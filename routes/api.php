<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ApiAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function() {
    $data = [
        'message' => "Welcome to our API"
    ];
    return response()->json($data, 200);
});
Route::post('/nhs', [AuthController::class, 'findnhsbrochure']);
Route::post('/nhsmeds', [AuthController::class, 'findnhsmeds']);

Route::post('/brochure', [AuthController::class, 'findbrochure']);
Route::match(['get', 'post'],'/brochure-search', 'AuthController@brochuresearch');
//::match(['GET', 'POST'], '/brochure-search', '\AuthController@brochuresearch')->name('brochure-search');
Route::match(['GET', 'POST'],'/brochure-search', [AuthController::class, 'brochuresearch']);


// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/user', [AuthController::class, 'getUser']);


Route::post('/auth/register',[ApiAuthController::class,'register']);
Route::post('/auth/login',[ApiAuthController::class,'login']);
Route::get('/auth/user',[ApiAuthController::class,'user'])->middleware('auth:sanctum');
Route::post('/auth/logout',[ApiAuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/profile/change-password',[ProfileController::class,'change_password'])->middleware('auth:sanctum');

Route::post('/profile/update-profile',[ProfileController::class,'update_profile'])->middleware('auth:sanctum');

//Route::match(['get', 'post'],'/brochure-search', 'APIController@brochuresearch');
Route::middleware('jwt.verify')->group(function() {
    Route::get('/dashboard', function() {
        return response()->json(['message' => 'Welcome to dashboard'], 200);
    });


});



// Route::get('/brochures', 'APIController@brochures');
Route::get('/brochures', [AuthController::class, 'brochures']);
Route::post('/sms-brochures', [AuthController::class, 'smsbrochures']);
Route::post('/email-brochures', [AuthController::class, 'emailbrochures']);

Route::get('/manikin', [AuthController::class, 'manikin']);
Route::get('/manikin-jpg', [AuthController::class, 'manikinJPG']);


Route::get('/framehtml', [AuthController::class, 'framehtml']);
Route::match(['get', 'post'],'/brochure-html', [AuthController::class, 'showbrochurehtml']);