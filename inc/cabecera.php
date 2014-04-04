<script>
    $(window).scroll(function()
    {
        console.log($('#logo'));
        if ($(this).scrollTop() > 50)
            $('#logo').addClass("fixed").fadeIn();
        else
            $('#logo').removeClass("fixed");
    });
</script>
<style type="text/css">



    .fixed{
        position:fixed;
        top:0;
        z-index: 100;
    }

    .contenedor{width:50%;margin:20px auto}
</style> 
<header class="header_bg clearfix">

    <!-- Social -->
    <ul class="social-links">
        <li ><a href="javascript:"><img src="images/facebook.png" alt="Facebook"></a></li>
        <li ><a href="javascript:"><img src="images/twitter.png" width="24" height="24" alt="Twitter"></a></li>
    </ul>
    <!-- /Social -->
    <!-- Logo -->


    <div class="container_logo "> <!-- creé esta clase para indicarle el maximo de width, parece que no acepta la que hay establecida-->
        <div class="logo">
            <a href="index.html"><img id="logo" src="images/logo.png" alt="" /></a>
        </div>
    </div>
    <!-- /Logo -->

    <!-- Slider -->
    <div class="bannerbg">
        <div class="container clearfix">
            <div class="flexslider" >
                <ul class="slides">
                    <li>
                        <img src="images/fslide01.jpg" alt="" />
                        <p class="flex-caption">I am Caption!</p>
                    </li>
                    <li>
                        <a href="#"><img src="images/fslide02.jpg" alt="" /></a>
                    </li>
                    <li>
                        <img src="images/fslide03.jpg" alt="" />
                        <p class="flex-caption">I am Caption!</p>
                    </li>
                    <li>
                        <img src="images/fslide04.jpg" alt="" />
                    </li>

                    <li>
                        <img src="images/fslide05.jpg" alt="" />
                    </li>

                    <li>
                        <img src="images/fslide06.jpg" alt="" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Slider -->
    <!-- Master Nav -->
    <div class="clearB"></div>
    <div class="container_p "> <!-- creé esta clase para indicarle el maximo de width, parece que no acepta la que hay establecida-->
        <nav class="main-menu">
            <ul>
                <?php
                $activarClase = ' class="seccion_actual"';
                $existePagina = 0;
                $paginaActiva = 'index';
                $cadenaPaginas = 'admin,index,reverbas,musica,documentales,street_art,play_podcast,briconsejos,galeria,contacto';

                // Comprueba que la variable exista.
                if (!empty($_GET['cargar'])) {

                    if (strpos($cadenaPaginas, $_GET['cargar'])) {
                        $existePagina = 1;
                        $paginaActiva = strtolower($_GET['cargar']);
                    }
                }
                ?>
                <li><a href="index.html"<?php if ($existePagina && $paginaActiva == 'index') echo $activarClase; ?>>INICIO</a></li>
                <li><a href="reverbas.html"<?php if ($existePagina && $paginaActiva == 'reverbas') echo $activarClase; ?> >REVERBAS</a></li>
                <li><a href="musica.html"<?php if ($existePagina && $paginaActiva == 'musica') echo $activarClase; ?>>MUSICA</a></li>
                <li><a href="documentales.html"<?php if ($existePagina && $paginaActiva == 'documentales') echo $activarClase; ?>>DOCUMENTALES</a></li>
                <li>
                    <a<?php if ($existePagina && $paginaActiva == 'street_art' || $paginaActiva == 'play_podcast' || $paginaActiva == 'briconsejos')echo $activarClase;?> >INTERACTIVIDAD</a>
                    <ul>
                        <li><a href="#"></a></li>
                        <li><a href="street_art.html">STREET ART</a></li>
                        <li><a href="play_podcast.html">PLAYLIST | PODCAST</a></li>
                        <li><a href="briconsejos.html">BRICONSEJOS</a></li>
                    </ul>
                </li>
                <li><a href="galeria.html"<?php if ($existePagina && $paginaActiva == 'galeria') echo $activarClase; ?>>GALERIA</a></li>
                <li><a href="contacto.html"<?php if ($existePagina && $paginaActiva == 'contacto') echo $activarClase; ?>>CONTACTO</a></li>
            </ul>
        </nav>

        <!-- /Master Nav -->
        <!--CUADRO DE BUSQUEDA PRUEBA-->
        <form id="busqueda" action="http://google.com/cse">
            <input type="hidden" name="cx" value="EL ID DE TU MOTOR DE B�SQUEDA va aqu�" />
            <input type="hidden" name="ie" value="UTF-8" />
            <input type="search" name="googlesearch" size="13">
        </form>
        <!--CUADRO DE BUSQUEDA-->
        <div class="clearB"></div>
    </div>

</header>