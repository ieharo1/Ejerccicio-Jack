<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orden_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('numero_orden')->unique();
            $table->foreignId('orden_recepcion_id')->nullable()->constrained('orden_recepcions')->onDelete('set null');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->enum('tipo', ['normal', 'avanzada'])->default('normal');
            $table->boolean('garantia')->default(false);
            $table->boolean('autoriza_prueba_ruta')->default(false);
            $table->datetime('fecha_ingreso');
            $table->string('asesor_repuestos')->nullable();
            $table->string('tecnico')->nullable();
            $table->enum('estado', ['recepcion', 'diagnostico', 'repuestos', 'aprobacion', 'reparacion', 'control', 'entrega', 'archivado'])->default('recepcion');
            $table->text('observaciones')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('impuesto', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orden_servicios');
    }
};
