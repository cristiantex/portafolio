<?php

namespace Tests\Feature;

use App\Models\Perfil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactoTest extends TestCase
{
    use RefreshDatabase;

    private function valido(array $extra = []): array
    {
        return array_merge(['nombre' => 'Luis', 'email' => 'luis@example.com', 'mensaje' => 'Hola, quiero conversar sobre un proyecto.'], $extra);
    }

    public function test_guarda_el_mensaje_y_confirma(): void
    {
        $this->post('/contacto', $this->valido())->assertRedirect(route('home').'#contacto')->assertSessionHas('contacto_ok');

        $this->assertDatabaseHas('mensajes', ['email' => 'luis@example.com', 'leido_at' => null]);
    }

    public function test_valida_los_campos(): void
    {
        $this->post('/contacto', ['nombre' => '', 'email' => 'no-es-correo', 'mensaje' => 'corto'])
            ->assertSessionHasErrors(['nombre', 'email', 'mensaje']);

        $this->assertDatabaseCount('mensajes', 0);
    }

    public function test_el_honeypot_descarta_bots(): void
    {
        $this->post('/contacto', $this->valido(['sitio_web' => 'http://spam.example']))->assertSessionHasErrors('sitio_web');

        $this->assertDatabaseCount('mensajes', 0);
    }

    public function test_limita_la_frecuencia_de_envios(): void
    {
        foreach (range(1, 3) as $i) {
            $this->post('/contacto', $this->valido())->assertSessionHasNoErrors();
        }

        $this->post('/contacto', $this->valido())->assertStatus(429);
        $this->assertDatabaseCount('mensajes', 3);
    }

    public function test_el_formulario_muestra_errores_accesibles(): void
    {
        Perfil::create(['alias' => 'Ana', 'nombre' => 'Ana Pérez']);

        $this->from('/')->followingRedirects()->post('/contacto', ['nombre' => '', 'email' => 'x', 'mensaje' => ''])
            ->assertSee('aria-invalid="true"', false)->assertSee('Revisa los campos marcados');
    }
}
