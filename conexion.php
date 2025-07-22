<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db = "registro_usuarios";

$conn = new mysqli("localhost", "root", "", "registro_usuarios", 3307);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
