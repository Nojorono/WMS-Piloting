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
                        <h5 class="me-auto">Inbound Planning - Add</h5>
                        <a href="{{ route('inbound_planning.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1">List</button>
                        </a>
                        <a href="{{ route('inbound_planning.showFormUploadExcel') }}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary text-xs py-1">Upload Excel</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('inbound_planning.storeInboundPlanning') }}" id="form-save-inbound">
                    @csrf
                    @method('POST')
                    <div class="col-sm-12">
                        <div class="card border-0">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="inbound_planning_no" class="form-label text-xs">Inbound Planning No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="inbound_planning_no" name="inbound_planning_no" value="Auto Generate" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_inbound_planning_no"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="supplier_name" class="form-label text-xs">Supplier Name*</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="supplier_id" name="supplier_id" value="">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="" readonly>
                                                <div id="validation_supplier_name" class="invalid-feedback text-xs"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_supplier_id"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="reference_no" class="form-label text-xs">Reference No*</label>
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
                                                <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address" name="supplier_address" value="" readonly>
                                                <div id="validation_supplier_address" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="receipt_no" class="form-label text-xs">Receipt No*</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="receipt_no" name="receipt_no" value="">
                                                <div id="validation_receipt_no" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_name" class="form-label text-xs">Client Name*</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="hidden" id="client_id" name="client_id" value="{{ session('current_client_id') }}">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ session('current_client_name') }}" readonly>
                                                <div id="validation_client_name" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="order_type" class="form-label text-xs">Order Type*</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="order_id" name="order_id" value="" >
                                                <input type="text" autocomplete="off" class="form-control py-0" id="order_type" name="order_type" value="" readonly>
                                                <div id="validation_order_type" class="invalid-feedback text-xs"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_order_type"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_name" class="form-label text-xs">Warehouse Name*</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="hidden" id="warehouse_id" name="warehouse_id" value="{{ session('current_warehouse_id') }}" readonly>
                                                <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="{{ session('current_warehouse_name') }}" readonly>
                                                <div id="validation_warehouse_name" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date*</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="" >
                                                <div id="validation_plan_delivery_date" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="" class="form-label text-xs">Task Type*</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="task_type" id="task_type_single_receive" value="Single Receive" checked>
                                                    <label class="form-check-label text-xs" for="task_type_single_receive">
                                                        Single Receive
                                                    </label>
                                                    <div id="validation_task_type_single_receive" class="invalid-feedback text-xs"></div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="task_type" id="task_type_partial_receive" value="Partial Receive">
                                                    <label class="form-check-label text-xs" for="task_type_partial_receive">
                                                        Partial Receive
                                                    </label>
                                                    <div id="validation_task_type_partial_receive" class="invalid-feedback text-xs"></div>
                                                </div>

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
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--notes">Notes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--attachment">Attachment</a>
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
                                                            <th class="text-xs text-center">SKU No</th>
                                                            <th class="text-xs text-center">Item Name</th>
                                                            <th class="text-xs text-center">Batch No</th>
                                                            <th class="text-xs text-center">Serial No</th>
                                                            <th class="text-xs text-center">IMEI No</th>
                                                            <th class="text-xs text-center">Part No</th>
                                                            <th class="text-xs text-center">Color</th>
                                                            <th class="text-xs text-center">Size</th>
                                                            <th class="text-xs text-center">Stock ID</th>
                                                            <th class="text-xs text-center">Stock Type</th>
                                                            <th class="text-xs text-center">Expired Date</th>
                                                            <th class="text-xs text-center">UOM</th>
                                                            <th class="text-xs text-center">Qty Plan</th>
                                                            <th class="text-xs text-center">Classification ID</th>
                                                            <th class="text-xs text-center">Classification</th>
                                                            <th class="text-xs text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--notes">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <textarea name="remarks" id="remarks" rows="10" class="form-control py-0"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--attachment">
                                    <div class="row ">
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0"name="file_1" id="file_1">
                                            <div id="validation_file_1" class="invalid-feedback text-xs"></div>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0"name="file_2" id="file_2">
                                            <div id="validation_file_2" class="invalid-feedback text-xs"></div>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0"name="file_3" id="file_3">
                                            <div id="validation_file_3" class="invalid-feedback text-xs"></div>
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

<div class="modal fade" id="modal-Supplier" tabindex="-1" aria-labelledby="modal-SupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SupplierLabel">Supplier - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Supplier" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">Supplier ID</th>
                                <th class="text-xs">Supplier Name</th>
                                <th class="text-xs">Supplier Address</th>
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
@endsection

@section("javascript")
<script type="text/javascript">
function displayModalClassification(row) {
    $("#modal-Classification_target_row").val(row);
    $("#list-datatable-modal-Classification").DataTable().destroy();
    $("#list-datatable-modal-Classification").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('inbound_planning.datatablesClassification') }}",
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

function displayModalUOM(row) {
    $("#modal-UOM_target_row").val(row);
    $("#list-datatable-modal-UOM").DataTable().destroy();
    $("#list-datatable-modal-UOM").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('inbound_planning.datatablesUOM') }}",
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


function displayModalSKU(row) {
    $("#modal-SKU_target_row").val(row);
    $("#list-datatable-modal-SKU").DataTable().destroy();
    $("#list-datatable-modal-SKU").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('inbound_planning.datatablesSKU') }}",
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

function deleteRowTableItemDetail(row) {
    $(`#table_item_detail_${row}`).remove();
}


$(document).ready(function () {
    $("#dropdown_toggle_inbound").prop('aria-expanded',true);
    $("#dropdown_toggle_inbound").addClass('active');
    $("#dropdown_inbound").addClass('show');
    $("#logo_inbound").addClass("d-none");
    $("#logo_white_inbound").removeClass("d-none");
    $("#li_inbound_planning").addClass("active");
    $("#a_inbound_planning").addClass("active");
    /* special function start */
    let row_Table_Item_Detail = 0;
    const add_Row_Table_Item_Detail = () => {
        row_Table_Item_Detail++;

        const html_Row = `
        <tr id='table_item_detail_${row_Table_Item_Detail}'>
            <td>
                <div class="input-group">                               
                    <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_${row_Table_Item_Detail}' readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_sku_${row_Table_Item_Detail}" name="btn_search_sku_${row_Table_Item_Detail}" onclick="displayModalSKU('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                    <div id="validation_sku_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
                </div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_${row_Table_Item_Detail}' readonly>
                <div id="validation_item_name_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_${row_Table_Item_Detail}'>
                <div id="validation_batch_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_${row_Table_Item_Detail}'>
                <div id="validation_serial_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='imei_no[]' id='imei_no_${row_Table_Item_Detail}'>
                <div id="validation_imei_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='part_no[]' id='part_no_${row_Table_Item_Detail}'>
                <div id="validation_part_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='color[]' id='color_${row_Table_Item_Detail}'>
                <div id="validation_color_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='size[]' id='size_${row_Table_Item_Detail}'>
                <div id="validation_size_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='stock_id[]' id='stock_id_${row_Table_Item_Detail}' readonly>
                <div id="validation_stock_id_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='stock_type[]' id='stock_type_${row_Table_Item_Detail}' readonly>
                <div id="validation_stock_type_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='date' class='form-control py-0' name='expired_date[]' id='expired_date_${row_Table_Item_Detail}'>
                <div id="validation_expired_date_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <div class="input-group">  
                    <input type='text' class='form-control py-0' name='uom[]' id='uom_${row_Table_Item_Detail}' readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_uom_${row_Table_Item_Detail}" name="btn_search_uom_${row_Table_Item_Detail}" onclick="displayModalUOM('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                    <div id="validation_uom_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
                </div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='qty_plan[]' id='qty_plan_${row_Table_Item_Detail}'>
                <div id="validation_qty_plan_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='id_classification[]' id='id_classification_${row_Table_Item_Detail}' readonly>
                <div id="validation_id_classification_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <div class="input-group">  
                    <input type='text' class='form-control py-0' name='classification[]' id='classification_${row_Table_Item_Detail}' readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_classification_${row_Table_Item_Detail}" name="btn_search_classification_${row_Table_Item_Detail}" onclick="displayModalClassification('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                    <div id="validation_classification_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
                </div>
            </td>
            <td class='text-center'>
                <button type='button' class='btn btn-primary mb-0 py-1' id='btn_delete_${row_Table_Item_Detail}' name='btn_delete_${row_Table_Item_Detail}' onclick='deleteRowTableItemDetail("${row_Table_Item_Detail}")'>Delete</button>
            </td>
        </tr>`;
        $("#tabel-item-detail > tbody").append(html_Row)
    }

    const validate_Input_File = () => {
        const file_1_size = $("#file_1").get(0).files[0];
        const file_2_size = $("#file_2").get(0).files[0];
        const file_3_size = $("#file_3").get(0).files[0];
        console.log(file_1_size);
        let total_size = 0;
        const max_all_size = 2000000;
        if(typeof file_1_size !== 'undefined'){
            total_size += parseInt(file_1_size.size);
        }
        if(typeof file_2_size !== 'undefined'){
            total_size += parseInt(file_2_size.size);
        }
        if(typeof file_3_size !== 'undefined'){
            total_size += parseInt(file_3_size.size);
        }
        
        if(total_size >= max_all_size){
            return {
                err: true,
                msg: "File is too big, max all file upload only 2MB.",
            }
        }
        return {
            err: false,
            msg: "File size is allowed.",
        }
    }
    /* special function end */


    $("#btn_search_supplier_id").on('click',function () {
        $("#modal-Supplier").modal('show');
        $("#list-datatable-modal-Supplier").DataTable().destroy();
        $("#list-datatable-modal-Supplier").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('inbound_planning.datatablesSupplier') }}",
            columns:[
                {data: 'supplier_id', searchable: true,},
                {data: 'supplier_name', searchable: true,},
                {data: 'address1', searchable: true,},
            ],
        });
    });

    $("#list-datatable-modal-Supplier > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const supplier_id = $($(dom_tr).children("td")[0]).text(); 
        const supplier_name = $($(dom_tr).children("td")[1]).text(); 
        const address = $($(dom_tr).children("td")[2]).text(); 
        
        $("#supplier_id").val(supplier_id);
        $("#supplier_name").val(supplier_name);
        $("#supplier_address").val(address);
        $("#modal-Supplier").modal('hide');
        
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
                    className: 'text-xs',
                },
                {
                    data: 'order_type', 
                    searchable: true,
                    className: 'text-xs',
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

    $("#btn_add_row_table_item_detail").on("click",function () {
        add_Row_Table_Item_Detail();
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
        
        $(`#id_classification_${target_row}`).val(id_classification);
        $(`#classification_${target_row}`).val(classification);
        
        $("#modal-Classification").modal('hide');
        
    });

    $("#form-save-inbound").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("input[name='_token']").val();
        const _method = $("input[name='_method']").val();

        const plan_delivery_date = $('#plan_delivery_date').val();
        const warehouse_id = $('#warehouse_id').val();
        const order_id = $('#order_id').val();
        const order_type = $('#order_type').val();
        const client_id = $('#client_id').val();
        const receipt_no = $('#receipt_no').val();
        const supplier_address = $('#supplier_address').val();
        const reference_no = $('#reference_no').val();
        const supplier_id = $('#supplier_id').val();
        const supplier_name = $('#supplier_name').val();
        const remarks = $('#remarks').val();
        const task_type = $('input[name="task_type"]:checked').val();

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

        const arr_imei_no = [];
        $("input[name^='imei_no']").each(function () {
            arr_imei_no.push({
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

        const arr_color = [];
        $("input[name^='color']").each(function () {
            arr_color.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_size = [];
        $("input[name^='size']").each(function () {
            arr_size.push({
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

        const arr_uom = [];
        $("input[name^='uom']").each(function () {
            arr_uom.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_qty_plan = [];
        $("input[name^='qty_plan']").each(function () {
            arr_qty_plan.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_id_classification = [];
        $("input[name^='id_classification']").each(function () {
            arr_id_classification.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_classification = [];
        $("input[name^='classification']").each(function () {
            arr_classification.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const check_Validation_Input_File = validate_Input_File();
        if('err' in check_Validation_Input_File){
            if(check_Validation_Input_File.err){
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: check_Validation_Input_File.msg,
                    type: 'error',
                    icon: 'error',
                });
                return;
            }
        }
        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("plan_delivery_date",plan_delivery_date);
        formData.append("warehouse_id",warehouse_id);
        formData.append("order_id",order_id);
        formData.append("order_type",order_type);
        formData.append("client_id",client_id);
        formData.append("receipt_no",receipt_no);
        formData.append("supplier_address",supplier_address);
        formData.append("reference_no",reference_no);
        formData.append("supplier_id",supplier_id);
        formData.append("supplier_name",supplier_name);
        formData.append("remarks",remarks);
        formData.append("task_type",task_type);
        formData.append("arr_sku_no",JSON.stringify(arr_sku_no));
        formData.append("arr_item_name",JSON.stringify(arr_item_name));
        formData.append("arr_batch_no",JSON.stringify(arr_batch_no));
        formData.append("arr_serial_no",JSON.stringify(arr_serial_no));
        formData.append("arr_imei_no",JSON.stringify(arr_imei_no));
        formData.append("arr_part_no",JSON.stringify(arr_part_no));
        formData.append("arr_color",JSON.stringify(arr_color));
        formData.append("arr_size",JSON.stringify(arr_size));
        formData.append("arr_expired_date",JSON.stringify(arr_expired_date));
        formData.append("arr_uom",JSON.stringify(arr_uom));
        formData.append("arr_qty_plan",JSON.stringify(arr_qty_plan));
        formData.append("arr_id_classification",JSON.stringify(arr_id_classification));
        formData.append("arr_classification",JSON.stringify(arr_classification));
        formData.append("file_1",$("#file_1").get(0).files[0]);
        formData.append("file_2",$("#file_2").get(0).files[0]);
        formData.append("file_3",$("#file_3").get(0).files[0]);

        $.ajax({
            url:url,
            method: _method,
            // data: form_data,
            // dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
            
                $("#plan_delivery_date").removeClass('is-invalid');
                $("#validation_plan_delivery_date").html('');
                $("#warehouse_id").removeClass('is-invalid');
                $("#validation_warehouse_id").html('');
                $("#order_id").removeClass('is-invalid');
                $("#validation_order_id").html('');
                $("#order_type").removeClass('is-invalid');
                $("#validation_order_type").html('');
                $("#client_name").removeClass('is-invalid');
                $("#validation_client_name").html('');
                $("#receipt_no").removeClass('is-invalid');
                $("#validation_receipt_no").html('');
                $("#supplier_address").removeClass('is-invalid');
                $("#validation_supplier_address").html('');
                $("#reference_no").removeClass('is-invalid');
                $("#validation_reference_no").html('');
                $("#supplier_name").removeClass('is-invalid');
                $("#validation_supplier_name").html('');

                $("#task_type_single_receive").removeClass('is-invalid');
                $("#validation_task_type_single_receive").html('');
                $("#task_type_partial_receive").removeClass('is-invalid');
                $("#validation_task_type_partial_receive").html('');

                $("input[name^='sku_no']").removeClass('is-invalid');
                $("[id^='validation_sku_no']").html('');
                $("input[name^='item_name']").removeClass('is-invalid');
                $("[id^='validation_item_name']").html('');
                $("input[name^='batch_no']").removeClass('is-invalid');
                $("[id^='validation_batch_no']").html('');
                $("input[name^='serial_no']").removeClass('is-invalid');
                $("[id^='validation_serial_no']").html('');
                $("input[name^='imei_no']").removeClass('is-invalid');
                $("[id^='validation_imei_no']").html('');
                $("input[name^='part_no']").removeClass('is-invalid');
                $("[id^='validation_part_no']").html('');
                $("input[name^='color']").removeClass('is-invalid');
                $("[id^='validation_color']").html('');
                $("input[name^='size']").removeClass('is-invalid');
                $("[id^='validation_size']").html('');
                $("input[name^='expired_date']").removeClass('is-invalid');
                $("[id^='validation_expired_date']").html('');
                $("input[name^='uom']").removeClass('is-invalid');
                $("[id^='validation_uom']").html('');
                $("input[name^='qty_plan']").removeClass('is-invalid');
                $("[id^='validation_qty_plan']").html('');
                $("input[name^='id_classification']").removeClass('is-invalid');
                $("[id^='validation_id_classification']").html('');
                $("input[name^='classification']").removeClass('is-invalid');
                $("[id^='validation_classification']").html('');

                $("#file_1").removeClass('is-invalid');
                $("#validation_file_1").html('');
                $("#file_2").removeClass('is-invalid');
                $("#validation_file_2").html('');
                $("#file_3").removeClass('is-invalid');
                $("#validation_file_3").html('');
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
                
                window.location = "{{ route('inbound_planning.index') }}";
                return;

            },
        });
    });
});
</script>
@endsection
