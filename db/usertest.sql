-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-08-2018 a las 21:31:23
-- Versión del servidor: 10.1.30-MariaDB-0ubuntu0.17.10.1
-- Versión de PHP: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `usertest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleFactura`
--

CREATE TABLE `DetalleFactura` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `NroComprobante` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` float(8,2) NOT NULL,
  `tipo_operacion` int(11) NOT NULL,
  `observacion` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Factura`
--

CREATE TABLE `Factura` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_egreso` int(11) NOT NULL,
  `id_ingreso` int(11) NOT NULL,
  `Tipo` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `FormaPago` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Persona` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `NroComprobante` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Iva` float NOT NULL,
  `Descuento` float NOT NULL,
  `Direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_operacion` int(11) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Insumo`
--

CREATE TABLE `Insumo` (
  `Id_insumo` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `UnidadMedida` double NOT NULL,
  `Cantidad` float NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Insumo`
--

INSERT INTO `Insumo` (`Id_insumo`, `Nombre`, `UnidadMedida`, `Cantidad`, `activo`) VALUES
(1, 'peperoni', 0.2, 12.4, 1),
(2, 'papas', 200, -793, 1),
(3, 'aceitunas', 5, 155, 1),
(4, 'morron', 1, 12, 0),
(5, 'chorizo', 1, 4, 1),
(6, 'mayonesa', 0.2, 10.8, 1),
(7, 'pan', 1, 4, 1),
(8, 'aceitunas', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE `Persona` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `TipoPersona` int(11) NOT NULL,
  `Nombre` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Direccion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Cuit` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Persona`
--

INSERT INTO `Persona` (`Id`, `TipoPersona`, `Nombre`, `Telefono`, `Direccion`, `Cuit`, `activo`) VALUES
(1, 1, 'Fulanito', 1, '1', 1, 0),
(2, 1, 'pepe', 321654, 'siempre viva 1234', 35455734, 1),
(4, 2, 'queseria SA', 45454, 'alguna calle444', 2135, 1),
(5, 2, 'fiambreria FC', 44444, 'alguna calle xxx', 999999999, 1),
(13, 1, 'maria', 1232131, 'alguna calle23', 12353, 1),
(17, 2, 'comp', 0, 'asfdaf afawf', 3300022, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE `Producto` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `Stock` int(11) NOT NULL,
  `NombreProducto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CostoProducto` float(8,2) NOT NULL,
  `esElaborado` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Producto`
--

INSERT INTO `Producto` (`Id`, `Stock`, `NombreProducto`, `CostoProducto`, `esElaborado`, `activo`) VALUES
(1, 98, 'Coca', 10.10, 0, 1),
(2, 0, 'papas_fritas', 20.00, 1, 1),
(3, 0, 'Muzza_Napo', 16.00, 1, 1),
(4, 200, 'Quilmes', 25.00, 0, 1),
(5, 200, 'PapasLays', 30.00, 0, 0),
(6, 0, 'Choripan', 15.00, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Receta`
--

CREATE TABLE `Receta` (
  `Id_receta` int(11) NOT NULL,
  `Id_insumo` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Receta`
--

INSERT INTO `Receta` (`Id_receta`, `Id_insumo`, `Id_producto`) VALUES
(1, 1, 3),
(2, 2, 2),
(6, 3, 3),
(10, 1, 2),
(11, 5, 6),
(12, 7, 6),
(13, 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `Usuario` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Contrasena` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `TipoUsuario` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`Id`, `Usuario`, `Contrasena`, `Email`, `TipoUsuario`) VALUES
(1, 'test', 'test', 'test@test', '1'),
(4, 'prueba', 'qwer', 'asfa@ajdj', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `DetalleFactura`
--
ALTER TABLE `DetalleFactura`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Factura`
--
ALTER TABLE `Factura`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Insumo`
--
ALTER TABLE `Insumo`
  ADD PRIMARY KEY (`Id_insumo`);

--
-- Indices de la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Receta`
--
ALTER TABLE `Receta`
  ADD PRIMARY KEY (`Id_receta`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `DetalleFactura`
--
ALTER TABLE `DetalleFactura`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Factura`
--
ALTER TABLE `Factura`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Insumo`
--
ALTER TABLE `Insumo`
  MODIFY `Id_insumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `Persona`
--
ALTER TABLE `Persona`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `Producto`
--
ALTER TABLE `Producto`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `Receta`
--
ALTER TABLE `Receta`
  MODIFY `Id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
