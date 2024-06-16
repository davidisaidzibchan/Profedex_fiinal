<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consejo extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'consejo', 'semestre', 'id_materia', 'id_profesor', 'id_usuario', 'anonimo', 'etiquetas', 'estado', 'like', 'dislike','guardado'];

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia');
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'id_profesor');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_consejo', 'id_consejo', 'id_usuario');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }
}
