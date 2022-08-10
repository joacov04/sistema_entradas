# Sistema de entradas con códigos QR

## Descripción
Sistema simple de control de asistencia para eventos

## ToDo List antes de hacer publico
- [ ] Hacer un boton en algun lado (accesible solo con contraseña) que permita que cualquier telefono pueda escanear qrs (para el dia del evento ultima hora)
- [ ] Borrar el credentials.inc de aca y cambiar contraseñas
- [ ] Meter todo en carpetas para que sea mas prolijo
- [ ] Traducir readme a ingles si pinta
- [ ] Explicar brevemente el usage

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
usada boolean);
```
4. Crear un archivo `credentials.inc` para php-mysql con el siguiente formato
```
<?php
$user='fdp';
$host='localhost';
$pass='password';
$base='entradas';
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

2. Si se utiliza el spreadsheets de google docs, hay un archivo `api.php` para importar con la funcion `=IMPORTDATA()`
y tener la cantidad de QR's que fueron generados. La url a utilizar seria `http://server.com/dir_entradas/api.php`

