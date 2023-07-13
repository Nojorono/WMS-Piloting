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
                        <a href="{{ route('inventory_adjustment.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1">List</button>
                        </a>
                        @if (in_array($data["current_data"][0]->status_id,["OOT","OIN"]))
                            <span class="text-decoration-none me-2">
                                <button type="button" class="btn btn-primary text-xs py-1" name="btn_confirm" id="btn_confirm">Confirm</button>
                            </span>
                        @endif
                        
                    </div>
                    <hr>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="adjustment_id" name="adjustment_id" value="{{ $data["current_data"][0]->adjustment_id }}" readonly>
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
                                            <div class="col-sm-12">
                                                <input type="hidden" id="adjustment_code" name="adjustment_code" value="{{ $data["current_data"][0]->adjustment_code }}" >
                                                <input type="text" autocomplete="off" class="form-control py-0" id="adjustment_type" name="adjustment_type" value="{{ $data["current_data"][0]->adjustment_type }}" readonly>
                                                <div id="validation_adjustment_type" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="reason" class="form-label text-xs">Reason</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="reason" name="reason" value="{{ $data["current_data"][0]->reason }}" readonly>
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
                                                            <th class="text-center text-xs">Movement ID</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            
                                                        @endphp
                                                        @if (count($data["current_data_detail"]) > 0)
                                                        @foreach ($data["current_data_detail"] as $current_data_detail)
                                                        <tr>
                                                            <td class="text-center text-xs">{{ $current_data_detail->sku }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->item_name }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->batch_no }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->serial_no }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->imei }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->part_no }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->color }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->size }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->expired_date }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->location_code }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->stock_id }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->adjustment_qty }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->final_qty }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->uom_name }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->gr_id }}</td>
                                                            <td class="text-center text-xs">{{ $current_data_detail->movement_id }}</td>
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
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('inventory_adjustment.confirmInventoryAdjustment' , [ 'id' => $data["current_data"][0]->adjustment_id ]) }}" id="form-process-confirm">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label text-xs">Are you sure this Inventory Adjustment is correct ? </label>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary text-xs py-1 mb-0">Yes</button>
                                    <button type="button" class="btn btn-primary text-xs py-1 mb-0" data-bs-dismiss="modal">No</button>
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

@section("javascript")
<script type="text/javascript">
$(document).ready(function () {
    $("#dropdown_toggle_inventory").prop('aria-expanded',true);
    $("#dropdown_toggle_inventory").addClass('active');
    $("#dropdown_inventory").addClass('show');
    $("#li_inventory_adjustment").addClass("active");
    $("#a_inventory_adjustment").addClass("active");

    $("#btn_confirm").on("click",function () {
        $("#modal-Confirm").modal("show");
    });

    $("#form-process-confirm").on("submit",function (e) {
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
                window.location.reload();
                return;

            },
        });
    });
});
</script>
@endsection
