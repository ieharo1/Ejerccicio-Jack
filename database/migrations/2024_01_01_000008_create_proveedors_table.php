<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->text('direccion')->nullable();
            $table->string('contacto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
