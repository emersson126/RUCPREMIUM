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
            function guardarEnTabla(data) {
                $.ajax({
                    url: 'guardarEnTabla.php', // Ruta al archivo PHP creado
                    type: 'POST',
                    data: {
                        statusCode: data.statusCode,
                        numeroRuc: data.body.numeroRuc,
                        codDomHabido: data.body.datosContribuyente.codDomHabido,

                        numTelefono1: data.body.datosContribuyente.contacto.numTelefono1,
                        numTelefono2: data.body.datosContribuyente.contacto.numTelefono2,
                        numTelefono3: data.body.datosContribuyente.contacto.numTelefono3,

                        desRazonSocial: data.body.datosContribuyente.desRazonSocial,

                        codUbigeo: data.body.datosContribuyente.ubigeo.codUbigeo,
                        desDistrito: data.body.datosContribuyente.ubigeo.desDistrito,
                        desProvincia: data.body.datosContribuyente.ubigeo.desProvincia,
                        desDepartamento: data.body.datosContribuyente.ubigeo.desDepartamento,

                        desDireccion: data.body.datosContribuyente.desDireccion,
                        desNomApe: data.body.datosContribuyente.desNomApe,
                        codCorreo2: data.body.datosContribuyente.codCorreo2,
                        codCorreo1: data.body.datosContribuyente.codCorreo1,
                        codEstado: data.body.datosContribuyente.codEstado,

                        nombreComercial: data.body.nombreComercial,
                        actividadEconomica_primaria: data.body.actividadEconomica[0],
                        actividadEconomica_secundaria: data.body.actividadEconomica[1],
                        sistemaEmisionElectronica_factura: data.body.sistemaEmisionElectronica[0],
                        sistemaEmisionElectronica_boleta: data.body.sistemaEmisionElectronica[1],
                        sistemaEmisionElectronica_verificador: data.body.sistemaEmisionElectronica[2],
                        padrones: data.body.padrones[0],
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.error("Error al guardar en la tabla: " + error.responseText);
                    }
                });
            }
        }
        function mostrarResultados(data) {
            // Muestra los resultados en el elemento con id "resultados"
            var resultadosDiv = document.getElementById("resultados");
            resultadosDiv.innerHTML = `<p>Estado: ${data.statusCode}</p>`; //200
            resultadosDiv.innerHTML += `<p>RUC: ${data.body.numeroRuc}</p>`; //20100047218
            resultadosDiv.innerHTML += `<h1>DATOS DEL CONTRIBUYENTE</h1>`; 
            resultadosDiv.innerHTML += `<p>codDomHabido: ${data.body.datosContribuyente.codDomHabido}</p>`; //HABIDO
            resultadosDiv.innerHTML += `<p>CONTACTO</p>`;
            resultadosDiv.innerHTML += `<p>numTelefono1: ${data.body.datosContribuyente.contacto.numTelefono1}</p>`; //3132122
            resultadosDiv.innerHTML += `<p>numTelefono2: ${data.body.datosContribuyente.contacto.numTelefono2}</p>`; //3132000
            resultadosDiv.innerHTML += `<p>numTelefono3: ${data.body.datosContribuyente.contacto.numTelefono3}</p>`; //999658578
            resultadosDiv.innerHTML += `<p>Razón Social: ${data.body.datosContribuyente.desRazonSocial}</p>`;
            resultadosDiv.innerHTML += `<p>UBIGEO</p>`;
            resultadosDiv.innerHTML += `<p>codUbigeo: ${data.body.datosContribuyente.ubigeo.codUbigeo}</p>`; //150114
            resultadosDiv.innerHTML += `<p>desDistrito: ${data.body.datosContribuyente.ubigeo.desDistrito}</p>`; //LA MOLINA
            resultadosDiv.innerHTML += `<p>desProvincia: ${data.body.datosContribuyente.ubigeo.desProvincia}</p>`; //LIMA
            resultadosDiv.innerHTML += `<p>desDepartamento: ${data.body.datosContribuyente.ubigeo.desDepartamento}</p>`; //LIMA
            resultadosDiv.innerHTML += `<p>desDireccion: ${data.body.datosContribuyente.desDireccion}</p>`; //CAL. CENTENARIO NRO. 156 LAS LADERAS DE MELGAREJO
            resultadosDiv.innerHTML += `<p>desNomApe: ${data.body.datosContribuyente.desNomApe}</p>`; //BANCO DE CREDITO DEL PERU
            resultadosDiv.innerHTML += `<p>codCorreo2: ${data.body.datosContribuyente.codCorreo2}</p>`; //jmunoz@bcp.com.pe
            resultadosDiv.innerHTML += `<p>codCorreo1: ${data.body.datosContribuyente.codCorreo1}</p>`; //vchang@bcp.com.pe
            resultadosDiv.innerHTML += `<p>codEstado: ${data.body.datosContribuyente.codEstado}</p>`; //ACTIVO
            resultadosDiv.innerHTML += `<p>nombreComercial: ${data.body.nombreComercial}</p>`; //BANCO DE CREDITO DEL PERU
            resultadosDiv.innerHTML += `<p>ACTIVIDAD ECONÓMICA</p>`;
            resultadosDiv.innerHTML += `<p>Primaria: ${data.body.actividadEconomica[0]}</p>`; //Principal - CIIU 65197 - OTROS TIPOS INTERMEDIACION MONETARIA.
            resultadosDiv.innerHTML += `<p>Secundaria: ${data.body.actividadEconomica[1]}</p>`; //Secundaria 1 - CIIU 65912 - ARRENDAMIENTO CON OPCION DE COMPRA
            resultadosDiv.innerHTML += `<p>Emision Electrónica</p>`;
            resultadosDiv.innerHTML += `<p>Inicio: ${data.body.sistemaEmisionElectronica[0]}</p>`; //FACTURA PORTAL DESDE 26/11/2014
            resultadosDiv.innerHTML += `<p>Medio: ${data.body.sistemaEmisionElectronica[1]}</p>`; //DESDE LOS SISTEMAS DEL CONTRIBUYENTE.DESDE 30/01/2018
            resultadosDiv.innerHTML += `<p>Autorizado: ${data.body.sistemaEmisionElectronica[2]}</p>`; //SEE-FACTURADOR . AUTORIZ DESDE 09/11/2017
            resultadosDiv.innerHTML += `<p>Padrones: ${data.body.padrones[0]}</p>`; //"Incorporado al Régimen de Agentes de Retención de IGV (R.S.037-2002) 
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
