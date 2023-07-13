<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterContactController extends Controller
{
    private $menu_id = 30;
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
            'datatablesSupplier',
        ]);
        $this->middleware('check_user_access_update:' . $this->menu_id)->only([
            'edit',
            'update',
            'datatablesSupplier',
        ]);
        $this->middleware('check_user_access_delete:' . $this->menu_id)->only([]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("master-contact.index", compact("data"));
    }

    public function datatables(Request $request)
    {
        $query = DB::table("m_wh_contact_buffer as a")
            ->select([
                "a.contact_id",
                "b.client_project_name",
                "c.supplier_name",
                DB::raw("case when a.is_active='Y' then 'Active'
                ELSE 'Inactive'
                END AS 'status'"),
            ])
            ->leftJoin("m_wh_client_project as b", "b.client_project_id", "=", "a.client_project_id")
            ->leftJoin("m_wh_supplier as c", "c.supplier_id", "=", "a.supplier_id")
            ->where("a.client_project_id", session("current_client_project_id"))
            ->orderBy("a.contact_id", "desc");

        return DataTables::of($query)
            ->addColumn('action', function ($data_contact) {
                $button = "";
                $button .= "<div class='text-center'>";
                $button .= "
                <a href='" . route('master_contact.show', ['id' => $data_contact->contact_id]) . "' class='text-decoration-none'>
                    <button class='btn btn-primary text-xs py-1'>Show</button>
                </a>";
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }


    private function get_Supplier($supplier_id = null)
    {
        return DB::table("m_wh_supplier as a")
            ->select([
                "a.supplier_id",
                "a.supplier_name",
            ])
            ->leftJoin("m_wh_client_project as b", "b.client_id", "=", "a.client_id")
            ->where("b.wh_id", session("current_warehouse_id"))
            ->where("b.client_project_id", session("current_client_project_id"))
            ->where(function ($query) use ($supplier_id) {
                if ($supplier_id !== null) {
                    $query->where("a.supplier_id", $supplier_id);
                }
            })
            ->orderBy("a.supplier_id", "asc")
            ->get();
    }
    public function datatablesSupplier(Request $request)
    {

        $data = $this->get_Supplier();
        return DataTables::of($data)
            ->make(true);
    }

    private function get_List_Project($client_project_id = null)
    {
        if ($client_project_id === null) {
            $client_project_id = session("current_client_project_id");
        }

        return DB::table("m_wh_client_project")
            ->select([
                "client_project_id",
                "client_project_name",
            ])
            ->where("wh_id", session("current_warehouse_id"))
            ->where("client_project_id", $client_project_id)
            ->orderBy("client_project_id", "asc")
            ->get();
    }

    public function create()
    {
        if (!in_array(session('user_level_id'), [1, 2, 5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        $data["list_project"] = $this->get_List_Project();

        return view("master-contact.create", compact("data"));
    }

    public function store(Request $request)
    {
        if (!in_array(session('user_level_id'), [1, 2, 5])) {
            return response()->json([
                "err" => true,
                "message" => "You dont have access for this action, please reload the page.",
                "data" => [],
            ], 200);
        }

        $project_name = $request->input("project_name");
        $supplier_id = $request->input("supplier_id");
        $supplier_name = $request->input("supplier_name");
        $notification_email_address = $request->input("notification_email_address");
        $notification_whatsapp_address = $request->input("notification_whatsapp_address");
        $checkbox_email = $request->input("checkbox_email");
        $checkbox_whatsapp = $request->input("checkbox_whatsapp");
        $checkbox_apps_inbox = $request->input("checkbox_apps_inbox");

        $data_error = [];

        if (empty($project_name)) {
            $data_error["project_name"][] = "Project Name is required";
        }

        if (empty($supplier_id)) {
            $data_error["supplier_name"][] = "Supplier is required";
        } else if (count($this->get_Supplier($supplier_id)) == 0) {
            $data_error["supplier_name"][] = "Supplier is invalid";
        }

        if ($checkbox_email == "Y" && empty($notification_email_address)) {
            $data_error["notification_email_address"][] = "Notification Email Address is required";
        }

        if ($checkbox_whatsapp == "Y" && empty($notification_whatsapp_address)) {
            $data_error["notification_whatsapp_address"][] = "Notification Whatsapp Address is required";
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

            $contact_id = DB::table("m_wh_contact_buffer")
                ->insertGetId([
                    "client_project_id" => $project_name,
                    "supplier_id" => $supplier_id,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);

            if ($checkbox_email == "Y") {
                DB::table("m_wh_contact_buffer_detail")
                    ->insert([
                        "contact_id" => $contact_id,
                        "notification_type_id" => 1,
                        "notification_address" => $notification_email_address,
                        "user_created" => session("username"),
                        "datetime_created" => $this->datetime_now,
                    ]);
            }

            if ($checkbox_whatsapp == "Y") {
                DB::table("m_wh_contact_buffer_detail")
                    ->insert([
                        "contact_id" => $contact_id,
                        "notification_type_id" => 2,
                        "notification_address" => $notification_whatsapp_address,
                        "user_created" => session("username"),
                        "datetime_created" => $this->datetime_now,
                    ]);
            }

            if ($checkbox_apps_inbox == "Y") {
                DB::table("m_wh_contact_buffer_detail")
                    ->insert([
                        "contact_id" => $contact_id,
                        "notification_type_id" => 3,
                        "user_created" => session("username"),
                        "datetime_created" => $this->datetime_now,
                    ]);
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
            "message" => "Success Add Contact",
            "data" => [],
        ], 200);
    }

    private function get_Contact_Buffer_Header($contact_id)
    {
        return DB::table("m_wh_contact_buffer as a")
            ->select([
                "a.contact_id",
                "a.client_project_id",
                "a.supplier_id",
                "a.is_active",
                "b.supplier_name",
            ])
            ->leftJoin("m_wh_supplier as b", "b.supplier_id", "=", "a.supplier_id")
            ->where("a.contact_id", $contact_id)
            ->get();
    }

    private function get_Contact_Buffer_Detail($contact_id, $notification_type_id)
    {
        return DB::table("m_wh_contact_buffer_detail")
            ->select([
                "contact_id",
                "notification_type_id",
                "notification_address",
            ])
            ->where("contact_id", $contact_id)
            ->where("notification_type_id", $notification_type_id)
            ->get();
    }

    public function show(Request $request, $id)
    {
        $current_data_header = $this->get_Contact_Buffer_Header($id);

        if (count($current_data_header) == 0) {
            echo "<script>
            alert('Contact is not found');
            window.location.href = '" . route('master_contact.index') . "';
            </script>";
            exit();
        }

        $data = [];
        $data["list_project"] = $this->get_List_Project();
        $data["current_data_header"] = $current_data_header;
        $data["current_data_detail_email"] = $this->get_Contact_Buffer_Detail($id, 1);
        $data["current_data_detail_whatsapp"] = $this->get_Contact_Buffer_Detail($id, 2);
        $data["current_data_detail_apps_inbox"] = $this->get_Contact_Buffer_Detail($id, 3);
        // dd($data);
        return view("master-contact.show", compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $current_data_header = $this->get_Contact_Buffer_Header($id);

        if (count($current_data_header) == 0) {
            echo "<script>
            alert('Contact is not found');
            window.location.href = '" . route('master_contact.index') . "';
            </script>";
            exit();
        }

        $data = [];
        $data["list_project"] = $this->get_List_Project();
        $data["current_data_header"] = $current_data_header;
        $data["current_data_detail_email"] = $this->get_Contact_Buffer_Detail($id, 1);
        $data["current_data_detail_whatsapp"] = $this->get_Contact_Buffer_Detail($id, 2);
        $data["current_data_detail_apps_inbox"] = $this->get_Contact_Buffer_Detail($id, 3);

        return view("master-contact.edit", compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data_header = $this->get_Contact_Buffer_Header($id);

        if (count($current_data_header) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Contact is not found, Please Reload Page.",
                "data" => [],
            ], 200);
        }

        $contact_id = $current_data_header[0]->contact_id;
        $project_name = $request->input("project_name");
        $supplier_id = $request->input("supplier_id");
        $supplier_name = $request->input("supplier_name");
        $notification_email_address = $request->input("notification_email_address");
        $notification_whatsapp_address = $request->input("notification_whatsapp_address");
        $checkbox_email = $request->input("checkbox_email");
        $checkbox_whatsapp = $request->input("checkbox_whatsapp");
        $checkbox_apps_inbox = $request->input("checkbox_apps_inbox");
        $checkbox_status = $request->input("checkbox_status");

        $data_error = [];

        if (empty($project_name)) {
            $data_error["project_name"][] = "Project Name is required";
        }

        if (empty($supplier_id)) {
            $data_error["supplier_name"][] = "Supplier is required";
        } else if (count($this->get_Supplier($supplier_id)) == 0) {
            $data_error["supplier_name"][] = "Supplier is invalid";
        }

        if ($checkbox_email == "Y" && empty($notification_email_address)) {
            $data_error["notification_email_address"][] = "Notification Email Address is required";
        }

        if ($checkbox_whatsapp == "Y" && empty($notification_whatsapp_address)) {
            $data_error["notification_whatsapp_address"][] = "Notification Whatsapp Address is required";
        }

        if (empty($checkbox_status)) {
            $data_error["checkbox_status"][] = "Status is required";
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

            DB::table("m_wh_contact_buffer")
                ->where("contact_id", $contact_id)
                ->update([
                    "client_project_id" => $project_name,
                    "supplier_id" => $supplier_id,
                    "is_active" => $checkbox_status,
                    "user_updated" => session("username"),
                    "datetime_updated" => $this->datetime_now,
                ]);

            DB::table("m_wh_contact_buffer_detail")
                ->where("contact_id", $contact_id)
                ->delete();

            if ($checkbox_email == "Y") {
                DB::table("m_wh_contact_buffer_detail")
                    ->insert([
                        "contact_id" => $contact_id,
                        "notification_type_id" => 1,
                        "notification_address" => $notification_email_address,
                        "user_created" => session("username"),
                        "datetime_created" => $this->datetime_now,
                    ]);
            }

            if ($checkbox_whatsapp == "Y") {
                DB::table("m_wh_contact_buffer_detail")
                    ->insert([
                        "contact_id" => $contact_id,
                        "notification_type_id" => 2,
                        "notification_address" => $notification_whatsapp_address,
                        "user_created" => session("username"),
                        "datetime_created" => $this->datetime_now,
                    ]);
            }

            if ($checkbox_apps_inbox == "Y") {
                DB::table("m_wh_contact_buffer_detail")
                    ->insert([
                        "contact_id" => $contact_id,
                        "notification_type_id" => 3,
                        "user_created" => session("username"),
                        "datetime_created" => $this->datetime_now,
                    ]);
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
            "message" => "Success Update Contact",
            "data" => [],
        ], 200);
    }
}
