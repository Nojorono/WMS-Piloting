@extends('layout.app')

@section("title")
Master Location
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
                        <h5 class="me-auto">Master Location - Edit</h5>
                        <a href="{{route('master_location.index')}}" class="text-decoration-none me-2">
                            <button type="button" class="btn btn-primary text-xs py-1" >List</button>
                        </a>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('master_location.update',['id' => @$data["current_data"][0]->location_id ]) }}" id="form-save-location">
                        <div class="col-sm-12 mb-2">
                            <div class="card">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="location_code" class="form-label text-xs">Location Code</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="location_code" name="location_code" value="{{ @$data["current_data"][0]->location_code }}" readonly>
                                                    <div id="validation_location_code" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="location_name" class="form-label text-xs">Location Name</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="location_name" name="location_name" value="{{ @$data["current_data"][0]->location_name }}">
                                                    <div id="validation_location_name" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="location_index" class="form-label text-xs">Location Index</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="location_index" name="location_index" value="{{ @$data["current_data"][0]->index_code }}" readonly>
                                                    <div id="validation_location_index" class="invalid-feedback"></div>
                                                </div>
                                                <div class="col-sm-2 ps-0 text-end">
                                                    <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_location_index" id="btn_search_location_index"><i class="bi bi-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="location_type" class="form-label text-xs">Location Type</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select class="form-select py-0" id="location_type" name="location_type">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["arr_choice_location_type"]) && count($data["arr_choice_location_type"]) > 0)
                                                        @foreach ( $data["arr_choice_location_type"] as $key_choice_location_type => $value_choice_location_type )
                                                        @php
                                                            $selected_location_type = "";
                                                            if( @$data["current_data"][0]->location_type == $value_choice_location_type->type_name ){
                                                                $selected_location_type = " selected ";
                                                            }
                                                        @endphp
                                                        <option value="{{ $value_choice_location_type->type_name }}" {{ $selected_location_type }}> {{ $value_choice_location_type->type_name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="validation_location_type" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="project" class="form-label text-xs">Project</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select class="form-select py-0" id="project" name="project" disabled>
                                                        <option value="">Choose</option>
                                                        @if (isset($data["arr_choice_project"]) && count($data["arr_choice_project"]) > 0)
                                                        @foreach ( $data["arr_choice_project"] as $key_choice_project => $value_choice_project )
                                                        @php
                                                            $selected_project = "";
                                                            if( @$data["current_data"][0]->client_project_id == $value_choice_project->client_project_id ){
                                                                $selected_project = " selected ";
                                                            }
                                                        @endphp
                                                        <option value="{{ $value_choice_project->client_project_id }}" {{ $selected_project }}> {{ $value_choice_project->client_project_name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="validation_project" class="invalid-feedback"></div>
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
                                                            $selected_warehouse = "";
                                                            if( @$data["current_data"][0]->wh_id == $value_choice_warehouse->wh_id ){
                                                                $selected_warehouse = " selected ";
                                                            }
                                                        @endphp
                                                        <option value="{{ $value_choice_warehouse->wh_id }}" {{ $selected_warehouse }}> {{ $value_choice_warehouse->wh_name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="validation_warehouse" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="commodity_name" class="form-label text-xs">Commodity</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <input type="hidden" id="commodity_id" name="commodity_id" value="{{ @$data["current_data"][0]->commodity_id }}">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="commodity_name" name="commodity_name" value="{{ @$data["current_data"][0]->commodity_name }}" readonly>
                                                    <div id="validation_commodity_name" class="invalid-feedback"></div>
                                                </div>
                                                <div class="col-sm-2 ps-0 text-end">
                                                    <button type="button" class="btn btn-primary mb-0 rounded py-1" name="btn_search_commodity" id="btn_search_commodity"><i class="bi bi-search"></i></button>
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

<div class="modal fade" id="modal-LocationIndex" tabindex="-1" aria-labelledby="modal-LocationIndexLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-LocationIndexLabel">Location Index - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-LocationIndex">
                        <thead>
                            <tr>
                                <th class="text-xs">Index Code</th>
                                <th class="text-xs">Index Name</th>
                                <th class="text-xs">Length</th>
                                <th class="text-xs">Width</th>
                                <th class="text-xs">Height</th>
                                <th class="text-xs">Capacity</th>
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

<div class="modal fade" id="modal-Commodity" tabindex="-1" aria-labelledby="modal-CommodityLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-CommodityLabel">Commodity - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Commodity">
                        <thead>
                            <tr>
                                <th class="text-xs">Commodity ID</th>
                                <th class="text-xs">Commodity Name</th>
                                <th class="text-xs">Description</th>
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
    $("#li_master_location").addClass("active");
    $("#a_master_location").addClass("active");

    $("#btn_search_location_index").on("click",function () {
        $("#modal-LocationIndex").modal('show');
        $("#list-datatable-modal-LocationIndex").DataTable().destroy();
        $("#list-datatable-modal-LocationIndex").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('master_location.datatablesLocationIndex') }}",
            columns:[
                {data: 'index_code', searchable: true, className: 'text-xs',},
                {data: 'index_name', searchable: true, className: 'text-xs',},
                {data: 'length', searchable: true, className: 'text-xs',},
                {data: 'width', searchable: true, className: 'text-xs',},
                {data: 'height', searchable: true, className: 'text-xs',},
                {data: 'capacity', searchable: true, className: 'text-xs',},
            ],
        });
    });

    $("#list-datatable-modal-LocationIndex > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const index_code = $($(dom_tr).children("td")[0]).text();

        $("#location_index").val(index_code);

        $("#modal-LocationIndex").modal('hide');
    });

    $("#btn_search_commodity").on("click",function () {
        $("#modal-Commodity").modal('show');
        $("#list-datatable-modal-Commodity").DataTable().destroy();
        $("#list-datatable-modal-Commodity").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('master_location.datatablesCommodity') }}",
            columns:[
                {data: 'commodity_id', searchable: true, className: 'text-xs',},
                {data: 'commodity_name', searchable: true, className: 'text-xs',},
                {data: 'commodity_desc', searchable: true, className: 'text-xs',},
            ],
        });
    });

    $("#list-datatable-modal-Commodity > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const commodity_id = $($(dom_tr).children("td")[0]).text();
        const commodity_name = $($(dom_tr).children("td")[1]).text();
        const commodity_desc = $($(dom_tr).children("td")[2]).text();

        $("#commodity_id").val(commodity_id);
        $("#commodity_name").val(commodity_name);

        $("#modal-Commodity").modal('hide');
    });
    
    $("#form-save-location").on("submit",function (e) {
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

                const location_name = $("#location_name").val();
                const location_index = $("#location_index").val();
                const location_type = $("#location_type").val();
                const commodity_id = $("#commodity_id").val();
                const commodity_name = $("#commodity_name").val();

                const formData = new FormData();
                formData.append("_token",_token);
                formData.append("_method",_method);
                formData.append("location_name",location_name);
                formData.append("location_index",location_index);
                formData.append("location_type",location_type);
                formData.append("commodity_id",commodity_id);
                formData.append("commodity_name",commodity_name);

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

                        $("#location_code").removeClass('is-invalid');
                        $("#validation_location_code").html('');
                        $("#location_name").removeClass('is-invalid');
                        $("#validation_location_name").html('');
                        $("#location_index").removeClass('is-invalid');
                        $("#validation_location_index").html('');
                        $("#location_type").removeClass('is-invalid');
                        $("#validation_location_type").html('');
                        $("#project").removeClass('is-invalid');
                        $("#validation_project").html('');
                        $("#warehouse").removeClass('is-invalid');
                        $("#validation_warehouse").html('');
                        $("#commodity_name").removeClass('is-invalid');
                        $("#validation_commodity_name").html('');
                        
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
                        window.location = "{{ route('master_location.index') }}";
                        return;

                    },
                });
            }
        });
    });
});
</script>
@endsection