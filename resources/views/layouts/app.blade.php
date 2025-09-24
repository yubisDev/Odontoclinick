<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Odontoclinick')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    body {
        min-height: 100vh;
        display: flex;
        background-color: #f0f2f5; /* Color de fondo más suave */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Sidebar */
    .sidebar {
        width: 220px;
        /* Gradiente de color y sombra */
        background-image: linear-gradient(to bottom, #0d6efd, #004d99); 
        color: white;
        min-height: 100vh;
        transition: all 0.3s;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1rem;
        box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 0 1rem 1rem 0; /* Bordes redondeados */
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        transition: all 0.2s;
    }

    .sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.15); /* Fondo más suave al pasar el cursor */
        border-radius: 0.5rem;
        padding-left: 1.2rem;
    }

    .sidebar .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2);
        font-weight: 500;
        border-radius: 0.5rem;
    }

    .sidebar .btn-toggle-nav a {
        font-size: 0.9rem;
        padding-left: 1.5rem;
    }

    .sidebar hr {
        border-color: rgba(255,255,255,0.2);
    }
    
    /* Animación de íconos */
    .sidebar a i {
        transition: transform 0.2s;
    }
    .sidebar a:hover i {
        transform: scale(1.1);
    }

    /* Contenido */
    .content {
        flex: 1;
        padding: 2rem;
        overflow-x: auto;
    }

    /* Flecha de menú */
    .sidebar .collapse.show + a .bi-chevron-down {
        transform: rotate(180deg);
        transition: transform 0.3s;
    }

    /* Botón de cierre de sesión con efecto visual */
    .logout-btn {
        margin-top: 1rem;
        width: 100%;
        font-weight: 500;
        box-shadow: 0 0 10px rgba(255, 0, 0, 0);
        transition: box-shadow 0.3s ease-in-out;
    }

    .logout-btn:hover {
        box-shadow: 0 0 15px rgba(255, 0, 0, 0.7);
    }
</style>
</head>
<body>

<div class="sidebar d-flex flex-column">
    <div>
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-4 text-white text-decoration-none">
            <span class="fs-4 fw-bold">Odontoclinick</span>
        </a>
        <hr>

        @auth
            @php 
                $rol = auth()->user()->id_rol;
                $rolesText = [1 => 'Admin', 2 => 'Médico', 3 => 'Secretaria', 4 => 'Paciente'];
            @endphp

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="mb-1">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard {{ $rolesText[$rol] ?? '' }}
                    </a>
                </li>
                @if($rol == 1)
                    <li class="mb-1">
                        <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#medicosSub" role="button">
                            <span><i class="bi bi-person-badge me-2"></i>Médicos</span>
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse" id="medicosSub">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('medicos.index') }}" class="nav-link text-white ps-4">Listado</a></li>
                                <li><a href="{{ route('medicos.create') }}" class="nav-link text-white ps-4">Agregar</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('horarios.admin.panel') }}" class="nav-link text-white">
                            <i class="bi bi-clock me-2"></i>Asignar Horarios a Médicos
                        </a>
                    </li>
                    <li class="mb-1">
                        <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#secretariasSub" role="button">
                            <span><i class="bi bi-person-lines-fill me-2"></i>Secretarias</span>
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse" id="secretariasSub">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('secretarias.index') }}" class="nav-link text-white ps-4">Listado</a></li>
                                <li><a href="{{ route('secretarias.create') }}" class="nav-link text-white ps-4">Agregar</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1"><a href="{{ route('tratamientos.index') }}" class="nav-link text-white"><i class="bi bi-journal-medical me-2"></i>Tratamientos</a></li>
                    <li class="mb-1"><a href="{{ route('productos.index') }}" class="nav-link text-white"><i class="bi bi-bag-check me-2"></i>Productos</a></li>
                    <li class="mb-1"><a href="{{ route('inventario.index') }}" class="nav-link text-white"><i class="bi bi-box-seam me-2"></i>Inventario</a></li>
                @elseif($rol == 2)
                    <li class="mb-1">
                        <a href="{{ route('citas.index') }}" class="nav-link text-white">
                            <i class="bi bi-calendar-check me-2"></i>Citas
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('pacientes.index') }}" class="nav-link text-white">
                            <i class="bi bi-people me-2"></i>Pacientes
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('historial.index_all') }}" class="nav-link text-white">
                            <i class="bi bi-folder2-open me-2"></i>Historiales Clínicos
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('horarios.medico.panel') }}" class="nav-link text-white">
                            <i class="bi bi-clock me-2"></i>Mis Horarios
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('medicos.perfil') }}" class="nav-link text-white">
                            <i class="bi bi-person-circle me-2"></i>Mi Perfil
                        </a>
                    </li>
                @elseif($rol == 3)
                    <li class="mb-1"><a href="{{ route('citas.index') }}" class="nav-link text-white"><i class="bi bi-calendar-check me-2"></i>Citas</a></li>
                    <li class="mb-1"><a href="{{ route('pacientes.index') }}" class="nav-link text-white"><i class="bi bi-people me-2"></i>Pacientes</a></li>
                    <li class="mb-1"><a href="{{ route('pagos.index') }}" class="nav-link text-white"><i class="bi bi-cash-stack me-2"></i>Pagos</a></li>
                @elseif($rol == 4)
                    <li class="mb-1">
                        <a href="{{ route('pacientes.show', auth()->id()) }}" class="nav-link text-white">
                            <i class="bi bi-person-circle me-2"></i>Mis Datos
                        </a>
                    </li>
                @endif
            </ul>
        @endauth
    </div>
    
    <div>
        @auth
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmLogout();">
                @csrf
                <button type="submit" class="btn btn-danger logout-btn"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</button>
            </form>
        @endauth
    </div>
</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function confirmLogout() {
    return confirm('¿Estás seguro que deseas cerrar sesión?');
}
</script>
</body>
</html>
