<?php
// Conexión
$conn = new mysqli("localhost", "root", "", "registro_usuarios", 3307);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar usuario si se recibe parámetro ?eliminar=
if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $conn->query("DELETE FROM usuarios WHERE id = $idEliminar");
    header("Location: index.php");
    exit();
}   

// Insertar datos
$registroExitoso = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nombre"]) && !empty($_POST["correo"])) {
        // Formateo:
        $nombre = ucwords(strtolower(trim($_POST["nombre"]))); // Capitaliza cada palabra
        $correo = strtolower(trim($_POST["correo"]));          // Correo en minúscula
        
        $nombre = $conn->real_escape_string($nombre);
        $correo = $conn->real_escape_string($correo);
        // Inserción:
        $conn->query("INSERT INTO usuarios (nombre, correo) VALUES ('$nombre', '$correo')");
        $registroExitoso = true;
    }
}

// Obtener registros
$resultado = $conn->query("SELECT * FROM usuarios ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <!-- Formulario -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Registrar usuario</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($registroExitoso): ?>
                            <div class="alert alert-success">Usuario registrado con éxito.</div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Correo</label>
                                <input type="email" name="correo" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Usuarios registrados</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($resultado && $resultado->num_rows > 0): ?>
                                    <?php while ($row = $resultado->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= htmlspecialchars($row['nombre']) ?></td>
                                            <td><?= htmlspecialchars($row['correo']) ?></td>
                                            <td>
                                                <a href="?eliminar=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                                   onclick="return confirm('¿Seguro que deseas eliminar este registro?')">
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No hay usuarios registrados.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
                                    