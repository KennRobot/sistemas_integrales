<?php
include 'includes/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM ventas WHERE ID_Venta = $id";
    $result = $conn->query($sql);
    $venta = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $fecha = $_POST['fecha'];
    $total = $_POST['total'];

    $sql = "UPDATE ventas SET ID_Cliente = '$id_cliente', Fecha = '$fecha', Total = '$total' WHERE ID_Venta = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Venta actualizada exitosamente.";
        header("Location: ventas.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venta</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Venta</h1>
        <form method="POST">
            <label for="id_cliente">ID Cliente</label>
            <input type="text" name="id_cliente" value="<?php echo $venta['ID_Cliente']; ?>" required>
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" value="<?php echo $venta['Fecha']; ?>" required>
            <label for="total">Total</label>
            <input type="text" name="total" value="<?php echo $venta['Total']; ?>" required>
            <button type="submit" class="btn">Actualizar Venta</button>
        </form>
    </div>
</body>
</html>
