<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Application; // Import the Application model
use App\Models\JobVacancy; // Import the JobVacancy model

class ApplicationController extends Controller
{
    /**
     * Apply for a job vacancy.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $request)
    {
        $request->validate([
            'vacancy_id' => 'required',
            'positions' => 'required|array',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Check if the society's validation data has been accepted by the validator
        if (!$user->TRUE) {
            throw ValidationException::withMessages([
                'message' => 'Your data validator must be accepted by the validator before applying for a job.',
            ])->status(401);
        }

        // Check if the society has already applied for a job
        if ($user->TRUE) {
            throw ValidationException::withMessages([
                'message' => 'Application for a job can only be done once.',
            ])->status(401);
        }

        $vacancyId = $request->input('vacancy_id');
        $positions = $request->input('positions');
        $notes = $request->input('notes');

        // Validate the vacancy ID and positions
        $vacancy = JobVacancy::find($vacancyId);
        if (!$vacancy || empty($positions)) {
            throw ValidationException::withMessages([
                'message' => 'Invalid field',
                'errors' => [
                    'vacancy_id' => ['The vacancy id field is required.'],
                    'positions' => ['The positions field is required.'],
                ],
            ])->status(401);
        }

        // Check if the positions are available in the job vacancy
        $availablePositions = $vacancy->available_positions; // Replace 'available_positions' with the actual relationship name in the JobVacancy model
        foreach ($positions as $position) {
            $positionData = $availablePositions->firstWhere('position', $position);
            if (!$positionData || $positionData->apply_count >= $positionData->capacity) {
                throw ValidationException::withMessages([
                    'message' => 'Invalid field',
                    'errors' => [
                        'positions' => ['The selected position is not available or has reached the maximum capacity.'],
                    ],
                ])->status(401);
            }
        }

        // Create the application
        $application = new Application();
        $application->user_id = $user->id;
        $application->job_vacancy_id = $vacancyId;
        $application->positions = $positions;
        $application->notes = $notes;
        $application->save();

        // Increment the apply count for the selected positions in the job vacancy
        foreach ($positions as $position) {
            $positionData = $availablePositions->firstWhere('position', $position);
            $positionData->apply_count++;
            $positionData->save();
        }

        return response()->json([
            'message' => 'Applying for job successful',
        ]);
    }

    /**
     * Get all of society's job applications.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function applications(Request $request)
    {
        $user = Auth::user();

        $applications = $user->applications; // Replace 'applications' with the actual relationship name in the User model

        $response = [
            'vacancies' => [],
        ];

        foreach ($applications as $application) {
            $response['vacancies'][] = [
                'id' => $application->job_vacancy_id,
                'category' => [
                    'id' => $application->jobVacancy->category->id,
                    'job_category' => $application->jobVacancy->category->job_category,
                ],
                'company' => $application->jobVacancy->company,
                'address' => $application->jobVacancy->address,
                'position' => [
                    [
                        'position' => $application->positions,
                        'apply_status' => $application->apply_status,
                        'notes' => $application->notes,
                    ],
                ],
            ];
        }

        return response()->json($response);
    }
}
