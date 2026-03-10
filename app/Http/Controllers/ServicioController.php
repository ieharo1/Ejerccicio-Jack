<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $servicios = Servicio::when($search, function ($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('codigo', 'like', "%{$search}%");
        })->orderBy('nombre')->paginate(15);
        
        return view('servicios.index', compact('servicios', 'search'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:50|unique:servicios',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'nullable|string|max:100',
        ]);

        Servicio::create($validated);
        return redirect()->route('servicios.index')->with('success', 'Servicio creado correctamente');
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:50|unique:servicios,codigo,' . $servicio->id,
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'nullable|string|max:100',
        ]);

        $servicio->update($validated);
        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado correctamente');
    }
}
