@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Gestión de Productos</h2>

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Buscador --}}
    <form action="{{ route('productos.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar producto..." value="{{ request('buscar') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    {{-- Botón agregar producto --}}
    <div class="mb-3 text-end">
        <a href="{{ route('productos.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Agregar Producto
        </a>
    </div>

    {{-- Tabla de productos --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Fecha Vencimiento</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                    <tr>
                        <td class="text-center">{{ $producto->id_producto }}</td>
                        <td>{{ $producto->nombre_producto }}</td>
                        <td>{{ $producto->categoria->nombre_categoria ?? 'Sin categoría' }}</td>
                        <td>{{ Str::limit($producto->descripcion, 40) }}</td>
                        <td class="text-center">{{ $producto->fecha_vencimiento }}</td>
                        <td class="text-center">{{ $producto->cantidad }}</td>
                        <td class="text-end">${{ number_format($producto->precio, 2) }}</td>
                        <td class="text-center">
                            <a href="{{ route('productos.edit', $producto->id_producto) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No se encontraron productos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $productos->links() }}
    </div>
</div>
@endsection
