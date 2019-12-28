# Ecommerce

Es una tienda en línea genérica que tiene la capacidad de poder extender sus funcionalidades dependiendo de las necesidades que se tengan en el momento, además de cumplir con los objetivos básicos.

### Pre-requisitos

Se necesita instalar las siguientes herramientas

```
Composer v1.9
Php v7.2
Node v12.13.1
```

### Instalación 

1. Es necesario crear una base de datos y agregar las credenciales de la base de datos en el archivo .env
2. En consola se tienen que ejecutar en orden los siguientes comandos

```
1. composer install
2. php artisan key:generate
3. php artisan migrate
4. npm install
5. npm run dev
```

## Ejecutando las pruebas

```
vendor/bin/phpunit
```

## Ejecutando datos semilla

```
php artisan db:seed
```

## Ejecutando pruebas de sintaxis en componentes vue

```
npm test
```

## Construido con 

* [Laravel: 6.x](https://laravel.com/docs/6.x) - Framework principal de desarrollo
* [Vue: 2.x](https://vuejs.org/) - Framework para construir interfaces


## Licencia

Este proyecto está bajo la Licencia [MIT](LICENSE.md)

