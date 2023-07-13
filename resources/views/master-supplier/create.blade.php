@extends('layout.app')

@section("title")
Master Supplier
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
                        <h5 class="me-auto">Master Supplier - Create</h5>
                        <a href="{{route('master_supplier.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('master_supplier.store') }}" id="form-save-supplier">
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="supplier_id" class="form-label text-xs">Supplier ID</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="supplier_id" name="supplier_id" value="" readonly>
                                                    <div id="validation_supplier_id" class="invalid-feedback"></div>
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
                                                    <label for="supplier_name" class="form-label text-xs">Supplier Name</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="">
                                                    <div id="validation_supplier_name" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="supplier_address1" class="form-label text-xs">Supplier Address1</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address1" name="supplier_address1" value="">
                                                    <div id="validation_supplier_address1" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="supplier_address2" class="form-label text-xs">Supplier Address2</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address2" name="supplier_address2" value="">
                                                    <div id="validation_supplier_address2" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="supplier_address3" class="form-label text-xs">Supplier Address3</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address3" name="supplier_address3" value="">
                                                    <div id="validation_supplier_address3" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="city" class="form-label text-xs">City</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="city" name="city" value="">
                                                    <div id="validation_city" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="contact_person" class="form-label text-xs">Contact Person</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="contact_person" name="contact_person" value="">
                                                    <div id="validation_contact_person" class="invalid-feedback"></div>
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
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="client" class="form-label text-xs">Client Name</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select class="form-select py-0" id="client" name="client">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["arr_choice_client"]) && count($data["arr_choice_client"]) > 0)
                                                        @foreach ( $data["arr_choice_client"] as $key_choice_client => $value_choice_client )
                                                        <option value="{{ $value_choice_client->client_id }}"> {{ $value_choice_client->client_name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="validation_client" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <button type="submit" class="btn btn-primary mb-0 py-1">Save</button>
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
    $("#li_master_supplier").addClass("active");
    $("#a_master_supplier").addClass("active");

    $("#form-save-supplier").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        
        const supplier_name = $("#supplier_name").val();
        const supplier_address1 = $("#supplier_address1").val();
        const supplier_address2 = $("#supplier_address2").val();
        const supplier_address3 = $("#supplier_address3").val();
        const city = $("#city").val();
        const contact_person = $("#contact_person").val();
        const phone = $("#phone").val();
        const client = $("#client").val();

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        
        formData.append("supplier_name",supplier_name);
        formData.append("supplier_address1",supplier_address1);
        formData.append("supplier_address2",supplier_address2);
        formData.append("supplier_address3",supplier_address3);
        formData.append("city",city);
        formData.append("contact_person",contact_person);
        formData.append("phone",phone);
        formData.append("client",client);

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
                $("#supplier_name").removeClass('is-invalid');
                $("#validation_supplier_name").html('');
                $("#supplier_address1").removeClass('is-invalid');
                $("#validation_supplier_address1").html('');
                $("#supplier_address2").removeClass('is-invalid');
                $("#validation_supplier_address2").html('');
                $("#supplier_address3").removeClass('is-invalid');
                $("#validation_supplier_address3").html('');
                $("#city").removeClass('is-invalid');
                $("#validation_city").html('');
                $("#contact_person").removeClass('is-invalid');
                $("#validation_contact_person").html('');
                $("#phone").removeClass('is-invalid');
                $("#validation_phone").html('');
                $("#client").removeClass('is-invalid');
                $("#validation_client").html('');
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
                window.location = "{{ route('master_supplier.index') }}";
                return;

            },
        });
        
    });
});
</script>
@endsection