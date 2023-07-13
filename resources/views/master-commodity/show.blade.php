@extends('layout.app')

@section("title")
Master Commodity
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
                        <h5 class="me-auto">Master Commodity - Show</h5>
                        <a href="{{route('master_commodity.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                        <a href="{{route('master_commodity.edit' , ['id' => @$data["current_data"][0]->commodity_id ])}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >Edit</button>
                        </a>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="commodity_name" class="form-label text-xs">Commodity Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="commodity_name" name="commodity_name" value="{{ @$data['current_data'][0]->commodity_name }}" readonly>
                                                <div id="validation_commodity_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="commodity_desc" class="form-label text-xs">Commodity Desc</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <textarea class="form-control py-0" id="commodity_desc" name="commodity_desc" cols="30" rows="5" readonly>{{ @$data['current_data'][0]->commodity_desc }}</textarea>
                                                <div id="validation_commodity_desc" class="invalid-feedback"></div>
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
    $("#li_master_commodity").addClass("active");
    $("#a_master_commodity").addClass("active");
});
</script>
@endsection