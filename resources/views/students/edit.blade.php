@extends('layouts.app')

@section('content')
    <h1>Edit Student</h1>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $student->name }}" required>

        <label for="email">Email:</label>
        <input type="text" name="email" value="{{ $student->email }}" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" value="{{ $student->dob }}" required>

        <button type="submit">Update</button>
    </form>
@endsection