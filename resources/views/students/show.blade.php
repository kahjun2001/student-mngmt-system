@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Student Report: {{ $student->name }}</h2>

        <!-- Student Information Section -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-6">
            <h3 class="text-xl font-semibold">Student Information</h3>
            <ul class="list-none">
                <li><strong>Custom ID: </strong>{{ $student->custom_id }}</li>
                <li><strong>Name: </strong>{{ $student->name }}</li>
                <li><strong>Email: </strong>{{ $student->email }}</li>
                <li><strong>Date of Birth: </strong>{{ $student->dob }}</li>
                <li><strong>Phone: </strong>{{ $student->phone }}</li>
                <li><strong>Course: </strong>{{ $student->course->name }}</li>
            </ul>
        </div>

        <!-- Exam Marks Form -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-6">
            <h3 class="text-xl font-semibold mb-4">Add Exam Marks</h3>
            @foreach ($student->subjects as $subject)
                <form action="{{ route('examMarks.store', [$student->custom_id, $subject->subject_code]) }}" method="POST" class="mb-4">
                    @csrf
                    <label for="mark" class="block text-lg mb-2">{{ $subject->name }} ({{ $subject->subject_code }})</label>
                    <input type="number" name="mark" placeholder="Enter Mark" required class="border p-2 mb-4 w-full">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Add Mark</button>
                </form>
            @endforeach
        </div>

        <!-- Exam Marks Table -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h3 class="text-xl font-semibold mb-4">Exam Marks</h3>
            @if ($student->examMarks->isEmpty())
                <p>No exam marks available for this student.</p>
            @else
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm">
                            <th class="py-2 px-4">Subject</th>
                            <th class="py-2 px-4">Mark</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($student->examMarks as $examMark)
                            <tr>
                                <td class="py-2 px-4">{{ $examMark->subject->name }}</td>
                                <td class="py-2 px-4">{{ $examMark->mark }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Average Mark Section -->
                <div class="mt-4">
                    <strong>Average Mark: </strong>
                    {{ $student->examMarks->avg('mark') }} <!-- This calculates the average mark -->
                </div>
            @endif
        </div>

        <!-- Back to Students List -->
        <div class="mt-6">
            <a href="{{ route('students.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">Back to Students List</a>
        </div>
    </div>
@endsection