# LaraFlex CMS & CRUD Toolkit (Admin Panel) V.1.0.1

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

El paquete "LaraFlex CMS & CRUD Toolkit" es una solución actualmente en su version temprana de desarrollo para la administración de laravel con su panel de administracion, desarrollo de CRUD (Create, Read, Update, Delete) y sistema de gestión de contenido en aplicaciones Laravel, para la creacion de páginas, posts, categorias, tags, importacion de temas etc... Diseñado para agilizar el desarrollo en Laravel y ofrecer una interfaz de usuario intuitiva, este paquete proporciona una amplia gama de características y funcionalidades.

## Características destacadas

- **Panel de administración listo para usar:** Ofrece una interfaz de usuario profesional y amigable que permite administrar eficientemente la aplicación.
- **CRUD automático:** Genera automáticamente las operaciones CRUD para tus modelos, ahorrándote tiempo y esfuerzo en la implementación repetitiva de código.
- **Sistema de gestión de contenido (CMS):** Permite crear y gestionar fácilmente el contenido de tu aplicación, como páginas, publicaciones de blog, categorías y más.
- **Integración con Laravel:** Totalmente compatible con el framework Laravel y aprovecha sus características y mejores prácticas.

## En desarrollo

- **Personalización flexible:** Adapta el panel de administración a tus necesidades con opciones de configuración y ajustes visuales.
- **Autenticación y autorización:** Proporciona una capa de seguridad integrada para proteger las áreas administrativas y definir roles y permisos de usuario.
- **Soporte para múltiples idiomas:** Permite localizar tu aplicación en diferentes idiomas, facilitando su uso en entornos multilingües.


## Instalación

Puedes instalar el paquete utilizando [Composer](https://getcomposer.org). Ejecuta los siguientes comandos en la raíz de tu proyecto Laravel:

```bash

composer require caimari/laraflex
composer require caimari/fmanager
composer require caimari/laraflex-theme-plexus

php artisan migrate
php artisan storage:link
php artisan vendor:publish --tag=laraflex-images

routes/web.php

/*
Route::get('/', function () {
    return view('welcome');
});
*/

La ruta mencionada es una ruta de bienvenida predeterminada que se crea automáticamente al instalar Laravel. Utiliza la URL raíz ("/") y el método GET para acceder a ella. Sin embargo, si deseas asegurarte de que el tema "laraflex-theme-plexus" se cargue correctamente, es posible que debas tener en cuenta otras rutas definidas en el archivo "routes/web.php" que también utilicen la URL raíz ("/"). 

En ese caso, podría haber conflictos y la ruta de bienvenida predeterminada podría interferir con la carga del tema deseado. Para evitar esto, puedes comentar o eliminar la ruta de bienvenida predeterminada y asegurarte de que las rutas definidas en el archivo "routes/web.php" sean coherentes y no entren en conflicto con la carga del tema que deseas utilizar.

## Desinstalación

composer remove caimari/laraflex caimari/fmanager caimari/laraflex-theme-plexus

```

## Acceso

La ruta predeterminada del panel de LaraFlex es "/panel". Después de realizar la migración de las tablas, se crea un usuario administrador con las siguientes credenciales:

- Login: admin@admin.com
- Contraseña: adminadmin

Es importante tener en cuenta que debes cambiar inmediatamente estas credenciales de acceso y la contraseña predeterminada por razones de seguridad.

