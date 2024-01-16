<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Key Demo</title>
</head>
<body>

    <h1>API Key Demo</h1>

    <div id="resultados">
        <!-- Aquí se mostrarán los resultados -->
    </div>

    <script>
        // Realiza una solicitud AJAX a la API PHP al cargar la página
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'api.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Parsea la respuesta JSON y muestra la API Key
                    var apiKeyData = JSON.parse(xhr.responseText);
                    mostrarResultados(apiKeyData);
                } else {
                    // Muestra un mensaje de error si la solicitud falla
                    mostrarError('Error al obtener la API Key');
                }
            }
        };
        xhr.send();

        function mostrarResultados(apiKeyData) {
            // Muestra todos los campos y valores de la API Key
            var resultadosDiv = document.getElementById("resultados");
            resultadosDiv.innerHTML = '<h2>Resultados:</h2>';
            
            for (var key in apiKeyData) {
                resultadosDiv.innerHTML += `<p>${key}: ${apiKeyData[key]}</p>`;
            }
        }

        function mostrarError(mensaje) {
            // Muestra un mensaje de error en el elemento con id "resultados"
            var resultadosDiv = document.getElementById("resultados");
            resultadosDiv.innerHTML = `<p>Error: ${mensaje}</p>`;
        }
    </script>
</body>
</html>
