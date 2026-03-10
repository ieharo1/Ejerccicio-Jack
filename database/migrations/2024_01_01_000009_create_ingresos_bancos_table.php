<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cuentas_bancarias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('numero_cuenta', 50)->nullable();
            $table->string('banco', 100)->nullable();
            $table->decimal('saldo_actual', 12, 2)->default(0);
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });

        Schema::create('movimientos_bancarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuenta_bancaria_id')->constrained('cuentas_bancarias')->onDelete('cascade');
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->decimal('monto', 12, 2);
            $table->string('concepto', 255);
            $table->date('fecha');
            $table->foreignId('orden_servicio_id')->nullable()->constrained('ordenes_servicio')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_servicio_id')->nullable()->constrained('ordenes_servicio')->onDelete('set null');
            $table->foreignId('cuenta_bancaria_id')->nullable()->constrained('cuentas_bancarias')->onDelete('set null');
            $table->decimal('monto', 12, 2);
            $table->decimal('impuesto', 12, 2)->default(0);
            $table->string('metodo_pago', 50);
            $table->string('numero_referencia', 100)->nullable();
            $table->date('fecha');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingresos');
        Schema::dropIfExists('movimientos_bancarios');
        Schema::dropIfExists('cuentas_bancarias');
    }
};
