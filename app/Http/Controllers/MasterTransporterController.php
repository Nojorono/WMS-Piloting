<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterTransporterController extends Controller
{
    private $menu_id = 27;
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
            
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([

        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("master-transporter.index",compact("data"));
    }

    private function get_List_Transporter_Datatables()
    {
        $data = DB::query()
        ->select([
            "a.transporter_id",
            "a.transporter_name",
        ])
        ->from("m_wh_transporter as a")
        ->where("a.is_active","Y")
        ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->get_List_Transporter_Datatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_transporter) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_transporter.show',[ 'id'=> $master_transporter->transporter_id ])."' class='text-decoration-none'>
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
        return view("master-transporter.create",compact("data"));
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
        
        $transporter_name = $request->input("transporter_name");
        
        $data_error = [];

        if(empty($transporter_name)){
            $data_error["transporter_name"][] = "Transporter Name is Required";
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
            DB::table("m_wh_transporter")->insert([
                "transporter_name" => $transporter_name,
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
            "message" => "Success Add Transporter",
            "data" => [],
        ],200);
    }

    private function get_Transporter($transporter_id)
    {
        $data = DB::select("SELECT 
        transporter_id, 
        transporter_name,
        is_active
        FROM m_wh_transporter
        WHERE transporter_id = ?
        AND is_active= ?
        ",[
            $transporter_id,
            'Y',
        ]);

        return $data;

    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Transporter($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Transporter is not found.');
            window.location.href = '".route('master_transporter.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        
        return view("master-transporter.show",compact("data"));
    }
}