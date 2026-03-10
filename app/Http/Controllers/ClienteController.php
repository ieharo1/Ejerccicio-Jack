<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $clientes = Cliente::when($search, function ($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('cedula_ruc', 'like', "%{$search}%")
                ->orWhere('telefono', 'like', "%{$search}%");
        })->orderBy('nombre')->paginate(15);
        
        return view('clientes.index', compact('clientes', 'search'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula_ruc' => 'required|string|max:20|unique:clientes',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
        ]);

        Cliente::create($validated);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('vehiculos', 'ordenRecepcions', 'ordenServicios');
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula_ruc' => 'required|string|max:20|unique:clientes,cedula_ruc,' . $cliente->id,
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
        ]);

        $cliente->update($validated);
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}
