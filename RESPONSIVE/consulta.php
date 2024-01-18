
<?php
header('Content-Type: application/json');
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userweb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los datos
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

// Crear un array para almacenar los resultados
$data = array();

// Convertir los resultados en un array asociativo
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Devolver los datos como JSON
echo json_encode($data);

// Cerrar la conexión
$conn->close();
?>
