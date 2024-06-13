<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('/my-courses', \App\Http\Controllers\Api\MyCourseController::class)
    ->only(['index', 'show']);
Route::apiResource('/my-counsellings', \App\Http\Controllers\Api\MyCounsellingController::class)
    ->only(['index', 'show', 'store', 'update']);
Route::apiResource('/counselling-topics', \App\Http\Controllers\Api\CounsellingTopicController::class)
    ->only(['index']);
Route::apiResource('/my-exam-card', \App\Http\Controllers\Api\MyExamCardController::class)
    ->only(['show']);
Route::apiResource('/my-courses.meetings', \App\Http\Controllers\Api\MyCourseMeetingController::class)
    ->only(['index', 'show']);
Route::apiResource('/my-attendances', \App\Http\Controllers\Api\MyCourseAttendanceController::class)
    ->only(['index', 'store']);
Route::apiResource('/my-attendance-permits', \App\Http\Controllers\Api\MyCourseAttendancePermitController::class)
    ->only(['store']);
Route::apiResource('/my-course.evaluations', \App\Http\Controllers\Api\MyCourseMeetingEvaluationController::class)
    ->only(['store', 'update']);
Route::apiResource('/my-course.problems', \App\Http\Controllers\Api\MyCourseProblemController::class)
    ->only(['store']);

// INTERNSHIP
Route::apiResource('/my-internships', \App\Http\Controllers\Api\MyInternshipController::class)
    ->only(['index', 'store', 'update', 'show']);
Route::apiResource('/my-internship-proposals', \App\Http\Controllers\Api\MyInternshipProposalController::class)
    ->only(['store', 'update']);
Route::apiResource('/open-internship-proposals', \App\Http\Controllers\Api\OpenInternshipProposalController::class)
    ->only(['index']);
Route::apiResource('/internship-companies', \App\Http\Controllers\Api\InternshipCompanyController::class);
Route::post('/my-internships/{intern_id}/send-logs', [\App\Http\Controllers\Api\MyInternshipLogbookController::class, 'send']);
Route::apiResource('/my-internships.logs', \App\Http\Controllers\Api\MyInternshipLogbookController::class);
Route::apiResource('/my-internships.seminar', \App\Http\Controllers\Api\MyInternshipSeminarController::class);
Route::apiResource('/my-internships.final', \App\Http\Controllers\Api\MyInternshipFinalController::class);

//Thesis
Route::apiResource('/my-theses', \App\Http\Controllers\Api\MyThesisController::class);
Route::post('/my-thesis/{thesis_id}/data-request', [\App\Http\Controllers\Api\MyThesisDataRequestController::class, 'store']);
Route::apiResource('/my-thesis.logs', \App\Http\Controllers\Api\MyThesisLogController::class);
Route::apiResource('/my-thesis.seminars', \App\Http\Controllers\Api\MyThesisSeminarController::class)
    ->only(['store', 'show']);
Route::apiResource('/my-thesis.defenses', \App\Http\Controllers\Api\MyThesisDefenseController::class);
Route::apiResource('/theses-upcoming-seminars', \App\Http\Controllers\Api\ThesisSeminarUpcomingController::class)
    ->only(['index']);
