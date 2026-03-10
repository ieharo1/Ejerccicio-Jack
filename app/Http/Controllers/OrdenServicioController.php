<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\Servicio;
use App\Models\Repuesto;
use App\Models\User;
use Illuminate\Http\Request;

class OrdenServicioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $estado = $request->get('estado');
        
        $ordenes = OrdenServicio::with(['cliente', 'vehiculo', 'tecnico'])
            ->when($search, function ($query) use ($search) {
                $query->where('id_consecutivo', 'like', "%{$search}%");
            })
            ->when($estado, function ($query) use ($estado) {
                $query->where('estado', $estado);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('ordenes.index', compact('ordenes', 'search', 'estado'));
    }

    public function create()
    {
        $clientes = Cliente::with('vehiculos')->orderBy('nombre')->get();
        $servicios = Servicio::orderBy('nombre')->get();
        $repuestos = Repuesto::where('stock', '>', 0)->orderBy('nombre')->get();
        $tecnicos = User::where('rol', 'tecnico')->orWhere('rol', 'admin')->orWhere('rol', 'gerente')->get();
        
        return view('ordenes.create', compact('clientes', 'servicios', 'repuestos', 'tecnicos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'tipo' => 'required|in:normal,avanzada',
            'garantia' => 'required|boolean',
            'autoriza_prueba_ruta' => 'required|boolean',
            'fecha_hora_ingreso' => 'required|date',
            'tecnico_id' => 'nullable|exists:users,id',
            'asesor_repuestos_id' => 'nullable|exists:users,id',
            'requiere_diagnostico' => 'required|boolean',
            'motivo_ingreso' => 'nullable|string',
            'estado' => 'nullable|in:recepcion,diagnostico,repuestos,aprobacion,reparacion,control,entrega,archivado',
        ]);

        $consecutivo = 'OS-' . date('Ymd') . '-' . str_pad(OrdenServicio::count() + 1, 4, '0', STR_PAD_LEFT);
        $validated['id_consecutivo'] = $consecutivo;
        $validated['estado'] = $validated['estado'] ?? 'recepcion';

        $orden = OrdenServicio::create($validated);
        
        if ($request->has('servicios')) {
            foreach ($request->servicios as $servicio) {
                $orden->items()->create([
                    'tipo' => 'servicio',
                    'item_id' => $servicio['id'],
                    'item_nombre' => $servicio['nombre'],
                    'cantidad' => $servicio['cantidad'] ?? 1,
                    'precio' => $servicio['precio'],
                    'impuesto' => 0,
                ]);
            }
        }

        if ($request->has('repuestos')) {
            foreach ($request->repuestos as $repuesto) {
                $orden->items()->create([
                    'tipo' => 'repuesto',
                    'item_id' => $repuesto['id'],
                    'item_nombre' => $repuesto['nombre'],
                    'cantidad' => $repuesto['cantidad'],
                    'precio' => $repuesto['precio'],
                    'impuesto' => 0,
                ]);
            }
        }

        return redirect()->route('ordenes.index')->with('success', 'Orden de servicio creada correctamente');
    }

    public function show(OrdenServicio $orden)
    {
        $orden->load('cliente', 'vehiculo', 'tecnico', 'items');
        return view('ordenes.show', compact('orden'));
    }

    public function edit(OrdenServicio $orden)
    {
        $clientes = Cliente::with('vehiculos')->orderBy('nombre')->get();
        $servicios = Servicio::orderBy('nombre')->get();
        $repuestos = Repuesto::where('stock', '>', 0)->orderBy('nombre')->get();
        $tecnicos = User::where('rol', 'tecnico')->orWhere('rol', 'admin')->orWhere('rol', 'gerente')->get();
        
        return view('ordenes.edit', compact('orden', 'clientes', 'servicios', 'repuestos', 'tecnicos'));
    }

    public function update(Request $request, OrdenServicio $orden)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'tipo' => 'required|in:normal,avanzada',
            'garantia' => 'required|boolean',
            'autoriza_prueba_ruta' => 'required|boolean',
            'fecha_hora_ingreso' => 'required|date',
            'tecnico_id' => 'nullable|exists:users,id',
            'asesor_repuestos_id' => 'nullable|exists:users,id',
            'requiere_diagnostico' => 'required|boolean',
            'motivo_ingreso' => 'nullable|string',
            'estado' => 'required|in:recepcion,diagnostico,repuestos,aprobacion,reparacion,control,entrega,archivado',
        ]);

        $orden->update($validated);
        return redirect()->route('ordenes.index')->with('success', 'Orden de servicio actualizada correctamente');
    }

    public function destroy(OrdenServicio $orden)
    {
        $orden->delete();
        return redirect()->route('ordenes.index')->with('success', 'Orden de servicio eliminada correctamente');
    }

    public function cambiarEstado(Request $request, OrdenServicio $orden)
    {
        $orden->update(['estado' => $request->estado]);
        return back()->with('success', 'Estado actualizado correctamente');
    }
}
