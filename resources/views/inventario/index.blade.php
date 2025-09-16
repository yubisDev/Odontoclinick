@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inventario</h1>
    <a href="{{ route('inventario.create') }}" class="btn btn-primary">Registrar Entrada</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad Disponible</th>
                <th>Stock</th>
                <th>Fecha Entrada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventario as $item)
            <tr>
                <td>{{ $item->id_inventario }}</td>
                <td>{{ $item->producto->nombre_producto }}</td>
                <td>{{ $item->cantidad_disponible }}</td>
                <td>{{ $item->stock }}</td>
                <td>{{ $item->fecha_entrada }}</td>
                <td>
                    <a href="{{ route('inventario.edit', $item->id_inventario) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('inventario.destroy', $item->id_inventario) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar este registro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
