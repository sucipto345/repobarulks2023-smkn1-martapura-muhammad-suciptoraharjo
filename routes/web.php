<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::post('/v1/auth/login', 'AuthController@login');
Route::post('/v1/auth/logout', 'AuthController@logout');

Route::post('/v1/validation', 'ValidationController@requestDataValidation');
Route::get('/v1/validations', 'ValidationController@getSocietyDataValidation');

Route::get('/v1/job_vacancies', 'JobVacancyController@getJobVacancies');
Route::get('/v1/job_vacancies/{id}', 'JobVacancyController@getJobVacancyDetail');

Route::post('/v1/applications', 'ApplicationController@applyForJobs');
Route::get('/v1/applications', 'ApplicationController@getSocietyJobApplications');