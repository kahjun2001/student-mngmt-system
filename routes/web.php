<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamMarkController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentSubjectController;

Route::get('/', function () {
    return view('index');
});

Route::get('/students/export', [StudentController::class, 'export'])->name('students.export');
Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
Route::resource('exams', ExamMarkController::class);
Route::resource('reports', ReportController::class);
Route::get('/subjects/export', [SubjectController::class, 'export'])->name('subjects.export');
Route::resource('subjects', SubjectController::class);

Route::get('/export/student-averages', [ReportController::class,'exportStudentAverages'])->name('export.student.averages');
Route::get('/export/subject-averages', [ReportController::class,'exportSubjectAverages'])->name('export.subject.averages');
Route::get('/students', [StudentController::class,'index'])->name('students.index');
Route::get('/courses', [CourseController::class,'index'])->name('courses.index');
Route::get('/subjects', [SubjectController::class,'index'])->name('subjects.index');
Route::get('/students/{custom_id}', [StudentController::class, 'show'])->name('students.show');
Route::get('/subjects/{code}', [SubjectController::class, 'show'])->name('subjects.show');
Route::post('examMarks/{studentCustomId}/{subjectCode}', [ExamMarkController::class, 'store'])->name('examMarks.store');
Route::post('/students/{custom_id}/enroll', [StudentSubjectController::class, 'store'])->name('studentSubject.store');
Route::post('/students/{custom_id}/enroll', [StudentSubjectController::class, 'store'])->name('students.enroll');
Route::post('/examMarks/{studentCustomId}/{subjectCode}', [ExamMarkController::class, 'store'])->name('examMarks.store');
Route::delete('/students/{student}/subjects/{subject}', [StudentController::class, 'detachSubject'])->name('students.subjects.detach');
Route::post('/exam-marks', [ExamMarkController::class, 'store'])->name('exam-marks.store');