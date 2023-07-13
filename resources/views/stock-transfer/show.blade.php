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
                        <h5 class="me-auto">Stock Transfer - Show</h5>
                        <a href="{{ route('stock_transfer.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1">List</button>
                        </a>
                        {{-- @if ($data['stock_transfer_header'][0]->status_id == "OST")
                        <a href="#" onclick="alert('diblueprint ga ada proses edit nya.')" class="text-decoration-none me-2"> 
                            <button type="button" class="btn btn-primary">Edit</button>
                        </a>
                        @endif --}}
                        {{-- {{ route('outbound_planning.edit',['id' => $data["full_outbound_planning"][0]->outbound_planning_no ]) }} --}}
                    </div>
                    <hr>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="stock_transfer_id" name="stock_transfer_id" value="{{ @$data['stock_transfer_header'][0]->stock_transfer_id }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="{{ @$data['stock_transfer_header'][0]->wh_code }}" readonly>
                                                <div id="validation_warehouse_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="transaction_type" class="form-label text-xs">Transaction Type</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="transaction_type" name="transaction_type" value="{{ @$data['stock_transfer_header'][0]->transaction_name }}" readonly>
                                                <div id="validation_transaction_type" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="remark" class="form-label text-xs">Remark</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="remark" name="remark" value="{{ @$data['stock_transfer_header'][0]->remark }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ @$data['stock_transfer_header'][0]->client_project_name }}" readonly>
                                                <div id="validation_client_name" class="invalid-feedback"></div>
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
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" aria-current="true" data-bs-toggle="tab" href="#page-tab--attachment">Attachment</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-item-detail" style="min-width: calc(1 * 100%);">
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $row_stock_transfer_detail = 1;
                                                        @endphp
                                                        @foreach ($data["stock_transfer_detail"] as $key_stock_transfer_detail => $value_stock_transfer_detail )
                                                        <tr id="row_item_detail_{{ $row_stock_transfer_detail }}">
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_sku }}
                                                                <input type="hidden" name="source_sku[]" id="source_sku_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_sku }}">    
                                                                <div id="validation_source_sku_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $row_stock_transfer_detail }}
                                                                <input type="hidden" class="form-control" name="source_item_name[]" id="source_item_name_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_item_name }}">
                                                                <div id="validation_source_item_name_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_sku }}
                                                                <input type="hidden" name="destination_sku[]" id="destination_sku_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_sku }}" >    
                                                                <div id="validation_destination_sku_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_item_name }}
                                                                <input type="hidden" name="destination_item_name[]" id="destination_item_name_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_item_name }}" >    
                                                                <div id="validation_destination_item_name_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_batch_no }}
                                                                <input type="hidden" name="source_batch_no[]" id="source_batch_no_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_batch_no }}" >    
                                                                <div id="validation_source_batch_no_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_batch_no }}
                                                                <input type="hidden" name="destination_batch_no[]" id="destination_batch_no_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_batch_no }}" >    
                                                                <div id="validation_destination_batch_no_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_serial_no }}
                                                                <input type="hidden" name="source_serial_no[]" id="source_serial_no_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_serial_no }}" >    
                                                                <div id="validation_source_serial_no_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_serial_no }}
                                                                <input type="hidden" name="destination_serial_no[]" id="destination_serial_no_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_serial_no }}" >    
                                                                <div id="validation_destination_serial_no_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_imei }}
                                                                <input type="hidden" name="source_imei_no[]" id="source_imei_no_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_imei }}" >    
                                                                <div id="validation_source_imei_no_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_imei }}
                                                                <input type="hidden" name="destination_imei_no[]" id="destination_imei_no_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_imei }}" >    
                                                                <div id="validation_destination_imei_no_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_part_no }}
                                                                <input type="hidden" name="source_part_no[]" id="source_part_no_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_part_no }}" >    
                                                                <div id="validation_source_part_no_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_part_no }}
                                                                <input type="hidden" name="destination_part_no[]" id="destination_part_no_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_part_no }}" >    
                                                                <div id="validation_destination_part_no_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_color }}
                                                                <input type="hidden" name="source_color[]" id="source_color_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_color }}" >    
                                                                <div id="validation_source_color_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_color }}
                                                                <input type="hidden" name="destination_color[]" id="destination_color_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_color }}" >    
                                                                <div id="validation_destination_color_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_size }}
                                                                <input type="hidden" name="source_size[]" id="source_size_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_size }}" >    
                                                                <div id="validation_source_size_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_size }}
                                                                <input type="hidden" name="destination_size[]" id="destination_size_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_size }}" >    
                                                                <div id="validation_destination_size_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_exp_date }}
                                                                <input type="hidden" name="source_expired_date[]" id="source_expired_date_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_exp_date }}" >    
                                                                <div id="validation_source_expired_date_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_exp_date }}
                                                                <input type="hidden" name="destination_expired_date[]" id="destination_expired_date_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_exp_date }}" >    
                                                                <div id="validation_destination_expired_date_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_qty }}
                                                                <input type="hidden" name="source_qty[]" id="source_qty_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_qty }}" >    
                                                                <div id="validation_source_qty_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_uom }}
                                                                <input type="hidden" name="source_uom[]" id="source_uom_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_uom }}" >    
                                                                <div id="validation_source_uom_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_qty }}
                                                                <input type="hidden" name="destination_qty[]" id="destination_qty_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_qty }}" >    
                                                                <div id="validation_destination_qty_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_uom }}
                                                                <input type="hidden" name="destination_uom[]" id="destination_uom_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_uom }}" >    
                                                                <div id="validation_destination_uom_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                
                                                                <input type="hidden" name="source_base_qty[]" id="source_base_qty_{{ $row_stock_transfer_detail }}" value="" >    
                                                                <div id="validation_source_base_qty_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                
                                                                <input type="hidden" name="source_base_uom[]" id="source_base_uom_{{ $row_stock_transfer_detail }}" value="" >    
                                                                <div id="validation_source_base_uom_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                <input type="hidden" name="source_stock_id[]" id="source_stock_id_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_stock_id }}">    
                                                                {{ $value_stock_transfer_detail->source_stock_type }}
                                                                <input type="hidden" name="source_stock_type[]" id="source_stock_type_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_stock_type }}" >    
                                                                <div id="validation_source_stock_type_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                <input type="hidden" name="destination_stock_id[]" id="destination_stock_id_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_stock_id }}"> 
                                                                {{ $value_stock_transfer_detail->dest_stock_type }}
                                                                <input type="hidden" name="destination_stock_type[]" id="destination_stock_type_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_stock_type }}" >    
                                                                <div id="validation_destination_stock_type_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_location }}
                                                                <input type="hidden" name="source_location_id[]" id="source_location_id_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_location }}" >    
                                                                <div id="validation_source_location_id_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->dest_location }}
                                                                <input type="hidden" name="destination_location_id[]" id="destination_location_id_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->dest_location }}" >    
                                                                <div id="validation_destination_location_id_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                            <td class="text-center text-xs">
                                                                {{ $value_stock_transfer_detail->source_gr }}
                                                                <input type="hidden" name="source_gr_id[]" id="source_gr_id_{{ $row_stock_transfer_detail }}" value="{{ $value_stock_transfer_detail->source_gr }}" >    
                                                                <div id="validation_source_gr_id_{{ $row_stock_transfer_detail }}" class="invalid-feedback"></div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $row_stock_transfer_detail++;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--attachment">
                                    <div class="row ">
                                        <div class="col-sm-12 mb-2">
                                            @if (isset($data['stock_transfer_header'][0]->data_upload1))
                                            <a href="{{ $data['stock_transfer_header'][0]->data_upload1 }}">{{ $data['stock_transfer_header'][0]->data_upload1 }}</a>
                                                
                                            @endif
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            @if (isset($data['stock_transfer_header'][0]->data_upload2))
                                            <a href="{{ $data['stock_transfer_header'][0]->data_upload2 }}">{{ $data['stock_transfer_header'][0]->data_upload2 }}</a>
                                                
                                            @endif
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            @if (isset($data['stock_transfer_header'][0]->data_upload3))
                                            <a href="{{ $data['stock_transfer_header'][0]->data_upload3 }}">{{ $data['stock_transfer_header'][0]->data_upload3 }}</a>
                                                
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        @if ($data['stock_transfer_header'][0]->status_id == "OST")
                        <button type="button" class="btn btn-primary text-xs py-1" id="btn_confirm" name="btn_confirm">Confirm</button>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Confirm" tabindex="-1" aria-labelledby="modal-ConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ConfirmLabel">Confirm Stock Transfer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('stock_transfer.confirmStockTransfer' , [ 'id' => $data["stock_transfer_header"][0]->stock_transfer_id ]) }}" id="form-process-confirm">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label text-xs">Are you sure this Stock Transfer is correct ? </label>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary text-xs py-1">Yes</button>
                                    <button type="button" class="btn btn-primary text-xs py-1" data-bs-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@endsection

@section("javascript")
<script type="text/javascript">
$(document).ready(function () {
    $("#dropdown_toggle_inventory").prop('aria-expanded',true);
    $("#dropdown_toggle_inventory").addClass('active');
    $("#dropdown_inventory").addClass('show');
    $("#li_stock_transfer").addClass("active");
    $("#a_stock_transfer").addClass("active");

    $("#btn_confirm").on("click",function () {
        $("#modal-Confirm").modal('show');
    });

    $("#form-process-confirm").on("submit",function (e) {
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
