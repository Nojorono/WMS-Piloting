<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterClientController extends Controller
{
    private $menu_id = 36;
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
        return view("master-client.index",compact("data"));
    }

    private function getClientListDatatables()
    {
        $data = DB::query()
        ->select([
            "a.client_id",
            "a.client_name",
            "a.address1",
            "a.country",
        ])
        ->from("m_wh_client as a")
        ->leftJoin("m_wh_client_project as b","b.client_id","=","a.client_id")
        ->where("b.client_project_id",session('current_client_project_id'))
        ->where("a.is_active","Y")
        ->orderBy("a.client_id","ASC")
        ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->getClientListDatatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_client) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_client.show',[ 'id'=> $master_client->client_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 py-1'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_List_Methods($methods_id = null)
    {
        $data = DB::query()
        ->select([
            "a.methods_id",
            "a.methods_name",
        ])
        ->from("m_wh_methods as a")
        ->where(function ($query) use($methods_id)
        {
            if(!empty($methods_id)){
                $query->where("a.methods_id",$methods_id);
            }
        })
        ->get();

        return $data;
    }

    private function get_Client($client_id)
    {
        return DB::query()
        ->select([
            "a.client_id",
            "a.client_name",
            "a.address1",
            "a.address2",
            "a.address3",
            "a.phone",
            "a.city",
            "a.country",
            "a.postal_code",
            "a.account_number",
            "a.methods_id",
        ])
        ->from("m_wh_client as a")
        ->where(function ($query) use($client_id)
        {
            if(!empty($client_id)){
                $query->where("a.client_id",$client_id);
            }
        })
        ->get();
    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Client($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Client is not found');
            </script>";
            exit();
        }

        $data = [];
        $data['arr_methods'] = $this->get_List_Methods(null);
        $data["current_data"] = $current_data;
        return view("master-client.show",compact("data"));
    }

    public function create()
    {
        if (!in_array(session('user_level_id'),[5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        $data['arr_methods'] = $this->get_List_Methods(null);
        return view("master-client.create",compact("data"));
    }

    public function store(Request $request)
    {
        if (!in_array(session('user_level_id'),[5])) {
            return response()->json([
                "err" => true,
                "message" => "You dont have access for this action, please reload the page.",
                "data" => [],
            ],200);
        }
        
        $client_id = $request->input("client_id");
        $client_name = $request->input("client_name");
        $client_address_1 = $request->input("client_address_1");
        $client_address_2 = $request->input("client_address_2");
        $client_address_3 = $request->input("client_address_3");
        $city = $request->input("city");
        $country = $request->input("country");
        $zip_code = $request->input("zip_code");
        $phone = $request->input("phone");
        $methods = $request->input("methods");

        $data_error = [];

        if(empty($client_id)){
            $data_error["client_id"][] = "Client Id is Required";
        }else if (count($this->get_Client($client_id)) > 0 ){
            $data_error["client_id"][] = "Client Id is already exist";
        }

        if(empty($client_name)){
            $data_error["client_name"][] = "Client Name is Required";
        }

        if(empty($methods)){
            $data_error["methods"][] = "Methods is Required";
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
            DB::table("m_wh_client")->insert([
                "client_id"=> $client_id,
                "client_name"=> $client_name,
                "address1"=> $client_address_1,
                "address2"=> $client_address_2,
                "address3"=> $client_address_3,
                "phone"=> $phone,
                "city"=> $city,
                "country"=> $country,
                "postal_code"=> $zip_code,
                "methods_id"=> $methods,
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
            "message" => "Success Add Client",
            "data" => [],
        ],200);
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Client($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Client is not found');
            </script>";
            exit();
        }

        $data = [];
        $data['arr_methods'] = $this->get_List_Methods(null);
        $data["current_data"] = $current_data;
        return view("master-client.edit",compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Client($id);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Client is not found",
                "data" => [],
            ],200);
        }

        $client_name = $request->input("client_name");
        $client_address_1 = $request->input("client_address_1");
        $client_address_2 = $request->input("client_address_2");
        $client_address_3 = $request->input("client_address_3");
        $city = $request->input("city");
        $country = $request->input("country");
        $zip_code = $request->input("zip_code");
        $phone = $request->input("phone");

        DB::beginTransaction();
        try {
            DB::table("m_wh_client")
            ->where("client_id",$current_data[0]->client_id)
            ->update([
                "client_name" => $client_name,
                "address1" => $client_address_1,
                "address2" => $client_address_2,
                "address3" => $client_address_3,
                "city" => $city,
                "postal_code" => $zip_code,
                "country" => $country,
                "phone" => $phone,
                "updated_by" => session("username"),
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
            "message" => "Success Update Project",
            "data" => [],
        ],200);
    }
}