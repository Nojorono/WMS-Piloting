<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class InventoryListController extends Controller
{
    private $menu_id = 15;
    private $datetime_now;
    
    public function __construct()
    {
        $this->middleware('check_user_access_read:'.$this->menu_id)->only([
            'index',
            'datatables',
            'datatablesLocation',
            'datatablesPallet',
            'datatablesSerialNo',
            'datatablesPartNo',
            'datatablesColor',
            'datatablesSize',
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
        return view("inventory-list.index",compact("data"));
    }

    private function getInventoryListDatatables($warehouse_id,$batch_no,$expired_date,$client_id,$serial_no,$stock_type,$location_id,$imei_no,$gr_id,$pallet_id,$part_no,$gr_date_from,$gr_date_to,$sku_no,$color,$last_movement_location_id,$item_name,$size)
    {
        $data = DB::query()
        ->select([
            "c.wh_code",
            "b.client_project_name",
            "a.location_id",
            "a.pallet_id",
            "a.sku",
            "a.part_name",
            "a.batch_no",
            "a.serial_no",
            "a.imei",
            "a.part_no",
            "a.color",
            "a.size",
            "a.expired_date",
            "d.classification_name",
            "a.on_hand_qty",
            "a.allocated_qty",
            "a.picked_qty",
            "a.available_qty",
            "a.uom_name",
            "a.stock_id",
            "a.gr_id",
            DB::raw("CAST(a.gr_datetime AS DATE) AS gr_date"),
            DB::raw("TIMESTAMPDIFF(DAY, a.gr_datetime, NOW()) AS aging"),
            "a.last_movement_id",
            "a.user_created",
            "a.datetime_created",
        ])
        ->from("t_wh_location_inventory as a")
        ->leftJoin("m_wh_client_project as b","a.client_project_id","=","b.client_project_id")
        ->leftJoin("m_warehouse as c","b.wh_id","=","c.wh_id")
        ->leftJoin("m_item_classification as d","a.clasification_id","=","d.item_classification_id")
        ->where("d.process_id","12")
        ->where(function ($query) use($warehouse_id)
        {
            if(!empty($warehouse_id)){
                $query->where("c.wh_id",$warehouse_id);
            }
        })
        ->where(function ($query) use($client_id)
        {
            if(!empty($client_id)){
                $query->where("b.client_project_id",$client_id);
            }
        })
        ->where(function ($query) use($location_id)
        {
            if(!empty($location_id)){
                $query->where("a.location_id",$location_id);
            }
        })
        ->where(function ($query) use($pallet_id)
        {
            if(!empty($pallet_id)){
                $query->where("a.pallet_id",$pallet_id);
            }
        })
        ->where(function ($query) use($sku_no)
        {
            if(!empty($sku_no)){
                $query->where("a.sku",$sku_no);
            }
        })
        ->where(function ($query) use($batch_no)
        {
            if(!empty($batch_no)){
                $query->where("a.batch_no",$batch_no);
            }
        })
        ->where(function ($query) use($serial_no)
        {
            if(!empty($serial_no)){
                $query->where("a.serial_no",$serial_no);
            }
        })
        ->where(function ($query) use($imei_no)
        {
            if(!empty($imei_no)){
                $query->where("a.imei",$imei_no);
            }
        })
        ->where(function ($query) use($part_no)
        {
            if(!empty($part_no)){
                $query->where("a.part_no",$part_no);
            }
        })
        ->where(function ($query) use($color)
        {
            if(!empty($color)){
                $query->where("a.color",$color);
            }
        })
        ->where(function ($query) use($size)
        {
            if(!empty($size)){
                $query->where("a.size",$size);
            }
        })
        ->where(function ($query) use($stock_type)
        {
            if(!empty($stock_type)){
                $query->where("a.stock_id",$stock_type);
            }
        })
        ->where(function ($query) use($gr_id)
        {
            if(!empty($gr_id)){
                $query->where("a.gr_id",$gr_id);
            }
        })
        ->where(function ($query) use($gr_date_from,$gr_date_to)
        {
            if(!empty($gr_date_from) && !empty($gr_date_to)){
                $query->whereBetween(DB::raw("CAST(a.gr_datetime AS DATE)"),[$gr_date_from,$gr_date_to]);
            }
        })
        ->where(function ($query) use($last_movement_location_id)
        {
            if(!empty($last_movement_location_id)){
                $query->where("a.last_movement_id",$last_movement_location_id);
            }
        })
        ->orderBy("a.location_id","ASC")
        ->get();
        return $data;
    }

    public function datatables(Request $request)
    {
        $warehouse_id = $request->input("warehouse_id");
        $batch_no = $request->input("batch_no");
        $expired_date = $request->input("expired_date");
        $client_id = $request->input("client_id");
        $serial_no = $request->input("serial_no");
        $stock_type = $request->input("stock_type");
        $location_id = $request->input("location_id");
        $imei_no = $request->input("imei_no");
        $gr_id = $request->input("gr_id");
        $pallet_id = $request->input("pallet_id");
        $part_no = $request->input("part_no");
        $gr_date_from = $request->input("gr_date_from");
        $gr_date_to = $request->input("gr_date_to");
        $sku_no = $request->input("sku_no");
        $color = $request->input("color");
        $last_movement_location_id = $request->input("last_movement_location_id");
        $item_name = $request->input("item_name");
        $size = $request->input("size");

        $data = $this->getInventoryListDatatables($warehouse_id,$batch_no,$expired_date,$client_id,$serial_no,$stock_type,$location_id,$imei_no,$gr_id,$pallet_id,$part_no,$gr_date_from,$gr_date_to,$sku_no,$color,$last_movement_location_id,$item_name,$size);
        
        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesLocation(Request $request)
    {
        // SELECT location_id
        // FROM t_wh_location_inventory
        // WHERE client_project_id='1' #based on login
        // GROUP BY location_id

        $data = DB::query()
        ->select("location_id")
        ->from("t_wh_location_inventory")
        ->where("client_project_id",session("current_client_project_id"))
        ->groupBy("location_id")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesPallet(Request $request)
    {
        // SELECT pallet_id
        // FROM t_wh_location_inventory
        // WHERE client_project_id='1' #based on login
        // AND pallet_id IS NOT NULL
        // AND pallet_id <>''
        // GROUP BY pallet_id

        $data = DB::query()
        ->select("pallet_id")
        ->from("t_wh_location_inventory")
        ->where("client_project_id",session("current_client_project_id"))
        ->whereNotNull("pallet_id")
        ->where("pallet_id","<>","")
        ->groupBy("pallet_id")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesSerialNo(Request $request)
    {
        // SELECT serial_no
        // FROM t_wh_location_inventory
        // WHERE client_project_id='1' #based on login
        // AND serial_no IS NOT NULL
        // AND serial_no <>''
        // GROUP BY serial_no


        $data = DB::query()
        ->select("serial_no")
        ->from("t_wh_location_inventory")
        ->where("client_project_id",session("current_client_project_id"))
        ->whereNotNull("serial_no")
        ->where("serial_no","<>","")
        ->groupBy("serial_no")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesPartNo(Request $request)
    {
        // SELECT part_no
        // FROM t_wh_location_inventory
        // WHERE client_project_id='1' #based on login
        // AND part_no IS NOT NULL
        // AND part_no <>''
        // GROUP BY part_no


        $data = DB::query()
        ->select("part_no")
        ->from("t_wh_location_inventory")
        ->where("client_project_id",session("current_client_project_id"))
        ->whereNotNull("part_no")
        ->where("part_no","<>","")
        ->groupBy("part_no")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesColor(Request $request)
    {
        // SELECT color
        // FROM t_wh_location_inventory
        // WHERE client_project_id='1' #based on login
        // AND color IS NOT NULL
        // AND color <>''
        // GROUP BY color


        $data = DB::query()
        ->select("color")
        ->from("t_wh_location_inventory")
        ->where("client_project_id",session("current_client_project_id"))
        ->whereNotNull("color")
        ->where("color","<>","")
        ->groupBy("color")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function datatablesSize(Request $request)
    {
        // SELECT size
        // FROM t_wh_location_inventory
        // WHERE client_project_id='1' #based on login
        // AND size IS NOT NULL
        // AND size <>''
        // GROUP BY size


        $data = DB::query()
        ->select("size")
        ->from("t_wh_location_inventory")
        ->where("client_project_id",session("current_client_project_id"))
        ->whereNotNull("size")
        ->where("size","<>","")
        ->groupBy("size")
        ->get();
        
        return DataTables::of($data)
        ->make(true);
    }

    public function viewExcel(Request $request)
    {
        $warehouse_id = $request->input("warehouse_id");
        $batch_no = $request->input("batch_no");
        $expired_date = $request->input("expired_date");
        $client_id = $request->input("client_id");
        $serial_no = $request->input("serial_no");
        $stock_type = $request->input("stock_type");
        $location_id = $request->input("location_id");
        $imei_no = $request->input("imei_no");
        $gr_id = $request->input("gr_id");
        $pallet_id = $request->input("pallet_id");
        $part_no = $request->input("part_no");
        $gr_date_from = $request->input("gr_date_from");
        $gr_date_to = $request->input("gr_date_to");
        $sku_no = $request->input("sku_no");
        $color = $request->input("color");
        $last_movement_location_id = $request->input("last_movement_location_id");
        $item_name = $request->input("item_name");
        $size = $request->input("size");
        $selected_column_query = json_decode($request->input("selected_column_query"),true);
        $mapping_filter_query = json_decode($request->input("mapping_filter_query"),true);

        $data = $this->getInventoryListDatatables($warehouse_id,$batch_no,$expired_date,$client_id,$serial_no,$stock_type,$location_id,$imei_no,$gr_id,$pallet_id,$part_no,$gr_date_from,$gr_date_to,$sku_no,$color,$last_movement_location_id,$item_name,$size);

        $spreadsheet = new Spreadsheet(); 
        $spreadsheet->getProperties()
        ->setCreator(config('app.name'))
        ->setLastModifiedBy(config('app.name'))
        ->setTitle("Inventory List Excel")
        ->setSubject("Inventory List Excel")
        ->setDescription("Inventory List Excel")
        ->setKeywords("office 2007 openxml php");
        $spreadsheet->getActiveSheet()->setTitle('Inventory_List');
        $row = 1;
        $row_alphabet = "A";


        if(count($mapping_filter_query) > 0){
            foreach ($mapping_filter_query as $key_mapping_filter_query => $value_mapping_filter_query) {
                $id = $value_mapping_filter_query["id"];
                $desc = $value_mapping_filter_query["desc"];
                if(in_array($id,$selected_column_query)){
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, $desc);
                    $row_alphabet++;
                }
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
                        if(in_array($id,$selected_column_query)){
                            $spreadsheet->setActiveSheetIndex(0)->setCellValue($row_alphabet.$row, $value_data->$id);
                            $row_alphabet++;
                        }
                    }
                }
                $row++;
            }

        }

        $filename = "Inventory_List_".date("YmdHis",strtotime($this->datetime_now));
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $objWriter->save('php://output');
        exit();
    }

}