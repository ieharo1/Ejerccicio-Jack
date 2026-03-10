<?php

namespace App\Http\Controllers;

use App\Models\CuentaBancaria;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class CuentaBancariaController extends Controller
{
    public function index()
    {
        $cuentas = CuentaBancaria::with('movimientos')->get();
        return view('bancos.index', compact('cuentas'));
    }

    public function create()
    {
        return view('bancos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_cuenta' => 'nullable|string|max:50',
            'banco' => 'nullable|string|max:100',
            'saldo_inicial' => 'nullable|numeric|min:0',
            'tipo' => 'required|in:ahorro,corriente',
        ]);

        CuentaBancaria::create($validated);
        return redirect()->route('bancos.index')->with('success', 'Cuenta bancaria creada correctamente');
    }

    public function show(CuentaBancaria $cuenta)
    {
        $movimientos = $cuenta->movimientos()->orderBy('fecha', 'desc')->paginate(20);
        return view('bancos.show', compact('cuenta', 'movimientos'));
    }

    public function edit(CuentaBancaria $cuenta)
    {
        return view('bancos.edit', compact('cuenta'));
    }

    public function update(Request $request, CuentaBancaria $cuenta)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_cuenta' => 'nullable|string|max:50',
            'banco' => 'nullable|string|max:100',
            'tipo' => 'required|in:ahorro,corriente',
        ]);

        $cuenta->update($validated);
        return redirect()->route('bancos.index')->with('success', 'Cuenta bancaria actualizada correctamente');
    }

    public function destroy(CuentaBancaria $cuenta)
    {
        $cuenta->delete();
        return redirect()->route('bancos.index')->with('success', 'Cuenta bancaria eliminada correctamente');
    }

    public function movimiento(Request $request, CuentaBancaria $cuenta)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:ingreso,egreso',
            'monto' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
        ]);

        $validated['cuenta_bancaria_id'] = $cuenta->id;

        if ($validated['tipo'] === 'ingreso') {
            $cuenta->increment('saldo_actual', $validated['monto']);
        } else {
            $cuenta->decrement('saldo_actual', $validated['monto']);
        }

        Movimiento::create($validated);
        
        return back()->with('success', 'Movimiento registrado correctamente');
    }
}
