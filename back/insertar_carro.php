<?php
    include_once '../bd/conexion.php';

    if(isset($_POST['insertar_auto'])){
        $nombre_carro = $_POST['nombre_carro'];
        $ventas_carro = $_POST['ventas_carro'];

        mysqli_query($conexion, "INSERT INTO lista_carros( marca, ventas) VALUES ('$nombre_carro','$ventas_carro');");
    }
    header('location: ../home/home_inicio.php');


?>