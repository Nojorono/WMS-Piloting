@extends('layout.app')

@section("title")
Master Client
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
                        <h5 class="me-auto">Master Client - Edit</h5>
                        <a href="{{route('master_client.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >List</button>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('master_client.update',['id' => $data["current_data"][0]->client_id ]) }}" id="form-save-client">
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_id" class="form-label">Client ID</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_id" name="client_id" value="{{ @$data["current_data"][0]->client_id }}" disabled>
                                                <div id="validation_client_id" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_name" class="form-label">Client Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="{{ @$data["current_data"][0]->client_name }}">
                                                <div id="validation_client_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_address_1" class="form-label">Client Address 1</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_address_1" name="client_address_1" value="{{ @$data["current_data"][0]->address1 }}">
                                                <div id="validation_client_address_1" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_address_2" class="form-label">Client Address 2</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_address_2" name="client_address_2" value="{{ @$data["current_data"][0]->address2 }}">
                                                <div id="validation_client_address_2" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="client_address_3" class="form-label">Client Address 3</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="client_address_3" name="client_address_3" value="{{ @$data["current_data"][0]->address3 }}">
                                                <div id="validation_client_address_3" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="city" class="form-label">City</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="city" name="city" value="{{ @$data["current_data"][0]->city }}">
                                                <div id="validation_city" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="country" class="form-label">Country</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="country" name="country" value="{{ @$data["current_data"][0]->country }}">
                                                <div id="validation_country" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="zip_code" class="form-label">Zip Code</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="zip_code" name="zip_code" value="{{ @$data["current_data"][0]->postal_code }}">
                                                <div id="validation_zip_code" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="phone" class="form-label">Phone</label>
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
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="methods" class="form-label">Methods</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="methods" name="methods" disabled>
                                                    <option value="">Select Methods</option>
                                                    @if (isset($data['arr_methods']) && count($data['arr_methods']) > 0)
                                                    
                                                    @foreach ( $data['arr_methods'] as $methods )
                                                    @php
                                                        $selected = "";
                                                        if($methods->methods_id == @$data["current_data"][0]->methods_id){
                                                            $selected = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $methods->methods_id }}" {{$selected}}>{{ $methods->methods_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_methods" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <button type="submit" class="btn btn-primary mb-0 py-1">Update</button>
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
    $("#li_master_client").addClass("active");
    $("#a_master_client").addClass("active");

    $("#form-save-client").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        
        const client_name = $("#client_name").val();
        const client_address_1 = $("#client_address_1").val();
        const client_address_2 = $("#client_address_2").val();
        const client_address_3 = $("#client_address_3").val();
        const city = $("#city").val();
        const country = $("#country").val();
        const zip_code = $("#zip_code").val();
        const phone = $("#phone").val();

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("client_name",client_name);
        formData.append("client_address_1",client_address_1);
        formData.append("client_address_2",client_address_2);
        formData.append("client_address_3",client_address_3);
        formData.append("city",city);
        formData.append("country",country);
        formData.append("zip_code",zip_code);
        formData.append("phone",phone);
    
        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#client_id").removeClass('is-invalid');
                $("#validation_client_id").html('');
                $("#client_name").removeClass('is-invalid');
                $("#validation_client_name").html('');
                $("#client_address_1").removeClass('is-invalid');
                $("#validation_client_address_1").html('');
                $("#client_address_2").removeClass('is-invalid');
                $("#validation_client_address_2").html('');
                $("#client_address_3").removeClass('is-invalid');
                $("#validation_client_address_3").html('');
                $("#city").removeClass('is-invalid');
                $("#validation_city").html('');
                $("#country").removeClass('is-invalid');
                $("#validation_country").html('');
                $("#zip_code").removeClass('is-invalid');
                $("#validation_zip_code").html('');
                $("#phone").removeClass('is-invalid');
                $("#validation_phone").html('');
                $("#methods").removeClass('is-invalid');
                $("#validation_methods").html('');
            },
            error: function (error) {
                Swal
                .mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                            confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                            confirmButton: 'btn btn-primary mb-0 py-1 me-2',
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
                        confirmButton: 'btn btn-primary mb-0 py-1 me-2',
                    },
                    buttonsStyling: false,
                })
                .fire({
                    text: `${response.message}`,
                    type: 'success',
                    icon: 'success',
                });
                window.location = "{{ route('master_client.index') }}";
                return;

            },
        });
        
    });
});
</script>
@endsection