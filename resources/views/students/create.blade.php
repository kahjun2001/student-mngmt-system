@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Create Student</h1>

        <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Name:</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold">Email:</label>
                    <input type="email" name="email" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-semibold">Phone Number:</label>
                    <input type="text" name="phone" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label for="course_id" class="block text-gray-700 font-semibold">Course:</label>
                    <select name="course_id" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="" disabled selected>Select a course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="dob" class="block text-gray-700 font-semibold">Date of Birth:</label>
                    <input type="date" name="dob" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Save</button>
            </form>
        </div>
    </div>
@endsection