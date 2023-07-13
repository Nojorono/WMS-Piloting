@extends('layout.app')

@section("title")
Master Transporter
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
                        <h5 class="me-auto">Master Transporter - Show</h5>
                        <a href="{{route('master_transporter.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-12 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="transporter_id" class="form-label text-xs">Transporter ID</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="transporter_id" name="transporter_id" value="{{ @$data["current_data"][0]->transporter_id }}" readonly>
                                                <div id="validation_transporter_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="transporter_name" class="form-label text-xs">Transporter Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="transporter_name" name="transporter_name" value="{{ @$data["current_data"][0]->transporter_name }}" readonly>
                                                <div id="validation_transporter_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
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

$(document).ready(function () {
    $("#dropdown_toggle_master").prop('aria-expanded',true);
    $("#dropdown_toggle_master").addClass('active');
    $("#dropdown_master").addClass('show');
    $("#li_master_transporter").addClass("active");
    $("#a_master_transporter").addClass("active");
});
</script>
@endsection