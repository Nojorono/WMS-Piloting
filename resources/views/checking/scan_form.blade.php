@extends('layout.app')

@section("title")
Scan Checking
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
                        <h5 class="me-auto">Scan Checking</h5>
                        @if ($data["checking_data"][0]->status_id == "CHE")
                        <a href="{{ route('checking.printShippingLabel' , [ 'id' => $data['checking_data'][0]->outbound_id ]) }}" class="text-decoration-none me-0">
                            <button type="button" class="btn btn-primary py-1 mb-0">Print Shipping Label</button>
                        </a>
                        @endif
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
                                                <input type="text" class="form-control py-0" id="outbound_id" name="outbound_id" value="{{ $data["checking_data"][0]->outbound_id }}" readonly>
                                                <div class="invalid-feedback" id="validation_outbound_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="supplier_name" class="form-label text-xs">Supplier Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ $data["data_header"][0]->supplier_name }}" readonly>
                                                <div class="invalid-feedback" id="validation_supplier_name"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="reference_no" class="form-label text-xs">Reference No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="reference_no" name="reference_no" value="{{ $data["checking_data"][0]->reference_no }}" readonly>
                                                <div class="invalid-feedback" id="validation_reference_no"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="supplier_address" name="supplier_address" value="{{ $data["data_header"][0]->supplier_address }}" readonly>
                                                <div class="invalid-feedback" id="validation_supplier_address"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="receipt_no" class="form-label text-xs">Receipt No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="receipt_no" name="receipt_no" value="{{ $data["data_header"][0]->receipt_no }}" readonly>
                                                <div class="invalid-feedback" id="validation_receipt_no"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="{{ $data["checking_data"][0]->plan_delivery_date }}" readonly>
                                                <div class="invalid-feedback" id="validation_plan_delivery_date"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="order_type" class="form-label text-xs">Order Type</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="order_type" name="order_type" value="{{ $data["data_header"][0]->order_type }}" readonly>
                                                <div class="invalid-feedback" id="validation_order_type"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="checker" class="form-label text-xs">Checker</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="checker" name="checker" value="{{ $data["data_header"][0]->checker }}" readonly>
                                                <div class="invalid-feedback" id="validation_checker"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="bucket_id" class="form-label text-xs">Bucket ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="bucket_id" name="bucket_id" value="{{ $data["data_header"][0]->bucket_id }}" readonly>
                                                <div class="invalid-feedback" id="validation_bucket_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="carton_id" class="form-label text-xs">Carton Id</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="carton_id" name="carton_id" value="{{ $data["data_header"][0]->carton_id }}" readonly>
                                                <div class="invalid-feedback" id="validation_carton_id"></div>
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
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--checked-items" onclick="getCheckedItems()">Checked Items</a>
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
                                            <label  class="form-label text-xs">Last Scan</label>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <div class="table-responsive">
                                                <table class="table " id="list-table-last-scans" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs">SKU No</th>
                                                            <th class="text-xs">Item Name</th>
                                                            <th class="text-xs">Scan Qty</th>
                                                            <th class="text-xs">Stock Type</th>
                                                            <th class="text-xs">Datetime Scan</th>
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
                                                <button type="button" class="btn btn-primary ms-auto me-0 py-1 mb-0" name="btn_scan_choose" id="btn_scan_choose">Choose</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--checked-items">
                                    <div class="table-responsive">
                                        <table class="table " id="list-datatable-checked-items" style="width: 100%;">
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
                                                    <th>Checked By</th>
                                                    <th>Datetime Scan</th>
                                                    <th>GR ID</th>
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
                                                        <th>Check Qty</th>
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
                            <button type="button" class="btn btn-primary ms-auto me-0 py-1 mb-0" name="btn_confirm_checking" id="btn_confirm_checking">Confirm Checking</button>
                        </div>
                    </div>
                </div>
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
                                <div class="table-responsive">
                                    <table class="table " id="list-table-modal-ConfirmSKU" >
                                        <thead>
                                            <tr>
                                                <th>Location</th>
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
                                <button type="button" class="btn btn-primary py-1 mb-0" name="btn_save_sku" id="btn_save_sku">Save</button>
                                <button type="button" class="btn btn-primary py-1 mb-0" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ConfirmChecking" tabindex="-1" aria-labelledby="modal-ConfirmCheckingLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('checking.confirmChecking' , [ 'id' => $data['checking_data'][0]->outbound_id ]) }}" id="form-process-confirm-checking">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label text-xs">Are you sure want to CONFIRM this Checking ? </label>
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
function getCheckedItems() {
    $("#list-datatable-checked-items").DataTable().destroy();
    $("#list-datatable-checked-items").DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ordering: false,
        ajax: {
            url: "{{ route('checking.datatablesCheckedItems' , [ 'id' => $data['checking_data'][0]->outbound_id ]) }}",
        },
        columns:[
            {
                data: 'location_id', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'sku', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'item_name', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'batch_no', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'serial_no', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'expired_date', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'scan_qty', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'uom', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'stock_type', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'checked_by', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'datetime_scan', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'gr_id', 
                searchable: false,
                className: "text-xs",
            },
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
            url: "{{ route('checking.datatablesOutstandingItems' , [ 'id' => $data['checking_data'][0]->outbound_id ]) }}",
        },
        columns:[
            {
                data: 'location_id', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'sku', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'item_name', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'batch_no', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'serial_no', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'expired_date', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'check_qty', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'outstanding_qty', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'uom', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'stock_type', 
                searchable: false,
                className: "text-xs",
            },
            {
                data: 'gr_id', 
                searchable: false,
                className: "text-xs",
            },
        ],
    });
}

function getLastScan() {
    $.ajax({
        url: "{{ route('checking.getLastScan' , [ 'id' => $data['checking_data'][0]->outbound_id ]) }}",
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
                    type: 'error',
                    icon: 'error',
                });
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
    const check_qty = $(`#modal_confirm_sku_check_qty_${row}`).val();
    if(check_qty < allocated_qty){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: "Check Qty can't lest than Allocated Qty!",
            type: 'error',
            icon: 'error',
        });
        $(`#modal_confirm_sku_check_qty_${row}`).val("");
        return;
    }

    if(check_qty > allocated_qty){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: "Check Qty can't more than Allocated Qty!",
            type: 'error',
            icon: 'error',
        });
        $(`#modal_confirm_sku_check_qty_${row}`).val("");
        return;
    }
}

$(document).ready(function () {
    $("#dropdown_toggle_outbound").prop('aria-expanded',true);
    $("#dropdown_toggle_outbound").addClass('active');
    $("#dropdown_outbound").addClass('show');
    $("#li_checking").addClass("active");
    $("#a_checking").addClass("active");

    getLastScan();

    $("#btn_scan_choose").on("click", function () {
        const formData = new FormData();
        const _token = $("meta[name='csrf-token']").prop('content');
        const scan_sku = $("#scan_sku").val();

        formData.append("_token",_token);
        formData.append("scan_sku",scan_sku);

        $.ajax({
            url: "{{ route('checking.getSKUAndLocation' , [ 'id' => $data['checking_data'][0]->outbound_id ]) }}",
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
                            text: result.message,
                            type: 'error',
                            icon: 'error',
                        });
                        return;
                    }else{
                        $("#target_sku").val(scan_sku);
                        $("#list-table-modal-ConfirmSKU tbody").html("");

                        let html = "";
                        if(result.data.length > 0){
                            result.data.forEach((element,index) => {
                                html += `<tr id="row_modal_confirm_sku_${index}">
                                    <td>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="modal_confirm_sku_location_${index}" name="modal_confirm_sku_location_${index}" value="${element.location}" readonly>
                                    </td>
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
                                        <input type="text" autocomplete="off" class="form-control py-0" id="modal_confirm_sku_allocated_qty_${index}" name="modal_confirm_sku_allocated_qty_${index}" value="${element.allocated_qty}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="modal_confirm_sku_check_qty_${index}" name="modal_confirm_sku_check_qty_${index}" value="" onchange="checkQtyModalConfirm('${index}')">
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

    $("#btn_save_sku").on("click",function () {
        const target_data = [];
        $("#list-table-modal-ConfirmSKU tbody tr").each(function () {
            const row = $(this).prop("id").replace("row_modal_confirm_sku_","");
            const location = $(`#modal_confirm_sku_location_${row}`).val();
            const batch_no = $(`#modal_confirm_sku_batch_no_${row}`).val();
            const gr_id = $(`#modal_confirm_sku_gr_id_${row}`).val();
            const stock_type = $(`#modal_confirm_sku_stock_type_${row}`).val();
            const allocated_qty = $(`#modal_confirm_sku_allocated_qty_${row}`).val();
            const check_qty = $(`#modal_confirm_sku_check_qty_${row}`).val();
            const target_sku = $("#target_sku").val();

            if(check_qty != "" && check_qty != 0){
                target_data.push({
                    location: location,
                    batch_no: batch_no,
                    gr_id: gr_id,
                    stock_type: stock_type,
                    allocated_qty: allocated_qty,
                    check_qty: check_qty,
                    sku: target_sku,
                });
            }
        });

        const formData = new FormData();
        const _token = $("meta[name='csrf-token']").prop('content');
        formData.append("_token",_token);
        formData.append("target_data",JSON.stringify(target_data));
        
        $.ajax({
            url: "{{ route('checking.saveScanQty' , [ 'id' => $data['checking_data'][0]->outbound_id ]) }}",
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
                        text: response.message,
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

    $("#btn_confirm_checking").on("click",function () {
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
        
        $("#modal-ConfirmChecking").modal("show");    
    });

    $("#form-process-confirm-checking").on("submit",function (e) {
        e.preventDefault();

        const formData = new FormData();
        const _token = $("meta[name='csrf-token']").prop('content');
        const bucket_id = $("#bucket_id").val();
        const carton_id = $("#carton_id").val();
        formData.append("_token",_token);
        formData.append("bucket_id",bucket_id);
        formData.append("carton_id",carton_id);
        
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

                window.location.href= "{{ route('checking.show' , [ 'id' => $data['checking_data'][0]->outbound_id ]) }}";
            },
        });
    });
    
});
</script>
@endsection
