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
                        <h5 class="me-auto">Master Location</h5>
                        @if (in_array(session('user_level_id'),[1,2,5]))
                        <a href="{{route('master_location.create')}}" class="text-decoration-none">
                            <button type="button" class="btn btn-primary me-2 text-xs py-1" >Add</button>
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
    $("#logo_master").addClass("d-none");
    $("#logo_white_master").removeClass("d-none");
    $("#li_master_location").addClass("active");
    $("#a_master_location").addClass("active");

    const mapping_filter = [
        {
            id: "location_code",
            desc: "Location Code",
        },
        {
            id: "location_index",
            desc: "Location Index",
        },
        {
            id: "location_type",
            desc: "Location Type",
        },
        {
            id: "wh_name",
            desc: "Warehouse Name",
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
                column_data_server.push({data: element.id, className: 'text-xs',});
                temp_html_datatable += `<th>${element.desc}</th>`;
            }
        });

        column_data_server.push({data: "action", className: 'text-xs',});
        temp_html_datatable += `<th>Action</th>`;

        temp_html_datatable += `</tr></thead><tbody></tbody></table>`;
        $("#container-datatable").html(temp_html_datatable);

        $("#list-datatable").DataTable().destroy();
        $("#list-datatable").DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ordering: false,
            ajax: {
                url: "{{route('master_location.datatables')}}",
                
            },
            columns: column_data_server,
        });
    }
    // special function end

    searchDatatables();

});
</script>
@endsection