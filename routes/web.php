<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamMarkController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('index');
});

Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
Route::resource('exams', ExamMarkController::class);
Route::resource('reports', ReportController::class);

Route::get('/export/student-averages', [ReportController::class,'exportStudentAverages'])->name('export.student.averages');
Route::get('/export/subject-averages', [ReportController::class,'exportSubjectAverages'])->name('export.subject.averages');