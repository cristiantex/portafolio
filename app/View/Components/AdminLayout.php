<?php

namespace App\View\Components;

use App\Models\Mensaje;
use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    public function __construct(public string $titulo, public string $activo = '') {}

    public function render(): View
    {
        return view('layouts.admin', [
            'sinLeer' => Mensaje::whereNull('leido_at')->count(),
            'nav' => [
                'welcome' => ['Resumen', 'home'],
                'perfil.edit' => ['Perfil', 'user'],
                'experiencias.index' => ['Experiencias', 'briefcase'],
                'proyectos.index' => ['Proyectos', 'layers'],
                'tecnologias.index' => ['Tecnologías', 'code'],
                'formacion.index' => ['Formación', 'book'],
                'mensajes.index' => ['Mensajes', 'inbox'],
            ],
        ]);
    }
}
