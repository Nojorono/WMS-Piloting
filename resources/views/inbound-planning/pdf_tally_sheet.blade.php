<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $data["data_header"][0]->inbound_planning_no }}</title>
    <style>
.page-break {
    page-break-after: always;
}
.custom-table--bordered ,.custom-table--bordered th , .custom-table--bordered td
{
    border-collapse: collapse;
    border: solid 1px black;
    padding: 1px 2px;
}
    </style>
</head>
<body>
    <div style="padding-bottom: 1rem; ">
        <table class="" style="width: 100%;">
            <tr>
                <td style="width: 20%;"><img src="{{ asset('img/logo-nojorono-biru-2.png') }}" style="width:100px;"></td>
                <td ><h2>INBOUND TALLY SHEET</h2></td>
            </tr>
        </table>
    </div>
    <div style="padding-bottom: 2rem;">
        <table class="" style="width: 100%;">
            <tbody>
                <tr>
                    <th style="width: 25%; text-align:left;">Inbound ID</th>
                    <td style="width: 25%; border: solid 1px black;">{{ @$data["data_header"][0]->inbound_planning_no }}</td>
                    <th style="width: 25%; text-align:left;"></th>
                    <td style="width: 25%;"></td>
                </tr>
                <tr>
                    <th style="width: 25%; text-align:left;">Date of Receipt</th>
                    <td style="width: 25%; border: solid 1px black;">{{ @$data["data_header"]->date_of_receipt }}</td>
                    <th style="width: 25%; text-align:left;">Client ID</th>
                    <td style="width: 25%; border: solid 1px black;">{{ @$data["data_header"][0]->client_id }}</td>
                </tr>
                <tr>
                    <th style="width: 25%; text-align:left;">Reference No</th>
                    <td style="width: 25%; border: solid 1px black;">{{ @$data["data_header"]->reference_no }}</td>
                    <th style="width: 25%; text-align:left;">Client Name</th>
                    <td style="width: 25%; border: solid 1px black;">{{ @$data["data_header"][0]->client_name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 2rem;">
        <div>
            <center><h2>INBOUND VEHICLE</h2></center>
        </div>
        <table class="custom-table--bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 10%;">Vehicle No</th>
                    <th style="width: 10%;">Vehicle Type</th>
                    <th style="width: 10%;">Container No</th>
                    <th style="width: 10%;">Seal No</th>
                    <th style="width: 10%;">Arrival Vehicle</th>
                    <th style="width: 10%;">Departure Vehicle</th>
                    <th style="width: 10%;">Start Unloading</th>
                    <th style="width: 10%;">Finish Unloading</th>
                    <th style="width: 20%;">Driver Sign</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($data["data_vehicle"]) && count($data["data_vehicle"]) > 0)
                @foreach ($data["data_vehicle"] as $data_vehicle)
                <tr>
                    <td>{{ @$data_vehicle->vehicle_no }}</td>
                    <td>{{ @$data_vehicle->vehicle_type }}</td>
                    <td>{{ @$data_vehicle->container_no }}</td>
                    <td>{{ @$data_vehicle->seal_no }}</td>
                    <td>{{ @$data_vehicle->arrival_date }}</td>
                    <td>{{ @$data_vehicle->departure_date }}</td>
                    <td>{{ @$data_vehicle->start_unloading }}</td>
                    <td>{{ @$data_vehicle->finish_unloading }}</td>
                    <td></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 2rem;">
        <div>
            <center><h2>INBOUND ACTUAL RECEIVING</h2></center>
        </div>
        <div style="padding-bottom: 1rem;">
            <table class="custom-table--bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>SKU No</th>
                        <th>Item Name</th>
                        <th>Batch No</th>
                        <th>Expired Date</th>
                        <th>Plan Qty</th>
                        <th>Receive Qty</th>
                        <th>Discrepancy</th>
                        <th>UoM</th>
                    </tr>
                </thead>
                <tbody>

                    @if (isset($data["data_actual_receiving"]) && count($data["data_actual_receiving"]) > 0)
                    @php
                        $sum_qty_plan = 0;
                        $sum_qty_receive = 0;
                        $sum_discrepancy = 0;
                    @endphp
                    @foreach ($data["data_actual_receiving"] as $data_actual_receiving)
                    @php
                        $sum_qty_plan = $sum_qty_plan + @$data_actual_receiving->qty_plan;
                        $sum_qty_receive = $sum_qty_receive + @$data_actual_receiving->qty_receive;
                        $sum_discrepancy = $sum_discrepancy + @$data_actual_receiving->discrepancy;
                    @endphp
                    <tr>
                        <td>{{ @$data_actual_receiving->sku }}</td>
                        <td>{{ @$data_actual_receiving->item_name }}</td>
                        <td>{{ @$data_actual_receiving->batch_no }}</td>
                        <td>{{ @$data_actual_receiving->expired_date }}</td>
                        <td>{{ @$data_actual_receiving->qty_plan }}</td>
                        <td>{{ @$data_actual_receiving->qty_receive }}</td>
                        <td>{{ @$data_actual_receiving->discrepancy }}</td>
                        <td>{{ @$data_actual_receiving->uom_name }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Grand Total</td>
                        <td>{{ $sum_qty_plan }}</td>
                        <td>{{ $sum_qty_receive }}</td>
                        <td>{{ $sum_discrepancy }}</td>
                        <td></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div style="padding-bottom: 2rem;">
        <div>
            <center><h2>INBOUND RECEIVING STATUS</h2></center>
        </div>
        <div style="padding-bottom: 1rem;">
            <table class="custom-table--bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>SKU No</th>
                        <th>Item Name</th>
                        <th>Batch No</th>
                        <th>Expired Date</th>
                        <th>Receive Qty</th>
                        <th>Stock Type</th>
                        <th>UoM</th>
                        <th>Item Classification</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data["data_receiving_status"]) && count($data["data_receiving_status"]) > 0)
                    @php
                        $sum_qty_receive = 0;
                    @endphp
                    @foreach ($data["data_receiving_status"] as $data_receiving_status)
                    @php
                        $sum_qty_receive = $sum_qty_receive + $data_receiving_status->qty_receive;
                    @endphp
                    <tr>
                        <td>{{ @$data_receiving_status->sku }}</td>
                        <td>{{ @$data_receiving_status->item_name }}</td>
                        <td>{{ @$data_receiving_status->batch_no }}</td>
                        <td>{{ @$data_receiving_status->expired_date }}</td>
                        <td>{{ @$data_receiving_status->qty_receive }}</td>
                        <td>{{ @$data_receiving_status->stock_id }}</td>
                        <td>{{ @$data_receiving_status->uom_name }}</td>
                        <td>{{ @$data_receiving_status->classification_name }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Grand Total</td>
                        <td>{{ $sum_qty_receive }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div style="padding-bottom: 2rem;">
        <b>Bap No.</b>
    </div>
    <div style="padding-bottom: 2rem;">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: center;">Warehouseman</td>
                    <td style="text-align: center;">Warehouse Admin</td>
                    <td style="text-align: center;">Supervisor</td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;">(__________________)</td>
                    <td style="text-align: center;">(__________________)</td>
                    <td style="text-align: center;">(__________________)</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
