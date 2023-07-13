{{-- menu ini show tapi bisa ngedit yang seharus nya tidak begitu, tapi instruksi dari mas mugna minta nya begini. --}}
@extends('layout.app')

@section("title")
Picking
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
                        <h5 class="me-auto">Picking - Show</h5>
                        <a href="{{ route('picking.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0">List</button>
                        </a>
                        @if ($data["pick_data"][0]->status_id == "RPO")
                        <span class="me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" name="btn_cancel" id="btn_cancel" >Cancel</button>
                        </span>
                        @endif
                        <a href="{{ route('picking.viewPDF' , [ 'id' => $data["pick_data"][0]->outbound_id ]) }}" target="_blank" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0">Print</button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('picking.updatePicking' , [ 'id' => $data["pick_data"][0]->outbound_id ]) }}" id="form-process-update-picking">
                    <div class="col-sm-12 mb-2">
                        <div class="card border-0">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="outbound_id" class="form-label text-xs">Outbound ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="outbound_id" name="outbound_id" value="{{ @$data["pick_data"][0]->outbound_id }}" readonly>
                                                <div class="invalid-feedback" id="validation_outbound_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="supplier_name" class="form-label text-xs">Supplier Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ @$data["pick_data"][0]->supplier_name }}" readonly>
                                                <div class="invalid-feedback" id="validation_supplier_name"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="reference_no" class="form-label text-xs">Reference No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="reference_no" name="reference_no" value="{{ @$data["pick_data"][0]->reference_no }}" readonly>
                                                <div class="invalid-feedback" id="validation_reference_no"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="supplier_address" name="supplier_address" value="{{ @$data["pick_data"][0]->supplier_address }}" readonly>
                                                <div class="invalid-feedback" id="validation_supplier_address"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="receipt_no" class="form-label text-xs">Receipt No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="receipt_no" name="receipt_no" value="{{ @$data["pick_data"][0]->receipt_no }}" readonly>
                                                <div class="invalid-feedback" id="validation_receipt_no"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="{{ @$data["pick_data"][0]->plan_delivery_date }}" readonly>
                                                <div class="invalid-feedback" id="validation_plan_delivery_date"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="order_type" class="form-label text-xs">Order Type</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="order_type" name="order_type" value="{{ @$data["pick_data"][0]->order_type }}" readonly>
                                                <div class="invalid-feedback" id="validation_order_type"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="checker" class="form-label text-xs">Checker</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="checker" name="checker" value="{{ @$data["pick_data"][0]->checker }}" readonly>
                                                <div class="invalid-feedback" id="validation_checker"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                @if ($data["pick_data"][0]->status_id == "RPO")
                                                <button type="button" class="btn btn-primary py-1 rounded mb-0" name="btn_search_checker" id="btn_search_checker"><i class="bi bi-search"></i></button>
                                                @endif
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
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--quantity-details">Quantity Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--location-details">Location Details</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="table-item-detail" style="min-width: calc(2.5 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">SKU No</th>
                                                            <th class="text-center">Item Name</th>
                                                            <th class="text-center">Serial No</th>
                                                            <th class="text-center">IMEI</th>
                                                            <th class="text-center">Part No</th>
                                                            <th class="text-center">Color</th>
                                                            <th class="text-center">Size</th>
                                                            <th class="text-center">Qty Allocated</th>
                                                            <th class="text-center">UOM</th>
                                                            <th class="text-center">Classification</th>
                                                            <th class="text-center">Location</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $row_pick_data_item_details = 1;
                                                        @endphp
                                                        @foreach ($data["pick_data"] as $key_pick_data => $value_pick_data )
                                                        <tr id='row_table_item_detail_{{ $row_pick_data_item_details }}'>
                                                            <td>
                                                                <div class="input-group">                               
                                                                    <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->sku }}" readonly>
                                                                    <div id="validation_sku_no_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->item_name }}" readonly>
                                                                <div id="validation_item_name_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->serial_no }}" readonly>
                                                                <div id="validation_serial_no_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='imei_no[]' id='imei_no_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->imei }}" readonly>
                                                                <div id="validation_imei_no_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='part_no[]' id='part_no_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->part_no }}" readonly>
                                                                <div id="validation_part_no_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='color[]' id='color_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->color }}" readonly>
                                                                <div id="validation_color_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='size[]' id='size_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->size }}" readonly>
                                                                <div id="validation_size_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='number' class='form-control py-0' name='qty_allocated[]' id='qty_allocated_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->qty_allocated }}" readonly>
                                                                <div id="validation_qty_allocated_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">  
                                                                    <input type='text' class='form-control py-0' name='uom[]' id='uom_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->uom }}" readonly>
                                                                    <div id="validation_uom_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group"> 
                                                                    {{-- <input type='hidden' name='id_classification[]' id='id_classification_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->item_classification_id }}"> --}}
                                                                    <input type='text' class='form-control py-0' name='classification[]' id='classification_{{ $row_pick_data_item_details }}' value="{{ $value_pick_data->classification_name }}" readonly>
                                                                    <div id="validation_classification_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group"> 
                                                                    <input type='text' class='form-control py-0' name='display_location[]' id='display_location_{{ $row_pick_data_item_details }}' value="" readonly>
                                                                    <button type="button" class="btn btn-primary py-1 mb-0 rounded" onclick="displayFormLocationDetails('{{ $row_pick_data_item_details }}')">Location</button>
                                                                    <div id="validation_display_location_{{ $row_pick_data_item_details }}" class="invalid-feedback"></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $row_pick_data_item_details++;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--notes">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <textarea name="remarks" id="remarks" rows="10" class="form-control py-0" readonly>{{ @$data["pick_data"][0]->notes }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--quantity-details">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-quantity-details" style="width: calc(2 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Batch No</th>
                                                            <th class="text-center">SKU No</th>
                                                            <th class="text-center">Part Name</th>
                                                            <th class="text-center">Available Qty</th>
                                                            <th class="text-center">Expired Date</th>
                                                            <th class="text-center">GR ID</th>
                                                            <th class="text-center">Allocated Qty</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $row_pick_quantity_details = 0;
                                                        @endphp
                                                        @foreach ($data["pick_quantity_details_data"] as $key_pick_quantity_details_data => $value_pick_quantity_details_data )
                                                        @php
                                                            $row_pick_quantity_details++;
                                                        @endphp
                                                        <tr id='row_table_quantity_details_{{ $row_pick_quantity_details }}'>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='quantity_details_batch_no[]' id='quantity_details_batch_no_{{ $row_pick_quantity_details }}' value='{{ $value_pick_quantity_details_data->batch_no }}' readonly>
                                                                <div id="validation_quantity_details_batch_no_{{ $row_pick_quantity_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='quantity_details_sku[]' id='quantity_details_sku_{{ $row_pick_quantity_details }}' value='{{ $value_pick_quantity_details_data->sku }}' readonly>
                                                                <div id="validation_quantity_details_sku_{{ $row_pick_quantity_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='quantity_details_part_name[]' id='quantity_details_part_name_{{ $row_pick_quantity_details }}' value='{{ $value_pick_quantity_details_data->part_name }}' readonly>
                                                                <div id="validation_quantity_details_part_name_{{ $row_pick_quantity_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='number' class='form-control py-0' name='quantity_details_available_qty[]' id='quantity_details_available_qty_{{ $row_pick_quantity_details }}' value='{{ $value_pick_quantity_details_data->available_qty }}' readonly>
                                                                <div id="validation_quantity_details_available_qty_{{ $row_pick_quantity_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='quantity_details_expired_date[]' id='quantity_details_expired_date_{{ $row_pick_quantity_details }}' value='{{ $value_pick_quantity_details_data->expired_date }}' readonly>
                                                                <div id="validation_quantity_details_expired_date_{{ $row_pick_quantity_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='quantity_details_gr_id[]' id='quantity_details_gr_id_{{ $row_pick_quantity_details }}' value='{{ $value_pick_quantity_details_data->gr_id }}' readonly>
                                                                <div id="validation_quantity_details_gr_id_{{ $row_pick_quantity_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='number' class='form-control py-0' name='quantity_details_allocated_qty[]' id='quantity_details_allocated_qty_{{ $row_pick_quantity_details }}' value='{{ $value_pick_quantity_details_data->allocated_qty }}' readonly>
                                                                <div id="validation_quantity_details_allocated_qty_{{ $row_pick_quantity_details }}" class="invalid-feedback"></div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--location-details">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-location-details" style="width: calc(2 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Location</th>
                                                            <th class="text-center">SKU No</th>
                                                            <th class="text-center">Item Name</th>
                                                            <th class="text-center">Serial No</th>
                                                            <th class="text-center">Batch No</th>
                                                            <th class="text-center">Expired Date</th>
                                                            <th class="text-center">Available Qty</th>
                                                            <th class="text-center">Stock Type</th>
                                                            <th class="text-center">GR ID</th>
                                                            <th class="text-center">Pick Qty</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $row_pick_location_details_data = 0;
                                                        @endphp
                                                        @foreach ($data["pick_location_details_data"] as $key_pick_location_details_data => $value_pick_location_details_data )
                                                        @php
                                                            $row_pick_location_details_data++;
                                                        @endphp
                                                        <tr id="row_table_location_details_{{ $row_pick_location_details_data }}">
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='location_details_location_id[]' id='location_details_location_id_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->location_id }}' readonly>
                                                                <div id="validation_location_details_location_id_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='location_details_sku[]' id='location_details_sku_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->sku }}' readonly>
                                                                <div id="validation_location_details_sku_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='location_details_part_name[]' id='location_details_part_name_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->item_name }}' readonly>
                                                                <div id="validation_location_details_part_name_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='location_details_serial_no[]' id='location_details_serial_no_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->serial_no }}' readonly>
                                                                <div id="validation_location_details_serial_no_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='location_details_batch_no[]' id='location_details_batch_no_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->batch_no }}' readonly>
                                                                <div id="validation_location_details_batch_no_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='location_details_expired_date[]' id='location_details_expired_date_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->expired_date }}' readonly>
                                                                <div id="validation_location_details_expired_date_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='location_details_available_qty[]' id='location_details_available_qty_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->available_qty }}' readonly>
                                                                <div id="validation_location_details_available_qty_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='location_details_stock_id[]' id='location_details_stock_id_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->stock_id }}' readonly>
                                                                <div id="validation_location_details_stock_id_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='location_details_gr_id[]' id='location_details_gr_id_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->gr_id }}' readonly>
                                                                <div id="validation_location_details_gr_id_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='number' class='form-control py-0' name='location_details_pick_qty[]' id='location_details_pick_qty_{{ $row_pick_location_details_data }}' value='{{ $value_pick_location_details_data->pick_qty }}' readonly>
                                                                <div id="validation_location_details_pick_qty_{{ $row_pick_location_details_data }}" class="invalid-feedback"></div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
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
                            <a href="{{ route('picking.viewScanPicking',[ 'id' => $data["pick_data"][0]->outbound_id ]) }}" class="text-decoration-none me-2">
                                <button type="button" class="btn btn-primary py-1 mb-0">Picking</button>
                            </a>
                            @if ($data["pick_data"][0]->status_id == "RPO")
                            <button type="button" class="me-2 btn btn-primary py-1 mb-0" id="btn_suggest_location">Suggest Location</button>
                            <button type="submit" class="ms-auto me-0 btn btn-primary py-1 mb-0">Save</button>
                            @endif
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-CancelPicking" tabindex="-1" aria-labelledby="modal-CancelPickingLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('picking.cancelPicking' , [ 'id' => $data["pick_data"][0]->outbound_id ]) }}" id="form-process-cancel-picking">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <label for="cancel_reason" class="form-label text-xs">Cancel Reason </label>
                                <textarea name="cancel_reason" id="cancel_reason" rows="5" class="form-control py-0"></textarea>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="form-label text-xs" for="last_status">Last Status</label>
                                <input type="text" class="form-control py-0" id="last_status" name="last_status" value="{{ $data["status_name"] }}" readonly>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="form-label text-xs" for="cancel_by">Cancel By</label>
                                <input type="text" class="form-control py-0" id="cancel_by" name="cancel_by" value="{{ session("username") }}" readonly>
                            </div>
                            <div class="col-sm-12 text-end">
                                <button type="submit" class="btn btn-primary py-1 mb-0">Save</button>
                                <button type="button" class="btn btn-primary py-1 mb-0" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-SearchChecker" tabindex="-1" aria-labelledby="modal-SearchCheckerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SearchChecker" >
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Fullname</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-AddLocationDetails" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modal-AddLocationDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <input type="hidden" id="target_row_add_item_details" name="target_row_add_item_details" value="">
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label for="modal_add_location_allocated_qty" class="form-label text-xs">Allocated Qty</label>
                            <input type="text" class="form-control py-0" id="modal_add_location_allocated_qty" name="modal_add_location_allocated_qty" value="" readonly>
                            <div class="invalid-feedback" id="validation_modal_add_location_allocated_qty"></div>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <table class="table " id="list-table-modal-AddLocationDetails" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Location</th>
                                        <th class="text-center">SKU No</th>
                                        <th class="text-center">Item Name</th>
                                        <th class="text-center">Serial No</th>
                                        <th class="text-center">Batch No</th>
                                        <th class="text-center">Expired Date</th>
                                        <th class="text-center">Available Qty</th>
                                        <th class="text-center">Stock Type</th>
                                        <th class="text-center">Pick Qty</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 text-end">
                            <button type="button" class="btn btn-primary py-1 mb-0" name="btn_choose" id="btn_choose">Choose</button>
                            <button type="button" class="btn btn-primary py-1 mb-0" name="btn_close" id="btn_close" data-bs-dismiss="modal">Close</button>
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
function checkAllocatedQuantityWithPickQty(row) {
    const available_qty = parseInt($(`#modal_location_details_available_qty_${row}`).val());
    const pick_qty = parseInt($(`#modal_location_details_pick_qty_${row}`).val());

    if(pick_qty > available_qty  ){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: 'Pick Qty is more than Available Qty',
            type: 'error',
            icon: 'error',
        });
        $(`#modal_location_details_pick_qty_${row}`).val("0");
        return;
    }
}

function displayFormLocationDetails(row) {
    $("#target_row_add_item_details").val(row);
    const target_sku = $(`#sku_no_${row}`).val();
    if(target_sku == "" || target_sku === undefined){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: 'SKU cannot be empty',
            type: 'error',
            icon: 'error',
        });
        return;
    }

    let sum_allocated_qty = 0;
    $("#table-item-detail tbody tr").each(function () {
        const row_table_item_detail = $(this).prop("id").replace("row_table_item_detail_","");
        const sku_no = $(`#sku_no_${row_table_item_detail}`).val();
        const qty_allocated = $(`#qty_allocated_${row_table_item_detail}`).val();
        
        if(sku_no == target_sku ){
            sum_allocated_qty += parseInt(qty_allocated);
        }
    });
    
    $('#modal_add_location_allocated_qty').val(sum_allocated_qty);


    const arr_batch_no = [];
    const arr_gr_id = [];
    $("#tabel-quantity-details tbody tr").each(function () {
        const quantity_details_current_row = $(this).prop("id").replace("row_table_quantity_details_","");
        const quantity_details_batch_no = $(`#quantity_details_batch_no_${quantity_details_current_row}`).val();
        const quantity_details_sku = $(`#quantity_details_sku_${quantity_details_current_row}`).val();
        const quantity_details_allocated_qty = $(`#quantity_details_allocated_qty_${quantity_details_current_row}`).val();
        const quantity_details_gr_id = $(`#quantity_details_gr_id_${quantity_details_current_row}`).val();
        
        if(quantity_details_sku == target_sku ){
            arr_batch_no.push(quantity_details_batch_no);
            arr_gr_id.push(quantity_details_gr_id);
        }

    });

    
    const formData = new FormData();
    const _token = $("meta[name='csrf-token']").prop('content');
    formData.append("_token",_token);
    formData.append("sku",target_sku);
    formData.append("arr_batch_no",JSON.stringify(arr_batch_no));
    formData.append("arr_gr_id",JSON.stringify(arr_gr_id));

    $.ajax({
        url: "{{ route('picking.tablesLocationDetails') }}",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function () {
            $("#list-table-modal-AddLocationDetails tbody").html("");
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
                if(!'message' in response){
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
                return
            }

            if(!'data' in response){
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

            let html = ``;
            response.data.forEach((element,index) => {
                const expired_date = (element.expired_date != null) ? element.expired_date : "";
                const serial_no = (element.serial_no != null) ? element.serial_no : "";
                html += `<tr id="modal_location_details_${index}">
                    <input type="hidden" name="modal_location_details_gr_id_${index}" id="modal_location_details_gr_id_${index}" value="${element.gr_id}">
                    <td><input type="text" class="form-control py-0" name="modal_location_details_location_id_${index}" id="modal_location_details_location_id_${index}" value="${element.location_id}" readonly></td>
                    <td><input type="text" class="form-control py-0" name="modal_location_details_sku_${index}" id="modal_location_details_sku_${index}" value="${element.sku}" readonly></td>
                    <td><input type="text" class="form-control py-0" name="modal_location_details_part_name_${index}" id="modal_location_details_part_name_${index}" value="${element.part_name}" readonly></td>
                    <td><input type="text" class="form-control py-0" name="modal_location_details_serial_no_${index}" id="modal_location_details_serial_no_${index}" value="${serial_no}" readonly></td>
                    <td><input type="text" class="form-control py-0" name="modal_location_details_batch_no_${index}" id="modal_location_details_batch_no_${index}" value="${element.batch_no}" readonly></td>
                    <td><input type="text" class="form-control py-0" name="modal_location_details_expired_date_${index}" id="modal_location_details_expired_date_${index}" value="${expired_date}" readonly></td>
                    <td><input type="text" class="form-control py-0" name="modal_location_details_available_qty_${index}" id="modal_location_details_available_qty_${index}" value="${element.available_qty}" readonly></td>
                    <td><input type="text" class="form-control py-0" name="modal_location_details_stock_id_${index}" id="modal_location_details_stock_id_${index}" value="${element.stock_id}" readonly></td>
                    
                    <td><input type="number" class="form-control py-0" name="modal_location_details_pick_qty_${index}" id="modal_location_details_pick_qty_${index}" onchange="checkAllocatedQuantityWithPickQty('${index}')" value=""></td>
                </tr>`;
            });
            $("#list-table-modal-AddLocationDetails tbody").html(html);
            $("#modal-AddLocationDetails").modal("show");

        },
    });
    
}

function cleanRowTableLocationDetailBasedOnSKU(sku) {
    if(sku == "" || sku == undefined){
        return;
    }

    $("#tabel-location-details tbody tr").each(function (index,dom) {
        const id = $(this).prop("id");
        const current_row = id.replace("row_table_location_details_","");
        const current_sku = $(`#location_details_sku_${current_row}`).val();
        if(sku == current_sku){
            $(`#row_table_location_details_${current_row}`).remove();
        }
    });
}


$(document).ready(function () {

    $("#dropdown_toggle_outbound").prop('aria-expanded',true);
    $("#dropdown_toggle_outbound").addClass('active');
    $("#dropdown_outbound").addClass('show');
    $("#li_picking").addClass("active");
    $("#a_picking").addClass("active");

    let row_location_details = 0;
    $("#btn_choose").on("click",function () {

        const row = $("#target_row_add_item_details").val();
        const target_sku = $(`#sku_no_${row}`).val();
        cleanRowTableLocationDetailBasedOnSKU(target_sku);
        const allocated_qty = $("#modal_add_location_allocated_qty").val();
        let total_pick_qty = 0;
        let html_location_details = "";
        $("#list-table-modal-AddLocationDetails tbody tr").each(function () {
            
            const row_modal_location_details = $(this).prop("id").replace("modal_location_details_","");
            const modal_location_details_location_id = $(`#modal_location_details_location_id_${row_modal_location_details}`).val();
            const modal_location_details_sku = $(`#modal_location_details_sku_${row_modal_location_details}`).val();
            const modal_location_details_part_name = $(`#modal_location_details_part_name_${row_modal_location_details}`).val();
            const modal_location_details_serial_no = $(`#modal_location_details_serial_no_${row_modal_location_details}`).val();
            const modal_location_details_batch_no = $(`#modal_location_details_batch_no_${row_modal_location_details}`).val();
            const modal_location_details_expired_date = $(`#modal_location_details_expired_date_${row_modal_location_details}`).val();
            const modal_location_details_available_qty = $(`#modal_location_details_available_qty_${row_modal_location_details}`).val();
            const modal_location_details_stock_id = $(`#modal_location_details_stock_id_${row_modal_location_details}`).val();
            const modal_location_details_gr_id = $(`#modal_location_details_gr_id_${row_modal_location_details}`).val();
            const modal_location_details_pick_qty = $(`#modal_location_details_pick_qty_${row_modal_location_details}`).val();
            if(modal_location_details_pick_qty != "" && modal_location_details_pick_qty != 0){
                row_location_details++;
                html_location_details += `
                <tr id="row_table_location_details_${row_location_details}">
                    <td>
                        <input type='text' class='form-control py-0' name='location_details_location_id[]' id='location_details_location_id_${row_location_details}' value='${modal_location_details_location_id}' readonly>
                        <div id="validation_location_details_location_id_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='location_details_sku[]' id='location_details_sku_${row_location_details}' value='${modal_location_details_sku}' readonly>
                        <div id="validation_location_details_sku_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='location_details_part_name[]' id='location_details_part_name_${row_location_details}' value='${modal_location_details_part_name}' readonly>
                        <div id="validation_location_details_part_name_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='location_details_serial_no[]' id='location_details_serial_no_${row_location_details}' value='${modal_location_details_serial_no}' readonly>
                        <div id="validation_location_details_serial_no_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='location_details_batch_no[]' id='location_details_batch_no_${row_location_details}' value='${modal_location_details_batch_no}' readonly>
                        <div id="validation_location_details_batch_no_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='location_details_expired_date[]' id='location_details_expired_date_${row_location_details}' value='${modal_location_details_expired_date}' readonly>
                        <div id="validation_location_details_expired_date_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='location_details_available_qty[]' id='location_details_available_qty_${row_location_details}' value='${modal_location_details_available_qty}' readonly>
                        <div id="validation_location_details_available_qty_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='location_details_stock_id[]' id='location_details_stock_id_${row_location_details}' value='${modal_location_details_stock_id}' readonly>
                        <div id="validation_location_details_stock_id_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='text' class='form-control py-0' name='location_details_gr_id[]' id='location_details_gr_id_${row_location_details}' value='${modal_location_details_gr_id}' readonly>
                        <div id="validation_location_details_gr_id_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type='number' class='form-control py-0' name='location_details_pick_qty[]' id='location_details_pick_qty_${row_location_details}' value='${modal_location_details_pick_qty}' readonly>
                        <div id="validation_location_details_pick_qty_${row_location_details}" class="invalid-feedback"></div>
                    </td>
                </tr>
                `;

                total_pick_qty += parseInt(modal_location_details_pick_qty);
            }
            
        });

        if(total_pick_qty > allocated_qty){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Pick Qty can't more than Allocated Qty",
                type: 'error',
                icon: 'error',
            });
            return;
        }

        if(total_pick_qty < allocated_qty){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Pick Qty can't less than Allocated Qty",
                type: 'error',
                icon: 'error',
            });
            return;
        }

        $("#tabel-location-details tbody").append(html_location_details);
        $("#modal-AddLocationDetails").modal("hide");

    });

    $("#btn_cancel").on("click",function () {
        $("#modal-CancelPicking").modal('show');
    });

    $("#form-process-cancel-picking").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        const cancel_reason = $("#cancel_reason").val();
        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("cancel_reason",cancel_reason);
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

    $("#btn_search_checker").on("click",function () {
        $("#modal-SearchChecker").modal('show');
        $("#list-datatable-modal-SearchChecker").DataTable().destroy();
        $("#list-datatable-modal-SearchChecker").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('picking.datatablesChecker') }}",
            columns:[
                {data: 'username', searchable: true,},
                {data: 'fullname', searchable: true,},
            ],
        });
    });

    $("#list-datatable-modal-SearchChecker > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }

        const username = $($(dom_tr).children("td")[0]).text(); 
        
        $("#checker").val(username);
        $("#modal-SearchChecker").modal('hide');
        
    });

    $("#btn_suggest_location").on("click",function () {
        $("#tabel-quantity-details > tbody > tr").each(function (e) {
            const current_row = $(this).prop("id").replace("row_table_quantity_details_","");
            const batch_no = $(`#quantity_details_batch_no_${current_row}`).val();
            const sku = $(`#quantity_details_sku_${current_row}`).val();
            const allocated_qty = $(`#quantity_details_allocated_qty_${current_row}`).val();
            const gr_id = $(`#quantity_details_gr_id_${current_row}`).val();
            let current_qty = parseInt(allocated_qty);
            const arr_location = [];

            const arr_batch_no = [];
            const arr_gr_id = [];

            arr_batch_no.push(batch_no);
            arr_gr_id.push(gr_id);

            const formData = new FormData();
            const _token = $("meta[name='csrf-token']").prop('content');

            formData.append("_token",_token);
            formData.append("sku",sku);
            formData.append("arr_batch_no",JSON.stringify(arr_batch_no));
            formData.append("arr_gr_id",JSON.stringify(arr_gr_id));

            $.ajax({
                url: "{{ route('picking.tablesLocationDetails') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function () {

                },
                error: function (error) {
                    console.log("something wrong");
                },
                complete: function () {

                },
                success: function (response) {
                    if(typeof response !== 'object'){
                        console.log("something wrong");
                        return;
                    }

                    if(response.err){
                        if(!'message' in response){
                            console.log("something wrong");
                            return;
                        }
                        console.log("something wrong");
                        return
                    }

                    if(!'data' in response){
                        console.log("something wrong");
                        return;
                    }

                    let html_location_details = ``;
                    response.data.forEach((element,index) => {
                        const temp_available_qty = (element.available_qty) ?  element.available_qty : "";
                        const temp_batch_no = (element.batch_no) ?  element.batch_no : "";
                        const temp_expired_date = (element.expired_date) ?  element.expired_date : "";
                        const temp_gr_id = (element.gr_id) ?  element.gr_id : "";
                        const temp_location_id = (element.location_id) ?  element.location_id : "";
                        const temp_on_hand_qty = (element.on_hand_qty) ?  element.on_hand_qty : "";
                        const temp_part_name = (element.part_name) ?  element.part_name : "";
                        const temp_serial_no = (element.serial_no) ?  element.serial_no : "";
                        const temp_sku = (element.sku) ?  element.sku : "";
                        const temp_stock_id = (element.stock_id) ?  element.stock_id : "";
                        let display_qty = 0;
                        let temp_current_qty = 0;
                        if(current_qty != 0){

                            temp_current_qty = parseInt(temp_available_qty) - current_qty;
                            if(temp_current_qty < 0){
                                display_qty = temp_available_qty;
                                current_qty = temp_current_qty * -1;
                            }else{
                                display_qty = current_qty;
                                current_qty = 0;
                            }
                            arr_location.push(temp_location_id);
                            
                            row_location_details++;
                            html_location_details += `
                            <tr id="row_table_location_details_${row_location_details}">
                                <td>
                                    <input type='text' class='form-control py-0' name='location_details_location_id[]' id='location_details_location_id_${row_location_details}' value='${temp_location_id}' readonly>
                                    <div id="validation_location_details_location_id_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='location_details_sku[]' id='location_details_sku_${row_location_details}' value='${temp_sku}' readonly>
                                    <div id="validation_location_details_sku_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='location_details_part_name[]' id='location_details_part_name_${row_location_details}' value='${temp_part_name}' readonly>
                                    <div id="validation_location_details_part_name_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='location_details_serial_no[]' id='location_details_serial_no_${row_location_details}' value='${temp_serial_no}' readonly>
                                    <div id="validation_location_details_serial_no_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='location_details_batch_no[]' id='location_details_batch_no_${row_location_details}' value='${temp_batch_no}' readonly>
                                    <div id="validation_location_details_batch_no_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='location_details_expired_date[]' id='location_details_expired_date_${row_location_details}' value='${temp_expired_date}' readonly>
                                    <div id="validation_location_details_expired_date_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='location_details_available_qty[]' id='location_details_available_qty_${row_location_details}' value='${temp_available_qty}' readonly>
                                    <div id="validation_location_details_available_qty_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='location_details_stock_id[]' id='location_details_stock_id_${row_location_details}' value='${temp_stock_id}' readonly>
                                    <div id="validation_location_details_stock_id_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='location_details_gr_id[]' id='location_details_gr_id_${row_location_details}' value='${temp_gr_id}' readonly>
                                    <div id="validation_location_details_gr_id_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='number' class='form-control py-0' name='location_details_pick_qty[]' id='location_details_pick_qty_${row_location_details}' value='${display_qty}' readonly>
                                    <div id="validation_location_details_pick_qty_${row_location_details}" class="invalid-feedback"></div>
                                </td>
                            </tr>
                            `;
                        }
                    });
                    
                    if(current_qty != 0){
                        //disni masih sisa allocated_qty nya mau di apain????  //jebakan_Suggest_location_point_2
                    }
                    
                    cleanRowTableLocationDetailBasedOnSKU(sku);

                    $("#tabel-location-details tbody").append(html_location_details);
                    let display_location = ``;
                    if(arr_location.length > 0){
                        if(0 in arr_location){
                            display_location += `${arr_location[0]},`;
                        }

                        if(1 in arr_location){
                            display_location += `${arr_location[1]},`;
                        }
                    }
                    
                    $(`#display_location_${current_row}`).val(display_location);

                },
            });
        });    
    });

    $("#form-process-update-picking").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        const checker = $("#checker").val();

        const arr_sku_no = [];
        $("input[name^='sku_no']").each(function () {
            arr_sku_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_location_id = [];
        $("input[name^='location_details_location_id']").each(function () {
            arr_location_details_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_sku = [];
        $("input[name^='location_details_sku']").each(function () {
            arr_location_details_sku.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_part_name = [];
        $("input[name^='location_details_part_name']").each(function () {
            arr_location_details_part_name.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_serial_no = [];
        $("input[name^='location_details_serial_no']").each(function () {
            arr_location_details_serial_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_batch_no = [];
        $("input[name^='location_details_batch_no']").each(function () {
            arr_location_details_batch_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_expired_date = [];
        $("input[name^='location_details_expired_date']").each(function () {
            arr_location_details_expired_date.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_available_qty = [];
        $("input[name^='location_details_available_qty']").each(function () {
            arr_location_details_available_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_stock_id = [];
        $("input[name^='location_details_stock_id']").each(function () {
            arr_location_details_stock_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_gr_id = [];
        $("input[name^='location_details_gr_id']").each(function () {
            arr_location_details_gr_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_details_pick_qty = [];
        $("input[name^='location_details_pick_qty']").each(function () {
            arr_location_details_pick_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("checker",checker);
        formData.append("arr_sku_no",JSON.stringify(arr_sku_no));
        formData.append("arr_location_details_location_id",JSON.stringify(arr_location_details_location_id));
        formData.append("arr_location_details_sku",JSON.stringify(arr_location_details_sku));
        formData.append("arr_location_details_part_name",JSON.stringify(arr_location_details_part_name));
        formData.append("arr_location_details_serial_no",JSON.stringify(arr_location_details_serial_no));
        formData.append("arr_location_details_batch_no",JSON.stringify(arr_location_details_batch_no));
        formData.append("arr_location_details_expired_date",JSON.stringify(arr_location_details_expired_date));
        formData.append("arr_location_details_available_qty",JSON.stringify(arr_location_details_available_qty));
        formData.append("arr_location_details_stock_id",JSON.stringify(arr_location_details_stock_id));
        formData.append("arr_location_details_gr_id",JSON.stringify(arr_location_details_gr_id));
        formData.append("arr_location_details_pick_qty",JSON.stringify(arr_location_details_pick_qty));
        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#checker").removeClass('is-invalid');
                $("#validation_checker").html('');

                $("input[name^='sku_no']").removeClass('is-invalid');
                $("[id^='validation_sku_no']").html('');

                $("input[name^='location_details_location_id']").removeClass('is-invalid');
                $("[id^='validation_location_details_location_id']").html('');
                $("input[name^='location_details_sku']").removeClass('is-invalid');
                $("[id^='validation_location_details_sku']").html('');
                $("input[name^='location_details_part_name']").removeClass('is-invalid');
                $("[id^='validation_location_details_part_name']").html('');
                $("input[name^='location_details_serial_no']").removeClass('is-invalid');
                $("[id^='validation_location_details_serial_no']").html('');
                $("input[name^='location_details_batch_no']").removeClass('is-invalid');
                $("[id^='validation_location_details_batch_no']").html('');
                $("input[name^='location_details_expired_date']").removeClass('is-invalid');
                $("[id^='validation_location_details_expired_date']").html('');
                $("input[name^='location_details_available_qty']").removeClass('is-invalid');
                $("[id^='validation_location_details_available_qty']").html('');
                $("input[name^='location_details_stock_id']").removeClass('is-invalid');
                $("[id^='validation_location_details_stock_id']").html('');
                $("input[name^='location_details_gr_id']").removeClass('is-invalid');
                $("[id^='validation_location_details_gr_id']").html('');
                $("input[name^='location_details_pick_qty']").removeClass('is-invalid');
                $("[id^='validation_location_details_pick_qty']").html('');
                
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
                window.location.reload();
                return;

            },
        });
    })
});
</script>
@endsection
