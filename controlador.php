<?php
// Inicializamos las sesiones.
@session_start();
require './lib/constantes.php';
require './lib/funciones.php';

?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once 'inc/head.php'; ?>
    <body>
       <?php
        require_once 'inc/cabecera.php';
          ?>     
          <div class="clearB"></div>    
       <?php
        if (!empty($_GET['cargar'])) {
            switch ($_GET['cargar']) {
                case 'index':
                    require_once 'inc/index.php';
                    break;
                case 'reverbas':
                    require_once 'inc/reverbas.php';
                    break;                
                case 'musica':
                    require_once 'inc/musica.php';
                    break;
                case 'documentales':
                    require_once 'inc/documentales.php';
                    break;  
                case 'street_art':
                    require_once 'inc/street_art.php';
                    break;
                case 'play_podcast':
                    require_once 'inc/play_podcast.php';
                    break;
                case 'briconsejos':
                    require_once 'inc/briconsejos.php';
                    break;
                case 'galeria':
                    require_once 'inc/galeria.php';
                    break;
                case 'contacto':
                    require_once 'inc/contacto.php';
                    break;                    
            }
        }
        else
             require_once 'inc/index.php';
        ?>
        <div class="clearB"></div>
        <?php require_once 'inc/app.php'; ?>
        <?php require_once 'inc/colaboradores.php'; ?>
    </body>
</html>