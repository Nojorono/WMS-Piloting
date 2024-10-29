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

class MovementLocationController extends Controller
{
    private $menu_id = 20;
    private $datetime_now;

    public function __construct()
    {
        $this->middleware('check_user_access_read:' . $this->menu_id)->only([
            'index',
            'datatables',
            'datatablesMovementLocationID',
            'datatablesMovementStatus',
            'viewExcel',
            'show',
            'datatablesClientID',
            'printPDF',
        ]);
        $this->middleware('check_user_access_create:' . $this->menu_id)->only([
            'create',
            'datatablesClientID',
            'datatablesWarehouseID',
            'getModalItemDetailSKU',
            'datatablesModalItemDetailLocation',
            'storeItemDetail',
        ]);
        $this->middleware('check_user_access_update:' . $this->menu_id)->only([
            'datatablesTargetUserAssign',
            'processAssignWarehouseman',
            'confirmMovement',
            'cancelMovement',
            'viewMovementActivity',
        ]);
        $this->middleware('check_user_access_delete:' . $this->menu_id)->only([]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("movement-location.index", compact('data'));
    }
    private function get_Data_Movement_Location($movement_location_id = false, $client_id = false, $movement_date_from = false, $movement_date_to = false, $warehouse_id = false, $status = false)
    {

        $data = DB::query()
            ->select([
                "a.movement_id",
                "b.client_project_name AS client_id",
                "c.wh_code",
                "a.movement_date",
                "d.status_name",
                "a.user_created",
                "a.datetime_created",
                "a.status_id",
            ])
            ->from("t_wh_movement as a")
            ->leftJoin("m_wh_client_project as b", "a.client_project_id", "=", "b.client_project_id")
            ->leftJoin("m_warehouse as c", "c.wh_id", "=", "a.wh_id")
            ->leftJoin("m_status as d", "a.status_id", "=", "d.status_id")
            ->where("a.client_project_id", session("current_client_project_id"))
            ->where(function ($query) use ($movement_location_id) {
                if (!empty($movement_location_id)) {
                    $query->where("a.movement_id", $movement_location_id);
                }
            })
            ->where(function ($query) use ($client_id) {
                if (!empty($client_id)) {
                    $query->where("b.client_project_name", $client_id);
                }
            })
            ->where(function ($query) use ($warehouse_id) {
                if (!empty($warehouse_id)) {
                    $query->where("c.wh_code", $warehouse_id);
                }
            })
            ->where(function ($query) use ($movement_date_from, $movement_date_to) {
                if (!empty($movement_date_from) && !empty($movement_date_to)) {
                    $query->whereBetween("a.movement_date", [$movement_date_from, $movement_date_to]);
                }
            })
            ->orderBy("a.datetime_created", "DESC")
            ->get();
        return $data;
    }

    public function datatables(Request $request)
    {
        $movement_location_id = $request->input("movement_location_id");
        $client_id = $request->input("client_id");
        $movement_date_from = $request->input("movement_date_from");
        $movement_date_to = $request->input("movement_date_to");
        $warehouse_id = $request->input("warehouse_id");
        $status = $request->input("status");

        $data = $this->get_Data_Movement_Location($movement_location_id, $client_id, $movement_date_from, $movement_date_to, $warehouse_id, $status);

        return DataTables::of($data)
            ->addColumn('action', function ($movement_location) {
                $button = "";
                $button .= "<div class='text-center'>";
                $button .= "<a href='" . route('movement_location.show', ['id' => $movement_location->movement_id]) . "' class='text-decoration-none'>
            <button class='btn btn-primary mb-0 py-1'>Show</button>
            </a>";
                $button .= "</div>";
                return $button;
            })
            ->make(true);
    }

    private function get_Movement_Location_ID()
    {
        $data = DB::query()
            ->select([
                "a.movement_id",
            ])
            ->from("t_wh_movement as a")
            ->where("a.client_project_id", session("current_client_project_id"))
            ->get();
        return $data;
    }

    public function datatablesMovementLocationID(Request $request)
    {
        $data = $this->get_Movement_Location_ID();

        return DataTables::of($data)
            ->make(true);
    }

    private function get_Movement_Status()
    {
        $data = DB::query()
            ->select([
                "b.status_name",
            ])
            ->from("t_wh_movement as a")
            ->leftJoin("m_status as b", "b.status_id", "=", "a.status_id")
            ->where("a.client_project_id", session("current_client_project_id"))
            ->get();
        return $data;
    }

    public function datatablesMovementStatus(Request $request)
    {
        $data = $this->get_Movement_Status();

        return DataTables::of($data)
            ->make(true);
    }

    public function viewExcel(Request $request)
    {
        $data = DB::select("SELECT 
        a.movement_id,
        b.client_project_name AS client_name,
        c.wh_code,
        a.movement_date,
        e.sku,
        e.part_name,
        e.batch_no,
        e.serial_no,
        e.stock_id AS stock_type,
        e.qty,
        e.location_from,
        e.location_to,
        d.status_name,
        a.user_created,
        date(a.datetime_created) AS created_date
        FROM t_wh_movement AS a
        LEFT JOIN m_wh_client_project AS b ON a.client_project_id = b.client_project_id
        LEFT JOIN m_warehouse AS c ON a.wh_id = c.wh_id
        LEFT JOIN m_status AS d ON a.status_id = d.status_id
        LEFT JOIN t_wh_temporary_movement_copy e ON a.movement_id=e.movement_id
        WHERE a.client_project_id = ?
        ORDER BY a.datetime_created DESC
        ", [
            session("current_client_project_id"),
        ]);

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator(config('app.name'))
            ->setLastModifiedBy(config('app.name'))
            ->setTitle("Movement Location Excel")
            ->setSubject("Movement Location Excel")
            ->setDescription("Movement Location Excel")
            ->setKeywords("office 2007 openxml php");
        $spreadsheet->getActiveSheet()->setTitle('Movement_Location');

        $row = 1;
        $row_alphabet = "A";
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Movement Location Id");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Client Name");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Warehouse Name");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Movement Date");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "SKU");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Part Name");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Batch No");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Serial No");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Stock Type");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Qty");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Location From");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Location To");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Status");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Created By");
        $row_alphabet++;
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, "Created On");
        $row_alphabet++;
        $row++;

        if (count($data) > 0) {
            foreach ($data as $key_data => $value_data) {
                $row_alphabet = "A";
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->movement_id);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->client_name);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->wh_code);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->movement_date);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->sku);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->part_name);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->batch_no);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->serial_no);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->stock_type);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->qty);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->location_from);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->location_to);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->status_name);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->user_created);
                $row_alphabet++;
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet . $row, @$value_data->created_date);
                $row_alphabet++;
                $row++;
            }
        }

        $filename = "Movement_Location_" . date("YmdHis", strtotime($this->datetime_now));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $objWriter->save('php://output');
        exit();
    }

    private function get_Data_Item_Details_Movement_Location($movement_id)
    {
        // SELECT sku, part_name, batch_no, serial_no, expired_date, qty, uom_name, stock_id, location_from, location_type_from, location_to, location_type_to
        // FROM t_wh_temporary_movement_copy
        // WHERE movement_id='CBT-08-1122-0002'
        $data = DB::query()
            ->select([
                "a.sku",
                "a.part_name",
                "a.batch_no",
                "a.serial_no",
                "a.expired_date",
                "a.qty",
                "a.uom_name",
                "a.stock_id",
                "a.location_from",
                "a.location_type_from",
                "a.location_to",
                "a.location_type_to",
                "a.gr_id",
            ])
            ->from("t_wh_temporary_movement_copy as a")
            ->where("a.movement_id", $movement_id)
            ->get();
        return $data;
    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Data_Movement_Location($id);
        $current_data_item_detail = $this->get_Data_Item_Details_Movement_Location($id);

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_item_detail"] = $current_data_item_detail;

        return view("movement-location.show", compact("data"));
    }

    public function create()
    {
        return view("movement-location.create");
    }

    private function get_Client_ID()
    {
        $data = DB::query()
            ->select([
                "client_project_name",
            ])
            ->from("m_wh_client_project")
            ->where("client_project_id", session("current_client_project_id"))
            ->get();
        return $data;
    }

    public function datatablesClientID()
    {
        $data = $this->get_Client_ID();

        return DataTables::of($data)
            ->make(true);
    }

    private function get_Warehouse_ID()
    {
        $data = DB::query()
            ->select([
                "b.wh_code",
            ])
            ->from("m_wh_client_project as a")
            ->leftJoin("m_warehouse as b", "a.client_project_id", "=", "b.client_project_id")
            ->where("a.client_project_id", session("current_client_project_id"))
            ->get();
        return $data;
    }

    public function datatablesWarehouseID()
    {
        $data = $this->get_Warehouse_ID();

        return DataTables::of($data)
            ->make(true);
    }

    public function getModalItemDetailSKU(Request $request)
    {
        $search = $request->input("search");
        $data = DB::query()
            ->select([
                "a.sku",
                "a.part_name",
                "a.batch_no",
                "a.serial_no",
                "a.expired_date",
                "a.pallet_id",
                "a.location_id",
                "a.location_type",
                "a.available_qty",
                "a.uom_name",
                "a.stock_id",
                "a.gr_id",
            ])
            ->from("t_wh_location_inventory as a")
            ->where("a.client_project_id", session("current_client_project_id"))
            ->where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->orWhere("sku", "like", "%" . $search . "%");
                    $query->orWhere("part_name", "like", "%" . $search . "%");
                    $query->orWhere("batch_no", "like", "%" . $search . "%");
                    $query->orWhere("serial_no", "like", "%" . $search . "%");
                    $query->orWhere("expired_date", "like", "%" . $search . "%");
                    $query->orWhere("pallet_id", "like", "%" . $search . "%");
                    $query->orWhere("location_id", "like", "%" . $search . "%");
                    $query->orWhere("location_type", "like", "%" . $search . "%");
                    $query->orWhere("available_qty", "like", "%" . $search . "%");
                    $query->orWhere("uom_name", "like", "%" . $search . "%");
                    $query->orWhere("stock_id", "like", "%" . $search . "%");
                }
            })
            ->get();

        return response()->json([
            "err" => false,
            "message" => "Success getModalItemDetailSKU",
            "data" => $data,
        ], 200);
    }

    private function get_Modal_Item_Detail_location()
    {
        $data = DB::query()
            ->select([
                "a.location_code",
                "a.location_type",
                "c.wh_code",
            ])
            ->from("m_wh_location as a")
            ->leftJoin("m_wh_client_project as b", "a.client_project_id", "=", "b.client_project_id")
            ->leftJoin("m_warehouse as c","c.wh_id","=","a.wh_id")
            ->where("b.client_project_id", session("current_client_project_id"))
            // ->where("c.wh_id", session("current_wh_id"))
            ->orderBy("a.location_code", "ASC")
            ->get();
        return $data;
    }

    public function datatablesModalItemDetailLocation()
    {
        $data = $this->get_Modal_Item_Detail_location();
        // echo($data);die();
        return DataTables::of($data)
            ->make(true);
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

    public function storeItemDetail(Request $request)
    {
        $movement_date = $request->input("movement_date");
        $arr_sku_no = json_decode($request->input("arr_sku_no"), true);
        $arr_item_name = json_decode($request->input("arr_item_name"), true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"), true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"), true);
        $arr_expired_date = json_decode($request->input("arr_expired_date"), true);
        $arr_qty = json_decode($request->input("arr_qty"), true);
        $arr_uom = json_decode($request->input("arr_uom"), true);
        $arr_stock_type = json_decode($request->input("arr_stock_type"), true);
        $arr_pallet_id = json_decode($request->input("arr_pallet_id"), true);
        $arr_location_id = json_decode($request->input("arr_location_id"), true);
        $arr_location_type = json_decode($request->input("arr_location_type"), true);
        $arr_dest_pallet_id = json_decode($request->input("arr_dest_pallet_id"), true);
        $arr_dest_location_id = json_decode($request->input("arr_dest_location_id"), true);
        $arr_dest_location_type = json_decode($request->input("arr_dest_location_type"), true);
        $arr_gr_id = json_decode($request->input("arr_gr_id"), true);

        $data_error = [];

        $max_row_count_item_detail = count($arr_sku_no);
        for ($i = 0; $i < $max_row_count_item_detail; $i++) {
            $qty_id = $arr_qty[$i]['id'];
            $qty_value = $arr_qty[$i]['value'];

            if (empty($qty_value)) {
                $data_error[$qty_id][] = "Qty is Required";
            } else if ($qty_value <= 0) {
                $data_error[$qty_id][] = "Qty must more than 0";
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

            $process_code = "08";
            $process_id = "8";
            $wh_prefix = $this->getWHPrefix();
            $date_format_stock_transfer = date("my", strtotime($this->datetime_now));
            $current_running_number = $this->getLastRunningNumber($process_code) + 1;
            $running_number = $this->mustFourDigits($current_running_number);
            $movement_id = $wh_prefix . "-" . $process_code . "-" . $date_format_stock_transfer . "-" . $running_number;
            if ($current_running_number > 9999) {
                DB::rollBack();
                return response()->json([
                    "err" => true,
                    "message" => "Running Number is more than 9999, cant create more.",
                    "data" => [],
                ], 200);
            }

            $this->updateRunningNumber($current_running_number, $process_code);

            DB::table("t_wh_movement")
                ->insert([
                    "movement_id" => $movement_id,
                    "wh_id" => session("current_warehouse_id"),
                    "client_project_id" => session("current_client_project_id"),
                    "movement_date" => $movement_date,
                    "status_id" => "OPM",
                    "user_created" => session('username'),
                    "datetime_created" => $this->datetime_now,
                ]);

            $max_row_item_detail = count($arr_sku_no);
            for ($i = 0; $i < $max_row_item_detail; $i++) {

                $sku_no = $arr_sku_no[$i]["value"];
                $item_name = $arr_item_name[$i]["value"];
                $batch_no = $arr_batch_no[$i]["value"];
                $serial_no = $arr_serial_no[$i]["value"];
                $expired_date = (!empty($arr_expired_date[$i]["value"])) ? $arr_expired_date[$i]["value"] : null;
                $qty = $arr_qty[$i]["value"];
                $uom = $arr_uom[$i]["value"];
                $stock_type = $arr_stock_type[$i]["value"];
                $pallet_id = $arr_pallet_id[$i]["value"];
                $location_id = $arr_location_id[$i]["value"];
                $location_type = $arr_location_type[$i]["value"];
                $dest_pallet_id = $arr_dest_pallet_id[$i]["value"];
                $dest_location_id = $arr_dest_location_id[$i]["value"];
                $dest_location_type = $arr_dest_location_type[$i]["value"];
                $gr_id = $arr_gr_id[$i]["value"];

                DB::table("t_wh_temporary_movement_copy")
                    ->insert([
                        "movement_id" => $movement_id,
                        "process_id" => $process_id,
                        "sku" => $sku_no,
                        "part_name" => $item_name,
                        "batch_no" => $batch_no,
                        "serial_no" => $serial_no,
                        "expired_date" => $expired_date,
                        "qty" => $qty,
                        "uom_name" => $uom,
                        "stock_id" => $stock_type,
                        "location_from" => $location_id,
                        "location_type_from" => $location_type,
                        "location_to" => $dest_location_id,
                        "location_type_to" => $dest_location_type,
                        "gr_id" => $gr_id,
                        "user_created" => session('username'),
                        "datetime_created" => $this->datetime_now,
                        "is_active" => "Y",
                    ]);

                $data_t_wh_location_inventory = DB::select("SELECT 
                sku, on_hand_qty, allocated_qty, uom_name
                FROM t_wh_location_inventory
                WHERE client_project_id = ? /* '1' */
                and location_id = ? /* '1A1-001-003' */
                AND stock_id = ? /* 'AV' */
                AND sku = ? /* '112233446' */
                AND gr_id = ? /* 'CBT-GR-1222-0016' */
                ", [
                    session("current_client_project_id"),
                    $location_id,
                    $stock_type,
                    $sku_no,
                    $gr_id,
                ]);

                DB::table("t_wh_location_inventory")
                ->where("location_id",$location_id)
                ->where("stock_id",$stock_type)
                ->where("sku",$sku_no)
                ->where("gr_id",$gr_id)
                ->update([
                    "on_hand_qty" => (@$data_t_wh_location_inventory[0]->on_hand_qty - $qty),
                    "allocated_qty" => (@$data_t_wh_location_inventory[0]->allocated_qty + $qty),
                    "last_movement_id" => $movement_id,
                    "user_updated" => session('username'),
                    "datetime_updated" => $this->datetime_now,
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
            "message" => "Success Add Movement Location",
            "data" => [],
        ], 200);
    }

    private function getTargetUserAssign($username = false)
    {
        $data = DB::query()
            ->select([
                "a.username",
                "a.fullname",
            ])
            ->from("t_wh_user as a")
            ->leftJoin("m_wh_user_level as b", "b.user_level_id", "=", "a.user_level_id")
            ->leftJoin("m_wh_user_client_project as c", "c.username", "=", "a.username")
            ->leftJoin("m_wh_client_project as d", "d.client_project_id", "=", "c.client_project_id")
            ->where("a.wh_id", session('current_warehouse_id'))
            ->where("d.client_id", session('current_client_id'))
            ->where("c.client_project_id", session('current_client_project_id'))
            ->whereIn("b.user_level_id", ["2", "3"])
            ->where(function ($query) use ($username) {
                if ($username !== false) {
                    $query->where("a.username", $username);
                }
            })
            ->get();
        return $data;
    }

    public function datatablesTargetUserAssign(Request $request)
    {
        // DB::enableQueryLog();
        $data = $this->getTargetUserAssign();
        // print_r(DB::getQueryLog());
        return DataTables::of($data)
            ->make(true);
    }

    public function processAssignWarehouseman(Request $request, $id)
    {
        $current_data = $this->get_Data_Movement_Location($id);

        if (count($current_data) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Movement ID is not exits, please reload page.",
                "data" => [],
            ], 200);
        }

        if ($current_data[0]->status_id != "OPM") {
            return response()->json([
                "err" => true,
                "message" => "Movement ID is status is not OPM, please reload page.",
                "data" => [],
            ], 200);
        }

        $arr_warehouseman_username = json_decode($request->input("arr_warehouseman_username"), true);
        $arr_warehouseman_date_start = json_decode($request->input("arr_warehouseman_date_start"), true);
        $arr_warehouseman_time_start = json_decode($request->input("arr_warehouseman_time_start"), true);
        $arr_warehouseman_date_finish = json_decode($request->input("arr_warehouseman_date_finish"), true);
        $arr_warehouseman_time_finish = json_decode($request->input("arr_warehouseman_time_finish"), true);

        DB::beginTransaction();
        try {
            $max_count_warehouseman = count($arr_warehouseman_username);
            for ($i = 0; $i < $max_count_warehouseman; $i++) {
                $username = $arr_warehouseman_username[$i]["value"];
                $date_start = $arr_warehouseman_date_start[$i]["value"];
                $time_start = $arr_warehouseman_time_start[$i]["value"];
                $date_finish = $arr_warehouseman_date_finish[$i]["value"];
                $time_finish = $arr_warehouseman_time_finish[$i]["value"];

                $datetime_est_start = null;
                if (!empty($date_start) && !empty($time_start)) {
                    $datetime_est_start = date("Y-m-d H:i:00", strtotime($date_start . " " . $time_start));
                }

                $datetime_est_finish = null;
                if (!empty($date_finish) && !empty($time_finish)) {
                    $datetime_est_finish = date("Y-m-d H:i:00", strtotime($date_finish . " " . $time_finish));
                }

                DB::table("t_wh_activity")->insert([
                    "process_id" => "8",
                    "movement_id" => $current_data[0]->movement_id,
                    "checker" => $username,
                    "datetime_est_start" => $datetime_est_start,
                    "datetime_est_finish" => $datetime_est_finish,
                    "user_created" => session('username'),
                    "datetime_created" => $this->datetime_now,
                ]);
            }

            DB::table("t_wh_movement")
                ->where("movement_id", $current_data[0]->movement_id)
                ->where("client_project_id", session("current_client_project_id"))
                ->update([
                    "status_id" => "ASM",
                    "user_updated" => session('username'),
                    "datetime_updated" => $this->datetime_now,
                ]);
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
            "message" => "Success Assign Warehouseman",
            "data" => [],
        ], 200);
    }

    public function printPDF(Request $request, $id)
    {
        $current_data = $this->get_Data_Movement_Location($id);

        if (count($current_data) == 0) {
            echo "<script>
            alert('Movement ID doesnt exist');
            window.location.href = '" . route('movement_location.index') . "'
            </script>";
            return;
        }

        $data = [];
        $data["data_header"] = DB::select("SELECT a.movement_id, c.client_name, d.wh_code
        FROM t_wh_movement a
        LEFT JOIN m_wh_client_project b ON a.client_project_id=b.client_project_id
        LEFT JOIN m_wh_client c ON b.client_id=c.client_id
        LEFT JOIN m_warehouse d ON a.wh_id=d.wh_id
        WHERE a.movement_id = ?
        ", [
            @$current_data[0]->movement_id,
        ]);

        $data["data_detail"] = DB::select("SELECT 
        a.sku,
        a.part_name,
        a.batch_no,
        a.serial_no,
        a.expired_date,
        a.qty,
        a.uom_name,
        a.stock_id,
        a.location_from,
        a.location_type_from,
        a.location_to,
        a.location_type_to
        FROM t_wh_temporary_movement_copy AS a
        WHERE a.movement_id = ?
        ", [
            @$current_data[0]->movement_id,
        ]);

        $pdf = Pdf::loadView('movement-location.pdf', compact('data'))->setPaper('a4', 'landscape');;
        return $pdf->stream($current_data[0]->movement_id . ".pdf");
    }

    public function confirmMovement(Request $request, $id)
    {
        $current_data = $this->get_Data_Movement_Location($id);
        if (count($current_data) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Movement ID is not exits,please reload page.",
                "data" => [],
            ], 200);
        }

        if ($current_data[0]->status_id != "MOM") {
            return response()->json([
                "err" => true,
                "message" => "Status ID is not MOM",
                "data" => [],
            ], 200);
        }

        $current_data_item_detail = $this->get_Data_Item_Details_Movement_Location($id);

        DB::beginTransaction();
        try {

            // UPDATE t_wh_movement
            // SET
            //     status_id='COM',
            //     user_updated='atmi',
            //     datetime_updated=NOW()
            // WHERE movement_id='CBT-08-1122-0002'
            // AND client_project_id='1' #based on login
            DB::table("t_wh_movement")
                ->where("movement_id", $current_data[0]->movement_id)
                ->where("client_project_id", session("current_client_project_id"))
                ->update([
                    "status_id" => "COM",
                    "user_updated" => session('username'),
                    "datetime_updated" => $this->datetime_now,
                ]);

            if (count($current_data_item_detail) > 0) {
                foreach ($current_data_item_detail as $key_current_data_item_detail => $value_current_data_item_detail) {
                    $item_detail_batch_no = $value_current_data_item_detail->batch_no;
                    $item_detail_expired_date = $value_current_data_item_detail->expired_date;
                    $item_detail_gr_id = $value_current_data_item_detail->gr_id;
                    $item_detail_location_from = $value_current_data_item_detail->location_from;
                    $item_detail_location_type_from = $value_current_data_item_detail->location_type_from;
                    $item_detail_location_to = $value_current_data_item_detail->location_to;
                    $item_detail_location_type_to = $value_current_data_item_detail->location_type_to;
                    $item_detail_part_name = $value_current_data_item_detail->part_name;
                    $item_detail_qty = $value_current_data_item_detail->qty;
                    $item_detail_serial_no = $value_current_data_item_detail->serial_no;
                    $item_detail_sku = $value_current_data_item_detail->sku;
                    $item_detail_stock_id = $value_current_data_item_detail->stock_id;
                    $item_detail_uom_name = $value_current_data_item_detail->uom_name;

                    // SELECT *
                    // FROM t_wh_location_inventory
                    // WHERE sku='112233445' #diambil dari field sku
                    // AND batch_no='20230113' #diambil dari field batch_no
                    // AND serial_no='' #diambil dari field serial_no
                    // AND location_id='1A1-001-002' #diambil dari location to
                    // AND gr_id='CBT-GR-0123-0007' #diambil dari field gr_id
                    // AND stock_id='AV' #diambil dari field stock_id\
                    $check_location_inventory = DB::query()
                        ->select("*")
                        ->from("t_wh_location_inventory")

                        ->where("sku", $item_detail_sku)
                        ->where("location_id", $item_detail_location_to)
                        ->where("gr_id", $item_detail_gr_id)
                        ->where("stock_id", $item_detail_stock_id)
                        ->where(function ($query) use ($item_detail_batch_no) {
                            if (!empty($item_detail_batch_no)) {
                                $query->where("batch_no", $item_detail_batch_no);
                            }
                        })
                        ->where(function ($query) use ($item_detail_serial_no) {
                            $query->where("serial_no", $item_detail_serial_no);
                        })
                        ->get();

                    if (count($check_location_inventory) > 0) {
                        // SELECT a.sku, a.batch_no, a.serial_no, a.on_hand_qty, a.available_qty, b.qty AS move_qty, (a.on_hand_qty+b.qty) AS update_onhandqty, (a.available_qty+b.qty) AS update_available_qty
                        // FROM t_wh_location_inventory a
                        // LEFT JOIN t_wh_temporary_movement_copy b ON a.sku=b.sku AND a.location_id=b.location_to AND a.gr_id=b.gr_id AND a.batch_no=b.batch_no AND a.serial_no=b.serial_no
                        // WHERE a.sku='112233445' #diambil dari field sku
                        // AND a.batch_no='20230113' #diambil dari field batch_no
                        // AND a.serial_no='' #diambil dari field serial_no
                        // AND a.location_id='1A1-001-002' #diambil dari location to
                        // AND a.gr_id='CBT-GR-0123-0007' #diambil dari field gr_id
                        // AND a.stock_id='AV' #diambil dari field stock_id
                        $calc_data = DB::query()
                            ->select([
                                "a.sku",
                                "a.batch_no",
                                "a.serial_no",
                                "a.on_hand_qty",
                                "a.available_qty",
                                "b.qty AS move_qty",
                                DB::raw("(a.on_hand_qty+b.qty) AS update_onhandqty"),
                                DB::raw("(a.available_qty+b.qty) AS update_available_qty"),
                            ])
                            ->from("t_wh_location_inventory as a")
                            ->leftJoin("t_wh_temporary_movement_copy as b", function ($query) {
                                $query->on("a.sku", "=", "b.sku");
                                $query->on("a.location_id", "=", "b.location_to");
                                $query->on("a.gr_id", "=", "b.gr_id");
                                $query->on("a.batch_no", "=", "b.batch_no");
                                $query->on("a.serial_no", "=", "b.serial_no");
                            })
                            ->where("a.sku", $item_detail_sku)
                            ->where("a.location_id", $item_detail_location_to)
                            ->where("a.gr_id", $item_detail_gr_id)
                            ->where("a.stock_id", $item_detail_stock_id)
                            ->where(function ($query) use ($item_detail_batch_no) {
                                if (!empty($item_detail_batch_no)) {
                                    $query->where("a.batch_no", $item_detail_batch_no);
                                }
                            })
                            ->where(function ($query) use ($item_detail_serial_no) {
                                $query->where("a.serial_no", $item_detail_serial_no);
                            })
                            ->get();

                        $update_onhandqty = $calc_data[0]->update_onhandqty;
                        $update_available_qty = $calc_data[0]->update_available_qty;

                        // UPDATE t_wh_location_inventory
                        // SET
                        //     on_hand_qty='64', #dari update_onhandqty di query sebelumnya
                        //     available_qty='64', #dari update_onhandqty di query sebelumnya
                        //     last_movement_id='CBT-08-0123-0003', #diambil dari movement id sesi tsb
                        //     user_updated='atmi', #diambil dari login session
                        //     datetime_updated=NOW()
                        // WHERE sku='112233445' #diambil dari field sku
                        // AND batch_no='20230113' #diambil dari field batch_no
                        // AND serial_no='' #diambil dari field serial_no
                        // AND location_id='1A1-001-002' #diambil dari location to
                        // AND gr_id='CBT-GR-0123-0007' #diambil dari field gr_id
                        // AND stock_id='AV' #diambil dari field stock_id
                        DB::table("t_wh_location_inventory")
                            ->where("sku", $item_detail_sku)
                            ->where("location_id", $item_detail_location_to)
                            ->where("gr_id", $item_detail_gr_id)
                            ->where("stock_id", $item_detail_stock_id)
                            ->where(function ($query) use ($item_detail_batch_no) {
                                if (!empty($item_detail_batch_no)) {
                                    $query->where("batch_no", $item_detail_batch_no);
                                }
                            })
                            ->where(function ($query) use ($item_detail_serial_no) {
                                $query->where("serial_no", $item_detail_serial_no);
                            })
                            ->update([
                                "on_hand_qty" => $update_onhandqty,
                                "available_qty" => $update_available_qty,
                                "last_movement_id" => $current_data[0]->movement_id,
                                "user_updated" => session('username'),
                                "datetime_updated" => $this->datetime_now,
                            ]);

                        $check_location_inventory_from = DB::query()
                            ->select("*")
                            ->from("t_wh_location_inventory")

                            ->where("sku", $item_detail_sku)
                            ->where("location_id", $item_detail_location_from)
                            ->where("gr_id", $item_detail_gr_id)
                            ->where("stock_id", $item_detail_stock_id)
                            ->where(function ($query) use ($item_detail_batch_no) {
                                if (!empty($item_detail_batch_no)) {
                                    $query->where("batch_no", $item_detail_batch_no);
                                }
                            })
                            ->where(function ($query) use ($item_detail_serial_no) {
                                $query->where("serial_no", $item_detail_serial_no);
                            })
                            ->get();

                        if (count($check_location_inventory_from) > 0) {
                            $from_allocated_qty = $check_location_inventory_from[0]->allocated_qty;
                            $from_available_qty = $check_location_inventory_from[0]->available_qty;
                            $calc_from_allocated_qty = $from_allocated_qty - $item_detail_qty;
                            $calc_from_available_qty = $from_available_qty - $item_detail_qty;
                            // UPDATE t_wh_location_inventory
                            // SET
                            //         allocated_qty='', #dari allocated qty eksisting – move qty
                            //         available_qty='', #dari available qty eksisting – move qty
                            //         last_movement_id='CBT-08-0123-0003', #diambil dari movement id sesi tsb
                            //         user_updated='atmi', #diambil dari login session
                            //         datetime_updated=NOW()
                            //     WHERE sku='112233445' #diambil dari field sku
                            //     AND batch_no='20230113' #diambil dari field batch_no
                            //     AND serial_no='' #diambil dari field serial_no
                            //     AND location_id='1A1-001-001' #diambil dari location from
                            //     AND gr_id='CBT-GR-0123-0007' #diambil dari field gr_id
                            //     AND stock_id='AV' #diambil dari field stock_id
                            DB::table("t_wh_location_inventory")
                                ->where("sku", $item_detail_sku)
                                ->where("location_id", $item_detail_location_from)
                                ->where("gr_id", $item_detail_gr_id)
                                ->where("stock_id", $item_detail_stock_id)
                                ->where(function ($query) use ($item_detail_batch_no) {
                                    if (!empty($item_detail_batch_no)) {
                                        $query->where("batch_no", $item_detail_batch_no);
                                    }
                                })
                                ->where(function ($query) use ($item_detail_serial_no) {
                                    $query->where("serial_no", $item_detail_serial_no);
                                })
                                ->update([
                                    "allocated_qty" => $calc_from_allocated_qty,
                                    "available_qty" => $calc_from_available_qty,
                                    "last_movement_id" => $current_data[0]->movement_id,
                                    "user_updated" => session('username'),
                                    "datetime_updated" => $this->datetime_now,
                                ]);
                        }
                    } else {
                        $check_location_inventory_from_before_insert = DB::query()
                            ->select("*")
                            ->from("t_wh_location_inventory")

                            ->where("sku", $item_detail_sku)
                            ->where("location_id", $item_detail_location_from)
                            ->where("gr_id", $item_detail_gr_id)
                            ->where("stock_id", $item_detail_stock_id)
                            ->where(function ($query) use ($item_detail_batch_no) {
                                if (!empty($item_detail_batch_no)) {
                                    $query->where("batch_no", $item_detail_batch_no);
                                }
                            })
                            ->where(function ($query) use ($item_detail_serial_no) {
                                $query->where("serial_no", $item_detail_serial_no);
                            })
                            ->get();

                        // INSERT INTO t_wh_location_inventory
                        // (
                        //     location_id,
                        //     location_type,
                        //     client_project_id,
                        //     sku,
                        //     part_name,
                        //     batch_no,
                        //     serial_no,
                        //     expired_date,
                        //     on_hand_qty,
                        //     available_qty,
                        //     uom_name,
                        //     stock_id,
                        //     gr_id,
                        //     gr_datetime,
                        //     last_movement_id,
                        //     user_created,
                        //     datetime_created,
                        //     is_active
                        // ) VALUES (
                        //     '1A1-001-002', #location_to
                        //     'Racking', #location_type_to
                        //     '1', #based on login
                        //     '112233445', #sku
                        //     'Teh Kotak Original', #part_name
                        //     '20230113', #batch_no
                        //     '', #serial_no
                        //     '2023-12-12 00:00:00', #expired_date
                        //     '4', #diambil dr qty move
                        //     '4', #diambil dr qty move
                        //     'PIECES',
                        //     'AV',
                        //     'CBT-GR-0123-0007',
                        //     '2023-01-13 10:18:21',
                        //     'CBT-08-0123-0003',
                        //     'atmi',
                        //     NOW(),
                        //     'Y'
                        // )
                        $data_t_wh_location_inventory = [
                            "location_id" => $item_detail_location_to,
                            "location_type" => $item_detail_location_type_to,
                            "client_project_id" => session("current_client_project_id"),
                            "sku" => $item_detail_sku,
                            "part_name" => $item_detail_part_name,
                            "batch_no" => $item_detail_batch_no,
                            "serial_no" => $item_detail_serial_no,
                            "on_hand_qty" => $item_detail_qty,
                            "available_qty" => $item_detail_qty,
                            "uom_name" => $item_detail_uom_name,
                            "stock_id" => $item_detail_stock_id,
                            "gr_id" => $item_detail_gr_id,
                            "clasification_id" => @$check_location_inventory_from_before_insert[0]->clasification_id,
                            "gr_datetime" => @$check_location_inventory_from_before_insert[0]->gr_datetime,
                            "last_movement_id" => $current_data[0]->movement_id,
                            "user_created" => session('username'),
                            "datetime_created" => $this->datetime_now,
                            "is_active" => 'Y',
                        ];
                        if (!empty($item_detail_expired_date)) {
                            $data_t_wh_location_inventory["expired_date"] = $item_detail_expired_date;
                        }
                        DB::table("t_wh_location_inventory")
                            ->insert($data_t_wh_location_inventory);

                        $check_location_inventory_from = DB::query()
                            ->select("*")
                            ->from("t_wh_location_inventory")

                            ->where("sku", $item_detail_sku)
                            ->where("location_id", $item_detail_location_from)
                            ->where("gr_id", $item_detail_gr_id)
                            ->where("stock_id", $item_detail_stock_id)
                            ->where(function ($query) use ($item_detail_batch_no) {
                                if (!empty($item_detail_batch_no)) {
                                    $query->where("batch_no", $item_detail_batch_no);
                                }
                            })
                            ->where(function ($query) use ($item_detail_serial_no) {
                                $query->where("serial_no", $item_detail_serial_no);
                            })
                            ->get();

                        if (count($check_location_inventory_from) > 0) {
                            $from_allocated_qty = $check_location_inventory_from[0]->allocated_qty;
                            $from_available_qty = $check_location_inventory_from[0]->available_qty;
                            $calc_from_allocated_qty = $from_allocated_qty - $item_detail_qty;
                            $calc_from_available_qty = $from_available_qty - $item_detail_qty;
                            // UPDATE t_wh_location_inventory
                            // SET
                            //         allocated_qty='', #dari allocated qty eksisting – move qty
                            //         available_qty='', #dari available qty eksisting – move qty
                            //         last_movement_id='CBT-08-0123-0003', #diambil dari movement id sesi tsb
                            //         user_updated='atmi', #diambil dari login session
                            //         datetime_updated=NOW()
                            //     WHERE sku='112233445' #diambil dari field sku
                            //     AND batch_no='20230113' #diambil dari field batch_no
                            //     AND serial_no='' #diambil dari field serial_no
                            //     AND location_id='1A1-001-001' #diambil dari location from
                            //     AND gr_id='CBT-GR-0123-0007' #diambil dari field gr_id
                            //     AND stock_id='AV' #diambil dari field stock_id
                            DB::table("t_wh_location_inventory")
                                ->where("sku", $item_detail_sku)
                                ->where("location_id", $item_detail_location_from)
                                ->where("gr_id", $item_detail_gr_id)
                                ->where("stock_id", $item_detail_stock_id)
                                ->where(function ($query) use ($item_detail_batch_no) {
                                    if (!empty($item_detail_batch_no)) {
                                        $query->where("batch_no", $item_detail_batch_no);
                                    }
                                })
                                ->where(function ($query) use ($item_detail_serial_no) {
                                    $query->where("serial_no", $item_detail_serial_no);
                                })
                                ->update([
                                    "allocated_qty" => $calc_from_allocated_qty,
                                    "available_qty" => $calc_from_available_qty,
                                    "last_movement_id" => $current_data[0]->movement_id,
                                    "user_updated" => session('username'),
                                    "datetime_updated" => $this->datetime_now,
                                ]);
                        }
                    }

                    $check_location_inventory2 = DB::query()
                        ->select("*")
                        ->from("t_wh_location_inventory")

                        ->where("sku", $item_detail_sku)
                        ->where("location_id", $item_detail_location_from)
                        ->where("gr_id", $item_detail_gr_id)
                        ->where("stock_id", $item_detail_stock_id)
                        ->where(function ($query) use ($item_detail_batch_no) {
                            if (!empty($item_detail_batch_no)) {
                                $query->where("batch_no", $item_detail_batch_no);
                            }
                        })
                        ->where(function ($query) use ($item_detail_serial_no) {
                            $query->where("serial_no", $item_detail_serial_no);
                        })
                        ->get();

                    if (count($check_location_inventory2) > 0) {
                        $on_hand_qty = $check_location_inventory2[0]->on_hand_qty;
                        $available_qty = $check_location_inventory2[0]->available_qty;
                        if ($on_hand_qty == 0 && $available_qty == 0) {
                            $check_location_inventory2 = DB::table("t_wh_location_inventory")
                                ->where("sku", $item_detail_sku)
                                ->where("location_id", $item_detail_location_from)
                                ->where("gr_id", $item_detail_gr_id)
                                ->where("stock_id", $item_detail_stock_id)
                                ->where(function ($query) use ($item_detail_batch_no) {
                                    if (!empty($item_detail_batch_no)) {
                                        $query->where("batch_no", $item_detail_batch_no);
                                    }
                                })
                                ->where(function ($query) use ($item_detail_serial_no) {
                                    $query->where("serial_no", $item_detail_serial_no);
                                })
                                ->delete();
                        }
                    }
                }
            }
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
            "message" => "Success Confirm",
            "data" => [],
        ], 200);
    }

    public function cancelMovement(Request $request, $id)
    {
        $current_data = $this->get_Data_Movement_Location($id);
        if (count($current_data) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Movement ID is not exits,please reload page.",
                "data" => [],
            ], 200);
        }

        if ($current_data[0]->status_id != "OPM") {
            return response()->json([
                "err" => true,
                "message" => "Status ID is not OPM",
                "data" => [],
            ], 200);
        }

        $current_data_item_detail = $this->get_Data_Item_Details_Movement_Location($id);

        DB::beginTransaction();
        try {
            DB::table("t_wh_movement")
                ->where("movement_id", $current_data[0]->movement_id)
                ->where("client_project_id", session("current_client_project_id"))
                ->update([
                    "status_id" => "CAM",
                    "user_updated" => session('username'),
                    "datetime_updated" => $this->datetime_now,
                ]);

            if (count($current_data_item_detail) > 0) {
                foreach ($current_data_item_detail as $key_current_data_item_detail => $value_current_data_item_detail) {
                    $item_detail_batch_no = $value_current_data_item_detail->batch_no;
                    $item_detail_expired_date = $value_current_data_item_detail->expired_date;
                    $item_detail_gr_id = $value_current_data_item_detail->gr_id;
                    $item_detail_location_from = $value_current_data_item_detail->location_from;
                    $item_detail_location_type_from = $value_current_data_item_detail->location_type_from;
                    $item_detail_location_to = $value_current_data_item_detail->location_to;
                    $item_detail_location_type_to = $value_current_data_item_detail->location_type_to;
                    $item_detail_part_name = $value_current_data_item_detail->part_name;
                    $item_detail_qty = $value_current_data_item_detail->qty;
                    $item_detail_serial_no = $value_current_data_item_detail->serial_no;
                    $item_detail_sku = $value_current_data_item_detail->sku;
                    $item_detail_stock_id = $value_current_data_item_detail->stock_id;
                    $item_detail_uom_name = $value_current_data_item_detail->uom_name;

                    $check_location_inventory_from = DB::query()
                        ->select("*")
                        ->from("t_wh_location_inventory")

                        ->where("sku", $item_detail_sku)
                        ->where("location_id", $item_detail_location_from)
                        ->where("gr_id", $item_detail_gr_id)
                        ->where("stock_id", $item_detail_stock_id)
                        ->where(function ($query) use ($item_detail_batch_no) {
                            if (!empty($item_detail_batch_no)) {
                                $query->where("batch_no", $item_detail_batch_no);
                            }
                        })
                        ->where(function ($query) use ($item_detail_serial_no) {
                            $query->where("serial_no", $item_detail_serial_no);
                        })
                        ->get();

                    if (count($check_location_inventory_from) > 0) {
                        $from_on_hand_qty = $check_location_inventory_from[0]->on_hand_qty;
                        $from_allocated_qty = $check_location_inventory_from[0]->allocated_qty;
                        $calc_from_on_hand_qty = $from_on_hand_qty + $item_detail_qty;
                        $calc_from_allocated_qty = $from_allocated_qty - $item_detail_qty;
                        // UPDATE t_wh_location_inventory
                        // SET
                        //         allocated_qty='', #dari allocated qty eksisting – move qty
                        //         available_qty='', #dari available qty eksisting – move qty
                        //         last_movement_id='CBT-08-0123-0003', #diambil dari movement id sesi tsb
                        //         user_updated='atmi', #diambil dari login session
                        //         datetime_updated=NOW()
                        //     WHERE sku='112233445' #diambil dari field sku
                        //     AND batch_no='20230113' #diambil dari field batch_no
                        //     AND serial_no='' #diambil dari field serial_no
                        //     AND location_id='1A1-001-001' #diambil dari location from
                        //     AND gr_id='CBT-GR-0123-0007' #diambil dari field gr_id
                        //     AND stock_id='AV' #diambil dari field stock_id
                        DB::table("t_wh_location_inventory")
                            ->where("sku", $item_detail_sku)
                            ->where("location_id", $item_detail_location_from)
                            ->where("gr_id", $item_detail_gr_id)
                            ->where("stock_id", $item_detail_stock_id)
                            ->where(function ($query) use ($item_detail_batch_no) {
                                if (!empty($item_detail_batch_no)) {
                                    $query->where("batch_no", $item_detail_batch_no);
                                }
                            })
                            ->where(function ($query) use ($item_detail_serial_no) {
                                $query->where("serial_no", $item_detail_serial_no);
                            })
                            ->update([
                                "allocated_qty" => $calc_from_allocated_qty,
                                "on_hand_qty" => $calc_from_on_hand_qty,
                                "last_movement_id" => $current_data[0]->movement_id,
                                "user_updated" => session('username'),
                                "datetime_updated" => $this->datetime_now,
                            ]);
                    }
                }
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
            "message" => "Success Cancel",
            "data" => [],
        ], 200);
    }

    public function viewMovementActivity(Request $request, $id)
    {
        $current_data = $this->get_Data_Movement_Location($id);
        $current_data_item_detail = $this->get_Data_Item_Details_Movement_Location($id);

        if (count($current_data) == 0) {
            echo "<script>
            alert('Movement ID is not exists');
            window.location.href = '" . route('movement_location.index') . "'
            </script>";
            return;
        }

        if ($current_data[0]->status_id != "ASM") {
            echo "<script>
            alert('Status ID is not ASM');
            window.location.href = '" . route('movement_location.index') . "'
            </script>";
            return;
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_item_detail"] = $current_data_item_detail;
        return view('movement-location.movement_activity', compact('data'));
    }

    public function saveMovementActivity(Request $request, $id)
    {
        $current_data = $this->get_Data_Movement_Location($id);
        $current_data_item_detail = $this->get_Data_Item_Details_Movement_Location($id);

        if (count($current_data) == 0) {
            return response()->json([
                "err" => true,
                "message" => "Movement ID is not exist, please reload page.",
                "data" => [],
            ], 200);
        }

        if ($current_data[0]->status_id != "ASM") {
            return response()->json([
                "err" => true,
                "message" => "Status ID is not ASM",
                "data" => [],
            ], 200);
        }

        $arr_sku_no = json_decode($request->input("arr_sku_no"), true);
        $arr_item_name = json_decode($request->input("arr_item_name"), true);
        $arr_batch_no = json_decode($request->input("arr_batch_no"), true);
        $arr_serial_no = json_decode($request->input("arr_serial_no"), true);
        $arr_expired_date = json_decode($request->input("arr_expired_date"), true);
        $arr_qty = json_decode($request->input("arr_qty"), true);
        $arr_uom = json_decode($request->input("arr_uom"), true);
        $arr_stock_type = json_decode($request->input("arr_stock_type"), true);
        $arr_pallet_id = json_decode($request->input("arr_pallet_id"), true);
        $arr_location_id = json_decode($request->input("arr_location_id"), true);
        $arr_location_type = json_decode($request->input("arr_location_type"), true);
        $arr_dest_pallet_id = json_decode($request->input("arr_dest_pallet_id"), true);
        $arr_dest_location_id = json_decode($request->input("arr_dest_location_id"), true);
        $arr_dest_location_type = json_decode($request->input("arr_dest_location_type"), true);
        $arr_gr_id = json_decode($request->input("arr_gr_id"), true);


        DB::beginTransaction();
        try {
            $max_item_detail = count($arr_dest_location_id);
            for ($i = 0; $i < $max_item_detail; $i++) {
                $sku_no = $arr_sku_no[$i]["value"];
                $item_name = $arr_item_name[$i]["value"];
                $batch_no = $arr_batch_no[$i]["value"];
                $serial_no = $arr_serial_no[$i]["value"];
                $expired_date = $arr_expired_date[$i]["value"];
                $qty = $arr_qty[$i]["value"];
                $uom = $arr_uom[$i]["value"];
                $stock_type = $arr_stock_type[$i]["value"];
                $pallet_id = $arr_pallet_id[$i]["value"];
                $location_id = $arr_location_id[$i]["value"];
                $location_type = $arr_location_type[$i]["value"];
                $dest_pallet_id = $arr_dest_pallet_id[$i]["value"];
                $dest_location_id = $arr_dest_location_id[$i]["value"];
                $dest_location_type = $arr_dest_location_type[$i]["value"];
                $gr_id = $arr_gr_id[$i]["value"];

                DB::table("t_wh_temporary_movement_copy")
                    ->where("movement_id", $current_data[0]->movement_id)
                    ->where("sku", $sku_no)
                    ->where("location_to", $dest_location_id)
                    ->where("gr_id", $gr_id)
                    ->where("stock_id", $stock_type)
                    ->where(function ($query) use ($batch_no) {
                        $query->where("batch_no", $batch_no);
                    })
                    ->where(function ($query) use ($serial_no) {
                        $query->where("serial_no", $serial_no);
                    })
                    ->update([
                        "location_to" => $dest_location_id,
                        "location_type_to" => $dest_location_type,
                        "user_updated" => session("username"),
                        "datetime_updated" => $this->datetime_now,
                    ]);
            }

            DB::table("t_wh_movement")
                ->where("movement_id", $current_data[0]->movement_id)
                ->where("client_project_id", session("current_client_project_id"))
                ->update([
                    "status_id" => "MOM",
                    "user_updated" => session("username"),
                    "datetime_updated" => $this->datetime_now,
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
            "message" => "Success Movement Activity",
            "data" => [],
        ], 200);
    }
}
