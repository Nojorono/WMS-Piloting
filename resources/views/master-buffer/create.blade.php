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
                        <h5 class="me-auto">Master Buffer - Add</h5>
                        <span>
                            <button type="button" class="btn btn-primary mb-0 py-1 me-2" id="btn_list">List</button>
                        </span>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('master_buffer.store') }}" id="form-save-buffer">
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="buffer_id" name="buffer_id" value="" readonly>
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
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="contact_id" name="contact_id" value="" readonly>
                                                    <div id="validation_contact_id" class="invalid-feedback"></div>
                                                </div>
                                                <div class="col-sm-2 ps-0">
                                                    <button type="button" class="btn btn-primary mb-0 py-1 mb-0 rounded" name="btn_search_contact" id="btn_search_contact"><i class="bi bi-search"></i></button>
                                                </div>
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
                                                <div class="col-sm-10">
                                                    <input type="text" autocomplete="off" class="form-control py-0" id="sku" name="sku" value="" readonly>
                                                    <div id="validation_sku" class="invalid-feedback"></div>
                                                </div>
                                                <div class="col-sm-2 ps-0">
                                                    <button type="button" class="btn btn-primary mb-0 py-1 mb-0 rounded" name="btn_search_sku" id="btn_search_sku"><i class="bi bi-search"></i></button>
                                                </div>
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
                                                    <input type="number" autocomplete="off" class="form-control py-0" id="buffer_qty" name="buffer_qty" value="">
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
                                                    <select class="form-select py-0" id="rules" name="rules">
                                                        <option value="">Choose</option>
                                                        @if (isset($data["list_rules"]) && count($data["list_rules"]) > 0)
                                                        @foreach ($data["list_rules"] as $list_rules)
                                                        <option value="{{ $list_rules->rules_id }}">{{ $list_rules->desc }}</option>
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
                                                    <textarea class="form-control py-0" id="messages" style="height: 100px" name="messages"></textarea>
                                                    <div id="validation_messages" class="invalid-feedback"></div>
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

<div class="modal fade" id="modal-Contact" tabindex="-1" aria-labelledby="modal-ContactLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-ContactLabel">Contact - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-Contact">
                        <thead>
                            <tr>
                                <th class="text-xs">Contact ID</th>
                                <th class="text-xs">Client Project Name</th>
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

<div class="modal fade" id="modal-SKU" tabindex="-1" aria-labelledby="modal-SKULabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-SKULabel">SKU - List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table " id="list-datatable-modal-SKU">
                        <thead>
                            <tr>
                                <th class="text-xs">SKU</th>
                                <th class="text-xs">Part Name</th>
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

<div class="modal fade" id="modal-List-Pop-Up" tabindex="-1" aria-labelledby="modal-List-Pop-UpLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-List-Pop-UpLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        Are you sure to leave this page?
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="d-flex">
                            <a href="{{route('master_buffer.index')}}" class="text-decoration-none me-2">
                                <button type="button" class="btn btn-primary mb-0 py-1">Yes</button>
                            </a>
                            <button type="button" class="btn btn-primary mb-0 py-1" data-bs-dismiss="modal">no</button>
                        </div>
                    </div>
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
    $("#li_master_buffer").addClass("active");
    $("#a_master_buffer").addClass("active");

    $("#btn_list").on("click",function () {
        $("#modal-List-Pop-Up").modal('show');
    });

    $("#btn_search_contact").on("click",function () {
        $("#modal-Contact").modal('show');
        $("#list-datatable-modal-Contact").DataTable().destroy();
        $("#list-datatable-modal-Contact").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('master_buffer.datatablesContact') }}",
            columns:[
                {data: 'contact_id', searchable: true, className:"text-xs"},
                {data: 'client_project_name', searchable: true, className:"text-xs"},
                {data: 'supplier_name', searchable: true, className:"text-xs"},
            ],
        });
    });

    $("#list-datatable-modal-Contact > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        
        const contact_id = $($(dom_tr).children("td")[0]).text();

        $("#contact_id").val(contact_id);

        $("#modal-Contact").modal('hide');
    });

    $("#btn_search_sku").on("click",function () {
        $("#modal-SKU").modal('show');
        $("#list-datatable-modal-SKU").DataTable().destroy();
        $("#list-datatable-modal-SKU").DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('master_buffer.datatablesSKU') }}",
            columns:[
                {data: 'sku', searchable: true, className:"text-xs"},
                {data: 'part_name', searchable: true, className:"text-xs"},
            ],
        });
    });

    $("#list-datatable-modal-SKU > tbody").on('click','tr',function () {
        const dom_tr = $(this);
        if( $($(dom_tr).children("td")[0]).text() == "No data available in table"){
            return;
        }
        const sku = $($(dom_tr).children("td")[0]).text();

        $("#sku").val(sku);

        $("#modal-SKU").modal('hide');
    });

    $("#form-save-buffer").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const contact_id = $("#contact_id").val();
        const sku = $("#sku").val();
        const buffer_qty = $("#buffer_qty").val();
        const rules = $("#rules").val();
        const messages = $("#messages").val();

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);

        formData.append("contact_id",contact_id);
        formData.append("sku",sku);
        formData.append("buffer_qty",buffer_qty);
        formData.append("rules",rules);
        formData.append("messages",messages);

        $.ajax({
            url:url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
                $("#buffer_id").removeClass('is-invalid');
                $("#validation_buffer_id").html('');
                $("#contact_id").removeClass('is-invalid');
                $("#validation_contact_id").html('');
                $("#sku").removeClass('is-invalid');
                $("#validation_sku").html('');
                $("#buffer_qty").removeClass('is-invalid');
                $("#validation_buffer_qty").html('');
                $("#rules").removeClass('is-invalid');
                $("#validation_rules").html('');
                $("#messages").removeClass('is-invalid');
                $("#validation_messages").html('');
                
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
                window.location = "{{ route('master_buffer.index') }}";
                return;

            },
        });
        
    });
});
</script>
@endsection