<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Repuesto;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $compras = Compra::with('proveedor')
            ->when($search, function ($query) use ($search) {
                $query->where('numero_factura', 'like', "%{$search}%");
            })
            ->orderBy('fecha', 'desc')
            ->paginate(15);
        
        return view('compras.index', compact('compras', 'search'));
    }

    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        $repuestos = Repuesto::orderBy('nombre')->get();
        return view('compras.create', compact('proveedores', 'repuestos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedors,id',
            'fecha' => 'required|date',
            'numero_factura' => 'nullable|string|max:50',
            'observaciones' => 'nullable|string',
        ]);

        $compra = Compra::create($validated);
        
        $total = 0;
        if ($request->has('items')) {
            foreach ($request->items as $item) {
                $repuesto = Repuesto::find($item['repuesto_id']);
                $subtotal = $item['cantidad'] * $item['precio_unitario'];
                
                $compra->items()->create([
                    'repuesto_id' => $item['repuesto_id'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'subtotal' => $subtotal,
                ]);
                
                $repuesto->increment('stock', $item['cantidad']);
                $total += $subtotal;
            }
        }

        $compra->update(['total' => $total]);
        
        return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente');
    }

    public function show(Compra $compra)
    {
        $compra->load('proveedor', 'items.repuesto');
        return view('compras.show', compact('compra'));
    }

    public function destroy(Compra $compra)
    {
        foreach ($compra->items as $item) {
            $repuesto = Repuesto::find($item->repuesto_id);
            if ($repuesto) {
                $repuesto->decrement('stock', $item->cantidad);
            }
        }
        
        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente');
    }
}
