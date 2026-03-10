<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicios_programados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->string('categoria')->nullable();
            $table->string('servicio');
            $table->date('fecha_programacion');
            $table->text('observacion')->nullable();
            $table->enum('estado', ['pendiente', 'realizado', 'cancelado'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicios_programados');
    }
};
