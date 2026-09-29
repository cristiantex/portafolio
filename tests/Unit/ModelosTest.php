<?php

namespace Tests\Unit;

use App\Models\Experiencia;
use App\Models\Perfil;
use App\Models\Proyecto;
use App\Support\Lista;
use Carbon\Carbon;
use Tests\TestCase;

class ModelosTest extends TestCase
{
    public function test_lista_separa_y_limpia(): void
    {
        $this->assertSame(['PHP', 'Java'], Lista::separar(' PHP , ,Java ,'));
        $this->assertSame(['a', 'b'], Lista::separar('a; b;', ';'));
        $this->assertSame([], Lista::separar(null));
        $this->assertSame([], Lista::separar('   '));
    }

    public function test_duracion_de_una_experiencia(): void
    {
        Carbon::setTestNow('2024-06-15');

        $e = new Experiencia(['fecha_inicio' => '2021-03-01', 'fecha_fin' => '2023-06-01']);
        $this->assertSame('2 años 3 meses', $e->duracion);

        $e = new Experiencia(['fecha_inicio' => '2023-06-01', 'fecha_fin' => '2024-06-01']);
        $this->assertSame('1 año', $e->duracion);

        $this->assertTrue((new Experiencia(['fecha_inicio' => '2020-01-01']))->es_actual);

        Carbon::setTestNow();
    }

    public function test_es_caso_requiere_algo_mas_que_la_descripcion(): void
    {
        $this->assertFalse((new Proyecto(['titulo' => 'x', 'descripcion' => 'solo resumen']))->es_caso);
        $this->assertTrue((new Proyecto(['titulo' => 'x', 'resultado' => 'algo']))->es_caso);
    }

    public function test_resumen_del_perfil_usa_titular_o_primera_oracion(): void
    {
        $this->assertSame('Titular.', (new Perfil(['titular' => 'Titular.']))->resumen);
        $this->assertSame('Primera oración.', (new Perfil(['descripcion' => 'Primera oración. Segunda.']))->resumen);
        $this->assertNull((new Perfil)->resumen);
    }

    public function test_foto_acepta_url_externa_y_ruta_local(): void
    {
        $this->assertSame('https://x.test/a.png', (new Perfil(['foto_perfil' => 'https://x.test/a.png']))->foto_url);
        $this->assertNull((new Perfil)->foto_url);
    }
}
