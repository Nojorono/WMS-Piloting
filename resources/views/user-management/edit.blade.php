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
                        <h5 class="me-auto">User Management - EDIT</h5>
                        <a href="{{route('user_management.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" >List</button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('user_management.update', ['id' => @$data['current_data'][0]->username]) }}" id="form-update-user">
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <div class="row">

                                    <!-- USER ID -->
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

                                    <!-- FULLNAME -->
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="fullname" class="form-label text-xs">Full Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="fullname" name="fullname" value="{{ @$data["current_data"][0]->fullname }}">
                                                <div id="validation_fullname" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="password" class="form-label text-xs">Password</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="password" autocomplete="off" class="form-control py-0" id="password" name="password" value="{{ @$data["current_data"][0]->password }}" >
                                                <div id="validation_password" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <!-- EMAIL -->
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="email" class="form-label text-xs">Email</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="email" autocomplete="off" class="form-control py-0" id="email" name="email" value="{{ @$data["current_data"][0]->email }}">
                                                <div id="validation_email" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PHONE -->
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="phone" class="form-label text-xs">Phone</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="phone" name="phone" value="{{ @$data["current_data"][0]->phone }}">
                                                <div id="validation_phone" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- USER LEVEL -->
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="user_level" class="form-label text-xs">User Level</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="user_level" name="user_level">
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

                                    <!-- USER GROUP -->
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="user_group" class="form-label text-xs">User Group</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                <select class="form-select py-0" id="user_group" name="user_group">
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_user_group"]) && count($data["arr_choice_user_group"]) > 0)
                                                        @foreach ($data["arr_choice_user_group"] as $key_choice_user_group => $value_choice_user_group)
                                                            <option value="{{ $value_choice_user_group->id }}" {{ $value_choice_user_group->id == $data["current_data"][0]->user_group_id ? 'selected' : '' }}>
                                                                {{ $value_choice_user_group->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- WAREHOUSE -->
                                    <div class="col-sm-4 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse" class="form-label text-xs">Warehouse</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="warehouse" name="warehouse">
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

                                <!-- SEND EMAIL -->
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="send_email" class="form-label text-xs">Send Email?</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="send_email" name="send_email">
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

                                    <!-- PROJECT -->
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="project" class="form-label text-xs">Project</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="project" name="project" multiple>
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
                                    <!-- WEB USER -->
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="web_user" class="form-label text-xs">Web User?</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="web_user" name="web_user">
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

                                    <!-- ANDROID USER -->
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="android_user" class="form-label text-xs">Android User?</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="android_user" name="android_user">
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
                        <button type="submit" class="btn btn-primary py-1 mb-0">Update</button>
                    </div>
                    </form>
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
    $("#dropdown_toggle_setting").prop('aria-expanded', true);
    $("#dropdown_toggle_setting").addClass('active');
    $("#dropdown_setting").addClass('show');
    $("#logo_setting").addClass("d-none");
    $("#logo_white_setting").removeClass("d-none");
    $("#li_user_management").addClass("active");
    $("#a_user_management").addClass("active");

    const select_project = new Choices(document.getElementById('project'), {});

    $("#form-update-user").on("submit", function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        // Prepare form data
        const formData = new FormData();
        formData.append("_token", _token);
        formData.append("_method", _method);

        // Collect form field data
        formData.append("user_id", $("#user_id").val());
        formData.append("fullname", $("#fullname").val());
        // formData.append("password", $("#password").val());
        formData.append("email", $("#email").val());
        formData.append("phone", $("#phone").val());
        formData.append("user_level", $("#user_level").val());
        formData.append("user_group", $("#user_group").val());
        formData.append("warehouse", $("#warehouse").val());
        formData.append("send_email", $("#send_email").val());
        formData.append("web_user", $("#web_user").val());
        formData.append("android_user", $("#android_user").val());

        // formData.append("project", $("#project").val());
        formData.append("project", JSON.stringify($("#project").val()));

        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // AJAX request
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                // Reset previous validation errors
                $(".form-control").removeClass('is-invalid');
                $(".invalid-feedback").html('');
            },
            // success: function (response) {
            //     console.log(response.output);
            // },
            error: function (error) {
                Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: 'Something went wrong',
                        type: 'error',
                        icon: 'error',
                    });
            },
            success: function (response) {
                if (typeof response !== 'object') {
                    Swal
                        .mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary me-2',
                            },
                            buttonsStyling: false,
                        })
                        .fire({
                            text: 'Invalid response format',
                            type: 'error',
                            icon: 'error',
                        });
                    return;
                }

                if (response.err) {
                    for (const key_data in response.data) {
                        if (Object.hasOwnProperty.call(response.data, key_data)) {
                            const arr_message = response.data[key_data];
                            let text_message = "";
                            arr_message.forEach(error_message => {
                                text_message += `${error_message} <br>`;
                            });
                            $(`#${key_data}`).addClass('is-invalid');
                            $(`#validation_${key_data}`).html(text_message);
                        }
                    }
                    Swal
                        .mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary me-2',
                            },
                            buttonsStyling: false,
                        })
                        .fire({
                            text: `${response.message}`,
                            type: 'error',
                            icon: 'error',
                        });
                    return;
                }

                Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: `${response.message}`,
                        type: 'success',
                        icon: 'success',
                    });
                window.location = "{{ route('user_management.index') }}";
            },
        });
    });
});
</script>
@endsection
