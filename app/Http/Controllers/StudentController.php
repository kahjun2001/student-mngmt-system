<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

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
        return view("students.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:students,email',
            'dob' => 'required|date',
        ]);

        Student::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'dob' => $request->dob,
        ]);

        return redirect()->route('students.index')->with('success','Student Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return  view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return  view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:students,email,' . $student->id,
            'dob' => 'required|date',
        ]);

        $student->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'dob'=> $request->dob,
        ]);

        return redirect()->route('students.index')->with('success','Student infomartion updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Student deleted successfully');
    }
}
