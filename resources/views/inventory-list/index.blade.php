@extends('layout.app')

@section("title")
Inventory List
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
                        <h5 class="me-auto">Inventory List</h5>
                        <span>
                            <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_export_excel" name="btn_export_excel">Export</button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-primary mb-0 py-1 d-inline me-2" id="btn_filter" name="btn_filter">Filter</button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-primary mb-0 py-1 d-inline" id="btn_advance_filter" name="btn_advance_filter">Advance Filter</button>
                        </span>
                    </div>
                    <div class="col-sm-12 mb-2">

                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <div class="table-responsive" id="container-datatable"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-AdvanceFilter" tabindex="-1" aria-labelledby="modal-AdvanceFilterLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-AdvanceFilterLabel">Advance Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="warehouse_name" class="form-label">Warehouse Name</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="hidden" id="warehouse_id" name="warehouse_id" value="{{ session("current_warehouse_id") }}">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="warehouse_name" name="warehouse_name" value="{{session("current_warehouse_name")}}" readonly>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="batch_no" class="form-label">Batch No</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="batch_no" name="batch_no" value="">
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="expired_date" class="form-label">Expired Date</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="expired_date" name="expired_date" value="">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="client_name" class="form-label">Client Name</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="hidden" id="client_id" name="client_id" value="{{ session("current_client_id") }}">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="client_name" name="client_name" value="{{session("current_client_name")}}" readonly>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="serial_no" class="form-label">Serial No</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="serial_no" name="serial_no" value="">
                                    </div>
                                    <div class="col-sm-2 ps-0">
                                        <button type="button" class="btn btn-primary rounded mb-0 py-1" id="btn_search_serial_no"><i class="bi bi-search"></i></button>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="stock_type" class="form-label">Stock Type</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="stock_type" name="stock_type" value="">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="location_id" class="form-label">Location ID</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="location_id" name="location_id" value="">
                                    </div>
                                    <div class="col-sm-2 ps-0">
                                        <button type="button" class="btn btn-primary rounded mb-0 py-1" id="btn_search_location_id"><i class="bi bi-search"></i></button>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="imei_no" class="form-label">IMEI No</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="imei_no" name="imei_no" value="">
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="gr_id" class="form-label">GR ID</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="gr_id" name="gr_id" value="">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="pallet_id" class="form-label">Pallet ID</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="pallet_id" name="pallet_id" value="">
                                    </div>
                                    <div class="col-sm-2 ps-0">
                                        <button type="button" class="btn btn-primary rounded mb-0 py-1" id="btn_search_pallet_id"><i class="bi bi-search"></i></button>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="part_no" class="form-label">Part No</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="part_no" name="part_no" value="">
                                    </div>
                                    <div class="col-sm-2 ps-0">
                                        <button type="button" class="btn btn-primary rounded mb-0 py-1" id="btn_search_part_no"><i class="bi bi-search"></i></button>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="gr_date_to" class="form-label">GR Date From</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="gr_date_from" name="gr_date_from" value="">
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-sm-3 mb-2">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label for="gr_date_to" class="form-label">GR Date To</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="gr_date_to" name="gr_date_to" value="">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="sku_no" class="form-label">SKU No</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="sku_no" name="sku_no" value="">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="color" class="form-label">Color</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="color" name="color" value="">
                                    </div>
                                    <div class="col-sm-2 ps-0">
                                        <button type="button" class="btn btn-primary rounded mb-0 py-1" id="btn_search_color"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="last_movement_location_id" class="form-label">Last Movement Location ID</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="last_movement_location_id" name="last_movement_location_id" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="item_name" class="form-label">Item Name</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="item_name" name="item_name" value="">
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="size" class="form-label">Size</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" autocomplete="off" class="form-control py-0 rounded-start" id="size" name="size" value="">
                                    </div>
                                    <div class="col-sm-2 ps-0">
                                        <button type="button" class="btn btn-primary rounded mb-0 py-1" id="btn_search_size"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mb-2 text-end">
                                <button type="button" class="btn btn-primary mb-0 py-1" id="btn_search" name="btn_search">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-FilterTable" tabindex="-1" aria-labelledby="modal-FilterTableLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-FilterTableLabel">Filter Table</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-FilterTable"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-SerialNo" tabindex="-1" aria-labelledby="modal-SerialNoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-SerialNoLabel">Serial No - List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SerialNo">
                        <thead>
                            <tr>
                                <th class="text-xs">Serial No</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Location" tabindex="-1" aria-labelledby="modal-LocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-LocationLabel">Location - List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Location">
                        <thead>
                            <tr>
                                <th class="text-xs">Location ID</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Pallet" tabindex="-1" aria-labelledby="modal-PalletLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-PalletLabel">Pallet ID - List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Pallet">
                        <thead>
                            <tr>
                                <th class="text-xs">Pallet ID</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-PartNo" tabindex="-1" aria-labelledby="modal-PartNoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-PartNoLabel">Part No - List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-PartNo">
                        <thead>
                            <tr>
                                <th class="text-xs">Part No</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Color" tabindex="-1" aria-labelledby="modal-ColorLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-ColorLabel">Color - List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Color">
                        <thead>
                            <tr>
                                <th class="text-xs">Color</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-Size" tabindex="-1" aria-labelledby="modal-SizeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-SizeLabel">Size - List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Size">
                        <thead>
                            <tr>
                                <th class="text-xs">Size</th>
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
    let selected_column = [];

    function changeFilter() {
        let temp_checked = [];
        $("[name^=checkboxFilter]:checked").each(function() {
            temp_checked.push($(this).val())
        });
        selected_column = [];
        selected_column = temp_checked;

    }

    $(document).ready(function() {
        $("#dropdown_toggle_inventory").prop('aria-expanded', true);
        $("#dropdown_toggle_inventory").addClass('active');
        $("#dropdown_inventory").addClass('show');
        $("#logo_inventory").addClass("d-none");
        $("#logo_white_inventory").removeClass("d-none");
        $("#li_inventory_list").addClass("active");
        $("#a_inventory_list").addClass("active");

        const mapping_filter = [{
                id: "wh_code",
                desc: "WHS ID",
            },
            {
                id: "client_project_name",
                desc: "Client ID",
            },
            {
                id: "location_id",
                desc: "Location ID",
            },
            {
                id: "pallet_id",
                desc: "Pallet ID",
            },
            {
                id: "sku",
                desc: "SKU No",
            },
            {
                id: "part_name",
                desc: "Item Name",
            },
            // {
            //     id: "batch_no",
            //     desc: "Batch No",
            // },
            // {
            //     id: "serial_no",
            //     desc: "Serial No",
            // },
            // {
            //     id: "imei",
            //     desc: "IMEI No",
            // },
            // {
            //     id: "part_no",
            //     desc: "Part No",
            // },
            // {
            //     id: "color",
            //     desc: "Color",
            // },
            // {
            //     id: "size",
            //     desc: "Size",
            // },
            {
                id: "expired_date",
                desc: "Expired Date",
            },
            {
                id: "classification_name",
                desc: "Classification",
            },
            {
                id: "on_hand_qty",
                desc: "On Hand Qty",
            },
            {
                id: "allocated_qty",
                desc: "Allocated Qty",
            },
            {
                id: "picked_qty",
                desc: "Picked Qty",
            },
            {
                id: "available_qty",
                desc: "Available Qty",
            },
            {
                id: "uom_name",
                desc: "UOM",
            },
            {
                id: "stock_id",
                desc: "Stock Type",
            },
            {
                id: "gr_id",
                desc: "GR ID",
            },
            {
                id: "gr_date",
                desc: "GR Date",
            },
            {
                id: "aging",
                desc: "Aging (Days)",
            },
            {
                id: "last_movement_id",
                desc: "Last Movement Location ID",
            },
            {
                id: "user_created",
                desc: "Update By",
            },
            {
                id: "datetime_created",
                desc: "Update Time",
            },
        ];


        mapping_filter.forEach((element, index) => {
            selected_column.push(element.id);
        });

        // special function start
        const searchDatatables = () => {
            if (selected_column.length == 0) {
                Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: "Filter Cant all empty.",
                        type: 'error',
                        icon: 'error',
                    });
                return;
            }
            $("#container-datatable").html("");
            let temp_html_datatable = "";
            temp_html_datatable += `<table class="table " id="list-datatable" style="width: 100%;"><thead><tr>`;
            let column_data_server = [];
            mapping_filter.forEach((element, index) => {
                const selected = selected_column.includes(element.id);
                if (selected) {
                    column_data_server.push({
                        data: element.id,
                        className: "text-xs"
                    });
                    temp_html_datatable += `<th class="text-xs">${element.desc}</th>`;
                }
            });
            temp_html_datatable += `</tr></thead><tbody></tbody></table>`;
            $("#container-datatable").html(temp_html_datatable);

            const warehouse_id = $("#warehouse_id").val();
            const batch_no = $("#batch_no").val();
            const expired_date = $("#expired_date").val();
            const client_id = $("#client_id").val();
            const serial_no = $("#serial_no").val();
            const stock_type = $("#stock_type").val();
            const location_id = $("#location_id").val();
            const imei_no = $("#imei_no").val();
            const gr_id = $("#gr_id").val();
            const pallet_id = $("#pallet_id").val();
            const part_no = $("#part_no").val();
            const gr_date_from = $("#gr_date_from").val();
            const gr_date_to = $("#gr_date_to").val();
            const sku_no = $("#sku_no").val();
            const color = $("#color").val();
            const last_movement_location_id = $("#last_movement_location_id").val();
            const item_name = $("#item_name").val();
            const size = $("#size").val();

            $("#list-datatable").DataTable().destroy();
            $("#list-datatable").DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ordering: false,
                ajax: {
                    url: "{{route('inventory_list.datatables')}}",
                    data: {
                        warehouse_id: warehouse_id,
                        batch_no: batch_no,
                        expired_date: expired_date,
                        client_id: client_id,
                        serial_no: serial_no,
                        stock_type: stock_type,
                        location_id: location_id,
                        imei_no: imei_no,
                        gr_id: gr_id,
                        pallet_id: pallet_id,
                        part_no: part_no,
                        gr_date_from: gr_date_from,
                        gr_date_to: gr_date_to,
                        sku_no: sku_no,
                        color: color,
                        last_movement_location_id: last_movement_location_id,
                        item_name: item_name,
                        size: size,
                    },
                },
                columns: column_data_server,
            });
        }
        // special function end

        $("#btn_filter").on("click", function() {
            $("#container-datatable").html("");
            $("#modal-FilterTable").modal('show');
            $("#modal-body-FilterTable").html("");
            let html_filter = `<div class="row">`;

            mapping_filter.forEach((element, index) => {
                const selected = selected_column.includes(element.id);
                const selected_html = (selected) ? 'checked' : '';
                html_filter += `
            <div class="col-sm-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="${element.id}" id="checkboxFilter_${index}" name="checkboxFilter[]" onchange="changeFilter()" ${selected_html}>
                    <label class="form-check-label text-xs" for="checkboxFilter_${index}">
                        ${element.desc}
                    </label>
                </div>
            </div>`;
            });

            html_filter += `
        </div>`;
            $("#modal-body-FilterTable").html(html_filter);
        });

        $("#btn_search").on("click", function() {
            searchDatatables();
            $("#modal-AdvanceFilter").modal('hide');
        });

        $("#btn_advance_filter").on("click", function() {
            $("#modal-AdvanceFilter").modal('show');
        });

        $("#btn_export_excel").on("click", function() {
            if (selected_column.length == 0) {
                Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: "Filter Cant all empty.",
                        type: 'error',
                        icon: 'error',
                    });
                return;
            }

            const warehouse_id = $("#warehouse_id").val();
            const batch_no = $("#batch_no").val();
            const expired_date = $("#expired_date").val();
            const client_id = $("#client_id").val();
            const serial_no = $("#serial_no").val();
            const stock_type = $("#stock_type").val();
            const location_id = $("#location_id").val();
            const imei_no = $("#imei_no").val();
            const gr_id = $("#gr_id").val();
            const pallet_id = $("#pallet_id").val();
            const part_no = $("#part_no").val();
            const gr_date_from = $("#gr_date_from").val();
            const gr_date_to = $("#gr_date_to").val();
            const sku_no = $("#sku_no").val();
            const color = $("#color").val();
            const last_movement_location_id = $("#last_movement_location_id").val();
            const item_name = $("#item_name").val();
            const size = $("#size").val();
            const selected_column_query = JSON.stringify(selected_column);
            const mapping_filter_query = JSON.stringify(mapping_filter);

            const url = "{{ route('inventory_list.viewExcel') }}";

            const full_url = `${url}?warehouse_id=${warehouse_id}&batch_no=${batch_no}&expired_date=${expired_date}&client_id=${client_id}&serial_no=${serial_no}&stock_type=${stock_type}&location_id=${location_id}&imei_no=${imei_no}&gr_id=${gr_id}&pallet_id=${pallet_id}&part_no=${part_no}&gr_date_from=${gr_date_from}&gr_date_to=${gr_date_to}&sku_no=${sku_no}&color=${color}&last_movement_location_id=${last_movement_location_id}&item_name=${item_name}&size=${size}&selected_column_query=${selected_column_query}&mapping_filter_query=${mapping_filter_query}`;
            window.open(full_url, "_blank");
        });

        $("#btn_search_serial_no").on('click', function() {
            $("#modal-SerialNo").modal('show');
            $("#list-datatable-modal-SerialNo").DataTable().destroy();
            $("#list-datatable-modal-SerialNo").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ route('inventory_list.datatablesSerialNo') }}",
                columns: [{
                    data: 'serial_no',
                    searchable: true,
                    className: 'text-xs',
                }, ],
            });
        });

        $("#list-datatable-modal-SerialNo > tbody").on('click', 'tr', function() {
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const serial_no = $($(dom_tr).children("td")[0]).text();

            $("#serial_no").val(serial_no);
            $("#modal-SerialNo").modal('hide');

        });

        $("#btn_search_location_id").on('click', function() {
            $("#modal-Location").modal('show');
            $("#list-datatable-modal-Location").DataTable().destroy();
            $("#list-datatable-modal-Location").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ route('inventory_list.datatablesLocation') }}",
                columns: [{
                    data: 'location_id',
                    searchable: true,
                    className: 'text-xs',
                }, ],
            });
        });

        $("#list-datatable-modal-Location > tbody").on('click', 'tr', function() {
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const location_id = $($(dom_tr).children("td")[0]).text();

            $("#location_id").val(location_id);
            $("#modal-Location").modal('hide');

        });

        $("#btn_search_pallet_id").on('click', function() {
            $("#modal-Pallet").modal('show');
            $("#list-datatable-modal-Pallet").DataTable().destroy();
            $("#list-datatable-modal-Pallet").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ route('inventory_list.datatablesPallet') }}",
                columns: [{
                    data: 'pallet_id',
                    searchable: true,
                    className: 'text-xs',
                }, ],
            });
        });

        $("#list-datatable-modal-Pallet > tbody").on('click', 'tr', function() {
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const pallet_id = $($(dom_tr).children("td")[0]).text();

            $("#pallet_id").val(pallet_id);
            $("#modal-Pallet").modal('hide');

        });

        $("#btn_search_part_no").on('click', function() {
            $("#modal-PartNo").modal('show');
            $("#list-datatable-modal-PartNo").DataTable().destroy();
            $("#list-datatable-modal-PartNo").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ route('inventory_list.datatablesPartNo') }}",
                columns: [{
                    data: 'part_no',
                    searchable: true,
                    className: 'text-xs',
                }, ],
            });
        });

        $("#list-datatable-modal-PartNo > tbody").on('click', 'tr', function() {
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const part_no = $($(dom_tr).children("td")[0]).text();

            $("#part_no").val(part_no);
            $("#modal-PartNo").modal('hide');

        });

        $("#btn_search_color").on('click', function() {
            $("#modal-Color").modal('show');
            $("#list-datatable-modal-Color").DataTable().destroy();
            $("#list-datatable-modal-Color").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ route('inventory_list.datatablesColor') }}",
                columns: [{
                    data: 'color',
                    searchable: true,
                    className: 'text-xs',
                }, ],
            });
        });

        $("#list-datatable-modal-Color > tbody").on('click', 'tr', function() {
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const color = $($(dom_tr).children("td")[0]).text();

            $("#color").val(color);
            $("#modal-Color").modal('hide');

        });

        $("#btn_search_size").on('click', function() {
            $("#modal-Size").modal('show');
            $("#list-datatable-modal-Size").DataTable().destroy();
            $("#list-datatable-modal-Size").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ route('inventory_list.datatablesSize') }}",
                columns: [{
                    data: 'size',
                    searchable: true,
                    className: 'text-xs',
                }, ],
            });
        });

        $("#list-datatable-modal-Size > tbody").on('click', 'tr', function() {
            const dom_tr = $(this);
            if ($($(dom_tr).children("td")[0]).text() == "No data available in table") {
                return;
            }
            const size = $($(dom_tr).children("td")[0]).text();

            $("#size").val(size);
            $("#modal-Size").modal('hide');

        });
    });
</script>
@endsection