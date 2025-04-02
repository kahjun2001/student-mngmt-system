@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Subject</h1>

        <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Subject Name:</label>
                    <input type="text" name="name" value="{{ $subject->name }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label for="code" class="block text-gray-700 font-semibold">Subject Code:</label>
                    <input type="text" name="subject_code" value="{{ $subject->subject_code }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Assign to Courses:</label>
                    @foreach($courses as $course)
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="courses[]" 
                                value="{{ $course->id }}" 
                                {{ $subject->courses->contains($course->id) ? 'checked' : '' }}
                                class="mr-2"
                            >
                            <label>{{ $course->name }}</label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Update</button>
            </form>
        </div>
    </div>
@endsection
