<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>

    <h1>Registro de Datos</h1>

    <form id="registroForm">
        <label for="statusCode">Status Code:</label>
        <input type="text" id="statusCode" name="statusCode" required>
        <br>

        <label for="numeroRuc">Número de RUC:</label>
        <input type="text" id="numeroRuc" name="numeroRuc" required>
        <br>

        <label for="codDomHabido">Código Domicilio Habido:</label>
        <input type="text" id="codDomHabido" name="codDomHabido">
        <br>

        <label for="numTelefono1">Número de Teléfono 1:</label>
        <input type="text" id="numTelefono1" name="numTelefono1">
        <br>

        <label for="numTelefono2">Número de Teléfono 2:</label>
        <input type="text" id="numTelefono2" name="numTelefono2">
        <br>

        <label for="numTelefono3">Número de Teléfono 3:</label>
        <input type="text" id="numTelefono3" name="numTelefono3">
        <br>

        <label for="desRazonSocial">Razón Social:</label>
        <input type="text" id="desRazonSocial" name="desRazonSocial">
        <br>

        <label for="codUbigeo">Código Ubigeo:</label>
        <input type="text" id="codUbigeo" name="codUbigeo">
        <br>

        <label for="desDistrito">Distrito:</label>
        <input type="text" id="desDistrito" name="desDistrito">
        <br>

        <label for="desProvincia">Provincia:</label>
        <input type="text" id="desProvincia" name="desProvincia">
        <br>

        <label for="desDepartamento">Departamento:</label>
        <input type="text" id="desDepartamento" name="desDepartamento">
        <br>

        <label for="desDireccion">Dirección:</label>
        <input type="text" id="desDireccion" name="desDireccion">
        <br>

        <label for="desNomApe">Nombre y Apellido:</label>
        <input type="text" id="desNomApe" name="desNomApe">
        <br>

        <label for="codCorreo2">Correo Electrónico 2:</label>
        <input type="text" id="codCorreo2" name="codCorreo2">
        <br>

        <label for="codCorreo1">Correo Electrónico 1:</label>
        <input type="text" id="codCorreo1" name="codCorreo1">
        <br>

        <label for="codEstado">Código de Estado:</label>
        <input type="text" id="codEstado" name="codEstado">
        <br>

        <label for="nombreComercial">Nombre Comercial:</label>
        <input type="text" id="nombreComercial" name="nombreComercial">
        <br>

        <label for="actividadEconomica_primaria">Actividad Económica Primaria:</label>
        <input type="text" id="actividadEconomica_primaria" name="actividadEconomica_primaria">
        <br>

        <label for="actividadEconomica_secundaria">Actividad Económica Secundaria:</label>
        <input type="text" id="actividadEconomica_secundaria" name="actividadEconomica_secundaria">
        <br>

        <label for="sistemaEmisionElectronica_factura">Sistema Emisión Electrónica Factura:</label>
        <input type="text" id="sistemaEmisionElectronica_factura" name="sistemaEmisionElectronica_factura">
        <br>

        <label for="sistemaEmisionElectronica_boleta">Sistema Emisión Electrónica Boleta:</label>
        <input type="text" id="sistemaEmisionElectronica_boleta" name="sistemaEmisionElectronica_boleta">
        <br>

        <label for="sistemaEmisionElectronica_verificador">Sistema Emisión Electrónica Verificador:</label>
        <input type="text" id="sistemaEmisionElectronica_verificador" name="sistemaEmisionElectronica_verificador">
        <br>

        <label for="padrones">Padrones:</label>
        <input type="text" id="padrones" name="padrones">
        <br>

        <label for="url_de_consulta">URL de Consulta:</label>
        <input type="text" id="url_de_consulta" name="url_de_consulta">
        <br>

        <input type="submit" value="Guardar Datos">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#registroForm').submit(function (event) {
                event.preventDefault();

                // Obtener los datos del formulario
                var formData = $(this).serialize();

                // Enviar los datos al servidor
                $.ajax({
                    url: 'guardarEnTabla.php',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        alert("Datos guardados correctamente");
                        // Puedes redirigir a otra página o hacer alguna otra acción después de guardar
                    },
                    error: function (error) {
                        console.error("Error al guardar los datos: " + error.responseText);
                        alert("Error al intentar guardar los datos");
                    }
                });
            });
        });
    </script>
</body>
</html>
