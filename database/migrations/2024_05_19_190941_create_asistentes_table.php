<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {    
        Schema::create('asistentes', function (Blueprint $table) {        
            $table->id();        
            $table->string('nombre');        
            $table->string('apellido');        
            $table->string('email')->unique();        
            $table->enum('tipo', ['estudiante', 'profesor', 'profesional']);        
            $table->timestamps();    
        });
    }
    
    public function down()
    {    
        Schema::dropIfExists('asistentes');
    }
    
};
