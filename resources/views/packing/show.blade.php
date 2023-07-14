@extends('layout.app')

@section("title")
Packing
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
                        <h5 class="me-auto">Packing - Show</h5>
                        <a href="{{ route('packing.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0">List</button>
                        </a>
                        <span class="me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" name="btn_cancel" id="btn_cancel" >Cancel</button>
                        </span>
                        @if ($data["current_data"][0]->status_id == "GIO") {{-- "PAC" --}}
                        <span class="me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" name="btn_print_do" id="btn_print_do" >Print DO</button>
                        </span>
                        @endif
                    </div>
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
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="outbound_id" name="outbound_id" value="{{ @$data["current_data"][0]->outbound_id }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="supplier_name" name="supplier_name" value="{{ @$data["current_data"][0]->supplier_name }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="reference_no" name="reference_no" value="{{ @$data["current_data"][0]->reference_no }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="supplier_address" name="supplier_address" value="{{ @$data["current_data"][0]->supplier_address }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="receipt_no" name="receipt_no" value="{{ @$data["current_data"][0]->receipt_no }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="plan_delivery_date" name="plan_delivery_date" value="{{ @$data["current_data"][0]->plan_delivery_date }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="order_type" name="order_type" value="{{ @$data["current_data"][0]->order_type }}" readonly>
                                                <div class="invalid-feedback" id="validation_order_type"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="checker" class="form-label text-xs">Checker</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="checker" name="checker" value="{{ @$data["current_data"][0]->checker }}" readonly>
                                                <div class="invalid-feedback" id="validation_checker"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="bucket_id" class="form-label text-xs">Bucket ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="bucket_id" name="bucket_id" value="{{ @$data["current_data"][0]->bucket_id }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="carton_id" name="carton_id" value="{{ @$data["current_data"][0]->carton_id }}" readonly>
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
                                        <a class="nav-link active" data-bs-toggle="tab" href="#page-tab--item-details">Item Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#page-tab--transport-and-loading">Transport & Loading</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#page-tab--notes">Notes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#page-tab--attachment">Attachment</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content">
                                <div class="tab-pane active" id="page-tab--item-details">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-item-details" style="width: calc(2 * 100%);">
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($data["current_data_detail"]) > 0)
                                                        @php
                                                            $current_row_item_details = 1;
                                                        @endphp
                                                        @foreach ($data["current_data_detail"] as $current_data_detail)
                                                            <tr>
                                                                <td><input type="text" class="form-control py-0" name="sku_no[]" id="sku_no_{{ $current_row_item_details }}" value="{{ $current_data_detail->sku_no }}" readonly></td>
                                                                <td><input type="text" class="form-control py-0" name="item_name[]" id="item_name_{{ $current_row_item_details }}" value="{{ $current_data_detail->item_name }}" readonly></td>
                                                                <td><input type="text" class="form-control py-0" name="serial_no[]" id="serial_no_{{ $current_row_item_details }}" value="{{ $current_data_detail->serial_no }}" readonly></td>
                                                                <td><input type="text" class="form-control py-0" name="imei[]" id="imei_{{ $current_row_item_details }}" value="{{ $current_data_detail->imei }}" readonly></td>
                                                                <td><input type="text" class="form-control py-0" name="part_no[]" id="part_no_{{ $current_row_item_details }}" value="{{ $current_data_detail->part_no }}" readonly></td>
                                                                <td><input type="text" class="form-control py-0" name="color[]" id="color_{{ $current_row_item_details }}" value="{{ $current_data_detail->color }}" readonly></td>
                                                                <td><input type="text" class="form-control py-0" name="size[]" id="size_{{ $current_row_item_details }}" value="{{ $current_data_detail->size }}" readonly></td>
                                                                <td><input type="text" class="form-control py-0" name="qty_allocated[]" id="qty_allocated_{{ $current_row_item_details }}" value="{{ $current_data_detail->qty_allocated }}" readonly></td>
                                                            </tr>
                                                            @php
                                                                $current_row_item_details++;
                                                            @endphp
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
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="supervisor" name="supervisor" value="{{ $data["current_data_transport_loading"][0]->supervisor_id }}" readonly>
                                                    <div class="invalid-feedback" id="validation_supervisor"></div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="start_loading_date" class="form-label text-xs">Start Loading Date</label>
                                                    <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="start_loading_date" name="start_loading_date" value="{{ (!empty($data["current_data_transport_loading"][0]->start_loading)) ? date("Y-m-d",strtotime($data["current_data_transport_loading"][0]->start_loading)) : "" }}" readonly>
                                                    <div class="invalid-feedback" id="validation_start_loading_date"></div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="start_loading_time" class="form-label text-xs">Start Loading Time</label>
                                                    <input type="time" autocomplete="off" class="form-control py-0 rounded-start" id="start_loading_time" name="start_loading_time" value="{{ (!empty($data["current_data_transport_loading"][0]->start_loading)) ? date("H:i",strtotime($data["current_data_transport_loading"][0]->start_loading)) : "" }}" readonly>
                                                    <div class="invalid-feedback" id="validation_start_loading_time"></div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="finish_loading_date" class="form-label text-xs">Finish Loading Date</label>
                                                    <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="finish_loading_date" name="finish_loading_date" value="{{ (!empty($data["current_data_transport_loading"][0]->finish_loading)) ? date("Y-m-d",strtotime($data["current_data_transport_loading"][0]->finish_loading)) : "" }}" readonly>
                                                    <div class="invalid-feedback" id="validation_finish_loading_date"></div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="finish_loading_time" class="form-label text-xs">Finish Loading Time</label>
                                                    <input type="time" autocomplete="off" class="form-control py-0 rounded-start" id="finish_loading_time" name="finish_loading_time" value="{{ (!empty($data["current_data_transport_loading"][0]->finish_loading)) ? date("H:i",strtotime($data["current_data_transport_loading"][0]->finish_loading)) : "" }}" readonly>
                                                    <div class="invalid-feedback" id="validation_finish_loading_time"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="vehicle_no" class="form-label text-xs">Vehicle No</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="vehicle_no" name="vehicle_no" value="{{ $data["current_data_transport_loading"][0]->vehicle_no }}" readonly>
                                                    <div class="invalid-feedback" id="validation_vehicle_no"></div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="driver" class="form-label text-xs">Driver</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="driver" name="driver" value="{{ $data["current_data_transport_loading"][0]->driver }}" readonly>
                                                    <div class="invalid-feedback" id="validation_driver"></div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="vehicle_type" class="form-label text-xs">Vehicle Type</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="vehicle_type" name="vehicle_type" value="{{ $data["current_data_transport_loading"][0]->vehicle_type }}" readonly>
                                                    <div class="invalid-feedback" id="validation_vehicle_type"></div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="transporter" class="form-label text-xs">Transporter</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="transporter" name="transporter" value="{{ $data["current_data_transport_loading"][0]->transporter }}" readonly>
                                                    <div class="invalid-feedback" id="validation_transporter"></div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="container_no" class="form-label text-xs">Container No</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="container_no" name="container_no" value="{{ $data["current_data_transport_loading"][0]->container_no }}" readonly>
                                                    <div class="invalid-feedback" id="validation_container_no"></div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="seal_no" class="form-label text-xs">Seal No</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="seal_no" name="seal_no" value="{{ $data["current_data_transport_loading"][0]->seal_no }}" readonly>
                                                    <div class="invalid-feedback" id="validation_seal_no"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_name" class="form-label text-xs">Consignee Name</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_name" name="consignee_name" value="{{ $data["current_data_transport_loading"][0]->consignee_name }}" readonly>
                                                    <div class="invalid-feedback" id="validation_consignee_name"></div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_address" class="form-label text-xs">Consignee Address</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_address" name="consignee_address" value="{{ $data["current_data_transport_loading"][0]->consignee_address }}" readonly>
                                                    <div class="invalid-feedback" id="validation_consignee_address"></div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_city" class="form-label text-xs">Consignee City</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_city" name="consignee_city" value="{{ $data["current_data_transport_loading"][0]->consignee_city }}" readonly>
                                                    <div class="invalid-feedback" id="validation_consignee_city"></div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="service_id" class="form-label text-xs">Service Type</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="service_id" name="service_id" value="{{ $data["current_data_transport_loading"][0]->service_type }}" readonly>
                                                    <div class="invalid-feedback" id="validation_service_id"></div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="remark" class="form-label text-xs">Remark</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="remark" name="remark" value="{{ $data["current_data_transport_loading"][0]->remark }}" readonly>
                                                    <div class="invalid-feedback" id="validation_remark"></div>
                                                </div>
                                                
                                                <div class="col-sm-12 mb-2">
                                                    <label for="phone" class="form-label text-xs">Phone</label>
                                                    <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="phone" name="phone" value="{{ $data["current_data_transport_loading"][0]->phone_no }}" readonly>
                                                    <div class="invalid-feedback" id="validation_phone"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--notes">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <textarea name="remarks" id="remarks" rows="10" class="form-control py-0" readonly>{{ $data["current_data_detail"][0]->notes }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--attachment">
                                    <div class="row">
                                        @if (!empty($data["current_data_attachment_1"]))
                                        <div class="col-sm-6 mb-2">
                                            <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="description_attachment_1" name="description_attachment_1" value="{{ $data["current_data_attachment_1"]->description }}" readonly>
                                        </div>
                                        <div class="col-sm-2 mb-2">
                                            <div class="d-flex">
                                                <input type="hidden" name="url_attachment_1" id="url_attachment_1" value="{{ $data["current_data_attachment_1"]->img_url }}">
                                                <button type="button" class="btn btn-primary py-1 mb-0" onclick="modalViewImage('1')">View Image</button>
                                            </div>
                                        </div>
                                        @endif
                                        @if (!empty($data["current_data_attachment_2"]))
                                        <div class="col-sm-6 mb-2">
                                            <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="description_attachment_2" name="description_attachment_2" value="{{ $data["current_data_attachment_2"]->description }}" readonly>
                                        </div>
                                        <div class="col-sm-2 mb-2">
                                            <div class="d-flex">
                                                <input type="hidden" name="url_attachment_2" id="url_attachment_2" value="{{ $data["current_data_attachment_2"]->img_url }}">
                                                <button type="button" class="btn btn-primary py-1 mb-0" onclick="modalViewImage('2')">View Image</button>
                                            </div>
                                        </div>
                                        @endif
                                        @if (!empty($data["current_data_attachment_3"]))
                                        <div class="col-sm-6 mb-2">
                                            <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="description_attachment_3" name="description_attachment_3" value="{{ $data["current_data_attachment_3"]->description }}" readonly>
                                        </div>
                                        <div class="col-sm-2 mb-2">
                                            <div class="d-flex">
                                                <input type="hidden" name="url_attachment_3" id="url_attachment_3" value="{{ $data["current_data_attachment_3"]->img_url }}">
                                                <button type="button" class="btn btn-primary py-1 mb-0" onclick="modalViewImage('3')">View Image</button>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex">
                            @if ($data["current_data"][0]->status_id != "CGI")
                            <button type="button" class="btn btn-primary py-1 mb-0" name="btn_confirm" id="btn_confirm">Confirm Good Issued</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-CancelPacking" tabindex="-1" aria-labelledby="modal-CancelPackingLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('packing.cancelPacking' , [ 'id' => $data["current_data"][0]->outbound_id ]) }}" id="form-process-cancel-packing">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <label for="cancel_reason" class="form-label text-xs">Cancel Reason </label>
                                <textarea name="cancel_reason" id="cancel_reason" rows="5" class="form-control py-0"></textarea>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="form-label text-xs" for="last_status">Last Status</label>
                                <input type="text" class="form-control py-0" id="last_status" name="last_status" value="{{ $data["current_data"][0]->packing_status }}" readonly>
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

<div class="modal fade" id="modal-ConfirmPacking" tabindex="-1" aria-labelledby="modal-ConfirmPackingLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('packing.confirmPacking' , [ 'id' => $data["current_data"][0]->outbound_id ]) }}" id="form-confirm-packing">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label text-xs">Are you sure want to Confirm Good Issued ? </label>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary py-1 mb-0">Yes</button>
                            <button type="button" class="btn btn-primary py-1 mb-0" data-bs-dismiss="modal">No</button>
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
function modalViewImage(row) {
    const target_file = $(`#url_attachment_${row}`).val();
    if(!target_file){
        return;
    }
    $('#view_image').attr('src', target_file);
    $("#modal-ViewImage").modal("show");
}

$(document).ready(function () {
    $("#dropdown_toggle_outbound").prop('aria-expanded',true);
    $("#dropdown_toggle_outbound").addClass('active');
    $("#dropdown_outbound").addClass('show');
    $("#logo_outbound").addClass("d-none");
    $("#logo_white_outbound").removeClass("d-none");
    $("#li_packing").addClass("active");
    $("#a_packing").addClass("active");

    $("#btn_cancel").on("click",function () {
        $("#modal-CancelPacking").modal("show");
    });

    $("#form-process-cancel-packing").on("submit",function (e) {
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

    $("#btn_confirm").on("click",function () {
        $("#modal-ConfirmPacking").modal("show");
    });

    $("#form-confirm-packing").on("submit",function (e) {
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

    $("#btn_print_do").on("click",function () {
        const url = "{{ route('packing.viewPrintDO' , [ 'id' => $data['current_data'][0]->outbound_id ]) }}";
        window.open(url,"_blank")
    });
});
</script>
@endsection
