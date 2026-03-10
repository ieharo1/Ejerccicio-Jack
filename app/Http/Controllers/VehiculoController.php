<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $vehiculos = Vehiculo::with('cliente')
            ->when($search, function ($query) use ($search) {
                $query->where('placa', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('modelo', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('vehiculos.index', compact('vehiculos', 'search'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('vehiculos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'placa' => 'required|string|max:20|unique:vehiculos',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'año' => 'nullable|integer|min:1900|max:2100',
            'color' => 'nullable|string|max:50',
            'vin' => 'nullable|string|max:50',
            'kilometraje' => 'nullable|integer|min:0',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        Vehiculo::create($validated);
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente');
    }

    public function show(Vehiculo $vehiculo)
    {
        $vehiculo->load('cliente', 'ordenServicios', 'ordenRecepcions');
        return view('vehiculos.show', compact('vehiculo'));
    }

    public function edit(Vehiculo $vehiculo)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('vehiculos.edit', compact('vehiculo', 'clientes'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $validated = $request->validate([
            'placa' => 'required|string|max:20|unique:vehiculos,placa,' . $vehiculo->id,
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'año' => 'nullable|integer|min:1900|max:2100',
            'color' => 'nullable|string|max:50',
            'vin' => 'nullable|string|max:50',
            'kilometraje' => 'nullable|integer|min:0',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $vehiculo->update($validated);
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado correctamente');
    }
}
