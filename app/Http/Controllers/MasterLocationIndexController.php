<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterLocationIndexController extends Controller
{
    private $menu_id = 25;
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
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            'edit',
            'update',
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([

        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("master-location-index.index",compact("data"));
    }

    private function get_List_Location_Index_Datatables()
    {
        $data = DB::query()
        ->select([
            "a.index_code",
            "a.index_name",
            "a.is_active",
        ])
        ->from("m_wh_location_index as a")
        ->where("a.is_active","Y")
        ->orderBy("a.index_code","ASC")
        ->get();

        return $data;
    }

    private function get_List_Is_Active()
    {
        return ["Y", "N"];
    }

    public function datatables(Request $request)
    {

        $data = $this->get_List_Location_Index_Datatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_location_index) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_location_index.show',[ 'id'=> $master_location_index->index_code ])."' class='text-decoration-none'>
            <button class='btn btn-primary text-xs py-1 mb-0'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    public function create()
    {
        if (!in_array(session('user_level_id'),[1,2,5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        return view("master-location-index.create",compact("data"));
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

        
        $index_code = $request->input("index_code");
        $index_name = $request->input("index_name");
        $length = $request->input("length");
        $width = $request->input("width");
        $height = $request->input("height");
        $capacity = $request->input("capacity");
        
        $data_error = [];

        if(empty($index_code)){
            $data_error["index_code"][] = "Index Code is Required";
        }

        if(empty($index_name)){
            $data_error["index_name"][] = "Index Name is Required";
        }

        if(empty($length)){
            $data_error["length"][] = "Length is Required";
        }

        if(empty($width)){
            $data_error["width"][] = "Width is Required";
        }

        if(empty($height)){
            $data_error["height"][] = "Height is Required";
        }

        if(empty($capacity)){
            $data_error["capacity"][] = "Capacity is Required";
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
            DB::table("m_wh_location_index")->insert([
                "index_code" => $index_code,
                "index_name" => $index_name,
                "length" => $length,
                "width" => $width,
                "height" => $height,
                "capacity" => $capacity,
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
            "message" => "Success Add Location Index",
            "data" => [],
        ],200);
    }

    private function get_Location_Index($index_code)
    {
        $data = DB::select("SELECT index_code,
        index_name,
        `length`,
        width,
        height,
        capacity,
        is_active
        FROM m_wh_location_index
        WHERE index_code = ?
        and is_active='Y'
        
        ",[
            $index_code,
        ]);

        return $data;

    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Location_Index($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Location is not found.');
            window.location.href = '".route('master_location_index.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["arr_choice_is_active"] = $this->get_List_Is_Active();
        
        return view("master-location-index.show",compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Location_Index($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Location is not found');
            window.location.href = '".route('master_location_index.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["arr_choice_is_active"] = $this->get_List_Is_Active();

        return view("master-location-index.edit",compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Location_Index($id);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Location is not found",
                "data" => [],
            ],200);
        }
        
        $index_name = $request->input("index_name");
        $length = $request->input("length");
        $width = $request->input("width");
        $height = $request->input("height");
        $capacity = $request->input("capacity");
        $is_active = $request->input("is_active");

        $data_error = [];

        if(empty($index_name)){
            $data_error["index_name"][] = "Index Name is Required";
        }

        if(empty($length)){
            $data_error["length"][] = "Length is Required";
        }

        if(empty($width)){
            $data_error["width"][] = "Width is Required";
        }

        if(empty($height)){
            $data_error["height"][] = "Height is Required";
        }

        if(empty($capacity)){
            $data_error["capacity"][] = "Capacity is Required";
        }
        
        if(empty($is_active)){
            $data_error["capacity"][] = "is_active is Required";
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
            DB::table("m_wh_location_index")
            ->where("index_code",$current_data[0]->index_code)
            ->update([
                "index_name" => $index_name,
                "length" => $length,
                "width" => $width,
                "height" => $height,
                "capacity" => $capacity,
                "is_active" => $is_active,
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
            "message" => "Success Update Location Index",
            "data" => [],
        ],200);
    }
}