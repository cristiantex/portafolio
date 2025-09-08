<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    protected $table = 'experiencias';
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'empresa', 'cargo', 'fecha_inicio', 'fecha_fin',
        'descripcion', 'tecnologias', 'logros'
    ];

    protected $casts = [
        'tecnologias' => 'array',
    ];
}
