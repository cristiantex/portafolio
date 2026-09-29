<?php

namespace App\Models;

use App\Support\Lista;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfil';

    protected $fillable = [
        'alias', 'nombre', 'profesion', 'titular', 'descripcion', 'enfoque', 'rumbo', 'ubicacion',
        'email', 'telefono', 'linkedin', 'github', 'foto_perfil', 'cv',
    ];

    /** Problemas que resuelve, uno por elemento. */
    protected function enfoqueLista(): Attribute
    {
        return Attribute::get(fn () => Lista::separar($this->enfoque, ';'));
    }

    /** Frase corta del hero: el titular editado o, si falta, la primera oración de la descripción. */
    protected function resumen(): Attribute
    {
        return Attribute::get(function () {
            if (filled($this->titular)) {
                return $this->titular;
            }

            return filled($this->descripcion)
                ? Str::of($this->descripcion)->before('. ')->finish('.')->limit(220)->toString()
                : null;
        });
    }

    /** La foto puede ser una URL externa (datos antiguos) o una ruta en el disco público. */
    protected function fotoUrl(): Attribute
    {
        return Attribute::get(function () {
            if (blank($this->foto_perfil)) {
                return null;
            }

            return Str::startsWith($this->foto_perfil, ['http://', 'https://', 'data:'])
                ? $this->foto_perfil
                : asset('storage/'.ltrim(Str::after($this->foto_perfil, 'storage/'), '/'));
        });
    }

    protected function cvUrl(): Attribute
    {
        return Attribute::get(fn () => filled($this->cv) ? asset('storage/'.$this->cv) : null);
    }

    /** Número de teléfono solo con dígitos, para enlaces wa.me / tel. */
    protected function telefonoDigitos(): Attribute
    {
        return Attribute::get(fn () => preg_replace('/\D/', '', (string) $this->telefono));
    }
}
