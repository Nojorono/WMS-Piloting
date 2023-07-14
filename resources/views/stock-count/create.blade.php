@extends('layout.app')

@section("title")
Stock Count
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
                        <h5 class="me-auto">Stock Count - Add</h5>
                        <a href="{{ route("stock_count.index") }}" class="text-decoration-none ms-auto me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" id="btn_list" name="btn_list">List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('stock_count.store') }}" id="form-save-stock-count">
                    @method('POST')
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="stock_count_id" class="form-label text-xs">Stock Count ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="stock_count_id" name="stock_count_id" value="" readonly>
                                                <div id="validation_stock_count_id" class="invalid-feedback"></div>
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
                                                <label for="count_date" class="form-label text-xs">Count Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="count_date" name="count_date" value="">
                                                <div id="validation_count_date" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="remark" class="form-label text-xs">Remark</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="remark" name="remark" value="" readonly>
                                                <div id="validation_remark" class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_remark" id="btn_search_remark"><i class="bi bi-search"></i></button>
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
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="count_no" class="form-label text-xs">Count No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="count_no" name="count_no" value="Count 1" readonly>
                                                <div id="validation_count_no" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link text-xs active" aria-current="true" data-bs-toggle="tab" href="#page-tab--item-detail">Item Details</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <button type="button" class="btn btn-primary text-xs py-1 mb-0" name="btn_criteria" id="btn_criteria">Criteria</button>
                                        </div>
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-item-detail" style="min-width: calc(1 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center text-xs">Location ID</th>
                                                            <th class="text-center text-xs">SKU No</th>
                                                            <th class="text-center text-xs">Item Name</th>
                                                            <th class="text-center text-xs">Batch No</th>
                                                            <th class="text-center text-xs">Serial No</th>
                                                            <th class="text-center text-xs">IMEI No</th>
                                                            <th class="text-center text-xs">Part No</th>
                                                            <th class="text-center text-xs">Color</th>
                                                            <th class="text-center text-xs">Size</th>
                                                            <th class="text-center text-xs">Expired Date</th>
                                                            <th class="text-center text-xs">On Hand Qty</th>
                                                            <th class="text-center text-xs">UOM</th>
                                                            <th class="text-center text-xs">Stock ID</th>
                                                            <th class="text-center text-xs">GR ID</th>
                                                            <th class="text-center text-xs">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
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
                        <button type="submit" class="btn btn-primary text-xs py-1 mb-0">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Remark" tabindex="-1" aria-labelledby="modal-RemarkLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-RemarkLabel">Remark - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Remark" >
                        <thead>
                            <tr>
                                <th class="text-xs">Type Code</th>
                                <th class="text-xs">Type Name</th>
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

<div class="modal fade" id="modal-Criteria" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modal-CriteriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-CriteriaLabel">Stock Count Criteria</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <label for="criteria_sku" class="form-label text-xs">SKU</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_sku" name="criteria_sku" value="" readonly>
                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_criteria_sku" id="btn_search_criteria_sku"><i class="bi bi-search"></i></button>
                            <div id="validation_criteria_sku" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="criteria_item_name" class="form-label text-xs">Item Name</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_item_name" name="criteria_item_name" value="" readonly>
                            <div id="validation_criteria_item_name" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="criteria_batch_no" class="form-label text-xs">Batch No</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_batch_no" name="criteria_batch_no" value="" readonly>
                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_criteria_batch_no" id="btn_search_criteria_batch_no"><i class="bi bi-search"></i></button>
                            <div id="validation_criteria_batch_no" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="criteria_imei_no" class="form-label text-xs">IMEI No</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_imei_no" name="criteria_imei_no" value="" readonly>
                            <div id="validation_criteria_imei_no" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="criteria_part_no" class="form-label text-xs">Part No</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_part_no" name="criteria_part_no" value="" readonly>
                            <div id="validation_criteria_part_no" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="criteria_color" class="form-label text-xs">Color</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_color" name="criteria_color" value="" readonly>
                            <div id="validation_criteria_color" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="criteria_size" class="form-label text-xs">Size</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_size" name="criteria_size" value="" readonly>
                            <div id="validation_criteria_size" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="criteria_stock_type" class="form-label text-xs">Stock Type</label>
                        <div class="input-group">
                            <input type="hidden" id="criteria_stock_id" name="criteria_stock_id" value="">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_stock_type" name="criteria_stock_type" value="" readonly>
                            <div id="validation_criteria_stock_type" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="criteria_location_type" class="form-label text-xs">Location Type</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_location_type" name="criteria_location_type" value="" readonly>
                            <div id="validation_criteria_location_type" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <label for="criteria_location_id_from" class="form-label text-xs">Location ID From</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_location_id_from" name="criteria_location_id_from" value="" readonly>
                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_criteria_location_id_from" id="btn_search_criteria_location_id_from"><i class="bi bi-search"></i></button>
                            <div id="validation_criteria_location_id_from" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <label for="criteria_location_id_to" class="form-label text-xs">Location ID To</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" class="form-control py-0" id="criteria_location_id_to" name="criteria_location_id_to" value="" readonly>
                            <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_criteria_location_id_to" id="btn_search_criteria_location_id_to"><i class="bi bi-search"></i></button>
                            <div id="validation_criteria_location_id_to" class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary text-xs py-1 mb-0" name="btn_apply_criteria" id="btn_apply_criteria">Apply</button>
                <button type="button" class="btn btn-primary text-xs py-1 mb-0" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Criteria-SKU" tabindex="-1" aria-labelledby="modal-Criteria-SKULabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-Criteria-SKULabel">Criteria SKU - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Criteria-SKU" >
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


<div class="modal fade" id="modal-Criteria-Batch-No" tabindex="-1" aria-labelledby="modal-Criteria-Batch-NoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-Criteria-Batch-NoLabel">Criteria Batch No - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Criteria-Batch-No" >
                        <thead>
                            <tr>
                                <th class="text-xs">SKU</th>
                                <th class="text-xs">Item Name</th>
                                <th class="text-xs">Batch No</th>
                                <th class="text-xs">Stock ID</th>
                                <th class="text-xs">Location Type</th>
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

<div class="modal fade" id="modal-Criteria-Location-From" tabindex="-1" aria-labelledby="modal-Criteria-Location-FromLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-Criteria-Location-FromLabel">Location From - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Criteria-Location-From" >
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

<div class="modal fade" id="modal-Criteria-Location-To" tabindex="-1" aria-labelledby="modal-Criteria-Location-ToLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-Criteria-Location-ToLabel">Location To - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Criteria-Location-To" >
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
    $("#logo_inventory").addClass("d-none");
    $("#logo_white_inventory").removeClass("d-none");
    $("#li_stock_count").addClass("active");
    $("#a_stock_count").addClass("active");

    let row_item_detail = 0;
    $("#btn_search_remark").on("click",function () {
        $("#modal-Remark").modal('show');
        $("#list-datatable-modal-Remark").DataTable().destroy();
        $("#list-datatable-modal-Remark").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('stock_count.datatablesRemark') }}",
            columns:[
                {data: 'type_code', searchable: true, className: 'text-xs'},
                {data: 'type_name', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-Remark > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const type_code = $($(dom_tr).children("td")[0]).text(); 
        
        $("#remark").val(type_code);
        $("#modal-Remark").modal('hide');
    });

    $("#btn_search_criteria_sku").on("click",function () {
        $("#modal-Criteria-SKU").modal('show');
        $("#list-datatable-modal-Criteria-SKU").DataTable().destroy();
        $("#list-datatable-modal-Criteria-SKU").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url : "{{ route('stock_count.datatablesCriteriaSKU') }}",
            },
            columns:[
                {data: 'sku', searchable: true, className: 'text-xs'},
                {data: 'part_name', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-Criteria-SKU > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const sku = $($(dom_tr).children("td")[0]).text(); 
        const part_name = $($(dom_tr).children("td")[1]).text(); 
        
        $("#criteria_sku").val(sku);
        $("#criteria_item_name").val(part_name);
        $("#modal-Criteria-SKU").modal('hide');
    });

    $("#btn_search_criteria_batch_no").on("click",function () {
        const criteria_sku = $("#criteria_sku").val();
        if(criteria_sku == ""){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: 'Criteria SKU Required',
                type: 'error',
                icon: 'error',
            });
            return;
        }

        $("#modal-Criteria-Batch-No").modal('show');
        $("#list-datatable-modal-Criteria-Batch-No").DataTable().destroy();
        $("#list-datatable-modal-Criteria-Batch-No").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url : "{{ route('stock_count.datatablesCriteriaBatchNo') }}",
                data : {
                    criteria_sku: criteria_sku,
                },
            },
            columns:[
                {data: 'sku', searchable: true, className: 'text-xs'},
                {data: 'part_name', searchable: true, className: 'text-xs'},
                {data: 'batch_no', searchable: true, className: 'text-xs'},
                {data: 'stock_id', searchable: true, className: 'text-xs'},
                {data: 'location_type', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-Criteria-Batch-No > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const batch_no = $($(dom_tr).children("td")[2]).text(); 
        const stock_id = $($(dom_tr).children("td")[3]).text(); 
        const location_type = $($(dom_tr).children("td")[4]).text(); 
        
        $("#criteria_batch_no").val(batch_no);
        $("#criteria_stock_id").val(stock_id);
        $("#criteria_stock_type").val(stock_id);
        $("#criteria_location_type").val(location_type);
        $("#modal-Criteria-Batch-No").modal('hide');
    });

    $("#btn_search_criteria_location_id_from").on("click",function () {
        const criteria_sku = $("#criteria_sku").val();
        $("#modal-Criteria-Location-From").modal('show');
        $("#list-datatable-modal-Criteria-Location-From").DataTable().destroy();
        $("#list-datatable-modal-Criteria-Location-From").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url : "{{ route('stock_count.datatablesCriteriaLocation') }}",
                data : {
                    criteria_sku: criteria_sku,
                },
            },
            columns:[
                {data: 'location_id', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-Criteria-Location-From > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const location_id = $($(dom_tr).children("td")[0]).text();
        $("#criteria_location_id_from").val(location_id);
        $("#modal-Criteria-Location-From").modal('hide');
    });

    $("#btn_search_criteria_location_id_to").on("click",function () {
        const criteria_sku = $("#criteria_sku").val();
        $("#modal-Criteria-Location-To").modal('show');
        $("#list-datatable-modal-Criteria-Location-To").DataTable().destroy();
        $("#list-datatable-modal-Criteria-Location-To").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url : "{{ route('stock_count.datatablesCriteriaLocation') }}",
                data : {
                    criteria_sku: criteria_sku,
                },
            },
            columns:[
                {data: 'location_id', searchable: true, className: 'text-xs'},
            ],
        });
    });
    
    $("#list-datatable-modal-Criteria-Location-To > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const location_id = $($(dom_tr).children("td")[0]).text();
        $("#criteria_location_id_to").val(location_id);
        $("#modal-Criteria-Location-To").modal('hide');
    });

    $("#btn_criteria").on("click",function () {
        $("#criteria_sku").val("");
        $("#criteria_item_name").val("");
        $("#criteria_batch_no").val("");
        $("#criteria_imei_no").val("");
        $("#criteria_part_no").val("");
        $("#criteria_color").val("");
        $("#criteria_size").val("");
        $("#criteria_stock_id").val("");
        $("#criteria_stock_type").val("");
        $("#criteria_location_type").val("");
        $("#criteria_location_id_from").val("");
        $("#criteria_location_id_to").val("");
        $("#modal-Criteria").modal("show");
    });
    
    $("#btn_apply_criteria").on("click",function () {
        
        const criteria_sku = $("#criteria_sku").val();
        // const criteria_item_name = $("#criteria_item_name").val();
        const criteria_batch_no = $("#criteria_batch_no").val();
        // const criteria_imei_no = $("#criteria_imei_no").val();
        // const criteria_part_no = $("#criteria_part_no").val();
        // const criteria_color = $("#criteria_color").val();
        // const criteria_size = $("#criteria_size").val();
        const criteria_stock_id = $("#criteria_stock_id").val();
        // const criteria_stock_type = $("#criteria_stock_type").val();
        const criteria_location_type = $("#criteria_location_type").val();
        const criteria_location_id_from = $("#criteria_location_id_from").val();
        const criteria_location_id_to = $("#criteria_location_id_to").val();

        const url = "{{ route('stock_count.getCriteriaApply') }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("criteria_sku",criteria_sku);
        formData.append("criteria_batch_no",criteria_batch_no);
        formData.append("criteria_stock_id",criteria_stock_id);
        formData.append("criteria_location_type",criteria_location_type);
        formData.append("criteria_location_id_from",criteria_location_id_from);
        formData.append("criteria_location_id_to",criteria_location_id_to);
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

                if('data' in response ){
                    if(response.data.length > 0){
                        let html = '';
                        let error_data = '';
                        response.data.forEach((element,index) => {
                            row_item_detail++;
                            const batch_no = (element.batch_no) ? element.batch_no : "";
                            const color = (element.color) ? element.color : "";
                            const expired_date = (element.expired_date) ? element.expired_date : "";
                            const imei = (element.imei) ? element.imei : "";
                            const location_id = (element.location_id) ? element.location_id : "";
                            const on_hand_qty = (element.on_hand_qty) ? element.on_hand_qty : "";
                            const item_name = (element.part_name) ? element.part_name : "";
                            const part_no = (element.part_no) ? element.part_no : "";
                            const serial_no = (element.serial_no) ? element.serial_no : "";
                            const size = (element.size) ? element.size : "";
                            const sku_no = (element.sku) ? element.sku : "";
                            const stock_id = (element.stock_id) ? element.stock_id : "";
                            const uom = (element.uom_name) ? element.uom_name : "";
                            const gr_id = (element.gr_id) ? element.gr_id : "";

                            html += `
                            <tr id="row_item_detail_${row_item_detail}">
                                <td class="text-center">
                                    ${location_id}
                                    <input type="hidden" name="location_id[]" id="location_id_${row_item_detail}" value="${location_id}">
                                    <div id="validation_location_id_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${sku_no}
                                    <input type="hidden" name="sku_no[]" id="sku_no_${row_item_detail}" value="${sku_no}">
                                    <div id="validation_sku_no_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${item_name}
                                    <input type="hidden" name="item_name[]" id="item_name_${row_item_detail}" value="${item_name}">
                                    <div id="validation_item_name_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${batch_no}
                                    <input type="hidden" name="batch_no[]" id="batch_no_${row_item_detail}" value="${batch_no}">
                                    <div id="validation_batch_no_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${serial_no}
                                    <input type="hidden" name="serial_no[]" id="serial_no_${row_item_detail}" value="${serial_no}">
                                    <div id="validation_serial_no_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${imei}
                                    <input type="hidden" name="imei[]" id="imei_${row_item_detail}" value="${imei}">
                                    <div id="validation_imei_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${part_no}
                                    <input type="hidden" name="part_no[]" id="part_no_${row_item_detail}" value="${part_no}">
                                    <div id="validation_part_no_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${color}
                                    <input type="hidden" name="color[]" id="color_${row_item_detail}" value="${color}">
                                    <div id="validation_color_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${size}
                                    <input type="hidden" name="size[]" id="size_${row_item_detail}" value="${size}">
                                    <div id="validation_size_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${expired_date}
                                    <input type="hidden" name="expired_date[]" id="expired_date_${row_item_detail}" value="${expired_date}">
                                    <div id="validation_expired_date_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${on_hand_qty}
                                    <input type="hidden" name="on_hand_qty[]" id="on_hand_qty_${row_item_detail}" value="${on_hand_qty}">
                                    <div id="validation_on_hand_qty_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${uom}
                                    <input type="hidden" name="uom[]" id="uom_${row_item_detail}" value="${uom}">
                                    <div id="validation_uom_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${stock_id}
                                    <input type="hidden" name="stock_id[]" id="stock_id_${row_item_detail}" value="${stock_id}">
                                    <div id="validation_stock_id_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td class="text-center">
                                    ${gr_id}
                                    <input type="hidden" name="gr_id[]" id="gr_id_${row_item_detail}" value="${gr_id}">
                                    <div id="validation_gr_id_${row_item_detail}" class="invalid-feedback"></div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary text-xs py-1 mb-0" onclick="deleteRowItemDetail('${row_item_detail}')">Remove</button>
                                </td>
                            </tr>`;
                        });
                        
                        $("#tabel-item-detail tbody").append(html);
                        $("#modal-Criteria").modal("hide"); 
                    }
                }
            },
        });
    });

    $("#form-save-stock-count").on("submit",function (e) {
       e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = $("input[name='_method']").val();
        const count_date = $("#count_date").val();
        const remark = $("#remark").val();

        const arr_location_id = [];
        $("#container-item-detail input[name^='location_id']").each(function () {
            arr_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_sku_no = [];
        $("#container-item-detail input[name^='sku_no']").each(function () {
            arr_sku_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_item_name = [];
        $("#container-item-detail input[name^='item_name']").each(function () {
            arr_item_name.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_batch_no = [];
        $("#container-item-detail input[name^='batch_no']").each(function () {
            arr_batch_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_serial_no = [];
        $("#container-item-detail input[name^='serial_no']").each(function () {
            arr_serial_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_imei = [];
        $("#container-item-detail input[name^='imei']").each(function () {
            arr_imei.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_part_no = [];
        $("#container-item-detail input[name^='part_no']").each(function () {
            arr_part_no.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_color = [];
        $("#container-item-detail input[name^='color']").each(function () {
            arr_color.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_size = [];
        $("#container-item-detail input[name^='size']").each(function () {
            arr_size.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_expired_date = [];
        $("#container-item-detail input[name^='expired_date']").each(function () {
            arr_expired_date.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_on_hand_qty = [];
        $("#container-item-detail input[name^='on_hand_qty']").each(function () {
            arr_on_hand_qty.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_uom = [];
        $("#container-item-detail input[name^='uom']").each(function () {
            arr_uom.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_stock_id = [];
        $("#container-item-detail input[name^='stock_id']").each(function () {
            arr_stock_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_gr_id = [];
        $("#container-item-detail input[name^='gr_id']").each(function () {
            arr_gr_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });


        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("count_date",count_date);
        formData.append("remark",remark);
        formData.append("arr_location_id",JSON.stringify(arr_location_id));
        formData.append("arr_sku_no",JSON.stringify(arr_sku_no));
        formData.append("arr_item_name",JSON.stringify(arr_item_name));
        formData.append("arr_batch_no",JSON.stringify(arr_batch_no));
        formData.append("arr_serial_no",JSON.stringify(arr_serial_no));
        formData.append("arr_imei",JSON.stringify(arr_imei));
        formData.append("arr_part_no",JSON.stringify(arr_part_no));
        formData.append("arr_color",JSON.stringify(arr_color));
        formData.append("arr_size",JSON.stringify(arr_size));
        formData.append("arr_expired_date",JSON.stringify(arr_expired_date));
        formData.append("arr_on_hand_qty",JSON.stringify(arr_on_hand_qty));
        formData.append("arr_uom",JSON.stringify(arr_uom));
        formData.append("arr_stock_id",JSON.stringify(arr_stock_id));
        formData.append("arr_gr_id",JSON.stringify(arr_gr_id));

        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#count_date").removeClass('is-invalid');
                $("#validation_count_date").html('');
                $("#remark").removeClass('is-invalid');
                $("#validation_remark").html('');

                $("#container-item-detail input[name^='location_id']").removeClass('is-invalid');
                $("[id^='validation_location_id']").html('');
                $("#container-item-detail input[name^='sku_no']").removeClass('is-invalid');
                $("[id^='validation_sku_no']").html('');
                $("#container-item-detail input[name^='item_name']").removeClass('is-invalid');
                $("[id^='validation_item_name']").html('');
                $("#container-item-detail input[name^='batch_no']").removeClass('is-invalid');
                $("[id^='validation_batch_no']").html('');
                $("#container-item-detail input[name^='serial_no']").removeClass('is-invalid');
                $("[id^='validation_serial_no']").html('');
                $("#container-item-detail input[name^='imei']").removeClass('is-invalid');
                $("[id^='validation_imei']").html('');
                $("#container-item-detail input[name^='part_no']").removeClass('is-invalid');
                $("[id^='validation_part_no']").html('');
                $("#container-item-detail input[name^='color']").removeClass('is-invalid');
                $("[id^='validation_color']").html('');
                $("#container-item-detail input[name^='size']").removeClass('is-invalid');
                $("[id^='validation_size']").html('');
                $("#container-item-detail input[name^='expired_date']").removeClass('is-invalid');
                $("[id^='validation_expired_date']").html('');
                $("#container-item-detail input[name^='on_hand_qty']").removeClass('is-invalid');
                $("[id^='validation_on_hand_qty']").html('');
                $("#container-item-detail input[name^='uom']").removeClass('is-invalid');
                $("[id^='validation_uom']").html('');
                $("#container-item-detail input[name^='stock_id']").removeClass('is-invalid');
                $("[id^='validation_stock_id']").html('');
                $("#container-item-detail input[name^='gr_id']").removeClass('is-invalid');
                $("[id^='validation_gr_id']").html('');
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
                window.location = "{{ route('stock_count.index') }}";
                return;

            },
        });
    });
});
</script>
@endsection
