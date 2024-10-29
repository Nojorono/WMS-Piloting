<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MasterBufferController extends Controller
{
    private $menu_id = 38;
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
            "datatablesContact",
            "datatablesSKU",
        ]);
        $this->middleware('check_user_access_update:' . $this->menu_id)->only([
            'edit',
            'update',
            "datatablesContact",
            "datatablesSKU",
        ]);
        $this->middleware('check_user_access_delete:' . $this->menu_id)->only([]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("master-buffer.index", compact("data"));
    }

    public function datatables(Request $request)
    {
        // dummy data
        $data = DB::select("SELECT a.buffer_id, c.client_project_name, d.supplier_name, a.sku, e.`desc` AS rules, a.qty_buffer
        FROM m_wh_buffer a
        LEFT JOIN m_wh_contact_buffer b ON a.contact_id=b.contact_id
        LEFT JOIN m_wh_client_project c ON b.client_project_id=c.client_project_id
        LEFT JOIN m_wh_supplier d ON b.supplier_id=d.supplier_id
        LEFT JOIN m_wh_rules e ON a.rules_id=e.rules_id
        WHERE b.client_project_id= ? #based on login
        ORDER BY a.buffer_id ASC
        ", [
            session("current_client_project_id"),
        ]);

        return DataTables::of($data)
            ->addColumn('action', function ($data_buffer) {
                $button = "";
                $button .= "<div class='text-center'>";
                $button .= "<a href='" . route('master_buffer.show', ['id' => $data_buffer->buffer_id,]) . "' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 py-1'>Show</button>
            </a>";
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }

    private function get_Contact($contact_id = null)
    {
        return DB::table("m_wh_contact_buffer as a")
            ->select([
                "a.contact_id",
                "b.client_project_name",
                "c.supplier_name",
            ])
            ->leftJoin("m_wh_client_project as b", "b.client_project_id", "=", "a.client_project_id")
            ->leftJoin("m_wh_supplier as c", "c.supplier_id", "=", "a.supplier_id")
            ->where("a.client_project_id", session("current_client_project_id"))
            ->where(function ($query) use ($contact_id) {
                if ($contact_id !== null) {
                    $query->where("a.contact_id", $contact_id);
                }
            })
            ->get();
    }

    public function datatablesContact()
    {
        $data = $this->get_Contact();
        return DataTables::of($data)
            ->make(true);
    }

    private function get_SKU($sku = null)
    {

        return DB::table("m_wh_item as a")
            ->select([
                "a.sku",
                "a.part_name",
            ])
            ->leftJoin("m_warehouse as c","c.wh_id","=","a.wh_id")
            ->leftJoin("m_wh_client_project as b", function ($query) {
                $query->on("b.client_project_id", "=", "c.client_project_id");
                $query->on("b.client_id", "=", "a.client_id");
            })
            ->where("a.wh_id", session("current_warehouse_id"))
            ->where("b.client_project_id", session("current_client_project_id"))
            ->where(function ($query) use ($sku) {
                if ($sku !== null) {
                    $query->where("a.sku", $sku);
                }
            })
            ->orderBy("a.sku", "asc")
            ->get();
    }

    public function datatablesSKU()
    {
        $data = $this->get_SKU();
        return DataTables::of($data)
            ->make(true);
    }

    private function get_List_Rules($rules_id = null)
    {

        return DB::table("m_wh_rules")
            ->select([
                "rules_id",
                "desc",
            ])
            ->where(function ($query) use ($rules_id) {
                if ($rules_id !== null) {
                    $query->where("rules_id", $rules_id);
                }
            })
            ->get();
    }

    public function create()
    {
        if (!in_array(session('user_level_id'), [1, 2, 5])) {
            return redirect(route('forbidden'));
        }

        $data = [];
        $data["list_rules"] = $this->get_List_Rules();
        return view("master-buffer.create", compact("data"));
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

        $contact_id = $request->input("contact_id");
        $sku = $request->input("sku");
        $buffer_qty = $request->input("buffer_qty");
        $rules = $request->input("rules");
        $messages = $request->input("messages");

        $data_error = [];

        if (empty($contact_id)) {
            $data_error["contact_id"][] = "Contact is required";
        } else if (count($this->get_Contact($contact_id)) == 0) {
            $data_error["contact_id"][] = "Contact is invalid";
        }

        if (empty($sku)) {
            $data_error["sku"][] = "SKU is required";
        } else if (count($this->get_SKU($sku)) == 0) {
            $data_error["sku"][] = "SKU is invalid";
        }

        if (empty($buffer_qty)) {
            $data_error["buffer_qty"][] = "Buffer Qty is required";
        }

        if (empty($rules)) {
            $data_error["rules"][] = "rules is required";
        } else if (count($this->get_List_Rules($rules)) == 0) {
            $data_error["rules"][] = "rules is invalid";
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

            $default_remarks = DB::select("SELECT a.remarks
            FROM m_wh_parameter a
            WHERE a.rules_id = ?
            ", [
                $rules,
            ]);

            if (empty($messages)) {
                $messages = @$default_remarks[0]->remarks;
            }

            DB::table("m_wh_buffer")
                ->insertGetId([
                    "contact_id" => $contact_id,
                    "sku" => $sku,
                    "qty_buffer" => $buffer_qty,
                    "rules_id" => $rules,
                    "messages" => $messages,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);



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
            "message" => "Success Add Buffer",
            "data" => [],
        ], 200);
    }

    private function get_Buffer($buffer_id)
    {
        return DB::select("SELECT a.buffer_id, a.contact_id, a.sku, a.qty_buffer, d.rules_id, a.messages
        FROM m_wh_buffer a
        LEFT JOIN m_wh_contact_buffer b ON a.contact_id=b.contact_id
        LEFT JOIN m_wh_supplier c ON b.supplier_id=c.supplier_id
        LEFT JOIN m_wh_rules d ON a.rules_id=d.rules_id
        WHERE a.buffer_id= ? ", [
            $buffer_id,
        ]);
    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Buffer($id);
        if (count($current_data) == 0) {
            echo "<script>
            alert('Buffer is not found');
            window.location.href = '" . route('master_buffer.index') . "';
            </script>";
            exit();
        }

        $data = [];
        $data["list_rules"] = $this->get_List_Rules();
        $data["current_data"] = $current_data;

        return view("master-buffer.show", compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data = $this->get_Buffer($id);
        if (count($current_data) == 0) {
            echo "<script>
            alert('Buffer is not found');
            window.location.href = '" . route('master_buffer.index') . "';
            </script>";
            exit();
        }

        $data = [];
        $data["list_rules"] = $this->get_List_Rules();
        $data["current_data"] = $current_data;

        return view("master-buffer.edit", compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data = $this->get_Buffer($id);

        if (count($current_data) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Buffer is not found, Please Reload Page.",
                "data" => [],
            ], 200);
        }

        $buffer_id = @$current_data[0]->buffer_id;
        $contact_id = $request->input("contact_id");
        $sku = $request->input("sku");
        $buffer_qty = $request->input("buffer_qty");
        $rules = $request->input("rules");
        $messages = $request->input("messages");

        $data_error = [];

        if (empty($contact_id)) {
            $data_error["contact_id"][] = "Contact is required";
        } else if (count($this->get_Contact($contact_id)) == 0) {
            $data_error["contact_id"][] = "Contact is invalid";
        }

        if (empty($sku)) {
            $data_error["sku"][] = "SKU is required";
        } else if (count($this->get_SKU($sku)) == 0) {
            $data_error["sku"][] = "SKU is invalid";
        }

        if (empty($buffer_qty)) {
            $data_error["buffer_qty"][] = "Buffer Qty is required";
        }

        if (empty($rules)) {
            $data_error["rules"][] = "rules is required";
        } else if (count($this->get_List_Rules($rules)) == 0) {
            $data_error["rules"][] = "rules is invalid";
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

            $default_remarks = DB::select("SELECT a.remarks
            FROM m_wh_parameter a
            WHERE a.rules_id = ?
            ", [
                $rules,
            ]);

            if (empty($messages)) {
                $messages = @$default_remarks[0]->remarks;
            }

            DB::table("m_wh_buffer")
                ->where("buffer_id", $buffer_id)
                ->update([
                    "contact_id" => $contact_id,
                    "sku" => $sku,
                    "qty_buffer" => $buffer_qty,
                    "rules_id" => $rules,
                    "messages" => $messages,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);

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
            "message" => "Success Update Buffer",
            "data" => [],
        ], 200);
    }
}
