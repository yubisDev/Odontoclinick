@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detalle del Producto</h2>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $producto->nombre_producto }}</h4>
        </div>
        <div class="card-body">
            <p><strong>🆔 ID:</strong> {{ $producto->id_producto }}</p>
            <p><strong>📦 Categoría:</strong> {{ $producto->categoria->nombre_categoria ?? 'Sin categoría' }}</p>
            <p><strong>📝 Descripción:</strong> {{ $producto->descripcion ?? 'No especificada' }}</p>
            <p><strong>📅 Fecha de Vencimiento:</strong> 
                {{ $producto->fecha_vencimiento ? \Carbon\Carbon::parse($producto->fecha_vencimiento)->format('d/m/Y') : 'No aplica' }}
            </p>
            <p><strong>🔢 Cantidad:</strong> {{ $producto->cantidad }}</p>
            <p><strong>💲 Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
            <div>
                <a href="{{ route('productos.edit', $producto->id_producto) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
                <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
