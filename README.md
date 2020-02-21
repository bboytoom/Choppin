# Choppin

Plataforma de comercio electrónico de código abierto.

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

1. Copiar el archivo .env.example y renombrarlo por .env
2. En consola se tienen que ejecutar en orden los siguientes comandos
```
php artisan key:generate
vagrant up
vagrant ssh
php artisan storage:link
php artisan jwt:secret
```

3. En la variable **x-api-key** del archivo axios.js que se encuentra en el directorio resources/js/plugins ingresar la clave de autorización que se encuentra en el archivo _.env_
```
axios.defaults.headers.common['x-api-key'] = 'Clave de autorización'
```

4. En consola se tienen que ejecutar en orden los siguientes comandos
```
php artisan migrate
npm install
npm run dev
```


## Pruebas

[Pruebas de Back end](https://github.com/bboytoom/Choppin/wiki/Pruebas-de-Back-end)
[Pruebas de Front end](https://github.com/bboytoom/Choppin/wiki/Pruebas-de-Front-end)


## Datos de prueba
```
php artisan db:seed
```


## Documentación
[Wiki](https://github.com/bboytoom/Choppin/wiki)


## Construido con 
* [Laravel: 6.x](https://laravel.com/docs/6.x) - Framework principal de desarrollo
* [Vue: 2.x](https://vuejs.org/) - Framework para construir interfaces
* [Vagrant: 2.x](https://www.vagrantup.com/) - Entorno de desarrollo


## Licencia
Este proyecto está bajo la Licencia [MIT](LICENSE.md)
