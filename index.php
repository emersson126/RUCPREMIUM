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
        // Mueve la definición de obtenerValor fuera de guardarEnTabla
        function obtenerValor(objeto, ruta, predeterminado = null) {
            const propiedades = ruta.split('.');
            let valor = objeto;
            for (const propiedad of propiedades) {
                if (valor && typeof valor === 'object' && propiedad in valor) {
                    valor = valor[propiedad];
                } else {
                    return predeterminado;
                }
            }
            return valor;
        }

        function consultarSunat() {
            var ruc = document.getElementById("rucInput").value;
            
            // Validar el formato del RUC antes de realizar la consulta
            if (!/^\d{11}$/.test(ruc)) {
                alert("Ingrese un número de RUC válido.");
                return;
            }

            var apiUrl = `https://api.sunat.dev/ruc-premium/${ruc}?apikey=hmWkX8YV2qNsp2keZUW3R4tnb3mqOUWfexjzIucOdvfhnU6pmMJGXcO2RqTWMIQC`;

            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // La API respondió correctamente
                    console.log(data);
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
            if (data && data.body) {
                $.ajax({
                    url: 'https://nextius.net/RUC/guardarEnTabla.php',
                    type: 'POST',
                    data: {
                        statusCode: obtenerValor(data, 'statusCode'),
                        numeroRuc: obtenerValor(data.body, 'numeroRuc'),
                        codDomHabido: obtenerValor(data.body.datosContribuyente, 'codDomHabido', ''),
                        numTelefono1: obtenerValor(data.body.datosContribuyente.contacto, 'numTelefono1', ''),
                        numTelefono2: obtenerValor(data.body.datosContribuyente.contacto, 'numTelefono2', ''),
                        numTelefono3: obtenerValor(data.body.datosContribuyente.contacto, 'numTelefono3', ''),
                        desRazonSocial: obtenerValor(data.body.datosContribuyente, 'desRazonSocial', ''),
                        codUbigeo: obtenerValor(data.body.datosContribuyente.ubigeo, 'codUbigeo', ''),
                        desDistrito: obtenerValor(data.body.datosContribuyente.ubigeo, 'desDistrito', ''),
                        desProvincia: obtenerValor(data.body.datosContribuyente.ubigeo, 'desProvincia', ''),
                        desDepartamento: obtenerValor(data.body.datosContribuyente.ubigeo, 'desDepartamento', ''),
                        desDireccion: obtenerValor(data.body.datosContribuyente, 'desDireccion', ''),
                        desNomApe: obtenerValor(data.body.datosContribuyente, 'desNomApe', ''),
                        codCorreo2: obtenerValor(data.body.datosContribuyente, 'codCorreo2', ''),
                        codCorreo1: obtenerValor(data.body.datosContribuyente, 'codCorreo1', ''),
                        codEstado: obtenerValor(data.body.datosContribuyente, 'codEstado', ''),
                        nombreComercial: obtenerValor(data.body, 'nombreComercial', ''),
                        actividadEconomica_primaria: obtenerValor(data.body, 'actividadEconomica.0', ''),
                        actividadEconomica_secundaria: obtenerValor(data.body, 'actividadEconomica.1', ''),
                        sistemaEmisionElectronica_factura: obtenerValor(data.body, 'sistemaEmisionElectronica.0', ''),
                        sistemaEmisionElectronica_boleta: obtenerValor(data.body, 'sistemaEmisionElectronica.1', ''),
                        sistemaEmisionElectronica_verificador: obtenerValor(data.body, 'sistemaEmisionElectronica.2', ''),
                        padrones: obtenerValor(data.body, 'padrones.0', ''),
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.error("Error al guardar en la tabla: " + error.responseText);
                    }
                });
            } else {
                console.error("Error: Estructura de datos incorrecta");
            }
        }

        function mostrarResultados(data) {
            var resultadosDiv = document.getElementById("resultados");
            resultadosDiv.innerHTML = `<p>Estado: ${obtenerValor(data, 'statusCode')}</p>`;
            resultadosDiv.innerHTML += `<p>RUC: ${obtenerValor(data.body, 'numeroRuc')}</p>`;
            resultadosDiv.innerHTML += `<h1>DATOS DEL CONTRIBUYENTE</h1>`;
            resultadosDiv.innerHTML += `<p>codDomHabido: ${obtenerValor(data.body.datosContribuyente, 'codDomHabido', '')}</p>`;
            
            // Verificar si 'contacto' es nulo antes de acceder a sus propiedades
            if (data.body.datosContribuyente.contacto) {
                resultadosDiv.innerHTML += `<p>CONTACTO</p>`;
                resultadosDiv.innerHTML += `<p>numTelefono1: ${obtenerValor(data.body.datosContribuyente.contacto, 'numTelefono1', '')}</p>`;
                resultadosDiv.innerHTML += `<p>numTelefono2: ${obtenerValor(data.body.datosContribuyente.contacto, 'numTelefono2', '')}</p>`;
                resultadosDiv.innerHTML += `<p>numTelefono3: ${obtenerValor(data.body.datosContribuyente.contacto, 'numTelefono3', '')}</p>`;
            }

            resultadosDiv.innerHTML += `<p>Razón Social: ${obtenerValor(data.body.datosContribuyente, 'desRazonSocial', '')}</p>`;
            resultadosDiv.innerHTML += `<p>UBIGEO</p>`;
            resultadosDiv.innerHTML += `<p>codUbigeo: ${obtenerValor(data.body.datosContribuyente.ubigeo, 'codUbigeo', '')}</p>`;
            resultadosDiv.innerHTML += `<p>desDistrito: ${obtenerValor(data.body.datosContribuyente.ubigeo, 'desDistrito', '')}</p>`;
            resultadosDiv.innerHTML += `<p>desProvincia: ${obtenerValor(data.body.datosContribuyente.ubigeo, 'desProvincia', '')}</p>`;
            resultadosDiv.innerHTML += `<p>desDepartamento: ${obtenerValor(data.body.datosContribuyente.ubigeo, 'desDepartamento', '')}</p>`;
            resultadosDiv.innerHTML += `<p>desDireccion: ${obtenerValor(data.body.datosContribuyente, 'desDireccion', '')}</p>`;
            resultadosDiv.innerHTML += `<p>desNomApe: ${obtenerValor(data.body.datosContribuyente, 'desNomApe', '')}</p>`;
            resultadosDiv.innerHTML += `<p>codCorreo2: ${obtenerValor(data.body.datosContribuyente, 'codCorreo2', '')}</p>`;
            resultadosDiv.innerHTML += `<p>codCorreo1: ${obtenerValor(data.body.datosContribuyente, 'codCorreo1', '')}</p>`;
            resultadosDiv.innerHTML += `<p>codEstado: ${obtenerValor(data.body.datosContribuyente, 'codEstado', '')}</p>`;
            resultadosDiv.innerHTML += `<p>nombreComercial: ${obtenerValor(data.body, 'nombreComercial', '')}</p>`;
            resultadosDiv.innerHTML += `<p>ACTIVIDAD ECONÓMICA</p>`;
            resultadosDiv.innerHTML += `<p>Primaria: ${obtenerValor(data.body, 'actividadEconomica.0', '')}</p>`;
            resultadosDiv.innerHTML += `<p>Secundaria: ${obtenerValor(data.body, 'actividadEconomica.1', '')}</p>`;
            resultadosDiv.innerHTML += `<p>Emision Electrónica</p>`;
            resultadosDiv.innerHTML += `<p>Inicio: ${obtenerValor(data.body, 'sistemaEmisionElectronica.0', '')}</p>`;
            resultadosDiv.innerHTML += `<p>Medio: ${obtenerValor(data.body, 'sistemaEmisionElectronica.1', '')}</p>`;
            resultadosDiv.innerHTML += `<p>Autorizado: ${obtenerValor(data.body, 'sistemaEmisionElectronica.2', '')}</p>`;
            resultadosDiv.innerHTML += `<p>Padrones: ${obtenerValor(data.body, 'padrones.0', '')}</p>`;
            console.log(resultadosDiv);
            // Agrega más información según tus necesidades
        }

        function mostrarError(error) {
            var resultadosDiv = document.getElementById("resultados");
            resultadosDiv.innerHTML = `<p>Error al consultar la API: ${error.responseText}</p>`;
        }
    </script>

</body>
</html>
