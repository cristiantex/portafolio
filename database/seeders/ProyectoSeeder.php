<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    public function run(): void
    {
        Proyecto::create([
            'titulo' => 'Portafolio web con mantenedor',
            'descripcion' => 'Este sitio: portafolio público con un mantenedor propio para editar su contenido.',
            'repositorio_url' => 'https://github.com/cristiantex/portafolio',
            'tecnologias' => 'Laravel, MySQL, Vite, JavaScript',
            'publicado' => true,
            'problema' => 'Un portafolio estático obliga a editar código para cada cambio de contenido.',
            'construccion' => 'Sitio público y mantenedor sobre los mismos datos: perfil, experiencias, proyectos, tecnologías, formación y mensajes de contacto.',
            'arquitectura' => 'MVC de Laravel con controladores delgados, Form Requests para validar, un servicio que arma los datos de la web pública y vistas Blade sin consultas.',
            'flujo' => 'Navegador > Rutas y middleware > Controlador > Servicio > Modelos Eloquent > MySQL',
            'decisiones' => 'Las secciones sin datos no se muestran, para no publicar contenido vacío; El acceso al mantenedor usa sesión, límite de intentos y comparación segura de credenciales; CSS y JS propios compilados con Vite en lugar de librerías de UI en el cliente',
            'desafios' => 'Mantener un solo modelo de datos que sirviera tanto al currículum público como al formulario de edición.',
            'resultado' => 'Todo el contenido se edita desde el mantenedor y la web pública se actualiza sin tocar código.',
        ]);

        Proyecto::create([
            'titulo' => 'Aplicación de gestión (ejemplo)',
            'descripcion' => 'Proyecto de ejemplo sin caso técnico: se muestra en la lista de otros proyectos.',
            'tecnologias' => 'PHP, MySQL, jQuery',
            'publicado' => true,
        ]);
    }
}
