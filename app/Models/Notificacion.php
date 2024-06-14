<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';
    protected $fillable = ['id_consejo', 'id_usuario', 'mensaje', 'tipo', 'estado'];

    public function consejo()
    {
        return $this->belongsTo(Consejo::class, 'id_consejo');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
