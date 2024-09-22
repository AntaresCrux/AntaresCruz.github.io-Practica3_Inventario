<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

// Verifica si se recibió un idProd por GET
if (isset($_GET['idProd'])) {
    $idProd = $_GET['idProd'];

    // Consulta SQL para eliminar el producto
    //$sql = "DELETE FROM producto WHERE idProd='$idProd'";
    $sql = "CALL EliminarProducto('$idProd');";

    if ($conn->query($sql) === TRUE) {
        // Redirecciona a index.php después de eliminar el producto
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}

$conn->close();
?>
