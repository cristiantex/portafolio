<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'experiencias';
    protected $fillable = [
        'empresa', 'cargo', 'fecha_inicio', 'fecha_fin',
        'descripcion', 'tecnologias', 'logros'
    ];
}