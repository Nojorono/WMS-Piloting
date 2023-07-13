@extends('layout.app')

@section("title")
Master Item
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
                        <h5 class="me-auto">Master Item - Show</h5>
                        <a href="{{route('master_item.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >List</button>
                        </a>
                        <a href="{{route('master_item.edit' , ['id' => @$data["current_data"][0]->sku ])}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >Edit</button>
                        </a>
                    </div>
                    <hr>
                    <div class="col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="sku" class="form-label text-xs">SKU</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="sku" name="sku" value="{{ @$data["current_data"][0]->sku }}" readonly>
                                                <div id="validation_sku" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="part_name" class="form-label text-xs">Part Name</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="part_name" name="part_name" value="{{ @$data["current_data"][0]->part_name }}" readonly>
                                                <div id="validation_part_name" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="imei" class="form-label text-xs">IMEI</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="imei" name="imei" value="{{ @$data["current_data"][0]->imei }}" readonly>
                                                <div id="validation_imei" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="length" class="form-label text-xs">Length</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="length" name="length" value="{{ @$data["current_data"][0]->length }}" readonly>
                                                <div id="validation_length" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="part_no" class="form-label text-xs">Part No</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="part_no" name="part_no" value="{{ @$data["current_data"][0]->part_no }}" readonly>
                                                <div id="validation_part_no" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="width" class="form-label text-xs">Width</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="width" name="width" value="{{ @$data["current_data"][0]->width }}" readonly>
                                                <div id="validation_width" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="color" class="form-label text-xs">Color</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="color" name="color" value="{{ @$data["current_data"][0]->color }}" readonly>
                                                <div id="validation_color" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="height" class="form-label text-xs">Height</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="height" name="height" value="{{ @$data["current_data"][0]->height }}" readonly>
                                                <div id="validation_height" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="size" class="form-label text-xs">Size</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="size" name="size" value="{{ @$data["current_data"][0]->size }}" readonly>
                                                <div id="validation_size" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="volume" class="form-label text-xs">Volume</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="volume" name="volume" value="{{ @$data["current_data"][0]->volume }}" readonly>
                                                <div id="validation_volume" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="uom" class="form-label text-xs">UoM</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="uom" name="uom" value="{{ @$data["current_data"][0]->base_uom }}" readonly>
                                                <div id="validation_uom" class="invalid-feedback"></div>
                                            </div>
                                            {{-- <div class="col-sm-2 ps-0">
                                                <button type="button" class="btn btn-primary mb-0 py-1 mb-0 rounded" name="btn_search_uom" id="btn_search_uom"><i class="bi bi-search"></i></button>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="directions" class="form-label text-xs">Directions</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" autocomplete="off" class="form-control py-0" id="directions" name="directions" value="{{ @$data["current_data"][0]->directions }}" readonly>
                                                <div id="validation_directions" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="warehouse" class="form-label text-xs">Warehouse</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="warehouse" name="warehouse" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_warehouse"]) && count($data["arr_choice_warehouse"]) > 0)
                                                    @foreach ( $data["arr_choice_warehouse"] as $key_choice_warehouse => $value_choice_warehouse )
                                                    @php
                                                        $selected_choice_warehouse = "";
                                                        if(@$data["current_data"][0]->wh_id == $value_choice_warehouse->wh_id){
                                                            $selected_choice_warehouse = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_warehouse->wh_id }}" {{ $selected_choice_warehouse }}> {{ $value_choice_warehouse->wh_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_warehouse" class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="is_serial_no" class="form-label text-xs">Is Serial No</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="is_serial_no" name="is_serial_no" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_is_serial_no"]) && count($data["arr_choice_is_serial_no"]) > 0)
                                                    @foreach ( $data["arr_choice_is_serial_no"] as $key_choice_is_serial_no => $value_choice_is_serial_no )
                                                    @php
                                                        $selected_choice_is_serial_no = "";
                                                        if(@$data["current_data"][0]->is_serial_no == $value_choice_is_serial_no){
                                                            $selected_choice_is_serial_no = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_is_serial_no }}" {{ $selected_choice_is_serial_no }}> {{ $value_choice_is_serial_no }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_is_serial_no" class="invalid-feedback"></div>
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
                                    <div class="col-sm-6 mb-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="is_batch_no" class="form-label text-xs">Is Batch No</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-select py-0" id="is_batch_no" name="is_batch_no" disabled>
                                                    <option value="">Choose</option>
                                                    @if (isset($data["arr_choice_is_batch_no"]) && count($data["arr_choice_is_batch_no"]) > 0)
                                                    @foreach ( $data["arr_choice_is_batch_no"] as $key_choice_is_batch_no => $value_choice_is_batch_no )
                                                    @php
                                                        $selected_choice_is_batch_no = "";
                                                        if(@$data["current_data"][0]->is_batch_no == $value_choice_is_batch_no){
                                                            $selected_choice_is_batch_no = " selected ";
                                                        }
                                                    @endphp
                                                    <option value="{{ $value_choice_is_batch_no }}" {{ $selected_choice_is_batch_no }} > {{ $value_choice_is_batch_no }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div id="validation_is_batch_no" class="invalid-feedback"></div>
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
    $("#li_master_item").addClass("active");
    $("#a_master_item").addClass("active");
});
</script>
@endsection