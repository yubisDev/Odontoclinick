@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Inventario</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad Disponible</th>
                <th>Stock</th>
                <th>Fecha Entrada</th>
                <th>Fecha Salida</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventarios as $inv)
            <tr>
                <td>{{ $inv->id_inventario }}</td>
                <td>{{ $inv->producto->nombre_producto ?? 'No asignado' }}</td>
                <td>{{ $inv->cantidad_disponible }}</td>
                <td>{{ $inv->stock }}</td>
                <td>{{ $inv->fecha_entrada }}</td>
                <td>{{ $inv->fecha_salida ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay registros en inventario</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
