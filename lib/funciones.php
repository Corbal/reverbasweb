<?php

require 'phpass-0.3/PasswordHash.php'; 
   
function encriptar($password, $vueltas = 8) {
    $hasher = new PasswordHash($vueltas, false);
 
    $password = $hasher->HashPassword($password);
                        
    return $password;
}

function comprobarPass($password,$passbbdd) {
    if($hasher->CheckPassword($password, $passbbdd))
    {
        return true;
    }
    else
    {
        return false;
    }
 
}

function cambiaf_mysql($fecha) {
     $fecha = str_replace('/', '-', $fecha);
     return date('Y-m-d', strtotime($fecha));
}

function cambiaf_normal($fecha) {
     return date('d/m/Y', strtotime($fecha));
}

//----------------------------------------------------------------------------------------------------
/**
 * Función chequearSpam.
 * Chequea caracteres de SPAM en el correo.
 * 
 * @param string $campo El campo a chequear.
 * @return boolean true si ha pasado correctamente el chequeo de spam o sale de la aplicación si se encontró spam imprimiendo un mensaje.
 */
function chequearSpam($campo) {
//Array con las posibles cabeceras a utilizar por un spammer
     $spam = array("Content-Type:",
         "MIME-Version:",
         "Content-Transfer-Encoding:",
         "Return-path:",
         "Subject:",
         "From:",
         "Envelope-to:",
         "To:",
         "bcc:",
         "cc:",
         "link=",
         "url=");

     //Comprobamos que entre los datos no se encuentre alguna de
     //las cadenas del array. Si se encuentra alguna cadena de SPAM muestra mensaje y sale de la aplicación.
     foreach ($spam as $patron) {
          // strpos(pajar,aguja) devuelve FALSE si no encuentra la cadena.
          if (strpos(strtolower($campo), strtolower($patron)) !== false) {
               echo "<br/><br/><h3><CENTER>!! Error: Caracteres SPAM detectados en el correo !! </h3>";
               echo "<h4><CENTER>!! Spammers no permitidos. Solicitud cancelada. !! </h4>.<br/></CENTER>";
               exit; // Sale de la aplicación.
          }
     }

     return true;
}

//----------------------------------------------------------------------------------------------------
/**
 * Función chequearEmail
 * Comprueba que el e-mail tenga un formato válido.
 * 
 * @param type $campo
 * @return boolean true si ha pasado el chequeo de e-mail  o sale de la aplicación si se encontró un e-mail incorrecto.
 */
function chequearEmail($campo) {
     if (!filter_var($campo, FILTER_VALIDATE_EMAIL)) {
          echo "<br/><br/><h3><CENTER>!! Error: Formato de e-mail incorrecto </font>!! </h3>";
          echo "<h4><CENTER>!! Solicitud cancelada !! </h4>.<br/></CENTER>";
          exit; // Sale de la aplicación.
     }
     return true;
}

/**
 * Funcion enviar_correo
 * Envio de correos de usuarios a administración
 * 
 * @param string $nombre
 * @param string $email
 * @param string $asunto
 * @param strigg $contenido
 */
function enviar_correo($nombre, $asunto, $email, $contenido) {
     // Cargamos las librerias de phpmailer
     // cargamos las constantes por si acaso.
     require_once RUTA_LIB.'class.phpmailer.php';
     require_once RUTA_LIB.'constantes.php';

     if (!empty($email)) { // Enviamos el correo.
          
               // Creamos un objeto de la clase phpmailer.
               $correo = new PHPMailer();

               // Ahora configuramos ese objeto.
               $correo->IsSMTP(); // indicamos que enviamos por SMTP.
               $correo->SMTPAuth = true; // Nos autenticaremos en el servidor de correo.
               $correo->CharSet = 'UTF-8';
               $correo->Host = MAIL_SERVIDOR;
               $correo->Port = MAIL_PUERTO;

               // Si enviamos correo por GMAIL (chequeando el puerto),habilitamos
               // el protocolo SSL.
               if (MAIL_PUERTO == 465 || MAIL_PUERTO == 587)  //usamos GMAIL
                    $correo->SMTPSecure = 'ssl';

               // Si usais XAMPP, teneis que habilitar en \xampp\php\php.ini 
               // la siguiente extensión:   
               // extension= php_openssl.dll
               // Datos del correo.
               $correo->Username = ADMINMAIL;
               $correo->Password = MAILPASSWD;
               $correo->SetFrom($email, $nombre);
               $correo->AddReplyTo($email, $nombre);

               $correo->AddAddress(ADMINMAIL, 'Administrador');
               $correo->Subject = $asunto;
               $correo->AltBody = 'Cambia de cliente de correo, lo que usas es una basura';
               $correo->MsgHTML($contenido);
               $correo->IsHTML(true);

                // Enviamos el correo.
               if ($correo->Send())
                    echo '<h1 class="blanco">Se ha enviado correctamente el correo.</h1>';
               else
                    echo '<h1>Error enviado correo: </h1>' . $correo->ErrorInfo;
          }     
}
?>