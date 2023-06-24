<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
{
    // Validasi input
    $request->validate([
        'id_card_number' => 'required',
        'password' => 'required',
    ]);



    if ($authSuccess) {
        $user =


        $token =

        $response = [
            'username' => $user->name,
            'password' => $password,
            'token' => $token
        ];

        return response()->json($response);
    }

    return response()->json(['message' => 'ID Card or Password incorrect'], 401);
}
public function logout(Request $request)
{
    $request->validate([
        'token' => 'required',
    ]);

    if ($tokenValid) {
        return response()->json(['message' => 'Logout success']);
    }

    return response()->json(['message' => 'Invalid token'], 401);
}

}
