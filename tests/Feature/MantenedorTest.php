<?php

namespace Tests\Feature;

use App\Models\Experiencia;
use App\Models\Formacion;
use App\Models\Mensaje;
use App\Models\Perfil;
use App\Models\Proyecto;
use App\Models\Tecnologia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MantenedorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withSession(['logged_in' => true]);
    }

    public function test_el_resumen_lista_lo_que_falta_completar(): void
    {
        Perfil::create(['alias' => 'Ana', 'nombre' => 'Ana']);
        Tecnologia::create(['nombre' => 'PHP', 'nivel' => 'Avanzado']);
        Proyecto::create(['titulo' => 'Sin caso', 'publicado' => true]);

        $this->get('/portafolio')->assertOk()
            ->assertSee('Contenido por completar')
            ->assertSee('tecnología(s) sin categoría')
            ->assertSee('proyecto(s) publicado(s) sin caso técnico')
            ->assertSee('Subir el CV');
    }

    public function test_todas_las_pantallas_renderizan(): void
    {
        $perfil = Perfil::create(['alias' => 'Ana', 'nombre' => 'Ana']);
        $exp = Experiencia::create(['empresa' => 'A', 'cargo' => 'B', 'fecha_inicio' => '2020-01-01']);
        $for = Formacion::create(['institucion' => 'U', 'titulo' => 'T', 'tipo' => 'Curso', 'fecha_inicio' => '2020-01-01']);
        $tec = Tecnologia::create(['nombre' => 'PHP', 'nivel' => 'Avanzado']);
        $pro = Proyecto::create(['titulo' => 'P', 'publicado' => true]);
        Mensaje::create(['nombre' => 'L', 'email' => 'l@example.com', 'mensaje' => 'Hola mundo, esto es un mensaje.']);

        foreach ([
            '/portafolio', '/perfil', '/mensajes',
            '/experiencias', '/experiencias/create', "/experiencias/{$exp->id}/edit",
            '/formacion', '/formacion/create', "/formacion/{$for->id}/edit",
            '/tecnologias', '/tecnologias/create', "/tecnologias/{$tec->id}/edit",
            '/proyectos', '/proyectos/create', "/proyectos/{$pro->id}/edit",
        ] as $ruta) {
            $this->get($ruta)->assertOk();
        }
    }

    public function test_crear_y_editar_perfil_con_archivos(): void
    {
        Storage::fake('public');

        $this->post('/perfil', [
            'alias' => 'Ana', 'nombre' => 'Ana Pérez', 'titular' => 'Sistemas empresariales',
            'linkedin' => 'https://linkedin.com/in/ana',
            'foto_perfil' => UploadedFile::fake()->image('yo.jpg'),
            'cv' => UploadedFile::fake()->create('cv.pdf', 200, 'application/pdf'),
        ])->assertRedirect(route('perfil.edit'))->assertSessionHas('success');

        $perfil = Perfil::first();
        Storage::disk('public')->assertExists([$perfil->foto_perfil, $perfil->cv]);
        $this->assertStringEndsWith($perfil->cv, $perfil->cv_url);

        $anterior = $perfil->cv;
        $this->post('/perfil', ['alias' => 'Ana', 'nombre' => 'Ana', 'cv' => UploadedFile::fake()->create('nuevo.pdf', 100, 'application/pdf')]);
        Storage::disk('public')->assertMissing($anterior);
        $this->assertSame(1, Perfil::count());
    }

    public function test_el_perfil_rechaza_urls_y_archivos_invalidos(): void
    {
        $this->post('/perfil', [
            'alias' => 'Ana', 'nombre' => 'Ana', 'github' => 'no-es-url',
            'cv' => UploadedFile::fake()->create('cv.exe', 10, 'application/octet-stream'),
        ])->assertSessionHasErrors(['github', 'cv']);
    }

    public function test_la_foto_antigua_con_url_externa_se_conserva_al_subir_otra(): void
    {
        Storage::fake('public');
        Perfil::create(['alias' => 'Ana', 'nombre' => 'Ana', 'foto_perfil' => 'https://cdn.example.com/a.png']);

        $this->post('/perfil', ['alias' => 'Ana', 'nombre' => 'Ana', 'foto_perfil' => UploadedFile::fake()->image('n.png')])->assertSessionHasNoErrors();

        $this->assertStringStartsWith('perfil/', Perfil::first()->foto_perfil);
    }

    public function test_crud_de_experiencias(): void
    {
        $datos = ['empresa' => 'Acme', 'cargo' => 'Ingeniero', 'fecha_inicio' => '2020-01-01', 'contexto' => 'Legacy'];

        $this->post('/experiencias', $datos)->assertRedirect(route('experiencias.index'));
        $exp = Experiencia::firstOrFail();
        $this->assertSame('Legacy', $exp->contexto);

        $this->put("/experiencias/{$exp->id}", array_merge($datos, ['cargo' => 'Líder', 'fecha_fin' => '2021-01-01']))->assertRedirect();
        $this->assertSame('Líder', $exp->fresh()->cargo);

        $this->delete("/experiencias/{$exp->id}")->assertRedirect(route('experiencias.index'));
        $this->assertDatabaseCount('experiencias', 0);
    }

    public function test_experiencia_valida_fechas_y_largo_de_tecnologias(): void
    {
        $this->post('/experiencias', ['empresa' => 'A', 'cargo' => 'B', 'fecha_inicio' => '2021-01-01', 'fecha_fin' => '2020-01-01', 'tecnologias' => str_repeat('x', 300)])
            ->assertSessionHasErrors(['fecha_fin', 'tecnologias']);
    }

    public function test_crud_de_tecnologias_con_categoria(): void
    {
        $this->post('/tecnologias', ['nombre' => 'Java', 'categoria' => 'Backend', 'nivel' => 'Avanzado', 'experiencia_anios' => 6])->assertRedirect(route('tecnologias.index'));
        $this->assertDatabaseHas('tecnologias', ['nombre' => 'Java', 'categoria' => 'Backend']);

        $this->post('/tecnologias', ['nombre' => 'X', 'categoria' => 'Inventada', 'nivel' => 'Genio'])->assertSessionHasErrors(['categoria', 'nivel']);

        $this->delete('/tecnologias/'.Tecnologia::first()->id)->assertRedirect();
        $this->assertDatabaseCount('tecnologias', 0);
    }

    public function test_crud_de_formacion(): void
    {
        $this->post('/formacion', ['institucion' => 'U', 'titulo' => 'Ing', 'tipo' => 'Carrera', 'fecha_inicio' => '2010-03-01'])->assertRedirect(route('formacion.index'));
        $f = Formacion::firstOrFail();

        $this->put("/formacion/{$f->id}", ['institucion' => 'U2', 'titulo' => 'Ing', 'tipo' => 'Curso', 'fecha_inicio' => '2010-03-01'])->assertRedirect();
        $this->assertSame('U2', $f->fresh()->institucion);

        $this->post('/formacion', ['institucion' => 'U', 'titulo' => 'T', 'tipo' => 'Otra cosa', 'fecha_inicio' => '2010-03-01'])->assertSessionHasErrors('tipo');

        $this->delete("/formacion/{$f->id}")->assertRedirect();
        $this->assertDatabaseCount('formacion', 0);
    }

    public function test_proyectos_guardan_caso_tecnico_publicacion_e_imagen(): void
    {
        Storage::fake('public');

        $this->post('/proyectos', [
            'titulo' => 'API', 'publicado' => '1', 'flujo' => 'A > B > C', 'decisiones' => 'Una; Dos',
            'repositorio_url' => 'https://github.com/x/y', 'imagen' => UploadedFile::fake()->image('p.png'),
        ])->assertRedirect(route('proyectos.index'));

        $p = Proyecto::firstOrFail();
        $this->assertTrue($p->publicado);
        $this->assertSame(['A', 'B', 'C'], $p->pasos_flujo);
        $this->assertSame(['Una', 'Dos'], $p->decisiones_lista);
        $this->assertTrue($p->es_caso);
        Storage::disk('public')->assertExists(str_replace('storage/', '', $p->imagen));

        // Sin el checkbox el proyecto pasa a borrador.
        $this->put("/proyectos/{$p->id}", ['titulo' => 'API'])->assertRedirect();
        $this->assertFalse($p->fresh()->publicado);

        $imagen = str_replace('storage/', '', $p->imagen);
        $this->delete("/proyectos/{$p->id}")->assertRedirect();
        Storage::disk('public')->assertMissing($imagen);
    }

    public function test_proyecto_limita_tecnologias_al_largo_de_la_columna(): void
    {
        $this->post('/proyectos', ['titulo' => 'X', 'tecnologias' => str_repeat('a', 256)])->assertSessionHasErrors('tecnologias');
    }

    public function test_mensajes_se_marcan_y_eliminan(): void
    {
        $m = Mensaje::create(['nombre' => 'L', 'email' => 'l@example.com', 'mensaje' => 'Mensaje de prueba largo.']);

        $this->patch("/mensajes/{$m->id}/leido")->assertRedirect();
        $this->assertTrue($m->fresh()->leido);

        $this->patch("/mensajes/{$m->id}/leido");
        $this->assertFalse($m->fresh()->leido);

        $this->delete("/mensajes/{$m->id}")->assertRedirect(route('mensajes.index'));
        $this->assertDatabaseCount('mensajes', 0);
    }

    public function test_los_errores_de_validacion_salen_en_espanol(): void
    {
        $this->from('/proyectos/create')->followingRedirects()->post('/proyectos', ['titulo' => ''])
            ->assertSee('Este campo es obligatorio.')->assertSee('por corregir');
    }
}
