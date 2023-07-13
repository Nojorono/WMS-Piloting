<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class ReportSummaryOutboundController extends Controller
{
    private $menu_id = 34;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'getReport',
            'viewExcel',
        ]);
        $this->middleware('check_user_access_create:'.$this->menu_id)->only([
        ]);
        $this->middleware('check_user_access_update:'.$this->menu_id)->only([
        ]);
        $this->middleware('check_user_access_delete:'.$this->menu_id)->only([

        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $data = [];
        return view("report-summary-outbound.index",compact("data"));
    }

    private function get_Report_Summary_Outbound($date_from,$date_to)
    {
        return DB::select("SELECT a.outbound_planning_no,
        b.sku,
        c.part_name,
        b.serial_no,
        d.batch_no,
        f.stock_id AS stock_type,
        e.inbound_planning_no,
        f.pick_qty AS qty,
        b.uom_name,
        f.location_id,
        g.consignee_name,
        g.consignee_address,
        g.consignee_city,
        g.phone_no,
        g.awb,
        a.plan_delivery AS etd
        FROM t_wh_outbound_planning a
        LEFT JOIN t_wh_outbound_planning_detail b ON a.outbound_planning_no=b.outbound_planning_no
        LEFT JOIN m_wh_item c ON c.sku=b.sku
        LEFT JOIN t_wh_outbound_detail_sku d ON d.outbound_planning_no=b.outbound_planning_no
        LEFT JOIN t_wh_receive e ON e.gr_id=d.gr_id
        LEFT JOIN t_wh_picking_detail f ON f.outbound_planning_no=a.outbound_planning_no
        LEFT JOIN t_wh_checking_transport_loading g ON g.outbound_planning_no=a.outbound_planning_no
        WHERE a.client_project_id = ? #based on login
        AND a.plan_delivery BETWEEN ? AND ?
        ORDER BY a.outbound_planning_no, b.sku, f.location_id
        ",[
            session("current_client_project_id"),
            $date_from,
            $date_to
        ]);
    }

    public function getReport(Request $request)
    {
        
        $date_from = $request->input("date_from");
        $date_to = $request->input("date_to");

        $data_error = [];
        
        if(empty($date_from)){
            $data_error["date_from"][] = "Date From is required";
        }

        if(empty($date_to)){
            $data_error["date_to"][] = "Date To is required";
        }

        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }

        $data = $this->get_Report_Summary_Outbound($date_from,$date_to);

        if(count($data) == 0){
            return response()->json([
                "err" => true,
                "message" => "No Data",
                "data" => [],
            ],200);
        }
        
        return response()->json([
            "err" => false,
            "message" => "Success get Report Summary Inbound",
            "data" => $data,
        ],200);
    }

    public function viewExcel(Request $request)
    {
        $mapping_filter_query = [
            
            [
                "id" => "outbound_planning_no",
                "desc" => "Outbound Planning No",
            ],
            [
                "id" => "sku",
                "desc" => "SKU",
            ],
            [
                "id" => "part_name",
                "desc" => "Part Name",
            ],
            [
                "id" => "serial_no",
                "desc" => "Serial No",
            ],
            [
                "id" => "batch_no",
                "desc" => "Batch No",
            ],
            [
                "id" => "stock_type",
                "desc" => "Stock Type",
            ],
            [
                "id" => "inbound_planning_no",
                "desc" => "Inbound Planning No",
            ],
            [
                "id" => "qty",
                "desc" => "Qty",
            ],
            [
                "id" => "uom_name",
                "desc" => "UoM Name",
            ],
            [
                "id" => "location_id",
                "desc" => "Location ID",
            ],
            [
                "id" => "consignee_name",
                "desc" => "Consignee Name",
            ],
            [
                "id" => "consignee_address",
                "desc" => "Consignee Address",
            ],
            [
                "id" => "consignee_city",
                "desc" => "Consignee City",
            ],
            [
                "id" => "phone_no",
                "desc" => "Phone No",
            ],
            [
                "id" => "awb",
                "desc" => "AWB",
            ],
            [
                "id" => "etd",
                "desc" => "ETD",
            ],
        ];
        $date_from = $request->input("date_from");
        $date_to = $request->input("date_to");

        if(empty($date_from)){
            echo "<script>
            alert('Date From is required');
            window.location.href = '".route('report_summary_outbound.index')."'
            </script>";
            return;
        }

        if(empty($date_to)){
            echo "<script>
            alert('Date To is required');
            window.location.href = '".route('report_summary_outbound.index')."'
            </script>";
            return;
        }

        $data = $this->get_Report_Summary_Outbound($date_from,$date_to);
        $spreadsheet = new Spreadsheet(); 
        $spreadsheet->getProperties()
        ->setCreator(config('app.name'))
        ->setLastModifiedBy(config('app.name'))
        ->setTitle("Report Summary Outbound Excel")
        ->setSubject("Report Summary Outbound Excel")
        ->setDescription("Report Summary Outbound Excel")
        ->setKeywords("office 2007 openxml php");
        $spreadsheet->getActiveSheet()->setTitle('Report_Summary_Outbound');
        $row = 1;
        $row_alphabet = "A";


        if(count($mapping_filter_query) > 0){
            foreach ($mapping_filter_query as $key_mapping_filter_query => $value_mapping_filter_query) {
                $id = $value_mapping_filter_query["id"];
                $desc = $value_mapping_filter_query["desc"];
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, $desc);
                $row_alphabet++;
            }
        }
        $row++;

        if(count($data) > 0){
            foreach ($data as $key_data => $value_data) {
                $row_alphabet = "A";
                if(count($mapping_filter_query) > 0){
                    foreach ($mapping_filter_query as $key_mapping_filter_query => $value_mapping_filter_query) {
                        $id = $value_mapping_filter_query["id"];
                        $desc = $value_mapping_filter_query["desc"];
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, $value_data->$id);
                        $row_alphabet++;
                        
                    }
                }
                $row++;
            }

        }

        $filename = "Report_Summary_Outbound_Excel_".date("YmdHis",strtotime($this->datetime_now));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $objWriter->save('php://output');
        exit();
    }

    public function printPDF(Request $request)
    {
        $date_from = $request->input("date_from");
        $date_to = $request->input("date_to");

        if(empty($date_from)){
            echo "<script>
            alert('Date From is required');
            window.location.href = '".route('report_summary_outbound.index')."'
            </script>";
            return;
        }

        if(empty($date_to)){
            echo "<script>
            alert('Date To is required');
            window.location.href = '".route('report_summary_outbound.index')."'
            </script>";
            return;
        }

        $current_data = $this->get_Report_Summary_Outbound($date_from,$date_to);
        $filename = "Report_Summary_Outbound_PDF_".date("YmdHis",strtotime($this->datetime_now));
        $data = [];
        $data["filename"] = $filename;
        $data["date_from"] = $date_from;
        $data["date_to"] = $date_to;
        $data["current_data"] = $current_data;
        // dd($data);
        $pdf = Pdf::loadView('report-summary-outbound.pdf', compact('data'))->setPaper('a4', 'potrait');;
        return $pdf->stream($filename.".pdf");
    }
}