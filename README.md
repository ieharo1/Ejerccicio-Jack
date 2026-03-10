# Sistema de Gestión para Taller Mecánico

Sistema ERP completo para la gestión de talleres mecánicos profesionales.

## Características

- **Gestión de Clientes**: Registro completo con historial
- **Gestión de Vehículos**: Control por placa, marca, modelo
- **Órdenes de Recepción**: Documentación del estado inicial
- **Órdenes de Servicio**: Flujo de trabajo completo (Recepción → Diagnóstico → Repuestos → Aprobación → Reparación → Control → Entrega)
- **Inventario de Repuestos**: Control de stock con alertas
- **Compras**: Gestión de proveedores y órdenes de compra
- **Ingresos**: Registro de pagos por orden de servicio
- **Bancos**: Gestión de cuentas y movimientos
- **CRM**: Servicios programados con kanban
- **Reportes**: Generación de reportes PDF y Excel

## Tecnologías

- **Backend**: PHP 8.3, Laravel 11, Livewire 3
- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript
- **Base de datos**: MariaDB/MySQL
- **PDF**: DomPDF

## Requisitos

- PHP 8.2+
- Composer
- Node.js
- MySQL/MariaDB

## Instalación

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run build
php artisan serve
```

## Credenciales de Acceso

- **Administrador**: admin@taller.com / password
- **Gerente**: gerente@taller.com / password
- **Técnico**: tecnico@taller.com / password
- **Asesor**: asesor@taller.com / password

## Estructura del Proyecto

```
├── app/
│   ├── Http/Controllers/
│   ├── Livewire/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
└── routes/
```

---

## 👨‍💻 Desarrollado por Isaac Esteban Haro Torres

**Ingeniero en Sistemas · Full Stack · Automatización · Data**

- 📧 Email: zackharo1@gmail.com
- 📱 WhatsApp: 098805517
- 💻 GitHub: https://github.com/ieharo1
- 🌐 Portafolio: https://ieharo1.github.io/portafolio-isaac.haro/

---

© 2026 Isaac Esteban Haro Torres - Todos los derechos reservados.
