@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Subjects</h1>

        <a href="{{ route('subjects.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">Add Subject</a>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-4 bg-white p-6 rounded-lg shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Subject Name</th>
                        <th class="border border-gray-300 px-4 py-2">Code</th>
                        <th class="border border-gray-300 px-4 py-2">Courses</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td><a href="{{ route('subjects.show', $subject->subject_code) }}">{{ $subject->name }}</a></td>
                            <td class="border border-gray-300 px-4 py-2">{{ $subject->subject_code }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @foreach($subject->courses as $course)
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $course->name }}</span>
                                @endforeach
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
