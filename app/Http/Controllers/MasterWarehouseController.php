<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterWarehouseController extends Controller
{
    private $menu_id = 23;
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
            'datatablesClientName',
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
        return view("master-warehouse.index",compact("data"));
    }

    private function get_Warehouse_List_Datatables()
    {
        $data = DB::query()
        ->select([
            "a.wh_code",
            "a.wh_name",
            DB::raw("a.address1 AS address"),
            "a.wh_id",
        ])
        ->from("m_warehouse as a")
        ->leftJoin("m_wh_client_project as b","b.wh_id","=","a.wh_id")
        ->where("b.client_project_id",session('current_client_project_id'))
        ->orderBy("a.wh_code","ASC")
        ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->get_Warehouse_List_Datatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_warehouse) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_warehouse.show',[ 'id'=> $master_warehouse->wh_code ])."' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 py-1'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_Warehouse($wh_code)
    {
        return DB::select("SELECT 
        wh_code, 
        wh_prefix, 
        wh_name, 
        address1, 
        address2, 
        address3, 
        city,
        country,
        postal_code,
        phone,
        is_rpx_wh
        FROM m_warehouse
        WHERE wh_code = ?
        ",[$wh_code]);
    }

    private function get_Choice_Is_RPX_Warehouse()
    {
        return [
            "Y" => "Yes",
            "N" => "No",
        ];
    }

    public function show(Request $request, $id)
    {
        $data = [];
        $data["arr_choice_is_rpx_warehouse"] = $this->get_Choice_Is_RPX_Warehouse();
        $data["current_data"] = $this->get_Warehouse($id);
        return view("master-warehouse.show",compact("data"));
    }

    private function get_List_Client_Name($client_id = null)
    {
        $data = DB::query()
        ->select([
            "client_id",
            "client_name",
            DB::raw("address1 AS address"),
        ])
        ->from("m_wh_client as a")
        ->where("a.is_active","Y")
        ->where(function ($query) use($client_id)
        {
            if(!empty($client_id)){
                $query->where("a.client_id",$client_id);
            }
        })
        ->orderBy("a.client_id","ASC")
        ->get();

        return $data;
    }

    public function datatablesClientName()
    {
        $data = $this->get_List_Client_Name();
        return DataTables::of($data)
        ->make(true);
    }

    public function create()
    {
        if (!in_array(session('user_level_id'),[1,2,5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        $data["arr_choice_is_rpx_warehouse"] = $this->get_Choice_Is_RPX_Warehouse();
        return view("master-warehouse.create",compact("data"));
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

        $warehouse_code = $request->input("warehouse_code");
        $warehouse_prefix = $request->input("warehouse_prefix");
        $warehouse_name = $request->input("warehouse_name");
        $warehouse_address_1 = $request->input("warehouse_address_1");
        $warehouse_address_2 = $request->input("warehouse_address_2");
        $warehouse_address_3 = $request->input("warehouse_address_3");
        $city = $request->input("city");
        $country = $request->input("country");
        $zip_code = $request->input("zip_code");
        $phone = $request->input("phone");
        $is_rpx_warehouse = $request->input("is_rpx_warehouse");

        $data_error = [];

        if(empty($warehouse_code)){
            $data_error["warehouse_code"][] = "Warehouse Code is Required";
        }

        if(empty($warehouse_prefix)){
            $data_error["warehouse_prefix"][] = "Warehouse Prefix is Required";
        }

        if(empty($warehouse_name)){
            $data_error["warehouse_name"][] = "Warehouse Name is Required";
        }

        if(empty($is_rpx_warehouse)){
            $data_error["is_rpx_warehouse"][] = "Please Choose";
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
            DB::table("m_warehouse")->insert([
                "wh_code" => $warehouse_code,
                "wh_prefix" => $warehouse_prefix,
                "wh_name" => $warehouse_name,
                "address1" => $warehouse_address_1,
                "address2" => $warehouse_address_2,
                "address3" => $warehouse_address_3,
                "city" => $city,
                "postal_code" => $zip_code,
                "country" => $country,
                "phone" => $phone,
                "is_rpx_wh" => $is_rpx_warehouse,
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
            "message" => "Success Add Warehouse",
            "data" => [],
        ],200);
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Warehouse($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Warehouse is not found');
            </script>";
            exit();
        }
        $data = [];
        
        $data["arr_choice_is_rpx_warehouse"] = $this->get_Choice_Is_RPX_Warehouse();
        $data["current_data"] = $current_data;

        return view("master-warehouse.edit",compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Warehouse($id);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Warehouse is not found",
                "data" => [],
            ],200);
        }

        $warehouse_name = $request->input("warehouse_name");
        $warehouse_address_1 = $request->input("warehouse_address_1");
        $warehouse_address_2 = $request->input("warehouse_address_2");
        $warehouse_address_3 = $request->input("warehouse_address_3");
        $city = $request->input("city");
        $country = $request->input("country");
        $zip_code = $request->input("zip_code");
        $phone = $request->input("phone");

        $data_error = [];

        if(empty($warehouse_name)){
            $data_error["warehouse_name"][] = "Warehouse Name is Required";
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
            DB::table("m_warehouse")
            ->where("wh_code",$current_data[0]->wh_code)
            ->update([
                "wh_name" => $warehouse_name,
                "address1" => $warehouse_address_1,
                "address2" => $warehouse_address_2,
                "address3" => $warehouse_address_3,
                "city" => $city,
                "country" => $country,
                "postal_code" => $zip_code,
                "phone" => $phone,
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
            "message" => "Success Update Warehouse",
            "data" => [],
        ],200);
    }
}