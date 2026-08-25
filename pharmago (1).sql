-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2026 a las 18:33:08
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pharmago`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cod_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `contra_encriptada` varchar(255) DEFAULT NULL,
  `numero` varchar(50) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `rol` enum('cliente','admin') DEFAULT 'cliente',
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cod_cliente`, `nombre`, `apellido`, `usuario`, `email`, `contraseña`, `contra_encriptada`, `numero`, `tipo_documento`, `documento`, `rol`, `estado`) VALUES
(12, 'jua', 'cardenas', 'juancho', 'juanchocc@gmail.com', '123', '$2y$10$.wCQPspLGRjvPTM9ZTmS6ObRBetzGI6fz6i4BBZEQC7WpBkyBv1I6', '3130000000', 'CC', '21', 'cliente', 1),
(13, 'Johasdfae', 'lo', 'loa', 'b@gmail.comlll', '123', '$2y$10$T2pLMbkOP4/VBCzhclLcUuK7dEenY8/u2iN2LwkYDuI5O9RAzMc0y', '321', 'TI', '1236756756', 'admin', 1),
(14, 'luis daniel', 'gimenez', 'daniel021', 'lg47743021@gmail.com', '123', '$2y$10$ohltHAv/HUNKSPIHMAZx0e97SUFGK.mtibYdq5otZBBW/G0.qJkNy', '3028482223', 'CE', '5684491', 'cliente', 1),
(15, 'adminlolo', 'adminlola', 'admin@gmail.com', 'admin@gmail.com', '123', '$2y$10$dyHT0KQt1iNpiUiaYl8bsOB.hYqnkHYcISzjsS//LueTPMG.S655e', '321', 'CC', '12', 'admin', 1),
(16, 'peeeada', 'dad', 'admin@gmail.com', 'd@mca.xo', '123', '$2y$10$0uhNeiiyUgmX0suWsBO4CeyVXxCVWAC0ni3PBtXnvkPZ5RiRO4S1q', '1233', 'CC', '123', 'cliente', 1),
(17, 'l', 'l', 'e@gmail.com', 'e@d.d', '1234', '$2y$10$mDtM58IyJjHU6mS6b44SZOzXHI5ok8/IJkAbtb491/mitQmDmzoH6', '123', 'CC', '12', 'cliente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `cod_mensaje` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `mensaje` varchar(150) NOT NULL,
  `estado` enum('activo','inactivo','pendiente','realizado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`cod_mensaje`, `usuario`, `mensaje`, `estado`) VALUES
(1, 'e@gmail.com', 'jkj', 'activo'),
(2, 'e@gmail.com', 'puto servicio', 'inactivo'),
(3, 'admin@gmail.com', 'ghgjhg', 'activo'),
(4, 'e@gmail.com', 'bhkj', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `cod_productos` int(11) NOT NULL,
  `cod_proveedor` int(11) NOT NULL,
  `precio_compra` varchar(50) NOT NULL,
  `precio_venta` varchar(50) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `presentacion` enum('solido','liquido','semi-liquido','gaseoso') NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `fecha_fabricacion` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria` varchar(80) DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`cod_productos`, `cod_proveedor`, `precio_compra`, `precio_venta`, `nombre`, `presentacion`, `cantidad`, `fecha_fabricacion`, `fecha_vencimiento`, `imagen`, `descripcion`, `categoria`, `estado`) VALUES
(17, 1, '1500', '2500', 'Acetaminofén', 'solido', '500', '2025-01-15', '2028-01-15', 'acetaminofen-500mg.png', NULL, NULL, 'activo'),
(18, 5, '12000', '18000', 'Amlodipina', 'solido', '355', '2025-02-10', '2028-02-10', 'AMLODIPINA-10MG.png', NULL, NULL, 'activo'),
(19, 5, '18000', '28000', 'Atorvastatina', 'solido', '255', '2025-03-05', '2028-03-05', 'ATORVASTATINA.png', NULL, NULL, 'activo'),
(20, 4, '3500', '5500', 'Ibuprofeno', 'solido', '400', '2025-01-20', '2028-01-20', 'ibu.png', NULL, NULL, 'activo'),
(21, 1, '123', '12', 'a', '', '1', '2123-03-12', '0000-00-00', '', NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `cod_proveedor` int(11) NOT NULL,
  `correo_contacto` varchar(50) NOT NULL,
  `nombre_representante` varchar(50) NOT NULL,
  `numero_telefono_representante` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion_empresa` varchar(50) NOT NULL,
  `plazo` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`cod_proveedor`, `correo_contacto`, `nombre_representante`, `numero_telefono_representante`, `correo`, `direccion_empresa`, `plazo`, `razon_social`, `estado`) VALUES
(1, 'ventas@lafrancesa.com.co', 'Carlos Gómez', '3001234567', 'contacto@lafrancesa.com.co', 'Calle 45 #12-34, Bogotá', '30', 'Distribuidora La Francesa S.A.S.', 'activo'),
(3, 'pedidos@medisalud.com.co', 'Andrés Rodríguez', '3203456789', 'servicio@medisalud.com.co', 'Avenida 6N #25-40, Cali', '30', 'Medisalud Colombia S.A.S.', 'activo'),
(4, 'ventas@drogueriasunidas.com.co', 'Paula Herrera', '3154567890', 'contacto@drogueriasunidas.com.co', 'Calle 30 #15-22, Barranquilla', '60', '', 'activo'),
(5, 'atencion@farmadistribuciones.com.co', 'Jorge Ramírez', '3185678901', 'info@farmadistribuciones.com.co', 'Carrera 27 #18-50, Bucaramanga', '30', 'Farma Distribuciones S.A.S.', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`cod_mensaje`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`cod_productos`),
  ADD KEY `ibk_01_productos` (`cod_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`cod_proveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `cod_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `cod_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `cod_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `ibk_01_productos` FOREIGN KEY (`cod_proveedor`) REFERENCES `proveedores` (`cod_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
