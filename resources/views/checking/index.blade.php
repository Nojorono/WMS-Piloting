@extends('layout.app')

@section("title")
Checking
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
                        <h5 class="me-auto">Checking - List</h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="bucket_id" class="form-label text-xs">Bucket ID</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="bucket_id" name="bucket_id" value="">
                                                <div id="validation_bucket_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-2">
                                        <button type="button" class="btn btn-primary py-1 mb-0" id="btn_search" name="btn_search">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table " id="list-datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-xs">Outbound ID</th>
                                        <th class="text-xs">Warehouse Name</th>
                                        <th class="text-xs">Client Name</th>
                                        <th class="text-xs">Reference No</th>
                                        <th class="text-xs">Plan Delivery Date</th>
                                        <th class="text-xs">Order Type</th>
                                        <th class="text-xs">Checking Status</th>
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


@endsection

@section("javascript")
<script type="text/javascript">
$(document).ready(function () {
    $("#dropdown_toggle_outbound").prop('aria-expanded',true);
    $("#dropdown_toggle_outbound").addClass('active');
    $("#dropdown_outbound").addClass('show');
    $("#li_checking").addClass("active");
    $("#a_checking").addClass("active");
    
    // special function start
    const searchDatatables = () => {

        const bucket_id = $("#bucket_id").val();
        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('checking.datatables') }}",
                data : {
                    bucket_id: bucket_id,
                }
            },
            columns:[
                {
                    data: "outbound_id",
                    className: "text-xs",
                },
                {
                    data: "warehouse_name",
                    className: "text-xs",
                },
                {
                    data: "client_name",
                    className: "text-xs",
                },
                {
                    data: "reference_no",
                    className: "text-xs",
                },
                {
                    data: "plan_delivery_date",
                    className: "text-xs",
                },
                {
                    data: "order_type",
                    className: "text-xs",
                },
                {
                    data: "picking_status",
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
   
    searchDatatables();

    $("#btn_search").on("click",function () {
        searchDatatables();
    });
});
</script>
@endsection
