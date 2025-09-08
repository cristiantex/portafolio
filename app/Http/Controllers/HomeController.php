<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Tecnologia;
use App\Models\Experiencia;
use App\Models\Formacion;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Mostrar el portafolio completo
     */
    public function index()
    {
        return view('home', [
            'perfils'      => Perfil::all(),
            'tecnologias'  => Tecnologia::all(),
            'experiencias' => Experiencia::orderBy('fecha_inicio', 'desc')->get(),
            'formacions'   => Formacion::orderBy('fecha_inicio', 'desc')->get(),
            'proyectos'    => Proyecto::latest()->get(),
        ]);
    }
}
