# ecommerce

Es una tienda en línea genérica que tiene la capacidad de poder extender sus funcionalidades dependiendo de las necesidades que se tengan en el momento, además de cumplir con los objetivos básicos.

### Pre-requisitos

Se necesita instalar las siguientes herramientas

```

    > _Composer v1.9_
    > _Php v7.2_
    > _Node v12.13.1_

```

### Instalación 

1.- Es necesario crear una base de datos y agregar las credenciales de la base de datos en el archivo .env
2.- En consola se tienen que ejecutar en orden los siguientes comandos

```

    > _1. composer install_
    > _2. php artisan key:generate_
    > _3. php artisan migrate_
    > _4. npm install_

```

## Ejecutando las pruebas

```
    
    > _vendor/bin/phpunit_

```


## Construido con 

* [Laravel: 6.x](https://laravel.com/docs/6.x) - Framework principal de desarrollo
* [Vue: 2.x](https://vuejs.org/) - Framework para construir interfaces


## Licencia

```
MIT
```
