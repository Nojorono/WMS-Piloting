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
                        <h5 class="me-auto">Inbound Planning - Show</h5>
                        <a href="{{ route('inbound_planning.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1">List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{route('inbound_planning.processCancel', [ 'id' => $data["current_data"]->inbound_planning_no ])}}" id="form-delete">
                    @csrf
                    @method('POST')
                    <div class="col-sm-12">
                        <div class="card border-0">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-12 mb-2">
                                        <label class="form-label text-xs">Are you sure want delete this data ? </label>
                                        <button type="submit" class="btn btn-primary mb-0 py-1">Yes</button>
                                        <a href="{{ route('inbound_planning.show',['id' => $data["current_data"]->inbound_planning_no ]) }}" class="text-decoration-none me-2">
                                            <button type="button" class="btn btn-primary mb-0 py-1">No</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="col-sm-12">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <label for="inbound_planning_no" class="form-label text-xs">Inbound Planning No</label>
                                        <input type="text" class="form-control py-0" id="inbound_planning_no" name="inbound_planning_no" value="{{ $data["current_data"]->inbound_planning_no }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_inbound_planning_no"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_name" class="form-label text-xs">Supplier Name*</label>
                                        <input type="hidden" id="supplier_id" name="supplier_id" value="{{ $data["current_data"]->supplier_id }}" readonly>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ $data["current_data"]->supplier_name }}" readonly>
                                        <div id="validation_supplier_name" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="reference_no" class="form-label text-xs">Reference No*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="reference_no" name="reference_no" value="{{ $data["current_data"]->reference_no }}" readonly>
                                        <div id="validation_reference_no" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address" name="supplier_address" value="{{ $data["current_data"]->address1 }}" readonly>
                                        <div id="validation_supplier_address" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="receipt_no" class="form-label text-xs">Receipt No*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="receipt_no" name="receipt_no" value="{{ $data["current_data"]->receipt_no }}" readonly>
                                        <div id="validation_receipt_no" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="client_name" class="form-label text-xs">Client Name*</label>
                                        <input type="hidden" id="client_id" name="client_id" value="{{ session('current_client_id') }}">
                                        <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ session('current_client_name') }}" readonly>
                                        <div id="validation_client_name" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="order_type" class="form-label text-xs">Order Type*</label>
                                        <input type="hidden" id="order_id" name="order_id" value="{{ $data["current_data"]->order_id }}" >
                                        <input type="text" autocomplete="off" class="form-control py-0" id="order_type" name="order_type" value="{{ $data["current_data"]->order_type }}" readonly>
                                        <div id="validation_order_type" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="warehouse_name" class="form-label text-xs">Warehouse Name*</label>
                                        <input type="hidden" id="warehouse_id" name="warehouse_id" value="{{ session('current_warehouse_id') }}" readonly>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="{{ session('current_warehouse_name') }}" readonly>
                                        <div id="validation_warehouse_name" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date*</label>
                                        <input type="date" autocomplete="off" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="{{ date("Y-m-d",strtotime($data["current_data"]->plan_delivery)) }}" readonly>
                                        <div id="validation_plan_delivery_date" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="" class="form-label text-xs">Task Type*</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="task_type" id="task_type_single_receive" value="Single Receive" disabled {{ (@$data["current_data"]->task_type == "Single Receive") ? 'checked' : '' }}>
                                                    <label class="form-check-label text-xs" for="task_type_single_receive">
                                                        Single Receive
                                                    </label>
                                                    <div id="validation_task_type_single_receive" class="invalid-feedback text-xs"></div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="task_type" id="task_type_partial_receive" value="Partial Receive" disabled {{ (@$data["current_data"]->task_type == "Partial Receive") ? 'checked' : '' }}>
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $current_row = 0;
                                                        @endphp
                                                        @if (count($data["current_data_detail"]) > 0)
                                                        @foreach ($data["current_data_detail"] as $current_data_detail )
                                                        @php
                                                            $current_row ++;
                                                        @endphp
                                                        <tr id='table_item_detail_{{ $current_row }}'>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_{{ $current_row }}' value="{{ $current_data_detail->SKU }}" readonly>
                                                                <div id="validation_sku_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_{{ $current_row }}' value="{{ $current_data_detail->part_name }}" readonly>
                                                                <div id="validation_item_name_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_{{ $current_row }}' value="{{ $current_data_detail->batch_no }}" readonly>
                                                                <div id="validation_batch_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_{{ $current_row }}' value="{{ $current_data_detail->serial_no }}" readonly>
                                                                <div id="validation_serial_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='imei_no[]' id='imei_no_{{ $current_row }}' value="{{ $current_data_detail->imei }}" readonly>
                                                                <div id="validation_imei_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='part_no[]' id='part_no_{{ $current_row }}' value="{{ $current_data_detail->part_no }}" readonly>
                                                                <div id="validation_part_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='color[]' id='color_{{ $current_row }}' value="{{ $current_data_detail->color }}" readonly>
                                                                <div id="validation_color_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='size[]' id='size_{{ $current_row }}' value="{{ $current_data_detail->size }}" readonly>
                                                                <div id="validation_size_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='stock_id[]' id='stock_id_{{ $current_row }}' value="{{ $current_data_detail->stock_id }}" readonly>
                                                                <div id="validation_stock_id_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='stock_type[]' id='stock_type_{{ $current_row }}' value="{{ $current_data_detail->stock_type }}" readonly>
                                                                <div id="validation_stock_type_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='date' class='form-control py-0' name='expired_date[]' id='expired_date_{{ $current_row }}' value="{{ (!empty($current_data_detail->expired_date)) ? date("Y-m-d",strtotime($current_data_detail->expired_date)) : "" }}" readonly>
                                                                <div id="validation_expired_date_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>  
                                                                <input type='text' class='form-control py-0 rounded-start' name='uom[]' id='uom_{{ $current_row }}' value="{{ $current_data_detail->uom_name }}" readonly>
                                                                <div id="validation_uom_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='qty_plan[]' id='qty_plan_{{ $current_row }}' value="{{ $current_data_detail->qty }}" readonly>
                                                                <div id="validation_qty_plan_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='id_classification[]' id='id_classification_{{ $current_row }}' value="{{ $current_data_detail->clasification_id }}" readonly>
                                                                <div id="validation_id_classification_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>  
                                                                <input type='text' class='form-control py-0 rounded-start' name='classification[]' id='classification_{{ $current_row }}' value="{{ $current_data_detail->classification_name }}" readonly>
                                                                <div id="validation_classification_{{ $current_row }}" class="invalid-feedback text-xs"></div>
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
                                {{-- <div class="tab-pane" id="page-tab--transport-and-unloading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            Transport & Unloading
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="tab-pane" id="page-tab--notes">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <textarea name="remarks" id="remarks" rows="10" class="form-control py-0" readonly>{{ $data["current_data"]->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--attachment">
                                    <div class="row ">
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0"name="file_1" id="file_1" disabled>
                                            <div id="validation_file_1" class="invalid-feedback text-xs"></div>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0"name="file_2" id="file_2" disabled>
                                            <div id="validation_file_2" class="invalid-feedback text-xs"></div>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0"name="file_3" id="file_3" disabled>
                                            <div id="validation_file_3" class="invalid-feedback text-xs"></div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
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

    $("#form-delete").on("submit",function (e) {
        e.preventDefault();
        $("#btn_delete").prop("disabled",true);
        $("#btn_no").prop("disabled",true);
        const url = $(this).prop('action');
        const _token = $("input[name='_token']").val();
        const _method = $("input[name='_method']").val();
        
        const form_data = {
            _token: _token,
            _method: _method,
        }

        $.ajax({
            url:url,
            method: _method,
            data: form_data,
            dataType: 'json',
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
                $("#btn_delete").prop("disabled",false);
                $("#btn_no").prop("disabled",false);
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
                    text: response.message,
                    type: 'success',
                    icon: 'success',
                });
                window.location = "{{route('inbound_planning.index')}}";
                return;

            },
        });
    });
});
</script>
@endsection
