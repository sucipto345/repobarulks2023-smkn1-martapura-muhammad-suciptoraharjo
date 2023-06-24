<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Handle society login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'id_card_number' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('id_card_number', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful

            $user = Auth::user();
            $token = Str::random(32); // Generate a random token

            $regional = $this->getRegionalData($user->id); // Retrieve province and district dynamically

            return response()->json([
                'name' => $user->name,
                'born_date' => $user->born_date,
                'gender' => $user->gender,
                'address' => $user->address,
                'token' => $token,
                'regional' => $regional
            ]);
        } else {
            // Incorrect ID Card Number or Password

            throw ValidationException::withMessages([
                'message' => 'ID Card Number or Password incorrect',
            ])->status(401);
        }
    }

    /**
     * Retrieve province and district data dynamically.
     *
     * @param  int  $userId
     * @return array
     */
    private function getRegionalData($userId)
    {
        // Retrieve province and district data based on $userId
        // Implement the logic to fetch the data from the database or an external API

        $province = "DKI Jakarta";
        $district = "Central Jakarta";

        return [
            'id' => 1,
            'province' => $province,
            'district' => $district
        ];
    }

    /**
     * Handle society logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Perform any necessary logout actions

        return response()->json([
            'message' => 'Logout success'
        ]);
    }
}
