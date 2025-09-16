<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Mostrar el formulario de edición de perfil
     */
    public function edit()
    {
        // Solo necesitas un registro (ejemplo: id=1 para un solo usuario)
        $perfil = Perfil::first();

        return view('perfil', compact('perfil'));
    }

    /**
     * Actualizar los datos del perfil
     */
    public function update(Request $request)
    {
        $perfil = Perfil::first();

        // Validación de campos obligatorios
        $validated = $request->validate([
            'alias'       => 'required|string|max:50',
            'nombre'      => 'required|string|max:100',
            'profesion'   => 'nullable|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'email'       => 'nullable|email|max:150',
            'telefono'    => 'nullable|string|max:20',
            'linkedin'    => 'nullable|string|max:150',
            'github'      => 'nullable|string|max:150',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if (!$perfil) {
            $perfil = new Perfil();
        }

        $perfil->fill($validated);

        // Subida de foto
        if ($request->hasFile('foto_perfil')) {
            if ($perfil->foto_perfil && Storage::exists('public/'.$perfil->foto_perfil)) {
                Storage::delete('public/'.$perfil->foto_perfil);
            }
            $path = $request->file('foto_perfil')->store('perfil', 'public');
            $perfil->foto_perfil = $path;
        }

        $perfil->save();

        return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado correctamente.');
    }

}
