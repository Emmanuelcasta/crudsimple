<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];

$sql = "INSERT INTO usuarios (nombre, correo) VALUES ('$nombre', '$correo')";

if ($conn->query($sql) === TRUE) {
    echo "Registro insertado con éxito.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
