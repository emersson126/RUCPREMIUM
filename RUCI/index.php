 <?php
            // Incluir el archivo de conexión
            require_once('connection.php');

            // SQL para seleccionar el apikey y el email del registro con id 1
            $sql = "SELECT apikey, email, credits, register FROM apikeys WHERE id = 1";
            $resultado = $conexion->query($sql);

            // Inicializar variables
            $apikey_value = "";
            $email_value = "";
            $register_value = "";
            $credits_value = "";

            // Verificar si encontró resultados
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $apikey_value = $fila["apikey"];
                $email_value = $fila["email"];
                $register_value = $fila["register"];
                $credits_value = $fila["credits"];
                $credits_valuepro = $credits_value;

                // Obtener la fecha actual
                $fecha_actual = new DateTime();

                // Convertir la fecha almacenada en $register_value a un objeto DateTime
                $fecha_registro = new DateTime($register_value);

                // Obtener la fecha del primer día del siguiente mes a partir de la fecha almacenada
                $fecha_siguiente_mes = clone $fecha_registro;
                $fecha_siguiente_mes->modify('first day of next month');

                // Calcular la diferencia en días
                $diferencia_dias = $fecha_siguiente_mes->diff($fecha_actual)->days;

                // Formatear las fechas para mostrarlas en el formato deseado
                $fecha_siguiente_mes_formateada = $fecha_siguiente_mes->format('d/m/Y');
                $fecha_actual_formateada = $fecha_actual->format('d/m/Y');

            }
            $conexion->close();
            ?>
<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="">
    <meta charset="utf-8">
    <meta name="author" content="nextius">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Datos públicos de SUNAT, puedes consultar de forma gratuita e incluso descargar información 20606310375, puedes crear una nueva API, en el siguiente Link">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>SUNAT CONSULTA GRATUITA</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="./assets/css/dashlite.css?ver=3.2.3">
    <link id="skin-default" rel="stylesheet" href="./assets/css/theme.css?ver=3.2.3">
    <style type="text/css">
        .green{
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            font-size: 15px;
            padding: 0px 10px;
            border-radius: 5px;
        }
        .yellow{
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
            font-size: 15px;
            padding: 0px 10px;
            border-radius: 5px;
        }
        .red{
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            font-size: 15px;
            padding: 0px 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body class="nk-body bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger me-sm-2 d-lg-none">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand">
                            <a href="#" class="logo-link">
                                <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div><!-- .nk-header-brand -->
                        
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                        <div class="quick-icon border border-light">
                                            <img class="icon" src="./images/flags/peru.png" alt="">
                                        </div>
                                    </a>
                                </li><!-- .dropdown -->
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <div class="user-toggle">
                                            <a href="https://nextius.com/contacto" target="_blank">
                                            <div class="user-avatar sm" style="    background: #0ab98a !important;">
                                                <em class="icon ni icon ni ni-whatsapp"></em>
                                            </div>
                                            </a>
                                        </div>
                                    </a>
                                </li><!-- .dropdown -->
                            </ul><!-- .nk-quick-nav -->
                        </div><!-- .nk-header-tools -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->
            
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="components-preview wide-lg mx-auto">
                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h4 class="title nk-block-title">CONSULTA SUNAT GRATUITA</h4>
                                            <div class="nk-block-des">
                                                <p>Datos públicos de SUNAT, puedes consultar de forma gratuita e incluso descargar información 20606310375, puedes crear una nueva API, en el siguiente <a target="_blank" href="https://sunat.dev/register">Link</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <div class="preview-block">
                                                <span class="preview-title-lg overline-title">DATOS DE SUNAT</span><span id="messageruc"></span>
                                                <div class="row gy-4">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">REGISTRO ÚNICO DEL CONTRIBUYENTE RUC</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" required class="form-control focus" id="ruc0" placeholder="Ingrese el RUC" pattern="[0-9]*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span class="preview-title overline-title"><em class="icon ni ni-wallet-out"></em> PREMIUM (75) | LITE (3) CRÉDITOS</span>
                                                        <a href="#" onclick="validarRUC()" class="btn btn-lg btn-primary">CONSULTA RUC</a>
                                                        <a href="#" onclick="validarRUClite()" class="btn btn-dim btn-lg btn-primary">LITE</a>

                                                    </div>
                                                    <script>
                                                        document.getElementById('ruc0').addEventListener('input', function(event) {
                                                            // Obtener el valor actual del campo
                                                            var inputValue = event.target.value;
                                                            
                                                            // Eliminar cualquier carácter que no sea un número
                                                            var sanitizedValue = inputValue.replace(/\D/g, '');
                                                            
                                                            // Actualizar el valor del campo con solo números
                                                            event.target.value = sanitizedValue;
                                                        });
                                                        function validarRUC() {
                                                            // Obtener el valor del RUC ingresado por el usuario
                                                            var ruc = document.getElementById('ruc0').value;
                                                            
                                                            // Validar que el RUC no esté vacío y que tenga la estructura correcta
                                                            var rucRegex = /^(10|20)\d{9}$/; 
                                                            // Expresión regular para validar RUC (debe empezar con 10 o 20 y tener 11 dígitos en total)

                                                            setTimeout(function() {
                                                                        var messageElement = document.getElementById('ruc0');
                                                                        messageElement.classList.remove('red');
                                                                        messageElement.classList.remove('green');
                                                                    }, 5000);

                                                            if (ruc.trim() === '' || !rucRegex.test(ruc)) {
                                                                var messageElement = document.getElementById('ruc0');
                                                                messageElement.classList.add('red');
                                                            }
                                                            else{
                                                                var messageElement = document.getElementById('ruc0');
                                                                messageElement.classList.remove('red');
                                                                messageElement.classList.add('green');

                                                            // URL base de la API de SUNAT
                                                            var apiUrl = 'https://api.sunat.dev/ruc-premium/';
                                                    
                                                            // Construir la URL completa con el RUC ingresado
                                                            var fullUrl = apiUrl + ruc + '?apikey=<?php echo $apikey_value; ?>';
                                                    
                                                            // Realizar la consulta a la API
                                                            fetch(fullUrl)
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                    // Manejar la respuesta de la API
                                                                    console.log(data);
                                                                    var status = data.statusCode;

                                                                    if (status === 200) {

                                                                        // Actualizar los valores de longitud y latitud en el iframe
                                                                        var numeroRuc = data.body.numeroRuc;
                                                                        var codDomHabido = data.body.datosContribuyente.codDomHabido; 
                                                                        var codEstado = data.body.datosContribuyente.codEstado;
                                                                        var desRazonSocial = data.body.datosContribuyente.desRazonSocial;
                                                                        var nombreComercial = data.body.nombreComercial;
                                                                        var desDireccion = data.body.datosContribuyente.desDireccion;
                                                                        var desDistrito = data.body.datosContribuyente.ubigeo.desDistrito;
                                                                        var desProvincia = data.body.datosContribuyente.ubigeo.desProvincia;
                                                                        var desDepartamento = data.body.datosContribuyente.ubigeo.desDepartamento;
                                                                        var numTelefono1 = data.body.datosContribuyente.contacto.numTelefono1;
                                                                        var numTelefono2 = data.body.datosContribuyente.contacto.numTelefono2;
                                                                        var numTelefono3 = data.body.datosContribuyente.contacto.numTelefono3;
                                                                        var codCorreo1 = data.body.datosContribuyente.codCorreo1;
                                                                        var codCorreo2 = data.body.datosContribuyente.codCorreo2;
                                                                        var actividadEconomica1 = data.body.actividadEconomica[0];
                                                                        var actividadEconomica2 = data.body.actividadEconomica[1];
                                                                        var sistemaEmisionElectronica = `${data.body.sistemaEmisionElectronica.join(', ')}`;
                                                                        var padrones = data.body.padrones[0];
                                                                        var tipoConsulta = "PREMIUM";

                                                                        // Asignar valores a las variables
                                                                        document.getElementById('numeroRuc').value = numeroRuc;
                                                                        document.getElementById('estados').value = `${codDomHabido} - ${codEstado}`;
                                                                        document.getElementById('desRazonSocial').value = desRazonSocial;
                                                                        document.getElementById('nombreComercial').value = nombreComercial;
                                                                        document.getElementById('desDireccion').value = desDireccion;
                                                                        document.getElementById('ubigeo').value = `${desDistrito}, ${desProvincia}, ${desDepartamento}`;
                                                                        document.getElementById('telefonos').value = `${numTelefono1}, ${numTelefono2}, ${numTelefono3}`;
                                                                        document.getElementById('emails').value = `${codCorreo1}, ${codCorreo2}`;
                                                                        document.getElementById('actividadEconomica1').value = actividadEconomica1;
                                                                        document.getElementById('actividadEconomica2').value = actividadEconomica2;
                                                                        document.getElementById('sistemaEmisionElectronica').value = sistemaEmisionElectronica;
                                                                        document.getElementById('padrones').value = padrones;

                                                                        var url0 = `https://h.albato.com/wh/38/1lfvf5g/pZyIxOG57W6F9lhHdEr32Lvx1H_Xe-AkOy2R7gBOpP0/?numeroRuc=${numeroRuc}&codDomHabido=${codDomHabido}&codEstado=${codEstado}&desRazonSocial=${desRazonSocial}&nombreComercial=${nombreComercial}&desDireccion=${desDireccion}&desDistrito=${desDistrito}&desProvincia=${desProvincia}&desDepartamento=${desDepartamento}&numTelefono1=${numTelefono1}&numTelefono2=${numTelefono2}&numTelefono3=${numTelefono3}&codCorreo1=${codCorreo1}&codCorreo2=${codCorreo2}&actividadEconomica1=${actividadEconomica1}&actividadEconomica2=${actividadEconomica2}&sistemaEmisionElectronica=${sistemaEmisionElectronica}&padrones=${padrones}&tipoConsulta=${tipoConsulta}`;

                                                                        var urlwebhook0 = url0.replaceAll(" ", "%20");
                                                                        console.log(urlwebhook0);

                                                                        // Enviar los datos a través de webhook
                                                                        enviarDatosPorWebhookruc(urlwebhook0);

                                                                         // Actualizar los créditos en la base de datos mediante una solicitud HTTP a PHP
                                                                        // Definir el valor de aumento
                                                                        var aumento = 75;
                                                                        fetch('actualizarCreditos.php', {
                                                                            method: 'POST',
                                                                            headers: {
                                                                                'Content-Type': 'application/json'
                                                                            },
                                                                            body: JSON.stringify({
                                                                                aumento: aumento  // Incremento de créditos
                                                                            })
                                                                        })
                                                                        .then(response => {
                                                                            if (!response.ok) {
                                                                                throw new Error('Error al actualizar los créditos');
                                                                            }
                                                                            return response.text(); // Leer el cuerpo de la respuesta
                                                                        })
                                                                        .then(data => {
                                                                            console.log('Respuesta del servidor:', data); // Mostrar la respuesta del servidor en la consola
                                                                        })
                                                                        .catch(error => {
                                                                            console.error('Error al actualizar los créditos:', error);
                                                                        });

                                                                    }else if (status === 400) {
                                                                        // Mostrar un mensaje de error
                                                                        var messageElement = document.getElementById('messageruc');
                                                                        messageElement.innerText = 'Intenta nuevamente!';
                                                                        messageElement.classList.add('yellow');

                                                                    } else if (status === 403) {
                                                                        // Mostrar un mensaje de error
                                                                        var messageElement = document.getElementById('messageruc');
                                                                        messageElement.innerText = 'Actualiza tu APIKEY';
                                                                        messageElement.classList.add('red');

                                                                    } else {
                                                                        // Otro código de estado no manejado
                                                                        console.error('Código de estado no manejado:', status);
                                                                    }
                                                                    // Esperar 3 segundos antes de ocultar el mensaje
                                                                    setTimeout(function() {
                                                                        var messageElement = document.getElementById('messageruc');
                                                                        messageElement.innerText = ''; // Limpiar el texto del mensaje
                                                                        messageElement.className = ''; // Eliminar todas las clases
                                                                    }, 5000);
                                                                    
                                                                })
                                                                .catch(error => {
                                                                    // Manejar errores en la consulta
                                                                    console.error('Error al consultar la API de SUNAT:', error);
                                                                });
                                                        }
                                                        function enviarDatosPorWebhookruc(urlwebhook0) {
                                                            fetch(urlwebhook0, {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json'
                                                                }
                                                            })
                                                            .then(response => {
                                                                if (!response.ok) {
                                                                    throw new Error('Error al enviar los datos al webhook');
                                                                }
                                                                console.log('Datos enviados correctamente al webhook');
                                                                var messageElement = document.getElementById('messageruc');
                                                                messageElement.innerText = 'Búsqueda Exitosa!';
                                                                messageElement.classList.add('green');
                                                            })
                                                            .catch(error => {
                                                                console.error('Error al enviar los datos al webhook:', error);
                                                            });
                                                        }
                                                        }
                                                        function validarRUClite() {
                                                            // Obtener el valor del RUC ingresado por el usuario
                                                            var ruc = document.getElementById('ruc0').value;
                                                            
                                                            // Validar que el RUC no esté vacío y que tenga la estructura correcta
                                                            var rucRegex = /^(10|20)\d{9}$/; 
                                                            // Expresión regular para validar RUC (debe empezar con 10 o 20 y tener 11 dígitos en total)

                                                            setTimeout(function() {
                                                                        var messageElement = document.getElementById('ruc0');
                                                                        messageElement.classList.remove('red');
                                                                        messageElement.classList.remove('green');
                                                                    }, 5000);

                                                            if (ruc.trim() === '' || !rucRegex.test(ruc)) {
                                                                var messageElement = document.getElementById('ruc0');
                                                                messageElement.classList.add('red');
                                                            }
                                                            else{
                                                                var messageElement = document.getElementById('ruc0');
                                                                messageElement.classList.remove('red');
                                                                messageElement.classList.add('green');

                                                            // URL base de la API de SUNAT
                                                            var apiUrl = 'https://api.sunat.dev/ruc/';
                                                    
                                                            // Construir la URL completa con el RUC ingresado
                                                            var fullUrl = apiUrl + ruc + '?apikey=<?php echo $apikey_value; ?>';
                                                    
                                                            // Realizar la consulta a la API
                                                            fetch(fullUrl)
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                    // Manejar la respuesta de la API
                                                                    console.log(data);
                                                                    var status = data.statusCode;

                                                                    if (status === 200) {

                                                                        // Actualizar los valores de longitud y latitud en el iframe
                                                                        var numeroRuc = data.body.numeroRuc;
                                                                        var codDomHabido = data.body.datosContribuyente.codDomHabido; 
                                                                        var codEstado = data.body.datosContribuyente.codEstado;
                                                                        var desRazonSocial = data.body.datosContribuyente.desRazonSocial;
                                                                        var nombreComercial = "-";
                                                                        var desDireccion = data.body.datosContribuyente.desDireccion;
                                                                        var desDistrito = data.body.datosContribuyente.ubigeo.desDistrito;
                                                                        var desProvincia = data.body.datosContribuyente.ubigeo.desProvincia;
                                                                        var desDepartamento = data.body.datosContribuyente.ubigeo.desDepartamento;
                                                                        var tipoConsulta = "LITE";

                                                                        // Asignar valores a las variables
                                                                        document.getElementById('numeroRuc').value = numeroRuc;
                                                                        document.getElementById('estados').value = `${codDomHabido} - ${codEstado}`;
                                                                        document.getElementById('desRazonSocial').value = desRazonSocial;
                                                                        document.getElementById('nombreComercial').value = nombreComercial;
                                                                        document.getElementById('desDireccion').value = desDireccion;
                                                                        document.getElementById('ubigeo').value = `${desDistrito}, ${desProvincia}, ${desDepartamento}`;

                                                                        var url0 = `https://h.albato.com/wh/38/1lfvf5g/pZyIxOG57W6F9lhHdEr32Lvx1H_Xe-AkOy2R7gBOpP0/?numeroRuc=${numeroRuc}&codDomHabido=${codDomHabido}&codEstado=${codEstado}&desRazonSocial=${desRazonSocial}&nombreComercial=${nombreComercial}&desDireccion=${desDireccion}&desDistrito=${desDistrito}&desProvincia=${desProvincia}&desDepartamento=${desDepartamento}&tipoConsulta=${tipoConsulta}`;

                                                                        var urlwebhook0 = url0.replaceAll(" ", "%20");
                                                                        console.log(urlwebhook0);

                                                                        // Enviar los datos a través de webhook
                                                                        enviarDatosPorWebhookruc(urlwebhook0);

                                                                         // Actualizar los créditos en la base de datos mediante una solicitud HTTP a PHP
                                                                        // Definir el valor de aumento
                                                                        var aumento = 3;
                                                                        fetch('actualizarCreditos.php', {
                                                                            method: 'POST',
                                                                            headers: {
                                                                                'Content-Type': 'application/json'
                                                                            },
                                                                            body: JSON.stringify({
                                                                                aumento: aumento  // Incremento de créditos
                                                                            })
                                                                        })
                                                                        .then(response => {
                                                                            if (!response.ok) {
                                                                                throw new Error('Error al actualizar los créditos');
                                                                            }
                                                                            return response.text(); // Leer el cuerpo de la respuesta
                                                                        })
                                                                        .then(data => {
                                                                            console.log('Respuesta del servidor:', data); // Mostrar la respuesta del servidor en la consola
                                                                        })
                                                                        .catch(error => {
                                                                            console.error('Error al actualizar los créditos:', error);
                                                                        });

                                                                    }else if (status === 400) {
                                                                        // Mostrar un mensaje de error
                                                                        var messageElement = document.getElementById('messageruc');
                                                                        messageElement.innerText = 'Intenta nuevamente!';
                                                                        messageElement.classList.add('yellow');

                                                                    } else if (status === 403) {
                                                                        // Mostrar un mensaje de error
                                                                        var messageElement = document.getElementById('messageruc');
                                                                        messageElement.innerText = 'Actualiza tu APIKEY';
                                                                        messageElement.classList.add('red');

                                                                    } else {
                                                                        // Otro código de estado no manejado
                                                                        console.error('Código de estado no manejado:', status);
                                                                    }
                                                                    // Esperar 3 segundos antes de ocultar el mensaje
                                                                    setTimeout(function() {
                                                                        var messageElement = document.getElementById('messageruc');
                                                                        messageElement.innerText = ''; // Limpiar el texto del mensaje
                                                                        messageElement.className = ''; // Eliminar todas las clases
                                                                    }, 5000);
                                                                    
                                                                })
                                                                .catch(error => {
                                                                    // Manejar errores en la consulta
                                                                    console.error('Error al consultar la API de SUNAT:', error);
                                                                });
                                                        }
                                                        function enviarDatosPorWebhookruc(urlwebhook0) {
                                                            fetch(urlwebhook0, {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json'
                                                                }
                                                            })
                                                            .then(response => {
                                                                if (!response.ok) {
                                                                    throw new Error('Error al enviar los datos al webhook');
                                                                }
                                                                console.log('Datos enviados correctamente al webhook');
                                                                var messageElement = document.getElementById('messageruc');
                                                                messageElement.innerText = 'Búsqueda Exitosa!';
                                                                messageElement.classList.add('green');
                                                            })
                                                            .catch(error => {
                                                                console.error('Error al enviar los datos al webhook:', error);
                                                            });
                                                        }
                                                        }

                                                    </script>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Número de RUC</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="numeroRuc" disabled placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Estado:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="estados" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Razón Social: </label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="desRazonSocial" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div><div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Nombre Comercial:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="nombreComercial" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Dirección:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="desDireccion" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Ubigeo:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="ubigeo" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Contacto:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="telefonos" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Correos Electrónicos:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="emails" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Actividad Económica 01: </label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="actividadEconomica1" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Actividad Económica 02: </label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="actividadEconomica2" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Sistema de Emisión Electrónica:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="sistemaEmisionElectronica" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Padrones:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="padrones" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-preview -->
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <div class="preview-block">
                                                <span class="preview-title-lg overline-title">DATOS PERSONALES </span><span id="message"></span>
                                                <div class="row gy-4">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">DOCUMENTO DE IDENTIDAD DNI</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" required class="form-control focus" id="dni0" placeholder="Ingrese tu DNI">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span class="preview-title overline-title">Búsqueda | <em class="icon ni ni-wallet-out"></em> (3) CRÉDITOS</span>
                                                        <a href="#" onclick="consultarDNI()" class="btn btn-lg btn-primary">CONSULTAR DNI</a>

                                                    </div>
                                                    
                                                   <script>
                                                        document.getElementById('dni0').addEventListener('input', function(event) {
                                                            // Obtener el valor actual del campo
                                                            var inputValue = event.target.value;
                                                            
                                                            // Eliminar cualquier carácter que no sea un número
                                                            var sanitizedValue = inputValue.replace(/\D/g, '');
                                                            
                                                            // Actualizar el valor del campo con solo números
                                                            event.target.value = sanitizedValue;
                                                        });
                                                        function consultarDNI() {
                                                            // Obtener el valor del RUC ingresado por el usuario
                                                            var dni = document.getElementById('dni0').value;
                                                            
                                                            // Validar que el RUC no esté vacío y que tenga la estructura correcta
                                                            var dniRegex = /^\d{8}$/;
                                                            // Expresión regular para validar RUC (debe empezar con 10 o 20 y tener 11 dígitos en total)

                                                            setTimeout(function() {
                                                                        var messageElement = document.getElementById('dni0');
                                                                        messageElement.classList.remove('red');
                                                                        messageElement.classList.remove('green');
                                                                    }, 5000);

                                                            if (dni.trim() === '' || !dniRegex.test(dni)) {
                                                                var messageElement = document.getElementById('dni0');
                                                                messageElement.classList.add('red');
                                                            }
                                                            else{
                                                                var messageElement = document.getElementById('dni0');
                                                                messageElement.classList.remove('red');
                                                                messageElement.classList.add('green');

                                                            // URL base de la API de SUNAT
                                                            var apiUrl = 'https://api.sunat.dev/dni/';

                                                            // Construir la URL completa con el RUC ingresado
                                                            var fullUrl = apiUrl + dni + '?apikey=<?php echo $apikey_value; ?>';

                                                            // Realizar la consulta a la API
                                                            fetch(fullUrl)
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                    // Manejar la respuesta de la API
                                                                    console.log(data);
                                                                    var status = data.statusCode;

                                                                    if (status === 200) {

                                                                        // Actualizar los valores de longitud y latitud en el iframe
                                                                        var nuDni = data.body.nuDni;
                                                                        var preNombres = data.body.preNombres; 
                                                                        var apePaterno = data.body.apePaterno;
                                                                        var apeMaterno = data.body.apeMaterno;
                                                                        var nameComplete = `${preNombres} ${apePaterno} ${apeMaterno}`;
                                                                        var desDireccion0 = data.body.desDireccion;
                                                                        var region = data.body.ubigeo.region;
                                                                        var departamento = data.body.ubigeo.departamento;
                                                                        var provincia = data.body.ubigeo.provincia;
                                                                        var distrito = data.body.ubigeo.distrito;
                                                                        var ubigeo_inei = data.body.ubigeo.ubigeo_inei;
                                                                        var macroregion_inei = data.body.ubigeo.macroregion_inei;
                                                                        var provincia_inei = data.body.ubigeo.provincia_inei;
                                                                        var ubigeo_reniec = data.body.ubigeo.ubigeo_reniec;
                                                                        var id_ubigeo = data.body.ubigeo.id_ubigeo;
                                                                        var macroregion_minsa = data.body.ubigeo.macroregion_minsa;
                                                                        var iso_3166_2 = data.body.ubigeo.iso_3166_2;
                                                                        var altitud = data.body.ubigeo.altitud;
                                                                        var superficie = data.body.ubigeo.superficie;
                                                                        var latitud = data.body.ubigeo.latitud;
                                                                        var longitud = data.body.ubigeo.longitud;

                                                                        document.getElementById('nuDni').value = nuDni;
                                                                        document.getElementById('nameComplete').value = nameComplete;
                                                                        document.getElementById('desDireccion0').value = desDireccion0;
                                                                        document.getElementById('region').value = region;
                                                                        document.getElementById('departamento').value = departamento;
                                                                        document.getElementById('provincia').value = provincia;
                                                                        document.getElementById('distrito').value = distrito;
                                                                        document.getElementById('ubigeo_inei').value = ubigeo_inei;
                                                                        document.getElementById('macroregion_inei').value = macroregion_inei;
                                                                        document.getElementById('provincia_inei').value = provincia_inei;
                                                                        document.getElementById('ubigeo_reniec').value = ubigeo_reniec;
                                                                        document.getElementById('id_ubigeo').value = id_ubigeo;
                                                                        document.getElementById('macroregion_minsa').value = macroregion_minsa;
                                                                        document.getElementById('iso_3166_2').value = iso_3166_2;
                                                                        document.getElementById('altitud').value = altitud;
                                                                        document.getElementById('superficie').value = superficie;
                                                                        document.getElementById('longitud').value = longitud;
                                                                        document.getElementById('latitud').value = latitud;

                                                                        var iframe = document.getElementById('mapaIframe');
                                                                        iframe.src = `https://maps.google.com/?q=${latitud},${longitud}&t=m&output=embed`;

                                                                        var url = `https://h.albato.com/wh/38/1lfvf5g/2GR6Wbe8ab9Pu8t3f9qK6csoJvi1wRrc0MXZfSExAv8/?nuDNI=${nuDni}&preNombres=${preNombres}&apePaterno=${apePaterno}&apeMaterno=${apeMaterno}&nameComplete=${nameComplete}&desDireccion=${desDireccion}&region=${region}&departamento=${departamento}&provincia=${provincia}&distrito=${distrito}&ubigeo_inei=${ubigeo_inei}&macroregion_inei=${macroregion_inei}&provincia_inei=${provincia_inei}&ubigeo_reniec=${ubigeo_reniec}&id_ubigeo=${id_ubigeo}&macroregion_minsa=${macroregion_minsa}&iso_3166_2=${iso_3166_2}&altitud=${altitud}&superficie=${superficie}&latitud=${latitud}&longitud=${longitud}`;
                                                                        var urlwebhook = url.replaceAll(" ", "%20");
                                                                        console.log(urlwebhook);

                                                                        // Enviar los datos a través de webhook
                                                                        enviarDatosPorWebhook(urlwebhook);
                                                                         // Actualizar los créditos en la base de datos mediante una solicitud HTTP a PHP
                                                                        var aumento = 3;
                                                                        fetch('actualizarCreditos.php', {
                                                                            method: 'POST',
                                                                            headers: {
                                                                                'Content-Type': 'application/json'
                                                                            },
                                                                            body: JSON.stringify({
                                                                                aumento: aumento  // Incremento de créditos
                                                                            })
                                                                        })
                                                                        .then(response => {
                                                                            if (!response.ok) {
                                                                                throw new Error('Error al actualizar los créditos');
                                                                            }
                                                                            return response.text(); // Leer el cuerpo de la respuesta
                                                                        })
                                                                        .then(data => {
                                                                            console.log('Respuesta del servidor:', data); // Mostrar la respuesta del servidor en la consola
                                                                        })
                                                                        .catch(error => {
                                                                            console.error('Error al actualizar los créditos:', error);
                                                                        });


                                                                    }else if (status === 400) {
                                                                        // Mostrar un mensaje de error
                                                                        var messageElement = document.getElementById('message');
                                                                        messageElement.innerText = 'Intenta nuevamente!';
                                                                        messageElement.classList.add('yellow');

                                                                    } else if (status === 403) {
                                                                        // Mostrar un mensaje de error
                                                                        var messageElement = document.getElementById('message');
                                                                        messageElement.innerText = 'Actualiza tu APIKEY';
                                                                        messageElement.classList.add('red');

                                                                    } else {
                                                                        // Otro código de estado no manejado
                                                                        console.error('Código de estado no manejado:', status);
                                                                    }
                                                                    // Esperar 3 segundos antes de ocultar el mensaje
                                                                    setTimeout(function() {
                                                                        var messageElement = document.getElementById('message');
                                                                        messageElement.innerText = ''; // Limpiar el texto del mensaje
                                                                        messageElement.className = ''; // Eliminar todas las clases
                                                                    }, 5000);
                                                                    
                                                                })
                                                                .catch(error => {
                                                                    // Manejar errores en la consulta
                                                                    console.error('Error al consultar la API de SUNAT:', error);
                                                                });
                                                        }
                                                        function enviarDatosPorWebhook(urlwebhook) {
                                                            fetch(urlwebhook, {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json'
                                                                }
                                                            })
                                                            .then(response => {
                                                                if (!response.ok) {
                                                                    throw new Error('Error al enviar los datos al webhook');
                                                                }
                                                                console.log('Datos enviados correctamente al webhook');
                                                                var messageElement = document.getElementById('message');
                                                                messageElement.innerText = 'Búsqueda Exitosa!';
                                                                messageElement.classList.add('green');
                                                            })
                                                            .catch(error => {
                                                                console.error('Error al enviar los datos al webhook:', error);
                                                            });
                                                        }
                                                        }

                                                    </script>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Número de DNI:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="nuDni" disabled placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Nombres Completos:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="nameComplete" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Dirección: </label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="desDireccion0" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div><div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Región:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="region" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Departamento:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="departamento" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Provincia:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="provincia" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Distrito:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="distrito" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Ubigeo INEI:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="ubigeo_inei" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Macroregión INEI: </label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="macroregion_inei" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Provincia INEI: </label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="provincia_inei" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Ubigeo RENIEC:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="ubigeo_reniec" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">ID de Ubigeo:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="id_ubigeo" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Macroregión MINSA:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="macroregion_minsa" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">ISO 3166-2:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="iso_3166_2" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Altitud:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="altitud" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Superficie:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="superficie" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Longitud:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="longitud" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">Latitud:</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="latitud" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                         <iframe id="mapaIframe" class="iframe" src="https://maps.google.com/?q=-9.3658,-77.0964&t=m&output=embed" height="400" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div><!-- .nk-block -->
                            </div><!-- .components-preview wide-lg mx-auto -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
           
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="components-preview wide-lg mx-auto">
                                <div class="nk-block nk-block-lg">
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner" id="apikeycard">
                                            <div class="preview-block">
                                                <span class="preview-title-lg overline-title"><?php echo "Vence: $fecha_siguiente_mes_formateada "?>  | <em class="icon ni ni-alarm-alt"></em> <?php echo "$diferencia_dias días";?></span>
                                                <div class="row gy-4">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">APIKEY | <a target="_blank" href="https://sunat.dev/register">CREAR NUEVO</a> | <a target="_blank" href="https://yopmail.com/"><em class="icon ni ni-mail"></em></a> </label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" required class="form-control" id="apikey" placeholder="apikey" value="<?php echo htmlspecialchars($apikey_value); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01">EMAIL</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" required class="form-control" id="email" placeholder="email" value="<?php echo htmlspecialchars($email_value); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-01"><em class="icon ni ni-coins"></em> CRÉDITOS</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" required class="form-control" id="credits" placeholder="credits" value="<?php echo htmlspecialchars($credits_valuepro); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <span class="preview-title overline-title"><em class="icon ni ni-update"></em><?php echo "$fecha_actual_formateada";?></span>
                                                        <a href="#" onclick="actualizar_apikey()" class="btn btn-lg btn-outline-primary">GUARDAR</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div><!-- .nk-block -->
                            </div><!-- .components-preview wide-lg mx-auto -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
            <script>
            document.getElementById('credits').addEventListener('input', function(event) {
            // Obtener el valor actual del campo
            var inputValue = event.target.value;
                                                            
            // Eliminar cualquier carácter que no sea un número
            var sanitizedValue = inputValue.replace(/\D/g, '');
                                                            
            // Actualizar el valor del campo con solo números
            event.target.value = sanitizedValue;
            });

            function actualizar_apikey() {
                var nuevo_apikey = document.getElementById('apikey').value.trim();
                var nuevo_email = document.getElementById('email').value.trim();
                var nuevo_credits = document.getElementById('credits').value.trim();

                // Validar que ningún campo esté vacío y que el campo email contenga al menos un @
                if (nuevo_apikey === '') {
                    var messageElement = document.getElementById('apikey');
                    messageElement.classList.add('red');
                }
                if (nuevo_email === '' || nuevo_email.indexOf('@') === -1) {
                    var messageElement = document.getElementById('email');
                    messageElement.classList.add('red');
                }
                // Validar que el campo credits sea mayor a 3
                if (nuevo_credits === '' || parseInt(nuevo_credits) <= 3) {
                    var messageElement = document.getElementById('credits');
                    messageElement.classList.add('red');
                }

                // Enviar los datos al servidor usando AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "actualizar_apikey.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        //alert(xhr.responseText); // Mostrar respuesta del servidor
                        var messageElement = document.getElementById('apikeycard');
                        messageElement.classList.add('green');
                    }
                };
                xhr.send("apikey=" + encodeURIComponent(nuevo_apikey) + "&email=" + encodeURIComponent(nuevo_email) + "&credits=" + encodeURIComponent(nuevo_credits));
            }

            </script>
            <!-- footer @s -->
            <div class="nk-footer bg-white">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> &copy; 2024 Powered By.  <a href="https://nextius.com" target="_blank">NEXTIUS.com</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=3.2.3"></script>
    <script src="./assets/js/scripts.js?ver=3.2.3"></script>
</body>

</html>