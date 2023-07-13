<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class InboundPlanningController extends Controller
{
    private $menu_id = 11;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'datatables',
            'show',
            'viewPDF',
            'viewPDFTallySheet',
            'datatablesOrderType',
            'datatablesInboundStatus',
        ]);
        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
            'create',
            'datatablesSupplier',
            'datatablesSKU',
            'datatablesUOM',
            'datatablesClassification',
            'storeInboundPlanning',
            'showFormUploadExcel',
            'templateExcel',
            'processUploadToForm',
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            'edit',
            'update',
            'confirmToUnreceive',
            'datatablesTargetUserAssign',
            'processAssignChecker',
            'inboundCheckingAndReceive',
            'datatablesScanVehicle',
            'processSavePartialVehicle',
            'processUpdateVehicleFinish',
            'processScan',
            'datatablesCheckedItems',
            'datatablesOutstandingItems',
            'processRemoveScan',
            'confirmInboundPlanning',
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([
            'cancel',
            'processCancel',
        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("inbound-planning.index",compact("data"));
    }

    private function getInboundPlanningDatatables(
        $id = false,
        $inbound_planning_no = false,
        $reference_no = false,
        $plan_delivery_date = false,
        $order_id = false,
        $status_id= false
        )
    {
        $data = DB::query()
        ->select([
            "a.inbound_planning_no",
            "d.client_name",
            "b.client_project_name",
            "c.wh_name",
            "a.reference_no",
            "a.plan_delivery",
            "e.order_type",
            "f.status_name",
            "f.status_id",
            "a.task_type",
        ])
        ->from("t_wh_inbound_planning as a")
        ->leftJoin("m_wh_client_project as b","b.client_project_id","=","a.client_project_id")
        ->leftJoin("m_warehouse as c",function ($query)
        {
            $query->on("c.wh_id","=","b.wh_id");
            $query->on("c.wh_id","=","a.wh_id");
        })
        ->leftJoin("m_wh_client as d","d.client_id","=","b.client_id")
        ->leftJoin("m_wh_order_type as e","e.order_id","=","a.order_id")
        ->leftJoin("m_status as f","f.status_id","=","a.status_id")
        ->where("c.wh_id",session('current_warehouse_id'))
        ->where("d.client_id",session('current_client_id'))
        ->where("b.client_project_id",session('current_client_project_id'))
        ->where("f.process_id", 12)
        ->where(function ($query) use($inbound_planning_no)
        {
            if(!empty($inbound_planning_no)){
                $query->where("a.inbound_planning_no",$inbound_planning_no);
            }
        })
        ->where(function ($query) use($reference_no)
        {
            if(!empty($reference_no)){
                $query->where("a.reference_no",$reference_no);
            }
        })
        ->where(function ($query) use($plan_delivery_date)
        {
            if(!empty($plan_delivery_date)){
                $query->where("a.plan_delivery",$plan_delivery_date);
            }
        })
        ->where(function ($query) use($order_id)
        {
            if(!empty($order_id)){
                $query->where("a.order_id",$order_id);
            }
        })
        ->where(function ($query) use($status_id)
        {
            if(!empty($status_id)){
                $query->where("a.status_id",$status_id);
            }
        })
        ->orderBy("a.datetime_created","DESC")
        ->get();
        return $data;
    }

    public function datatables(Request $request)
    {
        $inbound_planning_no = $request->input("inbound_planning_no");
        $reference_no = $request->input("reference_no");
        $plan_delivery_date = $request->input("plan_delivery_date");
        $order_id = $request->input("order_id");
        $order_type = $request->input("order_type");
        $status_id = $request->input("status_id");
        $status_name = $request->input("status_name");

        $data = $this->getInboundPlanningDatatables(false,$inbound_planning_no,$reference_no,$plan_delivery_date,$order_id,$status_id);
        
        return DataTables::of($data)
        ->addColumn('action', function ($inbound) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('inbound_planning.show',[ 'id'=> $inbound->inbound_planning_no ])."' class='text-decoration-none'>
            <button class='btn btn-primary text-xs py-1 mb-0'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function getInboundStatus($status_id = false)
    {
        $data = DB::query()
        ->select([
            "a.status_id",
            "a.status_name",
            "a.process_id",
        ])
        ->from("m_status as a")
        ->leftJoin("m_process as b","b.process_id","=","a.process_id")
        ->where("b.process_id",12)
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

    public function datatablesInboundStatus()
    {
        $data = $this->getInboundStatus();
        
        return DataTables::of($data)
        ->make(true);
    }
    public function create()
    {
        $data = [];

        return view("inbound-planning.create",compact("data"));
    }

    private function getSupplier($supplier_id = false)
    {
        $data = DB::query()
        ->select([
            "a.supplier_id",
            "a.supplier_name",
            "a.address1",
        ])
        ->from("m_wh_supplier as a")
        ->leftJoin("m_wh_client_project as b","b.client_id","=","a.client_id")
        ->leftJoin("m_wh_client as c","c.client_id","=","b.client_id")
        ->where("b.wh_id",session('current_warehouse_id'))
        ->where("c.client_id",session('current_client_id'))
        ->where("b.client_project_id",session('current_client_project_id'))
        ->where(function ($query) use($supplier_id)
        {
            if($supplier_id !== false){
                $query->where("a.supplier_id",$supplier_id);
            }
        })
        ->get();

        return $data;
    }

    public function datatablesSupplier(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getSupplier();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
        ->make(true);
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

    private function getSKU($sku = false)
    {
        $data = DB::query()
        ->select([
            "a.sku",
            "a.part_name",
        ])
        ->from("m_wh_item as a")
        ->leftJoin("m_wh_client_project as b",function ($query)
        {
            $query->on("b.client_id","=","a.client_id");
            $query->on("b.wh_id","=","a.wh_id");
            
        })
        ->where("b.wh_id",session('current_warehouse_id'))
        ->where("b.client_id",session('current_client_id'))
        ->where("b.client_project_id",session('current_client_project_id'))
        ->where(function ($query) use($sku)
        {
            if($sku !== false){
                $query->where("a.sku",$sku);
            }
        })
        ->get();
        return $data;
    }

    public function datatablesSKU(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getSKU();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
        ->make(true);
    }

    private function getUOM($uom_name = false)
    {
        $data = DB::query()
        ->select([
            "a.uom_name",
        ])
        ->from("m_item_uom as a")
        ->where("a.is_active","Y")
        ->where(function ($query) use($uom_name)
        {
            if($uom_name !== false){
                $query->where("a.uom_name",$uom_name);
            }
        })
        ->get();
        return $data;
    }

    public function datatablesUOM(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getUOM();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
        ->make(true);
    }

    private function getClassification($item_classification_id = false)
    {
        $data = DB::query()
        ->select([
            "a.item_classification_id",
            "a.classification_name",
        ])
        ->from("m_item_classification as a")
        ->leftJoin("m_process as b","b.process_id","=","a.process_id")
        ->where("b.process_id",12)
        ->where("b.is_active","Y")
        ->where(function ($query) use($item_classification_id)
        {
            if($item_classification_id !== false){
                $query->where("a.item_classification_id",$item_classification_id);
            }
        })
        ->get();
        return $data;
    }

    public function datatablesClassification(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getClassification();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
        ->make(true);
    }

    private function getLastRunningNumber($process_code)
    {
        $running_number = 0;

        $data = DB::query()
        ->select([
            "a.running_number",
        ])
        ->from("t_running_number as a")
        ->where("a.process_code",$process_code)
        ->where("a.date",date("Y-m" ,strtotime($this->datetime_now)))
        ->where("a.wh_id",session("current_warehouse_id"))
        ->get();

        if(count($data) == 0){
            $insert_running_number = DB::table("t_running_number")
            ->insert([
                "process_code" => $process_code,
                "date" => date("Y-m" ,strtotime($this->datetime_now)),
                "wh_id" => session("current_warehouse_id"),
                "running_number" => 0,
            ]);
            return $running_number;
        }

        $running_number = $data[0]->running_number;

        return $running_number;
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

    private function updateRunningNumber($last_running_number)
    {
        $data = DB::table("t_running_number as a")
        ->where("a.process_code","IN")
        ->where("a.date",date("Y-m" ,strtotime($this->datetime_now)))
        ->where("a.wh_id",session("current_warehouse_id"))
        ->update([
            "running_number" => $last_running_number,
        ]);
    }

    private function mustFourDigits($data)
    {
        while (strlen($data) < 4) {
            $data = "0".$data;
        }
        return $data;
    }

    private function uploadFTP($file,$target_dir)
    {
        return Storage::disk('ftp')->put($target_dir,$file);
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

    public function storeInboundPlanning(Request $request)
    {
        $allowed_file_type = ["png","jpg","jpeg"];
        $session_client_project_id = session("current_client_project_id");
        $session_client_id = session("current_client_id");
        $session_warehouse_id = session("current_warehouse_id");

        $supplier_id = $request->input("supplier_id");
        $supplier_name = $request->input("supplier_name");
        $reference_no = $request->input("reference_no");
        $receipt_no = $request->input("receipt_no");
        $order_id = $request->input("order_id");
        $order_type = $request->input("order_type");
        $plan_delivery_date = $request->input("plan_delivery_date");
        $client_id = $request->input("client_id");
        $warehouse_id = $request->input('warehouse_id');
        $remarks = $request->input('remarks');
        $task_type = $request->input('task_type');

        $arr_sku_no = json_decode($request->input("arr_sku_no"),true);
        $arr_item_name = json_decode($request->input("arr_item_name"),true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"),true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"),true);
        $arr_imei_no = json_decode($request->input("arr_imei_no"),true);
        $arr_part_no = json_decode($request->input("arr_part_no"),true);
        $arr_color = json_decode($request->input("arr_color"),true);
        $arr_size = json_decode($request->input("arr_size"),true);
        $arr_expired_date = json_decode($request->input("arr_expired_date"),true);
        $arr_uom = json_decode($request->input("arr_uom"),true);
        $arr_qty_plan = json_decode($request->input("arr_qty_plan"),true);
        $arr_id_classification = json_decode($request->input("arr_id_classification"),true);
        $arr_classification = json_decode($request->input("arr_classification"),true);

        $file_1 = $request->file("file_1");
        $file_2 = $request->file("file_2");
        $file_3 = $request->file("file_3");

        $data_error = [];

        if(empty($supplier_id)){
            $data_error['supplier_name'][] = "Supplier ID is required";
            $data_error['supplier_name'][] = "Supplier Name is required";
        }else{
            $check_Supplier_id = $this->getSupplier($supplier_id);
            if(count($check_Supplier_id) == 0){
                $data_error['supplier_name'][] = "Supplier ID is not exist in database";
                $data_error['supplier_name'][] = "Supplier Name is not exist in database";
            }
        }

        if(empty($reference_no)){
            $data_error['reference_no'][] = "Reference No is required";
        }

        if(empty($receipt_no)){
            $data_error['receipt_no'][] = "Receipt No is required";
        }

        if(empty($order_id)){
            $data_error['order_type'][] = "Order ID is required";
        }else{
            $check_Order_id = $this->getOrderType($order_id);
            if(count($check_Order_id) == 0){
                $data_error['order_type'][] = "Order ID is not exist in database";
            }
        }

        if(empty($order_type)){
            $data_error['order_type'][] = "Order Type is required";
        }

        if(empty($plan_delivery_date)){
            $data_error['plan_delivery_date'][] = "Plan Delivery Date is required";
        }else if(!empty($plan_delivery_date) && strtotime(date("Y-m-d",strtotime($plan_delivery_date))) < strtotime(date("Y-m-d",strtotime($this->datetime_now)))){
            $data_error['plan_delivery_date'][] = "Plan Delivery Date can not back date";
        }

        if(empty($client_id)){
            $data_error['client_name'][] = "Client is required";
        }

        if($session_client_id != $client_id){
            $data_error['client_name'][] = "Client is not same with login, please reload the page.";
        }

        if(empty($warehouse_id)){
            $data_error['warehouse_name'][] = "Warehouse is required";
        }

        if($session_warehouse_id != $warehouse_id){
            $data_error['warehouse_name'][] = "Warehouse is not same with login, please reload the page.";
        }

        if(empty($task_type)){
            $data_error['task_type_single_receive'][] = "Task Type is required";
            $data_error['task_type_partial_receive'][] = "Task Type is required";
        }else if(!in_array($task_type, ["Single Receive","Partial Receive",])){
            $data_error['task_type_single_receive'][] = "Task Type is required";
            $data_error['task_type_partial_receive'][] = "Task Type is required";
        }
        
        if(
            count($arr_sku_no) == 0 ||
            count($arr_item_name) == 0 ||
            count($arr_batch_no) == 0 ||
            count($arr_serial_no) == 0 ||
            count($arr_imei_no) == 0 ||
            count($arr_part_no) == 0 ||
            count($arr_color) == 0 ||
            count($arr_size) == 0 ||
            count($arr_expired_date) == 0 ||
            count($arr_uom) == 0 ||
            count($arr_qty_plan) == 0 ||
            count($arr_id_classification) == 0 ||
            count($arr_classification) == 0
        ){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details is required",
                "data" => $data_error,
            ],200);
        }

        $exist_sku = [];
        foreach ($arr_sku_no as $key_sku_no => $sku_no) {
            $id_sku_no = isset($sku_no['id']) ? $sku_no['id'] : null ;
            $value = isset($sku_no['value']) ? $sku_no['value'] : null ;
            if(empty($value)){
                $data_error[$id_sku_no][] = "Sku No is required";
            }else if(!empty($value)){
                $check_SKU = $this->getSKU($value);
                if(count($check_SKU) == 0){
                    $data_error[$id_sku_no][] = "Sku No is not exist in database";
                }else if(array_key_exists($value,$exist_sku)){
                    $data_error[$id_sku_no][] = "Sku No is already used in other row";
                    $data_error[$exist_sku[$value]][] = "Sku No is already used";
                }
                $exist_sku[$value] = $id_sku_no;
            }
            
        }

        foreach ($arr_item_name as $key_item_name => $value_item_name) {
            $id_item_name = isset($value_item_name['id']) ? $value_item_name['id'] : null ;
            $value = isset($value_item_name['value']) ? $value_item_name['value'] : null ;
            if(empty($value)){
                $data_error[$id_item_name][] = "Item Name is required";
            }
        }

        foreach ($arr_uom as $key_uom => $value_uom) {
            $id_uom = isset($value_uom['id']) ? $value_uom['id'] : null ;
            $value = isset($value_uom['value']) ? $value_uom['value'] : null ;
            if(empty($value)){
                $data_error[$id_uom][] = "UOM is required";
            }
        }
        
        foreach ($arr_qty_plan as $key_qty_plan => $value_qty_plan) {
            $id_qty_plan = isset($value_qty_plan['id']) ? $value_qty_plan['id'] : null ;
            $value = isset($value_qty_plan['value']) ? $value_qty_plan['value'] : null ;
            if(empty($value)){
                $data_error[$id_qty_plan][] = "Plan Qty is required";
            }
        }
        
        foreach ($arr_id_classification as $key_id_classification => $value_id_classification) {
            $id_id_classification = isset($value_id_classification['id']) ? $value_id_classification['id'] : null ;
            $value = isset($value_id_classification['value']) ? $value_id_classification['value'] : null ;
            if(empty($value)){
                $data_error[$id_id_classification][] = "Classification ID is required";
            }else{
                $check_Classification_ID = $this->getClassification($value);
                if(count($check_Classification_ID) == 0){
                    $data_error[$id_id_classification][] = "Classification ID is not exist in database";
                }
            }
        }

        foreach ($arr_classification as $key_classification => $value_classification) {
            $id_classification = isset($value_classification['id']) ? $value_classification['id'] : null ;
            $value = isset($value_classification['value']) ? $value_classification['value'] : null ;
            if(empty($value)){
                $data_error[$id_classification][] = "Classification is required";
            }
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

        $validated = [
            "supplier_id" => $supplier_id,
            "reference_no" => $reference_no,
            "receipt_no" => $receipt_no,
            "order_id" => $order_id,
            "order_type" => $order_type,
            "plan_delivery_date" => $plan_delivery_date,
            "client_id" => $client_id,
            "warehouse_id" => $warehouse_id,
            "remarks" => $remarks,
            "arr_sku_no" => $arr_sku_no,
            "arr_item_name" => $arr_item_name,
            "arr_batch_no" => $arr_batch_no,
            "arr_serial_no" => $arr_serial_no,
            "arr_imei_no" => $arr_imei_no,
            "arr_part_no" => $arr_part_no,
            "arr_color" => $arr_color,
            "arr_size" => $arr_size,
            "arr_expired_date" => $arr_expired_date,
            "arr_uom" => $arr_uom,
            "arr_qty_plan" => $arr_qty_plan,
            "arr_id_classification" => $arr_id_classification,
            "arr_classification" => $arr_classification,
            "task_type" => $task_type,
        ];

        DB::beginTransaction();
        try {
            $url = "https://static.rpx.co.id/";
            $path = "/wms_web_dev/inbound";

            $url_file_1= "";
            if(!empty($file_1)){
                $file_1_name = $this->uploadFTP($file_1,$path);
                $url_file_1 = $url.$file_1_name;
            }

            $url_file_2= "";
            if(!empty($file_2)){
                $file_2_name = $this->uploadFTP($file_2,$path);
                $url_file_2 = $url.$file_2_name;
            }

            $url_file_3= "";
            if(!empty($file_3)){
                $file_3_name = $this->uploadFTP($file_3,$path);
                $url_file_3 = $url.$file_3_name;
            }

            $process_code = "IN";
            $status_id = $this->getStatusID($process_code,"OPI");
            if(!$status_id){
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Status ID is not defined",
                    "data" => [],
                ],200);
            }

            $wh_prefix = $this->getWHPrefix();
            $date_format_inbound_planning = date("my",strtotime($this->datetime_now));
            $current_running_number = $this->getLastRunningNumber($process_code ) + 1;
            $running_number = $this->mustFourDigits($current_running_number);
            $inbound_planning_no = $wh_prefix."-".$process_code."-".$date_format_inbound_planning."-".$running_number;
            if($current_running_number > 9999){
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Running Number is more than 9999, cant create more.",
                    "data" => [],
                ],200);
            }
            $this->updateRunningNumber($current_running_number);

            DB::table("t_wh_inbound_planning")
            ->insertGetId([
                "inbound_planning_no" => $inbound_planning_no,
                "wh_id" => $session_warehouse_id,
                "client_project_id" => $session_client_project_id,
                "supplier_id" => $validated["supplier_id"],
                "status_id" => $status_id,
                "reference_no" => $validated["reference_no"],
                "receipt_no" => $validated["receipt_no"],
                "plan_delivery" => $validated["plan_delivery_date"],
                "order_id" => $validated["order_id"],
                "remarks" => $validated["remarks"],
                "task_type" => $validated["task_type"],
                "data_upload1" => $url_file_1,
                "data_upload2" => $url_file_2,
                "data_upload3" => $url_file_3,
                "user_created" => session("username"),
                "datetime_created" => $this->datetime_now,
            ]);

            $max_row_detail = count($validated["arr_sku_no"]);
            for ($i=0; $i < $max_row_detail; $i++) { 
                $data_insert_t_wh_inbound_planning_detail = [
                    "inbound_planning_no" => $inbound_planning_no,
                    "SKU" => $validated["arr_sku_no"][$i]["value"],
                    "item_name" => $validated["arr_item_name"][$i]["value"],
                    "batch_no" => $validated["arr_batch_no"][$i]["value"],
                    "serial_no" => $validated["arr_serial_no"][$i]["value"],
                    "imei" => $validated["arr_imei_no"][$i]["value"],
                    "part_no" => $validated["arr_part_no"][$i]["value"],
                    "color" => $validated["arr_color"][$i]["value"],
                    "size" => $validated["arr_size"][$i]["value"],
                    "qty" => $validated["arr_qty_plan"][$i]["value"],
                    "uom_name" => $validated["arr_uom"][$i]["value"],
                    "clasification_id" => $validated["arr_id_classification"][$i]["value"],
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];

                if(!empty($validated["arr_expired_date"][$i]["value"])){
                    $data_insert_t_wh_inbound_planning_detail["expired_date"] = $validated["arr_expired_date"][$i]["value"];
                }

                DB::table("t_wh_inbound_planning_detail")
                ->insert($data_insert_t_wh_inbound_planning_detail);
            }

            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('Exception error',array('context' => $error));
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
            "message" => "Success Add Inbound Planning.",
            "data" => [],
        ],200);
    }

    public function showFormUploadExcel()
    {
        $data = [];
        return view("inbound-planning.upload-excel",compact("data"));
    }

    public function templateExcel()
    {
        return response()->download(public_path('template_excel/Template_Inbound_Planning.xlsx'));
    }

    public function processUploadToForm(Request $request)
    {
        $upload_file = $request->file('upload_file');

        if(empty($upload_file)){
            return response()->json([
                "err" => true,
                "message" => "Upload File is Required",
                "data" => [],
            ],200);
        }

        $extension_upload_file = $upload_file->getClientOriginalExtension();

        if($extension_upload_file != 'xlsx'){
            return response()->json([
                "err" => true,
                "message" => "File extension must be xlsx",
                "data" => [],
            ],200);
        }

        $spreadsheet = IOFactory::load($upload_file);

        $sheet = $spreadsheet->getSheet(0);

        $supplier_id = $sheet->getCell("B6")->getValue();
        $supplier_address = "";
        $getSupplier = $this->getSupplier($supplier_id);
        if(count($getSupplier) > 0){
            $supplier_address = @$getSupplier[0]->address1;
        }

        $order_id = $sheet->getCell("B4")->getValue();
        $order_type = "";
        $getOrderType = $this->getOrderType($order_id);
        if(count($getOrderType) > 0){
            $order_type = @$getOrderType[0]->order_type;
        }

        $temp_plan_delivery_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($sheet->getCell("B5")->getValue());
        $plan_delivery_date = (!empty($temp_plan_delivery_date)) ? date("Y-m-d", $temp_plan_delivery_date) : "";

        $reference_no = $sheet->getCell("B2")->getValue();
        $receipt_no = $sheet->getCell("B3")->getValue();
        $client_id = session("current_client_id");
        $warehouse_id = session("current_warehouse_id");

        $inbound_planning_header =  [
            "supplier_id" => $supplier_id,
            "supplier_address" => $supplier_address,
            "order_id" => $order_id,
            "order_type" => $order_type,
            "plan_delivery_date" => $plan_delivery_date,
            "reference_no" => $reference_no,
            "receipt_no" => $receipt_no,
            "client_id" => $client_id,
            "warehouse_id" => $warehouse_id,
        ];

        $inbound_planning_detail = [];
        $max_row = $sheet->getHighestRow();

        for ($i=10; $i <= $max_row; $i++) { 
            $sku_no = $sheet->getCell("A".$i)->getValue();
            $item_name = "";
            $get_SKU = $this->getSKU($sku_no);
            if(count($get_SKU) > 0){
                $item_name = @$get_SKU[0]->part_name;
            }

            $id_uom = $sheet->getCell("J".$i)->getValue();
            $uom = "";
            $getUOM = $this->getUOM($id_uom);
            if(count($getUOM) > 0){
                $uom = @$getUOM[0]->uom_name;
            }

            $id_classification = $sheet->getCell("K".$i)->getValue();
            $classification = "";
            $getClassification = $this->getClassification($id_classification);
            if(count($getClassification) > 0){
                $classification = @$getClassification[0]->classification_name;
            }

            $temp_expired_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($sheet->getCell("H".$i)->getValue());
            $expired_date = (!empty($temp_expired_date)) ? date("Y-m-d", $temp_expired_date) : "";

            $batch_no = $sheet->getCell("B".$i)->getValue();
            $serial_no = $sheet->getCell("C".$i)->getValue();
            $imei_no = $sheet->getCell("D".$i)->getValue();
            $part_no = $sheet->getCell("E".$i)->getValue();
            $color = $sheet->getCell("F".$i)->getValue();
            $size = $sheet->getCell("G".$i)->getValue();
            $qty_plan = $sheet->getCell("I".$i)->getValue();
            
            
            $temp = [
                "sku_no" => $sku_no,
                "item_name" => $item_name,
                "batch_no" => $batch_no,
                "serial_no" => $serial_no,
                "imei_no" => $imei_no,
                "part_no" => $part_no,
                "color" => $color,
                "size" => $size,
                "expired_date" => $expired_date,
                "qty_plan" => $qty_plan,
                "uom" => $uom,
                "id_classification" => $id_classification,
                "classification" => $classification,
            ];
            
            $inbound_planning_detail[] = $temp;
            
        }

        return response()->json([
            "err" => false,
            "message" => "Success Read Excel, Please check data, \nIf correct please click button Create. \nIf incorrect please refresh page and re-upload",
            "data" => [
                "inbound_planning_header" => $inbound_planning_header,
                "inbound_planning_detail" => $inbound_planning_detail,
            ],
        ],200);
    }

    private function getInboundPlanning($inbound_planning_no = false)
    {
        $data = DB::query()
        ->select([
            "a.inbound_planning_no",
            "a.wh_id",
            "a.client_project_id",
            "a.supplier_id",
            "a.status_id",
            "a.reference_no",
            "a.receipt_no",
            "a.plan_delivery",
            "a.order_id",
            "a.remarks",
            "a.data_upload1",
            "a.data_upload2",
            "a.data_upload3",
            "a.user_created",
            "a.datetime_created",
            "e.order_type",
            "g.address1",
            "g.supplier_name",
            "a.task_type",
        ])
        ->from("t_wh_inbound_planning as a")
        ->leftJoin("m_wh_client_project as b","b.client_project_id","=","a.client_project_id")
        ->leftJoin("m_warehouse as c",function ($query)
        {
            $query->on("c.wh_id","=","b.wh_id");
            $query->on("c.wh_id","=","a.wh_id");
        })
        ->leftJoin("m_wh_client as d","d.client_id","=","b.client_id")
        ->leftJoin("m_wh_order_type as e","e.order_id","=","a.order_id")
        ->leftJoin("m_status as f","f.status_id","=","a.status_id")
        ->leftJoin("m_wh_supplier as g",function ($query)
        {
            $query->on("g.supplier_id","=","a.supplier_id");
            $query->on("g.client_id","=","b.client_id");
        })
        ->where("c.wh_id",session('current_warehouse_id'))
        ->where("d.client_id",session('current_client_id'))
        ->where("b.client_project_id",session('current_client_project_id'))
        ->where("f.process_id", 12)
        ->where(function ($query) use($inbound_planning_no)
        {
            if($inbound_planning_no !== false){
                $query->where("a.inbound_planning_no",$inbound_planning_no);
            }
        })
        ->orderBy("a.datetime_created","DESC")
        ->get();
        return $data;
    }

    private function getInboundPlanningDetail($inbound_planning_no = false)
    {
        $data = DB::query()
        ->select([
            "a.inbound_planning_no",
            "a.SKU",
            "a.item_name",
            "a.batch_no",
            "a.serial_no",
            "a.imei",
            "a.part_no",
            "a.color",
            "a.size",
            "a.expired_date",
            "a.qty",
            "a.uom_name",
            "a.stock_id",
            "a.clasification_id",
            "h.part_name",
            "j.classification_name",
            "k.stock_type",
        ])
        ->from("t_wh_inbound_planning_detail as a")
        ->leftJoin("t_wh_inbound_planning as g","g.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("m_wh_client_project as b","b.client_project_id","=","g.client_project_id")
        ->leftJoin("m_warehouse as c",function ($query)
        {
            $query->on("c.wh_id","=","b.wh_id");
            $query->on("c.wh_id","=","g.wh_id");
        })
        ->leftJoin("m_wh_client as d","d.client_id","=","b.client_id")
        ->leftJoin("m_wh_order_type as e","e.order_id","=","g.order_id")
        ->leftJoin("m_status as f","f.status_id","=","g.status_id")
        ->leftJoin("m_wh_item as h","h.sku","=","a.SKU")
        ->leftJoin("m_item_classification as j",function ($query)
        {
            $query->on("j.item_classification_id","=","a.clasification_id");
            $query->on("j.item_classification_id","=","f.process_id");
        })
        ->leftJoin("m_wh_stock_type as k","k.stock_id","=","a.stock_id")
        ->where("c.wh_id",session('current_warehouse_id'))
        ->where("d.client_id",session('current_client_id'))
        ->where("b.client_project_id",session('current_client_project_id'))
        ->where(function ($query) use($inbound_planning_no)
        {
            if($inbound_planning_no !== false){
                $query->where("a.inbound_planning_no",$inbound_planning_no);
            }
        })
        ->orderBy("a.datetime_created","DESC")
        ->get();
        return $data;
    }

    private function getWHActivity($inbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.activity_id",
            "a.checker",
            DB::raw("CAST(a.datetime_est_start AS DATE) AS start_date"),
            DB::raw("CAST(a.datetime_est_start AS TIME) AS start_time"),
            DB::raw("CAST(a.datetime_est_finish AS DATE) AS finish_date"),
            DB::raw("CAST(a.datetime_est_finish AS TIME) AS finish_time"),
        ])
        ->from("t_wh_activity as a")
        ->leftJoin("t_wh_inbound_planning as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->where("a.inbound_planning_no", $inbound_planning_no)
        ->orderBy("a.datetime_created","DESC")
        ->get();
        return $data;
    }

    private function getWHTransportationWHScanQty($inbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.checker",
            "a.supervisor_id",
            "b.arrival_date",
            "b.start_unloading",
            "b.finish_unloading",
            "b.departure_date",
            "b.vehicle_no",
            "b.driver_name",
            "c.vehicle_type",
            "b.container_no",
            "b.seal_no",
        ])
        ->from("t_wh_activity as a")
        ->leftJoin("t_wh_transportation as b","a.activity_id","=","b.activity_id")
        ->leftJoin("m_wh_vehicle as c","b.vehicle_id","=","c.vehicle_id")
        ->where("a.inbound_planning_no",$inbound_planning_no)
        ->get();

        return $data;
    }

    public function show(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            echo "<script>
            alert('Inbound Planning doesnt exist');
            window.location.href = '".route('inbound_planning.index')."'
            </script>";
            return;
        }
        
        $current_data = $check_Inbound_Planning[0];
        // $current_data_detail = $this->getInboundPlanningDetail($id);
        $current_data_detail = DB::select("SELECT 
        a.inbound_planning_no, 
        a.SKU, 
        a.item_name, 
        a.batch_no, 
        a.serial_no, 
        a.imei, 
        a.part_no, 
        a.color, 
        a.size, 
        a.expired_date, 
        a.qty, 
        l.discrepancy, 
        a.uom_name, 
        l.stock_id, 
        a.clasification_id, 
        h.part_name, 
        j.classification_name, 
        k.stock_type
        FROM t_wh_inbound_planning_detail AS a
        LEFT JOIN t_wh_inbound_planning AS g ON g.inbound_planning_no = a.inbound_planning_no
        LEFT JOIN m_wh_client_project AS b ON b.client_project_id = g.client_project_id
        LEFT JOIN m_warehouse AS c ON c.wh_id = b.wh_id AND c.wh_id = g.wh_id
        LEFT JOIN m_wh_client AS d ON d.client_id = b.client_id
        LEFT JOIN m_wh_order_type AS e ON e.order_id = g.order_id
        LEFT JOIN m_status AS f ON f.status_id = g.status_id
        LEFT JOIN m_wh_item AS h ON h.sku = a.SKU
        LEFT JOIN m_item_classification AS j ON j.item_classification_id = a.clasification_id
        LEFT JOIN t_wh_inbound_detail l ON l.inbound_planning_no=a.inbound_planning_no AND l.SKU=a.sku
        LEFT JOIN m_wh_stock_type AS k ON k.stock_id = l.stock_id
        WHERE c.wh_id = ? 
        AND d.client_id = ? 
        AND b.client_project_id = ? 
        AND (a.inbound_planning_no = ?) 
        AND j.process_id= ?
        ORDER BY a.datetime_created DESC
        ",[
            session("current_warehouse_id"),
            session("current_client_id"),
            session("current_client_project_id"),
            $current_data->inbound_planning_no,
            "12",
        ]);
        $current_data_wh_activity = $this->getWHActivity($current_data->inbound_planning_no);
        $current_data_wh_transportation_wh_scan_qty = $this->getWHTransportationWHScanQty($current_data->inbound_planning_no);

        //can_confirm start 
        $can_confirm = true;
        if (count($current_data_wh_transportation_wh_scan_qty) > 0) {
            foreach ($current_data_wh_transportation_wh_scan_qty as $key_data_wh_transportation_wh_scan_qty => $value_data_wh_transportation_wh_scan_qty) {

                $arrival_date = $value_data_wh_transportation_wh_scan_qty->arrival_date;
                $start_unloading = $value_data_wh_transportation_wh_scan_qty->start_unloading;
                $finish_unloading = $value_data_wh_transportation_wh_scan_qty->finish_unloading;
                $departure_date = $value_data_wh_transportation_wh_scan_qty->departure_date;
                // if(empty($finish_unloading) || empty($departure_date)){ //temp_disabled_odoo_TASK1598
                if(!empty($arrival_date) && !empty($start_unloading)  && (empty($finish_unloading) || empty($departure_date))){
                    $can_confirm = false;
                }
            }
        }
        //can_confirm end

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_detail"] = $current_data_detail;
        $data["current_data_wh_activity"] = $current_data_wh_activity;
        $data["current_data_wh_transportation_wh_scan_qty"] = $current_data_wh_transportation_wh_scan_qty;
        $data["can_confirm"] = $can_confirm;

        return view("inbound-planning.show",compact("data")); 
    }

    public function edit(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            echo "<script>
            alert('Inbound Planning doesnt exist');
            window.location.href = '".route('inbound_planning.index')."'
            </script>";
            return;
        }
        
        $current_data = $check_Inbound_Planning[0];
        $current_data_detail = $this->getInboundPlanningDetail($id);

        $data = [];
        $data["current_data"] = $current_data;
        if($current_data->status_id != "OPI"){ 
            echo "<script>
            alert('Inbound Planning status is not Open');
            window.location.href = '".route('inbound_planning.index')."'
            </script>";
            return;
        }
        $data["current_data_detail"] = $current_data_detail;

        return view("inbound-planning.edit",compact("data"));   
    }

    public function update(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning doesnt exist",
                "data" => [],
            ],200);
        }
        $current_data = $check_Inbound_Planning[0];

        if($current_data->status_id != "OPI"){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning status is not Open, Please Reload the page.",
                "data" => [],
            ],200);
        }

        $allowed_file_type = ["png","jpg","jpeg"];
        $session_client_project_id = session("current_client_project_id");
        $session_client_id = session("current_client_id");
        $session_warehouse_id = session("current_warehouse_id");

        $supplier_id = $request->input("supplier_id");
        $reference_no = $request->input("reference_no");
        $receipt_no = $request->input("receipt_no");
        $order_id = $request->input("order_id");
        $order_type = $request->input("order_type");
        $plan_delivery_date = $request->input("plan_delivery_date");
        $client_id = $request->input("client_id");
        $warehouse_id = $request->input('warehouse_id');
        $remarks = $request->input('remarks');
        $task_type = $request->input("task_type");

        $arr_sku_no = json_decode($request->input("arr_sku_no"),true);
        $arr_item_name = json_decode($request->input("arr_item_name"),true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"),true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"),true);
        $arr_imei_no = json_decode($request->input("arr_imei_no"),true);
        $arr_part_no = json_decode($request->input("arr_part_no"),true);
        $arr_color = json_decode($request->input("arr_color"),true);
        $arr_size = json_decode($request->input("arr_size"),true);
        $arr_expired_date = json_decode($request->input("arr_expired_date"),true);
        $arr_uom = json_decode($request->input("arr_uom"),true);
        $arr_qty_plan = json_decode($request->input("arr_qty_plan"),true);
        $arr_id_classification = json_decode($request->input("arr_id_classification"),true);
        $arr_classification = json_decode($request->input("arr_classification"),true);

        $file_1 = $request->file("file_1");
        $file_2 = $request->file("file_2");
        $file_3 = $request->file("file_3");

        $data_error = [];

        if(empty($supplier_id)){
            $data_error['supplier_name'][] = "Supplier ID is required";
            $data_error['supplier_name'][] = "Supplier Name is required";
        }else{
            $check_Supplier_id = $this->getSupplier($supplier_id);
            if(count($check_Supplier_id) == 0){
                $data_error['supplier_name'][] = "Supplier ID is not exist in database";
                $data_error['supplier_name'][] = "Supplier Name is not exist in database";
            }
        }

        if(empty($reference_no)){
            $data_error['reference_no'][] = "Reference No is required";
        }

        if(empty($receipt_no)){
            $data_error['receipt_no'][] = "Receipt No is required";
        }

        if(empty($order_id)){
            $data_error['order_type'][] = "Order ID is required";
        }else{
            $check_Order_id = $this->getOrderType($order_id);
            if(count($check_Order_id) == 0){
                $data_error['order_type'][] = "Order ID is not exist in database";
            }
        }

        if(empty($order_type)){
            $data_error['order_type'][] = "Order Type is required";
        }

        if(empty($plan_delivery_date)){
            $data_error['plan_delivery_date'][] = "Plan Delivery Date is required";
        }else if(!empty($plan_delivery_date) && strtotime(date("Y-m-d",strtotime($plan_delivery_date))) < strtotime(date("Y-m-d",strtotime($this->datetime_now)))){
            $data_error['plan_delivery_date'][] = "Plan Delivery Date can not back date";
        }

        if(empty($client_id)){
            $data_error['client_name'][] = "Client is required";
        }

        if($session_client_id != $client_id){
            $data_error['client_name'][] = "Client is not same with login, please reload the page.";
        }

        if(empty($warehouse_id)){
            $data_error['warehouse_name'][] = "Warehouse is required";
        }

        if($session_warehouse_id != $warehouse_id){
            $data_error['warehouse_name'][] = "Warehouse is not same with login, please reload the page.";
        }
        
        if(empty($task_type)){
            $data_error['task_type_single_receive'][] = "Task Type is required";
            $data_error['task_type_partial_receive'][] = "Task Type is required";
        }else if(!in_array($task_type, ["Single Receive","Partial Receive",])){
            $data_error['task_type_single_receive'][] = "Task Type is required";
            $data_error['task_type_partial_receive'][] = "Task Type is required";
        }

        if(
            count($arr_sku_no) == 0 ||
            count($arr_item_name) == 0 ||
            count($arr_batch_no) == 0 ||
            count($arr_serial_no) == 0 ||
            count($arr_imei_no) == 0 ||
            count($arr_part_no) == 0 ||
            count($arr_color) == 0 ||
            count($arr_size) == 0 ||
            count($arr_expired_date) == 0 ||
            count($arr_uom) == 0 ||
            count($arr_qty_plan) == 0 ||
            count($arr_id_classification) == 0 ||
            count($arr_classification) == 0
        ){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details is required",
                "data" => $data_error,
            ],200);
        }

        $exist_sku = [];
        foreach ($arr_sku_no as $key_sku_no => $sku_no) {
            $id_sku_no = isset($sku_no['id']) ? $sku_no['id'] : null ;
            $value = isset($sku_no['value']) ? $sku_no['value'] : null ;
            if(empty($value)){
                $data_error[$id_sku_no][] = "Sku No is required";
            }else if(!empty($value)){
                $check_SKU = $this->getSKU($value);
                if(count($check_SKU) == 0){
                    $data_error[$id_sku_no][] = "Sku No is not exist in database";
                }else if(array_key_exists($value,$exist_sku)){
                    $data_error[$id_sku_no][] = "Sku No is already used in other row";
                    $data_error[$exist_sku[$value]][] = "Sku No is already used";
                }
                $exist_sku[$value] = $id_sku_no;
            }
            
        }

        foreach ($arr_item_name as $key_item_name => $value_item_name) {
            $id_item_name = isset($value_item_name['id']) ? $value_item_name['id'] : null ;
            $value = isset($value_item_name['value']) ? $value_item_name['value'] : null ;
            if(empty($value)){
                $data_error[$id_item_name][] = "Item Name is required";
            }
        }

        foreach ($arr_uom as $key_uom => $value_uom) {
            $id_uom = isset($value_uom['id']) ? $value_uom['id'] : null ;
            $value = isset($value_uom['value']) ? $value_uom['value'] : null ;
            if(empty($value)){
                $data_error[$id_uom][] = "UOM is required";
            }
        }
        
        foreach ($arr_qty_plan as $key_qty_plan => $value_qty_plan) {
            $id_qty_plan = isset($value_qty_plan['id']) ? $value_qty_plan['id'] : null ;
            $value = isset($value_qty_plan['value']) ? $value_qty_plan['value'] : null ;
            if(empty($value)){
                $data_error[$id_qty_plan][] = "Plan Qty is required";
            }
        }
        
        foreach ($arr_id_classification as $key_id_classification => $value_id_classification) {
            $id_id_classification = isset($value_id_classification['id']) ? $value_id_classification['id'] : null ;
            $value = isset($value_id_classification['value']) ? $value_id_classification['value'] : null ;
            if(empty($value)){
                $data_error[$id_id_classification][] = "Classification ID is required";
            }else{
                $check_Classification_ID = $this->getClassification($value);
                if(count($check_Classification_ID) == 0){
                    $data_error[$id_id_classification][] = "Classification ID is not exist in database";
                }
            }
        }

        foreach ($arr_classification as $key_classification => $value_classification) {
            $id_classification = isset($value_classification['id']) ? $value_classification['id'] : null ;
            $value = isset($value_classification['value']) ? $value_classification['value'] : null ;
            if(empty($value)){
                $data_error[$id_classification][] = "Classification is required";
            }
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

        $validated = [
            "supplier_id" => $supplier_id,
            "reference_no" => $reference_no,
            "receipt_no" => $receipt_no,
            "order_id" => $order_id,
            "order_type" => $order_type,
            "plan_delivery_date" => $plan_delivery_date,
            "client_id" => $client_id,
            "warehouse_id" => $warehouse_id,
            "remarks" => $remarks,
            "arr_sku_no" => $arr_sku_no,
            "arr_item_name" => $arr_item_name,
            "arr_batch_no" => $arr_batch_no,
            "arr_serial_no" => $arr_serial_no,
            "arr_imei_no" => $arr_imei_no,
            "arr_part_no" => $arr_part_no,
            "arr_color" => $arr_color,
            "arr_size" => $arr_size,
            "arr_expired_date" => $arr_expired_date,
            "arr_uom" => $arr_uom,
            "arr_qty_plan" => $arr_qty_plan,
            "arr_id_classification" => $arr_id_classification,
            "arr_classification" => $arr_classification,
            "task_type" => $task_type,
        ];

        

        DB::beginTransaction();
        try {
            $url = "https://static.rpx.co.id/";
            $path = "/wms_web_dev/inbound";

            $url_file_1= "";
            if(!empty($file_1)){
                $file_1_name = $this->uploadFTP($file_1,$path);
                $url_file_1 = $url.$file_1_name;
            }

            $url_file_2= "";
            if(!empty($file_2)){
                $file_2_name = $this->uploadFTP($file_2,$path);
                $url_file_2 = $url.$file_2_name;
            }

            $url_file_3= "";
            if(!empty($file_3)){
                $file_3_name = $this->uploadFTP($file_3,$path);
                $url_file_3 = $url.$file_3_name;
            }

            
            $data_update_t_wh_inbound_planning_header = [
                "wh_id" => $session_warehouse_id,
                "client_project_id" => $session_client_project_id,
                "supplier_id" => $validated["supplier_id"],
                "status_id" => "OPI",
                "reference_no" => $validated["reference_no"],
                "receipt_no" => $validated["receipt_no"],
                "plan_delivery" => $validated["plan_delivery_date"],
                "order_id" => $validated["order_id"],
                "remarks" => $validated["remarks"],
                "task_type" => $validated["task_type"],
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
            ];
            if(!empty($url_file_1)){
                $data_update_t_wh_inbound_planning_header["data_upload1"] = $url_file_1;
            }
            if(!empty($url_file_2)){
                $data_update_t_wh_inbound_planning_header["data_upload2"] = $url_file_2;
            }
            if(!empty($url_file_3)){
                $data_update_t_wh_inbound_planning_header["data_upload3"] = $url_file_3;
            }

            DB::table("t_wh_inbound_planning")
            ->where("inbound_planning_no",$current_data->inbound_planning_no)
            ->update($data_update_t_wh_inbound_planning_header);

            DB::table("t_wh_inbound_planning_detail")
            ->where("inbound_planning_no",$current_data->inbound_planning_no)
            ->delete();

            $max_row_detail = count($arr_sku_no);
            for ($i=0; $i < $max_row_detail; $i++) { 
                $data_insert_t_wh_inbound_planning_detail = [
                    "inbound_planning_no" => $current_data->inbound_planning_no,
                    "SKU" => $validated["arr_sku_no"][$i]["value"],
                    "item_name" => $validated["arr_item_name"][$i]["value"],
                    "batch_no" => $validated["arr_batch_no"][$i]["value"],
                    "serial_no" => $validated["arr_serial_no"][$i]["value"],
                    "imei" => $validated["arr_imei_no"][$i]["value"],
                    "part_no" => $validated["arr_part_no"][$i]["value"],
                    "color" => $validated["arr_color"][$i]["value"],
                    "size" => $validated["arr_size"][$i]["value"],
                    "qty" => $validated["arr_qty_plan"][$i]["value"],
                    "uom_name" => $validated["arr_uom"][$i]["value"],
                    "clasification_id" => $validated["arr_id_classification"][$i]["value"],
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];

                if(!empty($validated["arr_expired_date"][$i]["value"])){
                    $data_insert_t_wh_inbound_planning_detail["expired_date"] = $validated["arr_expired_date"][$i]["value"];
                }

                DB::table("t_wh_inbound_planning_detail")
                ->insert($data_insert_t_wh_inbound_planning_detail);
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
            "message" => "Success Update Inbound Planning.",
            "data" => [],
        ],200);
    }

    public function cancel(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            echo "<script>
            alert('Inbound Planning doesnt exist');
            window.location.href = '".route('inbound_planning.index')."'
            </script>";
            return;
        }
        
        $current_data = $check_Inbound_Planning[0];
        $current_data_detail = $this->getInboundPlanningDetail($id);

        $data = [];
        $data["current_data"] = $current_data;
        if(!in_array($current_data->status_id , [ "OPI", "UIN"])){
            echo "<script>
            alert('Inbound Planning status is not Open or Unreceived');
            window.location.href = '".route('inbound_planning.index')."'
            </script>";
            return;
        }
        $data["current_data_detail"] = $current_data_detail;

        return view("inbound-planning.cancel",compact("data")); 
    }

    public function processCancel(Request $request, $id)
    {

        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning doesnt exist",
                "data" => [],
            ],200);
        }
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , [ "OPI", "UIN"])){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning status is not Open or Unreceived, Please Reload the page.",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {

            $data_update_t_wh_inbound_planning_header = [
                "status_id" => "CIN",
                "is_active" => "N",
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
            ];

            DB::table("t_wh_inbound_planning")
            ->where("inbound_planning_no",$current_data->inbound_planning_no)
            ->update($data_update_t_wh_inbound_planning_header);

            $data_update_t_wh_activity = [
                "is_active" => "N",
            ];

            DB::table("t_wh_activity")
            ->where("inbound_planning_no",$current_data->inbound_planning_no)
            ->where("process_id",12)
            ->update($data_update_t_wh_activity);


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
            "message" => "Success Cancel Inbound Planning.",
            "data" => [],
        ],200);
    }

    public function confirmToUnreceive(Request $request, $id)
    {

        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning doesnt exist",
                "data" => [],
            ],200);
        }
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , [ "OPI" ])){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning status is not Open , Please Reload the page.",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {

            $data_update_t_wh_inbound_planning_header = [
                "status_id" => "UIN",
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
            ];

            DB::table("t_wh_inbound_planning")
            ->where("inbound_planning_no",$current_data->inbound_planning_no)
            ->update($data_update_t_wh_inbound_planning_header);

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
            "message" => "Success Confirm Inbound Planning.",
            "data" => [],
        ],200);
    }

    private function getTargetUserAssign($username = false)
    {
        $data = DB::query()
        ->select([
            "a.username",
            "a.fullname",
        ])
        ->from("t_wh_user as a")
        ->leftJoin("m_wh_user_level as b","b.user_level_id","=","a.user_level_id")
        ->leftJoin("m_wh_user_client_project as c","c.username","=","a.username")
        ->leftJoin("m_wh_client_project as d","d.client_project_id","=","c.client_project_id")
        ->where("d.wh_id",session('current_warehouse_id'))
        ->where("d.client_id",session('current_client_id'))
        ->where("c.client_project_id",session('current_client_project_id'))
        ->whereIn("b.user_level_id",["1","2","3","5"])
        ->where(function ($query) use($username)
        {
            if($username !== false){
                $query->where("a.username",$username);
            }
        })
        ->get();
        return $data;
    }

    public function datatablesTargetUserAssign(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getTargetUserAssign();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
        ->make(true);
    }

    public function processAssignChecker(Request $request, $id)
    {

        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning doesnt exist",
                "data" => [],
            ],200);
        }
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , [ "UIN" ])){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning status is not Unreceived , Please Reload the page.",
                "data" => [],
            ],200);
        }    

        $arr_checker_username = json_decode($request->input("arr_checker_username"),true);
        $arr_checker_date_start = json_decode($request->input("arr_checker_date_start"),true);
        $arr_checker_time_start = json_decode($request->input("arr_checker_time_start"),true);
        $arr_checker_date_finish = json_decode($request->input("arr_checker_date_finish"),true);
        $arr_checker_time_finish = json_decode($request->input("arr_checker_time_finish"),true);

        if(
            $arr_checker_username == null ||
            $arr_checker_date_start == null ||
            $arr_checker_time_start == null ||
            $arr_checker_date_finish == null ||
            $arr_checker_time_finish == null 
        ){
            return response()->json([
                "err" => true,
                "message" => "Assign To Checker data is required.",
                "data" => [],
            ],200);
        }

        $data_error = [];

        foreach ($arr_checker_username as $key_checker_username => $value_checker_username) {
            $id_checker_username = isset($value_checker_username['id']) ? $value_checker_username['id'] : null ;
            $value = isset($value_checker_username['value']) ? $value_checker_username['value'] : null ;
            if(empty($value)){
                $data_error[$id_checker_username][] = "Username is required";
            }
        }
        
        foreach ($arr_checker_date_start as $key_checker_date_start => $value_checker_date_start) {
            $id_checker_date_start = isset($value_checker_date_start['id']) ? $value_checker_date_start['id'] : null ;
            $value = isset($value_checker_date_start['value']) ? $value_checker_date_start['value'] : null ;
            if(empty($value)){
                $data_error[$id_checker_date_start][] = "Date Start is required";
            }
        }
        
        foreach ($arr_checker_time_start as $key_checker_time_start => $value_checker_time_start) {
            $id_checker_time_start = isset($value_checker_time_start['id']) ? $value_checker_time_start['id'] : null ;
            $value = isset($value_checker_time_start['value']) ? $value_checker_time_start['value'] : null ;
            if(empty($value)){
                $data_error[$id_checker_time_start][] = "Time Start is required";
            }
        }
        
        foreach ($arr_checker_date_finish as $key_checker_date_finish => $value_checker_date_finish) {
            $id_checker_date_finish = isset($value_checker_date_finish['id']) ? $value_checker_date_finish['id'] : null ;
            $value = isset($value_checker_date_finish['value']) ? $value_checker_date_finish['value'] : null ;
            if(empty($value)){
                $data_error[$id_checker_date_finish][] = "Date Finish is required";
            }
        }
        
        foreach ($arr_checker_time_finish as $key_checker_time_finish => $value_checker_time_finish) {
            $id_checker_time_finish = isset($value_checker_time_finish['id']) ? $value_checker_time_finish['id'] : null ;
            $value = isset($value_checker_time_finish['value']) ? $value_checker_time_finish['value'] : null ;
            if(empty($value)){
                $data_error[$id_checker_time_finish][] = "Time Finish is required";
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
            "arr_checker_username" => $arr_checker_username,
            "arr_checker_date_start" => $arr_checker_date_start,
            "arr_checker_time_start" => $arr_checker_time_start,
            "arr_checker_date_finish" => $arr_checker_date_finish,
            "arr_checker_time_finish" => $arr_checker_time_finish,
        ];
        DB::beginTransaction();
        try {

            $max_count_username = count($validated["arr_checker_username"]);
            $data_t_wh_activity = [];
            for ($i=0; $i < $max_count_username ; $i++) { 
                $temp_datetime_est_start = date("Y-m-d H:i:s",strtotime($validated["arr_checker_date_start"][$i]["value"]." ".$validated["arr_checker_time_start"][$i]["value"]));
                $temp_datetime_est_finish = date("Y-m-d H:i:s",strtotime($validated["arr_checker_date_finish"][$i]["value"]." ".$validated["arr_checker_time_finish"][$i]["value"]));
                $data_t_wh_activity[] = [
                    "process_id" => 12,
                    "inbound_planning_no" => $current_data->inbound_planning_no,
                    "reference_no" => $current_data->reference_no,
                    "checker" => $validated["arr_checker_username"][$i]["value"],
                    "datetime_est_start" => $temp_datetime_est_start,
                    "datetime_est_finish" => $temp_datetime_est_finish,
                    "is_active" => "Y",
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];
            }

            DB::table("t_wh_activity")
            ->insert($data_t_wh_activity);

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
            "message" => "Success Assign Checker.",
            "data" => [],
        ],200);
    }

    private function getClientProjectBy_Client_Project_id($client_project_id)
    {
        $data = DB::query()
        ->select([
            "a.client_project_name",
            "a.client_id",
            "b.client_name",
        ])
        ->from("m_wh_client_project as a")
        ->leftJoin("m_wh_client as b","b.client_id","=","a.client_id")
        ->where("a.client_project_id",$client_project_id)
        ->get();
        return $data;
    }

    public function viewPDF(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            echo "<script>
            alert('Inbound Planning doesnt exist');
            window.location.href = '".route('inbound_planning.index')."'
            </script>";
            return;
        }
        
        $current_data = $check_Inbound_Planning[0];

        $current_data_detail = DB::select("SELECT 
        b.sku, 
        b.item_name, 
        b.batch_no, 
        b.serial_no,
        date(b.expired_date) AS expired_date, 
        b.qty AS qty_plan, 
        b.uom_name,
        case when d.qty IS NULL then '' ELSE d.qty END AS qty_receive,
        c.classification_name, 
        b.imei, 
        b.part_no, 
        b.color,
        b.size
        FROM t_wh_inbound_planning a
        LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no
        LEFT JOIN m_item_classification c ON c.item_classification_id=b.clasification_id
        LEFT JOIN t_wh_inbound_detail d ON d.inbound_planning_no=b.inbound_planning_no AND d.sku=b.sku
        WHERE a.inbound_planning_no = ?
        AND a.client_project_id = ?
        AND c.process_id = ?
        ",[
            $current_data->inbound_planning_no,
            session("current_client_project_id"),
            "12",
        ]);

        $current_data_client_project =$this->getClientProjectBy_Client_Project_id($current_data->client_project_id);

        $data = [];
        $data["current_data"] = $current_data;
        $data["data_header"] = DB::select("SELECT b.client_id, c.client_name, a.inbound_planning_no
        FROM t_wh_inbound_planning a
        LEFT JOIN m_wh_client_project b ON a.client_project_id=b.client_project_id
        LEFT JOIN m_wh_client c ON c.client_id=b.client_id
        WHERE a.inbound_planning_no = ?
        AND a.client_project_id = ?
        ",[
            $current_data->inbound_planning_no,
            session("current_client_project_id"),
        ]);
        $data["current_data_detail"] = $current_data_detail;
        $data["current_data_client_project"] = $current_data_client_project;

        $pdf = Pdf::loadView('inbound-planning.pdf', compact('data'));
        return $pdf->stream($data["current_data"]->inbound_planning_no.".pdf");
    }
    
    private function getWHActivityByChecker($inbound_planning_no,$checker)
    {
        $data = DB::query()
        ->select([
            "a.activity_id",
            "a.checker",
            DB::raw("CAST(a.datetime_est_start AS DATE) AS start_date"),
            DB::raw("CAST(a.datetime_est_start AS TIME) AS start_time"),
            DB::raw("CAST(a.datetime_est_finish AS DATE) AS finish_date"),
            DB::raw("CAST(a.datetime_est_finish AS TIME) AS finish_time"),
        ])
        ->from("t_wh_activity as a")
        ->leftJoin("t_wh_inbound_planning as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->where("a.inbound_planning_no", $inbound_planning_no)
        ->where("a.checker", $checker)
        ->orderBy("a.datetime_created","DESC")
        ->get();
        return $data;
    }

    private function getWHTransportationByCheckerAndActivityIDAndVehicleNo($activity_id,$checker,$vehicle_no = false)
    {
        $data = DB::query()
        ->select([
            "a.activity_id",
            "c.checker",
            "a.vehicle_id",
            "b.vehicle_type",
            "a.vehicle_no",
            "a.driver_name",
            "a.container_no",
            "a.seal_no",
            "a.transport_id",
            DB::raw("CAST(a.arrival_date AS DATE) AS arrival_date"),
            DB::raw("CAST(a.arrival_date AS TIME) AS arrival_time"),
            DB::raw("CAST(a.start_unloading AS DATE) AS start_unloading_date"),
            DB::raw("CAST(a.start_unloading AS TIME) AS start_unloading_time"),
            DB::raw("CAST(a.finish_unloading AS DATE) AS finish_unloading_date"),
            DB::raw("CAST(a.finish_unloading AS TIME) AS finish_unloading_time"),
            DB::raw("CAST(a.departure_date AS DATE) AS departure_date"),
            DB::raw("CAST(a.departure_date AS TIME) AS departure_time"),
        ])
        ->from("t_wh_transportation as a")
        ->leftJoin("m_wh_vehicle as b","b.vehicle_id","=","a.vehicle_id")
        ->leftJoin("t_wh_activity as c","c.activity_id","=","a.activity_id")
        ->where("a.activity_id", $activity_id)
        ->where("c.checker", $checker)
        ->where(function ($query) use($vehicle_no)
        {
            if($vehicle_no !== false){
                $query->where("a.vehicle_no",$vehicle_no);
            }
        })
        ->get();
        return $data;
    }

    public function inboundCheckingAndReceive(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            echo "<script>
            alert('Inbound Planning doesnt exist');
            window.location.href = '".route('inbound_planning.show',['id' => $id ])."'
            </script>";
            return;
        }
        
        $current_data = $check_Inbound_Planning[0];
        $current_data_detail = $this->getInboundPlanningDetail($id);
        $data = [];
        $data["current_data"] = $current_data;
        if(!in_array($current_data->status_id , ["UIN"])){ 
            echo "<script>
            alert('Inbound Planning status is not Unreceived');
            window.location.href = '".route('inbound_planning.show',['id' => $id ])."'
            </script>";
            return;
        }
        $data["current_data_detail"] = $current_data_detail;

        $current_data_wh_activity = $this->getWHActivityByChecker($current_data->inbound_planning_no,session('username'));
        if(count($current_data_wh_activity) == 0){ 
            echo "<script>
            alert('You are not assigned to this inbound planning no');
            window.location.href = '".route('inbound_planning.show',['id' => $id ])."'
            </script>";
            return;
        }
        $data["current_data_wh_activity"] = $current_data_wh_activity;

        // $current_data_scan = $this->getWHScanType($current_data->inbound_planning_no,$current_data_wh_activity[0]->activity_id);
        // $data["current_data_scan"] = $current_data_scan;
        
        $current_data_transpotation = $this->getWHTransportationByCheckerAndActivityIDAndVehicleNo($current_data_wh_activity[0]->activity_id,session('username'));
        $data["current_data_transpotation"] = $current_data_transpotation;

        $current_arr_stock_type_scan = $this->getStockTypeScan();
        $data["current_arr_stock_type_scan"] = $current_arr_stock_type_scan;

        return view('inbound-planning.inbound-checking-receive.index',compact('data'));
    }

    private function getStockTypeScan($stock_id = false)
    {
        $data = DB::query()
        ->select([
            "a.stock_id",
            "a.stock_type",
        ])
        ->from("m_wh_stock_type as a")
        ->where("a.process_id","IN")
        ->where(function ($query) use($stock_id)
        {
            if(!empty($stock_id)){
                $query->where("a.stock_id", $stock_id);
            }
        })
        ->get();
        return $data;
    }

    private function getVehicleType($vehicle_id = false)
    {
        $data = DB::query()
        ->select([
            "a.vehicle_id",
            "a.vehicle_type",
        ])
        ->from("m_wh_vehicle as a")
        ->where(function ($query) use($vehicle_id)
        {
            if(!empty($vehicle_id)){
                $query->where("a.vehicle_id", $vehicle_id);
            }
        })
        ->get();

        return $data;
    }

    public function datatablesScanVehicle(Request $request)
    {
        $data = $this->getVehicleType();
        return DataTables::of($data)
        ->make(true);
    }

    private function getSupervisor()
    {
        $data = DB::query()
        ->select([
            "a.supervisor_id",
            "a.name",
        ])
        ->from("t_wh_supervisor as a")
        ->where("a.client_project_id",session("current_client_project_id"))
        ->get();
        return $data;
    }

    private function getPartName($sku)
    {
        $data = DB::query()
        ->select([
            "a.part_name",
        ])
        ->from("m_wh_item as a")
        ->where("a.sku",$sku)
        ->limit(1)
        ->get();
        return $data;
    }

    public function processSavePartialVehicle(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning doesnt exist",
                "data" => [],
            ],200);
        }
        
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , ["UIN"])){ //m_status | 1 = 'UNRECEIVED'
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning status is not Unreceived",
                "data" => [],
            ],200);
        }

        $current_data_wh_activity = $this->getWHActivityByChecker($current_data->inbound_planning_no,session('username'));

        if(count($current_data_wh_activity) == 0){ 
            return response()->json([
                "err" => true,
                "message" => "You are not assigned to this inbound planning no, Please Reload Page.",
                "data" => [],
            ],200);
        }

        if($current_data->inbound_planning_no != $request->input("inbound_planning_no")){ 
            return response()->json([
                "err" => true,
                "message" => "Inbound planning no is not same in Database, Please Reload Page.",
                "data" => [],
            ],200);
        }
        $activity_id = $current_data_wh_activity[0]->activity_id;
        $checker = $current_data_wh_activity[0]->checker;
        $inbound_planning_no = $current_data->inbound_planning_no;
        
        $arr_transport_id = json_decode($request->input("arr_transport_id"), true);
        $arr_vehicle_id = json_decode($request->input("arr_vehicle_id"), true);
        $arr_vehicle_type = json_decode($request->input("arr_vehicle_type"), true);
        $arr_vehicle_no = json_decode($request->input("arr_vehicle_no"), true);
        $arr_driver_name = json_decode($request->input("arr_driver_name"), true);
        $arr_container_no = json_decode($request->input("arr_container_no"), true);
        $arr_seal_no = json_decode($request->input("arr_seal_no"), true);
        $arr_arrival_date = json_decode($request->input("arr_arrival_date"), true);
        $arr_arrival_time = json_decode($request->input("arr_arrival_time"), true);
        $arr_start_unloading_date = json_decode($request->input("arr_start_unloading_date"), true);
        $arr_start_unloading_time = json_decode($request->input("arr_start_unloading_time"), true);

        if(
            count($arr_vehicle_id) == 0 ||
            count($arr_vehicle_type) == 0 ||
            count($arr_vehicle_no) == 0 ||
            count($arr_driver_name) == 0 ||
            count($arr_container_no) == 0 ||
            count($arr_seal_no) == 0 ||
            count($arr_arrival_date) == 0 ||
            count($arr_arrival_time) == 0 ||
            count($arr_start_unloading_date) == 0 ||
            count($arr_start_unloading_time) == 0
        ){
            return response()->json([
                "err" => true,
                "message" => "Vehicle Detail can not be empty",
                "data" => [],
            ],200);
        }

        $data_error = [];

        foreach ($arr_vehicle_id as $key_vehicle_id => $value_vehicle_id) {
            $id_vehicle_id = isset($value_vehicle_id['id']) ? $value_vehicle_id['id'] : null ;
            $id_vehicle_type = isset($arr_vehicle_type[$key_vehicle_id]['id']) ? $arr_vehicle_type[$key_vehicle_id]['id'] : null ;
            $value = isset($value_vehicle_id['value']) ? $value_vehicle_id['value'] : null ;
            if(empty($value)){
                $data_error[$id_vehicle_type][] = "Vehicle Type is required";
            }
            if(!empty($value)){
                if(count($this->getVehicleType($value)) == 0){
                    $data_error[$id_vehicle_type][] = "Vehicle Type is invalid, please change Vehicle Type";
                }
            }
        }

        foreach ($arr_vehicle_no as $key_vehicle_no => $value_vehicle_no) {
            $id_vehicle_no = isset($value_vehicle_no['id']) ? $value_vehicle_no['id'] : null ;
            $value = isset($value_vehicle_no['value']) ? $value_vehicle_no['value'] : null ;
            if(empty($value)){
                $data_error[$id_vehicle_no][] = "Vehicle No is required";
            }
        }

        foreach ($arr_driver_name as $key_driver_name => $value_driver_name) {
            $id_driver_name = isset($value_driver_name['id']) ? $value_driver_name['id'] : null ;
            $value = isset($value_driver_name['value']) ? $value_driver_name['value'] : null ;
            if(empty($value)){
                $data_error[$id_driver_name][] = "Driver Name is required";
            }
        }

        // foreach ($arr_container_no as $key_container_no => $value_container_no) {
        //     $id_container_no = isset($value_container_no['id']) ? $value_container_no['id'] : null ;
        //     $value = isset($value_container_no['value']) ? $value_container_no['value'] : null ;
        //     if(empty($value)){
        //         $data_error[$id_container_no][] = "Container No is required";
        //     }
        // }

        // foreach ($arr_seal_no as $key_seal_no => $value_seal_no) {
        //     $id_seal_no = isset($value_seal_no['id']) ? $value_seal_no['id'] : null ;
        //     $value = isset($value_seal_no['value']) ? $value_seal_no['value'] : null ;
        //     if(empty($value)){
        //         $data_error[$id_seal_no][] = "Seal No is required";
        //     }
        // }

        foreach ($arr_arrival_date as $key_arrival_date => $value_arrival_date) {
            $id_arrival_date = isset($value_arrival_date['id']) ? $value_arrival_date['id'] : null ;
            $value = isset($value_arrival_date['value']) ? $value_arrival_date['value'] : null ;
            if(empty($value)){
                $data_error[$id_arrival_date][] = "Arrival Date is required";
            }
        }

        foreach ($arr_arrival_time as $key_arrival_time => $value_arrival_time) {
            $id_arrival_time = isset($value_arrival_time['id']) ? $value_arrival_time['id'] : null ;
            $value = isset($value_arrival_time['value']) ? $value_arrival_time['value'] : null ;
            if(empty($value)){
                $data_error[$id_arrival_time][] = "Arrival Time is required";
            }
        }

        foreach ($arr_start_unloading_date as $key_start_unloading_date => $value_start_unloading_date) {
            $id_start_unloading_date = isset($value_start_unloading_date['id']) ? $value_start_unloading_date['id'] : null ;
            $value = isset($value_start_unloading_date['value']) ? $value_start_unloading_date['value'] : null ;
            if(empty($value)){
                $data_error[$id_start_unloading_date][] = "Start Unloading Date is required";
            }
        }

        foreach ($arr_start_unloading_time as $key_start_unloading_time => $value_start_unloading_time) {
            $id_start_unloading_time = isset($value_start_unloading_time['id']) ? $value_start_unloading_time['id'] : null ;
            $value = isset($value_start_unloading_time['value']) ? $value_start_unloading_time['value'] : null ;
            if(empty($value)){
                $data_error[$id_start_unloading_time][] = "Start Unloading Time is required";
            }
        }


        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }

       

        // $get_Supervisor = $this->getSupervisor();
        // if(count($get_Supervisor) == 0){
        //     return response()->json([
        //         "err" => true,
        //         "message" => "Supervisor does not exists. please contact administrator.",
        //         "data" => [],
        //     ],200);
        // }

        // $supervisor_id = $get_Supervisor[0]->supervisor_id;
        
        $validated = [
            "arr_transport_id" => $arr_transport_id,
            "arr_vehicle_id" => $arr_vehicle_id,
            "arr_vehicle_type" => $arr_vehicle_type,
            "arr_vehicle_no" => $arr_vehicle_no,
            "arr_driver_name" => $arr_driver_name,
            "arr_container_no" => $arr_container_no,
            "arr_seal_no" => $arr_seal_no,
            "arr_arrival_date" => $arr_arrival_date,
            "arr_arrival_time" => $arr_arrival_time,
            "arr_start_unloading_date" => $arr_start_unloading_date,
            "arr_start_unloading_time" => $arr_start_unloading_time,
        ];
       

        DB::beginTransaction();
        try {
            
            $max_count = count($arr_vehicle_no);
            $data_t_wh_transportation = [];
            for ($i=0; $i < $max_count; $i++) { 
                $transport_id = $validated["arr_transport_id"][$i]["value"];
                if(empty($transport_id)){
                    $data_t_wh_transportation = [
                        "activity_id" => $activity_id,
                        "arrival_date" => date("Y-m-d H:i:s",strtotime($validated["arr_arrival_date"][$i]["value"]." ".$validated["arr_arrival_time"][$i]["value"])),
                        "start_unloading" => date("Y-m-d H:i:s",strtotime($validated["arr_start_unloading_date"][$i]["value"]." ".$validated["arr_start_unloading_time"][$i]["value"])),
                        "vehicle_no" => $validated["arr_vehicle_no"][$i]["value"],
                        "driver_name" => $validated["arr_driver_name"][$i]["value"],
                        "vehicle_id" => $validated["arr_vehicle_id"][$i]["value"],
                        "container_no" => $validated["arr_container_no"][$i]["value"],
                        "seal_no" => $validated["arr_seal_no"][$i]["value"],
                        "user_created" => session("username"),
                        "datetime_created" => $this->datetime_now,
                        "is_active" => "Y",
                    ];
    
                    DB::table("t_wh_transportation")
                    ->insert($data_t_wh_transportation);
                }else{
                    $check_Transport_id = DB::query()->select("transport_id")->from("t_wh_transportation")->where("transport_id",$transport_id)->get();
                    if(count($check_Transport_id) > 0){
                        $data_t_wh_transportation = [
                            "arrival_date" => date("Y-m-d H:i:s",strtotime($validated["arr_arrival_date"][$i]["value"]." ".$validated["arr_arrival_time"][$i]["value"])),
                            "start_unloading" => date("Y-m-d H:i:s",strtotime($validated["arr_start_unloading_date"][$i]["value"]." ".$validated["arr_start_unloading_time"][$i]["value"])),
                            "vehicle_no" => $validated["arr_vehicle_no"][$i]["value"],
                            "driver_name" => $validated["arr_driver_name"][$i]["value"],
                            "vehicle_id" => $validated["arr_vehicle_id"][$i]["value"],
                            "container_no" => $validated["arr_container_no"][$i]["value"],
                            "seal_no" => $validated["arr_seal_no"][$i]["value"],
                            "user_created" => session("username"),
                            "datetime_created" => $this->datetime_now,
                        ];

                        DB::table("t_wh_transportation")
                        ->where("activity_id",$activity_id)
                        ->where("transport_id",$transport_id)
                        ->update($data_t_wh_transportation);
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
            "message" => "Success Add Vehicle.",
            "data" => [],
        ],200);
    }

    public function processUpdateVehicleFinish(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning doesnt exist",
                "data" => [],
            ],200);
        }
        
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , ["UIN"])){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning status is not Unreceived",
                "data" => [],
            ],200);
        }

        $current_data_wh_activity = $this->getWHActivityByChecker($current_data->inbound_planning_no,session('username'));

        if(count($current_data_wh_activity) == 0){ 
            return response()->json([
                "err" => true,
                "message" => "You are not assigned to this inbound planning no, Please Reload Page.",
                "data" => [],
            ],200);
        }

        if($current_data->inbound_planning_no != $request->input("inbound_planning_no")){ 
            return response()->json([
                "err" => true,
                "message" => "Inbound planning no is not same in Database, Please Reload Page.",
                "data" => [],
            ],200);
        }

        $activity_id = $current_data_wh_activity[0]->activity_id;
        $inbound_planning_no = $current_data->inbound_planning_no;

        $arr_transport_id = json_decode($request->input("arr_transport_id"), true);
        $arr_vehicle_no = json_decode($request->input("arr_vehicle_no"), true);
        $arr_finish_unloading_date = json_decode($request->input("arr_finish_unloading_date"), true);
        $arr_finish_unloading_time = json_decode($request->input("arr_finish_unloading_time"), true);
        $arr_departure_date = json_decode($request->input("arr_departure_date"), true);
        $arr_departure_time = json_decode($request->input("arr_departure_time"), true);

        if(
            count($arr_vehicle_no) == 0 ||
            count($arr_finish_unloading_date) == 0 ||
            count($arr_finish_unloading_time) == 0 ||
            count($arr_departure_date) == 0 ||
            count($arr_departure_time) == 0
        ){
            return response()->json([
                "err" => true,
                "message" => "Vehicle Detail can not be empty",
                "data" => [],
            ],200);
        }

        $data_error = [];
        $validated = [];
        $input_max_count = count($arr_vehicle_no);

        for ($i=0; $i < $input_max_count; $i++) { 
            $id_transport_id = $arr_transport_id[$i]["id"];
            $value_transport_id = $arr_transport_id[$i]["value"];
            if(empty($value_transport_id)){
                return response()->json([
                    "err" => true,
                    "message" => "Vehicle Cannot be Save, please Save Vehicle First",
                    "data" => [],
                ],200);
            }
            $id_finish_unloading_date = $arr_finish_unloading_date[$i]["id"];
            $value_finish_unloading_date = $arr_finish_unloading_date[$i]["value"];

            if(empty($value_finish_unloading_date)){
                $data_error[$id_finish_unloading_date][] = "Finish Unloading Date is required";
            }

            $id_finish_unloading_time = $arr_finish_unloading_time[$i]["id"];
            $value_finish_unloading_time = $arr_finish_unloading_time[$i]["value"];

            if(empty($value_finish_unloading_time)){
                $data_error[$id_finish_unloading_time][] = "Finish Unloading Time is required";
            }

            $id_departure_date = $arr_departure_date[$i]["id"];
            $value_departure_date = $arr_departure_date[$i]["value"];

            if(empty($value_departure_date)){
                $data_error[$id_departure_date][] = "Departure Date is required";
            }

            $id_departure_time = $arr_departure_time[$i]["id"];
            $value_departure_time = $arr_departure_time[$i]["value"];

            if(empty($value_departure_time)){
                $data_error[$id_departure_time][] = "Departure Time is required";
            }

            $id_vehicle_no = $arr_vehicle_no[$i]["id"];
            $value_vehicle_no = $arr_vehicle_no[$i]["value"];

            if(empty($value_vehicle_no)){
                $data_error[$id_vehicle_no][] = "Vehicle No is required";
            }else {
                $check_Exist_Vehicle_no_By_checker_vehicle_no_activity_id = DB::query()
                ->select([
                    "t_wh_transportation.vehicle_no",
                    "t_wh_transportation.activity_id",
                ])
                ->from("t_wh_transportation")
                
                ->where("t_wh_transportation.vehicle_no",$value_vehicle_no)
                ->where("t_wh_transportation.activity_id",$activity_id)
                ->get();
                if(count($check_Exist_Vehicle_no_By_checker_vehicle_no_activity_id) == 0){
                    $data_error[$id_vehicle_no][] = "Vehicle No is not exists, Please Reload the page.";
                }else{
                    $validated[] = [
                        "transport_id" => $value_transport_id,
                        "vehicle_no" => $value_vehicle_no,
                        "finish_unloading" => date("Y-m-d H:i:s",strtotime($value_finish_unloading_date." ".$value_finish_unloading_time)),
                        "departure_date" => date("Y-m-d H:i:s",strtotime($value_departure_date." ".$value_departure_time)),
                    ];
                }
            }
        }

        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }

        if(count($validated) == 0){
            return response()->json([
                "err" => true,
                "message" => "No Data to update",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {
            
            foreach ($validated as $key_validated => $value_validated) {
                DB::table("t_wh_transportation")
                ->where("transport_id",$value_validated["transport_id"])
                ->where("activity_id",$activity_id)
                ->update([
                    "finish_unloading" => $value_validated["finish_unloading"],
                    "departure_date" => $value_validated["departure_date"],
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
            "message" => "Success Update Vehicle.",
            "data" => [],
        ],200);

    }

    public function processScan(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning doesnt exist",
                "data" => [],
            ],200);
        }
        
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , ["UIN"])){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning status is not Unreceived",
                "data" => [],
            ],200);
        }

        $current_data_wh_activity = $this->getWHActivityByChecker($current_data->inbound_planning_no,session('username'));

        if(count($current_data_wh_activity) == 0){ 
            return response()->json([
                "err" => true,
                "message" => "You are not assigned to this inbound planning no, Please Reload Page.",
                "data" => [],
            ],200);
        }

        if($current_data->inbound_planning_no != $request->input("inbound_planning_no")){ 
            return response()->json([
                "err" => true,
                "message" => "Inbound planning no is not same in Database, Please Reload Page.",
                "data" => [],
            ],200);
        }
        $activity_id = $current_data_wh_activity[0]->activity_id;
        $scan_vehicle_no = $request->input("scan_vehicle_no");
        $scan_pallet_no = $request->input("scan_pallet_no");
        $scan_stock_type = $request->input("scan_stock_type");
        $scan_qty = $request->input("scan_qty");
        $scan_sku = $request->input("scan_sku");
        $scan_serial_no = $request->input("scan_serial_no");
        $scan_serial_checkbox = $request->input("scan_serial_checkbox");

        if(empty($scan_vehicle_no)){
            return response()->json([
                "err" => true,
                "message" => "Vehicle No is required",
                "data" => [],
            ],200);
        }

        $data_transportation = $this->getWHTransportationByCheckerAndActivityIDAndVehicleNo($activity_id,session('username'),$scan_vehicle_no);
        if(count($data_transportation) == 0){
            return response()->json([
                "err" => true,
                "message" => "Vehicle No in not exist with this inbound planning, please reload the page.",
                "data" => [],
            ],200);
        }
        $transport_id = @$data_transportation[0]->transport_id;
        

        if(empty($scan_stock_type)){
            return response()->json([
                "err" => true,
                "message" => "Stock Type is required",
                "data" => [],
            ],200);
        }
        
        $check_Stock_Type = $this->getStockTypeScan($scan_stock_type);
        if(count($check_Stock_Type) == 0){
            return response()->json([
                "err" => true,
                "message" => "Stock Type is not exits in database, please reload page.",
                "data" => [],
            ],200);
        }

        if(empty($scan_qty) ){
            return response()->json([
                "err" => true,
                "message" => "Quantity is required",
                "data" => [],
            ],200);
        }

        if($scan_qty <= 0){
            return response()->json([
                "err" => true,
                "message" => "Quantity is need more than 0",
                "data" => [],
            ],200);
        }

        if(empty($scan_sku) ){
            return response()->json([
                "err" => true,
                "message" => "SKU is required",
                "data" => [],
            ],200);
        }

        $check_SKU_in_inbound_planning_detail = DB::query()
        ->select([
            "b.SKU",
            "b.serial_no",
            "b.item_name",
            "b.uom_name",
            "b.batch_no",
            "b.stock_id",
        ])
        ->from("t_wh_inbound_planning as a")
        ->leftJoin("t_wh_inbound_planning_detail as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->where("a.inbound_planning_no",$current_data->inbound_planning_no)
        ->where("b.SKU",$scan_sku)
        ->where(function ($query) use($scan_serial_no,$scan_serial_checkbox)
        {
            if($scan_serial_checkbox && !empty($scan_serial_no)){
                $query->where("b.serial_no",$scan_serial_no);
            }
        })
        ->get();

        if(count($check_SKU_in_inbound_planning_detail) == 0){
            return response()->json([
                "err" => true,
                "message" => "SKU ini tidak terdapat pada inbound planning no : ".$current_data->inbound_planning_no,
                "data" => [],
            ],200);
        }

        $check_Serial_No_Mandatory = DB::query()
        ->select([
            "a.is_serial_no",
        ])
        ->from("m_wh_item as a")
        ->where("a.wh_id",session("current_warehouse_id"))
        ->where("a.client_id",session("current_client_id"))
        ->where("a.sku",$scan_sku)
        ->get();

        if(
            count($check_Serial_No_Mandatory) > 0 &&
            $check_Serial_No_Mandatory[0]->is_serial_no == "Y" &&
            empty($scan_serial_no) 
        ){
            return response()->json([
                "err" => true,
                "message" => "For this SKU, Serial No is required",
                "data" => [],
            ],200);
        }

        $check_qty_plan_by_inbound_planning_no_and_sku = DB::select("SELECT 
        * FROM (
            SELECT 
            `b`.`SKU`, 
            `b`.`item_name`, 
            `b`.`batch_no`, 
            `b`.`expired_date`, 
            `b`.`serial_no`, 
            `b`.`qty` AS qty_plan,  
            sum(d.qty_scan) AS qty_scan,
            IF(`b`.`qty`- sum(d.qty_scan) IS NOT NULL, `b`.`qty`- sum(d.qty_scan), `b`.`qty`) AS qty_outstanding,
            `b`.`uom_name`
            FROM t_wh_inbound_planning a
            LEFT JOIN t_wh_inbound_planning_detail AS b ON b.inbound_planning_no = a.inbound_planning_no
            LEFT JOIN t_wh_activity c ON a.inbound_planning_no=c.inbound_planning_no AND a.reference_no=c.reference_no AND b.inbound_planning_no=c.inbound_planning_no
            LEFT JOIN t_wh_scan_qty d ON c.activity_id=d.activity_id AND b.sku=d.sku AND b.batch_no=d.batch_no
            WHERE a.inbound_planning_no = ? 
            AND b.sku = ?
            GROUP BY b.sku
        ) t",[
            $current_data->inbound_planning_no,
            $scan_sku,
        ]);
        
        if(count($check_qty_plan_by_inbound_planning_no_and_sku) == 0){
            return response()->json([
                "err" => true,
                "message" => "For this SKU, check qty plan is not exists",
                "data" => [],
            ],200);
        }
 
        if($scan_qty > $check_qty_plan_by_inbound_planning_no_and_sku[0]->qty_outstanding  ){
            return response()->json([
                "err" => true,
                "message" => "Qty can't be more than qty planning",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {
            
            DB::table("t_wh_scan_qty")
            ->insert([
                "activity_id" => $activity_id,
                "transport_id" => $transport_id,
                "pallet_id" => $scan_pallet_no,
                "sku" => $scan_sku,
                "part_name" => @$check_SKU_in_inbound_planning_detail[0]->item_name,
                "batch_no" => @$check_SKU_in_inbound_planning_detail[0]->batch_no,
                "uom_name" => @$check_SKU_in_inbound_planning_detail[0]->uom_name,
                "stock_id" => $scan_stock_type,
                "serial_no" => $scan_serial_no,
                "qty_scan" => $scan_qty,
                "is_active" => "Y",
                "user_created" => session("username"),
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
            "message" => "Success Scan SKU",
            "data" => [],
        ],200);
    }

    public function datatablesCheckedItems(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return DataTables::of([])
            ->make(true);
        }
        
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , ["UIN"])){
            return DataTables::of([])
            ->make(true);
        }

        $current_data_wh_activity = $this->getWHActivityByChecker($current_data->inbound_planning_no,session('username'));

        if(count($current_data_wh_activity) == 0){ 
            return DataTables::of([])
            ->make(true);
        }

        $activity_id = $current_data_wh_activity[0]->activity_id;

        $data = DB::query()
        ->select([
            "a.sku",
            "a.part_name",
            "a.batch_no",
            "a.serial_no",
            "c.expired_date",
            "a.qty_scan",
            "c.qty",
            "a.uom_name",
            "a.stock_id",
            "a.user_created",
            "a.scan_id",
        ])
        ->from("t_wh_scan_qty as a")
        ->leftJoin("t_wh_activity as b","b.activity_id","=","a.activity_id")
        ->leftJoin("t_wh_inbound_planning_detail as c",function ($query) 
        {
            $query->on("c.SKU","=","a.sku");
            $query->on("c.batch_no","=","a.batch_no");
        })
        ->where("a.activity_id",$activity_id)
        ->where("c.inbound_planning_no",$current_data->inbound_planning_no)
        ->get();
        return DataTables::of($data)
        ->addColumn('action', function ($result) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<button class='btn btn-primary mb-0 py-1' onclick=\"removeScan('".$result->scan_id."')\">Remove</button>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    public function processRemoveScan(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning doesnt exist",
                "data" => [],
            ],200);
        }
        
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , ["UIN"])){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning status is not Unreceived",
                "data" => [],
            ],200);
        }

        $current_data_wh_activity = $this->getWHActivityByChecker($current_data->inbound_planning_no,session('username'));

        if(count($current_data_wh_activity) == 0){ 
            return response()->json([
                "err" => true,
                "message" => "You are not assigned to this inbound planning no, Please Reload Page.",
                "data" => [],
            ],200);
        }

        $scan_id = $request->input("scan_id");
        if(empty($scan_id)){
            return response()->json([
                "err" => true,
                "message" => "Scan ID is required.",
                "data" => [],
            ],200);
        }

        $check_Scan_id = DB::query()
        ->select([
            "a.scan_id",
        ])
        ->from("t_wh_scan_qty as a")
        ->where("a.scan_id",$scan_id)
        ->get();

        if(count($check_Scan_id) == 0){
            return response()->json([
                "err" => true,
                "message" => "Scan ID is not exist in database.",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {
            
            DB::table("t_wh_scan_qty")
            ->where("scan_id",$scan_id)
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
            "message" => "Success Delete Scan",
            "data" => [],
        ],200);
    }

    public function datatablesOutstandingItems(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return DataTables::of([])
            ->make(true);
        }
        
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , ["UIN"])){
            return DataTables::of([])
            ->make(true);
        }
        
        // $data = [];

        // $raw_data = DB::query()
        // ->select([
        //     "b.SKU",
        //     "b.item_name",
        //     "b.expired_date",
        //     "b.batch_no",
        //     "b.qty",
        //     "b.uom_name",
        //     "b.serial_no",
        // ])
        // ->from("t_wh_inbound_planning as a")
        // ->leftJoin("t_wh_inbound_planning_detail as b","b.inbound_planning_no","=","a.inbound_planning_no")
        // ->where("a.inbound_planning_no",$current_data->inbound_planning_no)
        // ->get();
        // if(count($raw_data) > 0){
        //     foreach ($raw_data as $key_raw_data => $value_raw_data) {
        //         $SKU = $value_raw_data->SKU;
        //         $item_name = $value_raw_data->item_name;
        //         $expired_date = $value_raw_data->expired_date;
        //         $batch_no = $value_raw_data->batch_no;
        //         $qty = $value_raw_data->qty;
        //         $uom_name = $value_raw_data->uom_name;
        //         $serial_no = $value_raw_data->serial_no;
        //         $total_qty_scan = 0;

        //         $get_qty_scan = DB::query()
        //         ->select([
        //             "b.qty_scan",
        //             "b.sku",
        //             "b.batch_no",
        //             "b.serial_no",
        //         ])
        //         ->from("t_wh_activity as a")
        //         ->leftJoin("t_wh_scan_qty as b","b.activity_id","=","a.activity_id")
        //         ->where("a.inbound_planning_no",$current_data->inbound_planning_no)
        //         ->where("b.sku",$SKU)
        //         ->where(function ($query) use($batch_no,$serial_no)
        //         {
        //             if(!empty($batch_no)){
        //                 $query->where("b.batch_no",$batch_no);
        //             }
        //             if(!empty($serial_no)){
        //                 $query->where("b.serial_no",$serial_no);
        //             }
        //         })
        //         ->get();

        //         if(count($get_qty_scan) > 0){
        //             foreach ($get_qty_scan as $key_qty_scan => $value_qty_scan) {
        //                 if($value_qty_scan->qty_scan !== null && !empty($value_qty_scan->qty_scan)){
        //                     $total_qty_scan += $value_qty_scan->qty_scan;
        //                 }
        //             }

        //         }

        //         $qty_outstanding = $qty - $total_qty_scan;

        //         $temp_object = new stdClass();
        //         $temp_object->SKU = $SKU;
        //         $temp_object->item_name = $item_name;
        //         $temp_object->expired_date = $expired_date;
        //         $temp_object->batch_no = $batch_no;
        //         $temp_object->qty = $qty;
        //         $temp_object->uom_name = $uom_name;
        //         $temp_object->serial_no = $serial_no;
        //         $temp_object->total_qty_scan = $total_qty_scan;
        //         $temp_object->qty_outstanding = $qty_outstanding;
        //         $data[] = $temp_object;
        //     }
        // }

        $data = DB::select("SELECT 
        * FROM (
            SELECT 
            `b`.`SKU`, 
            `b`.`item_name`, 
            `b`.`batch_no`, 
            `b`.`expired_date`, 
            `b`.`serial_no`, 
            `b`.`qty` AS qty_plan,  
            sum(d.qty_scan) AS qty_scan,
            IF(`b`.`qty`- sum(d.qty_scan) IS NOT NULL, `b`.`qty`- sum(d.qty_scan), `b`.`qty`) AS qty_outstanding,
            `b`.`uom_name`
            FROM t_wh_inbound_planning a
            LEFT JOIN t_wh_inbound_planning_detail AS b ON b.inbound_planning_no = a.inbound_planning_no
            LEFT JOIN t_wh_activity c ON a.inbound_planning_no=c.inbound_planning_no AND a.reference_no=c.reference_no AND b.inbound_planning_no=c.inbound_planning_no
            LEFT JOIN t_wh_scan_qty d ON c.activity_id=d.activity_id AND b.sku=d.sku AND b.batch_no=d.batch_no
            WHERE a.inbound_planning_no = ? 
            GROUP BY b.sku
        ) t
        WHERE
        t.qty_outstanding > 0
        ",[
            $current_data->inbound_planning_no,
        ]);
        
        return DataTables::of($data)
        ->make(true);
    }

    private function getGRStatus($status_id = false)
    {
        $data = DB::query()
        ->select([
            "a.status_id",
            "a.status_name",
            "a.process_id",
        ])
        ->from("m_status as a")
        ->where("a.process_id","GR")
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

    public function confirmInboundPlanning(Request $request, $id)
    {
        $gr_status_id = $this->getStatusID("GR","OGR");
        if(!$gr_status_id){
            return response()->json([
                "err" => true,
                "message" => "Gr Status ID is not defined",
                "data" => [],
            ],200);
        }

        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning doesnt exist",
                "data" => [],
            ],200);
        }
        
        $current_data = $check_Inbound_Planning[0];

        if(!in_array($current_data->status_id , ["UIN"])){
            return response()->json([
                "err" => true,
                "message" => "Inbound Planning status is not Unreceived",
                "data" => [],
            ],200);
        }

        $get_status_id_receive = $this->getStatusID("IN","RIN");
        if(!$get_status_id_receive){
            return response()->json([
                "err" => true,
                "message" => "Inbound Receive Status ID is not defined",
                "data" => [],
            ],200);
        }
        $data_status_id_receive = $get_status_id_receive;

        DB::beginTransaction();
        try {
            
            // ambil total qty scan dari t_wh_scan_qty start
            $temp_data_t_wh_inbound_planning_detail = [];
            $current_data_wh_activity = $this->getWHActivity($current_data->inbound_planning_no);
            $current_data_detail = $this->getInboundPlanningDetail($id);
            
            if (count($current_data_wh_activity) > 0) {
                foreach ($current_data_wh_activity as $key_data_wh_activity => $value_data_wh_activity) {
                    $get_scan_qty = DB::query()
                    ->select([
                        "a.SKU",
                        "a.batch_no",
                        "b.qty_scan",
                        "b.stock_id",
                    ])
                    ->from("t_wh_inbound_planning_detail AS a")
                    ->leftJoin("t_wh_scan_qty AS b",function ($query)
                    {
                        $query->on("b.sku","=","a.SKU");
                        $query->on("b.batch_no","=","a.batch_no");
                    })
                    ->where("a.inbound_planning_no",$id)
                    ->where("b.activity_id",$value_data_wh_activity->activity_id)
                    ->get();
                    
                    if(count($get_scan_qty) > 0){
                        foreach ($get_scan_qty as $key_scan_qty => $value_scan_qty) {
                            $sku = $value_scan_qty->SKU;
                            $stock_id = $value_scan_qty->stock_id;
                            $qty_scan = $value_scan_qty->qty_scan;
                            if(!array_key_exists($sku."|".$stock_id,$temp_data_t_wh_inbound_planning_detail)){
                                $temp_data_t_wh_inbound_planning_detail[$sku."|".$stock_id] = 0;
                            }
                            $temp_data_t_wh_inbound_planning_detail[$sku."|".$stock_id] += $qty_scan;
                        }
                    }
                }
            }
            // ambil total qty scan dari t_wh_scan_qty end
            
            // insert t_wh_inbound_detail start
            if(count($temp_data_t_wh_inbound_planning_detail) > 0 ){
                foreach( $temp_data_t_wh_inbound_planning_detail as $key_temp_data_t_wh_inbound_planning_detail => $value_temp_data_t_wh_inbound_planning_detail){
                    foreach ($current_data_detail as $key_current_data_detail => $value_current_data_detail) {
                        $arr_temp_t_wh_inbound_planning_detail = explode("|",$key_temp_data_t_wh_inbound_planning_detail);
                        $temp_sku = $arr_temp_t_wh_inbound_planning_detail[0];
                        $temp_stock_id = $arr_temp_t_wh_inbound_planning_detail[1];
                        $target_sku = $value_current_data_detail->SKU;
                        if($temp_sku == $target_sku){
                            $qty_receive = $value_temp_data_t_wh_inbound_planning_detail;
                            $discrepancy = $value_current_data_detail->qty - $qty_receive;
                            DB::table("t_wh_inbound_detail")
                            ->insert([
                                "inbound_planning_no" => $value_current_data_detail->inbound_planning_no,
                                "SKU" => $value_current_data_detail->SKU,
                                "item_name" => $value_current_data_detail->item_name,
                                "batch_no" => $value_current_data_detail->batch_no,
                                "serial_no" => $value_current_data_detail->serial_no,
                                "imei" => $value_current_data_detail->imei,
                                "part_no" => $value_current_data_detail->part_no,
                                "color" => $value_current_data_detail->color,
                                "size" => $value_current_data_detail->size,
                                "expired_date" => $value_current_data_detail->expired_date,
                                "qty" => $qty_receive,
                                "discrepancy" => $discrepancy,
                                "uom_name" => $value_current_data_detail->uom_name,
                                "stock_id" => $temp_stock_id,
                                "clasification_id" => $value_current_data_detail->clasification_id,
                                "spv_id" => session("username"),
                                "user_updated" => session("username"),
                                "datetime_updated" => $this->datetime_now,
                            ]);
                        }
                    }
                }
            }
            // insert t_wh_inbound_detail end

            // update status_id start
            DB::table("t_wh_inbound_planning")
            ->where("inbound_planning_no",$current_data->inbound_planning_no)
            ->update([
                "status_id" => $data_status_id_receive,
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
            ]);
            // update status_id end

            //insert t_wh_receive start
            $get_all_data_inbound_planning = DB::query()
            ->select([
                "a.inbound_planning_no",
            ])
            ->from("t_wh_inbound_planning as a")
            ->where("a.inbound_planning_no",$current_data->inbound_planning_no)
            ->limit(1)
            ->get();
            if(count($get_all_data_inbound_planning) > 0){
                foreach ($get_all_data_inbound_planning as $key_data_inbound_planning => $value_data_inbound_planning) {
                    $inbound_planning_no = $value_data_inbound_planning->inbound_planning_no;
                    $temp_gr_id = explode("-",$inbound_planning_no);
                    $temp_gr_id[1] = "GR";
                    $gr_id = "";
                    
                    foreach ($temp_gr_id as $key_temp_gr_id => $value_temp_gr_id) {
                        $gr_id .= $value_temp_gr_id;
                        if(count($temp_gr_id) > ($key_temp_gr_id + 1)){
                            $gr_id .= "-";
                        }
                    }

                    DB::table("t_wh_receive")
                    ->insert([
                        "inbound_planning_no" => $inbound_planning_no,
                        "gr_id" => $gr_id,
                        "status_id" => $gr_status_id,
                        "user_created" => session("username"),
                        "datetime_created" => $this->datetime_now,
                    ]);

                }
            }
            //insert t_wh_receive end

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
            "message" => "Success Update Inbound Planning No",
            "data" => [],
        ],200);
    }

    private function getDataTallySheet($inbound_planning_no )
    {
        $data = DB::query()
        ->select([
            "c.pallet_id",
            "c.sku",
            "c.part_name AS item_name",
            "a.batch_no",
            "a.serial_no",
            "a.imei",
            "a.part_no",
            "a.color",
            "a.size",
            "a.expired_date",
            "a.qty AS qty_receive",
            "a.uom_name",
            "d.qty AS qty_plan",
            "e.stock_type",
            "f.classification_name",
        ])
        ->from("t_wh_inbound_detail as a")
        ->leftJoin("t_wh_activity as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("t_wh_scan_qty as c",function ($query)
        {
            $query->on("c.activity_id","=","b.activity_id");
            $query->on("c.sku","=","a.SKU");
        })
        ->leftJoin("t_wh_inbound_planning_detail as d",function ($query)
        {
            $query->on("d.inbound_planning_no","=","a.inbound_planning_no");
            $query->on("d.SKU","=","a.SKU");
        })
        ->leftJoin("m_wh_stock_type as e","e.stock_id","=","c.stock_id")
        ->leftJoin("m_item_classification as f","f.item_classification_id","=","d.clasification_id")
        ->where("a.inbound_planning_no",$inbound_planning_no)
        ->whereNotNull("c.scan_id")
        ->orderBy("d.datetime_created","DESC")
        ->get();

        return $data;
    }

    public function viewPDFTallySheet(Request $request, $id)
    {
        $check_Inbound_Planning = $this->getInboundPlanning($id);
        if(count($check_Inbound_Planning) == 0){
            echo "<script>
            alert('Inbound Planning doesnt exist');
            window.location.href = '".route('inbound_planning.index')."'
            </script>";
            return;
        }
        
        $current_data = $check_Inbound_Planning[0];

        $data = [];

        $data["data_header"] = DB::select("SELECT a.inbound_planning_no, date(a.datetime_created) AS date_of_receipt, a.reference_no, c.client_id, c.client_name
        FROM t_wh_inbound_planning a
        LEFT JOIN m_wh_client_project b ON b.client_project_id=a.client_project_id
        LEFT JOIN m_wh_client c ON b.client_id=c.client_id
        WHERE a.inbound_planning_no = ?
        AND a.client_project_id = ?
        ",[
            $current_data->inbound_planning_no,
            session("current_client_project_id"),
        ]);

        $data["data_vehicle"] = DB::select("SELECT b.vehicle_no, c.vehicle_type, b.container_no, b.seal_no, b.arrival_date, b.departure_date, b.start_unloading, b.finish_unloading
        FROM t_wh_activity a
        LEFT JOIN t_wh_transportation b ON a.activity_id=b.activity_id
        LEFT JOIN m_wh_vehicle c ON b.vehicle_id=c.vehicle_id
        WHERE a.inbound_planning_no = ?
        ",[
            $current_data->inbound_planning_no,
        ]);

        $data["data_actual_receiving"] = DB::select("SELECT a.sku, a.item_name, a.batch_no, a.expired_date, b.qty AS qty_plan, a.qty AS qty_receive, (b.qty-a.qty) AS discrepancy, a.uom_name
        FROM t_wh_inbound_detail a
        LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no AND a.sku=b.sku AND a.batch_no=b.batch_no AND a.serial_no=b.serial_no
        WHERE a.inbound_planning_no = ?
        GROUP BY a.sku
        ",[
            $current_data->inbound_planning_no,
        ]);

        $data["data_receiving_status"] = DB::select("SELECT a.sku, a.item_name, a.batch_no, a.expired_date, a.qty AS qty_receive, a.stock_id, a.uom_name, c.classification_name
        FROM t_wh_inbound_detail a
        LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no AND a.sku=b.sku AND a.batch_no=b.batch_no AND a.serial_no=b.serial_no
        LEFT JOIN m_item_classification c ON a.clasification_id=c.item_classification_id
        WHERE a.inbound_planning_no = ?
        GROUP BY a.sku, a.stock_id        
        ",[
            $current_data->inbound_planning_no,
        ]);
        // dd($data);
        $pdf = Pdf::loadView('inbound-planning.pdf_tally_sheet', compact('data'))->setPaper('a4', 'potrait');
        return $pdf->stream($current_data->inbound_planning_no."_tally_sheet.pdf");
    }

    
}
