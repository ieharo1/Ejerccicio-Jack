<?php

namespace App\Http\Controllers;

use App\Models\OrdenRecepcion;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class OrdenRecepcionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $recepciones = OrdenRecepcion::with(['cliente', 'vehiculo'])
            ->when($search, function ($query) use ($search) {
                $query->where('id_consecutivo', 'like', "%{$search}%");
            })
            ->orderBy('fecha', 'desc')
            ->paginate(15);
        
        return view('recepciones.index', compact('recepciones', 'search'));
    }

    public function create()
    {
        $clientes = Cliente::with('vehiculos')->orderBy('nombre')->get();
        return view('recepciones.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha' => 'required|date',
            'motivo_ingreso' => 'required|string',
            'comentarios' => 'nullable|string',
            'tecnico' => 'nullable|string|max:255',
            'fecha_vencimiento' => 'nullable|date',
            'kilometraje' => 'nullable|integer',
            'nivel_combustible' => 'nullable|string|max:50',
            'fluidos_adecuados' => 'nullable|boolean',
            'objetos_valor' => 'nullable|string',
            'inventario_interior' => 'nullable|string',
            'danos_visibles' => 'nullable|string',
        ]);

        $consecutivo = 'R-' . date('Ymd') . '-' . str_pad(OrdenRecepcion::count() + 1, 4, '0', STR_PAD_LEFT);
        $validated['id_consecutivo'] = $consecutivo;

        OrdenRecepcion::create($validated);
        return redirect()->route('recepciones.index')->with('success', 'Orden de recepción creada correctamente');
    }

    public function show(OrdenRecepcion $recepcion)
    {
        $recepcion->load('cliente', 'vehiculo');
        return view('recepciones.show', compact('recepcion'));
    }

    public function edit(OrdenRecepcion $recepcion)
    {
        $clientes = Cliente::with('vehiculos')->orderBy('nombre')->get();
        return view('recepciones.edit', compact('recepcion', 'clientes'));
    }

    public function update(Request $request, OrdenRecepcion $recepcion)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha' => 'required|date',
            'motivo_ingreso' => 'required|string',
            'comentarios' => 'nullable|string',
            'tecnico' => 'nullable|string|max:255',
            'fecha_vencimiento' => 'nullable|date',
            'kilometraje' => 'nullable|integer',
            'nivel_combustible' => 'nullable|string|max:50',
            'fluidos_adecuados' => 'nullable|boolean',
            'objetos_valor' => 'nullable|string',
            'inventario_interior' => 'nullable|string',
            'danos_visibles' => 'nullable|string',
        ]);

        $recepcion->update($validated);
        return redirect()->route('recepciones.index')->with('success', 'Orden de recepción actualizada correctamente');
    }

    public function destroy(OrdenRecepcion $recepcion)
    {
        $recepcion->delete();
        return redirect()->route('recepciones.index')->with('success', 'Orden de recepción eliminada correctamente');
    }
}
