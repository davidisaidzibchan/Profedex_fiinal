<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'materia_profesores', 'id_materia', 'id_profesor');
    }
}
