@extends('layouts.app')

@section('content')
    <h1>Create Students</h1>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="text" name="email" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" required>

        <button type="submit">Save</button>

    </form>


@endsection