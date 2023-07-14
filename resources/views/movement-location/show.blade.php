@extends('layout.app')

@section("title")
Movement Location
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
                        <h5 class="me-auto">Movement Location - Show</h5>
                        <a href="{{ route('movement_location.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1">List</button>
                        </a>
                        <span class="me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" name="btn_print" id="btn_print" >Print</button>
                        </span>
                        @if ($data["current_data"][0]->status_id == "MOM")
                        <span class="me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" name="btn_confirm" id="btn_confirm" >Confirm</button>
                        </span>
                        @endif
                        @if ($data["current_data"][0]->status_id == "OPM")
                        <span class="me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" name="btn_cancel" id="btn_cancel" >Cancel</button>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="movement_id" class="form-label">Movement ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="movement_id" name="movement_id" value="{{ $data["current_data"][0]->movement_id }}" readonly>
                                                <div class="invalid-feedback" id="validation_movement_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_name" class="form-label">Warehouse Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="warehouse_name" name="warehouse_name" value="{{ session('current_warehouse_name') }}" readonly>
                                                <div class="invalid-feedback" id="validation_warehouse_name"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="status" class="form-label">Status</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="status" name="status" value="{{ $data["current_data"][0]->status_name }}" readonly>
                                                <div class="invalid-feedback" id="validation_status"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_id" class="form-label">Client ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="client_id" name="client_id" value="{{ $data["current_data"][0]->client_id }}" readonly>
                                                <div class="invalid-feedback" id="validation_client_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="movement_date" class="form-label">Movement Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="movement_date" name="movement_date" value="{{ $data["current_data"][0]->movement_date }}" readonly>
                                                <div class="invalid-feedback" id="validation_movement_date"></div>
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
                                                            <th class="text-center text-xs">SKU No</th>
                                                            <th class="text-center text-xs">Item Name</th>
                                                            <th class="text-center text-xs">Batch No</th>
                                                            <th class="text-center text-xs">Serial No</th>
                                                            <th class="text-center text-xs">Expired Date</th>
                                                            <th class="text-center text-xs">Qty</th>
                                                            <th class="text-center text-xs">UOM</th>
                                                            <th class="text-center text-xs">Stock Type</th>
                                                            <th class="text-center text-xs">Source Pallet ID</th>
                                                            <th class="text-center text-xs">Source Location ID</th>
                                                            <th class="text-center text-xs">Source Location Type</th>
                                                            <th class="text-center text-xs">Dest Pallet ID</th>
                                                            <th class="text-center text-xs">Dest Location ID</th>
                                                            <th class="text-center text-xs">Dest Location Type</th>
                                                            <th class="text-center text-xs">GR ID</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($data["current_data_item_detail"]) > 0 )
                                                        @foreach ($data["current_data_item_detail"] as $current_data_item_detail )
                                                        <tr>
                                                            <td class="text-xs">{{ $current_data_item_detail->sku }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->part_name }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->batch_no }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->serial_no }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->expired_date }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->qty }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->uom_name }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->stock_id }}</td>
                                                            <td class="text-xs"></td>
                                                            <td class="text-xs">{{ $current_data_item_detail->location_from }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->location_type_from }}</td>
                                                            <td class="text-xs"></td>
                                                            <td class="text-xs">{{ $current_data_item_detail->location_to }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->location_type_to }}</td>
                                                            <td class="text-xs">{{ $current_data_item_detail->gr_id }}</td>
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
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex">
                            @if ($data["current_data"][0]->status_id == "OPM")
                            <button type="button" class="btn btn-primary mb-0 py-1 me-2" name="btn_assign_to_warehouseman" id="btn_assign_to_warehouseman">Assign To Warehouseman</button>
                            @endif
                            @if ($data["current_data"][0]->status_id == "ASM")
                            <a href="{{ route('movement_location.viewMovementActivity',[ 'id' => $data["current_data"][0]->movement_id ]) }}" class="text-decoration-none me-2">
                                <button type="button" class="btn btn-primary mb-0 py-1" name="btn_movement_activity" id="btn_movement_activity">Movement Activity</button>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-AssignToWarehouseman" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modal-AssignToWarehousemanLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-AssignToWarehousemanLabel">Assign To Warehouseman</h5>
            <button type="button" class="btn btn-primary mb-0 py-1" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('movement_location.processAssignWarehouseman' , [ 'id' => $data["current_data"][0]->movement_id ]) }}" id="form-assign-warehouseman">
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
                                <button type="submit" class="btn btn-primary mb-0 py-1" name="btn_save_warehouseman" id="btn_save_warehouseman">Save</button>
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

<div class="modal fade" id="modal-ConfirmMovement" tabindex="-1" aria-labelledby="modal-ConfirmMovementLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('movement_location.confirmMovement' , [ 'id' => $data["current_data"][0]->movement_id ]) }}" id="form-confirm-movement">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label">Are you sure want to Confirm this ? </label>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary mb-0 py-1">Yes</button>
                            <button type="button" class="btn btn-primary mb-0 py-1" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-CancelMovement" tabindex="-1" aria-labelledby="modal-CancelMovementLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            <form method="POST" action="{{ route('movement_location.cancelMovement' , [ 'id' => $data["current_data"][0]->movement_id ]) }}" id="form-cancel-movement">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label">Are you sure want to Cancel this ? </label>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary mb-0 py-1">Yes</button>
                            <button type="button" class="btn btn-primary mb-0 py-1" data-bs-dismiss="modal">No</button>
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
function displayModalTargetUserWarehouseman(row) {
    $("#user_warehouseman_target_row").val(row);
    $("#tabel-TargetUserWarehouseman").DataTable().destroy();
    $("#tabel-TargetUserWarehouseman").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('movement_location.datatablesTargetUserAssign') }}",
        columns:[
            {data: 'username', searchable: true, className: "text-xs"},
            {data: 'fullname', searchable: true, className: "text-xs"},
        ],
    });

    $("#modal-TargetUserWarehouseman").modal("show");
}

function deleteRowWarehouseman(row) {
    $(`#row_warehouseman_${row}`).remove();
}

$(document).ready(function () {
    $("#dropdown_toggle_inventory").prop('aria-expanded',true);
    $("#dropdown_toggle_inventory").addClass('active');
    $("#dropdown_inventory").addClass('show');
    $("#logo_inventory").addClass("d-none");
    $("#logo_white_inventory").removeClass("d-none");
    $("#li_movement_location").addClass("active");
    $("#a_movement_location").addClass("active");

    let row_count_warehouseman = 1;

    $("#btn_assign_to_warehouseman").on("click",function () {
        $("#modal-AssignToWarehouseman").modal('show');
    });

    $("#btn_add_row_warehouseman").on("click",function () {
        const html_row_warehouseman = `
        <tr id="row_warehouseman_${row_count_warehouseman}">
            <td>
                <div class="input-group">  
                    <input type="text" class="form-control py-0" name="warehouseman_username[]" id="warehouseman_username_${row_count_warehouseman}" readonly>
                    <button type="button" class="btn btn-primary mb-0 py-1 mb-0 rounded" id="btn_search_target_warehouseman_${row_count_warehouseman}" name="btn_search_target_warehouseman_${row_count_warehouseman}" onclick="displayModalTargetUserWarehouseman('${row_count_warehouseman}')"><i class="bi bi-search"></i></button>
                    <div id="validation_warehouseman_username_${row_count_warehouseman}" class="invalid-feedback"></div>
                </div>
            </td>
            <td>
                <input type="date" class="form-control py-0" name="warehouseman_date_start[]" id="warehouseman_date_start_${row_count_warehouseman}">
                <div id="validation_warehouseman_date_start_${row_count_warehouseman}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type="time" class="form-control py-0" name="warehouseman_time_start[]" id="warehouseman_time_start_${row_count_warehouseman}">
                <div id="validation_warehouseman_time_start_${row_count_warehouseman}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type="date" class="form-control py-0" name="warehouseman_date_finish[]" id="warehouseman_date_finish_${row_count_warehouseman}">
                <div id="validation_warehouseman_date_finish_${row_count_warehouseman}" class="invalid-feedback"></div>
            </td>
            <td>
                <input type="time" class="form-control py-0" name="warehouseman_time_finish[]" id="warehouseman_time_finish_${row_count_warehouseman}">
                <div id="validation_warehouseman_time_finish_${row_count_warehouseman}" class="invalid-feedback"></div>
            </td>
            <td>
                <button type="button" class="btn btn-primary mb-0 py-1" name="btn_remove_row_warehouseman_${row_count_warehouseman}" id="btn_remove_row_warehouseman_${row_count_warehouseman}" onclick="deleteRowWarehouseman('${row_count_warehouseman}')">Remove</button>
            </td>
        </tr>`;
        row_count_warehouseman++;
        $("#tabel-AssignToWarehouseman > tbody").append(html_row_warehouseman);
    });

    $("#tabel-TargetUserWarehouseman > tbody").on('click','tr',function () {
        const target_row = $("#user_warehouseman_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const username = $($(dom_tr).children("td")[0]).text();
        
        $(`#warehouseman_username_${target_row}`).val(username);
        
        $("#modal-TargetUserWarehouseman").modal('hide');
    });

    $("#form-assign-warehouseman").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        const arr_warehouseman_username = [];
        $("input[name^='warehouseman_username']").each(function () {
            arr_warehouseman_username.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_warehouseman_date_start = [];
        $("input[name^='warehouseman_date_start']").each(function () {
            arr_warehouseman_date_start.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_warehouseman_time_start = [];
        $("input[name^='warehouseman_time_start']").each(function () {
            arr_warehouseman_time_start.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_warehouseman_date_finish = [];
        $("input[name^='warehouseman_date_finish']").each(function () {
            arr_warehouseman_date_finish.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_warehouseman_time_finish = [];
        $("input[name^='warehouseman_time_finish']").each(function () {
            arr_warehouseman_time_finish.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("arr_warehouseman_username",JSON.stringify(arr_warehouseman_username));
        formData.append("arr_warehouseman_date_start",JSON.stringify(arr_warehouseman_date_start));
        formData.append("arr_warehouseman_time_start",JSON.stringify(arr_warehouseman_time_start));
        formData.append("arr_warehouseman_date_finish",JSON.stringify(arr_warehouseman_date_finish));
        formData.append("arr_warehouseman_time_finish",JSON.stringify(arr_warehouseman_time_finish));

        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
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
            error: function (error) {
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                            confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                            confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                        confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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

    $("#btn_print").on("click",function () {
        const url = "{{ route('movement_location.printPDF' , [ 'id' => $data['current_data'][0]->movement_id ]) }}";
        window.open(url,"_blank");
    });

    $("#btn_confirm").on("click",function () {
        $("#modal-ConfirmMovement").modal("show");
    });

    $("#form-confirm-movement").on("submit",function (e) {
        e.preventDefault();
        const _token = $("meta[name='csrf-token']").prop('content');
        const url = $(this).prop("action");
        const formData = new FormData();
        formData.append("_token",_token);
        $.ajax({
            url: url,
            method: "POST",
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
                        confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                            confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                            confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                        confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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

    $("#btn_cancel").on("click",function () {
        $("#modal-CancelMovement").modal("show");
    });

    $("#form-cancel-movement").on("submit",function (e) {
        e.preventDefault();
        const _token = $("meta[name='csrf-token']").prop('content');
        const url = $(this).prop("action");
        const formData = new FormData();
        formData.append("_token",_token);
        $.ajax({
            url: url,
            method: "POST",
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
                        confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                            confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                            confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                        confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
