<script type="text/javascript">
	$(window).load(function() {
		
		$(".bannerbg").fadeOut(200);		
		$("#nombre").blur(function(){
			if($(this).val()=="")
			{
				$(this).addClass("contactoerror");
				$(this).focus();
			}
			else
				$(this).removeClass("contactoerror");
		});
				 
		$("#email").blur(function(){
			expresion = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
			if (this.value.match(expresion))
			{
				$(this).removeClass("contactoerror");
			}
			else
			{
				$(this).addClass("contactoerror");
				$(this).focus();
			}
		});
		$("#mensaje").blur(function(){
			if($(this).val()=="")
			{
				$(this).addClass("contactoerror");
				$(this).focus();
			}
			else
				$(this).removeClass("contactoerror");
		});
		$("#contacto").submit(function(){
			this.preventDefault();		
		});


		
	});
</script> 



<div class="container">        
    <div class="col_1_3">
        <div class="features">     
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") { // estamos recibiendo datos por POST // Aqui dentro validaremos todo y grabaremos en la base de datos.
                // Primero depuramos los campos, luego los validaremos.
                // Enviamos el correo.
                enviar_correo($_POST['nombre'], $_POST['asunto'], $_POST['email'], $_POST['mensaje']);

            }
            else {
                ?>

                <div id="">
                    <fieldset class="contactar">
					<h1 class="blanco">¡CONTACTA CON NOSOTROS!</h1>
                        <form id="contacto" class="formulario" action="" method="post" autocomplete="off">
                            <p>Nombre:</p>
                            <input name="nombre" id="nombre" type="text" />
                            <p> Asunto:</p>
                            <input name="asunto" id="asunto" type="text" />
                            <p>Email:</p>
                            <input name="email" id="email" type="text" />
                            <p> Mensaje:</p>
                            <textarea name="mensaje" id="mensaje" rows="6" cols="80"></textarea>
                            <br/>                            
                            <input type="submit" class="controles" value="Envia mensaje"/>
                        </form>
                    </fieldset>
                </div>
		
    <?php
}
?>
        </div>
    </div>
</div>