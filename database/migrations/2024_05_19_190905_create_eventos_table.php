<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
           $table->id();
           $table->string('nombre');
           $table->text('descripcion');
           $table->date('fecha_inicio');
           $table->date('fecha_fin');
           $table->string('ubicacion');
           $table->timestamps();    
        });
    }

    public function down()
    {
        Schema::dropIfExists('eventos');
    }
};
