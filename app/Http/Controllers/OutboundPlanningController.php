<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\Facades\DataTables;

class OutboundPlanningController extends Controller
{
    private $menu_id = 13;
    private $datetime_now;

    public function __construct()
    {
        $this->middleware('check_user_access_read:' . $this->menu_id)->only([
            'index',
            'datatables',
            'datatablesOrderType',
            'datatablesOutboundStatus',
            'show',
            'confirmPlanning',
        ]);
        $this->middleware('check_user_access_create:' . $this->menu_id)->only([
            'create',
            'datatablesClassification',
            'datatablesUOM',
            'datatablesSKU',
            'datatablesSupplier',
            'tablesSKUDetails',
            'datatablesSupervisor',
            'datatablesVehicleType',
            'datatablesTransporter',
            'datatablesServiceType',
        ]);
        $this->middleware('check_user_access_update:' . $this->menu_id)->only([
            'edit',
            'update',
            'cancelOutboundPlanning',
        ]);
        $this->middleware('check_user_access_delete:' . $this->menu_id)->only([]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("outbound-planning.index", compact("data"));
    }

    private function getOutboundListDatatables($outbound_id, $reference_no, $plan_delivery_date, $order_id, $status_id)
    {

        $data = DB::query()
            ->select([
                "a.outbound_planning_no AS outbound_id",
                "b.wh_code AS warehouse_name",
                "f.client_name",
                "a.reference_no",
                "a.plan_delivery AS plan_delivery_date",
                "c.order_type",
                "d.status_name AS outbound_status",
            ])
            ->from("t_wh_outbound_planning as a")
            ->leftJoin("m_warehouse as b", "a.wh_id", "=", "b.wh_id")
            ->leftJoin("m_wh_order_type as c", "c.order_id", "=", "a.order_id")
            ->leftJoin("m_status as d", "d.status_id", "=", "a.status_id")
            ->leftJoin("m_wh_client_project as e", "e.client_project_id", "=", "a.client_project_id")
            ->leftJoin("m_wh_client as f", "f.client_id", "=", "e.client_id")
            ->where("a.wh_id", session('current_warehouse_id'))
            ->where("a.client_project_id", session('current_client_project_id'))
            ->where(function ($query) use ($outbound_id) {
                if (!empty($outbound_id)) {
                    $query->where("a.outbound_planning_no", $outbound_id);
                }
            })
            ->where(function ($query) use ($reference_no) {
                if (!empty($reference_no)) {
                    $query->where("a.reference_no", $reference_no);
                }
            })
            ->where(function ($query) use ($plan_delivery_date) {
                if (!empty($plan_delivery_date)) {
                    $query->where("a.plan_delivery", $plan_delivery_date);
                }
            })
            ->where(function ($query) use ($order_id) {
                if (!empty($order_id)) {
                    $query->where("a.order_id", $order_id);
                }
            })
            ->where(function ($query) use ($status_id) {
                if (!empty($status_id)) {
                    $query->where("a.status_id", $status_id);
                }
            })
            ->orderBy("a.datetime_created", "DESC")
            ->get();
        return $data;
    }

    public function datatables(Request $request)
    {
        $outbound_id = $request->input("outbound_id");
        $reference_no = $request->input("reference_no");
        $plan_delivery_date = $request->input("plan_delivery_date");
        $order_id = $request->input("order_id");
        $order_type = $request->input("order_type");
        $status_id = $request->input("status_id");
        $outbound_status = $request->input("outbound_status");

        $data = $this->getOutboundListDatatables($outbound_id, $reference_no, $plan_delivery_date, $order_id, $status_id);

        return DataTables::of($data)
            ->addColumn('action', function ($outbound) {
                $button = "";
                $button .= "<div class='text-center'>";
                $button .= "<a href='" . route('outbound_planning.show', ['id' => $outbound->outbound_id]) . "' class='text-decoration-none'>
            <button class='btn btn-primary text-xs py-1 mb-0'>Show</button>
            </a>";
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }

    private function getOrderType($order_id = false)
    {
        $data = DB::query()
            ->select([
                "a.order_id",
                "a.order_type",
            ])
            ->from("m_wh_order_type as a")
            ->where("a.is_active", "Y")
            ->where(function ($query) use ($order_id) {
                if ($order_id !== false) {
                    $query->where("a.order_id", $order_id);
                }
            })
            ->orderBy("a.order_type", "ASC")
            ->get();
        return $data;
    }

    public function datatablesOrderType(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getOrderType();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
            ->make(true);
    }

    private function getOutboundStatus($status_id = false)
    {
        $data = DB::query()
            ->select([
                "a.status_id",
                "a.status_name",
                "a.process_id",
            ])
            ->from("m_status as a")
            ->leftJoin("m_process as b", "b.process_id", "=", "a.process_id")
            ->where("b.process_id", 19)
            ->where("a.is_active", "Y")
            ->where(function ($query) use ($status_id) {
                if (!empty($status_id)) {
                    $query->where("a.status_id", $status_id);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesOutboundStatus()
    {
        $data = $this->getOutboundStatus();

        return DataTables::of($data)
            ->make(true);
    }

    private function get_Supervisor($supervisor_id = false)
    {
        $data = DB::query()
            ->select([
                "a.supervisor_id",
                "a.name AS supervisor_name",
            ])
            ->from("t_wh_supervisor as a")
            ->where("a.is_active", "Y")
            ->where("a.client_project_id", session("current_client_project_id"))
            ->where(function ($query) use ($supervisor_id) {
                if ($supervisor_id != false) {
                    $query->where("a.supervisor_id", $supervisor_id);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesSupervisor(Request $request)
    {
        $data = $this->get_Supervisor();

        return DataTables::of($data)
            ->make(true);
    }

    private function get_Vehicle_Type($vehicle_id = false)
    {
        $data = DB::query()
            ->select([
                "a.vehicle_id",
                "a.vehicle_type",
                "a.vehicle_description",
            ])
            ->from("m_wh_vehicle as a")
            ->where("a.is_active", "Y")
            ->where(function ($query) use ($vehicle_id) {
                if ($vehicle_id != false) {
                    $query->where("a.vehicle_id", $vehicle_id);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesVehicleType(Request $request)
    {
        $data = $this->get_Vehicle_Type();

        return DataTables::of($data)
            ->make(true);
    }

    private function get_Transporter($transporter_id = false)
    {
        $data = DB::query()
            ->select([
                "a.transporter_id",
                "a.transporter_name",
            ])
            ->from("m_wh_transporter as a")
            ->where("a.is_active", "Y")
            ->where(function ($query) use ($transporter_id) {
                if ($transporter_id != false) {
                    $query->where("a.transporter_id", $transporter_id);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesTransporter(Request $request)
    {
        $data = $this->get_Transporter();

        return DataTables::of($data)
            ->make(true);
    }

    private function get_Service_Type($service_id = false)
    {
        $data = DB::query()
            ->select([
                "a.service_id",
                "a.service_name",
                "a.service_description",
            ])
            ->from("m_wh_service_type as a")
            ->where("a.is_active", "Y")
            ->where(function ($query) use ($service_id) {
                if ($service_id != false) {
                    $query->where("a.service_id", $service_id);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesServiceType(Request $request)
    {
        $data = $this->get_Service_Type();

        return DataTables::of($data)
            ->make(true);
    }

    public function create()
    {
        $data = [];
        return view("outbound-planning.create", compact("data"));
    }

    private function getClassification($item_classification_id = false)
    {
        $data = DB::query()
            ->select([
                "a.item_classification_id",
                "a.classification_name",
            ])
            ->from("m_item_classification as a")
            ->where("a.process_id", 19)
            ->where(function ($query) use ($item_classification_id) {
                if ($item_classification_id !== false) {
                    $query->where("a.item_classification_id", $item_classification_id);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesClassification(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getClassification();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
            ->make(true);
    }

    private function getUOM($uom_name = false)
    {
        $data = DB::query()
            ->select([
                "a.uom_name",
            ])
            ->from("m_item_uom as a")
            ->where("a.is_active", "Y")
            ->where(function ($query) use ($uom_name) {
                if ($uom_name !== false) {
                    $query->where("a.uom_name", $uom_name);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesUOM(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getUOM();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
            ->make(true);
    }

    private function getSKU($sku = false)
    {
        $data = DB::query()
            ->select([
                "a.sku",
                "a.part_name",
                "a.imei",
                "a.part_no",
                "a.color",
                "a.size",
            ])
            ->from("m_wh_item as a")
            ->where("a.wh_id", session('current_warehouse_id'))
            ->where("a.client_id", session('current_client_id'))
            ->where(function ($query) use ($sku) {
                if ($sku !== false) {
                    $query->where("a.sku", $sku);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesSKU(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getSKU();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
            ->make(true);
    }

    private function getSupplier($supplier_id = false)
    {
        $data = DB::query()
            ->select([
                "a.supplier_id",
                "a.supplier_name",
                "a.address1",
            ])
            ->from("m_wh_supplier as a")
            ->where("a.client_id", session('current_client_id'))
            ->where(function ($query) use ($supplier_id) {
                if ($supplier_id !== false) {
                    $query->where("a.supplier_id", $supplier_id);
                }
            })
            ->get();

        return $data;
    }

    public function datatablesSupplier(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getSupplier();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
            ->make(true);
    }

    public function tablesSKUDetails(Request $request)
    {
        $sku = $request->input("sku");
        if (empty($sku)) {
            return response()->json([
                "err" => true,
                "message" => "SKU cant be empty",
                "data" => [],
            ], 200);
        }

        $data = DB::query()
            ->select([
                "a.batch_no",
                "a.sku",
                "b.part_name",
                DB::raw("SUM(a.available_qty) AS available_qty"),
                "a.expired_date",
                "a.gr_id",
            ])
            ->from("t_wh_location_inventory as a")
            ->leftJoin("m_wh_item as b", "b.sku", "=", "a.sku")
            ->leftJoin("t_wh_receive as c", "c.gr_id", "=", "a.gr_id")
            ->leftJoin("t_wh_inbound_planning as d", "d.inbound_planning_no", "=", "c.inbound_planning_no")
            ->leftJoin("m_wh_stock_type as e", "e.stock_id", "=", "a.stock_id")
            ->where("a.sku", $sku)
            ->where(function ($query) {
                $query->where("a.batch_no", "<>", "");
                $query->orWhereNotNull("a.batch_no");
            })
            ->where("d.client_project_id", session('current_client_project_id'))
            ->where("e.selling_type", "1")
            ->groupBy("a.batch_no")
            ->groupBy("a.sku")
            ->get();

        return response()->json([
            "err" => false,
            "message" => "Success get SKU Details",
            "data" => $data,
        ], 200);
    }

    private function getLastRunningNumber($process_code)
    {
        $running_number = 0;

        $data = DB::query()
            ->select([
                "a.running_number",
            ])
            ->from("t_running_number as a")
            ->where("a.process_code", $process_code)
            ->where("a.date", date("Y-m", strtotime($this->datetime_now)))
            ->where("a.wh_id", session("current_warehouse_id"))
            ->get();

        if (count($data) == 0) {
            $insert_running_number = DB::table("t_running_number")
                ->insert([
                    "process_code" => $process_code,
                    "date" => date("Y-m", strtotime($this->datetime_now)),
                    "wh_id" => session("current_warehouse_id"),
                    "running_number" => 0,
                ]);
            return $running_number;
        }

        $running_number = $data[0]->running_number;

        return $running_number;
    }

    private function getWHPrefix()
    {
        $wh_prefix = false;

        $data = DB::query()
            ->select([
                "a.wh_prefix",
            ])
            ->from("m_warehouse as a")
            ->where("a.wh_id", session("current_warehouse_id"))
            ->get();

        if (count($data) == 0) {

            return $wh_prefix;
        }

        $wh_prefix = $data[0]->wh_prefix;

        return $wh_prefix;
    }

    private function mustFourDigits($data)
    {
        while (strlen($data) < 4) {
            $data = "0" . $data;
        }
        return $data;
    }

    private function getStatusID($process_code, $status_id)
    {
        $data = DB::query()
            ->select([
                "b.status_id",
            ])
            ->from("m_process AS a")
            ->leftJoin("m_status AS b", "b.process_id", "=", "a.process_id")
            ->where("a.process_code", $process_code)
            ->where("b.status_id", $status_id)
            ->get();

        if (count($data) == 0) {
            return false;
        }

        $result_status_id = $data[0]->status_id;

        return $result_status_id;
    }

    private function updateRunningNumber($last_running_number)
    {
        $data = DB::table("t_running_number as a")
            ->where("a.process_code", "OUT")
            ->where("a.date", date("Y-m", strtotime($this->datetime_now)))
            ->where("a.wh_id", session("current_warehouse_id"))
            ->update([
                "running_number" => $last_running_number,
            ]);
    }

    private function uploadFTP($file, $target_dir)
    {
        return Storage::disk('ftp')->put($target_dir, $file);
    }

    public function storeOutboundPlanning(Request $request)
    {
        $supplier_id = $request->input("supplier_id");
        $supplier_address = $request->input("supplier_address");
        $reference_no = $request->input("reference_no");
        $receipt_no = $request->input("receipt_no");
        $plan_delivery_date = $request->input("plan_delivery_date");
        $order_id = $request->input("order_id");
        $order_type = $request->input("order_type");
        $remarks = $request->input("remarks");

        $supervisor = $request->input("supervisor");
        $start_loading_date = $request->input("start_loading_date");
        $start_loading_time = $request->input("start_loading_time");
        $finish_loading_date = $request->input("finish_loading_date");
        $finish_loading_time = $request->input("finish_loading_time");
        $vehicle_no = $request->input("vehicle_no");
        $driver = $request->input("driver");
        $vehicle_id = $request->input("vehicle_id");
        $transporter = $request->input("transporter");
        $container_no = $request->input("container_no");
        $seal_no = $request->input("seal_no");
        $consignee_name = $request->input("consignee_name");
        $consignee_address = $request->input("consignee_address");
        $consignee_city = $request->input("consignee_city");
        $service_id = $request->input("service_id");
        $remark = $request->input("remark");
        $phone = $request->input("phone");

        $arr_sku_no = json_decode($request->input("arr_sku_no"), true);
        $arr_item_name = json_decode($request->input("arr_item_name"), true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"), true);
        $arr_imei_no = json_decode($request->input("arr_imei_no"), true);
        $arr_part_no = json_decode($request->input("arr_part_no"), true);
        $arr_color = json_decode($request->input("arr_color"), true);
        $arr_size = json_decode($request->input("arr_size"), true);
        $arr_qty_request = json_decode($request->input("arr_qty_request"), true);
        $arr_uom = json_decode($request->input("arr_uom"), true);
        $arr_id_classification = json_decode($request->input("arr_id_classification"), true);
        $arr_classification = json_decode($request->input("arr_classification"), true);

        $arr_quantity_details_batch_no = json_decode($request->input("arr_quantity_details_batch_no"), true);
        $arr_quantity_details_sku = json_decode($request->input("arr_quantity_details_sku"), true);
        $arr_quantity_details_part_name = json_decode($request->input("arr_quantity_details_part_name"), true);
        $arr_quantity_details_available_qty = json_decode($request->input("arr_quantity_details_available_qty"), true);
        $arr_quantity_details_expired_date = json_decode($request->input("arr_quantity_details_expired_date"), true);
        $arr_quantity_details_gr_id = json_decode($request->input("arr_quantity_details_gr_id"), true);
        $arr_quantity_details_allocated_qty = json_decode($request->input("arr_quantity_details_allocated_qty"), true);

        $data_error = [];
        if (empty($supplier_id)) {
            $data_error["supplier_name"][] = "Supplier is is Required";
        }
        if (empty($reference_no)) {
            $data_error["reference_no"][] = "Reference No is Required";
        }
        if (empty($receipt_no)) {
            $data_error["receipt_no"][] = "Receipt No is Required";
        }
        if (empty($plan_delivery_date)) {
            $data_error["plan_delivery_date"][] = "Plan Delivery Date is Required";
        }
        if (empty($order_id)) {
            $data_error["order_type"][] = "Order Type is Required";
        }

        if (empty($service_id)) {
            $data_error["service_type"][] = "Service Type Required";
        }

        if (empty($consignee_name)) {
            $data_error["consignee_name"][] = "Consignee Name Required";
        }

        if (empty($consignee_address)) {
            $data_error["consignee_address"][] = "Consignee Address Required";
        }

        if (empty($consignee_city)) {
            $data_error["consignee_city"][] = "Consignee City Required";
        }

        if (empty($phone)) {
            $data_error["phone"][] = "Phone Required";
        }

        if (
            count($arr_sku_no) == 0 ||
            count($arr_item_name) == 0 ||
            count($arr_serial_no) == 0 ||
            count($arr_imei_no) == 0 ||
            count($arr_part_no) == 0 ||
            count($arr_color) == 0 ||
            count($arr_size) == 0 ||
            count($arr_qty_request) == 0 ||
            count($arr_uom) == 0 ||
            count($arr_id_classification) == 0 ||
            count($arr_classification) == 0
        ) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details is required",
                "data" => $data_error,
            ], 200);
        }

        $exist_sku = [];
        foreach ($arr_sku_no as $key_sku_no => $sku_no) {
            $id_sku_no = isset($sku_no['id']) ? $sku_no['id'] : null;
            $value = isset($sku_no['value']) ? $sku_no['value'] : null;
            if (empty($value)) {
                $data_error[$id_sku_no][] = "Sku No is required";
            } else if (!empty($value)) {
                $check_SKU = $this->getSKU($value);
                if (count($check_SKU) == 0) {
                    $data_error[$id_sku_no][] = "Sku No is not exist in database";
                } else if (array_key_exists($value, $exist_sku)) {
                    $data_error[$id_sku_no][] = "Sku No is already used in other row";
                    $data_error[$exist_sku[$value]][] = "Sku No is already used";
                }
                $exist_sku[$value] = $id_sku_no;
            }
        }

        foreach ($arr_qty_request as $key_qty_request => $value_qty_request) {
            $id_qty_request = isset($value_qty_request['id']) ? $value_qty_request['id'] : null;
            $value = isset($value_qty_request['value']) ? $value_qty_request['value'] : null;
            $sku_value = isset($arr_sku_no[$key_qty_request]['value']) ? $arr_sku_no[$key_qty_request]['value'] : null;
            $temp_total_allocated_qty = 0;
            if (empty($value)) {
                $data_error[$id_qty_request][] = "Qty Request is required";
            } else {
                if (count($arr_quantity_details_sku) > 0) {
                    foreach ($arr_quantity_details_sku as $key_quantity_details_sku => $value_quantity_details_sku) {
                        $quantity_details_sku_id = isset($value_quantity_details_sku['id']) ? $value_quantity_details_sku['id'] : null;
                        $quantity_details_sku_value = isset($value_quantity_details_sku['value']) ? $value_quantity_details_sku['value'] : null;
                        $quantity_details_allocated_qty_id = isset($arr_quantity_details_allocated_qty[$key_quantity_details_sku]['id']) ? $arr_quantity_details_allocated_qty[$key_quantity_details_sku]['id'] : null;
                        $quantity_details_allocated_qty_value = isset($arr_quantity_details_allocated_qty[$key_quantity_details_sku]['value']) ? $arr_quantity_details_allocated_qty[$key_quantity_details_sku]['value'] : null;

                        if ($sku_value == $quantity_details_sku_value) {
                            $temp_total_allocated_qty += $quantity_details_allocated_qty_value;
                        }
                    }
                    if ($temp_total_allocated_qty > $value) {
                        $data_error[$id_qty_request][] = "Allocated Qty in Quantity Details is more than Qty Request, please update Quantity Details.";
                    }
                }
            }
        }

        foreach ($arr_uom as $key_uom => $value_uom) {
            $id_uom = isset($value_uom['id']) ? $value_uom['id'] : null;
            $value = isset($value_uom['value']) ? $value_uom['value'] : null;
            if (empty($value)) {
                $data_error[$id_uom][] = "Uom Request is required";
            } else {
                $check_UOM = $this->getUOM($value);
                if (count($check_UOM) == 0) {
                    $data_error[$id_uom][] = "UOM is not exist in database";
                }
            }
        }

        foreach ($arr_id_classification as $key_id_classification => $value_id_classification) {
            $id_classification = isset($value_id_classification['id']) ? $value_id_classification['id'] : null;
            $value_id_classification = isset($value_id_classification['value']) ? $value_id_classification['value'] : null;
            $classification_dom_id = isset($arr_classification[$key_id_classification]['id']) ? $arr_classification[$key_id_classification]['id'] : null;
            $classification_dom_value = isset($arr_classification[$key_id_classification]['value']) ? $arr_classification[$key_id_classification]['value'] : null;
            if (empty($value_id_classification)) {
                $data_error[$classification_dom_id][] = "Classification Request is required";
            } else {
                $check_id_classification = $this->getClassification($value_id_classification);
                if (count($check_id_classification) == 0) {
                    $data_error[$classification_dom_id][] = "Classification is not exist in database";
                }
            }
        }

        if (count($data_error) > 0) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ], 200);
        }

        $validated = [
            "supplier_id" => $supplier_id,
            "supplier_address" => $supplier_address,
            "reference_no" => $reference_no,
            "receipt_no" => $receipt_no,
            "plan_delivery_date" => $plan_delivery_date,
            "order_id" => $order_id,
            "order_type" => $order_type,
            "remarks" => $remarks,
            "arr_sku_no" => $arr_sku_no,
            "arr_item_name" => $arr_item_name,
            "arr_serial_no" => $arr_serial_no,
            "arr_imei_no" => $arr_imei_no,
            "arr_part_no" => $arr_part_no,
            "arr_color" => $arr_color,
            "arr_size" => $arr_size,
            "arr_qty_request" => $arr_qty_request,
            "arr_uom" => $arr_uom,
            "arr_id_classification" => $arr_id_classification,
            "arr_classification" => $arr_classification,
            "arr_quantity_details_batch_no" => $arr_quantity_details_batch_no,
            "arr_quantity_details_sku" => $arr_quantity_details_sku,
            "arr_quantity_details_part_name" => $arr_quantity_details_part_name,
            "arr_quantity_details_available_qty" => $arr_quantity_details_available_qty,
            "arr_quantity_details_expired_date" => $arr_quantity_details_expired_date,
            "arr_quantity_details_gr_id" => $arr_quantity_details_gr_id,
            "arr_quantity_details_allocated_qty" => $arr_quantity_details_allocated_qty,
        ];

        DB::beginTransaction();
        try {

            $process_code = "OUT";
            $status_id = $this->getStatusID($process_code, "UNO");
            if (!$status_id) {
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Status ID is not defined",
                    "data" => [],
                ], 200);
            }

            $wh_prefix = $this->getWHPrefix();
            $date_format_outbound_planning = date("my", strtotime($this->datetime_now));
            $current_running_number = $this->getLastRunningNumber($process_code) + 1;
            $running_number = $this->mustFourDigits($current_running_number);
            $outbound_id = $wh_prefix . "-" . $process_code . "-" . $date_format_outbound_planning . "-" . $running_number;
            if ($current_running_number > 9999) {
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Running Number is more than 9999, cant create more.",
                    "data" => [],
                ], 200);
            }
            $this->updateRunningNumber($current_running_number);

            DB::table("t_wh_outbound_planning")
                ->insertGetId([
                    "outbound_planning_no" => $outbound_id,
                    "wh_id" => session("current_warehouse_id"),
                    "client_project_id" => session("current_client_project_id"),
                    "supplier_id" => $validated["supplier_id"],
                    "order_id" => $validated["order_id"],
                    "status_id" => $status_id,
                    "reference_no" => $validated["reference_no"],
                    "receipt_no" => $validated["receipt_no"],
                    "plan_delivery" => date("Y-m-d", strtotime($validated["plan_delivery_date"])),
                    "notes" => $validated["remarks"],
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);

            $max_row_detail = count($validated["arr_sku_no"]);
            for ($i = 0; $i < $max_row_detail; $i++) {
                $data_insert_t_wh_outbound_planning_detail = [
                    "outbound_planning_no" => $outbound_id,
                    "sku" => $validated["arr_sku_no"][$i]["value"],
                    "qty" => $validated["arr_qty_request"][$i]["value"],
                    "uom_name" => $validated["arr_uom"][$i]["value"],
                    "clasification_id" => $validated["arr_id_classification"][$i]["value"],
                    "serial_no" => $validated["arr_serial_no"][$i]["value"],
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];
                DB::table("t_wh_outbound_planning_detail")
                    ->insert($data_insert_t_wh_outbound_planning_detail);
            }

            $max_row_quantity_detail = count($validated["arr_quantity_details_sku"]);
            for ($i = 0; $i < $max_row_quantity_detail; $i++) {
                $expired_date = (!empty($validated["arr_quantity_details_expired_date"][$i]["value"])) ? date("Y-m-d", strtotime($validated["arr_quantity_details_expired_date"][$i]["value"])) : null;
                $data_insert_t_wh_outbound_detail_sku = [
                    "outbound_planning_no" => $outbound_id,
                    "sku" => @$validated["arr_quantity_details_sku"][$i]["value"],
                    "batch_no" => @$validated["arr_quantity_details_batch_no"][$i]["value"],
                    "gr_id" => @$validated["arr_quantity_details_gr_id"][$i]["value"],
                    "available_qty" => @$validated["arr_quantity_details_available_qty"][$i]["value"],
                    "allocated_qty" => @$validated["arr_quantity_details_allocated_qty"][$i]["value"],
                    "expired_date" => $expired_date,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];
                DB::table("t_wh_outbound_detail_sku")
                    ->insert($data_insert_t_wh_outbound_detail_sku);
            }


            DB::table("t_wh_checking_transport_loading")
                ->insert([
                    "outbound_planning_no" => $outbound_id,
                    "supervisor_id" => $supervisor,
                    "vehicle_id" => $vehicle_id,
                    "transporter_id" => $transporter,
                    "service_id" => $service_id,
                    "start_loading" => (!empty($start_loading_date) && !empty($start_loading_time)) ? date("Y-m-d H:i:s", strtotime($start_loading_date . " " . $start_loading_time)) : null,
                    "finish_loading" => (!empty($finish_loading_date) && !empty($finish_loading_time)) ? date("Y-m-d H:i:s", strtotime($finish_loading_date . " " . $finish_loading_time)) : null,
                    "driver" => $driver,
                    "vehicle_no" => $vehicle_no,
                    "container_no" => $container_no,
                    "seal_no" => $seal_no,
                    "consignee_name" => $consignee_name,
                    "consignee_address" => $consignee_address,
                    "consignee_city" => $consignee_city,
                    "remark" => $remark,
                    "phone_no" => $phone,
                    "user_created" => session('username'),
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
            "message" => "Success Add Outbound Planning.",
            "data" => [],
        ], 200);
    }

    private function get_Full_Outbound_Planning($outbound_planning_no)
    {
        $data = DB::query()
            ->select([
                "a.outbound_planning_no",
                "a.reference_no",
                "a.receipt_no",
                "d.order_type",
                "c.supplier_name",
                "c.address1 AS supplier_address",
                "a.plan_delivery AS plan_delivery_date",
                "b.sku",
                "f.part_name AS item_name",
                "b.serial_no",
                "f.imei",
                "f.part_no",
                "f.color",
                "f.size",
                "b.qty AS qty_request",
                "b.uom_name AS uom",
                "e.classification_name",
                "a.notes",
                "a.status_id",
                "c.supplier_id",
                "d.order_id",
                "e.item_classification_id",
                "g.status_name",
                "a.user_created",
                "a.datetime_created",
                "a.user_updated",
                "a.datetime_updated",
            ])
            ->from("t_wh_outbound_planning as a")
            ->leftJoin("t_wh_outbound_planning_detail as b", "b.outbound_planning_no", "=", "a.outbound_planning_no")
            ->leftJoin("m_wh_supplier as c", "c.supplier_id", "=", "a.supplier_id")
            ->leftJoin("m_wh_order_type as d", "d.order_id", "=", "a.order_id")
            ->leftJoin("m_item_classification as e", "e.item_classification_id", "=", "b.clasification_id")
            ->leftJoin("m_wh_item as f", "f.sku", "=", "b.sku")
            ->leftJoin("m_status as g", "g.status_id", "=", "a.status_id")
            ->where("e.process_id", 19)
            ->where("a.outbound_planning_no", $outbound_planning_no)
            ->get();

        return $data;
    }

    private function get_Outbound_Planning_Quantity_Details($outbound_planning_no)
    {
        $data = DB::query()
            ->select([
                "a.batch_no",
                "a.sku",
                "b.part_name",
                "a.available_qty",
                "a.allocated_qty",
                "a.expired_date",
                "a.gr_id",
            ])
            ->from("t_wh_outbound_detail_sku as a")
            ->leftJoin("m_wh_item as b", "b.sku", "=", "a.sku")
            ->where("a.outbound_planning_no", $outbound_planning_no)
            ->get();

        return $data;
    }

    private function get_Data_Transport_Loading($outbound_planning_no)
    {
        $data = DB::query()
            ->select([
                "a.supervisor_id",
                "a.vehicle_id",
                "b.vehicle_type",
                "a.transporter_id",
                "c.transporter_name",
                "a.service_id",
                "d.service_name",
                "a.start_loading",
                "a.finish_loading",
                "a.driver",
                "a.vehicle_no",
                "a.container_no",
                "a.seal_no",
                "a.consignee_name",
                "a.consignee_address",
                "a.consignee_city",
                "a.remark",
                "a.phone_no",
            ])
            ->from("t_wh_checking_transport_loading as a")
            ->leftJoin("m_wh_vehicle as b", "b.vehicle_id", "=", "a.vehicle_id")
            ->leftJoin("m_wh_transporter as c", "c.transporter_id", "=", "a.transporter_id")
            ->leftJoin("m_wh_service_type as d", "d.service_id", "=", "a.service_id")
            ->where("a.outbound_planning_no", $outbound_planning_no)
            ->get();
        return $data;
    }

    public function show(Request $request, $id)
    {
        $full_outbound_planning = $this->get_Full_Outbound_Planning($id);

        if (count($full_outbound_planning) == 0) {
            echo "<script>
            alert('Outbound Planning doesnt exist');
            window.location.href = '" . route('outbound_planning.index') . "'
            </script>";
            return;
        }

        $outbound_planning_quantity_details = $this->get_Outbound_Planning_Quantity_Details($id);
        $transport_and_loading = $this->get_Data_Transport_Loading($id);

        $data = [];
        $data["full_outbound_planning"] = $full_outbound_planning;
        $data["outbound_planning_quantity_details"] = $outbound_planning_quantity_details;
        $data["transport_and_loading"] = $transport_and_loading;

        return view("outbound-planning.show", compact('data'));
    }

    public function confirmPlanning(Request $request, $id)
    {
        $full_outbound_planning = $this->get_Full_Outbound_Planning($id);

        if (count($full_outbound_planning) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Outbound Planning doesnt exist, Please reload Page.",
                "data" => [],
            ], 200);
        }

        $outbound_planning_no = @$full_outbound_planning[0]->outbound_planning_no;
        $status_id = @$full_outbound_planning[0]->status_id;

        if ($status_id != "UNO") {
            return response()->json([
                "err" => true,
                "message" => "Status is not UNO, cant confirm.",
                "data" => [],
            ], 200);
        }

        DB::beginTransaction();

        try {
            $data_update_t_wh_outbound_planning = [
                "status_id" => "ALO",
                "user_updated" => session("username"),
                "datetime_updated" => $this->datetime_now,
            ];
            DB::table("t_wh_outbound_planning")
                ->where("outbound_planning_no", $outbound_planning_no)
                ->update($data_update_t_wh_outbound_planning);

            $data_insert_t_wh_picking = [
                "outbound_planning_no" => $outbound_planning_no,
                "status_id" => "RPO",
                "user_created" => session("username"),
                "datetime_created" => $this->datetime_now,
            ];
            DB::table("t_wh_picking")
                ->insert($data_insert_t_wh_picking);

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
            "message" => "Success Confirm Outbound Planning",
            "data" => [],
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        $full_outbound_planning = $this->get_Full_Outbound_Planning($id);

        if (count($full_outbound_planning) == 0) {
            echo "<script>
            alert('Outbound Planning doesnt exist');
            window.location.href = '" . route('outbound_planning.index') . "'
            </script>";
            return;
        }

        $status_id = @$full_outbound_planning[0]->status_id;

        if ($status_id != "UNO") {
            echo "<script>
            alert('Status is not UNO, cant edit.');
            window.location.href = '" . route('outbound_planning.index') . "'
            </script>";
            return;
        }

        $outbound_planning_quantity_details = $this->get_Outbound_Planning_Quantity_Details($id);
        $transport_and_loading = $this->get_Data_Transport_Loading($id);

        $data = [];
        $data["full_outbound_planning"] = $full_outbound_planning;
        $data["outbound_planning_quantity_details"] = $outbound_planning_quantity_details;
        $data["transport_and_loading"] = $transport_and_loading;

        return view("outbound-planning.edit", compact('data'));
    }

    public function update(Request $request, $id)
    {
        $full_outbound_planning = $this->get_Full_Outbound_Planning($id);

        if (count($full_outbound_planning) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Outbound Planning doesnt exist, Please reload Page.",
                "data" => [],
            ], 200);
        }

        $status_id = @$full_outbound_planning[0]->status_id;

        if ($status_id != "UNO") {
            return response()->json([
                "err" => true,
                "message" => "Status is not UNO, cant update, Please Reload Page.",
                "data" => [],
            ], 200);
        }

        $supplier_id = $request->input("supplier_id");
        $supplier_address = $request->input("supplier_address");
        $reference_no = $request->input("reference_no");
        $receipt_no = $request->input("receipt_no");
        $plan_delivery_date = $request->input("plan_delivery_date");
        $order_id = $request->input("order_id");
        $order_type = $request->input("order_type");
        $remarks = $request->input("remarks");

        $arr_sku_no = json_decode($request->input("arr_sku_no"), true);
        $arr_item_name = json_decode($request->input("arr_item_name"), true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"), true);
        $arr_imei_no = json_decode($request->input("arr_imei_no"), true);
        $arr_part_no = json_decode($request->input("arr_part_no"), true);
        $arr_color = json_decode($request->input("arr_color"), true);
        $arr_size = json_decode($request->input("arr_size"), true);
        $arr_qty_request = json_decode($request->input("arr_qty_request"), true);
        $arr_uom = json_decode($request->input("arr_uom"), true);
        $arr_id_classification = json_decode($request->input("arr_id_classification"), true);
        $arr_classification = json_decode($request->input("arr_classification"), true);

        $arr_quantity_details_batch_no = json_decode($request->input("arr_quantity_details_batch_no"), true);
        $arr_quantity_details_sku = json_decode($request->input("arr_quantity_details_sku"), true);
        $arr_quantity_details_part_name = json_decode($request->input("arr_quantity_details_part_name"), true);
        $arr_quantity_details_available_qty = json_decode($request->input("arr_quantity_details_available_qty"), true);
        $arr_quantity_details_expired_date = json_decode($request->input("arr_quantity_details_expired_date"), true);
        $arr_quantity_details_gr_id = json_decode($request->input("arr_quantity_details_gr_id"), true);
        $arr_quantity_details_allocated_qty = json_decode($request->input("arr_quantity_details_allocated_qty"), true);

        $data_error = [];
        if (empty($supplier_id)) {
            $data_error["supplier_name"][] = "Supplier is is Required";
        }
        if (empty($reference_no)) {
            $data_error["reference_no"][] = "Reference No is Required";
        }
        if (empty($receipt_no)) {
            $data_error["receipt_no"][] = "Receipt No is Required";
        }
        if (empty($plan_delivery_date)) {
            $data_error["plan_delivery_date"][] = "Plan Delivery Date is Required";
        }
        if (empty($order_id)) {
            $data_error["order_type"][] = "Order Type is Required";
        }

        if (
            count($arr_sku_no) == 0 ||
            count($arr_item_name) == 0 ||
            count($arr_serial_no) == 0 ||
            count($arr_imei_no) == 0 ||
            count($arr_part_no) == 0 ||
            count($arr_color) == 0 ||
            count($arr_size) == 0 ||
            count($arr_qty_request) == 0 ||
            count($arr_uom) == 0 ||
            count($arr_id_classification) == 0 ||
            count($arr_classification) == 0
        ) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details is required",
                "data" => $data_error,
            ], 200);
        }

        $exist_sku = [];
        foreach ($arr_sku_no as $key_sku_no => $sku_no) {
            $id_sku_no = isset($sku_no['id']) ? $sku_no['id'] : null;
            $value = isset($sku_no['value']) ? $sku_no['value'] : null;
            if (empty($value)) {
                $data_error[$id_sku_no][] = "Sku No is required";
            } else if (!empty($value)) {
                $check_SKU = $this->getSKU($value);
                if (count($check_SKU) == 0) {
                    $data_error[$id_sku_no][] = "Sku No is not exist in database";
                } else if (array_key_exists($value, $exist_sku)) {
                    $data_error[$id_sku_no][] = "Sku No is already used in other row";
                    $data_error[$exist_sku[$value]][] = "Sku No is already used";
                }
                $exist_sku[$value] = $id_sku_no;
            }
        }

        foreach ($arr_qty_request as $key_qty_request => $value_qty_request) {
            $id_qty_request = isset($value_qty_request['id']) ? $value_qty_request['id'] : null;
            $value = isset($value_qty_request['value']) ? $value_qty_request['value'] : null;
            $sku_value = isset($arr_sku_no[$key_qty_request]['value']) ? $arr_sku_no[$key_qty_request]['value'] : null;
            $temp_total_allocated_qty = 0;
            if (empty($value)) {
                $data_error[$id_qty_request][] = "Qty Request is required";
            } else {
                if (count($arr_quantity_details_sku) > 0) {
                    foreach ($arr_quantity_details_sku as $key_quantity_details_sku => $value_quantity_details_sku) {
                        $quantity_details_sku_id = isset($value_quantity_details_sku['id']) ? $value_quantity_details_sku['id'] : null;
                        $quantity_details_sku_value = isset($value_quantity_details_sku['value']) ? $value_quantity_details_sku['value'] : null;
                        $quantity_details_allocated_qty_id = isset($arr_quantity_details_allocated_qty[$key_quantity_details_sku]['id']) ? $arr_quantity_details_allocated_qty[$key_quantity_details_sku]['id'] : null;
                        $quantity_details_allocated_qty_value = isset($arr_quantity_details_allocated_qty[$key_quantity_details_sku]['value']) ? $arr_quantity_details_allocated_qty[$key_quantity_details_sku]['value'] : null;

                        if ($sku_value == $quantity_details_sku_value) {
                            $temp_total_allocated_qty += $quantity_details_allocated_qty_value;
                        }
                    }
                    if ($temp_total_allocated_qty > $value) {
                        $data_error[$id_qty_request][] = "Allocated Qty in Quantity Details is more than Qty Request, please update Quantity Details.";
                    }
                }
            }
        }

        foreach ($arr_uom as $key_uom => $value_uom) {
            $id_uom = isset($value_uom['id']) ? $value_uom['id'] : null;
            $value = isset($value_uom['value']) ? $value_uom['value'] : null;
            if (empty($value)) {
                $data_error[$id_uom][] = "Uom Request is required";
            } else {
                $check_UOM = $this->getUOM($value);
                if (count($check_UOM) == 0) {
                    $data_error[$id_uom][] = "UOM is not exist in database";
                }
            }
        }

        foreach ($arr_id_classification as $key_id_classification => $value_id_classification) {
            $id_classification = isset($value_id_classification['id']) ? $value_id_classification['id'] : null;
            $value_id_classification = isset($value_id_classification['value']) ? $value_id_classification['value'] : null;
            $classification_dom_id = isset($arr_classification[$key_id_classification]['id']) ? $arr_classification[$key_id_classification]['id'] : null;
            $classification_dom_value = isset($arr_classification[$key_id_classification]['value']) ? $arr_classification[$key_id_classification]['value'] : null;
            if (empty($value_id_classification)) {
                $data_error[$classification_dom_id][] = "Classification Request is required";
            } else {
                $check_id_classification = $this->getClassification($value_id_classification);
                if (count($check_id_classification) == 0) {
                    $data_error[$classification_dom_id][] = "Classification is not exist in database";
                }
            }
        }

        if (count($data_error) > 0) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ], 200);
        }

        $validated = [
            "supplier_id" => $supplier_id,
            "supplier_address" => $supplier_address,
            "reference_no" => $reference_no,
            "receipt_no" => $receipt_no,
            "plan_delivery_date" => $plan_delivery_date,
            "order_id" => $order_id,
            "order_type" => $order_type,
            "remarks" => $remarks,
            "arr_sku_no" => $arr_sku_no,
            "arr_item_name" => $arr_item_name,
            "arr_serial_no" => $arr_serial_no,
            "arr_imei_no" => $arr_imei_no,
            "arr_part_no" => $arr_part_no,
            "arr_color" => $arr_color,
            "arr_size" => $arr_size,
            "arr_qty_request" => $arr_qty_request,
            "arr_uom" => $arr_uom,
            "arr_id_classification" => $arr_id_classification,
            "arr_classification" => $arr_classification,
            "arr_quantity_details_batch_no" => $arr_quantity_details_batch_no,
            "arr_quantity_details_sku" => $arr_quantity_details_sku,
            "arr_quantity_details_part_name" => $arr_quantity_details_part_name,
            "arr_quantity_details_available_qty" => $arr_quantity_details_available_qty,
            "arr_quantity_details_expired_date" => $arr_quantity_details_expired_date,
            "arr_quantity_details_gr_id" => $arr_quantity_details_gr_id,
            "arr_quantity_details_allocated_qty" => $arr_quantity_details_allocated_qty,
        ];

        DB::beginTransaction();
        try {

            $process_code = "OUT";
            $status_id = $this->getStatusID($process_code, "UNO");
            if (!$status_id) {
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Status ID is not defined",
                    "data" => [],
                ], 200);
            }

            DB::table("t_wh_outbound_planning")
                ->where("outbound_planning_no", $full_outbound_planning[0]->outbound_planning_no)
                ->update([
                    "wh_id" => session("current_warehouse_id"),
                    "client_project_id" => session("current_client_project_id"),
                    "supplier_id" => $validated["supplier_id"],
                    "order_id" => $validated["order_id"],
                    "status_id" => $status_id,
                    "reference_no" => $validated["reference_no"],
                    "receipt_no" => $validated["receipt_no"],
                    "plan_delivery" => date("Y-m-d", strtotime($validated["plan_delivery_date"])),
                    "notes" => $validated["remarks"],
                    "user_updated" => session("username"),
                    "datetime_updated" => $this->datetime_now,
                ]);

            DB::table("t_wh_outbound_planning_detail")
                ->where("outbound_planning_no", $full_outbound_planning[0]->outbound_planning_no)
                ->delete();

            $max_row_detail = count($validated["arr_sku_no"]);
            for ($i = 0; $i < $max_row_detail; $i++) {
                $data_insert_t_wh_outbound_planning_detail = [
                    "outbound_planning_no" => $full_outbound_planning[0]->outbound_planning_no,
                    "sku" => $validated["arr_sku_no"][$i]["value"],
                    "qty" => $validated["arr_qty_request"][$i]["value"],
                    "uom_name" => $validated["arr_uom"][$i]["value"],
                    "clasification_id" => $validated["arr_id_classification"][$i]["value"],
                    "serial_no" => $validated["arr_serial_no"][$i]["value"],
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];
                DB::table("t_wh_outbound_planning_detail")
                    ->insert($data_insert_t_wh_outbound_planning_detail);
            }

            DB::table("t_wh_outbound_detail_sku")
                ->where("outbound_planning_no", $full_outbound_planning[0]->outbound_planning_no)
                ->delete();

            $max_row_quantity_detail = count($validated["arr_quantity_details_sku"]);
            for ($i = 0; $i < $max_row_quantity_detail; $i++) {
                $expired_date = (!empty($validated["arr_quantity_details_expired_date"][$i]["value"])) ? date("Y-m-d", strtotime($validated["arr_quantity_details_expired_date"][$i]["value"])) : null;
                $data_insert_t_wh_outbound_detail_sku = [
                    "outbound_planning_no" => $full_outbound_planning[0]->outbound_planning_no,
                    "sku" => @$validated["arr_quantity_details_sku"][$i]["value"],
                    "batch_no" => @$validated["arr_quantity_details_batch_no"][$i]["value"],
                    "gr_id" => @$validated["arr_quantity_details_gr_id"][$i]["value"],
                    "available_qty" => @$validated["arr_quantity_details_available_qty"][$i]["value"],
                    "allocated_qty" => @$validated["arr_quantity_details_allocated_qty"][$i]["value"],
                    "expired_date" => $expired_date,
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];
                DB::table("t_wh_outbound_detail_sku")
                    ->insert($data_insert_t_wh_outbound_detail_sku);
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
            "message" => "Success Update Outbound Planning.",
            "data" => [],
        ], 200);
    }

    public function cancelOutboundPlanning(Request $request, $id)
    {
        $full_outbound_planning = $this->get_Full_Outbound_Planning($id);

        if (count($full_outbound_planning) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Outbound Planning doesnt exist, Please reload Page.",
                "data" => [],
            ], 200);
        }

        $status_id = @$full_outbound_planning[0]->status_id;

        if (!in_array($status_id, ["UNO", "ALO"])) {
            return response()->json([
                "err" => true,
                "message" => "Status is not UNO or ALO, cant cancel, Please Reload Page.",
                "data" => [],
            ], 200);
        }

        $cancel_reason = $request->input("cancel_reason");

        DB::beginTransaction();
        try {

            $data_t_wh_outbound_planning_history = [
                "outbound_planning_no" => $full_outbound_planning[0]->outbound_planning_no,
                "previous_state" => $status_id,
                "last_status" => "COU",
                "user_created" => session("username"),
                "datetime_created" => $this->datetime_now,

            ];
            DB::table("t_wh_outbound_planning_history")->insert($data_t_wh_outbound_planning_history);

            $data_t_wh_outbound_planning = [
                "cancel_reason" => $cancel_reason,
                "status_id" => "COU",
                "user_updated" => session('username'),
                "datetime_updated" => $this->datetime_now,
            ];
            DB::table("t_wh_outbound_planning")
                ->where("outbound_planning_no", $full_outbound_planning[0]->outbound_planning_no)
                ->update($data_t_wh_outbound_planning);

            if ($status_id == "ALO") {
                $data_t_wh_picking = [
                    "status_id" => "CPI",
                    "user_updated" => session('username'),
                    "datetime_updated" => $this->datetime_now,
                ];
                DB::table("t_wh_picking")
                    ->where("outbound_planning_no", $full_outbound_planning[0]->outbound_planning_no)
                    ->update($data_t_wh_picking);
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
            "message" => "Success Cancel Outbound.",
            "data" => [],
        ], 200);
    }
}
