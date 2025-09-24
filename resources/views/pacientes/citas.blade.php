<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas</title>
    <!-- Incluye Tailwind CSS (versión CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .cita-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background-color: #fafafa;
            border-left: 5px solid #3b82f6;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .cita-info {
            flex-grow: 1;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="container">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Mis Citas</h1>
        <p class="text-center text-gray-600 mb-8">Aquí puedes ver todas las citas que has agendado.</p>
        
        @if ($citas->isEmpty())
            <div class="text-center text-gray-500 py-10">
                <p class="text-lg">Aún no tienes ninguna cita agendada.</p>
                <p class="mt-2">
                    <a href="{{ route('pacientes.agendar') }}" class="text-blue-500 hover:underline">
                        ¡Agenda tu primera cita aquí!
                    </a>
                </p>
            </div>
        @else
            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                @foreach ($citas as $cita)
                    <div class="cita-card">
                        <div class="cita-info">
                            <p class="text-xl font-semibold text-gray-800">
                                Doctor: {{ $cita->medico->nombre }} {{ $cita->medico->apellidos }}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                <span class="font-medium">Fecha:</span> {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Hora:</span> {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}
                            </p>
                            @if ($cita->notas)
                                <p class="text-sm text-gray-600 mt-2">
                                    <span class="font-medium">Notas:</span> {{ $cita->notas }}
                                </p>
                            @endif
                        </div>
                        <div class="flex-shrink-0">
                            <!-- Botón para cancelar la cita (ejemplo) -->
                            <form action="#" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.27 21H7.73a2 2 0 01-1.954-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v2M6 7h12" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>
