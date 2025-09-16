@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-primary">Nuevo Producto</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id_producto }}</td>
                <td>{{ $producto->nombre_producto }}</td>
                <td>{{ $producto->categoria->nombre_categoria }}</td>
                <td>{{ $producto->cantidad }}</td>
                <td>${{ $producto->precio }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id_producto) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
