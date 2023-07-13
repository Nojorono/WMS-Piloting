<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class TestController extends Controller
{
    
    public function __construct()
    {
        //
    }

    public function index()
    {
        $data = [];
        return view("test.index",compact("data"));
    }

    public function view_simple_datatables()
    {
        $data = [];
        return view("test.simple_datatables",compact("data"));
    }

    public function view_datatables()
    {
        $data = [];
        return view("test.datatables",compact("data"));
    }

    public function get_data_datatables(Request $request)
    {
        $query = DB::query()->select([
            'stock_count_id',
            'count_no',
            'location_id',
            'sku',
            'stock_id',
            'gr_id',
        ])
        ->from('t_wh_stock_count_detail')
        ;
        return DataTables::queryBuilder($query)->make(true);
    }

    public function view_form()
    {
        $data = [];
        return view("test.test_form",compact("data"));
    }

    public function save_form(Request $request)
    {
        $data_error = [];

        $plan_delivery_date = $request->input("plan_delivery_date");
        $warehouse_id = $request->input("warehouse_id");
        $order_id = $request->input("order_id");
        $order_type = $request->input("order_type");
        $client_id = $request->input("client_id");
        $receipt_no = $request->input("receipt_no");
        $supplier_address = $request->input("supplier_address");
        $reference_no = $request->input("reference_no");
        $supplier_id = $request->input("supplier_id");
        $supplier_name = $request->input("supplier_name");
        $remarks = $request->input("remarks");

        if(empty($plan_delivery_date)){
            $data_error["plan_delivery_date"][] = "plan_delivery_date is Required";
        }

        if(empty($warehouse_id)){
            $data_error["warehouse_id"][] = "warehouse_id is Required";
        }

        if(empty($order_id)){
            $data_error["order_id"][] = "order_id is Required";
        }

        if(empty($order_type)){
            $data_error["order_type"][] = "order_type is Required";
        }

        if(empty($client_id)){
            $data_error["client_id"][] = "client_id is Required";
        }

        if(empty($receipt_no)){
            $data_error["receipt_no"][] = "receipt_no is Required";
        }

        if(empty($supplier_address)){
            $data_error["supplier_address"][] = "supplier_address is Required";
        }

        if(empty($reference_no)){
            $data_error["reference_no"][] = "reference_no is Required";
        }

        if(empty($supplier_id)){
            $data_error["supplier_id"][] = "supplier_id is Required";
        }

        if(empty($supplier_name)){
            $data_error["supplier_name"][] = "supplier_name is Required";
        }

        if(empty($remarks)){
            $data_error["remarks"][] = "remarks is Required";
        }

        if(count($data_error) > 0){
            return response()->json([
                "err" => true,
                "message" => "Validation Failed",
                "data" => $data_error,
            ],200);
        }

        return response()->json([
            "err" => true,
            "message" => "Bablas",
            "data" => [],
        ],200);
    }

    public function view_sweetalert2()
    {
        $data = [];
        return view("test.sweetalert2",compact("data"));
    }

    public function view_sweetalert2_backend()
    {
        echo "
        <link id='pagestyle' href='". asset("/css/soft-ui-dashboard.css") ."' rel='stylesheet' />
        <script src='".asset('/js/plugins/sweetalert.min.js')."' defer></script>
        <script type='text/javascript'>
        Swal
        .fire({
            title: 'Are you sure?',
            text: 'You won\\'t be able to revert this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        });
        //window.location.href = '".route('test.view_sweetalert2')."';
        </script>";
    }

}
