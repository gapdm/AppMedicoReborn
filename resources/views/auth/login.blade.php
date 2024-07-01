<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="max-w-4xl w-full bg-white shadow-md rounded-lg overflow-hidden md:max-w-4xl">
    <div class="md:flex">
        <div class="w-full h-48 md:h-auto md:w-50 bg-cover bg-center" style="object-fit: contain; background-color: #FF7A00;">
        <img src="{{url('/img/card-left.png')}}" alt=""></div>
        <div class="w-full p-8">
            <h2 class="text-2xl font-semibold text-gray-700 text-center">Login</h2>
            <form method="POST" action="{{route('auth.login')}}" class="mt-4">
                @csrf
                <div class="mt-4">
                    <label class="block text-gray-700" for="email">Email</label>
                    <input id="email" type="email" name="email" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700" for="password">Password</label>
                    <input id="password" type="password" name="password" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">Log In</button>
                </div>
            </form>
            <div class="mt-4 flex items-center justify-between">
                <a href="{{route('register')}}" class="text-center w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                    Registro
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
