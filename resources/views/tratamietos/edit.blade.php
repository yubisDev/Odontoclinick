@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Tratamiento</h1>

    <form action="{{ route('tratamientos.update', $tratamiento->id_tratamiento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre_tratamiento">Nombre del Tratamiento</label>
            <input type="text" name="nombre_tratamiento" value="{{ $tratamiento->nombre_tratamiento }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $tratamiento->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="costo_tratamiento">Costo</label>
            <input type="number" name="costo_tratamiento" step="0.01" value="{{ $tratamiento->costo_tratamiento }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
