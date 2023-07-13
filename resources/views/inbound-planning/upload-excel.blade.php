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
                        <h5 class="me-auto">Inbound Planning - Upload Excel</h5>
                        <a href="{{ route('inbound_planning.index') }}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary mb-0 py-1">List</button>
                        </a>
                    </div>
                    <form action="{{route('inbound_planning.processUploadToForm')}}" id="form_upload" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-sm-12 mb-2">
                            <div class="card card--primary">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm-12 mb-3">
                                            <a href="{{ route('inbound_planning.templateExcel') }}" class="text-xs" target="_blank">Download Template</a>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <input class="form-control py-0 py-0" type="file" name="upload_file" id="upload_file">
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <button type="submit" class="btn btn-primary mb-0 py-1" name="btn_upload" id="btn_upload">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('inbound_planning.storeInboundPlanning') }}" id="form-save-excel-inbound">
                    @csrf
                    @method('POST')
                    <div class="col-sm-12 mb-2" style="display: none;" id="form-upload__header">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <label for="inbound_planning_no" class="form-label text-xs">Inbound Planning No</label>
                                        <input type="text" class="form-control py-0" id="inbound_planning_no" name="inbound_planning_no" value="Auto Generate" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_inbound_planning_no"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_id" class="form-label text-xs">Supplier ID*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="supplier_id" name="supplier_id" value="" readonly>
                                        <div id="validation_supplier_id" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="reference_no" class="form-label text-xs">Reference No*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="reference_no" name="reference_no" value="" readonly>
                                        <div id="validation_reference_no" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address" name="supplier_address" value="" readonly>
                                        <div id="validation_supplier_address" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="receipt_no" class="form-label text-xs">Receipt No*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="receipt_no" name="receipt_no" value="" readonly>
                                        <div id="validation_receipt_no" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="client_id" class="form-label text-xs">Client ID*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="client_id" name="client_id" value="" readonly>
                                        <div id="validation_client_id" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="order_type" class="form-label text-xs">Order Type*</label>
                                        <input type="hidden" id="order_id" name="order_id" value="">
                                        <input type="text" autocomplete="off" class="form-control py-0" id="order_type" name="order_type" value="" readonly>
                                        <div id="validation_order_type" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="warehouse_id" class="form-label text-xs">Warehouse ID*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_id" name="warehouse_id" value="" readonly>
                                        <div id="validation_warehouse_id" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="" readonly>
                                        <div id="validation_plan_delivery_date" class="invalid-feedback text-xs"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2" style="display: none;" id="form-upload__detail">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link text-xs active" aria-current="true" data-bs-toggle="tab" href="#page-tab--item-detail">Item Details</a>
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
                                                            <th class="text-xs text-center">Plan Qty</th>
                                                            <th class="text-xs text-center">Classification ID</th>
                                                            <th class="text-xs text-center">Classification</th>
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
                    <div class="col-sm-12 mb-2" style="display: none;" id="form-upload__action">
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

@section("javascript")
<script type="text/javascript">
$(document).ready(function () {
    $("#dropdown_toggle_inbound").prop('aria-expanded',true);
    $("#dropdown_toggle_inbound").addClass('active');
    $("#dropdown_inbound").addClass('show');
    $("#li_inbound_planning").addClass("active");
    $("#a_inbound_planning").addClass("active");
    
    $("#form-save-excel-inbound").on("submit",function (e) {
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
        const remarks = ""; // diexcel ga ada remarks

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
        formData.append("remarks",remarks);
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
                $("#client_id").removeClass('is-invalid');
                $("#validation_client_id").html('');
                $("#receipt_no").removeClass('is-invalid');
                $("#validation_receipt_no").html('');
                $("#supplier_address").removeClass('is-invalid');
                $("#validation_supplier_address").html('');
                $("#reference_no").removeClass('is-invalid');
                $("#validation_reference_no").html('');
                $("#supplier_id").removeClass('is-invalid');
                $("#validation_supplier_id").html('');

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

    $("#form_upload").on("submit",function (e) {
        e.preventDefault();
        $("#btn_upload").prop('disabled',true);
        $("#form-upload__header").hide();
        $("#form-upload__detail").hide();
        $("#form-upload__action").hide();

        const url = $(this).prop('action');
        const _method = $(this).find("input[name='_method']").val();
        $.ajax({
            url:url,
            method: _method,
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $("#upload_file").prop('disabled',true);
                
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
                $("#btn_upload").prop('disabled',false);
                
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
                    $("#upload_file").prop('disabled',false);
                    return;
                }

                if('data' in response){
                    if('inbound_planning_header' in response.data){
                        $("#supplier_id").val(response.data.inbound_planning_header.supplier_id);
                        $("#reference_no").val(response.data.inbound_planning_header.reference_no);
                        $("#supplier_address").val(response.data.inbound_planning_header.supplier_address);
                        $("#receipt_no").val(response.data.inbound_planning_header.receipt_no);
                        $("#client_id").val(response.data.inbound_planning_header.client_id);
                        $("#order_id").val(response.data.inbound_planning_header.order_id);
                        $("#order_type").val(response.data.inbound_planning_header.order_type);
                        $("#warehouse_id").val(response.data.inbound_planning_header.warehouse_id);
                        $("#plan_delivery_date").val(response.data.inbound_planning_header.plan_delivery_date);
                    }

                    if('inbound_planning_detail' in response.data){
                        if(response.data.inbound_planning_detail.length > 0) {
                            let html_detail = "";
                            let row_count = 0;
                            response.data.inbound_planning_detail.forEach(element => {
                                const sku_no = ( element.sku_no )? element.sku_no : "";
                                const item_name = ( element.item_name )? element.item_name : "";
                                const batch_no = ( element.batch_no )? element.batch_no : "";
                                const serial_no = ( element.serial_no )? element.serial_no : "";
                                const imei_no = ( element.imei_no )? element.imei_no : "";
                                const part_no = ( element.part_no )? element.part_no : "";
                                const color = ( element.color )? element.color : "";
                                const size = ( element.size )? element.size : "";
                                const expired_date = ( element.expired_date )? element.expired_date : "";
                                const qty_plan = ( element.qty_plan )? element.qty_plan : "";
                                const uom = ( element.uom )? element.uom : "";
                                const id_classification = ( element.id_classification )? element.id_classification : "";
                                const classification = ( element.classification )? element.classification : "";
                                row_count++;
                                html_detail += `
                                <tr id='table_item_detail_${row_count}'>
                                    <td>
                                        <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_${row_count}' value="${sku_no}" readonly>
                                        <div id="validation_sku_no_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='item_name[]' id='item_name_${row_count}' value="${item_name}" readonly>
                                        <div id="validation_item_name_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_${row_count}' value="${batch_no}" readonly>
                                        <div id="validation_batch_no_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_${row_count}' value="${serial_no}" readonly>
                                        <div id="validation_serial_no_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='imei_no[]' id='imei_no_${row_count}' value="${imei_no}" readonly>
                                        <div id="validation_imei_no_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='part_no[]' id='part_no_${row_count}' value="${part_no}" readonly>
                                        <div id="validation_part_no_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='color[]' id='color_${row_count}' value="${color}" readonly>
                                        <div id="validation_color_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='size[]' id='size_${row_count}' value="${size}" readonly>
                                        <div id="validation_size_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='stock_id[]' id='stock_id_${row_count}' value="" readonly>
                                        <div id="validation_stock_id_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='stock_type[]' id='stock_type_${row_count}' value="" readonly>
                                        <div id="validation_stock_type_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='date' class='form-control py-0' name='expired_date[]' id='expired_date_${row_count}' value="${expired_date}" readonly>
                                        <div id="validation_expired_date_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='uom[]' id='uom_${row_count}' value="${uom}" readonly>
                                        <div id="validation_uom_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='qty_plan[]' id='qty_plan_${row_count}' value="${qty_plan}" readonly>
                                        <div id="validation_qty_plan_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td>
                                        <input type='text' class='form-control py-0' name='id_classification[]' id='id_classification_${row_count}' value="${id_classification}" readonly>
                                        <div id="validation_id_classification_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                    <td> 
                                        <input type='text' class='form-control py-0' name='classification[]' id='classification_${row_count}' value="${classification}" readonly>
                                        <div id="validation_classification_${row_count}" class="invalid-feedback text-xs"></div>
                                    </td>
                                </tr>`;
                            });

                            $("#tabel-item-detail tbody").html("");
                            $("#tabel-item-detail tbody").html(html_detail);
                        }
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
                    type: 'success',
                    icon: 'success',
                });
                $("#form-upload__header").show();
                $("#form-upload__detail").show();
                $("#form-upload__action").show();
                $("#btn_upload").hide();
                return;

            },
        });
    });
});
</script>
@endsection
