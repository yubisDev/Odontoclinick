<?php

namespace App\Http\Controllers;

use App\Models\Inventario;

class InventarioController extends Controller
{
    public function index()
    {
        // Traer inventario con productos relacionados
        $inventarios = Inventario::with('producto')->get();

        return view('inventario.index', compact('inventarios'));
    }
}
