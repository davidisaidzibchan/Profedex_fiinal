<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores';
    use HasFactory;
    protected $fillable = ['nivel_edu', 'nombre', 'descripcion', 'kills', 'xp', 'dificultad','like', 'peligro', 'atributos', 'curiosidades', 'horario', 'categoria', 'habilidades', 'semestres','clases','imagen','tema', 'tipo', 'correo'];

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'profesor_materia', 'id_profesor', 'id_materia');
    }

    protected $casts = [
        'atributos' => 'array',
    ];

    
    public function getAtributosAsArray(): array
    {
        return $this->atributos ?? [];
    }
    
}
