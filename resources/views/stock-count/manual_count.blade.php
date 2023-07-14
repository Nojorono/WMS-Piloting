@extends('layout.app')

@section("title")
Stock Count
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
                        <h5 class="me-auto">Stock Count - Manual Count</h5>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('stock_count.processManualCount',[ 'id' => $data["current_data"][0]->stock_count_id , 'count_no' => $data["current_data"][0]->count_no ]) }}" id="form-save-manual-count">
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="stock_count_id" class="form-label text-xs">Stock Count ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="stock_count_id" name="stock_count_id" value="{{ @$data["current_data"][0]->stock_count_id }}" readonly>
                                                <div id="validation_stock_count_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_id" class="form-label text-xs">Warehouse ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_id" name="warehouse_id" value="{{ session("current_warehouse_id") }}" readonly>
                                                <div id="validation_warehouse_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="count_date" class="form-label text-xs">Count Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="count_date" name="count_date" value="{{ @$data["current_data"][0]->count_date }}" readonly>
                                                <div id="validation_count_date" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="remark" class="form-label text-xs">Remark</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="remark" name="remark" value="{{ @$data["current_data"][0]->remark }}" readonly>
                                                <div id="validation_remark" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_id" class="form-label text-xs">Client ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_id" name="client_id" value="{{ session("current_client_id") }}" readonly>
                                                <div id="validation_client_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="count_no" class="form-label text-xs">Count No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="count_no" name="count_no" value="{{ @$data["current_data"][0]->count_no }}" readonly>
                                                <div id="validation_count_no" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="start_counting_date" class="form-label text-xs">Start Counting Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="start_counting_date" name="start_counting_date" value="">
                                                <div id="validation_start_counting_date" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="start_counting_time" class="form-label text-xs">Start Counting Time</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="time" autocomplete="off" class="form-control py-0" id="start_counting_time" name="start_counting_time" value="">
                                                <div id="validation_start_counting_time" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="finish_counting_date" class="form-label text-xs">Finish Counting Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="finish_counting_date" name="finish_counting_date" value="">
                                                <div id="validation_finish_counting_date" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="finish_counting_time" class="form-label text-xs">Finish Counting Time</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="time" autocomplete="off" class="form-control py-0" id="finish_counting_time" name="finish_counting_time" value="">
                                                <div id="validation_finish_counting_time" class="invalid-feedback"></div>
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
                                        <a class="nav-link text-xs active" aria-current="true" data-bs-toggle="tab" href="#page-tab--item-detail">Item Details</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body py-0 tab-content">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-item-detail" style="min-width: calc(1 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-xs">Location ID</th>
                                                            <th class="text-center text-xs">SKU No</th>
                                                            <th class="text-center text-xs">Item Name</th>
                                                            <th class="text-center text-xs">Batch No</th>
                                                            <th class="text-center text-xs">Serial No</th>
                                                            <th class="text-center text-xs">Stock On Hand Qty</th>
                                                            <th class="text-center text-xs">Count Qty</th>
                                                            <th class="text-center text-xs">Discrepancy</th>
                                                            <th class="text-center text-xs">Precentage</th>
                                                            <th class="text-center text-xs">UOM</th>
                                                            <th class="text-center text-xs">Counter</th>
                                                            <th class="text-center text-xs">Count Status</th>
                                                            <th class="text-center text-xs">GR ID</th>
                                                            <th class="text-center text-xs">Stock ID</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($data["current_data_detail"]) > 0)
                                                        @foreach ($data["current_data_detail"] as $key_current_data_detail => $current_data_detail)
                                                        <tr id="row_item_detail_{{ $key_current_data_detail }}">
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->location_id }}
                                                                <input type="hidden" name="location_id[]" id="location_id_{{ $key_current_data_detail }}" value="{{ $current_data_detail->location_id }}">
                                                                <div id="validation_location_id_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->sku }}
                                                                <input type="hidden" name="sku_no[]" id="sku_no_{{ $key_current_data_detail }}" value="{{ $current_data_detail->sku }}">
                                                                <div id="validation_sku_no_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->item_name }}
                                                                <input type="hidden" name="item_name[]" id="item_name_{{ $key_current_data_detail }}" value="{{ $current_data_detail->item_name }}">
                                                                <div id="validation_item_name_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->batch_no }}
                                                                <input type="hidden" name="batch_no[]" id="batch_no_{{ $key_current_data_detail }}" value="{{ $current_data_detail->batch_no }}">
                                                                <div id="validation_batch_no_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->serial_no }}
                                                                <input type="hidden" name="serial_no[]" id="serial_no_{{ $key_current_data_detail }}" value="{{ $current_data_detail->serial_no }}">
                                                                <div id="validation_serial_no_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->on_hand_qty }}
                                                                <input type="hidden" name="stock_on_hand_qty[]" id="stock_on_hand_qty_{{ $key_current_data_detail }}" value="{{ $current_data_detail->on_hand_qty }}">
                                                                <div id="validation_stock_on_hand_qty_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" name="count_qty[]" id="count_qty_{{ $key_current_data_detail }}" value="{{ $current_data_detail->count_qty }}">
                                                                <div id="validation_count_qty_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->discrepancy }}
                                                                <input type="hidden" name="discrepancy[]" id="discrepancy_{{ $key_current_data_detail }}" value="{{ $current_data_detail->discrepancy }}">
                                                                <div id="validation_discrepancy_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->percentage }}
                                                                <input type="hidden" name="percentage[]" id="percentage_{{ $key_current_data_detail }}" value="{{ $current_data_detail->percentage }}">
                                                                <div id="validation_percentage_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->uom_name }}
                                                                <input type="hidden" name="uom[]" id="uom_{{ $key_current_data_detail }}" value="{{ $current_data_detail->uom_name }}">
                                                                <div id="validation_uom_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                <div class="input-group">  
                                                                    {{ $current_data_detail->counter }}
                                                                    <input type="hidden" name="counter[]" id="counter_{{ $key_current_data_detail }}" value="{{ $current_data_detail->counter }}">
                                                                    <div id="validation_counter_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->count_status }}
                                                                <input type="hidden" name="count_status[]" id="count_status_{{ $key_current_data_detail }}" value="{{ $current_data_detail->count_status }}">
                                                                <div id="validation_count_status_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->gr_id }}
                                                                <input type="hidden" name="gr_id[]" id="gr_id_{{ $key_current_data_detail }}" value="{{ $current_data_detail->gr_id }}">
                                                                <div id="validation_gr_id_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $current_data_detail->stock_id }}
                                                                <input type="hidden" name="stock_id[]" id="stock_id_{{ $key_current_data_detail }}" value="{{ $current_data_detail->stock_id }}">
                                                                <div id="validation_stock_id_{{ $key_current_data_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
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
                            <button type="submit" class="btn btn-primary text-xs py-1 mb-0 ms-auto me-0" >Save</button>
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
    $("#dropdown_toggle_inventory").prop('aria-expanded',true);
    $("#dropdown_toggle_inventory").addClass('active');
    $("#dropdown_inventory").addClass('show');
    $("#logo_inventory").addClass("d-none");
    $("#logo_white_inventory").removeClass("d-none");
    $("#li_stock_count").addClass("active");
    $("#a_stock_count").addClass("active");

    $("#form-save-manual-count").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        const count_date = $("#count_date").val();
        const remark = $("#remark").val();
        const count_no = $("#count_no").val();
        const start_counting_date = $("#start_counting_date").val();
        const start_counting_time = $("#start_counting_time").val();
        const finish_counting_date = $("#finish_counting_date").val();
        const finish_counting_time = $("#finish_counting_time").val();

        const arr_location_id = [];
        $("#container-item-detail input[name^='location_id']").each(function () {
            arr_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_sku_no = [];
        $("#container-item-detail input[name^='sku_no']").each(function () {
            arr_sku_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_name = [];
        $("#container-item-detail input[name^='item_name']").each(function () {
            arr_item_name.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_batch_no = [];
        $("#container-item-detail input[name^='batch_no']").each(function () {
            arr_batch_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_serial_no = [];
        $("#container-item-detail input[name^='serial_no']").each(function () {
            arr_serial_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_stock_on_hand_qty = [];
        $("#container-item-detail input[name^='stock_on_hand_qty']").each(function () {
            arr_stock_on_hand_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_count_qty = [];
        $("#container-item-detail input[name^='count_qty']").each(function () {
            arr_count_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_discrepancy = [];
        $("#container-item-detail input[name^='discrepancy']").each(function () {
            arr_discrepancy.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_percentage = [];
        $("#container-item-detail input[name^='percentage']").each(function () {
            arr_percentage.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_uom = [];
        $("#container-item-detail input[name^='uom']").each(function () {
            arr_uom.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_counter = [];
        $("#container-item-detail input[name^='counter']").each(function () {
            arr_counter.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_count_status = [];
        $("#container-item-detail input[name^='count_status']").each(function () {
            arr_count_status.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_gr_id = [];
        $("#container-item-detail input[name^='gr_id']").each(function () {
            arr_gr_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_stock_id = [];
        $("#container-item-detail input[name^='stock_id']").each(function () {
            arr_stock_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("count_date",count_date);
        formData.append("remark",remark);
        formData.append("count_no",count_no);
        formData.append("start_counting_date",start_counting_date);
        formData.append("start_counting_time",start_counting_time);
        formData.append("finish_counting_date",finish_counting_date);
        formData.append("finish_counting_time",finish_counting_time);

        formData.append("arr_location_id",JSON.stringify(arr_location_id));
        formData.append("arr_sku_no",JSON.stringify(arr_sku_no));
        formData.append("arr_item_name",JSON.stringify(arr_item_name));
        formData.append("arr_batch_no",JSON.stringify(arr_batch_no));
        formData.append("arr_serial_no",JSON.stringify(arr_serial_no));
        formData.append("arr_stock_on_hand_qty",JSON.stringify(arr_stock_on_hand_qty));
        formData.append("arr_count_qty",JSON.stringify(arr_count_qty));
        formData.append("arr_discrepancy",JSON.stringify(arr_discrepancy));
        formData.append("arr_percentage",JSON.stringify(arr_percentage));
        formData.append("arr_uom",JSON.stringify(arr_uom));
        formData.append("arr_counter",JSON.stringify(arr_counter));
        formData.append("arr_count_status",JSON.stringify(arr_count_status));
        formData.append("arr_gr_id",JSON.stringify(arr_gr_id));
        formData.append("arr_stock_id",JSON.stringify(arr_stock_id));

        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#count_date").removeClass('is-invalid');
                $("#validation_count_date").html('');
                $("#remark").removeClass('is-invalid');
                $("#validation_remark").html('');
                $("#count_no").removeClass('is-invalid');
                $("#validation_count_no").html('');
                $("#start_counting_date").removeClass('is-invalid');
                $("#validation_start_counting_date").html('');
                $("#start_counting_time").removeClass('is-invalid');
                $("#validation_start_counting_time").html('');
                $("#finish_counting_date").removeClass('is-invalid');
                $("#validation_finish_counting_date").html('');
                $("#finish_counting_time").removeClass('is-invalid');
                $("#validation_finish_counting_time").html('');

                $("#container-item-detail input[name^='location_id']").removeClass('is-invalid');
                $("[id^='validation_location_id']").html('');
                $("#container-item-detail input[name^='sku_no']").removeClass('is-invalid');
                $("[id^='validation_sku_no']").html('');
                $("#container-item-detail input[name^='item_name']").removeClass('is-invalid');
                $("[id^='validation_item_name']").html('');
                $("#container-item-detail input[name^='batch_no']").removeClass('is-invalid');
                $("[id^='validation_batch_no']").html('');
                $("#container-item-detail input[name^='serial_no']").removeClass('is-invalid');
                $("[id^='validation_serial_no']").html('');
                $("#container-item-detail input[name^='stock_on_hand_qty']").removeClass('is-invalid');
                $("[id^='validation_stock_on_hand_qty']").html('');
                $("#container-item-detail input[name^='count_qty']").removeClass('is-invalid');
                $("[id^='validation_count_qty']").html('');
                $("#container-item-detail input[name^='discrepancy']").removeClass('is-invalid');
                $("[id^='validation_discrepancy']").html('');
                $("#container-item-detail input[name^='percentage']").removeClass('is-invalid');
                $("[id^='validation_percentage']").html('');
                $("#container-item-detail input[name^='uom']").removeClass('is-invalid');
                $("[id^='validation_uom']").html('');
                $("#container-item-detail input[name^='counter']").removeClass('is-invalid');
                $("[id^='validation_counter']").html('');
                $("#container-item-detail input[name^='count_status']").removeClass('is-invalid');
                $("[id^='validation_count_status']").html('');
                $("#container-item-detail input[name^='gr_id']").removeClass('is-invalid');
                $("[id^='validation_gr_id']").html('');
                $("#container-item-detail input[name^='stock_id']").removeClass('is-invalid');
                $("[id^='validation_stock_id']").html('');
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
                window.location = "{{ route('stock_count.index') }}";
                return;

            },
        });
        
    });
});
</script>
@endsection
