<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienciaRequest;
use App\Models\Experiencia;

class ExperienciaController extends Controller
{
    public function index()
    {
        return view('admin.experiencias.index', [
            'experiencias' => Experiencia::orderByDesc('fecha_inicio')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.experiencias.form', ['experiencia' => new Experiencia]);
    }

    public function store(ExperienciaRequest $request)
    {
        Experiencia::create($request->validated());

        return redirect()->route('experiencias.index')->with('success', 'Experiencia agregada correctamente.');
    }

    public function edit(Experiencia $experiencia)
    {
        return view('admin.experiencias.form', compact('experiencia'));
    }

    public function update(ExperienciaRequest $request, Experiencia $experiencia)
    {
        $experiencia->update($request->validated());

        return redirect()->route('experiencias.index')->with('success', 'Experiencia actualizada correctamente.');
    }

    public function destroy(Experiencia $experiencia)
    {
        $experiencia->delete();

        return redirect()->route('experiencias.index')->with('success', 'Experiencia eliminada correctamente.');
    }
}
