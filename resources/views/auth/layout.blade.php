<!DOCTYPE html>
<html class="html h-full bg-white">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="{{ route('login.index') }}" class="text-center text-6xl font-bold text-gray-900">
                <h1>Barta</h1>
            </a>

            <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                @yield('title')
            </h1>
        </div>

        @yield('content')
    </div>
</body>

</html>
