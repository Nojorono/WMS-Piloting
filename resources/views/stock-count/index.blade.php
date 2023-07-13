@extends('layout.app')

@section("title")
Stock Count
@endsection

@section("custom-style")
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 d-flex mb-2">
                        <h5 class="me-auto">Stock Count - List</h5>
                        <button type="button" class="btn btn-primary ms-auto me-2 text-xs py-1" id="btn_add" name="btn_add">Add</button>
                        <button type="button" class="btn btn-primary me-2 text-xs py-1" id="btn_export_excel" name="btn_export_excel">Export</button>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="stock_count_id" class="form-label text-xs">Stock Count ID</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="stock_count_id" name="stock_count_id" value="" readonly>
                                                <div id="validation_stock_count_id" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_stock_count_id" id="btn_search_stock_count_id"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="count_date_from" class="form-label text-xs">Count Date From</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="count_date_from" name="count_date_from" value="">
                                                <div id="validation_count_date_from" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="count_date_to" class="form-label text-xs">Count Date To</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="count_date_to" name="count_date_to" value="">
                                                <div id="validation_count_date_to" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_name" class="form-label text-xs">Client Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="hidden" id="client_id" name="client_id" value="{{ session("current_client_id") }}">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ session("current_client_name") }}" readonly>
                                                <div id="validation_client_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_name" class="form-label text-xs">Warehouse Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="hidden" id="warehouse_id" name="warehouse_id" value="{{ session("current_warehouse_id") }}">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="{{ session("current_warehouse_name") }}" readonly>
                                                <div id="validation_warehouse_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="count_status" class="form-label text-xs">Count Status</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="count_status" name="count_status" value="" readonly>
                                                <div id="validation_count_status" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_count_status" id="btn_search_count_status"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="remark" class="form-label text-xs">Remark</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="remark" name="remark" value="" readonly>
                                                <div id="validation_remark" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_remark" id="btn_search_remark"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mb-2 d-flex">
                                        <button type="button" class="btn btn-primary  text-xs py-1 mb-0" id="btn_search" name="btn_search">Search</button>
                                        <button type="button" class="btn btn-danger ms-2 text-xs py-1 mb-0" id="btn_reset" name="btn_reset">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <div class="table-responsive" id="container-datatable">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-FilterTable" tabindex="-1" aria-labelledby="modal-FilterTableLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-FilterTableLabel">Filter Table</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-FilterTable"></div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-StockCountID" tabindex="-1" aria-labelledby="modal-StockCountIDLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-StockCountIDLabel">Stock Count ID - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-StockCountID" >
                        <thead>
                            <tr>
                                <th class="text-xs">Stock Count ID</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-CountStatus" tabindex="-1" aria-labelledby="modal-CountStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-CountStatusLabel">Count Status - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-CountStatus" >
                        <thead>
                            <tr>
                                <th class="text-xs">Status ID</th>
                                <th class="text-xs">Status Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Remark" tabindex="-1" aria-labelledby="modal-RemarkLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-RemarkLabel">Remark - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Remark" >
                        <thead>
                            <tr>
                                <th class="text-xs">Type Code</th>
                                <th class="text-xs">Type Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script type="text/javascript">

let selected_column = [];

function changeFilter() {
    let temp_checked = [];
    $("[name^=checkboxFilter]:checked").each(function () {
        temp_checked.push($(this).val())
    });
    selected_column = [];
    selected_column = temp_checked;

}
$(document).ready(function () {
    $("#dropdown_toggle_inventory").prop('aria-expanded',true);
    $("#dropdown_toggle_inventory").addClass('active');
    $("#dropdown_inventory").addClass('show');
    $("#li_stock_count").addClass("active");
    $("#a_stock_count").addClass("active");

    const mapping_filter = [
        {
            id: "stock_count_id",
            desc: "Stock Count ID",
        },
        {
            id: "client_project_name",
            desc: "Client ID",
        },
        {
            id: "wh_code",
            desc: "Warehouse ID",
        },
        {
            id: "count_date",
            desc: "Count Date",
        },
        {
            id: "count_no",
            desc: "Count No",
        },
        {
            id: "status_name",
            desc: "Count Status",
        },
    ];
    
    mapping_filter.forEach((element,index) => {
        selected_column.push(element.id);
    });

    // special function start
    const searchDatatables = () => {
        const stock_count_id = $("#stock_count_id").val();
        const count_date_from = $("#count_date_from").val();
        const count_date_to = $("#count_date_to").val();
        const client_id = $("#client_id").val();
        const warehouse_id = $("#warehouse_id").val();
        const count_status = $("#count_status").val();
        const remark = $("#remark").val();

        $("#container-datatable").html("");
        let temp_html_datatable = "";
        temp_html_datatable += `<table class="table " id="list-datatable" style="width: 100%;"><thead><tr>`;
        let column_data_server = [];

        mapping_filter.forEach((element,index) => {
            const selected = selected_column.includes(element.id);
            if(selected){
                column_data_server.push({data: element.id, className: 'text-xs',});
                temp_html_datatable += `<th>${element.desc}</th>`;
            }
        });
        
        column_data_server.push({data: "action", className: 'text-xs',});
        temp_html_datatable += `<th>Action</th>`;

        temp_html_datatable += `</tr></thead><tbody></tbody></table>`;
        $("#container-datatable").html(temp_html_datatable);

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('stock_count.datatables') }}",
                data: {
                    stock_count_id: stock_count_id,
                    count_date_from: count_date_from,
                    count_date_to: count_date_to,
                    client_id: client_id,
                    warehouse_id: warehouse_id,
                    count_status: count_status,
                    remark: remark,
                },
            },
            columns: column_data_server,
        });
    }
    // special function end
    $("#btn_reset").on("click",function () {
        $("#stock_count_id").val("");
        $("#count_date_from").val("");
        $("#count_date_to").val("");
        $("#count_status").val("");
        $("#remark").val("");
    });

    $("#btn_search").on("click",function () {
        searchDatatables();
    });

    $("#btn_filter").on("click",function () {
        $("#container-datatable").html("");
        $("#modal-FilterTable").modal('show');
        $("#modal-body-FilterTable").html("");
        let html_filter = `<div class="row">`;
            
            mapping_filter.forEach((element,index) => {
            const selected = selected_column.includes(element.id);
            const selected_html = (selected) ? 'checked': '';
            html_filter += `
            <div class="col-sm-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="${element.id}" id="checkboxFilter_${index}" name="checkboxFilter[]" onchange="changeFilter()" ${selected_html}>
                    <label class="form-check-label" for="checkboxFilter_${index}">
                        ${element.desc}
                    </label>
                </div>
            </div>`;    
        });
        
        html_filter += `
        </div>`;
        $("#modal-body-FilterTable").html(html_filter);
    });

    $("#btn_search_stock_count_id").on("click",function () {
        $("#modal-StockCountID").modal('show');
        $("#list-datatable-modal-StockCountID").DataTable().destroy();
        $("#list-datatable-modal-StockCountID").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_count.datatablesStockCountID') }}",
            columns:[
                {data: 'stock_count_id', searchable: true, className: 'text-xs',},
            ],
        });
    });
    
    $("#list-datatable-modal-StockCountID > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const stock_count_id = $($(dom_tr).children("td")[0]).text(); 
        
        $("#stock_count_id").val(stock_count_id);
        $("#modal-StockCountID").modal('hide');
    });

    $("#btn_search_count_status").on("click",function () {
        $("#modal-CountStatus").modal('show');
        $("#list-datatable-modal-CountStatus").DataTable().destroy();
        $("#list-datatable-modal-CountStatus").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_count.datatablesCountStatus') }}",
            columns:[
                {data: 'status_id', searchable: true, className: 'text-xs',},
                {data: 'status_name', searchable: true, className: 'text-xs',},
            ],
        });
    });
    
    $("#list-datatable-modal-CountStatus > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const status_id = $($(dom_tr).children("td")[0]).text(); 
        
        $("#count_status").val(status_id);
        $("#modal-CountStatus").modal('hide');
    });
    
    $("#btn_search_remark").on("click",function () {
        $("#modal-Remark").modal('show');
        $("#list-datatable-modal-Remark").DataTable().destroy();
        $("#list-datatable-modal-Remark").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_count.datatablesRemark') }}",
            columns:[
                {data: 'type_code', searchable: true, className: 'text-xs',},
                {data: 'type_name', searchable: true, className: 'text-xs',},
            ],
        });
    });
    
    $("#list-datatable-modal-Remark > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const type_code = $($(dom_tr).children("td")[0]).text(); 
        
        $("#remark").val(type_code);
        $("#modal-Remark").modal('hide');
    });

    $("#btn_export_excel").on("click",function () {
        // const stock_count_id = $("#stock_count_id").val();
        // const count_date_from = $("#count_date_from").val();
        // const count_date_to = $("#count_date_to").val();
        // const client_id = $("#client_id").val();
        // const warehouse_id = $("#warehouse_id").val();
        // const count_status = $("#count_status").val();
        // const remark = $("#remark").val();
        // const selected_column_query = JSON.stringify(selected_column);
        // const mapping_filter_query = JSON.stringify(mapping_filter);

        const url = "{{ route('stock_count.viewExcel') }}";
        // const full_url = `${url}?stock_count_id=${stock_count_id}&count_date_from=${count_date_from}&count_date_to=${count_date_to}&client_id=${client_id}&warehouse_id=${warehouse_id}&count_status=${count_status}&remark=${remark}&selected_column_query=${selected_column_query}&mapping_filter_query=${mapping_filter_query}`; 
        const full_url = `${url}`; 

        window.open(full_url,"_blank");
    });

    $("#btn_add").on("click",function () {
        const url = "{{ route('stock_count.create') }}";
        window.location.href =url;
    });
});
</script>
@endsection
