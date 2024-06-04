<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('api.unauthorized');
Route::get('/forbidden', [AuthController::class, 'forbidden'])->name('api.forbidden');
Route::post('/forgot-password', [PasswordController::class, 'forgot']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    /*--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------*/
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/me', [ProfileController::class, 'update']);
    Route::get('/me', [ProfileController::class, 'index']);
    Route::post('/password', [PasswordController::class, 'update']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/submit-token', [ProfileController::class, 'mobileToken']);
    Route::get('/login/history', [AuthController::class, 'history']);
    Route::post('/v2/me', [ProfileController::class, 'updateV2'])->name('profile.update');

    require __DIR__.'/api/master.php';
    require __DIR__.'/api/curriculum.php';
    require __DIR__.'/api/classroom.php';
    require __DIR__.'/api/internship.php';
    require __DIR__.'/api/thesis.php';
    require __DIR__.'/api/research.php';
});
