<?php

    require_once '../lib/basedatos.php';
    require_once '../lib/funciones.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        $conexion = Basedatos::getInstancia();

        $sql = sprintf("select nickname from usuarios where nickname='%s'", $_POST['c01']);

        if (!$conexion->existe($sql))
        {
            // se comprueba que están cubiertos todos los campos (todos obligatorios a priori)
            if (!empty($_POST['c01']) && !empty($_POST['c02']) && !empty($_POST['c03']) && !empty($_POST['c04']) && !empty($_POST['c05']) && !empty($_POST['c06']) && !empty($_POST['c07']) && !empty($_POST['c08']) && !empty($_POST['c09']) && !empty($_POST['c11']) &&  !empty($_POST['check_app']) && ($_POST['c10'] == 1 || $_POST['c10'] == 0))
            {
                
                // array de errores
                $errores = array();
               
                // se comprueba que el formulario procede de la app, aplicando md5 a nickname y comparandolo con el campo oculto que viene de la app
                // se podría aplicar otra encriptacion más segura y aplicarla sobre otro campo también menos evidente
                if (/*md5($_POST['c01'])*/'holahola' == $_POST['check_app'])
                {
                    // Comenzamos la validación usando expresiones regulares.
                    // Validación del nickname. min 4 caracteres y máximo 20.
                    // letras y números y no caracteres especiales.
                    if (!preg_match('/^[a-zA-Z0-9_\-]{4,20}$/', $_POST['c01']))
                    {
                        $errores[] = 'Campo nickname obligatorio.';
                    }

                    // El nombre = que nickname y máximo 20 caracteres.
                    if (!preg_match('/^[a-zA-Z0-9_\- ]{4,20}$/', $_POST['c02']))
                    {
                        $errores[] = 'Campo nombre obligatorio';
                    }
                    // Los apellidos = que nickname y máximo 100 caracteres.
                    if (!preg_match('/^[a-zA-Z0-9_\- ]{4,100}$/', $_POST['c03']))
                    {
                        $errores[] = 'Campo apellidos obligatorio';
                    }
                    
                    // La edad
                    if (!preg_match('/^[0-9]{1,3}$/', $_POST['c04']))
                    {
                        $errores[] = 'Campo edad obligatorio';
                    }

                    // Validar e-mail
                    if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$/', $_POST['c05']))
                    {
                        $errores[] = 'Campo email obligatorio';
                    }

                    // El código postal
                    if (!preg_match('/^[0-9]{5}$/', $_POST['c06']))
                    {
                        $errores[] = 'Campo código postal obligatorio';
                    }
                    
                    // Fecha nacimiento
                    if (!preg_match('/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/', $_POST['c07']))
                    {
                        $errores[] = 'Campo fecha de nacimiento obligatorio';
                    }
                    
                    // Sexo
                    if (!preg_match('/^[H|M]{1}$/', $_POST['c08']))
                    {
                        $errores[] = 'Campo sexo obligatorio';
                    }
                    
                    // Telefono
                    if (!preg_match('/^[0-9]{9,10}$/', $_POST['c09']))
                    {
                        $errores[] = 'Campo teléfono obligatorio';
                    }
                    
                    // Privilegios
                    if (!preg_match('/^[0|1]{1}$/', $_POST['c10']))
                    {
                        $errores[] = 'Faltan privilegios';
                    }
                    
                    // La contraseña debe contener de 6 a 15 caracteres (cualquier tipo de caracter), al menos 1 letra minúscula, 1 Mayúscula, al menos 1 número
                    // Check your expressions at: http://www.phpliveregex.com/
                    // Have a look at: http://www.rexegg.com/ for more info!!.
                    if (!preg_match('/(?=^[\w\W]{6,15}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d).*/', $_POST['c11']))
                    {
                        $errores[] = 'Campo contraseña obligatorio';
                    }
                    
                    if (count($errores) == 0)
                    {
                        $_POST['c07'] = cambiaf_mysql($_POST['c07']);
                        
                        $_POST['c11'] = encriptar($_POST['c11']);

                        $sql = sprintf("insert into usuarios (nickname,nombre,apellidos,edad,email,codigopostal,fechanacimiento,sexo,telefono,privilegios,password) values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", $_POST['c01'], $_POST['c02'], $_POST['c03'], $_POST['c04'], $_POST['c05'], $_POST['c06'], $_POST['c07'], $_POST['c08'], $_POST['c09'], $_POST['c10'], $_POST['c11']);

                        if ($conexion->insertar($sql)->error == '')
                            {
                                echo "Registro de usuario correcto.";
                            } 
                        else
                            {
                                echo "Ha ocurrido algun problema al registrar usuario.";
                            }
                    }
                        
                    else
                    {
                        echo "error en algún campo";
                    }
                    
                    
                }
            else
                {
                    echo "Los datos no proceden de app móvil.";
                }
            } 
        else
            {
                echo "Rellene todos los campos.";
            }
         
        }
    else
       {
         echo "El nickname ya existe";
       }
    }
    else
    {
        echo "No se reciben datos por POST.";
    }
?>
