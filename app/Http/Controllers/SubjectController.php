<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('courses')->get();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('subjects.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:255',
            'courses' => 'array', // Ensure courses is an array
        ]);

        // Create the subject
        $subject = Subject::create([
            'name' => $validated['name'],
            'subject_code' => $validated['subject_code'],
        ]);

        // Attach selected courses in the pivot table
        if (!empty($validated['courses'])) {
            $subject->courses()->attach($validated['courses']);
        }

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }


    public function edit(Subject $subject)
    {
        $courses = Course::all();
        return view('subjects.edit', compact('subject', 'courses'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:255',
            'courses' => 'array',
        ]);

        $subject->update([
            'name' => $request->name,
            'subject_code' => $request->subject_code,
        ]);

        $subject->courses()->sync($request->courses ?? []);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    public function show($code)
    {
        // Fetch the subject using the code and eager load related students and exam marks
        $subject = Subject::with(['students', 'students.examMarks'])->where('subject_code', $code)->firstOrFail();

        // Calculate the average exam mark for the subject (across all students)
        $averageMark = $subject->students->flatMap(function($student) {
            return $student->examMarks;
        })->avg('mark');
        
        return view('subjects.show', compact('subject', 'averageMark'));
    }

}
