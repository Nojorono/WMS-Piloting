<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $data["current_data"]->inbound_planning_no }}</title>
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
        <h2>INBOUND PLANNING</h2>
        <table style='width:100%;'>
            <tr>
                <td style="width: 30%;">Client ID</td>
                <td style="width: 30%;">: {{ $data["current_data_client_project"][0]->client_id}}</td>
                <td style="width: 20%;"></td>
                <td style="width: 20%;"></td>
            </tr>
            <tr>
                <td>Client Name</td>
                <td>: {{ $data["current_data_client_project"][0]->client_name}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Inbound Planning No </td>
                <td>: {{ $data["current_data"]->inbound_planning_no}}</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <hr>
    <div style="padding-top: 1rem; padding-bottom: 2rem;">
        <table class="custom-table--bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">SKU No</th>
                    <th style="text-align: center;">Item Name</th>
                    <th style="text-align: center;">Batch No</th>
                    <th style="text-align: center;">Expired Date</th>
                    <th style="text-align: center;">UOM</th>
                    <th style="text-align: center;">Qty Plan</th>
                    <th style="text-align: center;">Qty Receive</th>
                    <th style="text-align: center;">Classification</th>
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
                        {{ @$current_data_detail->sku }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->item_name }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->batch_no }}
                    </td>
                    <td style="text-align: center;">
                        {{ (!empty(@$current_data_detail->expired_date)) ? date("Y-m-d",strtotime(@$current_data_detail->expired_date)) : "" }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->uom_name }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->qty_plan }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->qty_receive }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->classification_name }}
                    </td>
                </tr>
                @php
                    $grand_total = $grand_total + @$current_data_detail->qty
                @endphp
                @endforeach
                <tr>
                    <td style="text-align: center; border: none;" colspan="4">
                        
                    </td>
                    <td style="text-align: center; ">
                        Grand Total
                    </td>
                    <td style="text-align: center; ">
                        {{ $grand_total }}
                    </td>
                    <td style="text-align: center; border: none;" colspan="2">
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div style="padding-top: 1rem; padding-bottom: 3rem;">
        <table class="custom-table--bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">SKU No</th>
                    <th style="text-align: center;">Item Name</th>
                    <th style="text-align: center;">Batch No</th>
                    <th style="text-align: center;">Serial No</th>
                    <th style="text-align: center;">IMEI No</th>
                    <th style="text-align: center;">Part No</th>
                    <th style="text-align: center;">Color</th>
                    <th style="text-align: center;">Size</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data["current_data_detail"]) > 0)
                @foreach ($data["current_data_detail"] as $current_data_detail )
                <tr>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->sku }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->item_name }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->batch_no }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->serial_no }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->imei }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->part_no }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->color }}
                    </td>
                    <td style="text-align: center;">
                        {{ @$current_data_detail->size }}
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 5rem;">
        <div>Remarks:</div>
        <div style="width: 100%; min-height:150px; border:1px solid black;"></div>
    </div>
    <div style="padding-bottom: 5rem;">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: center;">Driver</td>
                    <td style="text-align: center;">Warehouseman</td>
                    <td style="text-align: center;">Supervisor</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                 <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                 <tr>
                    <td colspan="3">&nbsp;</td>
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