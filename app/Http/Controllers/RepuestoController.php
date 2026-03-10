<?php

namespace App\Http\Controllers;

use App\Models\Repuesto;
use App\Models\CategoriaRepuesto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class RepuestoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categoria = $request->get('categoria');
        
        $repuestos = Repuesto::with('categoria', 'proveedor')
            ->when($search, function ($query) use ($search) {
                $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('codigo', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%");
            })
            ->when($categoria, function ($query) use ($categoria) {
                $query->where('categoria_id', $categoria);
            })
            ->orderBy('nombre')
            ->paginate(15);

        $categorias = CategoriaRepuesto::orderBy('nombre')->get();
        $stockBajo = Repuesto::whereRaw('stock <= stock_minimo')->get();
        
        return view('repuestos.index', compact('repuestos', 'search', 'categorias', 'stockBajo', 'categoria'));
    }

    public function create()
    {
        $categorias = CategoriaRepuesto::orderBy('nombre')->get();
        $proveedores = Proveedor::orderBy('nombre')->get();
        return view('repuestos.create', compact('categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:50|unique:repuestos',
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categoria_repuestos,id',
            'marca' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'proveedor_id' => 'nullable|exists:proveedors,id',
        ]);

        Repuesto::create($validated);
        return redirect()->route('repuestos.index')->with('success', 'Repuesto creado correctamente');
    }

    public function show(Repuesto $repuesto)
    {
        $repuesto->load('categoria', 'proveedor');
        return view('repuestos.show', compact('repuesto'));
    }

    public function edit(Repuesto $repuesto)
    {
        $categorias = CategoriaRepuesto::orderBy('nombre')->get();
        $proveedores = Proveedor::orderBy('nombre')->get();
        return view('repuestos.edit', compact('repuesto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, Repuesto $repuesto)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:50|unique:repuestos,codigo,' . $repuesto->id,
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categoria_repuestos,id',
            'marca' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'proveedor_id' => 'nullable|exists:proveedors,id',
        ]);

        $repuesto->update($validated);
        return redirect()->route('repuestos.index')->with('success', 'Repuesto actualizado correctamente');
    }

    public function destroy(Repuesto $repuesto)
    {
        $repuesto->delete();
        return redirect()->route('repuestos.index')->with('success', 'Repuesto eliminado correctamente');
    }
}
