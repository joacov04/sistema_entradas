# Sistema de entradas con códigos QR
<p align="center">
<img src="https://user-images.githubusercontent.com/45110242/203401154-a3090563-6c59-463d-849f-ec6591df9e54.png"></img>
<img src="https://user-images.githubusercontent.com/45110242/208120071-48321912-0930-415c-a4d9-b43001b2dc51.png"></img>
<img src="https://user-images.githubusercontent.com/45110242/208120622-58448dd3-5a69-4761-bbd6-35b56ec7461e.png"></img>
</p>
## Descripción
Sistema simple de control de asistencia para eventos

## ToDo List

- [ ] poder cambiar imagen de fondo desde la pagina + varias tablas para varios dias
- [ ] que la tabla la cree directamente el programa los directorios tmabien
- [ ] que el nombre de la tabla de la bd sea el titulo de la pagina para comodidd con muchos eventos
- [ ] (fix) en el admin panel, cuando se busca un nombre en las entradas, tambien se borra la tabla de vendeores.

## Instalacion en servidor (linux):
**Requerimientos**: 
- apache2
- php, php-mysqli
- mysql
- python3

## Configuración de la base de datos (CLI):
1. Abrir mysql como root, crear la base de datos 'entradas' y el usuario 'fdp'
```
CREATE DATABASE entradas;
CREATE USER 'fdp'@'%' IDENTIFIED BY 'pass';
```
2. Darle todos los privilegios en nueve a nuevenue 
```
GRANT ALL PRIVILEGES ON fdp.* to 'fdp'@'%';
```
3. Crear la tabla en la base de datos
```
CREATE TABLE IF NOT EXISTS fdp (
token text,
nombre text,
usada boolean,
vendedor text);
```
4. Crear un archivo `credentials.inc` para php-mysql con el siguiente formato
```
<?php
$user='fdp';
$host='localhost';
$pass='password';
$base='entradas';
$table='fdp';
$PRICE=1000;
?>
```


## Instalacion de requqrimientos de python
1. Ejecutar el siguiente comando
```
pip3 install -r requirements.txt
```

## Crear los directorios necesarios
1. Ejecutar el siguiente comando
```
mkdir qr qrUsados
```

Si realizaste todos los pasos anteriores ya deberias poder utilizar el sistema.

## Para tener en cuenta
1. Es buena práctica usar el mod de apache BasicAuth para que solo el administrador tenga acceso para crear entradas 
y también para que no se puedan marcar como usadas las entradas antes del evento en cuestión.

2. Si se utiliza el spreadsheets de google docs, hay un archivo `api/count.php` para importar con la funcion `=IMPORTDATA()`
y tener la cantidad de QR's que fueron generados. La url a utilizar seria `http://server.com/dir_entradas/api/count.php`

