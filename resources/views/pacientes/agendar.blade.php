<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <!-- Incluye Tailwind CSS (versión CDN) para un diseño rápido -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            margin-bottom: 1.5rem;
        }
        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #4b5563;
        }
        .input-group select, .input-group input, .input-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        .input-group select:focus, .input-group input:focus, .input-group textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }
        .error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="form-container">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Agendar Nueva Cita</h1>
        <p class="text-center text-gray-600 mb-8">Selecciona tu doctor y la fecha para ver los horarios disponibles.</p>
        
        <!-- Muestra errores de validación si existen -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Hubo un problema!</strong>
                <span class="block sm:inline">Por favor, revisa los siguientes errores:</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form id="citaForm" action="{{ route('pacientes.agendar.store') }}" method="POST">
            @csrf
            <!-- Campo oculto para el ID del paciente -->
            <!-- Asume que el ID del paciente está disponible a través de la autenticación -->
            <input type="hidden" name="id_paciente" value="{{ Auth::user()->paciente->id_paciente ?? '' }}">

            <div class="input-group">
                <label for="id_doctor">Selecciona un Doctor</label>
                <select id="id_doctor" name="id_doctor" class="w-full px-4 py-2 border rounded-md">
                    <option value="">-- Elige un doctor --</option>
                    @foreach($medicos as $medico)
                        <option value="{{ $medico->id_doctor }}" {{ old('id_doctor') == $medico->id_doctor ? 'selected' : '' }}>
                            {{ $medico->nombre }} {{ $medico->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" class="w-full px-4 py-2 border rounded-md">
            </div>

            <div class="input-group">
                <label for="hora">Hora Disponible</label>
                <select id="hora" name="hora" class="w-full px-4 py-2 border rounded-md" required>
                    <option value="">-- Primero selecciona doctor y fecha --</option>
                </select>
                <div id="loading" class="mt-2 text-gray-500 hidden">Cargando horarios...</div>
            </div>

            <div class="input-group">
                <label for="notas">Notas (opcional)</label>
                <textarea id="notas" name="notas" rows="3" class="w-full px-4 py-2 border rounded-md">{{ old('notas') }}</textarea>
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                    Agendar Cita
                </button>
            </div>
        </form>
    </div>

    <!-- Script para la lógica de horarios dinámicos -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const doctorSelect = document.getElementById('id_doctor');
            const fechaInput = document.getElementById('fecha');
            const horaSelect = document.getElementById('hora');
            const loadingIndicator = document.getElementById('loading');
            
            // Función para obtener los horarios disponibles
            const getAvailableHours = async () => {
                const id_doctor = doctorSelect.value;
                const fecha = fechaInput.value;

                // Solo si ambos campos están llenos
                if (id_doctor && fecha) {
                    horaSelect.innerHTML = '<option value="">Cargando...</option>';
                    loadingIndicator.classList.remove('hidden');

                    try {
                        const response = await fetch('/citas/horarios-disponibles?' + new URLSearchParams({
                            id_doctor: id_doctor,
                            fecha: fecha
                        }));
                        
                        if (!response.ok) {
                            throw new Error('No se pudo obtener la información de los horarios.');
                        }
                        
                        const horas = await response.json();
                        
                        horaSelect.innerHTML = ''; // Limpiar opciones anteriores
                        if (horas.length > 0) {
                            horas.forEach(hora => {
                                const option = document.createElement('option');
                                option.value = hora;
                                option.textContent = hora;
                                horaSelect.appendChild(option);
                            });
                        } else {
                            const option = document.createElement('option');
                            option.value = '';
                            option.textContent = '-- No hay horarios disponibles --';
                            horaSelect.appendChild(option);
                        }
                        
                    } catch (error) {
                        console.error('Error al obtener horarios:', error);
                        horaSelect.innerHTML = '<option value="">-- Error al cargar horarios --</option>';
                    } finally {
                        loadingIndicator.classList.add('hidden');
                    }
                } else {
                    horaSelect.innerHTML = '<option value="">-- Primero selecciona doctor y fecha --</option>';
                }
            };
            
            // Escuchadores de eventos para los cambios en el doctor y la fecha
            doctorSelect.addEventListener('change', getAvailableHours);
            fechaInput.addEventListener('change', getAvailableHours);
            
            // Llama a la función al cargar la página si los campos ya tienen valor
            if (doctorSelect.value && fechaInput.value) {
                getAvailableHours();
            }
        });
    </script>

</body>
</html>
