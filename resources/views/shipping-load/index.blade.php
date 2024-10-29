@extends('layout.app')

@section("title")
Shipping Load
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
                        <h5 class="me-auto">Shipping Load - List</h5>
                        <a href="{{ route('shipping_load.create')  }}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary text-xs py-1">Add</button>
                        </a>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card ">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="booking_no" class="form-label text-xs">Booking No</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="booking_no" name="booking_no" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_name" class="form-label text-xs">Pickup Name</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="pickup_name" name="pickup_name" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_company" class="form-label text-xs">Pickup Company</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="pickup_company" name="pickup_company" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_date" class="form-label text-xs">Pickup Date</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="date" autocomplete="off" class="form-control py-0" id="pickup_date" name="pickup_date" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="pickup_status_name" class="form-label text-xs">Pickup Status</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="pickup_status_id" name="pickup_status_id" value="" readonly>
                                                <input type="text" autocomplete="off" class="form-control py-0" id="pickup_status_name" name="pickup_status_name" value="" readonly>
                                            </div>
                                            <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary rounded py-1 mb-0" id="btn_search_shipping_status"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" id="btn_search" name="btn_search">Search</button>
                                        <button type="button" class="btn btn-primary text-xs py-1 mb-0" id="btn_reset" name="btn_reset">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table " id="list-datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-xs">Booking No</th>
                                        <th class="text-xs">Warehouse Name</th>
                                        <th class="text-xs">Pickup Name</th>
                                        <th class="text-xs">Pickup Company</th>
                                        <th class="text-xs">Pickup Datetime</th>
                                        <th class="text-xs">Status</th>
                                        <th class="text-xs">Action</th>
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

<div class="modal fade" id="modal-ShippingLoadStatus" tabindex="-1" aria-labelledby="modal-ShippingLoadStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ShippingLoadStatusLabel">Status - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-ShippingLoadStatus" >
                        <thead>
                            <tr>
                                <th class="text-xs">Status ID</th>
                                <th class="text-xs">Status Name</th>
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
$(document).ready(function () {
    $("#dropdown_toggle_transportation").prop('aria-expanded',true);
    $("#dropdown_toggle_transportation").addClass('active');
    $("#dropdown_transportation").addClass('show');
    $("#logo_transportation").addClass("d-none");
    $("#logo_white_transportation").removeClass("d-none");
    $("#li_shipping_load").addClass("active");
    $("#a_shipping_load").addClass("active");

    // special function start
    const searchDatatables = () => {
        
        const booking_no = $("#booking_no").val();
        const pickup_name = $("#pickup_name").val();
        const pickup_company = $("#pickup_company").val();
        const pickup_date = $("#pickup_date").val();
        const pickup_status_id = $("#pickup_status_id").val();

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{route('shipping_load.datatables')}}",
                data: {
                    booking_no : booking_no,
                    pickup_name : pickup_name,
                    pickup_company : pickup_company,
                    pickup_date : pickup_date,
                    pickup_status_id : pickup_status_id,
                },
            },
            columns:[
            {
                data: "booking_no",
                className: "text-xs",
            },
            {
                data: "wh_name",
                className: "text-xs",
            },
            {
                data: "pickup_name",
                className: "text-xs",
            },
            {
                data: "pickup_company",
                className: "text-xs",
            },
            {
                data: "pickup_datetime",
                className: "text-xs",
            },
            {
                data: "status_name",
                className: "text-xs",
            },
            {
                data: "action",
                className: "text-xs",
            },
            ],
        });
    }
    // special function end

    $("#btn_search").on("click",function () {
        searchDatatables();
    });

    $("#btn_reset").on("click",function () {
        window.location.href = "{{ route('shipping_load.index') }}";
    });

    $("#btn_search_shipping_status").on('click',function () {
        $("#modal-ShippingLoadStatus").modal('show');
        $("#list-datatable-modal-ShippingLoadStatus").DataTable().destroy();
        $("#list-datatable-modal-ShippingLoadStatus").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('shipping_load.datatablesShippingLoadStatus') }}",
            columns:[
                {
                    data: 'status_id', 
                    searchable: true, 
                    className: "text-xs",
                },
                {
                    data: 'status_name', 
                    searchable: true, 
                    className: "text-xs",
                },
            ],
        });
    });

    $("#list-datatable-modal-ShippingLoadStatus > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const status_id = $($(dom_tr).children("td")[0]).text(); 
        const status_name = $($(dom_tr).children("td")[1]).text();
        
        $("#pickup_status_id").val(status_id);
        $("#pickup_status_name").val(status_name);
        $("#modal-ShippingLoadStatus").modal('hide');
        
    });
});
</script>
@endsection
