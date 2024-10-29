@extends('layout.app')

@section("title")
Master Location Index
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
                        <h5 class="me-auto">Master Location Index - Show</h5>
                        <a href="{{route('master_location_index.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                        <a href="{{route('master_location_index.edit' , ['id' => @$data["current_data"][0]->index_code ])}}" class="text-decoration-none me-2">
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
                                                <label for="index_code" class="form-label text-xs">Index Code</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="index_code" name="index_code" value="{{ @$data["current_data"][0]->index_code }}" readonly>
                                                <div id="validation_index_code" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="index_name" class="form-label text-xs">Index Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="index_name" name="index_name" value="{{ @$data['current_data'][0]->index_name }}" readonly>
                                                <div id="validation_index_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="length" class="form-label text-xs">Length</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="length" name="length" value="{{ @$data['current_data'][0]->length }}" readonly>
                                                <div id="validation_length" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="width" class="form-label text-xs">Width</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="width" name="width" value="{{ @$data['current_data'][0]->width }}" readonly>
                                                <div id="validation_width" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="height" class="form-label text-xs">Height</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="height" name="height" value="{{ @$data['current_data'][0]->height }}" readonly>
                                                <div id="validation_height" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="capacity" class="form-label text-xs">Capacity</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input type="number" autocomplete="off" class="form-control py-0" id="capacity" name="capacity" value="{{ @$data['current_data'][0]->capacity }}" readonly>
                                                <div id="validation_capacity" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="is_active" class="form-label text-xs">Is Active</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="is_active" name="is_active" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_is_active"]) && count($data["arr_choice_is_active"]) > 0)
                                                    @foreach ( $data["arr_choice_is_active"] as $key_choice_is_activ => $value_is_active )
                                                    @php
                                                        $selected_is_active = "";
                                                        if( @$data["current_data"][0]->is_active == $value_is_active ){
                                                            $selected_is_active = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_is_active }}" {{ $selected_is_active }}> {{ $value_is_active }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_is_active" class="invalid-feedback"></div>
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
    $("#li_master_location_index").addClass("active");
    $("#a_master_location_index").addClass("active");
});
</script>
@endsection