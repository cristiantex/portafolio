# portafolio
Portafolio web con dashboard de administración de contenido.

crear archivo .env: crear database mysql 'portafolio'
php artisan key:generate
desde la raíz de tu proyecto ejecutar : composer install
desde la raíz de tu proyecto ejecutar : npm install (requiere instalar Node.js) anadir --strict-ssl false para evitar firewall
php artisan migrate:fresh --seed 'para llenar con datos de prueba'
php artisan storage:link (para crear rutas simbolicas)