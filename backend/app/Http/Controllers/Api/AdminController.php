<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    /* ******************************************** */
    /*                     LOGIN                    */
    /* ******************************************** */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'msg' => "logged in Successfully",
                'user' => $user,
                'token' => $user->createToken('Admin Token')->accessToken
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => "Invalid Login Details"
            ]);
        }
    } // login function

    /* ******************************************** */
    /*                    LOGOUT                    */
    /* ******************************************** */

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => true
        ]);
    }
}
