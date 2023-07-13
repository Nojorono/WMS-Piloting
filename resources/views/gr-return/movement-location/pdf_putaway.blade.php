<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ @$data["current_data_header"][0]->gr_return_id }}</title>
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
        <b>Putaway List</b>
    </div>
    <div >
        <table class="" style="width: 100%;">
            <tbody>
                <tr>
                    <td colspan="4"><img src="data:image/png;base64,{{ \Milon\Barcode\Facades\DNS1DFacade::getBarcodePNG(@$data["current_data_header"][0]->gr_return_id, 'C128',1.5,33) }}" alt="barcode" /></td>
                </tr>
                <tr>
                    <td colspan="4" style="width: 20%;">{{ @$data["current_data_header"][0]->gr_return_id }}</td>
                </tr>
                <tr>
                    <th style="width: 20%; text-align:left;">Client Name</th>
                    <td style="width: 20%;">: {{ @$data["current_data_header"][0]->client_name  }}</td>
                    <th style="width: 20%; text-align:left;">Warehouse Name</th>
                    <td style="width: 20%;">: {{ @$data["current_data_header"][0]->wh_name  }}</td>
                </tr>
                <tr>
                    <th style="width: 20%; text-align:left;">Reference No</th>
                    <td style="width: 20%;">: {{ @$data["current_data_header"][0]->reference_no }}</td>
                    <th style="width: 20%; text-align:left;">Warehouseman</th>
                    <td style="width: 20%;">: {{ @$data["username_input"] }}</td>
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
                    <th style="text-align: center;">Batch No</th>
                    <th style="text-align: center;">Serial No</th>
                    <th style="text-align: center;">Putaway Qty</th>
                    <th style="text-align: center;">UOM</th>
                    <th style="text-align: center;">Stock Type</th>
                    <th style="text-align: center;">Dest Location ID</th>
                    <th style="text-align: center;">Dest Location Type</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grand_total = 0;
                @endphp
                @if (count(@$data["current_data_detail"]) > 0)
               
                @foreach (@$data["current_data_detail"] as $current_data_detail )
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
                        {{ $current_data_detail->serial_no }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->putaway_qty }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->uom_name }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->stock_id }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->location_to }}
                    </td>
                    <td style="text-align: center;">
                        {{ $current_data_detail->location_type_to }}
                    </td>
                </tr>
                @php
                    $grand_total = $grand_total + $current_data_detail->putaway_qty
                @endphp
                @endforeach
                @endif
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align: center;">Grand Total</td>
                    <td style="text-align: center;">{{ $grand_total }}</td>
                    <td colspan="4"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 5rem;">
        <table style="width: 100%;">
            <tbody>
                <tr>

                    <td style="text-align: center;">Warehouseman</td>
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