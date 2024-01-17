<?php
$servername = "localhost";
$username = "u903295641_RUCPREMIUM";
$password = "4megatech.comPRO";
$dbname = "u903295641_RUCPREMIUM";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta SQL para seleccionar todas las filas
$select_query = "SELECT * FROM customers";
$result = $conn->query($select_query);

// Cerrar la conexión después de obtener los resultados
$conn->close();
?>

<!-- Ahora puedes procesar los resultados y mostrarlos en una tabla -->
<?php
// Mostrar los resultados en una tabla HTML
echo "<table border='1'>
         <tr>
            <th>ID</th>
            <th>statusCode</th>
            <!-- Agrega más encabezados para cada columna según tus campos -->
         </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['statusCode'] . "</td>
            <!-- Agrega más celdas para cada columna según tus campos -->
         </tr>";
}

echo "</table>";

// Liberar los resultados después de usarlos
$result->free();
?>
