<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\SlotyController;
use App\Http\Controllers\SpeakersController;
use App\Http\Controllers\SponsorsController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\StageProgramController;
use App\Http\Controllers\TestimonialsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});


//admin
Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\LoginController::class, 'logout']);

//sponsors
Route::get('/sponsors', [SponsorsController::class, 'index']);
Route::patch('/sponsors/{id}', [SponsorsController::class, 'update']);
Route::delete('/sponsors/{id}', [SponsorsController::class, 'destroy']);
Route::post('/sponsors', [SponsorsController::class, 'store']);


//testimonials
Route::get('/testimonials', [TestimonialsController::class, 'index']);
Route::post('/testimonials', [TestimonialsController::class, 'store']);
Route::delete('/testimonials/{id}', [TestimonialsController::class, 'destroy']);
Route::patch('/testimonials/{id}', [TestimonialsController::class, 'update']);

//stages
Route::get('/stages', [StageController::class, 'index']);
Route::patch('/stages/{id}', [StageController::class, 'update']);
Route::delete('/stages/{id}', [StageController::class, 'destroy']);
Route::post('/stages', [StageController::class, 'store']);

//stageprogram
Route::get('programs', [StageProgramController::class, 'index']);
Route::post('programs', [StageProgramController::class, 'store']);
Route::delete('/programs/{id}', [StageProgramController::class, 'destroy']);
Route::patch('/programs/{id}', [StageProgramController::class, 'update']);

//speakers
Route::get('/speakers', [SpeakersController::class, 'index']);
Route::post('/speakers', [SpeakersController::class, 'store']);
Route::delete('/speakers/{id}', [SpeakersController::class, 'destroy']);
Route::patch('/speakers/{id}', [SpeakersController::class, 'update']);

//sloty
Route::get('/sloty', [SlotyController::class, 'index']);
Route::post('/sloty', [SlotyController::class, 'store']);
Route::delete('/sloty/{id}', [SlotyController::class, 'destroy']);
Route::patch('/sloty/{id}', [SlotyController::class, 'update']);

//registracia na konferenciu
Route::post("/ulozit-registraciu", [EmailController::class, 'sendEmail']);
