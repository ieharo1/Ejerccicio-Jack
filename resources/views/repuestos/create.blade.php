@extends('layouts.principal')

@section('title', 'Nuevo Repuesto')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nuevo Repuesto</h2>
    <a href="{{ route('repuestos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('repuestos.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Código</label>
                    <input type="text" name="codigo" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Categoría</label>
                    <select name="categoria_id" class="form-select" required>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Marca</label>
                    <input type="text" name="marca" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Proveedor</label>
                    <select name="proveedor_id" class="form-select">
                        <option value="">Seleccionar</option>
                        @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Stock Mínimo</label>
                    <input type="number" name="stock_minimo" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Precio Compra</label>
                    <input type="number" name="precio_compra" class="form-control" step="0.01" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Precio Venta</label>
                    <input type="number" name="precio_venta" class="form-control" step="0.01" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@endsection
