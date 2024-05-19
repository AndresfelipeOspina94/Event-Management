<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    protected $table = 'sesiones';
    protected $primaryKey = 'id';

    protected $fillable = [
        'evento_id',
        'ponente_id',
        'titulo',
        'descripcion',
        'hora_inicio',
        'hora_fin',
    ];

    // Relación uno a muchos inversa con eventos
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    // Relación uno a muchos inversa con ponentes
    public function ponente()
    {
        return $this->belongsTo(Ponente::class, 'ponente_id');
    }

    // Relación muchos a muchos con asistentes a través de inscripciones
    public function asistentes()
    {
        return $this->belongsToMany(Asistente::class, 'inscripciones', 'sesion_id', 'asistente_id')->withTimestamps();
    }
}
