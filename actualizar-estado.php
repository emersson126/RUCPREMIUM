<?php
// Verifica si se recibió un nuevo estado
if (isset($_POST['status'])) {
    $nuevoEstado = $_POST['status'];

    // Lee el contenido actual del archivo apikey.txt
    $contenidoActual = file_get_contents('apikey.txt');

    // Decodifica el contenido JSON
    $datosApiKey = json_decode($contenidoActual, true);

    // Actualiza el estado
    $datosApiKey['status'] = $nuevoEstado;

    // Codifica de nuevo los datos a formato JSON
    $nuevoContenido = json_encode($datosApiKey, JSON_PRETTY_PRINT);

    // Guarda el nuevo contenido en el archivo apikey.txt
    file_put_contents('apikey.txt', $nuevoContenido);
    echo "Estado actualizado correctamente.";
} else {
    // Mensaje de error si no se proporcionó un nuevo estado
    header('HTTP/1.1 400 Bad Request');
    echo "Error: No se proporcionó un nuevo estado.";
}
?>
