-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2024 a las 01:22:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_integral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `ID_Categoria` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ID_Categoria`, `Nombre`) VALUES
(1, 'Electrónica'),
(2, 'Ropa'),
(3, 'Alimentos'),
(4, 'Hogar'),
(5, 'Juguetes'),
(6, 'Libros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cliente` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Contacto` varchar(100) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Nombre`, `Contacto`, `Telefono`, `Direccion`) VALUES
(1, 'Juan Pérez', 'juan.perez@example.com', '1234567890', 'Calle Falsa 123'),
(2, 'María López', 'maria.lopez@example.com', '0987654321', 'Av. Libertad 456'),
(3, 'Carlos García', 'carlos.garcia@example.com', '1122334455', 'Calle del Sol 789'),
(4, 'Ana Martínez', 'ana.martinez@example.com', '5566778899', 'Calle Acacia 101'),
(5, 'Luis Fernández', 'luis.fernandez@example.com', '6655443322', 'Calle Real 202');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `ID_Compra` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `ID_Proveedor` int(11) DEFAULT NULL,
  `Total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`ID_Compra`, `Fecha`, `ID_Proveedor`, `Total`) VALUES
(1, '2024-11-10', 3, 950.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_compra`
--

CREATE TABLE `detalles_compra` (
  `ID_Detalle_Compra` int(11) NOT NULL,
  `ID_Compra` int(11) DEFAULT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_Unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_compra`
--

INSERT INTO `detalles_compra` (`ID_Detalle_Compra`, `ID_Compra`, `ID_Producto`, `Cantidad`, `Precio_Unitario`) VALUES
(1, 1, 16, 50, 19.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta`
--

CREATE TABLE `detalles_venta` (
  `ID_Detalle_Venta` int(11) NOT NULL,
  `ID_Venta` int(11) DEFAULT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_Unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_venta`
--

INSERT INTO `detalles_venta` (`ID_Detalle_Venta`, `ID_Venta`, `ID_Producto`, `Cantidad`, `Precio_Unitario`) VALUES
(1, 1, 2, 1, 22000.00),
(2, 2, 1, 1, 15000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Producto` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `ID_Categoria` int(11) DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Cantidad_Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Nombre`, `Descripcion`, `ID_Categoria`, `Precio`, `Cantidad_Stock`) VALUES
(1, 'Laptop Dell XPS 13', 'Laptop ultradelgada con pantalla de 13 pulgadas', 1, 15000.00, 49),
(2, 'Smartphone Samsung Galaxy S23', 'Smartphone con pantalla de 6.5 pulgadas', 1, 22000.00, 39),
(3, 'Auriculares Bose QuietComfort 45', 'Auriculares con cancelación de ruido', 1, 5000.00, 30),
(4, 'Teclado Mecánico Logitech G Pro', 'Teclado mecánico con switches rápidos', 1, 2000.00, 20),
(5, 'Monitor LG UltraWide 34\"', 'Monitor ultra ancho de 34 pulgadas para productividad', 1, 7000.00, 15),
(6, 'Mouse Logitech MX Master 3', 'Mouse ergonómico y programable', 1, 1200.00, 70),
(7, 'Cámara Sony Alpha 7 IV', 'Cámara mirrorless profesional con 33MP', 1, 35000.00, 10),
(8, 'Impresora HP LaserJet Pro', 'Impresora láser monocromática de alta velocidad', 3, 4500.00, 25),
(9, 'Tablet iPad Air', 'Tablet con pantalla de 10.9 pulgadas y chip A14', 2, 11000.00, 100),
(10, 'Disco Duro Externo Seagate 2TB', 'Disco duro externo con 2TB de capacidad', 1, 1500.00, 50),
(11, 'Cargador Anker PowerPort', 'Cargador rápido de 5 puertos USB', 2, 800.00, 80),
(12, 'Batería Portátil Xiaomi 10000mAh', 'Batería portátil con carga rápida', 2, 400.00, 60),
(13, 'Silla de Oficina Ergonomica', 'Silla de oficina con soporte lumbar ajustable', 1, 3000.00, 35),
(14, 'Mochila para Laptop Lenovo', 'Mochila de 15 pulgadas con compartimentos', 2, 900.00, 45),
(15, 'Mouse Pad Razer Goliathus', 'Alfombrilla de mouse de alta precisión', 3, 400.00, 30),
(16, 'Coca-Cola', 'Refresco Coca-Cola 600ml', 3, 19.00, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ID_Proveedor` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Contacto` varchar(100) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`ID_Proveedor`, `Nombre`, `Contacto`, `Telefono`, `Direccion`) VALUES
(1, 'Proveedor A', 'proveedorA@example.com', '1234567890', 'Calle Falsa 123'),
(2, 'Proveedor B', 'proveedorB@example.com', '0987654321', 'Av. Libertad 456'),
(3, 'Proveedor C', 'proveedorC@example.com', '1122334455', 'Calle del Sol 789'),
(4, 'Proveedor D', 'proveedorD@example.com', '5566778899', 'Calle Acacia 101'),
(5, 'Proveedor E', 'proveedorE@example.com', '6655443322', 'Calle Real 202');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `ID_Stock` int(11) NOT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `ID_Ubicacion` int(11) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`ID_Stock`, `ID_Producto`, `ID_Ubicacion`, `Cantidad`) VALUES
(1, 1, 1, 50),
(2, 2, 2, 40),
(3, 3, 3, 30),
(4, 4, 4, 20),
(5, 5, 5, 15),
(6, 6, 1, 70),
(7, 7, 2, 10),
(8, 8, 3, 25),
(9, 9, 4, 100),
(10, 10, 5, 50),
(11, 11, 1, 80),
(12, 12, 2, 60),
(13, 13, 3, 35),
(14, 14, 4, 45),
(15, 15, 5, 30),
(16, 16, 1, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `ID_Ubicacion` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`ID_Ubicacion`, `Nombre`, `Direccion`) VALUES
(1, 'Sucursal Tepic', 'Calle Falsa 123, Tepic, Nayarit, México'),
(2, 'Sucursal Guadalajara', 'Av. Libertad 456, Guadalajara, Jalisco, México'),
(3, 'Sucursal Mazatlán', 'Calle 5 de Febrero 512, Mazatlán, Sinaloa, México'),
(4, 'Sucursal Cancún', 'Boulevard Costero 10, Cancún, Quintana Roo, México'),
(5, 'Sucursal Puerto Vallarta', 'Calle del Mar 88, Puerto Vallarta, Jalisco, México'),
(6, 'Sucursal Monterrey', 'Avenida Juárez 333, Monterrey, Nuevo León, México'),
(7, 'Sucursal Mérida', 'Calle Real 202, Mérida, Yucatán, México'),
(8, 'Sucursal Querétaro', 'Calle del Sol 789, Querétaro, Querétaro, México'),
(9, 'Sucursal Puebla', 'Calle Acacia 101, Puebla, Puebla, México'),
(10, 'Sucursal Tijuana', 'Avenida Reforma 205, Tijuana, Baja California, México'),
(11, 'Sucursal León', 'Avenida Río 345, León, Guanajuato, México'),
(12, 'Sucursal Morelia', 'Calle Hidalgo 789, Morelia, Michoacán, México'),
(13, 'Sucursal Aguascalientes', 'Calle Juárez 102, Aguascalientes, Aguascalientes, México'),
(14, 'Sucursal Hermosillo', 'Calle del Valle 500, Hermosillo, Sonora, México'),
(15, 'Sucursal Culiacán', 'Boulevard López Portillo 1500, Culiacán, Sinaloa, México'),
(16, 'Sucursal Chihuahua', 'Avenida Ocampo 2800, Chihuahua, Chihuahua, México'),
(17, 'Sucursal Toluca', 'Avenida Las Torres 55, Toluca, Estado de México, México'),
(18, 'Sucursal Veracruz', 'Calle 16 de Septiembre 999, Veracruz, Veracruz, México'),
(19, 'Sucursal San Luis Potosí', 'Avenida México 333, San Luis Potosí, San Luis Potosí, México'),
(20, 'Sucursal Tuxpan', 'Calle Veracruz 23, Tuxpan, Veracruz, México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID_Venta` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `ID_Cliente` int(11) DEFAULT NULL,
  `Total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ID_Venta`, `Fecha`, `ID_Cliente`, `Total`) VALUES
(1, '2024-11-10', 1, 22000.00),
(2, '2024-11-10', 2, 15000.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`ID_Compra`),
  ADD KEY `ID_Proveedor` (`ID_Proveedor`);

--
-- Indices de la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD PRIMARY KEY (`ID_Detalle_Compra`),
  ADD KEY `ID_Compra` (`ID_Compra`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indices de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD PRIMARY KEY (`ID_Detalle_Venta`),
  ADD KEY `ID_Venta` (`ID_Venta`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `ID_Categoria` (`ID_Categoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ID_Proveedor`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID_Stock`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Ubicacion` (`ID_Ubicacion`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`ID_Ubicacion`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_Venta`),
  ADD KEY `ID_Cliente` (`ID_Cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `ID_Compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  MODIFY `ID_Detalle_Compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  MODIFY `ID_Detalle_Venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `ID_Stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `ID_Ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID_Venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedores` (`ID_Proveedor`);

--
-- Filtros para la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD CONSTRAINT `detalles_compra_ibfk_1` FOREIGN KEY (`ID_Compra`) REFERENCES `compras` (`ID_Compra`),
  ADD CONSTRAINT `detalles_compra_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`);

--
-- Filtros para la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`ID_Venta`) REFERENCES `ventas` (`ID_Venta`),
  ADD CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ID_Categoria`) REFERENCES `categorias` (`ID_Categoria`);

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`ID_Ubicacion`) REFERENCES `ubicaciones` (`ID_Ubicacion`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
