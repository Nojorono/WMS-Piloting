@extends('layout.app')

@section('title')
GR Return
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 d-flex mb-2">
                        <h5 class="me-auto">GR Return - List</h5>
                        <a href="{{route('gr_return.viewExcel')}}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary mb-0 py-1">Print List Data</button>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="table-responsive" id="container-datatable">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
let selected_column = [];
$(document).ready(function() {
    $("#dropdown_toggle_inbound").prop('aria-expanded', true);
    $("#dropdown_toggle_inbound").addClass('active');
    $("#dropdown_inbound").addClass('show');
    $("#li_gr_return").addClass("active");
    $("#a_gr_return").addClass("active");

    const mapping_filter = [
        {
            id: "return_no",
            desc: "Return No",
        },
        {
            id: "gr_return_id",
            desc: "GR Return Id",
        },
        {
            id: "wh_code",
            desc: "Warehouse Code",
        },
        {
            id: "client_project_name",
            desc: "Client Project Name",
        },
        {
            id: "reference_no",
            desc: "Reference No",
        },
        {
            id: "receive_date",
            desc: "Receive Date",
        },
        {
            id: "status_name",
            desc: "Status",
        },

    ];

    
    mapping_filter.forEach((element,index) => {
        selected_column.push(element.id);
    });

    // special function start

    const searchDatatables = () => {
        if(selected_column.length == 0){
            Swal
            .mixin({
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: 'Filter Cant all empty.',
                type: 'error',
                icon: 'error',
            });
            return;
        }

        $("#container-datatable").html("");
        let temp_html_datatable = "";
        temp_html_datatable += `<table class="table " id="list-datatable" style="width: 100%;"><thead><tr>`;
        let column_data_server = [];

        mapping_filter.forEach((element,index) => {
            const selected = selected_column.includes(element.id);
            if(selected){
                column_data_server.push({data: element.id, className:'text-xs',});
                temp_html_datatable += `<th class="text-xs">${element.desc}</th>`;
            }
        });
        
        column_data_server.push({data: "action", className:'text-xs',});
        temp_html_datatable += `<th>Action</th>`;

        temp_html_datatable += `</tr></thead><tbody></tbody></table>`;
        $("#container-datatable").html(temp_html_datatable);

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ordering: false,
            ajax: {
                url: "{{ route('gr_return.datatables') }}",
                data: {},
            },
            columns: column_data_server,
        });
    }
    // special function end

    searchDatatables();

});
</script>
@endsection
