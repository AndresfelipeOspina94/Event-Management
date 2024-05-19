<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asistente_id')->constrained('asistentes')->onDelete('cascade');
            $table->foreignId('sesion_id')->constrained('sesiones')->onDelete('cascade');
            $table->date('fecha_inscripcion');
            $table->timestamps();   
        });
    }


    public function down()
    {
        Schema::dropIfExists('inscripciones');
    }
};
