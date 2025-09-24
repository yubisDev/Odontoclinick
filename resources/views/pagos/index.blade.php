@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Pagos</h2>
    <a href="{{ route('pagos.create') }}" class="btn btn-primary mb-3">Registrar Pago</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Pago</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Método</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
            <tr>
                <td>{{ $pago->id_pago }}</td>
                <td>{{ $pago->cita->paciente->nombre ?? 'N/A' }}</td>
                <td>{{ $pago->cita->medico->nombre ?? 'N/A' }}</td>
                <td>{{ $pago->monto }}</td>
                <td>{{ $pago->fecha_pago }}</td>
                <td>{{ $pago->metodo_pago }}</td>
                <td>
                    <a href="{{ route('pagos.show', $pago->id_pago) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('pagos.edit', $pago->id_pago) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('pagos.destroy', $pago->id_pago) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Seguro que deseas eliminar este pago?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
