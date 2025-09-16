@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Citas</h1>
    <a href="{{ route('citas.create') }}" class="btn btn-primary">Nueva Cita</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
            <tr>
                <td>{{ $cita->id_cita }}</td>
                <td>{{ $cita->paciente->nombre }}</td>
                <td>{{ $cita->medico->nombre }}</td>
                <td>{{ $cita->fecha_horario }}</td>
                <td>{{ $cita->estado }}</td>
                <td>
                    <a href="{{ route('citas.edit', $cita->id_cita) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('citas.destroy', $cita->id_cita) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar esta cita?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
