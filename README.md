<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=0:0d1117,50:161b22,100:1f2937&height=200&section=header&text=Portafolio%20Web&fontSize=56&fontColor=e6edf3&fontAlignY=38&desc=Curr%C3%ADculum%20t%C3%A9cnico%20con%20mantenedor%20de%20contenido&descSize=17&descColor=8b949e&descAlignY=58" alt="Portafolio Web" width="100%"/>

<p>
  <img src="https://img.shields.io/badge/Laravel-10-0d1117?style=for-the-badge&logo=laravel&logoColor=FF2D20&labelColor=161b22" alt="Laravel 10"/>
  <img src="https://img.shields.io/badge/PHP-%E2%89%A5%208.1-0d1117?style=for-the-badge&logo=php&logoColor=8892BF&labelColor=161b22" alt="PHP"/>
  <img src="https://img.shields.io/badge/MySQL-0d1117?style=for-the-badge&logo=mysql&logoColor=4479A1&labelColor=161b22" alt="MySQL"/>
  <img src="https://img.shields.io/badge/Vite-0d1117?style=for-the-badge&logo=vite&logoColor=A78BFA&labelColor=161b22" alt="Vite"/>
  <img src="https://img.shields.io/badge/PHPUnit-40%20tests-0d1117?style=for-the-badge&logo=phpunit&logoColor=5FBF8F&labelColor=161b22" alt="PHPUnit"/>
</p>

<p><i>Un portafolio que se lee como un currículum técnico: experiencia contada como historias de ingeniería, proyectos como casos de estudio y un mantenedor propio para editar todo el contenido.</i></p>

<p>
  <a href="#-qué-muestra-el-sitio">Qué muestra</a> ·
  <a href="#-instalación">Instalación</a> ·
  <a href="#-mantenedor">Mantenedor</a> ·
  <a href="#-arquitectura">Arquitectura</a> ·
  <a href="#-pruebas">Pruebas</a>
</p>

</div>

<br/>

## 🧭 Qué muestra el sitio

La web pública es una sola página con secciones que se **muestran solo si tienen datos**:

| Sección | Contenido |
| :-- | :-- |
| **Inicio** | Nombre, rol, titular y un resumen técnico (años de experiencia, stack, bases de datos, problemas que resuelve, proyectos). Botón *Descargar CV* si hay un PDF cargado. |
| **Perfil** | Descripción, problemas que resuelve, trayectoria (calculada desde las experiencias), hacia dónde evoluciona el perfil y formación. |
| **Experiencia** | Cada rol como historia: **Contexto → Problema → Solución → Resultado**, con duración y tecnologías. |
| **Proyectos** | Casos técnicos con problema, qué se construyó, arquitectura, diagrama de flujo, decisiones, desafíos y resultado. Los proyectos sin caso técnico van en una lista aparte. |
| **Tecnologías** | Agrupadas por categoría (Backend, Frontend, Bases de datos, Arquitectura e ingeniería, DevOps, IA), con años de uso y para qué se usaron. |
| **Arquitectura** | Cómo está construido este mismo sitio. |
| **Contacto** | Datos de contacto y formulario real; los mensajes llegan al mantenedor. |

> Nada se inventa: todo sale de la base de datos. Los campos opcionales que no se completan no se dibujan.

<br/>

## ⚡ Instalación

**Requisitos:** PHP ≥ 8.1, Composer, Node.js y npm, MySQL.

```bash
git clone <URL_DEL_REPOSITORIO>
cd portafolio

cp .env.example .env
```

Configura `.env`:

```dotenv
DB_CONNECTION=mysql
DB_DATABASE=portafolio
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

# Acceso al mantenedor
LOGIN_USER=tu_usuario
LOGIN_PASS=tu_contraseña        # simple, para desarrollo
# LOGIN_PASS_HASH=              # bcrypt, recomendado en producción
```

Para generar el hash: `php artisan tinker --execute="echo Hash::make('tu-clave');"`

```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed      # tablas + datos de ejemplo (solo fuera de producción)
php artisan storage:link        # para servir foto, CV e imágenes subidas
npm run build                   # compila CSS/JS (o `npm run dev` mientras desarrollas)
php artisan serve               # http://127.0.0.1:8000
```

> **Ya tenía datos.** Las migraciones nuevas solo agregan columnas opcionales, así que basta con `php artisan migrate`. No uses `migrate:fresh` sobre datos reales.
>
> `public/build` está versionado para que el sitio funcione tras un `git pull` sin Node en el servidor. Si cambias CSS o JS, vuelve a ejecutar `npm run build`.

<br/>

## 🛠️ Mantenedor

Entra en `/login`. El panel usa el mismo lenguaje visual que el sitio público.

- **Resumen:** conteos, tecnologías más usadas en proyectos y una lista de **contenido por completar** (por ejemplo, proyectos publicados sin caso técnico).
- **Perfil:** identidad, titular, problemas que resuelves, rumbo, contacto, foto y CV en PDF.
- **Experiencias:** rol + historia (contexto, problema, solución, resultados) + tecnologías.
- **Proyectos:** datos básicos + *caso técnico* (problema, qué construí, arquitectura, diagrama, decisiones, desafíos, resultado). Solo los **publicados** aparecen en el sitio.
- **Tecnologías:** categoría, años de uso y descripción de uso.
- **Formación** y **Mensajes** del formulario de contacto.

**Formato de algunos campos**

| Campo | Formato | Ejemplo |
| :-- | :-- | :-- |
| Tecnologías (experiencias/proyectos) | separadas por coma | `Java, Spring Boot, MySQL` |
| Resultados, decisiones, problemas que resuelvo | separados por `;` | `Menos incidentes; Despliegues más simples` |
| Diagrama de flujo | pasos separados por `>` | `Frontend > API > Servicio > Base de datos` |

<br/>

## 🏗️ Arquitectura

```text
app/
├── Http/
│   ├── Controllers/     Delgados: coordinan, no consultan ni validan
│   ├── Requests/        Validación (un Form Request por recurso)
│   └── Middleware/      CheckLogin (sesión del mantenedor)
├── Models/              Casts, scopes (publicados) y accesores (listas, duración)
├── Services/
│   ├── PortafolioService.php   Arma los datos de la web pública
│   └── ResumenAdmin.php        Datos del panel de inicio
├── Support/Lista.php    Convierte "a, b; c" en listas limpias
└── View/Components/     Layouts de Blade (sitio y mantenedor)

resources/
├── css/  tokens.css · site.css · admin.css     Sistema de diseño propio, sin framework
├── js/   site.js · admin.js                    Mejora progresiva (el sitio se lee sin JS)
└── views/
    ├── site/sections/   hero, perfil, experiencia, proyectos, tecnologías, arquitectura, contacto
    ├── admin/           mantenedor
    └── components/      icon, flow (diagramas), form.* (campos accesibles)
```

**Decisiones**

- **Vistas sin consultas:** los controladores llaman a un servicio y las vistas solo pintan.
- **Frontend liviano:** ~4 KB de CSS y ~1 KB de JS (gzip) en el sitio público; fuentes IBM Plex autoalojadas; sin CDN ni librerías de UI.
- **Seguridad:** sesión regenerada al ingresar, CSRF, límite de intentos en login y contacto, contraseña con `hash_equals` o bcrypt, honeypot en el formulario, archivos validados por tipo y tamaño, salida escapada.
- **Accesibilidad y SEO:** HTML semántico, foco visible, navegación por teclado en los casos técnicos, `title`/`description`, Open Graph, JSON-LD (`Person`) y estilos de impresión para usar el sitio como CV.

<br/>

## ✅ Pruebas

```bash
php artisan test          # 40 pruebas: sitio público, contacto, acceso, mantenedor y modelos
./vendor/bin/pint --test  # estilo de código
```

<br/>

## 👤 Autor

<div align="center">

**Cristian Tambley M.**

<a href="mailto:cristiantex@gmail.com">
  <img src="https://img.shields.io/badge/cristiantex@gmail.com-0d1117?style=for-the-badge&logo=gmail&logoColor=EA4335&labelColor=161b22" alt="Email"/>
</a>

<img src="https://capsule-render.vercel.app/api?type=waving&color=0:1f2937,50:161b22,100:0d1117&height=110&section=footer" alt="" width="100%"/>

</div>
