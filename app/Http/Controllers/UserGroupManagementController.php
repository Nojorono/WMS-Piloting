<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserGroupManagementController extends Controller
{
    private $menu_id = 44;
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
        $this->middleware('check_user_access_delete:' . $this->menu_id)->only([]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("user-group-management.index", compact("data"));
    }

    public function get_List_User_Datatables()
    {
        $data = DB::query()
            ->select([
                "a.id",
                "a.name",
                "a.description",
                "a.is_activ",
            ])
            ->from("m_user_group as a")
            // ->where("a.is_activ","Y")

            ->get();

        return $data;
    }

    public function datatables(Request $request)
    {

        $data = $this->get_List_User_Datatables();

        return DataTables::of($data)
            ->addColumn('action', function ($user_group_management) {
                $button = "";
                $button .= "<div class='text-center'>";
                $button .= "<a href='" . route('user_group_management.show', ['id' => $user_group_management->id]) . "' class='text-decoration-none'>
            <button class='btn btn-primary py-1 mb-0'>Show</button>
            </a>";
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }

    private function get_List_Is_Activ()
    {
        return ["Y", "N"];
    }

    private function get_List_User_Level()
    {
        return DB::select("SELECT user_level_id, user_level, access_project
        FROM m_wh_user_level", []);
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
        $data["user_group_id"] = $this->getLastIdNumber();

        $data["arr_choice_is_activ"] = $this->get_List_Is_Activ();
        // $data["arr_choice_warehouse"] = $this->get_List_Warehouse();
        // $data["arr_choice_send_email"] = $this->get_List_Send_Email();
        // $data["arr_choice_project"] = $this->get_List_Project();
        // $data["arr_choice_web_user"] = $this->get_List_Web_User();
        // $data["arr_choice_android_user"] = $this->get_List_Android_User();
        $data["arr_menu"] = $this->get_List_Menu();

        return view("user-group-management.create", compact("data"));
    }

    private function getLastIdNumber()
    {
        $data = DB::select("SELECT
                id
            FROM
                m_user_group
            ORDER BY id DESC
            LIMIT 1
        ");

        return $data;
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

        $user_group_id = $request->input("user_group_id");
        $name = $request->input("name");
        $description = $request->input("description");
        $is_activ = $request->input("is_activ");
        $arr_menu_id = json_decode($request->input("arr_menu_id"), true);

        $data_error = [];

        if (empty($user_group_id)) {
            $data_error["user_group_id"][] = "User Group is Required";
        }

        if (empty($name)) {
            $data_error["name"][] = "Name is Required";
        }

        if (empty($description)) {
            $data_error["description"][] = "Description is Required";
        }

        if (empty($is_activ)) {
            $data_error["is_activ"][] = "Is Active is Required";
        }

        if (count($data_error) > 0) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ], 200);
        }

        // echo($arr_menu_id);die();
        DB::beginTransaction();
        try {
            $data_menu_access = [];
            for ($i = 0; $i < count($arr_menu_id); $i++) {
                $data_menu_access[] = [
                    "usergroup_id" => $user_group_id,
                    "menu_id" => $arr_menu_id[$i],
                ];
            }

            DB::table("m_user_group")->insert([
                "id" => $user_group_id,
                "name" => $name,
                "description" => $description,
                "is_activ" => $is_activ,
                "created_by" => session("username"),
                "created_at" => $this->datetime_now,
            ]);

            if (!empty($data_menu_access)) {
                DB::table("m_user_group_menu_access")->insert($data_menu_access);
            }

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
            "message" => "Success Add User Group",
            "data" => [],
        ], 200);
    }

    private function get_Group_User($id)
    {
        $data = DB::select("SELECT
        a.id,
        a.name,
        a.description,
        a.is_activ
        FROM m_user_group a
        WHERE a.id = ?

        ", [
            $id,
        ]);

        return $data;
    }

    private function get_User_Access_Arr($id)
    {
        $temp = DB::select("SELECT
        a.menu_id
        FROM m_user_group_menu_access a
        WHERE a.usergroup_id = ?
        ", [
            $id,
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
        $current_data = $this->get_Group_User($id);
        if (count($current_data) == 0) {
            echo "<script>
            alert('User is not found.');
            window.location.href = '" . route('user_group_management.index') . "'
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_user_access"] = $this->get_User_Access_Arr($id);

        $data["arr_choice_is_activ"] = $this->get_List_Is_Activ();
        $data["arr_menu"] = $this->get_List_Menu();

        return view("user-group-management.show", compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Group_User($id);
        if (count($current_data) == 0) {
            echo "<script>
            alert('Group User is not found.');
            </script>";
            exit();
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_user_access"] = $this->get_User_Access_Arr($id);

        $data["arr_choice_is_activ"] = $this->get_List_Is_Activ();
        $data["arr_menu"] = $this->get_List_Menu();

        return view("user-group-management.edit", compact("data"));
    }

    // NEW CODE UPDATE USER GROUP
    public function update(Request $request, $id)
    {
        if (!in_array(session('user_level_id'), [1, 5])) {
            return response()->json([
                "err" => true,
                "message" => "You don't have access for this action, please reload the page.",
                "data" => [],
            ], 200);
        }

        $name = $request->input("name");
        $description = $request->input("description");
        $is_activ = $request->input("is_activ");
        $arr_menu_id = json_decode($request->input("arr_menu_id"), true);

        $data_error = [];

        if (empty($name)) {
            $data_error["name"][] = "Name is Required";
        }

        if (empty($description)) {
            $data_error["description"][] = "Description is Required";
        }

        if (empty($is_activ)) {
            $data_error["is_activ"][] = "Is Active is Required";
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
            // Update user group details
            DB::table("m_user_group")->where("id", $id)->update([
                "name" => $name,
                "description" => $description,
                "is_activ" => $is_activ,
                "updated_at" => $this->datetime_now,
            ]);

            // Remove existing menu access entries
            DB::table("m_user_group_menu_access")->where("usergroup_id", $id)->delete();

            // Prepare new menu access entries
            $data_menu_access = [];
            foreach ($arr_menu_id as $menu_id) {
                $data_menu_access[] = [
                    "usergroup_id" => $id,
                    "menu_id" => $menu_id,
                ];
            }

            // Insert new menu access entries
            if (!empty($data_menu_access)) {
                DB::table("m_user_group_menu_access")->insert($data_menu_access);
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
            "message" => "User Group successfully updated",
            "data" => [],
        ], 200);
    }


    // EXISTING CODE
    // public function update(Request $request, $id)
    // {
    //     $current_data = $this->get_Group_User($id);
    //     if(count($current_data) == 0){
    //         return response()->json([
    //             "err" => true,
    //             "message" => "Group User is not found",
    //             "data" => [],
    //         ],200);
    //     }

    //     $name = $request->input("name");
    //     $description = $request->input("description");
    //     $is_activ = $request->input("is_activ");

    //     $data_error = [];

    //     if(empty($name)){
    //         $data_error["name"][] = "Name is Required";
    //     }

    //     if(empty($description)){
    //         $data_error["description"][] = "Description is Required";
    //     }

    //     if(empty($is_activ)){
    //         $data_error["is_activ"][] = "Is Active is Required";
    //     }

    //     if(count($data_error) > 0){
    //         return response()->json([
    //             "err" => true,
    //             "message" => "Validation Failed",
    //             "data" => $data_error,
    //         ],200);
    //     }

    //     DB::beginTransaction();
    //     try {

    //         $data_menu_access = [];
    //         for ($i=0; $i < count($arr_menu_id); $i++) {
    //             $data_menu_access[] = [
    //                 "id" => $id,
    //                 "menu_id" => $arr_menu_id[$i],
    //             ];
    //         }

    //         print_r($data_menu_access);
    //         DB::table("m_user_group")
    //         ->where("id",$current_data[0]->id)
    //         ->update([
    //             "name" => $name,
    //             "description" => $description,
    //             "is_activ" => $is_activ,
    //             "update_by" => session("username"),
    //             "update_at" => $this->datetime_now,
    //         ]);

    //         DB::table("m_user_group_menu_access")->update($data_menu_access);

    //         DB::commit();

    //     } catch (\Illuminate\Database\QueryException $error) {
    //         \Illuminate\Support\Facades\Log::error('QueryException error',array('context' => $error));
    //         DB::rollBack();
    //         return response()->json([
    //             "err" => true,
    //             "message" => "Something Wrong",
    //             "data" => [],
    //         ],500);

    //     } catch (\Exception $error) {
    //         \Illuminate\Support\Facades\Log::error('Exception error',array('context' => $error));
    //         DB::rollBack();
    //         return response()->json([
    //             "err" => true,
    //             "message" => "Something Wrong",
    //             "data" => [],
    //         ],500);

    //     }

    //     return response()->json([
    //         "err" => false,
    //         "message" => "Success Update User Group",
    //         "data" => [],
    //     ],200);

    // }
}
