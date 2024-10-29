@extends('layout.app')

@section("title")
User Group Management
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
                        <h5 class="me-auto">User Group Management - Show</h5>
                        <a href="{{route('user_group_management.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" >List</button>
                        </a>
                        <a href="{{route('user_group_management.edit' , ['id' => @$data['current_data'][0]->id ])}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" >Edit</button>
                        </a>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="user_group_id" class="form-label text-xs">User Group ID</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="user_group_id" name="user_group_id" value="{{ @$data["current_data"][0]->id }}" readonly>
                                                <div id="validation_user_group_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="name" class="form-label text-xs">Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="name" name="name" value="{{ @$data["current_data"][0]->name }}" readonly>
                                                <div id="validation_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="description" class="form-label text-xs">Description</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="description" autocomplete="off" class="form-control py-0" id="description" name="description" value="{{ @$data["current_data"][0]->description }}" readonly>
                                                <div id="validation_description" class="invalid-feedback"></div>
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
                                                    @if (isset($data["arr_choice_is_activ"]) && count($data["arr_choice_is_activ"]) > 0)
                                                    @foreach ( $data["arr_choice_is_activ"] as $key_choice_is_activ => $value_is_activ )
                                                    @php
                                                        $selected_is_activ = "";
                                                        if($data["current_data"][0]->is_activ == $value_is_activ){
                                                            $selected_is_activ = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_is_activ }}" {{ $selected_is_activ }}> {{ $value_is_activ }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_is_activ" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="row justify-content-center">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-xs text-center" style="background-color:var(--bs-primary); color:var(--bs-white);">Menu</th>
                                                    <th class="text-xs text-center" style="background-color:var(--bs-primary); color:var(--bs-white);">Access</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data["arr_menu"]) && count($data["arr_menu"]) > 0)
                                                    @foreach ( $data["arr_menu"] as $key_arr_menu => $value_arr_menu )
                                                        @php
                                                            $checked_parent = "";
                                                            if(in_array($value_arr_menu->menu_id,$data["current_data_user_access"])){
                                                                $checked_parent = " checked ";
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <td class="text-xs text-center text-bold">{{ $value_arr_menu->menu_name }}</td>
                                                            <td class="">
                                                                <div class="d-flex">
                                                                    <div class="form-check mx-auto">
                                                                        <input class="form-check-input" type="checkbox" name="menu_id[]" id="{{ $value_arr_menu->id_dom }}" value="{{ $value_arr_menu->menu_id }}" {{ $checked_parent }} disabled>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @if ($value_arr_menu->child_menu && count($value_arr_menu->child_menu) > 0)
                                                            @foreach ( $value_arr_menu->child_menu as $key_child_menu => $value_child_menu)
                                                            @php
                                                                $checked_child = "";
                                                                if(in_array($value_child_menu->menu_id,$data["current_data_user_access"])){
                                                                    $checked_child = " checked ";
                                                                }
                                                            @endphp
                                                            <tr>
                                                                <td class="text-xs text-center">{{ $value_child_menu->menu_name }}</td>
                                                                <td class="">
                                                                    <div class="d-flex">
                                                                        <div class="form-check mx-auto">
                                                                            <input class="form-check-input" type="checkbox" name="menu_id[]" id="{{ $value_arr_menu->id_dom."_".$value_child_menu->id_dom }}" value="{{ $value_child_menu->menu_id }}" {{ $checked_child }} disabled>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                                
                                            </tbody>
                                        </table>
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
<script src="{{ asset('js/plugins/choices.min.js') }}"></script>
<script type="text/javascript">

$(document).ready(function () {
    $("#dropdown_toggle_setting").prop('aria-expanded',true);
    $("#dropdown_toggle_setting").addClass('active');
    $("#dropdown_setting").addClass('show');
    $("#logo_setting").addClass("d-none");
    $("#logo_white_setting").removeClass("d-none");
    $("#li_user_group_management").addClass("active");
    $("#a_user_group_management").addClass("active");

    const select_project = new Choices( document.getElementById('project'),{});
});
</script>
@endsection