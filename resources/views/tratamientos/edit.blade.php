@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Tratamiento</h2>

    <form action="{{ route('tratamientos.update', $tratamiento->id_tratamiento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre del Tratamiento</label>
            <input type="text" name="nombre_tratamiento" class="form-control" value="{{ $tratamiento->nombre_tratamiento }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $tratamiento->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Costo</label>
            <input type="number" step="0.01" name="costo_tratamiento" class="form-control" value="{{ $tratamiento->costo_tratamiento }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
