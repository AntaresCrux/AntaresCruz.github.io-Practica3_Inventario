<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $existencia = $_POST['existencia'];

    // Consulta SQL para insertar el producto
    //$sql = "INSERT INTO producto (nombre, precio, existencia) VALUES ('$nombre', '$precio', '$existencia')";
    $sql = "CALL InsertarProducto('$nombre', '$precio', '$existencia')";

    if ($conn->query($sql) === TRUE) {
        // Redirecciona a index.php después de insertar el producto
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
