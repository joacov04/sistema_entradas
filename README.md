# Sistema de entradas con códigos QR
<p align="center">
<img src="https://user-images.githubusercontent.com/45110242/203401154-a3090563-6c59-463d-849f-ec6591df9e54.png"></img>
<img src="https://user-images.githubusercontent.com/45110242/208120071-48321912-0930-415c-a4d9-b43001b2dc51.png"></img>
<img src="https://user-images.githubusercontent.com/45110242/208120622-58448dd3-5a69-4761-bbd6-35b56ec7461e.png"></img>
</p>
## Descripción
Sistema simple de control de asistencia para eventos. 

## Funcionamiento
Al entrar a la página, se pueden generar links con n códigos QR que pueden ser utilizados para controlar la asistencia en un evento.
Una vez generado un link, se le envía al comprador, este rellena con sus datos y al completar todos los datos requeridos aparece 
el código QR en ese mismo link, también se le envía un email con el mismo QR e información adicional del evento.

## ToDo List

- [ ] (fix) (js) en el admin panel, cuando se busca un nombre en las entradas, tambien se borra la tabla de vendeores.

## Instalacion en servidor (linux):
**Requerimientos**: 
- apache2
- php, php-mysqli
- mysql

## Configuración de la base de datos (CLI):
1. Abrir mysql como root, crear la base de datos 'entradas' y el usuario 'fdp'
```
CREATE DATABASE entradas;
CREATE USER 'fdp'@'%' IDENTIFIED BY 'pass';
```
2. Darle todos los privilegios en sus BD a fdp 
```
GRANT ALL PRIVILEGES ON fdp.* to 'fdp'@'%';
```
3. Darle todos los privilegios en entradas a fdp
```
GRANT ALL PRIVILEGES ON entradas.* to 'fdp'@'%';
```
4. Crear las tablas en la base de datos
```
CREATE TABLE bios_persons(
  nombre text, 
  tel text,  
  mail text, 
  token text, 
  usada tyniint(1), 
  qr_token text
);
CREATE TABLE bios_tokens(
  token text, 
  cantidad int, 
  vendedor text, 
  datos_cargados tyniint(1)
 );
```
5. Crear un archivo `credentials.inc` para php-mysql con el siguiente formato
```
<?php
$user='fdp';
$host='localhost';
$pass='password';
$base='entradas';
$table='bios_persons';
$PRICE=1000;
// server.com es el servidor donde se esta haciendo el deploy, directorio_entradas el directorio
// donde se esta instalando el sistema, se puede omitir este directorio e instalar directamente en la ruta
// del servidor
$serverName='server.com/directorio_entradas'
?>
```


Si realizaste todos los pasos anteriores ya deberias poder utilizar el sistema.

## Para tener en cuenta
1. La página que ve el usuario final está estilizada para un evento en particular, para cambiarla se deben modificar los archivos `verification/ticket.php` y ´verification/ticket.css`, modificando únicamente la parte de código HTML debería ser suficiente.

2. Por defecto se le envía un mail (si está configurada la función mail() de php) al usuario final con el QR y la información del evento, este mail esta estilizado para un evento en particular, para cambiar esto debes modificar la variable ´$message´ en el archivo ´verification/ticket.php´. 

2. Se puede usar el mod de apache BasicAuth para que solo el administrador tenga acceso para crear entradas 
y también para que no se puedan marcar como usadas las entradas antes del evento en cuestión. Con este mod, aparece quien vendió 
cada entrada en la seccion de buscar

3. Si se utiliza el spreadsheets de google docs, hay un archivo `api/count.php` para importar con la funcion `=IMPORTDATA()`
y tener la cantidad de QR's que fueron generados. La url a utilizar seria `http://server.com/dir_entradas/api/count.php`

