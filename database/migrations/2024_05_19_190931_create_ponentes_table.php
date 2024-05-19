<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {    
        Schema::create('ponentes', function (Blueprint $table) {        
            $table->id();        
            $table->string('nombre');        
            $table->string('apellido');        
            $table->text('perfil_profesional');        
            $table->timestamps();    
        });
    }
    
    public function down()
    {    
        Schema::dropIfExists('ponentes');
    }
};