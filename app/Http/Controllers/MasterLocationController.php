<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterLocationController extends Controller
{
    private $menu_id = 24;
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
            'datatablesLocationIndex',
            'datatablesCommodity',
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            'edit',
            'update',
            'datatablesLocationIndex',
            'datatablesCommodity',
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([

        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("master-location.index",compact("data"));
    }

    private function get_Location_List_Datatables()
    {
        $data = DB::query()
        ->select([
            "a.location_code",
            DB::raw("a.index_code AS location_index"),
            "a.location_type",
            "b.wh_name",
            "a.location_id",
        ])
        ->from("m_wh_location as a")
        ->leftJoin("m_warehouse as b","b.wh_id","=","a.wh_id")
        ->where("a.client_project_id",session('current_client_project_id'))
        ->orderBy("a.location_code","ASC")
        ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->get_Location_List_Datatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_location) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_location.show',[ 'id'=> $master_location->location_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary text-xs py-1 mb-0'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_List_Location_Index($index_code = null)
    {
        $data = DB::query()
        ->select([
            "index_code",
            "index_name",
            "length",
            "width",
            "height",
            "capacity",
        ])
        ->from("m_wh_location_index as a")
        ->where("a.is_active","Y")
        ->where(function ($query) use($index_code)
        {
            if(!empty($index_code)){
                $query->where("a.index_code",$index_code);
            }
        })
        ->get();

        return $data;
    }

    public function datatablesLocationIndex()
    {
        $data = $this->get_List_Location_Index();
        return DataTables::of($data)
        ->make(true);
    }

    private function get_List_Commodity($commodity_id = null)
    {
        $data = DB::query()
        ->select([
            "commodity_id",
            "commodity_name",
            "commodity_desc",
        ])
        ->from("m_wh_commodity as a")
        ->where(function ($query) use($commodity_id)
        {
            if(!empty($commodity_id)){
                $query->where("a.commodity_id",$commodity_id);
            }
        })
        ->get();

        return $data;
    }

    public function datatablesCommodity()
    {
        $data = $this->get_List_Commodity();
        return DataTables::of($data)
        ->make(true);
    }

    private function get_List_Location_Type()
    {
        $data = DB::select("SELECT 
        type_name
        FROM m_wh_location_type
        WHERE is_active='Y'
        ",[]);

        return $data;
    }

    private function get_List_Project()
    {
        $data = DB::select("SELECT 
        client_project_id, client_project_name
        FROM m_wh_client_project
        WHERE client_project_id = ?
        ",[session('current_client_project_id')]);

        return $data;
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

    public function create()
    {
        if (!in_array(session('user_level_id'),[1,2,5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        $data["arr_choice_location_type"] = $this->get_List_Location_Type();
        $data["arr_choice_project"] = $this->get_List_Project();
        $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        return view("master-location.create",compact("data"));
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

        $location_code = $request->input("location_code");
        $location_name = $request->input("location_name");
        $location_index = $request->input("location_index");
        $location_type = $request->input("location_type");
        $project = $request->input("project");
        $warehouse = $request->input("warehouse");
        $commodity_id = $request->input("commodity_id");
        
        $data_error = [];

        if(empty($location_code)){
            $data_error["location_code"][] = "Location Code is Required";
        }

        if(empty($location_name)){
            $data_error["location_name"][] = "Location Name is Required";
        }

        if(empty($location_index)){
            $data_error["location_index"][] = "Location Index is Required";
        }

        if(empty($location_type)){
            $data_error["location_type"][] = "Location Type is Required";
        }

        if(empty($project)){
            $data_error["project"][] = "Project is Required";
        }

        if(empty($warehouse)){
            $data_error["warehouse"][] = "Warehouse is Required";
        }

        if(empty($commodity_id)){
            $data_error["commodity_name"][] = "Commodity is Required";
        }

        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }
        
        // return response()->json([
        //     "err" => true,
        //     "message" => "Bablas",
        //     "data" => $data_error,
        // ],200);

        DB::beginTransaction();
        try {
            DB::table("m_wh_location")->insert([
                "location_code" => $location_code,
                "location_name" => $location_name,
                "index_code" => $location_index,
                "location_type" => $location_type,
                "client_project_id" => $project,
                "wh_id" => $warehouse,
                "commodity_id" => $commodity_id,
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
            "message" => "Success Add Location",
            "data" => [],
        ],200);
    }

    private function get_Location($location_id)
    {
        $data = DB::select("SELECT a.location_code,
        a.location_name,
        a.index_code,
        a.location_type,
        b.client_project_name,
        c.wh_name,
        d.commodity_name
        ,a.location_id
        ,a.client_project_id
        ,a.wh_id
        ,a.commodity_id
        FROM m_wh_location a
        LEFT JOIN m_wh_client_project b ON a.client_project_id=b.client_project_id
        LEFT JOIN m_warehouse c ON a.wh_id=c.wh_id
        LEFT JOIN m_wh_commodity d ON a.commodity_id=d.commodity_id
        WHERE a.location_id = ?
        AND a.client_project_id = ?
        ",[
            $location_id,
            session('current_client_project_id'),
        ]);

        return $data;

    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Location($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Location is not found.');
            window.location.href = '".route('master_location.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["arr_choice_location_type"] = $this->get_List_Location_Type();
        $data["arr_choice_project"] = $this->get_List_Project();
        $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        $data["current_data"] = $current_data;
        
        return view("master-location.show",compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Location($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Location is not found');
            window.location.href = '".route('master_location.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["arr_choice_location_type"] = $this->get_List_Location_Type();
        $data["arr_choice_project"] = $this->get_List_Project();
        $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        $data["current_data"] = $current_data;

        return view("master-location.edit",compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Location($id);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Location is not found",
                "data" => [],
            ],200);
        }

        $location_name = $request->input("location_name");
        $location_index = $request->input("location_index");
        $location_type = $request->input("location_type");
        $commodity_id = $request->input("commodity_id");

        $data_error = [];

        if(empty($location_name)){
            $data_error["location_name"][] = "Location Name is Required";
        }

        if(empty($location_index)){
            $data_error["location_index"][] = "Location Index is Required";
        }

        if(empty($location_type)){
            $data_error["location_type"][] = "Location Type is Required";
        }

        if(empty($commodity_id)){
            $data_error["commodity_name"][] = "Commodity is Required";
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
            DB::table("m_wh_location")
            ->where("location_id",$current_data[0]->location_id)
            ->update([
                "location_name" => $location_name,
                "index_code" => $location_index,
                "location_type" => $location_type,
                "commodity_id" => $commodity_id,
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
            "message" => "Success Update Location",
            "data" => [],
        ],200);
    }
}