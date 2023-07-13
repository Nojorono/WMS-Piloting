<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class StockTransferController extends Controller
{
    private $menu_id = 16;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'datatables',
            'datatablesTransactionType',
            'show',
            'viewExcel',
        ]);
        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
            'create',
            'datatablesSKUAndItemName',
            'datatablesSourceBatchNoandSKUDetail',
            'datatablesUOM',
            'datatablesStockType',
            'datatablesLocationIDSource',
            'datatablesLocationIDDestination',
            'store',
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            'confirmStockTransfer',
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([
        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        return view('stock-transfer.index');
    }

    private function get_Stock_Transfer($stock_transfer_id = false,$warehouse_name = false,$transaction_type = false,$stock_transfer_status = false,$client_name = false)
    {
        $data = DB::query()
        ->select([
            "a.stock_transfer_id", 
            "b.client_project_name", 
            "c.wh_code", 
            "d.transaction_name", 
            "a.remark", 
            "e.status_name",
            "a.status_id",
            "a.data_upload1",
            "a.data_upload2",
            "a.data_upload3",
        ])
        ->from("t_wh_stock_transfer as a")
        ->leftJoin("m_wh_client_project as b","a.client_project_id","=","b.client_project_id")
        ->leftJoin("m_warehouse as c","b.wh_id","=","c.wh_id")
        ->leftJoin("m_wh_transaction_type as d","a.transaction_type","=","d.transaction_type")
        ->leftJoin("m_status as e","a.status_id","=","e.status_id")
        ->where(function ($query) use($stock_transfer_id)
        {
            if(!empty($stock_transfer_id)){
                $query->where("a.stock_transfer_id",$stock_transfer_id);
            }
        })
        ->where(function ($query) use($warehouse_name)
        {
            if(!empty($warehouse_name)){
                $query->where("c.wh_code",$warehouse_name);
            }
        })
        ->where(function ($query) use($client_name)
        {
            if(!empty($client_name)){
                $query->where("b.client_project_name",$client_name);
            }
        })
        ->where(function ($query) use($transaction_type)
        {
            if(!empty($transaction_type)){
                $query->where("a.transaction_type",$transaction_type);
            }
        })
        ->where(function ($query) use($stock_transfer_status)
        {
            if(!empty($stock_transfer_status)){
                $query->where("e.status_name",$stock_transfer_status);
            }
        })
        ->orderBy("a.datetime_created","DESC")
        ->get();
        return $data;

    }

    public function datatables(Request $request)
    {
        $stock_transfer_id = $request->input("stock_transfer_id");
        $warehouse_name = $request->input("warehouse_name");
        $transaction_type = $request->input("transaction_type");
        $stock_transfer_status = $request->input("stock_transfer_status");
        $client_name = $request->input("client_name");

        $data = $this->get_Stock_Transfer($stock_transfer_id,$warehouse_name,$transaction_type,$stock_transfer_status,$client_name);

        return DataTables::of($data)
        ->addColumn('action', function ($stock_transfer) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('stock_transfer.show',[ 'id'=> $stock_transfer->stock_transfer_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 text-xs py-1'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_Stock_Transfer_Detail($stock_transfer_id)
    {
        $data = DB::query()
        ->select([
            "a.*",
            "b.stock_type as source_stock_type",
            "c.stock_type as dest_stock_type",
        ])
        ->from("t_wh_stock_transfer_detail as a")
        ->leftJoin("m_wh_stock_type_copy as b","b.stock_id","=","a.source_stock_id")
        ->leftJoin("m_wh_stock_type_copy as c","c.stock_id","=","a.dest_stock_id")
        ->where("a.stock_transfer_id",$stock_transfer_id)
        ->orderBy("a.source_sku","ASC")
        ->get();
        return $data;

    }

    public function show(Request $request, $id)
    {
        $data = [];
        $data['stock_transfer_header'] = $this->get_Stock_Transfer($id);
        $data['stock_transfer_detail'] = $this->get_Stock_Transfer_Detail($id);

        return view("stock-transfer.show",compact('data'));
    }

    public function create()
    {
        return view("stock-transfer.create");
    }

    private function get_Transaction_Type($transaction_type = false)
    {
        $data = DB::query()
        ->select([
            "a.transaction_type",
            "a.transaction_name",
        ])
        ->from("m_wh_transaction_type as a")
        ->where(function ($query) use($transaction_type)
        {
            if(!empty($transaction_type)){
                $query->where("a.transaction_type",$transaction_type);
            }
        })
        ->get();

        return $data;
    }

    public function datatablesTransactionType(Request $request)
    {
        $data = $this->get_Transaction_Type();

        return DataTables::of($data)
        ->make(true);
    }

    private function get_SKU_And_ItemName($sku = false)
    {
        $data = DB::query()
        ->select([
            "a.sku",
            "a.part_name",
        ])
        ->from("t_wh_location_inventory as a")
        ->where(function ($query) use($sku)
        {
            if(!empty($sku)){
                $query->where("a.sku",$sku);
            }
        })
        ->where("a.client_project_id",session("current_client_project_id"))
        ->groupBy("a.sku")
        ->orderBy("a.sku","ASC")
        ->get();

        return $data;
    }

    public function datatablesSKUAndItemName(Request $request)
    {
        $data = $this->get_SKU_And_ItemName();

        return DataTables::of($data)
        ->make(true);
    }

    private function get_Source_BatchNo_and_SKUDetail($sku)
    {
        $data = DB::query()
        ->select([
            "a.sku",
            "a.batch_no",
            "a.serial_no",
            "a.imei",
            "a.part_no",
            "a.color",
            "a.size",
            "a.expired_date",
            "b.base_qty",
            "b.base_uom",
            "a.available_qty",
        ])
        ->from("t_wh_location_inventory as a")
        ->leftJoin("m_wh_item as b","b.sku","=","a.sku")
        ->where(function ($query) use($sku)
        {
            if(!empty($sku)){
                $query->where("a.sku",$sku);
            }
        })
        ->where("a.client_project_id",session("current_client_project_id"))
        ->where("b.client_id",session("current_client_id"))
        ->where("b.wh_id",session("current_warehouse_id"))
        ->orderBy("a.batch_no","ASC")
        ->get();

        return $data;
    }

    public function datatablesSourceBatchNoandSKUDetail(Request $request)
    {
        $sku = $request->input('sku');
        $data = [];

        if(!empty($sku)){
            $data = $this->get_Source_BatchNo_and_SKUDetail($sku);
        }

        return DataTables::of($data)
        ->make(true);
    }

    private function get_UOM($uom_name = false)
    {
        $data = DB::query()
        ->select([
            "a.uom_name",
        ])
        ->from("m_item_uom as a")
        ->where(function ($query) use($uom_name)
        {
            if(!empty($uom_name)){
                $query->where("a.uom_name",$uom_name);
            }
        })
        ->orderBy("a.uom_name","ASC")
        ->get();

        return $data;
    }

    public function datatablesUOM(Request $request)
    {
        $data = $this->get_UOM();

        return DataTables::of($data)
        ->make(true);
    }

    private function get_Stock_Type($stock_id = false)
    {
        $data = DB::query()
        ->select([
            "a.stock_id",
            "a.stock_type",
        ])
        ->from("m_wh_stock_type_copy as a")
        ->where(function ($query) use($stock_id)
        {
            if(!empty($stock_id)){
                $query->where("a.stock_id",$stock_id);
            }
        })
        ->get();

        return $data;
    }

    public function datatablesStockType(Request $request)
    {
        $data = $this->get_Stock_Type();

        return DataTables::of($data)
        ->make(true);
    }

    private function get_Location_ID_Source($sku,$batch_no,$serial_no,$stock_id)
    {
        $data = DB::query()
        ->select([
            "a.location_id",
            "a.gr_id",
            "a.gr_datetime",
            "a.last_movement_id",
        ])
        ->from("t_wh_location_inventory as a")
        ->where("a.client_project_id",session("current_client_project_id"))
        ->where("a.sku",$sku)
        ->where(function ($query) use($batch_no)
        {
            if(!empty($batch_no)){
                $query->where("a.batch_no",$batch_no);
            }
        })
        ->where(function ($query) use($serial_no)
        {
            if(!empty($serial_no)){
                $query->where("a.serial_no",$serial_no);
            }
        })
        ->where(function ($query) use($stock_id)
        {
            if(!empty($stock_id)){
                $query->where("a.stock_id",$stock_id);
            }
        })
        ->orderBy("a.location_id","ASC")
        ->get();

        return $data;
    }

    public function datatablesLocationIDSource(Request $request)
    {
        $sku = $request->input('sku');
        $batch_no = $request->input('batch_no');
        $serial_no = $request->input('serial_no');
        $stock_id = $request->input('stock_id');
        $data = [];

        if(!empty($sku)){
            $data = $this->get_Location_ID_Source($sku,$batch_no,$serial_no,$stock_id);
        }

        return DataTables::of($data)
        ->make(true);
    }

    private function get_Location_ID_Destination()
    {
        $data = DB::query()
        ->select([
            "a.location_id",
        ])
        ->from("t_wh_location_inventory as a")
        ->where("a.client_project_id",session("current_client_project_id"))
        ->groupBy("a.location_id")
        ->get();

        return $data;
    }

    public function datatablesLocationIDDestination(Request $request)
    {
        $data = $this->get_Location_ID_Destination();

        return DataTables::of($data)
        ->make(true);
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

    private function updateRunningNumber($last_running_number)
    {
        $data = DB::table("t_running_number as a")
        ->where("a.process_code","STR")
        ->where("a.date",date("Y-m" ,strtotime($this->datetime_now)))
        ->where("a.wh_id",session("current_warehouse_id"))
        ->update([
            "running_number" => $last_running_number,
        ]);
    }

    private function uploadFTP($file,$target_dir)
    {
        return Storage::disk('ftp')->put($target_dir,$file);
    }

    public function store(Request $request)
    {
        
        $transaction_type = $request->input("transaction_type");
        $remark = $request->input("remark");
        $arr_source_sku = json_decode($request->input("arr_source_sku"),true);
        $arr_source_item_name = json_decode($request->input("arr_source_item_name"),true);
        $arr_destination_sku = json_decode($request->input("arr_destination_sku"),true);
        $arr_destination_item_name = json_decode($request->input("arr_destination_item_name"),true);
        $arr_source_batch_no = json_decode($request->input("arr_source_batch_no"),true);
        $arr_destination_batch_no = json_decode($request->input("arr_destination_batch_no"),true);
        $arr_source_serial_no = json_decode($request->input("arr_source_serial_no"),true);
        $arr_destination_serial_no = json_decode($request->input("arr_destination_serial_no"),true);
        $arr_source_imei_no = json_decode($request->input("arr_source_imei_no"),true);
        $arr_destination_imei_no = json_decode($request->input("arr_destination_imei_no"),true);
        $arr_source_part_no = json_decode($request->input("arr_source_part_no"),true);
        $arr_destination_part_no = json_decode($request->input("arr_destination_part_no"),true);
        $arr_source_color = json_decode($request->input("arr_source_color"),true);
        $arr_destination_color = json_decode($request->input("arr_destination_color"),true);
        $arr_source_size = json_decode($request->input("arr_source_size"),true);
        $arr_destination_size = json_decode($request->input("arr_destination_size"),true);
        $arr_source_expired_date = json_decode($request->input("arr_source_expired_date"),true);
        $arr_destination_expired_date = json_decode($request->input("arr_destination_expired_date"),true);
        $arr_source_qty = json_decode($request->input("arr_source_qty"),true);
        $arr_source_uom = json_decode($request->input("arr_source_uom"),true);
        $arr_destination_qty = json_decode($request->input("arr_destination_qty"),true);
        $arr_destination_uom = json_decode($request->input("arr_destination_uom"),true);
        $arr_source_base_qty = json_decode($request->input("arr_source_base_qty"),true);
        $arr_source_base_uom = json_decode($request->input("arr_source_base_uom"),true);
        $arr_source_stock_id = json_decode($request->input("arr_source_stock_id"),true);
        $arr_source_stock_type = json_decode($request->input("arr_source_stock_type"),true);
        $arr_destination_stock_id = json_decode($request->input("arr_destination_stock_id"),true);
        $arr_destination_stock_type = json_decode($request->input("arr_destination_stock_type"),true);
        $arr_source_location_id = json_decode($request->input("arr_source_location_id"),true);
        $arr_destination_location_id = json_decode($request->input("arr_destination_location_id"),true);
        $arr_source_gr_id = json_decode($request->input("arr_source_gr_id"),true);

        $allowed_file_type = ["png","jpg","jpeg"];
        $file_1 = $request->file("file_1");
        $file_2 = $request->file("file_2");
        $file_3 = $request->file("file_3");
        
        $data_error = [];

        if(empty($transaction_type)){
            $data_error["transaction_type"][] = "Transaction Type cant be empty";
        }

        if(count($arr_source_sku) == 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details is required",
                "data" => $data_error,
            ],200);
        }

        $max_row_item_detail = count($arr_source_sku);
        for ($i=0; $i < $max_row_item_detail; $i++) { 
            $value_source_sku = $arr_source_sku[$i]['value'];
            $id_source_sku = $arr_source_sku[$i]['id'];
            $value_source_item_name = $arr_source_item_name[$i]['value'];
            $id_source_item_name = $arr_source_item_name[$i]['id'];
            $value_destination_sku = $arr_destination_sku[$i]['value'];
            $id_destination_sku = $arr_destination_sku[$i]['id'];
            $value_destination_item_name = $arr_destination_item_name[$i]['value'];
            $id_destination_item_name = $arr_destination_item_name[$i]['id'];
            $value_source_batch_no = $arr_source_batch_no[$i]['value'];
            $id_source_batch_no = $arr_source_batch_no[$i]['id'];
            $value_destination_batch_no = $arr_destination_batch_no[$i]['value'];
            $id_destination_batch_no = $arr_destination_batch_no[$i]['id'];
            $value_source_serial_no = $arr_source_serial_no[$i]['value'];
            $id_source_serial_no = $arr_source_serial_no[$i]['id'];
            $value_destination_serial_no = $arr_destination_serial_no[$i]['value'];
            $id_destination_serial_no = $arr_destination_serial_no[$i]['id'];
            $value_source_imei_no = $arr_source_imei_no[$i]['value'];
            $id_source_imei_no = $arr_source_imei_no[$i]['id'];
            $value_destination_imei_no = $arr_destination_imei_no[$i]['value'];
            $id_destination_imei_no = $arr_destination_imei_no[$i]['id'];
            $value_source_part_no = $arr_source_part_no[$i]['value'];
            $id_source_part_no = $arr_source_part_no[$i]['id'];
            $value_destination_part_no = $arr_destination_part_no[$i]['value'];
            $id_destination_part_no = $arr_destination_part_no[$i]['id'];
            $value_source_color = $arr_source_color[$i]['value'];
            $id_source_color = $arr_source_color[$i]['id'];
            $value_destination_color = $arr_destination_color[$i]['value'];
            $id_destination_color = $arr_destination_color[$i]['id'];
            $value_source_size = $arr_source_size[$i]['value'];
            $id_source_size = $arr_source_size[$i]['id'];
            $value_destination_size = $arr_destination_size[$i]['value'];
            $id_destination_size = $arr_destination_size[$i]['id'];
            $value_source_expired_date = $arr_source_expired_date[$i]['value'];
            $id_source_expired_date = $arr_source_expired_date[$i]['id'];
            $value_destination_expired_date = $arr_destination_expired_date[$i]['value'];
            $id_destination_expired_date = $arr_destination_expired_date[$i]['id'];
            $value_source_qty = $arr_source_qty[$i]['value'];
            $id_source_qty = $arr_source_qty[$i]['id'];
            $value_source_uom = $arr_source_uom[$i]['value'];
            $id_source_uom = $arr_source_uom[$i]['id'];
            $value_destination_qty = $arr_destination_qty[$i]['value'];
            $id_destination_qty = $arr_destination_qty[$i]['id'];
            $value_destination_uom = $arr_destination_uom[$i]['value'];
            $id_destination_uom = $arr_destination_uom[$i]['id'];
            $value_source_base_qty = $arr_source_base_qty[$i]['value'];
            $id_source_base_qty = $arr_source_base_qty[$i]['id'];
            $value_source_base_uom = $arr_source_base_uom[$i]['value'];
            $id_source_base_uom = $arr_source_base_uom[$i]['id'];
            $value_source_stock_id = $arr_source_stock_id[$i]['value'];
            $id_source_stock_id = $arr_source_stock_id[$i]['id'];
            $value_source_stock_type = $arr_source_stock_type[$i]['value'];
            $id_source_stock_type = $arr_source_stock_type[$i]['id'];
            $value_destination_stock_id = $arr_destination_stock_id[$i]['value'];
            $id_destination_stock_id = $arr_destination_stock_id[$i]['id'];
            $value_destination_stock_type = $arr_destination_stock_type[$i]['value'];
            $id_destination_stock_type = $arr_destination_stock_type[$i]['id'];
            $value_source_location_id = $arr_source_location_id[$i]['value'];
            $id_source_location_id = $arr_source_location_id[$i]['id'];
            $value_destination_location_id = $arr_destination_location_id[$i]['value'];
            $id_destination_location_id = $arr_destination_location_id[$i]['id'];

            if(empty($value_source_sku)){
                $data_error[$id_source_sku][] = "SKU cant be empty";
            }

            if(empty($value_destination_sku)){
                $data_error[$id_destination_sku][] = "SKU cant be empty";
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
            "transaction_type" => $transaction_type,
            "remark" => $remark,
            "arr_source_sku" => $arr_source_sku,
            "arr_source_item_name" => $arr_source_item_name,
            "arr_destination_sku" => $arr_destination_sku,
            "arr_destination_item_name" => $arr_destination_item_name,
            "arr_source_batch_no" => $arr_source_batch_no,
            "arr_destination_batch_no" => $arr_destination_batch_no,
            "arr_source_serial_no" => $arr_source_serial_no,
            "arr_destination_serial_no" => $arr_destination_serial_no,
            "arr_source_imei_no" => $arr_source_imei_no,
            "arr_destination_imei_no" => $arr_destination_imei_no,
            "arr_source_part_no" => $arr_source_part_no,
            "arr_destination_part_no" => $arr_destination_part_no,
            "arr_source_color" => $arr_source_color,
            "arr_destination_color" => $arr_destination_color,
            "arr_source_size" => $arr_source_size,
            "arr_destination_size" => $arr_destination_size,
            "arr_source_expired_date" => $arr_source_expired_date,
            "arr_destination_expired_date" => $arr_destination_expired_date,
            "arr_source_qty" => $arr_source_qty,
            "arr_source_uom" => $arr_source_uom,
            "arr_destination_qty" => $arr_destination_qty,
            "arr_destination_uom" => $arr_destination_uom,
            "arr_source_base_qty" => $arr_source_base_qty,
            "arr_source_base_uom" => $arr_source_base_uom,
            "arr_source_stock_id" => $arr_source_stock_id,
            "arr_source_stock_type" => $arr_source_stock_type,
            "arr_destination_stock_id" => $arr_destination_stock_id,
            "arr_destination_stock_type" => $arr_destination_stock_type,
            "arr_source_location_id" => $arr_source_location_id,
            "arr_destination_location_id" => $arr_destination_location_id,
            "arr_source_gr_id" => $arr_source_gr_id,
        ];
        

        DB::beginTransaction();
        try {
            $url = "https://static.rpx.co.id/";
            $path = "/wms_web_dev/stock-transfer";

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

            $process_code = "STR";
            $status_id = $this->getStatusID($process_code,"OST");
            if(!$status_id){
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Status ID is not defined",
                    "data" => [],
                ],200);
            }

            $wh_prefix = $this->getWHPrefix();
            $date_format_stock_transfer = date("my",strtotime($this->datetime_now));
            $current_running_number = $this->getLastRunningNumber($process_code) + 1;
            $running_number = $this->mustFourDigits($current_running_number);
            $stock_transfer_id = $wh_prefix."-".$process_code."-".$date_format_stock_transfer."-".$running_number;
            if($current_running_number > 9999){
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Running Number is more than 9999, cant create more.",
                    "data" => [],
                ],200);
            }


            $this->updateRunningNumber($current_running_number);
            
            $data_t_wh_stock_transfer = [
                "stock_transfer_id" => $stock_transfer_id,
                "client_project_id" => session("current_client_project_id"),
                "transaction_type" => $validated["transaction_type"],
                "remark" => $validated["remark"],
                "status_id" => $status_id,
                "data_upload1" => $url_file_1,
                "data_upload2" => $url_file_2,
                "data_upload3" => $url_file_3,
                "user_created" => session("username"),
                "datetime_created" => $this->datetime_now,
            ];

            DB::table("t_wh_stock_transfer")
            ->insert($data_t_wh_stock_transfer);

            $data_t_wh_stock_transfer_detail = [];
            $max_row_item_detail = count($validated['arr_source_sku']);
            for ($i=0; $i < $max_row_item_detail; $i++) { 
                $value_source_sku = $validated['arr_source_sku'][$i]['value'];
                $value_source_item_name = $validated['arr_source_item_name'][$i]['value'];
                $value_source_batch_no = $validated['arr_source_batch_no'][$i]['value'];
                $value_source_serial_no = $validated['arr_source_serial_no'][$i]['value'];
                $value_source_imei_no = $validated['arr_source_imei_no'][$i]['value'];
                $value_source_part_no = $validated['arr_source_part_no'][$i]['value'];
                $value_source_color = $validated['arr_source_color'][$i]['value'];
                $value_source_size = $validated['arr_source_size'][$i]['value'];
                $value_source_expired_date = $validated['arr_source_expired_date'][$i]['value'];
                $value_source_qty = $validated['arr_source_qty'][$i]['value'];
                $value_source_uom = $validated['arr_source_uom'][$i]['value'];
                $value_source_base_qty = $validated['arr_source_base_qty'][$i]['value'];
                $value_source_base_uom = $validated['arr_source_base_uom'][$i]['value'];
                $value_source_stock_id = $validated['arr_source_stock_id'][$i]['value'];
                $value_source_stock_type = $validated['arr_source_stock_type'][$i]['value'];
                $value_source_location_id = $validated['arr_source_location_id'][$i]['value'];
                $value_source_gr_id = $validated['arr_source_gr_id'][$i]['value'];
                $value_destination_sku = $validated['arr_destination_sku'][$i]['value'];
                $value_destination_item_name = $validated['arr_destination_item_name'][$i]['value'];
                $value_destination_batch_no = $validated['arr_destination_batch_no'][$i]['value'];
                $value_destination_serial_no = $validated['arr_destination_serial_no'][$i]['value'];
                $value_destination_imei_no = $validated['arr_destination_imei_no'][$i]['value'];
                $value_destination_part_no = $validated['arr_destination_part_no'][$i]['value'];
                $value_destination_color = $validated['arr_destination_color'][$i]['value'];
                $value_destination_size = $validated['arr_destination_size'][$i]['value'];
                $value_destination_expired_date = $validated['arr_destination_expired_date'][$i]['value'];
                $value_destination_qty = $validated['arr_destination_qty'][$i]['value'];
                $value_destination_uom = $validated['arr_destination_uom'][$i]['value'];
                $value_destination_stock_id = $validated['arr_destination_stock_id'][$i]['value'];
                $value_destination_stock_type = $validated['arr_destination_stock_type'][$i]['value'];
                $value_destination_location_id = $validated['arr_destination_location_id'][$i]['value'];
                $data_t_wh_stock_transfer_detail = [
                    "stock_transfer_id" => $stock_transfer_id,
                    "source_sku" => $value_source_sku,
                    "source_item_name" => $value_source_item_name,
                    "source_batch_no" => $value_source_batch_no,
                    "source_serial_no" => $value_source_serial_no,
                    "source_imei" => $value_source_imei_no,
                    "source_part_no" => $value_source_part_no,
                    "source_color" => $value_source_color,
                    "source_size" => $value_source_size,
                    "source_qty" => $value_source_qty,
                    "source_uom" => $value_source_uom,
                    "source_stock_id" => $value_source_stock_id,
                    "source_location" => $value_source_location_id,
                    "dest_sku" => $value_destination_sku,
                    "dest_item_name" => $value_destination_item_name,
                    "dest_batch_no" => $value_destination_batch_no,
                    "dest_serial_no" => $value_destination_serial_no,
                    "dest_imei" => $value_destination_imei_no,
                    "dest_part_no" => $value_destination_part_no,
                    "dest_color" => $value_destination_color,
                    "dest_size" => $value_destination_size,
                    "dest_qty" => $value_destination_qty,
                    "dest_uom" => $value_destination_uom,
                    "dest_stock_id" => $value_destination_stock_id,
                    "dest_location" => $value_destination_location_id,
                    "source_gr" => $value_source_gr_id,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];
                if(!empty($value_destination_expired_date)){
                    $data_t_wh_stock_transfer_detail["dest_exp_date"] = $value_destination_expired_date;
                }
                if(!empty($value_source_expired_date)){
                    $data_t_wh_stock_transfer_detail["source_exp_date"] = $value_source_expired_date;
                }
                DB::table("t_wh_stock_transfer_detail")
                ->insert($data_t_wh_stock_transfer_detail);
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
            "message" => "Success Add Stock Transfer.",
            "data" => [],
        ],200);
    }

    private function check_Location_Inventory($sku,$batch_no,$location_id,$stock_id,$gr_id)
    {
        // SELECT * FROM t_wh_location_inventory
        // WHERE sku='112233445' /*diambil dari dest_sku*/
        // AND batch_no='test28des22_1' /*diambil dari dest_batch_no*/
        // AND location_id='1A1-001-002' /*diambil dari dest_location*/
        // AND stock_id='AV' /*diambil dari dest_stock_id*/
        // AND gr_id='CBT-GR-1222-0016' /*diambil dari source_gr*/
        // AND client_project_id='1' /*diambil dari login*/

        $data = DB::query()
        ->select([
            "*",
        ])
        ->from("t_wh_location_inventory as a")
        ->where("a.sku",$sku)
        ->where(function ($query) use($batch_no)
        {
            if(!empty($batch_no)){
                $query->where("a.batch_no",$batch_no);
            }
        })
        ->where("a.location_id",$location_id)
        ->where("a.stock_id",$stock_id)
        ->where("a.gr_id",$gr_id)
        ->where("a.client_project_id",session("current_client_project_id"))
        ->get();

        return $data;
    }


    private function get_Location_Type($location_code)
    {
        $data = DB::query()
        ->select([
            "location_type",
        ])
        ->from("m_wh_location as a")
        ->where("a.location_code",$location_code)
        ->get();
        if(count($data) > 0){

            return @$data[0]->location_type;
        }
        return "";
    }

    private function get_Last_Movement($gr_id,$sku,$batch_no)
    {
        $data = DB::query()
        ->select([
            "last_movement_id",
        ])
        ->from("t_wh_location_inventory as a")
        ->where("a.gr_id",$gr_id)
        ->where("a.sku",$sku)
        ->where(function ($query) use($batch_no)
        {
            if(!empty($batch_no)){
                $query->where("a.batch_no",$batch_no);
            }
        })
        ->where("a.client_project_id",session("current_client_project_id"))
        ->get();
        if(count($data) > 0){

            return @$data[0]->last_movement_id;
        }
        return null;
    }

    public function generate_Movement_Id()
    {
        $process_code = "``";
        $wh_prefix = $this->getWHPrefix();
        $date_format_movement_id = date("my",strtotime($this->datetime_now));
        $current_running_number = $this->getLastRunningNumber($process_code) + 1;
        $running_number = $this->mustFourDigits($current_running_number);
        $movement_id = $wh_prefix."-".$process_code."-".$date_format_movement_id."-".$running_number;

        return $movement_id;
    }

    public function confirmStockTransfer(Request $request, $id)
    {
        $header_stock_transfer = $this->get_Stock_Transfer($id);
        $status_id = @$header_stock_transfer[0]->status_id;
        $stock_transfer_id = @$header_stock_transfer[0]->stock_transfer_id;
        if($status_id != "OST"){
            return response()->json([
                "err" => true,
                "message" => "Failed to Confirm, Status is not Open",
                "data" => [],
            ],200);
        }

        $detail_stock_transfer = $this->get_Stock_Transfer_Detail($stock_transfer_id);

        DB::beginTransaction();
        try {
            //check_qty
            foreach ($detail_stock_transfer as $key_detail_stock_transfer => $value_detail_stock_transfer) {
                $source_sku = @$value_detail_stock_transfer->source_sku;
                $source_batch_no = @$value_detail_stock_transfer->source_batch_no;
                $source_location = @$value_detail_stock_transfer->source_location;
                $source_stock_id = @$value_detail_stock_transfer->source_stock_id;
                $dest_qty = @$value_detail_stock_transfer->dest_qty;

                $get_Data_Location_Inventory_Source = DB::select("SELECT 
                * FROM t_wh_location_inventory
                WHERE sku = ?  /*source_sku*/
                AND batch_no = ?  /*source_batch_no*/
                AND location_id = ?  /*source_location*/
                AND stock_id = ?  /*source_stock_id*/
                ",[
                    $source_sku,
                    $source_batch_no,
                    $source_location,
                    $source_stock_id,
                ]);

                if($dest_qty > @$get_Data_Location_Inventory_Source[0]->on_hand_qty){
                    return response()->json([
                        "err" => true,
                        "message" => "Qty Destination can’t be bigger than On Hand Qty",
                        "data" => [],
                    ],200);
                }
            }

            
            foreach ($detail_stock_transfer as $key_detail_stock_transfer => $value_detail_stock_transfer) {
                $movement_id = $this->generate_Movement_Id();
                $dest_batch_no = @$value_detail_stock_transfer->dest_batch_no;
                $dest_color = @$value_detail_stock_transfer->dest_color;
                $dest_exp_date = @$value_detail_stock_transfer->dest_exp_date;
                $dest_imei = @$value_detail_stock_transfer->dest_imei;
                $dest_item_name = @$value_detail_stock_transfer->dest_item_name;
                $dest_location = @$value_detail_stock_transfer->dest_location;
                $dest_pallet_id = @$value_detail_stock_transfer->dest_pallet_id;
                $dest_part_no = @$value_detail_stock_transfer->dest_part_no;
                $dest_qty = @$value_detail_stock_transfer->dest_qty;
                $dest_serial_no = @$value_detail_stock_transfer->dest_serial_no;
                $dest_size = @$value_detail_stock_transfer->dest_size;
                $dest_sku = @$value_detail_stock_transfer->dest_sku;
                $dest_stock_id = @$value_detail_stock_transfer->dest_stock_id;
                $dest_stock_type = @$value_detail_stock_transfer->dest_stock_type;
                $dest_uom = @$value_detail_stock_transfer->dest_uom;
                $source_batch_no = @$value_detail_stock_transfer->source_batch_no;
                $source_color = @$value_detail_stock_transfer->source_color;
                $source_exp_date = @$value_detail_stock_transfer->source_exp_date;
                $source_gr = @$value_detail_stock_transfer->source_gr;
                $source_imei = @$value_detail_stock_transfer->source_imei;
                $source_item_name = @$value_detail_stock_transfer->source_item_name;
                $source_location = @$value_detail_stock_transfer->source_location;
                $source_pallet_id = @$value_detail_stock_transfer->source_pallet_id;
                $source_part_no = @$value_detail_stock_transfer->source_part_no;
                $source_qty = @$value_detail_stock_transfer->source_qty;
                $source_serial_no = @$value_detail_stock_transfer->source_serial_no;
                $source_size = @$value_detail_stock_transfer->source_size;
                $source_sku = @$value_detail_stock_transfer->source_sku;
                $source_stock_id = @$value_detail_stock_transfer->source_stock_id;
                $source_stock_type = @$value_detail_stock_transfer->source_stock_type;
                $source_uom = @$value_detail_stock_transfer->source_uom;

                $check_location = $this->check_Location_Inventory($dest_sku,$dest_batch_no,$dest_location,$dest_stock_id,$source_gr);

                if(count($check_location) == 0){
                    $getGRDatetime = DB::select("SELECT gr_id, gr_datetime
                    FROM t_wh_location_inventory
                    WHERE gr_id = ? /*didapat dari source_gr*/
                    AND sku = ? /*didapat dari source_sku*/
                    AND batch_no = ? /*didapat dari source_batch_no*/
                    AND stock_id = ? /*didapatkan dari source stock type*/
                    AND location_id = ? /*didapatkan dari source location*/
                    AND client_project_id = ? /*diambil dari login*/
                    ",[
                        $source_gr,
                        $source_sku,
                        $source_batch_no,
                        $source_stock_id,
                        $source_location,
                        session("current_client_project_id"),
                    ]);

                    DB::table("t_wh_location_inventory")->insert([
                        "location_id" => $dest_location, /*diambil dari dest_location*/
                        "location_type" => $this->get_Location_Type($dest_location), /*jalankan query getlocationtype*/
                        "client_project_id" => session("current_client_project_id"), /*diambil dari login*/
                        "sku" => $dest_sku, /*diambil dari dest_sku*/
                        "part_name" => $dest_item_name, /*diambil dari dest_item_name*/
                        "batch_no" => $dest_batch_no, /*diambil dari dest_batch_no*/
                        "serial_no" => 	$dest_serial_no, /*diambil dari dest_serial_no*/
                        "imei" => $dest_imei, /*diambil dari dest_imei*/
                        "part_no" => $dest_part_no, /*diambil dari dest_part_no*/
                        "color" => $dest_color, /*diambil dari dest_color*/
                        "size" => $dest_size, /*diambil dari dest_size*/
                        "expired_date" => $dest_exp_date, /*diambil dari dest_exp_date*/
                        "clasification_id" => 1, /*default 1*/
                        "on_hand_qty" => $dest_qty, /*diambil dari dest_qty*/
                        "available_qty" => $dest_qty, /*diambil dari dest_qty*/
                        "uom_name" => $dest_uom, /*diambil dari dest_uom*/
                        "stock_id" => $dest_stock_id, /*diambil dari dest_stock_id*/
                        "gr_id" => $source_gr, /*diambil dari source_gr*/
                        "gr_datetime" => @$getGRDatetime[0]->gr_datetime,
                        "last_movement_id" => $movement_id,
                        "user_created" => session("username"),
                        "datetime_created" => $this->datetime_now,
                        "is_active" => "Y",
                    ]);

                    DB::table("t_wh_location_inventory")
                    ->where("sku",$source_sku)
                    ->where(function ($query) use($source_batch_no)
                    {
                        if(!empty($source_batch_no)){
                            $query->where("batch_no",$source_batch_no);
                        }
                    })
                    ->where("location_id",$source_location)
                    ->where("stock_id",$source_stock_id)
                    ->where("gr_id",$source_gr)
                    ->where("client_project_id",session("current_client_project_id"))
                    ->update([
                        "on_hand_qty" => (@$check_location[0]->on_hand_qty - $source_qty),
                        "available_qty" => (@$check_location[0]->on_hand_qty - $source_qty),
                        "user_updated" => session("username"),
                        "datetime_updated" => $this->datetime_now,
                    ]);

                    DB::table("t_wh_stock_transfer_detail")
                    ->where("source_sku", $source_sku)
                    ->where("source_gr", $source_gr)
                    ->where("source_location", $source_location)
                    ->where("source_stock_id", $source_stock_id)
                    ->where("dest_sku", $dest_sku)
                    ->where("dest_location", $dest_location)
                    ->where("dest_stock_id", $dest_stock_id)
                    ->where("stock_transfer_id", $stock_transfer_id)
                    ->update([
                        "movement_id" => $movement_id
                    ]);
                    
                    $check_location2 = $this->check_Location_Inventory($dest_sku,$dest_batch_no,$dest_location,$dest_stock_id,$source_gr);

                    if(
                        $check_location2[0]->on_hand_qty == 0 &&
                        $check_location2[0]->allocated_qty == 0 &&
                        $check_location2[0]->picked_qty == 0 &&
                        $check_location2[0]->available_qty == 0
                    ){
                        DB::table("t_wh_location_inventory")
                        ->where("sku",$source_sku)
                        ->where(function ($query) use($source_batch_no)
                        {
                            if(!empty($source_batch_no)){
                                $query->where("batch_no",$source_batch_no);
                            }
                        })
                        ->where("location_id",$dest_location)
                        ->where("stock_id",$dest_stock_id)
                        ->where("gr_id",$source_gr)
                        ->where("client_project_id",session("current_client_project_id"))
                        ->delete();
                    }

                }else{

                    DB::table("t_wh_location_inventory")
                    ->where("sku",$dest_sku)
                    ->where(function ($query) use($dest_batch_no)
                    {
                        if(!empty($dest_batch_no)){
                            $query->where("batch_no",$dest_batch_no);
                        }
                    })
                    ->where("location_id",$dest_location)
                    ->where("stock_id",$dest_stock_id)
                    ->where("gr_id",$source_gr)
                    ->where("client_project_id",session("current_client_project_id"))
                    ->update([
                        "on_hand_qty" => (@$check_location[0]->on_hand_qty + $dest_qty),
                        "available_qty" => (@$check_location[0]->on_hand_qty + $dest_qty),
                        "last_movement_id" => $movement_id,
                        "user_updated" => session("username"),
                        "datetime_updated" => $this->datetime_now,
                    ]);

                    DB::table("t_wh_location_inventory")
                    ->where("sku",$source_sku)
                    ->where(function ($query) use($source_batch_no)
                    {
                        if(!empty($source_batch_no)){
                            $query->where("batch_no",$source_batch_no);
                        }
                    })
                    ->where("location_id",$source_location)
                    ->where("stock_id",$source_stock_id)
                    ->where("gr_id",$source_gr)
                    ->where("client_project_id",session("current_client_project_id"))
                    ->update([
                        "on_hand_qty" => (@$check_location[0]->on_hand_qty - $source_qty),
                        "available_qty" => (@$check_location[0]->on_hand_qty - $source_qty),
                        "user_updated" => session("username"),
                        "datetime_updated" => $this->datetime_now,
                    ]);

                    DB::table("t_wh_stock_transfer_detail")
                    ->where("source_sku", $source_sku)
                    ->where("source_gr", $source_gr)
                    ->where("source_location", $source_location)
                    ->where("source_stock_id", $source_stock_id)
                    ->where("dest_sku", $dest_sku)
                    ->where("dest_location", $dest_location)
                    ->where("dest_stock_id", $dest_stock_id)
                    ->where("stock_transfer_id", $stock_transfer_id)
                    ->update([
                        "movement_id" => $movement_id
                    ]);

                    $check_location2 = $this->check_Location_Inventory($dest_sku,$dest_batch_no,$dest_location,$dest_stock_id,$source_gr);

                    if(
                        $check_location2[0]->on_hand_qty == 0 &&
                        $check_location2[0]->allocated_qty == 0 &&
                        $check_location2[0]->picked_qty == 0 &&
                        $check_location2[0]->available_qty == 0
                    ){
                        DB::table("t_wh_location_inventory")
                        ->where("sku",$source_sku)
                        ->where(function ($query) use($source_batch_no)
                        {
                            if(!empty($source_batch_no)){
                                $query->where("batch_no",$source_batch_no);
                            }
                        })
                        ->where("location_id",$dest_location)
                        ->where("stock_id",$dest_stock_id)
                        ->where("gr_id",$source_gr)
                        ->where("client_project_id",session("current_client_project_id"))
                        ->delete();
                    }
                }
            }

            $data_t_wh_stock_transfer = [
                "status_id" => "CST",
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
            ];
            DB::table("t_wh_stock_transfer")
            ->where("stock_transfer_id",$stock_transfer_id)
            ->update($data_t_wh_stock_transfer);

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
            "message" => "Success Confirm Stock Transfer.",
            "data" => [],
        ],200);
    }

    public function viewExcel(Request $request)
    {
        $stock_transfer_id = $request->input("stock_transfer_id");
        $warehouse_name = $request->input("warehouse_name");
        $transaction_type = $request->input("transaction_type");
        $stock_transfer_status = $request->input("stock_transfer_status");
        $client_name = $request->input("client_name");
        $selected_column_query = json_decode($request->input("selected_column_query"),true);
        $mapping_filter_query = json_decode($request->input("mapping_filter_query"),true);

        $data = $this->get_Stock_Transfer($stock_transfer_id,$warehouse_name,$transaction_type,$stock_transfer_status,$client_name);

        $spreadsheet = new Spreadsheet(); 
        $spreadsheet->getProperties()
        ->setCreator(config('app.name'))
        ->setLastModifiedBy(config('app.name'))
        ->setTitle("Stock Transfer Excel")
        ->setSubject("Stock Transfer Excel")
        ->setDescription("Stock Transfer Excel")
        ->setKeywords("office 2007 openxml php");
        $spreadsheet->getActiveSheet()->setTitle('Stock_Transfer');
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

        $filename = "Stock_Transfer_".date("YmdHis",strtotime($this->datetime_now));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $objWriter->save('php://output');
        exit();
    }

}
