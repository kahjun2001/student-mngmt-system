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

        <!-- Enroll in Subject Button -->
        <div class="mb-6">
            <button onclick="toggleModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Enroll in Subject</button>
        </div>

        <!-- Enroll Modal -->
        <div id="enrollModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                <h3 class="text-xl font-semibold mb-4">Enroll Student in Subject</h3>
                <form action="{{ route('students.enroll', $student->custom_id) }}" method="POST">
                    @csrf
                    <label for="subject_code" class="block text-lg mb-2">Select Subject</label>
                    <select name="subject_code" id="subject_code" class="border p-2 mb-4 w-full" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->subject_code }}">{{ $subject->name }} ({{ $subject->subject_code }})</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">Enroll</button>
                </form>
                <button onclick="toggleModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mt-4 hover:bg-gray-600 transition">Cancel</button>
            </div>
        </div>

        <!-- Subjects Table -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <h3 class="text-xl font-semibold mb-4">Enrolled Subjects</h3>
            @if ($student->subjects->isEmpty())
                <p>No subjects enrolled yet.</p>
            @else
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-sm">
                            <th class="py-2 px-4">Subject</th>
                            <th class="py-2 px-4">Marks</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($student->subjects as $subject)
                            <tr>
                                <td class="py-2 px-4">{{ $subject->name }} ({{ $subject->subject_code }})</td>
                                <td class="py-2 px-4">
                                    <form action="{{ route('exam-marks.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="subject_code" value="{{ $subject->subject_code }}">
                                        <input type="hidden" name="student_custom_id" value="{{ $student->custom_id }}">
                                        
                                        <!-- Display saved mark if it exists -->
                                        <div class="flex items-center">
                                            <span class="mr-4">
                                                @php
                                                    $examMark = \App\Models\ExamMark::where('student_custom_id', $student->custom_id)
                                                                                    ->where('subject_code', $subject->subject_code)
                                                                                    ->first();
                                                @endphp

                                                @if($examMark) 
                                                    Mark: {{ $examMark->marks }}
                                                @else
                                                    No mark saved
                                                @endif
                                            </span>

                                            <!-- The form input for adding marks -->
                                            <input type="number" name="marks" class="border px-2 py-1" required>

                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition ml-4">
                                                Save Mark
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="py-2 px-4">
                                    <form action="{{ route('students.subjects.detach', ['student' => $student->custom_id, 'subject' => $subject->subject_code]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">Remove Subject</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Overall Average Mark Section -->
                <div class="mt-4">
                    <strong>Overall Average Mark: </strong>
                    @if ($student->examMarks->count() > 0)
                        {{ $student->examMarks->avg('marks') }} <!-- This calculates the overall average mark -->
                    @else
                        <span class="text-gray-500">No marks available yet</span>
                    @endif
                </div>
            @endif
        </div>


        <!-- Back to Students List -->
        <div class="mt-6">
            <a href="{{ route('students.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">Back to Students List</a>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('enrollModal');
            modal.classList.toggle('hidden');
        }
    </script>
@endsection
