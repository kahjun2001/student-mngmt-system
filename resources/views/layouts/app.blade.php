<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex">
        <div class="w-48 h-screen bg-gray-700 text-[#E2E2E2]">
            <ul class="list-none flex flex-col gap-2">
                <li><a class="w-40 h-12 pl-4 ml-2 rounded flex items-center {{ request()->routeIs('students.index') ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 hover:text-white' }}" href="{{ route('students.index') }}">Students</a></li>
                <li><a class="w-40 h-12 pl-4 ml-2 rounded flex items-center {{ request()->routeIs('courses.index') ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 hover:text-white' }}" href="{{ route('courses.index') }}">Courses</a></li>
                <li><a class="w-40 h-12 pl-4 ml-2 rounded flex items-center {{ request()->routeIs('exams.index') ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 hover:text-white' }}" href="{{ route('exams.index') }}">Exams</a></li>
                <li><a class="w-40 h-12 pl-4 ml-2 rounded flex items-center {{ request()->routeIs('reports.index') ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 hover:text-white' }}" href="{{ route('reports.index') }}">Reports</a></li>
            </ul>
        </div>
    

        <div class="flex-1 p-8">
            @yield('content')
        </div>
    </div>
    
</body>
</html>