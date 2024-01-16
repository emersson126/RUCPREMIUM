<?php
// Verifica si se recibió una nueva API Key
if (isset($_POST['apiKey'])) {
    // Guarda la nueva API Key en el archivo apikey.txt
    $apiKey = $_POST['apiKey'];
    file_put_contents('apikey.txt', $apiKey);
    echo "API Key actualizada correctamente.";
} else {
    // Si no se recibió una nueva API Key, muestra un mensaje de error
    header('HTTP/1.1 400 Bad Request');
    echo "Error: No se proporcionó una nueva API Key.";
}
?>
