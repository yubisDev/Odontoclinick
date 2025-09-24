@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tratamientos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('tratamientos.create') }}" class="btn btn-primary">+ Nuevo Tratamiento</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tratamientos as $tratamiento)
                <tr>
                    <td>{{ $tratamiento->id_tratamiento }}</td>
                    <td>{{ $tratamiento->nombre_tratamiento }}</td>
                    <td>{{ $tratamiento->descripcion }}</td>
                    <td>${{ number_format($tratamiento->costo_tratamiento, 2) }}</td>
                    <td>
                        <a href="{{ route('tratamientos.show', $tratamiento->id_tratamiento) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('tratamientos.edit', $tratamiento->id_tratamiento) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('tratamientos.destroy', $tratamiento->id_tratamiento) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este tratamiento?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay tratamientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
