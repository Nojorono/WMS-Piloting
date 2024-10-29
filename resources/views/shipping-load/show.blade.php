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
                        <h5 class="me-auto">Shipping Load - View</h5>
                        <a href="{{ route('shipping_load.viewPDF',['id' => @$data["current_data_header"][0]->booking_no ]) }}" class="text-decoration-none me-2" target="_blank">
                            <button type="button" class="btn btn-primary mb-0 py-1">Print</button>
                        </a>

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
                                                <input type="text" class="form-control py-0" id="booking_no" name="booking_no" value="{{ @$data["current_data_header"][0]->booking_no }}" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_booking_no"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_name" class="form-label text-xs">Pickup Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="pickup_name" name="pickup_name" value="{{ @$data["current_data_header"][0]->pickup_name }}" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_pickup_name"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_company" class="form-label text-xs">Pickup Company</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="pickup_company" name="pickup_company" value="{{ @$data["current_data_header"][0]->pickup_company }}" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_pickup_company"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_address" class="form-label text-xs">Pickup Address</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea class="form-control py-0" id="pickup_address" name="pickup_address" cols="30" rows="5" readonly>{{ @$data["current_data_header"][0]->pickup_address }}</textarea>
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
                                                <input type="text" class="form-control py-0" id="pickup_date" name="pickup_date" value="{{ (@$data["current_data_header"][0]->pickup_datetime) ? date("Y-m-d",strtotime(@$data["current_data_header"][0]->pickup_datetime)) : "" }}" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_pickup_date"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_time" class="form-label text-xs">Pickup Time</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="pickup_time" name="pickup_time" value="{{ (@$data["current_data_header"][0]->pickup_datetime) ? date("H:i:s",strtotime(@$data["current_data_header"][0]->pickup_datetime)) : "" }}" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_pickup_time"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="phone" class="form-label text-xs">Phone</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="phone" name="phone" value="{{ @$data["current_data_header"][0]->phone }}" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_phone"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="job_no" class="form-label text-xs">Job No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="job_no" name="job_no" value="{{ @$data["current_data_header"][0]->job_no }}" readonly>
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $row_Table_Item_Detail = 0;
                                                        @endphp
                                                        @if (@$data["current_data_detail"] !== null &&  count($data["current_data_detail"]) > 0)
                                                        @foreach ($data["current_data_detail"] as $detail)
                                                        <tr id='table_item_detail_{{ $row_Table_Item_Detail }}'>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='outbound_planning_no[]' id='outbound_planning_no_{{ $row_Table_Item_Detail }}' value="{{ @$detail->outbound_planning_no }}" readonly>
                                                                <div id="validation_outbound_planning_no_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='order_type[]' id='order_type_{{ $row_Table_Item_Detail }}' value="{{ @$detail->order_type }}" readonly>
                                                                <div id="validation_order_type_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='sku[]' id='sku_{{ $row_Table_Item_Detail }}' value="{{ @$detail->sku }}" readonly>
                                                                <div id="validation_sku_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='description[]' id='description_{{ $row_Table_Item_Detail }}' value="{{ @$detail->description }}" readonly>
                                                                <div id="validation_description_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_{{ $row_Table_Item_Detail }}' value="{{ @$detail->serial_no }}" readonly>
                                                                <div id="validation_serial_no_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_{{ $row_Table_Item_Detail }}' value="{{ @$detail->batch_no }}" readonly>
                                                                <div id="validation_batch_no_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='expired_date[]' id='expired_date_{{ $row_Table_Item_Detail }}' value="{{ @$detail->expired_date }}" readonly>
                                                                <div id="validation_expired_date_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='gr_id[]' id='gr_id_{{ $row_Table_Item_Detail }}' value="{{ @$detail->gr_id }}" readonly>
                                                                <div id="validation_gr_id_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='qty[]' id='qty_{{ $row_Table_Item_Detail }}' value="{{ @$detail->qty }}" readonly>
                                                                <div id="validation_qty_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='uom[]' id='uom_{{ $row_Table_Item_Detail }}' value="{{ @$detail->uom_name }}" readonly>
                                                                <div id="validation_uom_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='classification_item[]' id='classification_item_{{ $row_Table_Item_Detail }}' value="{{ @$detail->stock_type }}" readonly>
                                                                <div id="validation_classification_item_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='awb_number[]' id='awb_number_{{ $row_Table_Item_Detail }}' value="{{ @$detail->awb }}" readonly>
                                                                <div id="validation_awb_number_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='remarks[]' id='remarks_{{ $row_Table_Item_Detail }}' value="{{ @$detail->remarks }}" readonly>
                                                                <div id="validation_remarks_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $row_Table_Item_Detail++;
                                                        @endphp
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--notes">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2">
                                            <textarea class="form-control py-0" name="reason" id="reason" cols="30" rows="10" readonly>{{ @$data["current_data_header"][0]->notes }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex">
                            @if (@$data["current_data_header"][0]->status_id == "OPS")
                            <button type="button" class="btn btn-primary mb-0 py-1" name="btn_pickup" id="btn_pickup">Pickup</button>
                            @endif
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

$(document).ready(function() {
    $("#dropdown_toggle_transportation").prop('aria-expanded',true);
    $("#dropdown_toggle_transportation").addClass('active');
    $("#dropdown_transportation").addClass('show');
    $("#logo_transportation").addClass("d-none");
    $("#logo_white_transportation").removeClass("d-none");
    $("#li_shipping_load").addClass("active");
    $("#a_shipping_load").addClass("active");

    $("#btn_pickup").on("click",function () {
      

        const url = "{{ route('shipping_load.updateShippingLoad', ['id' => @$data['current_data_header'][0]->booking_no, ]) }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);

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
                    }).then(function () {
                        window.location.href = "{{route('shipping_load.show', ['id' => @$data['current_data_header'][0]->booking_no, ])}}";
                    });
                    return;
            },
        });
    });
});
</script>
@endsection
