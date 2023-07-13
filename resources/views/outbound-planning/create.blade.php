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
                        <h5 class="me-auto">Outbound Planning - Add</h5>
                        <a href="{{ route('outbound_planning.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1">List</button>
                        </a>
                        <a href="#" class="text-decoration-none"> {{-- {{ route('outbound_planning.showFormUploadExcel') }} --}}
                            <button type="button" class="btn btn-primary text-xs py-1">Upload Excel</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('outbound_planning.storeOutboundPlanning') }}" id="form-save-outbound">
                    @csrf
                    @method('POST')
                    <div class="col-sm-12">
                        <div class="card border-0">
                            <div class="card-body py-0">
                                <div class="row ">
                                    <div class="col-sm-3">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <label for="outbound_id" class="form-label text-xs">Outbound ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="outbound_id" name="outbound_id" value="Auto Generate" readonly>
                                                <div class="invalid-feedback" id="validation_outbound_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <label for="supplier_name" class="form-label text-xs">Supplier Name*</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="supplier_id" name="supplier_id" value="">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="" readonly>
                                                <div id="validation_supplier_name" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_supplier_name"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <label for="reference_no" class="form-label text-xs">Reference No*</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="reference_no" name="reference_no" value="">
                                                <div class="invalid-feedback" id="validation_reference_no"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="supplier_address" name="supplier_address" value="" readonly>
                                                <div class="invalid-feedback" id="validation_supplier_address"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <label for="receipt_no" class="form-label text-xs">Receipt No*</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control py-0" id="receipt_no" name="receipt_no" value="">
                                                <div class="invalid-feedback" id="validation_receipt_no"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date*</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" min="{{ date("Y-m-d") }}" value="">
                                                <div class="invalid-feedback" id="validation_plan_delivery_date"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row ">
                                            <div class="col-sm-12">
                                                <label for="order_type" class="form-label text-xs">Order Type*</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="order_id" name="order_id" value="" >
                                                <input type="text" autocomplete="off" class="form-control py-0" id="order_type" name="order_type" value="" readonly>
                                                <div id="validation_order_type" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_order_type"><i class="bi bi-search"></i></button>
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
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--transport-and-loading">Transport & loading</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body py-0 tab-content">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2">
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-primary text-xs py-1 mb-0 me-2" id="btn_add_row_table_item_detail" name="btn_add_row_table_item_detail">Add</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="table-item-detail" style="min-width: calc(2.5 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-xs">SKU No</th>
                                                            <th class="text-center text-xs">Item Name</th>
                                                            <th class="text-center text-xs">Qty Request</th>
                                                            <th class="text-center text-xs">UOM</th>
                                                            <th class="text-center text-xs">Classification</th>
                                                            <th class="text-center text-xs">Batch No</th>
                                                            <th class="text-center text-xs">Serial No</th>
                                                            <th class="text-center text-xs">IMEI</th>
                                                            <th class="text-center text-xs">Part No</th>
                                                            <th class="text-center text-xs">Color</th>
                                                            <th class="text-center text-xs">Size</th>
                                                            <th class="text-center text-xs">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--notes">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <textarea name="remarks" id="remarks" rows="10" class="form-control py-0"></textarea>
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
                                                            {{-- <th class="text-center text-xs">Action</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
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
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="supervisor" name="supervisor" value="" readonly>
                                                        <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_supervisor"><i class="bi bi-search"></i></button>
                                                        <div class="invalid-feedback" id="validation_supervisor"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="start_loading_date" class="form-label text-xs">Start Loading Date</label>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="start_loading_date" name="start_loading_date" value="">
                                                        <div class="invalid-feedback" id="validation_start_loading_date"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="start_loading_time" class="form-label text-xs">Start Loading Time</label>
                                                    <div class="input-group">
                                                        <input type="time" autocomplete="off" class="form-control py-0 rounded-start" id="start_loading_time" name="start_loading_time" value="">
                                                        <div class="invalid-feedback" id="validation_start_loading_time"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="finish_loading_date" class="form-label text-xs">Finish Loading Date</label>
                                                    <div class="input-group">
                                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="finish_loading_date" name="finish_loading_date" value="">
                                                        <div class="invalid-feedback" id="validation_finish_loading_date"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <label for="finish_loading_time" class="form-label text-xs">Finish Loading Time</label>
                                                    <div class="input-group">
                                                        <input type="time" autocomplete="off" class="form-control py-0 rounded-start" id="finish_loading_time" name="finish_loading_time" value="">
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
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="vehicle_no" name="vehicle_no" value="" >
                                                        <div class="invalid-feedback" id="validation_vehicle_no"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="driver" class="form-label text-xs">Driver</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="driver" name="driver" value="" >
                                                        <div class="invalid-feedback" id="validation_driver"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="vehicle_type" class="form-label text-xs">Vehicle Type</label>
                                                    <div class="input-group">
                                                        <input type="hidden" id="vehicle_id" name="vehicle_id" value="">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="vehicle_type" name="vehicle_type" value="" readonly>
                                                        <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_vehicle"><i class="bi bi-search"></i></button>
                                                        <div class="invalid-feedback" id="validation_vehicle_type"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="transporter_name" class="form-label text-xs">Transporter_name</label>
                                                    <div class="input-group">
                                                        <input type="hidden" id="transporter" name="transporter" value="">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="transporter_name" name="transporter_name" value="" readonly>
                                                        <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_transporter"><i class="bi bi-search"></i></button>
                                                        <div class="invalid-feedback" id="validation_transporter_name"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="container_no" class="form-label text-xs">Container No</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="container_no" name="container_no" value="">
                                                        <div class="invalid-feedback" id="validation_container_no"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="seal_no" class="form-label text-xs">Seal No</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="seal_no" name="seal_no" value="">
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
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_name" name="consignee_name" value="">
                                                        <div class="invalid-feedback" id="validation_consignee_name"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_address" class="form-label text-xs">Consignee Address</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_address" name="consignee_address" value="">
                                                        <div class="invalid-feedback" id="validation_consignee_address"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="consignee_city" class="form-label text-xs">Consignee City</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="consignee_city" name="consignee_city" value="">
                                                        <div class="invalid-feedback" id="validation_consignee_city"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="service_type" class="form-label text-xs">Service Type</label>
                                                    <div class="input-group">
                                                        <input type="hidden" id="service_id" name="service_id" value="">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="service_type" name="service_type" value="" readonly>
                                                        <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_service"><i class="bi bi-search"></i></button>
                                                        <div class="invalid-feedback" id="validation_service_type"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label for="remark" class="form-label text-xs">Remark</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="remark" name="remark" value="">
                                                        <div class="invalid-feedback" id="validation_remark"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-12 mb-2">
                                                    <label for="phone" class="form-label text-xs">Phone</label>
                                                    <div class="input-group">
                                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="phone" name="phone" value="">
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
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary text-xs py-1 mb-0 ms-0 me-auto" id="btn_suggest_batch_no">Suggest Batch No</button>
                            <button type="submit" class="btn btn-primary text-xs py-1 mb-0 ms-auto ">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Supplier" tabindex="-1" aria-labelledby="modal-SupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SupplierLabel">Supplier - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Supplier" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">Supplier ID</th>
                                <th class="text-xs">Supplier Name</th>
                                <th class="text-xs">Supplier Address</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-OrderType" tabindex="-1" aria-labelledby="modal-OrderTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-OrderTypeLabel">Order Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-OrderType" >
                        <thead>
                            <tr>
                                <th class="text-xs">Order ID</th>
                                <th class="text-xs">Order Type</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-SKU" tabindex="-1" aria-labelledby="modal-SKULabel" aria-hidden="true">
    <input type="hidden" name="modal-SKU_target_row" id="modal-SKU_target_row">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SKULabel">SKU - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SKU" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">SKU</th>
                                <th class="text-xs">Part Name</th>
                                <th class="text-xs">IMEI</th>
                                <th class="text-xs">Part No</th>
                                <th class="text-xs">Color</th>
                                <th class="text-xs">Size</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-UOM" tabindex="-1" aria-labelledby="modal-UOMLabel" aria-hidden="true">
    <input type="hidden" name="modal-UOM_target_row" id="modal-UOM_target_row">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-UOMLabel">UOM - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-UOM" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">UOM Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Classification" tabindex="-1" aria-labelledby="modal-ClassificationLabel" aria-hidden="true">
    <input type="hidden" name="modal-Classification_target_row" id="modal-Classification_target_row">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ClassificationLabel">Classification - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Classification" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">Classification ID</th>
                                <th class="text-xs">Classification Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-SKU-Details" tabindex="-1" aria-labelledby="modal-SKU-DetailsLabel" aria-hidden="true">
    <input type="hidden" name="modal-SKU-Details_target_row" id="modal-SKU-Details_target_row">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SKU-DetailsLabel">SKU Details - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <div class="table-responsive">
                            <table class="table " id="list-table-modal-SKU-Details" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-xs">Batch No</th>
                                        <th class="text-xs">SKU</th>
                                        <th class="text-xs">Part Name</th>
                                        <th class="text-xs">Available Qty</th>
                                        <th class="text-xs">Expired Date</th>
                                        <th class="text-xs">GR ID</th>
                                        <th class="text-xs">Allocated Qty</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 text-end">
                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" name="btn_choose" id="btn_choose">Choose</button>
                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" name="btn_close" id="btn_close" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Supervisor" tabindex="-1" aria-labelledby="modal-SupervisorLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SupervisorLabel">Supervisor - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Supervisor" >
                        <thead>
                            <tr>
                                <th class="text-xs">Supervisor ID</th>
                                <th class="text-xs">Supervisor Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-VehicleType" tabindex="-1" aria-labelledby="modal-VehicleTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-VehicleTypeLabel">Vehicle Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-VehicleType" >
                        <thead>
                            <tr>
                                <th class="text-xs">Vehicle ID</th>
                                <th class="text-xs">Vehicle Type</th>
                                <th class="text-xs">Vehicle Description</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Transporter" tabindex="-1" aria-labelledby="modal-TransporterLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-TransporterLabel">Transporter - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Transporter" >
                        <thead>
                            <tr>
                                <th class="text-xs">Transporter ID</th>
                                <th class="text-xs">Transporter Name</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ServiceType" tabindex="-1" aria-labelledby="modal-ServiceTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ServiceTypeLabel">Service Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-ServiceType" >
                        <thead>
                            <tr>
                                <th class="text-xs">Service ID</th>
                                <th class="text-xs">Service Name</th>
                                <th class="text-xs">Service Description</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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
function displayModalClassification(row) {
    $("#modal-Classification_target_row").val(row);
    $("#list-datatable-modal-Classification").DataTable().destroy();
    $("#list-datatable-modal-Classification").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('outbound_planning.datatablesClassification') }}",
        columns:[
            {data: 'item_classification_id', searchable: true, className: 'text-xs'},
            {data: 'classification_name', searchable: true, className: 'text-xs'},
        ],
    });
    $("#modal-Classification").modal('show');
}

function displayModalUOM(row) {
    $("#modal-UOM_target_row").val(row);
    $("#list-datatable-modal-UOM").DataTable().destroy();
    $("#list-datatable-modal-UOM").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('outbound_planning.datatablesUOM') }}",
        columns:[
            {data: 'uom_name', searchable: true, className: 'text-xs'},
        ],
    });
    $("#modal-UOM").modal('show');
}


function displayModalSKU(row) {
    $("#modal-SKU_target_row").val(row);
    $("#list-datatable-modal-SKU").DataTable().destroy();
    $("#list-datatable-modal-SKU").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('outbound_planning.datatablesSKU') }}",
        columns:[
            {data: 'sku', searchable: true, className: 'text-xs'},
            {data: 'part_name', searchable: true, className: 'text-xs'},
            {data: 'imei', searchable: true, className: 'text-xs'},
            {data: 'part_no', searchable: true, className: 'text-xs'},
            {data: 'color', searchable: true, className: 'text-xs'},
            {data: 'size', searchable: true, className: 'text-xs'},
        ],
    });
    $("#modal-SKU").modal('show');
}

function deleteRowTableItemDetail(row) {
    $(`#row_table_item_detail_${row}`).remove();
}

function displayModalSKUDetails(row) {
    const sku = $(`#sku_no_${row}`).val();
    const qty_request = $(`#qty_request_${row}`).val();
    if(sku == "" || sku === undefined){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: "SKU cannot be empty",
            type: 'error',
            icon: 'error',
        });
        return;
    }

    if(qty_request == "" || qty_request == 0 || qty_request === undefined){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: "Qty Request cannot be empty",
            type: 'error',
            icon: 'error',
        });
        return;
    }
    $("#modal-SKU-Details_target_row").val(row);
    const formData = new FormData();
    const _token = $("meta[name='csrf-token']").prop('content');
    formData.append("_token",_token);
    formData.append("sku",sku);
    formData.append("qty_request",qty_request);

    $.ajax({
        url: "{{ route('outbound_planning.tablesSKUDetails') }}",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function () {
            $("#list-table-modal-SKU-Details tbody").html("");
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
                    text: response.message,
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
                html += `<tr id="sku_details_${index}">
                <td><input type="text" class="form-control py-0" name="batch_no_${index}" id="batch_no_${index}" value="${element.batch_no}" readonly></td>
                <td><input type="text" class="form-control py-0" name="sku_${index}" id="sku_${index}" value="${element.sku}" readonly></td>
                <td><input type="text" class="form-control py-0" name="part_name_${index}" id="part_name_${index}" value="${element.part_name}" readonly></td>
                <td><input type="number" class="form-control py-0" name="available_qty_${index}" id="available_qty_${index}" value="${element.available_qty}" readonly></td>
                <td><input type="text" class="form-control py-0" name="expired_date_${index}" id="expired_date_${index}" value="${expired_date}" readonly></td>
                <td><input type="text" class="form-control py-0" name="gr_id_${index}" id="gr_id_${index}" value="${element.gr_id}" readonly></td>
                <td><input type="number" class="form-control py-0" name="allocated_qty_${index}" id="allocated_qty_${index}" value="" onchange="checkAllocatedQuantityWithAvailableQty('${index}')"></td>
            </tr>`;
            });
            
            $("#list-table-modal-SKU-Details tbody").html(html);
            $("#modal-SKU-Details").modal('show');

        },
    });
    
}

function checkAllocatedQuantityWithAvailableQty(row) {
    const available_qty = parseInt($(`#available_qty_${row}`).val());
    const allocated_qty = parseInt($(`#allocated_qty_${row}`).val());

    if(allocated_qty > available_qty  ){
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: 'Allocated Qty is more than Available Qty',
            type: 'error',
            icon: 'error',
        });
        $(`#allocated_qty_${row}`).val("0");
        return;
    }
}

function deleteRowTableQuantityDetail(row) {
    $(`#row_table_quantity_details_${row}`).remove();
}

function cleanRowTableQuantityDetailBasedOnSKU(sku) {
    if(sku == "" || sku == undefined){
        return;
    }

    $("#tabel-quantity-details tbody tr").each(function (index,dom) {
        const id = $(this).prop("id");
        const current_row = id.replace("row_table_quantity_details_","");
        const current_sku = $(`#quantity_details_sku_${current_row}`).val();
        if(sku == current_sku){
            $(`#row_table_quantity_details_${current_row}`).remove();
        }
    });
}

$(document).ready(function () {
    $("#dropdown_toggle_outbound").prop('aria-expanded',true);
    $("#dropdown_toggle_outbound").addClass('active');
    $("#dropdown_outbound").addClass('show');
    $("#li_outbound_planning").addClass("active");
    $("#a_outbound_planning").addClass("active");

    /* special function start */
    let row_Table_Item_Detail = 0;
    let row_Table_Quantity_Detail = 0;

    const add_Row_Table_Item_Detail = () => {
        row_Table_Item_Detail++;

        const html_Row = `
        <tr id='row_table_item_detail_${row_Table_Item_Detail}'>
            <td>
                <div class="input-group">                               
                    <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_${row_Table_Item_Detail}' readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_sku_${row_Table_Item_Detail}" name="btn_search_sku_${row_Table_Item_Detail}" onclick="displayModalSKU('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                    <div id="validation_sku_no_${row_Table_Item_Detail}" class="invalid-feedback"></div>
                </div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_${row_Table_Item_Detail}' readonly>
                <div id="validation_item_name_${row_Table_Item_Detail}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type='number' class='form-control py-0' name='qty_request[]' id='qty_request_${row_Table_Item_Detail}'>
                <div id="validation_qty_request_${row_Table_Item_Detail}" class="invalid-feedback"></div>
            </td>
            <td>
                <div class="input-group">  
                    <input type='text' class='form-control py-0' name='uom[]' id='uom_${row_Table_Item_Detail}' readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_uom_${row_Table_Item_Detail}" name="btn_search_uom_${row_Table_Item_Detail}" onclick="displayModalUOM('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                    <div id="validation_uom_${row_Table_Item_Detail}" class="invalid-feedback"></div>
                </div>
            </td>
            <td>
                <div class="input-group"> 
                    <input type='hidden' name='id_classification[]' id='id_classification_${row_Table_Item_Detail}'>
                    <input type='text' class='form-control py-0' name='classification[]' id='classification_${row_Table_Item_Detail}' readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_classification_${row_Table_Item_Detail}" name="btn_search_classification_${row_Table_Item_Detail}" onclick="displayModalClassification('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                    <div id="validation_classification_${row_Table_Item_Detail}" class="invalid-feedback"></div>
                </div>
            </td>
            <td>
                <div class="text-center">
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_sku_details_${row_Table_Item_Detail}" name="btn_search_sku_details_${row_Table_Item_Detail}" onclick="displayModalSKUDetails('${row_Table_Item_Detail}')"><i class="bi bi-search"></i></button>
                </div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_${row_Table_Item_Detail}'>
                <div id="validation_serial_no_${row_Table_Item_Detail}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='imei_no[]' id='imei_no_${row_Table_Item_Detail}' readonly>
                <div id="validation_imei_no_${row_Table_Item_Detail}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='part_no[]' id='part_no_${row_Table_Item_Detail}' readonly>
                <div id="validation_part_no_${row_Table_Item_Detail}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='color[]' id='color_${row_Table_Item_Detail}' readonly>
                <div id="validation_color_${row_Table_Item_Detail}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='size[]' id='size_${row_Table_Item_Detail}' readonly>
                <div id="validation_size_${row_Table_Item_Detail}" class="invalid-feedback"></div>
            </td>
            
            <td class='text-center'>
                <button type='button' class='btn btn-primary text-xs py-1 mb-0' id='btn_delete_${row_Table_Item_Detail}' name='btn_delete_${row_Table_Item_Detail}' onclick='deleteRowTableItemDetail("${row_Table_Item_Detail}")'>Delete</button>
            </td>
        </tr>`;
        $("#table-item-detail > tbody").append(html_Row)
    }
    /* special function end */

    $("#btn_search_supervisor").on('click',function () {
        $("#modal-Supervisor").modal('show');
        $("#list-datatable-modal-Supervisor").DataTable().destroy();
        $("#list-datatable-modal-Supervisor").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('outbound_planning.datatablesSupervisor') }}",
            columns:[
                {data: 'supervisor_id', searchable: true, className: 'text-xs'},
                {data: 'supervisor_name', searchable: true, className: 'text-xs'},
            ],
        });
    });

    $("#list-datatable-modal-Supervisor > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const supervisor_id = $($(dom_tr).children("td")[0]).text(); 
        const supervisor_name = $($(dom_tr).children("td")[1]).text();
        
        $("#supervisor").val(supervisor_id);
        $("#modal-Supervisor").modal('hide');
        
    });

    $("#btn_search_vehicle").on('click',function () {
        $("#modal-VehicleType").modal('show');
        $("#list-datatable-modal-VehicleType").DataTable().destroy();
        $("#list-datatable-modal-VehicleType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('outbound_planning.datatablesVehicleType') }}",
            columns:[
                {data: 'vehicle_id', searchable: true, className: 'text-xs'},
                {data: 'vehicle_type', searchable: true, className: 'text-xs'},
                {data: 'vehicle_description', searchable: true, className: 'text-xs'},
            ],
        });
    });

    $("#list-datatable-modal-VehicleType > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const vehicle_id = $($(dom_tr).children("td")[0]).text();
        const vehicle_type = $($(dom_tr).children("td")[1]).text();
        
        $("#vehicle_id").val(vehicle_id);
        $("#vehicle_type").val(vehicle_type);
        $("#modal-VehicleType").modal('hide');
        
    });

    $("#btn_search_transporter").on('click',function () {
        $("#modal-Transporter").modal('show');
        $("#list-datatable-modal-Transporter").DataTable().destroy();
        $("#list-datatable-modal-Transporter").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('outbound_planning.datatablesTransporter') }}",
            columns:[
                {data: 'transporter_id', searchable: true, className: 'text-xs'},
                {data: 'transporter_name', searchable: true, className: 'text-xs'},
            ],
        });
    });

    $("#list-datatable-modal-Transporter > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const transporter_id = $($(dom_tr).children("td")[0]).text();
        const transporter_name = $($(dom_tr).children("td")[1]).text();
        
        $("#transporter").val(transporter_id);
        $("#transporter_name").val(transporter_name);
        $("#modal-Transporter").modal('hide');
        
    });

    $("#btn_search_service").on('click',function () {
        $("#modal-ServiceType").modal('show');
        $("#list-datatable-modal-ServiceType").DataTable().destroy();
        $("#list-datatable-modal-ServiceType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('outbound_planning.datatablesServiceType') }}",
            columns:[
                {data: 'service_id', searchable: true, className: 'text-xs'},
                {data: 'service_name', searchable: true, className: 'text-xs'},
                {data: 'service_description', searchable: true, className: 'text-xs'},
            ],
        });
    });

    $("#list-datatable-modal-ServiceType > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const service_id = $($(dom_tr).children("td")[0]).text();
        const service_name = $($(dom_tr).children("td")[1]).text();
        
        $("#service_id").val(service_id);
        $("#service_type").val(service_name);
        $("#modal-ServiceType").modal('hide');
        
    });

    $("#btn_choose").on("click",function () {
        const row_item_details = $(`#modal-SKU-Details_target_row`).val();
        const qty_request = parseInt($(`#qty_request_${row_item_details}`).val());
        let clean_sku_dom = "";
        let total_allocated_quantity = 0;
        const temp_sku_details = [];

        $("#list-table-modal-SKU-Details tbody tr").each(function (index,dom) {
            const id = $(this).prop("id");
            const current_row = id.replace("sku_details_","");
            const batch_no = $(`#batch_no_${current_row}`).val();
            const sku = $(`#sku_${current_row}`).val();
            const part_name = $(`#part_name_${current_row}`).val();
            const available_qty = $(`#available_qty_${current_row}`).val();
            const expired_date = $(`#expired_date_${current_row}`).val();
            const gr_id = $(`#gr_id_${current_row}`).val();
            const allocated_qty = $(`#allocated_qty_${current_row}`).val();

            if(clean_sku_dom == ""){
                clean_sku_dom = `${sku}`;
            }

            if(allocated_qty != 0 && allocated_qty != "" ){
                total_allocated_quantity += parseInt(allocated_qty);
                temp_sku_details.push({
                    batch_no : batch_no,
                    sku : sku,
                    part_name : part_name,
                    available_qty : available_qty,
                    expired_date : expired_date,
                    gr_id : gr_id,
                    allocated_qty : allocated_qty,
                });
            }
            
        });

        if(total_allocated_quantity > qty_request){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: 'allocated qty cannot be more than qty request!',
                type: 'error',
                icon: 'error',
            });
            return;
        }
        
        let html_quantity_details = '';
        temp_sku_details.forEach((element, index) => {
            row_Table_Quantity_Detail++;
            // html_quantity_details += `
            // <tr id="row_table_quantity_details_${row_Table_Quantity_Detail}">
            //     <td>
            //         <input type='text' class='form-control' name='quantity_details_batch_no[]' id='quantity_details_batch_no_${row_Table_Quantity_Detail}' value='${element.batch_no}' readonly>
            //         <div id="validation_quantity_details_batch_no_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
            //     </td>
            //     <td>
            //         <input type='text' class='form-control' name='quantity_details_sku[]' id='quantity_details_sku_${row_Table_Quantity_Detail}' value='${element.sku}' readonly>
            //         <div id="validation_quantity_details_sku_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
            //     </td>
            //     <td>
            //         <input type='text' class='form-control' name='quantity_details_part_name[]' id='quantity_details_part_name_${row_Table_Quantity_Detail}' value='${element.part_name}' readonly>
            //         <div id="validation_quantity_details_part_name_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
            //     </td>
            //     <td>
            //         <input type='number' class='form-control' name='quantity_details_available_qty[]' id='quantity_details_available_qty_${row_Table_Quantity_Detail}' value='${element.available_qty}' readonly>
            //         <div id="validation_quantity_details_available_qty_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
            //     </td>
            //     <td>
            //         <input type='text' class='form-control' name='quantity_details_expired_date[]' id='quantity_details_expired_date_${row_Table_Quantity_Detail}' value='${element.expired_date}' readonly>
            //         <div id="validation_quantity_details_expired_date_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
            //     </td>
            //     <td>
            //         <input type='text' class='form-control' name='quantity_details_gr_id[]' id='quantity_details_gr_id_${row_Table_Quantity_Detail}' value='${element.gr_id}' readonly>
            //         <div id="validation_quantity_details_gr_id_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
            //     </td>
            //     <td>
            //         <input type='number' class='form-control' name='quantity_details_allocated_qty[]' id='quantity_details_allocated_qty_${row_Table_Quantity_Detail}' value='${element.allocated_qty}' readonly>
            //         <div id="validation_quantity_details_allocated_qty_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
            //     </td>
            //     <td class='text-center'>
            //         <button type='button' class='btn btn-primary' id='btn_delete_quantity_details_${row_Table_Quantity_Detail}' name='btn_delete_quantity_details_${row_Table_Quantity_Detail}' onclick='deleteRowTableQuantityDetail("${row_Table_Quantity_Detail}")'>Delete</button>
            //     </td>
            // </tr>
            // `;
            html_quantity_details += `
            <tr id="row_table_quantity_details_${row_Table_Quantity_Detail}">
                <td>
                    <input type='text' class='form-control py-0' name='quantity_details_batch_no[]' id='quantity_details_batch_no_${row_Table_Quantity_Detail}' value='${element.batch_no}' readonly>
                    <div id="validation_quantity_details_batch_no_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                </td>
                <td>
                    <input type='text' class='form-control py-0' name='quantity_details_sku[]' id='quantity_details_sku_${row_Table_Quantity_Detail}' value='${element.sku}' readonly>
                    <div id="validation_quantity_details_sku_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                </td>
                <td>
                    <input type='text' class='form-control py-0' name='quantity_details_part_name[]' id='quantity_details_part_name_${row_Table_Quantity_Detail}' value='${element.part_name}' readonly>
                    <div id="validation_quantity_details_part_name_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                </td>
                <td>
                    <input type='number' class='form-control py-0' name='quantity_details_available_qty[]' id='quantity_details_available_qty_${row_Table_Quantity_Detail}' value='${element.available_qty}' readonly>
                    <div id="validation_quantity_details_available_qty_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                </td>
                <td>
                    <input type='text' class='form-control py-0' name='quantity_details_expired_date[]' id='quantity_details_expired_date_${row_Table_Quantity_Detail}' value='${element.expired_date}' readonly>
                    <div id="validation_quantity_details_expired_date_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                </td>
                <td>
                    <input type='text' class='form-control py-0' name='quantity_details_gr_id[]' id='quantity_details_gr_id_${row_Table_Quantity_Detail}' value='${element.gr_id}' readonly>
                    <div id="validation_quantity_details_gr_id_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                </td>
                <td>
                    <input type='number' class='form-control py-0' name='quantity_details_allocated_qty[]' id='quantity_details_allocated_qty_${row_Table_Quantity_Detail}' value='${element.allocated_qty}' readonly>
                    <div id="validation_quantity_details_allocated_qty_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                </td>
            </tr>
            `;

        });
        cleanRowTableQuantityDetailBasedOnSKU(clean_sku_dom);
        
        $("#tabel-quantity-details tbody").append(html_quantity_details);
        $("#modal-SKU-Details").modal("hide");
    });

    $("#btn_search_supplier_name").on('click',function () {
        $("#modal-Supplier").modal('show');
        $("#list-datatable-modal-Supplier").DataTable().destroy();
        $("#list-datatable-modal-Supplier").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('outbound_planning.datatablesSupplier') }}",
            columns:[
                {data: 'supplier_id', searchable: true, className: 'text-xs'},
                {data: 'supplier_name', searchable: true, className: 'text-xs'},
                {data: 'address1', searchable: true, className: 'text-xs'},
            ],
        });
    });

    $("#list-datatable-modal-Supplier > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const supplier_id = $($(dom_tr).children("td")[0]).text(); 
        const supplier_name = $($(dom_tr).children("td")[1]).text(); 
        const address = $($(dom_tr).children("td")[2]).text(); 
        
        $("#supplier_id").val(supplier_id);
        $("#supplier_name").val(supplier_name);
        $("#supplier_address").val(address);
        $("#modal-Supplier").modal('hide');
        
    });

    $("#btn_search_order_type").on('click',function () {
        $("#modal-OrderType").modal('show');
        $("#list-datatable-modal-OrderType").DataTable().destroy();
        $("#list-datatable-modal-OrderType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('outbound_planning.datatablesOrderType') }}",
            columns:[
                {data: 'order_id', searchable: true, className: 'text-xs'},
                {data: 'order_type', searchable: true, className: 'text-xs'},
            ],
        });
    });

    $("#list-datatable-modal-OrderType > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const order_id = $($(dom_tr).children("td")[0]).text(); 
        const order_type = $($(dom_tr).children("td")[1]).text();
        
        $("#order_id").val(order_id);
        $("#order_type").val(order_type);
        $("#modal-OrderType").modal('hide');
        
    });

    $("#btn_add_row_table_item_detail").on("click",function () {
        add_Row_Table_Item_Detail();
    });

    $("#btn_add_row_attachment").on("click",function () {
        add_Row_Attachment();
    })

    $("#list-datatable-modal-SKU > tbody").on('click','tr',function () {
        const target_row = $("#modal-SKU_target_row").val();
        const prev_sku_no = $(`#sku_no_${target_row}`).val();

        if(prev_sku_no != ""){
            cleanRowTableQuantityDetailBasedOnSKU(prev_sku_no);
        }

        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const sku = $($(dom_tr).children("td")[0]).text(); 
        const part_name = $($(dom_tr).children("td")[1]).text(); 
        const imei = $($(dom_tr).children("td")[2]).text(); 
        const part_no = $($(dom_tr).children("td")[3]).text(); 
        const color = $($(dom_tr).children("td")[4]).text(); 
        const size = $($(dom_tr).children("td")[5]).text(); 
        
        $(`#sku_no_${target_row}`).val(sku);
        $(`#item_name_${target_row}`).val(part_name);
        $(`#imei_no_${target_row}`).val(imei);
        $(`#part_no_${target_row}`).val(part_no);
        $(`#color_${target_row}`).val(color);
        $(`#size_${target_row}`).val(size);
        
        $("#modal-SKU").modal('hide');
        
    });

    $("#list-datatable-modal-UOM > tbody").on('click','tr',function () {
        const target_row = $("#modal-UOM_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }

        const uom = $($(dom_tr).children("td")[0]).text(); 
        
        $(`#uom_${target_row}`).val(uom);
        
        $("#modal-UOM").modal('hide');
        
    });

    $("#list-datatable-modal-Classification > tbody").on('click','tr',function () {
        const target_row = $("#modal-Classification_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const id_classification = $($(dom_tr).children("td")[0]).text(); 
        const classification = $($(dom_tr).children("td")[1]).text(); 
        
        $(`#id_classification_${target_row}`).val(id_classification);
        $(`#classification_${target_row}`).val(classification);
        
        $("#modal-Classification").modal('hide');
        
    });

    $("#btn_suggest_batch_no").on("click",function (e) {
        $("#table-item-detail > tbody > tr").each(function (e) {
            const current_row = $(this).attr("id").replace("row_table_item_detail_","");
            const sku_no = $(`#sku_no_${current_row}`).val();
            const qty_request = $(`#qty_request_${current_row}`).val();
            $(`#qty_request_${current_row}`).removeClass('is-invalid');
            $(`#validation_qty_request_${current_row}`).html('');
            let current_qty = parseInt(qty_request);
            let untouch_current_qty = current_qty;

            if(sku_no == "" || sku_no === undefined){
                return;
            }

            if(qty_request == "" || qty_request == 0 || qty_request === undefined){
                return;
            }

            const formData = new FormData();
            const _token = $("meta[name='csrf-token']").prop('content');
            formData.append("_token",_token);
            formData.append("sku",sku_no);
            formData.append("qty_request",qty_request);

            $.ajax({
                url: "{{ route('outbound_planning.tablesSKUDetails') }}",
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
                        console.log("something wrong");
                        return;
                    }

                    if(!'data' in response){
                        console.log("something wrong");
                        return;
                    }
                    let html_quantity_details = ``;

                    response.data.forEach((element,index) => {
                        const temp_available_qty = (element.available_qty) ? element.available_qty : "";
                        const temp_batch_no = (element.batch_no) ? element.batch_no : "";
                        const temp_expired_date = (element.expired_date) ? element.expired_date : "";
                        const temp_gr_id = (element.gr_id) ? element.gr_id : "";
                        const temp_part_name = (element.part_name) ? element.part_name : "";
                        const temp_sku = (element.sku) ? element.sku : "";
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

                            row_Table_Quantity_Detail++;
    
                            html_quantity_details += `
                            <tr id="row_table_quantity_details_${row_Table_Quantity_Detail}">
                                <td>
                                    <input type='text' class='form-control py-0' name='quantity_details_batch_no[]' id='quantity_details_batch_no_${row_Table_Quantity_Detail}' value='${temp_batch_no}' readonly>
                                    <div id="validation_quantity_details_batch_no_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='quantity_details_sku[]' id='quantity_details_sku_${row_Table_Quantity_Detail}' value='${temp_sku}' readonly>
                                    <div id="validation_quantity_details_sku_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='quantity_details_part_name[]' id='quantity_details_part_name_${row_Table_Quantity_Detail}' value='${temp_part_name}' readonly>
                                    <div id="validation_quantity_details_part_name_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='number' class='form-control py-0' name='quantity_details_available_qty[]' id='quantity_details_available_qty_${row_Table_Quantity_Detail}' value='${temp_available_qty}' readonly>
                                    <div id="validation_quantity_details_available_qty_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='quantity_details_expired_date[]' id='quantity_details_expired_date_${row_Table_Quantity_Detail}' value='${temp_expired_date}' readonly>
                                    <div id="validation_quantity_details_expired_date_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='text' class='form-control py-0' name='quantity_details_gr_id[]' id='quantity_details_gr_id_${row_Table_Quantity_Detail}' value='${temp_gr_id}' readonly>
                                    <div id="validation_quantity_details_gr_id_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <input type='number' class='form-control py-0' name='quantity_details_allocated_qty[]' id='quantity_details_allocated_qty_${row_Table_Quantity_Detail}' value='${display_qty}' readonly>
                                    <div id="validation_quantity_details_allocated_qty_${row_Table_Quantity_Detail}" class="invalid-feedback"></div>
                                </td>
                            </tr>`;
                        }

                    });

                    if(current_qty != 0){
                        //disni masih sisa qty_request nya mau di apain????  soal nya kalo kesave nilai nya jadi ga sama dengan qty request nya //jebakan_Suggest_picking_outbound_point_1
                        cleanRowTableQuantityDetailBasedOnSKU(sku_no);
                        $(`#qty_request_${current_row}`).addClass('is-invalid');
                        $(`#validation_qty_request_${current_row}`).html(`Qty request can't exceed available qty, available_qty : ${ parseInt(untouch_current_qty) - parseInt(current_qty) }`);
                        return;
                    }

                    cleanRowTableQuantityDetailBasedOnSKU(sku_no);
                    $("#tabel-quantity-details tbody").append(html_quantity_details);
                },
            });
        });
    });

    $("#form-save-outbound").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = $("input[name='_method']").val();

        const supplier_id = $('#supplier_id').val();
        const reference_no = $('#reference_no').val();
        const supplier_address = $('#supplier_address').val();
        const receipt_no = $('#receipt_no').val();
        const plan_delivery_date = $('#plan_delivery_date').val();
        const order_id = $('#order_id').val();
        const order_type = $('#order_type').val();
        
        const remarks = $('#remarks').val();

        const supervisor = $("#supervisor").val();
        const start_loading_date = $("#start_loading_date").val();
        const start_loading_time = $("#start_loading_time").val();
        const finish_loading_date = $("#finish_loading_date").val();
        const finish_loading_time = $("#finish_loading_time").val();
        const vehicle_no = $("#vehicle_no").val();
        const driver = $("#driver").val();
        const vehicle_id = $("#vehicle_id").val();
        const transporter = $("#transporter").val();
        const container_no = $("#container_no").val();
        const seal_no = $("#seal_no").val();
        const consignee_name = $("#consignee_name").val();
        const consignee_address = $("#consignee_address").val();
        const consignee_city = $("#consignee_city").val();
        const service_id = $("#service_id").val();
        const remark = $("#remark").val();
        const phone = $("#phone").val();

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

        const arr_qty_request = [];
        $("input[name^='qty_request']").each(function () {
            arr_qty_request.push({
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

        const arr_quantity_details_batch_no = [];
        $("input[name^='quantity_details_batch_no']").each(function () {
            arr_quantity_details_batch_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_quantity_details_sku = [];
        $("input[name^='quantity_details_sku']").each(function () {
            arr_quantity_details_sku.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_quantity_details_part_name = [];
        $("input[name^='quantity_details_part_name']").each(function () {
            arr_quantity_details_part_name.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_quantity_details_available_qty = [];
        $("input[name^='quantity_details_available_qty']").each(function () {
            arr_quantity_details_available_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_quantity_details_expired_date = [];
        $("input[name^='quantity_details_expired_date']").each(function () {
            arr_quantity_details_expired_date.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_quantity_details_gr_id = [];
        $("input[name^='quantity_details_gr_id']").each(function () {
            arr_quantity_details_gr_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_quantity_details_allocated_qty = [];
        $("input[name^='quantity_details_allocated_qty']").each(function () {
            arr_quantity_details_allocated_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("plan_delivery_date",plan_delivery_date);
        formData.append("order_id",order_id);
        formData.append("order_type",order_type);
        formData.append("receipt_no",receipt_no);
        formData.append("supplier_address",supplier_address);
        formData.append("reference_no",reference_no);
        formData.append("supplier_id",supplier_id);
        formData.append("remarks",remarks);
        formData.append("arr_sku_no",JSON.stringify(arr_sku_no));
        formData.append("arr_item_name",JSON.stringify(arr_item_name));
        formData.append("arr_serial_no",JSON.stringify(arr_serial_no));
        formData.append("arr_imei_no",JSON.stringify(arr_imei_no));
        formData.append("arr_part_no",JSON.stringify(arr_part_no));
        formData.append("arr_color",JSON.stringify(arr_color));
        formData.append("arr_size",JSON.stringify(arr_size));
        formData.append("arr_qty_request",JSON.stringify(arr_qty_request));
        formData.append("arr_uom",JSON.stringify(arr_uom));
        formData.append("arr_id_classification",JSON.stringify(arr_id_classification));
        formData.append("arr_classification",JSON.stringify(arr_classification));
        formData.append("arr_quantity_details_batch_no",JSON.stringify(arr_quantity_details_batch_no));
        formData.append("arr_quantity_details_sku",JSON.stringify(arr_quantity_details_sku));
        formData.append("arr_quantity_details_part_name",JSON.stringify(arr_quantity_details_part_name));
        formData.append("arr_quantity_details_available_qty",JSON.stringify(arr_quantity_details_available_qty));
        formData.append("arr_quantity_details_expired_date",JSON.stringify(arr_quantity_details_expired_date));
        formData.append("arr_quantity_details_gr_id",JSON.stringify(arr_quantity_details_gr_id));
        formData.append("arr_quantity_details_allocated_qty",JSON.stringify(arr_quantity_details_allocated_qty));
        formData.append("supervisor",supervisor);
        formData.append("start_loading_date",start_loading_date);
        formData.append("start_loading_time",start_loading_time);
        formData.append("finish_loading_date",finish_loading_date);
        formData.append("finish_loading_time",finish_loading_time);
        formData.append("vehicle_no",vehicle_no);
        formData.append("driver",driver);
        formData.append("vehicle_id",vehicle_id);
        formData.append("transporter",transporter);
        formData.append("container_no",container_no);
        formData.append("seal_no",seal_no);
        formData.append("consignee_name",consignee_name);
        formData.append("consignee_address",consignee_address);
        formData.append("consignee_city",consignee_city);
        formData.append("service_id",service_id);
        formData.append("remark",remark);
        formData.append("phone",phone);
        // formData.append("file_1",$("#file_1").get(0).files[0]);
        // formData.append("file_2",$("#file_2").get(0).files[0]);
        // formData.append("file_3",$("#file_3").get(0).files[0]);

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
                $("#supplier_name").removeClass('is-invalid');
                $("#validation_supplier_name").html('');

                $("input[name^='sku_no']").removeClass('is-invalid');
                $("[id^='validation_sku_no']").html('');
                $("input[name^='item_name']").removeClass('is-invalid');
                $("[id^='validation_item_name']").html('');
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
                $("input[name^='qty_request']").removeClass('is-invalid');
                $("[id^='validation_qty_request']").html('');
                $("input[name^='uom']").removeClass('is-invalid');
                $("[id^='validation_uom']").html('');
                $("input[name^='id_classification']").removeClass('is-invalid');
                $("[id^='validation_id_classification']").html('');
                $("input[name^='classification']").removeClass('is-invalid');
                $("[id^='validation_classification']").html('');

                $("input[name^='quantity_details_batch_no']").removeClass('is-invalid');
                $("[id^='validation_quantity_details_batch_no']").html('');
                $("input[name^='quantity_details_sku']").removeClass('is-invalid');
                $("[id^='validation_quantity_details_sku']").html('');
                $("input[name^='quantity_details_part_name']").removeClass('is-invalid');
                $("[id^='validation_quantity_details_part_name']").html('');
                $("input[name^='quantity_details_available_qty']").removeClass('is-invalid');
                $("[id^='validation_quantity_details_available_qty']").html('');
                $("input[name^='quantity_details_expired_date']").removeClass('is-invalid');
                $("[id^='validation_quantity_details_expired_date']").html('');
                $("input[name^='quantity_details_gr_id']").removeClass('is-invalid');
                $("[id^='validation_quantity_details_gr_id']").html('');
                $("input[name^='quantity_details_allocated_qty']").removeClass('is-invalid');
                $("[id^='validation_quantity_details_allocated_qty']").html('');

                $("#supervisor").removeClass('is-invalid');
                $("#validation_supervisor").html('');
                $("#start_loading_date").removeClass('is-invalid');
                $("#validation_start_loading_date").html('');
                $("#start_loading_time").removeClass('is-invalid');
                $("#validation_start_loading_time").html('');
                $("#finish_loading_date").removeClass('is-invalid');
                $("#validation_finish_loading_date").html('');
                $("#finish_loading_time").removeClass('is-invalid');
                $("#validation_finish_loading_time").html('');
                $("#vehicle_no").removeClass('is-invalid');
                $("#validation_vehicle_no").html('');
                $("#driver").removeClass('is-invalid');
                $("#validation_driver").html('');
                $("#vehicle_type").removeClass('is-invalid');
                $("#validation_vehicle_type").html('');
                $("#transporter_name").removeClass('is-invalid');
                $("#validation_transporter_name").html('');
                $("#container_no").removeClass('is-invalid');
                $("#validation_container_no").html('');
                $("#seal_no").removeClass('is-invalid');
                $("#validation_seal_no").html('');
                $("#consignee_name").removeClass('is-invalid');
                $("#validation_consignee_name").html('');
                $("#consignee_address").removeClass('is-invalid');
                $("#validation_consignee_address").html('');
                $("#consignee_city").removeClass('is-invalid');
                $("#validation_consignee_city").html('');
                $("#service_type").removeClass('is-invalid');
                $("#validation_service_type").html('');
                $("#remark").removeClass('is-invalid');
                $("#validation_remark").html('');
                $("#phone").removeClass('is-invalid');
                $("#validation_phone").html('');
                
                // $("#file_1").removeClass('is-invalid');
                // $("#validation_file_1").html('');
                // $("#file_2").removeClass('is-invalid');
                // $("#validation_file_2").html('');
                // $("#file_3").removeClass('is-invalid');
                // $("#validation_file_3").html('');
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
                window.location = "{{ route('outbound_planning.index') }}";
                return;

            },
        });
    });
});
</script>
@endsection