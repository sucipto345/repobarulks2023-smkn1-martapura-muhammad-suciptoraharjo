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

    // Lakukan logika autentikasi di sini
    // Misalnya, periksa ID Card Number dan Password di database

    // Jika autentikasi berhasil
    if ($authSuccess) {
        $user = // Ambil data user dari database

        // Buat token
        $token = // Generate token menggunakan library JWT atau Laravel Passport

        // Buat respon dengan format yang diinginkan
        $response = [
            'username' => $user->name,
            'password' => $password,
            'token' => $token
        ];

        // Mengembalikan respon sukses dengan kode status 200
        return response()->json($response);
    }

    // Jika autentikasi gagal
    // Mengembalikan respon error dengan kode status 401
    return response()->json(['message' => 'ID Card Number or Password incorrect'], 401);
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
