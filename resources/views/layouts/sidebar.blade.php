<!-- Sidebar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="w-64 h-full bg-orange-500 text-white flex flex-col">
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
