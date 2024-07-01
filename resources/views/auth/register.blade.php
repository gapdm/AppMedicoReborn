<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Registro</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="max-w-6xl w-full bg-white shadow-md rounded-lg overflow-hidden md:max-w-6xl">
    <div class="md:flex">
        <div class="w-full h-48 md:h-auto md:w-50 bg-cover bg-center flex items-center justify-center" style="background-color: #FF7A00;">
            <img src="{{url('/img/card-left.png')}}" alt="" class="object-contain max-h-full max-w-full">
        </div>
        <div class="w-full p-4">
            <h2 class="text-2xl font-semibold text-gray-700 text-center">Registro</h2>
            <form method="POST" action="{{ route('auth.register') }}" class="mt-2 grid grid-cols-2 gap-4">
                @csrf
                <div class="mt-2">
                    <label class="block text-gray-700" for="nombre">Nombre(s)</label>
                    <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('nombre')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="block text-gray-700" for="apellido">Apellidos</label>
                    <input id="apellido" type="text" name="apellido" value="{{ old('apellido') }}" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('apellido')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700" for="email">E-Mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700" for="telefono">Telefono</label>
                    <input id="telefono" type="text" name="telefono" value="{{ old('telefono') }}" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('telefono')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700" for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="0" {{ old('sexo') == '0' ? 'selected' : '' }}>Masculino</option>
                        <option value="1" {{ old('sexo') == '1' ? 'selected' : '' }}>Femenino</option>
                        <option value="2" {{ old('sexo') == '2' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('sexo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700" for="rol">Posición</label>
                    <select name="rol" id="rol" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" onchange="toggleFields()">
                        <option value="0" {{ old('rol') == '0' ? 'selected' : '' }}>Secretaria</option>
                        <option value="1" {{ old('rol') == '1' ? 'selected' : '' }}>Medico</option>
                    </select>
                    @error('rol')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700" for="password">Password</label>
                    <input id="password" type="password" name="password" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('password')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700" for="password_confirmation">Confirmar Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('password_confirmation')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div id="especialidadDiv" style="display: none">
                    <label class="block text-gray-700" for="especialidad">Especialidad</label>
                    <input id="especialidad" type="text" name="especialidad" value="{{ old('especialidad') }}" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('especialidad')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div id="cedulaDiv" style="display: none">
                    <label class="block text-gray-700" for="cedula">Cédula Profesional</label>
                    <input id="cedula" type="text" name="cedula" value="{{ old('cedula') }}" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @error('cedula')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-2 flex items-center justify-between col-span-2">
                    <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">Registrarse</button>
                </div>
            </form>
            <div class="mt-2 flex items-center justify-between">
                <a href="{{route('loginForm')}}" class="text-center link-register w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1" style="color: white">
                    Log In
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFields() {
        var rol = document.getElementById('rol').value;
        var especialidadDiv = document.getElementById('especialidadDiv');
        var cedulaDiv = document.getElementById('cedulaDiv');
        
        if (rol == '1') {
            especialidadDiv.style.display = 'block';
            cedulaDiv.style.display = 'block';
        } else {
            especialidadDiv.style.display = 'none';
            cedulaDiv.style.display = 'none';
        }
    }
</script>
</body>
</html>
