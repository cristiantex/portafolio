<?php

namespace App\Models;

use App\Support\Lista;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'experiencias';

    protected $fillable = [
        'empresa', 'cargo', 'fecha_inicio', 'fecha_fin',
        'descripcion', 'contexto', 'problema', 'solucion', 'tecnologias', 'logros',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    protected function tecnologiasLista(): Attribute
    {
        return Attribute::get(fn () => Lista::separar($this->tecnologias));
    }

    protected function resultados(): Attribute
    {
        return Attribute::get(fn () => Lista::separar($this->logros, ';'));
    }

    /** Tiene el detalle mínimo para contarse como caso (contexto, problema o solución). */
    protected function esCaso(): Attribute
    {
        return Attribute::get(fn () => filled($this->contexto) || filled($this->problema) || filled($this->solucion));
    }

    /** "5 años 3 meses": duración calculada con las fechas; no se guarda. */
    protected function duracion(): Attribute
    {
        return Attribute::get(function () {
            $meses = (int) $this->fecha_inicio->diffInMonths($this->fecha_fin ?? now());
            $anios = intdiv($meses, 12);
            $resto = $meses % 12;

            return collect([
                $anios ? $anios.($anios === 1 ? ' año' : ' años') : null,
                $resto ? $resto.($resto === 1 ? ' mes' : ' meses') : null,
            ])->filter()->implode(' ') ?: 'menos de 1 mes';
        });
    }

    protected function esActual(): Attribute
    {
        return Attribute::get(fn () => $this->fecha_fin === null);
    }
}
