<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordController extends Controller
{

    private $menu_id = 46;
    private $datetime_now;

    public function __construct()
    {
        $this->middleware('check_user_access_read:' . $this->menu_id)->only([
            'index',
        ]);
        $this->middleware('check_user_access_update:' . $this->menu_id)->only([
            'update',
        ]);

        $this->datetime_now = date("Y-m-d H:i:s");
    }

    public function index()
    {
        $username = session('username');

        $user = DB::table('t_wh_user')
            ->select('username', 'fullname', 'email')
            ->where('is_active', 'Y')
            ->where('username', $username)
            ->first();

        return view('user-change-password.index', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $email = $request->input("email");
        $hashingPassword = Hash::make($request->input("password"));

        if ($email == 'null') {
            return response()->json(['error' => true, 'message' => 'Email tidak boleh kosong']);
        }

        $user = DB::table("t_wh_user")->where("username", $id)->where("email", $email)->first();

        if ($user) {
            try {
                DB::table("t_wh_user")->where("username", $id)->update([
                    "password" => $hashingPassword,
                    "updated_at" => $this->datetime_now,
                ]);

                return response()->json(['success' => true, 'message' => 'Your password has been updated !']);
                
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Error updating password: ' . $e->getMessage()]);
            }
        } else {
            return response()->json(['error' => true, 'message' => 'User or Email not found']);
        }
    }

}
