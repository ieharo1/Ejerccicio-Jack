<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\OrdenServicio;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $ingresos = Ingreso::with('ordenServicio.cliente')
            ->when($search, function ($query) use ($search) {
                $query->where('descripcion', 'like', "%{$search}%");
            })
            ->orderBy('fecha', 'desc')
            ->paginate(15);
        
        return view('ingresos.index', compact('ingresos', 'search'));
    }

    public function create()
    {
        $ordenes = OrdenServicio::with('cliente')->orderBy('id_consecutivo', 'desc')->get();
        return view('ingresos.create', compact('ordenes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'orden_servicio_id' => 'nullable|exists:orden_servicios,id',
            'monto' => 'required|numeric|min:0',
            'impuesto' => 'nullable|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        Ingreso::create($validated);
        return redirect()->route('ingresos.index')->with('success', 'Ingreso registrado correctamente');
    }

    public function show(Ingreso $ingreso)
    {
        $ingreso->load('ordenServicio');
        return view('ingresos.show', compact('ingreso'));
    }

    public function destroy(Ingreso $ingreso)
    {
        $ingreso->delete();
        return redirect()->route('ingresos.index')->with('success', 'Ingreso eliminado correctamente');
    }
}
