<?php
// Incluir el archivo de conexión
include('../includes/conexion.php');

// Comprobar si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el producto de la base de datos
    $query = "DELETE FROM productos WHERE ID_Producto = $id";
    
    if (mysqli_query($conexion, $query)) {
        echo "<script>alert('Producto eliminado exitosamente');</script>";
        echo "<script>window.location.href = 'productos.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el producto: " . mysqli_error($conexion) . "');</script>";
    }
} else {
    echo "<script>alert('ID no proporcionado');</script>";
    echo "<script>window.location.href = 'productos.php';</script>";
}
?>
