# 🏢 Sistema de Gestión para Taller Mecánico

Sistema ERP completo para la gestión de talleres mecánicos profesionales.

---

## 📝 Descripción

Sistema profesional para la administración integral de talleres automotrices. Gestiona clientes, vehículos, órdenes de servicio, inventario, proveedores, finanzas y más.

### ¿Qué hace este proyecto?

- **Gestión de Clientes**: Registro completo con historial de servicios
- **Gestión de Vehículos**: Control por placa, marca, modelo, kilometraje
- **Órdenes de Recepción**: Documentación del estado inicial del vehículo
- **Órdenes de Servicio**: Flujo de trabajo completo (Recepción → Diagnóstico → Repuestos → Aprobación → Reparación → Control → Entrega)
- **Inventario de Repuestos**: Control de stock con alertas de bajo stock
- **Compras**: Gestión de proveedores y órdenes de compra
- **Ingresos**: Registro de pagos por orden de servicio
- **Bancos**: Gestión de cuentas bancarias y movimientos
- **CRM**: Servicios programados con kanban
- **Reportes**: Generación de reportes PDF y Excel

---

## ✨ Características Principales

| Característica | Descripción |
|----------------|-------------|
| 👥 **Gestión de Clientes** | CRUD completo con historial |
| 🚗 **Gestión de Vehículos** | Por placa, marca, modelo, año |
| 📋 **Órdenes de Recepción** | Estado inicial del vehículo |
| 🔧 **Órdenes de Servicio** | Flujo de trabajo de 7 etapas |
| 🧩 **Inventario** | Control de repuestos con alertas |
| 🏦 **Finanzas** | Ingresos, bancos, movimientos |
| 📅 **CRM** | Servicios programados con Kanban |
| 📊 **Reportes** | Exportación PDF y Excel |

---

## 🛠️ Stack Tecnológico

- **Backend**: PHP 8.3, Laravel 11, Livewire 3
- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript Vanilla
- **Base de datos**: MySQL/MariaDB
- **PDF**: DomPDF
- **Excel**: Maatwebsite Excel

---

## 🚀 Instalación y Uso

### Requisitos

- PHP 8.2+
- Composer
- Node.js
- MySQL/MariaDB

### Instalación

```bash
# Instalar dependencias
composer install

# Copiar archivo de entorno
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Poblar base de datos con datos de ejemplo
php artisan db:seed

# Instalar dependencias frontend
npm install
npm run build

# Iniciar servidor
php artisan serve
```

### Usar Docker

```bash
# Construir y levantar contenedores
docker-compose up -d

# Acceder al contenedor
docker-compose exec app bash

# Ejecutar migraciones dentro del contenedor
php artisan migrate
php artisan db:seed
```

---

## 👤 Credenciales de Acceso

| Rol | Email | Contraseña |
|-----|-------|------------|
| Administrador | admin@taller.com | password |
| Gerente | gerente@taller.com | password |
| Técnico | tecnico@taller.com | password |
| Asesor | asesor@taller.com | password |

---

## 📁 Estructura del Proyecto

```
├── app/
│   ├── Http/Controllers/    # Controladores
│   ├── Livewire/           # Componentes Livewire
│   └── Models/             # Modelos Eloquent
├── database/
│   ├── migrations/         # Migraciones
│   └── seeders/            # Seeders
├── resources/views/        # Vistas Blade
├── routes/                 # Rutas
└── docker-compose.yml      # Docker
```

---

## 📊 Módulos del Sistema

1. **Dashboard**: Métricas en tiempo real, gráficos de ingresos
2. **Clientes**: CRUD con historial de servicios
3. **Vehículos**: Gestión por placa con historial completo
4. **Recepción**: Documentación del estado inicial
5. **Órdenes de Servicio**: Flujo de 7 etapas
6. **Repuestos**: Inventario con alertas de stock
7. **Servicios**: Catálogo de servicios
8. **Proveedores**: Gestión de proveedores
9. **Compras**: Órdenes de compra
10. **Ingresos**: Registro de pagos
11. **Bancos**: Cuentas y movimientos
12. **CRM**: Servicios programados con Kanban
13. **Reportes**: PDF y Excel

---

## ⚠️ Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- MySQL 8.0 o MariaDB
- Node.js 18+
- NPM

---

## 📦 Paquetes Utilizados

- `laravel/framework` - Framework Laravel
- `livewire/livewire` - Componentes reactivos
- `barryvdh/laravel-dompdf` - Generación de PDFs
- `maatwebsite/excel` - Exportación a Excel
- `bootstrap` - Framework CSS

---

## 👨‍💻 Desarrollado por Isaac Esteban Haro Torres

**Ingeniero en Sistemas · Full Stack · Automatización · Data**

- 📧 Email: zackharo1@gmail.com
- 📱 WhatsApp: 098805517
- 💻 GitHub: https://github.com/ieharo1
- 🌐 Portafolio: https://ieharo1.github.io/portafolio-isaac.haro/

---

© 2026 Isaac Esteban Haro Torres - Todos los derechos reservados.
