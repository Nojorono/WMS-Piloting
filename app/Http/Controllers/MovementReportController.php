<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class MovementReportController extends Controller
{
    private $menu_id = 35;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'getReport',
            'viewExcel',
            'getProcessCode',
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
        return view("movement-report.index",compact("data"));
    }

    private function get_Process_Code($process_id = false)
    {
        return DB::query()
        ->select([
            "process_id", 
            "process_code",
            "process_name",
        ])
        ->from("m_process")
        ->where("is_movement","Y")
        ->where("is_active","Y")
        ->whereIn("process_id",[1,2,3,8,9,10,11])
        ->where(function ($query) use($process_id)
        {
            if($process_id !== false){
                $query->where("process_id",$process_id);
            }
        })
        ->orderBy("process_code","ASC")
        ->get()
        ;
    }
    public function getProcessCode()
    {
        $get_Process_Code = $this->get_Process_Code(false);
        
        return response()->json([
            "err" => false,
            "message" => "Success getProcessCode",
            "data" => $get_Process_Code,
        ],200);
    }

    private function getMappingColumn($process_id)
    {
        $mapping_column_1_2_3 = [
            [
                "id" => "movement_id",
                "desc" => "Movement ID",
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
                "id" => "expired_date",
                "desc" => "Expired Date",
            ],
            [
                "id" => "location_type_from",
                "desc" => "Location Type From",
            ],
            [
                "id" => "location_from",
                "desc" => "Location From",
            ],
            [
                "id" => "location_type_to",
                "desc" => "Location Type To",
            ],
            [
                "id" => "location_to",
                "desc" => "Location To",
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
                "id" => "stock_id",
                "desc" => "Stock Type",
            ],
            [
                "id" => "gr_id",
                "desc" => "GR ID",
            ],
        ];

        $mapping_column_8 = [
            [
                "id" => "movement_id",
                "desc" => "Movement ID",
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
                "id" => "expired_date",
                "desc" => "Expired Date",
            ],
            [
                "id" => "location_type_from",
                "desc" => "Location Type From",
            ],
            [
                "id" => "location_from",
                "desc" => "Location From",
            ],
            [
                "id" => "location_type_to",
                "desc" => "Location Type To",
            ],
            [
                "id" => "location_to",
                "desc" => "Location To",
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
                "id" => "stock_id",
                "desc" => "Stock Type",
            ],
            [
                "id" => "gr_id",
                "desc" => "GR ID",
            ],
        ];

        $mapping_column_9_10 = [
            [
                "id" => "movement_id",
                "desc" => "Movement ID",
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
                "id" => "serial_no",
                "desc" => "Serial No",
            ],
            [
                "id" => "batch_no",
                "desc" => "Batch No",
            ],
            [
                "id" => "expired_date",
                "desc" => "Expired Date",
            ],
            [
                "id" => "location_code",
                "desc" => "Location Code",
            ],
            [
                "id" => "adjustment_qty",
                "desc" => "Adjustment Qty",
            ],
            [
                "id" => "final_qty",
                "desc" => "Final Qty",
            ],
            [
                "id" => "uom_name",
                "desc" => "UoM Name",
            ],
            [
                "id" => "stock_id",
                "desc" => "Stock Type",
            ],
            [
                "id" => "gr_id",
                "desc" => "GR ID",
            ],
        ];

        $mapping_column_11 = [
            
            [
                "id" => "movement_id",
                "desc" => "Movement ID",
            ],
            [
                "id" => "source_sku",
                "desc" => "Source SKU",
            ],
            [
                "id" => "dest_sku",
                "desc" => "Dest SKU",
            ],
            [
                "id" => "source_item_name",
                "desc" => "Source Part Name",
            ],
            [
                "id" => "dest_item_name",
                "desc" => "Dest Part Name",
            ],
            [
                "id" => "source_serial_no",
                "desc" => "Source Serial No",
            ],
            [
                "id" => "dest_serial_no",
                "desc" => "Dest Serial No",
            ],
            [
                "id" => "source_batch_no",
                "desc" => "Source Batch No",
            ],
            [
                "id" => "dest_batch_no",
                "desc" => "Dest Batch No",
            ],
            [
                "id" => "source_exp_date",
                "desc" => "Source Expired Date",
            ],
            [
                "id" => "dest_exp_date",
                "desc" => "Dest Expired Date",
            ],
            [
                "id" => "source_location",
                "desc" => "Source Location",
            ],
            [
                "id" => "dest_location",
                "desc" => "Dest Location",
            ],
            [
                "id" => "source_qty",
                "desc" => "Source Qty",
            ],
            [
                "id" => "dest_qty",
                "desc" => "Dest Qty",
            ],
            [
                "id" => "source_uom",
                "desc" => "Source UoM",
            ],
            [
                "id" => "dest_uom",
                "desc" => "Dest UoM",
            ],
            [
                "id" => "source_stock_id",
                "desc" => "Source Stock Type",
            ],
            [
                "id" => "dest_stock_id",
                "desc" => "Dest Stock Type",
            ],
            [
                "id" => "source_gr",
                "desc" => "Source GR ID",
            ],

        ];

        switch ($process_id) {
            case '1':
                return $mapping_column_1_2_3;
                break;
            case '2':
                return $mapping_column_1_2_3;
                break;
            case '3':
                return $mapping_column_1_2_3;
                break;
            case '8':
                return $mapping_column_8;
                break;
            case '9':
                return $mapping_column_9_10;
                break;
            case '10':
                return $mapping_column_9_10;
                break;
            case '11':
                return $mapping_column_11;
                break;
            default:
                return [];
                break;
        }
    }

    private function get_Report_Based_Process_Id($process_id,$date_from,$date_to)
    {
        $query_process_id_1_2_3 = "SELECT a.movement_id, a.sku, a.part_name, a.serial_no, a.batch_no, a.expired_date, a.location_type_from,
        a.location_from, a.location_type_to, a.location_to, a.qty, a.uom_name, a.stock_id, b.gr_id
        FROM t_wh_movement_detail a
        LEFT JOIN t_wh_receive_detail b ON b.movement_id=a.movement_id
        WHERE 1=1 
        AND a.datetime_created BETWEEN ? AND ?
        AND a.process_id= ? #based on process_code yang dipilih
        ORDER BY a.movement_id ASC
        ";

        $query_process_id_8 = "SELECT movement_id, sku, part_name, serial_no, batch_no, date(expired_date) AS expired_date, location_type_from, 
        location_from, location_type_to, location_to, qty, uom_name, stock_id, gr_id
        FROM t_wh_temporary_movement_copy
        WHERE 1=1 
        AND datetime_created BETWEEN ? AND ?
        AND process_id = ?
        ORDER BY movement_id ASC
        ";

        $query_process_id_9_10 = "SELECT c.movement_id, c.sku, c.item_name, c.serial_no, c.batch_no,
        c.expired_date, c.location_code, c.adjustment_qty, c.final_qty, c.uom_name, c.stock_id, c.gr_id
        FROM t_wh_adjustment a
        LEFT JOIN m_process b ON b.process_alias=a.adjustment_code
        LEFT JOIN t_wh_adjustment_detail c ON c.adjustment_id=a.adjustment_id
        WHERE 1=1 
        AND a.datetime_created BETWEEN ? AND ?
        AND process_id = ? #based on process_code yang dipilih
        ";

        $query_process_id_11 = "SELECT movement_id, source_sku, dest_sku, source_item_name, dest_item_name, source_serial_no, dest_serial_no,
        source_batch_no, dest_batch_no, source_exp_date, dest_exp_date, source_location, dest_location, source_qty,
        dest_qty, source_uom, dest_uom, source_stock_id, dest_stock_id, source_gr
        FROM t_wh_stock_transfer_detail
        WHERE 1=1
        AND datetime_created BETWEEN ? AND ?
        ORDER BY movement_id ASC
        ";

        switch ($process_id) {
            case '1':
                return DB::select($query_process_id_1_2_3,[
                    $date_from,
                    $date_to,
                    $process_id,
                ]);
                break;
            case '2':
                return DB::select($query_process_id_1_2_3,[
                    $date_from,
                    $date_to,
                    $process_id,
                ]);
                break;
            case '3':
                return DB::select($query_process_id_1_2_3,[
                    $date_from,
                    $date_to,
                    $process_id,
                ]);
                break;
            case '8':
                return DB::select($query_process_id_8,[
                    $date_from,
                    $date_to,
                    $process_id,
                ]);
                break;
            case '9':
                return DB::select($query_process_id_9_10,[
                    $date_from,
                    $date_to,
                    $process_id,
                ]);
                break;
            case '10':
                return DB::select($query_process_id_9_10,[
                    $date_from,
                    $date_to,
                    $process_id,
                ]);
                break;
            case '11':
                return DB::select($query_process_id_11,[
                    $date_from,
                    $date_to,
                    $process_id,
                ]);
                break;
            default:
                return [];
                break;
        }
    }

    public function getReport(Request $request)
    {
        
        $date_from = $request->input("date_from");
        $date_to = $request->input("date_to");
        $process_id = $request->input("process_id");

        $data_error = [];
        
        if(empty($date_from)){
            $data_error["date_from"][] = "Date From is required";
        }

        if(empty($date_to)){
            $data_error["date_to"][] = "Date To is required";
        }

        if(empty($process_id)){
            $data_error["process_id"][] = "Process Code is required";
        }

        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }

        $getMappingColumn = $this->getMappingColumn($process_id);
        $data = $this->get_Report_Based_Process_Id($process_id,$date_from,$date_to);
        
        return response()->json([
            "err" => false,
            "message" => "Success get Movement Report",
            "data" => $data,
            "mapping_column" => $getMappingColumn,
        ],200);
    }

    public function viewExcel(Request $request)
    {
        $date_from = $request->input("date_from");
        $date_to = $request->input("date_to");
        $process_id = $request->input("process_id");

        if(empty($date_from)){
            echo "<script>
            alert('Date From is required');
            window.location.href = '".route('movement_report.index')."'
            </script>";
            return;
        }

        if(empty($date_to)){
            echo "<script>
            alert('Date To is required');
            window.location.href = '".route('movement_report.index')."'
            </script>";
            return;
        }

        if(empty($process_id)){
            echo "<script>
            alert('Process Code is required');
            window.location.href = '".route('movement_report.index')."'
            </script>";
            return;
        }

        $mapping_filter_query = $this->getMappingColumn($process_id);

        $data = $this->get_Report_Based_Process_Id($process_id,$date_from,$date_to);

        $spreadsheet = new Spreadsheet(); 
        $spreadsheet->getProperties()
        ->setCreator(config('app.name'))
        ->setLastModifiedBy(config('app.name'))
        ->setTitle("Movement Report Excel")
        ->setSubject("Movement Report Excel")
        ->setDescription("Movement Report Excel")
        ->setKeywords("office 2007 openxml php");
        $spreadsheet->getActiveSheet()->setTitle('Movement_Report');
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

        $filename = "Movement_Report_Excel_".date("YmdHis",strtotime($this->datetime_now));
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
        $process_id = $request->input("process_id");

        if(empty($date_from)){
            echo "<script>
            alert('Date From is required');
            window.location.href = '".route('movement_report.index')."'
            </script>";
            return;
        }

        if(empty($date_to)){
            echo "<script>
            alert('Date To is required');
            window.location.href = '".route('movement_report.index')."'
            </script>";
            return;
        }

        if(empty($process_id)){
            echo "<script>
            alert('Process Code is required');
            window.location.href = '".route('movement_report.index')."'
            </script>";
            return;
        }

        $current_data = $this->get_Report_Based_Process_Id($process_id,$date_from,$date_to);
        $data_process_code = $this->get_Process_Code($process_id);
        $display_process_code = "".@$data_process_code[0]->process_code." - ".@$data_process_code[0]->process_name;
        

        $filename = "Movement_Report_PDF_".date("YmdHis",strtotime($this->datetime_now));
        $data = [];
        $data["filename"] = $filename;
        $data["date_from"] = $date_from;
        $data["date_to"] = $date_to;
        $data["display_process_code"] = $display_process_code;
        $data["current_data"] = $current_data;
        // dd($data);
        // dd("masih bermaslah karena mappingan nya beda2");
        switch ($process_id) {
            case '1':
                $pdf = Pdf::loadView('movement-report.pdf_1_2_3', compact('data'))->setPaper('a4', 'potrait');;
                break;
            case '2':
                $pdf = Pdf::loadView('movement-report.pdf_1_2_3', compact('data'))->setPaper('a4', 'potrait');;
                break;
            case '3':
                $pdf = Pdf::loadView('movement-report.pdf_1_2_3', compact('data'))->setPaper('a4', 'potrait');;
                break;
            case '8':
                $pdf = Pdf::loadView('movement-report.pdf_8', compact('data'))->setPaper('a4', 'potrait');;
                break;
            case '9':
                $pdf = Pdf::loadView('movement-report.pdf_9_10', compact('data'))->setPaper('a4', 'potrait');;
                break;
            case '10':
                $pdf = Pdf::loadView('movement-report.pdf_9_10', compact('data'))->setPaper('a4', 'potrait');;
                break;
            case '11':
                $pdf = Pdf::loadView('movement-report.pdf_11', compact('data'))->setPaper('a4', 'potrait');;
                break;
            default:
                echo "<script>
                alert('Process Code is not defined');
                window.location.href = '".route('movement_report.index')."'
                </script>";
                return;
                break;
        }
        return $pdf->stream($filename.".pdf");
    }
}