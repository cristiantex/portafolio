<?php

namespace App\Http\Controllers;

use App\Services\PortafolioService;

class HomeController extends Controller
{
    public function index(PortafolioService $portafolio)
    {
        $datos = $portafolio->datos();

        if (! $datos['perfil']) {
            return response()->view('site.sin-perfil', [], 503);
        }

        return view('site.home', $datos);
    }
}
