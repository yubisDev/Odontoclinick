@extends('layouts.app')

@section('content')
<div class="container mt-5"> <!-- margen para diferenciar del fondo -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Bienvenido, {{ Auth::user()->nombre_usuario }}</h2>

    </div>

    <hr>

    <h4>Próximas Citas</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->doctor->nombre }}</td>
                    <td>{{ $cita->fecha_horario ?? $cita->fecha }}</td>
                    <td>{{ $cita->hora ?? '-' }}</td>
                    <td>{{ $cita->estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No tienes citas programadas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Script de confirmación -->
<script>
function confirmLogout() {
    return confirm('¿Estás seguro que deseas cerrar sesión?');
}
</script>
@endsection
