<?php
// Incluir el archivo de conexión
include('../includes/conexion.php');

// Comprobar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $fecha = $_POST['fecha'];
    $proveedor_id = $_POST['proveedor_id'];
    $categoria_id = $_POST['categoria_id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion']; // Recoger la ubicación seleccionada

    // Iniciar la transacción
    $conexion->begin_transaction();

    try {
        // 1. Insertar el producto en la tabla 'productos'
        $query_producto = "INSERT INTO productos (ID_Categoria, Nombre, Precio, Cantidad_Stock, Descripcion) 
                           VALUES ('$categoria_id', '$nombre', '$precio', '$stock', '$descripcion')";
        if (!$conexion->query($query_producto)) {
            throw new Exception('Error al insertar el producto en la tabla productos');
        }

        // Obtener el ID del producto recién insertado
        $producto_id = $conexion->insert_id;

        // Calcular el total de la compra (precio * cantidad)
        $total = $precio * $stock;

        // 2. Insertar la compra en la tabla 'compras'
        $query_compra = "INSERT INTO compras (Fecha, ID_Proveedor, Total) 
                         VALUES ('$fecha', '$proveedor_id', '$total')";
        if (!$conexion->query($query_compra)) {
            throw new Exception('Error al insertar la compra en la tabla compras');
        }

        // Obtener el ID de la compra recién insertada
        $compra_id = $conexion->insert_id;

        // 3. Insertar el detalle de la compra en la tabla 'detalles_compra'
        $query_detalle = "INSERT INTO detalles_compra (ID_Compra, ID_Producto, Cantidad, Precio_Unitario) 
                          VALUES ('$compra_id', '$producto_id', '$stock', '$precio')";
        if (!$conexion->query($query_detalle)) {
            throw new Exception('Error al insertar los detalles de la compra en la tabla detalles_compra');
        }

        // 4. Insertar o actualizar el stock en la tabla 'stock'
        $query_stock = "INSERT INTO stock (ID_Producto, Cantidad, ID_Ubicacion) 
                        VALUES ('$producto_id', '$stock', '$ubicacion')";
        if (!$conexion->query($query_stock)) {
            throw new Exception('Error al actualizar el stock en la tabla stock');
        }

        // Confirmar la transacción
        $conexion->commit();

        echo "<script>alert('Producto, compra, detalles y Stock  insertados correctamente');</script>";
        echo "<script>window.location.href = 'compras.php';</script>";

    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conexion->rollback();
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras - Gestión</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<style>
    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 500px;
        margin: auto;
    }

    input[type="date"],
    input[type="number"],
    select,
    textarea {
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
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="../compras/compras.php">Compras</a>
        <a href="../productos/productos.php">Productos</a>
        <a href="../productos/categorias.php">Categorías</a>
        <a href="ubicaciones.php">Almacenes</a>
    </div>

    <div class="main-content">
        <div class="container">
            <h1>Agregar Compra</h1>

            <form action="insertar_compra.php" method="POST">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <label for="proveedor_id">Proveedor:</label>
                <select name="proveedor_id" id="proveedor_id" required>
                    <?php
                    $consulta_proveedores = "SELECT * FROM proveedores";
                    $resultado_proveedores = mysqli_query($conexion, $consulta_proveedores);
                    while ($proveedor = mysqli_fetch_assoc($resultado_proveedores)) {
                        echo "<option value='".$proveedor['ID_Proveedor']."'>".$proveedor['Nombre']."</option>";
                    }
                    ?>
                </select>

                <h3>Producto</h3>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" required>

                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" required>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>

                <label for="categoria_id">Categoría:</label>
                <select name="categoria_id" id="categoria_id" required>
                    <option value="">Seleccione una categoría</option>
                    <?php
                    $consulta_categorias = "SELECT * FROM categorias";
                    $resultado_categorias = mysqli_query($conexion, $consulta_categorias);
                    while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
                        echo "<option value='".$categoria['ID_Categoria']."'>".$categoria['Nombre']."</option>";
                    }
                    ?>
                </select>

                <!-- Campo para seleccionar la ubicación -->
                <label for="ubicacion">Ubicación del Producto:</label>
                <select name="ubicacion" id="ubicacion" required>
                    <option value="">Seleccione una ubicación</option>
                    <?php
                    // Consulta para obtener las ubicaciones disponibles
                    $consulta_ubicaciones = "SELECT * FROM ubicaciones";
                    $resultado_ubicaciones = mysqli_query($conexion, $consulta_ubicaciones);
                    while ($ubicacion = mysqli_fetch_assoc($resultado_ubicaciones)) {
                        echo "<option value='".$ubicacion['ID_Ubicacion']."'>".$ubicacion['Nombre']."</option>";
                    }
                    ?>
                </select>


                <button type="submit">Agregar Compra</button>
                <a href="compras.php" class="btn btn-cancel">Cancelar</a>
                
            </form>
        </div>
    </div>
</body>
</html>
