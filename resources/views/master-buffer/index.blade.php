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
                        <h5 class="me-auto">Master Buffer</h5>
                        @if (in_array(session('user_level_id'),[1,2,5]))
                        <a href="{{route('master_buffer.create')}}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary mb-0 py-1 me-2" >Add</button>
                        </a>
                        @endif
                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <div class="table-responsive" id="container-datatable"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("javascript")
<script type="text/javascript">
let selected_column = [];
$(document).ready(function () {
    $("#dropdown_toggle_master").prop('aria-expanded',true);
    $("#dropdown_toggle_master").addClass('active');
    $("#dropdown_master").addClass('show');
    $("#li_master_buffer").addClass("active");
    $("#a_master_buffer").addClass("active");

    const mapping_filter = [
        {
            id: "buffer_id",
            desc: "Buffer ID",
        },
        {
            id: "client_project_name",
            desc: "Project Name",
        },
        {
            id: "supplier_name",
            desc: "Supplier Name",
        },
        {
            id: "sku",
            desc: "SKU",
        },
        {
            id: "rules",
            desc: "Rules",
        },
        {
            id: "qty_buffer",
            desc: "Buffer Qty",
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
                    confirmButton: 'btn btn-primary mb-0 py-1 me-2',
                },
                buttonsStyling: false,
            })
            .fire({
                text: "Filter Cant all empty.",
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
                column_data_server.push({data: element.id, className: "text-xs"});
                temp_html_datatable += `<th class="text-xs">${element.desc}</th>`;
            }
        });

        column_data_server.push({data: "action"});
        temp_html_datatable += `<th class="text-xs">Action</th>`;

        temp_html_datatable += `</tr></thead><tbody></tbody></table>`;
        $("#container-datatable").html(temp_html_datatable);

        //button action dummy
        let dummyAction = `<div class='text-center'>
                                <a href='' class='text-decoration-none'>
                                <button class='btn btn-primary mb-0 py-1'>Show</button>
                                </a>
                            </div>`

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ordering: false,
            ajax: {
                url: "{{route('master_buffer.datatables')}}",
            },
            columns: column_data_server,
        });
    }
    // special function end

    searchDatatables();

});
</script>
@endsection