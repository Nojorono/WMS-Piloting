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
                        <h5 class="me-auto">User Management - Edit</h5>
                        <a href="{{route('user_group_management.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" >List</button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('user_group_management.update', ['id' => @$data['current_data'][0]->id]) }}" id="form-save-user-group">
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body">
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="name" name="name" value="{{ @$data["current_data"][0]->name }}">
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
                                                    <input type="description" autocomplete="off" class="form-control py-0" id="description" name="description" value="{{ @$data['current_data'][0]->description }}">
                                                    <div id="validation_description" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="is_activ" class="form-label text-xs">Is Active</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select class="form-select py-0" id="is_activ" name="is_activ">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["arr_choice_is_activ"]) && count($data["arr_choice_is_activ"]) > 0)
                                                        @foreach ( $data["arr_choice_is_activ"] as $key_choice_is_activ => $value_choice_is_activ )
                                                        @php
                                                            $selected_is_activ = "";
                                                            if( @$data["current_data"][0]->is_activ == $value_choice_is_activ ){
                                                                $selected_is_activ = " selected ";
                                                            }
                                                        @endphp
                                                        <option value="{{ $value_choice_is_activ }}" {{ $selected_is_activ }}> {{ $value_choice_is_activ }}</option>
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
                                                                            <input class="form-check-input" type="checkbox" name="menu_id[]" id="{{ $value_arr_menu->id_dom }}" value="{{ $value_arr_menu->menu_id }}" {{ $checked_parent }} enabled>
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
                                                                                <input class="form-check-input" type="checkbox" name="menu_id[]" id="{{ $value_arr_menu->id_dom."_".$value_child_menu->id_dom }}" value="{{ $value_child_menu->menu_id }}" {{ $checked_child }} enabled>
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
    // Initialize dropdown settings
    $("#dropdown_toggle_setting").prop('aria-expanded', true);
    $("#dropdown_toggle_setting").addClass('active');
    $("#dropdown_setting").addClass('show');
    $("#logo_setting").addClass("d-none");
    $("#logo_white_setting").removeClass("d-none");
    $("#li_user_group_management").addClass("active");
    $("#a_user_group_management").addClass("active");

    // Form submit handler
    $("#form-save-user-group").on("submit", function (e) {
        e.preventDefault();
        Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger me-2',
                cancelButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            title: 'Are you sure to update this User Group info ?',
            showCancelButton: true,
            cancelButtonText: `No`,
            showConfirmButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isDismissed) {
                Swal.fire('Changes are not saved', '', 'info');
            } else if (result.isConfirmed) {
                const url = $(this).prop('action');
                const _token = $("meta[name='csrf-token']").prop('content');
                const _method = "POST";

                const name = $("#name").val();
                const description = $("#description").val();
                const is_activ = $("#is_activ").val();
                const arr_menu_id = [];

                $("input[name='menu_id[]']").each(function () {
                    const checked = $(this).is(":checked");
                    const menu_id = $(this).val();
                    if (checked) {
                        arr_menu_id.push(menu_id);
                    }
                });

                // Prepare form data
                const formData = new FormData();
                formData.append("_token", _token);
                formData.append("_method", _method);
                formData.append("name", name);
                formData.append("description", description);
                formData.append("is_activ", is_activ);
                formData.append("arr_menu_id", JSON.stringify(arr_menu_id));

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
                        $("#name").removeClass('is-invalid');
                        $("#validation_name").html('');
                        $("#description").removeClass('is-invalid');
                        $("#validation_description").html('');
                        $("#is_activ").removeClass('is-invalid');
                        $("#validation_is_activ").html('');
                    },
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
                        window.location = "{{ route('user_group_management.index') }}";
                    },
                });
            }
        });
    });
});

</script>
@endsection