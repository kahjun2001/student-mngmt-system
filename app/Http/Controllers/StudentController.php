<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ExamMark;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;
use SplTempFileObject;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all(); // Get all students
        return view("students.index", compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all(); 
        return view("students.create", compact("courses"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = Student::create($validatedData);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($studentCustomId)
    {
        $student = Student::where('custom_id', $studentCustomId)->firstOrFail();

        $course = $student->course;

        if (!$course) {
            return redirect()->route('students.index')->withErrors('This student is not enrolled in any course.');
        }

        $subjects = $course->subjects;

        return view('students.show', compact('student', 'subjects'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $courses = Course::all();
        return view('students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email,' . $student->id,
                'phone' => 'required|string|max:15',
                'dob' => 'required|date',
                'course_id' => 'required|exists:courses,id'
            ]);

            // Update student data
            $student->update($validatedData);

            return redirect()->route('students.index')->with('success', 'Student information updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating student: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong! ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong! ' . $e->getMessage()]);
        }
    }

    public function detachSubject($studentCustomId, $subjectCode)
    {
        $student = Student::where('custom_id', $studentCustomId)->firstOrFail();
        $subject = Subject::where('subject_code', $subjectCode)->firstOrFail();

        // Detach the subject from the student
        $student->subjects()->detach($subject->id);

        return redirect()->route('students.show', $studentCustomId)->with('success', 'Subject removed successfully');
    }

    public function export()
    {
        $students = Student::with('examMarks')->get();

        $fileName = 'students_average_marks.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($students) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Student ID', 'Name', 'Average Mark']);

            foreach ($students as $student) {
                $averageMark = $student->examMarks->avg('marks') ?? 0;
                fputcsv($file, [$student->custom_id, $student->name, round($averageMark, 2)]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


}
