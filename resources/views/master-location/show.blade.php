@extends('layout.app')

@section("title")
Master Location
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
                        <h5 class="me-auto">Master Location - Show</h5>
                        <a href="{{route('master_location.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                        <a href="{{route('master_location.edit' , ['id' => @$data["current_data"][0]->location_id ])}}" class="text-decoration-none me-2">
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
                                                <label for="location_code" class="form-label text-xs">Location Code</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="location_code" name="location_code" value="{{ @$data["current_data"][0]->location_code }}" readonly>
                                                <div id="validation_location_code" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="location_name" class="form-label text-xs">Location Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="location_name" name="location_name" value="{{ @$data["current_data"][0]->location_name }}" readonly>
                                                <div id="validation_location_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="location_index" class="form-label text-xs">Location Index</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="location_index" name="location_index" value="{{ @$data["current_data"][0]->index_code }}" readonly>
                                                <div id="validation_location_index" class="invalid-feedback"></div>
                                            </div>
                                            {{-- <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded" name="btn_search_location_index" id="btn_search_location_index"><i class="bi bi-search"></i></button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="location_type" class="form-label text-xs">Location Type</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="location_type" name="location_type" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_location_type"]) && count($data["arr_choice_location_type"]) > 0)
                                                    @foreach ( $data["arr_choice_location_type"] as $key_choice_location_type => $value_choice_location_type )
                                                    @php
                                                        $selected_location_type = "";
                                                        if( @$data["current_data"][0]->location_type == $value_choice_location_type->type_name ){
                                                            $selected_location_type = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_location_type->type_name }}" {{ $selected_location_type }}> {{ $value_choice_location_type->type_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_location_type" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="project" class="form-label text-xs">Project</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="project" name="project" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_project"]) && count($data["arr_choice_project"]) > 0)
                                                    @foreach ( $data["arr_choice_project"] as $key_choice_project => $value_choice_project )
                                                    @php
                                                        $selected_project = "";
                                                        if( @$data["current_data"][0]->client_project_id == $value_choice_project->client_project_id ){
                                                            $selected_project = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_project->client_project_id }}" {{ $selected_project }}> {{ $value_choice_project->client_project_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_project" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse" class="form-label text-xs">Warehouse</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="warehouse" name="warehouse" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_warehouse"]) && count($data["arr_choice_warehouse"]) > 0)
                                                    @foreach ( $data["arr_choice_warehouse"] as $key_choice_warehouse => $value_choice_warehouse )
                                                    @php
                                                        $selected_warehouse = "";
                                                        if( @$data["current_data"][0]->wh_id == $value_choice_warehouse->wh_id ){
                                                            $selected_warehouse = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_warehouse->wh_id }}" {{ $selected_warehouse }}> {{ $value_choice_warehouse->wh_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_warehouse" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="commodity_name" class="form-label text-xs">Commodity</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="hidden" id="commodity_id" name="commodity_id" value="{{ @$data["current_data"][0]->commodity_id }}">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="commodity_name" name="commodity_name" value="{{ @$data["current_data"][0]->commodity_name }}" readonly>
                                                <div id="validation_commodity_name" class="invalid-feedback"></div>
                                            </div>
                                            {{-- <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 rounded" name="btn_search_commodity" id="btn_search_commodity"><i class="bi bi-search"></i></button>
                                            </div> --}}
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
    $("#li_master_location").addClass("active");
    $("#a_master_location").addClass("active");
});
</script>
@endsection