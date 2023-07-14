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
                        <h5 class="me-auto">Return - Add</h5>
                        <a href="{{route('return.index')}}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary mb-0 py-1">List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('return.store') }}" id="form-save">
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
                                                <input type="text" class="form-control py-0" id="return_no" name="return_no" value="Auto Generate" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_return_no"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="return_date" class="form-label text-xs">Return Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control py-0" id="return_date" name="return_date">
                                                <div class="invalid-feedback text-xs" id="validation_return_date"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="outbound_reference_no" class="form-label text-xs">Outbound Reference No</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="outbound_reference_no" name="outbound_reference_no" value="">
                                                <div id="validation_outbound_reference_no" class="invalid-feedback text-xs"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_outbound_reference_no"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="return_from" class="form-label text-xs">Return From</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="return_from" name="return_from" value="">
                                                <div id="validation_return_from" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="awb_number" class="form-label text-xs">AWB Number</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="awb_number" name="awb_number" value="">
                                                <div id="validation_awb_number" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_name" class="form-label text-xs">Client Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ @session('current_client_name') }}" readonly>
                                                <div id="validation_client_name" class="invalid-feedback text-xs"></div>
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
                                                <div id="validation_reference_no" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_name" class="form-label text-xs">Warehouse Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="{{ @session('current_warehouse_name') }}" readonly>
                                                <div id="validation_warehouse_name" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link text-xs active" aria-current="true" data-bs-toggle="tab" href="#page-tab--item-detail">Item Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" aria-current="true" data-bs-toggle="tab" href="#page-tab--reason">Reason</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content py-0">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2">
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-primary me-2 mb-0 py-1" id="btn_add_row_table_item_detail" name="btn_add_row_table_item_detail">Add</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-item-detail" style="min-width: calc(2.5 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center">SKU</th>
                                                            <th class="text-xs text-center">Item Name</th>
                                                            <th class="text-xs text-center">Batch No</th>
                                                            <th class="text-xs text-center">Serial No</th>
                                                            <th class="text-xs text-center">Expired Date</th>
                                                            <th class="text-xs text-center">Part No</th>
                                                            <th class="text-xs text-center">IMEI</th>
                                                            <th class="text-xs text-center">Color</th>
                                                            <th class="text-xs text-center">Qty</th>
                                                            <th class="text-xs text-center">UoM</th>
                                                            <th class="text-xs text-center">Classification</th>
                                                            <th class="text-xs text-center">Stock Type</th>
                                                            <th class="text-xs text-center">Item Reason</th>
                                                            <th class="text-xs text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--reason">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2">
                                            <textarea class="form-control py-0" name="reason" id="reason" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mb-0 py-1">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-SKU" tabindex="-1" aria-labelledby="modal-SKULabel" aria-hidden="true">
    <input type="hidden" name="modal-SKU_target_row" id="modal-SKU_target_row">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SKULabel">SKU - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SKU" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">SKU</th>
                                <th class="text-xs">Part Name</th>
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

<div class="modal fade" id="modal-UOM" tabindex="-1" aria-labelledby="modal-UOMLabel" aria-hidden="true">
    <input type="hidden" name="modal-UOM_target_row" id="modal-UOM_target_row">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-UOMLabel">UOM - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-UOM" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">UOM Name</th>
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

<div class="modal fade" id="modal-Classification" tabindex="-1" aria-labelledby="modal-ClassificationLabel" aria-hidden="true">
    <input type="hidden" name="modal-Classification_target_row" id="modal-Classification_target_row">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ClassificationLabel">Classification - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Classification" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">Classification ID</th>
                                <th class="text-xs">Classification Name</th>
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

<div class="modal fade" id="modal-StockType" tabindex="-1" aria-labelledby="modal-StockTypeLabel" aria-hidden="true">
    <input type="hidden" name="modal-StockType_target_row" id="modal-StockType_target_row">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-StockTypeLabel">Stock Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-StockType" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">Stock ID</th>
                                <th class="text-xs">Stock Type</th>
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

@section('javascript')
<script type="text/javascript">
let row_Table_Item_Detail = 0;

function displayModalSKU(row) {
    $("#modal-SKU_target_row").val(row);
    $("#list-datatable-modal-SKU").DataTable().destroy();
    $("#list-datatable-modal-SKU").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('return.datatablesSKU') }}",
        columns:[
            {
                data: 'sku', 
                searchable: true,
                className: 'text-xs',
            },
            {
                data: 'part_name', 
                searchable: true,
                className: 'text-xs',
            },
        ],
    });
    $("#modal-SKU").modal('show');
}

function displayModalUOM(row) {
    $("#modal-UOM_target_row").val(row);
    $("#list-datatable-modal-UOM").DataTable().destroy();
    $("#list-datatable-modal-UOM").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('return.datatablesUOM') }}",
        columns:[
            {
                data: 'uom_name', 
                searchable: true,
                className: 'text-xs',
            },
        ],
    });
    $("#modal-UOM").modal('show');
}

function displayModalClassification(row) {
    $("#modal-Classification_target_row").val(row);
    $("#list-datatable-modal-Classification").DataTable().destroy();
    $("#list-datatable-modal-Classification").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('return.datatablesClassification') }}",
        columns:[
            {
                data: 'item_classification_id', 
                searchable: true,
                className: 'text-xs',
            },
            {
                data: 'classification_name', 
                searchable: true,
                className: 'text-xs',
            },
        ],
    });
    $("#modal-Classification").modal('show');
}

function displayModalStockType(row) {
    $("#modal-StockType_target_row").val(row);
    $("#list-datatable-modal-StockType").DataTable().destroy();
    $("#list-datatable-modal-StockType").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('return.datatablesStockType') }}",
        columns:[
            {
                data: 'stock_id', 
                searchable: true,
                className: 'text-xs',
            },
            {
                data: 'stock_type', 
                searchable: true,
                className: 'text-xs',
            },
        ],
    });
    $("#modal-StockType").modal('show');
}

function deleteRowTableItemDetail(row) {
    $(`#table_item_detail_${row}`).remove();
}

function addRowTableDetail(sku = "" , batch_no = "", expired_date = "", qty = "", uom_name = "") {
    row_Table_Item_Detail++;
    let html_table_item_detail = `
    <tr id='table_item_detail_${row_Table_Item_Detail}'>
        <td>
            <div class="input-group">                               
                <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_${row_Table_Item_Detail}' value="${sku}" readonly>
                <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_sku_${row_Table_Item_Detail}" name="btn_search_sku_${row_Table_Item_Detail}" onclick="displayModalSKU('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                <div id="validation_sku_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='item_name[]' id='item_name_${row_Table_Item_Detail}' value="" readonly>
            <div id="validation_item_name_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_${row_Table_Item_Detail}' value="${batch_no}">
            <div id="validation_batch_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_${row_Table_Item_Detail}' value="">
            <div id="validation_serial_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='date' class='form-control py-0' name='expired_date[]' id='expired_date_${row_Table_Item_Detail}' value="${expired_date}">
            <div id="validation_expired_date_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='part_no[]' id='part_no_${row_Table_Item_Detail}' value="">
            <div id="validation_part_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='imei_no[]' id='imei_no_${row_Table_Item_Detail}' value="">
            <div id="validation_imei_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='color[]' id='color_${row_Table_Item_Detail}' value="">
            <div id="validation_color_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='number' class='form-control py-0' name='qty[]' id='qty_${row_Table_Item_Detail}' value="${qty}">
            <div id="validation_qty_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <div class="input-group">  
                <input type='text' class='form-control py-0' name='uom[]' id='uom_${row_Table_Item_Detail}'value="${uom_name}" readonly>
                <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_uom_${row_Table_Item_Detail}" name="btn_search_uom_${row_Table_Item_Detail}" onclick="displayModalUOM('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                <div id="validation_uom_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </div>
        </td>
        <td>
            <div class="input-group">  
                <input type='hidden' name='classification_id[]' id='classification_id_${row_Table_Item_Detail}'>
                <input type='text' class='form-control py-0' name='classification_name[]' id='classification_name_${row_Table_Item_Detail}' readonly>
                <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_classification_${row_Table_Item_Detail}" name="btn_search_classification_${row_Table_Item_Detail}" onclick="displayModalClassification('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                <div id="validation_classification_name_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </div>
        </td>
        <td>
            <div class="input-group">  
                <input type='hidden' name='stock_id[]' id='stock_id_${row_Table_Item_Detail}'>
                <input type='text' class='form-control py-0' name='stock_type[]' id='stock_type_${row_Table_Item_Detail}' readonly>
                <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_stock_type_${row_Table_Item_Detail}" name="btn_search_stock_type_${row_Table_Item_Detail}" onclick="displayModalStockType('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                <div id="validation_stock_type_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='item_reason[]' id='item_reason_${row_Table_Item_Detail}'>
            <div id="validation_item_reason_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td class="text-center">
            <button type='button' class='btn btn-primary mb-0 py-1' id='btn_delete_${row_Table_Item_Detail}' name='btn_delete_${row_Table_Item_Detail}' onclick='deleteRowTableItemDetail("${row_Table_Item_Detail}")'>Delete</button>
        </td>
    </tr>
    `;

    $("#tabel-item-detail > tbody").append(html_table_item_detail)
}

$(document).ready(function() {
    $("#dropdown_toggle_inbound").prop('aria-expanded', true);
    $("#dropdown_toggle_inbound").addClass('active');
    $("#dropdown_inbound").addClass('show');
    $("#logo_inbound").addClass("d-none");
    $("#logo_white_inbound").removeClass("d-none");
    $("#li_return").addClass("active");
    $("#a_return").addClass("active");

    $("#btn_search_outbound_reference_no").on("click",function () {

        const outbound_reference_no = $("#outbound_reference_no").val();
        
        if(!outbound_reference_no){
            return;
        }

        const url = "{{ route('return.getDataByOutboundReferenceNo') }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("outbound_reference_no",outbound_reference_no);
        
        $.ajax({
            url:url,
            method: _method,
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
                    return;
                }
                if('data' in response && response.data.length > 0){
                    response.data.forEach(element => {
                        const batch_no = (element.batch_no) ? element.batch_no : "";
                        const expired_date = (element.expired_date) ? element.expired_date : "";
                        const qty = (element.qty) ? element.qty : "";
                        const sku = (element.sku) ? element.sku : "";
                        const uom_name = (element.uom_name) ? element.uom_name : "";
                        addRowTableDetail(sku,batch_no,expired_date,qty,uom_name);
                    });
                }
            },
        });
    });
    
    $("#btn_add_row_table_item_detail").on("click",function (e) {
        addRowTableDetail();
    });

    $("#list-datatable-modal-SKU > tbody").on('click','tr',function () {
        const target_row = $("#modal-SKU_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const sku = $($(dom_tr).children("td")[0]).text(); 
        const part_name = $($(dom_tr).children("td")[1]).text(); 
        
        $(`#sku_no_${target_row}`).val(sku);
        $(`#item_name_${target_row}`).val(part_name);
        
        $("#modal-SKU").modal('hide');
        
    });

    $("#list-datatable-modal-UOM > tbody").on('click','tr',function () {
        const target_row = $("#modal-UOM_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }

        const uom = $($(dom_tr).children("td")[0]).text(); 
        
        $(`#uom_${target_row}`).val(uom);
        
        $("#modal-UOM").modal('hide');
        
    });

    $("#list-datatable-modal-Classification > tbody").on('click','tr',function () {
        const target_row = $("#modal-Classification_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        
        const id_classification = $($(dom_tr).children("td")[0]).text(); 
        const classification = $($(dom_tr).children("td")[1]).text(); 
        
        $(`#classification_id_${target_row}`).val(id_classification);
        $(`#classification_name_${target_row}`).val(classification);
        
        $("#modal-Classification").modal('hide');
        
    });

    $("#list-datatable-modal-StockType > tbody").on('click','tr',function () {
        const target_row = $("#modal-StockType_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }

        const stock_id = $($(dom_tr).children("td")[0]).text(); 
        const stock_type = $($(dom_tr).children("td")[1]).text(); 
        
        $(`#stock_id_${target_row}`).val(stock_id);
        $(`#stock_type_${target_row}`).val(stock_type);
        
        $("#modal-StockType").modal('hide');
    });

    $("#form-save").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const return_no = $("#return_no").val();
        const return_date = $("#return_date").val();
        const outbound_reference_no = $("#outbound_reference_no").val();
        const return_from = $("#return_from").val();
        const awb_number = $("#awb_number").val();
        const client_name = $("#client_name").val();
        const reference_no = $("#reference_no").val();
        const warehouse_name = $("#warehouse_name").val();
        const reason = $("#reason").val();

        const arr_sku_no = [];
        $("input[name^='sku_no']").each(function () {
            arr_sku_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_name = [];
        $("input[name^='item_name']").each(function () {
            arr_item_name.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_batch_no = [];
        $("input[name^='batch_no']").each(function () {
            arr_batch_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_serial_no = [];
        $("input[name^='serial_no']").each(function () {
            arr_serial_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_expired_date = [];
        $("input[name^='expired_date']").each(function () {
            arr_expired_date.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_part_no = [];
        $("input[name^='part_no']").each(function () {
            arr_part_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_imei_no = [];
        $("input[name^='imei_no']").each(function () {
            arr_imei_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_color = [];
        $("input[name^='color']").each(function () {
            arr_color.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_qty = [];
        $("input[name^='qty']").each(function () {
            arr_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_uom = [];
        $("input[name^='uom']").each(function () {
            arr_uom.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_classification_id = [];
        $("input[name^='classification_id']").each(function () {
            arr_classification_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_classification_name = [];
        $("input[name^='classification_name']").each(function () {
            arr_classification_name.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_stock_id = [];
        $("input[name^='stock_id']").each(function () {
            arr_stock_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_stock_type = [];
        $("input[name^='stock_type']").each(function () {
            arr_stock_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_reason = [];
        $("input[name^='item_reason']").each(function () {
            arr_item_reason.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });


        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("return_no",return_no);
        formData.append("return_date",return_date);
        formData.append("outbound_reference_no",outbound_reference_no);
        formData.append("return_from",return_from);
        formData.append("awb_number",awb_number);
        formData.append("client_name",client_name);
        formData.append("reference_no",reference_no);
        formData.append("warehouse_name",warehouse_name);
        formData.append("reason",reason);

        formData.append("arr_sku_no",JSON.stringify(arr_sku_no));
        formData.append("arr_item_name",JSON.stringify(arr_item_name));
        formData.append("arr_batch_no",JSON.stringify(arr_batch_no));
        formData.append("arr_serial_no",JSON.stringify(arr_serial_no));
        formData.append("arr_expired_date",JSON.stringify(arr_expired_date));
        formData.append("arr_part_no",JSON.stringify(arr_part_no));
        formData.append("arr_imei_no",JSON.stringify(arr_imei_no));
        formData.append("arr_color",JSON.stringify(arr_color));
        formData.append("arr_qty",JSON.stringify(arr_qty));
        formData.append("arr_uom",JSON.stringify(arr_uom));
        formData.append("arr_classification_id",JSON.stringify(arr_classification_id));
        formData.append("arr_classification_name",JSON.stringify(arr_classification_name));
        formData.append("arr_stock_id",JSON.stringify(arr_stock_id));
        formData.append("arr_stock_type",JSON.stringify(arr_stock_type));
        formData.append("arr_item_reason",JSON.stringify(arr_item_reason));

        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
            
                $("#return_no").removeClass('is-invalid');
                $("#validation_return_no").html('');
                $("#return_date").removeClass('is-invalid');
                $("#validation_return_date").html('');
                $("#outbound_reference_no").removeClass('is-invalid');
                $("#validation_outbound_reference_no").html('');
                $("#return_from").removeClass('is-invalid');
                $("#validation_return_from").html('');
                $("#awb_number").removeClass('is-invalid');
                $("#validation_awb_number").html('');
                $("#client_name").removeClass('is-invalid');
                $("#validation_client_name").html('');
                $("#reference_no").removeClass('is-invalid');
                $("#validation_reference_no").html('');
                $("#warehouse_name").removeClass('is-invalid');
                $("#validation_warehouse_name").html('');
                $("#reason").removeClass('is-invalid');
                $("#validation_reason").html('');

                $("input[name^='sku_no']").removeClass('is-invalid');
                $("[id^='validation_sku_no']").html('');
                $("input[name^='item_name']").removeClass('is-invalid');
                $("[id^='validation_item_name']").html('');
                $("input[name^='batch_no']").removeClass('is-invalid');
                $("[id^='validation_batch_no']").html('');
                $("input[name^='serial_no']").removeClass('is-invalid');
                $("[id^='validation_serial_no']").html('');
                $("input[name^='expired_date']").removeClass('is-invalid');
                $("[id^='validation_expired_date']").html('');
                $("input[name^='part_no']").removeClass('is-invalid');
                $("[id^='validation_part_no']").html('');
                $("input[name^='imei_no']").removeClass('is-invalid');
                $("[id^='validation_imei_no']").html('');
                $("input[name^='color']").removeClass('is-invalid');
                $("[id^='validation_color']").html('');
                $("input[name^='qty']").removeClass('is-invalid');
                $("[id^='validation_qty']").html('');
                $("input[name^='uom']").removeClass('is-invalid');
                $("[id^='validation_uom']").html('');
                $("input[name^='classification_id']").removeClass('is-invalid');
                $("[id^='validation_classification_id']").html('');
                $("input[name^='classification_name']").removeClass('is-invalid');
                $("[id^='validation_classification_name']").html('');
                $("input[name^='stock_id']").removeClass('is-invalid');
                $("[id^='validation_stock_id']").html('');
                $("input[name^='stock_type']").removeClass('is-invalid');
                $("[id^='validation_stock_type']").html('');
                $("input[name^='item_reason']").removeClass('is-invalid');
                $("[id^='validation_item_reason']").html('');
                
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
                    for (const key_data in response.data) {
                        if (Object.hasOwnProperty.call(response.data, key_data)) {
                            const arr_message = response.data[key_data];
                            let text_message = "";
                            arr_message.forEach(error_message => {
                                text_message += `${error_message} <br>`;
                            });
                            $(`#${key_data}`).addClass('is-invalid');
                            $(`#validation_${key_data}`).html(text_message);
                        }
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
                });
                
                window.location = "{{ route('return.index') }}";
                return;

            },
        });

    });
});
</script>
@endsection
