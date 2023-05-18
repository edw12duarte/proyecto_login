<?php

    session_start();
    include_once '../bd/conexion.php';

    if(isset($_POST['ingreso'])){

        $correo = $_POST['correo'];
        $clave = $_POST['clave'];
        $clave_encriptada =  base64_encode($clave);

        $consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$correo' AND clave ='$clave_encriptada'");
        
        $num_registros = mysqli_num_rows($consulta);

        //--> para iniciar variables session de usuarios
        if ($num_registros == 1){

            //('$consulta-> fetch_array()') para cuando se TRAE 1 SOLO registro
            $captura_datos = $consulta -> fetch_array();

            $_SESSION['usuario'] =$captura_datos['nombre']; // $captura_datos[0]
            $_SESSION['correo'] =$captura_datos['correo'];
            $_SESSION['rol'] = $captura_datos['rol'];
            $_SESSION['time'] = time(); 

            /*
            // Cuando se trae en la $consulta MAS DE 1 registro
            while($captura_datos = mysqli_fetch_array($consulta)){      
                $_SESSION['usuario'] =$captura_datos['nombre'];
                $_SESSION['correo'] =$captura_datos['correo'];
                $_SESSION['rol'] =$captura_datos['rol'];
            }*/

            header('location: ../home/home_inicio.php');
        }else{
            header('location: ../index.html');
        }

    }
    

?>