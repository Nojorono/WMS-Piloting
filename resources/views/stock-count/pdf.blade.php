<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $data["current_data"][0]->stock_count_id }}</title>
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
                <td style="width: 85%;"><h1>Stock Count List</h1></td>
                <td style="width: 15%;"><img src="{{ asset("img/logo-nojorono-biru-2.png") }}" style="width: 100%;" alt="Logo"></td>
            </tr>
        </table>
    </div>
    <div>
        <table class="" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%;"><img src="data:image/png;base64,{{ \Milon\Barcode\Facades\DNS1DFacade::getBarcodePNG($data["current_data"][0]->stock_count_id, 'C128',1.5,33) }}" alt="barcode" /></td>
                    <td style="text-align: center; width: 50%;"><b>{{ $data["current_data"][0]->count_no }}</b></td>
                </tr>
                <tr>
                    <td colspan="2">{{ $data["current_data"][0]->stock_count_id }}</td>
                </tr>

            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 1rem;">
        <table class="" style="width: 100%;">
            <tr>
                <th style="width: 25%; text-align:left;"></th>
                <td style="width: 25%; text-align:left;"></td>
                <th style="width: 25%; text-align:left;">Count Date</th>
                <td style="width: 25%; text-align:left;">: {{ $data["current_data"][0]->count_date }}</td>
            </tr>
            <tr>
                <th style="width: 25%; text-align:left;">Client ID</th>
                <td style="width: 25%; text-align:left;">: {{ session("current_client_id") }}</td>
                <th style="width: 25%; text-align:left;">Warehouse ID</th>
                <td style="width: 25%; text-align:left;">: {{ session("current_warehouse_id") }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div style="padding-bottom: 1rem;">
        <table style='width:100%;' class="custom-table--bordered">
            <thead>
                <tr>
                    <th>Location ID</th>
                    <th>SKU No</th>
                    <th>Item Name</th>
                    <th>Batch No</th>
                    <th>Serial No</th>
                    <th>Expired Date</th>
                    <th>Qty On Hand</th>
                    <th>Actual Qty</th>
                    <th>UOM</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_detail"]) > 0)
                @foreach ( $data["current_detail"] as $current_detail)
                <tr>
                    <td style="text-align: center;">{{ $current_detail->location_id }}</td>
                    <td style="text-align: center;">{{ $current_detail->sku }}</td>
                    <td style="text-align: center;">{{ $current_detail->item_name }}</td>
                    <td style="text-align: center;">{{ $current_detail->batch_no }}</td>
                    <td style="text-align: center;">{{ $current_detail->serial_no }}</td>
                    <td style="text-align: center;">{{ $current_detail->expired_date }}</td>
                    <td style="text-align: center;">{{ $current_detail->on_hand_qty }}</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">{{ $current_detail->uom_name }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 3rem;">
        <table class="" style="width: 100%;">
            <tr>
                <th style="width:20%;">Starting Counting</th>
                <td style="width:20%;">: {{ $data["current_detail"][0]->datetime_start_counting }}</td>
                <td style="width:60%;"></td>
            </tr>
            <tr>
                <th style="width:20%;">Finished Counting</th>
                <td style="width:20%;">: {{ $data["current_detail"][0]->datetime_finish_counting }}</td>
                <td style="width:60%;"></td>
            </tr>
        </table>
    </div>
    <div style="padding-bottom: 5rem;">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: center;">Stock Counter</td>
                    <td style="text-align: center;">Supervisor</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                 <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                 <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;">(__________________)</td>
                    <td style="text-align: center;">(__________________)</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
