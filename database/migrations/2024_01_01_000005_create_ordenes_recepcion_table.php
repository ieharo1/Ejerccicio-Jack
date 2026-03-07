<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordenes_recepcion', function (Blueprint $table) {
            $table->id();
            $table->string('consecutivo', 20)->unique();
            $table->date('fecha');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->text('motivo_ingreso');
            $table->text('comentarios')->nullable();
            $table->string('tecnico', 100)->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->integer('kilometraje')->nullable();
            $table->string('nivel_combustible', 20)->nullable();
            $table->boolean('fluidos_adecuados')->default(true);
            $table->text('objetos_valor')->nullable();
            $table->text('inventario_interior')->nullable();
            $table->text('daños_visibles')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordenes_recepcion');
    }
};
