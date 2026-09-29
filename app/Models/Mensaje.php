<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensajes';

    protected $fillable = ['nombre', 'email', 'mensaje', 'leido_at'];

    protected $casts = ['leido_at' => 'datetime'];

    public function getLeidoAttribute(): bool
    {
        return $this->leido_at !== null;
    }
}
