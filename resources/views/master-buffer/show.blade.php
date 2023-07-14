@extends('layout.app')

@section("title")
Master Buffer
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
                        <h5 class="me-auto">Master Buffer - Show</h5>
                        <a href="{{route('master_buffer.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >List</button>
                        </a>
                        <a href="{{route('master_buffer.edit' , ['id' => @$data['current_data'][0]->buffer_id, ])}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >Edit</button>
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
                                                <label for="buffer_id" class="form-label text-xs">Buffer ID</label>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-6">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="buffer_id" name="buffer_id" value="{{ @$data['current_data'][0]->buffer_id }}" readonly>
                                                <div id="validation_buffer_id" class="invalid-feedback"></div>
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
                                                <label for="contact_id" class="form-label text-xs">Contact</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="contact_id" name="contact_id" value="{{ @$data['current_data'][0]->contact_id }}" readonly>
                                                <div id="validation_contact_id" class="invalid-feedback"></div>
                                            </div>
                                            {{-- <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 py-1 mb-0 rounded" name="btn_search_contact" id="btn_search_contact"><i class="bi bi-search"></i></button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="sku" class="form-label text-xs">SKU</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="sku" name="sku" value="{{ @$data['current_data'][0]->sku }}" readonly>
                                                <div id="validation_sku" class="invalid-feedback"></div>
                                            </div>
                                            {{-- <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 py-1 mb-0 rounded" name="btn_search_sku" id="btn_search_sku"><i class="bi bi-search"></i></button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="buffer_qty" class="form-label text-xs">Buffer Qty</label>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-6">
                                                <input type="number" autocomplete="off" class="form-control py-0" id="buffer_qty" name="buffer_qty" value="{{ @$data['current_data'][0]->qty_buffer }}" readonly>
                                                <div id="validation_buffer_qty" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="rules" class="form-label text-xs">Rules</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="rules" name="rules" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["list_rules"]) && count($data["list_rules"]) > 0)
                                                    @php
                                                        $selected_rules = "";
                                                        @endphp
                                                    @foreach ($data["list_rules"] as $list_rules)
                                                    @php
                                                        if(@$data['current_data'][0]->rules_id == $list_rules->rules_id ){
                                                            $selected_rules = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $list_rules->rules_id }}" {{ $selected_rules }} >{{ $list_rules->desc }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_rules" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="messages" class="form-label text-xs">Messages</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <textarea class="form-control py-0" id="messages" style="height: 100px" name="messages" readonly>{{ @$data['current_data'][0]->messages }}</textarea>
                                                <div id="validation_messages" class="invalid-feedback"></div>
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
    $("#logo_master").addClass("d-none");
    $("#logo_white_master").removeClass("d-none");
    $("#li_master_buffer").addClass("active");
    $("#a_master_buffer").addClass("active");
});
</script>
@endsection