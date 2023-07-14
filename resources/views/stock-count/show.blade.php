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
                        <h5 class="me-auto">Stock Count - Show</h5>
                        <a href="{{ route("stock_count.index") }}" class="text-decoration-none ms-auto me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" id="btn_list" name="btn_list">List</button>
                        </a>
                        <button type="button" class="btn btn-primary text-xs py-1" name="btn_print" id="btn_print">Print</button>
                    </div>
                    <hr>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="stock_count_id" name="stock_count_id" value="{{ @$data["current_data"][0]->stock_count_id }}" readonly>
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
                                                <input type="date" autocomplete="off" class="form-control py-0" id="count_date" name="count_date" value="{{ @$data["current_data"][0]->count_date }}" readonly>
                                                <div id="validation_count_date" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="remark" class="form-label text-xs">Remark</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="remark" name="remark" value="{{ @$data["current_data"][0]->remark }}" readonly>
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
                                                <select class="form-select py-0 rounded" id="count_no" name="count_no">
                                                    <option value="">All</option>
                                                    @if (count($data["count_no_list"]) > 0)
                                                    @foreach ( $data["count_no_list"] as $count_no_list )
                                                    <option value="{{ $count_no_list }}">{{ $count_no_list }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
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
                            <div class="card-body py-0 tab-content">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row">
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
                                                            <th class="text-center text-xs">Stock On Hand Qty</th>
                                                            <th class="text-center text-xs">Count Qty</th>
                                                            <th class="text-center text-xs">Discrepancy</th>
                                                            <th class="text-center text-xs">Precentage</th>
                                                            <th class="text-center text-xs">UOM</th>
                                                            <th class="text-center text-xs">Counter</th>
                                                            <th class="text-center text-xs">Count Status</th>
                                                            <th class="text-center text-xs">GR ID</th>
                                                            <th class="text-center text-xs">Stock ID</th>
                                                            <th class="text-center text-xs">Count No</th>
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
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary text-xs py-1 mb-0 me-2 d-none" id="btn_assign_to_counter" name="btn_assign_to_counter">Assign to Counter</button>
                            <button type="button" class="btn btn-primary text-xs py-1 mb-0 me-2 d-none" id="btn_manual_count" name="btn_manual_count">Manual Count</button>
                            <button type="button" class="btn btn-primary text-xs py-1 mb-0 me-2 d-none" id="btn_confirm" name="btn_confirm">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-AssignToCounter" tabindex="-1" aria-labelledby="modal-AssignToCounterLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-AssignToCounterLabel">Assign To Counter</h5>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('stock_count.processAssignCounter' , [ 'id' => $data["current_data"][0]->stock_count_id ]) }}" id="form-assign-counter">
            @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary text-xs py-1 mb-0 ms-0 me-auto" name="btn_add_row_counter" id="btn_add_row_counter">Add Row Counter</button>
                                    <span class="ms-auto me-2">
                                        Total Location : {{ @$data["count_location_id"]; }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-AssignToCounter" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-xs">Counter Name</th>
                                                <th class="text-xs">Location ID</th>
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
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary text-xs py-1 mb-0 ms-0 me-auto" id="btn_suggest_location" name="btn_suggest_location">Suggest Location</button>
                                    <button type="submit" class="btn btn-primary text-xs py-1 mb-0 me-2">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-TargetUserCounter" tabindex="-1" aria-labelledby="modal-TargetUserCounterLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-TargetUserCounterLabel">Target User Counter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="user_counter_target_row" id="user_counter_target_row" value="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-TargetUserCounter" style="width: 100%;">
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

<div class="modal fade" id="modal-TargetLocation" tabindex="-1" aria-labelledby="modal-TargetLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-TargetLocationLabel">Target Location Counter</h5>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="location_counter_target_row" id="location_counter_target_row" value="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="row" id="container-TargetLocation"></div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary text-xs py-1 mb-0 me-auto" name="btn_select_all_location" id="btn_select_all_location">Select All</button>
                                    <button type="button" class="btn btn-primary text-xs py-1 mb-0 me-2" name="btn_choose_location" id="btn_choose_location">Choose</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ViewTargetLocation" tabindex="-1" aria-labelledby="modal-ViewTargetLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ViewTargetLocationLabel">Location Selected</h5>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="row" id="container-ViewTargetLocation"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ConfirmStockCount" tabindex="-1" aria-labelledby="modal-ConfirmStockCountLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            {{-- <h5 class="modal-title" id="modal-ConfirmStockCountLabel">Confirm Stock Count</h5> --}}
            {{-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button> --}}
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('stock_count.processConfirmCount' , [ 'id' => $data["current_data"][0]->stock_count_id, 'count_no' => $data["current_data"][0]->count_no ]) }}" id="form-confirm-stock-count">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                Are you sure to confirm this stock count id ?
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary text-xs py-1 mb-0 me-2">Yes</button>
                                    <button type="button" class="btn btn-primary text-xs py-1 mb-0 me-2" data-bs-dismiss="modal" aria-label="Close">No</button>
                                </div>
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
function displayModalTargetLocation(row) {
    $("#location_counter_target_row").val(row);
    $.ajax({
        url: "{{ route('stock_count.getTargetLocation' , ['id' => $data['current_data'][0]->stock_count_id]) }}",
        cache: false,
        beforeSend: function () {
            $("#container-TargetLocation").html("");
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
            let html = '';
            if('data' in response){
                if(response.data.length > 0){
                    const counter_location_id = $(`#counter_location_id_${row}`).val();
                    let list_current_location_id = [];
                    if(counter_location_id){
                        const obj_current_location_id = JSON.parse(counter_location_id);
                        if('list' in obj_current_location_id){
                            list_current_location_id = obj_current_location_id.list;
                        }
                    }

                    response.data.forEach((element,index) => {
                        const location_id = (element.location_id != null) ? element.location_id : "";
                        const exist_location_id = list_current_location_id.find((temp_location) => temp_location == location_id);
                        const checked = " checked";
                        const checkedHTML = (exist_location_id) ? checked : '';
                        html += `
                        <div class="col-sm-3 mb-2">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="${location_id}" id="checkbox_location_id_${index}" ${checkedHTML} >
                            <label class="form-check-label" for="checkbox_location_id_${index}">
                                ${location_id}
                            </label>
                            </div>
                        </div>`;
                    });
                }
            }
            $("#container-TargetLocation").html(html);
            return;
        },
    });

    $("#modal-TargetLocation").modal("show");
}
function displayModalTargetUserCounter(row) {
    $("#user_counter_target_row").val(row);
    $("#tabel-TargetUserCounter").DataTable().destroy();
    $("#tabel-TargetUserCounter").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('stock_count.datatablesTargetUserAssign') }}",
        columns:[
            {data: 'username', searchable: true, className: 'text-xs'},
            {data: 'fullname', searchable: true, className: 'text-xs'},
        ],
    });

    $("#modal-TargetUserCounter").modal("show");
}

function deleteRowCounter(row) {
    $(`#row_counter_${row}`).remove();
}
function displayModalViewTargetLocation(row) {
    $(`#container-ViewTargetLocation`).html("");
    const temp_counter_location_id = $(`#counter_location_id_${row}`).val();
    if(temp_counter_location_id){
        const obj_counter_location_id = JSON.parse(temp_counter_location_id);
        const list_counter_location_id = obj_counter_location_id.list;
        let html = ``;
        list_counter_location_id.forEach(element => {
            html += `
            <div class="col-sm-3 mb-2">
                <label>
                    ${element}
                </label>
            </div>`;
        });
        $(`#container-ViewTargetLocation`).html(html);
    }
    $("#modal-ViewTargetLocation").modal("show");
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
    let row_count_counter = 0;
    // special function start
    const get_Item_Details = () => {
        const current_count_no = $("#count_no").val();
        const url = "{{ route('stock_count.getDataItemDetail', [ 'id' => $data['current_data'][0]->stock_count_id ]) }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("count_no",current_count_no);
        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#tabel-item-detail tbody").html("");
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
                        response.data.forEach((element,index) => {
                            row_item_detail++;
                            const location_id = (element.location_id) ? element.location_id : "";
                            const sku_no = (element.sku) ? element.sku : "";
                            const item_name = (element.item_name) ? element.item_name : "";
                            const batch_no = (element.batch_no) ? element.batch_no : "";
                            const serial_no = (element.serial_no) ? element.serial_no : "";
                            const stock_on_hand_qty = (element.on_hand_qty) ? element.on_hand_qty : "";
                            const count_qty = (element.count_qty) ? element.count_qty : "";
                            const discrepancy = (element.discrepancy) ? element.discrepancy : "";
                            const percentage = (element.percentage) ? element.percentage : "";
                            const uom = (element.uom_name) ? element.uom_name : "";
                            const counter = (element.counter) ? element.counter : "";
                            const count_status = (element.count_status) ? element.count_status : "";
                            const gr_id = (element.gr_id) ? element.gr_id : "";
                            const stock_id = (element.stock_id) ? element.stock_id : "";
                            const count_no = (element.count_no) ? element.count_no : "";

                            html += `
                            <tr id="row_item_detail_${row_item_detail}">
                                <td class="text-center text-xs">
                                    ${location_id}
                                    <input type="hidden" name="location_id[]" id="location_id_${row_item_detail}" value="${location_id}">
                                </td>
                                <td class="text-center text-xs">
                                    ${sku_no}
                                    <input type="hidden" name="sku_no[]" id="sku_no_${row_item_detail}" value="${sku_no}">
                                </td>
                                <td class="text-center text-xs">
                                    ${item_name}
                                    <input type="hidden" name="item_name[]" id="item_name_${row_item_detail}" value="${item_name}">
                                </td>
                                <td class="text-center text-xs">
                                    ${batch_no}
                                    <input type="hidden" name="batch_no[]" id="batch_no_${row_item_detail}" value="${batch_no}">
                                </td>
                                <td class="text-center text-xs">
                                    ${serial_no}
                                    <input type="hidden" name="serial_no[]" id="serial_no_${row_item_detail}" value="${serial_no}">
                                </td>
                                <td class="text-center text-xs">
                                    ${stock_on_hand_qty}
                                    <input type="hidden" name="stock_on_hand_qty[]" id="stock_on_hand_qty_${row_item_detail}" value="${stock_on_hand_qty}">
                                </td>
                                <td class="text-center text-xs">
                                    ${count_qty}
                                    <input type="hidden" name="count_qty[]" id="count_qty_${row_item_detail}" value="${count_qty}">
                                </td>
                                <td class="text-center text-xs">
                                    ${discrepancy}
                                    <input type="hidden" name="discrepancy[]" id="discrepancy_${row_item_detail}" value="${discrepancy}">
                                </td>
                                <td class="text-center text-xs">
                                    ${percentage}
                                    <input type="hidden" name="percentage[]" id="percentage_${row_item_detail}" value="${percentage}">
                                </td>
                                <td class="text-center text-xs">
                                    ${uom}
                                    <input type="hidden" name="uom[]" id="uom_${row_item_detail}" value="${uom}">
                                </td>
                                <td class="text-center text-xs">
                                    ${counter}
                                    <input type="hidden" name="counter[]" id="counter_${row_item_detail}" value="${counter}">
                                </td>
                                <td class="text-center text-xs">
                                    ${count_status}
                                    <input type="hidden" name="count_status[]" id="count_status_${row_item_detail}" value="${count_status}">
                                </td>
                                <td class="text-center text-xs">
                                    ${gr_id}
                                    <input type="hidden" name="gr_id[]" id="gr_id_${row_item_detail}" value="${gr_id}">
                                </td>
                                <td class="text-center text-xs">
                                    ${stock_id}
                                    <input type="hidden" name="stock_id[]" id="stock_id_${row_item_detail}" value="${stock_id}">
                                </td>
                                <td class="text-center text-xs">
                                    ${count_no}
                                    <input type="hidden" name="count_no[]" id="count_no_${row_item_detail}" value="${count_no}">
                                </td>
                            </tr>`;
                        });
                        
                        $("#tabel-item-detail tbody").html(html);
                    }
                }
            },
        });
    }

    const addDisplayNone = (id_dom) => {
        if(!$(`#${id_dom}`).hasClass('d-none')){
            $(`#${id_dom}`).addClass('d-none');
        }
    }

    const removeDisplayNone = (id_dom) => {
        if($(`#${id_dom}`).hasClass('d-none')){
            $(`#${id_dom}`).removeClass('d-none');
        }
    }

    const check_Count_no = () => {
        const current_count_no = $("#count_no").val();
        const header_count_no = "{{ $data['current_data'][0]->count_no }}";
        const url = "{{ route('stock_count.checkCountNo', [ 'id' => $data['current_data'][0]->stock_count_id ]) }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("count_no",current_count_no);
        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                addDisplayNone('btn_assign_to_counter');
                addDisplayNone('btn_manual_count');
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
                    if('exist' in response.data && 'status_id' in response.data){
                        if(
                            response.data.exist && 
                            (response.data.status_id == "OOP" || response.data.status_id == "ODC") &&
                            header_count_no == current_count_no
                        ){
                            removeDisplayNone('btn_assign_to_counter');
                        }
                        if(
                            response.data.exist && 
                            (response.data.status_id == "AOP" || response.data.status_id == "ADC") &&
                            header_count_no == current_count_no
                        ){
                            removeDisplayNone('btn_manual_count');
                        }
                    }
                }
            },
        });
    }

    const check_Confirm_Button = () => {
        const current_count_no = $("#count_no").val();
        const header_count_no = "{{ $data['current_data'][0]->count_no }}";
        const url = "{{ route('stock_count.checkConfirm', [ 'id' => $data['current_data'][0]->stock_count_id ]) }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("count_no",current_count_no);
        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                addDisplayNone('btn_confirm');
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
                    if('allowed_confirm' in response.data){
                        if(response.data.allowed_confirm && current_count_no != "" && header_count_no == current_count_no){
                            removeDisplayNone('btn_confirm');
                        }
                    }
                }
            },
        });
    }
    // special function end

    get_Item_Details();
    check_Count_no();
    check_Confirm_Button();

    $("#count_no").on("change",function () {
        get_Item_Details();
        check_Count_no();
        check_Confirm_Button();
    });

    $("#btn_assign_to_counter").on("click",function () {
        $("#modal-AssignToCounter").modal({backdrop: 'static', keyboard: false});
        $("#modal-AssignToCounter").modal('show');
    });

    $("#btn_add_row_counter").on("click",function () {
        const html_row_counter = `
        <tr id="row_counter_${row_count_counter}">
            <td>
                <div class="input-group">  
                    <input type="text" class="form-control" name="counter_username[]" id="counter_username_${row_count_counter}" value="" readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded" id="btn_search_target_counter_${row_count_counter}" name="btn_search_target_counter_${row_count_counter}" onclick="displayModalTargetUserCounter('${row_count_counter}')"><i class="bi bi-search"></i></button>
                    <div id="validation_counter_username_${row_count_counter}" class="invalid-feedback"></div>
                </div>
            </td>
            <td>
                <div class="input-group">  
                    <input type="hidden" name="counter_location_id[]" id="counter_location_id_${row_count_counter}" value="">
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary me-2 rounded" id="btn_search_target_counter_${row_count_counter}" name="btn_search_target_counter_${row_count_counter}" onclick="displayModalTargetLocation('${row_count_counter}')"><i class="bi bi-search"></i></button>
                        <button type="button" class="btn btn-primary me-2 rounded d-none" id="btn_view_counter_location_${row_count_counter}" name="btn_view_counter_location_${row_count_counter}" onclick="displayModalViewTargetLocation('${row_count_counter}')" >View</button>
                    </div>
                    <div id="validation_counter_location_id_${row_count_counter}" class="invalid-feedback"></div>
                </div>
            </td>
            <td>
                <input type="date" class="form-control" name="counter_date_start[]" id="counter_date_start_${row_count_counter}" value="">
                <div id="validation_counter_date_start_${row_count_counter}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type="time" class="form-control" name="counter_time_start[]" id="counter_time_start_${row_count_counter}" value="">
                <div id="validation_counter_time_start_${row_count_counter}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type="date" class="form-control" name="counter_date_finish[]" id="counter_date_finish_${row_count_counter}" value="">
                <div id="validation_counter_date_finish_${row_count_counter}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type="time" class="form-control" name="counter_time_finish[]" id="counter_time_finish_${row_count_counter}" value="">
                <div id="validation_counter_time_finish_${row_count_counter}" class="invalid-feedback"></div>
            </td>
            <td>
                <button type="button" class="btn btn-primary" name="btn_remove_row_counter_${row_count_counter}" id="btn_remove_row_counter_${row_count_counter}" onclick="deleteRowCounter('${row_count_counter}')">Remove</button>
            </td>
        </tr>`;
        row_count_counter++;
        $("#tabel-AssignToCounter > tbody").append(html_row_counter);
    });

    $("#tabel-TargetUserCounter > tbody").on('click','tr',function () {
        const target_row = $("#user_counter_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const username = $($(dom_tr).children("td")[0]).text();
        
        $(`#counter_username_${target_row}`).val(username);
        
        $("#modal-TargetUserCounter").modal('hide');
    });

    $("#form-assign-counter").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content')
        const _method = $("input[name='_method']").val();
        const arr_counter_username = [];
        $("input[name^='counter_username']").each(function () {
            arr_counter_username.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_counter_location_id = [];
        $("input[name^='counter_location_id']").each(function () {
            arr_counter_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_counter_date_start = [];
        $("input[name^='counter_date_start']").each(function () {
            arr_counter_date_start.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_counter_time_start = [];
        $("input[name^='counter_time_start']").each(function () {
            arr_counter_time_start.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_counter_date_finish = [];
        $("input[name^='counter_date_finish']").each(function () {
            arr_counter_date_finish.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_counter_time_finish = [];
        $("input[name^='counter_time_finish']").each(function () {
            arr_counter_time_finish.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("arr_counter_username",JSON.stringify(arr_counter_username));
        formData.append("arr_counter_location_id",JSON.stringify(arr_counter_location_id));
        formData.append("arr_counter_date_start",JSON.stringify(arr_counter_date_start));
        formData.append("arr_counter_time_start",JSON.stringify(arr_counter_time_start));
        formData.append("arr_counter_date_finish",JSON.stringify(arr_counter_date_finish));
        formData.append("arr_counter_time_finish",JSON.stringify(arr_counter_time_finish));

        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("input[name^='counter_username']").removeClass('is-invalid');
                $("[id^='validation_counter_username']").html('');
                $("input[name^='counter_location_id']").removeClass('is-invalid');
                $("[id^='validation_counter_location_id']").html('');
                $("input[name^='counter_date_start']").removeClass('is-invalid');
                $("[id^='validation_counter_date_start']").html('');
                $("input[name^='counter_time_start']").removeClass('is-invalid');
                $("[id^='validation_counter_time_start']").html('');
                $("input[name^='counter_date_finish']").removeClass('is-invalid');
                $("[id^='validation_counter_date_finish']").html('');
                $("input[name^='counter_time_finish']").removeClass('is-invalid');
                $("[id^='validation_counter_time_finish']").html('');
                
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

    $("#btn_manual_count").on("click",function () {
        const count_no = $("#count_no").val();
        const stock_count_id = "{{ $data['current_data'][0]->stock_count_id }}";
        if(count_no == ""){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Count No must be choosen, can't be All",
                type: 'error',
                icon: 'error',
            });
            return;
        }
        const full_url = `{{ url('/') }}`+`/stock_count/${stock_count_id}/viewManualCount/${count_no}`;
        window.open(full_url,"_blank");
    });

    $("#btn_print").on("click",function () {
        const count_no = $("#count_no").val();
        const stock_count_id = "{{ $data['current_data'][0]->stock_count_id }}";
        if(count_no == ""){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Count No must be choosen, can't be All",
                type: 'error',
                icon: 'error',
            });
            return;
        }
        const full_url = `{{ url('/') }}`+`/stock_count/${stock_count_id}/viewPDF/${count_no}`;
        window.open(full_url,"_blank");
    });

    $("#btn_choose_location").on("click",function () {
        const target_row = $("#location_counter_target_row").val();
        const arr_location_id = [];
        
        $("input[id^='checkbox_location_id']:checked").each(function () {
            const current_dom = $(this)
            arr_location_id.push(current_dom.val())
        });

        const temp_counter_location_id = {
            list : arr_location_id,
        };
        
        const counter_location_id = JSON.stringify(temp_counter_location_id);
        $(`#counter_location_id_${target_row}`).val(counter_location_id);
        if(arr_location_id.length == 0){
            addDisplayNone(`btn_view_counter_location_${target_row}`);
        }else{
            removeDisplayNone(`btn_view_counter_location_${target_row}`);
        }

        $("#modal-TargetLocation").modal("hide");
    });

    $("#btn_suggest_location").on('click',function () {
        const arr_counter_username = [];
        $("input[name^='counter_username']").each(function () {
            arr_counter_username.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("arr_counter_username",JSON.stringify(arr_counter_username));

        $.ajax({
            url: "{{ route('stock_count.processSuggestLocation' , ['id' => $data['current_data'][0]->stock_count_id]) }}",
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("input[name^='counter_username']").removeClass('is-invalid');
                $("[id^='validation_counter_username']").html('');
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

                if('data' in response){
                    if(response.data.length > 0){
                        response.data.forEach(element => {
                            const counter_name = element.counter_name;
                            const list_location_id = element.list_location_id;
                            
                            const temp_counter_location_id = {
                                list : list_location_id,
                            }

                            const counter_location_id = JSON.stringify(temp_counter_location_id);
                            $(`#tabel-AssignToCounter tbody input[name^='counter_username']`).each(function () {
                                const current_row = $(this).prop("id").replace("counter_username_","");
                                const counter_username = $(`#counter_username_${current_row}`).val();
                                if(counter_name == counter_username){
                                    $(`#counter_location_id_${current_row}`).val(counter_location_id);
                                    if(list_location_id.length == 0){
                                        addDisplayNone(`btn_view_counter_location_${current_row}`);
                                    }else{
                                        removeDisplayNone(`btn_view_counter_location_${current_row}`);
                                    }
                                }

                                
                            });
                        });
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
                    type: 'success',
                    icon: 'success',
                });
            },
        });
    });

    $("#btn_select_all_location").on('click',function () {
        $("input[id^='checkbox_location_id']").prop('checked', true);
    });

    $("#btn_confirm").on("click",function () {
        $("#modal-ConfirmStockCount").modal("show");
    });

    $("#form-confirm-stock-count").on("submit",function (e) {
        e.preventDefault();
        const current_count_no = $("#count_no").val();
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("count_no",current_count_no);

        $.ajax({
            url: "{{ route('stock_count.processConfirmCount' , ['id' => $data['current_data'][0]->stock_count_id , 'count_no' => $data['current_data'][0]->count_no ]) }}",
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
            },
        });
    });
});
</script>
@endsection
