<?php

namespace App\Http\Controllers;

use App\Http\Requests\TecnologiaRequest;
use App\Models\Tecnologia;

class TecnologiaController extends Controller
{
    public function index()
    {
        return view('admin.tecnologias.index', [
            'tecnologias' => Tecnologia::orderBy('nombre')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.tecnologias.form', ['tecnologia' => new Tecnologia]);
    }

    public function store(TecnologiaRequest $request)
    {
        Tecnologia::create($request->validated());

        return redirect()->route('tecnologias.index')->with('success', 'Tecnología agregada correctamente.');
    }

    public function edit(Tecnologia $tecnologia)
    {
        return view('admin.tecnologias.form', compact('tecnologia'));
    }

    public function update(TecnologiaRequest $request, Tecnologia $tecnologia)
    {
        $tecnologia->update($request->validated());

        return redirect()->route('tecnologias.index')->with('success', 'Tecnología actualizada correctamente.');
    }

    public function destroy(Tecnologia $tecnologia)
    {
        $tecnologia->delete();

        return redirect()->route('tecnologias.index')->with('success', 'Tecnología eliminada correctamente.');
    }
}
