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
                <td style="width: 50%; text-align:left;">{{ date("d/m/Y") }}</td>
                <td style="width: 50%; text-align:right;"><img src="{{ asset("img/logokonek.png") }}" style="width: 100px;" alt="Logo"></td>
            </tr>
        </table>
    </div>
    <hr>
    <div style="padding-bottom: 1rem;">
        <table style='width:100%;'>
            <tr>
                <td style="width: 50%;">Reference No</td>
                <td style="width: 50%;">Carton No</td>
            </tr>
            <tr>
                <td style="width: 50%;">{{ @$data["current_data"][0]->reference_no }}</td>
                <td style="width: 50%;">{{ @$data["current_data"][0]->carton_id }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div style="padding-bottom: 1rem;">
        <table style='width:100%;'>
            <tr>
                <td style="width: 50%; text-align: left;"><img src="data:image/png;base64,{{ \Milon\Barcode\Facades\DNS1DFacade::getBarcodePNG(@$data["current_data"][0]->outbound_id, 'C128',1.5,23) }}" alt="barcode" /></td>
                <td style="width: 50%; ">{!! \Milon\Barcode\Facades\DNS2DFacade::getBarcodeHTML(@$data["current_data"][0]->reference_no, 'QRCODE',2,2) !!}</td>
            </tr>
            <tr>
                <td style="width: 50%;">{{ @$data["current_data"][0]->outbound_id }}</td>
                <td style="width: 50%;"></td>
            </tr>
        </table>
    </div>
    <hr>
    <div style="padding-bottom: 1rem;">
        <table style='width:100%;'>
            <tr>
                <th style="text-align:left;">Pengirim</th>
                <th style="text-align:left;">Penerima</th>
            </tr>
            <tr>
                <td>{{ @$data["current_data"][0]->supplier_name }}</td>
                <td>{{ @$data["current_data"][0]->consignee_name }} <br> {{ @$data["current_data"][0]->alamat }}<br> {{ @$data["current_data"][0]->city }}</td>
            </tr>
            <tr>
                <th style="text-align:left;">Dikirim Dari</th>
                <th style="text-align:left;">Telepon</th>
            </tr>
            <tr>
                <td>{{ @$data["current_data"][0]->wh_name }} <br> {{ @$data["current_data"][0]->consignee_address }}<br> {{ @$data["current_data"][0]->consignee_city }}</td>
                <td>{{ @$data["current_data"][0]->phone_no }}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div style="padding-bottom: 1rem;">
        <div>
            Transporter : {{ @$data["current_data"][0]->transporter_name }}
        </div>
        <div>
            Remark : {{ @$data["current_data"][0]->remark }}
        </div>
    </div>
</body>
</html>
