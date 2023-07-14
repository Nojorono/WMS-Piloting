@extends('layout.app')

@section("title")
Stock Transfer
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
                        <h5 class="me-auto">Stock Transfer - List</h5>
                        <a href="{{ route('stock_transfer.create') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1">Add</button>
                        </a>
                        <button type="button" class="btn btn-primary text-xs py-1 me-2" id="btn_export_excel" name="btn_export_excel">Export</button>
                        <button type="button" class="btn btn-primary text-xs py-1" id="btn_filter" name="btn_filter">Filter</button>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="stock_transfer_id" class="form-label text-xs">Stock Transfer ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="stock_transfer_id" name="stock_transfer_id" value="">
                                                <div id="validation_stock_transfer_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_name" class="form-label text-xs">Warehouse Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="">
                                                <div id="validation_warehouse_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="transaction_type" class="form-label text-xs">Transaction Type</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="transaction_type" name="transaction_type" value="">
                                                <div id="validation_transaction_type" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="stock_transfer_status" class="form-label text-xs">Stock Transfer Status</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="stock_transfer_status" name="stock_transfer_status" value="">
                                                <div id="validation_stock_transfer_status" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_name" class="form-label text-xs">Client Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="">
                                                <div id="validation_client_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2 text-end">
                                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" id="btn_search" name="btn_search">Search</button>
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
    $("#logo_inventory").addClass("d-none");
    $("#logo_white_inventory").removeClass("d-none");
    $("#li_stock_transfer").addClass("active");
    $("#a_stock_transfer").addClass("active");

    const mapping_filter = [
        {
            id: "stock_transfer_id",
            desc: "Stock Transfer ID",
        },
        {
            id: "client_project_name",
            desc: "Client Name",
        },
        {
            id: "wh_code",
            desc: "Warehouse Name",
        },
        {
            id: "transaction_name",
            desc: "Transaction Type",
        },
        {
            id: "remark",
            desc: "Remark",
        },
        {
            id: "status_name",
            desc: "Status",
        },
        // {
        //     id: "action",
        //     desc: "Action",
        // },
    ];

    
    mapping_filter.forEach((element,index) => {
        selected_column.push(element.id);
    });

    // special function start
    const searchDatatables = () => {
        if(selected_column.length == 0){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Filter Cant all empty.",
                type: 'error',
                icon: 'error',
            });
            return;
        }

        $("#container-datatable").html("");
        let temp_html_datatable = "";
        temp_html_datatable += `<table class="table " id="list-datatable" style="width: 100%;"><thead><tr>`;
        let column_data_server = [];

        mapping_filter.forEach((element,index) => {
            const selected = selected_column.includes(element.id);
            if(selected){
                column_data_server.push({data: element.id, className: "text-xs",});
                temp_html_datatable += `<th class='text-xs'>${element.desc}</th>`;
            }
        });
        
        column_data_server.push({data: "action", className: "text-xs",});
        temp_html_datatable += `<th>Action</th>`;

        temp_html_datatable += `</tr></thead><tbody></tbody></table>`;
        $("#container-datatable").html(temp_html_datatable);

        const stock_transfer_id = $("#stock_transfer_id").val();
        const warehouse_name = $("#warehouse_name").val();
        const transaction_type = $("#transaction_type").val();
        const stock_transfer_status = $("#stock_transfer_status").val();
        const client_name = $("#client_name").val();

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('stock_transfer.datatables') }}",
                data: {
                    stock_transfer_id: stock_transfer_id,
                    warehouse_name: warehouse_name,
                    transaction_type: transaction_type,
                    stock_transfer_status: stock_transfer_status,
                    client_name: client_name,
                },
            },
            columns: column_data_server,
        });
    }
    // special function end

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
                    <label class="form-check-label text-xs" for="checkboxFilter_${index}">
                        ${element.desc}
                    </label>
                </div>
            </div>`;    
        });
        
        html_filter += `
        </div>`;
        $("#modal-body-FilterTable").html(html_filter);
    });

    $("#btn_search").on("click",function () {
        searchDatatables();
    });

    $("#btn_export_excel").on("click",function () {
        if(selected_column.length == 0){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Filter Cant all empty.",
                type: 'error',
                icon: 'error',
            });
            return;
        }

        const stock_transfer_id = $("#stock_transfer_id").val();
        const warehouse_name = $("#warehouse_name").val();
        const transaction_type = $("#transaction_type").val();
        const stock_transfer_status = $("#stock_transfer_status").val();
        const client_name = $("#client_name").val();

        const selected_column_query = JSON.stringify(selected_column);
        const mapping_filter_query = JSON.stringify(mapping_filter);

        const url = "{{ route('stock_transfer.viewExcel') }}";

        const full_url = `${url}?stock_transfer_id=${stock_transfer_id}&warehouse_name=${warehouse_name}&transaction_type=${transaction_type}&stock_transfer_status=${stock_transfer_status}&client_name=${client_name}&selected_column_query=${selected_column_query}&mapping_filter_query=${mapping_filter_query}`;
        window.open(full_url,"_blank");
    });

    
});
</script>
@endsection
