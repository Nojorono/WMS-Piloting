<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class PickingController extends Controller
{
    private $menu_id = 14;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'datatablesOrderType',
            'datatablesPickingStatus',
            'datatables',
            'viewPDF',
        ]);
        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            'show',
            'cancelPicking',
            'datatablesChecker',
            'updatePicking',
            'tablesLocationDetails',
            'viewScanPicking',
            'saveScanQty',
            'getLastScan',
            'datatablesPickedItems',
            'confirmPicking',
            'getSKUAndLocation',
            'deletePickedItems',
            'datatablesOutstandingItems',
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([
        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("picking.index",compact("data"));
    }

    private function getOrderType($order_id = false)
    {
        $data = DB::query()
        ->select([
            "a.order_id",
            "a.order_type",
        ])
        ->from("m_wh_order_type as a")
        ->where("a.is_active","Y")
        ->where(function ($query) use($order_id)
        {
            if($order_id !== false){
                $query->where("a.order_id",$order_id);
            }
        })
        ->get();
        return $data;
    }

    public function datatablesOrderType(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getOrderType();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
        ->make(true);
    }

    private function getPickingStatus($status_id = false)
    {
        $data = DB::query()
        ->select([
            "a.status_id",
            "a.status_name",
            "a.process_id",
        ])
        ->from("m_status as a")
        ->leftJoin("m_process as b","b.process_id","=","a.process_id")
        ->where("b.process_id",20)
        ->where("a.is_active","Y")
        ->where(function ($query) use($status_id)
        {
            if(!empty($status_id)){
                $query->where("a.status_id",$status_id);
            }
        })
        ->get();
        return $data;
    }

    public function datatablesPickingStatus()
    {
        $data = $this->getPickingStatus();
        
        return DataTables::of($data)
        ->make(true);
    }

    private function getPickingListDatatables($outbound_date_from,$outbound_date_to,$outbound_id,$reference_no,$plan_delivery_date,$order_id,$status_id)
    {   
        $data = DB::query()
        ->select([
            "a.outbound_planning_no AS outbound_id",
            "c.wh_code AS warehouse_name",
            "g.client_name",
            "b.reference_no",
            "b.plan_delivery AS plan_delivery_date",
            "d.order_type",
            "e.status_name AS picking_status",
        ])
        ->from("t_wh_picking as a")
        ->leftJoin("t_wh_outbound_planning as b","b.outbound_planning_no","=","a.outbound_planning_no")
        ->leftJoin("m_warehouse as c","c.wh_id","=","b.wh_id")
        ->leftJoin("m_wh_order_type as d","d.order_id","=","b.order_id")
        ->leftJoin("m_status as e","e.status_id","=","a.status_id")
        ->leftJoin("m_wh_client_project as f","f.client_project_id","=","b.client_project_id")
        ->leftJoin("m_wh_client as g","g.client_id","=","f.client_id")
        ->where("b.wh_id",session('current_warehouse_id'))
        ->where("b.client_project_id",session('current_client_project_id'))
        ->where(function ($query) use($outbound_date_from,$outbound_date_to)
        {
            if(!empty($outbound_date_from) && !empty($outbound_date_to)){
                $query->where("a.datetime_created",">=",$outbound_date_from." 00:00:00");
                $query->where("a.datetime_created","<=",$outbound_date_to." 23:59:59");
            }else{
                $query->where(DB::raw("DATE_FORMAT(a.datetime_created,'%Y-%m-%d')"),date("Y-m-d",strtotime($this->datetime_now)));
            }
        })
        ->where(function ($query) use($outbound_id)
        {
            if(!empty($outbound_id)){
                $query->where("a.outbound_planning_no",$outbound_id);
            }
        })
        ->where(function ($query) use($reference_no)
        {
            if(!empty($reference_no)){
                $query->where("b.reference_no",$reference_no);
            }
        })
        ->where(function ($query) use($plan_delivery_date)
        {
            if(!empty($plan_delivery_date)){
                $query->where("b.plan_delivery",$plan_delivery_date);
            }
        })
        ->where(function ($query) use($order_id)
        {
            if(!empty($order_id)){
                $query->where("b.order_id",$order_id);
            }
        })
        ->where(function ($query) use($status_id)
        {
            if(!empty($status_id)){
                $query->where("a.status_id",$status_id);
            }
        })
        ->get();
        return $data;
    }

    public function datatables(Request $request)
    {
        $outbound_date_from = $request->input("outbound_date_from");
        $outbound_date_to = $request->input("outbound_date_to");
        $outbound_id = $request->input("outbound_id");
        $reference_no = $request->input("reference_no");
        $plan_delivery_date = $request->input("plan_delivery_date");
        $order_id = $request->input("order_id");
        $order_type = $request->input("order_type");
        $status_id = $request->input("status_id");
        $picking_status = $request->input("picking_status");

        $data = $this->getPickingListDatatables($outbound_date_from,$outbound_date_to,$outbound_id,$reference_no,$plan_delivery_date,$order_id,$status_id);

        return DataTables::of($data)
        ->addColumn('action', function ($outbound) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('picking.show',[ 'id'=> $outbound->outbound_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary py-1'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_Picking($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.outbound_planning_no AS outbound_id",
            "a.reference_no",
            "a.receipt_no",
            "d.order_type",
            "c.supplier_name",
            "c.address1 AS supplier_address",
            "a.plan_delivery AS plan_delivery_date",
            "b.sku",
            "f.part_name AS item_name",
            "b.serial_no",
            "f.imei",
            "f.part_no",
            "f.color",
            "f.size",
            "b.qty AS qty_allocated",
            "b.uom_name AS uom",
            "e.classification_name",
            "a.notes",
            "g.status_id",
            "g.picker AS checker",
        ])
        ->from("t_wh_picking as g")
        ->leftJoin("t_wh_outbound_planning as a","a.outbound_planning_no","=","g.outbound_planning_no")
        ->leftJoin("t_wh_outbound_planning_detail as b","b.outbound_planning_no","=","a.outbound_planning_no")
        ->leftJoin("m_wh_supplier as c","c.supplier_id","=","a.supplier_id")
        ->leftJoin("m_wh_order_type as d","d.order_id","=","a.order_id")
        ->leftJoin("m_item_classification as e",function ($query)
        {
            $query->on("e.item_classification_id","=","b.clasification_id");
            $query->where("e.process_id","=",19);
        })
        ->leftJoin("m_wh_item as f","f.sku","=","b.sku")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();

        return $data;
    }

    private function get_Picking_Quantity_Details($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.batch_no",
            "a.sku",
            "b.part_name",
            "a.available_qty",
            "a.allocated_qty",
            "a.expired_date",
            "a.gr_id",
        ])
        ->from("t_wh_outbound_detail_sku as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();

        return $data;
    }

    private function get_Status_Name($status_id)
    {
        if(empty($status_id)){
            return "";
        }

        $data = DB::query()
        ->select([
            "a.status_name",
        ])
        ->from("m_status as a")
        ->where("a.status_id",$status_id)
        ->where("a.is_active","Y")
        ->get();

        return $data;
    }

    private function get_t_wh_picking_detail($outbound_planning_no)
    {
        if(empty($outbound_planning_no)){
            return "";
        }
        $temp_data = DB::query()
        ->select([
            "a.outbound_planning_no",
            "a.sku",
            "b.part_name AS item_name",
            "a.batch_no",
            "a.serial_no",
            "a.expired_date",
            "d.available_qty",
            "a.pick_qty",
            "a.location_id",
            "a.stock_id",
            "a.gr_id",
        ])
        ->from("t_wh_picking_detail as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->leftJoin("t_wh_outbound_detail_sku as c",function ($query)
        {
            $query->on("c.sku","=","a.sku");
            $query->on("c.batch_no","=","a.batch_no");
            $query->on("c.outbound_planning_no","=","a.outbound_planning_no");
        })
        ->leftJoin("t_wh_location_inventory as d",function ($query)
        {
            $query->on("d.gr_id","=","c.gr_id");
            $query->on("d.location_id","=","a.location_id");
            $query->on("d.sku","=","a.sku");
            $query->on("d.batch_no","=","a.batch_no");
        })
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();

        $data = [];
        if(count($temp_data) > 0){
            foreach ($temp_data as $key_temp_data => $value_temp_data) {
                $full_data = new stdClass;
                $full_data->outbound_planning_no = $value_temp_data->outbound_planning_no;
                $full_data->sku = $value_temp_data->sku;
                $full_data->item_name = $value_temp_data->item_name;
                $full_data->batch_no = $value_temp_data->batch_no;
                $full_data->serial_no = $value_temp_data->serial_no;
                $full_data->expired_date = $value_temp_data->expired_date;
                $full_data->available_qty = $value_temp_data->available_qty;
                $full_data->pick_qty = $value_temp_data->pick_qty;
                $full_data->location_id = $value_temp_data->location_id;
                $full_data->stock_id = $value_temp_data->stock_id;
                $full_data->gr_id = $value_temp_data->gr_id;

                if(empty($value_temp_data->available_qty)){
                    $current_location_inventory = DB::query()
                    ->select([
                        "available_qty",
                    ])
                    ->from("t_wh_location_inventory")
                    ->where("location_id",$full_data->location_id)
                    ->where("sku",$full_data->sku)
                    ->where("stock_id",$full_data->stock_id)
                    ->where("gr_id",$full_data->gr_id)
                    ->get();
                    $full_data->available_qty = $current_location_inventory[0]->available_qty;
                    
                }

                $data[] = $full_data;
            }
        }

        return $data;
    }

    public function show(Request $request, $id) //menu ini show tapi bisa ngedit yang seharus nya tidak begitu, tapi instruksi dari mas mugna minta nya begini.
    {
        $pick_data = $this->get_Picking($id);
        
        if(count($pick_data) == 0){
            echo "<script>
            alert('Outbound Planning doesnt exist.');
            window.location.href = '".route('picking.index')."'
            </script>";
            return;
        }

        $pick_quantity_details_data = $this->get_Picking_Quantity_Details($id);

        $data = [];
        $data["pick_data"] = $pick_data;
        $data["pick_quantity_details_data"] = $pick_quantity_details_data;
        $data["pick_location_details_data"] = $this->get_t_wh_picking_detail($id);
        $data["status_name"] = @$this->get_Status_Name(@$pick_data[0]->status_id)[0]->status_name;
        
        return view("picking.show", compact('data'));
    }

    public function cancelPicking(Request $request, $id)
    {

        $pick_data = $this->get_Picking($id);

        if(count($pick_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Picking Data doesnt exist, Please reload Page.",
                "data" => [],
            ],200);
        }

        $status_id = @$pick_data[0]->status_id;

        if(!in_array($status_id, ["RPO"])){
            return response()->json([
                "err" => true,
                "message" => "Status is not RPO, cant cancel, Please Reload Page.",
                "data" => [],
            ],200);
        }

        $cancel_reason = $request->input("cancel_reason");

        DB::beginTransaction();
        try {

            $data_t_wh_outbound_planning = [
                "cancel_reason" => $cancel_reason,
                "status_id" => "COU",
                "user_updated" => session('username'),
                "datetime_updated" => $this->datetime_now,
            ];
            DB::table("t_wh_outbound_planning")
            ->where("outbound_planning_no" ,$pick_data[0]->outbound_id)
            ->update($data_t_wh_outbound_planning);

            $data_t_wh_picking = [
                "status_id" => "CPI",
                "user_updated" => session('username'),
                "datetime_updated" => $this->datetime_now,
            ];
            DB::table("t_wh_picking")
            ->where("outbound_planning_no" ,$pick_data[0]->outbound_id)
            ->update($data_t_wh_picking);
                
            $data_t_wh_outbound_planning_history = [
                "outbound_planning_no" => $pick_data[0]->outbound_id,
                "previous_state" => $status_id,
                "last_status" => "CPI",
                "user_created" => session("username"),
                "datetime_created" => $this->datetime_now,
            ];
            DB::table("t_wh_outbound_planning_history")->insert($data_t_wh_outbound_planning_history);

            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('QueryException error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],
            ],500);

        } catch (\Exception $error) {
            \Illuminate\Support\Facades\Log::error('Exception error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],

            ],500);
            
        }

        return response()->json([
            "err" => false,
            "message" => "Success Cancel Picking.",
            "data" => [],
        ],200);
    }

    private function getChecker($username = false)
    {
        $data = DB::query()
        ->select([
            "a.username",
            "a.fullname",
        ])
        ->from("t_wh_user as a")
        ->where("a.is_active","Y")
        ->whereIn("a.user_level_id",[1,3])
        ->where("a.wh_id",session("current_warehouse_id"))
        ->where(function ($query) use($username)
        {
            if(!empty($username)){
                $query->where("a.username",$username);
            }
        })
        ->get();
        return $data;
    }

    public function datatablesChecker()
    {
        $data = $this->getChecker();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function updatePicking(Request $request, $id)
    {
        $pick_data = $this->get_Picking($id);

        if(count($pick_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Picking Data doesnt exist, Please reload Page.",
                "data" => [],
            ],200);
        }

        $status_id = @$pick_data[0]->status_id;

        if(!in_array($status_id, ["RPO"])){
            return response()->json([
                "err" => true,
                "message" => "Status is not RPO, cant update.",
                "data" => [],
            ],200);
        }

        $checker = $request->input("checker");

        $arr_sku_no = json_decode($request->input("arr_sku_no"),true);
        $arr_location_details_location_id = json_decode($request->input("arr_location_details_location_id"),true);
        $arr_location_details_sku = json_decode($request->input("arr_location_details_sku"),true);
        $arr_location_details_part_name = json_decode($request->input("arr_location_details_part_name"),true);
        $arr_location_details_serial_no = json_decode($request->input("arr_location_details_serial_no"),true);
        $arr_location_details_batch_no = json_decode($request->input("arr_location_details_batch_no"),true);
        $arr_location_details_expired_date = json_decode($request->input("arr_location_details_expired_date"),true);
        $arr_location_details_available_qty = json_decode($request->input("arr_location_details_available_qty"),true);
        $arr_location_details_stock_id = json_decode($request->input("arr_location_details_stock_id"),true);
        $arr_location_details_gr_id = json_decode($request->input("arr_location_details_gr_id"),true);
        $arr_location_details_pick_qty = json_decode($request->input("arr_location_details_pick_qty"),true);

        $data_error = [];

        if(empty($checker)){
            $data_error["checker"][] = "Checker is required";
        }
        $exist_item_detail_sku_no = [];
        if(count($arr_sku_no) > 0){
            foreach ($arr_sku_no as $key_arr_sku_no => $value_arr_sku_no) {
                $exist_item_detail_sku_no[$value_arr_sku_no["id"]] = $value_arr_sku_no["value"];
            }
        }

        $max_row_location_details = count($arr_location_details_sku);

        for ($i=0; $i < $max_row_location_details; $i++) { 
            if(in_array($arr_location_details_sku[$i]["value"],$exist_item_detail_sku_no)){
                $key_temp = array_keys($exist_item_detail_sku_no,$arr_location_details_sku[$i]["value"])[0];
                unset($exist_item_detail_sku_no[$key_temp]);
            }
            
        }

        if(count($exist_item_detail_sku_no) > 0){
            foreach ($exist_item_detail_sku_no as $key_exist_item_detail_sku_no => $value_exist_item_detail_sku_no) {
                $data_error[$key_exist_item_detail_sku_no][] = "SKU Must Exists in Location Details.";
            }
        }
        
        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }

        $validated = [
            "checker" => $checker,
            "arr_location_details_location_id" => $arr_location_details_location_id,
            "arr_location_details_sku" => $arr_location_details_sku,
            "arr_location_details_part_name" => $arr_location_details_part_name,
            "arr_location_details_serial_no" => $arr_location_details_serial_no,
            "arr_location_details_batch_no" => $arr_location_details_batch_no,
            "arr_location_details_expired_date" => $arr_location_details_expired_date,
            "arr_location_details_available_qty" => $arr_location_details_available_qty,
            "arr_location_details_stock_id" => $arr_location_details_stock_id,
            "arr_location_details_gr_id" => $arr_location_details_gr_id,
            "arr_location_details_pick_qty" => $arr_location_details_pick_qty,
        ];

        DB::beginTransaction();
        try {

            $data_t_wh_picking = [
                "picker" => $validated["checker"],
                "user_updated" => session('username'),
                "datetime_updated" => $this->datetime_now,
            ];
            DB::table("t_wh_picking")
            ->where("outbound_planning_no" ,$pick_data[0]->outbound_id)
            ->update($data_t_wh_picking);

            if(isset($validated["arr_location_details_sku"]) && count($validated["arr_location_details_sku"]) > 0){

                $prev_data_t_wh_picking_detail =  DB::query()
                ->select([
                    "outbound_planning_no",
                    "sku",
                    "batch_no",
                    "serial_no",
                    "expired_date",
                    "pick_qty",
                    "location_id",
                    "stock_id",
                    "gr_id",
                    "user_created",
                    "datetime_created",
                ])
                ->from("t_wh_picking_detail")
                ->where("outbound_planning_no" ,$pick_data[0]->outbound_id)
                ->get();
                if(count($prev_data_t_wh_picking_detail) > 0){
                    foreach ($prev_data_t_wh_picking_detail as $key_prev_data_t_wh_picking_detail => $value_prev_data_t_wh_picking_detail) {
                        $current_location_inventory = DB::query()
                        ->select([
                            "allocated_qty",
                            "available_qty",
                        ])
                        ->from("t_wh_location_inventory")
                        ->where("location_id",$value_prev_data_t_wh_picking_detail->location_id)
                        ->where("sku",$value_prev_data_t_wh_picking_detail->sku)
                        ->where("batch_no",$value_prev_data_t_wh_picking_detail->batch_no)
                        ->where("stock_id",$value_prev_data_t_wh_picking_detail->stock_id)
                        ->where("gr_id",$value_prev_data_t_wh_picking_detail->gr_id)
                        ->get();
    
                        if(count($current_location_inventory) > 0){
                            $new_available_qty = $current_location_inventory[0]->available_qty + $value_prev_data_t_wh_picking_detail->pick_qty;
                            $new_allocated_qty = $current_location_inventory[0]->allocated_qty - $value_prev_data_t_wh_picking_detail->pick_qty;
                            DB::table("t_wh_location_inventory")
                            ->where("location_id",$value_prev_data_t_wh_picking_detail->location_id)
                            ->where("sku",$value_prev_data_t_wh_picking_detail->sku)
                            ->where("batch_no",$value_prev_data_t_wh_picking_detail->batch_no)
                            ->where("stock_id",$value_prev_data_t_wh_picking_detail->stock_id)
                            ->where("gr_id",$value_prev_data_t_wh_picking_detail->gr_id)
                            ->update([
                                "available_qty" => $new_available_qty,
                                "allocated_qty" => $new_allocated_qty,
                            ]);
                        }
                    }
                    
                }

                DB::table("t_wh_picking_detail")
                ->where("outbound_planning_no" ,$pick_data[0]->outbound_id)
                ->delete();

                $max_picking_detail = count($validated["arr_location_details_sku"]);
                for ($i=0; $i < $max_picking_detail; $i++) { 
                    $temp_t_wh_picking_detail = [
                        "outbound_planning_no" => $pick_data[0]->outbound_id,
                        "sku" => $validated["arr_location_details_sku"][$i]["value"],
                        "batch_no" => $validated["arr_location_details_batch_no"][$i]["value"],
                        "serial_no" => $validated["arr_location_details_serial_no"][$i]["value"],
                        "pick_qty" => $validated["arr_location_details_pick_qty"][$i]["value"],
                        "location_id" => $validated["arr_location_details_location_id"][$i]["value"],
                        "stock_id" => $validated["arr_location_details_stock_id"][$i]["value"],
                        "gr_id" => $validated["arr_location_details_gr_id"][$i]["value"],
                        "user_created" => session('username'),
                        "datetime_created" => $this->datetime_now,
                    ];

                    if(!empty($validated["arr_location_details_expired_date"][$i]["value"])){
                        $temp_t_wh_picking_detail["expired_date"] = $validated["arr_location_details_expired_date"][$i]["value"];
                    }
                    
                    DB::table("t_wh_picking_detail")
                    ->insert($temp_t_wh_picking_detail);

                    $current_location_inventory = DB::query()
                    ->select([
                        "allocated_qty",
                        "available_qty",
                    ])
                    ->from("t_wh_location_inventory")
                    ->where("location_id",$validated["arr_location_details_location_id"][$i]["value"])
                    ->where("sku",$validated["arr_location_details_sku"][$i]["value"])
                    ->where("batch_no",$validated["arr_location_details_batch_no"][$i]["value"])
                    ->where("stock_id",$validated["arr_location_details_stock_id"][$i]["value"])
                    ->where("gr_id",$validated["arr_location_details_gr_id"][$i]["value"])
                    ->get();

                    if(count($current_location_inventory) > 0){
                        $new_available_qty = $current_location_inventory[0]->available_qty - $validated["arr_location_details_pick_qty"][$i]["value"];
                        $new_allocated_qty = $current_location_inventory[0]->allocated_qty + $validated["arr_location_details_pick_qty"][$i]["value"];
                        DB::table("t_wh_location_inventory")
                        ->where("location_id",$validated["arr_location_details_location_id"][$i]["value"])
                        ->where("sku",$validated["arr_location_details_sku"][$i]["value"])
                        ->where("batch_no",$validated["arr_location_details_batch_no"][$i]["value"])
                        ->where("stock_id",$validated["arr_location_details_stock_id"][$i]["value"])
                        ->where("gr_id",$validated["arr_location_details_gr_id"][$i]["value"])
                        ->update([
                            "available_qty" => $new_available_qty,
                            "allocated_qty" => $new_allocated_qty,
                        ]);
                    }
                }
                
            }
            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('QueryException error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],
            ],500);

        } catch (\Exception $error) {
            \Illuminate\Support\Facades\Log::error('Exception error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],

            ],500);
            
        }

        return response()->json([
            "err" => false,
            "message" => "Success Update Picking.",
            "data" => [],
        ],200);
    }

    private function get_Picking_PDF($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.outbound_planning_no AS outbound_id",
            "a.reference_no",
            "cd.client_name",
            "a.plan_delivery AS plan_delivery_date",
            "g.picker",
            "d.order_type AS service_type",
            "h.location_id AS location",
            "h.sku AS sku_no",
            "f.part_name AS item_name",
            "h.batch_no",
            "h.serial_no",
            "h.expired_date",
            "h.pick_qty",
            "f.base_uom AS uom",
            "h.stock_id AS stock_type",
        ])
        ->from("t_wh_picking as g")
        ->leftJoin("t_wh_outbound_planning as a","a.outbound_planning_no","=","g.outbound_planning_no")
        ->leftJoin("m_wh_client_project as c","c.client_project_id","=","a.client_project_id")
        ->leftJoin("m_wh_client as cd","cd.client_id","=","c.client_id")
        ->leftJoin("m_wh_order_type as d","d.order_id","=","a.order_id")
        ->leftJoin("t_wh_picking_detail as h","h.outbound_planning_no","=","g.outbound_planning_no")
        ->leftJoin("m_wh_item as f","f.sku","=","h.sku")
        ->where("g.outbound_planning_no",$outbound_planning_no)
        ->get();
        return $data;

    }
    
    public function viewPDF(Request $request, $id)
    {
        $picking_pdf = $this->get_Picking_PDF($id);
        if(count($picking_pdf) == 0){
            echo "<script>
            alert('Data doesnt exist');
            window.location.href = '".route('picking.index')."'
            </script>";
            return;
        }


        $data = [];
        $data["current_data"] = $picking_pdf;
        // dd($data);
        $pdf = Pdf::loadView('picking.pdf', compact('data'));
        return $pdf->stream($data["current_data"][0]->outbound_id.".pdf");
    }

    public function tablesLocationDetails(Request $request)
    {
        $arr_batch_no = json_decode($request->input("arr_batch_no"),true);
        $arr_gr_id = json_decode($request->input("arr_gr_id"),true);
        $sku = $request->input("sku");

        if(empty($sku)){
            return response()->json([
                "err" => true,
                "message" => "SKU cannot be empty",
                "data" => [],
            ],200);
        }

        if(count($arr_batch_no) > 0){
            $data = DB::query()
            ->select([
                "a.on_hand_qty",
                "a.location_id",
                "a.batch_no",
                "e.serial_no",
                "a.sku",
                "b.part_name",
                DB::raw("SUM(a.available_qty) AS available_qty"),
                "a.expired_date",
                "a.stock_id",
                "a.gr_id",
            ])
            ->from("t_wh_location_inventory as a")
            ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
            ->leftJoin("t_wh_receive as c","c.gr_id","=","a.gr_id")
            ->leftJoin("t_wh_inbound_planning as d","d.inbound_planning_no","=","c.inbound_planning_no")
            ->leftJoin("t_wh_inbound_planning_detail as e",function ($query)
            {
                $query->on("e.sku","=","a.sku");
                $query->on("e.inbound_planning_no","=","c.inbound_planning_no");
            })
            ->where("a.sku",$sku)
            ->where(function ($query) use($arr_batch_no)
            {
                if(!empty($arr_batch_no)){
                    $query->whereIn("a.batch_no",$arr_batch_no);
                }
            })
            ->where(function ($query) use($arr_gr_id)
            {
                if(!empty($arr_gr_id)){
                    $query->whereIn("a.gr_id",$arr_gr_id);
                }
            })
            ->where("d.client_project_id",session('current_client_project_id'))
            ->groupBy("a.sku")
            ->groupBy("a.location_id")
            ->orderBy("c.datetime_created","desc")
            ->get();
        }else{
            $data = DB::query()
            ->select([
                "a.on_hand_qty",
                "a.location_id",
                "a.batch_no",
                "e.serial_no",
                "a.sku",
                "b.part_name",
                "a.available_qty",
                "a.expired_date",
                "a.stock_id",
                "a.gr_id",
            ])
            ->from("t_wh_location_inventory as a")
            ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
            ->leftJoin("t_wh_receive as c","c.gr_id","=","a.gr_id")
            ->leftJoin("t_wh_inbound_planning as d","d.inbound_planning_no","=","c.inbound_planning_no")
            ->leftJoin("t_wh_inbound_planning_detail as e",function ($query)
            {
                $query->on("e.sku","=","a.sku");
                $query->on("e.inbound_planning_no","=","c.inbound_planning_no");
            })
            ->where("a.sku",$sku)
            ->where("d.client_project_id",session('current_client_project_id'))
            ->orderBy("c.datetime_created","desc")
            ->get();
        }
        

        return response()->json([
            "err" => false,
            "message" => "Success get SKU Details",
            "data" => $data,
        ],200);

    }


    public function get_Picking_For_Scan($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.outbound_planning_no AS outbound_id",
            "a.reference_no",
            "a.receipt_no",
            "d.order_type",
            "ca.supplier_name",
            "ca.address1 AS supplier_address",
            "a.plan_delivery AS plan_delivery_date",
            "g.bucket_id",
            "g.picker",
            "h.location_id AS location",
            "h.sku AS sku_no",
            "f.part_name AS item_name",
            "h.batch_no",
            "h.serial_no",
            "h.expired_date",
            "h.pick_qty",
            "f.base_uom AS uom",
            "h.stock_id AS stock_type",
            "h.gr_id",
        ])
        ->from("t_wh_picking as g")
        ->leftJoin("t_wh_outbound_planning as a","a.outbound_planning_no","=","g.outbound_planning_no")
        ->leftJoin("m_wh_client_project as c","c.client_project_id","=","a.client_project_id")
        ->leftJoin("m_wh_client as cd","cd.client_id","=","c.client_id")
        ->leftJoin("m_wh_order_type as d","d.order_id","=","a.order_id")
        ->leftJoin("t_wh_picking_detail as h","h.outbound_planning_no","=","g.outbound_planning_no")
        ->leftJoin("m_wh_item as f","f.sku","=","h.sku")
        ->leftJoin("m_wh_supplier as ca","ca.supplier_id","=","a.supplier_id")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();

        return $data;
    }

    public function viewScanPicking(Request $request, $id)
    {
        $pick_data = $this->get_Picking($id);

        if(count($pick_data) == 0){
            echo "<script>
            alert('Outbound Planning doesnt exist.');
            window.location.href = '".route('picking.show',[ 'id'=> $pick_data[0]->outbound_id ])."'
            </script>";
            return;
        }

        $checker = @$pick_data[0]->checker;
        if($checker != session('username')){
            echo "<script>
            alert('You are not assigned to this.');
            window.location.href = '".route('picking.show',[ 'id'=> $pick_data[0]->outbound_id ])."'
            </script>";
            return;
        }

        $status_id = @$pick_data[0]->status_id;
        if($status_id != "RPO"){
            echo "<script>
            alert('Status is not RPO can\'t scan.');
            window.location.href = '".route('picking.show',[ 'id'=> $pick_data[0]->outbound_id ])."'
            </script>";
            return;
        }

        $pick_data_for_scan = $this->get_Picking_For_Scan($id);
        
        $data = [];
        $data["pick_data_for_scan"] = $pick_data_for_scan;
        
        return view('picking.view_scan_picking', compact('data'));
    }

    public function saveScanQty(Request $request, $id)
    {
        
        $pick_data_for_scan = $this->get_Picking_For_Scan($id);
       
        $arr_exist_pick_data_with_value_pick_qty = [];
        if(count($pick_data_for_scan) > 0){
            foreach ($pick_data_for_scan as $key_pick_data_for_scan => $value_pick_data_for_scan) {
                $saved_key = $value_pick_data_for_scan->location."|".$value_pick_data_for_scan->sku_no."|".$value_pick_data_for_scan->gr_id."|".$value_pick_data_for_scan->stock_type."|".$value_pick_data_for_scan->batch_no;
                $arr_exist_pick_data_with_value_pick_qty[$saved_key] =  $value_pick_data_for_scan->pick_qty;
            }
        }

        $target_data = json_decode($request->input("target_data"),true);
        if(count($target_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Need atleast 1 data",
                "data" => [],
            ],200);
        }

        foreach ($target_data as $key_target_data => $value_target_data) {
            $temp_allocated_qty = @$value_target_data["allocated_qty"];
            $temp_gr_id = @$value_target_data["gr_id"];
            $temp_location = @$value_target_data["location"];
            $temp_pick_qty = @$value_target_data["pick_qty"];
            $temp_sku = @$value_target_data["sku"];
            $temp_stock_type = @$value_target_data["stock_type"];
            $temp_batch_no = @$value_target_data["batch_no"];
            $search_key = $temp_location."|".$temp_sku."|".$temp_gr_id."|".$temp_stock_type."|".$temp_batch_no;

            if(!array_key_exists($search_key,$arr_exist_pick_data_with_value_pick_qty)){
                return response()->json([
                    "err" => true,
                    "message" => "Data is not exists with \nSKU: ".$temp_sku." \nGR ID: ".$temp_gr_id." \nStock Type: ".$temp_stock_type." \nBatch No: ".$temp_batch_no."\nLocation : ".$temp_location."\n please close modal and re-open.",
                    "data" => [],
                ],200);
            }
           

            $sum_qty = 0;
            $get_sum_qty = DB::query()
            ->select(DB::raw("SUM(a.scan_qty) AS qty"))
            ->from("t_wh_scan_picking as a")
            ->where("a.outbound_id",$pick_data_for_scan[0]->outbound_id)
            ->where("a.sku",$temp_sku)
            ->where("a.location_id",$temp_location)
            ->where("a.gr_id",$temp_gr_id)
            ->where("a.batch_no",$temp_batch_no)
            ->where("a.stock_id",$temp_stock_type)
            ->get();

            if(count($get_sum_qty) > 0){
                $sum_qty .= $get_sum_qty[0]->qty;
            }

            $total_qty = $temp_pick_qty + $sum_qty;
            $max_pick_qty = $arr_exist_pick_data_with_value_pick_qty[$search_key];

            if($total_qty > $max_pick_qty ){
                return response()->json([
                    "err" => true,
                    "message" => "Outstanding Qty cannot more than Pick Qty!, Data with \nSKU: ".$temp_sku." \nGR ID: ".$temp_gr_id." \nStock Type: ".$temp_stock_type." \nBatch No: ".$temp_batch_no."\nLocation : ".$temp_location."\n please close modal and re-open.",
                    "data" => [],
                ],200);
            }
        }
        

        DB::beginTransaction();
        try {
            foreach ($target_data as $key_target_data => $value_target_data) {
                $temp_allocated_qty = @$value_target_data["allocated_qty"];
                $temp_gr_id = @$value_target_data["gr_id"];
                $temp_location = @$value_target_data["location"];
                $temp_pick_qty = @$value_target_data["pick_qty"];
                $temp_sku = @$value_target_data["sku"];
                $temp_stock_type = @$value_target_data["stock_type"];
                $temp_batch_no = @$value_target_data["batch_no"];
                DB::table("t_wh_scan_picking")
                ->insert([
                    "outbound_id" => $pick_data_for_scan[0]->outbound_id,
                    "sku" => $temp_sku,
                    "location_id" => $temp_location,
                    "gr_id" => $temp_gr_id,
                    "stock_id" => $temp_stock_type,
                    "batch_no" => $temp_batch_no,
                    "scan_qty" => $temp_pick_qty,
                    "user_created" => session('username'),
                    "datetime_created" => $this->datetime_now,
                ]);
            }
           
            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('QueryException error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],
            ],500);

        } catch (\Exception $error) {
            \Illuminate\Support\Facades\Log::error('Exception error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],

            ],500);
            
        }

        return response()->json([
            "err" => false,
            "message" => "Success Add Scan",
            "data" => [],
        ],200);
    }

    public function getLastScan(Request $request, $id)
    {
        $data = DB::query()
        ->select([
            "a.sku",
            "b.part_name AS item_name",
            "a.scan_qty",
            "b.base_uom AS uom",
            "c.stock_id AS stock_type",
            "a.datetime_created AS datetime_scan",
        ])
        ->from("t_wh_scan_picking as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->leftJoin("t_wh_picking_detail as c","c.sku","=","a.sku")
        ->where("a.outbound_id",$id)
        ->orderBy("a.datetime_created","DESC")
        ->limit(1)
        ->get();

        return response()->json([
            "err" => false,
            "message" => "Success getLastScan",
            "data" => $data,
        ],200);

    }

    private function get_Picked_Items($outbound_id)
    {
        $data = DB::query()
        ->select([
            "a.location_id",
            "a.sku",
            "b.part_name AS item_name",
            "c.batch_no",
            "c.serial_no",
            "c.expired_date",
            DB::raw("SUM(a.scan_qty) AS scan_qty"),
            "b.base_uom AS uom",
            "c.stock_id AS stock_type",
            "a.gr_id",
            "a.user_created AS picked_by",
            "a.datetime_created AS datetime_scan",
        ])
        ->from("t_wh_scan_picking as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->leftJoin("t_wh_picking_detail as c",function ($query)
        {
            $query->on("c.sku","=","a.sku");
            $query->on("c.outbound_planning_no","=","a.outbound_id");
            $query->on("c.location_id","=","a.location_id");
            $query->on("c.gr_id","=","a.gr_id");
        })
        ->where("a.outbound_id",$outbound_id)
        ->groupBy("a.location_id")
        ->groupBy("a.sku")
        ->groupBy("a.batch_no")
        ->groupBy("a.gr_id")
        ->groupBy("a.stock_id")
        ->get();

        return $data;
    }
    public function datatablesPickedItems(Request $request,$id)
    {

        $data = $this->get_Picked_Items($id);

        return DataTables::of($data)
        ->addColumn('action', function ($outbound) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<span>
            <button class='btn btn-primary' onclick='displayModalDeletePickedItems(\"".$outbound->sku."\",\"".$outbound->gr_id."\",\"".$outbound->location_id."\",\"".$outbound->batch_no."\",\"".$outbound->stock_type."\")'>Delete</button>
            </span>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    public function confirmPicking(Request $request,$id)
    {

        $pick_data_for_scan = $this->get_Picking_For_Scan($id);
        $pick_data_scan_picking = $this->get_Picked_Items($id);
        $data_outstanding = $this->get_Outstanding_Items($id);

        $bucket_id = $request->input("bucket_id");

        if(empty($bucket_id)){
            return response()->json([
                "err" => true,
                "message" => "Bucket ID is Required",
                "data" => [],
            ],200);
        }
        
        if(count($data_outstanding) > 0){
            foreach ($data_outstanding as $key_data_outstanding => $value_data_outstanding) {
                if($value_data_outstanding->outstanding_qty == 0){
                    return response()->json([
                        "err" => true,
                        "message" => "Failed Confirm, some Outstanding Qty still 0 ",
                        "data" => [],
                    ],200);
                }
            }
        }
        
        DB::beginTransaction();
        try {
            DB::table("t_wh_picking")
            ->where("outbound_planning_no", $pick_data_for_scan[0]->outbound_id)
            ->update([
                "status_id" => "PIO",
            ]);

            DB::table("t_wh_outbound_planning")
            ->where("outbound_planning_no", $pick_data_for_scan[0]->outbound_id)
            ->update([
                "status_id" => "PPO",
            ]);

            DB::table("t_wh_checking")
            ->insert([
                "outbound_planning_no" => $pick_data_for_scan[0]->outbound_id,
                "status_id" => "UNC",
                "bucket_id" => $bucket_id,
                "user_created" => session('username'),
                "datetime_created" => $this->datetime_now,
            ]);

            foreach ($pick_data_scan_picking as $key_pick_data_scan_picking => $value_pick_data_scan_picking) {
                // SELECT 
                // allocated_qty
                // FROM t_wh_location_inventory
                // WHERE sku='112233445' /*record Sku pada tab outstanding items*/
                // AND gr_id='CBT-GR-1222-0014' /*record Gr Id pada tab outstanding items*/
                // AND location_id='1A1-001-001' /*record Location Id pada tab outstanding items*/
                // AND stock_id='AV' /*record Stock Type pada tab outstanding items*/
                // AND batch_no='20201212' /*record Batch No pada tab outstanding items*/

                $get_location_inventory = DB::query()
                ->select('allocated_qty')
                ->from("t_wh_location_inventory")
                ->where("sku",$value_pick_data_scan_picking->sku)
                ->where("gr_id",$value_pick_data_scan_picking->gr_id)
                ->where("location_id",$value_pick_data_scan_picking->location_id)
                ->where("stock_id",$value_pick_data_scan_picking->stock_type)
                ->where(function ($query) use($value_pick_data_scan_picking) 
                {
                    if(!empty($value_pick_data_scan_picking->batch_no)){
                        $query->where("batch_no",$value_pick_data_scan_picking->batch_no);
                    }
                })
                ->get();

                if(count($get_location_inventory) > 0){
                    $current_allocated_qty = $get_location_inventory[0]->allocated_qty;

                    $updated_allocated_qty = $current_allocated_qty - $value_pick_data_scan_picking->scan_qty;
                    $updated_picked_qty = $value_pick_data_scan_picking->scan_qty;

                    DB::table("t_wh_location_inventory")
                    ->where("sku",$value_pick_data_scan_picking->sku)
                    ->where("gr_id",$value_pick_data_scan_picking->gr_id)
                    ->where("location_id",$value_pick_data_scan_picking->location_id)
                    ->where("stock_id",$value_pick_data_scan_picking->stock_type)
                    ->where(function ($query) use($value_pick_data_scan_picking) 
                    {
                        if(!empty($value_pick_data_scan_picking->batch_no)){
                            $query->where("batch_no",$value_pick_data_scan_picking->batch_no);
                        }
                    })
                    ->update([
                        "allocated_qty"=> $updated_allocated_qty,
                        "picked_qty"=> $updated_picked_qty,
                    ]);
                }

            }
            
            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('QueryException error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],
            ],500);

        } catch (\Exception $error) {
            \Illuminate\Support\Facades\Log::error('Exception error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],

            ],500);
            
        }

        return response()->json([
            "err" => false,
            "message" => "Success Confirm Picking",
            "data" => [],
        ],200);
    }

    public function getSKUAndLocation(Request $request,$id)
    {
        $scan_sku = $request->input("scan_sku");
        $scan_location_id = $request->input("scan_location_id");

        if(empty($scan_sku)){
            return response()->json([
                "err" => true,
                "message" => "SKU is Required",
                "data" => [],
            ],200);
        }

        if(empty($scan_location_id)){
            return response()->json([
                "err" => true,
                "message" => "Location is Required",
                "data" => [],
            ],200);
        }

        $picking_for_scan = $this->get_Picking_For_Scan($id);
        $data_chosen_picking_for_scan = [];
        if(count($picking_for_scan) > 0){
            foreach ($picking_for_scan as $key_picking_for_scan => $value_picking_for_scan) {
                if($scan_sku == $value_picking_for_scan->sku_no && $scan_location_id ==$value_picking_for_scan->location){
                    $data_chosen_picking_for_scan[] = $value_picking_for_scan;
                }
            }
        }

        return response()->json([
            "err" => false,
            "message" => "Success getSKUAndLocation",
            "data" => $data_chosen_picking_for_scan,
        ],200);
    }

    public function deletePickedItems(Request $request, $id)
    {
        $sku = $request->input("sku");
        $gr_id = $request->input("gr_id");
        $location = $request->input("location");
        $stock_id = $request->input("stock_id");
        $batch_no = $request->input("batch_no");

        $check_data = DB::table("t_wh_scan_picking")
        ->where("outbound_id", $id)
        ->where("sku", $sku)
        ->where("location_id", $location)
        ->where("stock_id", $stock_id)
        ->where("gr_id", $gr_id)
        ->where(function ($query) use($batch_no)
        {
            if(!empty($batch_no)){
                $query->where("batch_no", $batch_no);
            }
        })
        ->get();

        if(count($check_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Target Delete Picked Items not exists please reload page.",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {

            DB::table("t_wh_scan_picking")
            ->where("outbound_id", $id)
            ->where("sku", $sku)
            ->where("location_id", $location)
            ->where("stock_id", $stock_id)
            ->where("gr_id", $gr_id)
            ->where(function ($query) use($batch_no)
            {
                if(!empty($batch_no)){
                    $query->where("batch_no", $batch_no);
                }
            })
            ->delete();
            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('QueryException error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],
            ],500);

        } catch (\Exception $error) {
            \Illuminate\Support\Facades\Log::error('Exception error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],

            ],500);
            
        }

        return response()->json([
            "err" => false,
            "message" => "Success Delete Picked Items",
            "data" => [],
        ],200);
    }

    private function get_Outstanding_Items($outbound_id)
    {
        $data = DB::query()
        ->select([
            "a.location_id AS location",
            "a.sku AS sku_no",
            "c.part_name AS item_name",
            "a.batch_no",
            "a.serial_no",
            "a.expired_date",
            "a.pick_qty",
            // DB::raw("IF(b.scan_qty IS NULL,'0',b.scan_qty) AS outstanding_qty"),
            DB::raw("IF(b.scan_qty IS NULL,'0',b.scan_qty) AS pick_qty, 
            case
                when (a.pick_qty - b.scan_qty) IS NULL then a.pick_qty
                ELSE (a.pick_qty - b.scan_qty)
                END AS outstanding_qty
            "),
            "c.base_uom AS uom",
            "a.stock_id AS stock_type",
            "a.gr_id",
        ])
        ->from("t_wh_picking_detail as a")
        ->leftJoin("t_wh_scan_picking as b",function ($query)
        {
            $query->on("b.sku","=","a.sku");
            $query->on("b.batch_no","=","a.batch_no");
            $query->on("b.outbound_id","=","a.outbound_planning_no");
            $query->on("b.location_id","=","a.location_id");
            $query->on("b.gr_id","=","a.gr_id");
        })
        ->leftJoin("m_wh_item  as c","c.sku","=","a.sku")
        ->where("a.outbound_planning_no",$outbound_id)
        ->whereRaw("(a.pick_qty - b.scan_qty) IS NULL")
        ->get();

        return $data;
    }
    public function datatablesOutstandingItems(Request $request,$id)
    {
        $data = $this->get_Outstanding_Items($id);
        
        return DataTables::of($data)
        ->make(true);
    }
}