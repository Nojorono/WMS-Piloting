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

class PackingController extends Controller
{
    private $menu_id = 19;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'show',
            'viewPrintDO',
        ]);
        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
            'cancelPacking',
            'confirmPacking',
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([
        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("packing.index", compact('data'));
    }

    private function getPackingListDatatables($bucket_id)
    {   
        $data = DB::query()
        ->select([
            "a.outbound_planning_no AS outbound_id",
            "c.wh_code AS warehouse_name",
            "e.client_name",
            "b.reference_no",
            "b.plan_delivery AS plan_delivery_date",
            "f.order_type",
            "g.status_name AS packing_status",
        ])
        ->from("t_wh_packing as a")
        ->leftJoin("t_wh_outbound_planning as b","b.outbound_planning_no","=","a.outbound_planning_no")
        ->leftJoin("m_warehouse as c","c.wh_id","=","b.wh_id")
        ->leftJoin("m_wh_client_project as d","d.client_project_id","=","b.client_project_id")
        ->leftJoin("m_wh_client as e","e.client_id","=","d.client_id")
        ->leftJoin("m_wh_order_type as f","f.order_id","=","b.order_id")
        ->leftJoin("m_status as g","g.status_id","=","a.status_id")
        ->where("b.client_project_id",session('current_client_project_id'))
        ->whereRaw(DB::raw("DATE(a.datetime_created)=CURRENT_DATE"))
        ->where(function ($query) use($bucket_id)
        {
            if(!empty($bucket_id)){
                $query->where("a.bucket_id",$bucket_id);
            }
        })
        ->get();
        return $data;
    }

    public function datatables(Request $request)
    {
        $bucket_id = $request->input("bucket_id");

        $data = $this->getPackingListDatatables($bucket_id);

        return DataTables::of($data)
        ->addColumn('action', function ($outbound) {
            $button = "";
            $button .= "<div class='text-center'>";
            $button .= "<a href='".route('packing.show',[ 'id'=> $outbound->outbound_id ])."' class='text-decoration-none'>
            <button class='btn btn-primary py-1 mb-0'>Show</button>
            </a>"; 
            $button .= "</div>";
            return $button;
        })
        ->make(true);
    }

    private function get_Data_Packing($outbound_planning_no)
    {

        $data = DB::query()
        ->select([
            "a.outbound_planning_no AS outbound_id",
            "b.reference_no",
            "b.receipt_no",
            "e.client_name",
            "f.order_type",
            "a.bucket_id",
            "c.supplier_name",
            "c.address1 AS supplier_address",
            "b.plan_delivery AS plan_delivery_date",
            "h.picker AS checker",
            "a.carton_id",
            "a.status_id",
            "g.status_name AS packing_status",
        ])
        ->from("t_wh_packing as a")
        ->leftJoin("t_wh_outbound_planning as b","b.outbound_planning_no","=","a.outbound_planning_no")
        ->leftJoin("m_wh_supplier as c","c.supplier_id","=","b.supplier_id")
        ->leftJoin("m_wh_client_project as d","d.client_project_id","=","b.client_project_id")
        ->leftJoin("m_wh_client as e","e.client_id","=","d.client_id")
        ->leftJoin("m_wh_order_type as f","f.order_id","=","b.order_id")
        ->leftJoin("m_status as g","g.status_id","=","a.status_id")
        ->leftJoin("t_wh_picking as h","h.outbound_planning_no","=","a.outbound_planning_no")
        ->where("b.client_project_id",session('current_client_project_id'))
        ->whereRaw(DB::raw("DATE(a.datetime_created)=CURRENT_DATE"))
        ->where(function ($query) use($outbound_planning_no)
        {
            if(!empty($outbound_planning_no)){
                $query->where("a.outbound_planning_no",$outbound_planning_no);
            }
        })
        ->orderBy("g.status_name","DESC")
        ->get();
        return $data;

    }

    private function get_Data_Packing_Details($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.outbound_planning_no",
            "b.sku AS sku_no",
            "c.part_name AS item_name",
            "b.serial_no",
            "c.imei",
            "c.part_no",
            "c.color",
            "c.size",
            "b.qty AS qty_allocated",
            "a.notes",
        ])
        ->from("t_wh_outbound_planning as a")
        ->leftJoin("t_wh_outbound_planning_detail as b","b.outbound_planning_no","=","a.outbound_planning_no")
        ->leftJoin("m_wh_item as c","c.sku","=","b.sku")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->where("a.client_project_id",session('current_client_project_id'))
        ->where("a.wh_id",session('current_warehouse_id'))
        ->get();
        return $data;

    }

    private function get_Data_Packing_Transport_Loading($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.supervisor_id",
            "a.start_loading",
            "a.finish_loading",
            "a.vehicle_no",
            "a.driver",
            "b.vehicle_type",
            "c.transporter_name AS transporter",
            "a.container_no",
            "a.seal_no",
            "a.consignee_name",
            "a.consignee_address",
            "a.consignee_city",
            "d.service_name AS service_type",
            "a.remark",
            "a.phone_no",
        ])
        ->from("t_wh_checking_transport_loading as a")
        ->leftJoin("m_wh_vehicle as b","b.vehicle_id","=","a.vehicle_id")
        ->leftJoin("m_wh_transporter as c","c.transporter_id","=","a.transporter_id")
        ->leftJoin("m_wh_service_type as d","d.service_id","=","a.service_id")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();
        return $data;
    }

    private function get_Data_Packing_Attachment($outbound_planning_no)
    {
        $data = DB::query()
        ->select([
            "a.img_url",
            "a.description",
            "a.order_id",
        ])
        ->from("t_wh_checking_attachment as a")
        ->where("a.outbound_planning_no",$outbound_planning_no)
        ->get();
        return $data;
    }

    public function show(Request $request, $id)
    {
        $current_data = $this->get_Data_Packing($id);
        if(count($current_data) == 0){
            echo "<script>
            alert('Outbound Planning doesnt exist');
            window.location.href = '".route('packing.index')."'
            </script>";
            return;
        }

        $current_data_detail = $this->get_Data_Packing_Details($current_data[0]->outbound_id);
        $current_data_transport_loading = $this->get_Data_Packing_Transport_Loading($current_data[0]->outbound_id);
        $temp_current_data_attachment = $this->get_Data_Packing_Attachment($current_data[0]->outbound_id);

        $current_data_attachment_1 = false;
        $current_data_attachment_2 = false;
        $current_data_attachment_3 = false;
        if(count($temp_current_data_attachment) > 0){
            foreach ($temp_current_data_attachment as $key_temp_current_data_attachment => $value_temp_current_data_attachment) {
                if($value_temp_current_data_attachment->order_id == 1){
                    $current_data_attachment_1 = $value_temp_current_data_attachment;
                }else if($value_temp_current_data_attachment->order_id == 2){
                    $current_data_attachment_2 = $value_temp_current_data_attachment;
                }else if($value_temp_current_data_attachment->order_id == 3){
                    $current_data_attachment_3 = $value_temp_current_data_attachment;
                }
            }
        }

        $data = [];
        $data["current_data"] = $current_data;
        $data["current_data_detail"] = $current_data_detail;
        $data["current_data_transport_loading"] = $current_data_transport_loading;
        $data["current_data_attachment_1"] = $current_data_attachment_1;
        $data["current_data_attachment_2"] = $current_data_attachment_2;
        $data["current_data_attachment_3"] = $current_data_attachment_3;

        return view("packing.show",compact('data'));
    }

    public function cancelPacking(Request $request, $id)
    {
        $current_data = $this->get_Data_Packing($id);

        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Packing Data doesnt exist, Please reload Page.",
                "data" => [],
            ],200);
        }

        $cancel_reason = $request->input("cancel_reason");

        DB::beginTransaction();
        try {

            DB::table("t_wh_packing")
            ->where("outbound_planning_no" ,$current_data[0]->outbound_id)
            ->update([
                "status_id" => "CGI",
            ]);

            DB::table("t_wh_checking")
            ->where("outbound_planning_no" ,$current_data[0]->outbound_id)
            ->update([
                "status_id" => "CAC",
            ]);

            DB::table("t_wh_picking")
            ->where("outbound_planning_no" ,$current_data[0]->outbound_id)
            ->update([
                "status_id" => "CPI",
            ]);

            DB::table("t_wh_outbound_planning")
            ->where("outbound_planning_no" ,$current_data[0]->outbound_id)
            ->update([
                "status_id" => "COU",
            ]);

            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('QueryException error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],
            ],500);

        } catch (\Exception $error) {
            \Illuminate\Support\Facades\Log::error('Exception error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],

            ],500);
            
        }

        return response()->json([
            "err" => false,
            "message" => "Success Cancel Packing.",
            "data" => [],
        ],200);
    }

    public function confirmPacking(Request $request, $id)
    {
        $current_data = $this->get_Data_Packing($id);

        if(count($current_data) == 0){
            return response()->json([
                "err" => true,
                "message" => "Packing Data doesnt exist, Please reload Page.",
                "data" => [],
            ],200);
        }

        DB::beginTransaction();
        try {

            DB::table("t_wh_packing")
            ->where("outbound_planning_no" ,$current_data[0]->outbound_id)
            ->update([
                "status_id" => "GIO",
            ]);

            DB::table("t_wh_outbound_planning")
            ->where("outbound_planning_no" ,$current_data[0]->outbound_id)
            ->update([
                "status_id" => "DOO",
            ]);

            DB::commit();

        } catch (\Illuminate\Database\QueryException $error) {
            \Illuminate\Support\Facades\Log::error('QueryException error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],
            ],500);

        } catch (\Exception $error) {
            \Illuminate\Support\Facades\Log::error('Exception error',array('context' => $error));
            DB::rollBack();
            return response()->json([
                "err" => true,
                "message" => "Something Wrong",
                "data" => [],

            ],500);
            
        }

        return response()->json([
            "err" => false,
            "message" => "Success Confirm Good Issued.",
            "data" => [],
        ],200);
    }

    public function viewPrintDO(Request $request, $id)
    {
        $data_packing = $this->get_Data_Packing($id);
        if(count($data_packing) == 0){
            echo "<script>
            alert('Data doesnt exist');
            window.location.href = '".route('packing.index')."'
            </script>";
            return;
        }

        $data = [];
        $data["current_data"] = DB::select(
            DB::raw("SELECT
            a.outbound_planning_no AS outbound_id,
            a.plan_delivery AS date_of_receipt,
            a.reference_no,
            b.vehicle_no,
            c.vehicle_type,
            e.client_id,
            e.client_name,
            b.container_no,
            b.seal_no,
            b.start_loading,
            b.finish_loading
            FROM t_wh_outbound_planning a 
            LEFT JOIN t_wh_checking_transport_loading b ON b.outbound_planning_no=a.outbound_planning_no
            LEFT JOIN m_wh_vehicle c ON c.vehicle_id=b.vehicle_id
            LEFT JOIN m_wh_client_project d ON d.client_project_id=a.client_project_id
            LEFT JOIN m_wh_client e ON e.client_id=d.client_id
            WHERE a.outbound_planning_no = ? 
            "),
            [
                $data_packing[0]->outbound_id,
            ]
        );

        $data["current_data_detail"] = DB::select(
            DB::raw("SELECT 
            a.sku,
            '' AS batch_no,
            c.part_name AS item_name,
            a.serial_no,
            c.imei,
            c.color,
            c.size,
            '' AS expired_date,
            a.qty
            FROM t_wh_outbound_planning_detail a
            LEFT JOIN t_wh_outbound_detail_sku b ON b.outbound_planning_no=a.outbound_planning_no AND b.sku=a.sku
            LEFT JOIN m_wh_item c ON c.sku=a.sku
            WHERE a.outbound_planning_no= ?
            AND b.sku IS NULL
            UNION ALL
            SELECT
            a.sku,
            a.batch_no AS batch_no,
            b.part_name AS item_name,
            c.serial_no,
            b.imei,
            b.color,
            b.size,
            a.expired_date,
            a.allocated_qty AS qty
            FROM t_wh_outbound_detail_sku a
            LEFT JOIN m_wh_item b ON b.sku=a.sku
            LEFT JOIN t_wh_outbound_planning_detail c ON c.outbound_planning_no=a.outbound_planning_no AND c.sku=a.sku
            WHERE a.outbound_planning_no= ?
             
            "),
            [
                $data_packing[0]->outbound_id,
                $data_packing[0]->outbound_id,
            ]
        );
        $pdf = Pdf::loadView('packing.pdf', compact('data'));
        return $pdf->stream($data["current_data"][0]->outbound_id.".pdf");
    }
}