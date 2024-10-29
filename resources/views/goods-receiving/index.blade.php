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
                        <h5 class="me-auto">Goods Receiving - List</h5>
                        <a href="{{ route('goods_receiving.viewExcel') }}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary mb-0 py-1">Print List Data</button>
                        </a>
                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table " id="list-datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-xs">Inbound Planning No</th>
                                        <th class="text-xs">GR ID</th>
                                        <th class="text-xs">Warehouse Code</th>
                                        <th class="text-xs">Client Project Name</th>
                                        <th class="text-xs">Reference No</th>
                                        <th class="text-xs">Receive Date</th>
                                        <th class="text-xs">Order Type</th>
                                        <th class="text-xs">GR Status</th>
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
    $("#dropdown_toggle_inbound").prop('aria-expanded',true);
    $("#dropdown_toggle_inbound").addClass('active');
    $("#dropdown_inbound").addClass('show');
    $("#logo_inbound").addClass("d-none");
    $("#logo_white_inbound").removeClass("d-none");
    $("#li_goods_receiving").addClass("active");
    $("#a_goods_receiving").addClass("active");
    // special function start
    const searchDatatables = () => {
        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{route('goods_receiving.datatables')}}",
            },
            columns:[
                {
                    data: "inbound_planning_no",
                    className: 'text-xs',
                },
                {
                    data: "gr_id",
                    className: 'text-xs',
                },
                {
                    data: "wh_code",
                    className: 'text-xs',
                },
                {
                    data: "client_project_name",
                    className: 'text-xs',
                },
                {
                    data: "reference_no",
                    className: 'text-xs',
                },
                {
                    data: "datetime_created",
                    className: 'text-xs',
                },
                {
                    data: "order_type",
                    className: 'text-xs',
                },
                {
                    data: "status_name",
                    className: 'text-xs',
                },
                {
                    data: "action",
                    className: 'text-xs',
                },
            ],
        });
    }
    // special function end

    searchDatatables();
});
</script>
@endsection
