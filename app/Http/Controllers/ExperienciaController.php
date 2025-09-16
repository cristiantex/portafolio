<?php

namespace App\Http\Controllers;

use App\Models\Experiencia;
use Illuminate\Http\Request;

class ExperienciaController extends Controller
{
    public function index()
    {
        $experiencias = Experiencia::orderBy('fecha_inicio', 'desc')->get();
        return view('experiencias.index', compact('experiencias'));
    }

    public function create()
    {
        return view('experiencias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empresa'      => 'required|string|max:255',
            'cargo'        => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'nullable|date|after_or_equal:fecha_inicio',
            'descripcion'  => 'nullable|string|max:2000',
            'tecnologias'  => 'nullable|string',
            'logros'       => 'nullable|string|max:2000',
        ]);

        Experiencia::create($validated);

        return redirect()
            ->route('experiencias.index')
            ->with('success', 'Experiencia agregada correctamente.');
    }

    public function edit(Experiencia $experiencia)
    {
        return view('experiencias.edit', compact('experiencia'));
    }

    public function update(Request $request, Experiencia $experiencia)
    {
        $request->merge([
            'descripcion' => $request->input('descripcion') ?: null,
            'logros'      => $request->input('logros') ?: null,
        ]);

        $validated = $request->validate([
            'empresa'      => 'required|string|max:255',
            'cargo'        => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'nullable|date|after_or_equal:fecha_inicio',
            'descripcion'  => 'nullable|string|max:2000',
            'tecnologias'  => 'nullable|string',
            'logros'       => 'nullable|string|max:2000',
        ]);

        $experiencia->update($validated);

        return redirect()
            ->route('experiencias.index')
            ->with('success', 'Experiencia actualizada correctamente.');
    }

    public function destroy(Experiencia $experiencia)
    {
        $experiencia->delete();
        return redirect()->route('experiencias.index')->with('success', 'Experiencia eliminada correctamente.');
    }
}