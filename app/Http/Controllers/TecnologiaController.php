<?php

namespace App\Http\Controllers;

use App\Models\Tecnologia;
use Illuminate\Http\Request;

class TecnologiaController extends Controller
{
    public function index()
    {
        $tecnologias = Tecnologia::orderBy('nombre')->get();
        return view('tecnologias.index', compact('tecnologias'));
    }

    public function create()
    {
        return view('tecnologias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'            => 'required|string|max:255',
            'nivel'             => 'required|in:Básico,Intermedio,Avanzado,Experto',
            'experiencia_anios' => 'nullable|integer|min:0',
            'descripcion'       => 'nullable|string|max:1000',
        ]);

        Tecnologia::create($validated);

        return redirect()
            ->route('tecnologias.index')
            ->with('success', 'Tecnología agregada correctamente.');
    }

    public function edit(Tecnologia $tecnologia)
    {
        return view('tecnologias.edit', compact('tecnologia'));
    }

    public function update(Request $request, Tecnologia $tecnologia)
    {
        // Normaliza cadenas vacías a null
        $request->merge([
            'descripcion' => $request->input('descripcion') ?: null,
        ]);

        $validated = $request->validate([
            'nombre'            => 'required|string|max:255',
            'nivel'             => 'required|in:Básico,Intermedio,Avanzado,Experto',
            'experiencia_anios' => 'nullable|integer|min:0',
            'descripcion'       => 'nullable|string|max:1000',
        ]);

        $tecnologia->update($validated);

        return redirect()->route('tecnologias.index')->with('success', 'Tecnología actualizada correctamente.');
    }

    public function destroy(Tecnologia $tecnologia)
    {
        $tecnologia->delete();
        return redirect()->route('tecnologias.index')->with('success', 'Tecnología eliminada correctamente.');
    }
}
