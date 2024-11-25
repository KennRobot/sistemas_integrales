<?php
include '../includes/conexion.php';

// Verificar si se ha recibido el ID del cliente a editar
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    if (!is_numeric($id_cliente)) {
        echo "ID de cliente inválido.";
        exit;
    }

    // Consulta para obtener los datos del cliente
    $query = "SELECT * FROM clientes WHERE ID_Cliente = $id_cliente";
    $result = mysqli_query($conexion, $query);

    // Verificar si la consulta fue exitosa
    if (!$result) {
        echo "Error en la consulta: " . mysqli_error($conexion);
        exit;
    }

    // Obtener los datos del cliente
    $cliente = mysqli_fetch_assoc($result);

    // Verificar si se encontraron datos del cliente
    if (!$cliente) {
        echo "Cliente no encontrado.";
        exit;
    }
}

// Procesar la actualización del cliente cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    // Escapar los datos para evitar inyecciones SQL
    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $telefono = mysqli_real_escape_string($conexion, $telefono);
    $email = mysqli_real_escape_string($conexion, $email);
    $direccion = mysqli_real_escape_string($conexion, $direccion);

    // Consulta para actualizar los datos del cliente
    $query_update = "UPDATE clientes SET Nombre = '$nombre', Telefono = '$telefono', Contacto = '$email', Direccion = '$direccion' WHERE ID_Cliente = $id_cliente";

    // Ejecutar la actualización
    if (mysqli_query($conexion, $query_update)) {
        // Redirigir al listado de clientes con un mensaje de éxito
        header("Location: clientes.php?mensaje=actualizado");
        exit;
    } else {
        echo "Error al actualizar el cliente: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            width: 200px;
            height: 100%;
            background-color: #2c3e50;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #16a085;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            flex: 1;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            font-weight: bold;
            margin: 10px 0 5px;
        }

        form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        form button, .btn-cancel {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
        }

        form button {
            background-color: #3498db;
            color: #fff;
        }

        form button:hover {
            background-color: #2980b9;
        }

        .btn-cancel {
            background-color: #e74c3c;
            color: #fff;
        }

        .btn-cancel:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="../productos/productos.php">Productos</a>
        <a href="../clientes/clientes.php">Clientes</a>
    </div>

    <div class="main-content">
        <div class="container">
            <h1>Editar Cliente</h1>

            <!-- Verificar si el cliente fue encontrado antes de mostrar el formulario -->
            <?php if (isset($cliente)): ?>
                <form method="POST" action="">
                    <input type="hidden" name="id_cliente" value="<?php echo $cliente['ID_Cliente']; ?>">

                    <label for="nombre">Nombre del Cliente:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($cliente['Nombre']); ?>" required>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($cliente['Telefono']); ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($cliente['Contacto']); ?>" required>

                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($cliente['Direccion']); ?>" required>

                    <button type="submit">Actualizar Cliente</button>
                    <a href="clientes.php" class="btn-cancel">Cancelar</a>
                </form>
            <?php else: ?>
                <p>Cliente no encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
