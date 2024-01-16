<?php

// Configuración de la base de datos
$servername = "localhost";
$username = "u903295641_RUCPREMIUM";
$password = "4megatech.comPRO";
$dbname = "u903295641_RUCPREMIUM";

// Obtén los datos enviados por POST
$statusCode = $_POST['statusCode'] ?? "-";
$numeroRuc = $_POST['numeroRuc'] ?? "-";
$codDomHabido = $_POST['codDomHabido'] ?? "-";
$numTelefono1 = $_POST['numTelefono1'] ?? "-";
$numTelefono2 = $_POST['numTelefono2'] ?? "-";
$numTelefono3 = $_POST['numTelefono3'] ?? "-";
$desRazonSocial = $_POST['desRazonSocial'] ?? "-";
$codUbigeo = $_POST['codUbigeo'] ?? "-";
$desDistrito = $_POST['desDistrito'] ?? "-";
$desProvincia = $_POST['desProvincia'] ?? "-";
$desDepartamento = $_POST['desDepartamento'] ?? "-";
$desDireccion = $_POST['desDireccion'] ?? "-";
$desNomApe = $_POST['desNomApe'] ?? "-";
$codCorreo2 = $_POST['codCorreo2'] ?? "-";
$codCorreo1 = $_POST['codCorreo1'] ?? "-";
$codEstado = $_POST['codEstado'] ?? "-";
$nombreComercial = $_POST['nombreComercial'] ?? "-";
$actividadEconomica_primaria = $_POST['actividadEconomica_primaria'] ?? "-";
$actividadEconomica_secundaria = $_POST['actividadEconomica_secundaria'] ?? "-";
$sistemaEmisionElectronica_factura = $_POST['sistemaEmisionElectronica_factura'] ?? "-";
$sistemaEmisionElectronica_boleta = $_POST['sistemaEmisionElectronica_boleta'] ?? "-";
$sistemaEmisionElectronica_verificador = $_POST['sistemaEmisionElectronica_verificador'] ?? "-";
$padrones = $_POST['padrones'] ?? "-";
$url_de_consulta = $_POST['url_de_consulta'] ?? "-";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {

    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la sentencia SQL
$sql = "INSERT INTO customers (statusCode, numeroRuc, codDomHabido, numTelefono1, numTelefono2, numTelefono3, desRazonSocial, codUbigeo, desDistrito, desProvincia, desDepartamento, desDireccion, desNomApe, codCorreo2, codCorreo1, codEstado, nombreComercial, actividadEconomica_principal, actividadEconomica_secundaria, sistemaEmisionElectronica_factura, sistemaEmisionElectronica_boleta, padrones, url_de_consulta) 
        VALUES ('$statusCode', '$numeroRuc', '$codDomHabido', '$numTelefono1', '$numTelefono2', '$numTelefono3', '$desRazonSocial', '$codUbigeo', '$desDistrito', '$desProvincia', '$desDepartamento', '$desDireccion', '$desNomApe', '$codCorreo2', '$codCorreo1', '$codEstado', '$nombreComercial', '$actividadEconomica_primaria', '$actividadEconomica_secundaria', '$sistemaEmisionElectronica_factura', '$sistemaEmisionElectronica_boleta', '$padrones', '$url_de_consulta')";

// Ejecutar la sentencia SQL
if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente en la base de datos";
} else {
    echo "Error al insertar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();

?>
