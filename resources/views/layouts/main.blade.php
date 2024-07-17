@section('title')
    @yield('title')
@stop
@section('usuario')
    {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}
@stop
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    @stack('scripts')
</head>
<body class="bg-gray-100">
    <div class="flex">
        <aside class="w-64 bg-gray-800 text-white fixed top-0 left-0 h-full z-10">
            @include('layouts.sidebar')
        </aside>
        <div class="flex-1 ml-64">
            <div class="p-4 min:w-screen">
                <h1 class="text-3xl font-semibold text-orange-500">@yield('title')</h1>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
