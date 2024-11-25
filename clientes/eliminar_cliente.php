<?php
include '../includes/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM clientes WHERE ID_Cliente = $id";

    if ($conexion->query($sql) === TRUE) {
        echo "Cliente eliminado exitosamente.";
        header("Location: clientes.php");
        exit();
    } else {
        echo "Error al eliminar cliente: " . $conexion->error;
    }
}

$conexion->close();
?>
