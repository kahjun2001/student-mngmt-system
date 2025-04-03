@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Courses</h2>
        <a href="{{ route('courses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Add Course</a>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-md mt-3">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-300 mt-4">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border">#</th>
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">Name</th>
                        <th class="py-2 px-4 border">Number of Students</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($courses as $course)
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="py-2 px-4 border text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border">{{ $course->code }}</td>
                            <td class="py-2 px-4 border">{{ $course->name }}</td>
                            <td class="py-2 px-4 border">{{ $course->students->count() }}</td>
                            <td class="py-2 px-4 border flex space-x-2 justify-center">
                                <a href="{{ route('courses.edit', $course->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
