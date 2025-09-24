@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Agregar Producto</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                    <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="id_categoria" class="form-label">Categoría</label>
                    <select name="id_categoria" id="id_categoria" class="form-select" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
                </div>

                <div class="text-end">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
