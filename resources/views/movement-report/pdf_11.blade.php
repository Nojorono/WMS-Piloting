<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ @$data["filename"] }}</title>
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
                <td style="width: 40%;"><img src="{{ asset('img/logokonek.png') }}" style="width:100px;"></td>
                <td style="width: 60%; text-align: end;"><h2>Movement Report</h2></td>
            </tr>
        </table>
    </div>
    <div style="padding-bottom: 1rem; ">
        <table class="" style="width: 100%;">
            <tr>
                <td style="width: 15%;">Date From</td>
                <td style="width: 35%;">: {{ @$data["date_from"] }}</td>
                <td style="width: 15%;">Date To</td>
                <td style="width: 35%;">: {{ @$data["date_to"] }}</td>
            </tr>
            <tr>
                <td style="width: 15%;">Code</td>
                <td style="width: 35%;">: {{ @$data["display_process_code"] }}</td>
                <td style="width: 15%;"></td>
                <td style="width: 35%;"></td>
            </tr>
        </table>
    </div>
    <div style="padding-bottom: 2rem;">
        <table class="custom-table--bordered">
            <thead>
                <tr>
                    <th class="text-center">Movement ID</th>
                    <th class="text-center">Source SKU</th>
                    <th class="text-center">Dest SKU</th>
                    <th class="text-center">Source Part Name</th>
                    <th class="text-center">Dest Part Name</th>
                    <th class="text-center">Source Serial No</th>
                    <th class="text-center">Dest Serial No</th>
                    <th class="text-center">Source Batch No</th>

                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data"]) > 0 )
                @foreach ($data["current_data"] as $current_data )
                <tr>
                    <td class="text-center">{{ $current_data->movement_id }}</td>
                    <td class="text-center">{{ $current_data->source_sku }}</td>
                    <td class="text-center">{{ $current_data->dest_sku }}</td>
                    <td class="text-center">{{ $current_data->source_item_name }}</td>
                    <td class="text-center">{{ $current_data->dest_item_name }}</td>
                    <td class="text-center">{{ $current_data->source_serial_no }}</td>
                    <td class="text-center">{{ $current_data->dest_serial_no }}</td>
                    <td class="text-center">{{ $current_data->source_batch_no }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 2rem;">
        <table class="custom-table--bordered">
            <thead>
                <tr>
                    <th class="text-center">Movement ID</th>
                    <th class="text-center">Source SKU</th>
                    <th class="text-center">Dest Batch No</th>
                    <th class="text-center">Source Expired Date</th>
                    <th class="text-center">Dest Expired Date</th>
                    <th class="text-center">Source Location</th>
                    <th class="text-center">Dest Location</th>
                    <th class="text-center">Source Qty</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data"]) > 0 )
                @foreach ($data["current_data"] as $current_data )
                <tr>
                    <td class="text-center">{{ $current_data->movement_id }}</td>
                    <td class="text-center">{{ $current_data->source_sku }}</td>
                    <td class="text-center">{{ $current_data->dest_batch_no }}</td>
                    <td class="text-center">{{ $current_data->source_exp_date }}</td>
                    <td class="text-center">{{ $current_data->dest_exp_date }}</td>
                    <td class="text-center">{{ $current_data->source_location }}</td>
                    <td class="text-center">{{ $current_data->dest_location }}</td>
                    <td class="text-center">{{ $current_data->source_qty }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 2rem;">
        <table class="custom-table--bordered">
            <thead>
                <tr>
                    <th class="text-center">Movement ID</th>
                    <th class="text-center">Source SKU</th>
                    <th class="text-center">Dest Qty</th>
                    <th class="text-center">Source UoM</th>
                    <th class="text-center">Dest UoM</th>
                    <th class="text-center">Source Stock Type</th>
                    <th class="text-center">Dest Stock Type</th>
                    <th class="text-center">Source GR ID</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data"]) > 0 )
                @foreach ($data["current_data"] as $current_data )
                <tr>
                    <td class="text-center">{{ $current_data->movement_id }}</td>
                    <td class="text-center">{{ $current_data->source_sku }}</td>
                    <td class="text-center">{{ $current_data->dest_qty }}</td>
                    <td class="text-center">{{ $current_data->source_uom }}</td>
                    <td class="text-center">{{ $current_data->dest_uom }}</td>
                    <td class="text-center">{{ $current_data->source_stock_id }}</td>
                    <td class="text-center">{{ $current_data->dest_stock_id }}</td>
                    <td class="text-center">{{ $current_data->source_gr }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

</body>
</html>
