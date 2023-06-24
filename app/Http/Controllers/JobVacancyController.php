<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Application;
use App\Models\JobVacancy;

class JobVacancyController extends Controller
{
    /**
     * Get the details of a job vacancy.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $vacancy = JobVacancy::findOrFail($id);

        $response = [
            'id' => $vacancy->id,
            'category' => [
                'id' => $vacancy->category->id,
                'job_category' => $vacancy->category->job_category,
            ],
            'company' => $vacancy->company,
            'address' => $vacancy->address,
            'available_positions' => $vacancy->available_positions, // Replace with the actual relationship name
        ];

        return response()->json($response);
    }

    /**
     * Get the list of job vacancies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vacancies = JobVacancy::all();

        $response = [];

        foreach ($vacancies as $vacancy) {
            $response[] = [
                'id' => $vacancy->id,
                'category' => [
                    'id' => $vacancy->category->id,
                    'job_category' => $vacancy->category->job_category,
                ],
                'company' => $vacancy->company,
                'address' => $vacancy->address,
                'available_positions' => $vacancy->available_positions, // Replace with the actual relationship name
            ];
        }

        return response()->json($response);
    }
}
