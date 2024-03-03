<?php
// Incluir el archivo de conexión
require_once('connection.php');

// Obtener el cuerpo de la solicitud como JSON y decodificarlo
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si se recibió correctamente el valor del aumento
if (isset($data['aumento'])) {
    // Obtener el incremento de créditos enviado desde el frontend
    $aumento = $data['aumento'];

    // Actualizar los créditos en la base de datos
    $sql = "UPDATE apikeys SET credits = credits - $aumento WHERE id = 1";

    if ($conexion->query($sql) === TRUE) {
        echo "Créditos actualizados correctamente";
    } else {
        echo "Error al actualizar los créditos: " . $conexion->error;
    }
} else {
    echo "Error: No se recibió el valor del aumento correctamente";
}

// Cerrar conexión
$conexion->close();
?>
