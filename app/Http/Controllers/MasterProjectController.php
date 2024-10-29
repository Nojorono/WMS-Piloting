<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterProjectController extends Controller
{
    private $menu_id = 22;
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
        return view("master-project.index",compact("data"));
    }

    private function getInventoryListDatatables()
    {
        $data = DB::query()
        ->select([
            DB::raw("a.client_project_name AS project_name"),
            "b.client_name",
            // "c.wh_name",
            "a.client_project_id",
        ])
        ->from("m_wh_client_project as a")
        ->leftJoin("m_wh_client as b","b.client_id","=","a.client_id")
        // ->leftJoin("m_warehouse as c","c.client_project_id","=","a.client_project_id")
        ->where("a.client_project_id",session('current_client_project_id'))
        ->orderBy("a.client_project_name","ASC")
        ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->getInventoryListDatatables();
        
        return DataTables::of($data)
        ->addColumn('action', function ($master_project) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('master_project.show',[ 'id'=> $master_project->client_project_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 py-1'>Show</button>
            </a>";
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_List_Warehouse($wh_id = null)
    {
        $data = DB::query()
        ->select([
            "a.wh_id",
            "a.wh_name",
        ])
        ->from("m_warehouse as a")
        ->where(function ($query) use($wh_id)
        {
            if(!empty($wh_id)){
                $query->where("a.wh_id",$wh_id);
            }
        })
        ->get();

        return $data;
    }

    private function get_List_Project_Type($project_type_id = null)
    {
        $data = DB::query()
        ->select([
            "a.project_type_id",
            "a.project_type_name",
        ])
        ->from("m_wh_project_type as a")
        ->where(function ($query) use($project_type_id)
        {
            if(!empty($project_type_id)){
                $query->where("a.project_type_id",$project_type_id);
            }
        })
        ->get();

        return $data;
    }

    private function get_Project($client_project_id)
    {
        return DB::select("SELECT a.client_project_id AS project_id,
        a.client_project_name AS project_name,
        a.address1 AS project_address,
        a.address2,
        a.address3,
        a.city,
        a.country,
        a.postal_code AS zip_code,
        a.phone,
        -- b.wh_name,
        c.project_type_name,
        d.client_name,
        -- b.wh_id,
        a.project_type_id
        FROM m_wh_client_project a
        -- LEFT JOIN m_warehouse b ON a.client_project_id=b.client_project_id
        LEFT JOIN m_wh_project_type c ON a.project_type_id=c.project_type_id
        LEFT JOIN m_wh_client d ON a.client_id=d.client_id
        WHERE a.client_project_id= ?
        ",[$client_project_id]);
    }

    public function show(Request $request, $id)
    {
        $data = [];
        $data['arr_warehouse'] = $this->get_List_Warehouse();
        $data['arr_project_type'] = $this->get_List_Project_Type();
        $data["current_data"] = $this->get_Project($id);
        return view("master-project.show",compact("data"));
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

    public function getLastClientProjectID()
    {
        $data = DB::select("SELECT 
            client_project_id
            FROM m_wh_client_project
            ORDER BY client_project_id DESC
            LIMIT 1");
        
        return $data;
    }

    public function create()
    {
        if (!in_array(session('user_level_id'),[1,2,5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        // $data['arr_warehouse'] = $this->get_List_Warehouse();
        $data['arr_project_type'] = $this->get_List_Project_Type();
        return view("master-project.create",compact("data"));
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

        
        $project_name = $request->input("project_name");
        $project_address_1 = $request->input("project_address_1");
        $project_address_2 = $request->input("project_address_2");
        $project_address_3 = $request->input("project_address_3");
        $city = $request->input("city");
        $country = $request->input("country");
        $zip_code = $request->input("zip_code");
        $phone = $request->input("phone");
        // $warehouse = $request->input("warehouse");
        // $arr_warehouse = json_decode($request->input("arr_warehouse"), true);
        $project_type = $request->input("project_type");
        $client_id = $request->input("client_id");
        $client_name = $request->input("client_name");
        // // Fetch the last client project ID and add 11 to it
        // $last_client_project = $this->getLastClientProjectID();
        // // var_dump($last_client_project);
        // // Assuming the method returns an array with the 'client_project_id' key:
        // $last_client_project_id = $last_client_project[0]->client_project_id;
        // // var_dump($last_client_project_id);
        // // Add 11 to the last client project ID
        // $new_client_project_id = $last_client_project_id + 1;
        $data_error = [];

        if(empty($project_name)){
            $data_error["project_name"][] = "Project Name is Required";
        }

        // if(empty($warehouse)){
        //     $data_error["warehouse"][] = "Warehouse is Required";
        // }

        // if (empty($arr_warehouse)) {
        //     return response()->json([
        //         "err" => true,
        //         "message" => "Validation Failed, Project Required",
        //         "data" => $data_error,
        //     ], 200);
        // }

        if(empty($project_type)){
            $data_error["project_type"][] = "Project Type is Required";
        }

        if(empty($client_id)){
            $data_error["client_name"][] = "Client is Required";
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
            // $data_warehouse = [];
            // for ($i = 0; $i < count($arr_warehouse); $i++) {
            //     $data_warehouse[] = [
            //         "client_project_id" => $new_client_project_id,
            //         "client_id" => $client_id,
            //         "wh_id" => $arr_warehouse[$i],
            //         "created_by" => session("username"),
            //         "created_on" => $this->datetime_now,
            //     ];
            // }

            DB::table("m_wh_client_project")->insert([
                "client_id" => $client_id,
                "client_project_name" => $project_name,
                "project_type_id" => $project_type,
                "address1" => $project_address_1,
                "address2" => $project_address_2,
                "address3" => $project_address_3,
                "city" => $city,
                "postal_code" => $zip_code,
                "country" => $country,
                "phone" => $phone,
                "created_by" => session("username"),
                "created_on" => $this->datetime_now,
            ]);

            
            
            // DB::table("m_wh_client_project_whs")->insert($data_warehouse);
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
            "message" => "Success Add Project",
            "data" => [],
        ],200);
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Project($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Project is not found');
            </script>";
            exit();
        }
        $data = [];
        // $data['arr_warehouse'] = $this->get_List_Warehouse();
        $data['arr_project_type'] = $this->get_List_Project_Type();
        $data["current_data"] = $current_data;
        return view("master-project.edit",compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Project($id);
        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Project is not found",
                "data" => [],
            ],200);
        }

        $project_name = $request->input("project_name");
        $project_address_1 = $request->input("project_address_1");
        $project_address_2 = $request->input("project_address_2");
        $project_address_3 = $request->input("project_address_3");
        $city = $request->input("city");
        $country = $request->input("country");
        $zip_code = $request->input("zip_code");
        $phone = $request->input("phone");

        DB::beginTransaction();
        try {
            DB::table("m_wh_client_project")
            ->where("client_project_id",$current_data[0]->project_id)
            ->update([
                "client_project_name" => $project_name,
                "address1" => $project_address_1,
                "address2" => $project_address_2,
                "address3" => $project_address_3,
                "city" => $city,
                "postal_code" => $zip_code,
                "country" => $country,
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
            "message" => "Success Update Project",
            "data" => [],
        ],200);
    }
}