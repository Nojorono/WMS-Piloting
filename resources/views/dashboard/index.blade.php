@extends('layout.app')

@section("title")
Dashboard
@endsection

@section("custom-style")
@endsection

@section('content')
<div class="row align-items-center">
    <div class="col-sm-5 mb-2">
        <div class="row align-items-center ">
            <div class="col-sm-12 mb-2 fw-bold ">
                Quantity Report
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-6 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                On Hand Qty
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5">
                                {{ (!empty(@$data["quantity_report"][0]->on_hand_qty)) ? @$data["quantity_report"][0]->on_hand_qty : 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6  mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Available Qty
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5">
                                {{ (!empty(@$data["quantity_report"][0]->available_qty)) ? @$data["quantity_report"][0]->available_qty : 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-7 mb-2">
        <div class="row align-items-center">
            <div class="col-sm-12 mb-2 fw-bold">
                Stock Aging Report
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Fast Aging
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5">
                                {{ (!empty(@$data["fast_aging"][0]->aging)) ? @$data["fast_aging"][0]->aging : 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Medium Aging
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5">
                                {{ (!empty(@$data["medium_aging"][0]->aging)) ? @$data["medium_aging"][0]->aging : 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Slow Aging
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5">
                                {{ (!empty(@$data["slow_aging"][0]->aging)) ? @$data["slow_aging"][0]->aging : 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <div class="row align-items-center">
            <div class="col-sm-12 mb-2 fw-bold">
                Inbound Report
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-3 mb-2">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="date_from" class="form-label">Date From</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="date" autocomplete="off" class="form-control py-0" id="date_from" name="date_from" value="">
                        <div id="validation_date_from" class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 mb-2">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="date_to" class="form-label">Date From</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="date" autocomplete="off" class="form-control py-0" id="date_to" name="date_to" value="">
                        <div id="validation_date_to" class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body" id="chart_container">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-sm-6 mb-2">
                                <div class="card bg-white shadow-lg py-0">
                                    <div class="card-body py-1">
                                        <div class="row align-items-center">
                                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                                Total Planning
                                            </div>
                                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_data_total_planning">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="card bg-white shadow-lg py-0">
                                    <div class="card-body py-1">
                                        <div class="row align-items-center">
                                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                                Total Receive
                                            </div>
                                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_data_total_receive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="card bg-white shadow-lg py-0">
                                    <div class="card-body py-1">
                                        <div class="row align-items-center">
                                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                                Qty Planning
                                            </div>
                                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_data_qty_planning">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="card bg-white shadow-lg py-0">
                                    <div class="card-body py-1">
                                        <div class="row align-items-center">
                                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                                Qty Receive
                                            </div>
                                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_data_qty_receive">
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
    <div class="col-sm-12">
        <div class="row align-items-center">
            <div class="col-sm-12 mb-2 fw-bold">
                Outbound Report
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-3 mb-2">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="date_from_outbound" class="form-label">Date From</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="date" autocomplete="off" class="form-control py-0" id="date_from_outbound" name="date_from_outbound" value="">
                        <div id="validation_date_from_outbound" class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 mb-2">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="date_to_outbound" class="form-label">Date From</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="date" autocomplete="off" class="form-control py-0" id="date_to_outbound" name="date_to_outbound" value="">
                        <div id="validation_date_to_outbound" class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-12 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body" id="chart_container_outbound">
                        {{-- <div class="chart">
                            <canvas id="bar-chart" class="chart-canvas" height="300px"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center pt-4">
            <div class="col-sm-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Total Planning
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_outbound_total_planning"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Total Picking
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_outbound_total_picking"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Total Packing
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_outbound_total_packing"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Total Qty Planning
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_outbound_qty_planning"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Total Qty Picking
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_outbound_qty_picking"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-2">
                <div class="card bg-white shadow-lg py-0">
                    <div class="card-body py-1">
                        <div class="row align-items-center">
                            <div class="col-sm-12 mb-2 fw-bold text-xs">
                                Total Qty Packing
                            </div>
                            <div class="col-sm-12 mb-2 text-primary fw-bold fs-5" id="container_outbound_qty_packing"></div>
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
function generateInboundReport() {
    return new Promise((resolve,reject) => {

        $(`#container_data_total_planning`).html("Loading...");
        $(`#container_data_total_receive`).html("Loading...");
        $(`#container_data_qty_planning`).html("Loading...");
        $(`#container_data_qty_receive`).html("Loading...");
        $("#chart_container").html("");

        const url = "{{ route('dashboard_getInboundReport') }}";
        const _token = $("meta[name='csrf-token']").prop("content");
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

                if('data' in response){
                    let total_planning = 0;
                    if('total_planning' in response.data && response.data.total_planning != null){
                        total_planning = response.data.total_planning;
                    }
                    $(`#container_data_total_planning`).html(`${total_planning}`);

                    let total_receive = 0;
                    if('total_receive' in response.data && response.data.total_receive != null){
                        total_receive = response.data.total_receive;
                    }
                    $(`#container_data_total_receive`).html(`${total_receive}`);

                    let qty_planning = 0;
                    if('qty_planning' in response.data && response.data.qty_planning != null){
                        qty_planning = response.data.qty_planning;
                    }
                    $(`#container_data_qty_planning`).html(`${qty_planning}`);

                    let qty_receive = 0;
                    if('qty_receive' in response.data && response.data.qty_receive != null){
                        qty_receive = response.data.qty_receive;
                    }
                    $(`#container_data_qty_receive`).html(`${qty_receive}`);


                    if('data_grafik' in response.data){

                        $("#chart_container").html(`
                        <div class="chart">
                            <canvas id="line-chart" class="chart-canvas" height="300px"></canvas>
                        </div>`);

                        const list_inbound_planning_no = [];
                        if( 'list_inbound_planning_no' in response.data.data_grafik && response.data.data_grafik.list_inbound_planning_no.length > 0){
                            response.data.data_grafik.list_inbound_planning_no.forEach(element => {
                                list_inbound_planning_no.push(element);
                            });
                        }
                        const list_qty_plan = [];
                        if( 'list_qty_plan' in response.data.data_grafik && response.data.data_grafik.list_qty_plan.length > 0){
                            response.data.data_grafik.list_qty_plan.forEach(element => {
                                list_qty_plan.push(element);
                            });
                        }
                        const list_qty_receive = [];
                        if( 'list_qty_receive' in response.data.data_grafik && response.data.data_grafik.list_qty_receive.length > 0){
                            response.data.data_grafik.list_qty_receive.forEach(element => {
                                list_qty_receive.push(element);
                            });
                        }
                        const ctx2 = document.getElementById("line-chart").getContext("2d");
                        let gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

                        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
                        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

                        let gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

                        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
                        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors
                        new Chart(ctx2, {
                            type: "line",
                            data: {
                                labels: list_inbound_planning_no,
                                datasets: [
                                    {
                                        label: "Qty Plan",
                                        tension: 0.4,
                                        borderWidth: 0,
                                        pointRadius: 0,
                                        borderColor: "#cb0c9f",
                                        borderWidth: 3,
                                        backgroundColor: gradientStroke1,
                                        fill: true,
                                        data: list_qty_plan,
                                        maxBarThickness: 6
                                    },
                                    {
                                        label: "Qty Receive",
                                        tension: 0.4,
                                        borderWidth: 0,
                                        pointRadius: 0,
                                        borderColor: "#3A416F",
                                        borderWidth: 3,
                                        backgroundColor: gradientStroke2,
                                        fill: true,
                                        data: list_qty_receive,
                                        maxBarThickness: 6
                                    },
                                ],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'bottom',
                                    }
                                },
                                interaction: {
                                    intersect: false,
                                    mode: 'index',
                                },
                                scales: {
                                    y: {
                                        grid: {
                                        drawBorder: false,
                                        display: true,
                                        drawOnChartArea: true,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                        },
                                        ticks: {
                                        display: true,
                                        padding: 10,
                                        color: '#b2b9bf',
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                        }
                                    },
                                    x: {
                                        grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                        },
                                        ticks: {
                                        display: true,
                                        color: '#b2b9bf',
                                        padding: 20,
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                        }
                                    },
                                },
                            },
                        });
                    }
                }

            },
        });

        resolve(0);
    });
}

function generateOutboundReport() {
    return new Promise((resolve,reject) => {

        $(`#container_outbound_total_planning`).html("Loading...");
        $(`#container_outbound_total_picking`).html("Loading...");
        $(`#container_outbound_total_packing`).html("Loading...");
        $(`#container_outbound_qty_planning`).html("Loading...");
        $(`#container_outbound_qty_picking`).html("Loading...");
        $(`#container_outbound_qty_packing`).html("Loading...");
        $("#chart_container_outbound").html("");

        const url = "{{ route('dashboard_getOutboundReport') }}";
        const _token = $("meta[name='csrf-token']").prop("content");
        const _method = "POST";
        const date_from_outbound = $("#date_from_outbound").val();
        const date_to_outbound = $("#date_to_outbound").val();

        const formData = new FormData();
        formData.append("_token",_token);
        formData.append("_method",_method);
        formData.append("date_from_outbound",date_from_outbound);
        formData.append("date_to_outbound",date_to_outbound);

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

                if('data' in response){
                    let total_planning = 0;
                    if('total_planning' in response.data && response.data.total_planning != null){
                        total_planning = response.data.total_planning;
                    }
                    $(`#container_outbound_total_planning`).html(`${total_planning}`);

                    let qty_planning = 0;
                    if('qty_planning' in response.data && response.data.qty_planning != null){
                        qty_planning = response.data.qty_planning;
                    }
                    $(`#container_outbound_qty_planning`).html(`${total_planning}`);

                    let total_picking = 0;
                    if('total_picking' in response.data && response.data.total_picking != null){
                        total_picking = response.data.total_picking;
                    }
                    $(`#container_outbound_total_picking`).html(`${total_planning}`);

                    let qty_picking = 0;
                    if('qty_pickinging' in response.data && response.data.qty_picking != null){
                        qty_picking = response.data.qty_picking;
                    }
                    $(`#container_outbound_qty_picking`).html(`${total_planning}`);

                    let total_packing = 0;
                    if('total_packing' in response.data && response.data.total_packing != null){
                        total_packing = response.data.total_packing;
                    }
                    $(`#container_outbound_total_packing`).html(`${total_planning}`);

                    let qty_packing = 0;
                    if('qty_packing' in response.data && response.data.qty_packing != null){
                        qty_packing = response.data.qty_packing;
                    }
                    $(`#container_outbound_qty_packing`).html(`${total_planning}`);

                    if('data_grafik' in response.data){
                        let list_outbound_planning_no = [];
                        if( 'list_outbound_planning_no' in response.data.data_grafik && response.data.data_grafik.list_outbound_planning_no.length > 0){
                            response.data.data_grafik.list_outbound_planning_no.forEach(element => {
                                list_outbound_planning_no.push(element);
                            });
                        }
                        let list_qty_planning = [];
                        if( 'list_qty_planning' in response.data.data_grafik && response.data.data_grafik.list_qty_planning.length > 0){
                            response.data.data_grafik.list_qty_planning.forEach(element => {
                                list_qty_planning.push(element);
                            });
                        }
                        let list_qty_picking = [];
                        if( 'list_qty_picking' in response.data.data_grafik && response.data.data_grafik.list_qty_picking.length > 0){
                            response.data.data_grafik.list_qty_picking.forEach(element => {
                                list_qty_picking.push(element);
                            });
                        }
                        let list_qty_packing = [];
                        if( 'list_qty_packing' in response.data.data_grafik && response.data.data_grafik.list_qty_packing.length > 0){
                            response.data.data_grafik.list_qty_packing.forEach(element => {
                                list_qty_packing.push(element);
                            });
                        }

                        $("#chart_container_outbound").html(`
                        <div class="chart">
                            <canvas id="bar-chart" class="chart-canvas" height="300px"></canvas>
                        </div>
                        `);

                        const ctx5 = document.getElementById("bar-chart").getContext("2d");
                        new Chart(ctx5, {
                            type: "bar",
                            data: {
                                labels: list_outbound_planning_no,
                                datasets: [
                                    {
                                        label: "Qty Planning",
                                        weight: 5,
                                        borderWidth: 0,
                                        borderRadius: 4,
                                        backgroundColor: '#CD0C7F',
                                        data: list_qty_planning,
                                        fill: false,
                                        maxBarThickness: 35
                                    },
                                    {
                                        label: "Qty Picking",
                                        weight: 5,
                                        borderWidth: 0,
                                        borderRadius: 4,
                                        backgroundColor: '#6c657d',
                                        data: list_qty_picking,
                                        fill: false,
                                        maxBarThickness: 35
                                    },
                                    {
                                        label: "Qty Packing",
                                        weight: 5,
                                        borderWidth: 0,
                                        borderRadius: 4,
                                        backgroundColor: '#309ed1',
                                        data: list_qty_packing,
                                        fill: false,
                                        maxBarThickness: 35
                                    },
                                ],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false,
                                    }
                                },
                                scales: {
                                    y: {
                                        grid: {
                                            drawBorder: false,
                                            display: true,
                                            drawOnChartArea: true,
                                            drawTicks: false,
                                            borderDash: [5, 5]
                                        },
                                        ticks: {
                                            display: true,
                                            padding: 10,
                                            color: '#9ca2b7'
                                        }
                                    },
                                    x: {
                                        grid: {
                                            drawBorder: false,
                                            display: false,
                                            drawOnChartArea: true,
                                            drawTicks: true,
                                        },
                                        ticks: {
                                            display: true,
                                            color: '#9ca2b7',
                                            padding: 10
                                        }
                                    },
                                },
                            },
                        });
                    }
                }
            },
        });
    });
}
$(document).ready(async function () {
    $("#li_dashboard").addClass("active");
    $("#a_dashboard").addClass("active");
    $("#logo_dashboard").addClass("d-none");
    $("#logo_white_dashboard").removeClass("d-none");

    $("#date_from").on("change",async function () {
        await generateInboundReport();
    });

    $("#date_to").on("change",async function () {
        await generateInboundReport();
    });

    $("#date_from_outbound").on("change",async function () {
        await generateOutboundReport();
    });

    $("#date_to_outbound").on("change",async function () {
        await generateOutboundReport();
    });

    try {
        await Promise.all([
            generateInboundReport(),
            generateOutboundReport(),
        ])
    } catch (error) {

    }

});
</script>
@endsection
