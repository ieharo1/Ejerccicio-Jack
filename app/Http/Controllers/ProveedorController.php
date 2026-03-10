<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $proveedores = Proveedor::when($search, function ($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('telefono', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->orderBy('nombre')->paginate(15);
        
        return view('proveedores.index', compact('proveedores', 'search'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:255',
        ]);

        Proveedor::create($validated);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente');
    }

    public function show(Proveedor $proveedor)
    {
        $proveedor->load('repuestos', 'compras');
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:255',
        ]);

        $proveedor->update($validated);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente');
    }
}
