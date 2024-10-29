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

class CheckingController extends Controller
{
    private $menu_id = 17;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'datatables',
            'show',
        ]);
        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            'updateChecking',
            // 'datatablesSupervisor',
            // 'datatablesVehicleType',
            // 'datatablesTransporter',
            // 'datatablesServiceType',
            'datatablesChecker',
            'viewScanForm',
            'datatablesCheckedItems',
            'datatablesOutstandingItems',
            'getLastScan',
            'getSKUAndLocation',
            'confirmChecking',
            'printShippingLabel',
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([
        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        return view('checking.index');
    }

    private function get_Checking($outbound_planning_no = false,$bucket_id = false)
    {
        $data = DB::query()
        ->select([
            "a.outbound_planning_no as outbound_id",
            "c.wh_code AS warehouse_name",
            "g.client_name",
            "b.reference_no",
            "b.plan_delivery AS plan_delivery_date",
            "d.order_type",
            "e.status_name AS picking_status",
            "a.status_id",
        ])
        ->from("t_wh_checking as a")
        ->leftJoin("t_wh_outbound_planning as b","b.outbound_planning_no","=","a.outbound_planning_no")
        ->leftJoin("m_warehouse as c","c.wh_id","=","b.wh_id")
        ->leftJoin("m_wh_order_type as d","d.order_id","=","b.order_id")
        ->leftJoin("m_status as e","e.status_id","=","a.status_id")
        ->leftJoin("m_wh_client_project as f","f.client_project_id","=","b.client_project_id")
        ->leftJoin("m_wh_client as g","g.client_id","=","f.client_id")
        ->where("b.wh_id",session("current_warehouse_id"))
        ->where("b.client_project_id",session("current_client_project_id"))
        ->where(DB::raw("DATE_FORMAT(a.datetime_created,'%Y-%m-%d')"),date("Y-m-d",strtotime($this->datetime_now)))
        ->where(function ($query) use($outbound_planning_no)
        {
            if($outbound_planning_no != false){
                $query->where("a.outbound_planning_no",$outbound_planning_no);
            }
        })
        ->where(function ($query) use($bucket_id)
        {
            if(!empty($bucket_id)){
                $query->where("a.bucket_id",$bucket_id);
            }
        })
        ->get();
        return $data;

    }

    public function datatables(Request $request)
    {

        $bucket_id = $request->input("bucket_id");
        $data = $this->get_Checking(false,$bucket_id);

        return DataTables::of($data)
        ->addColumn('action', function ($checking) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('checking.show',[ 'id'=> $checking->outbound_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary py-1 mb-0'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_Data_Transport_Loading($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.supervisor_id",
            "a.vehicle_id",
            "b.vehicle_type",
            "a.transporter_id",
            "c.transporter_name",
            "a.service_id",
            "d.service_name",
            "a.start_loading",
            "a.finish_loading",
            "a.driver",
            "a.vehicle_no",
            "a.container_no",
            "a.seal_no",
            "a.consignee_name",
            "a.consignee_address",
            "a.consignee_city",
            "a.remark",
            "a.phone_no",
        ])
        ->from("t_wh_checking_transport_loading as a")
        ->leftJoin("m_wh_vehicle as b","b.vehicle_id","=","a.vehicle_id")
        ->leftJoin("m_wh_transporter as c","c.transporter_id","=","a.transporter_id")
        ->leftJoin("m_wh_service_type as d","d.service_id","=","a.service_id")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();
        return $data;
    }

    private function get_Data_Header($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.outbound_planning_no",
            "b.reference_no",
            "b.receipt_no",
            "c.order_type",
            "a.bucket_id",
            "d.supplier_name AS supplier_name",
            "d.address1 AS supplier_address",
            "b.plan_delivery",
            "a.checker",
            "a.carton_id",
        ])
        ->from("t_wh_checking as a")
        ->leftJoin("t_wh_outbound_planning as b","a.outbound_planning_no","=","b.outbound_planning_no")
        ->leftJoin("m_wh_order_type as c","b.order_id","=","c.order_id")
        ->leftJoin("m_wh_supplier as d","b.supplier_id","=","d.supplier_id")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();
        return $data;
    }

    private function get_Data_Attachment($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.img_url",
            "a.order_id",
            "a.description",
        ])
        ->from("t_wh_checking_attachment as a")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();
        return $data;
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

    private function get_Data_Item_Detail($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.outbound_planning_no AS outbound_id",
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
        ])
        ->from("t_wh_picking as g")
        ->leftJoin("t_wh_outbound_planning as a","a.outbound_planning_no","=","g.outbound_planning_no")
        ->leftJoin("t_wh_outbound_planning_detail as b","b.outbound_planning_no","=","a.outbound_planning_no")
        ->leftJoin("m_wh_supplier as c","c.supplier_id","=","a.supplier_id")
        ->leftJoin("m_wh_order_type as d","d.order_id","=","a.order_id")
        ->leftJoin("m_item_classification as e",function ($query)
        {
            $query->on("e.item_classification_id","=","b.clasification_id");
            $query->where("e.process_id","19");
        })
        ->leftJoin("m_wh_item as f","f.sku","=","b.sku")
        ->where("g.outbound_planning_no",$outbound_planning_no)
        ->get();
        return $data;
    }

    private function get_Data_Quantity_Detail($outbound_planning_no)
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

    public function get_Data_Location_Details($outbound_planning_no)
    {

        $data = DB::query()
        ->select([
            "a.location_id",
            "a.sku",
            "b.part_name",
            "a.serial_no",
            "a.batch_no",
            "a.expired_date",
            "a.pick_qty",
            "a.stock_id",
            "a.gr_id",
        ])
        ->from("t_wh_picking_detail as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();
        return $data;

    }

    public function show(Request $request, $id)
    {
        $checking_data = $this->get_Checking($id);
        $transport_and_loading = $this->get_Data_Transport_Loading($id);
        $attachment = $this->get_Data_Attachment($id);
        $data_header = $this->get_Data_Header($id);
        $data_item_detail = $this->get_Data_Item_Detail($id);
        $data_quantity_detail = $this->get_Data_Quantity_Detail($id);
        $data_location_detail = $this->get_Data_Location_Details($id);
        
        $data = [];
        $data["checking_data"] = $checking_data;
        $data["transport_and_loading"] = $transport_and_loading;
        $data["attachment"] = $attachment;
        $data["data_header"] = $data_header;
        $data["data_item_detail"] = $data_item_detail;
        $data["data_quantity_detail"] = $data_quantity_detail;
        $data["data_location_detail"] = $data_location_detail;
// dd($data);
        return view('checking.show',compact('data'));
    }

    private function uploadFTP($file,$target_dir)
    {
        return Storage::disk('ftp')->put($target_dir,$file);
    }

    public function updateChecking(Request $request, $id)
    {
        $checking_data = $this->get_Checking($id);
        if(count($checking_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Outbound Planning No doesnt exists",
                "data" => [],
            ],200);
        }

        if($checking_data[0]->status_id != "UNC"){
            return response()->json([
                "err" => true,
                "message" => "Failed Update, Status is not UNC, Please Reload Page.",
                "data" => [],
            ],200);
        }

        $allowed_file_type = ["png","jpg","jpeg"];

        $checker = session("username");
        $carton_id = $request->input("carton_id");

        $file_1 = $request->file("file_1");
        $file_2 = $request->file("file_2");
        $file_3 = $request->file("file_3");
        $description_file_1 = $request->input("description_file_1");
        $description_file_2 = $request->input("description_file_2");
        $description_file_3 = $request->input("description_file_3");

        $data_error = [];

        if(empty($carton_id)){
            $data_error["carton_id"][] = "Carton Id Required";
        }

        if(!empty($file_1)){
            if(!in_array($file_1->extension(), $allowed_file_type)){
                $data_error['file_1'][] = "File type is not allowed, only PNG, JPG, JPEG.";
            }
        }

        if(!empty($file_2)){
            if(!in_array($file_2->extension(), $allowed_file_type)){
                $data_error['file_2'][] = "File type is not allowed, only PNG, JPG, JPEG.";
            }
        }

        if(!empty($file_3)){
            if(!in_array($file_3->extension(), $allowed_file_type)){
                $data_error['file_3'][] = "File type is not allowed, only PNG, JPG, JPEG.";
            }
        }

        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }

        DB::beginTransaction();
        try {
            $url = "http://10.0.29.49/";
            $path = "/wms_web_dev/checking";
            $arr_url_file = [];
            if(!empty($file_1)){
                $file_1_name = $this->uploadFTP($file_1,$path);
                $arr_url_file[] = [
                    "outbound_planning_no" => $checking_data[0]->outbound_id,
                    "img_url" => $url.$file_1_name,
                    "order_id" => 1,
                    "description" => (!empty($description_file_1)) ? $description_file_1 : "",
                    "user_created" => session('username'),
                    "datetime_created" => $this->datetime_now,
                ];
            }

            if(!empty($file_2)){
                $file_2_name = $this->uploadFTP($file_2,$path);
                $arr_url_file[] = [
                    "outbound_planning_no" => $checking_data[0]->outbound_id,
                    "img_url" => $url.$file_2_name,
                    "order_id" => 2,
                    "description" => (!empty($description_file_2)) ? $description_file_2 : "",
                    "user_created" => session('username'),
                    "datetime_created" => $this->datetime_now,
                ];
            }

            if(!empty($file_3)){
                $file_3_name = $this->uploadFTP($file_3,$path);
                $arr_url_file[] = [
                    "outbound_planning_no" => $checking_data[0]->outbound_id,
                    "img_url" => $url.$file_3_name,
                    "order_id" => 3,
                    "description" => (!empty($description_file_3)) ? $description_file_3 : "",
                    "user_created" => session('username'),
                    "datetime_created" => $this->datetime_now,
                ];
            }

            if(count($arr_url_file) > 0){
                DB::table("t_wh_checking_attachment")
                ->where("outbound_planning_no",$checking_data[0]->outbound_id)
                ->delete();

                DB::table("t_wh_checking_attachment")
                ->insert($arr_url_file);
            }

            $data_t_wh_checking = [
                "carton_id" => $carton_id,
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
            ];
            if($checking_data[0]->status_id == "UNC"){
                $data_t_wh_checking["checker"] = $checker;
            }
            DB::table("t_wh_checking")
            ->where("outbound_planning_no",$checking_data[0]->outbound_id)
            ->update($data_t_wh_checking);

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
            "message" => "Success Update Checking",
            "data" => [],
        ],200);
    }

    public function viewScanForm(Request $request, $id)
    {
        $checking_data = $this->get_Checking($id);
        if(count($checking_data) == 0){
            echo "<script>
            alert('Outbound Planning doesnt exist.');
            window.location.href = '".route('checking.index')."'
            </script>";
            return;
        }

        $data_header = $this->get_Data_Header($id);

        if($data_header[0]->checker != session("username")){
            echo "<script>
            alert('You haven\'t assigned for this activity.');
            window.location.href = '".route('checking.index')."'
            </script>";
            return;
        }

        $data = [];
        $data["checking_data"] = $checking_data;
        $data["data_header"] = $data_header;

        return view("checking.scan_form",compact("data"));
    }

    public function datatablesCheckedItems(Request $request, $id)
    {
        // SELECT
        // a.location_id,
        // a.sku,
        // b.part_name AS item_name,
        // c.batch_no,
        // c.serial_no,
        // c.expired_date,
        // a.scan_qty,
        // b.base_uom AS uom,
        // c.stock_id AS stock_type,
        // a.user_created AS picked_by,
        // a.datetime_created AS datetime_scan
        // FROM t_wh_scan_checking a 
        // LEFT JOIN m_wh_item b ON b.sku=a.sku
        // LEFT JOIN t_wh_picking_detail c ON c.sku=a.sku AND c.outbound_planning_no=a.outbound_id AND c.location_id=a.location_id
        // WHERE a.outbound_id='CBT-OUT-1222-0019' 

        $data = DB::query()
        ->select([
            "a.location_id",
            "a.sku",
            "b.part_name AS item_name",
            "c.batch_no",
            "c.serial_no",
            "c.expired_date",
            "a.scan_qty",
            "b.base_uom AS uom",
            "c.stock_id AS stock_type",
            "a.user_created AS checked_by",
            "a.datetime_created AS datetime_scan",
            "a.gr_id",
        ])
        ->from("t_wh_scan_checking as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->leftJoin("t_wh_picking_detail as c",function ($query)
        {
            $query->on("c.sku","=","a.sku" );
            $query->on("c.outbound_planning_no","=","a.outbound_id" );
            $query->on("c.location_id","=","a.location_id");
            $query->on("c.stock_id","=","a.stock_id");
            $query->on("c.gr_id","=","a.gr_id");
            
        })
        ->where("a.outbound_id",$id)
        ->get();

        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesOutstandingItems(Request $request, $id)
    {
        $data = DB::query()
        ->select([
            "a.location_id",
            "a.sku",
            "b.part_name AS item_name",
            "a.batch_no",
            "a.serial_no",
            "a.expired_date",
            "c.scan_qty AS check_qty",
            DB::raw("(a.pick_qty - IFNULL(c.scan_qty, 0)) AS outstanding_qty"),
            "b.base_uom AS uom",
            "a.stock_id AS stock_type",
            "a.gr_id",
        ])
        ->from("t_wh_picking_detail as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->leftJoin("t_wh_scan_checking as c",function ($query)
        {
            $query->on("c.sku","=","a.sku" );
            $query->on("c.outbound_id","=","a.outbound_planning_no" );
            $query->on("c.location_id","=","a.location_id");
            $query->on("c.stock_id","=","a.stock_id");
            $query->on("c.gr_id","=","a.gr_id");
            
        })
        ->where("a.outbound_planning_no",$id)
        ->whereRaw("(a.pick_qty - c.scan_qty) IS NULL")
        ->get();
        return DataTables::of($data)
        ->make(true);
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
        ->from("t_wh_scan_checking as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->leftJoin("t_wh_picking_detail as c",function ($query)
        {
            $query->on("c.sku","=","a.sku" );
            $query->on("c.outbound_planning_no","=","a.outbound_id" );
            $query->on("c.location_id","=","a.location_id");
            $query->on("c.stock_id","=","a.stock_id");
            $query->on("c.gr_id","=","a.gr_id");
        })
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

    public function getSKUAndLocation(Request $request,$id)
    {
        $scan_sku = $request->input("scan_sku");

        if(empty($scan_sku)){
            return response()->json([
                "err" => true,
                "message" => "SKU is Required",
                "data" => [],
            ],200);
        }

        $checking_for_scan = DB::query()
        ->select([
            "a.location_id as location",
            "a.sku",
            "b.part_name AS item_name",
            "a.batch_no",
            "a.serial_no",
            "a.expired_date",
            "c.scan_qty AS check_qty",
            DB::raw("a.pick_qty AS allocated_qty"),
            "b.base_uom AS uom",
            "a.stock_id AS stock_type",
            "a.gr_id",
        ])
        ->from("t_wh_picking_detail as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->leftJoin("t_wh_scan_checking as c",function ($query)
        {
            $query->on("c.sku","=","a.sku" );
            $query->on("c.outbound_id","=","a.outbound_planning_no" );
            $query->on("c.location_id","=","a.location_id");
            $query->on("c.stock_id","=","a.stock_id");
            $query->on("c.gr_id","=","a.gr_id");
            
        })
        ->where("a.outbound_planning_no",$id)
        ->get();
        $data_chosen_checking_for_scan = [];
        if(count($checking_for_scan) > 0){
            foreach ($checking_for_scan as $key_checking_for_scan => $value_checking_for_scan) {
                if($scan_sku == $value_checking_for_scan->sku ){
                    $data_chosen_checking_for_scan[] = $value_checking_for_scan;
                }
            }
        }

        return response()->json([
            "err" => false,
            "message" => "Success getSKUAndLocation",
            "data" => $data_chosen_checking_for_scan,
        ],200);
    }

    public function saveScanQty(Request $request, $id)
    {

        $checking_for_scan = DB::query()
        ->select([
            "a.location_id as location",
            "a.sku",
            "b.part_name AS item_name",
            "a.batch_no",
            "a.serial_no",
            "a.expired_date",
            "c.scan_qty AS check_qty",
            DB::raw("a.pick_qty AS allocated_qty"),
            "b.base_uom AS uom",
            "a.stock_id as stock_type",
            "a.gr_id",
        ])
        ->from("t_wh_picking_detail as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->leftJoin("t_wh_scan_checking as c",function ($query)
        {
            $query->on("c.sku","=","a.sku" );
            $query->on("c.outbound_id","=","a.outbound_planning_no" );
            $query->on("c.location_id","=","a.location_id");
            $query->on("c.stock_id","=","a.stock_id");
            $query->on("c.gr_id","=","a.gr_id");
            
        })
        ->where("a.outbound_planning_no",$id)
        ->get();

        $arr_exist_check_data_with_value_check_qty = [];
        if(count($checking_for_scan) > 0){
            foreach ($checking_for_scan as $key_checking_for_scan => $value_checking_for_scan) {
                $saved_key = $value_checking_for_scan->location."|".$value_checking_for_scan->sku."|".$value_checking_for_scan->gr_id."|".$value_checking_for_scan->stock_type."|".$value_checking_for_scan->batch_no;
                $arr_exist_check_data_with_value_check_qty[$saved_key] =  $value_checking_for_scan->allocated_qty;
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
            $temp_check_qty = @$value_target_data["check_qty"];
            $temp_sku = @$value_target_data["sku"];
            $temp_stock_type = @$value_target_data["stock_type"];
            $temp_batch_no = @$value_target_data["batch_no"];
            $search_key = $temp_location."|".$temp_sku."|".$temp_gr_id."|".$temp_stock_type."|".$temp_batch_no;
            if(!array_key_exists($search_key,$arr_exist_check_data_with_value_check_qty)){
                return response()->json([
                    "err" => true,
                    "message" => "Data is not exists with \nSKU: ".$temp_sku." \nGR ID: ".$temp_gr_id." \nStock Type: ".$temp_stock_type." \nBatch No: ".$temp_batch_no."\nLocation : ".$temp_location."\n please close modal and re-open.",
                    "data" => [],
                ],200);
            }
           

            $sum_qty = 0;
            $get_sum_qty = DB::query()
            ->select(DB::raw("SUM(a.scan_qty) AS qty"))
            ->from("t_wh_scan_checking as a")
            ->where("a.outbound_id",$id)
            ->where("a.sku",$temp_sku)
            ->where("a.location_id",$temp_location)
            ->where("a.gr_id",$temp_gr_id)
            ->where("a.batch_no",$temp_batch_no)
            ->where("a.stock_id",$temp_stock_type)
            ->get();

            if(count($get_sum_qty) > 0){
                $sum_qty .= $get_sum_qty[0]->qty;
            }

            $total_qty = $temp_check_qty + $sum_qty;
            $max_check_qty = $arr_exist_check_data_with_value_check_qty[$search_key];

            if($total_qty > $max_check_qty ){
                return response()->json([
                    "err" => true,
                    "message" => "Outstanding Qty cannot more than Check Qty!, Data with \nSKU: ".$temp_sku." \nGR ID: ".$temp_gr_id." \nStock Type: ".$temp_stock_type." \nBatch No: ".$temp_batch_no."\nLocation : ".$temp_location."\n please close modal and re-open.",
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
                $temp_check_qty = @$value_target_data["check_qty"];
                $temp_sku = @$value_target_data["sku"];
                $temp_stock_type = @$value_target_data["stock_type"];
                $temp_batch_no = @$value_target_data["batch_no"];
                DB::table("t_wh_scan_checking")
                ->insert([
                    "outbound_id" => $id,
                    "sku" => $temp_sku,
                    "location_id" => $temp_location,
                    "gr_id" => $temp_gr_id,
                    "stock_id" => $temp_stock_type,
                    "batch_no" => $temp_batch_no,
                    "scan_qty" => $temp_check_qty,
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

    public function confirmChecking(Request $request, $id)
    {
        $bucket_id = $request->input("bucket_id");
        $carton_id = $request->input("carton_id");

        if(empty($carton_id)){
            return response()->json([
                "err" => true,
                "message" => "Carton ID is required",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {
            DB::table("t_wh_checking")
            ->where("outbound_planning_no", $id)
            ->update([
                "status_id" => "CHE",
                "carton_id" => $carton_id,
            ]);

            DB::table("t_wh_packing")
            ->insert([
                "outbound_planning_no" => $id,
                "bucket_id" => $bucket_id,
                "carton_id" => $carton_id,
                "status_id" => "UNP",
                "user_created" => session('username'),
                "datetime_created" => $this->datetime_now,
            ]);
            
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
            "message" => "Success Confirm Checking",
            "data" => [],
        ],200);

    }

    public function printShippingLabel(Request $request, $id)
    {
        $checking_data = $this->get_Checking($id);
        if(count($checking_data) == 0){
            echo "<script>
            alert('Outbound Planning doesnt exist.');
            window.location.href = '".route('checking.index')."'
            </script>";
            return;
        }

        // SELECT 
        // b.plan_delivery, 
        // b.reference_no,
        // a.outbound_planning_no, 
        // a.carton_id, 
        // c.supplier_name,
        // d.wh_name,
        // d.address1 AS alamat,
        // d.city,
        // e.consignee_name,
        // e.consignee_address,
        // e.consignee_city,
        // e.phone_no,
        // f.transporter_name,
        // e.remark
        // FROM t_wh_checking a
        // LEFT JOIN t_wh_outbound_planning b  ON a.outbound_planning_no=b.outbound_planning_no
        // LEFT JOIN m_wh_supplier c  ON b.supplier_id=c.supplier_id
        // LEFT JOIN m_warehouse d ON d.wh_id=b.wh_id
        // LEFT JOIN t_wh_checking_transport_loading e ON e.outbound_planning_no=a.outbound_planning_no
        // LEFT JOIN m_wh_transporter f ON f.transporter_id=e.transporter_id
        // WHERE a.outbound_planning_no='CBT-OUT-1222-0019' /*OutboundID*/
        
        $data = [];
        $data["current_data"] = DB::query()
        ->select([
            "a.outbound_planning_no as outbound_id",
            "b.plan_delivery",
            "b.reference_no",
            "a.outbound_planning_no",
            "a.carton_id",
            "c.supplier_name",
            "d.wh_name",
            "d.address1 AS alamat",
            "d.city",
            "e.consignee_name",
            "e.consignee_address",
            "e.consignee_city",
            "e.phone_no",
            "f.transporter_name",
            "e.remark",
        ])
        ->from("t_wh_checking as a")
        ->leftJoin("t_wh_outbound_planning as b","a.outbound_planning_no","=","b.outbound_planning_no")
        ->leftJoin("m_wh_supplier as c","b.supplier_id","=","c.supplier_id")
        ->leftJoin("m_warehouse as d","d.wh_id","=","b.wh_id")
        ->leftJoin("t_wh_checking_transport_loading as e","e.outbound_planning_no","=","a.outbound_planning_no")
        ->leftJoin("m_wh_transporter as f","f.transporter_id","=","e.transporter_id")
        ->where("a.outbound_planning_no",$id)
        ->get();
        // dd($data);
        $pdf = Pdf::loadView('checking.pdf_shipping_label', compact('data'));
        return $pdf->stream($data["current_data"][0]->outbound_id.".pdf");
    }
}
