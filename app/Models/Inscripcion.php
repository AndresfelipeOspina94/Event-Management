<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';
    protected $primaryKey = 'id';

    protected $fillable = [
        'asistente_id',
        'sesion_id',
        'fecha_inscripcion',
    ];

    // Relación muchos a uno con asistentes
    public function asistente()
    {
        return $this->belongsTo(Asistente::class, 'asistente_id');
    }

    // Relación muchos a uno con sesiones
    public function sesion()
    {
        return $this->belongsTo(Sesion::class, 'sesion_id');
    }
}
