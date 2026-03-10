<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportesExport;

class ReporteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $vehiculos = Vehiculo::with('cliente')->orderBy('placa')->get();
        $tecnicos = User::whereIn('rol', ['tecnico', 'admin', 'gerente'])->get();
        
        return view('reportes.index', compact('clientes', 'vehiculos', 'tecnicos'));
    }

    public function generar(Request $request)
    {
        $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'vehiculo_id' => 'nullable|exists:vehiculos,id',
            'tecnico_id' => 'nullable|exists:users,id',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'estado' => 'nullable|string',
        ]);

        $query = OrdenServicio::with(['cliente', 'vehiculo', 'tecnico', 'items']);

        if ($request->cliente_id) {
            $query->where('cliente_id', $request->cliente_id);
        }
        if ($request->vehiculo_id) {
            $query->where('vehiculo_id', $request->vehiculo_id);
        }
        if ($request->tecnico_id) {
            $query->where('tecnico_id', $request->tecnico_id);
        }
        if ($request->fecha_inicio) {
            $query->whereDate('fecha_hora_ingreso', '>=', $request->fecha_inicio);
        }
        if ($request->fecha_fin) {
            $query->whereDate('fecha_hora_ingreso', '<=', $request->fecha_fin);
        }
        if ($request->estado) {
            $query->where('estado', $request->estado);
        }

        $ordenes = $query->orderBy('fecha_hora_ingreso', 'desc')->get();

        return view('reportes.resultados', compact('ordenes'));
    }

    public function exportarPdf(Request $request)
    {
        $query = OrdenServicio::with(['cliente', 'vehiculo', 'tecnico', 'items']);

        if ($request->cliente_id) {
            $query->where('cliente_id', $request->cliente_id);
        }
        if ($request->vehiculo_id) {
            $query->where('vehiculo_id', $request->vehiculo_id);
        }
        if ($request->tecnico_id) {
            $query->where('tecnico_id', $request->tecnico_id);
        }
        if ($request->fecha_inicio) {
            $query->whereDate('fecha_hora_ingreso', '>=', $request->fecha_inicio);
        }
        if ($request->fecha_fin) {
            $query->whereDate('fecha_hora_ingreso', '<=', $request->fecha_fin);
        }

        $ordenes = $query->orderBy('fecha_hora_ingreso', 'desc')->get();

        $pdf = Pdf::loadView('reportes.pdf', compact('ordenes'));
        return $pdf->download('reporte_ordenes_servicio.pdf');
    }

    public function exportarExcel(Request $request)
    {
        $query = OrdenServicio::with(['cliente', 'vehiculo', 'tecnico', 'items']);

        if ($request->cliente_id) {
            $query->where('cliente_id', $request->cliente_id);
        }
        if ($request->vehiculo_id) {
            $query->where('vehiculo_id', $request->vehiculo_id);
        }
        if ($request->tecnico_id) {
            $query->where('tecnico_id', $request->tecnico_id);
        }
        if ($request->fecha_inicio) {
            $query->whereDate('fecha_hora_ingreso', '>=', $request->fecha_inicio);
        }
        if ($request->fecha_fin) {
            $query->whereDate('fecha_hora_ingreso', '<=', $request->fecha_fin);
        }

        $ordenes = $query->orderBy('fecha_hora_ingreso', 'desc')->get();

        return Excel::download(new ReportesExport($ordenes), 'reporte_ordenes_servicio.xlsx');
    }
}
