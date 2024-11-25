<?php
// Incluir el archivo de conexión
include('../includes/conexion.php');

// Comprobar si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del producto desde la base de datos
    $query = "SELECT * FROM productos WHERE ID_Producto = $id";
    $result = mysqli_query($conexion, $query);
    $producto = mysqli_fetch_assoc($result);

    // Obtener las categorías existentes
    $queryCategorias = "SELECT * FROM categorias";
    $resultCategorias = mysqli_query($conexion, $queryCategorias);

    // Comprobar si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recoger los datos del formulario
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $descripcion = $_POST['descripcion'];
        $idCategoria = $_POST['categoria'];

        // Actualizar los datos del producto
        $updateQuery = "UPDATE productos SET Nombre = '$nombre', Precio = '$precio', 
                        Cantidad_Stock = '$stock', Descripcion = '$descripcion', 
                        ID_Categoria = '$idCategoria' WHERE ID_Producto = $id";

        if (mysqli_query($conexion, $updateQuery)) {
            // Actualizar el stock en la tabla de stock
            $updateStockQuery = "UPDATE stock SET Cantidad = '$stock' WHERE ID_Producto = $id";

            if (mysqli_query($conexion, $updateStockQuery)) {
                echo "<script>alert('Producto y stock actualizados exitosamente');</script>";
                echo "<script>window.location.href = 'productos.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar el stock: " . mysqli_error($conexion) . "');</script>";
            }
        } else {
            echo "<script>alert('Error al actualizar el producto: " . mysqli_error($conexion) . "');</script>";
        }
    }
} else {
    echo "<script>alert('ID no proporcionado');</script>";
    echo "<script>window.location.href = 'productos.php';</script>";
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
    textarea,
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
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
        <a href="categorias.php">Categorias</a>
        <a href="../compras/ubicaciones.php">Almacenes</a>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="container">
            <h1>Gestión de Productos</h1>

            <!-- Mensajes de Éxito/Error -->
            <?php if (isset($_GET['mensaje'])) { ?>
                <div class="success"><?= $_GET['mensaje']; ?></div>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <div class="error"><?= $_GET['error']; ?></div>
            <?php } ?>

            <h1>Editar Producto</h1>

            <form action="editar_producto.php?id=<?php echo $producto['ID_Producto']; ?>" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $producto['Nombre']; ?>" required>

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" value="<?php echo $producto['Precio']; ?>" required>

                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" value="<?php echo $producto['Cantidad_Stock']; ?>" required>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo $producto['Descripcion']; ?></textarea>

                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" required>
                    <?php
                    // Mostrar las categorías existentes como opciones en el select
                    while ($categoria = mysqli_fetch_assoc($resultCategorias)) {
                        $selected = ($producto['ID_Categoria'] == $categoria['ID_Categoria']) ? 'selected' : '';
                        echo "<option value='{$categoria['ID_Categoria']}' $selected>{$categoria['Nombre']}</option>";
                    }
                    ?>
                </select>

                <button type="submit">Actualizar Producto</button>
                <a href="productos.php" class="btn btn-cancel">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
