
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
                <div class="row">
                    <div class="col-sm-3 mb-2">
                        <button class="btn bg-gradient-primary mb-0" onclick="soft.showSwal('basic')">Try me!</button>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <button type="button" class="btn btn-primary" id="btn_sweet_alert_manual">Sweet alert manual</button>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <a href="{{route("test.view_sweetalert2_backend")}}">
                            <button type="button" class="btn btn-primary">Sweet alert backend</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script src="{{asset('/js/plugins/sweetalert.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#btn_sweet_alert_manual").on("click",function () {
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
                cancelButton: 'btn btn-danger me-2'
            },
            buttonsStyling: false,
        })
        .fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        });
    });
});
</script>
@endsection
