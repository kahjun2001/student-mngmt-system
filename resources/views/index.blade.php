{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Exports</h1>
    <a href="{{ url('/export/student-averages') }}">Download Student Averages</a>
    <br>
    <a href="{{ url('/export/subject-averages') }}">Download Subject Averages</a>
</body>
</html> --}}

@extends('layouts.app')

@section('content')
    <h1>Welcome to the Student Management System</h1>
    <p>Use the navigation sidebar to manage students, courses, and exam marks.</p>
@endsection