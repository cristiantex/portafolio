<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Models\Mensaje;

class ContactoController extends Controller
{
    public function store(ContactoRequest $request)
    {
        Mensaje::create($request->safe()->only(['nombre', 'email', 'mensaje']));

        return redirect(route('home').'#contacto')
            ->with('contacto_ok', 'Mensaje recibido. Responderé al correo que indicaste.');
    }
}
