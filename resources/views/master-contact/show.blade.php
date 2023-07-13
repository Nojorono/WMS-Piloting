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
                        <h5 class="me-auto">Master Contact - Show</h5>
                        <a href="{{route('master_contact.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                        <a href="{{route('master_contact.edit' , ['id' => @$data["current_data_header"][0]->contact_id,])}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >Edit</button>
                        </a>
                    </div>
                    <hr>
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
                                                <select class="form-select py-0" id="project_name" name="project_name" disabled>
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
                                            <div class="col-sm-12">
                                                <input type="hidden" id="supplier_id" name="supplier_id" value="{{ @$data["current_data_header"][0]->supplier_id }}" readonly>
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ @$data["current_data_header"][0]->supplier_name }}" readonly>
                                                <div id="validation_supplier_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkbox_status" {{ (@$data["current_data_header"][0]->is_active == "Y") ? "checked" : "" }} disabled> Active
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
                                                    <input class="form-check-input" type="checkbox" id="checkbox_email" {{ (count(@$data["current_data_detail_email"]) > 0 ) ? "checked" : "" }}  disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="notification_email_address" class="form-label text-xs m-0">Email</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="notification_email_address" name="notification_email_address" value="{{ (count(@$data["current_data_detail_email"]) > 0 ) ? @$data["current_data_detail_email"][0]->notification_address : "" }}" placeholder="Insert Email Address" disabled>
                                                <div id="validation_notification_email_address" class="invalid-feedback"></div>

                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-2">
                                            <div class="col-sm-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkbox_whatsapp" {{ (count(@$data["current_data_detail_whatsapp"]) > 0 ) ? "checked" : "" }}  disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="notification_whatsapp_address" class="form-label text-xs m-0">Whatsapp</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="notification_whatsapp_address" name="notification_whatsapp_address" value="{{ (count(@$data["current_data_detail_whatsapp"]) > 0 ) ? @$data["current_data_detail_whatsapp"][0]->notification_address : "" }}" placeholder="Insert Phone Number" disabled>
                                                <div id="validation_notification_whatsapp_address" class="invalid-feedback"></div>

                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkbox_apps_inbox" {{ (count(@$data["current_data_detail_apps_inbox"]) > 0 ) ? "checked" : "" }}  disabled>
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
    $("#li_master_contact").addClass("active");
    $("#a_master_contact").addClass("active");
});
</script>
@endsection