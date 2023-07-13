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
                    <div class="col-3">
                        <a href="{{ route('test.view_simple_datatables') }}">
                            <button class="btn btn-primary" type="button">Simple Datatables</button>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('test.view_datatables') }}">
                            <button class="btn btn-primary" type="button">Datatables</button>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('test.view_form') }}">
                            <button class="btn btn-primary" type="button">Test Form</button>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('test.view_sweetalert2') }}">
                            <button class="btn btn-primary" type="button">Test Sweetalert</button>
                        </a>
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

});
</script>
@endsection
