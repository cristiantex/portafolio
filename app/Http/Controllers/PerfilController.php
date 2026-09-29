<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilRequest;
use App\Models\Perfil;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PerfilController extends Controller
{
    public function edit()
    {
        return view('admin.perfil', ['perfil' => Perfil::first() ?? new Perfil]);
    }

    public function update(PerfilRequest $request)
    {
        $perfil = Perfil::first() ?? new Perfil;
        $datos = $request->safe()->except(['foto_perfil', 'cv']);

        $perfil->fill($datos);

        if ($request->hasFile('foto_perfil')) {
            $this->borrarArchivo($perfil->foto_perfil);
            $perfil->foto_perfil = $request->file('foto_perfil')->store('perfil', 'public');
        }

        if ($request->hasFile('cv')) {
            $this->borrarArchivo($perfil->cv);
            $perfil->cv = $request->file('cv')->store('perfil', 'public');
        }

        $perfil->save();

        return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado correctamente.');
    }

    /** Solo borra archivos propios (no las URL externas de datos antiguos). */
    private function borrarArchivo(?string $ruta): void
    {
        if (blank($ruta) || Str::startsWith($ruta, ['http://', 'https://', 'data:'])) {
            return;
        }

        Storage::disk('public')->delete($ruta);
    }
}
