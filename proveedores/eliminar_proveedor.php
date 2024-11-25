<?php
include('../includes/conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM proveedores WHERE ID_Proveedor = $id";

    if (mysqli_query($conexion, $query)) {
        header("Location: proveedores.php?mensaje=Proveedor eliminado exitosamente");
        exit();
    } else {
        header("Location: proveedores.php?error=Error al eliminar el proveedor: " . mysqli_error($conexion));
        exit();
    }
} else {
    header("Location: proveedores.php?error=ID no proporcionado");
    exit();
}
?>
