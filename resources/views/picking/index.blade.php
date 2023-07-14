@extends('layout.app')

@section("title")
Picking
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
                        <h5 class="me-auto">Picking - List</h5>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="outbound_date_from" class="form-label text-xs">Outbound Date From</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="outbound_date_from" name="outbound_date_from" value="">
                                                <div id="validation_outbound_date_from" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="outbound_date_to" class="form-label text-xs">Outbound Date To</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="outbound_date_to" name="outbound_date_to" value="">
                                                <div id="validation_outbound_date_to" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="outbound_id" class="form-label text-xs">Outbound ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="outbound_id" name="outbound_id" value="">
                                                <div id="validation_outbound_id" class="invalid-feedback"></div>
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
                                                <div id="validation_reference_no" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="">
                                                <div id="validation_plan_delivery_date" class="invalid-feedback"></div>
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
                                                <button type="button" class="btn btn-primary rounded mb-0 py-1" id="btn_search_order_type"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="picking_status" class="form-label text-xs">Picking Status</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="status_id" name="status_id" value="" >
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="picking_status" name="picking_status" value="" readonly>
                                                <div id="validation_picking_status" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary rounded mb-0 py-1" id="btn_search_picking_status"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2 d-flex">
                                        <button type="button" class="btn btn-primary py-1 mb-0" id="btn_search" name="btn_search">Search</button>
                                        <button type="button" class="btn btn-danger ms-2 py-1 mb-0" id="btn_reset" name="btn_reset">Reset</button>
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
                                        <th class="text-xs">Picking Status</th>
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

<div class="modal fade" id="modal-PickingStatus" tabindex="-1" aria-labelledby="modal-PickingStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-PickingStatusLabel">Picking Status - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-PickingStatus" >
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
    $("#li_picking").addClass("active");
    $("#a_picking").addClass("active");

    // special function start
    const searchDatatables = () => {
        const outbound_date_from = $("#outbound_date_from").val();
        const outbound_date_to = $("#outbound_date_to").val();
        const outbound_id = $("#outbound_id").val();
        const reference_no = $("#reference_no").val();
        const plan_delivery_date = $("#plan_delivery_date").val();
        const order_id = $("#order_id").val();
        const order_type = $("#order_type").val();
        const status_id = $("#status_id").val();
        const picking_status = $("#picking_status").val();
    
        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('picking.datatables') }}",
                data: {
                    outbound_date_from: outbound_date_from,
                    outbound_date_to: outbound_date_to,
                    outbound_id: outbound_id,
                    reference_no: reference_no,
                    plan_delivery_date: plan_delivery_date,
                    order_id: order_id,
                    order_type: order_type,
                    status_id: status_id,
                    picking_status: picking_status,
                },
            },
            columns:[
                {
                    data: "outbound_id",
                    className: "text-xs",
                },
                {
                    data: "warehouse_name",
                    className: "text-xs",
                },
                {
                    data: "client_name",
                    className: "text-xs",
                },
                {
                    data: "reference_no",
                    className: "text-xs",
                },
                {
                    data: "plan_delivery_date",
                    className: "text-xs",
                },
                {
                    data: "order_type",
                    className: "text-xs",
                },
                {
                    data: "picking_status",
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
    $("#btn_reset").on("click",function () {
        $("#outbound_date_from").val("");
        $("#outbound_date_to").val("");
        $("#outbound_id").val("");
        $("#reference_no").val("");
        $("#plan_delivery_date").val("");
        $("#order_id").val("");
        $("#order_type").val("");
        $("#status_id").val("");
        $("#picking_status").val("");
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
            ajax: "{{ route('picking.datatablesOrderType') }}",
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

    $("#btn_search_picking_status").on('click',function () {
        $("#modal-PickingStatus").modal('show');
        $("#list-datatable-modal-PickingStatus").DataTable().destroy();
        $("#list-datatable-modal-PickingStatus").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('picking.datatablesPickingStatus') }}",
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

    $("#list-datatable-modal-PickingStatus > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const status_id = $($(dom_tr).children("td")[0]).text(); 
        const picking_status = $($(dom_tr).children("td")[1]).text();
        
        $("#status_id").val(status_id);
        $("#picking_status").val(picking_status);
        $("#modal-PickingStatus").modal('hide');
        
    });
});
</script>
@endsection
