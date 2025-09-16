@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Tratamiento</h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $tratamiento->nombre_tratamiento }}</h4>
            <p><strong>Descripción:</strong> {{ $tratamiento->descripcion ?? 'Sin descripción' }}</p>
            <p><strong>Costo:</strong> ${{ number_format($tratamiento->costo_tratamiento, 2) }}</p>
        </div>
    </div>

    <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary mt-3">Volver</a>
    <a href="{{ route('tratamientos.edit', $tratamiento->id_tratamiento) }}" class="btn btn-warning mt-3">Editar</a>
    <form action="{{ route('tratamientos.destroy', $tratamiento->id_tratamiento) }}" method="POST" style="display:inline;">
        @csrf @method('DELETE')
        <button class="btn btn-danger mt-3" onclick="return confirm('¿Eliminar este tratamiento?')">Eliminar</button>
    </form>
</div>
@endsection
