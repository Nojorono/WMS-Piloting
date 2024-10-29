@extends('layout.app')

@section("title")
Master Project
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
                        <h5 class="me-auto">Master Project - Create</h5>
                        <a href="{{route('master_project.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('master_project.store') }}" id="form-save-project">
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="project_id" class="form-label text-xs">Project ID</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="project_id" name="project_id" value="" readonly>
                                                    <div id="validation_project_id" class="invalid-feedback"></div>
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
                                                    <label for="project_name" class="form-label text-xs">Project Name</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="project_name" name="project_name" value="">
                                                    <div id="validation_project_name" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="project_address_1" class="form-label text-xs">Project Address 1</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="project_address_1" name="project_address_1" value="">
                                                    <div id="validation_project_address_1" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="project_address_2" class="form-label text-xs">Project Address 2</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="project_address_2" name="project_address_2" value="">
                                                    <div id="validation_project_address_2" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="project_address_3" class="form-label text-xs">Project Address 3</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="project_address_3" name="project_address_3" value="">
                                                    <div id="validation_project_address_3" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <label for="country" class="form-label text-xs">Country</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="country" name="country" value="">
                                                    <div id="validation_country" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="zip_code" class="form-label text-xs">Zip Code</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="zip_code" name="zip_code" value="">
                                                    <div id="validation_zip_code" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
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
                                                    <label for="project_type" class="form-label text-xs">Project Type</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select class="form-select py-0" id="project_type" name="project_type">
                                                        <option value="">Select Project Type</option>
                                                        @if (isset($data['arr_project_type']) && count($data['arr_project_type']) > 0)
                                                        @foreach ( $data['arr_project_type'] as $project_type )
                                                        <option value="{{ $project_type->project_type_id }}">{{ $project_type->project_type_name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="validation_project_type" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="client_name" class="form-label text-xs">Client Name</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <input type="hidden" id="client_id" name="client_id" value="" >
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="client_name" name="client_name" value="" readonly>
                                                    <div id="validation_client_name" class="invalid-feedback"></div>
                                                </div>
                                                <div class="col-sm-2 ps-0 text-end">
                                                    <button type="button" class="btn btn-primary mb-0 py-1 rounded" name="btn_search_client" id="btn_search_client"><i class="bi bi-search"></i></button>
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

<div class="modal fade" id="modal-ClientName" tabindex="-1" aria-labelledby="modal-ClientNameLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ClientNameLabel">Client - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-ClientName">
                        <thead>
                            <tr>
                                <th class="text-xs">Client ID</th>
                                <th class="text-xs">Client Name</th>
                                <th class="text-xs">Address</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script src="{{ asset('js/plugins/choices.min.js') }}"></script>
<script type="text/javascript">

$(document).ready(function () {
    $("#dropdown_toggle_master").prop('aria-expanded',true);
    $("#dropdown_toggle_master").addClass('active');
    $("#dropdown_master").addClass('show');
    $("#logo_master").addClass("d-none");
    $("#logo_white_master").removeClass("d-none");
    $("#li_master_project").addClass("active");
    $("#a_master_project").addClass("active");
    
    const select_warehouse = new Choices( document.getElementById('warehouse'), {
        removeItemButton: true
    });

    $("#btn_search_client").on("click",function () {
        $("#modal-ClientName").modal('show');
        $("#list-datatable-modal-ClientName").DataTable().destroy();
        $("#list-datatable-modal-ClientName").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('master_project.datatablesClientName') }}",
            columns:[
                {data: 'client_id', searchable: true,  className:'text-xs'},
                {data: 'client_name', searchable: true,  className:'text-xs'},
                {data: 'address', searchable: true,  className:'text-xs'},
            ],
        });
    });

    $("#list-datatable-modal-ClientName > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const client_id = $($(dom_tr).children("td")[0]).text();
        const client_name = $($(dom_tr).children("td")[1]).text(); 

        $("#client_id").val(client_id);
        $("#client_name").val(client_name);

        $("#modal-ClientName").modal('hide');
    });
    
    
    
    $("#form-save-project").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        
        const project_name = $("#project_name").val();
        const project_address_1 = $("#project_address_1").val();
        const project_address_2 = $("#project_address_2").val();
        const project_address_3 = $("#project_address_3").val();
        const city = $("#city").val();
        const country = $("#country").val();
        const zip_code = $("#zip_code").val();
        const phone = $("#phone").val();
        const project_type = $("#project_type").val();
        const client_id = $("#client_id").val();
        const client_name = $("#client_name").val();
        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("project_name",project_name);
        formData.append("project_address_1",project_address_1);
        formData.append("project_address_2",project_address_2);
        formData.append("project_address_3",project_address_3);
        formData.append("city",city);
        formData.append("country",country);
        formData.append("zip_code",zip_code);
        formData.append("phone",phone);
        formData.append("project_type",project_type);
        formData.append("client_id",client_id);
        formData.append("client_name",client_name);
    
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
                $("#project_name").removeClass('is-invalid');
                $("#validation_project_name").html('');
                $("#project_address_1").removeClass('is-invalid');
                $("#validation_project_address_1").html('');
                $("#project_address_2").removeClass('is-invalid');
                $("#validation_project_address_2").html('');
                $("#project_address_3").removeClass('is-invalid');
                $("#validation_project_address_3").html('');
                $("#city").removeClass('is-invalid');
                $("#validation_city").html('');
                $("#country").removeClass('is-invalid');
                $("#validation_country").html('');
                $("#zip_code").removeClass('is-invalid');
                $("#validation_zip_code").html('');
                $("#phone").removeClass('is-invalid');
                $("#validation_phone").html('');
               
                $("#project_type").removeClass('is-invalid');
                $("#validation_project_type").html('');
                $("#client_name").removeClass('is-invalid');
                $("#validation_client_name").html('');
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
                    // type: 'error',
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
                window.location = "{{ route('master_project.index') }}";
                return;

            },
        });
        
    });
});
</script>
@endsection