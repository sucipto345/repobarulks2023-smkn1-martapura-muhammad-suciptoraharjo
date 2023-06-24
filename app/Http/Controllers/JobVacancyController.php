<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    public function getJobVacancies(Request $request)
{
    $request->validate([
        'token' => 'required',
    ]);

    return response()->json([
        'job_vacancies' => $jobVacancies,
    ]);
}

}
