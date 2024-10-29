<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class InventoryAdjustmentController extends Controller
{
    private $menu_id = 18;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'datatables',
            'datatablesAdjusmentTypeAndAdjustmentStatus',
            'viewExcel',
            'show',
        ]);
        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
            'create',
            'getSKUItemDetails',
            'store',
            'datatables_m_wh_adjustment_type',
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([
        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        return view('inventory-adjustment.index');
    }

    private function get_Datatables_Inventory_Adjustment($adjustment_id = false, $adjustment_code = false, $adjustment_status = false)
    {

        $data = DB::query()
        ->select([
            "a.adjustment_id",
            "b.client_project_name",
            "c.wh_code",
            "d.adjustment_type",
            "a.reason",
            "e.status_name",
            "a.adjustment_code",
            "a.status_id",
        ])
        ->from("t_wh_adjustment as a")
        ->leftJoin("m_wh_client_project as b","a.client_project_id","=","b.client_project_id")
        ->leftJoin("m_warehouse as c","a.wh_id","=","c.wh_id")
        ->leftJoin("m_wh_adjustment_type as d","a.adjustment_code","=","d.adjustment_code")
        ->leftJoin("m_status as e","a.status_id","=","e.status_id")
        ->where("a.client_project_id",session("current_client_project_id"))
        ->where(function ($query) use($adjustment_id)
        {
            if(!empty($adjustment_id)){
                $query->where("a.adjustment_id",$adjustment_id);
            }
        })
        ->where(function ($query) use($adjustment_code)
        {
            if(!empty($adjustment_code)){
                $query->where("a.adjustment_code",$adjustment_code);
            }
        })
        ->where(function ($query) use($adjustment_status)
        {
            if(!empty($adjustment_status)){
                $query->where("e.status_name",$adjustment_status);
            }
        })
        ->orderBy("a.datetime_created","DESC")
        ->get();
        return $data;

    }

    public function datatables(Request $request)
    {   
        $adjustment_id = $request->input("adjustment_id");
        $adjustment_type = $request->input("adjustment_type");
        $adjustment_status = $request->input("adjustment_status");

        $data = $this->get_Datatables_Inventory_Adjustment($adjustment_id,$adjustment_type,$adjustment_status);

        return DataTables::of($data)
        ->addColumn('action', function ($inventory_adjustment) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('inventory_adjustment.show',[ 'id'=> $inventory_adjustment->adjustment_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary text-xs py-1 mb-0'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    public function datatablesAdjusmentTypeAndAdjustmentStatus()
    {
        $data = DB::query()
        ->select([
            "a.process_code",
            "b.status_name",
        ])
        ->from("m_process as a")
        ->leftJoin("m_status as b","b.process_id","=","a.process_id")
        ->whereIn("a.process_id",[17,18])
        ->get();
        return DataTables::of($data)
        ->make(true);
    }

    public function viewExcel(Request $request)
    {
        $adjustment_id = $request->input("adjustment_id");
        $adjustment_type = $request->input("adjustment_type");
        $adjustment_status = $request->input("adjustment_status");
        $selected_column_query = json_decode($request->input("selected_column_query"),true);
        $mapping_filter_query = json_decode($request->input("mapping_filter_query"),true);

        $data = $this->get_Datatables_Inventory_Adjustment($adjustment_id,$adjustment_type,$adjustment_status);

        $spreadsheet = new Spreadsheet(); 
        $spreadsheet->getProperties()
        ->setCreator(config('app.name'))
        ->setLastModifiedBy(config('app.name'))
        ->setTitle("Inventory Adjustment Excel")
        ->setSubject("Inventory Adjustment Excel")
        ->setDescription("Inventory Adjustment Excel")
        ->setKeywords("office 2007 openxml php");
        $spreadsheet->getActiveSheet()->setTitle('Inventory_Adjustment');
        $row = 1;
        $row_alphabet = "A";


        if(count($mapping_filter_query) > 0){
            foreach ($mapping_filter_query as $key_mapping_filter_query => $value_mapping_filter_query) {
                $id = $value_mapping_filter_query["id"];
                $desc = $value_mapping_filter_query["desc"];
                if(in_array($id,$selected_column_query)){
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, $desc);
                    $row_alphabet++;
                }
            }
        }
        $row++;

        if(count($data) > 0){
            foreach ($data as $key_data => $value_data) {
                $row_alphabet = "A";
                if(count($mapping_filter_query) > 0){
                    foreach ($mapping_filter_query as $key_mapping_filter_query => $value_mapping_filter_query) {
                        $id = $value_mapping_filter_query["id"];
                        $desc = $value_mapping_filter_query["desc"];
                        if(in_array($id,$selected_column_query)){
                            $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, $value_data->$id);
                            $row_alphabet++;
                        }
                    }
                }
                $row++;
            }

        }

        $filename = "Inventory_Adjustment_".date("YmdHis",strtotime($this->datetime_now));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $objWriter->save('php://output');
        exit();
    }

    public function create()
    {
        return view('inventory-adjustment.create');
    }

    private function get_m_wh_adjustment_type($adjustment_code = false)
    {
        $data = DB::query()
        ->select([
            "a.adjustment_code",
            "a.adjustment_type",
        ])
        ->from("m_wh_adjustment_type as a")
        ->where(function ($query) use($adjustment_code)
        {
            if($adjustment_code !== false){
                $query->where("a.adjustment_code",$adjustment_code);
            }
        })
        ->get();
        return $data;
    }

    public function datatables_m_wh_adjustment_type()
    {
        $data = $this->get_m_wh_adjustment_type();
        return DataTables::of($data)
        ->make(true);
    }

    public function getSKUItemDetails(Request $request)
    {

        $sku = $request->input("sku");

        $data = DB::query()
        ->select([
            "a.location_id",
            "a.sku",
            "a.part_name",
            "a.batch_no",
            "a.serial_no",
            "a.imei",
            "a.part_no",
            "a.color",
            "a.size",
            "a.expired_date",
            "a.stock_id",
            "a.on_hand_qty AS qty",
            "a.uom_name",
            "a.gr_id",
        ])
        ->from("t_wh_location_inventory as a")
        ->where("a.client_project_id",session("current_warehouse_id"))
        ->where(function ($query) use($sku)
        {
            if(!empty($sku)){
                $query->where("a.sku",$sku);
            }
        })
        ->orderBy("a.location_id","ASC")
        ->orderBy("a.sku","ASC")
        ->orderBy("a.batch_no","ASC")
        ->get();

        return response()->json([
            "err" => false,
            "message" => "Success getSKUItemDetails",
            "data" => $data,
        ],200);
        
    }

    private function getStatusID($process_code,$status_id)
    {
        $data = DB::query()
        ->select([
            "b.status_id",
        ])
        ->from("m_process AS a")
        ->leftJoin("m_status AS b","b.process_id","=","a.process_id")
        ->where("a.process_code",$process_code)
        ->where("b.status_id",$status_id)
        ->get();
        
        if(count($data) == 0){
            return false;
        }

        $result_status_id = $data[0]->status_id;

        return $result_status_id;
    }

    private function mustFourDigits($data)
    {
        while (strlen($data) < 4) {
            $data = "0".$data;
        }
        return $data;
    }

    private function getWHPrefix()
    {
        $wh_prefix = false;

        $data = DB::query()
        ->select([
            "a.wh_prefix",
        ])
        ->from("m_warehouse as a")
        ->where("a.wh_id",session("current_warehouse_id"))
        ->get();
        
        if(count($data) == 0){

            return $wh_prefix;
        }

        $wh_prefix = $data[0]->wh_prefix;

        return $wh_prefix;
    }

    private function getLastRunningNumber($process_code)
    {
        $running_number = 0;

        $data = DB::query()
        ->select([
            "a.running_number",
        ])
        ->from("t_running_number as a")
        ->where("a.process_code",$process_code )
        ->where("a.date",date("Y-m" ,strtotime($this->datetime_now)))
        ->where("a.wh_id",session("current_warehouse_id"))
        ->get();

        if(count($data) == 0){
            $insert_running_number = DB::table("t_running_number")
            ->insert([
                "process_code" => $process_code ,
                "date" => date("Y-m" ,strtotime($this->datetime_now)),
                "wh_id" => session("current_warehouse_id"),
                "running_number" => 0,
            ]);
            return $running_number;
        }

        $running_number = $data[0]->running_number;

        return $running_number;
    }

    private function updateRunningNumber($last_running_number,$process_code)
    {
        $data = DB::table("t_running_number as a")
        ->where("a.process_code",$process_code)
        ->where("a.date",date("Y-m" ,strtotime($this->datetime_now)))
        ->where("a.wh_id",session("current_warehouse_id"))
        ->update([
            "running_number" => $last_running_number,
        ]);
    }

    public function store(Request $request)
    {

        $adjustment_code = $request->input("adjustment_code");
        $adjustment_type = $request->input("adjustment_type");
        $reason = $request->input("reason");

        $arr_item_detail_sku = json_decode($request->input("arr_item_detail_sku"),true);
        $arr_item_detail_item_name = json_decode($request->input("arr_item_detail_item_name"),true);
        $arr_item_detail_batch_no = json_decode($request->input("arr_item_detail_batch_no"),true);
        $arr_item_detail_serial_no = json_decode($request->input("arr_item_detail_serial_no"),true);
        $arr_item_detail_imei_no = json_decode($request->input("arr_item_detail_imei_no"),true);
        $arr_item_detail_part_no = json_decode($request->input("arr_item_detail_part_no"),true);
        $arr_item_detail_color = json_decode($request->input("arr_item_detail_color"),true);
        $arr_item_detail_size = json_decode($request->input("arr_item_detail_size"),true);
        $arr_item_detail_expired_date = json_decode($request->input("arr_item_detail_expired_date"),true);
        $arr_item_detail_location = json_decode($request->input("arr_item_detail_location"),true);
        $arr_item_detail_stock_id = json_decode($request->input("arr_item_detail_stock_id"),true);
        $arr_item_detail_adjustment_qty = json_decode($request->input("arr_item_detail_adjustment_qty"),true);
        $arr_item_detail_uom = json_decode($request->input("arr_item_detail_uom"),true);
        $arr_item_detail_gr_id = json_decode($request->input("arr_item_detail_gr_id"),true);

        $data_error = [];
        if(empty($adjustment_code)){
            $data_error["adjustment_type"][] = "Adjustment Type is is Required";
        }

        if(empty($reason)){
            $data_error["reason"][] = "Reason is is Required";
        }


        if(
            count($arr_item_detail_sku) == 0 ||
            count($arr_item_detail_item_name) == 0 ||
            count($arr_item_detail_batch_no) == 0 ||
            count($arr_item_detail_serial_no) == 0 ||
            count($arr_item_detail_imei_no) == 0 ||
            count($arr_item_detail_part_no) == 0 ||
            count($arr_item_detail_color) == 0 ||
            count($arr_item_detail_size) == 0 ||
            count($arr_item_detail_expired_date) == 0 ||
            count($arr_item_detail_location) == 0 ||
            count($arr_item_detail_stock_id) == 0 ||
            count($arr_item_detail_adjustment_qty) == 0 ||
            count($arr_item_detail_uom) == 0 ||
            count($arr_item_detail_gr_id) == 0 
        ){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details is required",
                "data" => $data_error,
            ],200);
        }

        $max_count_detail = count($arr_item_detail_sku);
        for ($i=0; $i < $max_count_detail; $i++) { 
            $adjustment_qty_id = $arr_item_detail_adjustment_qty[$i]['id'];
            $adjustment_qty_value = $arr_item_detail_adjustment_qty[$i]['value'];

            if(empty($adjustment_qty_value)){
                $data_error[$adjustment_qty_id][] = "Adjustment Qty is is Required";
            }else if ($adjustment_qty_value <= 0){
                $data_error[$adjustment_qty_id][] = "Adjustment Qty must more than 0";
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
            "adjustment_code" => $adjustment_code,
            "adjustment_type" => $adjustment_type,
            "reason" => $reason,
            "arr_item_detail_sku" => $arr_item_detail_sku,
            "arr_item_detail_item_name" => $arr_item_detail_item_name,
            "arr_item_detail_batch_no" => $arr_item_detail_batch_no,
            "arr_item_detail_serial_no" => $arr_item_detail_serial_no,
            "arr_item_detail_imei_no" => $arr_item_detail_imei_no,
            "arr_item_detail_part_no" => $arr_item_detail_part_no,
            "arr_item_detail_color" => $arr_item_detail_color,
            "arr_item_detail_size" => $arr_item_detail_size,
            "arr_item_detail_expired_date" => $arr_item_detail_expired_date,
            "arr_item_detail_location" => $arr_item_detail_location,
            "arr_item_detail_stock_id" => $arr_item_detail_stock_id,
            "arr_item_detail_adjustment_qty" => $arr_item_detail_adjustment_qty,
            "arr_item_detail_uom" => $arr_item_detail_uom,
            "arr_item_detail_gr_id" => $arr_item_detail_gr_id,
        ];
        
        DB::beginTransaction();
        try {

            $process_code = $validated["adjustment_code"];
            $temp_status_id = "";
            
            if($process_code == "ADIN"){
                $temp_status_id = "OIN";
            }else if ($process_code == "ADOUT"){
                $temp_status_id = "OOT";
            }
            
            if(empty($temp_status_id)){
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Status ID is not defined",
                    "data" => [],
                ],200);
            }

            $status_id = $this->getStatusID($process_code,$temp_status_id);

            if(!$status_id){
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Status ID is not defined",
                    "data" => [],
                ],200);
            }

            $wh_prefix = $this->getWHPrefix();
            $date_format_data = date("my",strtotime($this->datetime_now));
            $current_running_number = $this->getLastRunningNumber($process_code) + 1;
            $running_number = $this->mustFourDigits($current_running_number);
            $adjustment_id = $wh_prefix."-".$process_code."-".$date_format_data."-".$running_number;

            if($current_running_number > 9999){
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Running Number is more than 9999, cant create more.",
                    "data" => [],
                ],200);
            }

            $this->updateRunningNumber($current_running_number,$process_code);

            DB::table("t_wh_adjustment")
            ->insert([
                "adjustment_id" => $adjustment_id,
                "client_project_id" => session("current_client_project_id"),
                "wh_id" => session("current_warehouse_id"),
                "adjustment_code" => $process_code,
                "reason" => $validated["reason"],
                "status_id" => $status_id,
                "user_created" => session("username"),
                "datetime_created" => $this->datetime_now,
            ]);

            $max_count_detail = count($validated["arr_item_detail_sku"]);

            $data_t_wh_adjustment_detail = [];
            for ($i=0; $i < $max_count_detail; $i++) { 
                $sku = $validated["arr_item_detail_sku"][$i]["value"];
                $item_name = $validated["arr_item_detail_item_name"][$i]["value"];
                $batch_no = $validated["arr_item_detail_batch_no"][$i]["value"];
                $serial_no = $validated["arr_item_detail_serial_no"][$i]["value"];
                $imei_no = $validated["arr_item_detail_imei_no"][$i]["value"];
                $part_no = $validated["arr_item_detail_part_no"][$i]["value"];
                $color = $validated["arr_item_detail_color"][$i]["value"];
                $size = $validated["arr_item_detail_size"][$i]["value"];
                $expired_date = (!empty($validated["arr_item_detail_expired_date"][$i]["value"])) ? $validated["arr_item_detail_expired_date"][$i]["value"] : null;
                $location = $validated["arr_item_detail_location"][$i]["value"];
                $stock_id = $validated["arr_item_detail_stock_id"][$i]["value"];
                $adjustment_qty = $validated["arr_item_detail_adjustment_qty"][$i]["value"];
                $uom = $validated["arr_item_detail_uom"][$i]["value"];
                $gr_id = $validated["arr_item_detail_gr_id"][$i]["value"];
                
                $temp = [
                    "adjustment_id" => $adjustment_id,
                    "location_code" => $location,
                    "sku" => $sku,
                    "item_name" => $item_name,
                    "batch_no" => $batch_no,
                    "serial_no" => $serial_no,
                    "imei" => $imei_no,
                    "part_no" => $part_no,
                    "color" => $color,
                    "size" => $size,
                    "expired_date" => $expired_date,
                    "stock_id" => $stock_id,
                    "adjustment_qty" => $adjustment_qty,
                    "uom_name" => $uom,
                    "gr_id" => $gr_id,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];
                
                $data_t_wh_adjustment_detail[] = $temp;
            }

            DB::table("t_wh_adjustment_detail")
            ->insert($data_t_wh_adjustment_detail);
        
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
            "message" => "Success Add Adjustment Inventory",
            "data" => [],
        ],200);
    }

    private function get_Inventory_Adjustment_Detail($adjustment_id)
    {
        $data = DB::query()
        ->select([
            "a.adjustment_id",
            "a.location_code",
            "a.sku",
            "a.item_name",
            "a.batch_no",
            "a.serial_no",
            "a.imei",
            "a.part_no",
            "a.color",
            "a.size",
            "a.expired_date",
            "a.stock_id",
            "a.adjustment_qty",
            "a.final_qty",
            "a.uom_name",
            "a.gr_id",
            "a.movement_id",
            "a.user_created",
            "a.datetime_created",
        ])
        ->from("t_wh_adjustment_detail as a")
        ->where("a.adjustment_id",$adjustment_id)
        ->get();

        return $data;
    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Datatables_Inventory_Adjustment($id,false,false);

        if(count($current_data) == 0){
            echo "<script>
            alert('Adjustment ID doesnt exist');
            window.location.href = '".route('inventory_adjustment.index')."'
            </script>";
            return;
        }

        $current_data_detail = $this->get_Inventory_Adjustment_Detail($current_data[0]->adjustment_id);

        $data = [];

        $data["current_data"] = $current_data;
        $data["current_data_detail"] = $current_data_detail;
        return view('inventory-adjustment.show',compact("data"));
    }

    public function confirmInventoryAdjustment(Request $request, $id)
    {
        $current_data = $this->get_Datatables_Inventory_Adjustment($id,false,false);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Adjustment ID doesnt exist, Please reload the page",
                "data" => [],
            ],200);
        }

        $current_data_detail = $this->get_Inventory_Adjustment_Detail($current_data[0]->adjustment_id);


        if(!in_array($current_data[0]->status_id,["OOT","OIN"])){
            return response()->json([
                "err" => true,
                "message" => "Adjustment ID is not Open, cant confirm.",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {

            $process_code = $current_data[0]->adjustment_code;
            $temp_status_id = "";
            
            if($process_code == "ADIN"){
                $last_movement_process_code = "09";
                $temp_status_id = "CAI";
                $status_id = $this->getStatusID($process_code,$temp_status_id);
                if(!$status_id){
                    DB::rollBack();
                    return response()->json([
                        "err" => true,
                        "message" => "Status ID is not defined",
                        "data" => [],
                    ],200);
                }

                if(count($current_data_detail) > 0){
                    foreach ($current_data_detail as $key_current_data_detail => $value_current_data_detail) {
                        $calculate_final_qty = DB::query()
                        ->select([
                            "a.adjustment_id",
                            "b.adjustment_code",
                            "a.sku",
                            "a.batch_no",
                            "a.location_code",
                            "a.adjustment_qty",
                            "c.on_hand_qty",
                            "c.available_qty",
                            DB::raw("(c.on_hand_qty+a.adjustment_qty) AS final_qty"),
                        ])
                        ->from("t_wh_adjustment_detail as a")
                        ->leftJoin("t_wh_adjustment as b","a.adjustment_id","=","b.adjustment_id")
                        ->leftJoin("t_wh_location_inventory as c",function ($query)
                        {
                            $query->on("a.sku","=","c.sku");
                            $query->on("a.location_code","=","c.location_id");
                            $query->on("a.batch_no","=","c.batch_no");
                            $query->on("a.stock_id","=","c.stock_id");
                        })
                        ->where("a.sku",$value_current_data_detail->sku)
                        ->where("a.location_code",$value_current_data_detail->location_code)
                        ->where("a.batch_no",$value_current_data_detail->batch_no)
                        ->where("a.gr_id",$value_current_data_detail->gr_id)
                        ->where("a.adjustment_id",$value_current_data_detail->adjustment_id)
                        ->where("a.stock_id",$value_current_data_detail->stock_id)
                        ->get();

                        if(count($calculate_final_qty) > 0){
                            

                            $wh_prefix = $this->getWHPrefix();
                            $date_format_data = date("my",strtotime($this->datetime_now));
                            $current_running_number = $this->getLastRunningNumber($last_movement_process_code) + 1;
                            $running_number = $this->mustFourDigits($current_running_number);
                            $last_movement_id = $wh_prefix."-".$last_movement_process_code."-".$date_format_data."-".$running_number;
                        
                            $this->updateRunningNumber($current_running_number,$last_movement_process_code);

                            $final_qty = @$calculate_final_qty[0]->final_qty;
                            DB::table("t_wh_location_inventory")
                            ->where("sku",$value_current_data_detail->sku)
                            ->where("location_id",$value_current_data_detail->location_code)
                            ->where("batch_no",$value_current_data_detail->batch_no)
                            ->where("stock_id",$value_current_data_detail->stock_id)
                            ->where("gr_id",$value_current_data_detail->gr_id)
                            ->update([
                                "on_hand_qty" => $final_qty,
                                "available_qty" => $final_qty,
                                "last_movement_id" => $last_movement_id,
                                "user_updated" => session("username"),
                                "datetime_updated" => $this->datetime_now,
                            ]);

                            DB::table("t_wh_adjustment_detail")
                            ->where("adjustment_id",$value_current_data_detail->adjustment_id)
                            ->where("sku",$value_current_data_detail->sku)
                            ->where("location_code",$value_current_data_detail->location_code)
                            ->where("batch_no",$value_current_data_detail->batch_no)
                            ->where("stock_id",$value_current_data_detail->stock_id)
                            ->where("gr_id",$value_current_data_detail->gr_id)
                            ->update([
                                "final_qty" => $final_qty,
                                "movement_id" => $last_movement_id,
                            ]);
                        }
                    }
                }

                DB::table("t_wh_adjustment")
                ->where("adjustment_id",$current_data[0]->adjustment_id)
                ->update([
                    "status_id" => $status_id,
                    "user_updated" => session("username"),
                    "datetime_updated" => $this->datetime_now,
                ]);
                
               
            }else if ($process_code == "ADOUT"){
                $last_movement_process_code = "10";
                $temp_status_id = "CAO";
                $status_id = $this->getStatusID($process_code,$temp_status_id);
                
                if(!$status_id){
                    DB::rollBack();
                    return response()->json([
                        "err" => true,
                        "message" => "Status ID is not defined",
                        "data" => [],
                    ],200);
                }

                if(count($current_data_detail) > 0){
                    foreach ($current_data_detail as $key_current_data_detail => $value_current_data_detail) {

                        $calculate_final_qty = DB::query()
                        ->select([
                            "a.adjustment_id",
                            "b.adjustment_code",
                            "a.sku",
                            "a.batch_no",
                            "a.location_code",
                            "a.adjustment_qty",
                            "c.on_hand_qty",
                            "c.available_qty",
                            DB::raw("(c.on_hand_qty-a.adjustment_qty) AS final_qty"),
                        ])
                        ->from("t_wh_adjustment_detail as a")
                        ->leftJoin("t_wh_adjustment as b","a.adjustment_id","=","b.adjustment_id")
                        ->leftJoin("t_wh_location_inventory as c",function ($query)
                        {
                            $query->on("a.sku","=","c.sku");
                            $query->on("a.location_code","=","c.location_id");
                            $query->on("a.batch_no","=","c.batch_no");
                            $query->on("a.stock_id","=","c.stock_id");
                        })
                        ->where("a.sku",$value_current_data_detail->sku)
                        ->where("a.location_code",$value_current_data_detail->location_code)
                        ->where("a.batch_no",$value_current_data_detail->batch_no)
                        ->where("a.gr_id",$value_current_data_detail->gr_id)
                        ->where("a.adjustment_id",$value_current_data_detail->adjustment_id)
                        ->where("a.stock_id",$value_current_data_detail->stock_id)
                        ->get();

                        if(count($calculate_final_qty) > 0){
                            $wh_prefix = $this->getWHPrefix();
                            $date_format_data = date("my",strtotime($this->datetime_now));
                            $current_running_number = $this->getLastRunningNumber($last_movement_process_code) + 1;
                            $running_number = $this->mustFourDigits($current_running_number);
                            $last_movement_id = $wh_prefix."-".$last_movement_process_code."-".$date_format_data."-".$running_number;
                            $this->updateRunningNumber($current_running_number,$last_movement_process_code);
                            $final_qty = @$calculate_final_qty[0]->final_qty;

                            DB::table("t_wh_location_inventory")
                            ->where("sku",$value_current_data_detail->sku)
                            ->where("location_id",$value_current_data_detail->location_code)
                            ->where("batch_no",$value_current_data_detail->batch_no)
                            ->where("stock_id",$value_current_data_detail->stock_id)
                            ->where("gr_id",$value_current_data_detail->gr_id)
                            ->update([
                                "on_hand_qty" => $final_qty,
                                "available_qty" => $final_qty,
                                "last_movement_id" => $last_movement_id,
                                "user_updated" => session("username"),
                                "datetime_updated" => $this->datetime_now,
                            ]);

                            DB::table("t_wh_adjustment_detail")
                            ->where("adjustment_id",$value_current_data_detail->adjustment_id)
                            ->where("sku",$value_current_data_detail->sku)
                            ->where("location_code",$value_current_data_detail->location_code)
                            ->where("batch_no",$value_current_data_detail->batch_no)
                            ->where("stock_id",$value_current_data_detail->stock_id)
                            ->where("gr_id",$value_current_data_detail->gr_id)
                            ->update([
                                "final_qty" => $final_qty,
                                "movement_id" => $last_movement_id,
                            ]);
                        }
                    }
                }

                DB::table("t_wh_adjustment")
                ->where("adjustment_id",$current_data[0]->adjustment_id)
                ->update([
                    "status_id" => $status_id,
                    "user_updated" => session("username"),
                    "datetime_updated" => $this->datetime_now,
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
            "message" => "Success Confirm Inventory Adjustment",
            "data" => [],
        ],200);
    }
}
