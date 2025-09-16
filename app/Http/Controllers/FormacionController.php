<?php

namespace App\Http\Controllers;

use App\Models\Formacion;
use Illuminate\Http\Request;

class FormacionController extends Controller
{
    public function index()
    {
        $formaciones = Formacion::orderBy('fecha_inicio', 'desc')->get();
        return view('formacion.index', compact('formaciones'));
    }

    public function create()
    {
        return view('formacion.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institucion'     => 'required|string|max:255',
            'titulo'          => 'required|string|max:255',
            'tipo'            => 'required|in:Carrera,Diplomado,Curso,Certificación,Otro',
            'fecha_inicio'    => 'required|date',
            'fecha_fin'       => 'nullable|date|after_or_equal:fecha_inicio',
            'certificado_url' => 'nullable|url',
        ]);

        Formacion::create($validated);

        return redirect()
            ->route('formacion.index')
            ->with('success', 'Formación agregada correctamente.');
    }

    public function edit(Formacion $formacion)
    {
        return view('formacion.edit', compact('formacion'));
    }

    public function update(Request $request, Formacion $formacion)
    {
        // Normaliza cadenas vacías a null (útil para campos nullable)
        $request->merge([
            'certificado_url' => $request->input('certificado_url') ?: null,
        ]);

        $validated = $request->validate([
            'institucion'     => 'required|string|max:255',
            'titulo'          => 'required|string|max:255',
            // Validación estricta contra los valores del ENUM en la BD
            'tipo'            => 'required|in:Carrera,Diplomado,Curso,Certificación,Otro',
            'fecha_inicio'    => 'required|date',
            'fecha_fin'       => 'nullable|date|after_or_equal:fecha_inicio',
            'certificado_url' => 'nullable|url',
        ]);

        $formacion->update($validated);

        return redirect()->route('formacion.index')->with('success', 'Formación actualizada correctamente.');
    }

    public function destroy(Formacion $formacion)
    {
        $formacion->delete();
        return redirect()->route('formacion.index')->with('success', 'Formación eliminada correctamente.');
    }
}
