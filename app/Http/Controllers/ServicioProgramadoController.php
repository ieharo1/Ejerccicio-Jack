<?php

namespace App\Http\Controllers;

use App\Models\ServicioProgramado;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ServicioProgramadoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $programados = ServicioProgramado::with(['cliente', 'vehiculo'])
            ->when($search, function ($query) use ($search) {
                $query->where('servicio', 'like', "%{$search}%")
                    ->orWhere('observacion', 'like', "%{$search}%");
            })
            ->orderBy('fecha_programacion')
            ->paginate(15);
        
        $estaSemana = Carbon::now()->startOfWeek();
        $proximaSemana = Carbon::now()->addWeek()->startOfWeek();
        $esteMes = Carbon::now()->endOfMonth();
        $proximoMes = Carbon::now()->addMonth()->endOfMonth();

        return view('crm.index', compact('programados', 'search', 'estaSemana', 'proximaSemana', 'esteMes', 'proximoMes'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('crm.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'categoria' => 'required|string|max:100',
            'servicio' => 'required|string|max:255',
            'fecha_programacion' => 'required|date',
            'observacion' => 'nullable|string',
            'estado' => 'nullable|in:pendiente,completado,cancelado',
        ]);

        $validated['estado'] = $validated['estado'] ?? 'pendiente';

        ServicioProgramado::create($validated);
        return redirect()->route('crm.index')->with('success', 'Servicio programado creado correctamente');
    }

    public function show(ServicioProgramado $programado)
    {
        $programado->load('cliente', 'vehiculo');
        return view('crm.show', compact('programado'));
    }

    public function edit(ServicioProgramado $programado)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('crm.edit', compact('programado', 'clientes'));
    }

    public function update(Request $request, ServicioProgramado $programado)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'categoria' => 'required|string|max:100',
            'servicio' => 'required|string|max:255',
            'fecha_programacion' => 'required|date',
            'observacion' => 'nullable|string',
            'estado' => 'required|in:pendiente,completado,cancelado',
        ]);

        $programado->update($validated);
        return redirect()->route('crm.index')->with('success', 'Servicio programado actualizado correctamente');
    }

    public function destroy(ServicioProgramado $programado)
    {
        $programado->delete();
        return redirect()->route('crm.index')->with('success', 'Servicio programado eliminado correctamente');
    }

    public function kanban()
    {
        $hoy = Carbon::now();
        $estaSemana = $hoy->copy()->endOfWeek();
        $proximaSemana = $hoy->copy()->addWeek()->endOfWeek();
        $esteMes = $hoy->copy()->endOfMonth();
        $proximoMes = $hoy->copy()->addMonth()->endOfMonth();
        $masDeUnMes = $hoy->copy()->addMonths(2)->startOfMonth();

        $pendientes = ServicioProgramado::where('estado', 'pendiente')
            ->whereNotNull('fecha_programacion')
            ->get()
            ->groupBy(function($item) use ($estaSemana, $proximaSemana, $esteMes, $proximoMes, $masDeUnMes) {
                $fecha = Carbon::parse($item->fecha_programacion);
                if ($fecha->lte($estaSemana)) return 'esta_semana';
                if ($fecha->lte($proximaSemana)) return 'proxima_semana';
                if ($fecha->lte($esteMes)) return 'este_mes';
                if ($fecha->lte($proximoMes)) return 'proximo_mes';
                return 'mas_un_mes';
            });

        return view('crm.kanban', compact('pendientes'));
    }

    public function actualizarEstado(Request $request, ServicioProgramado $programado)
    {
        $programado->update(['estado' => $request->estado]);
        return back()->with('success', 'Estado actualizado correctamente');
    }
}
