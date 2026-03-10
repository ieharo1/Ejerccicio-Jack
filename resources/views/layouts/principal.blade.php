<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Taller Mecánico')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @livewireStyles
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            border-radius: 5px;
            margin: 2px 10px;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #34495e;
        }
        .card-stat {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @auth
            <div class="col-md-2 sidebar p-0">
                <div class="text-center py-4">
                    <h5 class="text-white">Taller Mecánico</h5>
                </div>
                <nav>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Clientes
                    </a>
                    <a href="{{ route('vehiculos.index') }}" class="{{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                        <i class="bi bi-car-front me-2"></i> Vehículos
                    </a>
                    <a href="{{ route('recepciones.index') }}" class="{{ request()->routeIs('recepciones.*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-check me-2"></i> Recepción
                    </a>
                    <a href="{{ route('ordenes.index') }}" class="{{ request()->routeIs('ordenes.*') ? 'active' : '' }}">
                        <i class="bi bi-wrench me-2"></i> Órdenes Servicio
                    </a>
                    <a href="{{ route('repuestos.index') }}" class="{{ request()->routeIs('repuestos.*') ? 'active' : '' }}">
                        <i class="bi bi-gear me-2"></i> Repuestos
                    </a>
                    <a href="{{ route('servicios.index') }}" class="{{ request()->routeIs('servicios.*') ? 'active' : '' }}">
                        <i class="bi bi-tools me-2"></i> Servicios
                    </a>
                    <a href="{{ route('proveedores.index') }}" class="{{ request()->routeIs('proveedores.*') ? 'active' : '' }}">
                        <i class="bi bi-truck me-2"></i> Proveedores
                    </a>
                    <a href="{{ route('compras.index') }}" class="{{ request()->routeIs('compras.*') ? 'active' : '' }}">
                        <i class="bi bi-cart me-2"></i> Compras
                    </a>
                    <a href="{{ route('ingresos.index') }}" class="{{ request()->routeIs('ingresos.*') ? 'active' : '' }}">
                        <i class="bi bi-cash-stack me-2"></i> Ingresos
                    </a>
                    <a href="{{ route('bancos.index') }}" class="{{ request()->routeIs('bancos.*') ? 'active' : '' }}">
                        <i class="bi bi-bank me-2"></i> Bancos
                    </a>
                    <a href="{{ route('crm.index') }}" class="{{ request()->routeIs('crm.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check me-2"></i> CRM
                    </a>
                    <a href="{{ route('reportes.index') }}" class="{{ request()->routeIs('reportes.*') ? 'active' : '' }}">
                        <i class="bi bi-graph-up me-2"></i> Reportes
                    </a>
                    <hr class="text-white">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                        @csrf
                        <button type="submit" class="btn btn-link text-white text-decoration-none w-100 text-start" style="padding: 12px 20px;">
                            <i class="bi bi-box-arrow-left me-2"></i> Cerrar Sesión
                        </button>
                    </form>
                </nav>
            </div>
            <div class="col-md-10 p-4">
                @else
                <div class="col-12 p-4">
                    @endauth
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
    @yield('scripts')
</body>
</html>
