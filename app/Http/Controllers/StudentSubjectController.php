<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    public function store(Request $request, $custom_id)
    {
        // Find the student by custom_id
        $student = Student::where('custom_id', $custom_id)->firstOrFail();

        // Find the subject by subject_code
        $subject = Subject::where('subject_code', $request->subject_code)->firstOrFail();

        // Enroll the student in the subject
        $student->subjects()->attach($subject);

        // Redirect back with a success message
        return redirect()->route('students.show', $custom_id)->with('success', 'Student enrolled in subject successfully!');
    }
}
