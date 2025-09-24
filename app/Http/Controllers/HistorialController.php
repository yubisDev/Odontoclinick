<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Paciente;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    // Listar historiales de un paciente
    public function index($id_paciente)
    {
        $paciente = Paciente::findOrFail($id_paciente);
        $historiales = Historial::where('id_paciente', $id_paciente)->get();

        return view('historial.index_all', compact('paciente', 'historiales'));
    }

    // Mostrar detalle de un historial
    public function show($id)
    {
        $historial = Historial::findOrFail($id);
        return view('historial.show', compact('historial'));
    }

    // Formulario para crear historial
    public function create($id_paciente, $id_cita = null)
    {
        $paciente = Paciente::findOrFail($id_paciente);
        $cita = $id_cita ? Cita::findOrFail($id_cita) : null;

        return view('historial.create', compact('paciente', 'cita'));
    }

    // Guardar historial
    public function store(Request $request)
    {
        $request->validate([
            'id_paciente' => 'required|exists:paciente,id_paciente',
            'id_cita' => 'nullable|exists:citas,id_cita',
            'fecha' => 'required|date',
            'procedimiento_realizado' => 'required|string',
            'diagnostico' => 'required|string',
        ]);

        Historial::create([
            'id_paciente' => $request->id_paciente,
            'id_doctor' => Auth::user()->medico->id_doctor,
            'id_cita' => $request->id_cita,
            'fecha' => $request->fecha,
            'procedimiento_realizado' => $request->procedimiento_realizado,
            'diagnostico' => $request->diagnostico,
        ]);

        return redirect()->route('historial.index_all', $request->id_paciente)
            ->with('success', 'Historial registrado correctamente.');
    }

    // Formulario editar historial
    public function edit($id)
    {
        $historial = Historial::findOrFail($id);
        return view('historial.edit', compact('historial'));
    }

    // Actualizar historial
    public function update(Request $request, $id)
    {
        $historial = Historial::findOrFail($id);

        $request->validate([
            'fecha' => 'required|date',
            'procedimiento_realizado' => 'required|string',
            'diagnostico' => 'required|string',
        ]);

        $historial->update($request->all());

        return redirect()->route('historial.index_all')
            ->with('success', 'Historial actualizado correctamente.');
    }

    // Listar todos los historiales agrupados por paciente
    public function indexAll(Request $request)
    {
        $query = Historial::with('paciente')->orderBy('fecha', 'desc');

        // ✅ Filtros
        if ($request->filled('paciente')) {
            $query->whereHas('paciente', function($q) use ($request) {
                $q->where('nombre', 'like', '%'.$request->paciente.'%')
                  ->orWhere('apellidos', 'like', '%'.$request->paciente.'%');
            });
        }

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha', '<=', $request->fecha_fin);
        }

        if ($request->filled('procedimiento')) {
            $query->where('procedimiento_realizado', 'like', '%'.$request->procedimiento.'%');
        }

        if ($request->filled('diagnostico')) {
            $query->where('diagnostico', 'like', '%'.$request->diagnostico.'%');
        }

        $historiales = $query->get()->groupBy('id_paciente');

        return view('historial.index_all', compact('historiales'));
    }


    // Eliminar historial
    public function destroy($id)
    {
        $historial = Historial::findOrFail($id);
        $id_paciente = $historial->id_paciente;
        $historial->delete();

        return redirect()->route('historial.index_all', $id_paciente)
            ->with('success', 'Historial eliminado correctamente.');
    }
}
