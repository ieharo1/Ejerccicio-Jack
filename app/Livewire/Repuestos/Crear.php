<?php

namespace App\Livewire\Repuestos;

use Livewire\Component;
use App\Models\Repuesto;
use App\Models\CategoriaRepuesto;
use App\Models\Proveedor;

class Crear extends Component
{
    public $codigo = '';
    public $nombre = '';
    public $categoria_id = '';
    public $marca = '';
    public $stock = 0;
    public $stock_minimo = 0;
    public $precio_compra = '';
    public $precio_venta = '';
    public $proveedor_id = '';
    public $activo = true;
    public $modalOpen = false;

    protected $rules = [
        'codigo' => 'required|string|max:50|unique:repuestos,codigo',
        'nombre' => 'required|string|max:255',
        'categoria_id' => 'nullable|exists:categoria_repuestos,id',
        'marca' => 'nullable|string|max:100',
        'stock' => 'required|integer|min:0',
        'stock_minimo' => 'required|integer|min:0',
        'precio_compra' => 'required|numeric|min:0',
        'precio_venta' => 'required|numeric|min:0',
        'proveedor_id' => 'nullable|exists:proveedors,id',
        'activo' => 'boolean',
    ];

    public function openModal()
    {
        $this->resetFields();
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function resetFields()
    {
        $this->reset(['codigo', 'nombre', 'categoria_id', 'marca', 'stock', 'stock_minimo', 'precio_compra', 'precio_venta', 'proveedor_id', 'activo']);
    }

    public function store()
    {
        $this->validate();

        Repuesto::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'categoria_id' => $this->categoria_id ?: null,
            'marca' => $this->marca,
            'stock' => $this->stock,
            'stock_minimo' => $this->stock_minimo,
            'precio_compra' => $this->precio_compra,
            'precio_venta' => $this->precio_venta,
            'proveedor_id' => $this->proveedor_id ?: null,
            'activo' => $this->activo,
        ]);

        session()->flash('message', 'Repuesto creado exitosamente.');
        $this->closeModal();
        $this->dispatch('repuesto-creado');
    }

    public function render()
    {
        $categorias = CategoriaRepuesto::all();
        $proveedores = Proveedor::all();
        return view('livewire.repuestos.crear', compact('categorias', 'proveedores'));
    }
}
