<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIModel extends Model
{
    use HasFactory;

    protected $table = 't_wh_inbound_planning'; // Nama tabel utama
    protected $primaryKey = 'inbound_planning_no'; // Kunci primer
    // Tambahkan fillable atau guarded jika diperlukan

    public function getOrderListForMobileApp($checker, Request $request)
    {
        // Ambil data menggunakan Eloquent
        $dt = self::where('status_id', 'UIN')
            ->whereHas('activities', function ($query) use ($checker) {
                $query->where('checker', $checker);
            })
            ->with('activities:checker,inbound_planning_no,location_from,datetime_created') // ambil data terkait
            ->get();

        // Mengambil token CSRF
        $csrfToken = $request->session()->token();

        // Return the result as JSON including the CSRF token
        return response()->json([
            'data' => $dt,
            'csrf_token' => $csrfToken
        ]);
    }
}
