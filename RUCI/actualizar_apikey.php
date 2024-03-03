<?php
// Incluir el archivo de conexión
require_once('connection.php');

// Función para actualizar el APIKEY en la base de datos
if(isset($_POST['apikey']) && isset($_POST['email']) && isset($_POST['credits'])) {
    $nuevo_apikey = $_POST['apikey'];
    $nuevo_email = $_POST['email'];
    $nuevo_credits = $_POST['credits'];

    // Obtener la fecha y hora actuales
    $fecha_actual = date('Y-m-d H:i:s');

    // SQL para actualizar el apikey, el email y la fecha de registro del registro con id 1
    $sql = "UPDATE apikeys SET apikey = '$nuevo_apikey', email = '$nuevo_email', credits = '$nuevo_credits', register = '$fecha_actual' WHERE id = 1";

    if ($conexion->query($sql) === TRUE) {
        echo "APIKEY actualizado correctamente";
    } else {
        echo "Error al actualizar el APIKEY: " . $conexion->error;
    }
}

$conexion->close();
?>
