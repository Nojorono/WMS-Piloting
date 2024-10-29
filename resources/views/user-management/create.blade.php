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
                        <h5 class="me-auto">User Management Create</h5>
                        <a href="{{route('user_management.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" >List</button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('user_management.store') }}" id="form-save-user">
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="user_id" class="form-label text-xs">User ID</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="user_id" name="user_id" value="">
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="fullname" name="fullname" value="">
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
                                                    <input type="password" autocomplete="off" class="form-control py-0" id="password" name="password" value="">
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
                                                    <input type="email" autocomplete="off" class="form-control py-0" id="email" name="email" value="">
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="phone" name="phone" value="">
                                                    <div id="validation_phone" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
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
                                                        <option value="{{ $value_choice_user_level->user_level_id }}"> {{ $value_choice_user_level->user_level }}</option>
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
                                                        @foreach ( $data["arr_choice_user_group"] as $key_choice_user_group => $value_choice_user_group )
                                                        <option value="{{ $value_choice_user_group->id }}"> {{ $value_choice_user_group->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <!-- <div id="validation_user_level" class="invalid-feedback"></div> -->
                                                </div>
                                            </div>
                                        </div>

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
                                                        <option value="{{ $value_choice_warehouse->wh_id }}"> {{ $value_choice_warehouse->wh_name }}</option>
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
                                                    <select class="form-select py-0" id="send_email" name="send_email">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["arr_choice_send_email"]) && count($data["arr_choice_send_email"]) > 0)
                                                        @foreach ( $data["arr_choice_send_email"] as $key_choice_send_email => $value_choice_send_email )
                                                        <option value="{{ $value_choice_send_email }}"> {{ $value_choice_send_email }}</option>
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
                                                    <select class="form-select py-0" id="project" name="project" multiple>
                                                        <option value="">Choose</option>
                                                        @if (isset($data["arr_choice_project"]) && count($data["arr_choice_project"]) > 0)
                                                        @foreach ( $data["arr_choice_project"] as $key_choice_project => $value_choice_project )
                                                        <option value="{{ $value_choice_project->client_project_id }}"> {{ $value_choice_project->client_project_name }}</option>
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
                                                    <select class="form-select py-0" id="web_user" name="web_user">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["arr_choice_web_user"]) && count($data["arr_choice_web_user"]) > 0)
                                                        @foreach ( $data["arr_choice_web_user"] as $key_choice_web_user => $value_choice_web_user )
                                                        <option value="{{ $value_choice_web_user }}"> {{ $value_choice_web_user }}</option>
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
                                                    <select class="form-select py-0" id="android_user" name="android_user">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["arr_choice_android_user"]) && count($data["arr_choice_android_user"]) > 0)
                                                        @foreach ( $data["arr_choice_android_user"] as $key_choice_android_user => $value_choice_android_user )
                                                        <option value="{{ $value_choice_android_user }}"> {{ $value_choice_android_user }}</option>
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

                        <!-- <div class="col-sm-12 mb-2">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-xs" style="background-color:var(--bs-primary); color:var(--bs-white);">Menu</th>
                                                        <th class="text-center text-xs" style="background-color:var(--bs-primary); color:var(--bs-white);">Access</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($data["arr_menu"]) && count($data["arr_menu"]) > 0)
                                                        @foreach ( $data["arr_menu"] as $key_arr_menu => $value_arr_menu )
                                                            <tr>
                                                                <td class="text-center text-bold text-xs">{{ $value_arr_menu->menu_name }}</td>
                                                                <td class="">
                                                                    <div class="d-flex">
                                                                        <div class="form-check mx-auto">
                                                                            <input class="form-check-input" type="checkbox" name="menu_id[]" id="{{ $value_arr_menu->id_dom }}" value="{{ $value_arr_menu->menu_id }}" >
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @if ($value_arr_menu->child_menu && count($value_arr_menu->child_menu) > 0)
                                                                @foreach ( $value_arr_menu->child_menu as $key_child_menu => $value_child_menu)
                                                                <tr>
                                                                    <td class="text-center text-xs">{{ $value_child_menu->menu_name }}</td>
                                                                    <td class="">
                                                                        <div class="d-flex">
                                                                            <div class="form-check mx-auto">
                                                                                <input class="form-check-input" type="checkbox" name="menu_id[]" id="{{ $value_arr_menu->id_dom."_".$value_child_menu->id_dom }}" value="{{ $value_child_menu->menu_id }}" >
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
                        </div> -->
                        <div class="col-sm-12 mb-2">
                            <button type="submit" class="btn btn-primary py-1 mb-0">Save</button>
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
    $("#dropdown_toggle_setting").prop('aria-expanded',true);
    $("#dropdown_toggle_setting").addClass('active');
    $("#dropdown_setting").addClass('show');
    $("#logo_setting").addClass("d-none");
    $("#logo_white_setting").removeClass("d-none");
    $("#li_user_management").addClass("active");
    $("#a_user_management").addClass("active");

    const select_project = new Choices( document.getElementById('project'), {
        removeItemButton: true
    });

    $("#form-save-user").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";


        const user_id = $("#user_id").val();
        const fullname = $("#fullname").val();
        const password = $("#password").val();
        const email = $("#email").val();
        const phone = $("#phone").val();

        const user_level = $("#user_level").val();
        const user_group = $("#user_group").val();

        const warehouse = $("#warehouse").val();
        const send_email = $("#send_email").val();
        const temp_project = $("#project").val();
        const web_user = $("#web_user").val();
        const android_user = $("#android_user").val();
        // const arr_menu_id = [];
        const arr_project = [];

        // $("input[name*='menu_id']").each(function () {
        //     const checked = $(this).is(":checked");
        //     const menu_id = $(this).val();
        //     if(checked){
        //         arr_menu_id.push(menu_id)
        //     }
        // });

        temp_project.forEach(element => {
            arr_project.push(element);
        });

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);

        formData.append("user_id",user_id);
        formData.append("fullname",fullname);
        formData.append("password",password);
        formData.append("email",email);
        formData.append("phone",phone);
        formData.append("user_level",user_level);
        formData.append("user_group",user_group);

        formData.append("warehouse",warehouse);
        formData.append("send_email",send_email);
        formData.append("web_user",web_user);
        formData.append("android_user",android_user);
        // formData.append("arr_menu_id",JSON.stringify(arr_menu_id));
        formData.append("arr_project",JSON.stringify(arr_project));


        formData.forEach((value, key) => {
            console.log(`${key}: ${value}`);
        });


        $.ajax({
            url:url,
            method: _method,
            // data: form_data,
            // dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#user_id").removeClass('is-invalid');
                $("#validation_user_id").html('');
                $("#fullname").removeClass('is-invalid');
                $("#validation_fullname").html('');
                $("#password").removeClass('is-invalid');
                $("#validation_password").html('');
                $("#email").removeClass('is-invalid');
                $("#validation_email").html('');
                $("#phone").removeClass('is-invalid');
                $("#validation_phone").html('');
                $("#user_level").removeClass('is-invalid');
                $("#validation_user_level").html('');
                $("#warehouse").removeClass('is-invalid');
                $("#validation_warehouse").html('');
                $("#send_email").removeClass('is-invalid');
                $("#validation_send_email").html('');
                $("#project").removeClass('is-invalid');
                $("#validation_project").html('');
                $("#web_user").removeClass('is-invalid');
                $("#validation_web_user").html('');
                $("#android_user").removeClass('is-invalid');
                $("#validation_android_user").html('');
            },

            error: function (error) {
            console.log('error', error);

                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: 'Something Wrong',
                    // type: 'error',
                    icon: 'error',
                });
            },
            complete: function () {

            },
            success: function (response) {
            console.log('success', response);

                if(typeof response !== 'object'){
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: 'Something Wrong',
                        // type: 'error',
                        icon: 'error',
                    });
                    return;
                }

                if(response.err){
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
                        // type: 'error',
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
                    // type: 'success',
                    icon: 'success',
                });
                window.location = "{{ route('user_management.index') }}";
                return;

            },
        });

    });
});
</script>
@endsection
