<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=0:0d1117,50:161b22,100:1f2937&height=220&section=header&text=Portafolio%20Web&fontSize=60&fontColor=e6edf3&fontAlignY=38&desc=Dashboard%20de%20administraci%C3%B3n%20de%20contenido&descSize=18&descColor=8b949e&descAlignY=58" alt="Portafolio Web" width="100%"/>

<p>
  <img src="https://img.shields.io/badge/Laravel-10-0d1117?style=for-the-badge&logo=laravel&logoColor=FF2D20&labelColor=161b22" alt="Laravel 10"/>
  <img src="https://img.shields.io/badge/PHP-%E2%89%A5%208.1-0d1117?style=for-the-badge&logo=php&logoColor=8892BF&labelColor=161b22" alt="PHP"/>
  <img src="https://img.shields.io/badge/MySQL-0d1117?style=for-the-badge&logo=mysql&logoColor=4479A1&labelColor=161b22" alt="MySQL"/>
  <img src="https://img.shields.io/badge/TailwindCSS-0d1117?style=for-the-badge&logo=tailwindcss&logoColor=38BDF8&labelColor=161b22" alt="TailwindCSS"/>
  <img src="https://img.shields.io/badge/Alpine.js-0d1117?style=for-the-badge&logo=alpinedotjs&logoColor=77C1D2&labelColor=161b22" alt="Alpine.js"/>
  <img src="https://img.shields.io/badge/Vite-0d1117?style=for-the-badge&logo=vite&logoColor=A78BFA&labelColor=161b22" alt="Vite"/>
</p>

<p><i>Gestiona tu <b>formación</b>, <b>tecnologías</b>, <b>experiencias</b> y <b>proyectos</b> desde un panel limpio, oscuro y responsivo.</i></p>

<p>
  <a href="#-características">Características</a> ·
  <a href="#-instalación">Instalación</a> ·
  <a href="#-uso">Uso</a> ·
  <a href="#-estructura">Estructura</a> ·
  <a href="#-autor">Autor</a>
</p>

</div>

<br/>

## ✨ Características

<table>
  <tr>
<td width="50%" valign="top">

**🗂️ CRUD completo**
Formación, tecnologías, experiencias y proyectos, todo desde un único dashboard.

</td>
<td width="50%" valign="top">

**🚀 Publicación opcional**
Cada proyecto tiene un toggle para decidir si se muestra en el portafolio.

</td>
  </tr>
  <tr>
<td width="50%" valign="top">

**🏷️ Tecnologías como texto**
Se guardan separadas por comas, simples de editar y de mostrar.

</td>
<td width="50%" valign="top">

**📱 Responsivo**
Interfaz adaptada a escritorio, tablet y móvil.

</td>
  </tr>
  <tr>
<td colspan="2" valign="top">

**🔎 Tablas inteligentes**
Integración con **Simple-DataTables** para búsqueda y paginación instantáneas.

</td>
  </tr>
</table>

<br/>

## 🧰 Stack

| Capa | Tecnología |
| :-- | :-- |
| **Backend** | Laravel 10 · PHP ≥ 8.1 |
| **Frontend** | TailwindCSS · Alpine.js · Simple-DataTables |
| **Base de datos** | MySQL |
| **Build & dependencias** | Vite · Composer · npm |

<br/>

## 📋 Requisitos

- PHP `>= 8.1`
- Composer
- Node.js y npm
- MySQL
- Navegador moderno

<br/>

## ⚡ Instalación

**1. Clonar el repositorio**

```bash
git clone <URL_DEL_REPOSITORIO>
cd portafolio
```

**2. Crear el archivo `.env`**

```bash
cp .env.example .env
```

**3. Configurar las variables**

```dotenv
# Credenciales del login
LOGIN_USER=tu_usuario
LOGIN_PASS=tu_contraseña

# Base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portafolio
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

**4. Crear la base de datos**

```sql
CREATE DATABASE portafolio;
```

**5. Instalar y levantar**

```bash
composer install
npm install --legacy-peer-deps   # evita conflictos de dependencias
php artisan key:generate
php artisan migrate:fresh --seed # crea las tablas y datos de prueba
npm run dev                      # compila assets para desarrollo
php artisan serve                # http://127.0.0.1:8000
```

<br/>

## 🎮 Uso

1. Entra a `/login` con las credenciales definidas en `.env`.
2. Navega por el **sidebar** para gestionar formación, tecnologías, experiencias y proyectos.
3. Crea, edita o elimina registros desde la interfaz.
4. Activa el toggle `publicado` (`= 1`) para mostrar un proyecto en el portafolio.

<br/>

## 🗺️ Estructura

```text
app/
├── Http/Controllers/
│   ├── ExperienciaController.php
│   ├── FormacionController.php
│   ├── ProyectoController.php
│   └── TecnologiaController.php
└── Models/
    ├── Experiencia.php
    ├── Formacion.php
    ├── Proyecto.php
    └── Tecnologia.php

resources/views/
├── experiencias/
├── formacion/
├── proyectos/
└── tecnologias/
```

<br/>

## 💡 Tips

> [!TIP]
> - Las **tecnologías** en experiencias y proyectos se almacenan como texto separado por comas.
> - Para producción configura un servidor web (Apache/Nginx) y un `.env` adecuado.
> - Puedes agregar más *seeders* para probar con más datos.

<br/>

## 👤 Autor

<div align="center">

**Cristian Tambley M.**

<a href="mailto:cristiantex@gmail.com">
  <img src="https://img.shields.io/badge/cristiantex@gmail.com-0d1117?style=for-the-badge&logo=gmail&logoColor=EA4335&labelColor=161b22" alt="Email"/>
</a>

<img src="https://capsule-render.vercel.app/api?type=waving&color=0:1f2937,50:161b22,100:0d1117&height=110&section=footer" alt="" width="100%"/>

</div>
