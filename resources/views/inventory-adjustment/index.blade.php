@extends('layout.app')

@section("title")
Inventory Adjustment
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
                        <h5 class="me-auto">Inventory Adjustment - List</h5>
                        <a href="{{ route('inventory_adjustment.create') }}" class="text-decoration-none me-2">
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
                                                <label for="adjustment_id" class="form-label text-xs">Adjustment ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="adjustment_id" name="adjustment_id" value="">
                                                <div id="validation_adjustment_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="adjustment_status" class="form-label text-xs">Adjustment Status</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="adjustment_status" name="adjustment_status" value="" readonly>
                                                <div id="validation_adjustment_status" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_adjustment_status" id="btn_search_adjustment_status"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="adjustment_type" class="form-label text-xs">Adjustment Type</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="adjustment_type" name="adjustment_type" value="" readonly>
                                                <div id="validation_adjustment_type" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" id="btn_search" name="btn_search">Search</button>
                                        <button type="button" class="btn btn-danger text-xs py-1 mb-0 ms-2" id="btn_reset" name="btn_reset">Reset</button>
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

<div class="modal fade" id="modal-AdjusmentTypeAndAdjustmentStatus" tabindex="-1" aria-labelledby="modal-AdjusmentTypeAndAdjustmentStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-AdjusmentTypeAndAdjustmentStatusLabel">Adjustment Type And Adjustment Status - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-AdjusmentTypeAndAdjustmentStatus" >
                        <thead>
                            <tr>
                                <th class="text-xs">Adjusment Type</th>
                                <th class="text-xs">Adjusment Status</th>
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
    $("#logo_inventory").addClass("d-none");
    $("#logo_white_inventory").removeClass("d-none");
    $("#li_inventory_adjustment").addClass("active");
    $("#a_inventory_adjustment").addClass("active");

    const mapping_filter = [
        {
            id: "adjustment_id",
            desc: "Adjustment ID",
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
            id: "adjustment_type",
            desc: "Adjustment Type",
        },
        {
            id: "reason",
            desc: "Reason",
        },
        {
            id: "status_name",
            desc: "Status",
        },
    ];

    
    mapping_filter.forEach((element,index) => {
        selected_column.push(element.id);
    });

    // special function start

    $("#btn_reset").on("click",function () {
        $("#adjustment_id").val("");
        $("#adjustment_status").val("");
        $("#adjustment_type").val("");
    });

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
                text: 'Filter Cant all empty.',
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
                column_data_server.push({data: element.id, className: 'text-xs',});
                temp_html_datatable += `<th>${element.desc}</th>`;
            }
        });
        
        column_data_server.push({data: "action", className: 'text-xs',});
        temp_html_datatable += `<th>Action</th>`;

        temp_html_datatable += `</tr></thead><tbody></tbody></table>`;
        $("#container-datatable").html(temp_html_datatable);
        
        const adjustment_id = $("#adjustment_id").val();
        const adjustment_status = $("#adjustment_status").val();
        const adjustment_type = $("#adjustment_type").val();

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('inventory_adjustment.datatables') }}",
                data: {
                    adjustment_id: adjustment_id,
                    adjustment_status: adjustment_status,
                    adjustment_type: adjustment_type,
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
                text: 'Filter Cant all empty.',
                type: 'error',
                icon: 'error',
            });
            return;
        }

        const adjustment_id = $("#adjustment_id").val();
        const adjustment_status = $("#adjustment_status").val();
        const adjustment_type = $("#adjustment_type").val();
        const selected_column_query = JSON.stringify(selected_column);
        const mapping_filter_query = JSON.stringify(mapping_filter);

        const url = "{{ route('inventory_adjustment.viewExcel') }}";

        const full_url = `${url}?adjustment_id=${adjustment_id}&adjustment_status=${adjustment_status}&adjustment_type=${adjustment_type}&selected_column_query=${selected_column_query}&mapping_filter_query=${mapping_filter_query}`;
        window.open(full_url,"_blank");
    });

    $("#btn_search_adjustment_status").on("click",function () {
        $("#modal-AdjusmentTypeAndAdjustmentStatus").modal('show');
        $("#list-datatable-modal-AdjusmentTypeAndAdjustmentStatus").DataTable().destroy();
        $("#list-datatable-modal-AdjusmentTypeAndAdjustmentStatus").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('inventory_adjustment.datatablesAdjusmentTypeAndAdjustmentStatus') }}",
            columns:[
                {data: 'process_code', searchable: true, className: 'text-xs',},
                {data: 'status_name', searchable: true, className: 'text-xs',},
            ],
        });
    });

    $("#list-datatable-modal-AdjusmentTypeAndAdjustmentStatus > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const adjustment_type = $($(dom_tr).children("td")[0]).text(); 
        const adjustment_status = $($(dom_tr).children("td")[1]).text();

        $("#adjustment_type").val(adjustment_type);
        $("#adjustment_status").val(adjustment_status);

        $("#modal-AdjusmentTypeAndAdjustmentStatus").modal('hide');
    });
    
});
</script>
@endsection
