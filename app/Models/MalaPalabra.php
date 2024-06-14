<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MalaPalabra extends Model
{
    use HasFactory;
    protected $table = 'malas_palabras';
    protected $fillable = ['palabra'];
}
