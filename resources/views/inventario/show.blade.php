@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Inventario</h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Producto: {{ $inventario->producto->nombre_producto }}</h4>
            <p><strong>Cantidad Disponible:</strong> {{ $inventario->cantidad_disponible }}</p>
            <p><strong>Stock:</strong> {{ $inventario->stock }}</p>
            <p><strong>Fecha de Entrada:</strong> {{ $inventario->fecha_entrada }}</p>
        </div>
    </div>

    <a href="{{ route('inventario.index') }}" class="btn btn-secondary mt-3">Volver</a>
    <a href="{{ route('inventario.edit', $inventario->id_inventario) }}" class="btn btn-warning mt-3">Editar</a>
    <form action="{{ route('inventario.destroy', $inventario->id_inventario) }}" method="POST" style="display:inline;">
        @csrf @method('DELETE')
        <button class="btn btn-danger mt-3" onclick="return confirm('¿Eliminar este registro de inventario?')">Eliminar</button>
    </form>
</div>
@endsection
