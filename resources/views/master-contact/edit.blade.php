@extends('layout.app')

@section("title")
Master Contact
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
                        <h5 class="me-auto">Master Contact - Edit</h5>
                        <a href="{{route('master_contact.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary py-1 mb-0" >List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('master_contact.update',['id' => @$data["current_data_header"][0]->contact_id,]) }}" id="form-save-contact">
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="contact_id" class="form-label text-xs">ID</label>
                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-sm-6">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="contact_id" name="contact_id" value="{{ @$data["current_data_header"][0]->contact_id }}" readonly>
                                                    <div id="validation_contact_id" class="invalid-feedback"></div>
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
                                                    <select class="form-select py-0" id="project_name" name="project_name">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["list_project"]) && count($data["list_project"]) > 0)
                                                        @php
                                                            $selected_list_project = "";
                                                        @endphp
                                                        @foreach ($data["list_project"] as $list_project)
                                                        @php
                                                            if(@$data["current_data_header"][0]->client_project_id == $list_project->client_project_id ){
                                                                $selected_list_project = " selected ";
                                                            }
                                                        @endphp
                                                        <option value="{{ $list_project->client_project_id }}" {{ $selected_list_project }}>{{ $list_project->client_project_name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="validation_project_name" class="invalid-feedback"></div>
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
                                                <div class="col-sm-10">
                                                    <input type="hidden" id="supplier_id" name="supplier_id" value="{{ @$data["current_data_header"][0]->supplier_id }}" readonly>
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ @$data["current_data_header"][0]->supplier_name }}" readonly>
                                                    <div id="validation_supplier_name" class="invalid-feedback"></div>
                                                </div>
                                                <div class="col-sm-2 ps-0">
                                                    <button type="button" class="btn btn-primary mb-0 py-1 rounded" name="btn_search_supplier_name" id="btn_search_supplier_name"><i class="bi bi-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkbox_status" {{ (@$data["current_data_header"][0]->is_active == "Y") ? "checked" : "" }}> <span class="text-xs">Active</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="" class="form-label text-xs">Notification Type And Notification Address</label>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-2">
                                                <div class="col-sm-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkbox_email" {{ (count(@$data["current_data_detail_email"]) > 0 ) ? "checked" : "" }}  {{ (count(@$data["current_data_detail_email"]) == 0 ) ? "disabled" : "" }} >
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="notification_email_address" class="form-label text-xs m-0">Email</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="notification_email_address" name="notification_email_address" value="{{ (count(@$data["current_data_detail_email"]) > 0 ) ? @$data["current_data_detail_email"][0]->notification_address : "" }}" placeholder="Insert Email Address" {{ (count(@$data["current_data_detail_email"]) == 0 ) ? "disabled" : "" }} >
                                                    <div id="validation_notification_email_address" class="invalid-feedback"></div>
    
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-2">
                                                <div class="col-sm-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkbox_whatsapp" {{ (count(@$data["current_data_detail_whatsapp"]) > 0 ) ? "checked" : "" }} {{ (count(@$data["current_data_detail_whatsapp"]) == 0 ) ? "disabled" : "" }} >
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="notification_whatsapp_address" class="form-label text-xs m-0">Whatsapp</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="notification_whatsapp_address" name="notification_whatsapp_address" value="{{ (count(@$data["current_data_detail_whatsapp"]) > 0 ) ? @$data["current_data_detail_whatsapp"][0]->notification_address : "" }}" placeholder="Insert Phone Number" {{ (count(@$data["current_data_detail_whatsapp"]) == 0 ) ? "disabled" : "" }} >
                                                    <div id="validation_notification_whatsapp_address" class="invalid-feedback"></div>
    
                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-sm-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkbox_apps_inbox" {{ (count(@$data["current_data_detail_apps_inbox"]) > 0 ) ? "checked" : "" }} >
                                                    </div>
                                                </div>
                                                <div class="col-sm-11">
                                                    <label for="" class="form-label text-xs m-0">Apps Inbox</label>
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

<div class="modal fade" id="modal-supplier-name" tabindex="-1" aria-labelledby="modal-Supplier-NameLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-Supplier-NameLabel">Supplier Name - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-supplier-name">
                        <thead>
                            <tr>
                                <th class="text-xs">Supplier ID</th>
                                <th class="text-xs">Supplier Name</th>
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
<script type="text/javascript">

$(document).ready(function () {
    $("#dropdown_toggle_master").prop('aria-expanded',true);
    $("#dropdown_toggle_master").addClass('active');
    $("#dropdown_master").addClass('show');
    $("#li_master_contact").addClass("active");
    $("#a_master_contact").addClass("active");

    $("#checkbox_email").on('click', function() {
        let isChecked = $(this).attr('checked')
        if(isChecked){
            $(this).removeAttr('checked')
            $("#notification_email_address").attr('disabled', '')
            $("#notification_email_address").val('')
        } else {
            $(this).attr('checked', '') 
            $("#notification_email_address").removeAttr('disabled')
        }
    })
    $("#checkbox_whatsapp").on('click', function() {
        let isChecked = $(this).attr('checked')
        if(isChecked){
            $(this).removeAttr('checked')
            $("#notification_whatsapp_address").attr('disabled', '')
            $("#notification_whatsapp_address").val('')
        } else {
            $(this).attr('checked', '') 
            $("#notification_whatsapp_address").removeAttr('disabled')
        }
    })

    $("#btn_search_supplier_name").on("click",function () {
        $("#modal-supplier-name").modal('show');
        $("#list-datatable-modal-supplier-name").DataTable().destroy();
        $("#list-datatable-modal-supplier-name").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('master_contact.datatablesSupplier') }}",
            columns:[
                {data: 'supplier_id', searchable: true, className:"text-xs"},
                {data: 'supplier_name', searchable: true, className:"text-xs"},
            ],
        });
    });

    $("#list-datatable-modal-supplier-name > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const supplier_id = $($(dom_tr).children("td")[0]).text();
        const supplier_name = $($(dom_tr).children("td")[1]).text();

        $("#supplier_id").val(supplier_id);
        $("#supplier_name").val(supplier_name);

        $("#modal-supplier-name").modal('hide');
    });
   
    
    $("#form-save-contact").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";
        
        const project_name = $("#project_name").val();
        const supplier_id = $("#supplier_id").val();
        const supplier_name = $("#supplier_name").val();
        const notification_email_address = $("#notification_email_address").val();
        const notification_whatsapp_address = $("#notification_whatsapp_address").val();
        const checkbox_email = ($("#checkbox_email").is(':checked')) ? "Y" : "N";
        const checkbox_whatsapp = ($("#checkbox_whatsapp").is(':checked')) ? "Y" : "N";
        const checkbox_apps_inbox = ($("#checkbox_apps_inbox").is(':checked')) ? "Y" : "N";
        const checkbox_status = ($("#checkbox_status").is(':checked')) ? "Y" : "N";

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);

        formData.append("project_name",project_name);
        formData.append("supplier_id",supplier_id);
        formData.append("supplier_name",supplier_name);
        formData.append("notification_email_address",notification_email_address);
        formData.append("notification_whatsapp_address",notification_whatsapp_address);
        formData.append("checkbox_email",checkbox_email);
        formData.append("checkbox_whatsapp",checkbox_whatsapp);
        formData.append("checkbox_apps_inbox",checkbox_apps_inbox);
        formData.append("checkbox_status",checkbox_status);
        
        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#project_name").removeClass('is-invalid');
                $("#validation_project_name").html('');
                $("#supplier_id").removeClass('is-invalid');
                $("#validation_supplier_id").html('');
                $("#supplier_name").removeClass('is-invalid');
                $("#validation_supplier_name").html('');
                $("#notification_email_address").removeClass('is-invalid');
                $("#validation_notification_email_address").html('');
                $("#notification_whatsapp_address").removeClass('is-invalid');
                $("#validation_notification_whatsapp_address").html('');
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
                window.location = "{{ route('master_contact.index') }}";
                return;

            },
        });
    });
});
</script>
@endsection