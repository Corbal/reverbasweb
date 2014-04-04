<?php
function enviar_correo($nombre, $email, $asunto, $contenido) {
     // Cargamos las librerias de phpmailer
     // cargamos las constantes por si acaso.
     require_once './lib/class.phpmailer.php';
     require_once './lib/constantes.php';

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
               $correo->Username = MAIL_PROPIO;
               $correo->Password = MAIL_PASSWORD;
               $correo->SetFrom($email, $nombre);
               $correo->AddReplyTo($email, $nombre);

               $correo->AddAddress(MAIL_PROPIO, MAIL_NOMBRE_PROPIO);
               $correo->Subject = $asunto;
               $correo->AltBody = 'Cambia de cliente de correo, lo que usas es una basura';
               $correo->MsgHTML($contenido);
               $correo->IsHTML(true);

                // Enviamos el correo.
               if ($correo->Send())
                    echo 'Se ha enviado correctamente el correo.';
               else
                    echo 'Error enviado correo: ' . $correo->ErrorInfo;
          }     
}
?>
