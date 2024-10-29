<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Shipping Load</title>
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
        <h2>Delivery Order</h2>
        <table style='width:100%;'>
            <tr>
                <td style="width: 30%;">Booking No</td>
                <td style="width: 30%;">: {{ @$data["current_data_header"][0]->booking_no }}</td>
                <td style="width: 20%;">Pickup Date</td>
                <td style="width: 20%;">: {{ (@$data["current_data_header"][0]->pickup_datetime) ? date("Y-m-d",strtotime(@$data["current_data_header"][0]->pickup_datetime)) : "" }}</td>
            </tr>
            <tr>
                <td>Pickup Name</td>
                <td>: {{ @$data["current_data_header"][0]->pickup_name }}</td>
                <td>Pickup Time</td>
                <td>: {{ (@$data["current_data_header"][0]->pickup_datetime) ? date("H:i:s",strtotime(@$data["current_data_header"][0]->pickup_datetime)) : "" }}</td>
            </tr>
            <tr>
                <td>Pickup Company</td>
                <td>: {{ @$data["current_data_header"][0]->pickup_company }}</td>
                <td>Phone</td>
                <td>: {{ @$data["current_data_header"][0]->phone }}</td>
            </tr>
            <tr>
                <td>Pickup Address</td>
                <td>: {{ @$data["current_data_header"][0]->pickup_address }}</td>
                <td>Job No</td>
                <td>: {{ @$data["current_data_header"][0]->job_no }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div style="padding-top: 1rem; padding-bottom: 2rem;">
        <table class="custom-table--bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">Outbound Planning No</th>
                    <th style="text-align: center;">Order Type</th>
                    <th style="text-align: center;">SKU</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Serial No</th>
                    <th style="text-align: center;">Batch No</th>
                    <th style="text-align: center;">Expired Date</th>
                    <th style="text-align: center;">GR ID</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: center;">UoM</th>
                    <th style="text-align: center;">Classification Item</th>
                    <th style="text-align: center;">AWB Number</th>
                    <th style="text-align: center;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @if (@$data["current_data_detail"] !== null &&  count($data["current_data_detail"]) > 0)
                @php
                    $grand_total = 0;
                @endphp
                @foreach ($data["current_data_detail"] as $current_data_detail )
                <tr>
                    <td>{{ @$current_data_detail->outbound_planning_no }}</td>
                    <td>{{ @$current_data_detail->order_type }}</td>
                    <td>{{ @$current_data_detail->sku }}</td>
                    <td>{{ @$current_data_detail->description }}</td>
                    <td>{{ @$current_data_detail->serial_no }}</td>
                    <td>{{ @$current_data_detail->batch_no }}</td>
                    <td>{{ @$current_data_detail->expired_date }}</td>
                    <td>{{ @$current_data_detail->gr_id }}</td>
                    <td>{{ @$current_data_detail->qty }}</td>
                    <td>{{ @$current_data_detail->uom_name }}</td>
                    <td>{{ @$current_data_detail->stock_type }}</td>
                    <td>{{ @$current_data_detail->awb }}</td>
                    <td>{{ @$current_data_detail->remarks }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    
    <div style="padding-bottom: 5rem;">
        <div>Notes:</div>
        <div style="width: 100%; min-height:150px; border:1px solid black;">{{ @$data["current_data_header"][0]->notes }}</div>
    </div>
    <div style="padding-bottom: 5rem;">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: center;">Operation</td>
                    <td style="text-align: center;">Admin</td>
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