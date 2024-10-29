<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{
    private $menu_id = 31;
    private $datetime_now;

    public function __construct()
    {
        $this->middleware('check_user_access_read:' . $this->menu_id)->only([
            'index',
            'datatables',
            'show',
        ]);
        $this->middleware('check_user_access_create:' . $this->menu_id)->only([
            'create',
            'store',
        ]);
        $this->middleware('check_user_access_update:' . $this->menu_id)->only([
            'edit',
            'update',
        ]);
        $this->middleware('check_user_access_delete:' . $this->menu_id)->only([

        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("user-management.index", compact("data"));
    }

    public function get_List_User_Datatables()
    {
        $data = DB::query()
            ->select([
                "a.username",
                "a.fullname",
                "a.email",
                "b.user_level",
            ])
            ->from("t_wh_user as a")
            ->leftJoin("m_wh_user_level as b", "b.user_level_id", "=", "a.user_level_id")
            ->leftJoin("m_wh_client_project_whs as c", "c.wh_id", "=", "a.wh_id")
            ->where("a.is_active", "Y")
            ->where("c.client_project_id", session("current_client_project_id"))
            ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->get_List_User_Datatables();

        return DataTables::of($data)
            ->addColumn('action', function ($user_management) {
                $button = "";
                $button .= "<div class='text-center'>";
                $button .= "<a href='" . route('user_management.show', ['id' => $user_management->username]) . "' class='text-decoration-none'>
            <button class='btn btn-primary py-1 mb-0'>Show</button>
            </a>";
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }

    private function get_List_User_Level()
    {
        return DB::select("SELECT user_level_id, user_level, access_project
        FROM m_wh_user_level", []);
    }

    private function get_List_User_Group()
    {
        return DB::select("SELECT id, name, description
        FROM m_user_group", []);
    }

    private function get_List_Warehouse()
    {
        return DB::select("SELECT a.wh_id, a.wh_name
        FROM m_warehouse a", []);
    }

    private function get_List_Send_Email()
    {
        return ["Y", "N"];
    }

    private function get_List_Project()
    {
        return DB::select("SELECT client_project_id, client_project_name
        FROM m_wh_client_project", []);
    }

    private function get_List_Web_User()
    {
        return ["Y", "N"];
    }

    private function get_List_Android_User()
    {
        return ["Y", "N"];
    }

    private function get_List_Menu()
    {
        $arr_menu = [];

        $arr_root_menu = $this->get_Menu_Root();

        if (count($arr_root_menu) > 0) {
            foreach ($arr_root_menu as $key_root_menu => $value_root_menu) {
                $temp = $value_root_menu;
                $temp->child_menu = [];
                $child_menu = $this->get_Menu_By_Parent_id($value_root_menu->menu_id);
                $temp->child_menu = $child_menu;
                $arr_menu[] = $temp;
            }

        }

        return $arr_menu;
    }

    private function get_Menu_Root()
    {
        return $this->get_Menu_By_Parent_id(0);
    }

    private function get_Menu_By_Parent_id($parent_id)
    {
        return DB::select("SELECT
            menu_id
            ,menu_name
            ,description
            ,platform_id
            ,parent_id
            ,status
            ,no_urut
            ,id_dom
            ,menu_link
            ,menu_icon
            ,is_active
        FROM
            m_menu
        WHERE 1=1
            AND parent_id = ?
            AND platform_id = 2
            AND is_active = 'Y'
        ORDER BY no_urut ASC
        ", [
            $parent_id,
        ]);
    }

    public function create()
    {
        if (!in_array(session('user_level_id'), [1, 5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        $data["arr_choice_user_level"] = $this->get_List_User_Level();
        $data["arr_choice_user_group"] = $this->get_List_User_Group();

        $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        $data["arr_choice_send_email"] = $this->get_List_Send_Email();
        $data["arr_choice_project"] = $this->get_List_Project();
        $data["arr_choice_web_user"] = $this->get_List_Web_User();
        $data["arr_choice_android_user"] = $this->get_List_Android_User();
        $data["arr_menu"] = $this->get_List_Menu();

        return view("user-management.create", compact("data"));
    }

    public function store(Request $request)
    {
        if (!in_array(session('user_level_id'), [1, 5])) {
            return response()->json([
                "err" => true,
                "message" => "You dont have access for this action, please reload the page.",
                "data" => [],
            ], 200);
        }

        $user_id = $request->input("user_id");
        $fullname = $request->input("fullname");
        $password = $request->input("password");
        $email = $request->input("email");
        $phone = $request->input("phone");

        $user_level = $request->input("user_level");
        $user_group = $request->input("user_group");

        $warehouse = $request->input("warehouse");
        $send_email = $request->input("send_email");
        $web_user = $request->input("web_user");
        $android_user = $request->input("android_user");
        $arr_project = json_decode($request->input("arr_project"), true);
        // $arr_menu_id = json_decode($request->input("arr_menu_id"), true);

        $data_error = [];

        if (empty($user_id)) {
            $data_error["user_id"][] = "User ID is Required";
        }

        if (empty($fullname)) {
            $data_error["fullname"][] = "Full Name is Required";
        }

        if (empty($password)) {
            $data_error["password"][] = "Password is Required";
        }

        if (empty($user_level)) {
            $data_error["user_level"][] = "User Level is Required";
        }

        if (empty($user_group)) {
            $data_error["user_group"][] = "User Level is Required";
        }

        if (empty($warehouse)) {
            $data_error["warehouse"][] = "Warehouse is Required";
        }

        if (empty($send_email)) {
            $data_error["send_email"][] = "Send Email is Required";
        }

        if (empty($web_user)) {
            $data_error["web_user"][] = "Web User is Required";
        }

        if (empty($android_user)) {
            $data_error["android_user"][] = "Android User is Required";
        }

        if (empty($arr_project)) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Project Required",
                "data" => $data_error,
            ], 200);
        }

        if (count($data_error) > 0) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ], 200);
        }

        DB::beginTransaction();
        try {

            // $data_menu_access = [];
            // for ($i = 0; $i < count($arr_menu_id); $i++) {
            //     $data_menu_access[] = [
            //         "username" => $user_id,
            //         "menu_id" => $arr_menu_id[$i],
            //     ];
            // }

            $data_project = [];
            for ($i = 0; $i < count($arr_project); $i++) {
                $data_project[] = [
                    "username" => $user_id,
                    "client_project_id" => $arr_project[$i],
                ];
            }

            DB::table("t_wh_user")->insert([
                "username" => $user_id,
                "fullname" => $fullname,
                "password" => Hash::make($password),
                "email" => $email,
                "phone" => $phone,

                "user_level_id" => $user_level,
                "user_group_id" => $user_group,

                "wh_id" => $warehouse,
                "send_email" => $send_email,
                "is_web" => $web_user,
                "is_android" => $android_user,
                "created_by" => session("username"),
                "created_on" => $this->datetime_now,
            ]);

            DB::table("m_wh_user_client_project")->insert($data_project);

            // DB::table("m_user_menu_access")->insert($data_menu_access);

            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('QueryException error', array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],
            ], 500);

        } catch (\Exception $error) {
            \Illuminate\Support\Facades\Log::error('Exception error', array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],
            ], 500);

        }

        return response()->json([
            "err" => false,
            "message" => "Success Add User",
            "data" => [],
        ], 200);
    }

    private function get_User($username)
    {
        $data = DB::select("SELECT
        a.username,
        a.fullname,
        a.email,
        a.phone,
        a.send_email,
        a.is_web,
        a.is_android,
        a.user_level_id,
        a.wh_id,
        a.user_group_id
        FROM t_wh_user a
        WHERE a.username = ?",
            [
                $username,
            ]);

        return $data;
    }

    private function get_User_Project_Arr($username)
    {
        $temp = DB::select("SELECT
        a.client_project_id
        FROM m_wh_user_client_project a
        WHERE a.username = ?
        ", [
            $username,
        ]);

        $data = [];
        if (count($temp) > 0) {
            foreach ($temp as $key => $value) {
                $data[] = $value->client_project_id;
            }
        }

        return $data;
    }

    private function get_User_Access_Arr($username)
    {
        $temp = DB::select("SELECT
        a.menu_id
        FROM m_user_menu_access a
        WHERE a.username = ?
        ", [
            $username,
        ]);

        $data = [];
        if (count($temp) > 0) {
            foreach ($temp as $key => $value) {
                $data[] = $value->menu_id;
            }
        }

        return $data;
    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_User($id);
        if (count($current_data) == 0) {
            echo "<script>
            alert('User is not found.');
            window.location.href = '" . route('user_management.index') . "'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_project"] = $this->get_User_Project_Arr($id);
        $data["current_data_user_access"] = $this->get_User_Access_Arr($id);

        $data["arr_choice_user_level"] = $this->get_List_User_Level();
        $data["arr_choice_user_group"] = $this->get_List_User_Group();

        $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        $data["arr_choice_send_email"] = $this->get_List_Send_Email();
        $data["arr_choice_project"] = $this->get_List_Project();
        $data["arr_choice_web_user"] = $this->get_List_Web_User();
        $data["arr_choice_android_user"] = $this->get_List_Android_User();
        $data["arr_menu"] = $this->get_List_Menu();

        // dd($data);
        return view("user-management.show", compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_User($id);
        if (count($current_data) == 0) {
            echo "<script>
            alert('User is not found.');
            window.location.href = '" . route('user_management.index') . "'
            </script>";
            exit();
        }

        $data = [];

        $data["current_data"] = $current_data;

        $data["current_data_project"] = $this->get_User_Project_Arr($id);
        $data["current_data_user_access"] = $this->get_User_Access_Arr($id);
        $data["arr_choice_user_level"] = $this->get_List_User_Level();
        $data["arr_choice_user_group"] = $this->get_List_User_Group();
        $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        $data["arr_choice_send_email"] = $this->get_List_Send_Email();
        $data["arr_choice_web_user"] = $this->get_List_Web_User();
        $data["arr_choice_android_user"] = $this->get_List_Android_User();
        // $data["arr_menu"] = $this->get_List_Menu();

        $data["arr_choice_project"] = $this->get_List_Project();

        // dd($data);
        return view("user-management.edit", compact("data"));
    }

    public function update(Request $request, $id)
    {
        if (!in_array(session('user_level_id'), [1, 5])) {
            return response()->json([
                "err" => true,
                "message" => "You don't have access for this action, please reload the page.",
                "data" => [],
            ], 200);
        }

        // Retrieve input values from the request
        $user_id = $id;
        $fullname = $request->input("fullname");
        // $password = $request->input("password");
        $email = $request->input("email");
        $phone = $request->input("phone");
        $user_level = $request->input("user_level");
        $user_group = $request->input("user_group");
        $warehouse = $request->input("warehouse");
        $send_email = $request->input("send_email");
        $web_user = $request->input("web_user");
        $android_user = $request->input("android_user");

        // $project = $request->input("project");
        $project = json_decode($request->input("project"), true);

        $data_error = [];

        // Validate required fields
        if (empty($fullname)) {
            $data_error["fullname"][] = "Full Name is Required";
        }

        if (empty($email)) {
            $data_error["email"][] = "Email is Required";
        }

        if (empty($phone)) {
            $data_error["phone"][] = "Phone is Required";
        }

        if (empty($user_level)) {
            $data_error["user_level"][] = "User Level is Required";
        }

        if (empty($user_group)) {
            $data_error["user_group"][] = "User Group is Required";
        }

        if (empty($warehouse)) {
            $data_error["warehouse"][] = "Warehouse is Required";
        }

        if (count($data_error) > 0) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ], 200);
        }

        DB::beginTransaction();
        try {
            // Update user details
            DB::table("t_wh_user")->where("username", $user_id)->update([
                "fullname" => $fullname,
                "email" => $email,
                "phone" => $phone,
                "user_level_id" => $user_level,
                "user_group_id" => $user_group,
                "wh_id" => $warehouse,
                "send_email" => $send_email,
                "is_web" => $web_user,
                "is_android" => $android_user,
                "update_by" => session("username"),
                "updated_at" => now(),
            ]);

            // Update password if provided
            if (!empty($password)) {
                DB::table("users")->where("username", $user_id)->update([
                    "password" => Hash::make($password),
                ]);
            }

            // Handle projects
            DB::table("m_wh_user_client_project")->where("username", $user_id)->delete();

            $data_project = [];
            if (!empty($project)) {
                foreach ($project as $proj_id) {
                    $data_project[] = [
                        "username" => $user_id,
                        "client_project_id" => $proj_id,
                    ];
                }

                if (!empty($data_project)) {
                    DB::table("m_wh_user_client_project")->insert($data_project);
                }
            }
            

            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('QueryException error', ['context' => $error]);
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something went wrong",
                "data" => [],
            ], 500);

        } catch (\Exception $error) {
            \Illuminate\Support\Facades\Log::error('Exception error', ['context' => $error]);
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something went wrong",
                "data" => [],
            ], 500);
        }

        return response()->json([
            "err" => false,
            "message" => "User successfully updated",
            "data" => [],
        ], 200);
    }

}
