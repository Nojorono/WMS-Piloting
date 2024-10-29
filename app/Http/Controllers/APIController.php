<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\APIModel;

class APIController extends Controller
{
    public function getSKUforMobileApp($inbound_planning_no)
    {
        // Ambil data dari database
        $dataSKU = DB::table('t_wh_inbound_planning_detail')
            ->where('inbound_planning_no', $inbound_planning_no)
            ->get();


        // Ambil SKU dari setiap item
        $skuList = [];
        foreach ($dataSKU as $item) {
            $skuList[] = $item->SKU;
        }
        $resOutStanding = $this->checkOutstanding($inbound_planning_no, $skuList);

        // Kembalikan response dalam format JSON
        return response()->json([
            'data' => $resOutStanding,
        ], 200);
    }
}
