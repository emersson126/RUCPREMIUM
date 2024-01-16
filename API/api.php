<?php
header('Content-Type: application/json');

$apikeyFile = 'apikey.txt';

// Verifica si el archivo existe
if (file_exists($apikeyFile)) {
    // Lee el contenido del archivo
    $apikeyData = file_get_contents($apikeyFile);

    // Decodifica el contenido JSON y lo devuelve como respuesta
    $apikey = json_decode($apikeyData, true);
    echo json_encode($apikey);
} else {
    // Devuelve un error si el archivo no existe
    http_response_code(500);
    echo json_encode(['error' => 'Error al leer la API Key']);
}
?>
