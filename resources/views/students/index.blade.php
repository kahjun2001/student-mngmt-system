@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Students</h1>
        <div class="mb-4">
            <a href="{{ route('students.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Student</a>
            <a href="{{ route('students.export') }}" class="bg-green-500 text-white px-4 py-2 rounded ml-4">Export</a>
        </div>

        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">#</th>
                    <th class="py-2 px-4 border">ID</th>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Phone</th>
                    <th class="py-2 px-4 border">Course</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr class="text-center">
                        <td class="py-2 px-4 border">{{ $student->id }}</td>
                        <td class="py-2 px-4 border">{{ $student->custom_id }}</td>
                        <td class="py-2 px-4 border"><a href="{{ route('students.show', $student->custom_id) }}">{{ $student->name }}</a></td>
                        <td class="py-2 px-4 border">{{ $student->email }}</td>
                        <td class="py-2 px-4 border">{{ $student->phone }}</td>
                        <td class="py-2 px-4 border">{{ $student->course->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('students.edit', $student->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
