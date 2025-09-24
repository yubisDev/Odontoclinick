<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Inventario;

class ProductoController extends Controller
{
    /**
     * Mostrar listado de productos
     */
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        if ($request->filled('buscar')) {
            $query->where('nombre_producto', 'LIKE', '%' . $request->buscar . '%');
        }

        $productos = $query->paginate(10);

        return view('productos.index', compact('productos'));
    }


    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    /**
     * Guardar nuevo producto
     */
    public function store(Request $request)
    {
        // 1. Validar datos
        $request->validate([
            'nombre_producto' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'fecha_vencimiento' => 'nullable|date',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categoria,id_categoria',
        ]);

        // 2. Guardar producto
        $producto = Producto::create([
            'nombre_producto'   => $request->nombre_producto,
            'descripcion'       => $request->descripcion,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'cantidad'          => $request->cantidad,
            'precio'            => $request->precio,
            'id_categoria'      => $request->id_categoria,
        ]);

        // 3. Crear registro en inventario
        Inventario::create([
            'id_producto'        => $producto->id_producto,
            'cantidad_disponible'=> $request->cantidad,
            'stock'              => $request->cantidad,
            'fecha_entrada'      => now(),
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto agregado y registrado en inventario');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit($id)
    {
        $producto   = Producto::findOrFail($id);
        $categorias = Categoria::all();

        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualizar un producto
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_producto'   => 'required|string|max:255',
            'descripcion'       => 'nullable|string',
            'fecha_vencimiento' => 'required|date',
            'cantidad'          => 'required|integer|min:0',
            'precio'            => 'required|numeric|min:0',
            'id_categoria'      => 'required|exists:categoria,id_categoria',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')
                         ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar un producto
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')
                         ->with('success', 'Producto eliminado correctamente.');
    }
}
