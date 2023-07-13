<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $data["current_data"][0]->outbound_id }}</title>
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
    <div style="padding-bottom: 2rem;">
        <table style='width:100%;'>
            <tr>
                <td style="width: 15%;"><img src="{{ asset("img/logokonek.png") }}" style="width: 100%;" alt="Logo"></td>
                <td style="width: 85%;"><h1>Delivery Order</h1></td>
            </tr>
        </table>
    </div>
    <div style="padding-bottom: 5rem;">
        <table style='width:100%;'>
            <tr>
                <th style="width:25%;text-align:left;">Outbound ID</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->outbound_id }}</td>
                <td style="width:25%;text-align:left;"></td>
                <td style="width:25%;text-align:left;"></td>
            </tr>
            <tr>
                <th style="width:25%;text-align:left;">Date Of Recetipt</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->date_of_receipt }}</td>
                <th style="width:25%;text-align:left;">Client ID</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->client_id }}</td>
            </tr>
            <tr>
                <th style="width:25%;text-align:left;">Reference No</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->reference_no }}</td>
                <th style="width:25%;text-align:left;">Client Name</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->client_name }}</td>
            </tr>
            <tr>
                <th style="width:25%;text-align:left;">Vehicle No</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->vehicle_no }}</td>
                <th style="width:25%;text-align:left;">Container No</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->container_no }}</td>
            </tr>
            <tr>
                <th style="width:25%;text-align:left;">Vehicle Type</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->vehicle_type }}</td>
                <th style="width:25%;text-align:left;">Seal No</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->seal_no }}</td>
            </tr>
            <tr>
                <th style="width:25%;text-align:left;">Arrival Vehicle</th>
                <td style="width:25%;text-align:left;"></td>
                <th style="width:25%;text-align:left;">Start Unloading</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->start_loading }}</td>
            </tr>
            <tr>
                <th style="width:25%;text-align:left;">Departure Vehicle</th>
                <td style="width:25%;text-align:left;"></td>
                <th style="width:25%;text-align:left;">Finish Unloading</th>
                <td style="width:25%;text-align:left;">{{ @$data["current_data"][0]->finish_loading }}</td>
            </tr>
        </table>
    </div>
    <div style="padding-bottom: 5rem;">
        <table class="custom-table--bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">SKU No</th>
                    <th style="text-align: center;">Batch No</th>
                    <th style="text-align: center;">Item Name</th>
                    <th style="text-align: center;">Serial No</th>
                    <th style="text-align: center;">IMEI</th>
                    <th style="text-align: center;">Color</th>
                    <th style="text-align: center;">Size</th>
                    <th style="text-align: center;">Expired Date</th>
                    <th style="text-align: center;">Qty</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data_detail"]) > 0)
                @php
                    $grand_total = 0;
                @endphp
                @foreach ($data["current_data_detail"] as $current_data_detail )
                <tr>
                    <td style="text-align: center;">
                        {{ $current_data_detail->sku }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->batch_no }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->item_name }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->serial_no }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->imei }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->color }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->size }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->expired_date }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->qty }}
                    </td>
                </tr>
                @php
                    $grand_total = $grand_total + $current_data_detail->qty
                @endphp
                @endforeach
                @endif
                <tr>
                    <td colspan="7"></td>
                    <td style="text-align: center;">Grand Total</td>
                    <td style="text-align: center;">{{ $grand_total }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: center;">Driver</td>
                    <td style="text-align: center;">Warehouseman</td>
                    <td style="text-align: center;">Warehouseman Admin</td>
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
                    <td style="text-align: center;">(__________________)</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
