<?php
$servername = "localhost";
$username = "if0_37363420"; 
$password = "OXrA1L8kcR2"; 
$dbname = "if0_37363420_inventario_web"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
