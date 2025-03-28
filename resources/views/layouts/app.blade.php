<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Management System</title>
</head>
<body>
    <div class="sidebar">
        <ul style="list-style-type: none;">
            <li><a href="{{ route('students.index') }}">Students</a></li>
            <li><a href="{{ route('courses.index') }}">Courses</a></li>
            <li><a href="{{ route('exams.index') }}">Exams</a></li>
            <li><a href="{{ route('reports.index') }}">Reports</a></li>
        </ul>
    </div>

    <div class="content">
        @yield('content')
    </div>
    
</body>
</html>