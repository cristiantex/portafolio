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

    public function dashboard()
    {
        $perfil = Perfil::first();

        return view('welcome', [
            'alias'        => $perfil ? $perfil->alias : 'Administrador',
            'perfil'       => $perfil ?? null,       
            'tecnologias'  => Tecnologia::count(),
            'experiencias' => Experiencia::count(),
            'formacions'   => Formacion::count(),
            'proyectos'    => Proyecto::count(),
            'proyectosPendientes' => Proyecto::where('publicado', 0 )->count(),
        ]);
    }
}
