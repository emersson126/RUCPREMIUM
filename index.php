<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunat API Demo</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <h1>Sunat API Demo</h1>

    <label for="rucInput">Ingrese el número de RUC:</label>
    <input type="text" id="rucInput" placeholder="Ej. 20100047218">
    <button onclick="consultarSunat()">Consultar Sunat</button>

    <div id="resultados">
        <!-- Aquí se mostrarán los resultados -->
    </div>

    <script>
        function consultarSunat() {
            var ruc = document.getElementById("rucInput").value;
            var apiUrl = `https://api.sunat.dev/ruc-premium/${ruc}?apikey=hmWkX8YV2qNsp2keZUW3R4tnb3mqOUWfexjzIucOdvfhnU6pmMJGXcO2RqTWMIQC`;

            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // La API respondió correctamente
                    guardarEnTabla(data);
                    mostrarResultados(data);
                },
                error: function (error) {
                    // La API respondió con error
                    mostrarError(error);
                }
            });
        }

        function guardarEnTabla(data) {
            // Implementa aquí la lógica para guardar en la tabla "customers"
            // Puedes hacer otra petición AJAX al servidor para realizar la inserción en la base de datos.
        }

        function mostrarResultados(data) {
            // Muestra los resultados en el elemento con id "resultados"
            var resultadosDiv = document.getElementById("resultados");
            resultadosDiv.innerHTML = `<p>Estado: ${data.statusCode}</p>`;
            resultadosDiv.innerHTML += `<p>RUC: ${data.body.numeroRuc}</p>`;
            resultadosDiv.innerHTML += `<p>Razón Social: ${data.body.datosContribuyente.desRazonSocial}</p>`;
            console.log(resultadosDiv);
            // Agrega más información según tus necesidades
        }

        function mostrarError(error) {
            // Muestra el mensaje de error en el elemento con id "resultados"
            var resultadosDiv = document.getElementById("resultados");
            resultadosDiv.innerHTML = `<p>Error al consultar la API: ${error.responseText}</p>`;
        }
    </script>

</body>
</html>
