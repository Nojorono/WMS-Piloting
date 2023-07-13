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
    <div style="padding-bottom: 1rem;">
        <table style='width:100%;'>
            <tr>
                <td style="width: 15%;"><img src="{{ asset("img/logokonek.png") }}" style="width: 100%;" alt="Logo"></td>
                <td style="width: 85%;"><h1>Picking List</h1></td>
            </tr>
        </table>
    </div>
    <div style="padding-bottom: 1rem;">
        <table style='width:100%;'>
            <tr>
                <td style="width: 15%;">Outbound ID</td>
                <td style="width: 35%; text-align:center;">
                    <img src="data:image/png;base64,{{ \Milon\Barcode\Facades\DNS1DFacade::getBarcodePNG(@$data["current_data"][0]->outbound_id, 'C128',1,33) }}" alt="barcode" />
                    <br>
                    {{ $data["current_data"][0]->outbound_id }}
                </td>
                <td style="width: 15%;">Reference No</td>
                <td style="width: 35%; text-align:center;">
                    <img src="data:image/png;base64,{{ \Milon\Barcode\Facades\DNS1DFacade::getBarcodePNG(@$data["current_data"][0]->reference_no, 'C128',1,33) }}" alt="barcode" />
                    <br>
                    {{ $data["current_data"][0]->reference_no }}
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <div style="padding-bottom: 1rem;">
        <table style='width:100%;'>
            <tr>
                <td style="text-align: left;"><b>Client Name</b> :</td>
                <td style="text-align: left;">{{ $data["current_data"][0]->client_name }}</td>
                <td style="text-align: left;"><b>Plan Delivery Date</b> :</td>
                <td style="text-align: left;">{{ date("d/m/Y",strtotime($data["current_data"][0]->plan_delivery_date)) }}</td>
            </tr>
            <tr>
                <td style="text-align: left;"><b>Picker</b> :</td>
                <td style="text-align: left;">{{ $data["current_data"][0]->picker }}</td>
                <td style="text-align: left;"><b>Service Type</b> :</td>
                <td style="text-align: left;">{{ $data["current_data"][0]->service_type }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div style="padding-bottom: 1rem;">
        <table style='width:100%;' class="custom-table--bordered">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>SKU No</th>
                    <th>Item Name</th>
                    <th>Batch No</th>
                    <th>Serial No</th>
                    <th>Expired Date</th>
                    <th>Pick Qty</th>
                    <th>UOM</th>
                    <th>Stock Type</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data"]) > 0)
                @foreach ( $data["current_data"] as $current_data)
                <tr>
                    <td style="text-align: center;">{{ $current_data->location }}</td>
                    <td style="text-align: center;">{{ $current_data->sku_no }}</td>
                    <td style="text-align: center;">{{ $current_data->item_name }}</td>
                    <td style="text-align: center;">{{ $current_data->batch_no }}</td>
                    <td style="text-align: center;">{{ $current_data->serial_no }}</td>
                    <td style="text-align: center;">{{ $current_data->expired_date }}</td>
                    <td style="text-align: center;">{{ $current_data->pick_qty }}</td>
                    <td style="text-align: center;">{{ $current_data->uom }}</td>
                    <td style="text-align: center;">{{ $current_data->stock_type }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
