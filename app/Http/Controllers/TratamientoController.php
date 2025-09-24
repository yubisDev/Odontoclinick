<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    public function index()
    {
        $tratamientos = Tratamiento::all();
        return view('tratamientos.index', compact('tratamientos'));
    }

    public function create()
    {
        return view('tratamientos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_tratamiento' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'costo_tratamiento' => 'required|numeric',
        ]);

        Tratamiento::create($request->all());

        return redirect()->route('tratamientos.index')
                         ->with('success', 'Tratamiento creado correctamente.');
    }

    public function show($id_tratamiento)
    {
        $tratamiento = Tratamiento::findOrFail($id_tratamiento);
        return view('tratamientos.show', compact('tratamiento'));
    }

    public function edit($id_tratamiento)
    {
        $tratamiento = Tratamiento::findOrFail($id_tratamiento);
        return view('tratamientos.edit', compact('tratamiento'));
    }

    public function update(Request $request, $id_tratamiento)
    {
        $request->validate([
            'nombre_tratamiento' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'costo_tratamiento' => 'required|numeric',
        ]);

        $tratamiento = Tratamiento::findOrFail($id_tratamiento);
        $tratamiento->update($request->all());

        return redirect()->route('tratamientos.index')
                         ->with('success', 'Tratamiento actualizado correctamente.');
    }

    public function destroy($id_tratamiento)
    {
        $tratamiento = Tratamiento::findOrFail($id_tratamiento);
        $tratamiento->delete();

        return redirect()->route('tratamientos.index')
                         ->with('success', 'Tratamiento eliminado correctamente.');
    }
}
