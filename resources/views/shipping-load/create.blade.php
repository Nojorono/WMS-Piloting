@extends('layout.app')

@section('title')
Shipping Load
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
                        <h5 class="me-auto">Shipping Load - Add</h5>
                        <a href="{{route('shipping_load.index')}}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary mb-0 py-1">List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('shipping_load.store') }}" id="form-save">
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="booking_no" class="form-label text-xs">Booking No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="booking_no" name="booking_no" value="Auto Generate" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_booking_no"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_name" class="form-label text-xs">Pickup Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="pickup_name" name="pickup_name" value="">
                                                <div class="invalid-feedback text-xs" id="validation_pickup_name"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_company" class="form-label text-xs">Pickup Company</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="pickup_company" name="pickup_company" value="">
                                                <div class="invalid-feedback text-xs" id="validation_pickup_company"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_address" class="form-label text-xs">Pickup Address</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea class="form-control py-0" id="pickup_address" name="pickup_address" cols="30" rows="5"></textarea>
                                                <div class="invalid-feedback text-xs" id="validation_pickup_address"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_date" class="form-label text-xs">Pickup Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control py-0" id="pickup_date" name="pickup_date" value="">
                                                <div class="invalid-feedback text-xs" id="validation_pickup_date"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_time" class="form-label text-xs">Pickup Time</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="time" class="form-control py-0" id="pickup_time" name="pickup_time" value="">
                                                <div class="invalid-feedback text-xs" id="validation_pickup_time"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="phone" class="form-label text-xs">Phone</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="phone" name="phone" value="">
                                                <div class="invalid-feedback text-xs" id="validation_phone"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="job_no" class="form-label text-xs">Job No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="job_no" name="job_no" value="">
                                                <div class="invalid-feedback text-xs" id="validation_job_no"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="form-label text-xs">Outbound Date</label>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <input type="date" class="form-control py-0" id="outbound_date_from" name="outbound_date_from" value="">
                                                <div class="invalid-feedback text-xs" id="validation_outbound_date_from"></div>
                                            </div>
                                            <div class="col-sm-6 mb-2">
                                                <input type="date" class="form-control py-0" id="outbound_date_to" name="outbound_date_to" value="">
                                                <div class="invalid-feedback text-xs" id="validation_outbound_date_to"></div>
                                            </div>
                                            <div class="col-sm-12 ">
                                                <button type="button" class="btn btn-primary text-xs py-1 mb-0" id="btn_search_outbound_date" name="btn_search_outbound_date">Search</button>
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
                                        <a class="nav-link text-xs" aria-current="true" data-bs-toggle="tab" href="#page-tab--notes">Notes</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content py-0">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-item-detail" style="min-width: calc(2.5 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center">Outbound Planning No</th>
                                                            <th class="text-xs text-center">Order Type</th>
                                                            <th class="text-xs text-center">SKU</th>
                                                            <th class="text-xs text-center">Description</th>
                                                            <th class="text-xs text-center">Serial No</th>
                                                            <th class="text-xs text-center">Batch No</th>
                                                            <th class="text-xs text-center">Expired Date</th>
                                                            <th class="text-xs text-center">GR ID</th>
                                                            <th class="text-xs text-center">Qty</th>
                                                            <th class="text-xs text-center">UoM</th>
                                                            <th class="text-xs text-center">Classification Item</th>
                                                            <th class="text-xs text-center">AWB Number</th>
                                                            <th class="text-xs text-center">Remarks</th>
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

@endsection

@section('javascript')
<script type="text/javascript">
let row_Table_Item_Detail = 0;
function deleteRowTableItemDetail(row) {
    const outbound_planning_no = $(`#outbound_planning_no_${row}`).val();
    $(`input[name^='outbound_planning_no'][value='${outbound_planning_no}']`).each(function () {
        const current_dom_id = $(this).prop("id").replace("outbound_planning_no_","");
        $(`#table_item_detail_${current_dom_id}`).remove();
    });
}

function addRowTableDetail(
    outbound_planning_no = "",
    order_type = "",
    sku = "",
    description = "",
    serial_no = "",
    batch_no = "",
    expired_date = "",
    gr_id = "",
    qty = "",
    uom = "",
    classification_item = ""
) {
    row_Table_Item_Detail++;
    // <td>
    //         <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_${row_Table_Item_Detail}' value="${sku}" readonly>
    //         <div id="validation_sku_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
    //     </td>
    let html_table_item_detail = `
    <tr id='table_item_detail_${row_Table_Item_Detail}'>
        <td>
            <input type='text' class='form-control py-0' name='outbound_planning_no[]' id='outbound_planning_no_${row_Table_Item_Detail}' value="${outbound_planning_no}" readonly>
            <div id="validation_outbound_planning_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='order_type[]' id='order_type_${row_Table_Item_Detail}' value="${order_type}" readonly>
            <div id="validation_order_type_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='sku[]' id='sku_${row_Table_Item_Detail}' value="${sku}" readonly>
            <div id="validation_sku_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='description[]' id='description_${row_Table_Item_Detail}' value="${description}" readonly>
            <div id="validation_description_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_${row_Table_Item_Detail}' value="${serial_no}" readonly>
            <div id="validation_serial_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_${row_Table_Item_Detail}' value="${batch_no}" readonly>
            <div id="validation_batch_no_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='expired_date[]' id='expired_date_${row_Table_Item_Detail}' value="${expired_date}" readonly>
            <div id="validation_expired_date_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='gr_id[]' id='gr_id_${row_Table_Item_Detail}' value="${gr_id}" readonly>
            <div id="validation_gr_id_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='qty[]' id='qty_${row_Table_Item_Detail}' value="${qty}" readonly>
            <div id="validation_qty_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='uom[]' id='uom_${row_Table_Item_Detail}' value="${uom}" readonly>
            <div id="validation_uom_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='classification_item[]' id='classification_item_${row_Table_Item_Detail}' value="${classification_item}" readonly>
            <div id="validation_classification_item_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='awb_number[]' id='awb_number_${row_Table_Item_Detail}' value="">
            <div id="validation_awb_number_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td>
            <input type='text' class='form-control py-0' name='remarks[]' id='remarks_${row_Table_Item_Detail}' value="">
            <div id="validation_remarks_${row_Table_Item_Detail}" class="invalid-feedback text-xs"></div>
        </td>
        <td class="text-center">
            <button type='button' class='btn btn-primary mb-0 py-1' id='btn_delete_${row_Table_Item_Detail}' name='btn_delete_${row_Table_Item_Detail}' onclick='deleteRowTableItemDetail("${row_Table_Item_Detail}")'>Delete</button>
        </td>
    </tr>
    `;

    $("#tabel-item-detail > tbody").append(html_table_item_detail)
}

$(document).ready(function() {
    $("#dropdown_toggle_transportation").prop('aria-expanded',true);
    $("#dropdown_toggle_transportation").addClass('active');
    $("#dropdown_transportation").addClass('show');
    $("#logo_transportation").addClass("d-none");
    $("#logo_white_transportation").removeClass("d-none");
    $("#li_shipping_load").addClass("active");
    $("#a_shipping_load").addClass("active");

    $("#btn_search_outbound_date").on("click",function () {
        const outbound_date_from = $("#outbound_date_from").val();
        const outbound_date_to = $("#outbound_date_to").val();
        
        if(!outbound_date_from || !outbound_date_to){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: 'Outbound Date From and Outbound Date To is required.',
                type: 'error',
                icon: 'error',
            });
            return;
        }

        const url = "{{ route('shipping_load.searchOutbound') }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("outbound_date_from",outbound_date_from);
        formData.append("outbound_date_to",outbound_date_to);
        
        $("#tabel-item-detail > tbody").html("");

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
                        const outbound_planning_no = ('outbound_planning_no' in element && element.outbound_planning_no) ? element.outbound_planning_no : "";
                        const order_type = ('order_type' in element && element.order_type) ? element.order_type : "";
                        const sku = ('sku' in element && element.sku) ? element.sku : "";
                        const description = ('description' in element && element.description) ? element.description : "";
                        const serial_no = ('serial_no' in element && element.serial_no) ? element.serial_no : "";
                        const batch_no = ('batch_no' in element && element.batch_no) ? element.batch_no : "";
                        const expired_date = ('expired_date' in element && element.expired_date) ? element.expired_date : "";
                        const gr_id = ('gr_id' in element && element.gr_id) ? element.gr_id : "";
                        const qty = ('qty' in element && element.qty) ? element.qty : "";
                        const uom_name = ('uom_name' in element && element.uom_name) ? element.uom_name : "";
                        const stock_type = ('stock_type' in element && element.stock_type) ? element.stock_type : "";
                        addRowTableDetail(
                            outbound_planning_no,
                            order_type,
                            sku,
                            description,
                            serial_no,
                            batch_no,
                            expired_date,
                            gr_id,
                            qty,
                            uom_name,
                            stock_type
                        )
                    });
                }
            },
        });
    });

    $("#form-save").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const pickup_name = $("#pickup_name").val();
        const pickup_company = $("#pickup_company").val();
        const pickup_address = $("#pickup_address").val();
        const pickup_date = $("#pickup_date").val();
        const pickup_time = $("#pickup_time").val();
        const phone = $("#phone").val();
        const job_no = $("#job_no").val();
        const outbound_date_from = $("#outbound_date_from").val();
        const outbound_date_to = $("#outbound_date_to").val();
        const reason = $("#reason").val();

        const arr_outbound_planning_no = [];
        $("input[name^='outbound_planning_no']").each(function () {
            arr_outbound_planning_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_order_type = [];
        $("input[name^='order_type']").each(function () {
            arr_order_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_sku = [];
        $("input[name^='sku']").each(function () {
            arr_sku.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_description = [];
        $("input[name^='description']").each(function () {
            arr_description.push({
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

        const arr_batch_no = [];
        $("input[name^='batch_no']").each(function () {
            arr_batch_no.push({
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

        const arr_gr_id = [];
        $("input[name^='gr_id']").each(function () {
            arr_gr_id.push({
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

        const arr_classification_item = [];
        $("input[name^='classification_item']").each(function () {
            arr_classification_item.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_awb_number = [];
        $("input[name^='awb_number']").each(function () {
            arr_awb_number.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_remarks = [];
        $("input[name^='remarks']").each(function () {
            arr_remarks.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });



        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("pickup_name",pickup_name);
        formData.append("pickup_company",pickup_company);
        formData.append("pickup_address",pickup_address);
        formData.append("pickup_date",pickup_date);
        formData.append("pickup_time",pickup_time);
        formData.append("phone",phone);
        formData.append("job_no",job_no);
        formData.append("outbound_date_from",outbound_date_from);
        formData.append("outbound_date_to",outbound_date_to);
        formData.append("reason",reason);

        formData.append("arr_outbound_planning_no",JSON.stringify(arr_outbound_planning_no));
        formData.append("arr_order_type",JSON.stringify(arr_order_type));
        formData.append("arr_sku",JSON.stringify(arr_sku));
        formData.append("arr_description",JSON.stringify(arr_description));
        formData.append("arr_serial_no",JSON.stringify(arr_serial_no));
        formData.append("arr_batch_no",JSON.stringify(arr_batch_no));
        formData.append("arr_expired_date",JSON.stringify(arr_expired_date));
        formData.append("arr_gr_id",JSON.stringify(arr_gr_id));
        formData.append("arr_qty",JSON.stringify(arr_qty));
        formData.append("arr_uom",JSON.stringify(arr_uom));
        formData.append("arr_classification_item",JSON.stringify(arr_classification_item));
        formData.append("arr_awb_number",JSON.stringify(arr_awb_number));
        formData.append("arr_remarks",JSON.stringify(arr_remarks));

        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
            
                
                $("#pickup_name").removeClass('is-invalid');
                $("#validation_pickup_name").html('');
                $("#pickup_company").removeClass('is-invalid');
                $("#validation_pickup_company").html('');
                $("#pickup_address").removeClass('is-invalid');
                $("#validation_pickup_address").html('');
                $("#pickup_date").removeClass('is-invalid');
                $("#validation_pickup_date").html('');
                $("#pickup_time").removeClass('is-invalid');
                $("#validation_pickup_time").html('');
                $("#phone").removeClass('is-invalid');
                $("#validation_phone").html('');
                $("#job_no").removeClass('is-invalid');
                $("#validation_job_no").html('');
                $("#outbound_date_from").removeClass('is-invalid');
                $("#validation_outbound_date_from").html('');
                $("#outbound_date_to").removeClass('is-invalid');
                $("#validation_outbound_date_to").html('');
                $("#reason").removeClass('is-invalid');
                $("#validation_reason").html('');
                
                $("input[name^='outbound_planning_no']").removeClass('is-invalid');
                $("[id^='validation_outbound_planning_no']").html('');
                $("input[name^='order_type']").removeClass('is-invalid');
                $("[id^='validation_order_type']").html('');
                $("input[name^='sku']").removeClass('is-invalid');
                $("[id^='validation_sku']").html('');
                $("input[name^='description']").removeClass('is-invalid');
                $("[id^='validation_description']").html('');
                $("input[name^='serial_no']").removeClass('is-invalid');
                $("[id^='validation_serial_no']").html('');
                $("input[name^='batch_no']").removeClass('is-invalid');
                $("[id^='validation_batch_no']").html('');
                $("input[name^='expired_date']").removeClass('is-invalid');
                $("[id^='validation_expired_date']").html('');
                $("input[name^='gr_id']").removeClass('is-invalid');
                $("[id^='validation_gr_id']").html('');
                $("input[name^='qty']").removeClass('is-invalid');
                $("[id^='validation_qty']").html('');
                $("input[name^='uom']").removeClass('is-invalid');
                $("[id^='validation_uom']").html('');
                $("input[name^='classification_item']").removeClass('is-invalid');
                $("[id^='validation_classification_item']").html('');
                $("input[name^='awb_number']").removeClass('is-invalid');
                $("[id^='validation_awb_number']").html('');
                $("input[name^='remarks']").removeClass('is-invalid');
                $("[id^='validation_remarks']").html('');
                
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
                
                window.location = "{{ route('shipping_load.index') }}";
                return;

            },
        });

    });
});
</script>
@endsection
