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

class StockCountController extends Controller
{
    private $menu_id = 21;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'datatablesStockCountID',
            'datatables',
            'datatablesCountStatus',
            'datatablesRemark',
            'viewExcel',
            'show',
            'viewPDF',
            'getDataItemDetail',
            'checkCountNo',
            'checkConfirm',
            'processConfirmCount',
        ]);
        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
            'create',
            'store',
            'datatablesCriteriaSKU',
            'datatablesCriteriaBatchNo',
            'datatablesCriteriaLocation',
            'getCriteriaApply',
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            'datatablesTargetUserAssign',
            'getTargetLocation',
            'processAssignCounter',
            'processSuggestLocation',
            'viewManualCount',
            'processManualCount',
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([
        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("stock-count.index", compact('data'));
    }

    public function datatablesStockCountID()
    {
        $data = DB::query()
        ->select("stock_count_id")
        ->from("t_wh_stock_count")
        ->where("client_project_id",session("current_client_project_id"))
        ->get();

        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesCountStatus()
    {
        $data = DB::query()
        ->select([
            "status_id",
            "status_name",
        ])
        ->from("m_status")
        ->where("is_active","Y")
        ->where("process_id","8")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesRemark()
    {
        $data = DB::query()
        ->select([
            "type_code",
            "type_name",
        ])
        ->from("m_wh_stock_count_type")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function get_List_Stock_Count($stock_count_id = false,$count_date_from = false,$count_date_to = false,$count_status = false,$remark = false)
    {
        $data = DB::query()
        ->select([
            "a.stock_count_id",
            "b.client_project_name",
            "c.wh_code",
            "a.count_date",
            "a.count_no",
            "d.status_name",
        ])
        ->from("t_wh_stock_count as a")
        ->leftJoin("m_wh_client_project as b","a.client_project_id","=","b.client_project_id")
        ->leftJoin("m_warehouse as c","a.wh_id","=","c.wh_id")
        ->leftJoin("m_status as d","a.status_id","=","d.status_id")
        ->where("a.client_project_id",session("current_client_project_id"))
        ->where(function ($query) use($stock_count_id)
        {
            if(!empty($stock_count_id)){
                $query->where("a.stock_count_id",$stock_count_id);
            }
        })
        ->where(function ($query) use($count_status)
        {
            if(!empty($count_status)){
                $query->where("d.status_id",$count_status);
            }
        })
        ->where(function ($query) use($remark)
        {
            if(!empty($remark)){
                $query->where("a.stock_count_type",$remark);
            }
        })
        ->where(function ($query) use($count_date_from,$count_date_to)
        {
            if(!empty($count_date_from) && !empty($count_date_to)){
                $query->whereBetween(DB::raw("CAST(a.count_date AS DATE)"),[$count_date_from, $count_date_to]);
            }
        })
        ->orderBy("a.datetime_created","DESC")
        ->get();

        return $data;
    }
    public function datatables(Request $request)
    {
        $stock_count_id = $request->input("stock_count_id");
        $count_date_from = $request->input("count_date_from");
        $count_date_to = $request->input("count_date_to");
        $client_id = $request->input("client_id");
        $warehouse_id = $request->input("warehouse_id");
        $count_status = $request->input("count_status");
        $remark = $request->input("remark");

        $data = $this->get_List_Stock_Count($stock_count_id,$count_date_from,$count_date_to,$count_status,$remark);
        
        return DataTables::of($data)
        ->addColumn('action', function ($stock_count) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('stock_count.show',[ 'id'=> $stock_count->stock_count_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 text-xs py-1'>Show</button>
            </a>";
            
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    public function viewExcel(Request $request)
    {
        $data = DB::select("SELECT 
        a.stock_count_id,
        b.client_project_name,
        c.wh_code,
        e.location_id,
        e.sku,
        e.item_name,
        e.batch_no,
        e.serial_no,
        e.stock_id,
        e.count_qty,
        e.discrepancy,
        a.count_date,
        a.count_no,
        d.status_name
        FROM t_wh_stock_count AS a
        LEFT JOIN m_wh_client_project AS b ON a.client_project_id = b.client_project_id
        LEFT JOIN m_warehouse AS c ON a.wh_id = c.wh_id
        LEFT JOIN m_status AS d ON a.status_id = d.status_id
        LEFT JOIN t_wh_stock_count_detail e ON a.stock_count_id=e.stock_count_id AND a.count_no=e.count_no
        WHERE a.client_project_id = ?
        ORDER BY a.datetime_created DESC
        ",[
            session("current_client_project_id"),
        ]);

        $spreadsheet = new Spreadsheet(); 
        $spreadsheet->getProperties()
        ->setCreator(config('app.name'))
        ->setLastModifiedBy(config('app.name'))
        ->setTitle("Stock Count Excel")
        ->setSubject("Stock Count Excel")
        ->setDescription("Stock Count Excel")
        ->setKeywords("office 2007 openxml php");
        $spreadsheet->getActiveSheet()->setTitle('Stock_Count');
        $row = 1;
        $row_alphabet = "A";
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Stock Count Id");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Client Id");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Warehouse Id");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Location Id");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "SKU");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Item Name");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Batch No");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Serial No");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Stock Type");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Count Qty");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Discrepancy");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Count Date");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Count No");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, "Status");
        $row_alphabet++;
        $row++;


        if(count($data) > 0){
            foreach ($data as $key_data => $value_data) {
                $row_alphabet = "A";
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->stock_count_id);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->client_project_name);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->wh_code);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->location_id);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->sku);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->item_name);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->batch_no);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->serial_no);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->stock_id);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->count_qty);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->discrepancy);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->count_date);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->count_no);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, @$value_data->status_name);
                $row_alphabet++;
                $row++;
            }

        }

        $filename = "Stock_Count_".date("YmdHis",strtotime($this->datetime_now));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $objWriter->save('php://output');
        exit();
    }

    private function get_Data_Stock_Count_Header($stock_count_id)
    {
        $data = DB::query()
        ->select([
            "a.stock_count_id",
            "b.client_project_name",
            "c.wh_code",
            "a.count_date",
            "e.type_name AS remark",
            "a.count_no",
            "a.stock_count_type",
            "a.status_id",
        ])
        ->from("t_wh_stock_count as a")
        ->leftJoin("m_wh_client_project as b","a.client_project_id","=","b.client_project_id")
        ->leftJoin("m_warehouse as c","a.wh_id","=","c.wh_id")
        ->leftJoin("m_status as d","a.status_id","=","d.status_id")
        ->leftJoin("m_wh_stock_count_type as e","a.stock_count_type","=","e.type_code")
        ->where("a.client_project_id",session("current_client_project_id"))
        ->where("a.stock_count_id",$stock_count_id)
        ->get();
        return $data;
    }

    private function get_Data_Stock_Count_Detail($stock_count_id,$count_no = false, $counter = false)
    {
        $data = DB::query()
        ->select([
            "a.location_id",
            "a.sku",
            "a.item_name",
            "a.batch_no",
            "a.serial_no",
            "a.on_hand_qty",
            "a.count_qty",
            "a.discrepancy",
            "a.percentage",
            "a.uom_name",
            "a.counter",
            "a.count_status",
            "a.gr_id",
            "a.stock_id",
            "a.count_no",
        ])
        ->from("t_wh_stock_count_detail as a")
        ->leftJoin("t_wh_location_inventory as b",function ($query)
        {
            $query->on("a.location_id","=","b.location_id");
            $query->on("a.sku","=","b.sku");
            $query->on("a.serial_no","=","b.serial_no");
            $query->on("a.batch_no","=","b.batch_no");
            $query->on("a.stock_id","=","b.stock_id");
        })
        ->where("a.stock_count_id",$stock_count_id)
        ->where(function ($query) use($count_no)
        {
            if(!empty($count_no)){
                $query->where("a.count_no",$count_no);
            }
        })
        ->where(function ($query) use($counter)
        {
            if(!empty($counter)){
                $query->where("a.counter",$counter);
            }
        })
        ->get();
        return $data;

    }

    private function get_Count_No_List()
    {
        return [
            "Count 1",
            "Count 2",
            "Count 3",
        ];
    }

    public function getDataItemDetail(Request $request, $id)
    {
        $count_no = $request->input("count_no");

        $data = $this->get_Data_Stock_Count_Detail($id, $count_no, false);

        return response()->json([
            "err" => false,
            "message" => "Success getDataItemDetail",
            "data" => $data,
        ],200);
    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Data_Stock_Count_Header($id);
        $count_no_list = $this->get_Count_No_List();
        $count_location_id = count($this->get_T_WH_Stock_Count_Detail($id));

        $data = [];
        $data["current_data"] = $current_data;
        $data["count_no_list"] = $count_no_list;
        $data["count_location_id"] = $count_location_id;

        return view('stock-count.show',compact('data'));
    }

    public function create()
    {
        return view("stock-count.create");
    }

    public function datatablesCriteriaSKU()
    {
        $data = DB::query()
        ->select([
            "sku",
            "part_name",
        ])
        ->from("t_wh_location_inventory")
        ->where("client_project_id",session("current_client_project_id"))
        ->groupBy("sku")
        ->orderBy("sku","ASC")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesCriteriaBatchNo(Request $request)
    {
        $criteria_sku = $request->input("criteria_sku");
        $data = DB::query()
        ->select([
            "sku",
            "part_name",
            "batch_no",
            "stock_id",
            "location_type",
        ])
        ->from("t_wh_location_inventory")
        ->where("client_project_id",session("current_client_project_id"))
        ->where(function ($query) use($criteria_sku)
        {
            if(!empty($criteria_sku)){
                $query->where("sku",$criteria_sku);
            }
        })
        ->groupBy("sku")
        ->orderBy("sku","ASC")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesCriteriaLocation(Request $request)
    {
        $criteria_sku = $request->input("criteria_sku");
        $data = DB::query()
        ->select([
            "location_id",
        ])
        ->from("t_wh_location_inventory")
        ->where("client_project_id",session("current_client_project_id"))
        ->where(function ($query) use($criteria_sku)
        {
            if(!empty($criteria_sku)){
                $query->where("sku",$criteria_sku);
            }
        })
        ->groupBy("location_id")
        ->orderBy("location_id","ASC")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function getCriteriaApply(Request $request)
    {
        $criteria_sku = $request->input("criteria_sku");
        $criteria_batch_no = $request->input("criteria_batch_no");
        $criteria_stock_id = $request->input("criteria_stock_id");
        $criteria_location_type = $request->input("criteria_location_type");
        $criteria_location_id_from = $request->input("criteria_location_id_from");
        $criteria_location_id_to = $request->input("criteria_location_id_to");

        $data = DB::query()
        ->select([
            "location_id",
            "sku",
            "part_name",
            "batch_no",
            "serial_no",
            "imei",
            "part_no",
            "color",
            "size",
            "expired_date",
            "on_hand_qty",
            "uom_name",
            "stock_id",
            "gr_id",
        ])
        ->from("t_wh_location_inventory")
        ->where(function($query) use($criteria_sku)
        {
            if(!empty($criteria_sku)){
                $query->where("sku",$criteria_sku);
            }
        })
        ->where(function($query) use($criteria_batch_no)
        {
            if(!empty($criteria_batch_no)){
                $query->where("batch_no",$criteria_batch_no);
            }
        })
        ->where(function($query) use($criteria_stock_id)
        {
            if(!empty($criteria_stock_id)){
                $query->where("stock_id",$criteria_stock_id);
            }
        })
        ->where(function($query) use($criteria_location_type)
        {
            if(!empty($criteria_location_type)){
                $query->where("location_type",$criteria_location_type);
            }
        })
        ->where(function($query) use($criteria_location_id_from,$criteria_location_id_to)
        {
            if(!empty($criteria_location_id_from) && !empty($criteria_location_id_to)){
                $query->whereBetween("location_id",[$criteria_location_id_from,$criteria_location_id_to]);
            }
        })
        ->get();

        return response()->json([
            "err" => false,
            "message" => "Success getCriteriaApply",
            "data" => $data,
        ],200);
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

    private function mustFourDigits($data)
    {
        while (strlen($data) < 4) {
            $data = "0".$data;
        }
        return $data;
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
        $count_date = $request->input("count_date");
        $remark = $request->input("remark");
        $arr_location_id = json_decode($request->input("arr_location_id"),true);
        $arr_sku_no = json_decode($request->input("arr_sku_no"),true);
        $arr_item_name = json_decode($request->input("arr_item_name"),true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"),true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"),true);
        $arr_imei = json_decode($request->input("arr_imei"),true);
        $arr_part_no = json_decode($request->input("arr_part_no"),true);
        $arr_color = json_decode($request->input("arr_color"),true);
        $arr_size = json_decode($request->input("arr_size"),true);
        $arr_expired_date = json_decode($request->input("arr_expired_date"),true);
        $arr_on_hand_qty = json_decode($request->input("arr_on_hand_qty"),true);
        $arr_uom = json_decode($request->input("arr_uom"),true);
        $arr_stock_id = json_decode($request->input("arr_stock_id"),true);
        $arr_gr_id = json_decode($request->input("arr_gr_id"),true);
        $count_no = "Count 1";
        $wh_id = session("current_warehouse_id");

        $data_error = [];

        if(empty($count_date)){
            $data_error["count_date"][] = "Count Date Required";
        }

        if(empty($remark)){
            $data_error["remark"][] = "Remark Required";
        }

        if(
            count($arr_location_id) == 0 ||
            count($arr_sku_no) == 0 ||
            count($arr_item_name) == 0 ||
            count($arr_batch_no) == 0 ||
            count($arr_serial_no) == 0 ||
            count($arr_imei) == 0 ||
            count($arr_part_no) == 0 ||
            count($arr_color) == 0 ||
            count($arr_size) == 0 ||
            count($arr_expired_date) == 0 ||
            count($arr_on_hand_qty) == 0 ||
            count($arr_uom) == 0 ||
            count($arr_stock_id) == 0 ||
            count($arr_gr_id) == 0
        ){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details Required.",
                "data" => $data_error,
            ],200);
        }
        $arr_item_details_exists = [];
        $max_item_details = count($arr_location_id);
        for ($i=0; $i < $max_item_details; $i++) { 
            $value_location_id = $arr_location_id[$i]["value"];
            $id_location_id = $arr_location_id[$i]["id"];
            $value_sku_no = $arr_sku_no[$i]["value"];
            $id_sku_no = $arr_sku_no[$i]["id"];
            $value_item_name = $arr_item_name[$i]["value"];
            $id_item_name = $arr_item_name[$i]["id"];
            $value_batch_no = $arr_batch_no[$i]["value"];
            $id_batch_no = $arr_batch_no[$i]["id"];
            $value_serial_no = $arr_serial_no[$i]["value"];
            $id_serial_no = $arr_serial_no[$i]["id"];
            $value_imei = $arr_imei[$i]["value"];
            $id_imei = $arr_imei[$i]["id"];
            $value_part_no = $arr_part_no[$i]["value"];
            $id_part_no = $arr_part_no[$i]["id"];
            $value_color = $arr_color[$i]["value"];
            $id_color = $arr_color[$i]["id"];
            $value_size = $arr_size[$i]["value"];
            $id_size = $arr_size[$i]["id"];
            $value_expired_date = $arr_expired_date[$i]["value"];
            $id_expired_date = $arr_expired_date[$i]["id"];
            $value_on_hand_qty = $arr_on_hand_qty[$i]["value"];
            $id_on_hand_qty = $arr_on_hand_qty[$i]["id"];
            $value_uom = $arr_uom[$i]["value"];
            $id_uom = $arr_uom[$i]["id"];
            $value_stock_id = $arr_stock_id[$i]["value"];
            $id_stock_id = $arr_stock_id[$i]["id"];
            $value_gr_id = $arr_gr_id[$i]["value"];
            $id_gr_id = $arr_gr_id[$i]["id"];

            $search = $value_location_id."|".$value_sku_no."|".$value_stock_id."|".$value_gr_id;
            if(in_array($search,$arr_item_details_exists)){
                $data_error[$id_location_id][] = "This row data already exists";
                $data_error[$id_sku_no][] = "This row data already exists";
                $data_error[$id_stock_id][] = "This row data already exists";
                $data_error[$id_gr_id][] = "This row data already exists";
            }

            $arr_item_details_exists[] = $search;
        }

        if(count($data_error) > 0 ){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }

        DB::beginTransaction();
        try {
            
            $status_id = "";

            if($remark == "DCC"){
                $status_id = "ODC";
            }else if($remark == "OPN"){
                $status_id = "OOP";
            }

            $process_code = $remark;
            $wh_prefix = $this->getWHPrefix();
            $date_format_stock_transfer = date("my",strtotime($this->datetime_now));
            $current_running_number = $this->getLastRunningNumber($process_code) + 1;
            $running_number = $this->mustFourDigits($current_running_number);
            $stock_count_id = $wh_prefix."-".$process_code."-".$date_format_stock_transfer."-".$running_number;
            if($current_running_number > 9999){
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Running Number is more than 9999, cant create more.",
                    "data" => [],
                ],200);
            }

            $this->updateRunningNumber($current_running_number,$process_code);

            DB::table("t_wh_stock_count")
            ->insert([
                "stock_count_id" => $stock_count_id,
                "client_project_id" => session("current_client_project_id"),
                "wh_id"=> $wh_id,
                "count_date" => $count_date,
                "count_no" => $count_no,
                "stock_count_type" => $remark,
                "status_id" => $status_id,
                "user_created" => session('username'),
                "datetime_created" => $this->datetime_now,
            ]);
            
            $valid_max_item_details = count($arr_location_id);
            for ($i=0; $i < $valid_max_item_details; $i++) { 
                $value_location_id = $arr_location_id[$i]["value"];
                $value_sku_no = $arr_sku_no[$i]["value"];
                $value_item_name = $arr_item_name[$i]["value"];
                $value_batch_no = $arr_batch_no[$i]["value"];
                $value_serial_no = $arr_serial_no[$i]["value"];
                $value_imei = $arr_imei[$i]["value"];
                $value_part_no = $arr_part_no[$i]["value"];
                $value_color = $arr_color[$i]["value"];
                $value_size = $arr_size[$i]["value"];
                $value_expired_date = $arr_expired_date[$i]["value"];
                $value_on_hand_qty = $arr_on_hand_qty[$i]["value"];
                $value_uom = $arr_uom[$i]["value"];
                $value_stock_id = $arr_stock_id[$i]["value"];
                $value_gr_id = $arr_gr_id[$i]["value"];

                $data_t_wh_stock_count_detail = [
                    "stock_count_id" => $stock_count_id,
                    "count_no" => $count_no,
                    "location_id" => $value_location_id,
                    "sku" => $value_sku_no,
                    "item_name" => $value_item_name,
                    "batch_no" => $value_batch_no,
                    "serial_no" => $value_serial_no,
                    "imei" => $value_imei,
                    "part_no" => $value_part_no,
                    "color" => $value_color,
                    "size" => $value_size,
                    "on_hand_qty" => $value_on_hand_qty,
                    "stock_id" => $value_stock_id,
                    "gr_id" => $value_gr_id,
                    "uom_name" => $value_uom,
                    "user_created" => session('username'),
                    "datetime_created" => $this->datetime_now,
                ];
                
                if(!empty($value_expired_date) && $value_expired_date != '0000-00-00'){
                    $data_t_wh_stock_count_detail["expired_date"] = $value_expired_date;
                }
                DB::table("t_wh_stock_count_detail")
                ->insert($data_t_wh_stock_count_detail);
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
            "message" => "Success Add Stock Count",
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

    private function get_Process_ID($process_code)
    {
        $data = DB::query()
        ->select([
            "process_id",
        ])
        ->from("m_process")
        ->where("process_code", $process_code)
        ->get();

        if(count($data) == 0){
            return "";
        }
        return $data[0]->process_id;
    }

    public function processAssignCounter(Request $request, $id)
    {
        $current_data = $this->get_Data_Stock_Count_Header($id);

        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Stock Count Header doesnt exists, please reload page.",
                "data" => [],
            ],200);
        }

        if(!in_array($current_data[0]->status_id,['OOP','ODC'])){
            return response()->json([
                "err" => true,
                "message" => "Stock Count cant be assigned, status_id is not OOP or ODC",
                "data" => [],
            ],200);
        }

        $arr_db_location_id = [];
        $arr_exist_location_id = [];
        $get_data_location = $this->get_T_WH_Stock_Count_Detail($id);

        if(count($get_data_location) > 0){
            foreach ($get_data_location as $key_get_data_location => $value_get_data_location) {
                $arr_db_location_id[] = $value_get_data_location->location_id;
            }
        }

        $arr_counter_username = json_decode($request->input("arr_counter_username"),true);
        $arr_counter_location_id = json_decode($request->input("arr_counter_location_id"),true);
        $arr_counter_date_start = json_decode($request->input("arr_counter_date_start"),true);
        $arr_counter_time_start = json_decode($request->input("arr_counter_time_start"),true);
        $arr_counter_date_finish = json_decode($request->input("arr_counter_date_finish"),true);
        $arr_counter_time_finish = json_decode($request->input("arr_counter_time_finish"),true);
        
        if(
            $arr_counter_username == null ||
            $arr_counter_location_id == null ||
            $arr_counter_date_start == null ||
            $arr_counter_time_start == null ||
            $arr_counter_date_finish == null ||
            $arr_counter_time_finish == null 
        ){
            return response()->json([
                "err" => true,
                "message" => "Assign To Counter data is required.",
                "data" => [],
            ],200);
        }

        $data_error = [];
        $max_data_counter = count($arr_counter_username);
        for ($i=0; $i < $max_data_counter; $i++) { 
            $value_arr_counter_username = $arr_counter_username[$i]["value"];
            $id_arr_counter_username = $arr_counter_username[$i]["id"];

            $value_arr_counter_location_id = $arr_counter_location_id[$i]["value"];
            $id_arr_counter_location_id = $arr_counter_location_id[$i]["id"];
            $value_arr_counter_date_start = $arr_counter_date_start[$i]["value"];
            $id_arr_counter_date_start = $arr_counter_date_start[$i]["id"];

            $value_arr_counter_time_start = $arr_counter_time_start[$i]["value"];
            $id_arr_counter_time_start = $arr_counter_time_start[$i]["id"];

            $value_arr_counter_date_finish = $arr_counter_date_finish[$i]["value"];
            $id_arr_counter_date_finish = $arr_counter_date_finish[$i]["id"];

            $value_arr_counter_time_finish = $arr_counter_time_finish[$i]["value"];
            $id_arr_counter_time_finish = $arr_counter_time_finish[$i]["id"];

            
            if(empty($value_arr_counter_username)){
                $data_error[$id_arr_counter_username][] = "Counter Username required";
            }
            if(empty($value_arr_counter_location_id)){
                $data_error[$id_arr_counter_location_id][] = "Counter Location ID required";
            }
            if(empty($value_arr_counter_date_start)){
                $data_error[$id_arr_counter_date_start][] = "Counter Date Start required";
            }
            if(empty($value_arr_counter_time_start)){
                $data_error[$id_arr_counter_time_start][] = "Counter Time Start required";
            }
            if(empty($value_arr_counter_date_finish)){
                $data_error[$id_arr_counter_date_finish][] = "Counter Date Finish required";
            }
            if(empty($value_arr_counter_time_finish)){
                $data_error[$id_arr_counter_time_finish][] = "Counter Time Finish required";
            }

            if(!empty($value_arr_counter_location_id)){
                $printed = false;
                $list_counter_location_id = json_decode($value_arr_counter_location_id,true);
                if(isset($list_counter_location_id['list']) && count($list_counter_location_id['list']) > 0){
                    foreach ($list_counter_location_id['list'] as $key_list => $value_list) {
                        if(in_array($value_list,$arr_exist_location_id)){
                            if(!$printed){
                                $data_error[$id_arr_counter_location_id][] = "Counter Location ID invalid";
                                $printed = true;
                            }
                        }

                        if(in_array($value_list,$arr_db_location_id) && ($key_delete = array_search($value_list, $arr_db_location_id)) !== false){
                            unset($arr_db_location_id[$key_delete]);
                        }

                        $arr_exist_location_id[] = $value_list;
                    }
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
        
        if(count($arr_db_location_id) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, some Location ID is not assigned",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {
            $process_id = $this->get_Process_ID(@$current_data[0]->stock_count_type);
            $max_valid_data_counter = count($arr_counter_username);
            for ($i=0; $i < $max_valid_data_counter; $i++) { 
                $value_arr_counter_username = $arr_counter_username[$i]["value"];
                $value_arr_counter_location_id = $arr_counter_location_id[$i]["value"];
                $value_arr_counter_date_start = $arr_counter_date_start[$i]["value"];
                $value_arr_counter_time_start = $arr_counter_time_start[$i]["value"];
                $value_arr_counter_date_finish = $arr_counter_date_finish[$i]["value"];
                $value_arr_counter_time_finish = $arr_counter_time_finish[$i]["value"];

                
                $temp_datetime_est_start = date("Y-m-d H:i:s",strtotime($value_arr_counter_date_start." ".$value_arr_counter_time_start));
                $temp_datetime_est_finish = date("Y-m-d H:i:s",strtotime($value_arr_counter_date_finish." ".$value_arr_counter_time_finish));
                
                $activity_id = DB::table("t_wh_activity")
                ->insertGetId([
                    "process_id" => $process_id,
                    "stock_count_id" => $current_data[0]->stock_count_id,
                    "count_no" => @$current_data[0]->count_no,
                    "checker" => $value_arr_counter_username,
                    "datetime_est_start" => $temp_datetime_est_start,
                    "datetime_est_finish" => $temp_datetime_est_finish,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);
                $arr_location_id = json_decode($value_arr_counter_location_id,true);
                if(isset($arr_location_id["list"]) && count($arr_location_id) > 0){
                    foreach ($arr_location_id["list"] as $key_list_location_id => $value_list_location_id) {
                        DB::table("t_wh_stock_count_detail")
                        ->where("stock_count_id",$current_data[0]->stock_count_id)
                        ->where("location_id",$value_list_location_id)
                        ->where("count_no",@$current_data[0]->count_no)
                        ->update([
                            "counter" => $value_arr_counter_username,
                            "user_created" => session("username"),
                            "datetime_created" => $this->datetime_now,
                        ]);
                    }
                }
            }

            $status_id_for_t_wh_stock_count = "";
            if($current_data[0]->stock_count_type == "DCC"){
                $status_id_for_t_wh_stock_count = "ADC";
            }else if($current_data[0]->stock_count_type == "OPN"){
                $status_id_for_t_wh_stock_count = "AOP";
            }

            DB::table("t_wh_stock_count")
            ->where("stock_count_id",$current_data[0]->stock_count_id)
            ->update([
                "status_id" => $status_id_for_t_wh_stock_count,
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
            "message" => "Success Assign Counter.",
            "data" => [],
        ],200);
    }

    public function viewPDF(Request $request, $id, $count_no)
    {
        $current_data = $this->get_Data_Stock_Count_Header($id);

        if(count($current_data) == 0){
            echo "<script>
            alert('Stock Count doesnt exist');
            window.location.href = '".route('stock_count.index')."'
            </script>";
            return;
        }

        if(empty($count_no)){
            echo "<script>
            alert('Count no cant be null');
            window.location.href = '".route('stock_count.index')."'
            </script>";
            return;
        }

        $current_detail = DB::query()
        ->select([
            "d.checker", 
            "a.location_id", 
            "a.sku", 
            "a.item_name", 
            "a.batch_no", 
            "a.serial_no", 
            "a.expired_date", 
            "b.on_hand_qty", 
            "b.uom_name",
            "d.datetime_start_counting",
            "d.datetime_finish_counting",
        ])
        ->from("t_wh_stock_count_detail as a")
        ->leftJoin("t_wh_location_inventory as b",function ($query)
        {
            $query->on("a.location_id","=","b.location_id");
            $query->on("a.sku","=","b.sku");
            $query->on("a.gr_id","=","a.gr_id");
            $query->on("a.batch_no","=","b.batch_no");
        })
        ->leftJoin("t_wh_stock_count as c","a.stock_count_id","=","c.stock_count_id")
        ->leftJoin("t_wh_activity as d",function ($query)
        {
            $query->on("c.stock_count_id","=",'d.stock_count_id');
            $query->on("a.count_no","=",'d.count_no');
        })
        ->where("a.stock_count_id",$id)
        ->where("a.count_no",$count_no)
        ->get();

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_detail"] = $current_detail;

        $pdf = Pdf::loadView('stock-count.pdf', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream($data["current_data"][0]->stock_count_id.".pdf");
    }

    public function viewManualCount(Request $request, $id, $count_no)
    {        
        $current_data = $this->get_Data_Stock_Count_Header($id);

        if(count($current_data) == 0){
            echo "<script>
            alert('Stock Count doesnt exist');
            window.location.href = '".route('stock_count.index')."'
            </script>";
            return;
        }

        if(!in_array($current_data[0]->status_id,['AOP','ADC'])){
            echo "<script>
            alert('Stock Count cant be manual count, status_id is not AOP or ADC');
            window.location.href = '".route('stock_count.show',["id" => $id])."'
            </script>";
            return;
        }

        $current_data_detail = $this->get_Data_Stock_Count_Detail($id,$count_no, session('username'));

        if(count($current_data_detail) == 0){
            echo "<script>
            alert('Stock Count detail doesnt exist');
            window.location.href = '".route('stock_count.show',["id" => $id])."'
            </script>";
            return;
        }

        $check_user = DB::select("SELECT a.activity_id 
        FROM t_wh_activity a
        LEFT JOIN t_wh_count_qty b ON a.activity_id=b.activity_id
        WHERE a.stock_count_id= ?
        AND a.count_no= ?
        AND a.checker= ? 
        ",[$id,$count_no,session('username')]);

        if(count($check_user) == 0){
            echo "<script>
            alert('you are not assigned to this stock count id');
            window.location.href = '".route('stock_count.show',["id" => $id])."'
            </script>";
            return;
        }

        $check_already_count = DB::select("SELECT b.* 
        FROM t_wh_count_qty a
        LEFT JOIN t_wh_activity b ON a.activity_id=b.activity_id
        WHERE b.stock_count_id= ?
        AND b.count_no= ?
        AND b.checker= ? 
        ",[$id,$count_no,session('username')]);

        if(count($check_already_count) > 0){
            echo "<script>
            alert('cant count more, only once.');
            window.location.href = '".route('stock_count.show',["id" => $id])."'
            </script>";
            return;
        }
        
        
        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_detail"] = $current_data_detail;

        return view("stock-count.manual_count",compact("data"));
    }

    private function get_T_WH_Stock_Count_Detail($id)
    {
        $data = DB::query()
        ->select([
            "location_id",
        ])
        ->distinct()
        ->from("t_wh_stock_count_detail")
        ->where("stock_count_id",$id)
        ->orderBy("location_id","ASC")
        ->get();
        return $data;
    }

    public function getTargetLocation(Request $request,$id)
    {
        $data = $this->get_T_WH_Stock_Count_Detail($id);

        return response()->json([
            "err" => false,
            "message" => "Success getTargetLocation",
            "data" => $data,
        ],200);
    }

    public function processSuggestLocation(Request $request, $id)
    {
        $arr_counter_username = json_decode($request->input("arr_counter_username"), true);

        if ($arr_counter_username == null) {
            return response()->json([
                "err" => true,
                "message" => "Counter Name must be atleast 1",
                "data" => [],
            ], 200);
        }

        if (count($arr_counter_username) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Counter Name must be atleast 1",
                "data" => [],
            ], 200);
        }

        $data_error = [];
        $exists_counter_username = [];

        $count_counter = count($arr_counter_username);
        for ($i = 0; $i < $count_counter; $i++) {
            $value_arr_counter_username = $arr_counter_username[$i]["value"];
            $id_arr_counter_username = $arr_counter_username[$i]["id"];

            if (empty($value_arr_counter_username)) {
                $data_error[$id_arr_counter_username][] = "Counter Username required";
            }
            
            if(in_array($value_arr_counter_username,$exists_counter_username)){
                $data_error[$id_arr_counter_username][] = "Counter Username already Exists in other row.";
            }

            $exists_counter_username[] = $value_arr_counter_username;
        }

        if (count($data_error) > 0) {
            return response()->json([
                "err" => true,
                "message" => "Suggest Location Failed.",
                "data" => $data_error,
            ], 200);
        }

        $arr_location_id = [];
        $get_location_id = DB::select("SELECT distinct location_id AS location_id
        FROM t_wh_stock_count_detail
        WHERE stock_count_id = ?
        ", [$id]);
        if(count($get_location_id) > 0){
            foreach ($get_location_id as $key_location_id => $value_location_id) {
                $arr_location_id[] = $value_location_id->location_id;
            }
        }

        if (count($arr_location_id) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Suggest Location Failed. Location ID is not exists",
                "data" => [],
            ], 200);
        }

        $get_total_location = DB::select("SELECT count(distinct location_id) AS total_location
        FROM t_wh_stock_count_detail
        WHERE stock_count_id = ?
        ", [$id]);

        $total_location = 0;
        if(count($get_total_location) > 0){
            $total_location = @$get_total_location[0]->total_location;
        }

        $get_location_per_checker = DB::select("SELECT ? DIV ? AS location_per_checker", [$total_location,$count_counter]);
        $location_per_checker = @$get_location_per_checker[0]->location_per_checker;

        $get_sisa_location = DB::select("SELECT ? MOD ? AS sisa_location", [$total_location,$count_counter]);
        $sisa_location = @$get_sisa_location[0]->sisa_location;

        //bikin array dengan key username dengan data array counter_name dan list_location_id, lalu dimasukkan location kedalam list_location_id dengan maksimal location_per_checker nya.
        $temp_suggest_location = [];
        for ($i = 0; $i < $count_counter; $i++) {
            $value_arr_counter_username = $arr_counter_username[$i]["value"];
            $id_arr_counter_username = $arr_counter_username[$i]["id"];
            if(!array_key_exists($value_arr_counter_username,$arr_counter_username)){
                $temp_suggest_location[$value_arr_counter_username] = [
                    "counter_name" => $value_arr_counter_username,
                    "list_location_id" => [],
                ];
            }

            $current_cursor = 0;
            foreach ($arr_location_id as $key_location_id => $value_location_id) {
                if($current_cursor > ($location_per_checker - 1)){
                    continue;
                }
                $temp_suggest_location[$value_arr_counter_username]["list_location_id"][] = $value_location_id;
                unset($arr_location_id[$key_location_id]);
                $current_cursor++;
            }
        }
        
        //bikin looping dibawah buat ngilangin key sebagai username yang diganti ke integer biasa supaya urutan nya sama dengan yang ada di UI.
        $arr_suggest_location = [];
        foreach ($temp_suggest_location as $key_temp_suggest_location => $value_temp_suggest_location) {
            $arr_suggest_location[] = $value_temp_suggest_location;
        }

        //kalo ada sisa nya masukin ke urutan username yang pertama
        if($sisa_location > 0 && count($arr_location_id) > 0){
            $current_cursor = 0;
            foreach ($arr_location_id as $key_location_id => $value_location_id) {
                if($current_cursor > $sisa_location){
                    continue;
                }
                $arr_suggest_location[0]["list_location_id"][] = $value_location_id;
                unset($arr_location_id[$key_location_id]);
                $current_cursor++;
            }
        }
        
        return response()->json([
            "err" => false,
            "message" => "Success Suggest Location",
            "data" => $arr_suggest_location,
        ], 200);
    }

    public function checkCountNo(Request $request, $id)
    {
        $count_no = $request->input('count_no');
        $count_data = DB::select("SELECT a.location_id, a.sku, a.item_name, a.batch_no, a.serial_no, a.on_hand_qty, a.count_qty, a.discrepancy, a.percentage, a.uom_name, a.counter, a.count_status, a.gr_id, a.stock_id, a.count_no
        FROM t_wh_stock_count_detail AS a
        LEFT JOIN t_wh_location_inventory AS b ON a.location_id = b.location_id AND a.sku = b.sku AND a.serial_no = b.serial_no AND a.batch_no = b.batch_no
        WHERE a.stock_count_id = ? AND (a.count_no = ? )
        ",[$id,$count_no]);
        $data = [];
        $data['exist'] = false;
        
        if(count($count_data) > 0){
            $data['exist'] = true;
        }

        $header = $this->get_Data_Stock_Count_Header($id);
        $data['status_id'] = "";
        if(count($header) > 0){
            $data['status_id'] = $header[0]->status_id;
        }

        return response()->json([
            "err" => false,
            "message" => "Success checkCountNo",
            "data" => $data,
        ], 200);
    }

    public function processManualCount(Request $request, $id, $count_no)
    {
        $current_data = $this->get_Data_Stock_Count_Header($id);

        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Stock Count doesnt exist. please reload page.",
                "data" => [],
            ], 200);
        }

        if(!in_array($current_data[0]->status_id,['AOP','ADC'])){
            return response()->json([
                "err" => true,
                "message" => "Count cant be manual count, status_id is not AOP or ADC. please reload page.",
                "data" => [],
            ], 200);
        }

        $current_data_detail = $this->get_Data_Stock_Count_Detail($id,$count_no, session('username'));

        if(count($current_data_detail) == 0){
            return response()->json([
                "err" => true,
                "message" => "Stock Count detail doesnt exist. please reload page.",
                "data" => [],
            ], 200);
        }

        $check_user = DB::select("SELECT a.activity_id 
        FROM t_wh_activity a
        LEFT JOIN t_wh_count_qty b ON a.activity_id=b.activity_id
        WHERE a.stock_count_id= ?
        AND a.count_no= ?
        AND a.checker= ? 
        ",[$id,$count_no,session('username')]);

        if(count($check_user) == 0){
            return response()->json([
                "err" => true,
                "message" => "you are not assigned to this stock count id. please reload page.",
                "data" => [],
            ], 200);
        }

        $check_already_count = DB::select("SELECT b.* 
        FROM t_wh_count_qty a
        LEFT JOIN t_wh_activity b ON a.activity_id=b.activity_id
        WHERE b.stock_count_id= ?
        AND b.count_no= ?
        AND b.checker= ? 
        ",[$id,$count_no,session('username')]);

        if(count($check_already_count) > 0){
            return response()->json([
                "err" => true,
                "message" => "cant count more, only once. please reload page.",
                "data" => [],
            ], 200);
        }

        $start_counting_date = $request->input("start_counting_date");
        $start_counting_time = $request->input("start_counting_time");
        $finish_counting_date = $request->input("finish_counting_date");
        $finish_counting_time = $request->input("finish_counting_time");

        $arr_location_id = json_decode($request->input("arr_location_id"),true);
        $arr_sku_no = json_decode($request->input("arr_sku_no"),true);
        $arr_item_name = json_decode($request->input("arr_item_name"),true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"),true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"),true);
        $arr_stock_on_hand_qty = json_decode($request->input("arr_stock_on_hand_qty"),true);
        $arr_count_qty = json_decode($request->input("arr_count_qty"),true);
        $arr_discrepancy = json_decode($request->input("arr_discrepancy"),true);
        $arr_percentage = json_decode($request->input("arr_percentage"),true);
        $arr_uom = json_decode($request->input("arr_uom"),true);
        $arr_counter = json_decode($request->input("arr_counter"),true);
        $arr_count_status = json_decode($request->input("arr_count_status"),true);
        $arr_gr_id = json_decode($request->input("arr_gr_id"),true);
        $arr_stock_id = json_decode($request->input("arr_stock_id"),true);

        $data_error = [];

        if(
            count($arr_location_id) == 0 ||
            count($arr_sku_no) == 0 ||
            count($arr_item_name) == 0 ||
            count($arr_batch_no) == 0 ||
            count($arr_serial_no) == 0 ||
            count($arr_stock_on_hand_qty) == 0 ||
            count($arr_count_qty) == 0 ||
            count($arr_discrepancy) == 0 ||
            count($arr_percentage) == 0 ||
            count($arr_uom) == 0 ||
            count($arr_counter) == 0 ||
            count($arr_count_status) == 0 ||
            count($arr_stock_id) == 0 ||
            count($arr_gr_id) == 0
        ){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details Required.",
                "data" => $data_error,
            ],200);
        }

        $max_row_validation = count($arr_location_id);
        for ($i=0; $i < $max_row_validation; $i++) { 
            $value_arr_location_id = $arr_location_id[$i]['value'];
            $id_arr_location_id = $arr_location_id[$i]['id'];
            $value_arr_sku_no = $arr_sku_no[$i]['value'];
            $id_arr_sku_no = $arr_sku_no[$i]['id'];
            $value_arr_item_name = $arr_item_name[$i]['value'];
            $id_arr_item_name = $arr_item_name[$i]['id'];
            $value_arr_batch_no = $arr_batch_no[$i]['value'];
            $id_arr_batch_no = $arr_batch_no[$i]['id'];
            $value_arr_serial_no = $arr_serial_no[$i]['value'];
            $id_arr_serial_no = $arr_serial_no[$i]['id'];
            $value_arr_stock_on_hand_qty = $arr_stock_on_hand_qty[$i]['value'];
            $id_arr_stock_on_hand_qty = $arr_stock_on_hand_qty[$i]['id'];
            $value_arr_count_qty = $arr_count_qty[$i]['value'];
            $id_arr_count_qty = $arr_count_qty[$i]['id'];
            $value_arr_discrepancy = $arr_discrepancy[$i]['value'];
            $id_arr_discrepancy = $arr_discrepancy[$i]['id'];
            $value_arr_percentage = $arr_percentage[$i]['value'];
            $id_arr_percentage = $arr_percentage[$i]['id'];
            $value_arr_uom = $arr_uom[$i]['value'];
            $id_arr_uom = $arr_uom[$i]['id'];
            $value_arr_counter = $arr_counter[$i]['value'];
            $id_arr_counter = $arr_counter[$i]['id'];
            $value_arr_count_status = $arr_count_status[$i]['value'];
            $id_arr_count_status = $arr_count_status[$i]['id'];
            $value_arr_gr_id = $arr_gr_id[$i]['value'];
            $id_arr_gr_id = $arr_gr_id[$i]['id'];
            $value_arr_stock_id = $arr_stock_id[$i]['value'];
            $id_arr_stock_id = $arr_stock_id[$i]['id'];

            $check_data = DB::select("SELECT
            stock_count_id,
            count_no,
            location_id,
            sku,
            stock_id,
            gr_id
            FROM t_wh_stock_count_detail
            WHERE 1=1
            AND stock_count_id = ?
            AND count_no = ?
            AND location_id = ?
            AND sku = ?
            AND stock_id = ?
            AND gr_id = ?
            AND `counter` = ?
            ",[
                $id,
                $current_data[0]->count_no,
                $value_arr_location_id,
                $value_arr_sku_no,
                $value_arr_stock_id,
                $value_arr_gr_id,
                session('username'),
            ]);

            if(count($check_data) == 0){
                $check_data_error_message = "this data doesnt exists in item detail with your username.";
                $data_error[$id_arr_location_id][] = $check_data_error_message;
                $data_error[$id_arr_sku_no][] = $check_data_error_message;
                $data_error[$id_arr_stock_id][] = $check_data_error_message;
                $data_error[$id_arr_gr_id][] = $check_data_error_message;
            }
        }

        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed.",
                "data" => $data_error,
            ],200);
        }

        DB::beginTransaction();
        try {
            $activity_id = $check_user[0]->activity_id;
            
            $data_t_wh_activity =[
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
            ];

            if(!empty($start_counting_date) && !empty($start_counting_time)){
                
                $data_t_wh_activity["datetime_start_counting"] = date("Y-m-d H:i:s",strtotime($start_counting_date." ".$start_counting_time));
            }

            if(!empty($finish_counting_date) && !empty($finish_counting_time)){
                $data_t_wh_activity["datetime_finish_counting"] = date("Y-m-d H:i:s",strtotime($finish_counting_date." ".$finish_counting_time));
            }

            DB::table("t_wh_activity")
            ->where("stock_count_id",$current_data[0]->stock_count_id)
            ->where("count_no",$current_data[0]->count_no)
            ->where("checker",session('username'))
            ->update($data_t_wh_activity);

            $max_row = count($arr_location_id);
            for ($i=0; $i < $max_row; $i++) { 
                $value_arr_location_id = $arr_location_id[$i]['value'];
                $value_arr_sku_no = $arr_sku_no[$i]['value'];
                $value_arr_gr_id = $arr_gr_id[$i]['value'];
                $value_arr_stock_id = $arr_stock_id[$i]['value'];
                $value_arr_count_qty = $arr_count_qty[$i]['value'];

                $get_t_wh_stock_count_detail = DB::query()
                ->select([
                    "stock_count_id",
                    "count_no",
                    "location_id",
                    "sku",
                    "item_name",
                    "batch_no",
                    "serial_no",
                    "imei",
                    "part_no",
                    "color",
                    "size",
                    "expired_date",
                    "stock_id",
                    "gr_id",
                    "count_qty",
                    "on_hand_qty",
                    "discrepancy",
                    "uom_name",
                    "percentage",
                    "counter",
                    "count_status",
                ])
                ->from("t_wh_stock_count_detail")
                ->where('stock_count_id',$current_data[0]->stock_count_id)
                ->where('count_no',$current_data[0]->count_no)
                ->where('location_id',$value_arr_location_id)
                ->where('sku',$value_arr_sku_no)
                ->where('stock_id',$value_arr_stock_id)
                ->where('gr_id',$value_arr_gr_id)
                ->get();

                $data_t_wh_count_qty = [
                    "activity_id" => $activity_id,
                    "location_id" => $value_arr_location_id,
                    "sku" => $value_arr_sku_no,
                    "item_name" => $get_t_wh_stock_count_detail[0]->item_name,
                    "batch_no" => $get_t_wh_stock_count_detail[0]->batch_no,
                    "serial_no" => $get_t_wh_stock_count_detail[0]->serial_no,
                    "qty_count" => $value_arr_count_qty,
                    "uom_name" => $get_t_wh_stock_count_detail[0]->uom_name,
                    "stock_id" => $value_arr_stock_id,
                    "gr_id" => $value_arr_gr_id,
                    "counter" => $get_t_wh_stock_count_detail[0]->counter,
                    "user_created" => session('username'),
                    "datetime_created" => $this->datetime_now,
                ];

                if(!empty($get_t_wh_stock_count_detail[0]->expired_date)){
                    $data_t_wh_count_qty["expired_date"] = $get_t_wh_stock_count_detail[0]->expired_date;
                }
                
                DB::table("t_wh_count_qty")->insert($data_t_wh_count_qty);

            }

            $check_all_data_counted = DB::select("SELECT *
            FROM t_wh_activity a
            LEFT JOIN t_wh_count_qty  b ON a.activity_id=b.activity_id
            WHERE a.stock_count_id= ?
            AND a.count_no= ?
            AND b.count_id IS NULL",[
                $current_data[0]->stock_count_id,
                $current_data[0]->count_no,
            ]);

            if(count($check_all_data_counted) == 0){
                $status_id = "";
                $stock_count_type = $current_data[0]->stock_count_type;
                if($stock_count_type == "DCC"){
                    $status_id = "CTD";
                }else if($stock_count_type == "OPN"){
                    $status_id = "CTO";
                }
    
                DB::table("t_wh_stock_count")
                ->where("stock_count_id",$current_data[0]->stock_count_id)
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
            "message" => "Success Manual Count.",
            "data" => [],
        ],200);
    }

    public function checkConfirm(Request $request, $id)
    {
        $data = [];
        $data['allowed_confirm'] = false;
        $header = $this->get_Data_Stock_Count_Header($id);
        $status_id = "";
        if(count($header) > 0){
            $status_id = $header[0]->status_id;
        }

        if(in_array($status_id,['CTD','CTO']) && in_array(session('user_level_id'),[1,2])){
            $data['allowed_confirm'] = true;
        }

        return response()->json([
            "err" => false,
            "message" => "Success checkCountNo",
            "data" => $data,
        ], 200);
    }

    public function processConfirmCount(Request $request, $id, $count_no)
    {
        $current_data = $this->get_Data_Stock_Count_Header($id);

        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Stock Count doesnt exist. please reload page.",
                "data" => [],
            ], 200);
        }
        if(!in_array($current_data[0]->status_id,['CTD','CTO']) && !in_array(session('user_level_id'),[1,2])){
            return response()->json([
                "err" => true,
                "message" => "Cant confirm status_id is not CTD or CTO. please reload page.",
                "data" => [],
            ], 200);
        }

        $input_count_no = $request->input("count_no");
        if(empty($input_count_no)){
            return response()->json([
                "err" => true,
                "message" => "Count No must be choosen.",
                "data" => [],
            ], 200);
        }

        if($count_no != $input_count_no){
            return response()->json([
                "err" => true,
                "message" => "Count No must same with header. current Count No : ".$count_no,
                "data" => [],
            ], 200);
        }

        DB::beginTransaction();
        try {
            $get_t_wh_count_qty_calculated = DB::select("SELECT 
            a.sku, a.location_id, b.on_hand_qty, a.qty_count, (a.qty_count-b.on_hand_qty) AS discrepancy, CAST(CONCAT(CAST((a.qty_count/b.on_hand_qty *100) AS INT), '%') AS CHAR) AS percentage,
            case
                when (a.qty_count/b.on_hand_qty *100) = '100' then 'Balance'
                when (a.qty_count/b.on_hand_qty *100) > '100' then 'Gain'
                ELSE 'Loss'
            END AS count_status
            ,a.gr_id
            ,a.stock_id
            FROM t_wh_count_qty a
            LEFT JOIN t_wh_location_inventory b ON a.location_id=b.location_id AND a.sku=b.sku AND a.stock_id=b.stock_id AND a.gr_id=b.gr_id
            LEFT JOIN t_wh_activity c ON a.activity_id=c.activity_id
            WHERE c.stock_count_id= ?
            AND c.count_no= ?
            ",[
                $current_data[0]->stock_count_id,
                $current_data[0]->count_no,
            ]); 
            
            if(count($get_t_wh_count_qty_calculated) > 0){
                foreach ($get_t_wh_count_qty_calculated as $key_t_wh_count_qty_calculated => $value_t_wh_count_qty_calculated) {
                    $target_qty_count = $value_t_wh_count_qty_calculated->qty_count;
                    $target_discrepancy = $value_t_wh_count_qty_calculated->discrepancy;
                    $target_percentage = $value_t_wh_count_qty_calculated->percentage;
                    $target_count_status = $value_t_wh_count_qty_calculated->count_status;
                    $target_location_id = $value_t_wh_count_qty_calculated->location_id;
                    $target_sku = $value_t_wh_count_qty_calculated->sku;
                    $target_stock_id = $value_t_wh_count_qty_calculated->stock_id;
                    $target_gr_id = $value_t_wh_count_qty_calculated->gr_id;

                    $data_t_wh_stock_count_detail = [
                        "count_qty" => $target_qty_count,
                        "discrepancy" => $target_discrepancy,
                        "percentage" => $target_percentage,
                        "count_status" => $target_count_status,
                        "user_updated" => session("username"),
                        "datetime_updated" => $this->datetime_now,
                    ];

                    DB::table("t_wh_stock_count_detail")
                    ->where("stock_count_id",$current_data[0]->stock_count_id)
                    ->where("count_no",$current_data[0]->count_no)
                    ->where("location_id",$target_location_id)
                    ->where("sku",$target_sku)
                    ->where("stock_id",$target_stock_id)
                    ->where("gr_id",$target_gr_id)
                    ->update($data_t_wh_stock_count_detail);
                }
            }

            $check_count_status = DB::select("SELECT count_status
            FROM t_wh_stock_count_detail
            WHERE stock_count_id = ?
            AND count_no = ?
            GROUP BY count_status
            ",[
                $current_data[0]->stock_count_id,
                $current_data[0]->count_no,
            ]);
            $arr_check_count_status = [];
            if(count($check_count_status) > 0){
                foreach ($check_count_status as $key_check_count_status => $value_check_count_status) {
                    $arr_check_count_status[] = $value_check_count_status->count_status;
                }
            }
            
            if(
                count($arr_check_count_status) == 1 && in_array("Balance",$arr_check_count_status)
            ){
                $data_t_wh_stock_count = [
                    "user_updated" => session("username"),
                    "datetime_updated" => $this->datetime_now,
                ];
                $stock_count_type = $current_data[0]->stock_count_type;
                if($stock_count_type == "DCC"){
                    $data_t_wh_stock_count["status_id"] = "CFC";
                }else if($stock_count_type == "OPN"){
                    $data_t_wh_stock_count["status_id"] = "CFO";
                }

                DB::table("t_wh_stock_count")
                ->where("stock_count_id",$current_data[0]->stock_count_id)
                ->where("client_project_id",session('current_client_project_id'))
                ->where("count_no",$current_data[0]->count_no)
                ->update($data_t_wh_stock_count);

            }else if(
                (in_array("Gain",$arr_check_count_status) || in_array("Loss",$arr_check_count_status)) && $current_data[0]->count_no != "Count 3"
            ){
                
                $next_count_no = null;
                $current_count_no = $current_data[0]->count_no;
                if($current_count_no == "Count 1"){
                    $next_count_no = "Count 2";
                }else if($current_count_no == "Count 2"){
                    $next_count_no = "Count 3";
                }

                $data_t_wh_stock_count = [
                    "user_updated" => session("username"),
                    "datetime_updated" => $this->datetime_now,
                ];

                $stock_count_type = $current_data[0]->stock_count_type;
                if($stock_count_type == "DCC"){
                    $data_t_wh_stock_count["status_id"] = "ODC";
                }else if($stock_count_type == "OPN"){
                    $data_t_wh_stock_count["status_id"] = "OOP";
                }

                if(!empty($next_count_no)){
                    $data_t_wh_stock_count["count_no"] = $next_count_no;
                }
                
                DB::table("t_wh_stock_count")
                ->where("stock_count_id",$current_data[0]->stock_count_id)
                ->where("client_project_id",session('current_client_project_id'))
                ->where("count_no",$current_data[0]->count_no)
                ->update($data_t_wh_stock_count);

                $prev_t_wh_stock_count_detail = DB::select("SELECT 
                stock_count_id,
                count_no,
                location_id,
                sku,
                item_name,
                batch_no,
                serial_no,
                imei,
                part_no,
                color,
                size,
                expired_date,
                stock_id,
                gr_id,
                on_hand_qty,
                uom_name,
                user_created,
                datetime_created
                FROM t_wh_stock_count_detail
                WHERE 1=1
                AND stock_count_id = ?
                AND count_no = ?
                ",[
                    $current_data[0]->stock_count_id,
                    $current_data[0]->count_no,
                ]);
                
                if(count($prev_t_wh_stock_count_detail) > 0){
                    foreach ($prev_t_wh_stock_count_detail as $key_prev_t_wh_stock_count_detail => $value_prev_t_wh_stock_count_detail) {
                        
                        $stock_count_id = $value_prev_t_wh_stock_count_detail->stock_count_id;
                        $location_id = $value_prev_t_wh_stock_count_detail->location_id;
                        $sku = $value_prev_t_wh_stock_count_detail->sku;
                        $item_name = $value_prev_t_wh_stock_count_detail->item_name;
                        $batch_no = $value_prev_t_wh_stock_count_detail->batch_no;
                        $serial_no = $value_prev_t_wh_stock_count_detail->serial_no;
                        $imei = $value_prev_t_wh_stock_count_detail->imei;
                        $part_no = $value_prev_t_wh_stock_count_detail->part_no;
                        $color = $value_prev_t_wh_stock_count_detail->color;
                        $size = $value_prev_t_wh_stock_count_detail->size;
                        $expired_date = $value_prev_t_wh_stock_count_detail->expired_date;
                        $stock_id = $value_prev_t_wh_stock_count_detail->stock_id;
                        $gr_id = $value_prev_t_wh_stock_count_detail->gr_id;
                        $on_hand_qty = $value_prev_t_wh_stock_count_detail->on_hand_qty;
                        $uom_name = $value_prev_t_wh_stock_count_detail->uom_name;

                        $check_current_data = DB::table("t_wh_stock_count_detail")
                        ->where("stock_count_id",$current_data[0]->stock_count_id)
                        ->where("count_no",$next_count_no)
                        ->where("sku",$sku)
                        ->where("location_id",$location_id)
                        ->where("stock_id",$stock_id)
                        ->where("gr_id",$gr_id)
                        ->get();
                        
                        if(count($check_current_data) == 0){
                            
                            $data_t_wh_stock_count_detail = [
                                "stock_count_id" => $stock_count_id,
                                "count_no" => $next_count_no,
                                "location_id" => $location_id,
                                "sku" => $sku,
                                "item_name" => $item_name,
                                "batch_no" => $batch_no,
                                "serial_no" => $serial_no,
                                "imei" => $imei,
                                "part_no" => $part_no,
                                "color" => $color,
                                "size" => $size,
                                "stock_id" => $stock_id,
                                "gr_id" => $gr_id,
                                "on_hand_qty" => $on_hand_qty,
                                "uom_name" => $uom_name,
                                "user_created" => session("username"),
                                "datetime_created" => $this->datetime_now,
                            ];

                            if(!empty($expired_date) && $expired_date != "0000-00-00"){
                                $data_t_wh_stock_count_detail["expired_date"] = $expired_date;
                            }
                            
                            DB::table("t_wh_stock_count_detail")
                            ->insert($data_t_wh_stock_count_detail);
                        }
                    }
                }
            }else if (
                $current_data[0]->count_no == "Count 3"
            ){
                $data_t_wh_stock_count = [
                    "user_updated" => session("username"),
                    "datetime_updated" => $this->datetime_now,
                ];
                $stock_count_type = $current_data[0]->stock_count_type;
                if($stock_count_type == "DCC"){
                    $data_t_wh_stock_count["status_id"] = "CFC";
                }else if($stock_count_type == "OPN"){
                    $data_t_wh_stock_count["status_id"] = "CFO";
                }

                DB::table("t_wh_stock_count")
                ->where("stock_count_id",$current_data[0]->stock_count_id)
                ->where("client_project_id",session('current_client_project_id'))
                ->where("count_no",$current_data[0]->count_no)
                ->update($data_t_wh_stock_count);
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
            "message" => "Success Manual Count.",
            "data" => [],
        ],200);
    }
}