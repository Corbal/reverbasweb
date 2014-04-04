<?php
    require_once '../lib/basedatos.php';
    require_once '../lib/funciones.php';
    
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $conexion = Basedatos::getInstancia();
        
        if(!empty($_POST['c01']) && !empty($_POST['c02']))
        {
            $sql = sprintf("select nickname from usuarios where nickname='%s'", $_POST['c01']);
            
            if(!$conexion->existe($sql))
            {
                $sql = sprintf("select password from usuarios where nickname='%s'", $_POST['c01']);
                
                $passbbdd = $conexion->consulta($sql);
                
                if(comprobarPass($_POST['c02'], $passbbdd))
                {
                    @session_start();
                    $_SESSION['nickname'] = strtolower($_POST['c01']);
                    echo "sesión iniciada correctamente.";
                }
                else
                {
                    echo "Contraseña incorrecta.";
                }
            }
            else 
            {
                echo "El usuario no está registrado.";
            }
        }
        else
        {
            echo "Rellene todos los campos.";
        }
    }
    
?>

