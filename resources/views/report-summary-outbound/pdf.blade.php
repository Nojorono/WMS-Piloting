<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ @$data["filename"] }}</title>
    {{-- <title>{{ "Test" }}</title> --}}
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
                <td style="width: 60%; text-align: end;"><h2>REPORT SUMMARY OUTBOUND</h2></td>
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
        </table>
    </div>
    <div style="padding-bottom: 2rem;">
        <table class="custom-table--bordered">
            <thead>
                <tr>
                    <th class="text-center">Outbound Planning No</th>
                    <th class="text-center">SKU</th>
                    <th class="text-center">Part Name</th>
                    <th class="text-center">Serial No</th>
                    <th class="text-center">Batch No</th>
                    <th class="text-center">Stock Type</th>
                    <th class="text-center">Inbound Planning No</th>
                    <th class="text-center">Qty</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data"]) > 0 )
                @foreach ($data["current_data"] as $current_data )
                <tr>
                    <td class="text-center">{{ $current_data->outbound_planning_no }}</td>
                    <td class="text-center">{{ $current_data->sku }}</td>
                    <td class="text-center">{{ $current_data->part_name }}</td>
                    <td class="text-center">{{ $current_data->serial_no }}</td>
                    <td class="text-center">{{ $current_data->batch_no }}</td>
                    <td class="text-center">{{ $current_data->stock_type }}</td>
                    <td class="text-center">{{ $current_data->inbound_planning_no }}</td>
                    <td class="text-center">{{ $current_data->qty }}</td>
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
                    <th class="text-center">Outbound Planning No</th>
                    <th class="text-center">UoM Name</th>
                    <th class="text-center">Location ID</th>
                    <th class="text-center">Consignee Name</th>
                    <th class="text-center">Consignee Address</th>
                    <th class="text-center">Consignee City</th>
                    <th class="text-center">Phone No</th>
                    <th class="text-center">AWB</th>
                    <th class="text-center">ETD</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data"]) > 0 )
                @foreach ($data["current_data"] as $current_data )
                <tr>
                    <td class="text-center">{{ $current_data->outbound_planning_no }}</td>
                    <td class="text-center">{{ $current_data->uom_name }}</td>
                    <td class="text-center">{{ $current_data->location_id }}</td>
                    <td class="text-center">{{ $current_data->consignee_name }}</td>
                    <td class="text-center">{{ $current_data->consignee_address }}</td>
                    <td class="text-center">{{ $current_data->consignee_city }}</td>
                    <td class="text-center">{{ $current_data->phone_no }}</td>
                    <td class="text-center">{{ $current_data->awb }}</td>
                    <td class="text-center">{{ $current_data->etd }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
