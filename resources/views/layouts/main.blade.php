@section('title')
    @yield('title')
@stop

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title >@yield('title')</title>
    @stack('scripts')
</head>
<body class="bg-gray-100">
    <div class="grid grid-cols-[auto,1fr] min-h-screen">
        @include('layouts.sidebar')
        <div class="p-8 min-h-screen">
            <h1 class="text-3xl font-semibold text-orange-500">@yield('title')</h1>
            @yield('content')
        </div>
    </div>
</body>
</html>