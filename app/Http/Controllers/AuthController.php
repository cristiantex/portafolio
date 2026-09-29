<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credenciales = $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        if (! $this->credencialesValidas($credenciales['user'], $credenciales['password'])) {
            return back()
                ->withInput($request->only('user'))
                ->withErrors(['user' => 'Usuario o contraseña incorrectos.']);
        }

        $request->session()->regenerate();
        $request->session()->put('logged_in', true);

        return redirect()->intended(route('welcome'));
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function credencialesValidas(string $usuario, string $clave): bool
    {
        $config = config('portafolio.login');

        // Sin credenciales configuradas nadie entra: falla cerrado.
        if (blank($config['user']) || (blank($config['pass']) && blank($config['pass_hash']))) {
            return false;
        }

        $usuarioOk = hash_equals((string) $config['user'], $usuario);
        $claveOk = filled($config['pass_hash'])
            ? Hash::check($clave, $config['pass_hash'])
            : hash_equals((string) $config['pass'], $clave);

        return $usuarioOk && $claveOk;
    }
}
