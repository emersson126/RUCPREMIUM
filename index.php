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

    <label id="apikeyAPI"></label>
    <label id="emailAPI"></label>
    <label id="statusAPI"></label>

    <label for="rucInput">Ingrese el número de RUC:</label>
    <input type="text" id="rucInput" placeholder="Ej. 20100047218">
    <button onclick="validarRUC()">Validar RUC</button>
    <button onclick="consultarSunat()">Consultar Sunat</button>

    <div id="resultados">
        <!-- Aquí se mostrarán los resultados -->
    </div>

    <script>
    $.ajax({
            url: 'https://nextius.net/APIKEY/api.php',
            type: 'GET',
            dataType: 'json',
            success: function (apiData) {
                // Mostrar datos obtenidos en los labels
                $('#apikeyAPI').text('API Key: ' + apiData.apikey);
                $('#emailAPI').text('Email: ' + apiData.email);
                $('#statusAPI').text('Status: ' + apiData.status);
            },
            error: function (error) {
                console.error("Error al obtener datos de la API: " + error.responseText);
            }
        });
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

    function validarRUC() {
        var ruc = document.getElementById("rucInput").value;
        
        // Validar el formato del RUC antes de realizar la consulta
        if (!/^\d{11}$/.test(ruc)) {
            alert("Ingrese un número de RUC válido.");
            return;
        }

        var apiUrl = `https://api.sunat.dev/ruc/${ruc}?apikey=hmWkX8YV2qNsp2keZUW3R4tnb3mqOUWfexjzIucOdvfhnU6pmMJGXcO2RqTWMIQC`;

        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // La API respondió correctamente
                console.log(data);
                mostrarResultadosRUC(data);
            },
            error: function (error) {
                // La API respondió con error
                mostrarError(error);
            }
        });
    }

    function guardarEnTabla(data) {
        if (data && data.body) {
            if (data.statusCode === 400 && data.body.errors && data.body.errors.length > 0) {
                // Manejar errores específicos de la API
                var errorMessage = data.body.errors[0].message;
                console.error(`Error en la respuesta de la API: ${errorMessage}`);
            } else {
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
            }
        } else {
            console.error("Error: Estructura de datos incorrecta");
        }
    }

    function mostrarResultadosRUC(data) {
        var resultadosDiv = document.getElementById("resultados");
        
        // Verificar si hay un error específico en la respuesta
        if (data.statusCode === 400 && data.body.errors && data.body.errors.length > 0) {
            var errorMessage = data.body.errors[0].message;
            resultadosDiv.innerHTML = `<p>Error en la respuesta de la API: ${errorMessage}</p>`;
        } else {
            resultadosDiv.innerHTML = `<p>Estado: ${data.statusCode}</p>`;
            resultadosDiv.innerHTML += `<p>RUC: ${data.body.numeroRuc}</p>`;
            resultadosDiv.innerHTML += `<h1>DATOS DEL CONTRIBUYENTE</h1>`;
            resultadosDiv.innerHTML += `<p>Razón Social: ${data.body.datosContribuyente ? data.body.datosContribuyente.desRazonSocial : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desNomApe: ${data.body.datosContribuyente ? data.body.datosContribuyente.desNomApe : ''}</p>`;
            resultadosDiv.innerHTML += `<p>UBIGEO</p>`;
            resultadosDiv.innerHTML += `<p>codUbigeo: ${data.body.datosContribuyente && data.body.datosContribuyente.ubigeo ? data.body.datosContribuyente.ubigeo.codUbigeo : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desDistrito: ${data.body.datosContribuyente && data.body.datosContribuyente.ubigeo ? data.body.datosContribuyente.ubigeo.desDistrito : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desProvincia: ${data.body.datosContribuyente && data.body.datosContribuyente.ubigeo ? data.body.datosContribuyente.ubigeo.desProvincia : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desDepartamento: ${data.body.datosContribuyente && data.body.datosContribuyente.ubigeo ? data.body.datosContribuyente.ubigeo.desDepartamento : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desDireccion: ${data.body.datosContribuyente ? data.body.datosContribuyente.desDireccion : ''}</p>`;
            resultadosDiv.innerHTML += `<p>codEstado: ${data.body.datosContribuyente ? data.body.datosContribuyente.codEstado : ''}</p>`;
            resultadosDiv.innerHTML += `<p>codDomHabido: ${data.body.datosContribuyente ? data.body.datosContribuyente.codDomHabido : ''}</p>`;
        }

        console.log(resultadosDiv);
    }

    function mostrarResultados(data) {
        var resultadosDiv = document.getElementById("resultados");
        
        // Verificar si hay un error específico en la respuesta
        if (data.statusCode === 400 && data.body.errors && data.body.errors.length > 0) {
            var errorMessage = data.body.errors[0].message;
            resultadosDiv.innerHTML = `<p>Error en la respuesta de la API: ${errorMessage}</p>`;
        } else {
            resultadosDiv.innerHTML = `<p>Estado: ${data.statusCode}</p>`;
            resultadosDiv.innerHTML += `<p>RUC: ${data.body.numeroRuc}</p>`;
            resultadosDiv.innerHTML += `<h1>DATOS DEL CONTRIBUYENTE</h1>`;
            resultadosDiv.innerHTML += `<p>codDomHabido: ${data.body.datosContribuyente ? data.body.datosContribuyente.codDomHabido : ''}</p>`;
            
            if (data.body.datosContribuyente && data.body.datosContribuyente.contacto) {
                resultadosDiv.innerHTML += `<p>CONTACTO</p>`;
                resultadosDiv.innerHTML += `<p>numTelefono1: ${data.body.datosContribuyente.contacto.numTelefono1 || ''}</p>`;
                resultadosDiv.innerHTML += `<p>numTelefono2: ${data.body.datosContribuyente.contacto.numTelefono2 || ''}</p>`;
                resultadosDiv.innerHTML += `<p>numTelefono3: ${data.body.datosContribuyente.contacto.numTelefono3 || ''}</p>`;
            }

            resultadosDiv.innerHTML += `<p>Razón Social: ${data.body.datosContribuyente ? data.body.datosContribuyente.desRazonSocial : ''}</p>`;
            resultadosDiv.innerHTML += `<p>UBIGEO</p>`;
            resultadosDiv.innerHTML += `<p>codUbigeo: ${data.body.datosContribuyente && data.body.datosContribuyente.ubigeo ? data.body.datosContribuyente.ubigeo.codUbigeo : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desDistrito: ${data.body.datosContribuyente && data.body.datosContribuyente.ubigeo ? data.body.datosContribuyente.ubigeo.desDistrito : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desProvincia: ${data.body.datosContribuyente && data.body.datosContribuyente.ubigeo ? data.body.datosContribuyente.ubigeo.desProvincia : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desDepartamento: ${data.body.datosContribuyente && data.body.datosContribuyente.ubigeo ? data.body.datosContribuyente.ubigeo.desDepartamento : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desDireccion: ${data.body.datosContribuyente ? data.body.datosContribuyente.desDireccion : ''}</p>`;
            resultadosDiv.innerHTML += `<p>desNomApe: ${data.body.datosContribuyente ? data.body.datosContribuyente.desNomApe : ''}</p>`;
            resultadosDiv.innerHTML += `<p>codCorreo2: ${data.body.datosContribuyente ? data.body.datosContribuyente.codCorreo2 : ''}</p>`;
            resultadosDiv.innerHTML += `<p>codCorreo1: ${data.body.datosContribuyente ? data.body.datosContribuyente.codCorreo1 : ''}</p>`;
            resultadosDiv.innerHTML += `<p>codEstado: ${data.body.datosContribuyente ? data.body.datosContribuyente.codEstado : ''}</p>`;
            resultadosDiv.innerHTML += `<p>nombreComercial: ${data.body ? data.body.nombreComercial : ''}</p>`;
            resultadosDiv.innerHTML += `<p>ACTIVIDAD ECONÓMICA</p>`;
            resultadosDiv.innerHTML += `<p>Primaria: ${data.body && data.body.actividadEconomica ? data.body.actividadEconomica[0] : ''}</p>`;
            resultadosDiv.innerHTML += `<p>Secundaria: ${data.body && data.body.actividadEconomica ? data.body.actividadEconomica[1] : ''}</p>`;
            resultadosDiv.innerHTML += `<p>Emisión Electrónica</p>`;
            resultadosDiv.innerHTML += `<p>Inicio: ${data.body && data.body.sistemaEmisionElectronica ? data.body.sistemaEmisionElectronica[0] : ''}</p>`;
            resultadosDiv.innerHTML += `<p>Medio: ${data.body && data.body.sistemaEmisionElectronica ? data.body.sistemaEmisionElectronica[1] : ''}</p>`;
            resultadosDiv.innerHTML += `<p>Autorizado: ${data.body && data.body.sistemaEmisionElectronica ? data.body.sistemaEmisionElectronica[2] : ''}</p>`;
            resultadosDiv.innerHTML += `<p>Padrones: ${data.body ? data.body.padrones[0] : ''}</p>`;
        }

        console.log(resultadosDiv);
    }
    function mostrarError(error) {
    var resultadosDiv = document.getElementById("resultados");
    resultadosDiv.innerHTML = `<p>Error al consultar la API: ${error.responseText}</p>`;
    }

</script>
</body>
</html>
