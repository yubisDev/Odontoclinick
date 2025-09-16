@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tratamientos</h1>
    <a href="{{ route('tratamientos.create') }}" class="btn btn-primary">Nuevo Tratamiento</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Costo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tratamientos as $tratamiento)
            <tr>
                <td>{{ $tratamiento->id_tratamiento }}</td>
                <td>{{ $tratamiento->nombre_tratamiento }}</td>
                <td>${{ $tratamiento->costo_tratamiento }}</td>
                <td>
                    <a href="{{ route('tratamientos.edit', $tratamiento->id_tratamiento) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('tratamientos.destroy', $tratamiento->id_tratamiento) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar este tratamiento?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
