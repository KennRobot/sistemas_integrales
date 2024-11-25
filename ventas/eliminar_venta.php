<?php
include 'includes/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM ventas WHERE ID_Venta = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Venta eliminada exitosamente.";
        header("Location: ventas.php");
        exit();
    } else {
        echo "Error al eliminar venta: " . $conn->error;
    }
}

$conn->close();
?>
