<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormacionRequest;
use App\Models\Formacion;

class FormacionController extends Controller
{
    public function index()
    {
        return view('admin.formacion.index', [
            'formaciones' => Formacion::orderByDesc('fecha_inicio')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.formacion.form', ['formacion' => new Formacion]);
    }

    public function store(FormacionRequest $request)
    {
        Formacion::create($request->validated());

        return redirect()->route('formacion.index')->with('success', 'Formación agregada correctamente.');
    }

    public function edit(Formacion $formacion)
    {
        return view('admin.formacion.form', compact('formacion'));
    }

    public function update(FormacionRequest $request, Formacion $formacion)
    {
        $formacion->update($request->validated());

        return redirect()->route('formacion.index')->with('success', 'Formación actualizada correctamente.');
    }

    public function destroy(Formacion $formacion)
    {
        $formacion->delete();

        return redirect()->route('formacion.index')->with('success', 'Formación eliminada correctamente.');
    }
}
