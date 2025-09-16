@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Tratamiento</h1>

    <form action="{{ route('tratamientos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre_tratamiento">Nombre del Tratamiento</label>
            <input type="text" name="nombre_tratamiento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="costo_tratamiento">Costo</label>
            <input type="number" name="costo_tratamiento" step="0.01" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
