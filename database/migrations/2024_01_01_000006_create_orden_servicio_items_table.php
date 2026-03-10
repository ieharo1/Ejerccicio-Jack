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
            $table->foreignId('orden_servicio_id')->constrained('orden_servicios')->onDelete('cascade');
            $table->foreignId('servicio_id')->nullable()->constrained('servicios')->onDelete('set null');
            $table->string('item');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio', 12, 2);
            $table->decimal('impuesto', 5, 2)->default(12);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orden_servicio_items');
    }
};
