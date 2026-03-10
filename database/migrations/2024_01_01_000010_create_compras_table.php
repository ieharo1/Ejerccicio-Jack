<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('numero_factura')->nullable();
            $table->foreignId('proveedor_id')->constrained('proveedors')->onDelete('cascade');
            $table->date('fecha');
            $table->decimal('total', 12, 2)->default(0);
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['pendiente', 'recibida', 'cancelada'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
