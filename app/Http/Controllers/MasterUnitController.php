<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterUnitController extends Controller
{
    private $menu_id = 28;
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
        return view("master-unit.index",compact("data"));
    }

    private function get_List_Unit_Datatables()
    {
        $data = DB::query()
        ->select([
            "a.uom_name",
            "b.uom_type_name",
        ])
        ->from("m_item_uom as a")
        ->leftJoin("m_item_uom_type as b","b.uom_type_id","=","a.uom_type_id")
        ->where("a.is_active","Y")
        ->orderBy("a.uom_name","ASC")
        ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->get_List_Unit_Datatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_unit) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_unit.show',[ 'id'=> $master_unit->uom_name ])."' class='text-decoration-none'>
            <button class='btn btn-primary text-xs py-1 mb-0'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_List_Unit_Type()
    {
        $data = DB::select("SELECT uom_type_id, uom_type_name
        FROM m_item_uom_type
        ORDER BY uom_type_id ASC
        ",[]);

        return $data;
    }

    public function create()
    {
        if (!in_array(session('user_level_id'),[1,2,5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        $data["arr_choice_unit_type"] = $this->get_List_Unit_Type();
        return view("master-unit.create",compact("data"));
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
        
        $unit_name = $request->input("unit_name");
        $unit_type = $request->input("unit_type");
        
        $data_error = [];

        if(empty($unit_name)){
            $data_error["unit_name"][] = "Unit Name is Required";
        }

        if(empty($unit_type)){
            $data_error["unit_type"][] = "Unit Type is Required";
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
            DB::table("m_item_uom")->insert([
                "uom_name" => $unit_name,
                "uom_type_id" => $unit_type,
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
            "message" => "Success Add Unit",
            "data" => [],
        ],200);
    }

    private function get_Unit($uom_name)
    {
        $data = DB::select("SELECT 
        a.uom_name, 
        b.uom_type_name,
        a.uom_type_id
        FROM m_item_uom a
        LEFT JOIN m_item_uom_type b ON a.uom_type_id=b.uom_type_id
        WHERE a.is_active = ?
        AND a.uom_name = ?
        
        ",[
            'Y',
            $uom_name,
        ]);

        return $data;

    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Unit($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Unit is not found.');
            window.location.href = '".route('master_unit.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["arr_choice_unit_type"] = $this->get_List_Unit_Type();
        
        return view("master-unit.show",compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Unit($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Unit is not found');
            window.location.href = '".route('master_unit.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["arr_choice_unit_type"] = $this->get_List_Unit_Type();

        return view("master-unit.edit",compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Unit($id);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Unit is not found",
                "data" => [],
            ],200);
        }
        
        $unit_type = $request->input("unit_type");
        
        $data_error = [];

        if(empty($unit_type)){
            $data_error["unit_type"][] = "Unit Type is Required";
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
            DB::table("m_item_uom")
            ->where("uom_name",$current_data[0]->uom_name)
            ->where("is_active","Y")
            ->update([
                "uom_type_id" => $unit_type,
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
            "message" => "Success Update Unit",
            "data" => [],
        ],200);
    }
}