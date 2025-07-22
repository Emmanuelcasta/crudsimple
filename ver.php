<?php
include 'conexion.php';

$result = $conn->query("SELECT * FROM usuarios");

echo "<h2>Lista de usuarios</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nombre</th><th>Correo</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["nombre"]."</td><td>".$row["correo"]."</td></tr>";
}

echo "</table>";
?>
