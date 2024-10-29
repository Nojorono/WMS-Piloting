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
                        <h5 class="me-auto">Master Item - Edit</h5>
                        <a href="{{route('master_item.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary mb-0 py-1" >List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('master_item.update',['id' => @$data["current_data"][0]->sku ]) }}" id="form-save-item">
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body py-0">
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="part_name" name="part_name" value="{{ @$data["current_data"][0]->part_name }}">
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="imei" name="imei" value="{{ @$data["current_data"][0]->imei }}">
                                                    <div id="validation_imei" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="part_no" class="form-label text-xs">Part No</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="part_no" name="part_no" value="{{ @$data["current_data"][0]->part_no }}">
                                                    <div id="validation_part_no" class="invalid-feedback"></div>
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="color" name="color" value="{{ @$data["current_data"][0]->color }}">
                                                    <div id="validation_color" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="size" class="form-label text-xs">Size</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="size" name="size" value="{{ @$data["current_data"][0]->size }}">
                                                    <div id="validation_size" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="length" class="form-label text-xs">Length</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="length" name="length" value="{{ @$data["current_data"][0]->length }}">
                                                    <div id="validation_length" class="invalid-feedback"></div>
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="width" name="width" value="{{ @$data["current_data"][0]->width }}">
                                                    <div id="validation_width" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="height" class="form-label text-xs">Height</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="height" name="height" value="{{ @$data["current_data"][0]->height }}">
                                                    <div id="validation_height" class="invalid-feedback"></div>
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="volume" name="volume" value="{{ @$data["current_data"][0]->volume }}">
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
                                                <div class="col-sm-10">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="uom" name="uom" value="{{ @$data["current_data"][0]->base_uom }}">
                                                    <div id="validation_uom" class="invalid-feedback"></div>
                                                </div>
                                                <div class="col-sm-2 ps-0">
                                                    <button type="button" class="btn btn-primary mb-0 py-1 mb-0 rounded" name="btn_search_uom" id="btn_search_uom"><i class="bi bi-search"></i></button>
                                                </div>
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
                                                    <select class="form-select py-0" id="is_serial_no" name="is_serial_no">
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
                                                    <select class="form-select py-0" id="is_batch_no" name="is_batch_no">
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
                        <div class="col-sm-12 mb-2">
                            <button type="submit" class="btn btn-primary mb-0 py-1">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-UOM" tabindex="-1" aria-labelledby="modal-UOMLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-UOMLabel">UoM - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-UOM">
                        <thead>
                            <tr>
                                <th class="text-xs">UoM Name</th>
                                <th class="text-xs">UoM Type Name</th>
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
    $("#logo_master").addClass("d-none");
    $("#logo_white_master").removeClass("d-none");
    $("#li_master_item").addClass("active");
    $("#a_master_item").addClass("active");

    $("#btn_search_uom").on("click",function () {
        $("#modal-UOM").modal('show');
        $("#list-datatable-modal-UOM").DataTable().destroy();
        $("#list-datatable-modal-UOM").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('master_item.datatablesUOM') }}",
            columns:[
                {data: 'uom_name', searchable: true, className: "text-xs"},
                {data: 'uom_type_name', searchable: true, className: "text-xs"},
            ],
        });
    });

    $("#list-datatable-modal-UOM > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const uom_name = $($(dom_tr).children("td")[0]).text();

        $("#uom").val(uom_name);

        $("#modal-UOM").modal('hide');
    });
   
    
    $("#form-save-item").on("submit",function (e) {
        e.preventDefault();
        Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-danger me-2',
                cancelButton: 'btn btn-primary mb-0 py-1 me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            title: 'Are you sure to update this project info? Yes No',
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

                const part_name = $("#part_name").val();
                const imei = $("#imei").val();
                const part_no = $("#part_no").val();
                const size = $("#size").val();
                const color = $("#color").val();
                const uom = $("#uom").val();
                const length = $("#length").val();
                const width = $("#width").val();
                const height = $("#height").val();
                const volume = $("#volume").val();
                const directions = $("#directions").val();
                const is_serial_no = $("#is_serial_no").val();
                const is_batch_no = $("#is_batch_no").val();

                const formData = new FormData();
                formData.append("_token",_token);
                formData.append("_method",_method);
                formData.append("part_name",part_name);
                formData.append("imei",imei);
                formData.append("part_no",part_no);
                formData.append("size",size);
                formData.append("color",color);
                formData.append("uom",uom);
                formData.append("length",length);
                formData.append("width",width);
                formData.append("height",height);
                formData.append("volume",volume);
                formData.append("directions",directions);
                formData.append("is_serial_no",is_serial_no);
                formData.append("is_batch_no",is_batch_no);
                
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
                        $("#part_name").removeClass('is-invalid');
                        $("#validation_part_name").html('');
                        $("#imei").removeClass('is-invalid');
                        $("#validation_imei").html('');
                        $("#part_no").removeClass('is-invalid');
                        $("#validation_part_no").html('');
                        $("#size").removeClass('is-invalid');
                        $("#validation_size").html('');
                        $("#color").removeClass('is-invalid');
                        $("#validation_color").html('');
                        $("#uom").removeClass('is-invalid');
                        $("#validation_uom").html('');
                        $("#length").removeClass('is-invalid');
                        $("#validation_length").html('');
                        $("#width").removeClass('is-invalid');
                        $("#validation_width").html('');
                        $("#height").removeClass('is-invalid');
                        $("#validation_height").html('');
                        $("#volume").removeClass('is-invalid');
                        $("#validation_volume").html('');
                        $("#directions").removeClass('is-invalid');
                        $("#validation_directions").html('');
                        $("#is_serial_no").removeClass('is-invalid');
                        $("#validation_is_serial_no").html('');
                        $("#is_batch_no").removeClass('is-invalid');
                        $("#validation_is_batch_no").html('');
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
                        window.location = "{{ route('master_item.index') }}";
                        return;

                    },
                });
            }
        });
    });
});
</script>
@endsection