@extends('layout.app')

@section("title")
Master Unit
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
                        <h5 class="me-auto">Master Unit - Show</h5>
                        <a href="{{route('master_unit.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                        <a href="{{route('master_unit.edit' , ['id' => @$data["current_data"][0]->uom_name ])}}" class="text-decoration-none me-2">
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
                                                <label for="unit_name" class="form-label text-xs">Unit Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="unit_name" name="unit_name" value="{{ @$data["current_data"][0]->uom_name }}" readonly>
                                                <div id="validation_unit_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="unit_type" class="form-label text-xs">Unit Type</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="unit_type" name="unit_type" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_unit_type"]) && count($data["arr_choice_unit_type"]) > 0)
                                                    @foreach ( $data["arr_choice_unit_type"] as $key_choice_unit_type => $value_choice_unit_type )
                                                    @php
                                                        $selected_unit_type = "";
                                                        if(@$data["current_data"][0]->uom_type_id == $value_choice_unit_type->uom_type_id){
                                                            $selected_unit_type = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_unit_type->uom_type_id }}" {{ $selected_unit_type }}> {{ $value_choice_unit_type->uom_type_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_location_type" class="invalid-feedback"></div>
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
    $("#logo_master").addClass("d-none");
    $("#logo_white_master").removeClass("d-none");
    $("#li_master_unit").addClass("active");
    $("#a_master_unit").addClass("active");
});
</script>
@endsection