<?php
    include_once '../bd/conexion.php';

    if(isset($_POST['registro'])){

        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];

        $clave_encriptada =  base64_encode($clave);

        mysqli_query($conexion,"INSERT INTO usuarios (nombre, correo, clave)
                                VALUES('$nombre','$correo','$clave_encriptada')");
    }
    header('location: ../index.html');


?>