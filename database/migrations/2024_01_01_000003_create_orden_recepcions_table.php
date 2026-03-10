<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orden_recepcions', function (Blueprint $table) {
            $table->id();
            $table->string('consecutivo')->unique();
            $table->date('fecha');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->text('motivo_ingreso');
            $table->text('comentarios')->nullable();
            $table->string('tecnico')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->integer('kilometraje')->default(0);
            $table->string('nivel_combustible')->nullable();
            $table->boolean('fluidos_adecuados')->default(true);
            $table->text('objetos_valor')->nullable();
            $table->text('inventario_interior')->nullable();
            $table->text('daños_visibles')->nullable();
            $table->string('fotos')->nullable();
            $table->enum('estado', ['recibido', 'en_proceso', 'entregado', 'cancelado'])->default('recibido');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orden_recepcions');
    }
};
