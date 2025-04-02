@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Create Subject</h1>

        <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Subject Name:</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label for="subject_code" class="block text-gray-700 font-semibold">Subject Code:</label>
                    <input type="text" name="subject_code" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label for="courses" class="block text-gray-700 font-semibold">Assign to Courses:</label>
                    <div class="space-y-2">
                        @foreach($courses as $course)
                            <label class="flex items-center">
                                <input type="checkbox" name="courses[]" value="{{ $course->id }}" class="mr-2">
                                {{ $course->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Save</button>
            </form>
        </div>
    </div>
@endsection
