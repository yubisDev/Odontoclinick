<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Cita;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('cita.paciente', 'cita.medico')->get();
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $citas = Cita::with(['paciente', 'medico'])->get();
        return view('pagos.create', compact('citas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cita' => 'required|exists:citas,id_cita',
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
        ]);

        Pago::create($request->all());

        return redirect()->route('pagos.index')
                         ->with('success', 'Pago registrado correctamente.');
    }

    public function show($id)
    {
        $pago = Pago::with('cita.paciente', 'cita.medico')->findOrFail($id);
        return view('pagos.show', compact('pago'));
    }

    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        $citas = Cita::with(['paciente', 'medico'])->get();
        return view('pagos.edit', compact('pago', 'citas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cita' => 'required|exists:citas,id_cita',
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
        ]);

        $pago = Pago::findOrFail($id);
        $pago->update($request->all());

        return redirect()->route('pagos.index')
                         ->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect()->route('pagos.index')
                         ->with('success', 'Pago eliminado correctamente.');
    }
}
