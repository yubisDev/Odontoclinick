@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre_producto">Nombre del Producto</label>
            <input type="text" name="nombre_producto" value="{{ $producto->nombre_producto }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_categoria">Categoría</label>
            <select name="id_categoria" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}" {{ $producto->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->nombre_categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" value="{{ $producto->cantidad }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
