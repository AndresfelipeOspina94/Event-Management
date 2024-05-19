<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    use HasFactory;

    protected $table = 'asistentes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'tipo',
    ];

    // Relación muchos a muchos con sesiones a través de inscripciones
    public function sesiones()
    {
        return $this->belongsToMany(Sesion::class, 'inscripciones', 'asistente_id', 'sesion_id')->withTimestamps();
    }
}
