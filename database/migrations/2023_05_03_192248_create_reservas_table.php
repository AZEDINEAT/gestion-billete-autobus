<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('origen');
            $table->string('destino');
            $table->string('numero_bus');
            $table->integer('num_asientos');
            $table->date('fecha_viaje');
            $table->time('hora_viaje'); 
            $table->time('hora_llegada');
            $table->time('duracion'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
