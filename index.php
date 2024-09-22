<?php
include 'conexion.php'; // Archivo de conexión a la base de datos

// Consulta SQL para obtener todos los productos
$sql = "CALL ObtenerProductos()";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario de Productos</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="column">
            <h1>Registro de Productos</h1>
            <form action="insertar.php" method="POST" class="form">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" required>

                <label for="existencia">Existencia:</label>
                <input type="text" id="existencia" name="existencia" required>

                <input type="submit" value="Registrar">
            </form>
        </div>

        <div class="column">
            <h2>Lista de Productos</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Existencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Despliega los productos en la tabla
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["idProd"] . "</td>";
                                echo "<td>" . $row["nombre"] . "</td>";
                                echo "<td>$ " . number_format($row["precio"], 2) . "</td>";
                                echo "<td>" . $row["existencia"] . "</td>";
                                echo "<td><a href='eliminar.php?idProd=" . $row["idProd"] . "' class='btn eliminar'>Eliminar</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No hay productos registrados.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $conn->close(); ?>
</body>
</html>
