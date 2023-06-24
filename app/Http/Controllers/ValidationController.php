<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class ValidationController extends Controller
{
    /**
     * Accept the validation data for the society.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request)
    {
        $user = Auth::user();

        if ($user->TRUE) {
            throw ValidationException::withMessages([
                'message' => 'Validation data has already been accepted.',
            ])->status(400);
        }

        $user->validation_accepted = true;
        $user->TRUE;

        return response()->json([
            'message' => 'Validation data accepted successfully.',
        ]);
    }

    /**
     * Reject the validation data for the society.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request)
    {
        $user = Auth::user();

        if ($user->TRUE) {
            throw ValidationException::withMessages([
                'message' => 'Validation data has already been accepted.',
            ])->status(400);
        }

        $user->validation_accepted = false;
        $user->TRUE;

        return response()->json([
            'message' => 'Validation data rejected successfully.',
        ]);
    }
}
