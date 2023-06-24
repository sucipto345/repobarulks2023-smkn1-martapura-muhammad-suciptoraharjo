<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/auth/login', 'AuthController@login');
Route::post('/auth/logout', 'AuthController@logout');
Route::post('/validation', 'ValidationController@requestValidation');
Route::get('/validations', 'ValidationController@getValidations');
Route::get('/job_vacancies', 'JobVacancyController@getJobVacancies');
Route::middleware('/api/v1/auth/login')->get('/user', function(Request $request){
    return $request->users();
$idCardNumber = 'SomeText';
$password = 'SomeText';

$response = Http::post('https://[domain]/api/v1/auth/login', [
    'id_card_number' => $idCardNumber,
    'password' => $password,
]);

if ($response->ok()) {
    // Login berhasil
    $responseData = $response->json();
    $accessToken = $responseData['access_token'];
    
    // Lakukan tindakan selanjutnya setelah login sukses, misalnya mengirim permintaan untuk melamar pekerjaan
    // ...
} else {
    // Login gagal
    $errorResponse = $response->json();
    $errorMessage = $errorResponse['message'];
    // Lakukan tindakan yang sesuai untuk penanganan kesalahan login
    // ...
}

});