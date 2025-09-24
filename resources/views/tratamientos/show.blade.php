@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del Tratamiento</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $tratamiento->nombre_tratamiento }}</h5>
            <p class="card-text"><strong>Descripción:</strong> {{ $tratamiento->descripcion }}</p>
            <p class="card-text"><strong>Costo:</strong> ${{ number_format($tratamiento->costo_tratamiento, 2) }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('tratamientos.edit', $tratamiento->id_tratamiento) }}" class="btn btn-warning">Editar</a>
    </div>
</div>
@endsection
