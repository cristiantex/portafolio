<?php

namespace Tests\Feature;

use App\Models\Experiencia;
use App\Models\Formacion;
use App\Models\Perfil;
use App\Models\Proyecto;
use App\Models\Tecnologia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitioPublicoTest extends TestCase
{
    use RefreshDatabase;

    private function perfil(array $extra = []): Perfil
    {
        return Perfil::create(array_merge([
            'alias' => 'Ana', 'nombre' => 'Ana Pérez', 'profesion' => 'Ingeniera de Software',
            'descripcion' => 'Desarrollo sistemas. Trabajo con Java.',
        ], $extra));
    }

    public function test_sin_perfil_el_sitio_avisa_en_vez_de_fallar(): void
    {
        $this->get('/')->assertStatus(503)->assertSee('Sitio en configuración');
    }

    public function test_muestra_solo_proyectos_publicados(): void
    {
        $this->perfil();
        Proyecto::create(['titulo' => 'Visible', 'publicado' => true]);
        Proyecto::create(['titulo' => 'Borrador secreto', 'publicado' => false]);

        $this->get('/')->assertOk()->assertSee('Visible')->assertDontSee('Borrador secreto');
    }

    public function test_las_secciones_sin_datos_no_se_dibujan(): void
    {
        $this->perfil();

        $this->get('/')->assertOk()
            ->assertDontSee('id="experiencia"', false)
            ->assertDontSee('id="proyectos"', false)
            ->assertDontSee('id="tecnologias"', false)
            ->assertSee('id="perfil"', false)
            ->assertSee('id="contacto"', false);
    }

    public function test_el_boton_de_cv_solo_aparece_si_hay_cv(): void
    {
        $this->perfil();
        $this->get('/')->assertDontSee('Descargar CV');

        Perfil::first()->update(['cv' => 'perfil/cv.pdf']);
        $this->get('/')->assertSee('Descargar CV')->assertSee('storage/perfil/cv.pdf', false);
    }

    public function test_la_experiencia_se_cuenta_como_contexto_problema_solucion(): void
    {
        $this->perfil();
        Experiencia::create([
            'empresa' => 'Acme', 'cargo' => 'Ingeniero', 'fecha_inicio' => '2020-01-01',
            'contexto' => 'Sistema legacy', 'problema' => 'Sin pruebas', 'solucion' => 'Migración gradual',
            'logros' => 'Menos incidentes; Despliegues más simples', 'tecnologias' => 'Java, MySQL',
        ]);

        $this->get('/')->assertOk()
            ->assertSee('Contexto')->assertSee('Sistema legacy')
            ->assertSee('Problema')->assertSee('Solución')->assertSee('Migración gradual')
            ->assertSee('Menos incidentes')->assertSee('Despliegues más simples');
    }

    public function test_un_proyecto_con_caso_tecnico_muestra_diagrama_y_decisiones(): void
    {
        $this->perfil();
        Proyecto::create([
            'titulo' => 'API de pedidos', 'publicado' => true,
            'problema' => 'Pedidos duplicados', 'flujo' => 'Frontend > API > Servicio > Base de datos',
            'decisiones' => 'Idempotencia por clave; Colas para tareas lentas',
        ]);

        $this->get('/')->assertOk()
            ->assertSee('Casos técnicos')
            ->assertSee('Servicio')->assertSee('aria-label="Flujo: Frontend → API → Servicio → Base de datos"', false)
            ->assertSee('Idempotencia por clave')->assertSee('Colas para tareas lentas');
    }

    public function test_las_tecnologias_se_agrupan_por_categoria_y_sin_categoria_van_a_otras(): void
    {
        $this->perfil();
        Tecnologia::create(['nombre' => 'MySQL', 'categoria' => 'Bases de datos', 'nivel' => 'Avanzado', 'experiencia_anios' => 5]);
        Tecnologia::create(['nombre' => 'Vim', 'categoria' => null, 'nivel' => 'Básico']);

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString('Bases de datos', $html);
        $this->assertStringContainsString('5 años', $html);
        $this->assertStringContainsString('Otras', $html);
        $this->assertLessThan(strpos($html, 'Otras'), strpos($html, 'Bases de datos'), 'Respeta el orden configurado');
    }

    public function test_incluye_metadatos_para_compartir(): void
    {
        $this->perfil(['titular' => 'Sistemas empresariales y modernización.']);

        $this->get('/')->assertOk()
            ->assertSee('<title>Ana Pérez — Ingeniera de Software</title>', false)
            ->assertSee('name="description" content="Sistemas empresariales y modernización."', false)
            ->assertSee('property="og:title"', false)
            ->assertSee('application/ld+json', false)
            ->assertSee('rel="canonical"', false);
    }

    public function test_la_formacion_y_las_fechas_se_formatean(): void
    {
        $this->perfil();
        Formacion::create(['institucion' => 'U. de Chile', 'titulo' => 'Ingeniería', 'tipo' => 'Carrera', 'fecha_inicio' => '2010-03-01', 'fecha_fin' => '2014-12-01']);

        $this->get('/')->assertOk()->assertSee('2010 – 2014')->assertDontSee('00:00:00');
    }

    public function test_escapa_el_contenido_para_evitar_xss(): void
    {
        $this->perfil(['descripcion' => '<script>alert(1)</script>']);

        $this->get('/')->assertOk()->assertDontSee('<script>alert(1)</script>', false);
    }
}
