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
                        <h5 class="me-auto">User Group Management - Create</h5>
                        <a href="{{route('user_group_management.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" >List</button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('user_group_management.store') }}" id="form-save-user-group">
                    <!-- <form id="form-save-user-group"> -->
                    @csrf
                    @method('POST')
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="user_group_id" name="user_group_id" value="{{ @$data["user_group_id"][0]->id + 1 }}" readonly>
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="name" name="name">
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
                                                    <input type="description" autocomplete="off" class="form-control py-0" id="description" name="description" >
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
                        </div>
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
    $("#li_user_group_management").addClass("active");
    $("#a_user_group_management").addClass("active");

    // const select_project = new Choices( document.getElementById('project'), {
    //     removeItemButton: true
    // });

    $("#form-save-user-group").on("submit",function (e) {

        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        
        
        const user_group_id = $("#user_group_id").val();
        const name = $("#name").val();
        const description = $("#description").val();
        const is_activ = $("#is_activ").val();
        const arr_menu_id = [];
        
        $("input[name*='menu_id']").each(function () {
            const checked = $(this).is(":checked");
            const menu_id = $(this).val();
            if(checked){
                arr_menu_id.push(menu_id)
            }
        });
        console.log('arr_menu_id:', arr_menu_id);

        // temp_project.forEach(element => {
        //     arr_project.push(element);
        // });

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);

        formData.append("user_group_id",user_group_id);
        formData.append("name",name);
        formData.append("description",description);
        formData.append("is_activ",is_activ);
        formData.append("arr_menu_id",JSON.stringify(arr_menu_id));

        console.log('arr_menu_id before AJAX request:', arr_menu_id);

        $.ajax({
            url:url,
            method: _method,
            type: _method,
            // data: form_data,
            // dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#user_group_id").removeClass('is-invalid');
                $("#validation_user_group_id").html('');
                $("#name").removeClass('is-invalid');
                $("#validation_name").html('');
                $("#description").removeClass('is-invalid');
                $("#validation_description").html('');
                $("#is_activ").removeClass('is-invalid');
                $("#validation_is_activ").html('');
            },
            error: function (error) {
                console.log('ERROR');
                console.log('res_error', error);

                
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: 'Something Wrong',
                    type: 'error',
                    icon: 'error',
                });
            },
            complete: function () {

            },
            success: function (response) {
                console.log('SUCCESS');
                console.log('response', response);


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
                        type: 'error',
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
                return;

            },
        });
        
    });
});
</script>
@endsection