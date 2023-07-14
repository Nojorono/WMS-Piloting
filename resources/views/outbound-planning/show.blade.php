@extends('layout.app')

@section("title")
Outbound Planning
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
                        <h5 class="me-auto">Outbound Planning - Show</h5>
                        <a href="{{ route('outbound_planning.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1">List</button>
                        </a>
                        @if ($data["full_outbound_planning"][0]->status_id == "UNO")
                        <a href="{{ route('outbound_planning.edit',['id' => $data["full_outbound_planning"][0]->outbound_planning_no ]) }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1">Edit</button>
                        </a>
                        @endif
                        @if (in_array($data["full_outbound_planning"][0]->status_id , ["UNO","ALO"]))
                        <span class="me-2">
                            <button type="button" class="btn btn-primary text-xs py-1 me-2" name="btn_cancel" id="btn_cancel" >Cancel</button>
                        </span>
                        @endif
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card border-0">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="outbound_id" class="form-label text-xs">Outbound ID</label>
                                        <input type="text" class="form-control py-0" id="outbound_id" name="outbound_id" value="{{ @$data["full_outbound_planning"][0]->outbound_planning_no }}" readonly>
                                        <div class="invalid-feedback" id="validation_outbound_id"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_name" class="form-label text-xs">Supplier Name*</label>
                                        <input type="hidden" id="supplier_id" name="supplier_id" value="{{ @$data["full_outbound_planning"][0]->supplier_id }}">
                                        <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ @$data["full_outbound_planning"][0]->supplier_name }}" readonly>
                                        <div id="validation_supplier_name" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="reference_no" class="form-label text-xs">Reference No*</label>
                                        <input type="text" class="form-control py-0" id="reference_no" name="reference_no" value="{{ @$data["full_outbound_planning"][0]->reference_no }}" readonly>
                                        <div class="invalid-feedback" id="validation_reference_no"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                        <input type="text" class="form-control py-0" id="supplier_address" name="supplier_address" value="{{ @$data["full_outbound_planning"][0]->supplier_address }}" readonly>
                                        <div class="invalid-feedback" id="validation_supplier_address"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="receipt_no" class="form-label text-xs">Receipt No*</label>
                                        <input type="text" class="form-control py-0" id="receipt_no" name="receipt_no" value="{{ @$data["full_outbound_planning"][0]->receipt_no }}" readonly>
                                        <div class="invalid-feedback" id="validation_receipt_no"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date*</label>
                                        <input type="date" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" min="{{ date("Y-m-d") }}" value="{{ date("Y-m-d",strtotime(@$data["full_outbound_planning"][0]->plan_delivery_date)) }}" readonly>
                                        <div class="invalid-feedback" id="validation_plan_delivery_date"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="order_type" class="form-label text-xs">Order Type*</label>
                                        <input type="hidden" id="order_id" name="order_id" value="{{ @$data["full_outbound_planning"][0]->order_id }}" >
                                        <input type="text" autocomplete="off" class="form-control py-0" id="order_type" name="order_type" value="{{ @$data["full_outbound_planning"][0]->order_type }}" readonly>
                                        <div id="validation_order_type" class="invalid-feedback"></div>
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
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--transport-and-loading">Transport & loading</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body py-0 tab-content">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-item-detail" style="min-width: calc(2.5 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-xs">SKU No</th>
                                                            <th class="text-center text-xs">Item Name</th>
                                                            <th class="text-center text-xs">Serial No</th>
                                                            <th class="text-center text-xs">IMEI</th>
                                                            <th class="text-center text-xs">Part No</th>
                                                            <th class="text-center text-xs">Color</th>
                                                            <th class="text-center text-xs">Size</th>
                                                            <th class="text-center text-xs">Qty Request</th>
                                                            <th class="text-center text-xs">UOM</th>
                                                            <th class="text-center text-xs">Classification</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $row_full_outbound_planning = 1;
                                                        @endphp
                                                        @foreach ($data["full_outbound_planning"] as $key_full_outbound_planning => $value_full_outbound_planning )
                                                        <tr id='table_item_detail_{{ $row_full_outbound_planning }}'>
                                                            <td>
                                                                <div class="input-group">                               
                                                                    <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->sku }}" readonly>
                                                                    <div id="validation_sku_no_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->item_name }}" readonly>
                                                                <div id="validation_item_name_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->serial_no }}" readonly>
                                                                <div id="validation_serial_no_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='imei_no[]' id='imei_no_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->imei }}" readonly>
                                                                <div id="validation_imei_no_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='part_no[]' id='part_no_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->part_no }}" readonly>
                                                                <div id="validation_part_no_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='color[]' id='color_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->color }}" readonly>
                                                                <div id="validation_color_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='size[]' id='size_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->size }}" readonly>
                                                                <div id="validation_size_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <input type='number' class='form-control py-0' name='qty_request[]' id='qty_request_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->qty_request }}" readonly>
                                                                <div id="validation_qty_request_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">  
                                                                    <input type='text' class='form-control py-0' name='uom[]' id='uom_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->uom }}" readonly>
                                                                    <div id="validation_uom_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group"> 
                                                                    <input type='hidden' name='id_classification[]' id='id_classification_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->item_classification_id }}">
                                                                    <input type='text' class='form-control py-0' name='classification[]' id='classification_{{ $row_full_outbound_planning }}' value="{{ $value_full_outbound_planning->classification_name }}" readonly>
                                                                    <div id="validation_classification_{{ $row_full_outbound_planning }}" class="invalid-feedback"></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $row_full_outbound_planning++;
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
                                        <div class="col-sm-12">
                                            <textarea name="remarks" id="remarks" rows="10" class="form-control py-0" readonly>{{ @$data["full_outbound_planning"][0]->notes }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--quantity-details">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table" id="tabel-quantity-details" style="min-width: calc(1.5 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-xs">Batch No</th>
                                                            <th class="text-center text-xs">SKU No</th>
                                                            <th class="text-center text-xs">Part Name</th>
                                                            <th class="text-center text-xs">Available Qty</th>
                                                            <th class="text-center text-xs">Expired Date</th>
                                                            <th class="text-center text-xs">GR ID</th>
                                                            <th class="text-center text-xs">Allocated Qty</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $row_outbound_planning_quantity_details = 0;
                                                        @endphp
                                                        @foreach ($data["outbound_planning_quantity_details"] as $key_outbound_planning_quantity_details => $value_outbound_planning_quantity_details )
                                                            @php
                                                                $row_outbound_planning_quantity_details++;
                                                            @endphp
                                                            <tr id="row_table_quantity_details_{{ $row_outbound_planning_quantity_details }}">
                                                                <td>
                                                                    <input type='text' class='form-control py-0' name='quantity_details_batch_no[]' id='quantity_details_batch_no_{{ $row_outbound_planning_quantity_details }}' value='{{ $value_outbound_planning_quantity_details->batch_no }}' readonly>
                                                                    <div id="validation_quantity_details_batch_no_{{ $row_outbound_planning_quantity_details }}" class="invalid-feedback"></div>
                                                                </td>
                                                                <td>
                                                                    <input type='text' class='form-control py-0' name='quantity_details_sku[]' id='quantity_details_sku_{{ $row_outbound_planning_quantity_details }}' value='{{ $value_outbound_planning_quantity_details->sku }}' readonly>
                                                                    <div id="validation_quantity_details_sku_{{ $row_outbound_planning_quantity_details }}" class="invalid-feedback"></div>
                                                                </td>
                                                                <td>
                                                                    <input type='text' class='form-control py-0' name='quantity_details_part_name[]' id='quantity_details_part_name_{{ $row_outbound_planning_quantity_details }}' value='{{ $value_outbound_planning_quantity_details->part_name }}' readonly>
                                                                    <div id="validation_quantity_details_part_name_{{ $row_outbound_planning_quantity_details }}" class="invalid-feedback"></div>
                                                                </td>
                                                                <td>
                                                                    <input type='number' class='form-control py-0' name='quantity_details_available_qty[]' id='quantity_details_available_qty_{{ $row_outbound_planning_quantity_details }}' value='{{ $value_outbound_planning_quantity_details->available_qty }}' readonly>
                                                                    <div id="validation_quantity_details_available_qty_{{ $row_outbound_planning_quantity_details }}" class="invalid-feedback"></div>
                                                                </td>
                                                                <td>
                                                                    <input type='text' class='form-control py-0' name='quantity_details_expired_date[]' id='quantity_details_expired_date_{{ $row_outbound_planning_quantity_details }}' value='{{ $value_outbound_planning_quantity_details->expired_date }}' readonly>
                                                                    <div id="validation_quantity_details_expired_date_{{ $row_outbound_planning_quantity_details }}" class="invalid-feedback"></div>
                                                                </td>
                                                                <td>
                                                                    <input type='text' class='form-control py-0' name='quantity_details_gr_id[]' id='quantity_details_gr_id_{{ $row_outbound_planning_quantity_details }}' value='{{ $value_outbound_planning_quantity_details->gr_id }}' readonly>
                                                                    <div id="validation_quantity_details_gr_id_{{ $row_outbound_planning_quantity_details }}" class="invalid-feedback"></div>
                                                                </td>
                                                                <td>
                                                                    <input type='number' class='form-control py-0' name='quantity_details_allocated_qty[]' id='quantity_details_allocated_qty_{{ $row_outbound_planning_quantity_details }}' value='{{ $value_outbound_planning_quantity_details->allocated_qty }}' readonly>
                                                                    <div id="validation_quantity_details_allocated_qty_{{ $row_outbound_planning_quantity_details }}" class="invalid-feedback"></div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
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
                                                        <div class="invalid-feedback" id="validation_supervisor"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="start_loading_date" class="form-label text-xs">Start Loading Date</label>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="start_loading_date" name="start_loading_date" value="{{ (!empty(@$data["transport_and_loading"][0]->start_loading)) ? date("Y-m-d",strtotime(@$data["transport_and_loading"][0]->start_loading)) : "" }}" readonly>
                                                        <div class="invalid-feedback" id="validation_start_loading_date"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="start_loading_time" class="form-label text-xs">Start Loading Time</label>
                                                    <div class="input-group">
                                                        <input type="time" autocomplete="off" class="form-control py-0 rounded-start" id="start_loading_time" name="start_loading_time" value="{{ (!empty(@$data["transport_and_loading"][0]->start_loading)) ? date("H:i",strtotime(@$data["transport_and_loading"][0]->start_loading)) : "" }}" readonly>
                                                        <div class="invalid-feedback" id="validation_start_loading_time"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="finish_loading_date" class="form-label text-xs">Finish Loading Date</label>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="finish_loading_date" name="finish_loading_date" value="{{ (!empty(@$data["transport_and_loading"][0]->finish_loading)) ? date("Y-m-d",strtotime(@$data["transport_and_loading"][0]->finish_loading)) : "" }}" readonly>
                                                        <div class="invalid-feedback" id="validation_finish_loading_date"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="finish_loading_time" class="form-label text-xs">Finish Loading Time</label>
                                                    <div class="input-group">
                                                        <input type="time" autocomplete="off" class="form-control py-0 rounded-start" id="finish_loading_time" name="finish_loading_time" value="{{ (!empty(@$data["transport_and_loading"][0]->finish_loading)) ? date("H:i",strtotime(@$data["transport_and_loading"][0]->finish_loading)) : "" }}" readonly>
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
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="vehicle_no" name="vehicle_no" value="{{ @$data["transport_and_loading"][0]->vehicle_no }}" readonly>
                                                        <div class="invalid-feedback" id="validation_vehicle_no"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="driver" class="form-label text-xs">Driver</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="driver" name="driver" value="{{ @$data["transport_and_loading"][0]->driver }}" readonly>
                                                        <div class="invalid-feedback" id="validation_driver"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="vehicle_type" class="form-label text-xs">Vehicle Type</label>
                                                    <div class="input-group">
                                                        <input type="hidden" id="vehicle_id" name="vehicle_id" value="{{ @$data["transport_and_loading"][0]->vehicle_id }}">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="vehicle_type" name="vehicle_type" value="{{ @$data["transport_and_loading"][0]->vehicle_type }}" readonly>
                                                        <div class="invalid-feedback" id="validation_vehicle_type"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="transporter_name" class="form-label text-xs">Transporter_name</label>
                                                    <div class="input-group">
                                                        <input type="hidden" id="transporter" name="transporter" value="{{ @$data["transport_and_loading"][0]->transporter_id }}">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="transporter_name" name="transporter_name" value="{{ @$data["transport_and_loading"][0]->transporter_name }}" readonly>
                                                        <div class="invalid-feedback" id="validation_transporter_name"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="container_no" class="form-label text-xs">Container No</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="container_no" name="container_no" value="{{ @$data["transport_and_loading"][0]->container_no }}" readonly>
                                                        <div class="invalid-feedback" id="validation_container_no"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="seal_no" class="form-label text-xs">Seal No</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="seal_no" name="seal_no" value="{{ @$data["transport_and_loading"][0]->seal_no }}" readonly>
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
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_name" name="consignee_name" value="{{ @$data["transport_and_loading"][0]->consignee_name }}" readonly>
                                                        <div class="invalid-feedback" id="validation_consignee_name"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_address" class="form-label text-xs">Consignee Address</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_address" name="consignee_address" value="{{ @$data["transport_and_loading"][0]->consignee_address }}" readonly>
                                                        <div class="invalid-feedback" id="validation_consignee_address"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_city" class="form-label text-xs">Consignee City</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_city" name="consignee_city" value="{{ @$data["transport_and_loading"][0]->consignee_city }}" readonly>
                                                        <div class="invalid-feedback" id="validation_consignee_city"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="service_type" class="form-label text-xs">Service Type</label>
                                                    <div class="input-group">
                                                        <input type="hidden" id="service_id" name="service_id" value="{{ @$data["transport_and_loading"][0]->service_id }}">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="service_type" name="service_type" value="{{ @$data["transport_and_loading"][0]->service_name }}" readonly>
                                                        <div class="invalid-feedback" id="validation_service_type"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="remark" class="form-label text-xs">Remark</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="remark" name="remark" value="{{ @$data["transport_and_loading"][0]->remark }}" readonly>
                                                        <div class="invalid-feedback" id="validation_remark"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-12 mb-2">
                                                    <label for="phone" class="form-label text-xs">Phone</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="phone" name="phone" value="{{ @$data["transport_and_loading"][0]->phone_no }}" readonly>
                                                        <div class="invalid-feedback" id="validation_phone"></div>
                                                    </div>
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
                            <div class="card-body">
                                <div class="col-sm-12 d-flex mb-2">
                                    @if ($data["full_outbound_planning"][0]->status_id == "UNO")
                                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" id="btn_confirm_planning" name="btn_confirm_planning">Confirm Planning</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ConfirmPlanning" tabindex="-1" aria-labelledby="modal-ConfirmPlanningLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('outbound_planning.confirmPlanning' , [ 'id' => $data["full_outbound_planning"][0]->outbound_planning_no ]) }}" id="form-process-confirm-planning">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label text-xs">Are you sure this Outbound Planning is correct ? </label>
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
        </div>
    </div>
</div>

<div class="modal fade" id="modal-CancelOutboundPlanning" tabindex="-1" aria-labelledby="modal-CancelOutboundPlanningLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('outbound_planning.cancelOutboundPlanning' , [ 'id' => $data["full_outbound_planning"][0]->outbound_planning_no ]) }}" id="form-process-cancel-outbound-planning">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <label for="cancel_reason" class="form-label text-xs">Cancel Reason </label>
                                <textarea name="cancel_reason" id="cancel_reason" rows="5" class="form-control py-0"></textarea>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="form-label text-xs" for="last_status">Last Status</label>
                                <input type="text" class="form-control py-0" id="last_status" name="last_status" value="{{ $data["full_outbound_planning"][0]->status_name }}" readonly>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="form-label text-xs" for="cancel_by">Cancel By</label>
                                <input type="text" class="form-control py-0" id="cancel_by" name="cancel_by" value="{{ session("username") }}" readonly>
                            </div>
                            <div class="col-sm-12 text-end">
                                <button type="submit" class="btn btn-primary text-xs py-1 mb-0">Save</button>
                                <button type="button" class="btn btn-primary text-xs py-1 mb-0" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script type="text/javascript">
$(document).ready(function () {
    $("#dropdown_toggle_outbound").prop('aria-expanded',true);
    $("#dropdown_toggle_outbound").addClass('active');
    $("#dropdown_outbound").addClass('show');
    $("#logo_outbound").addClass("d-none");
    $("#logo_white_outbound").removeClass("d-none");
    $("#li_outbound_planning").addClass("active");
    $("#a_outbound_planning").addClass("active");

    $("#btn_cancel").on("click",function () {
        $("#modal-CancelOutboundPlanning").modal('show');
    });

    $("#form-process-cancel-outbound-planning").on("submit",function (e) {
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

    $("#btn_confirm_planning").on("click",function () {
        $("#modal-ConfirmPlanning").modal('show');
    });

    $("#form-process-confirm-planning").on("submit",function (e) {
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
