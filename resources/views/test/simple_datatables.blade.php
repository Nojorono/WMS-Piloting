{{-- 
masalah untuk server side nya kalo data nya banyak gimana?, di github udah ada yang pernah nnya tapi creator library nya ga mau nambahin proses server side nya
https://github.com/fiduswriter/Simple-DataTables/issues/12
https://github.com/fiduswriter/simple-datatables/issues/13
 --}}
@extends('layout.app')

@section("title")
Test
@endsection

@section("custom-style")
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
                <div class="table-responsive">
                    <table class="table " id="test_datatables" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>column data 1</th>
                                <th>column data 2</th>
                                <th>column data 3</th>
                                <th>column data 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 100; $i++)    
                            <tr>
                                <td>column data {{ $i }}</td>
                                <td>column data {{ $i }}</td>
                                <td>column data {{ $i }}</td>
                                <td>column data {{ $i }}</td>
                            </tr>
                            @endfor
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script src="{{ asset("/js/plugins/datatables.js") }}"></script>
<script type="text/javascript">

$(document).ready(function () {
    const dataTableBasic = new simpleDatatables.DataTable("#test_datatables", {
        // searchable: false,
        // fixedHeight: true,
        rowNavigation: true,
    });
    dataTableBasic.on('datatable.page', function(page) {
        console.log({page})
    });

    dataTableBasic.on('datatable.perpage', function(perpage) {
        console.log({perpage})
    });

    dataTableBasic.on('datatable.search', function(query, matched) {
        console.log({query, matched})
    });

    dataTableBasic.on('datatable.selectrow', function(row, event) {
        event.preventDefault();
        row.classList.add('selected');
        console.log({row, event})
    });

    
});
</script>
@endsection
