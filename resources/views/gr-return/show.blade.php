@extends('layout.app')

@section('title')
GR Return
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
                        <h5 class="me-auto">GR Return - Show</h5>
                        <a href="{{route('gr_return.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1">List</button>
                        </a>
                        @if (in_array(@$data["current_data_header"][0]->status_id, ["RRR",] ))
                        <a href="{{route('gr_return.printGRN',['id' => @$data["current_data_header"][0]->gr_return_id,])}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1">Print GRN</button>
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
                                                <label for="gr_return_id" class="form-label text-xs">GR Return Id</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="gr_return_id" name="gr_return_id" value="{{ @$data["current_data_header"][0]->gr_return_id }}" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_gr_return_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="gr_return_date" class="form-label text-xs">Return Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control py-0" id="gr_return_date" name="gr_return_date" value="{{ @$data["current_data_header"][0]->gr_return_date }}" readonly>
                                                <div class="invalid-feedback text-xs" id="validation_gr_return_date"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="return_no" class="form-label text-xs">Return No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="return_no" name="return_no" value="{{ @$data["current_data_header"][0]->return_no }}" readonly>
                                                <div id="validation_return_no" class="invalid-feedback text-xs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_name" class="form-label text-xs">Client Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ @$data["current_data_header"][0]->client_name }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="reference_no" name="reference_no" value="{{ @$data["current_data_header"][0]->reference_no }}" readonly>
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
                                                            <th class="text-xs text-center">UoM Name</th>
                                                            <th class="text-xs text-center">Classification Name</th>
                                                            <th class="text-xs text-center">Stock Type</th>
                                                            <th class="text-xs text-center">Item Reason</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (isset($data["current_data_detail"]) && count($data["current_data_detail"]) > 0)
                                                        @php
                                                            $row_Table_Item_Detail = 0;
                                                        @endphp
                                                        @foreach ($data["current_data_detail"] as $detail)
                                                        @php
                                                            $row_Table_Item_Detail++;
                                                        @endphp
                                                        <tr id='table_item_detail_{{ $row_Table_Item_Detail }}'>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_{{ $row_Table_Item_Detail }}' value="{{ @$detail->sku }}" readonly>
                                                                <div id="validation_sku_no_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_{{ $row_Table_Item_Detail }}' value="{{ @$detail->item_name }}" readonly>
                                                                <div id="validation_item_name_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_{{ $row_Table_Item_Detail }}' value="{{ @$detail->batch_no }}" readonly>
                                                                <div id="validation_batch_no_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_{{ $row_Table_Item_Detail }}' value="{{ @$detail->serial_no }}" readonly>
                                                                <div id="validation_serial_no_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='expired_date[]' id='expired_date_{{ $row_Table_Item_Detail }}' value="{{ @$detail->expired_date }}" readonly>
                                                                <div id="validation_expired_date_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='part_no[]' id='part_no_{{ $row_Table_Item_Detail }}' value="{{ @$detail->part_no }}" readonly>
                                                                <div id="validation_part_no_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='imei_no[]' id='imei_no_{{ $row_Table_Item_Detail }}' value="{{ @$detail->imei }}" readonly>
                                                                <div id="validation_imei_no_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='color[]' id='color_{{ $row_Table_Item_Detail }}' value="{{ @$detail->color }}" readonly>
                                                                <div id="validation_color_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='number' class='form-control py-0' name='qty[]' id='qty_{{ $row_Table_Item_Detail }}' value="{{ @$detail->qty }}" readonly>
                                                                <div id="validation_qty_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='uom[]' id='uom_{{ $row_Table_Item_Detail }}' value="{{ @$detail->uom_name }}" readonly>
                                                                <div id="validation_uom_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='hidden' name='classification_id[]' id='classification_id_{{ $row_Table_Item_Detail }}' value="{{ @$detail->classification_id }}">
                                                                <input type='text' class='form-control py-0' name='classification_name[]' id='classification_name_{{ $row_Table_Item_Detail }}' value="{{ @$detail->classification_name }}"  readonly>
                                                                <div id="validation_classification_name_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='hidden' name='stock_id[]' id='stock_id_{{ $row_Table_Item_Detail }}' value="{{ @$detail->stock_id }}">
                                                                <input type='text' class='form-control py-0' name='stock_type[]' id='stock_type_{{ $row_Table_Item_Detail }}' value="{{ @$detail->stock_type }}" readonly>
                                                                <div id="validation_stock_type_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='item_reason[]' id='item_reason_{{ $row_Table_Item_Detail }}' value="{{ @$detail->item_reason }}" readonly>
                                                                <div id="validation_item_reason_{{ $row_Table_Item_Detail }}" class="invalid-feedback text-xs"></div>
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
                                <div class="tab-pane" id="page-tab--reason">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2">
                                            <textarea class="form-control py-0" name="reason" id="reason" cols="30" rows="10" readonly>{{ @$data["current_data_header"][0]->reason }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex">
                            @if (in_array(@$data["current_data_header"][0]->status_id, ["ORR",] ))
                            <button type="button" class="btn btn-primary mb-0 py-1" id="btn_confirm">Confirm</button>
                            @endif
                            @if (in_array(@$data["current_data_header"][0]->status_id, ["RRR",] ))
                            <a href="{{ route('gr_return.movement_location',['id' => @$data["current_data_header"][0]->gr_return_id,]) }}" class="text-decoration-none me-2">
                                <button type="button" class="btn btn-primary mb-0 py-1">Movement Location</button>
                            </a>
                            <button type="button" class="btn btn-primary mb-0 py-1 ms-2" id="btn_confirm_putaway" name="btn_confirm_putaway">Confirm Putaway</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Confirm" tabindex="-1" aria-labelledby="modal-ConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ConfirmLabel">Confirm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('gr_return.confirm' , [ 'id' => @$data["current_data_header"][0]->gr_return_id ]) }}" id="form-confirm">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label text-xs">Are you sure this GR Return is correct ? </label>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary mb-0 py-1">Yes</button>
                                    <button type="button" class="btn btn-primary mb-0 py-1" data-bs-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $("#dropdown_toggle_inbound").prop('aria-expanded', true);
        $("#dropdown_toggle_inbound").addClass('active');
        $("#dropdown_inbound").addClass('show');
        $("#logo_inbound").addClass("d-none");
        $("#logo_white_inbound").removeClass("d-none");
        $("#li_gr_return").addClass("active");
        $("#a_gr_return").addClass("active");

        $("#btn_confirm").on("click",function () {
            $("#modal-Confirm").modal("show");
        });

        $("#form-confirm").on("submit",function (e) {
            e.preventDefault();
            const url = $(this).prop('action');
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
                    });
                    
                    window.location = "{{ route('gr_return.show',['id' => @$data['current_data_header'][0]->gr_return_id,]) }}";
                    return;

                },
            });
        });

        $("#btn_confirm_putaway").on("click",function () {
            const confirmed = confirm("Are you sure this data is already correct ?");
            
            if(!confirmed){
                return;
            }

            const url = "{{ route('gr_return.confirmPutaway', [ 'id'=> $data['current_data_header'][0]->gr_return_id ]) }}";
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
                    });
                    window.location = "{{ route('gr_return.index') }}";
                    return;

                },
            });
        });
    });
</script>
@endsection
