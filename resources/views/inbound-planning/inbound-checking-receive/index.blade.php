@extends('layout.app')

@section("title")
Inbound Planning
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
                        <h5 class="me-auto">Inbound Checking and Receive</h5>
                        <a href='{{ route('inbound_planning.show',[ 'id'=> $data["current_data"]->inbound_planning_no ]) }}' class='text-decoration-none'>
                            <button class='btn btn-primary mb-0 py-1'>Show</button>
                        </a>
                    </div>
                    <div class="col-sm-12">
                        <div class="card border-0">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-12 mb-2">
                                        <label for="inbound_planning_no" class="form-label text-xs">Inbound Planning No</label>
                                        <input type="text" class="form-control py-0" id="inbound_planning_no" name="inbound_planning_no" value="{{ $data["current_data"]->inbound_planning_no }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_inbound_planning_no"></div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <label for="reference_no" class="form-label text-xs">Reference No*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="reference_no" name="reference_no" value="{{ $data["current_data"]->reference_no }}" readonly>
                                        <div id="validation_reference_no" class="invalid-feedback text-xs"></div>
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
                                        <a class="nav-link text-xs active" aria-current="true" data-bs-toggle="tab" href="#page-tab--transportation">Transportation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" aria-current="true" data-bs-toggle="tab" href="#page-tab--scan">Scan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" aria-current="true" data-bs-toggle="tab" href="#page-tab--checked-items" onclick="getDatatablesCheckedItems()">Checked Items</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-xs" aria-current="true" data-bs-toggle="tab" href="#page-tab--outstanding-items" onclick="getDatatablesOutstandingItems()">Outstanding Items</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content py-0">
                                {{-- page-tab--transportation start --}}
                                <div class="tab-pane active" id="page-tab--transportation">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="d-flex justify-content-start">
                                                <button type="button" class="btn btn-primary mb-0 py-1" name="btn_add_vehicle" id="btn_add_vehicle"><i class="bi bi-plus"></i> Add Vehicle</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12" id="container_detail_vehicle">
                                            @php
                                            $current_row_detail_vehicle = 1
                                            @endphp
                                            @if (isset($data["current_data_transpotation"]) && count($data["current_data_transpotation"]) > 0 )
                                            @foreach ($data["current_data_transpotation"] as $data_transportation )
                                            <div class="row" id="row_{{ $current_row_detail_vehicle }}">
                                                <div class="col-sm-12 mb-2">
                                                    <h5>Vehicle Info</h5>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <input type="hidden" name="transport_id[]" id="transport_id_{{ $current_row_detail_vehicle }}" value={{ $data_transportation->transport_id }}>
                                                    <div class="row mb-2">
                                                        <label for="vehicle_type_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Vehicle Type</label>
                                                        <div class="col-sm-3">
                                                            <div class="row">
                                                                <div class="col-sm-10">
                                                                    <input type="hidden" name="vehicle_id[]" id="vehicle_id_{{ $current_row_detail_vehicle }}" value="{{ $data_transportation->vehicle_id }}">
                                                                    <input type="text" class="form-control py-0" name="vehicle_type[]" id="vehicle_type_{{ $current_row_detail_vehicle }}" value="{{ $data_transportation->vehicle_type }}" readonly>
                                                                    <div id="validation_vehicle_type_{{ $current_row_detail_vehicle }}" class="invalid-feedback text-xs"></div>
                                                                </div>
                                                                <div class="col-sm-2 ps-0">
                                                                    <button type="button" class="btn btn-primary mb-0 rounded" onclick="displayModalVehicleID('{{ $current_row_detail_vehicle }}')"><i class="bi bi-search"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="vehicle_no_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Vehicle No</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control py-0" id="vehicle_no_{{ $current_row_detail_vehicle }}" name="vehicle_no[]" value="{{ $data_transportation->vehicle_no }}" readonly>
                                                            <div class="invalid-feedback text-xs" id="validation_vehicle_no_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="driver_name_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Driver Name</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control py-0" id="driver_name_{{ $current_row_detail_vehicle }}" name="driver_name[]" value="{{ $data_transportation->driver_name }}">
                                                            <div class="invalid-feedback text-xs" id="validation_driver_name_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="container_no_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Container No</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control py-0" id="container_no_{{ $current_row_detail_vehicle }}" name="container_no[]" value="{{ $data_transportation->container_no }}">
                                                            <div class="invalid-feedback text-xs" id="validation_container_no_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="seal_no_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Seal No</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control py-0" id="seal_no_{{ $current_row_detail_vehicle }}" name="seal_no[]" value="{{ $data_transportation->seal_no }}">
                                                            <div class="invalid-feedback text-xs" id="validation_seal_no_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <h5>Vehicle Activity</h5>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <div class="row mb-2">
                                                        <label for="arrival_date_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Arrival Date</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" class="form-control py-0" id="arrival_date_{{ $current_row_detail_vehicle }}" name="arrival_date[]" value="{{ $data_transportation->arrival_date }}">
                                                            <div class="invalid-feedback text-xs" id="validation_arrival_date_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                        <label for="arrival_time_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Arrival Time</label>
                                                        <div class="col-sm-3">
                                                            <input type="time" class="form-control py-0" id="arrival_time_{{ $current_row_detail_vehicle }}" name="arrival_time[]" value="{{ $data_transportation->arrival_time }}">
                                                            <div class="invalid-feedback text-xs" id="validation_arrival_time_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="start_unloading_date_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Start Unloading Date</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" class="form-control py-0" id="start_unloading_date_{{ $current_row_detail_vehicle }}" name="start_unloading_date[]" value="{{ $data_transportation->start_unloading_date }}">
                                                            <div class="invalid-feedback text-xs" id="validation_start_unloading_date_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                        <label for="start_unloading_time_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Start Unloading Time</label>
                                                        <div class="col-sm-3">
                                                            <input type="time" class="form-control py-0" id="start_unloading_time_{{ $current_row_detail_vehicle }}" name="start_unloading_time[]" value="{{ $data_transportation->start_unloading_time }}">
                                                            <div class="invalid-feedback text-xs" id="validation_start_unloading_time_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="finish_unloading_date_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Finish Unloading Date</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" class="form-control py-0" id="finish_unloading_date_{{ $current_row_detail_vehicle }}" name="finish_unloading_date[]" value="{{ $data_transportation->finish_unloading_date }}">
                                                            <div class="invalid-feedback text-xs" id="validation_finish_unloading_date_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                        <label for="finish_unloading_time_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Finish Unloading Time</label>
                                                        <div class="col-sm-3">
                                                            <input type="time" class="form-control py-0" id="finish_unloading_time_{{ $current_row_detail_vehicle }}" name="finish_unloading_time" value="{{ $data_transportation->finish_unloading_time }}">
                                                            <div class="invalid-feedback text-xs" id="validation_finish_unloading_time_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="departure_date_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Departure Date</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" class="form-control py-0" id="departure_date_{{ $current_row_detail_vehicle }}" name="departure_date[]" value="{{ $data_transportation->departure_date }}">
                                                            <div class="invalid-feedback text-xs" id="validation_departure_date_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                        <label for="departure_time_{{ $current_row_detail_vehicle }}" class="form-label text-xs col-sm-2">Departure Time</label>
                                                        <div class="col-sm-3">
                                                            <input type="time" class="form-control py-0" id="departure_time_{{ $current_row_detail_vehicle }}" name="departure_time[]" value="{{ $data_transportation->departure_time }}">
                                                            <div class="invalid-feedback text-xs" id="validation_departure_time_{{ $current_row_detail_vehicle }}"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                            $current_row_detail_vehicle++;
                                            @endphp
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <button type="button" class="btn btn-primary mb-0 py-1" name="btn_save_partial_vehicle" id="btn_save_partial_vehicle">Save Vehicle</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mb-2 text-end">
                                            <button type="button" class="btn btn-primary mb-0 py-1" name="btn_save_vehicle" id="btn_save_vehicle">Save</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- page-tab--transportation end --}}


                                <!-- SCAN -->
                                {{-- page-tab--scan start --}}
                                <div class="tab-pane" id="page-tab--scan">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">

                                            <!-- VEHICLE NO -->
                                            <div class="row mb-2 align-items-center">
                                                <label for="scan_vehicle_no" class="form-label text-xs col-sm-2">Vehicle No</label>
                                                <div class="col-sm-3">
                                                    <select class="form-select py-0" name="scan_vehicle_no" id="scan_vehicle_no">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["current_data_transpotation"]) && count($data["current_data_transpotation"]) > 0 )
                                                        @foreach ($data["current_data_transpotation"] as $data_transportation )
                                                        <option value="{{ $data_transportation->vehicle_no }}">{{ $data_transportation->vehicle_no }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-2 align-items-center">
                                                <label for="scan_pallet_no" class="form-label text-xs col-sm-2">Pallet No</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control py-0" name="scan_pallet_no" id="scan_pallet_no">
                                                </div>
                                            </div>

                                            <div class="row mb-2 align-items-center">
                                                <label for="scan_stock_type" class="form-label text-xs col-sm-2">Stock Type</label>
                                                <div class="col-sm-3">
                                                    <select class="form-select py-0" name="scan_stock_type" id="scan_stock_type">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["current_arr_stock_type_scan"]) && count($data["current_arr_stock_type_scan"]) > 0 )
                                                        @foreach ($data["current_arr_stock_type_scan"] as $stock_type )
                                                        <option value="{{ $stock_type->stock_id }}">{{ $stock_type->stock_type }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-2 align-items-center">
                                                <label for="scan_qty" class="form-label text-xs col-sm-2">Quantity</label>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control py-0" name="scan_qty" id="scan_qty">
                                                </div>
                                            </div>

                                            <!-- SKU -->
                                            <div class="row mb-2 align-items-center">
                                                <label for="scan_sku" class="form-label text-xs col-sm-2">SKU</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control py-0" name="scan_sku" id="scan_sku">
                                                </div>
                                            </div>

                                            <div class="row mb-2 align-items-center">
                                                <div class="col-sm-2 form-check">
                                                    <input type="checkbox" class="form-check-input" name="scan_serial_checkbox" id="scan_serial_checkbox">
                                                    <label for="scan_serial_no" class="form-label text-xs">Serial No</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control py-0" name="scan_serial_no" id="scan_serial_no">
                                                </div>
                                            </div>

                                            <div class="row mb-2 align-items-center">
                                                <label class="form-label text-xs col-sm-2">Last Scan:</label>
                                            </div>

                                            <div class="row mb-2 align-items-center">
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control py-0" name="scan_last_sku" id="scan_last_sku" readonly>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control py-0" name="scan_last_qty" id="scan_last_qty" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mb-2 text-end">
                                            <button type="button" class="btn btn-primary" name="btn_save_scan" id="btn_save_scan">Save</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- page-tab--scan start --}}

                                {{-- page-tab--checked-items start --}}
                                <div class="tab-pane" id="page-tab--checked-items">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table " id="list-datatable-checked-items" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs">SKU No</th>
                                                            <th class="text-xs">Item Name</th>
                                                            <th class="text-xs">Pallet No</th>
                                                            <th class="text-xs">Serial No</th>
                                                            <th class="text-xs">Expired Date</th>
                                                            <th class="text-xs">Scan Qty</th>
                                                            <th class="text-xs">Qty Plan</th>
                                                            <th class="text-xs">UoM</th>
                                                            <th class="text-xs">Stock Type</th>
                                                            <th class="text-xs">Updated By</th>
                                                            <th class="text-xs">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- page-tab--checked-items end --}}

                                {{-- page-tab--outstanding-items start --}}
                                <div class="tab-pane" id="page-tab--outstanding-items">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table " id="list-datatable-outstanding-items" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs">SKU No</th>
                                                            <th class="text-xs">Item Name</th>
                                                            <th class="text-xs">Batch No</th>
                                                            <th class="text-xs">Expired Date</th>
                                                            <th class="text-xs">Qty Outstanding</th>
                                                            <th class="text-xs">Qty Plan</th>
                                                            <th class="text-xs">UoM</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- page-tab--outstanding-items end --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-VehicleType" tabindex="-1" aria-labelledby="modal-VehicleTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-VehicleTypeLabel">Vehicle - List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="modal-VehicleType_target_row" id="modal-VehicleType_target_row">

                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-VehicleType" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-xs">Vehicle ID</th>
                                <th class="text-xs">Vehicle Type</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script type="text/javascript">
    function removeScan(scan_id) {
        const confirmation = confirm("Are you sure want delete this data ?");
        if (!confirmation) {
            return;
        }

        const url = "{{ route('inbound_planning.processRemoveScan', [ 'id'=> $data['current_data']->inbound_planning_no ]) }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const formData = new FormData();
        formData.append("_token", _token);
        formData.append("_method", _method);
        formData.append("scan_id", scan_id);

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
                getDatatablesCheckedItems();
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
                return;

            },
        });

    }

    function checkSerialNoChecked() {
        const is_checked = $("#scan_serial_checkbox:checked").val();
        if (is_checked == "on") {
            $("#scan_serial_no").prop("readonly", false);
        } else {
            $("#scan_serial_no").prop("readonly", true);

        }
    }

    function displayModalVehicleID(row) {
        $("#modal-VehicleType_target_row").val(row);
        $("#list-datatable-modal-VehicleType").DataTable().destroy();
        $("#list-datatable-modal-VehicleType").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('inbound_planning.datatablesScanVehicle') }}",
            },
            columns: [{
                    data: 'vehicle_id',
                    searchable: true,
                    className: 'text-xs',
                },
                {
                    data: 'vehicle_type',
                    searchable: true,
                    className: 'text-xs',
                },
            ],
        });
        $("#modal-VehicleType").modal('show');
    }

    function getDatatablesCheckedItems() {
        $("#list-datatable-checked-items").DataTable().destroy();
        $("#list-datatable-checked-items").DataTable({
            processing: true,
            serverSide: true,
            serverSide: true,
            searching: false,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('inbound_planning.datatablesCheckedItems', [ 'id'=> $data['current_data']->inbound_planning_no ]) }}",
            },
            columns: [{
                    data: 'sku',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'part_name',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'pallet_id',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'serial_no',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'expired_date',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'qty_scan',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'qty',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'uom_name',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'stock_id',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'user_created',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'action',
                    searchable: false,
                    className: 'text-xs',
                },
            ],
        });
    }

    function getDatatablesOutstandingItems() {
        $("#list-datatable-outstanding-items").DataTable().destroy();
        $("#list-datatable-outstanding-items").DataTable({
            processing: true,
            serverSide: true,
            serverSide: true,
            searching: false,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('inbound_planning.datatablesOutstandingItems', [ 'id'=> $data['current_data']->inbound_planning_no ]) }}",
            },
            columns: [{
                    data: 'SKU',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'item_name',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'pallet_id',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'expired_date',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'qty_outstanding',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'qty_plan',
                    searchable: false,
                    className: 'text-xs',
                },
                {
                    data: 'uom_name',
                    searchable: false,
                    className: 'text-xs',
                },
            ],
        });
    }

    $(document).ready(function() {

        $("#dropdown_toggle_inbound").prop('aria-expanded', true);
        $("#dropdown_toggle_inbound").addClass('active');
        $("#dropdown_inbound").addClass('show');
        $("#logo_inbound").addClass("d-none");
        $("#logo_white_inbound").removeClass("d-none");
        $("#li_inbound_planning").addClass("active");
        $("#a_inbound_planning").addClass("active");

        let current_row_detail_vehicle = Number('{{ $current_row_detail_vehicle }}');

        checkSerialNoChecked();
        $("#scan_serial_checkbox").on("change", function() {
            checkSerialNoChecked();
        });

        $("#list-datatable-modal-VehicleType > tbody").on('click', 'tr', function() {
            const target_row = $("#modal-VehicleType_target_row").val();
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const vehicle_id = $($(dom_tr).children("td")[0]).text();
            const vehicle_type = $($(dom_tr).children("td")[1]).text();

            $(`#vehicle_id_${target_row}`).val(vehicle_id);
            $(`#vehicle_type_${target_row}`).val(vehicle_type);

            $("#modal-VehicleType").modal('hide');

        });

        $("#btn_add_vehicle").on("click", function() {
            let html_container_detail_vehicle = `
        <div class="row" id="row_${current_row_detail_vehicle}">
            <div class="col-sm-12 mb-2">
                <h5>Vehicle Info</h5>
            </div>
            <div class="col-sm-12 mb-2">
                <input type="hidden" name="transport_id[]" id="transport_id_${current_row_detail_vehicle}">
                <div class="row mb-2">
                    <label for="vehicle_type_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Vehicle Type</label>
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="hidden" name="vehicle_id[]" id="vehicle_id_${current_row_detail_vehicle}">
                                <input type="text" class="form-control py-0" name="vehicle_type[]" id="vehicle_type_${current_row_detail_vehicle}" readonly>
                                <div id="validation_vehicle_type_${current_row_detail_vehicle}" class="invalid-feedback text-xs"></div>
                            </div>
                            <div class="col-sm-2 ps-0">
                                <button type="button" class="btn btn-primary mb-0 rounded py-1" onclick="displayModalVehicleID('${current_row_detail_vehicle}')"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="vehicle_no_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Vehicle No</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control py-0" id="vehicle_no_${current_row_detail_vehicle}" name="vehicle_no[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_vehicle_no_${current_row_detail_vehicle}"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="driver_name_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Driver Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control py-0" id="driver_name_${current_row_detail_vehicle}" name="driver_name[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_driver_name_${current_row_detail_vehicle}"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="container_no_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Container No</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control py-0" id="container_no_${current_row_detail_vehicle}" name="container_no[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_container_no_${current_row_detail_vehicle}"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="seal_no_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Seal No</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control py-0" id="seal_no_${current_row_detail_vehicle}" name="seal_no[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_seal_no_${current_row_detail_vehicle}"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mb-2">
                <h5>Vehicle Activity</h5>
            </div>
            <div class="col-sm-12 mb-2">
                <div class="row mb-2">
                    <label for="arrival_date_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Arrival Date</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control py-0" id="arrival_date_${current_row_detail_vehicle}" name="arrival_date[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_arrival_date_${current_row_detail_vehicle}"></div>
                    </div>
                    <label for="arrival_time_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Arrival Time</label>
                    <div class="col-sm-3">
                        <input type="time" class="form-control py-0" id="arrival_time_${current_row_detail_vehicle}" name="arrival_time[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_arrival_time_${current_row_detail_vehicle}"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="start_unloading_date_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Start Unloading Date</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control py-0" id="start_unloading_date_${current_row_detail_vehicle}" name="start_unloading_date[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_start_unloading_date_${current_row_detail_vehicle}"></div>
                    </div>
                    <label for="start_unloading_time_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Start Unloading Time</label>
                    <div class="col-sm-3">
                        <input type="time" class="form-control py-0" id="start_unloading_time_${current_row_detail_vehicle}" name="start_unloading_time[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_start_unloading_time_${current_row_detail_vehicle}"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="finish_unloading_date_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Finish Unloading Date</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control py-0" id="finish_unloading_date_${current_row_detail_vehicle}" name="finish_unloading_date[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_finish_unloading_date_${current_row_detail_vehicle}"></div>
                    </div>
                    <label for="finish_unloading_time_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Finish Unloading Time</label>
                    <div class="col-sm-3">
                        <input type="time" class="form-control py-0" id="finish_unloading_time_${current_row_detail_vehicle}" name="finish_unloading_time" value="">
                        <div class="invalid-feedback text-xs" id="validation_finish_unloading_time_${current_row_detail_vehicle}"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="departure_date_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Departure Date</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control py-0" id="departure_date_${current_row_detail_vehicle}" name="departure_date[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_departure_date_${current_row_detail_vehicle}"></div>
                    </div>
                    <label for="departure_time_${current_row_detail_vehicle}" class="form-label text-xs col-sm-2">Departure Time</label>
                    <div class="col-sm-3">
                        <input type="time" class="form-control py-0" id="departure_time_${current_row_detail_vehicle}" name="departure_time[]" value="">
                        <div class="invalid-feedback text-xs" id="validation_departure_time_${current_row_detail_vehicle}"></div>
                    </div>
                </div>
            </div>
        </div>`;
            $("#container_detail_vehicle").append(html_container_detail_vehicle);
            current_row_detail_vehicle++;
        });

        $("#btn_save_partial_vehicle").on("click", function(e) {
            $("#btn_save_partial_vehicle").prop("disabled", true);
            const url = "{{ route('inbound_planning.processSavePartialVehicle', [ 'id'=> $data['current_data']->inbound_planning_no ]) }}";
            const _token = $("meta[name='csrf-token']").prop('content');
            const _method = "POST";

            const inbound_planning_no = $("#inbound_planning_no").val();

            const arr_transport_id = [];
            $("input[name^='transport_id']").each(function() {
                arr_transport_id.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_vehicle_id = [];
            $("input[name^='vehicle_id']").each(function() {
                arr_vehicle_id.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_vehicle_type = [];
            $("input[name^='vehicle_type']").each(function() {
                arr_vehicle_type.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_vehicle_no = [];
            $("input[name^='vehicle_no']").each(function() {
                arr_vehicle_no.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_driver_name = [];
            $("input[name^='driver_name']").each(function() {
                arr_driver_name.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_container_no = [];
            $("input[name^='container_no']").each(function() {
                arr_container_no.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_seal_no = [];
            $("input[name^='seal_no']").each(function() {
                arr_seal_no.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_arrival_date = [];
            $("input[name^='arrival_date']").each(function() {
                arr_arrival_date.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_arrival_time = [];
            $("input[name^='arrival_time']").each(function() {
                arr_arrival_time.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_start_unloading_date = [];
            $("input[name^='start_unloading_date']").each(function() {
                arr_start_unloading_date.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_start_unloading_time = [];
            $("input[name^='start_unloading_time']").each(function() {
                arr_start_unloading_time.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_finish_unloading_date = [];
            $("input[name^='finish_unloading_date']").each(function() {
                arr_finish_unloading_date.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_finish_unloading_time = [];
            $("input[name^='finish_unloading_time']").each(function() {
                arr_finish_unloading_time.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_departure_date = [];
            $("input[name^='departure_date']").each(function() {
                arr_departure_date.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_departure_time = [];
            $("input[name^='departure_time']").each(function() {
                arr_departure_time.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const formData = new FormData();

            formData.append("_token", _token);
            formData.append("_method", _method);
            formData.append("inbound_planning_no", inbound_planning_no);
            formData.append("arr_transport_id", JSON.stringify(arr_transport_id));
            formData.append("arr_vehicle_id", JSON.stringify(arr_vehicle_id));
            formData.append("arr_vehicle_type", JSON.stringify(arr_vehicle_type));
            formData.append("arr_vehicle_no", JSON.stringify(arr_vehicle_no));
            formData.append("arr_driver_name", JSON.stringify(arr_driver_name));
            formData.append("arr_container_no", JSON.stringify(arr_container_no));
            formData.append("arr_seal_no", JSON.stringify(arr_seal_no));
            formData.append("arr_arrival_date", JSON.stringify(arr_arrival_date));
            formData.append("arr_arrival_time", JSON.stringify(arr_arrival_time));
            formData.append("arr_start_unloading_date", JSON.stringify(arr_start_unloading_date));
            formData.append("arr_start_unloading_time", JSON.stringify(arr_start_unloading_time));
            formData.append("arr_finish_unloading_date", JSON.stringify(arr_finish_unloading_date));
            formData.append("arr_finish_unloading_time", JSON.stringify(arr_finish_unloading_time));
            formData.append("arr_departure_date", JSON.stringify(arr_departure_date));
            formData.append("arr_departure_time", JSON.stringify(arr_departure_time));

            // $.ajax({
            //     url:url,
            //     method: _method,
            //     data: formData,
            //     contentType: false,
            //     processData: false,
            //     cache: false,
            //     beforeSend: function () {
            //         $("input[name^='vehicle_id']").removeClass('is-invalid');
            //         $("[id^='validation_vehicle_id']").html('');
            //         $("input[name^='vehicle_type']").removeClass('is-invalid');
            //         $("[id^='validation_vehicle_type']").html('');
            //         $("input[name^='vehicle_no']").removeClass('is-invalid');
            //         $("[id^='validation_vehicle_no']").html('');
            //         $("input[name^='driver_name']").removeClass('is-invalid');
            //         $("[id^='validation_driver_name']").html('');
            //         $("input[name^='container_no']").removeClass('is-invalid');
            //         $("[id^='validation_container_no']").html('');
            //         $("input[name^='seal_no']").removeClass('is-invalid');
            //         $("[id^='validation_seal_no']").html('');
            //         $("input[name^='arrival_date']").removeClass('is-invalid');
            //         $("[id^='validation_arrival_date']").html('');
            //         $("input[name^='arrival_time']").removeClass('is-invalid');
            //         $("[id^='validation_arrival_time']").html('');
            //         $("input[name^='start_unloading_date']").removeClass('is-invalid');
            //         $("[id^='validation_start_unloading_date']").html('');
            //         $("input[name^='start_unloading_time']").removeClass('is-invalid');
            //         $("[id^='validation_start_unloading_time']").html('');
            //         $("input[name^='finish_unloading_date']").removeClass('is-invalid');
            //         $("[id^='validation_finish_unloading_date']").html('');
            //         $("input[name^='finish_unloading_time']").removeClass('is-invalid');
            //         $("[id^='validation_finish_unloading_time']").html('');
            //         $("input[name^='departure_date']").removeClass('is-invalid');
            //         $("[id^='validation_departure_date']").html('');
            //         $("input[name^='departure_time']").removeClass('is-invalid');
            //         $("[id^='validation_departure_time']").html('');
            //     },
            //     error: function (error) {
            //         Swal
            //         .mixin({
            //             customClass: {
            //                 confirmButton: 'btn btn-primary me-2',
            //             },
            //             buttonsStyling: false,
            //         })
            //         .fire({
            //             text: 'Something Wrong',
            //             type: 'error',
            //             icon: 'error',
            //         });
            //     },
            //     complete: function () {

            //     },
            //     success: function (response) {
            //         if(typeof response !== 'object'){
            //             Swal
            //             .mixin({
            //                 customClass: {
            //                     confirmButton: 'btn btn-primary me-2',
            //                 },
            //                 buttonsStyling: false,
            //             })
            //             .fire({
            //                 text: 'Something Wrong',
            //                 type: 'error',
            //                 icon: 'error',
            //             });
            //             return;
            //         }

            //         if(response.err){
            //             for (const key_data in response.data) {
            //                 if (Object.hasOwnProperty.call(response.data, key_data)) {
            //                     const arr_message = response.data[key_data];
            //                     let text_message = "";
            //                     arr_message.forEach(error_message => {
            //                         text_message += `${error_message} <br>`;
            //                     });
            //                     $(`#${key_data}`).addClass('is-invalid');
            //                     $(`#validation_${key_data}`).html(text_message);
            //                 }
            //             }
            //             Swal
            //             .mixin({
            //                 customClass: {
            //                     confirmButton: 'btn btn-primary me-2',
            //                 },
            //                 buttonsStyling: false,
            //             })
            //             .fire({
            //                 text: `${response.message}`,
            //                 type: 'error',
            //                 icon: 'error',
            //             });
            //             $("#btn_save_partial_vehicle").prop("disabled",false);
            //             return;
            //         }

            //         Swal
            //         .mixin({
            //             customClass: {
            //                 confirmButton: 'btn btn-primary me-2',
            //             },
            //             buttonsStyling: false,
            //         })
            //         .fire({
            //             text: `${response.message}`,
            //             type: 'success',
            //             icon: 'success',
            //         });

            //         window.location = "{{ route('inbound_planning.inboundCheckingAndReceive' , [ 'id'=> $data['current_data']->inbound_planning_no ]) }}";
            //         $("#btn_save_partial_vehicle").prop("disabled",false);
            //         return;

            //     },
            // });
        });

        $("#btn_save_vehicle").on("click", function(e) {
            $("#btn_save_vehicle").prop("disabled", true);
            const url = "{{ route('inbound_planning.processUpdateVehicleFinish', [ 'id'=> $data['current_data']->inbound_planning_no ]) }}";
            const _token = $("meta[name='csrf-token']").prop('content');
            const _method = "POST";

            const inbound_planning_no = $("#inbound_planning_no").val();

            const arr_transport_id = [];
            $("input[name^='transport_id']").each(function() {
                arr_transport_id.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_vehicle_id = [];
            $("input[name^='vehicle_id']").each(function() {
                arr_vehicle_id.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_vehicle_type = [];
            $("input[name^='vehicle_type']").each(function() {
                arr_vehicle_type.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_vehicle_no = [];
            $("input[name^='vehicle_no']").each(function() {
                arr_vehicle_no.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_driver_name = [];
            $("input[name^='driver_name']").each(function() {
                arr_driver_name.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_container_no = [];
            $("input[name^='container_no']").each(function() {
                arr_container_no.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_seal_no = [];
            $("input[name^='seal_no']").each(function() {
                arr_seal_no.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_arrival_date = [];
            $("input[name^='arrival_date']").each(function() {
                arr_arrival_date.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_arrival_time = [];
            $("input[name^='arrival_time']").each(function() {
                arr_arrival_time.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_start_unloading_date = [];
            $("input[name^='start_unloading_date']").each(function() {
                arr_start_unloading_date.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_start_unloading_time = [];
            $("input[name^='start_unloading_time']").each(function() {
                arr_start_unloading_time.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_finish_unloading_date = [];
            $("input[name^='finish_unloading_date']").each(function() {
                arr_finish_unloading_date.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_finish_unloading_time = [];
            $("input[name^='finish_unloading_time']").each(function() {
                arr_finish_unloading_time.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_departure_date = [];
            $("input[name^='departure_date']").each(function() {
                arr_departure_date.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_departure_time = [];
            $("input[name^='departure_time']").each(function() {
                arr_departure_time.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const formData = new FormData();
            formData.append("_token", _token);
            formData.append("_method", _method);
            formData.append("inbound_planning_no", inbound_planning_no);
            formData.append("arr_transport_id", JSON.stringify(arr_transport_id));
            formData.append("arr_vehicle_id", JSON.stringify(arr_vehicle_id));
            formData.append("arr_vehicle_type", JSON.stringify(arr_vehicle_type));
            formData.append("arr_vehicle_no", JSON.stringify(arr_vehicle_no));
            formData.append("arr_driver_name", JSON.stringify(arr_driver_name));
            formData.append("arr_container_no", JSON.stringify(arr_container_no));
            formData.append("arr_seal_no", JSON.stringify(arr_seal_no));
            formData.append("arr_arrival_date", JSON.stringify(arr_arrival_date));
            formData.append("arr_arrival_time", JSON.stringify(arr_arrival_time));
            formData.append("arr_start_unloading_date", JSON.stringify(arr_start_unloading_date));
            formData.append("arr_start_unloading_time", JSON.stringify(arr_start_unloading_time));
            formData.append("arr_finish_unloading_date", JSON.stringify(arr_finish_unloading_date));
            formData.append("arr_finish_unloading_time", JSON.stringify(arr_finish_unloading_time));
            formData.append("arr_departure_date", JSON.stringify(arr_departure_date));
            formData.append("arr_departure_time", JSON.stringify(arr_departure_time));

            $.ajax({
                url: url,
                method: _method,
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    $("input[name^='vehicle_id']").removeClass('is-invalid');
                    $("[id^='validation_vehicle_id']").html('');
                    $("input[name^='vehicle_type']").removeClass('is-invalid');
                    $("[id^='validation_vehicle_type']").html('');
                    $("input[name^='vehicle_no']").removeClass('is-invalid');
                    $("[id^='validation_vehicle_no']").html('');
                    $("input[name^='driver_name']").removeClass('is-invalid');
                    $("[id^='validation_driver_name']").html('');
                    $("input[name^='container_no']").removeClass('is-invalid');
                    $("[id^='validation_container_no']").html('');
                    $("input[name^='seal_no']").removeClass('is-invalid');
                    $("[id^='validation_seal_no']").html('');
                    $("input[name^='arrival_date']").removeClass('is-invalid');
                    $("[id^='validation_arrival_date']").html('');
                    $("input[name^='arrival_time']").removeClass('is-invalid');
                    $("[id^='validation_arrival_time']").html('');
                    $("input[name^='start_unloading_date']").removeClass('is-invalid');
                    $("[id^='validation_start_unloading_date']").html('');
                    $("input[name^='start_unloading_time']").removeClass('is-invalid');
                    $("[id^='validation_start_unloading_time']").html('');
                    $("input[name^='finish_unloading_date']").removeClass('is-invalid');
                    $("[id^='validation_finish_unloading_date']").html('');
                    $("input[name^='finish_unloading_time']").removeClass('is-invalid');
                    $("[id^='validation_finish_unloading_time']").html('');
                    $("input[name^='departure_date']").removeClass('is-invalid');
                    $("[id^='validation_departure_date']").html('');
                    $("input[name^='departure_time']").removeClass('is-invalid');
                    $("[id^='validation_departure_time']").html('');
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
                        $("#btn_save_vehicle").prop("disabled", false);
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
                    window.location = "{{ route('inbound_planning.inboundCheckingAndReceive' , [ 'id'=> $data['current_data']->inbound_planning_no ]) }}";
                    $("#btn_save_vehicle").prop("disabled", false);
                    return;

                },
            });
        });

        $("#btn_save_scan").on("click", function() {
            $("#btn_save_scan").prop("disabled", true);

            const url = "{{ route('inbound_planning.processScan', [ 'id'=> $data['current_data']->inbound_planning_no ]) }}";
            const _token = $("meta[name='csrf-token']").prop('content');
            const _method = "POST";

            const scan_vehicle_no = $("#scan_vehicle_no").val();
            const scan_pallet_no = $("#scan_pallet_no").val();
            const scan_stock_type = $("#scan_stock_type").val();
            const scan_qty = $("#scan_qty").val();
            const scan_sku = $("#scan_sku").val();
            const scan_serial_no = $("#scan_serial_no").val();
            const inbound_planning_no = $("#inbound_planning_no").val();
            const scan_serial_checkbox = ($("#scan_serial_checkbox:checked").val() == "on") ? true : false;

            const formData = new FormData();
            formData.append("_token", _token);
            formData.append("_method", _method);

            formData.append("inbound_planning_no", inbound_planning_no);
            formData.append("scan_vehicle_no", scan_vehicle_no);
            formData.append("scan_pallet_no", scan_pallet_no);
            formData.append("scan_stock_type", scan_stock_type);
            formData.append("scan_qty", scan_qty);
            formData.append("scan_sku", scan_sku);

            formData.append("scan_serial_no", scan_serial_no);
            formData.append("scan_serial_checkbox", scan_serial_checkbox);

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
                        $("#btn_save_scan").prop("disabled", false);
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

                    $("#scan_last_sku").val(scan_sku);
                    $("#scan_last_qty").val(scan_qty);
                    $("#btn_save_scan").prop("disabled", false);
                    return;

                },
            });
        });
    });
</script>
@endsection