<?php

namespace App\Services;

use App\Models\Experiencia;
use App\Models\Formacion;
use App\Models\Mensaje;
use App\Models\Perfil;
use App\Models\Proyecto;
use App\Models\Tecnologia;
use App\Support\Lista;

/** Datos del panel de inicio del mantenedor. */
class ResumenAdmin
{
    public function datos(): array
    {
        $perfil = Perfil::first();

        return [
            'perfil' => $perfil,
            'conteos' => [
                'Experiencias' => Experiencia::count(),
                'Proyectos' => Proyecto::count(),
                'Tecnologías' => Tecnologia::count(),
                'Formación' => Formacion::count(),
            ],
            'publicados' => Proyecto::publicados()->count(),
            'pendientes' => Proyecto::where('publicado', false)->count(),
            'sinLeer' => Mensaje::whereNull('leido_at')->count(),
            'usoTecnologias' => $this->usoEnProyectos(),
            'pendientesDeContenido' => $this->pendientesDeContenido($perfil),
        ];
    }

    /** @return array<string,int> tecnología => cantidad de proyectos que la usan, de mayor a menor */
    private function usoEnProyectos(): array
    {
        $conteo = [];

        foreach (Proyecto::pluck('tecnologias') as $texto) {
            foreach (Lista::separar($texto) as $tecnologia) {
                $conteo[$tecnologia] = ($conteo[$tecnologia] ?? 0) + 1;
            }
        }

        arsort($conteo);

        return array_slice($conteo, 0, 10, true);
    }

    /**
     * Qué secciones de la web pública están vacías o incompletas.
     *
     * @return list<array{texto:string,ruta:string}>
     */
    private function pendientesDeContenido(?Perfil $perfil): array
    {
        $pendientes = [];

        if (! $perfil) {
            return [['texto' => 'Crear el perfil: sin él la web pública no puede mostrarse.', 'ruta' => 'perfil.edit']];
        }

        foreach ([
            'titular' => 'Escribir el titular del perfil (frase corta del inicio).',
            'enfoque' => 'Indicar qué problemas resuelves (sección Perfil).',
            'cv' => 'Subir el CV en PDF para habilitar el botón de descarga.',
        ] as $campo => $texto) {
            if (blank($perfil->{$campo})) {
                $pendientes[] = ['texto' => $texto, 'ruta' => 'perfil.edit'];
            }
        }

        $sinCategoria = Tecnologia::whereNull('categoria')->count();
        if ($sinCategoria > 0) {
            $pendientes[] = ['texto' => "{$sinCategoria} tecnología(s) sin categoría.", 'ruta' => 'tecnologias.index'];
        }

        $sinHistoria = Experiencia::whereNull('contexto')->whereNull('problema')->whereNull('solucion')->count();
        if ($sinHistoria > 0) {
            $pendientes[] = ['texto' => "{$sinHistoria} experiencia(s) sin contexto, problema o solución.", 'ruta' => 'experiencias.index'];
        }

        $sinCaso = Proyecto::publicados()->get()->reject->es_caso->count();
        if ($sinCaso > 0) {
            $pendientes[] = ['texto' => "{$sinCaso} proyecto(s) publicado(s) sin caso técnico.", 'ruta' => 'proyectos.index'];
        }

        return $pendientes;
    }
}
