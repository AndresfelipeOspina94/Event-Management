<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sesiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->foreignId('ponente_id')->nullable()->constrained('ponentes')->onDelete('set null');
            $table->string('titulo');
            $table->text('descripcion');
            $table->time('hora_inicio');
            $table->time('hora_fin');        
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sesiones');
    }
};
