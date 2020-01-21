# Ecommerce

Es una tienda en línea genérica que tiene la capacidad de poder extender sus funcionalidades dependiendo de las necesidades que se tengan en el momento, además de cumplir con los objetivos básicos.

### Pre-requisitos

Se necesita instalar las siguientes herramientas
```
Composer v1.9
Php v7.3.12
Vagrant >= 2.2.6
```

### Entorno de desarrollo

Es necesario ejecutar el siguiente comando
```
vagrant box add laravel/homestead
composer install
php vendor/bin/homestead make
```

### Instalación 

1. copiar el archivo .env.example y renombrarlo por .env
2. En consola se tienen que ejecutar en orden los siguientes comandos
```
php artisan key:generate
vagrant up
vagrant ssh
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
* [Vagrant: 2.x](https://www.vagrantup.com/) - Entorno de desarrollo

## Licencia

Este proyecto está bajo la Licencia [MIT](LICENSE.md)
