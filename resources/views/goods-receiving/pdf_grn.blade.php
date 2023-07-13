<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $data["current_data"]->gr_id }}</title>
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
        <b>GR NOTE</b>
    </div>
    <div >
        <table class="" style="width: 100%;">
            <tbody>
                <tr>
                    <td colspan="4"><img src="data:image/png;base64,{{ \Milon\Barcode\Facades\DNS1DFacade::getBarcodePNG($data["current_data"]->gr_id, 'C128',1.5,33) }}" alt="barcode" /></td>
                </tr>
                <tr>
                    <td colspan="4" style="width: 20%;">{{ $data["current_data"]->gr_id }}</td>
                </tr>
                <tr>

                    <th style="width: 20%; text-align:left;">Client ID</th>
                    <td style="width: 20%;">{{ session("current_client_id")}}</td>
                    <td style="width: 20%;"></td>
                    <td style="width: 20%;"></td>
                </tr>
                <tr>
                    <th style="width: 20%; text-align:left;">Reference No</th>
                    <td style="width: 20%;">{{ $data["current_data"]->reference_no }}</td>
                    <th style="width: 20%; text-align:left;">GR Date</th>
                    <td style="width: 20%;">{{ $data["current_data"]->gr_date }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <hr>
    <div style="padding-top: 1rem; padding-bottom: 5rem;">
        <table class="custom-table--bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">SKU No</th>
                    <th style="text-align: center;">Item Name</th>
                    <th style="text-align: center;">Batch</th>
                    <th style="text-align: center;">Expired Date</th>
                    <th style="text-align: center;">Qty Received</th>
                    <th style="text-align: center;">UOM</th>
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
                        {{ $current_data_detail->item_name }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->batch_no }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->expired_date }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->qty_receive }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->uom_name }}
                    </td>
                </tr>
                @php
                    $grand_total = $grand_total + $current_data_detail->qty_receive
                @endphp
                @endforeach
                @endif
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align: center;">Grand Total</td>
                    <td style="text-align: center;">{{ $grand_total }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
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