<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    private $menu_id = 4;

    public function __construct()
    {
        // $this->middleware('check_user_access_read:'.$this->menu_id)->only(['index',]);
        // $this->middleware('check_user_access_create:'.$this->menu_id)->only([]);
        // $this->middleware('check_user_access_update:'.$this->menu_id)->only([]);
        // $this->middleware('check_user_access_delete:'.$this->menu_id)->only([]);
    }

    public function index()
    {
        $data = [];
        $data["username"] = session("username");
        $data["fullname"] = session("fullname");
        $data["wh_id"] = session("current_warehouse_id");

        $data["quantity_report"] = $this->get_Quantity_Report();
        $data["fast_aging"] = $this->get_Fast_Aging();
        $data["medium_aging"] = $this->get_Medium_Aging();
        $data["slow_aging"] = $this->get_Slow_Aging();

        // dd($data);
        return view("dashboard.index", compact("data"));
    }

    private function get_Quantity_Report()
    {
        return DB::table("t_wh_location_inventory")
            ->select([
                DB::raw("sum(on_hand_qty) AS on_hand_qty"),
                DB::raw("SUM(available_qty) AS available_qty"),
            ])
            ->where("client_project_id", session("current_client_project_id"))
            ->get();
    }

    private function get_Fast_Aging()
    {
        return DB::select("SELECT count(TIMESTAMPDIFF(DAY, gr_datetime, NOW())) AS aging
        FROM t_wh_location_inventory
        WHERE client_project_id= ? #based on login
        AND TIMESTAMPDIFF(DAY, gr_datetime, NOW()) < 60
        ", [
            session("current_client_project_id"),
        ]);
    }

    private function get_Medium_Aging()
    {
        return DB::select("SELECT count(TIMESTAMPDIFF(DAY, gr_datetime, NOW())) AS aging
        FROM t_wh_location_inventory
        WHERE client_project_id= ? #based on login
        AND TIMESTAMPDIFF(DAY, gr_datetime, NOW()) < 60
        ", [
            session("current_client_project_id"),
        ]);
    }

    private function get_Slow_Aging()
    {
        return DB::select("SELECT count(TIMESTAMPDIFF(DAY, gr_datetime, NOW())) AS aging
        FROM t_wh_location_inventory
        WHERE client_project_id= ? #based on login
        AND TIMESTAMPDIFF(DAY, gr_datetime, NOW()) > 120
        ", [
            session("current_client_project_id"),
        ]);
    }


    public function change_client_project_id(Request $request)
    {
        $username = session('username');
        $client_project_id = $request->input('client_project_id');

        if (empty($username)) {
            return response()->json([
                "err" => true,
                "message" => "Username not exists",
            ], 200);
        }

        $check_Client_Project = $this->get_Client_Project($username, $client_project_id);

        if (count($check_Client_Project) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Client Project ID is not exists",
            ], 200);
        }
        $new_client_id = $check_Client_Project[0]->client_id;
        $new_client_project_id = $check_Client_Project[0]->client_project_id;
        $new_wh_id = $check_Client_Project[0]->wh_id;


        session([
            "current_client_id" => $new_client_id,
            "current_client_project_id" => $new_client_project_id,
            "current_warehouse_id" => $new_wh_id,
        ]);

        return response()->json([
            "err" => false,
            "message" => "Success Change Client Project ID, Page will be reloaded.",
        ], 200);
    }

    private function get_Client_Project($username, $client_project_id)
    {
        $query_Client_Project = DB::query()
            ->select([
                "m_wh_client_project.client_project_id",
                "m_wh_client_project.client_project_name",
                "m_wh_client_project.wh_id",
                "m_wh_client.client_id",
                "m_wh_client.client_name",
                "t_wh_user.username",
            ])
            ->from("t_wh_user")
            ->leftJoin("m_wh_user_client_project", "m_wh_user_client_project.username", "=", "t_wh_user.username")
            ->leftJoin("m_wh_client_project", "m_wh_client_project.client_project_id", "=", "m_wh_user_client_project.client_project_id")
            ->leftJoin("m_wh_client", "m_wh_client.client_id", "=", "m_wh_client_project.client_id")
            ->whereRaw("m_wh_user_client_project.username IS NOT NULL")
            ->where("t_wh_user.username", $username)
            ->where("m_wh_user_client_project.client_project_id", $client_project_id)
            ->limit(1)
            ->get();

        if (count($query_Client_Project) == 0) {
            return [];
        }

        return $query_Client_Project;
    }

    public function get_message()
    {

        $data = DB::select("SELECT a.messages, DATE_FORMAT(a.datetime_created, '%d/%m/%Y') AS date_created, a.is_read
        FROM m_wh_inbox a
        LEFT JOIN m_wh_buffer b ON a.buffer_id=b.buffer_id
        LEFT JOIN m_wh_contact_buffer c ON b.contact_id=c.contact_id
        WHERE c.client_project_id = ?
        ORDER BY CAST(a.is_read AS CHAR) DESC, a.datetime_created DESC
        ", [
            session("current_client_project_id"),
        ]);

        return response()->json([
            "err" => false,
            "message" => "Success get message",
            "data" => $data,
        ], 200);
    }

    private function get_Inbound_Report_Total_Planning_and_Qty_Planning($date_from, $date_to)
    {
        if (!empty($date_from) && !empty($date_to)) {
            return DB::select("SELECT 
            COUNT(distinct a.inbound_planning_no) AS total_planning,
            SUM(b.qty) AS qty_planning
            FROM t_wh_inbound_planning a
            LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no
            WHERE a.client_project_id = ?
            AND DATE(a.datetime_created) BETWEEN ? AND ?
            ", [
                session("current_client_project_id"),
                $date_from,
                $date_to,
            ]);
        }
        return DB::select("SELECT 
        COUNT(distinct a.inbound_planning_no) AS total_planning,
        SUM(b.qty) AS qty_planning
        FROM t_wh_inbound_planning a
        LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no
        WHERE a.client_project_id = ?
        AND DATE(a.datetime_created)=CURDATE()
        ", [
            session("current_client_project_id"),
        ]);
    }

    private function get_Inbound_Report_Total_Receive_and_Qty_Receive($date_from, $date_to)
    {

        if (!empty($date_from) && !empty($date_to)) {
            return DB::select("SELECT count(distinct a.inbound_planning_no) AS total_receive
            , case
                when sum(a.qty) IS NULL then 0
                ELSE SUM(a.qty)
                end
            AS qty_receive
            FROM t_wh_inbound_detail a
            LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no
            AND a.sku=b.SKU AND a.serial_no=b.serial_no
            LEFT JOIN t_wh_inbound_planning c ON b.inbound_planning_no=c.inbound_planning_no
            WHERE c.client_project_id = ?
            AND DATE(c.datetime_created) BETWEEN ? AND ?
            ", [
                session("current_client_project_id"),
                $date_from,
                $date_to,
            ]);
        }

        return DB::select("SELECT count(distinct a.inbound_planning_no) AS total_receive
        , case
            when sum(a.qty) IS NULL then 0
            ELSE SUM(a.qty)
            end
        AS qty_receive
        FROM t_wh_inbound_detail a
        LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no
        AND a.sku=b.SKU AND a.serial_no=b.serial_no
        LEFT JOIN t_wh_inbound_planning c ON b.inbound_planning_no=c.inbound_planning_no
        WHERE c.client_project_id = ?
        AND DATE(a.datetime_created)=CURDATE()
        
        ", [
            session("current_client_project_id"),
        ]);
    }

    private function get_Inbound_Report_Grafik($date_from, $date_to)
    {

        $list_inbound_planning_no = [];
        $list_qty_plan = [];
        $list_qty_receive = [];

        if (!empty($date_from) && !empty($date_to)) {
            $raw_data = DB::select("SELECT a.inbound_planning_no, sum(b.qty) AS qty_plan, 
            case
                when sum(c.qty) IS NULL then '0'
                ELSE sum(c.qty)
                end
            AS qty_receive 
            FROM t_wh_inbound_planning a
            LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no
            LEFT JOIN t_wh_inbound_detail c ON a.inbound_planning_no=c.inbound_planning_no
            AND b.sku=c.SKU AND b.serial_no=c.serial_no
            WHERE a.client_project_id = ?
            AND DATE(a.datetime_created) BETWEEN ? AND ?
            GROUP BY a.inbound_planning_no
            ORDER BY a.inbound_planning_no ASC
            ", [
                session("current_client_project_id"),
                $date_from,
                $date_to,
            ]);

            if (count($raw_data) == 0) {
                return [
                    "list_inbound_planning_no" => $list_inbound_planning_no,
                    "list_qty_plan" => $list_qty_plan,
                    "list_qty_receive" => $list_qty_receive,
                ];
            }

            foreach ($raw_data as $key_raw_data => $value_raw_data) {
                $inbound_planning_no = ($value_raw_data->inbound_planning_no) ? $value_raw_data->inbound_planning_no : "";
                $qty_plan = ($value_raw_data->qty_plan) ? $value_raw_data->qty_plan : 0;
                $qty_receive = ($value_raw_data->qty_receive) ? $value_raw_data->qty_receive : 0;

                $list_inbound_planning_no[] = $inbound_planning_no;
                $list_qty_plan[] = $qty_plan;
                $list_qty_receive[] = $qty_receive;
            }

            return [
                "list_inbound_planning_no" => $list_inbound_planning_no,
                "list_qty_plan" => $list_qty_plan,
                "list_qty_receive" => $list_qty_receive,
            ];
        }

        $raw_data = DB::select("SELECT a.inbound_planning_no, sum(b.qty) AS qty_plan, 
        case
            when sum(c.qty) IS NULL then '0'
            ELSE sum(c.qty)
            end
        AS qty_receive 
        FROM t_wh_inbound_planning a
        LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no
        LEFT JOIN t_wh_inbound_detail c ON a.inbound_planning_no=c.inbound_planning_no
        AND b.sku=c.SKU AND b.serial_no=c.serial_no
        WHERE a.client_project_id = ?
        AND DATE(a.datetime_created)=CURDATE()
        GROUP BY a.inbound_planning_no
        ORDER BY a.inbound_planning_no ASC
        ", [
            session("current_client_project_id"),
        ]);

        if (count($raw_data) == 0) {
            return [
                "list_inbound_planning_no" => $list_inbound_planning_no,
                "list_qty_plan" => $list_qty_plan,
                "list_qty_receive" => $list_qty_receive,
            ];
        }

        foreach ($raw_data as $key_raw_data => $value_raw_data) {
            $inbound_planning_no = ($value_raw_data->inbound_planning_no) ? $value_raw_data->inbound_planning_no : "";
            $qty_plan = ($value_raw_data->qty_plan) ? $value_raw_data->qty_plan : 0;
            $qty_receive = ($value_raw_data->qty_receive) ? $value_raw_data->qty_receive : 0;

            $list_inbound_planning_no[] = $inbound_planning_no;
            $list_qty_plan[] = $qty_plan;
            $list_qty_receive[] = $qty_receive;
        }

        return [
            "list_inbound_planning_no" => $list_inbound_planning_no,
            "list_qty_plan" => $list_qty_plan,
            "list_qty_receive" => $list_qty_receive,
        ];
    }



    public function dashboard_getInboundReport(Request $request)
    {

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $data_Total_Planning_and_Qty_Planning = $this->get_Inbound_Report_Total_Planning_and_Qty_Planning($date_from, $date_to);
        $data_Total_Total_Receive_and_Qty_Receive = $this->get_Inbound_Report_Total_Receive_and_Qty_Receive($date_from, $date_to);

        $total_planning = $data_Total_Planning_and_Qty_Planning[0]->total_planning;
        $qty_planning = $data_Total_Planning_and_Qty_Planning[0]->qty_planning;
        $total_receive = $data_Total_Total_Receive_and_Qty_Receive[0]->total_receive;
        $qty_receive = $data_Total_Total_Receive_and_Qty_Receive[0]->qty_receive;

        $data_grafik = $this->get_Inbound_Report_Grafik($date_from, $date_to);

        return response()->json([
            "err" => false,
            "message" => "Success getInboundReport",
            "data" => [
                "total_planning" => $total_planning,
                "qty_planning" => $qty_planning,
                "total_receive" => $total_receive,
                "qty_receive" => $qty_receive,
                "data_grafik" => $data_grafik,
            ],
        ], 200);
    }

    private function get_Outbound_Grafik($date_from, $date_to)
    {
        $list_outbound_planning_no = [];
        $list_qty_planning = [];
        $list_qty_picking = [];
        $list_qty_packing = [];

        if (!empty($date_from) && !empty($date_to)) {
            $raw_data = DB::select("SELECT a.outbound_planning_no, 
            case
                when SUM(c.pick_qty) IS NULL then SUM(b.qty)
                ELSE SUM(c.pick_qty)
                END
            AS qty_planning
            , case
                when SUM(d.scan_qty) IS NULL then 0
                ELSE SUM(d.scan_qty)
                end
            AS qty_picking
            , case
                when SUM(d.scan_qty) IS NULL then 0
                ELSE SUM(d.scan_qty)
                end
            AS qty_packing
            FROM t_wh_outbound_planning a
            LEFT JOIN t_wh_outbound_planning_detail b ON a.outbound_planning_no=b.outbound_planning_no
            LEFT JOIN t_wh_picking_detail c ON b.outbound_planning_no=c.outbound_planning_no AND b.sku=c.sku AND c.serial_no=b.serial_no
            LEFT JOIN t_wh_scan_picking d ON c.outbound_planning_no=d.outbound_id AND d.sku=c.sku AND c.gr_id=d.gr_id AND c.location_id=d.location_id
            LEFT JOIN t_wh_scan_checking e ON d.outbound_id=e.outbound_id AND e.sku=d.sku AND e.gr_id=d.gr_id AND e.location_id=d.location_id
            WHERE a.client_project_id = ? #based on login
            AND DATE(a.datetime_created) BETWEEN ? AND ?
            GROUP BY a.outbound_planning_no
            ", [
                session("current_client_project_id"),
                $date_from,
                $date_to,
            ]);

            if (count($raw_data) == 0) {
                return [
                    "list_outbound_planning_no" => $list_outbound_planning_no,
                    "list_qty_planning" => $list_qty_planning,
                    "list_qty_picking" => $list_qty_picking,
                    "list_qty_packing" => $list_qty_packing,
                ];
            }

            foreach ($raw_data as $key_raw_data => $value_raw_data) {
                $list_outbound_planning_no[] = $value_raw_data->outbound_planning_no;
                $list_qty_planning[] = $value_raw_data->qty_planning;
                $list_qty_picking[] = $value_raw_data->qty_picking;
                $list_qty_packing[] = $value_raw_data->qty_packing;
            }

            return [
                "list_outbound_planning_no" => $list_outbound_planning_no,
                "list_qty_planning" => $list_qty_planning,
                "list_qty_picking" => $list_qty_picking,
                "list_qty_packing" => $list_qty_packing,
            ];
        }

        $raw_data = DB::select(" SELECT 
        a.outbound_planning_no, 
        case
            when SUM(c.pick_qty) IS NULL then SUM(b.qty)
            ELSE SUM(c.pick_qty)
            END
        AS qty_planning
        , case
            when SUM(d.scan_qty) IS NULL then 0
            ELSE SUM(d.scan_qty)
            end
        AS qty_picking
        , case
            when SUM(d.scan_qty) IS NULL then 0
            ELSE SUM(d.scan_qty)
            end
        AS qty_packing
        FROM t_wh_outbound_planning a
        LEFT JOIN t_wh_outbound_planning_detail b ON a.outbound_planning_no=b.outbound_planning_no
        LEFT JOIN t_wh_picking_detail c ON b.outbound_planning_no=c.outbound_planning_no AND b.sku=c.sku AND c.serial_no=b.serial_no
        LEFT JOIN t_wh_scan_picking d ON c.outbound_planning_no=d.outbound_id AND d.sku=c.sku AND c.gr_id=d.gr_id AND c.location_id=d.location_id
        LEFT JOIN t_wh_scan_checking e ON d.outbound_id=e.outbound_id AND e.sku=d.sku AND e.gr_id=d.gr_id AND e.location_id=d.location_id
        WHERE a.client_project_id = ? #based on login
        AND DATE(a.datetime_created) = CURDATE() 
        GROUP BY a.outbound_planning_no
        ", [
            session("current_client_project_id"),
        ]);

        if (count($raw_data) == 0) {
            return [
                "list_outbound_planning_no" => $list_outbound_planning_no,
                "list_qty_planning" => $list_qty_planning,
                "list_qty_picking" => $list_qty_picking,
                "list_qty_packing" => $list_qty_packing,
            ];
        }

        foreach ($raw_data as $key_raw_data => $value_raw_data) {
            $list_outbound_planning_no[] = $value_raw_data->outbound_planning_no;
            $list_qty_planning[] = $value_raw_data->qty_planning;
            $list_qty_picking[] = $value_raw_data->qty_picking;
            $list_qty_packing[] = $value_raw_data->qty_packing;
        }

        return [
            "list_outbound_planning_no" => $list_outbound_planning_no,
            "list_qty_planning" => $list_qty_planning,
            "list_qty_picking" => $list_qty_picking,
            "list_qty_packing" => $list_qty_packing,
        ];
    }

    private function get_Outbound_Report($date_from, $date_to)
    {
        if (!empty($date_from) && !empty($date_to)) {
            return DB::select("SELECT 
            count(distinct a.outbound_planning_no) AS total_planning,	
            SUM(b.qty) AS qty_picking,
            COUNT(d.outbound_id) AS total_picking,
            SUM(d.scan_qty) AS qty_picking,
            COUNT(e.outbound_id) AS total_packing,
            SUM(e.scan_qty) AS qty_packing
            FROM t_wh_outbound_planning a
            LEFT JOIN t_wh_outbound_planning_detail b ON a.outbound_planning_no=b.outbound_planning_no
            LEFT JOIN t_wh_picking_detail c ON b.outbound_planning_no=c.outbound_planning_no AND b.sku=c.sku
            LEFT JOIN t_wh_scan_picking d ON c.outbound_planning_no=d.outbound_id AND d.sku=c.sku AND c.gr_id=d.gr_id AND c.location_id=d.location_id
            LEFT JOIN t_wh_scan_checking e ON d.outbound_id=e.outbound_id AND e.sku=d.sku AND e.gr_id=d.gr_id AND e.location_id=d.location_id
            WHERE a.client_project_id = ?  #based on login
            AND DATE(a.datetime_created) BETWEEN ? AND ?
            
            ", [
                session("current_client_project_id"),
                $date_from,
                $date_to,
            ]);
        }

        return DB::select("SELECT 
        count(a.outbound_planning_no) AS total_planning,
        SUM(b.qty) AS qty_planning,
        COUNT(c.outbound_id) AS total_picking,
        SUM(c.scan_qty) AS qty_picking,
        COUNT(d.outbound_id) AS total_packing,
        SUM(d.scan_qty) AS qty_packing
        FROM t_wh_outbound_planning a
        LEFT JOIN t_wh_outbound_planning_detail b ON a.outbound_planning_no=b.outbound_planning_no
        LEFT JOIN t_wh_scan_picking c ON c.outbound_id=b.outbound_planning_no AND c.sku=b.sku
        LEFT JOIN t_wh_scan_checking d ON d.outbound_id=c.outbound_id AND d.sku=c.sku AND d.batch_no=c.batch_no
        WHERE a.client_project_id = ?
        AND DATE(a.datetime_created)=CURDATE() 
        ", [
            session("current_client_project_id"),
        ]);
    }

    public function dashboard_getOutboundReport(Request $request)
    {
        $date_from_outbound = $request->input('date_from_outbound');
        $date_to_outbound = $request->input('date_to_outbound');

        $data_Get_Outbound_Report = $this->get_Outbound_Report($date_from_outbound, $date_to_outbound);

        $total_planning = @$data_Get_Outbound_Report[0]->total_planning;
        $qty_planning = @$data_Get_Outbound_Report[0]->qty_planning;
        $total_picking = @$data_Get_Outbound_Report[0]->total_picking;
        $qty_picking = @$data_Get_Outbound_Report[0]->qty_picking;
        $total_packing = @$data_Get_Outbound_Report[0]->total_packing;
        $qty_packing = @$data_Get_Outbound_Report[0]->qty_packing;

        $data_grafik = $this->get_Outbound_Grafik($date_from_outbound, $date_to_outbound);

        return response()->json([
            "err" => false,
            "message" => "Success getOutboundReport",
            "data" => [
                "total_planning" => $total_planning,
                "qty_planning" => $qty_planning,
                "total_picking" => $total_picking,
                "qty_picking" => $qty_picking,
                "total_packing" => $total_packing,
                "qty_packing" => $qty_packing,
                "data_grafik" => $data_grafik,
            ],
        ], 200);
    }
}
