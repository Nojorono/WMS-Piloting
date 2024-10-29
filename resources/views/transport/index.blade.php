@extends('layout.app')

@section("title")
Transport
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
                        <h5 class="me-auto">Transport - List</h5>
                        {{-- <a href="{{ route('shipping_load.create')  }}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary text-xs py-1">Add</button>
                        </a> --}}
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card ">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="outbound_planning_no" class="form-label text-xs">Outbound Planning No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="outbound_planning_no" name="outbound_planning_no" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="awb" class="form-label text-xs">AWB</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="awb" name="awb" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="transporter_name" class="form-label text-xs">Transporter Name</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="transporter_id" name="transporter_id" value="" readonly>
                                                <input type="text" autocomplete="off" class="form-control py-0" id="transporter_name" name="transporter_name" value="" readonly>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_transporter"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="service_type_name" class="form-label text-xs">Service Type Name</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="service_type_id" name="service_type_id" value="" readonly>
                                                <input type="text" autocomplete="off" class="form-control py-0" id="service_type_name" name="service_type_name" value="" readonly>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_service_type"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" id="btn_search" name="btn_search">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table " id="list-datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-xs">Outbound Planning No</th>
                                        <th class="text-xs">AWB</th>
                                        <th class="text-xs">Transporter Name</th>
                                        <th class="text-xs">Service Type</th>
                                        <th class="text-xs">Created Date</th>
                                        <th class="text-xs">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Transporter" tabindex="-1" aria-labelledby="modal-TransporterLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-TransporterLabel">Transporter - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Transporter" >
                        <thead>
                            <tr>
                                <th class="text-xs">Transporter ID</th>
                                <th class="text-xs">Transporter Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-ServiceType" tabindex="-1" aria-labelledby="modal-ServiceTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ServiceTypeLabel">Service Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-ServiceType" >
                        <thead>
                            <tr>
                                <th class="text-xs">Service Type ID</th>
                                <th class="text-xs">Transporter Name</th>
                                <th class="text-xs">Service Name</th>
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

@section("javascript")
<script type="text/javascript">
$(document).ready(function () {
    $("#dropdown_toggle_transportation").prop('aria-expanded',true);
    $("#dropdown_toggle_transportation").addClass('active');
    $("#dropdown_transportation").addClass('show');
    $("#logo_transportation").addClass("d-none");
    $("#logo_white_transportation").removeClass("d-none");
    $("#li_transport").addClass("active");
    $("#a_transport").addClass("active");

    // special function start
    const searchDatatables = () => {
        
        const outbound_planning_no = $("#outbound_planning_no").val();
        const awb = $("#awb").val();
        const transporter_id = $("#transporter_id").val();
        const service_type_id = $("#service_type_id").val();

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{route('transport.datatables')}}",
                data: {
                    outbound_planning_no : outbound_planning_no,
                    awb : awb,
                    transporter_id : transporter_id,
                    service_type_id : service_type_id,
                },
            },
            columns:[
            {
                data: "outbound_planning_no",
                className: "text-xs",
            },
            {
                data: "awb",
                className: "text-xs",
            },
            {
                data: "transporter_name",
                className: "text-xs",
            },
            {
                data: "service_name",
                className: "text-xs",
            },
            {
                data: "created_date",
                className: "text-xs",
            },
            {
                data: "action",
                className: "text-xs",
            },
            ],
        });
    }
    // special function end

    $("#btn_search").on("click",function () {
        searchDatatables();
    });

    $("#btn_search_transporter").on('click',function () {
        $("#modal-Transporter").modal('show');
        $("#list-datatable-modal-Transporter").DataTable().destroy();
        $("#list-datatable-modal-Transporter").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('transport.datatablesTransporter') }}",
            columns:[
                {
                    data: 'transporter_id', 
                    searchable: true, 
                    className: "text-xs",
                },
                {
                    data: 'transporter_name', 
                    searchable: true, 
                    className: "text-xs",
                },
            ],
        });
    });

    $("#list-datatable-modal-Transporter > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const transporter_id = $($(dom_tr).children("td")[0]).text(); 
        const transporter_name = $($(dom_tr).children("td")[1]).text();
        
        $("#transporter_id").val(transporter_id);
        $("#transporter_name").val(transporter_name);
        $("#modal-Transporter").modal('hide');
        
    });

    $("#btn_search_service_type").on('click',function () {
        const transporter_id = $("#transporter_id").val();
        if(!transporter_id){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: 'Transporter is required.',
                type: 'error',
                icon: 'error',
            });
            return;
        }

        $("#modal-ServiceType").modal('show');
        $("#list-datatable-modal-ServiceType").DataTable().destroy();
        $("#list-datatable-modal-ServiceType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url : "{{ route('transport.datatablesServiceType') }}",
                data : {
                    transporter_id : transporter_id,
                },
            },
            columns:[
                {
                    data: 'service_id', 
                    searchable: true, 
                    className: "text-xs",
                },
                {
                    data: 'transporter_name', 
                    searchable: true, 
                    className: "text-xs",
                },
                {
                    data: 'service_name', 
                    searchable: true, 
                    className: "text-xs",
                },
            ],
        });
    });

    $("#list-datatable-modal-ServiceType > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const service_type_id = $($(dom_tr).children("td")[0]).text(); 
        const service_name = $($(dom_tr).children("td")[2]).text();
        
        $("#service_type_id").val(service_type_id);
        $("#service_type_name").val(service_name);
        $("#modal-ServiceType").modal('hide');
        
    });
});
</script>
@endsection
