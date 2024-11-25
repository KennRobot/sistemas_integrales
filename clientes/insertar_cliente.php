    <?php
    include '../includes/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];

        $query = "INSERT INTO clientes (Nombre, Telefono, Contacto, Direccion) VALUES ('$nombre', '$telefono', '$email', '$direccion')";
        if (mysqli_query($conexion, $query)) {
            echo "<script>alert('Cliente registrado exitosamente');</script>";
            echo "<script>window.location.href = 'clientes.php';</script>";
        } else {
            echo "Error al registrar el cliente: " . mysqli_error($conexion);
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrar Cliente</title>
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
                <h1>Registrar Nuevo Cliente</h1>
                <form method="POST" action="">
                    <label for="nombre">Nombre del Cliente:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required>

                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Número de teléfono" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Correo electrónico" required>

                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Dirección completa" required>

                    <button type="submit">Registrar Cliente</button>
                    <a href="clientes.php" class="btn-cancel">Cancelar</a>
                </form>
            </div>
        </div>
    </body>
    </html>
