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
                        <h5 class="me-auto">Master Supplier - Show</h5>
                        <a href="{{route('master_supplier.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >List</button>
                        </a>
                        <a href="{{route('master_supplier.edit' , ['id' => @$data["current_data"][0]->supplier_id ])}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >Edit</button>
                        </a>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 mb-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="supplier_id" class="form-label text-xs">Supplier ID</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_id" name="supplier_id" value="{{ @$data["current_data"][0]->supplier_id }}" readonly>
                                                <div id="validation_supplier_id" class="invalid-feedback"></div>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_name" name="supplier_name" value="{{ @$data["current_data"][0]->supplier_name }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address1" name="supplier_address1" value="{{ @$data["current_data"][0]->address1 }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address2" name="supplier_address2" value="{{ @$data["current_data"][0]->address2 }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="supplier_address3" name="supplier_address3" value="{{ @$data["current_data"][0]->address3 }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="city" name="city" value="{{ @$data["current_data"][0]->city }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="contact_person" name="contact_person" value="{{ @$data["current_data"][0]->contact_person }}" readonly>
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
                                                <input type="text" autocomplete="off" class="form-control py-0" id="phone" name="phone" value="{{ @$data["current_data"][0]->phone }}" readonly>
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
                                                <select class="form-select py-0" id="client" name="client" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_client"]) && count($data["arr_choice_client"]) > 0)
                                                    @foreach ( $data["arr_choice_client"] as $key_choice_client => $value_choice_client )
                                                    @php
                                                        $selected_choice_client = "";
                                                        if(@$data["current_data"][0]->client_id == $value_choice_client->client_id){
                                                            $selected_choice_client = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_client->client_id }}" {{ $selected_choice_client }}> {{ $value_choice_client->client_name }}</option>
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
});
</script>
@endsection