@extends('layout.app')

@section("title")
Inbound Planning
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
                        <h5 class="me-auto">Inbound Planning - List</h5>
                        <a href="{{ route('inbound_planning.create') }}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary text-xs py-1">Add</button>
                        </a>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card ">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="inbound_planning_no" class="form-label text-xs">Inbound Planning No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="inbound_planning_no" name="inbound_planning_no" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="reference_no" class="form-label text-xs">Reference No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="reference_no" name="reference_no" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row justify-content-center">
                                            <div class="col-sm-12">
                                                <label for="order_type" class="form-label text-xs">Order Type</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="order_id" name="order_id" value="" >
                                                <input type="text" autocomplete="off" class="form-control py-0" id="order_type" name="order_type" value="" readonly>
                                                <div id="validation_order_type" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_order_type"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="status_name" class="form-label text-xs">Inbound Status</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="status_id" name="status_id" value="" >
                                                <input type="text" autocomplete="off" class="form-control py-0" id="status_name" name="status_name" value="" readonly>
                                                <div id="validation_status_name" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_status_name"><i class="bi bi-search"></i></button>
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
                                        <th class="text-xs">Inbound Planning No</th>
                                        <th class="text-xs">Client Name</th>
                                        <th class="text-xs">Client Project Name</th>
                                        <th class="text-xs">Warehouse Name</th>
                                        <th class="text-xs">Reference No</th>
                                        <th class="text-xs">Plan Delivery Date</th>
                                        <th class="text-xs">Order Type</th>
                                        <th class="text-xs">Inbound Status</th>
                                        <th class="text-xs">Task Type</th>
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

<div class="modal fade" id="modal-OrderType" tabindex="-1" aria-labelledby="modal-OrderTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-OrderTypeLabel">Order Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-OrderType" >
                        <thead>
                            <tr>
                                <th class="text-xs">Order ID</th>
                                <th class="text-xs">Order Type</th>
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

<div class="modal fade" id="modal-InboundStatus" tabindex="-1" aria-labelledby="modal-InboundStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-InboundStatusLabel">Inbound Status - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-InboundStatus" >
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
        </div>
    </div>
</div>

@endsection

@section("javascript")
<script type="text/javascript">
$(document).ready(function () {
    $("#dropdown_toggle_inbound").prop('aria-expanded',true);
    $("#dropdown_toggle_inbound").addClass('active');
    $("#dropdown_inbound").addClass('show');
    $("#logo_inbound").addClass("d-none");
    $("#logo_white_inbound").removeClass("d-none");
    $("#li_inbound_planning").addClass("active");
    $("#a_inbound_planning").addClass("active");

    // special function start
    const searchDatatables = () => {
        const inbound_planning_no = $("#inbound_planning_no").val();
        const reference_no = $("#reference_no").val();
        const plan_delivery_date = $("#plan_delivery_date").val();
        const order_id = $("#order_id").val();
        const order_type = $("#order_type").val();
        const status_id = $("#status_id").val();
        const status_name = $("#status_name").val();
    
        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{route('inbound_planning.datatables')}}",
                data: {
                    inbound_planning_no :inbound_planning_no,
                    reference_no :reference_no,
                    plan_delivery_date :plan_delivery_date,
                    order_id :order_id,
                    order_type :order_type,
                    status_id :status_id,
                    status_name :status_name,
                },
            },
            columns:[
            {
                data: "inbound_planning_no",
                className: "text-xs",
            },
            {
                data: "client_name",
                className: "text-xs",
            },
            {
                data: "client_project_name",
                className: "text-xs",
            },
            {
                data: "wh_name",
                className: "text-xs",
            },
            {
                data: "reference_no",
                className: "text-xs",
            },
            {
                data: "plan_delivery",
                className: "text-xs",
            },
            {
                data: "order_type",
                className: "text-xs",
            },
            {
                data: "status_name",
                className: "text-xs",
            },
            {
                data: "task_type",
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
    
    $("#btn_search_order_type").on('click',function () {
        $("#modal-OrderType").modal('show');
        $("#list-datatable-modal-OrderType").DataTable().destroy();
        $("#list-datatable-modal-OrderType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('inbound_planning.datatablesOrderType') }}",
            columns:[
                {
                    data: 'order_id',
                    searchable: true,
                    className: "text-xs",
                },
                {
                    data: 'order_type',
                    searchable: true,
                    className: "text-xs",
                },
            ],
        });
    });

    $("#list-datatable-modal-OrderType > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const order_id = $($(dom_tr).children("td")[0]).text(); 
        const order_type = $($(dom_tr).children("td")[1]).text();
        
        $("#order_id").val(order_id);
        $("#order_type").val(order_type);
        $("#modal-OrderType").modal('hide');
        
    });

    $("#btn_search_status_name").on('click',function () {
        $("#modal-InboundStatus").modal('show');
        $("#list-datatable-modal-InboundStatus").DataTable().destroy();
        $("#list-datatable-modal-InboundStatus").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('inbound_planning.datatablesInboundStatus') }}",
            columns:[
                {
                    data: 'status_id', 
                    searchable: true, 
                    className: "text-xs",
                },
                {
                    data: 'status_name', 
                    searchable: true, 
                    className: "text-xs",
                },
            ],
        });
    });

    $("#list-datatable-modal-InboundStatus > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const status_id = $($(dom_tr).children("td")[0]).text(); 
        const status_name = $($(dom_tr).children("td")[1]).text();
        
        $("#status_id").val(status_id);
        $("#status_name").val(status_name);
        $("#modal-InboundStatus").modal('hide');
        
    });
});
</script>
@endsection
