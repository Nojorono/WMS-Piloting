@extends('layout.app')

@section("title")
Master Warehouse
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
                        <h5 class="me-auto">Master Warehouse - Show</h5>
                        <a href="{{route('master_warehouse.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >List</button>
                        </a>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body py-0">
                                <form method="POST" action="{{ route('master_warehouse.update',['id' => $data["current_data"][0]->wh_code ]) }}" id="form-save-warehouse">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="warehouse_code" class="form-label">Warehouse Code</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_code" name="warehouse_code" value="{{ @$data["current_data"][0]->wh_code }}" readonly>
                                                    <div id="validation_warehouse_code" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="warehouse_prefix" class="form-label">Warehouse Prefix</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_prefix" name="warehouse_prefix" value="{{ @$data["current_data"][0]->wh_prefix }}" readonly>
                                                    <div id="validation_warehouse_prefix" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="warehouse_name" class="form-label">Warehouse Name</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_name" name="warehouse_name" value="{{ @$data["current_data"][0]->wh_name }}">
                                                    <div id="validation_warehouse_name" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="warehouse_address_1" class="form-label">Warehouse Address 1</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_address_1" name="warehouse_address_1" value="{{ @$data["current_data"][0]->address1 }}">
                                                    <div id="validation_warehouse_address_1" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="warehouse_address_2" class="form-label">Warehouse Address 2</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_address_2" name="warehouse_address_2" value="{{ @$data["current_data"][0]->address2 }}">
                                                    <div id="validation_warehouse_address_2" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="warehouse_address_3" class="form-label">Warehouse Address 3</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="warehouse_address_3" name="warehouse_address_3" value="{{ @$data["current_data"][0]->address3 }}">
                                                    <div id="validation_warehouse_address_3" class="invalid-feedback"></div>
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
                                                    <label for="is_rpx_warehouse" class="form-label">is RPX Warehouse ?</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select class="form-select py-0" id="is_rpx_warehouse" name="is_rpx_warehouse" disabled>
                                                        <option value="">Choose</option>
                                                        @if (isset($data["arr_choice_is_rpx_warehouse"]) && count($data["arr_choice_is_rpx_warehouse"]) > 0)
                                                        @foreach ( $data["arr_choice_is_rpx_warehouse"] as $key_choice_is_rpx_warehouse => $value_choice_is_rpx_warehouse )
                                                        @php
                                                            $selected = "";
                                                            if($key_choice_is_rpx_warehouse == @$data["current_data"][0]->is_rpx_wh ){
                                                                $selected = " selected ";
                                                            }
                                                        @endphp
                                                        <option value="{{ $key_choice_is_rpx_warehouse }}" {{ $selected }}> {{ $value_choice_is_rpx_warehouse }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="validation_is_rpx_warehouse" class="invalid-feedback"></div>
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
    $("#li_master_warehouse").addClass("active");
    $("#a_master_warehouse").addClass("active");
    
    $("#form-save-warehouse").on("submit",function (e) {
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
                

                const warehouse_name = $("#warehouse_name").val();
                const warehouse_address_1 = $("#warehouse_address_1").val();
                const warehouse_address_2 = $("#warehouse_address_2").val();
                const warehouse_address_3 = $("#warehouse_address_3").val();
                const city = $("#city").val();
                const country = $("#country").val();
                const zip_code = $("#zip_code").val();
                const phone = $("#phone").val();

                const formData = new FormData();
                formData.append("_token",_token);
                formData.append("_method",_method);
                
                formData.append("warehouse_name",warehouse_name);
                formData.append("warehouse_address_1",warehouse_address_1);
                formData.append("warehouse_address_2",warehouse_address_2);
                formData.append("warehouse_address_3",warehouse_address_3);
                formData.append("city",city);
                formData.append("country",country);
                formData.append("zip_code",zip_code);
                formData.append("phone",phone);

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
                        $("#warehouse_name").removeClass('is-invalid');
                        $("#validation_warehouse_name").html('');
                        $("#warehouse_address_1").removeClass('is-invalid');
                        $("#validation_warehouse_address_1").html('');
                        $("#warehouse_address_2").removeClass('is-invalid');
                        $("#validation_warehouse_address_2").html('');
                        $("#warehouse_address_3").removeClass('is-invalid');
                        $("#validation_warehouse_address_3").html('');
                        $("#city").removeClass('is-invalid');
                        $("#validation_city").html('');
                        $("#country").removeClass('is-invalid');
                        $("#validation_country").html('');
                        $("#zip_code").removeClass('is-invalid');
                        $("#validation_zip_code").html('');
                        $("#phone").removeClass('is-invalid');
                        $("#validation_phone").html('');
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
                        window.location = "{{ route('master_warehouse.index') }}";
                        return;

                    },
                });
            }
        });
    });
});
</script>
@endsection