<?php
// Incluir el archivo de conexión
include('../includes/conexion.php');

// Comprobar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];

    // Insertar los datos en la base de datos
    $query = "INSERT INTO productos (Nombre, Precio, Cantidad_Stock, Descripcion) 
              VALUES ('$nombre', '$precio', '$stock', '$descripcion')";
    
    if (mysqli_query($conexion, $query)) {
        echo "<script>alert('Producto agregado exitosamente');</script>";
        echo "<script>window.location.href = 'productos.php';</script>";
    } else {
        echo "<script>alert('Error al agregar el producto: " . mysqli_error($conexion) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Gestión</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<style>
        /* Estilos adicionales para el formulario */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 500px;
            margin: auto;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            min-height: 120px;
            resize: vertical; /* Permitir redimensionar verticalmente */
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
</style>
<body>
    <!-- Barra Lateral de Navegación -->
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="productos.php">Productos</a>

    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="container">
            <h1>Gestión de Productos</h1>

            <!-- Mensajes de Éxito/Error -->
            <?php if(isset($_GET['mensaje'])) { ?>
                <div class="success"><?= $_GET['mensaje']; ?></div>
            <?php } ?>
            <?php if(isset($_GET['error'])) { ?>
                <div class="error"><?= $_GET['error']; ?></div>
            <?php } ?>
<h1>Agregar Producto</h1>

<form action="agregar_producto.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" required>

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required></textarea>

    <button type="submit">Agregar Producto</button>
</form>

</body>
</html>
