<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use Yajra\DataTables\Facades\DataTables;

class GoodsReceivingController extends Controller
{
    private $menu_id = 12;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            "index",
            "datatables",
            "viewExcel",
            "show",
            "printGRN",
            "datatablesTargetUserAssign",
            "datatablesDestLocation",
            "printPutaway",
        ]);

        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
        ]);

        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            "processGoodReceive",
            "showMovementLocation",
            "processAssignWarehouseman",
            "processReceiveDetail",
            "confirmPutaway",
        ]);

        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([
        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("goods-receiving.index",compact("data"));
    }

    private function getGoodReceiveDatatables()
    {
        $data = DB::query()
        ->select([
            "a.inbound_planning_no",
            "a.gr_id",
            "c.wh_code",
            "d.client_project_name",
            "b.reference_no",
            "a.datetime_created",
            "e.order_type",
            "f.status_name",
        ])
        ->from("t_wh_receive as a")
        ->leftJoin("t_wh_inbound_planning as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("m_warehouse as c","c.wh_id","=","b.wh_id")
        ->leftJoin("m_wh_client_project as d","d.client_project_id","=","b.client_project_id")
        ->leftJoin("m_wh_order_type as e","e.order_id","=","b.order_id")
        ->leftJoin("m_status as f","f.status_id","=","a.status_id")
        ->where("b.client_project_id",session('current_client_project_id'))
        ->orderBy("a.datetime_created","DESC")
        ->get();
        return $data;
    }

    public function datatables(Request $request)
    {
        $data = $this->getGoodReceiveDatatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($goods_receiving) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('goods_receiving.show',[ 'id'=> $goods_receiving->gr_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 py-1'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    public function viewExcel()
    {

        $spreadsheet = new Spreadsheet(); 
        $spreadsheet->getProperties()
        ->setCreator(config('app.name'))
        ->setLastModifiedBy(config('app.name'))
        ->setTitle("Goods Receiving Excel")
        ->setSubject("Goods Receiving Excel")
        ->setDescription("Goods Receiving Excel")
        ->setKeywords("office 2007 openxml php");
        $spreadsheet->getActiveSheet()->setTitle('Goods_Receiving_Excel');
        $row = 1;

        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A'.$row, "Inbound Planning No")
        ->setCellValue('B'.$row, "GR ID")
        ->setCellValue('C'.$row, "Warehouse Code")
        ->setCellValue('D'.$row, "Client Project Name")
        ->setCellValue('E'.$row, "Reference No")
        ->setCellValue('F'.$row, "Receive Date")
        ->setCellValue('G'.$row, "Order Type")
        ->setCellValue('H'.$row, "GR Status")
        ;
        $row++;

        $data = $this->getGoodReceiveDatatables();
        if(count($data) > 0){
            foreach ($data as $key_data => $value_data) {
                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.$row, $value_data->inbound_planning_no)
                ->setCellValue('B'.$row, $value_data->gr_id)
                ->setCellValue('C'.$row, $value_data->wh_code)
                ->setCellValue('D'.$row, $value_data->client_project_name)
                ->setCellValue('E'.$row, $value_data->reference_no)
                ->setCellValue('F'.$row, $value_data->datetime_created)
                ->setCellValue('G'.$row, $value_data->order_type)
                ->setCellValue('H'.$row, $value_data->status_name)
                ;
                $row++;
            }

        }

        $filename = "Goods_Receiving_Excel_".date("YmdHis",strtotime($this->datetime_now));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $objWriter->save('php://output');
        exit();
    }

    private function getDataGoodsReceiving($gr_id = false)
    {
        $data = DB::query()
        ->select([
            "a.gr_id",
            "a.inbound_planning_no",
            "b.reference_no",
            "b.receipt_no",
            "c.order_id",
            "c.order_type",
            "a.datetime_created AS gr_date",
            "d.supplier_name",
            "d.address1",
            "e.client_project_name",
            "f.wh_code",
            "a.status_id",
            "b.remarks",
            "g.client_name",
        ])
        ->from("t_wh_receive as a")
        ->leftJoin("t_wh_inbound_planning as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("m_wh_order_type as c","c.order_id","=","b.order_id")
        ->leftJoin("m_wh_supplier as d","d.supplier_id","=","b.supplier_id")
        ->leftJoin("m_wh_client_project as e","e.client_project_id","=","b.client_project_id")
        ->leftJoin("m_warehouse as f","f.wh_id","=","b.wh_id")
        ->leftJoin("m_wh_client as g","g.client_id","=","e.client_id")
        ->where(function ($query) use($gr_id)
        {
            if($gr_id !== false){
                $query->where("a.gr_id",$gr_id);
            }
        })
        ->orderBy("a.datetime_created","DESC")
        ->get();

        return $data;
    }

    private function getGoodReceiveDetails($gr_id = false)
    {
        $data = DB::query()
        ->select([
            "a.sku",
            "a.item_name",
            "a.batch_no",
            "a.serial_no",
            "a.imei",
            "a.part_no",
            "a.color",
            "a.size",
            // "a.expired_date",
            DB::raw("cast(a.expired_date AS DATE) AS expired_date"),
            "b.qty AS qty_receive",
            "a.qty AS qty_plan",
            "a.uom_name",
            "a.clasification_id",
            "c.classification_name",
        ])
        ->from("t_wh_inbound_planning_detail as a")
        ->leftJoin("t_wh_inbound_detail as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("m_item_classification as c","c.item_classification_id","=","a.clasification_id")
        ->leftJoin("t_wh_inbound_planning as d","d.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("t_wh_receive as e","e.inbound_planning_no","=","a.inbound_planning_no")
        ->where(function ($query) use($gr_id)
        {
            if($gr_id !== false){
                $query->where("e.gr_id",$gr_id);
            }
        })
        ->groupBy("a.sku")
        ->get();
        return $data;
    }

    private function getWHActivity($gr_id)
    {
        $data = DB::query()
        ->select([
            "a.checker",
            "a.supervisor_id",
            DB::raw("CAST(b.arrival_date AS DATE) AS arrival_date"),
            DB::raw("CAST(b.start_unloading AS DATE) AS start_unloading"),
            DB::raw("CAST(b.finish_unloading AS date) AS finish_unloading"),
            DB::raw("CAST(b.departure_date AS DATE) AS departure_date"),
            "b.vehicle_no",
            "b.driver_name",
            "c.vehicle_type",
            "b.container_no",
            "b.seal_no",
        ])
        ->from("t_wh_activity as a")
        ->leftJoin("t_wh_transportation as b","b.activity_id","=","a.activity_id")
        ->leftJoin("m_wh_vehicle as c","c.vehicle_id","=","b.vehicle_id")
        ->leftJoin("t_wh_receive as d","d.inbound_planning_no","=","a.inbound_planning_no")
        ->where("d.gr_id", $gr_id)
        ->get();
        return $data;
    }
    
    public function show(Request $request,$id)
    {
        $getDataGoodsReceiving = $this->getDataGoodsReceiving($id);
        if(count($getDataGoodsReceiving) == 0){
            echo "<script>
            alert('Goods Receiving doesnt exist');
            window.location.href = '".route('goods_receiving.index')."'
            </script>";
            exit();

        }
        $current_data = $getDataGoodsReceiving[0];
        $current_data_detail = $this->getGoodReceiveDetails($current_data->gr_id);
        $current_data_wh_activity = $this->getWHActivity($current_data->gr_id);

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_detail"] = $current_data_detail;
        $data["current_data_wh_activity"] = $current_data_wh_activity;

        // dd($data);
        return view("goods-receiving.show",compact("data")); 
    }

    public function processGoodReceive(Request $request,$id)
    {
        $getDataGoodsReceiving = $this->getDataGoodsReceiving($id);
        if(count($getDataGoodsReceiving) == 0){
            return response()->json([
                "err" => true,
                "message" => "Goods Receiving doesnt exist, please Reload Page",
                "data" => [],
            ],200);

        }
        
        $current_data = $getDataGoodsReceiving[0];
        
        if($current_data->status_id != "OGR"){
            return response()->json([
                "err" => true,
                "message" => "Goods Receiving is not Open, please Reload Page",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {

            DB::table("t_wh_inbound_planning")
            ->where("inbound_planning_no",$current_data->inbound_planning_no)
            ->update([
                "status_id" => "FIN",
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
            ]);

            DB::table("t_wh_receive")
            ->where("gr_id",$id)
            ->update([
                "status_id" => "RGR",
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
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
            "message" => "Success Good Receive",
            "data" => [],
        ],200);
    }

    public function printGRN(Request $request, $id)
    {
        $getDataGoodsReceiving = $this->getDataGoodsReceiving($id);
        if(count($getDataGoodsReceiving) == 0){
            echo "<script>
            alert('Goods Receiving doesnt exist');
            window.location.href = '".route('goods_receiving.index')."'
            </script>";
            exit();

        }
        $current_data = $getDataGoodsReceiving[0];
        $current_data_detail = $this->getGoodReceiveDetails($current_data->gr_id);
        $current_data_wh_activity = $this->getWHActivity($current_data->gr_id);

        if($current_data->status_id != "RGR"){
            echo "<script>
            alert('Goods Receiving is not Received, please Reload Page');
            window.location.href = '".route('goods_receiving.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_detail"] = $current_data_detail;
        $data["current_data_wh_activity"] = $current_data_wh_activity;


        $pdf = Pdf::loadView('goods-receiving.pdf_grn', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream($data["current_data"]->gr_id.".pdf");
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
        ->whereIn("b.user_level_id",["2","3"])
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

    private function getDestLocation($location_code = false)
    {
        $data = DB::query()
        ->select([
            "a.location_code AS dest_location_id",
            "c.type_name AS dest_location_type",
        ])
        ->from("m_wh_location as a")
        ->leftJoin("m_wh_client_project as b","b.wh_id","=","a.wh_id")
        ->leftJoin("m_wh_location_type as c","c.type_name","=","a.location_type")
        ->where("b.client_project_id", session("current_client_project_id"))
        ->where(function ($query) use($location_code)
        {
            if($location_code !== false){
                $query->where("a.location_code",$location_code);
            }
        })
        ->get();
        return $data;
    }

    public function datatablesDestLocation()
    {
        $data = $this->getDestLocation();
        return DataTables::of($data)
        ->make(true);
    }

    public function showMovementLocation(Request $request, $id)
    {
        $getDataGoodsReceiving = $this->getDataGoodsReceiving($id);
        if(count($getDataGoodsReceiving) == 0){
            echo "<script>
            alert('Goods Receiving doesnt exist');
            window.location.href = '".route('goods_receiving.index')."'
            </script>";
            exit();

        }
        $current_data = $getDataGoodsReceiving[0];

        if($current_data->status_id != "RGR"){
            echo "<script>
            alert('Goods Receiving is not Received, please Reload Page');
            window.location.href = '".route('goods_receiving.index')."'
            </script>";
            exit();
        }

        $current_data_header = DB::query()
        ->select([
            "a.gr_id",
            "b.reference_no",
            "c.movement_id",
            "c.datetime_created AS movement_date",
        ])
        ->from("t_wh_receive as a")
        ->leftJoin("t_wh_inbound_planning as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("t_wh_receive_detail as c","c.gr_id","=","a.gr_id")
        ->where("a.gr_id",$current_data->gr_id)
        ->get();

        $current_data_detail = DB::query()
        ->select([
            "a.sku",
            "a.item_name",
            "a.batch_no",
            "a.expired_date",
            "d.qty",
            "a.uom_name",
            "d.location_to AS dest_location_id",
            "d.location_type_to AS dest_location_type",
            "a.stock_id",
            "d.warehouseman",
        ])
        ->from("t_wh_inbound_detail as a")
        ->leftJoin("t_wh_receive as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("t_wh_receive_detail as c","c.gr_id","=","b.gr_id")
        ->leftJoin("t_wh_temporary_movement as d",function ($query)
        {
            $query->on("d.movement_id","=","c.movement_id");
            $query->on("d.sku","=","a.SKU");
            $query->on("d.stock_id","=","a.stock_id");
        })
        ->where("b.gr_id",$current_data->gr_id)
        ->orderBy("a.sku","ASC")
        ->get();

        $current_data_wh_activity_warehouseman = $data = DB::query()
        ->select([
            "a.checker",
            "a.supervisor_id",
            DB::raw("CAST(a.datetime_est_start AS DATE) AS start_date"),
            DB::raw("CAST(a.datetime_est_start AS TIME) AS start_time"),
            DB::raw("CAST(a.datetime_est_finish AS DATE) AS finish_date"),
            DB::raw("CAST(a.datetime_est_finish AS TIME) AS finish_time"),
        ])
        ->from("t_wh_activity as a")
        ->where("a.gr_id", $current_data->gr_id)
        ->get();

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_header"] = $current_data_header;
        $data["current_data_detail"] = $current_data_detail;
        $data["current_data_wh_activity_warehouseman"] = $current_data_wh_activity_warehouseman;

        return view("goods-receiving.movement-location.index",compact("data")); 

    }

    public function processAssignWarehouseman(Request $request, $id)
    {
        $getDataGoodsReceiving = $this->getDataGoodsReceiving($id);
        if(count($getDataGoodsReceiving) == 0){
            return response()->json([
                "err" => true,
                "message" => "Good Receive doesnt exist",
                "data" => [],
            ],200);
        }
        $current_data = $getDataGoodsReceiving[0];

        if(!in_array($current_data->status_id , [ "RGR" ])){ //m_status 1 = 'Unreceived' 
            return response()->json([
                "err" => true,
                "message" => "Good Receive status is not Fully Received , Please Reload the page.",
                "data" => [],
            ],200);
        }    
        
        $arr_warehouseman_username = json_decode($request->input("arr_warehouseman_username"),true);
        $arr_warehouseman_date_start = json_decode($request->input("arr_warehouseman_date_start"),true);
        $arr_warehouseman_time_start = json_decode($request->input("arr_warehouseman_time_start"),true);
        $arr_warehouseman_date_finish = json_decode($request->input("arr_warehouseman_date_finish"),true);
        $arr_warehouseman_time_finish = json_decode($request->input("arr_warehouseman_time_finish"),true);

        if(
            $arr_warehouseman_username == null ||
            $arr_warehouseman_date_start == null ||
            $arr_warehouseman_time_start == null ||
            $arr_warehouseman_date_finish == null ||
            $arr_warehouseman_time_finish == null 
        ){
            return response()->json([
                "err" => true,
                "message" => "Assign To warehouseman data is required.",
                "data" => [],
            ],200);
        }

        $data_error = [];

        foreach ($arr_warehouseman_username as $key_warehouseman_username => $value_warehouseman_username) {
            $id_warehouseman_username = isset($value_warehouseman_username['id']) ? $value_warehouseman_username['id'] : null ;
            $value = isset($value_warehouseman_username['value']) ? $value_warehouseman_username['value'] : null ;
            if(empty($value)){
                $data_error[$id_warehouseman_username][] = "Username is required";
            }
        }
        
        foreach ($arr_warehouseman_date_start as $key_warehouseman_date_start => $value_warehouseman_date_start) {
            $id_warehouseman_date_start = isset($value_warehouseman_date_start['id']) ? $value_warehouseman_date_start['id'] : null ;
            $value = isset($value_warehouseman_date_start['value']) ? $value_warehouseman_date_start['value'] : null ;
            if(empty($value)){
                $data_error[$id_warehouseman_date_start][] = "Date Start is required";
            }
        }
        
        foreach ($arr_warehouseman_time_start as $key_warehouseman_time_start => $value_warehouseman_time_start) {
            $id_warehouseman_time_start = isset($value_warehouseman_time_start['id']) ? $value_warehouseman_time_start['id'] : null ;
            $value = isset($value_warehouseman_time_start['value']) ? $value_warehouseman_time_start['value'] : null ;
            if(empty($value)){
                $data_error[$id_warehouseman_time_start][] = "Time Start is required";
            }
        }
        
        foreach ($arr_warehouseman_date_finish as $key_warehouseman_date_finish => $value_warehouseman_date_finish) {
            $id_warehouseman_date_finish = isset($value_warehouseman_date_finish['id']) ? $value_warehouseman_date_finish['id'] : null ;
            $value = isset($value_warehouseman_date_finish['value']) ? $value_warehouseman_date_finish['value'] : null ;
            if(empty($value)){
                $data_error[$id_warehouseman_date_finish][] = "Date Finish is required";
            }
        }
        
        foreach ($arr_warehouseman_time_finish as $key_warehouseman_time_finish => $value_warehouseman_time_finish) {
            $id_warehouseman_time_finish = isset($value_warehouseman_time_finish['id']) ? $value_warehouseman_time_finish['id'] : null ;
            $value = isset($value_warehouseman_time_finish['value']) ? $value_warehouseman_time_finish['value'] : null ;
            if(empty($value)){
                $data_error[$id_warehouseman_time_finish][] = "Time Finish is required";
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
            "arr_warehouseman_username" => $arr_warehouseman_username,
            "arr_warehouseman_date_start" => $arr_warehouseman_date_start,
            "arr_warehouseman_time_start" => $arr_warehouseman_time_start,
            "arr_warehouseman_date_finish" => $arr_warehouseman_date_finish,
            "arr_warehouseman_time_finish" => $arr_warehouseman_time_finish,
        ];
        DB::beginTransaction();
        try {

            $max_count_username = count($validated["arr_warehouseman_username"]);
            $data_t_wh_activity = [];
            for ($i=0; $i < $max_count_username ; $i++) { 
                $temp_datetime_est_start = date("Y-m-d H:i:s",strtotime($validated["arr_warehouseman_date_start"][$i]["value"]." ".$validated["arr_warehouseman_time_start"][$i]["value"]));
                $temp_datetime_est_finish = date("Y-m-d H:i:s",strtotime($validated["arr_warehouseman_date_finish"][$i]["value"]." ".$validated["arr_warehouseman_time_finish"][$i]["value"]));
                $data_t_wh_activity[] = [
                    "process_id" => 13,
                    "gr_id" => $current_data->gr_id,
                    "reference_no" => $current_data->reference_no,
                    "checker" => $validated["arr_warehouseman_username"][$i]["value"],
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
            "message" => "Success Assign Warehouseman.",
            "data" => [],
        ],200);
    }

    private function getProcessCodeByOrderID($order_id)
    {
        if(empty($order_id)){
            return false;
        }else if($order_id == 1){
            return "01";
        }else if($order_id == 2){
            return "02";
        }else if($order_id == 3){
            return "03";
        }
    }
    private function getProcessIDByOrderID($order_id)
    {
        if(empty($order_id)){
            return false;
        }else if($order_id == 1){
            return 1;
        }else if($order_id == 2){
            return 2;
        }else if($order_id == 3){
            return 3;
        }
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

    private function mustFourDigits($data)
    {
        while (strlen($data) < 4) {
            $data = "0".$data;
        }
        return $data;
    }

    private function getListSKUByGR($gr_id,$sku = false)
    {
        $data = DB::query()
        ->select([
            "a.sku",
            "a.item_name",
            "a.batch_no",
            "a.expired_date",
            "a.uom_name",
            "a.qty",
            "a.stock_id",
        ])
        ->from("t_wh_inbound_detail as a")
        ->leftJoin("t_wh_receive as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("t_wh_receive_detail as c","c.gr_id","=","b.gr_id")
        ->where("b.gr_id",$gr_id)
        ->where(function ($query) use($sku)
        {
            if($sku !== false){
                $query->where("a.sku",$sku);
            }
        })
        ->orderBy("a.sku","ASC")
        ->get();
        return $data;
    }

    public function datatablesListSKUByGR(Request $request , $id)
    {
        // DB::enableQueryLog();
        $data = $this->getListSKUByGR($id);
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
        ->make(true);
    }

    public function processReceiveDetail(Request $request, $id)
    {
        $getDataGoodsReceiving = $this->getDataGoodsReceiving($id);
        if(count($getDataGoodsReceiving) == 0){
            return response()->json([
                "err" => true,
                "message" => "Goods Receive doesnt exist",
                "data" => [],
            ],200);
        }
        $current_data = $getDataGoodsReceiving[0];

        if(!in_array($current_data->status_id , [ "RGR" ])){ //m_status 1 = 'Unreceived' 
            return response()->json([
                "err" => true,
                "message" => "Goods Receive status is not Fully Received , Please Reload the page.",
                "data" => [],
            ],200);
        } 

        $qty_left_each_sku = [];
        $getListSKUByGR = $this->getListSKUByGR($id);
        if(count($getListSKUByGR) > 0){
            foreach ($getListSKUByGR as $key_sku_by_gr => $value_sku_by_gr) {
                $qty_left_each_sku[$value_sku_by_gr->sku."|".$value_sku_by_gr->stock_id] = $value_sku_by_gr->qty;
            }
        }

        $exists_sku_and_location = [];
        $movement_location_id = $request->input("movement_location_id");
        $arr_sku = json_decode($request->input("arr_sku"),true);
        $arr_dest_location_id = json_decode($request->input("arr_dest_location_id"),true);
        $arr_dest_location_type = json_decode($request->input("arr_dest_location_type"),true);
        $arr_item_name = json_decode($request->input("arr_item_name"),true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"),true);
        $arr_expired_date = json_decode($request->input("arr_expired_date"),true);
        $arr_qty = json_decode($request->input("arr_qty"),true);
        $arr_uom = json_decode($request->input("arr_uom"),true);
        $arr_stock_id = json_decode($request->input("arr_stock_id"),true);
        $arr_warehouseman_assigned = json_decode($request->input("arr_warehouseman_assigned"),true);

        $data_error = [];

        if(
            count($arr_sku) == 0 ||
            count($arr_dest_location_id) == 0 ||
            count($arr_dest_location_type) == 0 ||
            count($arr_warehouseman_assigned) == 0 
        ){
            return response()->json([
                "err" => true,
                "message" => "Putaway Detail cant be empty",
                "data" => [],
            ],200);
        }
        
        foreach ($arr_stock_id as $key_stock_id => $value_stock_id) {

            $id_stock_id = isset($value_stock_id['id']) ? $value_stock_id['id'] : null ;
            $value = isset($value_stock_id['value']) ? $value_stock_id['value'] : null ;
            if(empty($value)){
                $data_error[$id_stock_id][] = "Stock ID is required";
            }
        }

        foreach ($arr_sku as $key_sku => $value_sku) {
            $id_sku = isset($value_sku['id']) ? $value_sku['id'] : null ;
            $value = isset($value_sku['value']) ? $value_sku['value'] : null ;
            if(empty($value)){
                $data_error[$id_sku][] = "SKU is required";
            }else{
                $checkSKU = $this->getListSKUByGR($id,$value);
                if(count($checkSKU) == 0){
                    $data_error[$id_sku][] = "SKU is not exist with current GR ID";
                }
            }
        }

        foreach ($arr_qty as $key_qty => $value_qty) {
            $id_sku = isset($arr_sku[$key_qty]['id']) ? $arr_sku[$key_qty]['id'] : null ;
            $value_sku = isset($arr_sku[$key_qty]['value']) ? $arr_sku[$key_qty]['value'] : null ;
            $id_stock_id = isset($arr_stock_id[$key_qty]['id']) ? $arr_stock_id[$key_qty]['id'] : null ;
            $value_stock_id = isset($arr_stock_id[$key_qty]['value']) ? $arr_stock_id[$key_qty]['value'] : null ;

            $id_qty = isset($value_qty['id']) ? $value_qty['id'] : null ;
            $value = isset($value_qty['value']) ? $value_qty['value'] : null ;
            if(empty($value)){
                $data_error[$id_qty][] = "Qty is required";
            }else{
                if(!empty($value_stock_id)){
                    $qty_left_each_sku[$value_sku."|".$value_stock_id] = $qty_left_each_sku[$value_sku."|".$value_stock_id] - $value;
                }
            }
        }

        foreach ($arr_dest_location_id as $key_dest_location_id => $value_dest_location_id) {
            $id_sku = isset($arr_sku[$key_dest_location_id]['id']) ? $arr_sku[$key_dest_location_id]['id'] : null ;
            $value_sku = isset($arr_sku[$key_dest_location_id]['value']) ? $arr_sku[$key_dest_location_id]['value'] : null ;

            $id_dest_location_id = isset($value_dest_location_id['id']) ? $value_dest_location_id['id'] : null ;
            $value = isset($value_dest_location_id['value']) ? $value_dest_location_id['value'] : null ;
            if(empty($value)){
                $data_error[$id_dest_location_id][] = "Dest Location ID is required";
            }else{
                if(array_key_exists($value_sku."|".$value,$exists_sku_and_location)){
                    $data_error[$exists_sku_and_location[$value_sku."|".$value]][] = "Dest Location ID and SKU already used in other row";
                    $data_error[$id_dest_location_id][] = "Dest Location ID and SKU already used in other row";
                }
                $exists_sku_and_location[$value_sku."|".$value] = $id_dest_location_id;
            }
        }

        foreach ($arr_dest_location_type as $key_dest_location_type => $value_dest_location_type) {
            $id_dest_location_type = isset($value_dest_location_type['id']) ? $value_dest_location_type['id'] : null ;
            $value = isset($value_dest_location_type['value']) ? $value_dest_location_type['value'] : null ;
            if(empty($value)){
                $data_error[$id_dest_location_type][] = "Dest Location Type is required";
            }
        }

        foreach ($arr_warehouseman_assigned as $key_warehouseman_assigned => $value_warehouseman_assigned) {
            $id_warehouseman_assigned = isset($value_warehouseman_assigned['id']) ? $value_warehouseman_assigned['id'] : null ;
            $value = isset($value_warehouseman_assigned['value']) ? $value_warehouseman_assigned['value'] : null ;
            if(empty($value)){
                $data_error[$id_warehouseman_assigned][] = "Warehouseman is required";
            }
        }
        
       

        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }

        $still_left_sku = false;
        foreach ($qty_left_each_sku as $key_qty_left_each_sku => $value_qty_left_each_sku) {
            if($value_qty_left_each_sku != 0){
                $still_left_sku = true;
            }
        }

        if($still_left_sku){
            $message = "Qty is not balance \n";
            foreach ($qty_left_each_sku as $key_qty_left_each_sku => $value_qty_left_each_sku) {
                if($value_qty_left_each_sku != 0){
                    $arr_key_qty_left_each_sku = explode("|",$key_qty_left_each_sku);
                    $message .= "SKU ".@$arr_key_qty_left_each_sku[0]." | Stock ID ".@$arr_key_qty_left_each_sku[1]." : ".$value_qty_left_each_sku."\n";
                }
            }
            return response()->json([
                "err" => true,
                "message" => $message,
                "data" => [],
            ],200);
        }

        $validated = [
            "arr_sku" => $arr_sku,
            "arr_dest_location_id" => $arr_dest_location_id,
            "arr_dest_location_type" => $arr_dest_location_type,
            "arr_item_name" => $arr_item_name,
            "arr_batch_no" => $arr_batch_no,
            "arr_expired_date" => $arr_expired_date,
            "arr_qty" => $arr_qty,
            "arr_uom" => $arr_uom,
            "arr_stock_id" => $arr_stock_id,
            "arr_warehouseman_assigned" => $arr_warehouseman_assigned,
            "movement_location_id" => $movement_location_id,
        ];

        DB::beginTransaction();
        try {
            if(!empty($validated["movement_location_id"])){
                $process_id = $this->getProcessIDByOrderID($current_data->order_id);
                $checkMovementID = DB::query()
                ->select("movement_id")
                ->from("t_wh_receive_detail")
                ->where("movement_id",$validated["movement_location_id"])
                ->get();
                if(count($checkMovementID) == 0){
                    return response()->json([
                        "err" => true,
                        "message" => "Movement Location ID is not exist, please reload page.",
                        "data" => [],
                    ],200);
                }
                DB::table("t_wh_temporary_movement")
                ->where("movement_id",$validated["movement_location_id"])
                ->delete();

                $max_count_sku =  count($validated["arr_sku"]);
                for ($i=0; $i < $max_count_sku ; $i++) { 
                    $data_t_wh_temporary_movement = [
                        "movement_id" => $validated["movement_location_id"],
                        "process_id" => $process_id,
                        "sku" => $validated["arr_sku"][$i]["value"],
                        "part_name" => $validated["arr_item_name"][$i]["value"],
                        "batch_no" => $validated["arr_batch_no"][$i]["value"],
                        "qty" => $validated["arr_qty"][$i]["value"],
                        "uom_name" => $validated["arr_uom"][$i]["value"],
                        "location_from" => "Staging Area",
                        "location_type_from" => "Bulk",
                        "location_to" => $validated["arr_dest_location_id"][$i]["value"],
                        "location_type_to" => $validated["arr_dest_location_type"][$i]["value"],
                        "stock_id" => $validated["arr_stock_id"][$i]["value"],
                        "warehouseman" =>  $validated["arr_warehouseman_assigned"][$i]["value"],
                        "user_created" =>  session("username"),
                        "datetime_created" => $this->datetime_now,
                    ];
                    if(!empty($validated["arr_expired_date"][$i]["value"])){
                        $data_t_wh_temporary_movement["expired_date"] = $validated["arr_expired_date"][$i]["value"];
                    }

                    DB::table("t_wh_temporary_movement")
                    ->insert($data_t_wh_temporary_movement);
                }
            }else{
                $process_code = $this->getProcessCodeByOrderID($current_data->order_id);
                $process_id = $this->getProcessIDByOrderID($current_data->order_id);
                $wh_prefix = $this->getWHPrefix();
                $date_format_inbound_planning = date("my",strtotime($this->datetime_now));
                $current_running_number = $this->getLastRunningNumber($process_code) + 1;
                $running_number = $this->mustFourDigits($current_running_number);
                $movement_id = $wh_prefix."-".$process_code."-".$date_format_inbound_planning."-".$running_number;
                
                if($current_running_number > 9999){
                    DB::rollBack();
                    return response()->json([
                        "err" => true,
                        "message" => "Running Number is more than 9999, cant create more.",
                        "data" => [],
                    ],200);
                }
                
                $this->updateRunningNumber($current_running_number,$process_code);
                DB::table("t_wh_receive_detail")
                ->insert([
                    "gr_id" => $current_data->gr_id,
                    "movement_id" => $movement_id,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);
                
                $max_count_sku =  count($validated["arr_sku"]);
                for ($i=0; $i < $max_count_sku ; $i++) { 
                    $data_t_wh_temporary_movement = [
                        "movement_id" => $movement_id,
                        "process_id" => $process_id,
                        "sku" => $validated["arr_sku"][$i]["value"],
                        "part_name" => $validated["arr_item_name"][$i]["value"],
                        "batch_no" => $validated["arr_batch_no"][$i]["value"],
                        "qty" => $validated["arr_qty"][$i]["value"],
                        "uom_name" => $validated["arr_uom"][$i]["value"],
                        "location_from" => "Staging Area",
                        "location_type_from" => "Bulk",
                        "location_to" => $validated["arr_dest_location_id"][$i]["value"],
                        "location_type_to" => $validated["arr_dest_location_type"][$i]["value"],
                        "stock_id" => $validated["arr_stock_id"][$i]["value"],
                        "warehouseman" =>  $validated["arr_warehouseman_assigned"][$i]["value"],
                        "user_created" =>  session("username"),
                        "datetime_created" => $this->datetime_now,
                    ];
                    if(!empty($validated["arr_expired_date"][$i]["value"])){
                        $data_t_wh_temporary_movement["expired_date"] = $validated["arr_expired_date"][$i]["value"];
                    }

                    DB::table("t_wh_temporary_movement")
                    ->insert($data_t_wh_temporary_movement);
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
            "message" => "Success Putaway Location.",
            "data" => [],
        ],200);
    }

    public function printPutaway(Request $request, $id)
    {
        $getDataGoodsReceiving = $this->getDataGoodsReceiving($id);
        if(count($getDataGoodsReceiving) == 0){
            echo "<script>
            alert('Good Receive doesnt exist');
            window.close();
            </script>";
            return;
        }
        $current_data = $getDataGoodsReceiving[0];

        if(!in_array($current_data->status_id , [ "RGR" ])){ //m_status 1 = 'Unreceived' 
            echo "<script>
            alert('Good Receive status is not Fully Received , Please Reload the page.');
            window.close();
            </script>";
            return;
        }  

        $username_input = $request->input('username');

        if(empty($username_input)){
            echo "<script>
            alert('Username is required');
            window.close();
            </script>";
            return;
        }

        $current_data_header = DB::query()
        ->select([
            "a.gr_id",
            "b.reference_no",
            "c.movement_id",
            "c.datetime_created AS movement_date",
        ])
        ->from("t_wh_receive as a")
        ->leftJoin("t_wh_inbound_planning as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("t_wh_receive_detail as c","c.gr_id","=","a.gr_id")
        ->where("a.gr_id",$current_data->gr_id)
        ->get();

        $current_data_detail = DB::query()
        ->select([
            "a.sku",
            "a.item_name",
            "a.batch_no",
            "a.serial_no",
            "d.qty",
            "a.uom_name",
            "a.stock_id",
            "d.location_to AS dest_location_id" ,
            "d.location_type_to AS dest_location_type" ,
            "d.warehouseman" ,
        ])
        ->from("t_wh_inbound_detail as a")
        ->leftJoin("t_wh_receive as b","b.inbound_planning_no","=","a.inbound_planning_no")
        ->leftJoin("t_wh_receive_detail as c","c.gr_id","=","b.gr_id")
        ->leftJoin("t_wh_temporary_movement as d",function ($query)
        {
            $query->on("d.movement_id","=","c.movement_id");
            $query->on("d.sku","=","a.SKU");
            $query->on("d.stock_id","=","a.stock_id");
        })
        ->where("b.gr_id",$current_data->gr_id)
        ->where("d.warehouseman",$username_input)
        ->orderBy("a.sku","ASC")
        ->get();

        $current_data_wh_activity_warehouseman = $data = DB::query()
        ->select([
            "a.checker",
            "a.supervisor_id",
            DB::raw("CAST(a.datetime_est_start AS DATE) AS start_date"),
            DB::raw("CAST(a.datetime_est_start AS TIME) AS start_time"),
            DB::raw("CAST(a.datetime_est_finish AS DATE) AS finish_date"),
            DB::raw("CAST(a.datetime_est_finish AS TIME) AS finish_time"),
        ])
        ->from("t_wh_activity as a")
        ->where("a.gr_id", $current_data->gr_id)
        ->get();

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_header"] = $current_data_header;
        $data["current_data_detail"] = $current_data_detail;
        $data["current_data_wh_activity_warehouseman"] = $current_data_wh_activity_warehouseman;

        // RGR
        $pdf = Pdf::loadView('goods-receiving.movement-location.pdf_putaway', compact('data'));
        return $pdf->stream($data["current_data"]->inbound_planning_no.".pdf");
    }

    public function confirmPutaway(Request $request, $id)
    {
        $getDataGoodsReceiving = $this->getDataGoodsReceiving($id);
        if(count($getDataGoodsReceiving) == 0){
            return response()->json([
                "err" => true,
                "message" => "Goods Receiving doesnt exist, please Reload Page",
                "data" => [],
            ],200);

        }
        
        $current_data = $getDataGoodsReceiving[0];
        
        if($current_data->status_id != "RGR"){
            return response()->json([
                "err" => true,
                "message" => "Goods Receiving is not Fully Received, please Reload Page",
                "data" => [],
            ],200);
        }

        try {
            $current_data_detail = DB::query()
            ->select([
                "c.movement_id",
                "d.process_id",
                "d.sku",
                "d.part_name",
                "d.batch_no",
                "d.serial_no",
                "a.imei",
                "a.part_no",
                "a.color",
                "a.size",
                "d.expired_date",
                ".clasification_id",
                "d.qty",
                "d.uom_name",
                "d.stock_id",
                "d.location_from",
                "d.location_type_from",
                "d.location_to",
                "d.location_type_to",
            ])
            ->from("t_wh_inbound_detail as a")
            ->leftJoin("t_wh_receive as b","b.inbound_planning_no","=","a.inbound_planning_no")
            ->leftJoin("t_wh_receive_detail as c","c.gr_id","=","b.gr_id")
            ->leftJoin("t_wh_temporary_movement as d",function ($query)
            {
                $query->on("d.movement_id","=","c.movement_id");
                $query->on("d.sku","=","a.SKU");
                $query->on("d.stock_id","=","a.stock_id");
            })
            ->where("b.gr_id",$current_data->gr_id)
            ->orderBy("a.sku","ASC")
            ->get();

            if(count($current_data_detail) == 0){
                return response()->json([
                    "err" => true,
                    "message" => "Detail Putaway is not exist",
                    "data" => [],
                ],200);
            }

            $get_t_wh_temporary_movement = DB::select("SELECT a.movement_id,
            a.process_id,
            a.sku,
            a.part_name,
            a.batch_no,
            a.serial_no,
            a.expired_date,
            a.qty,
            a.uom_name,
            a.stock_id,
            a.location_from,
            a.location_type_from,
            a.location_to,
            a.location_type_to
            FROM t_wh_temporary_movement a
            LEFT JOIN t_wh_receive_detail b ON b.movement_id=a.movement_id
            WHERE b.gr_id = ?
            ",[
                $current_data->gr_id
            ]);

            $data_t_wh_movement_detail = [];

            foreach ($get_t_wh_temporary_movement as $key_get_t_wh_temporary_movement => $value_get_t_wh_temporary_movement) {
                $data_t_wh_movement_detail[] = [
                    "movement_id" => $value_get_t_wh_temporary_movement->movement_id,
                    "process_id" => $value_get_t_wh_temporary_movement->process_id,
                    "sku" => $value_get_t_wh_temporary_movement->sku,
                    "part_name" => $value_get_t_wh_temporary_movement->part_name,
                    "batch_no" => $value_get_t_wh_temporary_movement->batch_no,
                    "serial_no" => $value_get_t_wh_temporary_movement->serial_no,
                    "expired_date" => $value_get_t_wh_temporary_movement->expired_date,
                    "qty" => $value_get_t_wh_temporary_movement->qty,
                    "uom_name" => $value_get_t_wh_temporary_movement->uom_name,
                    "stock_id" => $value_get_t_wh_temporary_movement->stock_id,
                    "location_from" => $value_get_t_wh_temporary_movement->location_from,
                    "location_type_from" => $value_get_t_wh_temporary_movement->location_type_from,
                    "location_to" => $value_get_t_wh_temporary_movement->location_to,
                    "location_type_to" => $value_get_t_wh_temporary_movement->location_type_to,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];
            }

            DB::table("t_wh_movement_detail")->insert($data_t_wh_movement_detail);

            $get_t_wh_movement_detail = DB::select("SELECT a.location_to,
            a.location_type_to,
            a.pallet_id_to,
            a.sku,
            a.part_name,
            d.batch_no,
            d.serial_no,
            d.imei,
            d.part_no,
            d.color,
            d.size,
            a.expired_date,
            d.clasification_id,
            a.qty AS on_hand_qty,
            a.qty AS available_qty,
            a.uom_name,
            a.stock_id,
            c.gr_id,
            a.movement_id
            FROM t_wh_movement_detail a
            LEFT JOIN t_wh_receive_detail b ON b.movement_id=a.movement_id
            LEFT JOIN t_wh_receive c ON c.gr_id=b.gr_id
            LEFT JOIN t_wh_inbound_planning_detail d ON c.inbound_planning_no=d.inbound_planning_no AND a.sku=d.sku
            WHERE c.gr_id = ?
            ",[
                $current_data->gr_id
            ]);

            $data_t_wh_location_inventory = [];

            foreach ($get_t_wh_movement_detail as $key_get_t_wh_movement_detail => $value_get_t_wh_movement_detail) {
                $data_t_wh_location_inventory[] = [
                    "location_id" => $value_get_t_wh_movement_detail->location_to,
                    "location_type" => $value_get_t_wh_movement_detail->location_type_to,
                    "client_project_id" => session("current_client_project_id"),
                    "pallet_id" => $value_get_t_wh_movement_detail->pallet_id_to,
                    "sku" => $value_get_t_wh_movement_detail->sku,
                    "part_name" => $value_get_t_wh_movement_detail->part_name,
                    "batch_no" => $value_get_t_wh_movement_detail->batch_no, 
                    "serial_no" => $value_get_t_wh_movement_detail->serial_no,
                    "imei" => $value_get_t_wh_movement_detail->imei,
                    "part_no" => $value_get_t_wh_movement_detail->part_no,
                    "color" => $value_get_t_wh_movement_detail->color,
                    "size" => $value_get_t_wh_movement_detail->size,
                    "expired_date" => $value_get_t_wh_movement_detail->expired_date,
                    "clasification_id" => $value_get_t_wh_movement_detail->clasification_id,
                    "on_hand_qty" => $value_get_t_wh_movement_detail->on_hand_qty,
                    "available_qty" => $value_get_t_wh_movement_detail->available_qty,
                    "uom_name" => $value_get_t_wh_movement_detail->uom_name,
                    "stock_id" => $value_get_t_wh_movement_detail->stock_id,
                    "gr_id" => $value_get_t_wh_movement_detail->gr_id,
                    "gr_datetime" => $this->datetime_now,
                    "last_movement_id" => $value_get_t_wh_movement_detail->movement_id,

                ];
            }

            DB::table("t_wh_location_inventory")->insert($data_t_wh_location_inventory);

            DB::table("t_wh_receive")
            ->where("gr_id",$current_data->gr_id)
            ->update([
                "status_id" => "CGR",
                "user_updated" =>  session("username"),
                "datetime_updated" => $this->datetime_now,
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
            "message" => "Success Confirm Putaway.",
            "data" => [],
        ],200);

    }

    private function getTargetWarehousemanAssign($id)
    {
        $data = DB::query()
        ->select([
            "a.checker",
        ])
        ->from("t_wh_activity as a")
        ->where("gr_id",$id)
        ->get();
        return $data;
    }

    public function datatablesTargetWarehousemanAssign(Request $request,$id)
    {
        // DB::enableQueryLog();
        $data = $this->getTargetWarehousemanAssign($id);
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
        ->make(true);
    }
}
