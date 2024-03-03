<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>

    <?php
    if (isset($_GET['id'])) {
        $idCliente = $_GET['id'];

        // Conectar a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "userweb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta para obtener la información del cliente
        $sql = "SELECT * FROM customers WHERE id = $idCliente";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $cliente = $result->fetch_assoc();
    ?>

            <form action="guardar_edicion.php" method="post">
                <!-- Campos de formulario para la edición -->
                <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

                <label for="numeroRuc">Número RUC:</label>
                <input type="text" id="numeroRuc" name="numeroRuc" value="<?php echo $cliente['numeroRuc']; ?>">

                <label for="desRazonSocial">Razón Social:</label>
                <input type="text" id="desRazonSocial" name="desRazonSocial" value="<?php echo $cliente['desRazonSocial']; ?>">

                <label for="numTelefono3">Teléfono:</label>
                <input type="text" id="numTelefono3" name="numTelefono3" value="<?php echo $cliente['numTelefono3']; ?>">

                <!-- Agrega más campos según sea necesario -->

                <input type="submit" value="Guardar Cambios">
            </form>

    <?php
        } else {
            echo "<p>Error: No se encontró el cliente con el ID proporcionado.</p>";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "<p>Error: No se proporcionó un ID de cliente.</p>";
    }
    ?>

</body>
</html>
