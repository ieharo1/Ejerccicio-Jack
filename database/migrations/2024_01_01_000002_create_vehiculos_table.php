<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('placa')->unique();
            $table->string('marca');
            $table->string('modelo');
            $table->integer('año');
            $table->string('color')->nullable();
            $table->string('vin')->nullable();
            $table->integer('kilometraje')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
