<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;

class MensajeController extends Controller
{
    public function index()
    {
        return view('admin.mensajes.index', [
            'mensajes' => Mensaje::latest()->get(),
        ]);
    }

    public function toggleLeido(Mensaje $mensaje)
    {
        $mensaje->update(['leido_at' => $mensaje->leido ? null : now()]);

        return back();
    }

    public function destroy(Mensaje $mensaje)
    {
        $mensaje->delete();

        return redirect()->route('mensajes.index')->with('success', 'Mensaje eliminado correctamente.');
    }
}
