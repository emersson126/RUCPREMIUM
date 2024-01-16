<?php
// Se asegura que no vengan vacios
if (isset($_POST['apiKey']) && isset($_POST['email'])) {
    $apiKey = trim($_POST['apiKey']);
    $email = trim($_POST['email']);

    if (!empty($apiKey) && !empty($email)) {
        // Guarda la nueva API Key y correo en el archivo apikey.txt
        file_put_contents('apikey.txt', json_encode(['apikey' => $apiKey, 'email' => $email, 'status' => 'activo']));
        echo "API Key y correo actualizados correctamente.";
    } else {
        // Mensaje de error si la nueva API Key o correo están vacíos
        header('HTTP/1.1 400 Bad Request');
        echo "Error: La nueva API Key y el correo no pueden estar vacíos.";
    }
} else {
    // Mensaje de error si no se proporcionaron datos
    header('HTTP/1.1 400 Bad Request');
    echo "Error: No se proporcionaron datos válidos.";
}
?>
