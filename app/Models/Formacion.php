<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacion extends Model
{
    protected $table = 'formacion';
    use HasFactory;
    protected $fillable = [
        'institucion', 'titulo', 'tipo',
        'fecha_inicio', 'fecha_fin', 'certificado_url'
    ];
}
