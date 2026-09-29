<?php

namespace App\Models;

use App\Support\Lista;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'titulo', 'descripcion', 'url', 'repositorio_url', 'imagen', 'tecnologias', 'publicado',
        'problema', 'construccion', 'arquitectura', 'flujo', 'decisiones', 'desafios', 'resultado',
    ];

    protected $casts = ['publicado' => 'boolean'];

    /** Solo lo que debe verse en la web pública. */
    public function scopePublicados(Builder $query): Builder
    {
        return $query->where('publicado', true);
    }

    protected function tecnologiasLista(): Attribute
    {
        return Attribute::get(fn () => Lista::separar($this->tecnologias));
    }

    protected function decisionesLista(): Attribute
    {
        return Attribute::get(fn () => Lista::separar($this->decisiones, ';'));
    }

    /** Pasos del diagrama de flujo: "Frontend > API > Base de datos". */
    protected function pasosFlujo(): Attribute
    {
        return Attribute::get(fn () => Lista::separar($this->flujo, '>'));
    }

    protected function imagenUrl(): Attribute
    {
        return Attribute::get(fn () => filled($this->imagen) ? asset($this->imagen) : null);
    }

    /** Un proyecto es "caso técnico" cuando tiene algo más que la descripción corta. */
    protected function esCaso(): Attribute
    {
        return Attribute::get(fn () => collect(['problema', 'construccion', 'arquitectura', 'flujo', 'decisiones', 'desafios', 'resultado'])
            ->contains(fn (string $campo) => filled($this->{$campo})));
    }
}
