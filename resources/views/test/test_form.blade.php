
@extends('layout.app')

@section("title")
Test
@endsection

@section("custom-style")
<link rel="stylesheet" type="text/css" href="{{ asset("DataTables/custom_with_softui_datatables.css") }}"/>

@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('test.index') }}">
                            <button class="btn btn-primary" type="button">index</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <form method="POST" action="{{ route('test.save_form') }}" id="form-save-test">
                        @csrf
                        @method('POST')
                        <div class="col-sm-12">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="inbound_planning_no" class="form-label">Inbound Planning No</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="inbound_planning_no" name="inbound_planning_no" value="Auto Generate" readonly>
                                                    <div class="invalid-feedback" id="validation_inbound_planning_no"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="supplier_name" class="form-label">Supplier Name*</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="hidden" id="supplier_id" name="supplier_id" value="">
                                                    <input type="text" autocomplete="off" class="form-control" id="supplier_name" name="supplier_name" value="" readonly>
                                                    <div id="validation_supplier_name" class="invalid-feedback "></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" class="btn btn-primary mb-0 rounded" id="btn_search_supplier_id"><i class="bi bi-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="reference_no" class="form-label">Reference No*</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control" id="reference_no" name="reference_no" value="">
                                                    <div id="validation_reference_no" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="supplier_address" class="form-label">Supplier Address</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control" id="supplier_address" name="supplier_address" value="" readonly>
                                                    <div id="validation_supplier_address" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="receipt_no" class="form-label">Receipt No*</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="text" autocomplete="off" class="form-control" id="receipt_no" name="receipt_no" value="">
                                                    <div id="validation_receipt_no" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="client_name" class="form-label">Client Name*</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="hidden" id="client_id" name="client_id" value="{{ session('current_client_id') }}">
                                                    <input type="text" autocomplete="off" class="form-control" id="client_name" name="client_name" value="{{ session('current_client_name') }}" readonly>
                                                    <div id="validation_client_name" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="order_type" class="form-label">Order Type*</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="hidden" id="order_id" name="order_id" value="" >
                                                    <input type="text" autocomplete="off" class="form-control" id="order_type" name="order_type" value="" readonly>
                                                    <div id="validation_order_type" class="invalid-feedback"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" class="btn btn-primary mb-0 rounded" id="btn_search_order_type"><i class="bi bi-search"></i></button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="warehouse_name" class="form-label">Warehouse Name*</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="hidden" id="warehouse_id" name="warehouse_id" value="{{ session('current_warehouse_id') }}" readonly>
                                                    <input type="text" autocomplete="off" class="form-control" id="warehouse_name" name="warehouse_name" value="{{ session('current_warehouse_name') }}" readonly>
                                                    <div id="validation_warehouse_name" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="plan_delivery_date" class="form-label">Plan Delivery Date*</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="date" autocomplete="off" class="form-control" id="plan_delivery_date" name="plan_delivery_date" value="" >
                                                    <div id="validation_plan_delivery_date" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("javascript")
<script type="text/javascript">
$(document).ready(function () {
    $("#form-save-test").on("submit",function (e) {
        e.preventDefault();
        const url = $(this).prop('action');
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = $("input[name='_method']").val();

        const plan_delivery_date = $('#plan_delivery_date').val();
        const warehouse_id = $('#warehouse_id').val();
        const order_id = $('#order_id').val();
        const order_type = $('#order_type').val();
        const client_id = $('#client_id').val();
        const receipt_no = $('#receipt_no').val();
        const supplier_address = $('#supplier_address').val();
        const reference_no = $('#reference_no').val();
        const supplier_id = $('#supplier_id').val();
        const supplier_name = $('#supplier_name').val();
        const remarks = $('#remarks').val();
        
        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("plan_delivery_date",plan_delivery_date);
        formData.append("warehouse_id",warehouse_id);
        formData.append("order_id",order_id);
        formData.append("order_type",order_type);
        formData.append("client_id",client_id);
        formData.append("receipt_no",receipt_no);
        formData.append("supplier_address",supplier_address);
        formData.append("reference_no",reference_no);
        formData.append("supplier_id",supplier_id);
        formData.append("supplier_name",supplier_name);
        formData.append("remarks",remarks);

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
            
                $("#plan_delivery_date").removeClass('is-invalid');
                $("#validation_plan_delivery_date").html('');
                $("#warehouse_id").removeClass('is-invalid');
                $("#validation_warehouse_id").html('');
                $("#order_id").removeClass('is-invalid');
                $("#validation_order_id").html('');
                $("#order_type").removeClass('is-invalid');
                $("#validation_order_type").html('');
                $("#client_name").removeClass('is-invalid');
                $("#validation_client_name").html('');
                $("#receipt_no").removeClass('is-invalid');
                $("#validation_receipt_no").html('');
                $("#supplier_address").removeClass('is-invalid');
                $("#validation_supplier_address").html('');
                $("#reference_no").removeClass('is-invalid');
                $("#validation_reference_no").html('');
                $("#supplier_name").removeClass('is-invalid');
                $("#validation_supplier_name").html('');
            },
            error: function (error) {
                alert('Something Wrong');
            },
            complete: function () {

            },
            success: function (response) {
                if(typeof response !== 'object'){
                    alert('Something Wrong');
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
                    alert(`${response.message}`);
                    return;
                }

                alert(response.message);
                window.location = "{{ route('inbound_planning.index') }}";
                return;

            },
        });
    });
});
</script>
@endsection
