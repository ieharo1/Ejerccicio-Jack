@extends('layouts.principal')

@section('title', 'Ver Proveedor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $proveedor->nombre }}</h2>
    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Datos del Proveedor</h5></div>
            <div class="card-body">
                <p><strong>Teléfono:</strong> {{ $proveedor->telefono }}</p>
                <p><strong>Email:</strong> {{ $proveedor->email }}</p>
                <p><strong>Dirección:</strong> {{ $proveedor->direccion }}</p>
                <p><strong>Contacto:</strong> {{ $proveedor->contacto }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
