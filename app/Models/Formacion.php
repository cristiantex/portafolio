<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacion extends Model
{
    use HasFactory;
    protected $table = 'formacion';
    protected $fillable = [
        'institucion', 'titulo', 'tipo',
        'fecha_inicio', 'fecha_fin', 'certificado_url'
    ];
}
