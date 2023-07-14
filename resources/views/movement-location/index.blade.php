@extends('layout.app')

@section("title")
Movement Location
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
                        <h5 class="me-auto">Movement Location - List</h5>
                        <a href="{{ route('movement_location.create') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1 py-1">Add</button>
                        </a>
                        <span>
                            <button type="button" class="btn btn-primary mb-0 py-1 py-1 me-2" id="btn_export_excel" name="btn_export_excel">Export</button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-primary mb-0 py-1 py-1" id="btn_filter" name="btn_filter">Filter</button>
                        </span>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="movement_location_id" class="form-label">Movement Location ID</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="movement_location_id" name="movement_location_id" value="" readonly>
                                                <div id="validation_movement_location_id" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 py-1 rounded" name="btn_search_movement" id="btn_search_movement"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_id" class="form-label">Client ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_id" name="client_id" value="">
                                                <div id="validation_client_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="movement_date_from" class="form-label">Movement Date From</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="movement_date_from" name="movement_date_from" value="">
                                                <div id="validation_movement_date_from" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="movement_date_to" class="form-label">Movement Date To</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="movement_date_to" name="movement_date_to" value="">
                                                <div id="validation_movement_date_to" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_id" class="form-label">Warehouse ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_id" name="warehouse_id" value="">
                                                <div id="validation_warehouse_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="status" class="form-label">Status</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="status" name="status" value="" readonly>
                                                <div id="validation_status" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 py-1 rounded" name="btn_search_status" id="btn_search_status"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2 text-end">
                                        <button type="button" class="btn btn-primary text-xs py-1" id="btn_search" name="btn_search">Search</button>
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

<div class="modal fade" id="modal-MovementLocationID" tabindex="-1" aria-labelledby="modal-MovementLocationIDLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-MovementLocationIDLabel">Movement Location ID - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-MovementLocationID" >
                        <thead>
                            <tr>
                                <th class="text-xs">Movement ID</th>
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

<div class="modal fade" id="modal-MovementStatus" tabindex="-1" aria-labelledby="modal-MovementStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-MovementStatusLabel">Status - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-MovementStatus" >
                        <thead>
                            <tr>
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
    $("#li_movement_location").addClass("active");
    $("#a_movement_location").addClass("active");

    const mapping_filter = [
        {
            id: "movement_id",
            desc: "Movement Location ID",
        },
        {
            id: "client_id",
            desc: "Client Name",
        },
        {
            id: "wh_code",
            desc: "Warehouse Name",
        },
        {
            id: "movement_date",
            desc: "Movement Date",
        },
        {
            id: "status_name",
            desc: "Status",
        },
        {
            id: "user_created",
            desc: "Created By",
        },
        {
            id: "datetime_created",
            desc: "Created On",
        },
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
                column_data_server.push({data: element.id, className: "text-xs"});
                temp_html_datatable += `<th>${element.desc}</th>`;
            }
        });
        
        column_data_server.push({data: "action", className: "text-xs"});
        temp_html_datatable += `<th>Action</th>`;

        temp_html_datatable += `</tr></thead><tbody></tbody></table>`;
        $("#container-datatable").html(temp_html_datatable);

        const movement_location_id = $("#movement_location_id").val();
        const client_id = $("#client_id").val();
        const movement_date_from = $("#movement_date_from").val();
        const movement_date_to = $("#movement_date_to").val();
        const warehouse_id = $("#warehouse_id").val();
        const status = $("#status").val();

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('movement_location.datatables') }}",
                data: {
                    movement_location_id: movement_location_id,
                    client_id: client_id,
                    movement_date_from: movement_date_from,
                    movement_date_to: movement_date_to,
                    warehouse_id: warehouse_id,
                    status: status,
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
        // if(selected_column.length == 0){
        //     Swal
        //     .mixin({
        //         customClass: {
        //             confirmButton: 'btn btn-primary me-2',
        //         },
        //         buttonsStyling: false,
        //     })
        //     .fire({
        //         text: "Filter Cant all empty.",
        //         type: 'error',
        //         icon: 'error',
        //     });
        //     return;
        // }

        // const movement_location_id = $("#movement_location_id").val();
        // const client_id = $("#client_id").val();
        // const movement_date_from = $("#movement_date_from").val();
        // const movement_date_to = $("#movement_date_to").val();
        // const warehouse_id = $("#warehouse_id").val();
        // const status = $("#status").val();

        // const selected_column_query = JSON.stringify(selected_column);
        // const mapping_filter_query = JSON.stringify(mapping_filter);

        const url = "{{ route('movement_location.viewExcel') }}";

        // const full_url = `${url}?movement_location_id=${movement_location_id}&client_id=${client_id}&movement_date_from=${movement_date_from}&movement_date_to=${movement_date_to}&warehouse_id=${warehouse_id}&status=${status}&selected_column_query=${selected_column_query}&mapping_filter_query=${mapping_filter_query}`;
        const full_url = `${url}`;
        window.open(full_url,"_blank");
    });


    $("#btn_search_movement").on("click",function () {
        $("#modal-MovementLocationID").modal('show');
        $("#list-datatable-modal-MovementLocationID").DataTable().destroy();
        $("#list-datatable-modal-MovementLocationID").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('movement_location.datatablesMovementLocationID') }}",
            columns:[
                {data: 'movement_id', searchable: true, className: "text-xs"},
            ],
        });
    });
    
    $("#list-datatable-modal-MovementLocationID > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const movement_id = $($(dom_tr).children("td")[0]).text(); 
        
        $("#movement_location_id").val(movement_id);
        $("#modal-MovementLocationID").modal('hide');
    });

    $("#btn_search_status").on("click",function () {
        $("#modal-MovementStatus").modal('show');
        $("#list-datatable-modal-MovementStatus").DataTable().destroy();
        $("#list-datatable-modal-MovementStatus").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('movement_location.datatablesMovementStatus') }}",
            columns:[
                {data: 'status_name', searchable: true, className: "text-xs"},
            ],
        });
    });
    
    $("#list-datatable-modal-MovementStatus > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const status = $($(dom_tr).children("td")[0]).text(); 
        
        $("#status").val(status);
        $("#modal-MovementStatus").modal('hide');
    });
    
});
</script>
@endsection
