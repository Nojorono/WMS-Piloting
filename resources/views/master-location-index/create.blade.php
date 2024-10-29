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
                        <h5 class="me-auto">Master Location Index - Create</h5>
                        <a href="{{route('master_location_index.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('master_location_index.store') }}" id="form-save-location-index">
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="index_code" name="index_code" value="{{ @$data['current_data'][0]->index_code }}">
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="index_name" name="index_name" value="{{ @$data['current_data'][0]->index_name }}">
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
                                                    <input type="number" autocomplete="off" class="form-control py-0" id="length" name="length" value="{{ @$data['current_data'][0]->length }}">
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
                                                    <input type="number" autocomplete="off" class="form-control py-0" id="width" name="width" value="{{ @$data['current_data'][0]->width }}">
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
                                                    <input type="number" autocomplete="off" class="form-control py-0" id="height" name="height" value="{{ @$data['current_data'][0]->height }}">
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
                                                    <input type="number" autocomplete="off" class="form-control py-0" id="capacity" name="capacity" value="{{ @$data['current_data'][0]->capacity }}">
                                                    <div id="validation_capacity" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <button type="submit" class="btn btn-primary text-xs py-1 mb-0">Save</button>
                        </div>
                    </form>
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

    

    $("#form-save-location-index").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        const index_code = $("#index_code").val();
        const index_name = $("#index_name").val();
        const length = $("#length").val();
        const width = $("#width").val();
        const height = $("#height").val();
        const capacity = $("#capacity").val();

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("index_code",index_code);
        formData.append("index_name",index_name);
        formData.append("length",length);
        formData.append("width",width);
        formData.append("height",height);
        formData.append("capacity", capacity);
        

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
                
                $("#index_code").removeClass('is-invalid');
                $("#validation_index_code").html('');
                $("#index_name").removeClass('is-invalid');
                $("#validation_index_name").html('');
                $("#length").removeClass('is-invalid');
                $("#validation_length").html('');
                $("#width").removeClass('is-invalid');
                $("#validation_width").html('');
                $("#height").removeClass('is-invalid');
                $("#validation_height").html('');
                $("#capacity").removeClass('is-invalid');
                $("#validation_capacity").html('');
                
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
                    text: 'Something Wrong',
                    type: 'error',
                    icon: 'error',
                });
            },
            complete: function () {

            },
            success: function (response) {
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
                window.location = "{{ route('master_location_index.index') }}";
                return;

            },
        });
        
    });
});
</script>
@endsection