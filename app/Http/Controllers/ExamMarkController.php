<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\ExamMark;


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
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $validated = $request->validate([
            'subject_code' => 'required|exists:subjects,subject_code',
            'student_custom_id' => 'required|exists:students,custom_id',
            'marks' => 'required|numeric|min:0|max:100',
        ]);

        // Create a new ExamMark instance
        ExamMark::create([
            'student_custom_id' => $request->student_custom_id,
            'subject_code' => $request->subject_code,
            'marks' => $request->marks,
        ]);

        // Redirect back with success message
        return redirect()->route('students.show', $request->student_custom_id)
            ->with('success', 'Mark added successfully');
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
