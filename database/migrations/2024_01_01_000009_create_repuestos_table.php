<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repuestos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->foreignId('categoria_id')->nullable()->constrained('categorias_repuestos')->onDelete('set null');
            $table->string('marca')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('stock_minimo')->default(5);
            $table->decimal('precio_compra', 12, 2)->default(0);
            $table->decimal('precio_venta', 12, 2)->default(0);
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedors')->onDelete('set null');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repuestos');
    }
};
