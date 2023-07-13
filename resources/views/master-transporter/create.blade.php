@extends('layout.app')

@section("title")
Master Transporter
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
                        <h5 class="me-auto">Master Transporter - Create</h5>
                        <a href="{{route('master_transporter.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('master_transporter.store') }}" id="form-save-transporter">
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="transporter_id" class="form-label text-xs">Transporter ID</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="transporter_id" name="transporter_id" value="" readonly>
                                                    <div id="validation_transporter_id" class="invalid-feedback"></div>
                                                </div>
                                                <div class="col-sm-6 text-xs">
                                                    Auto Generated
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="transporter_name" class="form-label text-xs">Transporter Name</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="transporter_name" name="transporter_name" value="">
                                                    <div id="validation_transporter_name" class="invalid-feedback"></div>
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
    $("#li_master_transporter").addClass("active");
    $("#a_master_transporter").addClass("active");

    $("#form-save-transporter").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        
        const transporter_name = $("#transporter_name").val();

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("transporter_name",transporter_name);

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
                $("#transporter_name").removeClass('is-invalid');
                $("#validation_transporter_name").html('');
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
                window.location = "{{ route('master_transporter.index') }}";
                return;

            },
        });
        
    });
});
</script>
@endsection