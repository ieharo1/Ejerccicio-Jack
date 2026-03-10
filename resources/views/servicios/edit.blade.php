@extends('layouts.principal')

@section('title', 'Editar Servicio')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Servicio</h2>
    <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('servicios.update', $servicio) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Código</label>
                    <input type="text" name="codigo" class="form-control" value="{{ $servicio->codigo }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $servicio->nombre }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" class="form-control" step="0.01" value="{{ $servicio->precio }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Categoría</label>
                    <input type="text" name="categoria" class="form-control" value="{{ $servicio->categoria }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3">{{ $servicio->descripcion }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
