<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ExamMark;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    // Export Average Marks for Each Student
    public function exportStudentAverages()
    {
        $students = Student::with('examMarks')->get();

        $csvFileName = 'student_averages.csv';
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$csvFileName\"",
        ];

        $callback = function () use ($students) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Student ID', 'Student Name', 'Average Mark']);

            foreach ($students as $student) {
                $averageMark = $student->examMarks->avg('marks') ?? 0;
                fputcsv($file, [$student->id, $student->name, number_format($averageMark, 2)]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Export Average Marks for Each Subject
    public function exportSubjectAverages()
    {
        $subjects = ExamMark::select('subject', \DB::raw('AVG(marks) as average'))
            ->groupBy('subject')
            ->get();

        $csvFileName = 'subject_averages.csv';
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$csvFileName\"",
        ];

        $callback = function () use ($subjects) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Subject', 'Average Mark']);

            foreach ($subjects as $subject) {
                fputcsv($file, [$subject->subject, number_format($subject->average, 2)]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
