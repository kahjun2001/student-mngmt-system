<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;

class ExamMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("exams.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($studentCustomId, $subjectCode, Request $request)
    {
        // Retrieve the student by custom_id
        $student = Student::where('custom_id', $studentCustomId)->firstOrFail();

        // Retrieve the subject by subject_code
        $subject = Subject::where('subject_code', $subjectCode)->firstOrFail();

        // Create a new ExamMark instance
        $examMark = new ExamMark();
        $examMark->student_id = $student->id;  // Use student ID, not custom_id, for relationship
        $examMark->subject_id = $subject->id;  // Use subject ID, not subject_code, for relationship
        $examMark->mark = $request->mark;     // Store the mark from the form
        $examMark->save();

        // Redirect back to the student's report page with a success message
        return redirect()->route('students.show', $student->custom_id)->with('success', 'Mark added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
