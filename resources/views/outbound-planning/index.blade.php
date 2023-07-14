@extends('layout.app')

@section("title")
Outbound Planning
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
                        <h5 class="me-auto">Outbound Planning - List</h5>
                        <a href="{{ route('outbound_planning.create') }}" class="text-decoration-none"> {{--  --}}
                            <button type="button" class="btn btn-primary text-xs py-1">Add</button>
                        </a>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="outbound_id" class="form-label text-xs">Outbound ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="outbound_id" name="outbound_id" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="reference_no" class="form-label text-xs">Reference No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="reference_no" name="reference_no" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" min="{{ date("Y-m-d") }}" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="order_type" class="form-label text-xs">Order Type</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="order_id" name="order_id" value="" >
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="order_type" name="order_type" value="" readonly>
                                                <div id="validation_order_type" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_order_type"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="outbound_status" class="form-label text-xs">Outbound Status</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="status_id" name="status_id" value="" >
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="outbound_status" name="outbound_status" value="" readonly>
                                                <div id="validation_outbound_status" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_outbound_status"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2 d-flex">
                                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" id="btn_search" name="btn_search">Search</button>
                                        <button type="button" class="btn btn-danger text-xs py-1 mb-0 ms-2" id="btn_reset" name="btn_reset">Reset</button>
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
                                        <th class="text-xs">Outbound ID</th>
                                        <th class="text-xs">Warehouse Name</th>
                                        <th class="text-xs">Client Name</th>
                                        <th class="text-xs">Reference No</th>
                                        <th class="text-xs">Plan Delivery Date</th>
                                        <th class="text-xs">Order Type</th>
                                        <th class="text-xs">Outbound Status</th>
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

<div class="modal fade" id="modal-OutboundStatus" tabindex="-1" aria-labelledby="modal-OutboundStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-OutboundStatusLabel">Outbound Status - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-OutboundStatus" >
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
    $("#dropdown_toggle_outbound").prop('aria-expanded',true);
    $("#dropdown_toggle_outbound").addClass('active');
    $("#dropdown_outbound").addClass('show');
    $("#logo_outbound").addClass("d-none");
    $("#logo_white_outbound").removeClass("d-none");
    $("#li_outbound_planning").addClass("active");
    $("#a_outbound_planning").addClass("active");

    // special function start
    const searchDatatables = () => {
        const outbound_id = $("#outbound_id").val();
        const reference_no = $("#reference_no").val();
        const plan_delivery_date = $("#plan_delivery_date").val();
        const order_id = $("#order_id").val();
        const order_type = $("#order_type").val();
        const status_id = $("#status_id").val();
        const outbound_status = $("#outbound_status").val();
    
        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{route('outbound_planning.datatables')}}",
                data: {
                    outbound_id :outbound_id,
                    reference_no :reference_no,
                    plan_delivery_date :plan_delivery_date,
                    order_id :order_id,
                    order_type :order_type,
                    status_id :status_id,
                    outbound_status :outbound_status,
                },
            },
            columns:[
                {data: "outbound_id", className: "text-xs"},
                {data: "warehouse_name", className: "text-xs"},
                {data: "client_name", className: "text-xs"},
                {data: "reference_no", className: "text-xs"},
                {data: "plan_delivery_date", className: "text-xs"},
                {data: "order_type", className: "text-xs"},
                {data: "outbound_status", className: "text-xs"},
                {data: "action", className: "text-xs"},
            ],
        });
    }
    // special function end
    $("#btn_reset").on("click",function () {
        $("#outbound_id").val("")
        $("#reference_no").val("")
        $("#plan_delivery_date").val("")
        $("#order_id").val("")
        $("#order_type").val("")
        $("#status_id").val("")
        $("#outbound_status").val("")
    });

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
            ajax: "{{ route('outbound_planning.datatablesOrderType') }}",
            columns:[
                {data: 'order_id', searchable: true,},
                {data: 'order_type', searchable: true,},
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

    $("#btn_search_outbound_status").on('click',function () {
        $("#modal-OutboundStatus").modal('show');
        $("#list-datatable-modal-OutboundStatus").DataTable().destroy();
        $("#list-datatable-modal-OutboundStatus").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('outbound_planning.datatablesOutboundStatus') }}",
            columns:[
                {data: 'status_id', searchable: true,},
                {data: 'status_name', searchable: true,},
            ],
        });
    });

    $("#list-datatable-modal-OutboundStatus > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const status_id = $($(dom_tr).children("td")[0]).text(); 
        const outbound_status = $($(dom_tr).children("td")[1]).text();
        
        $("#status_id").val(status_id);
        $("#outbound_status").val(outbound_status);
        $("#modal-OutboundStatus").modal('hide');
        
    });
});
</script>
@endsection
