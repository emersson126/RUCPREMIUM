<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "userweb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recuperar datos del formulario
    $id = $_POST['id'];
    $numeroRuc = $_POST['numeroRuc'];
    $desRazonSocial = $_POST['desRazonSocial'];
    $numTelefono3 = $_POST['numTelefono3'];

    // Actualizar la información del cliente en la base de datos
    $sql = "UPDATE customers SET numeroRuc='$numeroRuc', desRazonSocial='$desRazonSocial', numTelefono3='$numTelefono3' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Información del cliente actualizada con éxito.";
    } else {
        echo "Error al actualizar la información del cliente: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
