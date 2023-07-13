@extends('layout.app')

@section("title")
Master Commodity
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
                        <h5 class="me-auto">Master Commodity - Edit</h5>
                        <a href="{{route('master_commodity.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('master_commodity.update',['id' => @$data["current_data"][0]->commodity_id ]) }}" id="form-save-commodity">
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="commodity_name" class="form-label text-xs">Commodity Name</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="commodity_name" name="commodity_name" value="{{ @$data['current_data'][0]->commodity_name }}">
                                                    <div id="validation_commodity_name" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="commodity_desc" class="form-label text-xs">Commodity Desc</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <textarea class="form-control py-0" id="commodity_desc" name="commodity_desc" cols="30" rows="5">{{ @$data['current_data'][0]->commodity_desc }}</textarea>
                                                    <div id="validation_commodity_desc" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <button type="submit" class="btn btn-primary text-xs py-1 mb-0">Update</button>
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
    $("#li_master_commodity").addClass("active");
    $("#a_master_commodity").addClass("active");

   
    
    $("#form-save-commodity").on("submit",function (e) {
        e.preventDefault();
        Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger me-2',
                cancelButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            title: 'Are you sure to update this warehouse info ?',
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

                const commodity_name = $("#commodity_name").val();
                const commodity_desc = $("#commodity_desc").val();

                const formData = new FormData();
                formData.append("_token",_token);
                formData.append("_method",_method);
                formData.append("commodity_name",commodity_name);
                formData.append("commodity_desc",commodity_desc);

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
                        $("#commodity_name").removeClass('is-invalid');
                        $("#validation_commodity_name").html('');
                        $("#commodity_desc").removeClass('is-invalid');
                        $("#validation_commodity_desc").html('');
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
                        window.location = "{{ route('master_commodity.index') }}";
                        return;

                    },
                });
            }
        });
    });
});
</script>
@endsection