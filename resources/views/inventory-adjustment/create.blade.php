@extends('layout.app')

@section("title")
Inventory Adjustment
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
                        <h5 class="me-auto">Inventory Adjustment - Add</h5>
                        <a href="{{ route('inventory_adjustment.index') }}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary text-xs py-1">List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('inventory_adjustment.store') }}" id="form-save-inventory-adjustment">
                    @method('POST')
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="adjustment_id" class="form-label text-xs">Adjustment ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="adjustment_id" name="adjustment_id" value="" readonly>
                                                <div id="validation_adjustment_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_name" class="form-label text-xs">Warehouse Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="{{ session("current_warehouse_name") }}" readonly>
                                                <div id="validation_warehouse_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="adjustment_type" class="form-label text-xs">Adjustment Type</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="adjustment_code" name="adjustment_code" value="" >
                                                <input type="text" autocomplete="off" class="form-control py-0" id="adjustment_type" name="adjustment_type" value="" readonly>
                                                <div id="validation_adjustment_type" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_adjustment_type" id="btn_search_adjustment_type"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="reason" class="form-label text-xs">Reason</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="reason" name="reason" value="">
                                                <div id="validation_reason" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_name" class="form-label text-xs">Client Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ session("current_client_name") }}" readonly>
                                                <div id="validation_client_name" class="invalid-feedback"></div>
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
                                </ul>
                            </div>
                            <div class="card-body py-0 tab-content">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2">
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-primary text-xs py-1 mb-0 me-2" id="btn_add_row_table_item_detail" name="btn_add_row_table_item_detail">Add</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="table-item-detail" style="min-width: calc(1 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-xs">SKU No</th>
                                                            <th class="text-center text-xs">Item Name</th>
                                                            <th class="text-center text-xs">Batch No</th>
                                                            <th class="text-center text-xs">Serial No</th>
                                                            <th class="text-center text-xs">IMEI No</th>
                                                            <th class="text-center text-xs">Part No</th>
                                                            <th class="text-center text-xs">Color</th>
                                                            <th class="text-center text-xs">Size</th>
                                                            <th class="text-center text-xs">Expired Date</th>
                                                            <th class="text-center text-xs">Location</th>
                                                            <th class="text-center text-xs">Stock ID</th>
                                                            <th class="text-center text-xs">Adjustment Qty</th>
                                                            <th class="text-center text-xs">Final Qty</th>
                                                            <th class="text-center text-xs">UoM</th>
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
                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-primary text-xs py-1 mb-0">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-AdjusmentType" tabindex="-1" aria-labelledby="modal-AdjusmentTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-AdjusmentTypeLabel">Adjustment Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-AdjusmentType">
                        <thead>
                            <tr>
                                <th class="text-xs">Adjustment Code</th>
                                <th class="text-xs">Adjustment Type</th>
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

<div class="modal fade" id="modal-AddSKU-ItemDetails" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modal-AddSKU-ItemDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-AddSKU-ItemDetailsLabel">Add SKU</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center">
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" name="btn_choose" id="btn_choose">Choose</button>
                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" name="btn_close" id="btn_close" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col-sm-3 offset-sm-6 mb-2">
                        <label for="search_input_modal-AddSKU-ItemDetails" class="form-label text-xs">Search</label>
                        <input type="text" autocomplete="off" class="form-control py-0" id="search_input_modal-AddSKU-ItemDetails" name="search_input_modal-AddSKU-ItemDetails" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <div class="table-responsive">
                            <table class="table " id="list-table-modal-AddSKU-ItemDetails" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-xs">SKU No</th>
                                        <th class="text-xs">Item Name</th>
                                        <th class="text-xs">Batch No</th>
                                        <th class="text-xs">Serial No</th>
                                        <th class="text-xs">IMEI No</th>
                                        <th class="text-xs">Part No</th>
                                        <th class="text-xs">Color</th>
                                        <th class="text-xs">Size</th>
                                        <th class="text-xs">Expired Date</th>
                                        <th class="text-xs">Location</th>
                                        <th class="text-xs">Stock ID</th>
                                        <th class="text-xs">Qty</th>
                                        <th class="text-xs">Adjustment Qty</th>
                                        <th class="text-xs">UOM</th>
                                        <th class="text-xs">GR ID</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    
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

function deleteRowItemDetail(row) {
    $(`#row_item_detail_${row}`).remove();
}

function check_modal_add_sku_item_detail_adjustment_qty(row) {
    const current_value = $(`#row_modal_add_sku_item_detail_adjustment_qty_${row}`).val();
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
            text: 'Adjustment Qty must more than 0',
            type: 'error',
            icon: 'error',
        });
        $(`#row_modal_add_sku_item_detail_adjustment_qty_${row}`).val("");
    }
    
}
$(document).ready(function () {
    $("#dropdown_toggle_inventory").prop('aria-expanded',true);
    $("#dropdown_toggle_inventory").addClass('active');
    $("#dropdown_inventory").addClass('show');
    $("#logo_inventory").addClass("d-none");
    $("#logo_white_inventory").removeClass("d-none");
    $("#li_inventory_adjustment").addClass("active");
    $("#a_inventory_adjustment").addClass("active");

    let row_item_detail = 0;
    /* special function start */
    const get_SKU_Item_Details = (sku) => {
        return new Promise(function (resolve,reject) {
            const _token = $("meta[name='csrf-token']").prop('content');
            const formData = new FormData();
            formData.append("sku",sku);
            formData.append("_token",_token);
            $.ajax({
                url: "{{ route('inventory_adjustment.getSKUItemDetails') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function () {
                    $("#list-table-modal-AddSKU-ItemDetails tbody").html("");
                    $("#list-table-modal-AddSKU-ItemDetails tbody").html("<tr><td colspan='14'>Loading</td></tr>");
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
                    reject("error get_SKU_Item_Details");
                    return;
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
                        reject("error get_SKU_Item_Details");
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
                        reject("error get_SKU_Item_Details");
                        return;
                    }

                    if("data" in response){
                        if(response.data.length > 0 ){
                            let html_modal_add_sku_item_details = "";
                            response.data.forEach((element, index) => {
                                const sku = (element.sku != null) ? element.sku : "";
                                const part_name = (element.part_name != null) ? element.part_name : "";
                                const batch_no = (element.batch_no != null) ? element.batch_no : "";
                                const serial_no = (element.serial_no != null) ? element.serial_no : "";
                                const imei = (element.imei != null) ? element.imei : "";
                                const part_no = (element.part_no != null) ? element.part_no : "";
                                const color = (element.color != null) ? element.color : "";
                                const size = (element.size != null) ? element.size : "";
                                const expired_date = (element.expired_date != null) ? element.expired_date : "";
                                const location_id = (element.location_id != null) ? element.location_id : "";
                                const stock_id = (element.stock_id != null) ? element.stock_id : "";
                                const qty = (element.qty != null) ? element.qty : "";
                                const uom_name = (element.uom_name != null) ? element.uom_name : "";
                                const gr_id = (element.gr_id != null) ? element.gr_id : "";
                                html_modal_add_sku_item_details += `
                                <tr id="row_modal_add_sku_item_detail_${index}">
                                    <td class="text-center text-xs">
                                        ${sku}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_sku_${index}" name="row_modal_add_sku_item_detail_sku_${index}" value="${sku}">
                                    </td>
                                    <td class="text-xs">
                                        ${part_name}
                                        <input type="hidden" class="form-control" id="row_modal_add_sku_item_detail_item_name_${index}" name="row_modal_add_sku_item_detail_item_name_${index}" value="${part_name}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${batch_no}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_batch_no_${index}" name="row_modal_add_sku_item_detail_batch_no_${index}" value="${batch_no}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${serial_no}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_serial_no_${index}" name="row_modal_add_sku_item_detail_serial_no_${index}" value="${serial_no}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${imei}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_imei_no_${index}" name="row_modal_add_sku_item_detail_imei_no_${index}" value="${imei}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${part_no}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_part_no_${index}" name="row_modal_add_sku_item_detail_part_no_${index}" value="${part_no}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${color}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_color_${index}" name="row_modal_add_sku_item_detail_color_${index}" value="${color}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${size}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_size_${index}" name="row_modal_add_sku_item_detail_size_${index}" value="${size}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${expired_date}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_expired_date_${index}" name="row_modal_add_sku_item_detail_expired_date_${index}" value="${expired_date}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${location_id}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_location_${index}" name="row_modal_add_sku_item_detail_location_${index}" value="${location_id}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${stock_id}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_stock_id_${index}" name="row_modal_add_sku_item_detail_stock_id_${index}" value="${stock_id}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${qty}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_qty_${index}" name="row_modal_add_sku_item_detail_qty_${index}" value="${qty}">
                                    </td>
                                    <td class="text-center text-xs">
                                        <input type="number" autocomplete="off" class="form-control py-0" id="row_modal_add_sku_item_detail_adjustment_qty_${index}" name="row_modal_add_sku_item_detail_adjustment_qty_${index}" onchange="check_modal_add_sku_item_detail_adjustment_qty('${index}')" value="">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${uom_name}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_uom_${index}" name="row_modal_add_sku_item_detail_uom_${index}" value="${uom_name}">
                                    </td>
                                    <td class="text-center text-xs">
                                        ${gr_id}
                                        <input type="hidden" id="row_modal_add_sku_item_detail_gr_id_${index}" name="row_modal_add_sku_item_detail_gr_id_${index}" value="${gr_id}">
                                    </td>
                                </tr>`;
                            });

                            $("#list-table-modal-AddSKU-ItemDetails tbody").html(html_modal_add_sku_item_details);
                        }else{
                            $("#list-table-modal-AddSKU-ItemDetails tbody").html("<tr><td colspan='13'>No Data</td></tr>");
                        }
                    }

                    resolve(true);
                    return;
                },
            });

        });
        
    }
    /* special function end */

    $("#btn_search_adjustment_type").on("click",function () {
        $("#modal-AdjusmentType").modal('show');
        $("#list-datatable-modal-AdjusmentType").DataTable().destroy();
        $("#list-datatable-modal-AdjusmentType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('inventory_adjustment.datatables_m_wh_adjustment_type') }}",
            columns:[
                {data: 'adjustment_code', searchable: true, className: 'text-xs'},
                {data: 'adjustment_type', searchable: true, className: 'text-xs'},
            ],
        });
    });

    $("#list-datatable-modal-AdjusmentType > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const adjustment_code = $($(dom_tr).children("td")[0]).text();
        const adjustment_type = $($(dom_tr).children("td")[1]).text(); 

        $("#adjustment_code").val(adjustment_code);
        $("#adjustment_type").val(adjustment_type);

        $("#modal-AdjusmentType").modal('hide');
    });

    $("#btn_add_row_table_item_detail").on("click",async function () {
        try {
            await get_SKU_Item_Details("");
            // console.log(test);
            $("#modal-AddSKU-ItemDetails").modal("show");   
        } catch (error) {
            // console.log(error);
        }
        
    });

    $("#search_input_modal-AddSKU-ItemDetails").on("keyup",async function () {
        try {
            const search_sku = $(this).val();
            await get_SKU_Item_Details(search_sku);
            // console.log(test);
            $("#modal-AddSKU-ItemDetails").modal("show");   
        } catch (error) {
            // console.log(error);
        }
        
    });

    $("#btn_choose").on("click",function () {
        let html_table_item_detail = "";
        $("#list-table-modal-AddSKU-ItemDetails tbody tr").each(function () {
            const current_row = $(this).prop("id").replace("row_modal_add_sku_item_detail_","");
            const row_modal_add_sku_item_detail_sku = $(`#row_modal_add_sku_item_detail_sku_${current_row}`).val();
            const row_modal_add_sku_item_detail_item_name = $(`#row_modal_add_sku_item_detail_item_name_${current_row}`).val();
            const row_modal_add_sku_item_detail_batch_no = $(`#row_modal_add_sku_item_detail_batch_no_${current_row}`).val();
            const row_modal_add_sku_item_detail_serial_no = $(`#row_modal_add_sku_item_detail_serial_no_${current_row}`).val();
            const row_modal_add_sku_item_detail_imei_no = $(`#row_modal_add_sku_item_detail_imei_no_${current_row}`).val();
            const row_modal_add_sku_item_detail_part_no = $(`#row_modal_add_sku_item_detail_part_no_${current_row}`).val();
            const row_modal_add_sku_item_detail_color = $(`#row_modal_add_sku_item_detail_color_${current_row}`).val();
            const row_modal_add_sku_item_detail_size = $(`#row_modal_add_sku_item_detail_size_${current_row}`).val();
            const row_modal_add_sku_item_detail_expired_date = $(`#row_modal_add_sku_item_detail_expired_date_${current_row}`).val();
            const row_modal_add_sku_item_detail_location = $(`#row_modal_add_sku_item_detail_location_${current_row}`).val();
            const row_modal_add_sku_item_detail_stock_id = $(`#row_modal_add_sku_item_detail_stock_id_${current_row}`).val();
            const row_modal_add_sku_item_detail_qty = $(`#row_modal_add_sku_item_detail_qty_${current_row}`).val();
            const row_modal_add_sku_item_detail_adjustment_qty = $(`#row_modal_add_sku_item_detail_adjustment_qty_${current_row}`).val();
            const row_modal_add_sku_item_detail_uom = $(`#row_modal_add_sku_item_detail_uom_${current_row}`).val();
            const row_modal_add_sku_item_detail_gr_id = $(`#row_modal_add_sku_item_detail_gr_id_${current_row}`).val();
            
            if(row_modal_add_sku_item_detail_adjustment_qty != "" && row_modal_add_sku_item_detail_adjustment_qty != 0){
                row_item_detail++;
                html_table_item_detail += `
                <tr id="row_item_detail_${row_item_detail}">
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_sku[]' id='item_detail_sku_${row_item_detail}' value='${row_modal_add_sku_item_detail_sku}' readonly>
                        <div id="validation_item_detail_sku_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_item_name[]' id='item_detail_item_name_${row_item_detail}' value='${row_modal_add_sku_item_detail_item_name}' readonly>
                        <div id="validation_item_detail_item_name_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_batch_no[]' id='item_detail_batch_no_${row_item_detail}' value='${row_modal_add_sku_item_detail_batch_no}' readonly>
                        <div id="validation_item_detail_batch_no_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_serial_no[]' id='item_detail_serial_no_${row_item_detail}' value='${row_modal_add_sku_item_detail_serial_no}' readonly>
                        <div id="validation_item_detail_serial_no_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_imei_no[]' id='item_detail_imei_no_${row_item_detail}' value='${row_modal_add_sku_item_detail_imei_no}' readonly>
                        <div id="validation_item_detail_imei_no_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_part_no[]' id='item_detail_part_no_${row_item_detail}' value='${row_modal_add_sku_item_detail_part_no}' readonly>
                        <div id="validation_item_detail_part_no_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_color[]' id='item_detail_color_${row_item_detail}' value='${row_modal_add_sku_item_detail_color}' readonly>
                        <div id="validation_item_detail_color_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_size[]' id='item_detail_size_${row_item_detail}' value='${row_modal_add_sku_item_detail_size}' readonly>
                        <div id="validation_item_detail_size_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_expired_date[]' id='item_detail_expired_date_${row_item_detail}' value='${row_modal_add_sku_item_detail_expired_date}' readonly>
                        <div id="validation_item_detail_expired_date_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_location[]' id='item_detail_location_${row_item_detail}' value='${row_modal_add_sku_item_detail_location}' readonly>
                        <div id="validation_item_detail_location_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_stock_id[]' id='item_detail_stock_id_${row_item_detail}' value='${row_modal_add_sku_item_detail_stock_id}' readonly>
                        <div id="validation_item_detail_stock_id_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_adjustment_qty[]' id='item_detail_adjustment_qty_${row_item_detail}' value='${row_modal_add_sku_item_detail_adjustment_qty}' readonly>
                        <div id="validation_item_detail_adjustment_qty_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_final_qty[]' id='item_detail_final_qty_${row_item_detail}' value='' readonly>
                        <div id="validation_item_detail_final_qty_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_uom[]' id='item_detail_uom_${row_item_detail}' value='${row_modal_add_sku_item_detail_uom}' readonly>
                        <div id="validation_item_detail_uom_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='item_detail_gr_id[]' id='item_detail_gr_id_${row_item_detail}' value='${row_modal_add_sku_item_detail_gr_id}' readonly>
                        <div id="validation_item_detail_gr_id_${row_item_detail}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <button type='button' class='btn btn-primary text-xs py-1 mb-0' id='btn_delete_item_detail_${row_item_detail}' name='btn_delete_item_detail_${row_item_detail}' onclick='deleteRowItemDetail("${row_item_detail}")'>Delete</button>
                    </td>
                </tr>`;
            }
        });

        if(html_table_item_detail != ""){
            $("#table-item-detail tbody").append(html_table_item_detail);
        }

        $("#modal-AddSKU-ItemDetails").modal("hide"); 
    });

    $("#form-save-inventory-adjustment").on("submit",function (e) {
        e.preventDefault();

        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = $("input[name='_method']").val();
        const adjustment_code = $("#adjustment_code").val();
        const adjustment_type = $("#adjustment_type").val();
        const reason = $("#reason").val();
        
        const arr_item_detail_sku = [];
        $("input[name^='item_detail_sku']").each(function () {
            arr_item_detail_sku.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_item_name = [];
        $("input[name^='item_detail_item_name']").each(function () {
            arr_item_detail_item_name.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_batch_no = [];
        $("input[name^='item_detail_batch_no']").each(function () {
            arr_item_detail_batch_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_serial_no = [];
        $("input[name^='item_detail_serial_no']").each(function () {
            arr_item_detail_serial_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_imei_no = [];
        $("input[name^='item_detail_imei_no']").each(function () {
            arr_item_detail_imei_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_part_no = [];
        $("input[name^='item_detail_part_no']").each(function () {
            arr_item_detail_part_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_color = [];
        $("input[name^='item_detail_color']").each(function () {
            arr_item_detail_color.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_size = [];
        $("input[name^='item_detail_size']").each(function () {
            arr_item_detail_size.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_expired_date = [];
        $("input[name^='item_detail_expired_date']").each(function () {
            arr_item_detail_expired_date.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_location = [];
        $("input[name^='item_detail_location']").each(function () {
            arr_item_detail_location.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_stock_id = [];
        $("input[name^='item_detail_stock_id']").each(function () {
            arr_item_detail_stock_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_adjustment_qty = [];
        $("input[name^='item_detail_adjustment_qty']").each(function () {
            arr_item_detail_adjustment_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_final_qty = [];
        $("input[name^='item_detail_final_qty']").each(function () {
            arr_item_detail_final_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_uom = [];
        $("input[name^='item_detail_uom']").each(function () {
            arr_item_detail_uom.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_detail_gr_id = [];
        $("input[name^='item_detail_gr_id']").each(function () {
            arr_item_detail_gr_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });


        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("adjustment_code",adjustment_code);
        formData.append("adjustment_type",adjustment_type);
        formData.append("reason",reason);
        
        formData.append("arr_item_detail_sku",JSON.stringify(arr_item_detail_sku));
        formData.append("arr_item_detail_item_name",JSON.stringify(arr_item_detail_item_name));
        formData.append("arr_item_detail_batch_no",JSON.stringify(arr_item_detail_batch_no));
        formData.append("arr_item_detail_serial_no",JSON.stringify(arr_item_detail_serial_no));
        formData.append("arr_item_detail_imei_no",JSON.stringify(arr_item_detail_imei_no));
        formData.append("arr_item_detail_part_no",JSON.stringify(arr_item_detail_part_no));
        formData.append("arr_item_detail_color",JSON.stringify(arr_item_detail_color));
        formData.append("arr_item_detail_size",JSON.stringify(arr_item_detail_size));
        formData.append("arr_item_detail_expired_date",JSON.stringify(arr_item_detail_expired_date));
        formData.append("arr_item_detail_location",JSON.stringify(arr_item_detail_location));
        formData.append("arr_item_detail_stock_id",JSON.stringify(arr_item_detail_stock_id));
        formData.append("arr_item_detail_adjustment_qty",JSON.stringify(arr_item_detail_adjustment_qty));
        formData.append("arr_item_detail_final_qty",JSON.stringify(arr_item_detail_final_qty));
        formData.append("arr_item_detail_uom",JSON.stringify(arr_item_detail_uom));
        formData.append("arr_item_detail_gr_id",JSON.stringify(arr_item_detail_gr_id));
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
            
                $("#adjustment_type").removeClass('is-invalid');
                $("#validation_adjustment_type").html('');

                $("input[name^='item_detail_sku']").removeClass('is-invalid');
                $("[id^='validation_item_detail_sku']").html('');
                $("input[name^='item_detail_item_name']").removeClass('is-invalid');
                $("[id^='validation_item_detail_item_name']").html('');
                $("input[name^='item_detail_batch_no']").removeClass('is-invalid');
                $("[id^='validation_item_detail_batch_no']").html('');
                $("input[name^='item_detail_serial_no']").removeClass('is-invalid');
                $("[id^='validation_item_detail_serial_no']").html('');
                $("input[name^='item_detail_imei_no']").removeClass('is-invalid');
                $("[id^='validation_item_detail_imei_no']").html('');
                $("input[name^='item_detail_part_no']").removeClass('is-invalid');
                $("[id^='validation_item_detail_part_no']").html('');
                $("input[name^='item_detail_color']").removeClass('is-invalid');
                $("[id^='validation_item_detail_color']").html('');
                $("input[name^='item_detail_size']").removeClass('is-invalid');
                $("[id^='validation_item_detail_size']").html('');
                $("input[name^='item_detail_expired_date']").removeClass('is-invalid');
                $("[id^='validation_item_detail_expired_date']").html('');
                $("input[name^='item_detail_location']").removeClass('is-invalid');
                $("[id^='validation_item_detail_location']").html('');
                $("input[name^='item_detail_stock_id']").removeClass('is-invalid');
                $("[id^='validation_item_detail_stock_id']").html('');
                $("input[name^='item_detail_adjustment_qty']").removeClass('is-invalid');
                $("[id^='validation_item_detail_adjustment_qty']").html('');
                $("input[name^='item_detail_final_qty']").removeClass('is-invalid');
                $("[id^='validation_item_detail_final_qty']").html('');
                $("input[name^='item_detail_uom']").removeClass('is-invalid');
                $("[id^='validation_item_detail_uom']").html('');
                $("input[name^='item_detail_gr_id']").removeClass('is-invalid');
                $("[id^='validation_item_detail_gr_id']").html('');
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
                window.location = "{{ route('inventory_adjustment.index') }}";
                return;

            },
        });
        
    });
});
</script>
@endsection
