<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class ShippingLoadController extends Controller
{
    private $menu_id = 42;
    private $datetime_now;

    public function __construct()
    {
        $this->middleware('check_user_access_read:' . $this->menu_id)->only([
            'index',
            'datatablesShippingLoadStatus',
            'datatables',

        ]);
        $this->middleware('check_user_access_create:' . $this->menu_id)->only([
            'create',
            'searchOutbound',
            'store',
        ]);
        $this->middleware('check_user_access_update:' . $this->menu_id)->only([
            'updateShippingLoad',
        ]);
        $this->middleware('check_user_access_delete:' . $this->menu_id)->only([]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("shipping-load.index", compact('data'));
    }

    private function get_ShippingLoad_Status($status_id = false)
    {
        $data = DB::query()
            ->select([
                "a.status_id",
                "a.status_name",
            ])
            ->from("m_status as a")
            ->where("a.process_id", 25)
            ->where(function ($query) use ($status_id) {
                if ($status_id !== false) {
                    $query->where("a.status_id", $status_id);
                }
            })
            ->get();

        return $data;
    }

    public function datatablesShippingLoadStatus()
    {
        $data = $this->get_ShippingLoad_Status();
        return DataTables::of($data)
            ->make(true);
    }

    private function get_Shipping_Load_Data($booking_no, $pickup_name, $pickup_company, $pickup_date, $pickup_status_id)
    {

        return DB::table("t_wh_shipping_load as a")
            ->select([
                "a.booking_no",
                "c.wh_name",
                "a.pickup_name",
                "a.pickup_company",
                "a.pickup_datetime",
                "d.status_name",
            ])
            ->leftJoin("m_wh_client_project as b", "b.client_project_id", "=", "a.client_project_id")
            ->leftJoin("m_warehouse as c", "c.wh_id", "=", "b.wh_id")
            ->leftJoin("m_status as d", "d.status_id", "=", "a.status_id")
            ->where("a.client_project_id", session('current_client_project_id'))
            ->where(function ($query) use ($booking_no, $pickup_name, $pickup_company, $pickup_date, $pickup_status_id) {
                if (!empty($booking_no)) {
                    $query->where("a.booking_no", $booking_no);
                }

                if (!empty($pickup_name)) {
                    $query->where("a.pickup_name", $pickup_name);
                }

                if (!empty($pickup_company)) {
                    $query->where("a.pickup_company", $pickup_company);
                }

                if (!empty($pickup_date)) {
                    $query->where(DB::raw("CAST(a.pickup_datetime as DATE)"), $pickup_date);
                }

                if (!empty($pickup_status_id)) {
                    $query->where("a.status_id", $pickup_status_id);
                }
            })
            ->orderBy("a.pickup_datetime", "DESC")
            ->get();
    }

    public function datatables(Request $request)
    {
        $booking_no = $request->input("booking_no");
        $pickup_name = $request->input("pickup_name");
        $pickup_company = $request->input("pickup_company");
        $pickup_date = $request->input("pickup_date");
        $pickup_status_id = $request->input("pickup_status_id");

        $data = $this->get_Shipping_Load_Data($booking_no, $pickup_name, $pickup_company, $pickup_date, $pickup_status_id);

        return DataTables::of($data)
            ->addColumn('action', function ($shipping_load) {
                $button = "";
                $button .= "<div class='text-center'>";
                $button .= "
                <a href='" . route('shipping_load.show', ['id' => $shipping_load->booking_no]) . "' class='text-decoration-none'>
                <button class='btn btn-primary mb-0 py-1'>Show</button>
                </a>";
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }

    public function create()
    {
        $data = [];
        return view("shipping-load.create", compact('data'));
    }

    public function searchOutbound(Request $request)
    {
        $outbound_date_from = $request->input("outbound_date_from");
        $outbound_date_to = $request->input("outbound_date_to");

        $data = DB::select("SELECT a.outbound_planning_no, b.order_type, c.sku,
        d.part_name AS `description`, c.serial_no, e.batch_no,
        e.expired_date, e.gr_id, e.allocated_qty AS qty, c.uom_name,
        g.stock_type
        FROM t_wh_outbound_planning a
        LEFT JOIN m_wh_order_type b ON a.order_id=b.order_id
        LEFT JOIN t_wh_outbound_planning_detail c ON a.outbound_planning_no=c.outbound_planning_no
        LEFT JOIN m_wh_item d ON c.sku=d.sku
        LEFT JOIN t_wh_outbound_detail_sku e ON e.outbound_planning_no=a.outbound_planning_no AND e.sku=c.sku
        LEFT JOIN t_wh_picking_detail f ON a.outbound_planning_no=f.outbound_planning_no AND c.sku=f.sku AND f.batch_no=e.batch_no
        LEFT JOIN m_wh_stock_type g ON g.stock_id=f.stock_id
        LEFT JOIN t_wh_shipping_load_detail AS h ON h.outbound_planning_no = c.outbound_planning_no
        WHERE a.client_project_id = 1 #based on login
        AND a.status_id = 'DOO'
        AND h.outbound_planning_no IS NULL
        AND CAST(a.datetime_created AS DATE) BETWEEN '2023-07-01' AND '2023-07-31'
        GROUP BY a.outbound_planning_no, c.sku, c.serial_no, e.batch_no, e.expired_date, g.stock_type
        ORDER BY a.outbound_planning_no ASC
        ", [
            session("current_client_project_id"),
            $outbound_date_from,
            $outbound_date_to,
        ]);

        return response()->json([
            "err" => false,
            "message" => "Success searchOutbound",
            "data" => $data,
        ], 200);
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
        $pickup_name = $request->input('pickup_name');
        $pickup_company = $request->input('pickup_company');
        $pickup_address = $request->input('pickup_address');
        $pickup_date = $request->input('pickup_date');
        $pickup_time = $request->input('pickup_time');
        $phone = $request->input('phone');
        $job_no = $request->input('job_no');
        $outbound_date_from = $request->input('outbound_date_from');
        $outbound_date_to = $request->input('outbound_date_to');
        $reason = $request->input('reason');

        $arr_outbound_planning_no = json_decode($request->input("arr_outbound_planning_no"), true);
        $arr_order_type = json_decode($request->input("arr_order_type"), true);
        $arr_sku = json_decode($request->input("arr_sku"), true);
        $arr_description = json_decode($request->input("arr_description"), true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"), true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"), true);
        $arr_expired_date = json_decode($request->input("arr_expired_date"), true);
        $arr_gr_id = json_decode($request->input("arr_gr_id"), true);
        $arr_qty = json_decode($request->input("arr_qty"), true);
        $arr_uom = json_decode($request->input("arr_uom"), true);
        $arr_classification_item = json_decode($request->input("arr_classification_item"), true);
        $arr_awb_number = json_decode($request->input("arr_awb_number"), true);
        $arr_remarks = json_decode($request->input("arr_remarks"), true);

        $data_error = [];

        if (empty($pickup_date)) {
            $data_error["pickup_date"][] = "Pickup Date is required.";
        }

        if (
            count($arr_outbound_planning_no) == 0
        ) {
            return response()->json([
                "err" => true,
                "message" => "Validation Failed, Item Details is required",
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
            $process_code = "SHIP";
            $wh_prefix = $this->getWHPrefix();
            $date_format_booking_no = date("my", strtotime($this->datetime_now));
            $current_running_number = $this->getLastRunningNumber($process_code) + 1;
            $running_number = $this->mustFourDigits($current_running_number);
            $booking_no = $wh_prefix . "-" . $process_code . "-" . $date_format_booking_no . "-" . $running_number;
            if ($current_running_number > 9999) {
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Running Number is more than 9999, cant create more.",
                    "data" => [],
                ], 200);
            }

            $this->updateRunningNumber($current_running_number, $process_code);

            $pickup_datetime = date("Y-m-d H:i:s", strtotime($pickup_date . " 00:00:00"));

            if (!empty($pickup_time)) {
                $pickup_datetime = date("Y-m-d H:i:s", strtotime($pickup_date . " " . $pickup_time));
            }

            DB::table("t_wh_shipping_load")
                ->insert([
                    "booking_no" => $booking_no,
                    "pickup_name" => $pickup_name,
                    "pickup_company" => $pickup_company,
                    "pickup_address" => $pickup_address,
                    "phone" => $phone,
                    "job_no" => $job_no,
                    "pickup_datetime" => $pickup_datetime,
                    "status_id" => "OPS",
                    "notes" => $reason,
                    "client_project_id" => session("current_client_project_id"),
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ]);
            for ($i = 0; $i < count($arr_outbound_planning_no); $i++) {
                $data_t_wh_shipping_load_detail = [
                    "booking_no" => $booking_no,
                    "outbound_planning_no" => @$arr_outbound_planning_no[$i]["value"],
                    "awb" => @$arr_awb_number[$i]["value"],
                    "remarks" => @$arr_remarks[$i]["value"],
                    "user_created" => session("username"),
                    "datetime_created" => $this->datetime_now,
                ];
                DB::table("t_wh_shipping_load_detail")
                    ->insert($data_t_wh_shipping_load_detail);
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
            "message" => "Success Add Shipping Load.",
            "data" => [],
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $data = [];
        $data["current_data_header"] = DB::select("SELECT booking_no, pickup_name, pickup_company, pickup_address,
        pickup_datetime, phone, job_no, notes,status_id
        FROM t_wh_shipping_load
        WHERE client_project_id = ? #based on login
        AND booking_no = ?
        ", [
            session("current_client_project_id"),
            $id,
        ]);

        $data["current_data_detail"] = DB::select("SELECT a.outbound_planning_no, d.order_type, e.sku,
        f.part_name AS `description`, e.serial_no, g.batch_no,
        g.expired_date, g.gr_id, g.allocated_qty AS qty,
        e.uom_name, i.stock_type, a.awb, a.remarks
        FROM t_wh_shipping_load_detail a
        LEFT JOIN t_wh_shipping_load b ON a.booking_no=b.booking_no
        LEFT JOIN t_wh_outbound_planning c ON a.outbound_planning_no=c.outbound_planning_no
        LEFT JOIN m_wh_order_type d ON c.order_id=d.order_id
        LEFT JOIN t_wh_outbound_planning_detail e ON c.outbound_planning_no=e.outbound_planning_no
        LEFT JOIN m_wh_item f ON e.sku=f.sku
        LEFT JOIN t_wh_outbound_detail_sku g ON e.outbound_planning_no=g.outbound_planning_no AND e.sku=g.sku
        LEFT JOIN t_wh_picking_detail h ON c.outbound_planning_no=h.outbound_planning_no
        AND e.sku=h.sku AND g.batch_no=h.batch_no
        LEFT JOIN m_wh_stock_type i ON h.stock_id=i.stock_id
        WHERE b.client_project_id= ? #based on login
        AND a.booking_no = ?
        GROUP BY a.outbound_planning_no, e.sku, e.serial_no, g.batch_no, g.expired_date, i.stock_type
        ", [
            session("current_client_project_id"),
            $id,
        ]);

        return view("shipping-load.show", compact('data'));
    }

    public function viewPDF(Request $request, $id)
    {
        $data = [];
        $data["current_data_header"] = DB::select("SELECT booking_no, pickup_name, pickup_company, pickup_address,
        pickup_datetime, phone, job_no, notes,status_id
        FROM t_wh_shipping_load
        WHERE client_project_id = ? #based on login
        AND booking_no = ?
        ", [
            session("current_client_project_id"),
            $id,
        ]);

        $data["current_data_detail"] = DB::select("SELECT a.outbound_planning_no, d.order_type, e.sku,
        f.part_name AS `description`, e.serial_no, g.batch_no,
        g.expired_date, g.gr_id, g.allocated_qty AS qty,
        e.uom_name, i.stock_type, a.awb, a.remarks
        FROM t_wh_shipping_load_detail a
        LEFT JOIN t_wh_shipping_load b ON a.booking_no=b.booking_no
        LEFT JOIN t_wh_outbound_planning c ON a.outbound_planning_no=c.outbound_planning_no
        LEFT JOIN m_wh_order_type d ON c.order_id=d.order_id
        LEFT JOIN t_wh_outbound_planning_detail e ON c.outbound_planning_no=e.outbound_planning_no
        LEFT JOIN m_wh_item f ON e.sku=f.sku
        LEFT JOIN t_wh_outbound_detail_sku g ON e.outbound_planning_no=g.outbound_planning_no AND e.sku=g.sku
        LEFT JOIN t_wh_picking_detail h ON c.outbound_planning_no=h.outbound_planning_no
        AND e.sku=h.sku AND g.batch_no=h.batch_no
        LEFT JOIN m_wh_stock_type i ON h.stock_id=i.stock_id
        WHERE b.client_project_id= ? #based on login
        AND a.booking_no = ?
        GROUP BY a.outbound_planning_no, e.sku, e.serial_no, g.batch_no, g.expired_date, i.stock_type
        ", [
            session("current_client_project_id"),
            $id,
        ]);

        $pdf = Pdf::loadView('shipping-load.pdf', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream($data["current_data_header"][0]->booking_no . ".pdf");
    }

    public function updateShippingLoad(Request $request, $id)
    {

        $current_data_header = DB::select("SELECT booking_no, pickup_name, pickup_company, pickup_address,
        pickup_datetime, phone, job_no, notes,status_id
        FROM t_wh_shipping_load
        WHERE client_project_id = ? #based on login
        AND booking_no = ?
        ", [
            session("current_client_project_id"),
            $id,
        ]);

        if (count($current_data_header) == 0) {
            return response()->json([
                "err" => false,
                "message" => "Booking No is not found",
                "data" => [],
            ], 200);
        }

        if ($current_data_header[0]->status_id != "OPS") {
            return response()->json([
                "err" => false,
                "message" => "Booking No status is not OPS",
                "data" => [],
            ], 200);
        }

        $current_data_detail = DB::select("SELECT a.outbound_planning_no, d.order_type, e.sku,
        f.part_name AS `description`, e.serial_no, g.batch_no,
        g.expired_date, g.gr_id, g.allocated_qty AS qty,
        e.uom_name, i.stock_type, a.awb, a.remarks
        FROM t_wh_shipping_load_detail a
        LEFT JOIN t_wh_shipping_load b ON a.booking_no=b.booking_no
        LEFT JOIN t_wh_outbound_planning c ON a.outbound_planning_no=c.outbound_planning_no
        LEFT JOIN m_wh_order_type d ON c.order_id=d.order_id
        LEFT JOIN t_wh_outbound_planning_detail e ON c.outbound_planning_no=e.outbound_planning_no
        LEFT JOIN m_wh_item f ON e.sku=f.sku
        LEFT JOIN t_wh_outbound_detail_sku g ON e.outbound_planning_no=g.outbound_planning_no AND e.sku=g.sku
        LEFT JOIN t_wh_picking_detail h ON c.outbound_planning_no=h.outbound_planning_no
        AND e.sku=h.sku AND g.batch_no=h.batch_no
        LEFT JOIN m_wh_stock_type i ON h.stock_id=i.stock_id
        WHERE b.client_project_id= ? #based on login
        AND a.booking_no = ?
        
        ", [
            session("current_client_project_id"),
            $id,
        ]);
        DB::beginTransaction();
        try {

            DB::table("t_wh_shipping_load")
                ->where("client_project_id", session('current_client_project_id'))
                ->where("booking_no", $id)

                ->update([
                    "status_id" => 'PIS',
                    "user_updated" => session("username"),
                    "datetime_updated" => $this->datetime_now,
                ]);

            foreach ($current_data_detail as $key_current_data_detail => $value_current_data_detail) {
                DB::table("t_wh_outbound_planning")
                    ->where("client_project_id", session('current_client_project_id'))
                    ->where("outbound_planning_no", $value_current_data_detail->outbound_planning_no)
                    ->update([
                        "status_id" => 'SHO',
                        "user_updated" => session("username"),
                        "datetime_updated" => $this->datetime_now,
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
            "message" => "Success Update Shipping Load.",
            "data" => [],
        ], 200);
    }
}
