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

    <label>API Key Actual:</label>
    <span id="apiKeyActual"><!-- Aquí debe mostrar el valor de apikey del apikey.txt --></span> 
    <button onclick="modificarApiKey()">Modificar API Key</button>
    <br>
    <span id="correoActual"><!-- Aquí debe mostrar el valor de correo del apikey.txt --></span>
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
    // Espera a que el documento esté listo
    $(document).ready(function () {
        // Muestra la API Key actual al cargar la página
        mostrarApiKeyActual();

        function consultarSunat() {
            obtenerApiKeyActual(function(apiKey) {
            var ruc = document.getElementById("rucInput").value;

            if (!/^\d{11}$/.test(ruc)) {
                alert("Ingrese un número de RUC válido.");
                return;
            }

            var apiUrl = `https://api.sunat.dev/ruc-premium/${ruc}?apikey=${apiKey}`;

            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    
                    guardarEnTabla(data);
                    mostrarResultados(data);
                    cambiarStatus(data);
                },
                error: function (error) {
                    mostrarError(error);
                }
            });

            });
        }

        function validarRUC() {
            obtenerApiKeyActual(function(apiKey) {
            var ruc = document.getElementById("rucInput").value;

            if (!/^\d{11}$/.test(ruc)) {
                alert("Ingrese un número de RUC válido.");
                return;
            }

            var apiUrl = `https://api.sunat.dev/ruc/${ruc}?apikey=${apiKey}`;

            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    
                    mostrarResultadosRUC(data);
                    cambiarStatus(data);
                },
                error: function (error) {
                    mostrarError(error);
                }
            });
            });
        }
        
        // Función para mostrar la API Key
        function mostrarApiKey(apiKeyData) {
            // Actualiza el elemento con id "apiKeyActual" con la nueva API Key
            var apiKeyActualElement = document.getElementById("apiKeyActual");
            if (apiKeyActualElement) {
                apiKeyActualElement.innerText = apiKeyData.apikey;
            }

            // Muestra el correo asociado
            var correoActualElement = document.getElementById("correoActual");
            if (correoActualElement) {
                correoActualElement.innerText = apiKeyData.email;
            }

            // Cambia el fondo según el estado
            var estado = apiKeyData.status;
            if (apiKeyActualElement) {
                apiKeyActualElement.style.backgroundColor = estado === "activo" ? "green" : "red";
                apiKeyActualElement.style.color = "#fff";
                apiKeyActualElement.style.padding = "5px";
                apiKeyActualElement.style.borderRadius = "5px";
            }
        }

        // Función para obtener la API Key actual
        function obtenerApiKeyActual(callback) {
            $.ajax({
                url: 'apikey.txt',
                type: 'GET',
                success: function (data) {
                    try {
                        var apiKeyData = JSON.parse(data);
                        callback(apiKeyData.apikey);  // Llama al callback con la API key
                    } catch (error) {
                        alert("Error al parsear el contenido de apikey.txt: " + error);
                    }
                },
                error: function (error) {
                    alert("Error al cargar la API Key: " + error.responseText);
                }
            });
        }

        // Función para mostrar la API Key actual
        function mostrarApiKeyActual() {
            obtenerApiKeyActual(function(apiKey) {
                $.ajax({
                    url: 'apikey.txt',
                    type: 'GET',
                    success: function (data) {
                        // Parsea el contenido JSON del archivo apikey.txt
                        try {
                            var apiKeyData = JSON.parse(data);
                            mostrarApiKey(apiKeyData);
                        } catch (error) {
                            alert("Error al parsear el contenido de apikey.txt: " + error);
                        }
                    },
                    error: function (error) {
                        alert("Error al cargar la API Key: " + error.responseText);
                    }
                });
            });
        }

        // Función para modificar la API Key
        window.modificarApiKey = function () {
            var nuevaApiKey = prompt("Ingrese la nueva API Key:");
            var nuevoCorreo = prompt("Ingrese el nuevo correo:");
            var nuevoEstado = "activo";
            if (nuevaApiKey !== null && nuevoCorreo !== null) {
                $.ajax({
                    url: 'guardar-apikey.php',
                    type: 'POST',
                    data: { apiKey: nuevaApiKey, email: nuevoCorreo, status: nuevoEstado },
                    success: function (data) {
                        alert("API Key y correo se han actualizado correctamente.");
                        mostrarApiKeyActual();
                    },
                    error: function (xhr, status, error) {
                        alert("Error al actualizar la API Key y correo: " + xhr.responseText);
                    }
                });
            }
        };

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



        function guardarEnTabla(data) {
            if (data && data.body) {
                if (data.statusCode === 400 && data.body.errors && data.body.errors.length > 0) {
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

        function cambiarStatus(data) {
                if (data.statusCode === 403) {
                    var nuevoEstado = "inactivo";
                        $.ajax({
                            url: 'actualizar-estado.php',
                            type: 'POST',
                            data: {status: nuevoEstado},
                            success: function (data) {
                                alert("Estado actualizado correctamente.");
                                mostrarApiKeyActual();  // Actualiza la API Key mostrada
                            },
                            error: function (error) {
                                alert("Error al actualizar el status: " + error.responseText);
                            }
                        });
                } 
        } 

        function mostrarResultadosRUC(data) {
            var resultadosDiv = document.getElementById("resultados");

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
    });
    </script>
</body>
</html>
