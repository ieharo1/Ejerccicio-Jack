<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_servicio_id')->nullable()->constrained('orden_servicios')->nullOnDelete();
            $table->decimal('monto', 12, 2);
            $table->decimal('impuesto', 12, 2)->default(0);
            $table->string('metodo_pago');
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
