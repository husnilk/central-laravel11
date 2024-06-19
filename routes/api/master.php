<?php

use Illuminate\Support\Facades\Route;

/*--------------------------------------------------------------------------
/ User Managements
/--------------------------------------------------------------------------*/
Route::prefix('bo')->name('bo.')->group(function () {
    Route::apiResource('roles', \App\Http\Controllers\Api\Bo\RoleController::class);
    Route::apiResource('permissions', \App\Http\Controllers\Api\Bo\PermissionController::class);
    Route::apiResource('role-permissions', \App\Http\Controllers\Api\Bo\RolePermissionController::class);

    /*--------------------------------------------------------------------------
    / Manajemen Data Master
    /--------------------------------------------------------------------------*/
    Route::apiResource('buildings', \App\Http\Controllers\Api\Bo\BuildingController::class);
    Route::apiResource('rooms', \App\Http\Controllers\Api\Bo\RoomController::class);
    Route::apiResource('faculties', \App\Http\Controllers\Api\Bo\FacultyController::class);
    Route::apiResource('departments', \App\Http\Controllers\Api\Bo\DepartmentController::class);
    Route::apiResource('staffs', \App\Http\Controllers\Api\Bo\StaffController::class);
    Route::apiResource('lecturers', \App\Http\Controllers\Api\Bo\LecturerController::class);
    Route::apiResource('students', \App\Http\Controllers\Api\Bo\StudentController::class);
});
