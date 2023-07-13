@extends('layout.app')

@section("title")
Checking
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
                        <h5 class="me-auto">Checking - Show</h5>
                        <a href="{{ route('checking.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0">List</button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('checking.updateChecking' , [ 'id' => $data["checking_data"][0]->outbound_id ]) }}" id="form-process-update-checking"> 
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
                                                <input type="text" class="form-control py-0" id="outbound_id" name="outbound_id" value="{{ $data["checking_data"][0]->outbound_id }}" readonly>
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
                                                <input type="text" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ $data["data_header"][0]->supplier_name }}" readonly>
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
                                                <input type="text" class="form-control py-0" id="reference_no" name="reference_no" value="{{ $data["checking_data"][0]->reference_no }}" readonly>
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
                                                <input type="text" class="form-control py-0" id="supplier_address" name="supplier_address" value="{{ $data["data_header"][0]->supplier_address }}" readonly>
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
                                                <input type="text" class="form-control py-0" id="receipt_no" name="receipt_no" value="{{ $data["data_header"][0]->receipt_no }}" readonly>
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
                                                <input type="text" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="{{ $data["checking_data"][0]->plan_delivery_date }}" readonly>
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
                                                <input type="text" class="form-control py-0" id="order_type" name="order_type" value="{{ $data["data_header"][0]->order_type }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="checker" name="checker" value="{{ session("username") }}" readonly>
                                                <div class="invalid-feedback" id="validation_checker"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="bucket_id" class="form-label text-xs">Bucket ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="bucket_id" name="bucket_id" value="{{ $data["data_header"][0]->bucket_id }}" readonly>
                                                <div class="invalid-feedback" id="validation_bucket_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="carton_id" class="form-label text-xs">Carton Id</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="carton_id" name="carton_id" value="{{ !empty($data["data_header"][0]->carton_id) ? $data["data_header"][0]->carton_id : 1  }}">
                                                <div class="invalid-feedback" id="validation_carton_id"></div>
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
                                        <a class="nav-link text-xs active" data-bs-toggle="tab" href="#page-tab--item-details">Item Details</a>
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
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--transport-and-loading">Transport & loading</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--attachment">Attachment</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content">
                                <div class="tab-pane active" id="page-tab--item-details">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-location-details" style="width: calc(2 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center">SKU No</th>
                                                            <th class="text-xs text-center">Item Name</th>
                                                            <th class="text-xs text-center">Serial No</th>
                                                            <th class="text-xs text-center">Batch No</th>
                                                            <th class="text-xs text-center">IMEI</th>
                                                            <th class="text-xs text-center">Part No</th>
                                                            <th class="text-xs text-center">Color</th>
                                                            <th class="text-xs text-center">Size</th>
                                                            <th class="text-xs text-center">Qty Allocated</th>
                                                            <th class="text-xs text-center">UOM</th>
                                                            <th class="text-xs text-center">Classification Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($data["data_item_detail"]) > 0)
                                                        @foreach ($data["data_item_detail"] as $key_data_item_detail => $value_data_item_detail )
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_outbound_id[]" id="item_detail_outbound_id_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->outbound_id }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_sku[]" id="item_detail_sku_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->sku }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_item_name[]" id="item_detail_item_name_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->item_name }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_serial_no[]" id="item_detail_serial_no_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->serial_no }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_imei[]" id="item_detail_imei_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->imei }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_part_no[]" id="item_detail_part_no_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->part_no }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_color[]" id="item_detail_color_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->color }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_size[]" id="item_detail_size_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->size }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_qty_allocated[]" id="item_detail_qty_allocated_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->qty_allocated }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_uom[]" id="item_detail_uom_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->uom }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_detail_classification_name[]" id="item_detail_classification_name_{{ $key_data_item_detail }}" value="{{ $value_data_item_detail->classification_name }}" readonly>
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
                                <div class="tab-pane" id="page-tab--notes">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <textarea name="remarks" id="remarks" rows="10" class="form-control py-0" readonly>{{ @$data["data_item_detail"][0]->notes }}</textarea>
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
                                                            <th class="text-xs text-center">Batch No</th>
                                                            <th class="text-xs text-center">SKU No</th>
                                                            <th class="text-xs text-center">Part Name</th>
                                                            <th class="text-xs text-center">Available Qty</th>
                                                            <th class="text-xs text-center">Allocated Qty</th>
                                                            <th class="text-xs text-center">Expired Date</th>
                                                            <th class="text-xs text-center">GR ID</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($data["data_quantity_detail"]) > 0)
                                                        @foreach ($data["data_quantity_detail"] as $key_data_quantity_detail => $value_data_quantity_detail )
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="quantity_detail_batch_no[]" id="quantity_detail_batch_no_{{ $key_data_quantity_detail }}" value="{{ $value_data_quantity_detail->batch_no }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="quantity_detail_sku[]" id="quantity_detail_sku_{{ $key_data_quantity_detail }}" value="{{ $value_data_quantity_detail->sku }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="quantity_detail_part_name[]" id="quantity_detail_part_name_{{ $key_data_quantity_detail }}" value="{{ $value_data_quantity_detail->part_name }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="quantity_detail_available_qty[]" id="quantity_detail_available_qty_{{ $key_data_quantity_detail }}" value="{{ $value_data_quantity_detail->available_qty }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="quantity_detail_allocated_qty[]" id="quantity_detail_allocated_qty_{{ $key_data_quantity_detail }}" value="{{ $value_data_quantity_detail->allocated_qty }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="quantity_detail_expired_date[]" id="quantity_detail_expired_date_{{ $key_data_quantity_detail }}" value="{{ $value_data_quantity_detail->expired_date }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="quantity_detail_gr_id[]" id="quantity_detail_gr_id_{{ $key_data_quantity_detail }}" value="{{ $value_data_quantity_detail->gr_id }}" readonly>
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
                                <div class="tab-pane" id="page-tab--location-details">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-location-details" style="width: calc(2 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center">Location</th>
                                                            <th class="text-xs text-center">SKU No</th>
                                                            <th class="text-xs text-center">Item Name</th>
                                                            <th class="text-xs text-center">Serial No</th>
                                                            <th class="text-xs text-center">Batch No</th>
                                                            <th class="text-xs text-center">Expired Date</th>
                                                            <th class="text-xs text-center">Pick Qty</th>
                                                            <th class="text-xs text-center">Stock Type</th>
                                                            <th class="text-xs text-center">GR ID</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($data["data_location_detail"]) > 0)
                                                        @foreach ($data["data_location_detail"] as $key_data_location_detail => $value_data_location_detail )
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_detail_location_id[]" id="location_detail_location_id_{{ $key_data_location_detail }}" value="{{ $value_data_location_detail->location_id }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_detail_sku[]" id="location_detail_sku_{{ $key_data_location_detail }}" value="{{ $value_data_location_detail->sku }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_detail_part_name[]" id="location_detail_part_name_{{ $key_data_location_detail }}" value="{{ $value_data_location_detail->part_name }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_detail_serial_no[]" id="location_detail_serial_no_{{ $key_data_location_detail }}" value="{{ $value_data_location_detail->serial_no }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_detail_batch_no[]" id="location_detail_batch_no_{{ $key_data_location_detail }}" value="{{ $value_data_location_detail->batch_no }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_detail_expired_date[]" id="location_detail_expired_date_{{ $key_data_location_detail }}" value="{{ $value_data_location_detail->expired_date }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_detail_pick_qty[]" id="location_detail_pick_qty_{{ $key_data_location_detail }}" value="{{ $value_data_location_detail->pick_qty }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_detail_stock_id[]" id="location_detail_stock_id_{{ $key_data_location_detail }}" value="{{ $value_data_location_detail->stock_id }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_detail_gr_id[]" id="location_detail_gr_id_{{ $key_data_location_detail }}" value="{{ $value_data_location_detail->gr_id }}" readonly>
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
                                <div class="tab-pane" id="page-tab--transport-and-loading">
                                    <div class="row">
                                        <div class="col-sm-4 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="supervisor" class="form-label text-xs">Supervisor</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="supervisor" name="supervisor" value="{{ @$data["transport_and_loading"][0]->supervisor_id }}" readonly>
                                                        <button type="button" class="btn btn-primary py-1 rounded mb-0" id="btn_search_supervisor"><i class="bi bi-search"></i></button>
                                                        <div class="invalid-feedback" id="validation_supervisor"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="start_loading_date" class="form-label text-xs">Start Loading Date</label>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="start_loading_date" name="start_loading_date" value="{{ (!empty(@$data["transport_and_loading"][0]->start_loading)) ? date("Y-m-d",strtotime(@$data["transport_and_loading"][0]->start_loading)) : "" }}">
                                                        <div class="invalid-feedback" id="validation_start_loading_date"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="start_loading_time" class="form-label text-xs">Start Loading Time</label>
                                                    <div class="input-group">
                                                        <input type="time" autocomplete="off" class="form-control py-0 rounded-start" id="start_loading_time" name="start_loading_time" value="{{ (!empty(@$data["transport_and_loading"][0]->start_loading)) ? date("H:i",strtotime(@$data["transport_and_loading"][0]->start_loading)) : "" }}">
                                                        <div class="invalid-feedback" id="validation_start_loading_time"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="finish_loading_date" class="form-label text-xs">Finish Loading Date</label>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="finish_loading_date" name="finish_loading_date" value="{{ (!empty(@$data["transport_and_loading"][0]->finish_loading)) ? date("Y-m-d",strtotime(@$data["transport_and_loading"][0]->finish_loading)) : "" }}">
                                                        <div class="invalid-feedback" id="validation_finish_loading_date"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="finish_loading_time" class="form-label text-xs">Finish Loading Time</label>
                                                    <div class="input-group">
                                                        <input type="time" autocomplete="off" class="form-control py-0 rounded-start" id="finish_loading_time" name="finish_loading_time" value="{{ (!empty(@$data["transport_and_loading"][0]->finish_loading)) ? date("H:i",strtotime(@$data["transport_and_loading"][0]->finish_loading)) : "" }}">
                                                        <div class="invalid-feedback" id="validation_finish_loading_time"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="vehicle_no" class="form-label text-xs">Vehicle No</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="vehicle_no" name="vehicle_no" value="{{ @$data["transport_and_loading"][0]->vehicle_no }}" >
                                                        <div class="invalid-feedback" id="validation_vehicle_no"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="driver" class="form-label text-xs">Driver</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="driver" name="driver" value="{{ @$data["transport_and_loading"][0]->driver }}" >
                                                        <div class="invalid-feedback" id="validation_driver"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="vehicle_type" class="form-label text-xs">Vehicle Type</label>
                                                    <div class="input-group">
                                                        <input type="hidden" id="vehicle_id" name="vehicle_id" value="{{ @$data["transport_and_loading"][0]->vehicle_id }}">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="vehicle_type" name="vehicle_type" value="{{ @$data["transport_and_loading"][0]->vehicle_type }}" readonly>
                                                        <button type="button" class="btn btn-primary py-1 rounded mb-0" id="btn_search_vehicle"><i class="bi bi-search"></i></button>
                                                        <div class="invalid-feedback" id="validation_vehicle_type"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="transporter_name" class="form-label text-xs">Transporter_name</label>
                                                    <div class="input-group">
                                                        <input type="hidden" id="transporter" name="transporter" value="{{ @$data["transport_and_loading"][0]->transporter_id }}">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="transporter_name" name="transporter_name" value="{{ @$data["transport_and_loading"][0]->transporter_name }}" readonly>
                                                        <button type="button" class="btn btn-primary py-1 rounded mb-0" id="btn_search_transporter"><i class="bi bi-search"></i></button>
                                                        <div class="invalid-feedback" id="validation_transporter_name"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="container_no" class="form-label text-xs">Container No</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="container_no" name="container_no" value="{{ @$data["transport_and_loading"][0]->container_no }}">
                                                        <div class="invalid-feedback" id="validation_container_no"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="seal_no" class="form-label text-xs">Seal No</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="seal_no" name="seal_no" value="{{ @$data["transport_and_loading"][0]->seal_no }}">
                                                        <div class="invalid-feedback" id="validation_seal_no"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_name" class="form-label text-xs">Consignee Name</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_name" name="consignee_name" value="{{ @$data["transport_and_loading"][0]->consignee_name }}">
                                                        <div class="invalid-feedback" id="validation_consignee_name"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_address" class="form-label text-xs">Consignee Address</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_address" name="consignee_address" value="{{ @$data["transport_and_loading"][0]->consignee_address }}">
                                                        <div class="invalid-feedback" id="validation_consignee_address"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_city" class="form-label text-xs">Consignee City</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_city" name="consignee_city" value="{{ @$data["transport_and_loading"][0]->consignee_city }}">
                                                        <div class="invalid-feedback" id="validation_consignee_city"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="service_type" class="form-label text-xs">Service Type</label>
                                                    <div class="input-group">
                                                        <input type="hidden" id="service_id" name="service_id" value="{{ @$data["transport_and_loading"][0]->service_id }}">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="service_type" name="service_type" value="{{ @$data["transport_and_loading"][0]->service_name }}" readonly>
                                                        <button type="button" class="btn btn-primary py-1 rounded mb-0" id="btn_search_service"><i class="bi bi-search"></i></button>
                                                        <div class="invalid-feedback" id="validation_service_type"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="remark" class="form-label text-xs">Remark</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="remark" name="remark" value="{{ @$data["transport_and_loading"][0]->remark }}">
                                                        <div class="invalid-feedback" id="validation_remark"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-12 mb-2">
                                                    <label for="phone" class="form-label text-xs">Phone</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="phone" name="phone" value="{{ @$data["transport_and_loading"][0]->phone_no }}">
                                                        <div class="invalid-feedback" id="validation_phone"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--attachment">
                                    <div class="row ">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12 mb-2">
                                                    <input type="file" class="form-control py-0" name="file_1" id="file_1" onchange="onChangeImage('1')">
                                                    <div id="validation_file_1" class="invalid-feedback"></div>
                                                </div>
                                                @if (count($data["attachment"]) > 0)
                                                @foreach ( $data["attachment"]  as $attachment )
                                                @if ($attachment->order_id == 1)
                                                <div class="col-sm-12 mb-2">
                                                    <img src="{{ $attachment->img_url }}" style="width:100px;">
                                                </div>  
                                                @endif
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            @php
                                                $displayed_desc_1 = false;
                                            @endphp
                                            @if (count($data["attachment"]) > 0)
                                            @foreach ( $data["attachment"]  as $attachment )
                                            @if ($attachment->order_id == 1)
                                            @php
                                                $displayed_desc_1 = true;
                                            @endphp
                                            <input type="text" class="form-control py-0" name="description_file_1" id="description_file_1" placeholder="description" value="{{ $attachment->description}}">
                                            <div id="validation_description_file_1" class="invalid-feedback"></div>
                                            @endif
                                            @endforeach
                                            @endif
                                            @if (!$displayed_desc_1)
                                            <input type="text" class="form-control py-0" name="description_file_1" id="description_file_1" placeholder="description">
                                            <div id="validation_description_file_1" class="invalid-feedback"></div>
                                            @endif
                                        </div>
                                        <div class="col-sm-2 mb-2 d-none" id="container-file-control-1">
                                            <button type="button" class="btn btn-primary py-1 mb-0" onclick="modalViewImage('1')">View Image</button>
                                            <button type="button" class="btn btn-primary py-1 mb-0" onclick="deleteImage('1')">Delete</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12 mb-2">
                                                    <input type="file" class="form-control py-0" name="file_2" id="file_2" onchange="onChangeImage('2')">
                                                    <div id="validation_file_2" class="invalid-feedback"></div>
                                                </div>
                                                @if (count($data["attachment"]) > 0)
                                                @foreach ( $data["attachment"]  as $attachment )
                                                @if ($attachment->order_id == 2)
                                                <div class="col-sm-12 mb-2">
                                                    <img src="{{ $attachment->img_url }}" style="width:100px;">
                                                </div>  
                                                @endif
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            @php
                                                $displayed_desc_2 = false;
                                            @endphp
                                            @if (count($data["attachment"]) > 0)
                                            @foreach ( $data["attachment"]  as $attachment )
                                            @if ($attachment->order_id == 2)
                                            @php
                                                $displayed_desc_2 = true;
                                            @endphp
                                            <input type="text" class="form-control py-0" name="description_file_2" id="description_file_2" placeholder="description" value="{{ $attachment->description}}">
                                            <div id="validation_description_file_2" class="invalid-feedback"></div>
                                            @endif
                                            @endforeach
                                            @endif
                                            @if (!$displayed_desc_2)
                                            <input type="text" class="form-control py-0" name="description_file_2" id="description_file_2" placeholder="description">
                                            <div id="validation_description_file_2" class="invalid-feedback"></div>
                                            @endif
                                        </div>
                                        <div class="col-sm-2 mb-2 d-none" id="container-file-control-2">
                                            <button type="button" class="btn btn-primary py-1 mb-0" onclick="modalViewImage('2')">View Image</button>
                                            <button type="button" class="btn btn-primary py-1 mb-0" onclick="deleteImage('2')">Delete</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12 mb-2">
                                                    <input type="file" class="form-control py-0" name="file_3" id="file_3" onchange="onChangeImage('3')">
                                                    <div id="validation_file_3" class="invalid-feedback"></div>
                                                </div>
                                                @if (count($data["attachment"]) > 0)
                                                @foreach ( $data["attachment"]  as $attachment )
                                                @if ($attachment->order_id == 3)
                                                <div class="col-sm-12 mb-2">
                                                    <img src="{{ $attachment->img_url }}" style="width:100px;">
                                                </div>  
                                                @endif
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            @php
                                                $displayed_desc_3 = false;
                                            @endphp
                                            @if (count($data["attachment"]) > 0)
                                            @foreach ( $data["attachment"]  as $attachment )
                                            @if ($attachment->order_id == 3)
                                            @php
                                                $displayed_desc_3 = true;
                                            @endphp
                                            <input type="text" class="form-control py-0" name="description_file_3" id="description_file_3" placeholder="description" value="{{ $attachment->description}}">
                                            <div id="validation_description_file_3" class="invalid-feedback"></div>
                                            @endif
                                            @endforeach
                                            @endif
                                            @if (!$displayed_desc_3)
                                            <input type="text" class="form-control py-0" name="description_file_3" id="description_file_3" placeholder="description">
                                            <div id="validation_description_file_3" class="invalid-feedback"></div>
                                            @endif
                                        </div>
                                        <div class="col-sm-2 mb-2 d-none" id="container-file-control-3">
                                            <button type="button" class="btn btn-primary py-1 mb-0" onclick="modalViewImage('3')">View Image</button>
                                            <button type="button" class="btn btn-primary py-1 mb-0" onclick="deleteImage('3')">Delete</button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex">
                            <button type="button" class="ms-0 me-2 btn btn-primary py-1 mb-0" name="btn_checking" id="btn_checking">Checking</button>

                            @if ($data["checking_data"][0]->status_id == "UNC")
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


<div class="modal fade" id="modal-ViewImage" tabindex="-1" aria-labelledby="modal-ViewImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ViewImageLabel">View Image</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mb-2 text-center">
                        <img src="" alt="" name="view_image" id="view_image" style="width:100%;">
                    </div>
                    <div class="col-sm-12 mb-2 text-end">
                        <button type="button" class="btn btn-primary py-1 mb-0" data-bs-dismiss="modal">Close</button>
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
function modalViewImage(row) {
    const target_file = $(`#file_${row}`).get(0).files[0];
    if(!target_file){
        return;
    }
    let reader = new FileReader();
    reader.onload = function (e) {
        $('#view_image').attr('src', e.target.result);
    }
    reader.readAsDataURL(target_file);

    $("#modal-ViewImage").modal("show");
}

function onChangeImage(row) {
    const target_file = $(`#file_${row}`).get(0).files[0];
    if(!target_file){
        $(`#container-file-control-${row}`).addClass("d-none")
    }else{
        $(`#container-file-control-${row}`).removeClass("d-none")
    }
}

function deleteImage(row) {
    $(`#file_${row}`).val("");
    onChangeImage(row);
}

$(document).ready(function () {
    $("#dropdown_toggle_outbound").prop('aria-expanded',true);
    $("#dropdown_toggle_outbound").addClass('active');
    $("#dropdown_outbound").addClass('show');
    $("#li_checking").addClass("active");
    $("#a_checking").addClass("active");


    $("#form-process-update-checking").on("submit",function (e) {
        e.preventDefault();

        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const checker = $("#checker").val();
        const carton_id = $("#carton_id").val();
        
        const description_file_1 = $("#description_file_1").val();
        const description_file_2 = $("#description_file_2").val();
        const description_file_3 = $("#description_file_3").val();
        
        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("checker",checker);
        formData.append("carton_id",carton_id);

        formData.append("description_file_1",description_file_1);
        formData.append("description_file_2",description_file_2);
        formData.append("description_file_3",description_file_3);

        formData.append("file_1",$("#file_1").get(0).files[0]);
        formData.append("file_2",$("#file_2").get(0).files[0]);
        formData.append("file_3",$("#file_3").get(0).files[0]);
        

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
                $("#carton_id").removeClass('is-invalid');
                $("#validation_carton_id").html('');

                $("#file_1").removeClass('is-invalid');
                $("#validation_file_1").html('');
                $("#file_2").removeClass('is-invalid');
                $("#validation_file_2").html('');
                $("#file_3").removeClass('is-invalid');
                $("#validation_file_3").html('');

                $("#description_file_1").removeClass('is-invalid');
                $("#validation_description_file_1").html('');
                $("#description_file_2").removeClass('is-invalid');
                $("#validation_description_file_2").html('');
                $("#description_file_3").removeClass('is-invalid');
                $("#validation_description_file_3").html('');
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
    });

    $("#btn_checking").on("click",function () {
        const url = "{{ route('checking.viewScanForm', [ 'id' => $data['checking_data'][0]->outbound_id ]) }}";
        window.open(url,"_blank");
    });

});
</script>
@endsection
