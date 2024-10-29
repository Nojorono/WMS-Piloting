<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterItemController extends Controller
{
    private $menu_id = 30;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'datatables',
            'show',
        ]);
        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
            'create',
            'store',
            'datatablesUOM',
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            'edit',
            'update',
            'datatablesUOM',
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([

        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("master-item.index",compact("data"));
    }

    private function get_List_Item_Datatables()
    {
        $data = DB::query()
        ->select([
            "a.sku",
            "a.part_name",
            "a.base_uom",
            "b.wh_name",
        ])
        ->from("m_wh_item as a")
        ->leftJoin("m_warehouse as b","b.wh_id","=","a.wh_id")
        ->leftJoin("m_wh_client_project as c",function ($query)
        {
            $query->on("c.client_project_id","=","B.client_project_id");
            $query->on("c.client_id","=","a.client_id");
        })
        ->where("c.client_project_id",session("current_client_project_id"))
        ->where("a.is_active", "Y")
        ->orderBy("a.sku","ASC")
        ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->get_List_Item_Datatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_item) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_item.show',[ 'id'=> $master_item->sku  ])."' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 py-1'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_List_UOM()
    {
        $data = DB::select("SELECT a.uom_name, b.uom_type_name
        FROM m_item_uom a
        LEFT JOIN m_item_uom_type b ON a.uom_type_id = b.uom_type_id
        ORDER BY a.uom_name ASC
        ",[]);

        return $data;
    }

    public function datatablesUOM()
    {
        $data = $this->get_List_UOM();
        return DataTables::of($data)
        ->make(true);
    }

    private function get_List_Warehouse()
    {
        $data = DB::select("SELECT a.wh_id, a.wh_name
        FROM m_warehouse a
        LEFT JOIN m_wh_client_project b ON a.client_project_id=b.client_project_id
        WHERE b.client_project_id = ?
        ",[session('current_client_project_id')]);

        return $data;
    }

    private function get_List_Client()
    {
        $data = DB::select("SELECT a.client_id, a.client_name
        FROM m_wh_client a
        LEFT JOIN m_wh_client_project b ON a.client_id=b.client_id
        WHERE b.client_project_id= ?        
        ",[session('current_client_project_id')]);

        return $data;
    }

    private function get_List_Is_Batch_No()
    {
        return [
            "Y",
            "N",
        ];
    }

    private function get_List_Is_Serial_No()
    {
        return [
            "Y",
            "N",
        ];
    }

    public function create()
    {
        if (!in_array(session('user_level_id'),[1,2,5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        $data["arr_choice_client"] = $this->get_List_Client();
        $data["arr_choice_is_batch_no"] = $this->get_List_Is_Batch_No();
        $data["arr_choice_is_serial_no"] = $this->get_List_Is_Serial_No();
        return view("master-item.create",compact("data"));
    }

    public function store(Request $request)
    {
        if (!in_array(session('user_level_id'),[1,2,5])) {
            return response()->json([
                "err" => true,
                "message" => "You dont have access for this action, please reload the page.",
                "data" => [],
            ],200);
        }

        $sku = $request->input("sku");
        $part_name = $request->input("part_name");
        $imei = $request->input("imei");
        $length = $request->input("length");
        $part_no = $request->input("part_no");
        $width = $request->input("width");
        $color = $request->input("color");
        $height = $request->input("height");
        $size = $request->input("size");
        $volume = $request->input("volume");
        $uom = $request->input("uom");
        $directions = $request->input("directions");
        $warehouse = $request->input("warehouse");
        $is_serial_no = $request->input("is_serial_no");
        $client = $request->input("client");
        $is_batch_no = $request->input("is_batch_no");
        
        $data_error = [];

        if(empty($sku)){
            $data_error["sku"][] = "SKU is Required";
        }

        if(empty($part_name)){
            $data_error["part_name"][] = "Part Name is Required";
        }

        if(empty($uom)){
            $data_error["uom"][] = "UoM is Required";
        }

        if(empty($warehouse)){
            $data_error["warehouse"][] = "Warehouse is Required";
        }

        if(empty($client)){
            $data_error["client"][] = "Client is Required";
        }

        if(empty($length)){
            $data_error["length"][] = "length is Required";
        }

        if(empty($width)){
            $data_error["width"][] = "width is Required";
        }

        if(empty($height)){
            $data_error["height"][] = "height is Required";
        }

        if(empty($volume)){
            $data_error["volume"][] = "volume is Required";
        }

        if(empty($is_serial_no)){
            $data_error["is_serial_no"][] = "Please fill this question.";
        }

        if(empty($is_batch_no)){
            $data_error["is_batch_no"][] = "Please fill this question.";
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

            DB::table("m_wh_item")->insert([
                "sku" => $sku,
                "part_name" => $part_name,
                "imei" => $imei,
                "part_no" => $part_no,
                "color" => $color,
                "size" => $size,
                "base_uom" => $uom,
                "wh_id" => $warehouse,
                "client_id" => $client,
                "length" => $length,
                "width" => $width,
                "height" => $height,
                "volume" => $volume,
                "directions" => $directions,
                "is_serial_no" => $is_serial_no,
                "is_batch_no" => $is_batch_no,
                "created_by" => session("username"),
                "created_on" => $this->datetime_now,
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
            "message" => "Success Add Item",
            "data" => [],
        ],200);
    }

    private function get_Item($sku)
    {
        $data = DB::select("SELECT a.sku, 
        a.part_name,
        a.color,
        a.size,
        a.base_uom,
        b.wh_name,
        c.client_name,
        a.length,
        a.width,
        a.height,
        a.volume,
        a.directions,
        a.is_serial_no,
        a.is_batch_no,
        a.wh_id,
        a.client_id
        FROM m_wh_item a
        LEFT JOIN m_warehouse b ON a.wh_id=b.wh_id
        LEFT JOIN m_wh_client c ON a.client_id=c.client_id
        WHERE a.sku = ?
        and a.is_active = 'Y'
        
        ",[
            $sku,
        ]);

        return $data;

    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Item($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Item is not found.');
            window.location.href = '".route('master_item.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        $data["arr_choice_client"] = $this->get_List_Client();
        $data["arr_choice_is_batch_no"] = $this->get_List_Is_Batch_No();
        $data["arr_choice_is_serial_no"] = $this->get_List_Is_Serial_No();
        
        return view("master-item.show",compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Item($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Item is not found');
            window.location.href = '".route('master_item.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        $data["arr_choice_client"] = $this->get_List_Client();
        $data["arr_choice_is_batch_no"] = $this->get_List_Is_Batch_No();
        $data["arr_choice_is_serial_no"] = $this->get_List_Is_Serial_No();

        return view("master-item.edit",compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Item($id);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Item is not found",
                "data" => [],
            ],200);
        }
        
        $part_name = $request->input("part_name");
        $imei = $request->input("imei");
        $part_no = $request->input("part_no");
        $size = $request->input("size");
        $color = $request->input("color");
        $uom = $request->input("uom");
        $length = $request->input("length");
        $width = $request->input("width");
        $height = $request->input("height");
        $volume = $request->input("volume");
        $directions = $request->input("directions");
        $is_serial_no = $request->input("is_serial_no");
        $is_batch_no = $request->input("is_batch_no");

        $data_error = [];

        if(empty($part_name)){
            $data_error["part_name"][] = "Part Name is Required";
        }

        if(empty($uom)){
            $data_error["uom"][] = "UoM is Required";
        }

        if(empty($length)){
            $data_error["length"][] = "length is Required";
        }

        if(empty($width)){
            $data_error["width"][] = "width is Required";
        }

        if(empty($height)){
            $data_error["height"][] = "height is Required";
        }

        if(empty($volume)){
            $data_error["volume"][] = "volume is Required";
        }

        if(empty($is_serial_no)){
            $data_error["is_serial_no"][] = "Please fill this question.";
        }

        if(empty($is_batch_no)){
            $data_error["is_batch_no"][] = "Please fill this question.";
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

            DB::table("m_wh_item")
            ->where("sku",$current_data[0]->sku)
            ->update([
                "part_name" => $part_name,
                "imei" => $imei,
                "part_no" => $part_no,
                "color" => $color,
                "size" => $size,
                "base_uom" => $uom,
                "length" => $length,
                "width" => $width,
                "height" => $height,
                "volume" => $volume,
                "directions" => $directions,
                "is_serial_no" => $is_serial_no,
                "is_batch_no" => $is_batch_no,
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
            "message" => "Success Update Item",
            "data" => [],
        ],200);
    }
}