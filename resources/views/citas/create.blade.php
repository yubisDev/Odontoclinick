@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Registrar Nueva Cita</h2>

    <form action="{{ route('citas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_paciente" class="form-label">Paciente</label>
            <select name="id_paciente" class="form-control" required>
                <option value="">Seleccione un paciente</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id_paciente }}">
                        {{ $paciente->nombre }} {{ $paciente->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_doctor" class="form-label">Doctor</label>
            <select name="id_doctor" id="id_doctor" class="form-control" required>
                <option value="">Seleccione un doctor</option>
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id_doctor }}">
                        {{ $medico->nombre }} {{ $medico->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de la Cita</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required
                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        </div>

        {{-- El campo de hora será dinámico --}}
        <div class="mb-3">
            <label for="hora_disponible" class="form-label">Hora de la Cita</label>
            <select name="hora" id="hora_disponible" class="form-control" required disabled>
                <option value="">Seleccione primero un doctor y una fecha</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notas" class="form-label">Notas</label>
            <textarea name="notas" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const doctorSelect = document.getElementById('id_doctor');
        const fechaInput = document.getElementById('fecha');
        const horaSelect = document.getElementById('hora_disponible');

        function fetchAvailableHours() {
            const doctorId = doctorSelect.value;
            const fecha = fechaInput.value;

            if (!doctorId || !fecha) {
                horaSelect.innerHTML = '<option value="">Seleccione primero un doctor y una fecha</option>';
                horaSelect.disabled = true;
                return;
            }
            
            horaSelect.innerHTML = '<option value="">Cargando horas...</option>';
            horaSelect.disabled = true;

            fetch(`{{ route('citas.horarios-disponibles') }}?id_doctor=${doctorId}&fecha=${fecha}`)
                .then(response => response.json())
                .then(horas => {
                    // **Añadido para depuración: Ver el resultado exacto del servidor**
                    console.log('Horas disponibles recibidas:', horas);

                    horaSelect.innerHTML = '';
                    if (horas.length > 0) {
                        horas.forEach(hora => {
                            const option = document.createElement('option');
                            option.value = hora;
                            option.textContent = hora;
                            horaSelect.appendChild(option);
                        });
                        horaSelect.disabled = false;
                    } else {
                        horaSelect.innerHTML = '<option value="">No hay horas disponibles para este día</option>';
                        horaSelect.disabled = true;
                    }
                })
                .catch(error => {
                    console.error('Error al obtener las horas disponibles:', error);
                    horaSelect.innerHTML = '<option value="">Error al cargar las horas</option>';
                    horaSelect.disabled = true;
                });
        }

        doctorSelect.addEventListener('change', fetchAvailableHours);
        fechaInput.addEventListener('change', fetchAvailableHours);
    });
</script>
@endsection
