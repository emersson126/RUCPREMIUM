
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
        // Realizar la solicitud GET a la API
        $.get("https://nextius.link/tc/api.php", function(data) {
            // Mostrar la fecha de actualización en el formato deseado
            var fechaActualizacion = data.Date;
            var fecha = new Date(fechaActualizacion);

            var dia = fecha.getDate();
            var mes = fecha.getMonth() + 1; // Los meses son indexados desde 0, por eso se suma 1
            var year = fecha.getFullYear();
            var hora = fecha.getHours();
            var minutos = fecha.getMinutes();

            // Formatear la fecha y hora según tu estructura deseada
            var fechaFormateada = (dia < 10 ? '0' : '') + dia + '/' + (mes < 10 ? '0' : '') + mes + '/' + year;
            var horaFormateada = (hora < 10 ? '0' : '') + hora + ':' + (minutos < 10 ? '0' : '') + minutos;

            $('#fecha-actualizacion').text(fechaFormateada + ' ' + horaFormateada);

            // Lógica para análisis de datos
            var compras = [];
            var ventas = [];

            $.each(data, function(key, value) {
                if (value.Compra !== undefined && value.Venta !== undefined) {
                    compras.push(parseFloat(value.Compra));
                    ventas.push(parseFloat(value.Venta));
                }
            });

            $('#promedio-compra').text(calcularPromedio(compras).toFixed(3));
            $('#promedio-venta').text(calcularPromedio(ventas).toFixed(3));
            $('#maximo-compra').text(Math.max(...compras).toFixed(3));
            $('#maximo-venta').text(Math.max(...ventas).toFixed(3));
            $('#minimo-compra').text(Math.min(...compras).toFixed(3));
            $('#minimo-venta').text(Math.min(...ventas).toFixed(3));

            // Autorellenar solesChange con el valor de promedio-compra al cargar la página
            var promedioCompra = parseFloat($('#promedio-compra').text()) || 0;
            $('input[name="solesChange"]').val(promedioCompra);

            // Autorellenar solesChange con el valor de promedio-compra al cargar la página
            var promedioVenta = parseFloat($('#promedio-venta').text()) || 0;
            $('input[name="dolaresChange"]').val(promedioVenta);

            // Inicializar la tabla con DataTables y establecer el pageLength en 50
            var tabla = $('#example').DataTable({
                pageLength: 50
            });

            // Recorrer los datos de la API y agregar filas a la tabla hasta los primeros 50
            var contador = 0;
            $.each(data, function(key, value) {
                if (contador < 50 && value.Empresa !== undefined && value.Compra !== undefined && value.Venta !== undefined) {
                    var fila = '<tr>' +
                        '<td class="centerr">' + value.Empresa + '</td>' +
                        '<td class="centerr">' + value.Compra + '</td>' +
                        '<td class="centerr">' + value.Venta + '</td>' +
                        '</tr>';
                    tabla.row.add($(fila)).draw(false);
                    contador++;
                } else {
                    return false; // Detener el bucle una vez alcanzados los 50 registros o si hay valores indefinidos
                }
            });
        });

        // Función para calcular el promedio de un array de números
        function calcularPromedio(arr) {
            if (arr.length === 0) return 0;
            return arr.reduce((a, b) => a + b) / arr.length;
        }

        // Manejar el evento de entrada en las celdas de la tabla soles-tabla
        $('#soles-tabla').on('input', 'input', function() {
            // Obtener los valores ingresados por el usuario
            var dolaresPro = parseFloat($('input[name="dolarespro"]').val().replace(",", ".")) || 0;
            var solesChange = parseFloat($('input[name="solesChange"]').val().replace(",", ".")) || 0;

            // Calcular el resultado y mostrarlo en la celda solesResult
            var resultado1 = dolaresPro * solesChange;
            $('#solesResult').text(resultado1.toFixed(3));
        });

        // Manejar el evento de entrada en las celdas de la tabla dolares-tabla
        $('#dolares-tabla').on('input', 'input', function() {
            // Obtener los valores ingresados por el usuario
            var solesPro = parseFloat($('input[name="solespro"]').val().replace(",", ".")) || 0;
            var dolaresChange = parseFloat($('input[name="dolaresChange"]').val().replace(",", ".")) || 0;

            // Calcular el resultado y mostrarlo en la celda dolaresResult
            var resultado2 = solesPro / dolaresChange;
            $('#dolaresResult').text(resultado2.toFixed(3));
        });

        // Agregar validación para aceptar solo números y punto en los inputs
        $('input[name="dolarespro"], input[name="solesChange"], input[name="solespro"], input[name="dolaresChange"]').on('input', function() {
            var value = $(this).val();
            // Reemplazar cualquier caracter que no sea un número o punto con una cadena vacía
            var sanitizedValue = value.replace(/[^0-9.]/g, '');
            $(this).val(sanitizedValue);
        });
    });

    document.getElementById('refresh-link').addEventListener('click', function(event) {
        event.preventDefault();
        var fechaSpan = document.getElementById('fecha-actualizacion');
        var fechaActual = new Date().toLocaleString();
        fechaSpan.textContent = fechaActual;

        setTimeout(function() {
            location.reload();
        }, 1000);
    });
</script>

</body>
</html>
