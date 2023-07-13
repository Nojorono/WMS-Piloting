@extends('layout.app')

@section("title")
Stock Transfer
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
                        <h5 class="me-auto">Stock Transfer - Add</h5>
                        <a href="{{ route('stock_transfer.index') }}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary text-xs py-1">List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('stock_transfer.store') }}" id="form-save-stock-transfer">
                    @method('POST')
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="stock_transfer_id" class="form-label text-xs">Stock Transfer ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="stock_transfer_id" name="stock_transfer_id" value="" readonly>
                                                <div id="validation_stock_transfer_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_name" class="form-label text-xs">Warehouse Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="" readonly>
                                                <div id="validation_warehouse_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="transaction_type" class="form-label text-xs">Transaction Type</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="transaction_type" name="transaction_type" value="" readonly>
                                                <div id="validation_transaction_type" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_transaction_type" id="btn_search_transaction_type"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="remark" class="form-label text-xs">Remark</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="remark" name="remark" value="">
                                                <div id="validation_remark" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_name" class="form-label text-xs">Client Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="" readonly>
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
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" aria-current="true" data-bs-toggle="tab" href="#page-tab--attachment">Attachment</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2">
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-primary me-2 text-xs py-1 mb-0" id="btn_add_row_table_item_detail" name="btn_add_row_table_item_detail">Add</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="table-item-detail" style="min-width: calc(1 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-xs">Source SKU</th>
                                                            <th class="text-center text-xs">Source Item Name</th>
                                                            <th class="text-center text-xs">Destination SKU</th>
                                                            <th class="text-center text-xs">Destination Item Name</th>
                                                            <th class="text-center text-xs">Source Batch No</th>
                                                            <th class="text-center text-xs">Destination Batch No</th>
                                                            <th class="text-center text-xs">Source Serial No</th>
                                                            <th class="text-center text-xs">Destination Serial No</th>
                                                            <th class="text-center text-xs">Source IMEI No</th>
                                                            <th class="text-center text-xs">Destination IMEI No</th>
                                                            <th class="text-center text-xs">Source Part No</th>
                                                            <th class="text-center text-xs">Destination Part No</th>
                                                            <th class="text-center text-xs">Source Color</th>
                                                            <th class="text-center text-xs">Destination Color</th>
                                                            <th class="text-center text-xs">Source Size</th>
                                                            <th class="text-center text-xs">Destination Size</th>
                                                            <th class="text-center text-xs">Source Expired Date</th>
                                                            <th class="text-center text-xs">Destination Exp Date</th>
                                                            <th class="text-center text-xs">Source Qty</th>
                                                            <th class="text-center text-xs">Source UoM</th>
                                                            <th class="text-center text-xs">Destination Qty</th>
                                                            <th class="text-center text-xs">Destination UoM</th>
                                                            <th class="text-center text-xs">Base Qty</th>
                                                            <th class="text-center text-xs">Base UoM</th>
                                                            <th class="text-center text-xs">Source Stock Type</th>
                                                            <th class="text-center text-xs">Destination Stock Type</th>
                                                            <th class="text-center text-xs">Source Location</th>
                                                            <th class="text-center text-xs">Dest Location</th>
                                                            <th class="text-center text-xs">Source GR ID</th>
                                                            <th class="text-center text-xs">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--attachment">
                                    <div class="row ">
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0"name="file_1" id="file_1">
                                            <div id="validation_file_1" class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0"name="file_2" id="file_2">
                                            <div id="validation_file_2" class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0"name="file_3" id="file_3">
                                            <div id="validation_file_3" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-primary text-xs py-1 mb-0">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-TransactionType" tabindex="-1" aria-labelledby="modal-TransactionTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-TransactionTypeLabel">Transaction Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-TransactionType" >
                        <thead>
                            <tr>
                                <th class="text-xs">Transaction Type</th>
                                <th class="text-xs">Transaction Name</th>
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

<div class="modal fade" id="modal-AddRowDetail" tabindex="-1" aria-labelledby="modal-AddRowDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-AddRowDetailLabel">Add row details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-12 mb-2 text-center">
                                        <h5>Source</h5>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_sku" class="form-label text-xs">SKU</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="source_sku" name="source_sku" value="" readonly>
                                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_source_sku" id="btn_search_source_sku"><i class="bi bi-search"></i></button>
                                            <div id="validation_source_sku" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_item_name" class="form-label text-xs">Item Name</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="source_item_name" name="source_item_name" value="" readonly>
                                        <div id="validation_source_item_name" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_batch_no" class="form-label text-xs">Batch No</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="source_batch_no" name="source_batch_no" value="" readonly>
                                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_source_batch_no" id="btn_search_source_batch_no"><i class="bi bi-search"></i></button>
                                            <div id="validation_source_batch_no" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_serial_no" class="form-label text-xs">Serial No</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="source_serial_no" name="source_serial_no" value="" readonly>
                                        <div id="validation_source_serial_no" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_imei_no" class="form-label text-xs">IMEI No</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="source_imei_no" name="source_imei_no" value="" readonly>
                                        <div id="validation_source_imei_no" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_part_no" class="form-label text-xs">Part No</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="source_part_no" name="source_part_no" value="" readonly>
                                        <div id="validation_source_part_no" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_color" class="form-label text-xs">Color</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="source_color" name="source_color" value="" readonly>
                                        <div id="validation_source_color" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_size" class="form-label text-xs">Size</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="source_size" name="source_size" value="" readonly>
                                        <div id="validation_source_size" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_expired_date" class="form-label text-xs">Expired Date</label>
                                        <input type="date" autocomplete="off" class="form-control py-0" id="source_expired_date" name="source_expired_date" value="" readonly>
                                        <div id="validation_source_expired_date" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <label for="source_qty" class="form-label text-xs">Qty</label>
                                        <input type="hidden" name="source_available_qty" id="source_available_qty" value="">
                                        <input type="number" autocomplete="off" class="form-control py-0" id="source_qty" name="source_qty" value="">
                                        <div id="validation_source_qty" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <label for="source_uom" class="form-label text-xs">UoM</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="source_uom" name="source_uom" value="" readonly>
                                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_source_uom" id="btn_search_source_uom"><i class="bi bi-search"></i></button>
                                            <div id="validation_source_uom" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_stock_type" class="form-label text-xs">Stock Type</label>
                                        <div class="input-group">
                                            <input type="hidden" id="source_stock_id" name="source_stock_id" value="">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="source_stock_type" name="source_stock_type" value="" readonly>
                                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_source_stock_type" id="btn_search_source_stock_type"><i class="bi bi-search"></i></button>
                                            <div id="validation_source_stock_type" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_location_id" class="form-label text-xs">Location ID</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="source_location_id" name="source_location_id" value="" readonly>
                                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_source_location_id" id="btn_search_source_location_id"><i class="bi bi-search"></i></button>
                                            <div id="validation_source_location_id" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="source_gr_id" class="form-label text-xs">GR ID</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="source_gr_id" name="source_gr_id" value="" readonly>
                                            <div id="validation_source_gr_id" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-12 mb-2 text-center">
                                        <h5>Destination</h5>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_sku" class="form-label text-xs">SKU</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="destination_sku" name="destination_sku" value="" readonly>
                                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_destination_sku" id="btn_search_destination_sku"><i class="bi bi-search"></i></button>
                                            <div id="validation_destination_sku" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_item_name" class="form-label text-xs">Item Name</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="destination_item_name" name="destination_item_name" value="" readonly>
                                        <div id="validation_destination_item_name" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_batch_no" class="form-label text-xs">Batch No</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="destination_batch_no" name="destination_batch_no" value="">
                                            <div id="validation_destination_batch_no" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_serial_no" class="form-label text-xs">Serial No</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="destination_serial_no" name="destination_serial_no" value="">
                                        <div id="validation_destination_serial_no" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_imei_no" class="form-label text-xs">IMEI No</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="destination_imei_no" name="destination_imei_no" value="">
                                        <div id="validation_destination_imei_no" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_part_no" class="form-label text-xs">Part No</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="destination_part_no" name="destination_part_no" value="">
                                        <div id="validation_destination_part_no" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_color" class="form-label text-xs">Color</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="destination_color" name="destination_color" value="">
                                        <div id="validation_destination_color" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_size" class="form-label text-xs">Size</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="destination_size" name="destination_size" value="">
                                        <div id="validation_destination_size" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_expired_date" class="form-label text-xs">Expired Date</label>
                                        <input type="date" autocomplete="off" class="form-control py-0" id="destination_expired_date" name="destination_expired_date" value="">
                                        <div id="validation_destination_expired_date" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <label for="destination_qty" class="form-label text-xs">Qty</label>
                                        <input type="number" autocomplete="off" class="form-control py-0" id="destination_qty" name="destination_qty" value="" >
                                        <div id="validation_destination_qty" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <label for="destination_uom" class="form-label text-xs">UoM</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="destination_uom" name="destination_uom" value="" readonly>
                                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_destination_uom" id="btn_search_destination_uom"><i class="bi bi-search"></i></button>
                                            <div id="validation_destination_uom" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_stock_type" class="form-label text-xs">Stock Type</label>
                                        <div class="input-group">
                                            <input type="hidden" id="destination_stock_id" name="destination_stock_id" value="">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="destination_stock_type" name="destination_stock_type" value="" readonly>
                                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_destination_stock_type" id="btn_search_destination_stock_type"><i class="bi bi-search"></i></button>
                                            <div id="validation_destination_stock_type" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="destination_location_id" class="form-label text-xs">Location ID</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control py-0" id="destination_location_id" name="destination_location_id" value="" readonly>
                                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_destination_location_id" id="btn_search_destination_location_id"><i class="bi bi-search"></i></button>
                                            <div id="validation_destination_location_id" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2 text-end">
                        <button type="button" class="btn btn-primary text-xs py-1" id="btn_add_data_item_detail" name="btn_add_data_item_detail">Add Row</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-SourceSKU" tabindex="-1" aria-labelledby="modal-SourceSKULabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SourceSKULabel">Source SKU - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SourceSKU" >
                        <thead>
                            <tr>
                                <th class="text-xs">SKU</th>
                                <th class="text-xs">Item Name</th>
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

<div class="modal fade" id="modal-SourceSKUBatchNoSKUDetail" tabindex="-1" aria-labelledby="modal-SourceSKUBatchNoSKUDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SourceSKUBatchNoSKUDetailLabel">Source Batch No and SKU Detail - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SourceSKUBatchNoSKUDetail" >
                        <thead>
                            <tr>
                                <th class="text-xs">SKU</th>
                                <th class="text-xs">Batch No</th>
                                <th class="text-xs">Serial No</th>
                                <th class="text-xs">IMEI</th>
                                <th class="text-xs">Part No</th>
                                <th class="text-xs">Color</th>
                                <th class="text-xs">Size</th>
                                <th class="text-xs">Expired Date</th>
                                <th class="text-xs">Base Qty</th>
                                <th class="text-xs">Base UoM</th>
                                <th class="text-xs">Available Qty</th>
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

<div class="modal fade" id="modal-SourceUOM" tabindex="-1" aria-labelledby="modal-SourceUOMLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SourceUOMLabel">Source UoM - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SourceUOM" >
                        <thead>
                            <tr>
                                <th class="text-xs">UoM Name</th>
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

<div class="modal fade" id="modal-SourceStockType" tabindex="-1" aria-labelledby="modal-SourceStockTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SourceStockTypeLabel">Source Stock Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SourceStockType" >
                        <thead>
                            <tr>
                                <th class="text-xs">Stock ID</th>
                                <th class="text-xs">Stock Type</th>
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

<div class="modal fade" id="modal-SourceLocationID" tabindex="-1" aria-labelledby="modal-SourceLocationIDLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SourceLocationIDLabel">Source Location ID - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SourceLocationID" >
                        <thead>
                            <tr>
                                <th class="text-xs">Location ID</th>
                                <th class="text-xs">GR ID</th>
                                <th class="text-xs">GR Datetime</th>
                                <th class="text-xs">Last Movement ID</th>
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

<div class="modal fade" id="modal-DestinationSKU" tabindex="-1" aria-labelledby="modal-DestinationSKULabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-DestinationSKULabel">Destination SKU - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-DestinationSKU" >
                        <thead>
                            <tr>
                                <th class="text-xs">SKU</th>
                                <th class="text-xs">Item Name</th>
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

<div class="modal fade" id="modal-DestinationUOM" tabindex="-1" aria-labelledby="modal-DestinationUOMLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-DestinationUOMLabel">Destination UoM - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-DestinationUOM" >
                        <thead>
                            <tr>
                                <th class="text-xs">UoM Name</th>
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

<div class="modal fade" id="modal-DestinationStockType" tabindex="-1" aria-labelledby="modal-DestinationStockTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-DestinationStockTypeLabel">Destination Stock Type - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-DestinationStockType" >
                        <thead>
                            <tr>
                                <th class="text-xs">Stock ID</th>
                                <th class="text-xs">Stock Type</th>
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

<div class="modal fade" id="modal-DestinationLocationID" tabindex="-1" aria-labelledby="modal-DestinationLocationIDLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-DestinationLocationIDLabel">Destination Location ID - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-DestinationLocationID" >
                        <thead>
                            <tr>
                                <th class="text-xs">Location ID</th>
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

function deleteRowItemDetail(row) {
    $(`#row_item_detail_${row}`).remove();
}

$(document).ready(function () {
    $("#dropdown_toggle_inventory").prop('aria-expanded',true);
    $("#dropdown_toggle_inventory").addClass('active');
    $("#dropdown_inventory").addClass('show');
    $("#li_stock_transfer").addClass("active");
    $("#a_stock_transfer").addClass("active");

    let current_row_item_detail = 0;

    const validate_Input_File = () => {
        const file_1_size = $("#file_1").get(0).files[0];
        const file_2_size = $("#file_2").get(0).files[0];
        const file_3_size = $("#file_3").get(0).files[0];
        console.log(file_1_size);
        let total_size = 0;
        const max_all_size = 2000000;
        if(typeof file_1_size !== 'undefined'){
            total_size += parseInt(file_1_size.size);
        }
        if(typeof file_2_size !== 'undefined'){
            total_size += parseInt(file_2_size.size);
        }
        if(typeof file_3_size !== 'undefined'){
            total_size += parseInt(file_3_size.size);
        }
        
        if(total_size >= max_all_size){
            return {
                err: true,
                msg: "File is too big, max all file upload only 2MB.",
            }
        }
        return {
            err: false,
            msg: "File size is allowed.",
        }
    }

    $("#btn_search_transaction_type").on("click",function () {
        $("#modal-TransactionType").modal('show');
        $("#list-datatable-modal-TransactionType").DataTable().destroy();
        $("#list-datatable-modal-TransactionType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_transfer.datatablesTransactionType') }}",
            columns:[
                {data: 'transaction_type', searchable: true, className: 'text-xs'},
                {data: 'transaction_name', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-TransactionType > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const transaction_type = $($(dom_tr).children("td")[0]).text(); 
        
        $("#transaction_type").val(transaction_type);
        $("#modal-TransactionType").modal('hide');
    });

    $("#btn_add_row_table_item_detail").on("click",function () {
        $("#modal-AddRowDetail").modal('show');
    });

    $("#btn_search_source_sku").on("click",function () {
        $("#modal-SourceSKU").modal('show');
        $("#list-datatable-modal-SourceSKU").DataTable().destroy();
        $("#list-datatable-modal-SourceSKU").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_transfer.datatablesSKUAndItemName') }}",
            columns:[
                {data: 'sku', searchable: true, className: 'text-xs'},
                {data: 'part_name', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-SourceSKU > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const sku = $($(dom_tr).children("td")[0]).text(); 
        const part_name = $($(dom_tr).children("td")[1]).text(); 
        
        $("#source_sku").val(sku);
        $("#source_item_name").val(part_name);
        $("#modal-SourceSKU").modal('hide');
    });

    $("#btn_search_source_batch_no").on("click",function () {
        const sku = $("#source_sku").val();
        if(sku == ""){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: 'Source SKU cant be empty.',
                type: 'error',
                icon: 'error',
            });
            return;
        }
        $("#modal-SourceSKUBatchNoSKUDetail").modal('show');
        $("#list-datatable-modal-SourceSKUBatchNoSKUDetail").DataTable().destroy();
        $("#list-datatable-modal-SourceSKUBatchNoSKUDetail").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('stock_transfer.datatablesSourceBatchNoandSKUDetail') }}",
                data: {
                    sku: sku,
                },
            },
            columns:[
                {data: 'sku', searchable: true, className: 'text-xs'},
                {data: 'batch_no', searchable: true, className: 'text-xs'},
                {data: 'serial_no', searchable: true, className: 'text-xs'},
                {data: 'imei', searchable: true, className: 'text-xs'},
                {data: 'part_no', searchable: true, className: 'text-xs'},
                {data: 'color', searchable: true, className: 'text-xs'},
                {data: 'size', searchable: true, className: 'text-xs'},
                {data: 'expired_date', searchable: true, className: 'text-xs'},
                {data: 'base_qty', searchable: true, className: 'text-xs'},
                {data: 'base_uom', searchable: true, className: 'text-xs'},
                {data: 'available_qty', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-SourceSKUBatchNoSKUDetail > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        
        const sku = $($(dom_tr).children("td")[0]).text();
        const batch_no = $($(dom_tr).children("td")[1]).text();
        const serial_no = $($(dom_tr).children("td")[2]).text();
        const imei = $($(dom_tr).children("td")[3]).text();
        const part_no = $($(dom_tr).children("td")[4]).text();
        const color = $($(dom_tr).children("td")[5]).text();
        const size = $($(dom_tr).children("td")[6]).text();
        const expired_date = $($(dom_tr).children("td")[7]).text();
        const available_qty = $($(dom_tr).children("td")[10]).text();

        $("#source_batch_no").val(batch_no);
        $("#source_serial_no").val(serial_no);
        $("#source_imei_no").val(imei);
        $("#source_part_no").val(part_no);
        $("#source_color").val(color);
        $("#source_size").val(size);
        $("#source_expired_date").val(expired_date);
        $("#source_qty").val(available_qty);
        $("#source_available_qty").val(available_qty);
        
        $("#modal-SourceSKUBatchNoSKUDetail").modal('hide');
    });
    
    $("#btn_search_source_uom").on("click",function () {
        $("#modal-SourceUOM").modal('show');
        $("#list-datatable-modal-SourceUOM").DataTable().destroy();
        $("#list-datatable-modal-SourceUOM").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_transfer.datatablesUOM') }}",
            columns:[
                {data: 'uom_name', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-SourceUOM > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const uom_name = $($(dom_tr).children("td")[0]).text();
        
        $("#source_uom").val(uom_name);
        $("#modal-SourceUOM").modal('hide');
    });

    $("#btn_search_source_stock_type").on("click",function () {
        $("#modal-SourceStockType").modal('show');
        $("#list-datatable-modal-SourceStockType").DataTable().destroy();
        $("#list-datatable-modal-SourceStockType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_transfer.datatablesStockType') }}",
            columns:[
                {data: 'stock_id', searchable: true, className: 'text-xs'},
                {data: 'stock_type', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-SourceStockType > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const stock_id = $($(dom_tr).children("td")[0]).text();
        const stock_type = $($(dom_tr).children("td")[1]).text();

        $("#source_stock_id").val(stock_id);
        $("#source_stock_type").val(stock_type);
        $("#modal-SourceStockType").modal('hide');
    });
    
    $("#btn_search_source_location_id").on("click",function () {
        const source_sku = $("#source_sku").val();
        const source_batch_no = $("#source_batch_no").val();
        const source_serial_no = $("#source_serial_no").val();
        const source_stock_id  = $("#source_stock_id").val();
        $("#modal-SourceLocationID").modal('show');
        $("#list-datatable-modal-SourceLocationID").DataTable().destroy();
        $("#list-datatable-modal-SourceLocationID").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('stock_transfer.datatablesLocationIDSource') }}",
                data: {
                    sku: source_sku,
                    batch_no: source_batch_no,
                    serial_no: source_serial_no,
                    stock_id: source_stock_id,
                },
            },
            columns:[
                {data: 'location_id', searchable: true, className: 'text-xs'},
                {data: 'gr_id', searchable: true, className: 'text-xs'},
                {data: 'gr_datetime', searchable: true, className: 'text-xs'},
                {data: 'last_movement_id', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-SourceLocationID > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const location_id = $($(dom_tr).children("td")[0]).text();
        const gr_id = $($(dom_tr).children("td")[1]).text();

        $("#source_location_id").val(location_id);
        $("#source_gr_id").val(gr_id);
        $("#modal-SourceLocationID").modal('hide');
    });

    $("#btn_search_destination_sku").on("click",function () {
        $("#modal-DestinationSKU").modal('show');
        $("#list-datatable-modal-DestinationSKU").DataTable().destroy();
        $("#list-datatable-modal-DestinationSKU").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_transfer.datatablesSKUAndItemName') }}",
            columns:[
                {data: 'sku', searchable: true, className: 'text-xs'},
                {data: 'part_name', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-DestinationSKU > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const sku = $($(dom_tr).children("td")[0]).text(); 
        const part_name = $($(dom_tr).children("td")[1]).text(); 
        
        $("#destination_sku").val(sku);
        $("#destination_item_name").val(part_name);
        $("#modal-DestinationSKU").modal('hide');
    });

    $("#btn_search_destination_uom").on("click",function () {
        $("#modal-DestinationUOM").modal('show');
        $("#list-datatable-modal-DestinationUOM").DataTable().destroy();
        $("#list-datatable-modal-DestinationUOM").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_transfer.datatablesUOM') }}",
            columns:[
                {data: 'uom_name', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-DestinationUOM > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const uom_name = $($(dom_tr).children("td")[0]).text();
        
        $("#destination_uom").val(uom_name);
        $("#modal-DestinationUOM").modal('hide');
    });
    
    $("#btn_search_destination_stock_type").on("click",function () {
        $("#modal-DestinationStockType").modal('show');
        $("#list-datatable-modal-DestinationStockType").DataTable().destroy();
        $("#list-datatable-modal-DestinationStockType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_transfer.datatablesStockType') }}",
            columns:[
                {data: 'stock_id', searchable: true, className: 'text-xs'},
                {data: 'stock_type', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-DestinationStockType > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const stock_id = $($(dom_tr).children("td")[0]).text();
        const stock_type = $($(dom_tr).children("td")[1]).text();

        $("#destination_stock_id").val(stock_id);
        $("#destination_stock_type").val(stock_type);
        $("#modal-DestinationStockType").modal('hide');
    });

    $("#btn_search_destination_location_id").on("click",function () {
        $("#modal-DestinationLocationID").modal('show');
        $("#list-datatable-modal-DestinationLocationID").DataTable().destroy();
        $("#list-datatable-modal-DestinationLocationID").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('stock_transfer.datatablesLocationIDDestination') }}",
            },
            columns:[
                {data: 'location_id', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-DestinationLocationID > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const location_id = $($(dom_tr).children("td")[0]).text();

        $("#destination_location_id").val(location_id);
        $("#modal-DestinationLocationID").modal('hide');
    });

    // $("#destination_qty").on("change",function () {
    //     const source_qty = $("#source_qty").val();
    //     const destination_qty = $("#destination_qty").val()
    //     if(
    //         source_qty == "" 
    //         || source_qty == undefined 
    //         || source_qty == 0 
    //         || source_qty == "0"
    //     ){
    //         Swal
    //         .mixin({
    //             customClass: {
    //                 confirmButton: 'btn btn-primary me-2',
    //             },
    //             buttonsStyling: false,
    //         })
    //         .fire({
    //             text: 'Source Qty cant be empty.',
    //             type: 'error',
    //             icon: 'error',
    //         });
    //         $("#destination_qty").val("");
    //         return;
    //     }

    //     if(parseInt(destination_qty) > parseInt(source_qty)){
    //         Swal
    //         .mixin({
    //             customClass: {
    //                 confirmButton: 'btn btn-primary me-2',
    //             },
    //             buttonsStyling: false,
    //         })
    //         .fire({
    //             text: 'Destination Qty cant be more than Source Qty.',
    //             type: 'error',
    //             icon: 'error',
    //         });
    //         $("#destination_qty").val("");
    //         return;
    //     }
    // });

    $("#btn_add_data_item_detail").on("click",function () {

        current_row_item_detail++;
        const source_sku = $("#source_sku").val();
        const source_item_name = $("#source_item_name").val();
        const source_batch_no = $("#source_batch_no").val();
        const source_serial_no = $("#source_serial_no").val();
        const source_imei_no = $("#source_imei_no").val();
        const source_part_no = $("#source_part_no").val();
        const source_color = $("#source_color").val();
        const source_size = $("#source_size").val();
        const source_expired_date = $("#source_expired_date").val();
        const source_qty = $("#source_qty").val();
        const source_uom = $("#source_uom").val();
        const source_stock_id = $("#source_stock_id").val();
        const source_stock_type = $("#source_stock_type").val();
        const source_location_id = $("#source_location_id").val();
        const source_gr_id = $("#source_gr_id").val();

        const destination_sku = $("#destination_sku").val();
        const destination_item_name = $("#destination_item_name").val();
        const destination_batch_no = $("#destination_batch_no").val();
        const destination_serial_no = $("#destination_serial_no").val();
        const destination_imei_no = $("#destination_imei_no").val();
        const destination_part_no = $("#destination_part_no").val();
        const destination_color = $("#destination_color").val();
        const destination_size = $("#destination_size").val();
        const destination_expired_date = $("#destination_expired_date").val();
        const destination_qty = $("#destination_qty").val();
        const destination_uom = $("#destination_uom").val();
        const destination_stock_id = $("#destination_stock_id").val();
        const destination_stock_type = $("#destination_stock_type").val();
        const destination_location_id = $("#destination_location_id").val();

        const source_available_qty = $("#source_available_qty").val();

        if( source_qty < 0){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Qty cant be minus.",
                type: 'error',
                icon: 'error',
            });
            return;
        }

        if( destination_qty < 0){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Qty cant be minus.",
                type: 'error',
                icon: 'error',
            });
            return;
        }

        if(source_qty > source_available_qty){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Source Qty is more than Available Qty",
                type: 'error',
                icon: 'error',
            });
            return;
        }

        if(
            source_sku === destination_sku &&
            source_item_name === destination_item_name &&
            source_batch_no === destination_batch_no &&
            source_serial_no === destination_serial_no &&
            source_imei_no === destination_imei_no &&
            source_part_no === destination_part_no &&
            source_color === destination_color &&
            source_size === destination_size &&
            source_expired_date === destination_expired_date &&
            source_uom === destination_uom &&
            source_stock_id === destination_stock_id &&
            source_stock_type === destination_stock_type &&
            source_location_id === destination_location_id &&
            source_qty !== destination_qty 
        ){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Data too identic, please check again.",
                type: 'error',
                icon: 'error',
            });
            return;
        }

        let html_detail = ``;
        html_detail += `<tr id="row_item_detail_${current_row_item_detail}">
            <td class="text-center">
                ${source_sku}
                <input type="hidden" class="form-control py-0" name="source_sku[]" id="source_sku_${current_row_item_detail}" value="${source_sku}" >
                <div id="validation_source_sku_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_item_name}
                <input type="hidden" class="form-control py-0" name="source_item_name[]" id="source_item_name_${current_row_item_detail}" value="${source_item_name}" >
                <div id="validation_source_item_name_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_sku}
                <input type="hidden" class="form-control py-0" name="destination_sku[]" id="destination_sku_${current_row_item_detail}" value="${destination_sku}" >
                <div id="validation_destination_sku_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_item_name}
                <input type="hidden" class="form-control py-0" name="destination_item_name[]" id="destination_item_name_${current_row_item_detail}" value="${destination_item_name}" >
                <div id="validation_destination_item_name_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_batch_no}
                <input type="hidden" class="form-control py-0" name="source_batch_no[]" id="source_batch_no_${current_row_item_detail}" value="${source_batch_no}" >
                <div id="validation_source_batch_no_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_batch_no}
                <input type="hidden" class="form-control py-0" name="destination_batch_no[]" id="destination_batch_no_${current_row_item_detail}" value="${destination_batch_no}" >
                <div id="validation_destination_batch_no_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_serial_no}
                <input type="hidden" class="form-control py-0" name="source_serial_no[]" id="source_serial_no_${current_row_item_detail}" value="${source_serial_no}" >
                <div id="validation_source_serial_no_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_serial_no}
                <input type="hidden" class="form-control py-0" name="destination_serial_no[]" id="destination_serial_no_${current_row_item_detail}" value="${destination_serial_no}" >
                <div id="validation_destination_serial_no_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_imei_no}
                <input type="hidden" class="form-control py-0" name="source_imei_no[]" id="source_imei_no_${current_row_item_detail}" value="${source_imei_no}" >
                <div id="validation_source_imei_no_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_imei_no}
                <input type="hidden" class="form-control py-0" name="destination_imei_no[]" id="destination_imei_no_${current_row_item_detail}" value="${destination_imei_no}" >
                <div id="validation_destination_imei_no_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_part_no}
                <input type="hidden" class="form-control py-0" name="source_part_no[]" id="source_part_no_${current_row_item_detail}" value="${source_part_no}" >
                <div id="validation_source_part_no_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_part_no}
                <input type="hidden" class="form-control py-0" name="destination_part_no[]" id="destination_part_no_${current_row_item_detail}" value="${destination_part_no}" >
                <div id="validation_destination_part_no_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_color}
                <input type="hidden" class="form-control py-0" name="source_color[]" id="source_color_${current_row_item_detail}" value="${source_color}" >
                <div id="validation_source_color_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_color}
                <input type="hidden" class="form-control py-0" name="destination_color[]" id="destination_color_${current_row_item_detail}" value="${destination_color}" >
                <div id="validation_destination_color_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_size}
                <input type="hidden" class="form-control py-0" name="source_size[]" id="source_size_${current_row_item_detail}" value="${source_size}" >
                <div id="validation_source_size_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_size}
                <input type="hidden" class="form-control py-0" name="destination_size[]" id="destination_size_${current_row_item_detail}" value="${destination_size}" >
                <div id="validation_destination_size_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_expired_date}
                <input type="hidden" class="form-control py-0" name="source_expired_date[]" id="source_expired_date_${current_row_item_detail}" value="${source_expired_date}" >
                <div id="validation_source_expired_date_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_expired_date}
                <input type="hidden" class="form-control py-0" name="destination_expired_date[]" id="destination_expired_date_${current_row_item_detail}" value="${destination_expired_date}" >
                <div id="validation_destination_expired_date_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_qty}
                <input type="hidden" class="form-control py-0" name="source_qty[]" id="source_qty_${current_row_item_detail}" value="${source_qty}" >
                <div id="validation_source_qty_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_uom}
                <input type="hidden" class="form-control py-0" name="source_uom[]" id="source_uom_${current_row_item_detail}" value="${source_uom}" >
                <div id="validation_source_uom_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_qty}
                <input type="hidden" class="form-control py-0" name="destination_qty[]" id="destination_qty_${current_row_item_detail}" value="${destination_qty}" >
                <div id="validation_destination_qty_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_uom}
                <input type="hidden" class="form-control py-0" name="destination_uom[]" id="destination_uom_${current_row_item_detail}" value="${destination_uom}" >
                <div id="validation_destination_uom_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                
                <input type="hidden" class="form-control py-0" name="source_base_qty[]" id="source_base_qty_${current_row_item_detail}" value="" >
                <div id="validation_source_base_qty_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                
                <input type="hidden" class="form-control py-0" name="source_base_uom[]" id="source_base_uom_${current_row_item_detail}" value="" >
                <div id="validation_source_base_uom_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_stock_type}
                <input type="hidden" name="source_stock_id[]" id="source_stock_id_${current_row_item_detail}" value="${source_stock_id}">    
                <input type="hidden" class="form-control py-0" name="source_stock_type[]" id="source_stock_type_${current_row_item_detail}" value="${source_stock_type}" >
                <div id="validation_source_stock_type_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_stock_type}
                <input type="hidden" name="destination_stock_id[]" id="destination_stock_id_${current_row_item_detail}" value="${destination_stock_id}"> 
                <input type="hidden" class="form-control py-0" name="destination_stock_type[]" id="destination_stock_type_${current_row_item_detail}" value="${destination_stock_type}" >
                <div id="validation_destination_stock_type_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_location_id}
                <input type="hidden" class="form-control py-0" name="source_location_id[]" id="source_location_id_${current_row_item_detail}" value="${source_location_id}" >
                <div id="validation_source_location_id_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${destination_location_id}
                <input type="hidden" class="form-control py-0" name="destination_location_id[]" id="destination_location_id_${current_row_item_detail}" value="${destination_location_id}" >
                <div id="validation_destination_location_id_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                ${source_gr_id}
                <input type="hidden" class="form-control py-0" name="source_gr_id[]" id="source_gr_id_${current_row_item_detail}" value="${source_gr_id}" >
                <div id="validation_source_gr_id_${current_row_item_detail}" class="invalid-feedback"></div>
            </td>
            <td class="text-center">
                <button type="button" name="btn_delete_item_${current_row_item_detail}" id="btn_delete_item_${current_row_item_detail}" class="btn btn-primary text-xs py-1" onclick="deleteRowItemDetail('${current_row_item_detail}')">Delete</button>
            </td>
        </tr>`;
        $("#table-item-detail tbody").append(html_detail);

        $("#modal-AddRowDetail").modal('hide');
    });

    $("#form-save-stock-transfer").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = $("input[name='_method']").val();
        const transaction_type = $("#transaction_type").val();
        const remark = $("#remark").val();

        const arr_source_sku = [];
        $("#container-item-detail input[name^='source_sku']").each(function () {
            arr_source_sku.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_item_name = [];
        $("#container-item-detail input[name^='source_item_name']").each(function () {
            arr_source_item_name.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_sku = [];
        $("#container-item-detail input[name^='destination_sku']").each(function () {
            arr_destination_sku.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_item_name = [];
        $("#container-item-detail input[name^='destination_item_name']").each(function () {
            arr_destination_item_name.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_batch_no = [];
        $("#container-item-detail input[name^='source_batch_no']").each(function () {
            arr_source_batch_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_batch_no = [];
        $("#container-item-detail input[name^='destination_batch_no']").each(function () {
            arr_destination_batch_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_serial_no = [];
        $("#container-item-detail input[name^='source_serial_no']").each(function () {
            arr_source_serial_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_serial_no = [];
        $("#container-item-detail input[name^='destination_serial_no']").each(function () {
            arr_destination_serial_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_imei_no = [];
        $("#container-item-detail input[name^='source_imei_no']").each(function () {
            arr_source_imei_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_imei_no = [];
        $("#container-item-detail input[name^='destination_imei_no']").each(function () {
            arr_destination_imei_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_part_no = [];
        $("#container-item-detail input[name^='source_part_no']").each(function () {
            arr_source_part_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_part_no = [];
        $("#container-item-detail input[name^='destination_part_no']").each(function () {
            arr_destination_part_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_color = [];
        $("#container-item-detail input[name^='source_color']").each(function () {
            arr_source_color.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_color = [];
        $("#container-item-detail input[name^='destination_color']").each(function () {
            arr_destination_color.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_size = [];
        $("#container-item-detail input[name^='source_size']").each(function () {
            arr_source_size.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_size = [];
        $("#container-item-detail input[name^='destination_size']").each(function () {
            arr_destination_size.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_expired_date = [];
        $("#container-item-detail input[name^='source_expired_date']").each(function () {
            arr_source_expired_date.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_expired_date = [];
        $("#container-item-detail input[name^='destination_expired_date']").each(function () {
            arr_destination_expired_date.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_qty = [];
        $("#container-item-detail input[name^='source_qty']").each(function () {
            arr_source_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_uom = [];
        $("#container-item-detail input[name^='source_uom']").each(function () {
            arr_source_uom.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_qty = [];
        $("#container-item-detail input[name^='destination_qty']").each(function () {
            arr_destination_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_uom = [];
        $("#container-item-detail input[name^='destination_uom']").each(function () {
            arr_destination_uom.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_base_qty = [];
        $("#container-item-detail input[name^='source_base_qty']").each(function () {
            arr_source_base_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_base_uom = [];
        $("#container-item-detail input[name^='source_base_uom']").each(function () {
            arr_source_base_uom.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_stock_id = [];
        $("#container-item-detail input[name^='source_stock_id']").each(function () {
            arr_source_stock_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_stock_type = [];
        $("#container-item-detail input[name^='source_stock_type']").each(function () {
            arr_source_stock_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });
        
        const arr_destination_stock_id = [];
        $("#container-item-detail input[name^='destination_stock_id']").each(function () {
            arr_destination_stock_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });
        
        const arr_destination_stock_type = [];
        $("#container-item-detail input[name^='destination_stock_type']").each(function () {
            arr_destination_stock_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_location_id = [];
        $("#container-item-detail input[name^='source_location_id']").each(function () {
            arr_source_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_destination_location_id = [];
        $("#container-item-detail input[name^='destination_location_id']").each(function () {
            arr_destination_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_source_gr_id = [];
        $("#container-item-detail input[name^='source_gr_id']").each(function () {
            arr_source_gr_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const check_Validation_Input_File = validate_Input_File();
        if('err' in check_Validation_Input_File){
            if(check_Validation_Input_File.err){
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: check_Validation_Input_File.msg,
                    type: 'error',
                    icon: 'error',
                });
                return;
            }
        }
        
        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("transaction_type",transaction_type);
        formData.append("remark",remark);
        formData.append("arr_source_sku",JSON.stringify(arr_source_sku));
        formData.append("arr_source_item_name",JSON.stringify(arr_source_item_name));
        formData.append("arr_destination_sku",JSON.stringify(arr_destination_sku));
        formData.append("arr_destination_item_name",JSON.stringify(arr_destination_item_name));
        formData.append("arr_source_batch_no",JSON.stringify(arr_source_batch_no));
        formData.append("arr_destination_batch_no",JSON.stringify(arr_destination_batch_no));
        formData.append("arr_source_serial_no",JSON.stringify(arr_source_serial_no));
        formData.append("arr_destination_serial_no",JSON.stringify(arr_destination_serial_no));
        formData.append("arr_source_imei_no",JSON.stringify(arr_source_imei_no));
        formData.append("arr_destination_imei_no",JSON.stringify(arr_destination_imei_no));
        formData.append("arr_source_part_no",JSON.stringify(arr_source_part_no));
        formData.append("arr_destination_part_no",JSON.stringify(arr_destination_part_no));
        formData.append("arr_source_color",JSON.stringify(arr_source_color));
        formData.append("arr_destination_color",JSON.stringify(arr_destination_color));
        formData.append("arr_source_size",JSON.stringify(arr_source_size));
        formData.append("arr_destination_size",JSON.stringify(arr_destination_size));
        formData.append("arr_source_expired_date",JSON.stringify(arr_source_expired_date));
        formData.append("arr_destination_expired_date",JSON.stringify(arr_destination_expired_date));
        formData.append("arr_source_qty",JSON.stringify(arr_source_qty));
        formData.append("arr_source_uom",JSON.stringify(arr_source_uom));
        formData.append("arr_destination_qty",JSON.stringify(arr_destination_qty));
        formData.append("arr_destination_uom",JSON.stringify(arr_destination_uom));
        formData.append("arr_source_base_qty",JSON.stringify(arr_source_base_qty));
        formData.append("arr_source_base_uom",JSON.stringify(arr_source_base_uom));
        formData.append("arr_source_stock_id",JSON.stringify(arr_source_stock_id));
        formData.append("arr_source_stock_type",JSON.stringify(arr_source_stock_type));
        formData.append("arr_destination_stock_id",JSON.stringify(arr_destination_stock_id));
        formData.append("arr_destination_stock_type",JSON.stringify(arr_destination_stock_type));
        formData.append("arr_source_location_id",JSON.stringify(arr_source_location_id));
        formData.append("arr_destination_location_id",JSON.stringify(arr_destination_location_id));
        formData.append("arr_source_gr_id",JSON.stringify(arr_source_gr_id));
        formData.append("file_1",$("#file_1").get(0).files[0]);
        formData.append("file_2",$("#file_2").get(0).files[0]);
        formData.append("file_3",$("#file_3").get(0).files[0]);

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

                $("#container-item-detail input[name^='source_sku']").removeClass('is-invalid');
                $("[id^='validation_source_sku']").html('');
                $("#container-item-detail input[name^='source_item_name']").removeClass('is-invalid');
                $("[id^='validation_source_item_name']").html('');
                $("#container-item-detail input[name^='destination_sku']").removeClass('is-invalid');
                $("[id^='validation_destination_sku']").html('');
                $("#container-item-detail input[name^='destination_item_name']").removeClass('is-invalid');
                $("[id^='validation_destination_item_name']").html('');
                $("#container-item-detail input[name^='source_batch_no']").removeClass('is-invalid');
                $("[id^='validation_source_batch_no']").html('');
                $("#container-item-detail input[name^='destination_batch_no']").removeClass('is-invalid');
                $("[id^='validation_destination_batch_no']").html('');
                $("#container-item-detail input[name^='source_serial_no']").removeClass('is-invalid');
                $("[id^='validation_source_serial_no']").html('');
                $("#container-item-detail input[name^='destination_serial_no']").removeClass('is-invalid');
                $("[id^='validation_destination_serial_no']").html('');
                $("#container-item-detail input[name^='source_imei_no']").removeClass('is-invalid');
                $("[id^='validation_source_imei_no']").html('');
                $("#container-item-detail input[name^='destination_imei_no']").removeClass('is-invalid');
                $("[id^='validation_destination_imei_no']").html('');
                $("#container-item-detail input[name^='source_part_no']").removeClass('is-invalid');
                $("[id^='validation_source_part_no']").html('');
                $("#container-item-detail input[name^='destination_part_no']").removeClass('is-invalid');
                $("[id^='validation_destination_part_no']").html('');
                $("#container-item-detail input[name^='source_color']").removeClass('is-invalid');
                $("[id^='validation_source_color']").html('');
                $("#container-item-detail input[name^='destination_color']").removeClass('is-invalid');
                $("[id^='validation_destination_color']").html('');
                $("#container-item-detail input[name^='source_size']").removeClass('is-invalid');
                $("[id^='validation_source_size']").html('');
                $("#container-item-detail input[name^='destination_size']").removeClass('is-invalid');
                $("[id^='validation_destination_size']").html('');
                $("#container-item-detail input[name^='source_expired_date']").removeClass('is-invalid');
                $("[id^='validation_source_expired_date']").html('');
                $("#container-item-detail input[name^='destination_expired_date']").removeClass('is-invalid');
                $("[id^='validation_destination_expired_date']").html('');
                $("#container-item-detail input[name^='source_qty']").removeClass('is-invalid');
                $("[id^='validation_source_qty']").html('');
                $("#container-item-detail input[name^='source_uom']").removeClass('is-invalid');
                $("[id^='validation_source_uom']").html('');
                $("#container-item-detail input[name^='destination_qty']").removeClass('is-invalid');
                $("[id^='validation_destination_qty']").html('');
                $("#container-item-detail input[name^='destination_uom']").removeClass('is-invalid');
                $("[id^='validation_destination_uom']").html('');
                $("#container-item-detail input[name^='source_base_qty']").removeClass('is-invalid');
                $("[id^='validation_source_base_qty']").html('');
                $("#container-item-detail input[name^='source_base_uom']").removeClass('is-invalid');
                $("[id^='validation_source_base_uom']").html('');
                $("#container-item-detail input[name^='source_stock_id']").removeClass('is-invalid');
                $("[id^='validation_source_stock_id']").html('');
                $("#container-item-detail input[name^='source_stock_type']").removeClass('is-invalid');
                $("[id^='validation_source_stock_type']").html('');
                $("#container-item-detail input[name^='destination_stock_id']").removeClass('is-invalid');
                $("[id^='validation_destination_stock_id']").html('');
                $("#container-item-detail input[name^='destination_stock_type']").removeClass('is-invalid');
                $("[id^='validation_destination_stock_type']").html('');
                $("#container-item-detail input[name^='source_location_id']").removeClass('is-invalid');
                $("[id^='validation_source_location_id']").html('');
                $("#container-item-detail input[name^='destination_location_id']").removeClass('is-invalid');
                $("[id^='validation_destination_location_id']").html('');
                $("#container-item-detail input[name^='source_gr_id']").removeClass('is-invalid');
                $("[id^='validation_source_gr_id']").html('');

                $("#file_1").removeClass('is-invalid');
                $("#validation_file_1").html('');
                $("#file_2").removeClass('is-invalid');
                $("#validation_file_2").html('');
                $("#file_3").removeClass('is-invalid');
                $("#validation_file_3").html('');
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
                
                window.location = "{{ route('stock_transfer.index') }}";
                return;

            },
        });

    });
});
</script>
@endsection
