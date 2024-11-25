<?php 
include '../includes/conexion.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Gestión</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* Estilos adicionales */
        .card {
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #34495e;
            color: #ffffff;
            text-transform: uppercase;
        }

        table tbody tr:hover {
            background-color: #f4f4f4;
        }

        /* Estilos para el buscador */
        .search-container {
            margin-bottom: 15px;
            display: flex;
            justify-content: flex-end;
        }

        .search-container input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
        }

        .btn {
            text-decoration: none;
            padding: 10px 15px;
            color: #ffffff;
            background-color: #3498db;
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s;
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-delete {
            background-color: #e74c3c;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .success, .error {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }

        .success {
            background-color: #2ecc71;
            color: #ffffff;
        }

        .error {
            background-color: #e74c3c;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <!-- Barra Lateral de Navegación -->
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="categorias.php">Categorías</a>
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

            <!-- Buscador -->
            <div class="search-container">
                <input type="text" id="tableSearch" placeholder="Buscar productos...">
            </div>

            <!-- Lista de Productos -->
            <div class="card">
                <h2>Productos Existentes</h2>
                <a href='agregar_producto.php' class='btn'>Agregar Producto</a>
                <table id="productTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta para obtener los productos de la base de datos
                        $query = "SELECT p.*, c.Nombre AS Categoria 
                                  FROM productos p 
                                  LEFT JOIN categorias c ON p.ID_Categoria = c.ID_Categoria";
                        $result = mysqli_query($conexion, $query);

                        if (!$result) {
                            die("Error en la consulta: " . mysqli_error($conexion));
                        }

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>$" . number_format($row['Precio'], 2) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Cantidad_Stock']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Categoria'] ?? 'Sin categoría') . "</td>";
                            echo "<td>
                                    <a href='editar_producto.php?id=" . $row['ID_Producto'] . "' class='btn'>Editar</a>
                                    <a href='eliminar_producto.php?id=" . $row['ID_Producto'] . "' class='btn btn-delete'>Eliminar</a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Buscador
        document.getElementById('tableSearch').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#productTable tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                row.style.display = rowText.includes(searchValue) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
