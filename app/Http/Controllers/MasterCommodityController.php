<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterCommodityController extends Controller
{
    private $menu_id = 26;
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
        return view("master-commodity.index",compact("data"));
    }

    private function get_List_Commodity_Datatables()
    {
        $data = DB::query()
        ->select([
            "a.commodity_name",
            "a.commodity_desc",
            "a.commodity_id"
        ])
        ->from("m_wh_commodity as a")
        ->orderBy("a.commodity_name","ASC")
        ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->get_List_Commodity_Datatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_commodity) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_commodity.show',[ 'id'=> $master_commodity->commodity_id ])."' class='text-decoration-none'>
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
        return view("master-commodity.create",compact("data"));
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
        
        $commodity_name = $request->input("commodity_name");
        $commodity_desc = $request->input("commodity_desc");
        
        $data_error = [];

        if(empty($commodity_name)){
            $data_error["commodity_name"][] = "Commodity Name is Required";
        }

        if(empty($commodity_desc)){
            $data_error["commodity_desc"][] = "Commodity Desc is Required";
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
            DB::table("m_wh_commodity")->insert([
                "commodity_name" => $commodity_name,
                "commodity_desc" => $commodity_desc,
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
            "message" => "Success Add Commodity",
            "data" => [],
        ],200);
    }

    private function get_Commodity($commodity_id)
    {
        $data = DB::select("SELECT 
        commodity_name, 
        commodity_desc,
        commodity_id
        FROM m_wh_commodity
        WHERE commodity_id = ?
        ",[
            $commodity_id,
        ]);

        return $data;

    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Commodity($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Commodity is not found.');
            window.location.href = '".route('master_commodity.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        
        return view("master-commodity.show",compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Commodity($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Commodity is not found');
            window.location.href = '".route('master_commodity.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;

        return view("master-commodity.edit",compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Commodity($id);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Commodity is not found",
                "data" => [],
            ],200);
        }
        
        $commodity_name = $request->input("commodity_name");
        $commodity_desc = $request->input("commodity_desc");
        
        $data_error = [];

        if(empty($commodity_name)){
            $data_error["commodity_name"][] = "Commodity Name is Required";
        }

        if(empty($commodity_desc)){
            $data_error["commodity_desc"][] = "Commodity Desc is Required";
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
            DB::table("m_wh_commodity")
            ->where("commodity_id",$current_data[0]->commodity_id)
            ->update([
                "commodity_name" => $commodity_name,
                "commodity_desc" => $commodity_desc,
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
            "message" => "Success Update Commodity",
            "data" => [],
        ],200);
    }
}