@extends('layout.app')

@section("title")
Goods Receiving
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
                        <h5 class="me-auto">Goods Receiving - Show</h5>
                        <a href="{{ route('goods_receiving.index') }}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary mb-0 py-1">List</button>
                        </a>
                        @if ($data["current_data"]->status_id == "RGR")
                        <a href="{{ route('goods_receiving.printGRN',[ "id" => $data["current_data"]->gr_id ]) }}" class="text-decoration-none ms-2" target="_blank">
                            <button type="button" class="btn btn-primary mb-0 py-1">Print GRN</button>
                        </a>
                        @endif
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="card border-0">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <label for="gr_id" class="form-label text-xs">GR ID</label>
                                        <input type="text" class="form-control py-0" id="gr_id" name="gr_id" value="{{ @$data["current_data"]->gr_id }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_gr_id"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="gr_date" class="form-label text-xs">GR Date</label>
                                        <input type="text" class="form-control py-0" id="gr_date" name="gr_date" value="{{ @$data["current_data"]->gr_date }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_gr_date"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="inbound_id" class="form-label text-xs">Inbound Planning No</label>
                                        <input type="text" class="form-control py-0" id="inbound_id" name="inbound_id" value="{{ @$data["current_data"]->inbound_planning_no }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_inbound_id"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_name" class="form-label text-xs">Supplier</label>
                                        <input type="hidden" id="supplier_id" name="supplier_id" value="{{ @$data["current_data"]->supplier_id }}">
                                        <input type="text" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ @$data["current_data"]->supplier_name }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_supplier_name"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="reference_no" class="form-label text-xs">Reference No</label>
                                        <input type="text" class="form-control py-0" id="reference_no" name="reference_no" value="{{ @$data["current_data"]->reference_no }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_reference_no"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                        <input type="text" class="form-control py-0" id="supplier_address" name="supplier_address" value="{{ @$data["current_data"]->address1 }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_supplier_address"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="receipt_no" class="form-label text-xs">Receipt No</label>
                                        <input type="text" class="form-control py-0" id="receipt_no" name="receipt_no" value="{{ @$data["current_data"]->receipt_no }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_receipt_no"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="client_name" class="form-label text-xs">Client Name</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ @$data["current_data"]->client_name }}" readonly>
                                        <div id="validation_client_name" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="order_type" class="form-label text-xs">Order Type</label>
                                        <input type="hidden" id="order_id" name="order_id" value="{{ $data["current_data"]->order_id }}">
                                        <input type="text" autocomplete="off" class="form-control py-0" id="order_type" name="order_type" value="{{ $data["current_data"]->order_type }}" readonly>
                                        <div id="validation_order_type" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="warehouse_name" class="form-label text-xs">Warehouse Name</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="{{ session('current_warehouse_name') }}" readonly>
                                        <div id="validation_warehouse_name" class="invalid-feedback text-xs"></div>
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
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--transport-and-unloading">Transport & Unloading</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--scan-history">Scan History</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--notes">Notes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--attachment">Attachment</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body tab-content py-0">
                                <div class="tab-pane active" id="page-tab--item-detail">
                                    <div class="row mb-2">
                                        <div class="col-sm-12 mb-2" id="container-item-detail">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-item-detail" style="min-width: calc(1.5 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center">Movement Id</th>
                                                            <th class="text-xs text-center">SKU No</th>
                                                            <th class="text-xs text-center">Item Name</th>
                                                            <th class="text-xs text-center">Batch No</th>
                                                            <th class="text-xs text-center">Expired Date</th>
                                                            <th class="text-xs text-center">Qty Received</th>
                                                            <th class="text-xs text-center">Qty Plan</th>
                                                            <!-- <th class="text-xs text-center">Qty Putaway</th>
                                                            <th class="text-xs text-center">Location Putaway</th> -->
                                                            <th class="text-xs text-center">UOM</th>
                                                            <th class="text-xs text-center">Classification ID</th>
                                                            <th class="text-xs text-center">Classification</th>
                                                            <th class="text-xs text-center">Is Scanned</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $current_row = 0;
                                                        @endphp
                                                        @if (count($data["current_data_detail"]) > 0)
                                                        @foreach ($data["current_data_detail"] as $current_data_detail )
                                                        @php
                                                        $current_row ++;
                                                        @endphp
                                                        <tr id='table_item_detail_{{ $current_row }}'>
                                                            <td>
                                                                <input style="font-size: 12px;" type='text' class='form-control py-0' name='movement_id[]' id='movement_id_{{ $current_row }}' value="{{ $current_data_detail->movement_id }}" readonly>
                                                                <div id="validation_movement_id_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_{{ $current_row }}' value="{{ $current_data_detail->sku }}" readonly>
                                                                <div id="validation_sku_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_{{ $current_row }}' value="{{ $current_data_detail->item_name }}" readonly>
                                                                <div id="validation_item_name_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_{{ $current_row }}' value="{{ $current_data_detail->batch_no }}" readonly>
                                                                <div id="validation_batch_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='date' class='form-control py-0' name='expired_date[]' id='expired_date_{{ $current_row }}' value="{{ (!empty($current_data_detail->expired_date)) ? date("Y-m-d",strtotime($current_data_detail->expired_date)) : "" }}" readonly>
                                                                <div id="validation_expired_date_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='qty_received[]' id='qty_received_{{ $current_row }}' value="{{ $current_data_detail->qty_receive }}" readonly>
                                                                <div id="validation_qty_received_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='qty_plan[]' id='qty_plan_{{ $current_row }}' value="{{ $current_data_detail->qty_plan }}" readonly>
                                                                <div id="validation_qty_plan_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <!-- <td>
                                                                <input type='text' class='form-control py-0 rounded-start' name='qty_putaway[]' id='qty_putaway_{{ $current_row }}' value="{{ $current_data_detail->qty_putaway }}" readonly>
                                                                <div id="validation_qty_putaway_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0 rounded-start' name='location_to[]' id='location_to_{{ $current_row }}' value="{{ $current_data_detail->location_to }}" readonly>
                                                                <div id="validation_location_to_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td> -->
                                                            <td>
                                                                <input type='text' class='form-control py-0 rounded-start' name='uom[]' id='uom_{{ $current_row }}' value="{{ $current_data_detail->uom_name }}" readonly>
                                                                <div id="validation_uom_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='id_classification[]' id='id_classification_{{ $current_row }}' value="{{ $current_data_detail->clasification_id }}" readonly>
                                                                <div id="validation_id_classification_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0 rounded-start' name='classification[]' id='classification_{{ $current_row }}' value="{{ $current_data_detail->classification_name }}" readonly>
                                                                <div id="validation_classification_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0 rounded-start' name='is_scanned[]' id='is_scanned_{{ $current_row }}' value="{{ $current_data_detail->is_scanned }}" readonly>
                                                                <div id="validation_is_scanned_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- TRANSPORT & UNLOADING -->
                                <div class="tab-pane" id="page-tab--transport-and-unloading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-transport-and-unloading" {{-- style="min-width: calc(2.5 * 100%);" --}}>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center">Main Checker</th>
                                                            <!-- <th class="text-xs text-center">Supervisor</th> -->
                                                            <th class="text-xs text-center">Arrival Vehicle</th>
                                                            <th class="text-xs text-center">Start Unloading</th>
                                                            <th class="text-xs text-center">Finish Unloading</th>
                                                            <th class="text-xs text-center">Departure Vehicle</th>
                                                            <th class="text-xs text-center">Vehicle No</th>
                                                            <th class="text-xs text-center">Driver</th>
                                                            <th class="text-xs text-center">Vehicle Type</th>
                                                            <th class="text-xs text-center">Container No</th>
                                                            <th class="text-xs text-center">Seal No</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($data["current_data_wh_activity"]) > 0)
                                                        @foreach ($data["current_data_wh_activity"] as $current_data_wh_activity )
                                                        <tr class="text-center">
                                                            <td class="text-xs">{{ $current_data_wh_activity->main_checker}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_activity->arrival_date}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_activity->start_unloading}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_activity->finish_unloading}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_activity->departure_date}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_activity->vehicle_no}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_activity->driver_name}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_activity->vehicle_type}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_activity->container_no}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_activity->seal_no}}</td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SCAN HISTORY -->
                                <div class="tab-pane" id="page-tab--scan-history">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-scan-history" {{-- style="min-width: calc(2.5 * 100%);" --}}>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center">GR Id</th>
                                                            <th class="text-xs text-center">Movement Id</th>
                                                            <th class="text-xs text-center">Warehouseman</th>
                                                            <th class="text-xs text-center">Qty Scan</th>
                                                            <th class="text-xs text-center">SKU</th>
                                                            <th class="text-xs text-center">Item Name</th>
                                                            <th class="text-xs text-center">Serial No</th>
                                                            <th class="text-xs text-center">Status Id</th>
                                                            <th class="text-xs text-center">Expired Date</th>
                                                            <th class="text-xs text-center">UoM Name</th>
                                                            <th class="text-xs text-center">Stock Id</th>
                                                            <th class="text-xs text-center">Location From</th>
                                                            <th class="text-xs text-center">Location To</th>
                                                            <th class="text-xs text-center">Assign By</th>
                                                            <th class="text-xs text-center">Datetime Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($data["scan_history"]) > 0)
                                                        @foreach ($data["scan_history"] as $scan_history )
                                                        <tr class="text-center">
                                                            <td class="text-xs">{{ $scan_history->gr_id}}</td>
                                                            <td class="text-xs">{{ $scan_history->movement_id}}</td>
                                                            <td class="text-xs">{{ $scan_history->warehouseman}}</td>
                                                            <td class="text-xs">{{ $scan_history->qty}}</td>
                                                            <td class="text-xs">{{ $scan_history->sku}}</td>
                                                            <td class="text-xs">{{ $scan_history->part_name}}</td>
                                                            <td class="text-xs">{{ $scan_history->serial_no}}</td>
                                                            <td class="text-xs">{{ $scan_history->status_id}}</td>
                                                            <td class="text-xs">{{ $scan_history->expired_date}}</td>
                                                            <td class="text-xs">{{ $scan_history->uom_name}}</td>
                                                            <td class="text-xs">{{ $scan_history->stock_id}}</td>
                                                            <td class="text-xs">{{ $scan_history->location_from}}</td>
                                                            <td class="text-xs">{{ $scan_history->location_to}}</td>
                                                            <td class="text-xs">{{ $scan_history->user_created}}</td>
                                                            <td class="text-xs">{{ $scan_history->datetime_created}}</td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="page-tab--notes">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <textarea name="remarks" id="remarks" rows="10" class="form-control py-0" readonly>{{ @$data["current_data"]->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="page-tab--attachment">
                                    <div class="row ">
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0" name="file_1" id="file_1" disabled>
                                            <div id="validation_file_1" class="invalid-feedback text-xs"></div>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0" name="file_2" id="file_2" disabled>
                                            <div id="validation_file_2" class="invalid-feedback text-xs"></div>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <input type="file" class="form-control py-0" name="file_3" id="file_3" disabled>
                                            <div id="validation_file_3" class="invalid-feedback text-xs"></div>
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
                                            @if ($data["current_data"]->status_id == "OGR")
                                            <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_good_receive" name="btn_good_receive"> Good Receive</button>
                                            @endif

                                            @if ($data["current_data"]->status_id == "RGR")
                                            <a href="{{ route('goods_receiving.showMovementLocation',[ "id" => $data["current_data"]->gr_id ]) }}" class="text-decoration-none ms-2">
                                                <button type="button" class="btn btn-primary mb-0 py-1">Movement Location</button>
                                            </a>

                                            @if ($data["current_data"]->scan_status == "fully_scan")
                                            <button type="button" class="btn btn-primary mb-0 py-1 ms-2" id="btn_confirm_putaway" name="btn_confirm_putaway">Confirm Putaway</button>
                                            @endif

                                            @endif
                                            @if ($data["current_data"]->status_id == "PGR")
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("javascript")
<script type="text/javascript">
    $(document).ready(function() {
        $("#dropdown_toggle_inbound").prop('aria-expanded', true);
        $("#dropdown_toggle_inbound").addClass('active');
        $("#dropdown_inbound").addClass('show');
        $("#logo_inbound").addClass("d-none");
        $("#logo_white_inbound").removeClass("d-none");
        $("#li_goods_receiving").addClass("active");
        $("#a_goods_receiving").addClass("active");

        $("#btn_confirm_putaway").on("click", function() {
            const confirmed = confirm("Are you sure this data is already correct ?");

            if (!confirmed) {
                return;
            }

            const url = "{{ route('goods_receiving.confirmPutaway', [ 'id'=> $data['current_data']->gr_id ]) }}";
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
                beforeSend: function() {

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
                    window.location = "{{ route('goods_receiving.index') }}";
                    return;

                },
            });
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
    });
</script>
@endsection