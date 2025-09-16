# Portafolio Web

Portafolio web con dashboard de administración de contenido, donde puedes gestionar **formación, tecnologías, experiencias y proyectos**.  
El proyecto está desarrollado en **Laravel 10**, con **MySQL** como base de datos y un frontend con **TailwindCSS y Alpine.js**.

---

## Características

- Dashboard de administración de contenido.
- CRUD completo para:
  - Formación
  - Tecnologías
  - Experiencias
  - Proyectos
- Gestión de proyectos con publicación opcional.
- Manejo de tecnologías como texto separado por comas.
- Interfaz responsiva, compatible con dispositivos móviles.
- Integración con Simple-DataTables para tablas con búsqueda y paginación.

---

## Requisitos

- PHP >= 8.1
- Composer
- Node.js y npm
- MySQL
- Navegador moderno

---

## Instalación

1. Clonar el repositorio:

```bash
git clone <URL_DEL_REPOSITORIO>
cd portafolio
```

2. Crear archivo `.env` copiando el `.env.example`:

```bash
cp .env.example .env
```

3. Configurar variables en `.env`:

```dotenv
# Credenciales del login
LOGIN_USER=tu_usuario
LOGIN_PASS=tu_contraseña

# Configuración de base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portafolio
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

4. Crear la base de datos MySQL:

```sql
CREATE DATABASE portafolio;
```

5. Desde la raíz del proyecto, ejecutar los siguientes comandos:

```bash
composer install
npm install --legacy-peer-deps   # Para evitar conflictos de dependencias
php artisan key:generate
php artisan migrate:fresh --seed # Crea las tablas y llena con datos de prueba
npm run dev                      # Compila assets para desarrollo
```

---

## Uso

- Acceder al dashboard en `/login` con las credenciales definidas en `.env`.
- Navegar por el sidebar para gestionar **formación, tecnologías, experiencias y proyectos**.
- Crear, editar o eliminar registros desde la interfaz.
- Publicar proyectos con un toggle (`publicado` = 1 para mostrar en portafolio).

---

## Estructura del proyecto

```
app/
├── Http/Controllers
│   ├── ExperienciaController.php
│   ├── FormacionController.php
│   ├── ProyectoController.php
│   └── TecnologiaController.php
├── Models
│   ├── Experiencia.php
│   ├── Formacion.php
│   ├── Proyecto.php
│   └── Tecnologia.php
resources/
├── views/
│   ├── experiencias/
│   ├── formacion/
│   ├── proyectos/
│   └── tecnologias/
```

---

## Tecnologías usadas

- Backend: **Laravel 10**
- Frontend: **TailwindCSS**, **Alpine.js**, **Simple-DataTables**
- Base de datos: **MySQL**
- Gestión de dependencias: **Composer** y **npm**

---

## Tips y recomendaciones

- Las **tecnologías** en experiencias y proyectos se almacenan como texto separado por comas.
- Para desarrollo local, usar `php artisan serve` y abrir el proyecto en `http://127.0.0.1:8000`.
- Para producción, configurar un **servidor web** (Apache/Nginx) y **.env** adecuado.
- Se pueden agregar más seeders para probar más datos si es necesario.
- Las tablas del dashboard están listas para **búsqueda y paginación** con Simple-DataTables.

---

## Autor

- Tu nombre / Cristian Tambley M.
- Contacto: cristiantex@gmail.com
