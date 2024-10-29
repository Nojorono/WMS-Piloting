<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class COGSComputationController extends Controller
{
    private $menu_id = 45;
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
        return view("cogs-computation.index",compact("data"));
    }

    private function get_Report_Summary_Inbound($date_from,$date_to)
    {
        return DB::select("SELECT 
        a.inbound_planning_no
        , b.sku
        , b.item_name
        , b.batch_no
        , b.serial_no
        , e.qty
        , e.location_to AS location_id
        , date(a.plan_delivery) AS etd
        FROM t_wh_inbound_planning a
        LEFT JOIN t_wh_inbound_planning_detail b ON a.inbound_planning_no=b.inbound_planning_no
        LEFT JOIN t_wh_receive c ON a.inbound_planning_no=c.inbound_planning_no
        LEFT JOIN t_wh_receive_detail d ON d.gr_id=c.gr_id
        LEFT JOIN t_wh_movement_detail e ON e.movement_id=d.movement_id AND e.sku=b.SKU
        WHERE a.client_project_id= ? #based on login
        AND a.plan_delivery BETWEEN ? AND ?
        AND e.qty IS NOT NULL
        ORDER BY b.inbound_planning_no, b.sku
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

        $data = $this->get_Report_Summary_Inbound($date_from,$date_to);

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
                "id" => "inbound_planning_no",
                "desc" => "Inbound Planning No",
            ],
            [
                "id" => "sku",
                "desc" => "SKU",
            ],
            [
                "id" => "item_name",
                "desc" => "Part Name",
            ],
            [
                "id" => "batch_no",
                "desc" => "Batch No",
            ],
            [
                "id" => "serial_no",
                "desc" => "Serial No",
            ],
            [
                "id" => "qty",
                "desc" => "Qty",
            ],
            [
                "id" => "location_id",
                "desc" => "Location ID",
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
            window.location.href = '".route('report_summary_inbound.index')."'
            </script>";
            return;
        }

        if(empty($date_to)){
            echo "<script>
            alert('Date To is required');
            window.location.href = '".route('report_summary_inbound.index')."'
            </script>";
            return;
        }

        $data = $this->get_Report_Summary_Inbound($date_from,$date_to);
        $spreadsheet = new Spreadsheet(); 
        $spreadsheet->getProperties()
        ->setCreator(config('app.name'))
        ->setLastModifiedBy(config('app.name'))
        ->setTitle("Report Summary Inbound Excel")
        ->setSubject("Report Summary Inbound Excel")
        ->setDescription("Report Summary Inbound Excel")
        ->setKeywords("office 2007 openxml php");
        $spreadsheet->getActiveSheet()->setTitle('Report_Summary_Inbound');
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

        $filename = "Report_Summary_Inbound_Excel_".date("YmdHis",strtotime($this->datetime_now));
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
            window.location.href = '".route('report_summary_inbound.index')."'
            </script>";
            return;
        }

        if(empty($date_to)){
            echo "<script>
            alert('Date To is required');
            window.location.href = '".route('report_summary_inbound.index')."'
            </script>";
            return;
        }

        $current_data = $this->get_Report_Summary_Inbound($date_from,$date_to);
        $filename = "Report_Summary_Inbound_PDF_".date("YmdHis",strtotime($this->datetime_now));
        $data = [];
        $data["filename"] = $filename;
        $data["date_from"] = $date_from;
        $data["date_to"] = $date_to;
        $data["current_data"] = $current_data;
        // dd($data);
        $pdf = Pdf::loadView('cogs-computation.pdf', compact('data'))->setPaper('a4', 'potrait');;
        return $pdf->stream($filename.".pdf");
    }
}