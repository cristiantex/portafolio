<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AccesoTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['portafolio.login' => ['user' => 'admin', 'pass' => 'clave-segura', 'pass_hash' => null]]);
    }

    public function test_las_rutas_del_mantenedor_exigen_sesion(): void
    {
        foreach (['/portafolio', '/perfil', '/proyectos', '/experiencias', '/tecnologias', '/formacion', '/mensajes'] as $ruta) {
            $this->get($ruta)->assertRedirect(route('login'));
        }
    }

    public function test_login_correcto_abre_el_mantenedor(): void
    {
        $this->post('/login', ['user' => 'admin', 'password' => 'clave-segura'])->assertRedirect(route('welcome'));

        $this->assertTrue(session('logged_in'));
    }

    public function test_login_incorrecto_no_da_pistas_de_cual_dato_fallo(): void
    {
        $this->from('/login')->post('/login', ['user' => 'admin', 'password' => 'otra'])
            ->assertRedirect('/login')->assertSessionHasErrors(['user' => 'Usuario o contraseña incorrectos.']);

        $this->assertNull(session('logged_in'));
    }

    public function test_sin_credenciales_configuradas_nadie_entra(): void
    {
        config(['portafolio.login' => ['user' => null, 'pass' => null, 'pass_hash' => null]]);

        $this->post('/login', ['user' => '', 'password' => ''])->assertSessionHasErrors('user');
        $this->post('/login', ['user' => 'x', 'password' => 'y'])->assertSessionHasErrors('user');
    }

    public function test_acepta_contrasena_con_hash_bcrypt(): void
    {
        config(['portafolio.login' => ['user' => 'admin', 'pass' => null, 'pass_hash' => Hash::make('con-hash')]]);

        $this->post('/login', ['user' => 'admin', 'password' => 'con-hash'])->assertRedirect(route('welcome'));
    }

    public function test_limita_los_intentos_de_login(): void
    {
        foreach (range(1, 5) as $i) {
            $this->post('/login', ['user' => 'admin', 'password' => 'mal']);
        }

        $this->post('/login', ['user' => 'admin', 'password' => 'clave-segura'])->assertStatus(429);
    }

    public function test_logout_cierra_la_sesion(): void
    {
        $this->withSession(['logged_in' => true])->post('/logout')->assertRedirect(route('login'));

        $this->get('/portafolio')->assertRedirect(route('login'));
    }
}
