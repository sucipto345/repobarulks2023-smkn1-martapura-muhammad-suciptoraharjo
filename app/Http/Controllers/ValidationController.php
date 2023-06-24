<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function requestValidation(Request $request)
{
    $request->validate([
        'token' => 'required',
        'work_experience' => 'required|string',
        'job_category' => 'required|string',
        'job_position' => 'required|string',
        'reason_accepted' => 'required|string',
    ]);

    if ($validationSuccess) {

        return response()->json(['message' => 'Request data validation sent successfully']);
    }
    return response()->json(['message' => 'Unauthorized user'], 401);
}
public function getValidations(Request $request)
{
    $request->validate([
        'token' => 'required',
    ]);

    return response()->json([
        'validation' => [
            'id' => $validationId,
            'status' => $validationStatus,
            'work_experience' => $workExperience,
            'job_category_id' => $jobCategoryId,
            'job_position' => $jobPosition,
            'reason_accepted' => $reasonAccepted,
            'validator_notes' => $validatorNotes,
            'validator' => $validatorData,
        ],
    ]);
}


}
