@extends('layout.app')

@section('title')
Return
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 d-flex mb-2">
                        <h5 class="me-auto">Return - List</h5>
                        <a href="{{route('return.create')}}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary mb-0 py-1">Add</button>
                        </a>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="return_no" class="form-label text-xs">Return No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="return_no" name="return_no" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="outbound_reference_no" class="form-label text-xs">Outbound Reference</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="outbound_reference_no" name="outbound_reference_no" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="reference_no" class="form-label text-xs">Reference Number</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="reference_no" name="reference_no" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="return_date" class="form-label text-xs">Return Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="return_date" name="return_date" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="status_name" class="form-label text-xs">Status</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="status_id" name="status_id" value="" >
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="status_name" name="status_name" value="" readonly>
                                                <div id="validation_status_name" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary rounded mb-0 py-1" id="btn_search_status_name"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary me-2 mb-0 py-1" id="btn_search" name="btn_search">Search</button>
                                            <button type="button" class="btn btn-primary me-2 mb-0 py-1" id="btn_reset" name="btn_reset">Reset</button>
                                        </div>
                                    </div>
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

<div class="modal fade" id="modal-Status" tabindex="-1" aria-labelledby="modal-StatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-StatusLabel">Status - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Status" >
                        <thead>
                            <tr>
                                <th class="text-xs">Status Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
let selected_column = [];
$(document).ready(function() {
    $("#dropdown_toggle_inbound").prop('aria-expanded', true);
    $("#dropdown_toggle_inbound").addClass('active');
    $("#dropdown_inbound").addClass('show');
    $("#logo_inbound").addClass("d-none");
    $("#logo_white_inbound").removeClass("d-none");
    $("#li_return").addClass("active");
    $("#a_return").addClass("active");

    const mapping_filter = [
        {
            id: "return_no",
            desc: "Return No",
        },
        {
            id: "client_name",
            desc: "Client Name",
        },
        {
            id: "client_project_name",
            desc: "Client Project Name",
        },
        {
            id: "wh_name",
            desc: "Warehouse Name",
        },
        {
            id: "outbound_reference_no",
            desc: "Outbound Reference",
        },
        {
            id: "reference_no",
            desc: "Reference Number",
        },
        {
            id: "return_date",
            desc: "Return Date",
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
        $("#return_no").val("");
        $("#outbound_reference_no").val("");
        $("#reference_no").val("");
        $("#return_date").val("");
        $("#status_name").val("");
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
                column_data_server.push({data: element.id, className:'text-xs',});
                temp_html_datatable += `<th class="text-xs">${element.desc}</th>`;
            }
        });
        
        column_data_server.push({data: "action", className:'text-xs',});
        temp_html_datatable += `<th>Action</th>`;

        temp_html_datatable += `</tr></thead><tbody></tbody></table>`;
        $("#container-datatable").html(temp_html_datatable);
        
        
        const return_no = $("#return_no").val();
        const outbound_reference_no = $("#outbound_reference_no").val();
        const reference_no = $("#reference_no").val();
        const return_date = $("#return_date").val();
        const status_name = $("#status_name").val();

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('return.datatables') }}",
                data: {
                    return_no: return_no,
                    outbound_reference_no: outbound_reference_no,
                    reference_no: reference_no,
                    return_date: return_date,
                    status_name: status_name,
                },
            },
            columns: column_data_server,
        });
    }
    // special function end

    $("#btn_search").on("click",function () {
        searchDatatables();
    });

    $("#btn_search_status_name").on('click',function () {
        $("#modal-Status").modal('show');
        $("#list-datatable-modal-Status").DataTable().destroy();
        $("#list-datatable-modal-Status").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('return.datatablesStatus') }}",
            columns:[
                {
                    data: 'status_name', 
                    searchable: true,
                    className: 'text-xs',
                },
            ],
        });
    });

    $("#list-datatable-modal-Status > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const status_name = $($(dom_tr).children("td")[0]).text();

        $("#status_name").val(status_name);
        $("#modal-Status").modal('hide');
        
    });

});
</script>
@endsection
