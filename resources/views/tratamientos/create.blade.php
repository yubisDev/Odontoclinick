@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nuevo Tratamiento</h2>

    <form action="{{ route('tratamientos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre del Tratamiento</label>
            <input type="text" name="nombre_tratamiento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Costo</label>
            <input type="number" step="0.01" name="costo_tratamiento" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
