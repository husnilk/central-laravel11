<?php

use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\FacultyController;
use App\Http\Controllers\Api\LecturerController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

/*--------------------------------------------------------------------------
/ User Managements
/--------------------------------------------------------------------------*/
Route::prefix('bo')->name('bo.')->group(function () {
    Route::apiResource('roles', \App\Http\Controllers\Api\Bo\RoleController::class);
    Route::apiResource('permissions', \App\Http\Controllers\Api\Bo\PermissionController::class);
});
/*--------------------------------------------------------------------------
/ Manajemen Data Master
/--------------------------------------------------------------------------*/
Route::apiResource('buildings', BuildingController::class);
Route::apiResource('rooms', RoomController::class);
Route::apiResource('faculties', FacultyController::class);
Route::apiResource('departments', DepartmentController::class);
Route::apiResource('students', StudentController::class);
Route::apiResource('lecturers', LecturerController::class);
Route::apiResource('staff', StaffController::class);
