<?php
    session_start(); #--- NECESARIA PARA USAR VARIABLES DE SESSION
    
    #==============================================================
    //CODIGO PARA QUE SE CIERRE TODAS LAS SESIONES EN UN NAVEGADOR
    //valida que tiene que haber un inicio de session activa, de lo contrario, cierra la session en todos las pestañas
    if(isset($_SESSION['usuario'])){
        echo'';
    }else{
        header('location: ../back/close_session.php');
    }
    #==============================================================

    #==============================================================
    /*//Para cerrar la sesion despues de un tiempo (10 seg)
    if(isset($_SESSION['usuario'])){
        if (time() - $_SESSION['time'] > 10){
            header('location: ../back/close_session.php');
        }
    }
    */
    #==============================================================

    include_once '../bd/conexion.php';
    $query_carros_1= mysqli_query($conexion, "SELECT * FROM lista_carros");

    $data_marca = array();
    $data_ventas = array();

    while($datos = mysqli_fetch_array($query_carros_1)){
        array_push($data_marca, $datos['marca']);
        array_push($data_ventas, $datos['ventas']);
    }

    $datos_x = json_encode($data_marca);
    $datos_y = json_encode($data_ventas);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--Llamado a librerias-->
    <script src="https://cdn.plot.ly/plotly-2.20.0.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/27010df775.js" crossorigin="anonymous"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js'></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.0.1/model-viewer.min.js"></script>

    <title>Proyecto de gráficas</title>
</head>
<body>
    <section id="content-main">
        <div class="menu-main">
            <img src="img/logo.png" alt="">
            <nav>
                <ul>
                    <li>
                        <a href=""><i class="fa-solid fa-car"></i></a>
                    </li>
                    <?php
                        //============================================================
                        //Se usa la variable de session 'rol'==1 para habilitar componentes de la pagina 
                        //Se aconseja usar componentes(js) para estos elementos de roles de usuario
                        if ($_SESSION['rol'] == 1) {
                    ?>
                        <li>
                            <a href="">
                                <i class="fa-solid fa-cloud-sun"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa-solid fa-wallet"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa-solid fa-comments"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa-solid fa-gift"></i>
                            </a>
                        </li>
                    <?php
                        }
                        //=============================================================
                    ?>

                </ul>
                <div class="icon-android">
                    <a href="../back/close_session.php">
                        <i class="fa-solid fa-rectangle-xmark"></i>
                    </a>
                </div>
            </nav>
        </div>

        <div class="shop_cars">
            <h2>C. shop</h2>
            <div class="element_ind">
                <img class="rotate_car" src="img/car1.png" alt="car1">
                <span>Veyron</span>
            </div>
            <div class="element_ind">
                <img src="img/car2.png" alt="car1">
                <span>G. sport</span>
            </div>
            <div class="element_ind">
                <img src="img/car3.png" alt="car1">
                <span>Centodieci</span>
            </div>
        </div>

        <div class="graphic-main">
            <div class="content-card-one">
                <div class="indiv left">
                    <div class="icon-ind">
                        <i class="fa-regular fa-handshake"></i>
                    </div>
                    <div class="cont-info">
                        <?php
                            $total_cantidad_ventas = array_sum($data_ventas);

                            echo '<h3>'.$total_cantidad_ventas.'<span>Total cantidad ventas</span></h3>';
                        ?>
                    </div>
                    <h4>R.<span>9.5</span></h4>
                </div>
                <div class="indiv">
                    <div class="icon-ind green">
                        <i class="fa-regular fa-handshake"></i>
                    </div>
                    <div class="cont-info">
                    <?php
                            $max_ventas = max($data_ventas);
                            $indice_max_ventas = array_search($max_ventas, $data_ventas);
                            $carro_max_ventas = $data_marca[$indice_max_ventas];

                            echo '<h3>'.$max_ventas.'<span>'.$carro_max_ventas.'</span></h3>';
                        ?>
                    </div>
                    <h4>R.<span>9.9</span></h4>
                </div>
            </div>
            <div class="graphic">
                <div id='myDiv'></div>
            </div>
            <div class="graphic">
                <div id='myDiv_2'></div>
            </div>
        </div>

        <div class="tridimensional">
            <h1>Insertar Datos</h1>
            <form action="../back/insertar_carro.php" method="post">
                <input type="text" name="nombre_carro" placeholder ="Nombre del carro">
                <input type="number" name="ventas_carro" placeholder="Cantidad de ventas">
                <input type="submit" name="insertar_auto" placeholder="Enviar"  >
            </form>
            <table class="table">
                <thead>
                    <td colspan="2">Tabla venta de carros</td>
                    <tr>
                        <td>Marca</td>
                        <td>Cantidad de ventas</td>
                        <td>Porcentaje del total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once '../bd/conexion.php';

                        $cantidad_ventas = $data_ventas;
                        $total_ventas = array_sum($cantidad_ventas);
                
                        $query_carros_2 = mysqli_query($conexion, "SELECT * FROM lista_carros");
                
                        while($datos= mysqli_fetch_array($query_carros_2)){
                            $nombre_carro = $datos['marca'];
                            $ventas_carro = $datos['ventas'];
                
                            echo '
                                <tr>
                                    <td>'.$nombre_carro.'</td>
                                    <td>'.$ventas_carro.'</td>
                                    <td>'.round(($ventas_carro/$total_ventas)*100, 2).'%</td>
                                </tr>
                            ';
                        }
                        echo '
                            <tr style="font-weight: 900;">
                                <td>Total</td>
                                <td>'.$total_ventas.'</td>
                                <td>100%</td>
                            </tr>
                        ';
                    ?>
                    
                </tbody>
        </table>
        </div>
        
    </section>
    <script>
        function crearCadenaLineal(json){
            let convertir = JSON.parse(json);
            let arr =[];
            
            for (let i in convertir){
                arr.push(convertir[i]);
            }
            return arr;
        }

        let datos_x = crearCadenaLineal('<?php echo $datos_x;?>');
        let datos_y = crearCadenaLineal('<?php echo $datos_y;?>');

        let datos_carros = [{
        x: datos_x,
        y: datos_y,
        name: 'Carros vs Ventas',
        marker: {color: 'rgb(142, 124, 195)',size: 12},
        mode: 'lines+markers',
        line: {shape: 'spline', dash: 'dot'},
        type: 'scatter',
        }];

        var layout = {
        height: 390,
        width: 500,
        title: 'Marca vs Ventas',
        };

        Plotly.newPlot('myDiv', datos_carros, layout);


        
        var data_carros_pie = [{
        values: datos_y,
        labels: datos_x,
        type: 'pie',
        hole: .4,
        }];

        var layout_1 = {
        height: 400,
        width: 500,
        title: 'Marca vs Ventas',
        annotations: [{font: {size: 20},
                    showarrow: false,
                    text: 'M vs V',
                    x: 0.5,
                    y: 0.5 }]
        };

        Plotly.newPlot('myDiv_2', data_carros_pie, layout_1);
    </script>
    <script src="js/app.js"></script>


</body>
</html>