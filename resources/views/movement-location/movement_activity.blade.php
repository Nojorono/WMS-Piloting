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
                        <h5 class="me-auto">Movement Location - Movement Activity</h5>
                        <a href="{{ route('movement_location.show',[ 'id' => $data['current_data'][0]->movement_id ]) }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1">Show</button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('movement_location.saveMovementActivity',[ 'id' => $data['current_data'][0]->movement_id ]) }}" id="form-save-movement-activity">
                    <div class="col-sm-12 mb-2">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 mb-2">
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
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse_id" class="form-label">Warehouse ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="warehouse_id" name="warehouse_id" value="{{ session("current_warehouse_id") }}" readonly>
                                                <div class="invalid-feedback" id="validation_warehouse_id"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
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
                                    <div class="col-sm-4 mb-2">
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
                                    <div class="col-sm-4 mb-2">
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
                                                        @php
                                                            $row_table_item_detail = 1;
                                                        @endphp
                                                        @if (count($data["current_data_item_detail"]) > 0 )
                                                        @foreach ($data["current_data_item_detail"] as $current_data_item_detail )
                                                        
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="sku_no[]" id="sku_no_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->sku }}" readonly>
                                                                <div class="invalid-feedback" id="validation_sku_no_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="item_name[]" id="item_name_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->part_name }}" readonly>
                                                                <div class="invalid-feedback" id="validation_item_name_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="batch_no[]" id="batch_no_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->batch_no }}" readonly>
                                                                <div class="invalid-feedback" id="validation_batch_no_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="serial_no[]" id="serial_no_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->serial_no }}" readonly>
                                                                <div class="invalid-feedback" id="validation_serial_no_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="expired_date[]" id="expired_date_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->expired_date }}" readonly>
                                                                <div class="invalid-feedback" id="validation_expired_date_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="qty[]" id="qty_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->qty }}" readonly>
                                                                <div class="invalid-feedback" id="validation_qty_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="uom[]" id="uom_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->uom_name }}" readonly>
                                                                <div class="invalid-feedback" id="validation_uom_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="stock_type[]" id="stock_type_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->stock_id }}" readonly>
                                                                <div class="invalid-feedback" id="validation_stock_type_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="pallet_id[]" id="pallet_id_{{ $row_table_item_detail }}" value="" readonly>
                                                                <div class="invalid-feedback" id="validation_pallet_id_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_id[]" id="location_id_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->location_from }}" readonly>
                                                                <div class="invalid-feedback" id="validation_location_id_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="location_type[]" id="location_type_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->location_type_from }}" readonly>
                                                                <div class="invalid-feedback" id="validation_location_type_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="dest_pallet_id[]" id="dest_pallet_id_{{ $row_table_item_detail }}" value="" readonly>
                                                                <div class="invalid-feedback" id="validation_dest_pallet_id_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    
                                                                    <input type="text" class="form-control py-0" name="dest_location_id[]" id="dest_location_id_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->location_to }}" readonly>
                                                                    <button type="button" class="btn btn-primary mb-0 py-1 mb-0 rounded" onclick="displayModalAddItemDetailLocation('{{ $row_table_item_detail }}')"><i class="bi bi-search"></i></button>
                                                                    <div class="invalid-feedback" id="validation_dest_location_id_{{ $row_table_item_detail }}"></div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="dest_location_type[]" id="dest_location_type_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->location_type_to }}" readonly>
                                                                <div class="invalid-feedback" id="validation_dest_location_type_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control py-0" name="gr_id[]" id="gr_id_{{ $row_table_item_detail }}" value="{{ $current_data_item_detail->gr_id }}" readonly>
                                                                <div class="invalid-feedback" id="validation_gr_id_{{ $row_table_item_detail }}"></div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $row_table_item_detail++;
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
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary mb-0 py-1 me-2" name="btn_assign_to_warehouseman" id="btn_assign_to_warehouseman">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-AddItemDetailLocation" tabindex="-1" aria-labelledby="modal-AddItemDetailLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-AddItemDetailLocationLabel">Location- List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="modal-AddItemDetailLocation_target_row" id="modal-AddItemDetailLocation_target_row">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-AddItemDetailLocation" >
                        <thead>
                            <tr>
                                <th>Location Code</th>
                                <th>Location Type</th>
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
function displayModalAddItemDetailLocation(row) {
    $("#modal-AddItemDetailLocation_target_row").val(row);
    $("#list-datatable-modal-AddItemDetailLocation").DataTable().destroy();
    $("#list-datatable-modal-AddItemDetailLocation").DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('movement_location.datatablesModalItemDetailLocation') }}",
        columns:[
            {data: 'location_code', searchable: true,},
            {data: 'location_type', searchable: true,},
        ],
    });
    $("#modal-AddItemDetailLocation").modal('show');
}

$(document).ready(function () {
    $("#dropdown_toggle_inventory").prop('aria-expanded',true);
    $("#dropdown_toggle_inventory").addClass('active');
    $("#dropdown_inventory").addClass('show');
    $("#logo_inventory").addClass("d-none");
    $("#logo_white_inventory").removeClass("d-none");
    $("#li_movement_location").addClass("active");
    $("#a_movement_location").addClass("active");

    $("#list-datatable-modal-AddItemDetailLocation > tbody").on('click','tr',function () {
        const target_row = $("#modal-AddItemDetailLocation_target_row").val();
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const location_id = $($(dom_tr).children("td")[0]).text(); 
        const location_type = $($(dom_tr).children("td")[1]).text(); 
        
        $(`#dest_location_id_${target_row}`).val(location_id);
        $(`#dest_location_type_${target_row}`).val(location_type);
        $("#modal-AddItemDetailLocation").modal('hide');
    });

    $("#form-save-movement-activity").on("submit",function (e) {
        e.preventDefault();
        const _token = $("meta[name='csrf-token']").prop('content');
        const url = $(this).prop("action");

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

        const arr_batch_no = [];
        $("input[name^='batch_no']").each(function () {
            arr_batch_no.push({
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

        const arr_expired_date = [];
        $("input[name^='expired_date']").each(function () {
            arr_expired_date.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_qty = [];
        $("input[name^='qty']").each(function () {
            arr_qty.push({
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

        const arr_stock_type = [];
        $("input[name^='stock_type']").each(function () {
            arr_stock_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_pallet_id = [];
        $("input[name^='pallet_id']").each(function () {
            arr_pallet_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_id = [];
        $("input[name^='location_id']").each(function () {
            arr_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_location_type = [];
        $("input[name^='location_type']").each(function () {
            arr_location_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_dest_pallet_id = [];
        $("input[name^='dest_pallet_id']").each(function () {
            arr_dest_pallet_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_dest_location_id = [];
        $("input[name^='dest_location_id']").each(function () {
            arr_dest_location_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_dest_location_type = [];
        $("input[name^='dest_location_type']").each(function () {
            arr_dest_location_type.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });

        const arr_gr_id = [];
        $("input[name^='gr_id']").each(function () {
            arr_gr_id.push({
                id: $(this).prop('id'),
                value: $(this).val(),
            });    
        });
        

        const formData = new FormData();
        formData.append("_token",_token);

        formData.append("arr_sku_no",JSON.stringify(arr_sku_no));
        formData.append("arr_item_name",JSON.stringify(arr_item_name));
        formData.append("arr_batch_no",JSON.stringify(arr_batch_no));
        formData.append("arr_serial_no",JSON.stringify(arr_serial_no));
        formData.append("arr_expired_date",JSON.stringify(arr_expired_date));
        formData.append("arr_qty",JSON.stringify(arr_qty));
        formData.append("arr_uom",JSON.stringify(arr_uom));
        formData.append("arr_stock_type",JSON.stringify(arr_stock_type));
        formData.append("arr_pallet_id",JSON.stringify(arr_pallet_id));
        formData.append("arr_location_id",JSON.stringify(arr_location_id));
        formData.append("arr_location_type",JSON.stringify(arr_location_type));
        formData.append("arr_dest_pallet_id",JSON.stringify(arr_dest_pallet_id));
        formData.append("arr_dest_location_id",JSON.stringify(arr_dest_location_id));
        formData.append("arr_dest_location_type",JSON.stringify(arr_dest_location_type));
        formData.append("arr_gr_id",JSON.stringify(arr_gr_id));

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("input[name^='sku_no']").removeClass('is-invalid');
                $("[id^='validation_sku_no']").html('');
                $("input[name^='item_name']").removeClass('is-invalid');
                $("[id^='validation_item_name']").html('');
                $("input[name^='batch_no']").removeClass('is-invalid');
                $("[id^='validation_batch_no']").html('');
                $("input[name^='serial_no']").removeClass('is-invalid');
                $("[id^='validation_serial_no']").html('');
                $("input[name^='expired_date']").removeClass('is-invalid');
                $("[id^='validation_expired_date']").html('');
                $("input[name^='qty']").removeClass('is-invalid');
                $("[id^='validation_qty']").html('');
                $("input[name^='uom']").removeClass('is-invalid');
                $("[id^='validation_uom']").html('');
                $("input[name^='stock_type']").removeClass('is-invalid');
                $("[id^='validation_stock_type']").html('');
                $("input[name^='pallet_id']").removeClass('is-invalid');
                $("[id^='validation_pallet_id']").html('');
                $("input[name^='location_id']").removeClass('is-invalid');
                $("[id^='validation_location_id']").html('');
                $("input[name^='location_type']").removeClass('is-invalid');
                $("[id^='validation_location_type']").html('');
                $("input[name^='dest_pallet_id']").removeClass('is-invalid');
                $("[id^='validation_dest_pallet_id']").html('');
                $("input[name^='dest_location_id']").removeClass('is-invalid');
                $("[id^='validation_dest_location_id']").html('');
                $("input[name^='dest_location_type']").removeClass('is-invalid');
                $("[id^='validation_dest_location_type']").html('');
                $("input[name^='gr_id']").removeClass('is-invalid');
                $("[id^='validation_gr_id']").html('');
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
                
                window.location = "{{ route('movement_location.show',['id' => $data['current_data'][0]->movement_id ]) }}";
                return;

            },
        });
    });
    
});
</script>
@endsection
