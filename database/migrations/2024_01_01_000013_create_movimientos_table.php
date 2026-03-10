<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuenta_bancaria_id')->constrained('cuentas_bancarias')->onDelete('cascade');
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->decimal('monto', 12, 2);
            $table->string('descripcion')->nullable();
            $table->foreignId('orden_servicio_id')->nullable()->constrained('orden_servicios')->onDelete('set null');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
