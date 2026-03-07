<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller Mecánico - Sistema ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar { min-height: 100vh; background: #2c3e50; }
        .sidebar a { color: #ecf0f1; text-decoration: none; padding: 12px 15px; display: block; border-radius: 5px; margin: 2px 8px; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; }
        .sidebar a i { margin-right: 10px; width: 20px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .stat-card { border-left: 4px solid; }
        .stat-card.blue { border-color: #3498db; }
        .stat-card.green { border-color: #2ecc71; }
        .stat-card.orange { border-color: #f39c12; }
        .stat-card.red { border-color: #e74c3c; }
        .table-responsive { border-radius: 10px; overflow: hidden; }
        .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 0.85em; }
        .status-recepcion { background: #e3f2fd; color: #1565c0; }
        .status-diagnostico { background: #fff3e0; color: #ef6c00; }
        .status-repuestos { background: #e8f5e9; color: #2e7d32; }
        .status-aprobacion { background: #f3e5f5; color: #7b1fa2; }
        .status-reparacion { background: #e0f7fa; color: #00838f; }
        .status-control { background: #fce4ec; color: #c2185b; }
        .status-entrega { background: #e8f5e9; color: #1b5e20; }
        .status-archivado { background: #eceff1; color: #546e7a; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 text-center border-bottom border-secondary">
                    <h5 class="text-white mb-0"><i class="fas fa-wrench"></i> Taller Mecánico</h5>
                </div>
                <nav class="p-2">
                    <a href="#" onclick="showModule('dashboard')" class="active" id="nav-dashboard"><i class="fas fa-home"></i> Dashboard</a>
                    <a href="#" onclick="showModule('clientes')" id="nav-clientes"><i class="fas fa-users"></i> Clientes</a>
                    <a href="#" onclick="showModule('vehiculos')" id="nav-vehiculos"><i class="fas fa-car"></i> Vehículos</a>
                    <a href="#" onclick="showModule('recepciones')" id="nav-recepciones"><i class="fas fa-clipboard-list"></i> Recepciones</a>
                    <a href="#" onclick="showModule('servicios')" id="nav-servicios"><i class="fas fa-tools"></i> Órdenes Servicio</a>
                    <a href="#" onclick="showModule('repuestos')" id="nav-repuestos"><i class="fas fa-cogs"></i> Repuestos</a>
                    <a href="#" onclick="showModule('proveedores')" id="nav-proveedores"><i class="fas fa-truck"></i> Proveedores</a>
                    <a href="#" onclick="showModule('compras')" id="nav-compras"><i class="fas fa-shopping-cart"></i> Compras</a>
                    <a href="#" onclick="showModule('ingresos')" id="nav-ingresos"><i class="fas fa-dollar-sign"></i> Ingresos</a>
                    <a href="#" onclick="showModule('bancos')" id="nav-bancos"><i class="fas fa-university"></i> Bancos</a>
                    <a href="#" onclick="showModule('crm')" id="nav-crm"><i class="fas fa-calendar-alt"></i> CRM</a>
                    <a href="#" onclick="showModule('reportes')" id="nav-reportes"><i class="fas fa-chart-bar"></i> Reportes</a>
                    <a href="#" onclick="showModule('usuarios')" id="nav-usuarios"><i class="fas fa-user-cog"></i> Usuarios</a>
                </nav>
            </div>
            <div class="col-md-10 p-4" id="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showModule(module) {
            document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
            document.getElementById('nav-' + module).classList.add('active');
            loadModule(module);
        }

        function loadModule(module) {
            const content = document.getElementById('main-content');
            content.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div></div>';
            
            fetch('/api/module/' + module)
                .then(r => r.text())
                .then(html => { content.innerHTML = html; })
                .catch(() => { content.innerHTML = '<div class="alert alert-danger">Error cargando módulo</div>'; });
        }

        function guardarCliente() {
            const form = document.getElementById('form-cliente');
            const data = new FormData(form);
            fetch('/api/clientes', { method: 'POST', body: data })
                .then(r => r.json())
                .then(d => {
                    if(d.success) { alert('Guardado'); showModule('clientes'); }
                    else alert(d.message);
                });
        }

        function guardarVehiculo() {
            const form = document.getElementById('form-vehiculo');
            const data = new FormData(form);
            fetch('/api/vehiculos', { method: 'POST', body: data })
                .then(r => r.json())
                .then(d => {
                    if(d.success) { alert('Guardado'); showModule('vehiculos'); }
                    else alert(d.message);
                });
        }

        function guardarRecepcion() {
            const form = document.getElementById('form-recepcion');
            const data = new FormData(form);
            fetch('/api/recepciones', { method: 'POST', body: data })
                .then(r => r.json())
                .then(d => {
                    if(d.success) { alert('Guardado'); showModule('recepciones'); }
                    else alert(d.message);
                });
        }

        function guardarOrden() {
            const form = document.getElementById('form-orden');
            const data = new FormData(form);
            fetch('/api/ordenes', { method: 'POST', body: data })
                .then(r => r.json())
                .then(d => {
                    if(d.success) { alert('Guardado'); showModule('servicios'); }
                    else alert(d.message);
                });
        }

        function guardarRepuesto() {
            const form = document.getElementById('form-repuesto');
            const data = new FormData(form);
            fetch('/api/repuestos', { method: 'POST', body: data })
                .then(r => r.json())
                .then(d => {
                    if(d.success) { alert('Guardado'); showModule('repuestos'); }
                    else alert(d.message);
                });
        }

        function guardarProveedor() {
            const form = document.getElementById('form-proveedor');
            const data = new FormData(form);
            fetch('/api/proveedores', { method: 'POST', body: data })
                .then(r => r.json())
                .then(d => {
                    if(d.success) { alert('Guardado'); showModule('proveedores'); }
                    else alert(d.message);
                });
        }

        function buscarCliente(select) {
            const id = select.value;
            if(!id) return;
            fetch('/api/vehiculos/cliente/' + id)
                .then(r => r.json())
                .then(vs => {
                    const vselect = document.getElementById('vehiculo_id');
                    vselect.innerHTML = '<option value="">Seleccione...</option>';
                    vs.forEach(v => { vselect.innerHTML += `<option value="${v.id}">${v.placa} - ${v.marca} ${v.modelo}</option>`; });
                });
        }
    </script>
    @yield('scripts')
</body>
</html>
