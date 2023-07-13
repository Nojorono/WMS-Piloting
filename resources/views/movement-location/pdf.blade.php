<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $data["data_header"][0]->movement_id }}</title>
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
                <td style="width: 0%;"><h2>MOVEMENT LOCATION</h2></td>
                <td style="width: 10%; text-align: end;"><img src="{{ asset('img/logokonek.png') }}" style="width:100px;"></td>
            </tr>
        </table>

    </div>
    <div style="padding-bottom: 2rem;">
        <table class="" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width:50%;">
                        <img src="data:image/png;base64,{{ \Milon\Barcode\Facades\DNS1DFacade::getBarcodePNG($data["data_header"][0]->movement_id, 'C128',1.5,33) }}" alt="barcode" />
                        <div>
                            {{$data["data_header"][0]->movement_id}}
                        </div>
                    </td>
                    <td style="width:50%;">

                    </td>
                </tr>
                <tr>
                    <td style="width:50%;"><b>Client ID:</b> {{ $data["data_header"][0]->client_name }}</td>
                    <td style="width:50%;"><b>Warehouse ID:</b> {{ $data["data_header"][0]->wh_code }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 2rem;">
        <table class="custom-table--bordered" style="width:100%;">
            <thead>
                <tr>
                    <th class="text-center">SKU</th>
                    <th class="text-center">Item Name</th>
                    <th class="text-center">Batch No</th>
                    <th class="text-center">Serial No</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">UoM Name</th>
                    <th class="text-center">Source Location ID</th>
                    <th class="text-center">Dest Location ID</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($data["data_detail"]) && count($data["data_detail"]) > 0 )
                @foreach ($data["data_detail"] as $data_detail )
                <tr>
                    <td>{{ @$data_detail->sku }}</td>
                    <td>{{ @$data_detail->part_name }}</td>
                    <td>{{ @$data_detail->batch_no }}</td>
                    <td>{{ @$data_detail->serial_no }}</td>
                    <td>{{ @$data_detail->qty }}</td>
                    <td>{{ @$data_detail->uom_name }}</td>
                    <td>{{ @$data_detail->location_from }}</td>
                    <td>{{ @$data_detail->location_to }}</td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
    </div>
    <div style="padding-bottom: 2rem;">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: center;">Warehouseman</td>
                    <td style="text-align: center;">Warehouse Admin</td>
                    <td style="text-align: center;">Supervisor</td>
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
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
