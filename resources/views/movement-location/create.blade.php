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
                        <h5 class="me-auto">Movement Location - Add</h5>
                        <a href="{{ route('movement_location.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs mb-0 py-1">List</button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('movement_location.storeItemDetail') }}" id="form-save-movement-location">
                    <div class="col-sm-12 mb-2">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="movement_id" class="form-label">Movement ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="movement_id" name="movement_id" value="" readonly>
                                                <div class="invalid-feedback" id="validation_movement_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_id" class="form-label">Warehouse ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="warehouse_id" name="warehouse_id" value="" readonly>
                                                <div class="invalid-feedback" id="validation_warehouse_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_id" class="form-label">Client ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="client_id" name="client_id" value="" readonly>
                                                <div class="invalid-feedback" id="validation_client_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="movement_date" class="form-label">Movement Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="movement_date" name="movement_date" value="">
                                                <div class="invalid-feedback" id="validation_movement_date"></div>
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
                                        <a class="nav-link active" data-bs-toggle="tab" href="#page-tab--item-details">Item Details</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content">
                                <div class="tab-pane active" id="page-tab--item-details">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <button type="button" class="btn btn-primary mb-0 py-1" name="btn_add_row_item_details" id="btn_add_row_item_details">Add</button>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-item-details" style="width: calc(2 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-xs">SKU No</th>
                                                            <th class="text-center text-xs">Item Name</th>
                                                            <th class="text-center text-xs">Batch No</th>
                                                            <th class="text-center text-xs">Serial No</th>
                                                            <th class="text-center text-xs">Expired Date</th>
                                                            <th class="text-center text-xs">Qty</th>
                                                            <th class="text-center text-xs">UOM</th>
                                                            <th class="text-center text-xs">Stock Type</th>
                                                            <th class="text-center text-xs">Source Pallet ID</th>
                                                            <th class="text-center text-xs">Source Location ID</th>
                                                            <th class="text-center text-xs">Source Location Type</th>
                                                            <th class="text-center text-xs">Dest Pallet ID</th>
                                                            <th class="text-center text-xs">Dest Location ID</th>
                                                            <th class="text-center text-xs">Dest Location Type</th>
                                                            <th class="text-center text-xs">GR ID</th>
                                                            <th class="text-center text-xs">Action</th>
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
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary mb-0 py-1" name="btn_save" id="btn_save">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-AddRowItemDetail" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modal-AddRowItemDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-AddRowItemDetailLabel">Add Item Detail</h5>
            <button type="button" class="btn btn-primary mb-0 py-1" data-bs-dismiss="modal">Close</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="modal_item_detail_client_id" class="form-label">Client ID</label>
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="modal_item_detail_client_id" name="modal_item_detail_client_id" value="" readonly>
                                    <button type="button" class="btn btn-primary mb-0 py-1 rounded" id="btn_search_client_id_modal_item_detail" name="btn_search_client_id_modal_item_detail"><i class="bi bi-search"></i></button>
                                    <div class="invalid-feedback" id="validation_modal_item_detail_client_id"></div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="modal_item_detail_warehouse_id" class="form-label">Warehouse ID</label>
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="modal_item_detail_warehouse_id" name="modal_item_detail_warehouse_id" value="" readonly>
                                    <button type="button" class="btn btn-primary mb-0  py-1 rounded" id="btn_search_warehouse_id_modal_item_detail" name="btn_search_warehouse_id_modal_item_detail"><i class="bi bi-search"></i></button>
                                    <div class="invalid-feedback" id="validation_modal_item_detail_warehouse_id"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary mb-0 py-1" name="btn_search_modal_item_detail" id="btn_search_modal_item_detail">Search</button>
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-primary mb-0 py-1" name="btn_add_modal_item_detail" id="btn_add_modal_item_detail">Add</button>
                            </div>
                            <div class="col-sm-3 offset-sm-6">
                                <label for="modal_item_detail_warehouse_id" class="form-label">Search</label>
                                <input type="text" autocomplete="off" class="form-control py-0" id="modal_item_detail_search" name="modal_item_detail_search" value="" placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="table-responsive">
                            <table class="table " id="list-table-modal-AddRowItemDetail" >
                                <thead>
                                    <tr>
                                        <th class="text-center text-xs">SKU No</th>
                                        <th class="text-xs">Item Name</th>
                                        <th class="text-center text-xs">Batch No</th>
                                        <th class="text-center text-xs">Serial No</th>
                                        <th class="text-center text-xs">Expired Date</th>
                                        <th class="text-center text-xs">Pallet ID</th>
                                        <th class="text-center text-xs">Location ID</th>
                                        <th class="text-center text-xs">Location Type</th>
                                        <th class="text-center text-xs">Qty Available</th>
                                        <th class="text-center text-xs">Qty to Move</th>
                                        <th class="text-center text-xs">UoM</th>
                                        <th class="text-center text-xs">Stock Type</th>
                                        <th class="text-center text-xs">Dest Pallet ID</th>
                                        <th class="text-center text-xs">Dest Location ID</th>
                                        <th class="text-center text-xs">Dest Location Type</th>
                                        <th class="text-center text-xs">GR ID</th>
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

<div class="modal fade" id="modal-ClientID" tabindex="-1" aria-labelledby="modal-ClientIDLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ClientIDLabel">Client ID - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-ClientID" >
                        <thead>
                            <tr>
                                <th class="text-xs">Client Project Name</th>
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

<div class="modal fade" id="modal-WarehouseID" tabindex="-1" aria-labelledby="modal-WarehouseIDLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-WarehouseIDLabel">Warehouse ID - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-WarehouseID" >
                        <thead>
                            <tr>
                                <th class="text-xs">WH Code</th>
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

<div class="modal fade" id="modal-AddItemDetailLocation" tabindex="-1" aria-labelledby="modal-AddItemDetailLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-AddItemDetailLocationLabel">Location- List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="modal-AddItemDetailLocation_target_row" id="modal-AddItemDetailLocation_target_row">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-AddItemDetailLocation" >
                        <thead>
                            <tr>
                                <th class="text-xs">Location Code</th>
                                <th class="text-xs">Location Type</th>
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
function displayModalAddItemDetailLocation(row) {
    $("#modal-AddItemDetailLocation_target_row").val(row);
    $("#list-datatable-modal-AddItemDetailLocation").DataTable().destroy();
    $("#list-datatable-modal-AddItemDetailLocation").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('movement_location.datatablesModalItemDetailLocation') }}",
        columns:[
            {data: 'location_code', searchable: true, className: "text-xs"},
            {data: 'location_type', searchable: true, className: "text-xs"},
        ],
    });
    $("#modal-AddItemDetailLocation").modal('show');
}

function deleteRowTableItemDetail(row) {
    $(`#table_item_detail_${row}`).remove();
}

function check_modal_add_sku_item_detail_qty_to_move(row) {
    const current_value = $(`#modal_add_item_detail_qty_to_move_${row}`).val();
    const clean_value = Number(current_value);
    if(clean_value <= 0){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: 'Qty To Move must more than 0',
            type: 'error',
            icon: 'error',
        });
        $(`#modal_add_item_detail_qty_to_move_${row}`).val("");
    }
}
$(document).ready(function () {
    $("#dropdown_toggle_inventory").prop('aria-expanded',true);
    $("#dropdown_toggle_inventory").addClass('active');
    $("#dropdown_inventory").addClass('show');
    $("#li_movement_location").addClass("active");
    $("#a_movement_location").addClass("active");
    
    // special function start
    const getModalItemDetailSKU = (search) => {
        const _token = $("meta[name='csrf-token']").prop('content');
        const formData = new FormData();
        formData.append("_token",_token);
        if(search != undefined && search != "" ){
            formData.append("search",search);
        }

        $.ajax({
            url: "{{ route('movement_location.getModalItemDetailSKU') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#list-table-modal-AddRowItemDetail tbody").html("");
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

                if('data' in response){
                    const arr_data = response.data;
                    if(arr_data.length > 0){
                        let html = ``;
                        arr_data.forEach((element,index) => {
                            const available_qty = (element.available_qty) ? element.available_qty : "" ;
                            const batch_no = (element.batch_no) ? element.batch_no : "" ;
                            const expired_date = (element.expired_date) ? element.expired_date : "" ;
                            const location_id = (element.location_id) ? element.location_id : "" ;
                            const location_type = (element.location_type) ? element.location_type : "" ;
                            const pallet_id = (element.pallet_id) ? element.pallet_id : "" ;
                            const part_name = (element.part_name) ? element.part_name : "" ;
                            const serial_no = (element.serial_no) ? element.serial_no : "" ;
                            const sku = (element.sku) ? element.sku : "" ;
                            const stock_id = (element.stock_id) ? element.stock_id : "" ;
                            const uom_name = (element.uom_name) ? element.uom_name : "" ;
                            const gr_id = (element.gr_id) ? element.gr_id : "" ;
                            html += `
                            <tr id="modal_add_item_detail_row_${index}">
                                <td class="text-center text-xs">
                                    ${sku}
                                    <input type="hidden" name="modal_add_item_detail_sku_no_${index}" id="modal_add_item_detail_sku_no_${index}" value="${sku}">
                                </td>
                                <td class="text-xs">
                                    ${part_name}
                                    <input type="hidden" name="modal_add_item_detail_item_name_${index}" id="modal_add_item_detail_item_name_${index}" value="${part_name}">
                                </td>
                                <td class="text-center text-xs">
                                    ${batch_no}
                                    <input type="hidden" name="modal_add_item_detail_batch_no_${index}" id="modal_add_item_detail_batch_no_${index}" value="${batch_no}">
                                </td>
                                <td class="text-center text-xs">
                                    ${serial_no}
                                    <input type="hidden" name="modal_add_item_detail_serial_no_${index}" id="modal_add_item_detail_serial_no_${index}" value="${serial_no}">
                                </td>
                                <td class="text-center text-xs">
                                    ${expired_date}
                                    <input type="hidden" name="modal_add_item_detail_expired_date_${index}" id="modal_add_item_detail_expired_date_${index}" value="${expired_date}">
                                </td>
                                <td class="text-center text-xs">
                                    ${pallet_id}
                                    <input type="hidden" name="modal_add_item_detail_pallet_id_${index}" id="modal_add_item_detail_pallet_id_${index}" value="${pallet_id}">
                                </td>
                                <td class="text-center text-xs">
                                    ${location_id}
                                    <input type="hidden" name="modal_add_item_detail_location_id_${index}" id="modal_add_item_detail_location_id_${index}" value="${location_id}">
                                </td>
                                <td class="text-center text-xs">
                                    ${location_type}
                                    <input type="hidden" name="modal_add_item_detail_location_type_${index}" id="modal_add_item_detail_location_type_${index}" value="${location_type}">
                                </td>
                                <td class="text-center text-xs">
                                    ${available_qty}
                                    <input type="hidden" name="modal_add_item_detail_qty_available_${index}" id="modal_add_item_detail_qty_available_${index}" value="${available_qty}">
                                </td>
                                <td class="text-center text-xs">
                                    <input type="number" class="form-control py-0" name="modal_add_item_detail_qty_to_move_${index}" id="modal_add_item_detail_qty_to_move_${index}" onchange="check_modal_add_sku_item_detail_qty_to_move('${index}')" value="">
                                </td>
                                <td class="text-center text-xs">
                                    ${uom_name}
                                    <input type="hidden" name="modal_add_item_detail_uom_${index}" id="modal_add_item_detail_uom_${index}" value="${uom_name}">
                                </td>
                                <td class="text-center text-xs">
                                    ${stock_id}
                                    <input type="hidden" name="modal_add_item_detail_stock_type_${index}" id="modal_add_item_detail_stock_type_${index}" value="${stock_id}">
                                </td>
                                <td class="text-center text-xs">
                                    ${pallet_id}
                                    <input type="hidden" name="modal_add_item_detail_dest_pallet_id_${index}" id="modal_add_item_detail_dest_pallet_id_${index}" value="${pallet_id}">
                                </td>
                                <td class="text-center text-xs">
                                    <div class="input-group">
                                        <input type="text" class="form-control py-0" name="modal_add_item_detail_dest_location_id_${index}" id="modal_add_item_detail_dest_location_id_${index}" value="" readonly>
                                        <button type="button" class="btn btn-primary mb-0 py-1 rounded" onclick="displayModalAddItemDetailLocation('${index}')"><i class="bi bi-search"></i></button>
                                    </div>
                                </td>
                                <td class="text-center text-xs">
                                    <input type="text" class="form-control py-0" name="modal_add_item_detail_dest_location_type_${index}" id="modal_add_item_detail_dest_location_type_${index}" value="" readonly>
                                </td>
                                <td class="text-center text-xs">
                                    ${gr_id}
                                    <input type="hidden" name="modal_add_item_detail_gr_id_${index}" id="modal_add_item_detail_gr_id_${index}" value="${gr_id}">
                                </td>
                            </tr>`;
                        });
                        $("#list-table-modal-AddRowItemDetail tbody").html(html);
                    }
                }
                return;

            },
        });
    }
    // special function end

    let row_table_item_detail = 0;

    $("#btn_add_row_item_details").on("click",function () {
        $("#modal-AddRowItemDetail").modal("show");
    });

    $("#btn_search_client_id_modal_item_detail").on('click',function () {
        $("#modal-ClientID").modal('show');
        $("#list-datatable-modal-ClientID").DataTable().destroy();
        $("#list-datatable-modal-ClientID").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('movement_location.datatablesClientID') }}",
            columns:[
                {data: 'client_project_name', searchable: true, className: 'text-xs'},
            ],
        });
    });

    $("#list-datatable-modal-ClientID > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const client_project_name = $($(dom_tr).children("td")[0]).text(); 
        
        $("#modal_item_detail_client_id").val(client_project_name);
        $("#modal-ClientID").modal('hide');
        
    });

    $("#btn_search_warehouse_id_modal_item_detail").on('click',function () {
        $("#modal-WarehouseID").modal('show');
        $("#list-datatable-modal-WarehouseID").DataTable().destroy();
        $("#list-datatable-modal-WarehouseID").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('movement_location.datatablesWarehouseID') }}",
            columns:[
                {data: 'wh_code', searchable: true, className: "text-xs"},
            ],
        });
    });

    $("#list-datatable-modal-WarehouseID > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const wh_code = $($(dom_tr).children("td")[0]).text(); 
        
        $("#modal_item_detail_warehouse_id").val(wh_code);
        $("#modal-WarehouseID").modal('hide');
        
    });

    $("#btn_search_modal_item_detail").on("click",function () {
        getModalItemDetailSKU("");
    });

    $("#modal_item_detail_search").on("change",function () {
        const search = $(this).val();
        getModalItemDetailSKU(search);
    });

    $("#list-datatable-modal-AddItemDetailLocation > tbody").on('click','tr',function () {
        const target_row = $("#modal-AddItemDetailLocation_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const location_id = $($(dom_tr).children("td")[0]).text(); 
        const location_type = $($(dom_tr).children("td")[1]).text(); 
        
        $(`#modal_add_item_detail_dest_location_id_${target_row}`).val(location_id);
        $(`#modal_add_item_detail_dest_location_type_${target_row}`).val(location_type);
        $("#modal-AddItemDetailLocation").modal('hide');
    });

    $("#btn_add_modal_item_detail").on("click",function () {
        $("#list-table-modal-AddRowItemDetail tbody tr").each(function () {
            const current_row = $(this).prop('id').replace("modal_add_item_detail_row_","");
            
            const sku_no = $(`#modal_add_item_detail_sku_no_${current_row}`).val();
            const item_name = $(`#modal_add_item_detail_item_name_${current_row}`).val();
            const batch_no = $(`#modal_add_item_detail_batch_no_${current_row}`).val();
            const serial_no = $(`#modal_add_item_detail_serial_no_${current_row}`).val();
            const expired_date = $(`#modal_add_item_detail_expired_date_${current_row}`).val();
            const pallet_id = $(`#modal_add_item_detail_pallet_id_${current_row}`).val();
            const location_id = $(`#modal_add_item_detail_location_id_${current_row}`).val();
            const location_type = $(`#modal_add_item_detail_location_type_${current_row}`).val();
            const qty_available = $(`#modal_add_item_detail_qty_available_${current_row}`).val();
            const qty_to_move = $(`#modal_add_item_detail_qty_to_move_${current_row}`).val();
            const uom = $(`#modal_add_item_detail_uom_${current_row}`).val();
            const stock_type = $(`#modal_add_item_detail_stock_type_${current_row}`).val();
            const dest_pallet_id = $(`#modal_add_item_detail_dest_pallet_id_${current_row}`).val();
            const dest_location_id = $(`#modal_add_item_detail_dest_location_id_${current_row}`).val();
            const dest_location_type = $(`#modal_add_item_detail_dest_location_type_${current_row}`).val();
            const gr_id = $(`#modal_add_item_detail_gr_id_${current_row}`).val();
            
            if(qty_to_move != "" && qty_to_move != 0){
                row_table_item_detail++;
                let html_item_detail = `
                <tr id="table_item_detail_${row_table_item_detail}">
                    <td class="text-center">
                        ${sku_no}
                        <input type="hidden" name="sku_no[]" id="sku_no_${row_table_item_detail}" value="${sku_no}">
                        <div class="invalid-feedback" id="validation_sku_no_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${item_name}
                        <input type="hidden" name="item_name[]" id="item_name_${row_table_item_detail}" value="${item_name}">
                        <div class="invalid-feedback" id="validation_item_name_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${batch_no}
                        <input type="hidden" name="batch_no[]" id="batch_no_${row_table_item_detail}" value="${batch_no}">
                        <div class="invalid-feedback" id="validation_batch_no_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${serial_no}
                        <input type="hidden" name="serial_no[]" id="serial_no_${row_table_item_detail}" value="${serial_no}">
                        <div class="invalid-feedback" id="validation_serial_no_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${expired_date}
                        <input type="hidden" name="expired_date[]" id="expired_date_${row_table_item_detail}" value="${expired_date}">
                        <div class="invalid-feedback" id="validation_expired_date_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${qty_to_move}
                        <input type="hidden" name="qty[]" id="qty_${row_table_item_detail}" value="${qty_to_move}">
                        <div class="invalid-feedback" id="validation_qty_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${uom}
                        <input type="hidden" name="uom[]" id="uom_${row_table_item_detail}" value="${uom}">
                        <div class="invalid-feedback" id="validation_uom_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${stock_type}
                        <input type="hidden" class="form-control py-0" name="stock_type[]" id="stock_type_${row_table_item_detail}" value="${stock_type}">
                        <div class="invalid-feedback" id="validation_stock_type_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${pallet_id}
                        <input type="hidden" name="pallet_id[]" id="pallet_id_${row_table_item_detail}" value="${pallet_id}">
                        <div class="invalid-feedback" id="validation_pallet_id_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${location_id}
                        <input type="hidden" class="form-control py-0" name="location_id[]" id="location_id_${row_table_item_detail}" value="${location_id}">
                        <div class="invalid-feedback" id="validation_location_id_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${location_type}
                        <input type="hidden" name="location_type[]" id="location_type_${row_table_item_detail}" value="${location_type}">
                        <div class="invalid-feedback" id="validation_location_type_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${dest_pallet_id}
                        <input type="hidden" name="dest_pallet_id[]" id="dest_pallet_id_${row_table_item_detail}" value="${dest_pallet_id}">
                        <div class="invalid-feedback" id="validation_dest_pallet_id_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${dest_location_id}
                        <input type="hidden" name="dest_location_id[]" id="dest_location_id_${row_table_item_detail}" value="${dest_location_id}">
                        <div class="invalid-feedback" id="validation_dest_location_id_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${dest_location_type}
                        <input type="hidden" name="dest_location_type[]" id="dest_location_type_${row_table_item_detail}" value="${dest_location_type}">
                        <div class="invalid-feedback" id="validation_dest_location_type_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        ${gr_id}
                        <input type="hidden" name="gr_id[]" id="gr_id_${row_table_item_detail}" value="${gr_id}">
                        <div class="invalid-feedback" id="validation_gr_id_${row_table_item_detail}"></div>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" onclick='deleteRowTableItemDetail("${row_table_item_detail}")'>Delete</button>
                    </td>
                </tr>`;
                $("#tabel-item-details tbody").append(html_item_detail);
            }
        });

        $("#modal-AddRowItemDetail").modal("hide");
    });

    $("#form-save-movement-location").on("submit",function (e) {
        e.preventDefault();
        const _token = $("meta[name='csrf-token']").prop('content');
        const url = $(this).prop("action");
        const movement_date = $("#movement_date").val();

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

        const arr_stock_type = [];
        $("input[name^='stock_type']").each(function () {
            arr_stock_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_pallet_id = [];
        $("input[name^='pallet_id']").each(function () {
            arr_pallet_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_id = [];
        $("input[name^='location_id']").each(function () {
            arr_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_type = [];
        $("input[name^='location_type']").each(function () {
            arr_location_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_dest_pallet_id = [];
        $("input[name^='dest_pallet_id']").each(function () {
            arr_dest_pallet_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_dest_location_id = [];
        $("input[name^='dest_location_id']").each(function () {
            arr_dest_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_dest_location_type = [];
        $("input[name^='dest_location_type']").each(function () {
            arr_dest_location_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_gr_id = [];
        $("input[name^='gr_id']").each(function () {
            arr_gr_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });
        

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("movement_date",movement_date);
        formData.append("arr_sku_no",JSON.stringify(arr_sku_no));
        formData.append("arr_item_name",JSON.stringify(arr_item_name));
        formData.append("arr_batch_no",JSON.stringify(arr_batch_no));
        formData.append("arr_serial_no",JSON.stringify(arr_serial_no));
        formData.append("arr_expired_date",JSON.stringify(arr_expired_date));
        formData.append("arr_qty",JSON.stringify(arr_qty));
        formData.append("arr_uom",JSON.stringify(arr_uom));
        formData.append("arr_stock_type",JSON.stringify(arr_stock_type));
        formData.append("arr_pallet_id",JSON.stringify(arr_pallet_id));
        formData.append("arr_location_id",JSON.stringify(arr_location_id));
        formData.append("arr_location_type",JSON.stringify(arr_location_type));
        formData.append("arr_dest_pallet_id",JSON.stringify(arr_dest_pallet_id));
        formData.append("arr_dest_location_id",JSON.stringify(arr_dest_location_id));
        formData.append("arr_dest_location_type",JSON.stringify(arr_dest_location_type));
        formData.append("arr_gr_id",JSON.stringify(arr_gr_id));

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
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
                $("input[name^='qty']").removeClass('is-invalid');
                $("[id^='validation_qty']").html('');
                $("input[name^='uom']").removeClass('is-invalid');
                $("[id^='validation_uom']").html('');
                $("input[name^='stock_type']").removeClass('is-invalid');
                $("[id^='validation_stock_type']").html('');
                $("input[name^='pallet_id']").removeClass('is-invalid');
                $("[id^='validation_pallet_id']").html('');
                $("input[name^='location_id']").removeClass('is-invalid');
                $("[id^='validation_location_id']").html('');
                $("input[name^='location_type']").removeClass('is-invalid');
                $("[id^='validation_location_type']").html('');
                $("input[name^='dest_pallet_id']").removeClass('is-invalid');
                $("[id^='validation_dest_pallet_id']").html('');
                $("input[name^='dest_location_id']").removeClass('is-invalid');
                $("[id^='validation_dest_location_id']").html('');
                $("input[name^='dest_location_type']").removeClass('is-invalid');
                $("[id^='validation_dest_location_type']").html('');
                $("input[name^='gr_id']").removeClass('is-invalid');
                $("[id^='validation_gr_id']").html('');
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
                window.location = "{{ route('movement_location.index') }}";
                return;

            },
        });
    })
});
</script>
@endsection
