<?php
$servidor = "localhost";  // O IP del servidor
$usuario = "root";        // Tu usuario de MySQL
$clave = "";             // Tu clave de MySQL
$base_de_datos = "sistema_integral";  // Nombre de la base de datos

// Crear la conexión
$conexion = new mysqli($servidor, $usuario, $clave, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>