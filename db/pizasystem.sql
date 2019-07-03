-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-07-2019 a las 18:23:51
-- Versión del servidor: 10.0.38-MariaDB-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.33-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizasystem`
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

--
-- Volcado de datos para la tabla `DetalleFactura`
--

INSERT INTO `DetalleFactura` (`Id`, `NroComprobante`, `IdProducto`, `Cantidad`, `Precio`, `tipo_operacion`, `observacion`) VALUES
(1, 1, 1, 1, 10.10, 1, ''),
(2, 1, 3, 1, 16.00, 1, ''),
(3, 1, 4, 1, 25.00, 1, ''),
(4, 2, 6, 2, 15.00, 1, ''),
(5, 2, 8, 12, 24.00, 1, ''),
(6, 3, 2, 2, 20.00, 1, ''),
(7, 1, 0, 0, 2000.00, 4, 'Saldo inicial'),
(8, 1, 0, 0, 500.00, 3, 'Merca Varias'),
(9, 1, 4, 12, 30.00, 2, ''),
(10, 2, 2, 2000, 25.00, 2, ''),
(11, 3, 1, 10, 10.00, 2, ''),
(12, 4, 3, 2, 16.00, 1, ''),
(13, 4, 4, 1, 25.00, 1, ''),
(14, 5, 1, 1, 10.10, 1, ''),
(15, 6, 2, 1, 20.00, 1, ''),
(16, 7, 4, 1, 25.00, 1, ''),
(17, 2, 0, 0, 1500.00, 4, ''),
(18, 3, 0, 0, 1000.00, 4, 'efectivo'),
(19, 4, 0, 0, 50.00, 4, 'cambio'),
(20, 5, 0, 0, 3.00, 4, 'cambio'),
(21, 2, 0, 0, 150.00, 3, 'ingredientes necesarios a ultimo momento'),
(22, 6, 0, 0, 150.00, 4, 'reposición'),
(41, 4, 1, 12, 512.00, 2, '1'),
(42, 4, 7, 50, 150.00, 2, '2'),
(43, 5, 1, 1, 22.00, 2, '1'),
(44, 5, 4, 2, 22.00, 2, '1'),
(45, 5, 2, 2, 22.00, 2, '2'),
(46, 6, 1, 123, 123.00, 2, '2'),
(47, 6, 4, 123, 123.00, 2, '1'),
(48, 7, 5, 123, 123.00, 2, '2'),
(49, 7, 4, 123, 123.00, 2, '1'),
(50, 8, 3, 12, 12.00, 2, '2'),
(51, 9, 3, 12, 12.00, 2, '2'),
(52, 10, 3, 12, 12.00, 2, '2'),
(53, 11, 3, 12, 12.00, 2, '2'),
(54, 12, 3, 12, 12.00, 2, '2'),
(55, 13, 3, 12, 12.00, 2, '2'),
(56, 14, 1, 23, 22.00, 2, '2'),
(57, 15, 1, 23, 22.00, 2, '2'),
(58, 16, 1, 23, 22.00, 2, '2'),
(59, 17, 1, 23, 22.00, 2, '2'),
(60, 18, 1, 23, 22.00, 2, '2'),
(61, 19, 1, 23, 22.00, 2, '2'),
(62, 20, 1, 23, 22.00, 2, '2'),
(63, 21, 1, 23, 22.00, 2, '2'),
(64, 22, 1, 23, 22.00, 2, '2'),
(65, 23, 1, 23, 22.00, 2, '2'),
(66, 24, 1, 23, 22.00, 2, '2'),
(67, 25, 1, 23, 22.00, 2, '2'),
(68, 26, 2, 1, 1.00, 2, '2'),
(69, 27, 5, 10, 10.00, 2, '2'),
(70, 27, 4, 10, 10.00, 2, '1'),
(71, 28, 5, 10, 10.00, 2, '2'),
(72, 28, 4, 10, 10.00, 2, '1'),
(73, 29, 1, 5, 5.00, 2, '1'),
(74, 29, 2, 5, 5.00, 2, '2'),
(75, 30, 1, 23, 23.00, 2, '1'),
(76, 30, 3, 23, 23.00, 2, '2'),
(77, 31, 1, 5, 150.00, 2, '1'),
(78, 32, 4, 1, 55.00, 2, '1'),
(79, 8, 3, 1, 0.00, 1, ''),
(80, 8, 4, 2, 0.00, 1, ''),
(81, 9, 4, 1, 25.00, 1, '1'),
(82, 10, 1, 2, 10.10, 1, '1'),
(83, 10, 6, 2, 15.00, 1, '2'),
(84, 11, 2, 3, 20.00, 1, '2'),
(85, 12, 1, 1, 10.10, 1, '1'),
(86, 12, 2, 1, 20.00, 1, '2'),
(87, 13, 6, 2, 15.00, 1, '2'),
(88, 13, 1, 2, 10.10, 1, '1'),
(89, 15, 3, 2, 16.00, 1, '2'),
(90, 16, 3, 2, 16.00, 1, '2'),
(91, 19, 6, 2, 15.00, 1, '2'),
(92, 20, 6, 2, 15.00, 1, '2'),
(93, 20, 4, 2, 25.00, 1, '1'),
(94, 21, 6, 2, 15.00, 1, '2'),
(95, 21, 1, 2, 10.10, 1, '1'),
(96, 22, 6, 2, 15.00, 1, '2'),
(97, 22, 1, 2, 10.10, 1, '1'),
(98, 23, 3, 2, 16.00, 1, '2'),
(99, 23, 6, 2, 15.00, 1, '2'),
(100, 24, 4, 2, 25.00, 1, '1'),
(101, 24, 6, 2, 15.00, 1, '2'),
(102, 25, 2, 2, 20.00, 1, '2'),
(103, 26, 1, 2, 10.10, 1, '1'),
(104, 26, 6, 2, 15.00, 1, '2'),
(105, 27, 1, 2, 10.10, 1, '1'),
(106, 27, 4, 2, 25.00, 1, '1'),
(107, 27, 6, 2, 15.00, 1, '2'),
(108, 33, 2, 5000, 3.00, 2, '2'),
(109, 33, 3, 100, 50.00, 2, '2'),
(110, 33, 1, 10, 200.00, 2, '2');

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

--
-- Volcado de datos para la tabla `Factura`
--

INSERT INTO `Factura` (`Id`, `id_compra`, `id_egreso`, `id_ingreso`, `Tipo`, `FormaPago`, `Persona`, `NroComprobante`, `Fecha`, `Iva`, `Descuento`, `Direccion`, `tipo_operacion`, `usuario`) VALUES
(1, 0, 0, 0, 'A', 'efedct', '2', 1, '2019-04-16 19:25:04', 0.21, 0, 'Local Conercial', 1, '1'),
(2, 0, 0, 0, 'A', 'efect', '5', 2, '2019-04-16 19:28:48', 0.21, 5, 'Local Conercial', 1, '1'),
(3, 0, 0, 0, 'A', 'efect', '2', 3, '2019-04-16 20:56:19', 0.21, 0, 'Local Conercial', 1, '1'),
(4, 0, 0, 1, '', 'efectivo', '', 0, '2019-01-02 03:11:29', 0, 0, 'Local Conercial', 4, '1'),
(5, 0, 1, 0, '', 'efectivo', '', 0, '2019-01-10 03:58:11', 0, 0, 'Local Conercial', 3, '1'),
(6, 1, 0, 0, '', 'efect', '5', 0, '2019-04-18 18:52:24', 0, 0, 'Local Conercial', 2, '1'),
(7, 2, 0, 0, '', 'efect', '18', 0, '2019-04-18 19:53:15', 0, 0, 'Local Conercial', 2, '1'),
(8, 3, 0, 0, '', 'efec', '4', 0, '2019-04-18 21:31:06', 0, 0, 'Local Conercial', 2, '1'),
(9, 0, 0, 0, 'A', 'efect', '2', 4, '2019-04-24 22:40:54', 0.21, 0, 'Local Conercial', 1, '1'),
(10, 0, 0, 0, 'A', 'efect', '2', 5, '2019-04-25 00:40:41', 0.21, 0, 'Local Conercial', 1, '1'),
(11, 0, 0, 0, 'A', 'efec', '2', 6, '2019-04-25 01:01:43', 0.21, 0, 'Local Conercial', 1, '1'),
(12, 0, 0, 0, 'A', 'efect', '13', 7, '2019-04-25 01:20:51', 0.21, 0, 'Local Conercial', 1, '1'),
(13, 0, 0, 2, '', 'efectivo', '', 0, '2019-06-03 21:31:05', 0, 0, 'Local Conercial', 4, '1'),
(14, 0, 0, 3, '', 'efectivo', '', 0, '2019-06-09 03:12:07', 0, 0, 'Local Conercial', 4, '1'),
(15, 0, 0, 4, '', 'efectivo', '', 0, '2019-06-09 03:20:18', 0, 0, 'Local Conercial', 4, '1'),
(16, 0, 0, 5, '', 'efectivo', '', 0, '2019-06-09 03:21:51', 0, 0, 'Local Conercial', 4, '1'),
(17, 0, 2, 0, '', 'efectivo', '', 0, '2019-06-26 21:40:24', 0, 0, 'Local Conercial', 3, '1'),
(18, 0, 0, 6, '', 'efectivo', '', 0, '2019-06-26 21:40:39', 0, 0, 'Local Conercial', 4, '1'),
(28, 4, 0, 0, '', 'efect', '4', 0, '2019-06-30 01:11:37', 0, 0, 'Local Conercial', 2, '1'),
(29, 5, 0, 0, '', 'efect', '4', 0, '2019-06-30 01:44:24', 0, 0, 'Local Conercial', 2, '1'),
(30, 6, 0, 0, '', 'efef', '5', 0, '2019-06-30 02:21:53', 0, 0, 'Local Conercial', 2, '1'),
(31, 7, 0, 0, '', 'efec', '5', 0, '2019-06-30 02:22:21', 0, 0, 'Local Conercial', 2, '1'),
(32, 8, 0, 0, '', 'efect', '4', 0, '2019-06-30 02:30:39', 0, 0, 'Local Conercial', 2, '1'),
(33, 9, 0, 0, '', 'efect', '4', 0, '2019-06-30 02:34:07', 0, 0, 'Local Conercial', 2, '1'),
(34, 10, 0, 0, '', 'efect', '4', 0, '2019-06-30 02:35:38', 0, 0, 'Local Conercial', 2, '1'),
(35, 11, 0, 0, '', 'efect', '4', 0, '2019-06-30 02:36:14', 0, 0, 'Local Conercial', 2, '1'),
(36, 12, 0, 0, '', 'efect', '4', 0, '2019-06-30 02:39:01', 0, 0, 'Local Conercial', 2, '1'),
(37, 13, 0, 0, '', 'efect', '4', 0, '2019-06-30 02:39:47', 0, 0, 'Local Conercial', 2, '1'),
(38, 14, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 02:42:21', 0, 0, 'Local Conercial', 2, '1'),
(39, 15, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 02:42:29', 0, 0, 'Local Conercial', 2, '1'),
(40, 16, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 02:42:32', 0, 0, 'Local Conercial', 2, '1'),
(41, 17, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 02:44:35', 0, 0, 'Local Conercial', 2, '1'),
(42, 18, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 03:17:22', 0, 0, 'Local Conercial', 2, ''),
(43, 19, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 03:17:35', 0, 0, 'Local Conercial', 2, ''),
(44, 20, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 03:23:48', 0, 0, 'Local Conercial', 2, ''),
(45, 21, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 03:25:51', 0, 0, 'Local Conercial', 2, ''),
(46, 22, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 03:27:21', 0, 0, 'Local Conercial', 2, ''),
(47, 23, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 03:30:16', 0, 0, 'Local Conercial', 2, ''),
(48, 24, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 03:30:34', 0, 0, 'Local Conercial', 2, ''),
(49, 25, 0, 0, '', 'efeccccc', '18', 0, '2019-06-30 03:30:45', 0, 0, 'Local Conercial', 2, ''),
(50, 26, 0, 0, '', 'efec', '18', 0, '2019-06-30 03:31:51', 0, 0, 'Local Conercial', 2, '1'),
(51, 27, 0, 0, '', 'efect', '5', 0, '2019-06-30 03:57:24', 0, 0, 'Local Conercial', 2, '1'),
(52, 28, 0, 0, '', 'efect', '5', 0, '2019-06-30 03:57:31', 0, 0, 'Local Conercial', 2, '1'),
(53, 29, 0, 0, '', 'asdsad', '18', 0, '2019-06-30 03:58:46', 0, 0, 'Local Conercial', 2, '1'),
(54, 30, 0, 0, '', 'efect', '18', 0, '2019-06-30 04:01:21', 0, 0, 'Local Conercial', 2, '1'),
(55, 31, 0, 0, '', 'efct', '18', 0, '2019-07-03 16:58:57', 0, 0, 'Local Conercial', 2, '1'),
(56, 32, 0, 0, '', 'efect', '4', 0, '2019-07-03 17:00:40', 0, 0, 'Local Conercial', 2, '1'),
(57, 0, 0, 0, 'A', 'efect', '2', 8, '2019-07-03 19:18:43', 0.21, 0, 'Local Conercial', 1, '1'),
(58, 0, 0, 0, 'A', 'hgygf', '2', 9, '2019-07-03 19:34:45', 0.21, 0, 'Local Conercial', 1, '1'),
(59, 0, 0, 0, 'A', 'efect', '4', 10, '2019-07-03 19:51:17', 0.21, 0, 'Local Conercial', 1, '1'),
(60, 0, 0, 0, 'A', 'efect', '5', 11, '2019-07-03 20:01:03', 0.21, 0, 'Local Conercial', 1, '1'),
(61, 0, 0, 0, 'A', 'efe', '4', 12, '2019-07-03 20:04:01', 0.21, 0, 'Local Conercial', 1, '1'),
(62, 0, 0, 0, 'A', 'efect', '13', 13, '2019-07-03 20:06:50', 0.21, 0, 'Local Conercial', 1, '1'),
(63, 0, 0, 0, 'A', 'efect', '13', 14, '2019-07-03 20:11:03', 0.21, 0, 'Local Conercial', 1, '1'),
(64, 0, 0, 0, 'A', 'efect', '13', 15, '2019-07-03 20:12:18', 0.21, 0, 'Local Conercial', 1, '1'),
(65, 0, 0, 0, 'A', 'efect', '18', 16, '2019-07-03 20:13:18', 0.21, 0, 'Local Conercial', 1, '1'),
(66, 0, 0, 0, 'A', 'qweqw', '13', 17, '2019-07-03 20:15:27', 0.21, 0, 'Local Conercial', 1, '1'),
(67, 0, 0, 0, 'A', 'qweqw', '13', 18, '2019-07-03 20:15:40', 0.21, 0, 'Local Conercial', 1, '1'),
(68, 0, 0, 0, 'A', 'qweqw', '13', 19, '2019-07-03 20:20:18', 0.21, 0, 'Local Conercial', 1, '1'),
(69, 0, 0, 0, 'A', 'efect', '13', 20, '2019-07-03 20:23:34', 0.21, 0, 'Local Conercial', 1, '1'),
(70, 0, 0, 0, 'A', 'efect', '5', 21, '2019-07-03 20:26:32', 0.21, 0, 'Local Conercial', 1, '1'),
(71, 0, 0, 0, 'A', 'efect', '4', 22, '2019-07-03 20:33:04', 0.21, 0, 'Local Conercial', 1, '1'),
(72, 0, 0, 0, 'A', 'efect', '4', 23, '2019-07-03 20:34:10', 0.21, 0, 'Local Conercial', 1, '1'),
(73, 0, 0, 0, 'A', 'efect', '4', 24, '2019-07-03 20:38:45', 0.21, 0, 'Local Conercial', 1, '1'),
(74, 0, 0, 0, 'A', 'efect', '4', 25, '2019-07-03 20:39:54', 0.21, 0, 'Local Conercial', 1, '1'),
(75, 0, 0, 0, 'A', 'efect', '4', 26, '2019-07-03 20:40:43', 0.21, 0, 'Local Conercial', 1, '1'),
(76, 0, 0, 0, 'A', 'efect', '13', 27, '2019-07-03 20:43:09', 0.21, 0, 'Local Conercial', 1, '1'),
(77, 33, 0, 0, '', 'debito', '5', 0, '2019-07-03 20:56:05', 0, 0, 'Local Conercial', 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Insumo`
--

CREATE TABLE `Insumo` (
  `Id_insumo` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `UnidadMedida` double NOT NULL,
  `Salida` float DEFAULT NULL,
  `Stock` float NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Insumo`
--

INSERT INTO `Insumo` (`Id_insumo`, `Nombre`, `UnidadMedida`, `Salida`, `Stock`, `activo`) VALUES
(1, 'peperoni', 0.2, 0, 10, 1),
(2, 'papas', 1000, 0, 5000, 1),
(3, 'aceitunas', 5, 0, 335, 1),
(4, 'morron', 1, 0, 20, 0),
(5, 'chorizo', 1, 4, 48, 1),
(6, 'mayonesa', 0.2, 40, 7980, 1),
(7, 'pan', 1, 4, 48, 1),
(8, 'aceitunas', 1, 2, 0, 1);

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
  `activo` int(11) NOT NULL DEFAULT '1',
  `cumple` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Persona`
--

INSERT INTO `Persona` (`Id`, `TipoPersona`, `Nombre`, `Telefono`, `Direccion`, `Cuit`, `activo`, `cumple`) VALUES
(1, 1, 'Fulanito', 1, '1', 1, 0, '0000-00-00'),
(2, 1, 'pepe', 321654, 'siempre viva 1234', 35455734, 1, '0000-00-00'),
(4, 2, 'queseria SA', 45454, 'alguna calle444', 2135, 1, '0000-00-00'),
(5, 2, 'fiambreria FC', 44444, 'alguna calle xxx', 999999999, 1, '0000-00-00'),
(13, 1, 'maria', 1232131, 'alguna calle23', 12353, 1, '0000-00-00'),
(17, 2, 'comp', 0, 'asfdaf afawf', 3300022, 0, '0000-00-00'),
(18, 2, 'Verduleria', 3754569, 'AlgunaCalle', 123456, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE `Producto` (
  `Id` bigint(20) UNSIGNED NOT NULL,
  `Salida` int(11) DEFAULT NULL,
  `Stock` int(11) NOT NULL,
  `NombreProducto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CostoProducto` float(8,2) NOT NULL,
  `esElaborado` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Producto`
--

INSERT INTO `Producto` (`Id`, `Salida`, `Stock`, `NombreProducto`, `CostoProducto`, `esElaborado`, `activo`) VALUES
(1, 18, 34, 'Coca', 10.10, 0, 1),
(2, 0, 0, 'papas_fritas', 20.00, 1, 1),
(3, 0, 0, 'Napolitana', 16.00, 1, 1),
(4, 7, 261, 'Cerveza', 25.00, 0, 1),
(5, 0, 200, 'PapasLays', 30.00, 0, 0),
(6, 0, 0, 'Choripan', 15.00, 1, 1),
(8, 0, 12, 'empanadas', 24.00, 1, 0),
(9, 0, 0, 'LaPrueba', 12.00, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Receta`
--

CREATE TABLE `Receta` (
  `Id_receta` int(11) NOT NULL,
  `Id_insumo` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `consume` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Receta`
--

INSERT INTO `Receta` (`Id_receta`, `Id_insumo`, `Id_producto`, `consume`) VALUES
(18, 2, 2, 200),
(19, 8, 9, 12),
(20, 1, 3, 0.2),
(21, 8, 3, 5),
(22, 7, 6, 1),
(23, 5, 6, 1),
(24, 6, 6, 10);

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
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT de la tabla `Factura`
--
ALTER TABLE `Factura`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT de la tabla `Insumo`
--
ALTER TABLE `Insumo`
  MODIFY `Id_insumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `Persona`
--
ALTER TABLE `Persona`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `Producto`
--
ALTER TABLE `Producto`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `Receta`
--
ALTER TABLE `Receta`
  MODIFY `Id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
