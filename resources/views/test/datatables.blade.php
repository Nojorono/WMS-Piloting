
@extends('layout.app')

@section("title")
Test
@endsection

@section("custom-style")
<link rel="stylesheet" type="text/css" href="{{ asset("DataTables/custom_with_softui_datatables.css") }}"/>

@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('test.index') }}">
                            <button class="btn btn-primary" type="button">index</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        jangan lupa harus di matiin import datatables css yang original nya
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table " id="test_datatables" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>stock_count_id</th>
                                        <th>count_no</th>
                                        <th>location_id</th>
                                        <th>sku</th>
                                        <th>stock_id</th>
                                        <th>gr_id</th>
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
    $("#test_datatables").DataTable({
        processing: true,
        serverSide: true,
        // ordering: false,
        //dom original start
        dom : "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        //dom origin end

        //dom customed start
        // dom : "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        // "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>" +
        // "<'row'<'col-sm-12 mb-2'tr>>" 
        // +"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        // "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        //dom customed end
        ajax: {
            url: "{{route('test.get_data_datatables')}}",
            data: {
            },
        },
        columns:[
            
            {data: 'stock_count_id',},
            {data: 'count_no',},
            {data: 'location_id',},
            {data: 'sku',},
            {data: 'stock_id',},
            {data: 'gr_id',},
        ],
    });
});
</script>
@endsection
