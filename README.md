## Setup

### Instalar composer

https://getcomposer.org/download/

### Descargar dependencias de PHP usando composer

```
composer install --ignore-platform-req=ext-dom
```

"composer" es un manejador de dependencias de php. Se necesita composer v2.
Al ejecutar "composer install" se descargan todas las dependencias en una carpeta (/vendor), que posteriormente se copian automáticamente a la imagen de docker. 

Como no se recomienda correr "composer install" desde el dockerfile, lo resuelvo descargando las dependencias localmente, y que luego se copien en la imagen.

### Levantar imagen de docker

```
docker-compose up
```

### Configurar DB

Se incluye una base de datos para test. Si se desea reemplazar, se encuentra en `data/` y puede configurarse la ubicacion/nombre en `config/db.php`


--------------------------

### Posibles problemas y soluciones

"[package] requires ext-curl * -> the requested PHP extension curl is missing from your system."

```
sudo apt-get install php-curl
```
(y stackoverflow recomienda tmb `sudo service apache2 restart`, pero no es necesario en nuestro caso. https://stackoverflow.com/questions/33775897/how-do-i-install-the-ext-curl-extension-with-php-7)

----

"The "--ignore-platform-req" option does not exist"

Probablemente estes usando la version 1 de composer, cuando necesitas instalar la version 2.
Desinstalar la version 1 e instalar la v2.

-----
Your lock file does not contain a compatible set of packages. Please run composer update.

- codeception/base is locked to version 2.5.6 and an update of this package was not requested.
- codeception/base 2.5.6 requires ext-curl * -> it is missing from your system. Install or enable PHP's curl extension.

-----

Exception – yii\base\Exception
Failed to create directory "/app/runtime/cache": mkdir(): Permission denied
Caused by: yii\base\ErrorException

----> El problema es que estoy montando el volumen ./app y localmente no tengo permisos en esa carpeta.
Estaría bueno mejorar el tema de volumes para no tener TODO montado. Como workaround los permisos necesarios:

```
chmod -R 777 web
chmod -R 777 runtime
chmod -R 777 models
chmod -R 777 controllers
chmod -R 777 views
```

(Lo de models, controllers y views es para poder usar el Gii generator: http://localhost/gii)

------


