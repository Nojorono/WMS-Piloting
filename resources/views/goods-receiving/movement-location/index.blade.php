@extends('layout.app')

@section("title")
GR Putaway Location
@endsection

@section("custom-style")
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('goods_receiving.processReceiveDetail' , [ 'id'=> $data["current_data"]->gr_id ]) }}" id="form-putaway">
                    <div class="row">
                        <div class="col-sm-12 d-flex mb-2">
                            <h5 class="me-auto">GR Putaway Location</h5>
                            <a href="{{ route('goods_receiving.show' , [ 'id' => $data["current_data"]->gr_id ]) }}" class="text-decoration-none me-2">
                                <button type="button" class="btn btn-primary mb-0 py-1">Show</button>
                            </a>
                            <span>
                                <button type="button" class="btn btn-primary mb-0 py-1" name="btn_print_putaway" id="btn_print_putaway">Print Putaway</button>
                            </span>
                        </div>
                        <hr>
                        <div class="col-sm-12 mb-2">
                            <div class="card border-0">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <label for="gr_id" class="form-label text-xs">GR ID</label>
                                            <input type="text" class="form-control py-0" id="gr_id" name="gr_id" value="{{ @$data["current_data"]->gr_id }}" readonly>
                                            <div class="invalid-feedback text-xs" id="validation_gr_id"></div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label for="movement_location_id" class="form-label text-xs">Movement Location ID</label>
                                            <input type="text" class="form-control py-0" id="movement_location_id" name="movement_location_id" value="{{ @$data["current_data_header"][0]->movement_id }}" readonly>
                                            <div class="invalid-feedback text-xs" id="validation_movement_location_id"></div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label for="reference_no" class="form-label text-xs">Reference No</label>
                                            <input type="text" class="form-control py-0" id="reference_no" name="reference_no" value="{{ @$data["current_data"]->reference_no }}" readonly>
                                            <div class="invalid-feedback text-xs" id="validation_reference_no"></div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label for="movement_date" class="form-label text-xs">Movement Date</label>
                                            <input type="text" class="form-control py-0" id="movement_date" name="movement_date" value="{{ @$data["current_data_header"][0]->movement_date }}" readonly>
                                            <div class="invalid-feedback text-xs" id="validation_movement_date"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (session('user_edit') == 1)
                            <div class="col-sm-12 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 mb-2">
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_assign_to_warehouseman" name="btn_assign_to_warehouseman">Assign to Warehouseman</button>
                                                    <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_view_warehouseman" name="btn_view_warehouseman">View Warehouseman</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                        <div class="col-sm-12 mb-2">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-primary mb-0 py-1" id="btn_add_row_putaway_detail" name="btn_add_row_putaway_detail">+ Add Item</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-putaway-detail">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center" style="min-width:150px;">SKU</th>
                                                            <th class="text-xs text-center">Item Name</th>
                                                            <th class="text-xs text-center">Batch No</th>
                                                            <th class="text-xs text-center">Expired Date</th>
                                                            <th class="text-xs text-center">Qty</th>
                                                            <th class="text-xs text-center">UoM</th>
                                                            <th class="text-xs text-center">Dest Location ID</th>
                                                            <th class="text-xs text-center">Dest Location Type</th>
                                                            <th class="text-xs text-center">Stock ID</th>
                                                            <th class="text-xs text-center">Warehouseman</th>
                                                            <th class="text-xs text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $current_row_putaway_detail = 1;
                                                        @endphp
                                                        @if (count($data["current_data_detail"]) > 0)
                                                        @foreach ($data["current_data_detail"] as $current_data_detail )
                                                        <tr id="row_putaway_detail_{{ $current_row_putaway_detail }}">
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type='text' class='form-control py-0' name='sku[]' id='sku_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->sku }}" readonly>
                                                                    <button type="button" class="btn btn-primary mb-0 rounded py-1" onclick="displayModalListSKUByGR('{{ $current_row_putaway_detail }}')"><i class="bi bi-search"></i></button>
                                                                    <div id="validation_sku_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->item_name }}" readonly>
                                                                <div id="validation_item_name_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->batch_no }}" readonly>
                                                                <div id="validation_batch_no_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='expired_date[]' id='expired_date_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->expired_date }}" readonly>
                                                                <div id="validation_expired_date_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='qty[]' id='qty_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->qty }}">
                                                                <div id="validation_qty_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='uom[]' id='uom_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->uom_name }}" readonly>
                                                                <div id="validation_uom_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type='text' class='form-control py-0' name='dest_location_id[]' id='dest_location_id_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->dest_location_id }}" readonly>
                                                                    <button type="button" class="btn btn-primary mb-0 rounded py-1" onclick="displayModalDestLocation('{{ $current_row_putaway_detail }}')"><i class="bi bi-search"></i></button>
                                                                    <div id="validation_dest_location_id_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='dest_location_type[]' id='dest_location_type_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->dest_location_type }}" readonly>
                                                                <div id="validation_dest_location_type_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='stock_id[]' id='stock_id_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->stock_id }}" readonly>
                                                                <div id="validation_stock_id_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type='text' class='form-control py-0' name='warehouseman_assigned[]' id='warehouseman_assigned_{{ $current_row_putaway_detail }}' value="{{ $current_data_detail->warehouseman }}" readonly>
                                                                    <button type="button" class="btn btn-primary mb-0 rounded py-1" onclick="displayModalAssignedUserWarehouseman('{{ $current_row_putaway_detail }}')"><i class="bi bi-search"></i></button>
                                                                    <div id="validation_warehouseman_assigned_{{ $current_row_putaway_detail }}" class="invalid-feedback text-xs"></div>
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary mb-0 py-1" onclick="deleteRow_putaway_detail('{{ $current_row_putaway_detail }}')">Remove</button>
                                                            </td>
                                                        </tr>
                                                        @php
                                                        $current_row_putaway_detail++;
                                                        @endphp
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

            

                        @if (session('user_edit') == 1)
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="d-flex">
                                                <!-- <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_assign_to_warehouseman" name="btn_assign_to_warehouseman">Assign to Warehouseman</button>
                                                <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_view_warehouseman" name="btn_view_warehouseman">View Warehouseman</button> -->
                                                <button type="submit" class="btn btn-primary mb-0 py-1 ms-auto">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-AssignToWarehouseman" tabindex="-1" aria-labelledby="modal-AssignToWarehousemanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-AssignToWarehousemanLabel">Assign To Warehouseman</h5>
                <button type="button" class="btn btn-primary mb-0 py-1" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('goods_receiving.processAssignWarehouseman' , [ 'id' => $data["current_data"]->gr_id ]) }}" id="form-assign-warehouseman">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <button type="button" class="btn btn-primary mb-0 py-1" name="btn_add_row_warehouseman" id="btn_add_row_warehouseman">Add Row Warehouseman</button>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <div class="table-responsive">
                                        <table class="table " id="tabel-AssignToWarehouseman" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-xs">Warehouseman Name</th>
                                                    <th class="text-xs">Date Start</th>
                                                    <th class="text-xs">Time Start</th>
                                                    <th class="text-xs">Date Finish</th>
                                                    <th class="text-xs">Time Finish</th>
                                                    <th class="text-xs">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <button type="submit" class="btn btn-primary mb-0 py-1">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-TargetUserWarehouseman" tabindex="-1" aria-labelledby="modal-TargetUserWarehousemanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-TargetUserWarehousemanLabel">Target User Warehouseman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_warehouseman_target_row" id="user_warehouseman_target_row" value="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-TargetUserWarehouseman" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-xs">Username</th>
                                                <th class="text-xs">Fullname</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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

<div class="modal fade" id="modal-DestLocation" tabindex="-1" aria-labelledby="modal-DestLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-DestLocationLabel">Dest Location - List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="DestLocation_target_row" id="DestLocation_target_row" value="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-DestLocation" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-xs">Dest Location ID</th>
                                                <th class="text-xs">Dest Location Type</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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

<div class="modal fade" id="modal-ViewWarehouseman" tabindex="-1" aria-labelledby="modal-ViewWarehousemanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-ViewWarehousemanLabel">View Warehouseman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-ViewWarehouseman" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-xs">Warehouseman Name</th>
                                                <th class="text-xs">Date Start</th>
                                                <th class="text-xs">Time Start</th>
                                                <th class="text-xs">Date Finish</th>
                                                <th class="text-xs">Time Finish</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $row_count = 1;

                                            @endphp
                                            @if (count($data["current_data_wh_activity_warehouseman"]) > 0)
                                            @foreach ($data["current_data_wh_activity_warehouseman"] as $current_data_wh_activity_warehouseman )
                                            <tr id="row_view_warehouseman_{{ $row_count }}">
                                                <td>
                                                    <input type="text" class="form-control py-0" name="view_warehouseman_username[]" id="view_warehouseman_username_{{ $row_count }}" value="{{ $current_data_wh_activity_warehouseman->checker }}" readonly>
                                                    <div id="validation_view_warehouseman_username_{{ $row_count }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control py-0" name="view_warehouseman_date_start[]" id="view_warehouseman_date_start_{{ $row_count }}" value="{{ $current_data_wh_activity_warehouseman->start_date }}" readonly>
                                                    <div id="validation_view_warehouseman_date_start_{{ $row_count }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control py-0" name="view_warehouseman_time_start[]" id="view_warehouseman_time_start_{{ $row_count }}" value="{{ $current_data_wh_activity_warehouseman->start_time }}" readonly>
                                                    <div id="validation_view_warehouseman_time_start_{{ $row_count }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control py-0" name="view_warehouseman_date_finish[]" id="view_warehouseman_date_finish_{{ $row_count }}" value="{{ $current_data_wh_activity_warehouseman->finish_date }}" readonly>
                                                    <div id="validation_view_warehouseman_date_finish_{{ $row_count }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control py-0" name="view_warehouseman_time_finish[]" id="view_warehouseman_time_finish_{{ $row_count }}" value="{{ $current_data_wh_activity_warehouseman->finish_time }}" readonly>
                                                    <div id="validation_view_warehouseman_time_finish_{{ $row_count }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                            </tr>
                                            @php

                                            $row_count ++;
                                            @endphp
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

<div class="modal fade" id="modal-ListSKUByGR" tabindex="-1" aria-labelledby="modal-ListSKUByGRLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-ListSKUByGRLabel">SKU By GR - List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="ListSKUByGR_target_row" id="ListSKUByGR_target_row" value="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-ListSKUByGR" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-xs">SKU</th>
                                                <th class="text-xs">Item Name</th>
                                                <th class="text-xs">Batch No</th>
                                                <th class="text-xs">Expired Date</th>
                                                <th class="text-xs">UOM Name</th>
                                                <th class="text-xs">Stock ID</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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

<div class="modal fade" id="modal-TargetAssignedWarehouseman" tabindex="-1" aria-labelledby="modal-TargetAssignedWarehousemanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-TargetAssignedWarehousemanLabel">Target Assigned Warehouseman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="assigned_warehouseman_target_row" id="assigned_warehouseman_target_row" value="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-TargetAssignedWarehouseman" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-xs">Checker</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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

<div class="modal fade" id="modal-PrintPutawayWarehouseman" tabindex="-1" aria-labelledby="modal-PrintPutawayWarehousemanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-PrintPutawayWarehousemanLabel">Print Putaway Warehouseman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-PrintPutawayWarehouseman" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-xs">Checker</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
@endsection

@section("javascript")
<script type="text/javascript">
    function displayModalDestLocation(row) {
        $("#DestLocation_target_row").val(row);
        $("#tabel-DestLocation").DataTable().destroy();
        $("#tabel-DestLocation").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('goods_receiving.datatablesDestLocation') }}",
            columns: [{
                    data: 'dest_location_id',
                    searchable: true,
                    className: 'text-xs',
                },
                {
                    data: 'dest_location_type',
                    searchable: true,
                    className: 'text-xs',
                },
            ],
        });
        $("#modal-DestLocation").modal('show');
    }

    function displayModalListSKUByGR(row) {
        $("#ListSKUByGR_target_row").val(row);
        $("#tabel-ListSKUByGR").DataTable().destroy();
        $("#tabel-ListSKUByGR").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('goods_receiving.datatablesListSKUByGR' , [ 'id'=> $data['current_data']->gr_id ]) }}",
            columns: [{
                    data: 'sku',
                    searchable: true,
                    className: 'text-xs',
                },
                {
                    data: 'item_name',
                    searchable: true,
                    className: 'text-xs',
                },
                {
                    data: 'batch_no',
                    searchable: true,
                    className: 'text-xs',
                },
                {
                    data: 'expired_date',
                    searchable: true,
                    className: 'text-xs',
                },
                {
                    data: 'uom_name',
                    searchable: true,
                    className: 'text-xs',
                },
                {
                    data: 'stock_id',
                    searchable: true,
                    className: 'text-xs',
                },
            ],
        });
        $("#modal-ListSKUByGR").modal('show');
    }

    function deleteRowWarehouseman(row) {
        $(`#row_warehouseman_${row}`).remove();
    }

    function displayModalTargetUserWarehouseman(row) {
        $("#user_warehouseman_target_row").val(row);
        $("#tabel-TargetUserWarehouseman").DataTable().destroy();
        $("#tabel-TargetUserWarehouseman").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('goods_receiving.datatablesTargetUserAssign') }}",
            columns: [{
                    data: 'username',
                    searchable: true,
                    className: 'text-xs',
                },
                {
                    data: 'fullname',
                    searchable: true,
                    className: 'text-xs',
                },
            ],
        });

        $("#modal-TargetUserWarehouseman").modal("show");
    }

    function deleteRow_putaway_detail(row) {
        $(`#row_putaway_detail_${row}`).remove();
    }

    function displayModalAssignedUserWarehouseman(row) {
        $("#assigned_warehouseman_target_row").val(row);
        $("#tabel-TargetAssignedWarehouseman").DataTable().destroy();
        $("#tabel-TargetAssignedWarehouseman").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('goods_receiving.datatablesTargetWarehousemanAssign',['id' => $data['current_data']->gr_id]) }}",
            columns: [{
                data: 'checker',
                searchable: true,
                className: 'text-xs',
            }, ],
        });

        $("#modal-TargetAssignedWarehouseman").modal("show");
    }

    $(document).ready(function() {
        $("#dropdown_toggle_inbound").prop('aria-expanded', true);
        $("#dropdown_toggle_inbound").addClass('active');
        $("#dropdown_inbound").addClass('show');
        $("#logo_inbound").addClass("d-none");
        $("#logo_white_inbound").removeClass("d-none");
        $("#li_goods_receiving").addClass("active");
        $("#a_goods_receiving").addClass("active");

        let row_count_warehouseman = 1;
        let row_count_putaway_detail = "{{ $current_row_putaway_detail }}";

        $("#tabel-TargetUserWarehouseman > tbody").on('click', 'tr', function() {
            const target_row = $("#user_warehouseman_target_row").val();
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const username = $($(dom_tr).children("td")[0]).text();

            $(`#warehouseman_username_${target_row}`).val(username);

            $("#modal-TargetUserWarehouseman").modal('hide');
        });

        $("#tabel-DestLocation > tbody").on('click', 'tr', function() {
            const target_row = $("#DestLocation_target_row").val();
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const dest_location_id = $($(dom_tr).children("td")[0]).text();
            const dest_location_type = $($(dom_tr).children("td")[1]).text();


            $(`#dest_location_id_${target_row}`).val(dest_location_id);
            $(`#dest_location_type_${target_row}`).val(dest_location_type);
            $("#modal-DestLocation").modal('hide');
        });

        $("#btn_good_receive").on("click", function() {
            $("#btn_good_receive").prop("disabled", true);

            const url = "{{ route('goods_receiving.processGoodReceive', [ 'id'=> $data['current_data']->gr_id ]) }}";
            const _token = $("meta[name='csrf-token']").prop('content');
            const _method = "POST";

            const formData = new FormData();
            formData.append("_token", _token);
            formData.append("_method", _method);

            $.ajax({
                url: url,
                method: _method,
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {},
                error: function(error) {
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
                complete: function() {

                },
                success: function(response) {
                    if (typeof response !== 'object') {
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

                    if (response.err) {
                        $("#btn_good_receive").prop("disabled", false);
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

        $("#btn_assign_to_warehouseman").on("click", function() {
            $("#modal-AssignToWarehouseman").modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#modal-AssignToWarehouseman").modal('show');
        });

        $("#btn_add_row_warehouseman").on("click", function() {
            const html_row_warehouseman = `
        <tr id="row_warehouseman_${row_count_warehouseman}">
            <td>
                <div class="input-group">  
                    <input type="text" class="form-control py-0" name="warehouseman_username[]" id="warehouseman_username_${row_count_warehouseman}" readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_target_warehouseman_${row_count_warehouseman}" name="btn_search_target_warehouseman_${row_count_warehouseman}" onclick="displayModalTargetUserWarehouseman('${row_count_warehouseman}')"><i class="bi bi-search"></i></button>
                    <div id="validation_warehouseman_username_${row_count_warehouseman}" class="invalid-feedback text-xs"></div>
                </div>
            </td>
            <td>
                <input type="date" class="form-control py-0" name="warehouseman_date_start[]" id="warehouseman_date_start_${row_count_warehouseman}">
                <div id="validation_warehouseman_date_start_${row_count_warehouseman}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type="time" class="form-control py-0" name="warehouseman_time_start[]" id="warehouseman_time_start_${row_count_warehouseman}">
                <div id="validation_warehouseman_time_start_${row_count_warehouseman}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type="date" class="form-control py-0" name="warehouseman_date_finish[]" id="warehouseman_date_finish_${row_count_warehouseman}">
                <div id="validation_warehouseman_date_finish_${row_count_warehouseman}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type="time" class="form-control py-0" name="warehouseman_time_finish[]" id="warehouseman_time_finish_${row_count_warehouseman}">
                <div id="validation_warehouseman_time_finish_${row_count_warehouseman}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <button type="button" class="btn btn-primary mb-0 py-1" name="btn_remove_row_warehouseman_${row_count_warehouseman}" id="btn_remove_row_warehouseman_${row_count_warehouseman}" onclick="deleteRowWarehouseman('${row_count_warehouseman}')">Remove</button>
            </td>
        </tr>`;
            row_count_warehouseman++;
            $("#tabel-AssignToWarehouseman > tbody").append(html_row_warehouseman);
        });

        $("#form-assign-warehouseman").on("submit", function(e) {
            e.preventDefault();
            const url = $(this).prop('action');
            const _token = $("meta[name='csrf-token']").prop("content");
            const _method = "POST";
            const arr_warehouseman_username = [];
            $("input[name^='warehouseman_username']").each(function() {
                arr_warehouseman_username.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_warehouseman_date_start = [];
            $("input[name^='warehouseman_date_start']").each(function() {
                arr_warehouseman_date_start.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_warehouseman_time_start = [];
            $("input[name^='warehouseman_time_start']").each(function() {
                arr_warehouseman_time_start.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_warehouseman_date_finish = [];
            $("input[name^='warehouseman_date_finish']").each(function() {
                arr_warehouseman_date_finish.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_warehouseman_time_finish = [];
            $("input[name^='warehouseman_time_finish']").each(function() {
                arr_warehouseman_time_finish.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });



            const formData = new FormData();
            formData.append("_token", _token);
            formData.append("_method", _method);
            formData.append("arr_warehouseman_username", JSON.stringify(arr_warehouseman_username));
            formData.append("arr_warehouseman_date_start", JSON.stringify(arr_warehouseman_date_start));
            formData.append("arr_warehouseman_time_start", JSON.stringify(arr_warehouseman_time_start));
            formData.append("arr_warehouseman_date_finish", JSON.stringify(arr_warehouseman_date_finish));
            formData.append("arr_warehouseman_time_finish", JSON.stringify(arr_warehouseman_time_finish));

            $.ajax({
                url: url,
                method: _method,
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    $("input[name^='warehouseman_username']").removeClass('is-invalid');
                    $("[id^='validation_warehouseman_username']").html('');
                    $("input[name^='warehouseman_date_start']").removeClass('is-invalid');
                    $("[id^='validation_warehouseman_date_start']").html('');
                    $("input[name^='warehouseman_time_start']").removeClass('is-invalid');
                    $("[id^='validation_warehouseman_time_start']").html('');
                    $("input[name^='warehouseman_date_finish']").removeClass('is-invalid');
                    $("[id^='validation_warehouseman_date_finish']").html('');
                    $("input[name^='warehouseman_time_finish']").removeClass('is-invalid');
                    $("[id^='validation_warehouseman_time_finish']").html('');

                },
                error: function(error) {
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
                complete: function() {

                },
                success: function(response) {
                    if (typeof response !== 'object') {
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

                    if (response.err) {
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

        $("#btn_view_warehouseman").on("click", function() {
            $("#modal-ViewWarehouseman").modal("show")
        });

        $("#btn_add_row_putaway_detail").on("click", function() {
            row_count_putaway_detail = parseInt(row_count_putaway_detail);
            const html_row_putaway_detail = `
        <tr id="row_putaway_detail_${row_count_putaway_detail}">
            <td>
                <div class="input-group">  
                    <input type='text' class='form-control py-0' name='sku[]' id='sku_${row_count_putaway_detail}' value="" readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" onclick="displayModalListSKUByGR('${row_count_putaway_detail}')"><i class="bi bi-search"></i></button>
                    <div id="validation_sku_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
                </div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_${row_count_putaway_detail}' value="" readonly>
                <div id="validation_item_name_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_${row_count_putaway_detail}' value="" readonly>
                <div id="validation_batch_no_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='expired_date[]' id='expired_date_${row_count_putaway_detail}' value="" readonly>
                <div id="validation_expired_date_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='qty[]' id='qty_${row_count_putaway_detail}' value="">
                <div id="validation_qty_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='uom[]' id='uom_${row_count_putaway_detail}' value="" readonly>
                <div id="validation_uom_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <div class="input-group">  
                    <input type='text' class='form-control py-0' name='dest_location_id[]' id='dest_location_id_${row_count_putaway_detail}' value="" readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" onclick="displayModalDestLocation('${row_count_putaway_detail}')"><i class="bi bi-search"></i></button>
                    <div id="validation_dest_location_id_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
                </div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='dest_location_type[]' id='dest_location_type_${row_count_putaway_detail}' value="" readonly>
                <div id="validation_dest_location_type_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type='text' class='form-control py-0' name='stock_id[]' id='stock_id_${row_count_putaway_detail}' value="" readonly>
                <div id="validation_stock_id_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <div class="input-group">
                    <input type='text' class='form-control py-0' name='warehouseman_assigned[]' id='warehouseman_assigned_${row_count_putaway_detail}' value="" readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" onclick="displayModalAssignedUserWarehouseman('${row_count_putaway_detail}')"><i class="bi bi-search"></i></button>
                    <div id="validation_warehouseman_assigned_${row_count_putaway_detail}" class="invalid-feedback text-xs"></div>
                </div>
                
            </td>
            <td>
                <button type="button" class="btn btn-primary mb-0 py-1" onclick="deleteRow_putaway_detail('${row_count_putaway_detail}')">Remove</button> 
            </td>
        </tr>`;
            row_count_putaway_detail++;
            $("#tabel-putaway-detail > tbody").append(html_row_putaway_detail);
        });

        $("#tabel-ListSKUByGR > tbody").on('click', 'tr', function() {
            const target_row = $("#ListSKUByGR_target_row").val();
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const sku = $($(dom_tr).children("td")[0]).text();
            const item_name = $($(dom_tr).children("td")[1]).text();
            const batch_no = $($(dom_tr).children("td")[2]).text();
            const expired_date = $($(dom_tr).children("td")[3]).text();
            const uom_name = $($(dom_tr).children("td")[4]).text();
            const stock_id = $($(dom_tr).children("td")[5]).text();

            $(`#sku_${target_row}`).val(sku);
            $(`#item_name_${target_row}`).val(item_name);
            $(`#batch_no_${target_row}`).val(batch_no);
            $(`#expired_date_${target_row}`).val(expired_date);
            $(`#uom_${target_row}`).val(uom_name);
            $(`#stock_id_${target_row}`).val(stock_id);
            $("#modal-ListSKUByGR").modal('hide');
        });


        $("#form-putaway").on("submit", function(e) {
            e.preventDefault();
            const url = $(this).prop('action');
            const _token = $("meta[name='csrf-token']").prop("content");
            const _method = "POST";
            const movement_location_id = $("#movement_location_id").val();

            const arr_sku = [];
            $("input[name^='sku']").each(function() {
                arr_sku.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_dest_location_id = [];
            $("input[name^='dest_location_id']").each(function() {
                arr_dest_location_id.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_dest_location_type = [];
            $("input[name^='dest_location_type']").each(function() {
                arr_dest_location_type.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_stock_id = [];
            $("input[name^='stock_id']").each(function() {
                arr_stock_id.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_item_name = [];
            $("input[name^='item_name']").each(function() {
                arr_item_name.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_batch_no = [];
            $("input[name^='batch_no']").each(function() {
                arr_batch_no.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_expired_date = [];
            $("input[name^='expired_date']").each(function() {
                arr_expired_date.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_qty = [];
            $("input[name^='qty']").each(function() {
                arr_qty.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_uom = [];
            $("input[name^='uom']").each(function() {
                arr_uom.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_warehouseman_assigned = [];
            $("input[name^='warehouseman_assigned']").each(function() {
                arr_warehouseman_assigned.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const formData = new FormData();
            formData.append("_token", _token);
            formData.append("_method", _method);
            formData.append("movement_location_id", movement_location_id);
            formData.append("arr_sku", JSON.stringify(arr_sku));
            formData.append("arr_dest_location_id", JSON.stringify(arr_dest_location_id));
            formData.append("arr_dest_location_type", JSON.stringify(arr_dest_location_type));
            formData.append("arr_item_name", JSON.stringify(arr_item_name));
            formData.append("arr_batch_no", JSON.stringify(arr_batch_no));
            formData.append("arr_expired_date", JSON.stringify(arr_expired_date));
            formData.append("arr_qty", JSON.stringify(arr_qty));
            formData.append("arr_uom", JSON.stringify(arr_uom));
            formData.append("arr_stock_id", JSON.stringify(arr_stock_id));
            formData.append("arr_warehouseman_assigned", JSON.stringify(arr_warehouseman_assigned));
            $.ajax({
                url: url,
                method: _method,
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    $("input[name^='sku']").removeClass('is-invalid');
                    $("[id^='validation_sku']").html('');
                    $("input[name^='dest_location_id']").removeClass('is-invalid');
                    $("[id^='validation_dest_location_id']").html('');
                    $("input[name^='dest_location_type']").removeClass('is-invalid');
                    $("[id^='validation_dest_location_type']").html('');
                    $("input[name^='item_name']").removeClass('is-invalid');
                    $("[id^='validation_item_name']").html('');
                    $("input[name^='batch_no']").removeClass('is-invalid');
                    $("[id^='validation_batch_no']").html('');
                    $("input[name^='expired_date']").removeClass('is-invalid');
                    $("[id^='validation_expired_date']").html('');
                    $("input[name^='qty']").removeClass('is-invalid');
                    $("[id^='validation_qty']").html('');
                    $("input[name^='uom']").removeClass('is-invalid');
                    $("[id^='validation_uom']").html('');
                    $("input[name^='stock_id']").removeClass('is-invalid');
                    $("[id^='validation_stock_id']").html('');
                    $("input[name^='warehouseman_assigned']").removeClass('is-invalid');
                    $("[id^='validation_warehouseman_assigned']").html('');
                },
                error: function(error) {
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
                complete: function() {

                },
                success: function(response) {
                    if (typeof response !== 'object') {
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

                    if (response.err) {
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

        $("#tabel-TargetAssignedWarehouseman > tbody").on('click', 'tr', function() {
            const target_row = $("#assigned_warehouseman_target_row").val();
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const username = $($(dom_tr).children("td")[0]).text();

            $(`#warehouseman_assigned_${target_row}`).val(username);

            $("#modal-TargetAssignedWarehouseman").modal('hide');
        });

        $("#btn_print_putaway").on("click", function() {
            $("#tabel-PrintPutawayWarehouseman").DataTable().destroy();
            $("#tabel-PrintPutawayWarehouseman").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ route('goods_receiving.datatablesTargetWarehousemanAssign',['id' => $data['current_data']->gr_id]) }}",
                columns: [{
                    data: 'checker',
                    searchable: true,
                    className: 'text-xs',
                }, ],
            });
            $("#modal-PrintPutawayWarehouseman").modal('show');
        });

        $("#tabel-PrintPutawayWarehouseman > tbody").on('click', 'tr', function() {
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const username = $($(dom_tr).children("td")[0]).text();
            const url = "{{ route('goods_receiving.printPutaway' , [ 'id' => $data['current_data']->gr_id ]) }}";
            const full_url = `${url}?username=${username}`;

            window.open(full_url, "_blank");

            $("#modal-PrintPutawayWarehouseman").modal('hide');
        });
    });
</script>
@endsection