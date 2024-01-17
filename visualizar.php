
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de Cambio</title>
    <!-- Agregar hojas de estilo CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Agregar scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

    <header>
        
    </header>

    <style type="text/css">
        html, body {
            font-family: 'Almaden Sans', 'Helvetica', 'Arial' !important;
        }
        @media (max-width: 576px){
            .tablin{
                width: 100% !important;
            }
        }
        .tablin{
            margin-top: 20px;
        }
        div.fw-container {
            position: relative;
            max-width: 962px;
            margin: 0 auto;
            clear: both;
            padding: 0 1em 3em 1em;
            box-sizing: border-box;
        }
        #soles-tabla, #dolares-tabla {
            width: 50%;
            text-align: center;
            margin-bottom: 20px;
        }
        .centerrcv {
            justify-content: space-around;
            line-height: 1.75rem;
            font-size: 1.5rem;
            text-align: center;
        }
        .odd .sorting_1cv, .even .sorting_1cv {
            font-size: 1.4rem;
            text-align: left !important;
        }
        .rotating-image {
            animation: rotate 4s linear infinite;
            background: #a0d0ff;
            border-radius: 50%;
            padding: 5px;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <main>
        <div class="fw-container">
            <img src="https://images.ctfassets.net/spoqsaf9291f/3aQs9PTDRM8Rj1gIQfNGeG/a0af6bf6ad27e40abfd0c6fb35dcb825/hero_xmas-rev.png" style="width: 100%;
    border-radius: 10px;
    margin: 10px 0px 20px 0px;">
            <div class="row">
                <div class="tablin col-lg-6 col-md-12 col-sm-12" id="soles-tabla">
                    <div class="row">
                    <div class="col-4" style="font-weight: 600;">
                    Dólares
                    </div>
                    <div class="col-4" style="font-size: 13px;">
                    Tipo de compra
                    </div>
                    <div class="col-4">
                    Soles
                    </div>
                    <div class="col-4">
                    <input type="text" name="dolarespro" style="width: 100%;text-align: center;padding: 7px 1px;border: 3px solid #444;color: #0a85d1;border-radius: 5px;font-weight: 700;font-size: 20px;">
                    </div>
                    <div class="col-4">
                    <input type="text" name="solesChange" style="width: 90%;text-align: center;padding: 10px; border: none;">
                    </div>
                    <div class="col-4" id="solesResult" style="width: 90%;text-align: center;padding: 10px; border: none;">
                    0.000
                    </div>
                    </div>
                </div>
                <div class="tablin col-lg-6 col-md-12 col-sm-12" id="dolares-tabla">
                    <div class="row">
                    <div class="col-4" style="font-weight: 600;">
                    Soles
                    </div>
                    <div class="col-4" style="font-size: 13px;">
                    Tipo de venta
                    </div>
                    <div class="col-4">
                    Dólares
                    </div>
                    <div class="col-4">
                    <input type="text" name="solespro" style="width: 100%;text-align: center;padding: 7px 1px;border: 3px solid #444;color: #0a85d1;border-radius: 5px;font-weight: 700;font-size: 20px;">
                    </div>
                    <div class="col-4">
                    <input type="text" name="dolaresChange" style="width: 90%;text-align: center;padding: 10px;    border: none;">
                    </div>
                    <div class="col-4" id="dolaresResult" style="width: 90%;text-align: center;padding: 10px; border: none;">
                    0.000
                    </div>
                    </div>
                </div>

            </div>
            <!-- Tabla Superior - Análisis de Compra y Venta -->
            <table id="analisis-tabla" class="display" style="width:100%;display: none;">
                <thead>
                    <tr>
                        <th>Analisis</th>
                        <th>Compra</th>
                        <th>Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Promedio</td>
                        <td id="promedio-compra"></td>
                        <td id="promedio-venta"></td>
                    </tr>
                    <tr>
                        <td>Máximo</td>
                        <td id="maximo-compra"></td>
                        <td id="maximo-venta"></td>
                    </tr>
                    <tr>
                        <td>Mínimo</td>
                        <td id="minimo-compra"></td>
                        <td id="minimo-venta"></td>
                    </tr>
                </tbody>
            </table>

            <!-- Tabla Principal - Datos de la API -->
            <a style="text-decoration: none;    " href="#" id="refresh-link">
                <p style="margin-top: 20px;">Fecha Actualizada: <span id="fecha-actualizacion">09/01/2024 13:25</span> <img class="rotating-image" width="20" height="20" src="https://img.icons8.com/ios-filled/50/synchronize.png" alt="synchronize"></p>
            </a>
            <?php
            $servername = "localhost";
            $username = "u903295641_RUCPREMIUM";
            $password = "4megatech.comPRO";
            $dbname = "u903295641_RUCPREMIUM";

            // Crear la conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Consulta SQL para seleccionar todas las filas
            $select_query = "SELECT * FROM customers";
            $result = $conn->query($select_query);

            // Cerrar la conexión después de obtener los resultados
            $conn->close();
            ?>

            <!-- Ahora puedes procesar los resultados y mostrarlos en una tabla -->
            <?php
            // Mostrar los resultados en una tabla HTML
            echo "<table id='example' class='display' style='width:100%'>
                     <thead>
                        <tr>
                            <th>ID</th>
                            <th>CODE</th>
                        </tr>
                    </thead>";


            while ($row = $result->fetch_assoc()) {
                echo "
                     <tbody id='tabla-body'>
                        <tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['statusCode'] . "</td>
                            <!-- Agrega más celdas para cada columna según tus campos -->
                        </tr>
                     </tbody>
                     ";
            }

            echo "</table>";

            // Liberar los resultados después de usarlos
            $result->free();
            ?>

        </div>
    </main>

    <footer>
        
    </footer>

    <script type="text/javascript">
    $(document).ready(function() {
    }
</script>

</body>
</html>
