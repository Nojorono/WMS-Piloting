@extends('layout.app')

@section("title")
Scan Picking
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
                        <h5 class="me-auto">Scan Picking</h5>
                    </div>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="outbound_id" name="outbound_id" value="{{ $data["pick_data_for_scan"][0]->outbound_id }}" readonly>
                                                <div id="validation_outbound_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="supplier_name" class="form-label text-xs">Supplier Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ $data["pick_data_for_scan"][0]->supplier_name }}" readonly>
                                                <div id="validation_supplier_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="reference_no" class="form-label text-xs">Reference No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="reference_no" name="reference_no" value="{{ $data["pick_data_for_scan"][0]->reference_no }}" readonly>
                                                <div id="validation_reference_no" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address" name="supplier_address" value="{{ $data["pick_data_for_scan"][0]->supplier_address }}" readonly>
                                                <div id="validation_supplier_address" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="receipt_no" class="form-label text-xs">Receipt No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="receipt_no" name="receipt_no" value="{{ $data["pick_data_for_scan"][0]->receipt_no }}" readonly>
                                                <div id="validation_receipt_no" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="{{ $data["pick_data_for_scan"][0]->plan_delivery_date }}" readonly>
                                                <div id="validation_plan_delivery_date" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="order_type" class="form-label text-xs">Order Type</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="order_type" name="order_type" value="{{ $data["pick_data_for_scan"][0]->order_type }}" readonly>
                                                <div id="validation_order_type" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="bucket_id" class="form-label text-xs">Bucket ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="bucket_id" name="bucket_id" value="{{ $data["pick_data_for_scan"][0]->bucket_id }}">
                                                <div id="validation_bucket_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link text-xs active" data-bs-toggle="tab" href="#page-tab--scan">Scan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--picked-items" onclick="getPickedItems()">Picked Items</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--outstanding-items" onclick="getOutstanding()">Outstanding Items</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content">
                                <div class="tab-pane active" id="page-tab--scan">
                                    <div class="row">
                                        <div class="col-sm-3 mb-2">
                                            <label for="scan_sku" class="form-label text-xs">SKU No</label>
                                            <input type="text" autocomplete="off" class="form-control py-0" id="scan_sku" name="scan_sku" value="">
                                            <div id="validation_scan_sku" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 mb-2">
                                            <label for="scan_location_id" class="form-label text-xs">Location ID</label>
                                            <input type="text" autocomplete="off" class="form-control py-0" id="scan_location_id" name="scan_location_id" value="">
                                            <div id="validation_scan_location_id" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 mb-2">
                                            <label  class="form-label text-xs">Last Scan</label>
                                            
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <div class="table-responsive">
                                                <table class="table " id="list-table-last-scans" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>SKU No</th>
                                                            <th>Item Name</th>
                                                            <th>Scan Qty</th>
                                                            <th>Stock Type</th>
                                                            <th>Datetime Scan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-primary ms-auto me-0 py-1 mb-0" name="btn_scan_save" id="btn_scan_save">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--picked-items">
                                    <div class="table-responsive">
                                        <table class="table " id="list-datatable-picked-items" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Location</th>
                                                    <th>SKU No</th>
                                                    <th>Item Name</th>
                                                    <th>Batch No</th>
                                                    <th>Serial No</th>
                                                    <th>Expired Date</th>
                                                    <th>Scan Qty</th>
                                                    <th>UOM</th>
                                                    <th>Stock Type</th>
                                                    <th>Picked By</th>
                                                    <th>Datetime Scan</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--outstanding-items">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table " id="list-datatable-outstanding-items" style="width: calc(1.5 * 100%);">
                                                <thead>
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>SKU No</th>
                                                        <th>Item Name</th>
                                                        <th>Batch No</th>
                                                        <th>Serial No</th>
                                                        <th>Expired Date</th>
                                                        <th>Pick Qty</th>
                                                        <th>Outstanding Qty</th>
                                                        <th>UOM</th>
                                                        <th>Stock Type</th>
                                                        <th>GR ID</th>
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
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary ms-auto me-0 py-1 mb-0" name="btn_confirm_picking" id="btn_confirm_picking">Confirm Picking</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ConfirmPicking" tabindex="-1" aria-labelledby="modal-ConfirmPickingLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('picking.confirmPicking' , [ 'id' => $data['pick_data_for_scan'][0]->outbound_id ]) }}" id="form-process-confirm-picking">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label text-xs">Are you sure want to CONFIRM this Picking ? </label>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary py-1 mb-0">Yes</button>
                            <button type="button" class="btn btn-primary py-1 mb-0" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ConfirmSKU" tabindex="-1" aria-labelledby="modal-ConfirmSKULabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <input type="hidden" name="target_sku" id="target_sku">
                                <input type="hidden" name="target_location" id="target_location">
                                <div class="table-responsive">
                                    <table class="table " id="list-table-modal-ConfirmSKU" >
                                        <thead>
                                            <tr>
                                                <th>Batch No</th>
                                                <th>GR ID</th>
                                                <th>Stock Type</th>
                                                <th>Allocated Qty</th>
                                                <th>Pick Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2 text-end">
                                <button type="button" class="btn btn-primary py-1 mb-0" name="btn_confirm_sku" id="btn_confirm_sku">Choose</button>
                                <button type="button" class="btn btn-primary py-1 mb-0" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-DeletePickedItems" tabindex="-1" aria-labelledby="modal-DeletePickedItemsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('picking.deletePickedItems' , [ 'id' => $data['pick_data_for_scan'][0]->outbound_id ]) }}" id="form-process-delete-picked-items">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="target_deleted_picked_sku" id="target_deleted_picked_sku">
                    <input type="hidden" name="target_deleted_picked_gr_id" id="target_deleted_picked_gr_id">
                    <input type="hidden" name="target_deleted_picked_location" id="target_deleted_picked_location">
                    <input type="hidden" name="target_deleted_picked_batch_no" id="target_deleted_picked_batch_no">
                    <input type="hidden" name="target_deleted_picked_stock_id" id="target_deleted_picked_stock_id">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label text-xs">Are you sure want to Delete this Picking ? </label>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary py-1 mb-0">Yes</button>
                            <button type="button" class="btn btn-primary py-1 mb-0" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script type="text/javascript">
function getPickedItems() {
    $("#list-datatable-picked-items").DataTable().destroy();
    $("#list-datatable-picked-items").DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ordering: false,
        ajax: {
            url: "{{ route('picking.datatablesPickedItems' , [ 'id' => $data['pick_data_for_scan'][0]->outbound_id ]) }}",
        },
        columns:[
            {data: 'location_id', searchable: false,},
            {data: 'sku', searchable: false,},
            {data: 'item_name', searchable: false,},
            {data: 'batch_no', searchable: false,},
            {data: 'serial_no', searchable: false,},
            {data: 'expired_date', searchable: false,},
            {data: 'scan_qty', searchable: false,},
            {data: 'uom', searchable: false,},
            {data: 'stock_type', searchable: false,},
            {data: 'picked_by', searchable: false,},
            {data: 'datetime_scan', searchable: false,},
            {data: 'action', searchable: false,},
        ],
    });
}

function getOutstanding() {
    $("#list-datatable-outstanding-items").DataTable().destroy();
    $("#list-datatable-outstanding-items").DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ordering: false,
        ajax: {
            url: "{{ route('picking.datatablesOutstandingItems' , [ 'id' => $data['pick_data_for_scan'][0]->outbound_id ]) }}",
        },
        columns:[
            {data: 'location', searchable: false,},
            {data: 'sku_no', searchable: false,},
            {data: 'item_name', searchable: false,},
            {data: 'batch_no', searchable: false,},
            {data: 'serial_no', searchable: false,},
            {data: 'expired_date', searchable: false,},
            {data: 'pick_qty', searchable: false,},
            {data: 'outstanding_qty', searchable: false,},
            {data: 'uom', searchable: false,},
            {data: 'stock_type', searchable: false,},
            {data: 'gr_id', searchable: false,},
        ],
    });
}

function getLastScan() {
    $.ajax({
        url: "{{ route('picking.getLastScan' , [ 'id' => $data['pick_data_for_scan'][0]->outbound_id ]) }}",
        method: "GET",
        beforeSend: function () {
            $("#list-table-last-scans tbody").html("");
        },
        error: function (error) {
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: 'Something Wrong',
                type: 'error',
                icon: 'error',
            });
        },
        complete: function () {

        },
        success: function (response) {
            if(typeof response !== 'object'){
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: 'Something Wrong',
                    type: 'error',
                    icon: 'error',
                });
                return;
            }

            if(response.err){
                if(!'message' in response){
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: 'Something Wrong',
                        type: 'error',
                        icon: 'error',
                    });

                    return;
                }
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: `${response.message}`,
                    type: 'success',
                    icon: 'success',
                });;
                return
            }

            if('data' in response){
                if(response.data.length > 0){
                    const datetime_scan = response.data[0].datetime_scan;
                    const item_name = response.data[0].item_name;
                    const scan_qty = response.data[0].scan_qty;
                    const sku = response.data[0].sku;
                    const stock_type = response.data[0].stock_type;
                    const uom = response.data[0].uom;
                    let html = `
                    <tr>
                        <td>${sku}</td>
                        <td>${item_name}</td>
                        <td>${scan_qty}</td>
                        <td>${stock_type}</td>
                        <td>${datetime_scan}</td>
                    </tr>`;

                    $("#list-table-last-scans tbody").html(html);
                }
                
            }
           
        },
    });
}

function checkQtyModalConfirm(row) {
    const allocated_qty = $(`#modal_confirm_sku_allocated_qty_${row}`).val();
    const pick_qty = $(`#modal_confirm_sku_pick_qty_${row}`).val();
    if(pick_qty < allocated_qty){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: "Pick Qty can't less than Allocated Qty!",
            type: 'error',
            icon: 'error',
        });
        $(`#modal_confirm_sku_pick_qty_${row}`).val("");
        return;
    }

    if(pick_qty > allocated_qty){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: "Pick Qty can't more than Allocated Qty!",
            type: 'error',
            icon: 'error',
        });
        $(`#modal_confirm_sku_pick_qty_${row}`).val("");
        return;
    }
}

function displayModalDeletePickedItems(sku,gr_id,location,batch_no,stock_id) {
    $("#target_deleted_picked_sku").val(sku)
    $("#target_deleted_picked_gr_id").val(gr_id)
    $("#target_deleted_picked_location").val(location)
    $("#target_deleted_picked_batch_no").val(batch_no)
    $("#target_deleted_picked_stock_id").val(stock_id)
    $("#modal-DeletePickedItems").modal("show");
}

$(document).ready(function () {
    $("#dropdown_toggle_outbound").prop('aria-expanded',true);
    $("#dropdown_toggle_outbound").addClass('active');
    $("#dropdown_outbound").addClass('show');
    $("#logo_outbound").addClass("d-none");
    $("#logo_white_outbound").removeClass("d-none");
    $("#li_picking").addClass("active");
    $("#a_picking").addClass("active");

    getLastScan();

    $("#btn_scan_save").on("click", function () {
        const formData = new FormData();
        const _token = $("meta[name='csrf-token']").prop('content');
        const scan_sku = $("#scan_sku").val();
        const scan_location_id = $("#scan_location_id").val();

        formData.append("_token",_token);
        formData.append("scan_sku",scan_sku);
        formData.append("scan_location_id",scan_location_id);

        $.ajax({
            url: "{{ route('picking.getSKUAndLocation' , [ 'id' => $data['pick_data_for_scan'][0]->outbound_id ]) }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(result){
                if(typeof result != "object"){
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: 'Something Wrong',
                        type: 'error',
                        icon: 'error',
                    });
                    return;
                }else{
                    if(result.err == true){
                        Swal
                        .mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary me-2',
                            },
                            buttonsStyling: false,
                        })
                        .fire({
                            text: `${result.message}`,
                            type: 'error',
                            icon: 'error',
                        });
                        return;
                    }else{
                        $("#target_sku").val(scan_sku);
                        $("#target_location").val(scan_location_id);
                        $("#list-table-modal-ConfirmSKU tbody").html("");

                        let html = "";
                        if(result.data.length > 0){
                            result.data.forEach((element,index) => {
                                html += `<tr id="row_modal_confirm_sku_${index}">
                                    <td>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="modal_confirm_sku_batch_no_${index}" name="modal_confirm_sku_batch_no_${index}" value="${element.batch_no}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="modal_confirm_sku_gr_id_${index}" name="modal_confirm_sku_gr_id_${index}" value="${element.gr_id}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="modal_confirm_sku_stock_type_${index}" name="modal_confirm_sku_stock_type_${index}" value="${element.stock_type}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="modal_confirm_sku_allocated_qty_${index}" name="modal_confirm_sku_allocated_qty_${index}" value="${element.pick_qty}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="modal_confirm_sku_pick_qty_${index}" name="modal_confirm_sku_pick_qty_${index}" value="" onchange="checkQtyModalConfirm('${index}')">
                                    </td>
                                </tr>`;
                            });
                        }
                        $("#list-table-modal-ConfirmSKU tbody").html(html);
                        
                        $("#modal-ConfirmSKU").modal("show");
                        return;
                    }
                }                          
            },
            error: function () {
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: 'Something Wrong',
                    type: 'error',
                    icon: 'error',
                });
                return;
            }
        });
    });

    $("#btn_confirm_sku").on("click",function () {
        const target_data = [];
        $("#list-table-modal-ConfirmSKU tbody tr").each(function () {
            const row = $(this).prop("id").replace("row_modal_confirm_sku_","");
            const gr_id = $(`#modal_confirm_sku_gr_id_${row}`).val();
            const stock_type = $(`#modal_confirm_sku_stock_type_${row}`).val();
            const allocated_qty = $(`#modal_confirm_sku_allocated_qty_${row}`).val();
            const pick_qty = $(`#modal_confirm_sku_pick_qty_${row}`).val();
            const batch_no = $(`#modal_confirm_sku_batch_no_${row}`).val();
            
            const target_sku = $("#target_sku").val();
            const target_location = $("#target_location").val();
            if(pick_qty != "" && pick_qty != 0){
                target_data.push({
                    gr_id: gr_id,
                    stock_type: stock_type,
                    allocated_qty: allocated_qty,
                    pick_qty: pick_qty,
                    batch_no: batch_no,
                    sku: target_sku,
                    location: target_location,
                });
            }
        });

        const formData = new FormData();
        const _token = $("meta[name='csrf-token']").prop('content');
        formData.append("_token",_token);
        formData.append("target_data",JSON.stringify(target_data));
        
        $.ajax({
            url: "{{ route('picking.saveScanQty' , [ 'id' => $data['pick_data_for_scan'][0]->outbound_id ]) }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
            },
            error: function (error) {
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: 'Something Wrong',
                    type: 'error',
                    icon: 'error',
                });
            },
            complete: function () {

            },
            success: function (response) {
                if(typeof response !== 'object'){
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: 'Something Wrong',
                        type: 'error',
                        icon: 'error',
                    });
                    return;
                }

                if(response.err){
                    if(!'message' in response){
                        Swal
                        .mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary me-2',
                            },
                            buttonsStyling: false,
                        })
                        .fire({
                            text: 'Something Wrong',
                            type: 'error',
                            icon: 'error',
                        });
                        return;
                    }
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: `${response.message}`,
                        type: 'error',
                        icon: 'error',
                    });
                    return
                }

                getLastScan();
                $("#modal-ConfirmSKU").modal("hide");
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: `${response.message}`,
                    type: 'success',
                    icon: 'success',
                });
            },
        });
    });

    $("#btn_confirm_picking").on("click",function () {
        const bucket_id = $("#bucket_id").val();
        if(bucket_id == ""){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Bucket ID Required",
                type: 'error',
                icon: 'error',
            });
            return;
        }
        
        $("#modal-ConfirmPicking").modal("show");    
    });
    
    $("#form-process-delete-picked-items").on("submit",function (e) {
        e.preventDefault();

        const formData = new FormData();
        const _token = $("meta[name='csrf-token']").prop('content');
        const target_deleted_picked_sku = $("#target_deleted_picked_sku").val();
        const target_deleted_picked_gr_id = $("#target_deleted_picked_gr_id").val();
        const target_deleted_picked_location = $("#target_deleted_picked_location").val();
        const target_deleted_picked_stock_id = $("#target_deleted_picked_stock_id").val();
        const target_deleted_picked_batch_no = $("#target_deleted_picked_batch_no").val();

        formData.append("_token",_token);
        formData.append("sku",target_deleted_picked_sku);
        formData.append("gr_id",target_deleted_picked_gr_id);
        formData.append("location",target_deleted_picked_location);
        formData.append("stock_id",target_deleted_picked_stock_id);
        formData.append("batch_no",target_deleted_picked_batch_no);
        $.ajax({
            url: $(this).prop('action'),
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
            },
            error: function (error) {
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: 'Something Wrong',
                    type: 'error',
                    icon: 'error',
                });
            },
            complete: function () {

            },
            success: function (response) {
                if(typeof response !== 'object'){
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: 'Something Wrong',
                        type: 'error',
                        icon: 'error',
                    });
                    return;
                }

                if(response.err){
                    if(!'message' in response){
                        Swal
                        .mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary me-2',
                            },
                            buttonsStyling: false,
                        })
                        .fire({
                            text: 'Something Wrong',
                            type: 'error',
                            icon: 'error',
                        });
                        return;
                    }
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: `${response.message}`,
                        type: 'error',
                        icon: 'error',
                    });
                    return
                }
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: `${response.message}`,
                    type: 'success',
                    icon: 'success',
                });

                window.location.reload();
            },
        });
    });
    $("#form-process-confirm-picking").on("submit",function (e) {
        e.preventDefault();

        const formData = new FormData();
        const _token = $("meta[name='csrf-token']").prop('content');
        const bucket_id = $("#bucket_id").val();
        formData.append("_token",_token);
        formData.append("bucket_id",bucket_id);

        $.ajax({
            url: $(this).prop('action'),
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
            },
            error: function (error) {
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: 'Something Wrong',
                    type: 'error',
                    icon: 'error',
                });
            },
            complete: function () {

            },
            success: function (response) {
                if(typeof response !== 'object'){
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: 'Something Wrong',
                        type: 'error',
                        icon: 'error',
                    });
                    return;
                }

                if(response.err){
                    if(!'message' in response){
                        Swal
                        .mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary me-2',
                            },
                            buttonsStyling: false,
                        })
                        .fire({
                            text: 'Something Wrong',
                            type: 'error',
                            icon: 'error',
                        });
                        return;
                    }
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: `${response.message}`,
                        type: 'error',
                        icon: 'error',
                    });
                    return
                }
                
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: `${response.message}`,
                    type: 'success',
                    icon: 'success',
                });

                window.location.href= "{{ route('picking.show' , [ 'id' => $data['pick_data_for_scan'][0]->outbound_id ]) }}";
            },
        });
    });
});
</script>
@endsection
