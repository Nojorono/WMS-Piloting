<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReturnController extends Controller
{
    private $menu_id = 39;
    private $datetime_now;

    public function __construct()
    {
        $this->middleware('check_user_access_read:' . $this->menu_id)->only([
            "index",
            "datatables",
            "show",
            "datatablesStatus",
            "confirm",
        ]);
        $this->middleware('check_user_access_create:' . $this->menu_id)->only([
            "create",
            "store",
            "datatablesSKU",
            "datatablesUOM",
            "datatablesClassification",
            "datatablesStockType",
            "getDataByOutboundReferenceNo",
        ]);
        $this->middleware('check_user_access_update:' . $this->menu_id)->only([
            "edit",
            "update",
            "datatablesSKU",
            "datatablesUOM",
            "datatablesClassification",
            "datatablesStockType",
            "getDataByOutboundReferenceNo",
        ]);
        $this->middleware('check_user_access_delete:' . $this->menu_id)->only([]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        return view('return.index');
    }

    public function datatables(Request $request)
    {
        $return_no = $request->input("return_no");
        $outbound_reference_no = $request->input("outbound_reference_no");
        $reference_no = $request->input("reference_no");
        $return_date = $request->input("return_date");
        $status_name = $request->input("status_name");

        $data = DB::query()
            ->select([
                "a.return_no",
                "e.client_name",
                "b.client_project_name",
                "c.wh_name",
                "a.outbound_reference_no",
                "a.reference_no",
                "a.return_date",
                "d.status_name",
            ])
            ->from("t_wh_return as a")
            ->leftJoin("m_wh_client_project as b", "b.client_project_id", "=", "a.client_project_id")
            ->leftJoin("m_warehouse as c", "c.wh_id", "=", "b.wh_id")
            ->leftJoin("m_status as d", "d.status_id", "=", "a.status_id")
            ->leftJoin("m_wh_client as e", "e.client_id", "=", "b.client_id")
            ->where("a.client_project_id", session('current_client_project_id'))
            ->where(function ($query) use ($return_no) {
                if (!empty($return_no)) {
                    $query->where("a.return_no", $return_no);
                }
            })
            ->where(function ($query) use ($outbound_reference_no) {
                if (!empty($outbound_reference_no)) {
                    $query->where("a.outbound_reference_no", $outbound_reference_no);
                }
            })
            ->where(function ($query) use ($reference_no) {
                if (!empty($reference_no)) {
                    $query->where("a.reference_no", $reference_no);
                }
            })
            ->where(function ($query) use ($return_date) {
                if (!empty($return_date)) {
                    $query->where("a.return_date", $return_date);
                }
            })
            ->where(function ($query) use ($status_name) {
                if (!empty($status_name)) {
                    $query->where("d.status_name", $status_name);
                }
            })
            ->orderBy("a.datetime_created", "DESC")
            ->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data_return) {
                $button = "";
                $button .= "<div class='text-center'>";
                $button .= "
                <a href='" . route('return.show', ['id' => $data_return->return_no]) . "' class='text-decoration-none'>
                <button class='btn btn-primary mb-0 py-1'>Show</button>
                </a>";
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }

    private function getStatus($status_name = false)
    {
        $data = DB::query()
            ->select([
                "a.status_name",
            ])
            ->from("m_status as a")
            ->where("a.is_active", "Y")
            ->where("a.process_id", 23)
            ->where(function ($query) use ($status_name) {
                if ($status_name !== false) {
                    $query->where("a.status_name", $status_name);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesStatus(Request $request)
    {
        $data = $this->getStatus();
        return DataTables::of($data)
            ->make(true);
    }

    public function create()
    {
        return view('return.create');
    }

    public function getDataByOutboundReferenceNo(Request $request)
    {
        $outbound_reference_no = $request->input("outbound_reference_no");
        if (empty($outbound_reference_no)) {
            return response()->json([
                "err" => false,
                "message" => "Success getDataByOutboundReferenceNo",
                "data" => [],
            ], 200);
        }

        $data = DB::select("SELECT 
        b.sku, c.batch_no, c.expired_date, c.allocated_qty AS qty, b.uom_name
        FROM t_wh_outbound_planning a
        LEFT JOIN t_wh_outbound_planning_detail b ON a.outbound_planning_no=b.outbound_planning_no
        LEFT JOIN t_wh_outbound_detail_sku c ON b.outbound_planning_no=c.outbound_planning_no
        WHERE a.client_project_id = ?
        and a.reference_no = ? 
        ", [
            session("current_client_project_id"),
            $outbound_reference_no,
        ]);

        return response()->json([
            "err" => false,
            "message" => "Success getDataByOutboundReferenceNo",
            "data" => $data,
        ], 200);
    }

    private function getSKU($sku = false)
    {
        $data = DB::query()
            ->select([
                "a.sku",
                "a.part_name",
            ])
            ->from("m_wh_item as a")
            ->leftJoin("m_wh_client_project as b", function ($query) {
                $query->on("b.client_id", "=", "a.client_id");
                $query->on("b.wh_id", "=", "a.wh_id");
            })
            ->where("b.wh_id", session('current_warehouse_id'))
            ->where("b.client_id", session('current_client_id'))
            ->where("b.client_project_id", session('current_client_project_id'))
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
        $data = $this->getSKU();
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
        $data = $this->getUOM();
        return DataTables::of($data)
            ->make(true);
    }

    private function getClassification($item_classification_id = false)
    {
        $data = DB::query()
            ->select([
                "a.item_classification_id",
                "a.classification_name",
            ])
            ->from("m_item_classification as a")
            ->leftJoin("m_process as b", "b.process_id", "=", "a.process_id")
            ->where("b.process_id", 23)
            ->where("b.is_active", "Y")
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
        $data = $this->getClassification();
        return DataTables::of($data)
            ->make(true);
    }

    private function getStockType($stock_id = false)
    {
        $data = DB::query()
            ->select([
                "a.stock_id",
                "a.stock_type",
            ])
            ->from("m_wh_stock_type as a")
            ->where("a.process_id", "RTN")
            ->where(function ($query) use ($stock_id) {
                if ($stock_id !== false) {
                    $query->where("a.stock_id", $stock_id);
                }
            })
            ->orderBy("a.stock_id", "asc")
            ->get();
        return $data;
    }

    public function datatablesStockType(Request $request)
    {
        $data = $this->getStockType();
        return DataTables::of($data)
            ->make(true);
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

    private function mustFourDigits($data)
    {
        while (strlen($data) < 4) {
            $data = "0" . $data;
        }
        return $data;
    }

    private function updateRunningNumber($last_running_number, $process_code)
    {
        $data = DB::table("t_running_number as a")
            ->where("a.process_code", $process_code)
            ->where("a.date", date("Y-m", strtotime($this->datetime_now)))
            ->where("a.wh_id", session("current_warehouse_id"))
            ->update([
                "running_number" => $last_running_number,
            ]);
    }

    public function store(Request $request)
    {
        $return_no = $request->input("return_no");
        $return_date = $request->input("return_date");
        $outbound_reference_no = $request->input("outbound_reference_no");
        $return_from = $request->input("return_from");
        $awb_number = $request->input("awb_number");
        $reference_no = $request->input("reference_no");
        $reason = $request->input("reason");

        $arr_sku_no = json_decode($request->input("arr_sku_no"), true);
        $arr_item_name = json_decode($request->input("arr_item_name"), true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"), true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"), true);
        $arr_expired_date = json_decode($request->input("arr_expired_date"), true);
        $arr_part_no = json_decode($request->input("arr_part_no"), true);
        $arr_imei_no = json_decode($request->input("arr_imei_no"), true);
        $arr_color = json_decode($request->input("arr_color"), true);
        $arr_qty = json_decode($request->input("arr_qty"), true);
        $arr_uom = json_decode($request->input("arr_uom"), true);
        $arr_classification_id = json_decode($request->input("arr_classification_id"), true);
        $arr_classification_name = json_decode($request->input("arr_classification_name"), true);
        $arr_stock_id = json_decode($request->input("arr_stock_id"), true);
        $arr_stock_type = json_decode($request->input("arr_stock_type"), true);
        $arr_item_reason = json_decode($request->input("arr_item_reason"), true);

        $data_error = [];

        if (empty($return_date)) {
            $data_error['return_date'][] = "Return Date is required";
        }

        if (
            count($arr_sku_no) === 0 ||
            count($arr_item_name) === 0 ||
            count($arr_batch_no) === 0 ||
            count($arr_serial_no) === 0 ||
            count($arr_expired_date) === 0 ||
            count($arr_part_no) === 0 ||
            count($arr_imei_no) === 0 ||
            count($arr_color) === 0 ||
            count($arr_qty) === 0 ||
            count($arr_uom) === 0 ||
            count($arr_classification_id) === 0 ||
            count($arr_classification_name) === 0 ||
            count($arr_stock_id) === 0 ||
            count($arr_stock_type) === 0 ||
            count($arr_item_reason) === 0
        ) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details is required",
                "data" => $data_error,
            ], 200);
        }

        $max_row_detail = count($arr_sku_no);

        for ($i = 0; $i < $max_row_detail; $i++) {
            $dom_sku_no = isset($arr_sku_no[$i]['id']) ? $arr_sku_no[$i]['id'] : null;
            $value_sku_no = isset($arr_sku_no[$i]['value']) ? $arr_sku_no[$i]['value'] : null;

            $dom_item_name = isset($arr_item_name[$i]['id']) ? $arr_item_name[$i]['id'] : null;
            $value_item_name = isset($arr_item_name[$i]['value']) ? $arr_item_name[$i]['value'] : null;

            $dom_batch_no = isset($arr_batch_no[$i]['id']) ? $arr_batch_no[$i]['id'] : null;
            $value_batch_no = isset($arr_batch_no[$i]['value']) ? $arr_batch_no[$i]['value'] : null;

            $dom_serial_no = isset($arr_serial_no[$i]['id']) ? $arr_serial_no[$i]['id'] : null;
            $value_serial_no = isset($arr_serial_no[$i]['value']) ? $arr_serial_no[$i]['value'] : null;

            $dom_expired_date = isset($arr_expired_date[$i]['id']) ? $arr_expired_date[$i]['id'] : null;
            $value_expired_date = isset($arr_expired_date[$i]['value']) ? $arr_expired_date[$i]['value'] : null;

            $dom_part_no = isset($arr_part_no[$i]['id']) ? $arr_part_no[$i]['id'] : null;
            $value_part_no = isset($arr_part_no[$i]['value']) ? $arr_part_no[$i]['value'] : null;

            $dom_imei_no = isset($arr_imei_no[$i]['id']) ? $arr_imei_no[$i]['id'] : null;
            $value_imei_no = isset($arr_imei_no[$i]['value']) ? $arr_imei_no[$i]['value'] : null;

            $dom_color = isset($arr_color[$i]['id']) ? $arr_color[$i]['id'] : null;
            $value_color = isset($arr_color[$i]['value']) ? $arr_color[$i]['value'] : null;

            $dom_qty = isset($arr_qty[$i]['id']) ? $arr_qty[$i]['id'] : null;
            $value_qty = isset($arr_qty[$i]['value']) ? $arr_qty[$i]['value'] : null;

            $dom_uom = isset($arr_uom[$i]['id']) ? $arr_uom[$i]['id'] : null;
            $value_uom = isset($arr_uom[$i]['value']) ? $arr_uom[$i]['value'] : null;

            $dom_classification_id = isset($arr_classification_id[$i]['id']) ? $arr_classification_id[$i]['id'] : null;
            $value_classification_id = isset($arr_classification_id[$i]['value']) ? $arr_classification_id[$i]['value'] : null;

            $dom_classification_name = isset($arr_classification_name[$i]['id']) ? $arr_classification_name[$i]['id'] : null;
            $value_classification_name = isset($arr_classification_name[$i]['value']) ? $arr_classification_name[$i]['value'] : null;

            $dom_stock_id = isset($arr_stock_id[$i]['id']) ? $arr_stock_id[$i]['id'] : null;
            $value_stock_id = isset($arr_stock_id[$i]['value']) ? $arr_stock_id[$i]['value'] : null;

            $dom_stock_type = isset($arr_stock_type[$i]['id']) ? $arr_stock_type[$i]['id'] : null;
            $value_stock_type = isset($arr_stock_type[$i]['value']) ? $arr_stock_type[$i]['value'] : null;

            $dom_item_reason = isset($arr_item_reason[$i]['id']) ? $arr_item_reason[$i]['id'] : null;
            $value_item_reason = isset($arr_item_reason[$i]['value']) ? $arr_item_reason[$i]['value'] : null;

            if (empty($value_sku_no)) {
                $data_error[$dom_sku_no][] = "SKU is required";
            }

            if (empty($value_qty)) {
                $data_error[$dom_qty][] = "Qty is required";
            }

            if (empty($value_uom)) {
                $data_error[$dom_uom][] = "UOM is required";
            }

            if (empty($value_classification_id)) {
                $data_error[$dom_classification_name][] = "Classification is required";
            }

            if (empty($value_stock_id)) {
                $data_error[$dom_stock_type][] = "Stock Type is required";
            }
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
            $process_code = "RTN";
            $status_id = $this->getStatusID($process_code, "OPR");
            if (!$status_id) {
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Status ID is not defined",
                    "data" => [],
                ], 200);
            }

            $wh_prefix = $this->getWHPrefix();
            $date_format_inbound_planning = date("my", strtotime($this->datetime_now));
            $current_running_number = $this->getLastRunningNumber($process_code) + 1;
            $running_number = $this->mustFourDigits($current_running_number);
            $return_no = $wh_prefix . "-" . $process_code . "-" . $date_format_inbound_planning . "-" . $running_number;
            if ($current_running_number > 9999) {
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Running Number is more than 9999, cant create more.",
                    "data" => [],
                ], 200);
            }

            $this->updateRunningNumber($current_running_number, $process_code);

            DB::table("t_wh_return")->insert([
                "return_no" =>  $return_no,
                "client_project_id" =>  session("current_client_project_id"),
                "outbound_reference_no" =>  $outbound_reference_no,
                "awb" =>  $awb_number,
                "reference_no" =>  $reference_no,
                "return_date" =>  $return_date,
                "return_from" =>  $return_from,
                "status_id" =>  $status_id,
                "reason" =>  $reason,
                "user_created" =>  session("username"),
                "datetime_created" => $this->datetime_now,
            ]);

            for ($i = 0; $i < $max_row_detail; $i++) {
                $value_sku_no = isset($arr_sku_no[$i]['value']) && !empty($arr_sku_no[$i]['value']) ? $arr_sku_no[$i]['value'] : null;
                $value_item_name = isset($arr_item_name[$i]['value']) && !empty($arr_item_name[$i]['value']) ? $arr_item_name[$i]['value'] : null;
                $value_batch_no = isset($arr_batch_no[$i]['value']) && !empty($arr_batch_no[$i]['value']) ? $arr_batch_no[$i]['value'] : null;
                $value_serial_no = isset($arr_serial_no[$i]['value']) && !empty($arr_serial_no[$i]['value']) ? $arr_serial_no[$i]['value'] : null;
                $value_expired_date = isset($arr_expired_date[$i]['value']) && !empty($arr_expired_date[$i]['value']) ? $arr_expired_date[$i]['value'] : null;
                $value_part_no = isset($arr_part_no[$i]['value']) && !empty($arr_part_no[$i]['value']) ? $arr_part_no[$i]['value'] : null;
                $value_imei_no = isset($arr_imei_no[$i]['value']) && !empty($arr_imei_no[$i]['value']) ? $arr_imei_no[$i]['value'] : null;
                $value_color = isset($arr_color[$i]['value']) && !empty($arr_color[$i]['value']) ? $arr_color[$i]['value'] : null;
                $value_qty = isset($arr_qty[$i]['value']) && !empty($arr_qty[$i]['value']) ? $arr_qty[$i]['value'] : null;
                $value_uom = isset($arr_uom[$i]['value']) && !empty($arr_uom[$i]['value']) ? $arr_uom[$i]['value'] : null;
                $value_classification_id = isset($arr_classification_id[$i]['value']) && !empty($arr_classification_id[$i]['value']) ? $arr_classification_id[$i]['value'] : null;
                $value_classification_name = isset($arr_classification_name[$i]['value']) && !empty($arr_classification_name[$i]['value']) ? $arr_classification_name[$i]['value'] : null;
                $value_stock_id = isset($arr_stock_id[$i]['value']) && !empty($arr_stock_id[$i]['value']) ? $arr_stock_id[$i]['value'] : null;
                $value_stock_type = isset($arr_stock_type[$i]['value']) && !empty($arr_stock_type[$i]['value']) ? $arr_stock_type[$i]['value'] : null;
                $value_item_reason = isset($arr_item_reason[$i]['value']) && !empty($arr_item_reason[$i]['value']) ? $arr_item_reason[$i]['value'] : null;

                DB::table("t_wh_return_detail")->insert([
                    "return_no" => $return_no,
                    "sku" => $value_sku_no,
                    "item_name" => $value_item_name,
                    "batch_no" => $value_batch_no,
                    "serial_no" => $value_serial_no,
                    "expired_date" => $value_expired_date,
                    "part_no" => $value_part_no,
                    "imei" => $value_imei_no,
                    "color" => $value_color,
                    // "size" => "", //di UI ga ada dan di mapping ga ada
                    "qty" => $value_qty,
                    "uom_name" => $value_uom,
                    "stock_id" => $value_stock_id,
                    "classification_id" => $value_classification_id,
                    "item_reason" => $value_item_reason,
                    "user_created" =>  session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);
            }


            DB::commit();
        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('Exception error', array('context' => $error));
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
            "message" => "Success Add Return",
            "data" => [],
        ], 200);
    }

    public function get_Return_Header($return_no)
    {
        if (empty($return_no)) {
            return [];
        }

        return DB::table("t_wh_return as a")
            ->select([
                "a.return_no",
                "a.client_project_id",
                "a.outbound_reference_no",
                "a.awb",
                "a.reference_no",
                "a.return_date",
                "a.return_from",
                "a.status_id",
                "a.reason",
            ])
            ->where("a.return_no", $return_no)
            ->where("a.client_project_id", session("current_client_project_id"))
            ->get();
    }

    public function get_Return_Detail($return_no)
    {
        if (empty($return_no)) {
            return [];
        }

        return DB::table("t_wh_return_detail as a")
            ->select([
                "a.return_no",
                "a.sku",
                "a.item_name",
                "a.batch_no",
                "a.serial_no",
                "a.expired_date",
                "a.part_no",
                "a.imei",
                "a.color",
                "a.size",
                "a.qty",
                "a.uom_name",
                "a.stock_id",
                "c.stock_type",
                "a.classification_id",
                "b.classification_name",
                "a.item_reason",

            ])
            ->leftJoin("m_item_classification as b", "b.item_classification_id", "=", "a.classification_id")
            ->leftJoin("m_wh_stock_type as c", "c.stock_id", "=", "a.stock_id")
            ->where("a.return_no", $return_no)
            ->where("b.process_id", 23)
            ->where("c.process_id", "RTN")
            ->get();
    }

    public function show(Request $request, $id)
    {
        $current_data_header = $this->get_Return_Header($id);
        $current_data_detail = $this->get_Return_Detail($id);

        $data = [];
        $data["current_data_header"] = $current_data_header;
        $data["current_data_detail"] = $current_data_detail;

        // dd($data);
        return view('return.show', compact("data"));
    }

    public function edit(Request $request, $id)
    {
        $current_data_header = $this->get_Return_Header($id);
        $current_data_detail = $this->get_Return_Detail($id);

        if (!in_array(@$current_data_header[0]->status_id, ["OPR",])) {
            echo "<script>
            alert('Status Id is not OPR');
            window.location.href = '" . route('return.show', ["id" => $id,]) . "'
            </script>";
            return;
        }

        $data = [];
        $data["current_data_header"] = $current_data_header;
        $data["current_data_detail"] = $current_data_detail;

        return view('return.edit', compact("data"));
    }

    public function update(Request $request, $id)
    {
        $current_data_header = $this->get_Return_Header($id);
        $current_data_detail = $this->get_Return_Detail($id);

        if (!in_array(@$current_data_header[0]->status_id, ["OPR",])) {
            return response()->json([
                "err" => true,
                "message" => "Status Id is not OPR",
                "data" => [],
            ], 200);
        }

        $return_no = @$current_data_header[0]->return_no;
        $return_date = $request->input("return_date");
        $outbound_reference_no = $request->input("outbound_reference_no");
        $return_from = $request->input("return_from");
        $awb_number = $request->input("awb_number");
        $reference_no = $request->input("reference_no");
        $reason = $request->input("reason");

        $arr_sku_no = json_decode($request->input("arr_sku_no"), true);
        $arr_item_name = json_decode($request->input("arr_item_name"), true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"), true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"), true);
        $arr_expired_date = json_decode($request->input("arr_expired_date"), true);
        $arr_part_no = json_decode($request->input("arr_part_no"), true);
        $arr_imei_no = json_decode($request->input("arr_imei_no"), true);
        $arr_color = json_decode($request->input("arr_color"), true);
        $arr_qty = json_decode($request->input("arr_qty"), true);
        $arr_uom = json_decode($request->input("arr_uom"), true);
        $arr_classification_id = json_decode($request->input("arr_classification_id"), true);
        $arr_classification_name = json_decode($request->input("arr_classification_name"), true);
        $arr_stock_id = json_decode($request->input("arr_stock_id"), true);
        $arr_stock_type = json_decode($request->input("arr_stock_type"), true);
        $arr_item_reason = json_decode($request->input("arr_item_reason"), true);

        $data_error = [];

        if (empty($return_date)) {
            $data_error['return_date'][] = "Return Date is required";
        }

        if (
            count($arr_sku_no) === 0 ||
            count($arr_item_name) === 0 ||
            count($arr_batch_no) === 0 ||
            count($arr_serial_no) === 0 ||
            count($arr_expired_date) === 0 ||
            count($arr_part_no) === 0 ||
            count($arr_imei_no) === 0 ||
            count($arr_color) === 0 ||
            count($arr_qty) === 0 ||
            count($arr_uom) === 0 ||
            count($arr_classification_id) === 0 ||
            count($arr_classification_name) === 0 ||
            count($arr_stock_id) === 0 ||
            count($arr_stock_type) === 0 ||
            count($arr_item_reason) === 0
        ) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details is required",
                "data" => $data_error,
            ], 200);
        }

        $max_row_detail = count($arr_sku_no);

        for ($i = 0; $i < $max_row_detail; $i++) {
            $dom_sku_no = isset($arr_sku_no[$i]['id']) ? $arr_sku_no[$i]['id'] : null;
            $value_sku_no = isset($arr_sku_no[$i]['value']) ? $arr_sku_no[$i]['value'] : null;

            $dom_item_name = isset($arr_item_name[$i]['id']) ? $arr_item_name[$i]['id'] : null;
            $value_item_name = isset($arr_item_name[$i]['value']) ? $arr_item_name[$i]['value'] : null;

            $dom_batch_no = isset($arr_batch_no[$i]['id']) ? $arr_batch_no[$i]['id'] : null;
            $value_batch_no = isset($arr_batch_no[$i]['value']) ? $arr_batch_no[$i]['value'] : null;

            $dom_serial_no = isset($arr_serial_no[$i]['id']) ? $arr_serial_no[$i]['id'] : null;
            $value_serial_no = isset($arr_serial_no[$i]['value']) ? $arr_serial_no[$i]['value'] : null;

            $dom_expired_date = isset($arr_expired_date[$i]['id']) ? $arr_expired_date[$i]['id'] : null;
            $value_expired_date = isset($arr_expired_date[$i]['value']) ? $arr_expired_date[$i]['value'] : null;

            $dom_part_no = isset($arr_part_no[$i]['id']) ? $arr_part_no[$i]['id'] : null;
            $value_part_no = isset($arr_part_no[$i]['value']) ? $arr_part_no[$i]['value'] : null;

            $dom_imei_no = isset($arr_imei_no[$i]['id']) ? $arr_imei_no[$i]['id'] : null;
            $value_imei_no = isset($arr_imei_no[$i]['value']) ? $arr_imei_no[$i]['value'] : null;

            $dom_color = isset($arr_color[$i]['id']) ? $arr_color[$i]['id'] : null;
            $value_color = isset($arr_color[$i]['value']) ? $arr_color[$i]['value'] : null;

            $dom_qty = isset($arr_qty[$i]['id']) ? $arr_qty[$i]['id'] : null;
            $value_qty = isset($arr_qty[$i]['value']) ? $arr_qty[$i]['value'] : null;

            $dom_uom = isset($arr_uom[$i]['id']) ? $arr_uom[$i]['id'] : null;
            $value_uom = isset($arr_uom[$i]['value']) ? $arr_uom[$i]['value'] : null;

            $dom_classification_id = isset($arr_classification_id[$i]['id']) ? $arr_classification_id[$i]['id'] : null;
            $value_classification_id = isset($arr_classification_id[$i]['value']) ? $arr_classification_id[$i]['value'] : null;

            $dom_classification_name = isset($arr_classification_name[$i]['id']) ? $arr_classification_name[$i]['id'] : null;
            $value_classification_name = isset($arr_classification_name[$i]['value']) ? $arr_classification_name[$i]['value'] : null;

            $dom_stock_id = isset($arr_stock_id[$i]['id']) ? $arr_stock_id[$i]['id'] : null;
            $value_stock_id = isset($arr_stock_id[$i]['value']) ? $arr_stock_id[$i]['value'] : null;

            $dom_stock_type = isset($arr_stock_type[$i]['id']) ? $arr_stock_type[$i]['id'] : null;
            $value_stock_type = isset($arr_stock_type[$i]['value']) ? $arr_stock_type[$i]['value'] : null;

            $dom_item_reason = isset($arr_item_reason[$i]['id']) ? $arr_item_reason[$i]['id'] : null;
            $value_item_reason = isset($arr_item_reason[$i]['value']) ? $arr_item_reason[$i]['value'] : null;

            if (empty($value_sku_no)) {
                $data_error[$dom_sku_no][] = "SKU is required";
            }

            if (empty($value_qty)) {
                $data_error[$dom_qty][] = "Qty is required";
            }

            if (empty($value_uom)) {
                $data_error[$dom_uom][] = "UOM is required";
            }

            if (empty($value_classification_id)) {
                $data_error[$dom_classification_name][] = "Classification is required";
            }

            if (empty($value_stock_id)) {
                $data_error[$dom_stock_type][] = "Stock Type is required";
            }
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

            DB::table("t_wh_return")
                ->where("return_no", $return_no)
                ->update([
                    "client_project_id" =>  session("current_client_project_id"),
                    "outbound_reference_no" =>  $outbound_reference_no,
                    "awb" =>  $awb_number,
                    "reference_no" =>  $reference_no,
                    "return_date" =>  $return_date,
                    "return_from" =>  $return_from,
                    "reason" =>  $reason,
                    "user_updated" =>  session("username"),
                    "datetime_updated" => $this->datetime_now,
                ]);

            if (count($current_data_detail) > 0) {
                DB::table("t_wh_return_detail")
                    ->where("return_no", $return_no)
                    ->delete();
            }

            for ($i = 0; $i < $max_row_detail; $i++) {
                $value_sku_no = isset($arr_sku_no[$i]['value']) && !empty($arr_sku_no[$i]['value']) ? $arr_sku_no[$i]['value'] : null;
                $value_item_name = isset($arr_item_name[$i]['value']) && !empty($arr_item_name[$i]['value']) ? $arr_item_name[$i]['value'] : null;
                $value_batch_no = isset($arr_batch_no[$i]['value']) && !empty($arr_batch_no[$i]['value']) ? $arr_batch_no[$i]['value'] : null;
                $value_serial_no = isset($arr_serial_no[$i]['value']) && !empty($arr_serial_no[$i]['value']) ? $arr_serial_no[$i]['value'] : null;
                $value_expired_date = isset($arr_expired_date[$i]['value']) && !empty($arr_expired_date[$i]['value']) ? $arr_expired_date[$i]['value'] : null;
                $value_part_no = isset($arr_part_no[$i]['value']) && !empty($arr_part_no[$i]['value']) ? $arr_part_no[$i]['value'] : null;
                $value_imei_no = isset($arr_imei_no[$i]['value']) && !empty($arr_imei_no[$i]['value']) ? $arr_imei_no[$i]['value'] : null;
                $value_color = isset($arr_color[$i]['value']) && !empty($arr_color[$i]['value']) ? $arr_color[$i]['value'] : null;
                $value_qty = isset($arr_qty[$i]['value']) && !empty($arr_qty[$i]['value']) ? $arr_qty[$i]['value'] : null;
                $value_uom = isset($arr_uom[$i]['value']) && !empty($arr_uom[$i]['value']) ? $arr_uom[$i]['value'] : null;
                $value_classification_id = isset($arr_classification_id[$i]['value']) && !empty($arr_classification_id[$i]['value']) ? $arr_classification_id[$i]['value'] : null;
                $value_classification_name = isset($arr_classification_name[$i]['value']) && !empty($arr_classification_name[$i]['value']) ? $arr_classification_name[$i]['value'] : null;
                $value_stock_id = isset($arr_stock_id[$i]['value']) && !empty($arr_stock_id[$i]['value']) ? $arr_stock_id[$i]['value'] : null;
                $value_stock_type = isset($arr_stock_type[$i]['value']) && !empty($arr_stock_type[$i]['value']) ? $arr_stock_type[$i]['value'] : null;
                $value_item_reason = isset($arr_item_reason[$i]['value']) && !empty($arr_item_reason[$i]['value']) ? $arr_item_reason[$i]['value'] : null;

                DB::table("t_wh_return_detail")->insert([
                    "return_no" => $return_no,
                    "sku" => $value_sku_no,
                    "item_name" => $value_item_name,
                    "batch_no" => $value_batch_no,
                    "serial_no" => $value_serial_no,
                    "expired_date" => $value_expired_date,
                    "part_no" => $value_part_no,
                    "imei" => $value_imei_no,
                    "color" => $value_color,
                    "qty" => $value_qty,
                    "uom_name" => $value_uom,
                    "stock_id" => $value_stock_id,
                    "classification_id" => $value_classification_id,
                    "item_reason" => $value_item_reason,
                    "user_created" =>  session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);
            }


            DB::commit();
        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('Exception error', array('context' => $error));
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
            "message" => "Success Update Return",
            "data" => [],
        ], 200);
    }

    public function confirm(Request $request, $id)
    {
        $current_data_header = $this->get_Return_Header($id);

        if (!in_array(@$current_data_header[0]->status_id, ["OPR",])) {
            return response()->json([
                "err" => true,
                "message" => "Status Id is not OPR",
                "data" => [],
            ], 200);
        }

        DB::beginTransaction();
        try {

            $return_no =  $current_data_header[0]->return_no;
            $temp_gr_id = explode("-", $return_no);
            $temp_gr_id[1] = "GRR";
            $gr_id = "";

            foreach ($temp_gr_id as $key_temp_gr_id => $value_temp_gr_id) {
                $gr_id .= $value_temp_gr_id;
                if (count($temp_gr_id) > ($key_temp_gr_id + 1)) {
                    $gr_id .= "-";
                }
            }

            DB::table("t_wh_return")
                ->where("return_no", $return_no)
                ->update([
                    "status_id" => "RER",
                    "user_updated" =>  session("username"),
                    "datetime_updated" => $this->datetime_now,
                ]);

            DB::table("t_wh_receive_return")
                ->insert([
                    "gr_return_id" => $gr_id,
                    "return_no" => $return_no,
                    "status_id" => "ORR",
                    "user_created" =>  session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);
            DB::commit();
        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('Exception error', array('context' => $error));
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
            "message" => "Success Confirm",
            "data" => [],
        ], 200);
    }
}
