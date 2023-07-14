@extends('layout.app')

@section("title")
User Management
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
                        <h5 class="me-auto">User Management - Show</h5>
                        <a href="{{route('user_management.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" >List</button>
                        </a>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="user_id" class="form-label text-xs">User ID</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="user_id" name="user_id" value="{{ @$data["current_data"][0]->username }}" readonly>
                                                <div id="validation_user_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="fullname" class="form-label text-xs">Full Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="fullname" name="fullname" value="{{ @$data["current_data"][0]->fullname }}" readonly>
                                                <div id="validation_fullname" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="password" class="form-label text-xs">Password</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="password" autocomplete="off" class="form-control py-0" id="password" name="password" value="" readonly>
                                                <div id="validation_password" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="email" class="form-label text-xs">Email</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="email" autocomplete="off" class="form-control py-0" id="email" name="email" value="{{ @$data["current_data"][0]->email }}" readonly>
                                                <div id="validation_email" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="phone" class="form-label text-xs">Phone</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="phone" name="phone" value="{{ @$data["current_data"][0]->phone }}" readonly>
                                                <div id="validation_phone" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="user_level" class="form-label text-xs">User Level</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="user_level" name="user_level" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_user_level"]) && count($data["arr_choice_user_level"]) > 0)
                                                    @foreach ( $data["arr_choice_user_level"] as $key_choice_user_level => $value_choice_user_level )
                                                    @php
                                                        $selected_user_level = "";
                                                        if($data["current_data"][0]->user_level_id == $value_choice_user_level->user_level_id){
                                                            $selected_user_level = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_user_level->user_level_id }}" {{ $selected_user_level }}> {{ $value_choice_user_level->user_level }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_user_level" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
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
                                                        if($data["current_data"][0]->wh_id == $value_choice_warehouse->wh_id){
                                                            $selected_warehouse = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_warehouse->wh_id }}" {{ $selected_warehouse }} > {{ $value_choice_warehouse->wh_name }}</option>
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
                                                <label for="send_email" class="form-label text-xs">Send Email?</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="send_email" name="send_email" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_send_email"]) && count($data["arr_choice_send_email"]) > 0)
                                                    @foreach ( $data["arr_choice_send_email"] as $key_choice_send_email => $value_choice_send_email )
                                                    @php
                                                        $selected_send_email = "";
                                                        if($data["current_data"][0]->send_email == $value_choice_send_email){
                                                            $selected_send_email = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_send_email }}" {{ $selected_send_email }}> {{ $value_choice_send_email }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_send_email" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="project" class="form-label text-xs">Project</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="project" name="project" multiple disabled>
                                                    {{-- <option value="">Choose</option> --}}
                                                    @if (isset($data["arr_choice_project"]) && count($data["arr_choice_project"]) > 0)
                                                    @foreach ( $data["arr_choice_project"] as $key_choice_project => $value_choice_project )
                                                    @php
                                                        $selected_choice_project = "";
                                                        if(in_array($value_choice_project->client_project_id,$data["current_data_project"])){
                                                            $selected_choice_project = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_project->client_project_id }}" {{ $selected_choice_project }}> {{ $value_choice_project->client_project_name }}</option>
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
                                                <label for="web_user" class="form-label text-xs">Web User?</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="web_user" name="web_user" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_web_user"]) && count($data["arr_choice_web_user"]) > 0)
                                                    @foreach ( $data["arr_choice_web_user"] as $key_choice_web_user => $value_choice_web_user )
                                                    @php
                                                        $selected_web_user = "";
                                                        if($data["current_data"][0]->is_web == $value_choice_web_user){
                                                            $selected_web_user = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_web_user }}" {{ $selected_web_user }}> {{ $value_choice_web_user }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_web_user" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="android_user" class="form-label text-xs">Android User?</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="android_user" name="android_user" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_android_user"]) && count($data["arr_choice_android_user"]) > 0)
                                                    @foreach ( $data["arr_choice_android_user"] as $key_choice_android_user => $value_choice_android_user )
                                                    @php
                                                        $selected_android_user = "";
                                                        if($data["current_data"][0]->is_android == $value_choice_android_user){
                                                            $selected_android_user = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_android_user }}" {{ $selected_android_user }}> {{ $value_choice_android_user }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_android_user" class="invalid-feedback"></div>
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
    $("#li_user_management").addClass("active");
    $("#a_user_management").addClass("active");

    const select_project = new Choices( document.getElementById('project'),{});
});
</script>
@endsection