<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponente extends Model
{
    use HasFactory;

    protected $table = 'ponentes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido',
        'perfil_profesional',
    ];

    // Relación uno a muchos con sesiones
    public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'ponente_id');
    }
}
