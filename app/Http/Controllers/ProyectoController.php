<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::orderBy('titulo')->get();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('proyectos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string|max:2000',
            'url'          => 'nullable|url|max:500',
            'imagen'       => 'nullable|image|max:2048', // max 2MB
            'tecnologias'  => 'nullable|string|max:1000',
            'publicado'    => 'nullable|boolean',
        ]);

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('proyectos', 'public');
            $validated['imagen'] = 'storage/' . $path;
        }

        // Checkbox 'publicado' por defecto a 0 si no viene
        $validated['publicado'] = $request->has('publicado') ? 1 : 0;

        Proyecto::create($validated);

        return redirect()
            ->route('proyectos.index')
            ->with('success', 'Proyecto agregado correctamente.');
    }

    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $validated = $request->validate([
            'titulo'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string|max:2000',
            'url'          => 'nullable|url|max:500',
            'imagen'       => 'nullable|image|max:2048',
            'tecnologias'  => 'nullable|string|max:1000',
            'publicado'    => 'nullable|boolean',
        ]);

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            // Elimina imagen anterior si existe
            if ($proyecto->imagen && Storage::disk('public')->exists(str_replace('storage/', '', $proyecto->imagen))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $proyecto->imagen));
            }

            $path = $request->file('imagen')->store('proyectos', 'public');
            $validated['imagen'] = 'storage/' . $path;
        }

        // Checkbox 'publicado' por defecto a 0 si no viene
        $validated['publicado'] = $request->has('publicado') ? 1 : 0;

        $proyecto->update($validated);

        return redirect()
            ->route('proyectos.index')
            ->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(Proyecto $proyecto)
    {
        // Eliminar imagen si existe
        if ($proyecto->imagen && Storage::disk('public')->exists(str_replace('storage/', '', $proyecto->imagen))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $proyecto->imagen));
        }

        $proyecto->delete();

        return redirect()
            ->route('proyectos.index')
            ->with('success', 'Proyecto eliminado correctamente.');
    }
}