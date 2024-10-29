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

class TransportController extends Controller
{
    private $menu_id = 43;
    private $datetime_now;

    public function __construct()
    {
        $this->middleware('check_user_access_read:' . $this->menu_id)->only([
            'index',
            'datatablesTransporter',
            'datatablesServiceType',
        ]);
        $this->middleware('check_user_access_create:' . $this->menu_id)->only([]);
        $this->middleware('check_user_access_update:' . $this->menu_id)->only([]);
        $this->middleware('check_user_access_delete:' . $this->menu_id)->only([]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("transport.index", compact('data'));
    }

    public function datatablesTransporter()
    {
        $data = DB::select("SELECT transporter_id,transporter_name
        FROM m_wh_transporter  
        ORDER BY transporter_id
        ", []);
        return DataTables::of($data)
            ->make(true);
    }

    public function datatablesServiceType(Request $request)
    {
        $transporter_id = $request->input('transporter_id');
        if (empty($transporter_id)) {
            return DataTables::of([])
                ->make(true);
        }

        $data = DB::select("SELECT a.service_id, b.transporter_name, a.service_name
        FROM m_wh_service_type a
        LEFT JOIN m_wh_transporter b ON a.transporter_id=b.transporter_id
        WHERE a.transporter_id = ?
        ", [
            $transporter_id,
        ]);

        return DataTables::of($data)
            ->make(true);
    }

    public function datatables(Request $request)
    {

        $outbound_planning_no = $request->input("outbound_planning_no");
        $awb = $request->input("awb");
        $transporter_id = $request->input("transporter_id");
        $service_type_id = $request->input("service_type_id");

        $data = DB::query()->select([
            "a.outbound_planning_no",
            "a.awb",
            "b.transporter_name",
            "c.service_name",
            DB::raw("DATE(a.datetime_created) AS created_date"),
        ])
            ->from("t_wh_checking_transport_loading as a")
            ->leftJoin("m_wh_transporter as b", "a.transporter_id", "=", "b.transporter_id")
            ->leftJoin("m_wh_service_type as c", "a.service_id", "=", "c.service_id")
            ->leftJoin("t_wh_outbound_planning as d", "a.outbound_planning_no", "=", "d.outbound_planning_no")
            ->where("d.client_project_id", session('current_client_project_id'))
            ->where(function ($query) use ($outbound_planning_no, $awb, $transporter_id, $service_type_id) {
                if (!empty($outbound_planning_no)) {
                    $query->where("a.outbound_planning_no", $outbound_planning_no);
                }

                if (!empty($awb)) {
                    $query->where("a.awb", $awb);
                }

                if (!empty($transporter_id)) {
                    $query->where("a.transporter_id", $transporter_id);
                }

                if (!empty($service_type_id)) {
                    $query->where("a.service_id", $service_type_id);
                }
            })
            ->orderBy("a.datetime_created", "DESC")
            ->get();

        return DataTables::of($data)
            ->addColumn('action', function ($transport) {
                $button = "";
                $button .= "<div class='text-center'>";
                $button .= "
                <a href='#' class='text-decoration-none'>
                <button class='btn btn-primary mb-0 py-1'>Show</button>
                </a>"; // route('transport.show', ['id' => $transport->outbound_planning_no])
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }
}
