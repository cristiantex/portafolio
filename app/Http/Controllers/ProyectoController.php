<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProyectoRequest;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProyectoController extends Controller
{
    public function index()
    {
        return view('admin.proyectos.index', [
            'proyectos' => Proyecto::orderBy('titulo')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.proyectos.form', ['proyecto' => new Proyecto(['publicado' => true])]);
    }

    public function store(ProyectoRequest $request)
    {
        $datos = $request->safe()->except('imagen');
        $datos['publicado'] = $request->boolean('publicado');

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = 'storage/'.$request->file('imagen')->store('proyectos', 'public');
        }

        Proyecto::create($datos);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto agregado correctamente.');
    }

    public function edit(Proyecto $proyecto)
    {
        return view('admin.proyectos.form', compact('proyecto'));
    }

    public function update(ProyectoRequest $request, Proyecto $proyecto)
    {
        $datos = $request->safe()->except('imagen');
        $datos['publicado'] = $request->boolean('publicado');

        if ($request->hasFile('imagen')) {
            $this->borrarImagen($proyecto);
            $datos['imagen'] = 'storage/'.$request->file('imagen')->store('proyectos', 'public');
        }

        $proyecto->update($datos);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(Proyecto $proyecto)
    {
        $this->borrarImagen($proyecto);
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente.');
    }

    private function borrarImagen(Proyecto $proyecto): void
    {
        if (filled($proyecto->imagen)) {
            Storage::disk('public')->delete(Str::after($proyecto->imagen, 'storage/'));
        }
    }
}
