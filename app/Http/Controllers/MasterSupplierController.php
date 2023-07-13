<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterSupplierController extends Controller
{
    private $menu_id = 29;
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
        return view("master-supplier.index",compact("data"));
    }

    private function get_List_Supplier_Datatables()
    {
        $data = DB::query()
        ->select([
            "a.supplier_id",
            "a.supplier_name",
            "a.address1",
            "a.city",
        ])
        ->from("m_wh_supplier as a")
        ->leftJoin("m_wh_client_project as b","b.client_id","=","a.client_id")
        ->where("a.is_active","Y")
        ->where("b.client_project_id",session("current_client_project_id"))
        ->orderBy("a.supplier_id","ASC")
        ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->get_List_Supplier_Datatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_supplier) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_supplier.show',[ 'id'=> $master_supplier->supplier_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 py-1'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_List_Client()
    {
        $data = DB::select("SELECT a.client_id, a.client_name
        FROM m_wh_client a
        LEFT JOIN m_wh_client_project b ON a.client_id=b.client_id
        WHERE b.client_project_id= ?
        AND a.is_active = ?
        ORDER BY a.client_id ASC
        ",[
            session("current_client_project_id"),
            "Y",
        ]);

        return $data;
    }

    public function create()
    {
        if (!in_array(session('user_level_id'),[1,2,5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        $data["arr_choice_client"] = $this->get_List_Client();
        return view("master-supplier.create",compact("data"));
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
        
        $supplier_name = $request->input("supplier_name");
        $supplier_address1 = $request->input("supplier_address1");
        $supplier_address2 = $request->input("supplier_address2");
        $supplier_address3 = $request->input("supplier_address3");
        $city = $request->input("city");
        $contact_person = $request->input("contact_person");
        $phone = $request->input("phone");
        $client = $request->input("client");
        
        $data_error = [];

        if(empty($supplier_name)){
            $data_error["supplier_name"][] = "Supplier Name is Required";
        }

        if(empty($phone)){
            $data_error["phone"][] = "Phone is Required";
        }

        if(empty($client)){
            $data_error["client"][] = "Client is Required";
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
            DB::table("m_wh_supplier")->insert([
                "supplier_name" => $supplier_name,
                "address1" => $supplier_address1,
                "address2" => $supplier_address2,
                "address3" => $supplier_address3,
                "city" => $city,
                "contact_person" => $contact_person,
                "phone" => $phone,
                "client_id" => $client,
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
            "message" => "Success Add Supplier",
            "data" => [],
        ],200);
    }

    private function get_Supplier($supplier_id)
    {
        $data = DB::select("SELECT a.supplier_id,
        a.supplier_name,
        a.address1,
        a.address2,
        a.address3,
        a.city,
        a.contact_person,
        a.phone,
        b.client_name,
        a.client_id
        FROM m_wh_supplier a
        LEFT JOIN m_wh_client b ON a.client_id=b.client_id
        WHERE supplier_id= ?
        ",[
            $supplier_id,
        ]);

        return $data;

    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Supplier($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Supplier is not found.');
            window.location.href = '".route('master_unit.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["arr_choice_client"] = $this->get_List_Client();
        
        return view("master-supplier.show",compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Supplier($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Supplier is not found');
            window.location.href = '".route('master_unit.index')."'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["arr_choice_client"] = $this->get_List_Client();

        return view("master-supplier.edit",compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Supplier($id);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Supplier is not found",
                "data" => [],
            ],200);
        }
        
        $supplier_name = $request->input("supplier_name");
        $supplier_address1 = $request->input("supplier_address1");
        $supplier_address2 = $request->input("supplier_address2");
        $supplier_address3 = $request->input("supplier_address3");
        $city = $request->input("city");
        $contact_person = $request->input("contact_person");
        $phone = $request->input("phone");
        
        $data_error = [];

        if(empty($supplier_name)){
            $data_error["supplier_name"][] = "Supplier Name is Required";
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
            DB::table("m_wh_supplier")
            ->where("supplier_id",$current_data[0]->supplier_id)
            ->update([
                "supplier_name" => $supplier_name,
                "address1" => $supplier_address1,
                "address2" => $supplier_address2,
                "address3" => $supplier_address3,
                "city" => $city,
                "contact_person" => $contact_person,
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
            "message" => "Success Update Supplier",
            "data" => [],
        ],200);
    }
}