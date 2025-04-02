<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamMarkController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubjectController;

Route::get('/', function () {
    return view('index');
});

Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
Route::resource('exams', ExamMarkController::class);
Route::resource('reports', ReportController::class);
Route::resource('subjects', SubjectController::class);

Route::get('/export/student-averages', [ReportController::class,'exportStudentAverages'])->name('export.student.averages');
Route::get('/export/subject-averages', [ReportController::class,'exportSubjectAverages'])->name('export.subject.averages');
Route::get('/students', [StudentController::class,'index'])->name('students.index');
Route::get('/courses', [CourseController::class,'index'])->name('courses.index');
Route::get('/subjects', [SubjectController::class,'index'])->name('subjects.index');
Route::get('/exams', [ExamMarkController::class,'index'])->name('exams.index');
Route::get('/reports', [ReportController::class,'index'])->name('reports.index');
Route::get('/students/{custom_id}', [StudentController::class, 'show'])->name('students.show');
Route::get('/subjects/{code}', [SubjectController::class, 'show'])->name('subjects.show');
Route::post('examMarks/{studentCustomId}/{subjectCode}', [ExamMarkController::class, 'store'])->name('examMarks.store');