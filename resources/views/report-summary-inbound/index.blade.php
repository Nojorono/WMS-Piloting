@extends('layout.app')

@section("title")
Report Summary Inbound
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
                        <h5 class="me-auto">Report Summary Inbound</h5>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="row">
                            <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="date_from" class="form-label text-xs">Date From</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="date_from" name="date_from" value="">
                                        <div class="invalid-feedback" id="validation_date_from"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="date_to" class="form-label text-xs">Date To</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="date" autocomplete="off" class="form-control py-0 rounded-start" id="date_to" name="date_to" value="">
                                        <div class="invalid-feedback" id="validation_date_to"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-flex">
                                    <button class="btn btn-primary py-1 mb-0 ms-0 me-2" type="button" id="btn_search" name="btn_search">Search</button>
                                    <div class="btn-group me-2">
                                        <button type="button" class="btn btn-primary py-1 mb-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Download
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" onclick="exportExcel()">Excel</a></li>
                                            <li><a class="dropdown-item" onclick="printPDF()">PDF</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <div class="table-responsive">
                            <table class="table " id="list-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-xs">Inbound Planning No</th>
                                        <th class="text-xs">SKU</th>
                                        <th class="text-xs">Part Name</th>
                                        <th class="text-xs">Batch No</th>
                                        <th class="text-xs">Serial No</th>
                                        <th class="text-xs">Qty</th>
                                        <th class="text-xs">Location ID</th>
                                        <th class="text-xs">ETD</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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
function exportExcel() {
    $("#date_from").removeClass('is-invalid');
    $("#validation_date_from").html('');
    $("#date_to").removeClass('is-invalid');
    $("#validation_date_to").html('');

    const date_from = $("#date_from").val();
    const date_to = $("#date_to").val();

    if(!date_from){
        $(`#date_from`).addClass('is-invalid');
        $(`#validation_date_from`).html("Date From is required");

        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: 'Validation Failed',
            type: 'error',
            icon: 'error',
        });
        return;
    }

    if(!date_to){
        $(`#date_to`).addClass('is-invalid');
        $(`#validation_date_to`).html("Date To is required");
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: 'Validation Failed',
            type: 'error',
            icon: 'error',
        });
        return;
    }

    const url = "{{ route('report_summary_inbound.viewExcel') }}";

    const full_url = `${url}?date_from=${date_from}&date_to=${date_to}`;
    window.open(full_url,"_blank");
}

function printPDF() {
    $("#date_from").removeClass('is-invalid');
    $("#validation_date_from").html('');
    $("#date_to").removeClass('is-invalid');
    $("#validation_date_to").html('');

    const date_from = $("#date_from").val();
    const date_to = $("#date_to").val();

    if(!date_from){
        $(`#date_from`).addClass('is-invalid');
        $(`#validation_date_from`).html("Date From is required");

        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: 'Validation Failed',
            type: 'error',
            icon: 'error',
        });
        return;
    }

    if(!date_to){
        $(`#date_to`).addClass('is-invalid');
        $(`#validation_date_to`).html("Date To is required");
        Swal
        .mixin({
            customClass: {
                confirmButton: 'btn btn-primary me-2',
            },
            buttonsStyling: false,
        })
        .fire({
            text: 'Validation Failed',
            type: 'error',
            icon: 'error',
        });
        return;
    }

    const url = "{{ route('report_summary_inbound.printPDF') }}";

    const full_url = `${url}?date_from=${date_from}&date_to=${date_to}`;
    window.open(full_url,"_blank");
}

$(document).ready(function () {
    $("#dropdown_toggle_report").prop('aria-expanded',true);
    $("#dropdown_toggle_report").addClass('active');
    $("#dropdown_report").addClass('show');
    $("#li_report_summary_inbound").addClass("active");
    $("#a_report_summary_inbound").addClass("active");
    
    $("#btn_search").on("click",function () {

        const url = "{{ route('report_summary_inbound.getReport') }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const date_from = $("#date_from").val();
        const date_to = $("#date_to").val();

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("date_from",date_from);
        formData.append("date_to",date_to);

        $.ajax({
            url: url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {
            
                $("#date_from").removeClass('is-invalid');
                $("#validation_date_from").html('');
                $("#date_to").removeClass('is-invalid');
                $("#validation_date_to").html('');
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

                $("#list-table > tbody").html("");
                
                if('data' in response && response.data.length > 0){
                    let html_list_table = "";

                    response.data.forEach(element => {
                        html_list_table += `
                        <tr>
                            <td class="text-xs">${element.inbound_planning_no}</td>
                            <td class="text-xs">${element.sku}</td>
                            <td class="text-xs">${element.item_name}</td>
                            <td class="text-xs">${element.batch_no}</td>
                            <td class="text-xs">${element.serial_no}</td>
                            <td class="text-xs">${element.qty}</td>
                            <td class="text-xs">${element.location_id}</td>
                            <td class="text-xs">${element.etd}</td>
                        </tr>`;
                    });

                    $("#list-table > tbody").html(html_list_table);
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

                
            },
        });
    });
});
</script>
@endsection
