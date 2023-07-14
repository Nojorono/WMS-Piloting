@extends('layout.app')

@section("title")
Movement Report
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
                        <h5 class="me-auto">Movement Report</h5>
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
                            <div class="col-sm-3 mb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="process_id" class="form-label text-xs">Code</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <select name="process_id" id="process_id" class="form-select py-0">
                                            <option value="">Choose</option>
                                        </select>
                                        <div class="invalid-feedback" id="validation_process_id"></div>
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
                        <div class="table-responsive" id="container-table"></div>
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
    $("#process_id").removeClass('is-invalid');
    $("#validation_process_id").html('');

    const date_from = $("#date_from").val();
    const date_to = $("#date_to").val();
    const process_id = $("#process_id").val();

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

    if(!process_id){
        $(`#process_id`).addClass('is-invalid');
        $(`#validation_date_from`).html("Process Code is required");

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

    const url = "{{ route('movement_report.viewExcel') }}";

    const full_url = `${url}?date_from=${date_from}&date_to=${date_to}&process_id=${process_id}`;
    window.open(full_url,"_blank");
}

function printPDF() {
    $("#date_from").removeClass('is-invalid');
    $("#validation_date_from").html('');
    $("#date_to").removeClass('is-invalid');
    $("#validation_date_to").html('');
    $("#process_id").removeClass('is-invalid');
    $("#validation_process_id").html('');

    const date_from = $("#date_from").val();
    const date_to = $("#date_to").val();
    const process_id = $("#process_id").val();

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

    if(!process_id){
        $(`#process_id`).addClass('is-invalid');
        $(`#validation_date_from`).html("Process Code is required");

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

    const url = "{{ route('movement_report.printPDF') }}";

    const full_url = `${url}?date_from=${date_from}&date_to=${date_to}&process_id=${process_id}`;
    window.open(full_url,"_blank");
}

function getProcessCode() {
    return new Promise(function (resolve,reject) {
        const url = "{{ route('movement_report.getProcessCode') }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);

        $.ajax({
            url: url,
            method: _method,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function () {

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
                reject();
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
                    reject();
                    return;
                }

                if(response.err){
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
                    reject();
                    return;
                }

                resolve(response.data);
            },
        });
    });
}

async function addDataDropDownProcessCode() {
    const arr_process_id = await getProcessCode();
    $("#process_id").html("");
    
    let html_process_id = `<option value="">Choose</option>`;
    if(arr_process_id.length > 0){
        arr_process_id.forEach(element => {
            html_process_id += `<option value="${element.process_id}">${element.process_code} - ${element.process_name}</option>`;
        });
    }
    $("#process_id").html(html_process_id);

}

$(document).ready(function () {
    $("#dropdown_toggle_report").prop('aria-expanded',true);
    $("#dropdown_toggle_report").addClass('active');
    $("#dropdown_report").addClass('show');
    $("#logo_report").addClass("d-none");
    $("#logo_white_report").removeClass("d-none");
    $("#li_movement_report").addClass("active");
    $("#a_movement_report").addClass("active");
    addDataDropDownProcessCode();

    $("#btn_search").on("click",function () {

        const url = "{{ route('movement_report.getReport') }}";
        const _token = $("meta[name='csrf-token']").prop('content');
        const _method = "POST";

        const date_from = $("#date_from").val();
        const date_to = $("#date_to").val();
        const process_id = $("#process_id").val();

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("date_from",date_from);
        formData.append("date_to",date_to);
        formData.append("process_id",process_id);

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
                $("#process_id").removeClass('is-invalid');
                $("#validation_process_id").html('');
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
                
                
                if(!('mapping_column' in response)){
                    Swal
                    .mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                        },
                        buttonsStyling: false,
                    })
                    .fire({
                        text: `Something Wrong`,
                        type: 'error',
                        icon: 'error',
                    });
                    return;
                }

                $("#container-table").html("");
                let temp_html_table_header = "";
                temp_html_table_header += `<table class="table " id="list-table" style="width: 100%;"><thead><tr>`;
                let column_data_server = [];
                response.mapping_column.forEach((element,index) => {
                    temp_html_table_header += `<th class="text-center text-xs">${element.desc}</th>`;
                });
                temp_html_table_header += `</tr></thead><tbody></tbody></table>`;
                $("#container-table").html(temp_html_table_header);

                if(response.data.length > 0){
                    let temp_html_table_body = "";
                    response.data.forEach(element_data => {
                        temp_html_table_body += `<tr>`;
                        response.mapping_column.forEach((element_mapping_column) => {
                            const data = (element_data[element_mapping_column.id]) ? element_data[element_mapping_column.id] : "";
                            temp_html_table_body += `<td class="text-center text-xs">${data}</td>`;
                        });
                        temp_html_table_body += `</tr>`;

                    });
                    $("#list-table > tbody").html(temp_html_table_body);
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
