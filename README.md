# Ecommerce

Es una tienda en línea genérica que tiene la capacidad de poder extender sus funcionalidades dependiendo de las necesidades que se tengan en el momento, además de cumplir con los objetivos básicos.

### Pre-requisitos

Se necesita instalar Vagrant >= 2.2.6 y ejecutar los siguientes comandos
```
vagrant box add laravel/homestead
vagrant up
vagrant ssh
```

### Instalación 

1. Es necesario crear una base de datos y agregar las credenciales de la base de datos en el archivo .env
2. En consola se tienen que ejecutar en orden los siguientes comandos
```
composer install
php artisan key:generate
php artisan storage:link
```

3. En la variable **x-api-key** del archivo *app.js* que se encuentra en el directorio resources/js ingresar la clave generada por el comando *php artisan key:generate*
```
axios.defaults.headers.common['x-api-key'] = 'ingresar llave'
```

4. En consola se tienen que ejecutar en orden los siguientes comandos
```
php artisan migrate
npm install
npm run dev
```

## Ejecutando pruebas


### Pruebas funcionales

```
vendor/bin/phpunit
```

### Pruebas de sintaxis en componentes Vue

```
npm test
```

## Ejecutando datos semilla

```
php artisan db:seed
```

## Construido con 

* [Laravel: 6.x](https://laravel.com/docs/6.x) - Framework principal de desarrollo
* [Vue: 2.x](https://vuejs.org/) - Framework para construir interfaces


## Licencia

Este proyecto está bajo la Licencia [MIT](LICENSE.md)
