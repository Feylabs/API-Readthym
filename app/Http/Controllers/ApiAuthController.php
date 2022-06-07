<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only("email", "password");
        $user = User::where('email', '=', $request->email)->first();

        if ($user == null) {
            return RazkyFeb::error(400, "User Tidak Ditemukan");
        }
        $checkPass = Hash::check($request->password, $user->password);

        if ($checkPass) {
            return RazkyFeb::responseSuccessWithData(
                200, 200, 1, "Login Berhasil", "Success",
                $user
            );
        } else {
            return RazkyFeb::responseErrorWithData(
                400, 400, 0, "Login Gagal", "Failed", null
            );
        }
    }

    public function register(Request $request){
        $name = $request->name;
        $password = $request->password;
        $email = $request->email;

        $obj = new User();
        $obj->name=$name;
        $obj->password= Hash::make($password);
        $obj->email=$email;
        $obj->role=3;

        if ($obj->save()) {
            return RazkyFeb::responseSuccessWithData(
                200, 200, 1, "Register", "Success",
                $obj
            );
        } else {
            return RazkyFeb::responseErrorWithData(
                400, 400, 0, "Login Gagal", "Failed", null
            );
        }
    }

}
