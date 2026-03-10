@extends('layouts.principal')

@section('title', 'Ver Recepción')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Recepción: {{ $recepcion->id_consecutivo }}</h2>
    <a href="{{ route('recepciones.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Datos de Recepción</h5></div>
            <div class="card-body">
                <p><strong>Fecha:</strong> {{ $recepcion->fecha->format('d/m/Y') }}</p>
                <p><strong>Cliente:</strong> {{ $recepcion->cliente->nombre ?? 'N/A' }}</p>
                <p><strong>Vehículo:</strong> {{ $recepcion->vehiculo->placa ?? 'N/A' }} - {{ $recepcion->vehiculo->marca ?? '' }} {{ $recepcion->vehiculo->modelo ?? '' }}</p>
                <p><strong>Técnico:</strong> {{ $recepcion->tecnico }}</p>
                <p><strong>Motivo de Ingreso:</strong> {{ $recepcion->motivo_ingreso }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h5>Condiciones de Recepción</h5></div>
            <div class="card-body">
                <p><strong>Kilometraje:</strong> {{ number_format($recepcion->kilometraje ?? 0) }} km</p>
                <p><strong>Nivel Combustible:</strong> {{ $recepcion->nivel_combustible }}</p>
                <p><strong>Fluidos Adecuados:</strong> {{ $recepcion->fluidos_adecuados ? 'Sí' : 'No' }}</p>
                <p><strong>Objetos de Valor:</strong> {{ $recepcion->objetos_valor ?? 'Ninguno' }}</p>
                <p><strong>Daños Visibles:</strong> {{ $recepcion->danos_visibles ?? 'Ninguno' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h5>Comentarios</h5></div>
    <div class="card-body">
        {{ $recepcion->comentarios ?? 'Sin comentarios' }}
    </div>
</div>
@endsection
