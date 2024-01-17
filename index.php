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
    <div>
        <label>APIKEY: <span id="apikeyAPI"></span> </label>
        <label>EMAIL: <span id="emailAPI"></span> </label>
        <label>Operaciones: <span id="exitoso">0</span> + <span id="fallido">0</span> = <span id="total">0</span></label>
        <label>Créditos: <span id="creditos">0</span>/2000</label>
        <button onclick="modificarApiKey()">ModificarApiKey</button>
    </div>
    <br>
    <label id="messageAPI"></label>
    <hr>
    <br>
    <label for="rucInput">Ingrese el número de RUC:</label>
    <input type="text" id="rucInput" placeholder="Ej. 20100047218">
    <button onclick="validarRUC()">Validar RUC</button>
    <button onclick="consultarSunat()">Consultar Sunat</button>

    <div id="resultados">
        <!-- Aquí se mostrarán los resultados -->
    </div>

    <script>
    // Variable global para almacenar la API obtenida
    var apikey;
    var statusApiKey;
    var ejecucionesExitosas = 0;
    var ejecucionesFallidas = 0;
    $.ajax({
            url: 'https://nextius.net/APIKEY/api.php',
            type: 'GET',
            dataType: 'json',
            success: function (apiData) {
                // Asignar la API obtenida a la variable global
                apikey = apiData.apikey;
                statusApiKey = apiData.status;

                if (statusApiKey === "activo") {
                    $('#apikeyAPI').text(apiData.apikey).css({
                    'color': '#155724',
                    'background-color': '#d4edda',
                    'border-color': '#c3e6cb',
                    'font-size': '20px',
                    'padding': '0px 10px',
                    'border-radius': '10px'
                    });
                    $('#emailAPI').text(apiData.email).css({
                    'color': '#155724',
                    'background-color': '#d4edda',
                    'border-color': '#c3e6cb',
                    'font-size': '20px',
                    'padding': '0px 10px',
                    'border-radius': '10px'
                    });
                }
                else{
                    $('#apikeyAPI').text(apiData.apikey).css({
                    'color': '#721c24',
                    'background-color': '#f8d7da',
                    'border-color': '#f5c6cb',
                    'font-size': '20px',
                    'padding': '0px 10px',
                    'border-radius': '10px'
                    });
                    $('#emailAPI').text(apiData.email).css({
                    'color': '#721c24',
                    'background-color': '#f8d7da',
                    'border-color': '#f5c6cb',
                    'font-size': '20px',
                    'padding': '0px 10px',
                    'border-radius': '10px'
                    });
                }
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

            // Reemplazar comillas simples por guiones si el valor es una cadena
            if (typeof valor === 'string') {
                valor = valor.replace(/'/g, '-');
            }

            return valor;
    }

    function consultarSunat() {
        var ruc = document.getElementById("rucInput").value;
        $('#messageAPI').text('Cargando...');
        // Validar el formato del RUC antes de realizar la consulta
        if (!/^\d{11}$/.test(ruc)) {
            alert("Ingrese un número de RUC válido.");
            return;
        }

        var apiUrl = `https://api.sunat.dev/ruc-premium/${ruc}?apikey=${apikey}`;

        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // La API respondió correctamente
                console.log(data);
                
                var statusCode = data.statusCode;
                var messageElement = $('#messageAPI');

                if (statusCode === 200) {
                  messageElement.text('Respuesta Exitosa').css({
                    'color': '#155724',
                    'background-color': '#d4edda',
                    'border-color': '#c3e6cb',
                    'font-size': '20px',
                    'padding': '0px 10px',
                    'border-radius': '10px'
                    });

                  ejecucionesExitosas++;
                  actualizarEjecuciones();
                  //guardarEnTabla(data);
                  mostrarResultados(data);
                } 
                else if (statusCode === 400) {
                  messageElement.text('Inténtalo de nuevo, revisa tu apikey o RUC').css({
                    'color': '#856404',
                    'background-color': '#fff3cd',
                    'border-color': '#ffeeba',
                    'font-size': '20px',
                    'padding': '0px 10px',
                    'border-radius': '10px'
                    });
                  ejecucionesFallidas++;
                  actualizarEjecuciones();
                } 
                else if (statusCode === 403) {
                  messageElement.text('Límite de peticiones').css({
                    'color': '#721c24',
                    'background-color': '#f8d7da',
                    'border-color': '#f5c6cb',
                    'font-size': '20px',
                    'padding': '0px 10px',
                    'border-radius': '10px'
                  });
                  var url = `https://nextius.net/APIKEY/api.php/?status=inactivo`;
                    $.ajax({
                        url: url,
                        type: 'GET',  // Puedes cambiar a 'POST' si es necesario
                        success: function (data) {
                            alert("Actualice tu APIKEY, dado que el actual ya está inactivo");
                            // Puedes agregar aquí cualquier lógica adicional después de la actualización

                        },
                        error: function (xhr, status, error) {
                            alert("No se ha actualizado el estado de apikey a Inactivo: " + xhr.responseText);
                        }
                    });
                } 
                else {
                  messageElement.text('Error Desconocido').css({'background-color': 'black', 'color': 'white'});
                }
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

        var apiUrl = `https://api.sunat.dev/ruc/${ruc}?apikey=${apikey}`;

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

    window.modificarApiKey = function () {
        var nuevaApiKey = prompt("Ingrese la nueva API Key:");
        var nuevoCorreo = prompt("Ingrese el nuevo correo:");
        var nuevoEstado = "activo";

        if (nuevaApiKey !== null && nuevoCorreo !== null) {
            var url = `https://nextius.net/APIKEY/api.php/?apikey=${nuevaApiKey}&email=${nuevoCorreo}&status=${nuevoEstado}`;

            $.ajax({
                url: url,
                type: 'GET',  // Puedes cambiar a 'POST' si es necesario
                success: function (data) {
                    alert("API Key y correo se han actualizado correctamente.");
                    // Puedes agregar aquí cualquier lógica adicional después de la actualización

                },
                error: function (xhr, status, error) {
                    alert("Error al actualizar la API Key y correo: " + xhr.responseText);
                }
            });
        }
    };

    function actualizarResultados() {
      // Actualizar el contenido de los elementos HTML con los resultados
      $('#exitoso').text(ejecucionesExitosas);
      $('#fallido').text(ejecucionesFallidas);
      $('#total').text(ejecucionesExitosas + ejecucionesFallidas);
      $('#creditos').text(2000-75*(ejecucionesExitosas + ejecucionesFallidas));
    }
    function mostrarError(error) {
    var resultadosDiv = document.getElementById("resultados");
    resultadosDiv.innerHTML = `<p>Error al consultar la API: ${error.responseText}</p>`;
    }

</script>
</body>
</html>
