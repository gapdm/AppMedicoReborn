<!-- Sidebar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="w-64 h-full bg-orange-500 text-white flex flex-col justify-between">
    <div>
        <div class="px-8 py-4">
            <h2 class="text-xl font-semibold">Dashboard</h2>
        </div>
        <nav class="mt-4 flex flex-col items-center">
            <a href="{{ route('agenda') }}" class="flex items-center px-4 py-4 w-9/12 hover:bg-white hover:text-orange-500 rounded focus:bg-white focus:text-orange-500 {{ Request::is('agenda*') ? 'bg-white text-orange-500' : '' }}">
                <i class="fas fa-calendar mr-2"></i>
                Agenda
            </a>
            <a href="{{ route('pacientes') }}" class="flex items-center px-4 mt-4 py-4 w-9/12 hover:bg-white hover:text-orange-500 rounded focus:bg-white focus:text-orange-500 {{ Request::is('pacientes*') ? 'bg-white text-orange-500' : '' }}">
                <i class="fas fa-user-injured mr-2"></i>
                Pacientes
            </a>
            <a href="{{ route('citas') }}" class="flex items-center px-4 mt-4 py-4 w-9/12 hover:bg-white hover:text-orange-500 rounded focus:bg-white focus:text-orange-500 {{ Request::is('citas*') ? 'bg-white text-orange-500' : '' }}">
                <i class="fas fa-notes-medical mr-2"></i>
                Citas
            </a>
            <a href="{{ route('medicos') }}" class="flex items-center px-4 mt-4 py-4 w-9/12 hover:bg-white hover:text-orange-500 rounded focus:bg-white focus:text-orange-500 {{ Request::is('medicos*') ? 'bg-white text-orange-500' : '' }}">
                <i class="fas fa-user-md mr-2"></i>
                Médicos
            </a>
        </nav>
    </div>
    <div class="relative">
        <button id="userButton" class="w-full flex items-center px-4 py-4 bg-orange-600 hover:bg-orange-700 focus:bg-orange-700 focus:outline-none">
            <i class="fas fa-user mr-2"></i>
            @yield('usuario')
            <i class="fas fa-chevron-up ml-auto"></i>
        </button>
        <div id="userMenu" class="absolute bottom-16 left-0 w-full bg-white text-black hidden">
            <a href="#'" class="block px-4 py-2 hover:bg-gray-200">Perfil</a>
            <form method="POST" action="{{ route('auth.logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-200">Cerrar sesión</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('userButton').addEventListener('click', function() {
        var userMenu = document.getElementById('userMenu');
        if (userMenu.classList.contains('hidden')) {
            userMenu.classList.remove('hidden');
        } else {
            userMenu.classList.add('hidden');
        }
    });
</script>
