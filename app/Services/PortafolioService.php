<?php

namespace App\Services;

use App\Models\Experiencia;
use App\Models\Formacion;
use App\Models\Perfil;
use App\Models\Proyecto;
use App\Models\Tecnologia;
use Illuminate\Support\Collection;

/**
 * Reúne y ordena los datos de la web pública.
 * El controlador solo delega aquí; las vistas no consultan modelos.
 */
class PortafolioService
{
    public function datos(): array
    {
        $perfil = Perfil::first();
        $experiencias = Experiencia::orderByDesc('fecha_inicio')->get();
        $proyectos = Proyecto::publicados()->latest()->get();
        $tecnologias = Tecnologia::orderByDesc('experiencia_anios')->orderBy('nombre')->get();

        return [
            'perfil' => $perfil,
            'experiencias' => $experiencias,
            'trayectoria' => $experiencias->sortBy('fecha_inicio')->values(),
            'proyectos' => $proyectos,
            'casos' => $proyectos->filter->es_caso->values(),
            'formaciones' => Formacion::orderByDesc('fecha_inicio')->get(),
            'tecnologias' => $this->agruparPorCategoria($tecnologias),
            'stackPrincipal' => $tecnologias->whereNotNull('experiencia_anios')->take(6)->pluck('nombre'),
            'desde' => $experiencias->min('fecha_inicio'),
            'anosExperiencia' => $this->anosDeExperiencia($experiencias),
        ];
    }

    /**
     * @return Collection<string, Collection<int, Tecnologia>> categoría => tecnologías, en el orden configurado
     */
    private function agruparPorCategoria(Collection $tecnologias): Collection
    {
        $orden = config('portafolio.categorias_tecnologia');
        $fallback = end($orden);

        return $tecnologias
            ->groupBy(fn (Tecnologia $t) => in_array($t->categoria, $orden, true) ? $t->categoria : $fallback)
            ->sortBy(fn ($grupo, $categoria) => array_search($categoria, $orden, true));
    }

    private function anosDeExperiencia(Collection $experiencias): ?int
    {
        $inicio = $experiencias->min('fecha_inicio');

        return $inicio ? (int) $inicio->diffInYears(now()) : null;
    }
}
