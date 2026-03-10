@extends('layouts.principal')

@section('title', 'Editar Proveedor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Proveedor</h2>
    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('proveedores.update', $proveedor) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $proveedor->nombre }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $proveedor->telefono }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $proveedor->email }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contacto</label>
                    <input type="text" name="contacto" class="form-control" value="{{ $proveedor->contacto }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ $proveedor->direccion }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
