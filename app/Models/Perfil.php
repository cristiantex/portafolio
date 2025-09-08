<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table = 'perfil';
    protected $fillable = [
        'alias',
        'nombre',
        'profesion',
        'descripcion',
        'email',
        'telefono',
        'linkedin',
        'github',
        'foto_perfil',
    ];
}
