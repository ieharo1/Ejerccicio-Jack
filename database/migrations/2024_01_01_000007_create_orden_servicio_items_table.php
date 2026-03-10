<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orden_servicio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_servicio_id')->constrained('ordenes_servicio')->onDelete('cascade');
            $table->foreignId('repuesto_id')->nullable()->constrained('repuestos')->onDelete('set null');
            $table->string('item', 255);
            $table->integer('cantidad')->default(1);
            $table->decimal('precio', 12, 2)->default(0);
            $table->decimal('impuesto', 5, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->string('tipo', 50)->default('servicio'); // servicio o repuesto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orden_servicio_items');
    }
};
