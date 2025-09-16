@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Inventario</h1>

    <form action="{{ route('inventario.update', $inventario->id_inventario) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_producto">Producto</label>
            <select name="id_producto" class="form-control" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}" {{ $inventario->id_producto == $producto->id_producto ? 'selected' : '' }}>
                        {{ $producto->nombre_producto }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_disponible">Cantidad Disponible</label>
            <input type="number" name="cantidad_disponible" value="{{ $inventario->cantidad_disponible }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="stock">Stock</label>
            <input type="number" name="stock" value="{{ $inventario->stock }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fecha_entrada">Fecha de Entrada</label>
            <input type="date" name="fecha_entrada" value="{{ $inventario->fecha_entrada }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('inventario.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
