<?php
// Rutas del sistema.
//definimos las rutas fisicas de las carpetas privadas como una constante
//RAIZ nos devolvería por ejemplo algo como ésto:/var/www/clients/client94/web80/web/dwes/tema4/blog2013/
define('RAIZ', dirname(__DIR__) . '/');
define('RUTA_INC', RAIZ . 'inc/');
define('RUTA_LIB', RAIZ . 'lib/');
define('RUTA_CONF', RAIZ . 'conf/');
define('RUTA_FOTOS', RAIZ . 'fotos/');

// Bases de datos.
define('BD_SERVIDOR', '');
define('BD_NOMBRE', ' ');
define('BD_USUARIO', ' ');
define('BD_PASSWORD', ''); 

define('ADMINMAIL', '');
define('MAILPASSWD', '');
define('MAIL_SERVIDOR', 'smtp.gmail.com'); //$_SERVER['HTTP_HOST']);
define('MAIL_PUERTO', 465); //25);	//para gmail sería 465
define('MAIL_SSL','ssl');	//para gmail.
define('MAIL_NOMBRE_PROPIO', 'Administrador');
?>
