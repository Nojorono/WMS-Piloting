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
                        <h5 class="me-auto">Inbound Planning - Show</h5>
                        <a href="{{ route('inbound_planning.index') }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1">List</button>
                        </a>
                        @if ($data["current_data"]->status_id == "OPI")
                        <a href="{{ route('inbound_planning.edit',['id' => $data["current_data"]->inbound_planning_no ]) }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1">Edit</button>
                        </a>
                        @endif

                        @if ($data["current_data"]->status_id == "OPI" || $data["current_data"]->status_id == "UIN")
                        <a href="{{ route('inbound_planning.cancel',['id' => $data["current_data"]->inbound_planning_no ]) }}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1">Cancel</button>
                        </a>
                        @endif

                        <a href="{{ route('inbound_planning.viewPDF',['id' => $data["current_data"]->inbound_planning_no ]) }}" class="text-decoration-none me-2" target="_blank">
                            <button type="button" class="btn btn-primary mb-0 py-1">View PDF</button>
                        </a>
                        <a href="{{ route('inbound_planning.viewPDFTallySheet',['id' => $data["current_data"]->inbound_planning_no ]) }}" class="text-decoration-none me-2" target="_blank">
                            <button type="button" class="btn btn-primary mb-0 py-1">View Tally Sheet</button>
                        </a>
                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <div class="card border-0">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <label for="inbound_planning_no" class="form-label text-xs">Inbound Planning No</label>
                                        <input type="text" class="form-control py-0" id="inbound_planning_no" name="inbound_planning_no" value="{{ $data["current_data"]->inbound_planning_no }}" readonly>
                                        <div class="invalid-feedback text-xs" id="validation_inbound_planning_no"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_name" class="form-label text-xs">Supplier Name*</label>
                                        <input type="hidden" id="supplier_id" name="supplier_id" value="{{ $data["current_data"]->supplier_id }}" readonly>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ $data["current_data"]->supplier_name }}" readonly>
                                        <div id="validation_supplier_name" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="reference_no" class="form-label text-xs">Reference No*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="reference_no" name="reference_no" value="{{ $data["current_data"]->reference_no }}" readonly>
                                        <div id="validation_reference_no" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="supplier_address" class="form-label text-xs">Supplier Address</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address" name="supplier_address" value="{{ $data["current_data"]->address1 }}" readonly>
                                        <div id="validation_supplier_address" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="receipt_no" class="form-label text-xs">Receipt No*</label>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="receipt_no" name="receipt_no" value="{{ $data["current_data"]->receipt_no }}" readonly>
                                        <div id="validation_receipt_no" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="client_name" class="form-label text-xs">Client Name*</label>
                                        <input type="hidden" id="client_id" name="client_id" value="{{ session('current_client_id') }}">
                                        <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ session('current_client_name') }}" readonly>
                                        <div id="validation_client_name" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="order_type" class="form-label text-xs">Order Type*</label>
                                        <input type="hidden" id="order_id" name="order_id" value="{{ $data["current_data"]->order_id }}">
                                        <input type="text" autocomplete="off" class="form-control py-0" id="order_type" name="order_type" value="{{ $data["current_data"]->order_type }}" readonly>
                                        <div id="validation_order_type" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="warehouse_name" class="form-label text-xs">Warehouse Name*</label>
                                        <input type="hidden" id="warehouse_id" name="warehouse_id" value="{{ session('current_warehouse_id') }}" readonly>
                                        <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="{{ session('current_warehouse_name') }}" readonly>
                                        <div id="validation_warehouse_name" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="plan_delivery_date" class="form-label text-xs">Plan Delivery Date*</label>
                                        <input type="date" autocomplete="off" class="form-control py-0" id="plan_delivery_date" name="plan_delivery_date" value="{{ date("Y-m-d",strtotime($data["current_data"]->plan_delivery)) }}" readonly>
                                        <div id="validation_plan_delivery_date" class="invalid-feedback text-xs"></div>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="" class="form-label text-xs">Task Type*</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="task_type" id="task_type_single_receive" value="Single Receive" disabled {{ (@$data["current_data"]->task_type == "Single Receive") ? 'checked' : '' }}>
                                                    <label class="form-check-label text-xs" for="task_type_single_receive">
                                                        Single Receive
                                                    </label>
                                                    <div id="validation_task_type_single_receive" class="invalid-feedback text-xs"></div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="task_type" id="task_type_partial_receive" value="Partial Receive" disabled {{ (@$data["current_data"]->task_type == "Partial Receive") ? 'checked' : '' }}>
                                                    <label class="form-check-label text-xs" for="task_type_partial_receive">
                                                        Partial Receive
                                                    </label>
                                                    <div id="validation_task_type_partial_receive" class="invalid-feedback text-xs"></div>
                                                </div>

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
                                        <a class="nav-link text-xs" data-bs-toggle="tab" href="#page-tab--transport-and-unloading">Transport & Unloading</a>
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
                                                <table class="table " id="tabel-item-detail" style="min-width: calc(2.5 * 100%);">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center">SKU No</th>
                                                            <th class="text-xs text-center">Item Name</th>
                                                            <th class="text-xs text-center">Batch No</th>
                                                            <th class="text-xs text-center">Serial No</th>
                                                            <th class="text-xs text-center">IMEI No</th>
                                                            <th class="text-xs text-center">Part No</th>
                                                            <th class="text-xs text-center">Color</th>
                                                            <th class="text-xs text-center">Size</th>
                                                            <th class="text-xs text-center">Stock ID</th>
                                                            <th class="text-xs text-center">Stock Type</th>
                                                            <th class="text-xs text-center">Expired Date</th>
                                                            <th class="text-xs text-center">UOM</th>
                                                            <th class="text-xs text-center">Qty Plan</th>
                                                            <th class="text-xs text-center">Discrepancy</th>
                                                            <th class="text-xs text-center">Classification ID</th>
                                                            <th class="text-xs text-center">Classification</th>
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
                                                                <input type='text' class='form-control py-0' name='sku_no[]' id='sku_no_{{ $current_row }}' value="{{ $current_data_detail->SKU }}" readonly>
                                                                <div id="validation_sku_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='item_name[]' id='item_name_{{ $current_row }}' value="{{ $current_data_detail->part_name }}" readonly>
                                                                <div id="validation_item_name_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='batch_no[]' id='batch_no_{{ $current_row }}' value="{{ $current_data_detail->batch_no }}" readonly>
                                                                <div id="validation_batch_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='serial_no[]' id='serial_no_{{ $current_row }}' value="{{ $current_data_detail->serial_no }}" readonly>
                                                                <div id="validation_serial_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='imei_no[]' id='imei_no_{{ $current_row }}' value="{{ $current_data_detail->imei }}" readonly>
                                                                <div id="validation_imei_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='part_no[]' id='part_no_{{ $current_row }}' value="{{ $current_data_detail->part_no }}" readonly>
                                                                <div id="validation_part_no_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='color[]' id='color_{{ $current_row }}' value="{{ $current_data_detail->color }}" readonly>
                                                                <div id="validation_color_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='size[]' id='size_{{ $current_row }}' value="{{ $current_data_detail->size }}" readonly>
                                                                <div id="validation_size_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='stock_id[]' id='stock_id_{{ $current_row }}' value="{{ $current_data_detail->stock_id }}" readonly>
                                                                <div id="validation_stock_id_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='stock_type[]' id='stock_type_{{ $current_row }}' value="{{ $current_data_detail->stock_type }}" readonly>
                                                                <div id="validation_stock_type_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='date' class='form-control py-0' name='expired_date[]' id='expired_date_{{ $current_row }}' value="{{ (!empty($current_data_detail->expired_date)) ? date("Y-m-d",strtotime($current_data_detail->expired_date)) : "" }}" readonly>
                                                                <div id="validation_expired_date_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='uom[]' id='uom_{{ $current_row }}' value="{{ $current_data_detail->uom_name }}" readonly>
                                                                <div id="validation_uom_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='qty_plan[]' id='qty_plan_{{ $current_row }}' value="{{ $current_data_detail->qty }}" readonly>
                                                                <div id="validation_qty_plan_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='discrepancy[]' id='discrepancy_{{ $current_row }}' value="{{ $current_data_detail->discrepancy }}" readonly>
                                                                <div id="validation_discrepancy_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='id_classification[]' id='id_classification_{{ $current_row }}' value="{{ $current_data_detail->clasification_id }}" readonly>
                                                                <div id="validation_id_classification_{{ $current_row }}" class="invalid-feedback text-xs"></div>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='form-control py-0' name='classification[]' id='classification_{{ $current_row }}' value="{{ $current_data_detail->classification_name }}" readonly>
                                                                <div id="validation_classification_{{ $current_row }}" class="invalid-feedback text-xs"></div>
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
                                <div class="tab-pane" id="page-tab--transport-and-unloading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table " id="tabel-transport-and-unloading" {{-- style="min-width: calc(2.5 * 100%);" --}}>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs text-center">Checker</th>
                                                            <th class="text-xs text-center">Supervisor</th>
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
                                                        @if (count($data["current_data_wh_transportation_wh_scan_qty"]) > 0)
                                                        @foreach ($data["current_data_wh_transportation_wh_scan_qty"] as $current_data_wh_transportation_wh_scan_qty )
                                                        <tr>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->checker}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->supervisor_id}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->arrival_date}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->start_unloading}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->finish_unloading}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->departure_date}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->vehicle_no}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->driver_name}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->vehicle_type}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->container_no}}</td>
                                                            <td class="text-xs">{{ $current_data_wh_transportation_wh_scan_qty->seal_no}}</td>
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
                                            @if ($data["current_data"]->status_id == "OPI")
                                            <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_confirm_to_unreceive" name="btn_confirm_to_unreceive"> Confirm Inbound Planning</button>
                                            @endif
                                            @if ($data["current_data"]->status_id == "UIN")
                                            <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_assign_to_checker" name="btn_assign_to_checker">Assign to Checker</button>
                                            <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_view_checker" name="btn_view_checker">View Checker</button>
                                            <a href="{{ route("inbound_planning.inboundCheckingAndReceive",[ "id" => $data["current_data"]->inbound_planning_no])}}" class="text-decoration-none me-2">
                                                <button type="button" class="btn btn-primary mb-0 py-1" id="btn_inbound_checking_receive" name="btn_inbound_checking_receive">Inbound Checking And Receive</button>
                                            </a>
                                            @endif

                                            @if ($data["can_confirm"] && $data["current_data"]->status_id == "UIN")
                                            <button type="button" class="btn btn-primary mb-0 py-1 ms-auto me-0" id="btn_confirm_inbound_planning" name="btn_confirm_inbound_planning">Confirm</button>
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
<div class="modal fade" id="modal-ConfirmToUnreceive" tabindex="-1" aria-labelledby="modal-ConfirmToUnreceiveLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="{{ route('inbound_planning.confirmToUnreceive' , [ 'id' => $data["current_data"]->inbound_planning_no ]) }}" id="form-process-unreceive">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label text-xs">Are you sure this Inbound Planning is correct ? </label>
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

<div class="modal fade" id="modal-ViewChecker" tabindex="-1" aria-labelledby="modal-ViewCheckerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-ViewCheckerLabel">View Checker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-ViewChecker" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-xs">Checker Name</th>
                                                <th class="text-xs">Date Start</th>
                                                <th class="text-xs">Time Start</th>
                                                <th class="text-xs">Date Finish</th>
                                                <th class="text-xs">Time Finish</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $row_count_checker = 1;

                                            @endphp
                                            @if (count($data["current_data_wh_activity"]) > 0)
                                            @foreach ($data["current_data_wh_activity"] as $current_data_wh_activity )
                                            <tr id="row_view_checker_{{ $row_count_checker }}">
                                                <td>
                                                    <input type="text" class="form-control py-0" name="view_checker_username[]" id="view_checker_username_{{ $row_count_checker }}" value="{{ $current_data_wh_activity->checker }}" readonly>
                                                    <div id="validation_view_checker_username_{{ $row_count_checker }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control py-0" name="view_checker_date_start[]" id="view_checker_date_start_{{ $row_count_checker }}" value="{{ $current_data_wh_activity->start_date }}" readonly>
                                                    <div id="validation_view_checker_date_start_{{ $row_count_checker }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control py-0" name="view_checker_time_start[]" id="view_checker_time_start_{{ $row_count_checker }}" value="{{ $current_data_wh_activity->start_time }}" readonly>
                                                    <div id="validation_view_checker_time_start_{{ $row_count_checker }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control py-0" name="view_checker_date_finish[]" id="view_checker_date_finish_{{ $row_count_checker }}" value="{{ $current_data_wh_activity->finish_date }}" readonly>
                                                    <div id="validation_view_checker_date_finish_{{ $row_count_checker }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control py-0" name="view_checker_time_finish[]" id="view_checker_time_finish_{{ $row_count_checker }}" value="{{ $current_data_wh_activity->finish_time }}" readonly>
                                                    <div id="validation_view_checker_time_finish_{{ $row_count_checker }}" class="invalid-feedback text-xs"></div>
                                                </td>
                                            </tr>
                                            @php

                                            $row_count_checker ++;
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

<div class="modal fade" id="modal-AssignToChecker" tabindex="-1" aria-labelledby="modal-AssignToCheckerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-AssignToCheckerLabel">Assign To Checker</h5>
                <button type="button" class="btn btn-primary mb-0 py-1" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('inbound_planning.processAssignChecker' , [ 'id' => $data["current_data"]->inbound_planning_no ]) }}" id="form-assign-checker">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <button type="button" class="btn btn-primary mb-0 py-1" name="btn_add_row_checker" id="btn_add_row_checker">Add Row Checker</button>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <div class="table-responsive">
                                        <table class="table " id="tabel-AssignToChecker" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-xs">Checker Name</th>
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
                                    <button type="submit" class="btn btn-primary mb-0 py-1" name="btn_save_checker" id="btn_save_checker">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-TargetUserChecker" tabindex="-1" aria-labelledby="modal-TargetUserCheckerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-TargetUserCheckerLabel">Target User Checker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_checker_target_row" id="user_checker_target_row" value="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table " id="tabel-TargetUserChecker" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Fullname</th>
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
    function displayModalTargetUserChecker(row) {
        $("#user_checker_target_row").val(row);
        $("#tabel-TargetUserChecker").DataTable().destroy();
        $("#tabel-TargetUserChecker").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('inbound_planning.datatablesTargetUserAssign') }}",
            columns: [{
                    data: 'username',
                    searchable: true,
                },
                {
                    data: 'fullname',
                    searchable: true,
                },
            ],
        });

        $("#modal-TargetUserChecker").modal("show");
    }

    function deleteRowChecker(row) {
        $(`#row_checker_${row}`).remove();
    }

    $(document).ready(function() {
        $("#dropdown_toggle_inbound").prop('aria-expanded', true);
        $("#dropdown_toggle_inbound").addClass('active');
        $("#dropdown_inbound").addClass('show');
        $("#logo_inbound").addClass("d-none");
        $("#logo_white_inbound").removeClass("d-none");
        $("#li_inbound_planning").addClass("active");
        $("#a_inbound_planning").addClass("active");

        let row_count_checker = 1;

        $("#btn_confirm_to_unreceive").on("click", function() {
            $("#modal-ConfirmToUnreceive").modal('show');
        });

        $("#form-process-unreceive").on("submit", function(e) {
            e.preventDefault();
            const url = $(this).prop('action');
            const _token = $("input[name='_token']").val();
            const _method = $("input[name='_method']").val();
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
                            text: `${response.message}`,
                            type: 'success',
                            icon: 'success',
                        });

                    window.location.reload();
                    return;

                },
            });
        });

        $("#btn_assign_to_checker").on("click", function() {
            $("#modal-AssignToChecker").modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#modal-AssignToChecker").modal('show');
        });

        $("#btn_add_row_checker").on("click", function() {
            const html_row_checker = `
        <tr id="row_checker_${row_count_checker}">
            <td>
                <div class="input-group">  
                    <input type="text" class="form-control py-0" name="checker_username[]" id="checker_username_${row_count_checker}" readonly>
                    <button type="button" class="btn btn-primary mb-0 rounded py-1" id="btn_search_target_checker_${row_count_checker}" name="btn_search_target_checker_${row_count_checker}" onclick="displayModalTargetUserChecker('${row_count_checker}')"><i class="bi bi-search"></i></button>
                    <div id="validation_checker_username_${row_count_checker}" class="invalid-feedback text-xs"></div>
                </div>
            </td>
            <td>
                <input type="date" class="form-control py-0" name="checker_date_start[]" id="checker_date_start_${row_count_checker}">
                <div id="validation_checker_date_start_${row_count_checker}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type="time" class="form-control py-0" name="checker_time_start[]" id="checker_time_start_${row_count_checker}">
                <div id="validation_checker_time_start_${row_count_checker}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type="date" class="form-control py-0" name="checker_date_finish[]" id="checker_date_finish_${row_count_checker}">
                <div id="validation_checker_date_finish_${row_count_checker}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <input type="time" class="form-control py-0" name="checker_time_finish[]" id="checker_time_finish_${row_count_checker}">
                <div id="validation_checker_time_finish_${row_count_checker}" class="invalid-feedback text-xs"></div>
            </td>
            <td>
                <button type="button" class="btn btn-primary mb-0 py-1" name="btn_remove_row_checker_${row_count_checker}" id="btn_remove_row_checker_${row_count_checker}" onclick="deleteRowChecker('${row_count_checker}')">Remove</button>
            </td>
        </tr>`;
            row_count_checker++;
            $("#tabel-AssignToChecker > tbody").append(html_row_checker);
        });

        $("#tabel-TargetUserChecker > tbody").on('click', 'tr', function() {
            const target_row = $("#user_checker_target_row").val();
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const username = $($(dom_tr).children("td")[0]).text();

            $(`#checker_username_${target_row}`).val(username);

            $("#modal-TargetUserChecker").modal('hide');
        });

        $("#form-assign-checker").on("submit", function(e) {
            e.preventDefault();
            const url = $(this).prop('action');
            const _token = $("input[name='_token']").val();
            const _method = $("input[name='_method']").val();
            const arr_checker_username = [];
            $("input[name^='checker_username']").each(function() {
                arr_checker_username.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_checker_date_start = [];
            $("input[name^='checker_date_start']").each(function() {
                arr_checker_date_start.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_checker_time_start = [];
            $("input[name^='checker_time_start']").each(function() {
                arr_checker_time_start.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_checker_date_finish = [];
            $("input[name^='checker_date_finish']").each(function() {
                arr_checker_date_finish.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });

            const arr_checker_time_finish = [];
            $("input[name^='checker_time_finish']").each(function() {
                arr_checker_time_finish.push({
                    id: $(this).prop('id'),
                    value: $(this).val(),
                });
            });



            const formData = new FormData();
            formData.append("_token", _token);
            formData.append("_method", _method);
            formData.append("arr_checker_username", JSON.stringify(arr_checker_username));
            formData.append("arr_checker_date_start", JSON.stringify(arr_checker_date_start));
            formData.append("arr_checker_time_start", JSON.stringify(arr_checker_time_start));
            formData.append("arr_checker_date_finish", JSON.stringify(arr_checker_date_finish));
            formData.append("arr_checker_time_finish", JSON.stringify(arr_checker_time_finish));

            $.ajax({
                url: url,
                method: _method,
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    $("input[name^='checker_username']").removeClass('is-invalid');
                    $("[id^='validation_checker_username']").html('');
                    $("input[name^='checker_date_start']").removeClass('is-invalid');
                    $("[id^='validation_checker_date_start']").html('');
                    $("input[name^='checker_time_start']").removeClass('is-invalid');
                    $("[id^='validation_checker_time_start']").html('');
                    $("input[name^='checker_date_finish']").removeClass('is-invalid');
                    $("[id^='validation_checker_date_finish']").html('');
                    $("input[name^='checker_time_finish']").removeClass('is-invalid');
                    $("[id^='validation_checker_time_finish']").html('');

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

        $("#btn_view_checker").on("click", function() {
            $("#modal-ViewChecker").modal('show');
        });

        $("#btn_confirm_inbound_planning").on("click", function() {
            const confirmed = confirm("Are you sure this data is already correct ?");

            if (!confirmed) {
                return;
            }

            const url = "{{ route('inbound_planning.confirmInboundPlanning', [ 'id'=> $data['current_data']->inbound_planning_no ]) }}";
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

                    window.location = "{{ route('inbound_planning.index') }}";
                    return;

                },
            });
        });
    });
</script>
@endsection