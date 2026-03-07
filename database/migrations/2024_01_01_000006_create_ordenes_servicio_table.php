<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordenes_servicio', function (Blueprint $table) {
            $table->id();
            $table->string('numero_orden', 20)->unique();
            $table->foreignId('orden_recepcion_id')->nullable()->constrained('ordenes_recepcion')->onDelete('set null');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->enum('tipo_orden', ['normal', 'avanzada'])->default('normal');
            $table->boolean('garantia')->default(false);
            $table->boolean('autoriza_prueba_ruta')->default(false);
            $table->dateTime('fecha_ingreso');
            $table->string('asesor_repuestos', 100)->nullable();
            $table->string('tecnico', 100)->nullable();
            $table->enum('estado', [
                'recepcion', 'diagnostico', 'repuestos', 'aprobacion', 
                'reparacion', 'control', 'entrega', 'archivado'
            ])->default('recepcion');
            $table->text('motivo_ingreso')->nullable();
            $table->text('diagnostico')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('impuesto', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->dateTime('fecha_entrega')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordenes_servicio');
    }
};
