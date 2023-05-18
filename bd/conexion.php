
<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $bd = "bd_login";
    

    $conexion = new mysqli($servidor, $usuario, $clave, $bd);

    if ($conexion -> connect_errno){
        echo 'error en la conexion';
        exit();
    }
?>

