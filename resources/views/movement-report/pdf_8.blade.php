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
                <td style="width: 40%;"><img src="{{ asset('img/logo-nojorono-biru-2.png') }}" style="width:100px;"></td>
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
                    <th class="text-center">SKU</th>
                    <th class="text-center">Part Name</th>
                    <th class="text-center">Serial No</th>
                    <th class="text-center">Batch No</th>
                    <th class="text-center">Expired Date</th>
                    <th class="text-center">Location Type From</th>
                    <th class="text-center">Location From</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data"]) > 0 )
                @foreach ($data["current_data"] as $current_data )
                <tr>
                    <td class="text-center">{{ $current_data->movement_id }}</td>
                    <td class="text-center">{{ $current_data->sku }}</td>
                    <td class="text-center">{{ $current_data->part_name }}</td>
                    <td class="text-center">{{ $current_data->serial_no }}</td>
                    <td class="text-center">{{ $current_data->batch_no }}</td>
                    <td class="text-center">{{ $current_data->expired_date }}</td>
                    <td class="text-center">{{ $current_data->location_type_from }}</td>
                    <td class="text-center">{{ $current_data->location_from }}</td>
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
                    <th class="text-center">Location Type To</th>
                    <th class="text-center">Location To</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">UoM Name</th>
                    <th class="text-center">Stock Type</th>
                    <th class="text-center">GR ID</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data"]) > 0 )
                @foreach ($data["current_data"] as $current_data )
                <tr>
                    <td class="text-center">{{ $current_data->movement_id }}</td>
                    <td class="text-center">{{ $current_data->location_type_to }}</td>
                    <td class="text-center">{{ $current_data->location_to }}</td>
                    <td class="text-center">{{ $current_data->qty }}</td>
                    <td class="text-center">{{ $current_data->uom_name }}</td>
                    <td class="text-center">{{ $current_data->stock_id }}</td>
                    <td class="text-center">{{ $current_data->gr_id }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
