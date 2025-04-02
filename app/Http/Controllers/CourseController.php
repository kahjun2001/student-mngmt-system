<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view("courses.index", compact("courses"));
    }

    public function create()
    {
        return view("courses.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:courses,code',
            'name' => 'required|string|max:255|unique:courses,name',
        ]);

        Course::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:courses,code,' . $course->id,
            'name' => 'required|string|max:255|unique:courses,name,' . $course->id,
        ]);

        $course->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}
