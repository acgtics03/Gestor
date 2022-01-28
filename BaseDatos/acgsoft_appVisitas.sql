-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-01-2020 a las 12:25:11
-- Versión del servidor: 5.7.29
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `acgsoft_appVisitas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `fregistro` date NOT NULL,
  `user` varchar(30) NOT NULL,
  `ingreso` time NOT NULL,
  `irefrigerio` time DEFAULT NULL,
  `frefrigerio` time DEFAULT NULL,
  `salida` time DEFAULT NULL,
  `Estado` varchar(50) NOT NULL,
  `UpdateUser` varchar(100) DEFAULT NULL,
  `UpdateControl` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `LongIngreso` varchar(100) DEFAULT NULL,
  `LatIngreso` varchar(100) DEFAULT NULL,
  `LongRefini` varchar(100) DEFAULT NULL,
  `LatRefini` varchar(100) DEFAULT NULL,
  `LongReffinal` varchar(100) DEFAULT NULL,
  `LatReffinal` varchar(100) DEFAULT NULL,
  `LongSalida` varchar(100) DEFAULT NULL,
  `LatSalida` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `fregistro`, `user`, `ingreso`, `irefrigerio`, `frefrigerio`, `salida`, `Estado`, `UpdateUser`, `UpdateControl`, `LongIngreso`, `LatIngreso`, `LongRefini`, `LatRefini`, `LongReffinal`, `LatReffinal`, `LongSalida`, `LatSalida`) VALUES
(8, '2020-01-17', 'dtrinidad@acg-soft.com', '17:28:39', '17:32:27', NULL, NULL, 'INICIO_REFRIGERIO', NULL, '2020-01-17 22:32:27', '', '', '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centrocosto`
--

CREATE TABLE `centrocosto` (
  `iCodigo` int(2) NOT NULL,
  `sDescripcion` varchar(50) NOT NULL,
  `iEstado` int(11) NOT NULL,
  `dRegistroFecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `iRegistroUsuario` int(11) NOT NULL,
  `dModificacionFecha` datetime DEFAULT NULL,
  `iModificacionUsuario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `centrocosto`
--

INSERT INTO `centrocosto` (`iCodigo`, `sDescripcion`, `iEstado`, `dRegistroFecha`, `iRegistroUsuario`, `dModificacionFecha`, `iModificacionUsuario`) VALUES
(1, 'DUZKA', 1, '2019-10-04 17:33:43', 1, NULL, NULL),
(2, 'EL CLAN', 1, '2019-10-04 17:33:43', 1, NULL, NULL),
(3, 'FARENET', 1, '2019-10-04 17:33:43', 1, NULL, NULL),
(4, 'FONBIENES', 1, '2019-10-04 17:33:43', 1, NULL, NULL),
(5, 'FONTANELLA', 1, '2019-10-04 17:33:43', 1, NULL, NULL),
(6, 'FOOD PACK', 1, '2019-10-04 17:33:43', 1, NULL, NULL),
(7, 'GRUPO CELSO', 1, '2019-10-04 17:33:43', 1, NULL, NULL),
(8, 'HAVANNA', 1, '2019-10-04 17:33:43', 1, NULL, NULL),
(9, 'HOTEL CROWNE', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(10, 'HOTEL HOLIDAY', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(11, 'HUANCAHUASI', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(12, 'IMANES', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(13, 'JAPAN', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(14, 'JOHNSON', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(15, 'KALIKSZTEIN', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(16, 'KBM', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(17, 'KOKOPELLI', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(18, 'KRISPY', 1, '2019-10-04 17:33:44', 1, NULL, NULL),
(19, 'LA RIAZA', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(20, 'MAN PAN', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(21, 'MEGAMAR', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(22, 'MESACORP', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(23, 'MIYASATO', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(24, 'NABILA', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(25, 'OCEANUS', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(26, 'OLSA', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(27, 'ONASA HUANCAYO', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(28, 'ONASA LIMA', 1, '2019-10-04 17:33:45', 1, NULL, NULL),
(29, 'PAN DE LA CHOLA', 1, '2019-10-04 17:33:46', 1, NULL, NULL),
(30, 'PRODIS', 1, '2019-10-04 17:33:46', 1, NULL, NULL),
(31, 'ROCAZUL', 1, '2019-10-04 17:33:46', 1, NULL, NULL),
(32, 'ROMA', 1, '2019-10-04 17:33:46', 1, NULL, NULL),
(34, 'ROOSVELT', 1, '2019-10-04 17:33:46', 1, NULL, NULL),
(35, 'SANTOLIVO', 1, '2019-10-04 17:33:46', 1, NULL, NULL),
(37, 'SEGUNDO MUELLE', 1, '2019-10-04 17:33:46', 1, NULL, NULL),
(38, 'SEMILLAS', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(39, 'TONY ROMA\'S', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(40, 'TRACKLOG', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(41, 'TRUCK MOTORS', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(42, 'VISUAL IMPACT', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(43, 'DELICASS', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(44, 'APRILS', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(45, 'AROMATIKA', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(46, 'BACA', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(47, 'BENITES', 1, '2019-10-04 17:33:47', 1, NULL, NULL),
(48, 'CANTOL', 1, '2019-10-04 17:33:48', 1, NULL, NULL),
(49, 'CAPITALIA', 1, '2019-10-04 17:33:48', 1, NULL, NULL),
(50, 'CAPRICCIO', 1, '2019-10-04 17:33:48', 1, NULL, NULL),
(51, 'CDV', 1, '2019-10-04 17:33:48', 1, NULL, NULL),
(52, 'CONSORCIO HUACHIPA', 1, '2019-10-04 17:33:48', 1, NULL, NULL),
(53, 'CREAR', 1, '2019-10-04 17:33:48', 1, NULL, NULL),
(54, 'DEL PILAR', 1, '2019-10-04 17:33:48', 1, NULL, NULL),
(36, 'DISTRIBUIDORAS NABILA', 1, '2019-10-04 17:33:48', 1, NULL, NULL),
(33, 'ADMINISTRACION', 1, '2019-10-04 17:33:48', 1, NULL, NULL),
(55, 'ACG', 1, '2019-12-06 12:26:12', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigosrecuperacion`
--

CREATE TABLE `codigosrecuperacion` (
  `id` int(11) NOT NULL,
  `Codigo` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `RegControl` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `codigosrecuperacion`
--

INSERT INTO `codigosrecuperacion` (`id`, `Codigo`, `correo`, `RegControl`, `Estado`) VALUES
(1, 'p92wpc', 'dtrinidad@acg-soft.com', '2019-12-05 16:14:14', 0),
(2, 'kaa2x8', 'dtrinidad@acg-soft.com', '2019-12-05 16:22:14', 0),
(3, '0dgft7', 'dtrinidad@acg-soft.com', '2019-12-05 16:30:09', 0),
(4, '347u0z', 'dtrinidad@acg-soft.com', '2019-12-05 16:34:05', 0),
(5, 'rp8ms4', 'alarcon@acg-soft.com', '2019-12-05 16:39:11', 0),
(6, '85b4lw', 'dtrinidad@acg-soft.com', '2019-12-26 09:24:27', 0),
(7, 'dfgkj6', 'dtrinidad@acg-soft.com', '2020-01-02 14:34:02', 0),
(8, '0xys7d', 'dtrinidad@acg-soft.com', '2020-01-02 14:49:06', 0),
(9, 'wo4aib', 'Cpalomino@acg.com.pe', '2020-01-09 06:04:55', 0),
(10, 'fhgrld', 'dtrinidad@acg-soft.com', '2020-01-16 15:55:28', 0),
(11, 'n5bqz7', 'dtrinidad@acg-soft.com', '2020-01-16 15:58:31', 0),
(12, 'idt4nr', 'dtrinidad@acg-soft.com', '2020-01-16 16:11:30', 0),
(13, 'skdhwv', 'dtrinidad@acg-soft.com', '2020-01-16 16:26:12', 0),
(14, 'kljgo1', 'dtrinidad@acg-soft.com', '2020-01-16 16:32:31', 0),
(15, 'k4oi3o', 'dtrinidad@acg-soft.com', '2020-01-16 19:46:37', 0),
(16, 'pmm158', 'dtrinidad@acg-soft.com', '2020-01-16 19:52:35', 0),
(17, '0oa0hu', 'dtrinidad@acg-soft.com', '2020-01-16 20:01:45', 0),
(18, '5msp2v', 'dtrinidad@acg-soft.com', '2020-01-16 20:02:54', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrltarifa`
--

CREATE TABLE `ctrltarifa` (
  `iCtrlTarifa` int(11) NOT NULL,
  `iTarifa` int(11) NOT NULL,
  `tarifaReal` float NOT NULL,
  `idusuario` int(11) NOT NULL,
  `ControlRegister` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdateRegister` datetime DEFAULT NULL,
  `new` int(11) DEFAULT NULL,
  `new2` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `correlativo` int(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuario_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_permiso`
--

CREATE TABLE `horas_permiso` (
  `id` int(11) NOT NULL,
  `hora` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horas_permiso`
--

INSERT INTO `horas_permiso` (`id`, `hora`) VALUES
(1, '09:00:00'),
(2, '09:15:00'),
(3, '09:30:00'),
(4, '09:45:00'),
(5, '10:00:00'),
(6, '10:15:00'),
(7, '10:30:00'),
(8, '10:45:00'),
(9, '11:00:00'),
(10, '11:15:00'),
(11, '11:30:00'),
(12, '11:45:00'),
(13, '12:00:00'),
(14, '12:15:00'),
(15, '12:30:00'),
(16, '12:45:00'),
(17, '13:00:00'),
(18, '13:15:00'),
(19, '13:30:00'),
(20, '13:45:00'),
(21, '14:00:00'),
(22, '14:15:00'),
(23, '14:30:00'),
(24, '14:45:00'),
(25, '15:00:00'),
(26, '15:15:00'),
(27, '15:30:00'),
(28, '15:45:00'),
(29, '15:15:00'),
(30, '15:30:00'),
(31, '15:45:00'),
(32, '16:00:00'),
(33, '16:15:00'),
(34, '16:30:00'),
(35, '16:45:00'),
(36, '17:00:00'),
(37, '17:15:00'),
(38, '17:30:00'),
(39, '17:45:00'),
(40, '18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos`
--

CREATE TABLE `motivos` (
  `iCodigo` int(11) NOT NULL,
  `mdescripcion` varchar(50) NOT NULL,
  `iEstado` int(11) NOT NULL,
  `dRegistroFecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `iRegistroUsuario` int(11) NOT NULL,
  `dUpdateFecha` datetime DEFAULT NULL,
  `iUpdateUsuario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `motivos`
--

INSERT INTO `motivos` (`iCodigo`, `mdescripcion`, `iEstado`, `dRegistroFecha`, `iRegistroUsuario`, `dUpdateFecha`, `iUpdateUsuario`) VALUES
(1, 'Traslado', 1, '2019-12-05 12:42:02', 1, NULL, NULL),
(2, 'Reunion ACG', 1, '2019-12-05 12:42:02', 1, NULL, NULL),
(3, 'Propuesta Clientes', 1, '2019-12-05 12:42:40', 1, NULL, NULL),
(4, 'Reunion Clientes', 1, '2019-12-05 12:42:40', 1, NULL, NULL),
(5, 'Horas de Trabajo', 1, '2019-12-05 14:32:29', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_permiso`
--

CREATE TABLE `motivos_permiso` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL,
  `rfecha` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `motivos_permiso`
--

INSERT INTO `motivos_permiso` (`id`, `descripcion`, `estado`, `rfecha`) VALUES
(1, 'Salud', 1, '2019-12-27 10:53:00'),
(2, 'Familiar', 1, '2019-12-27 10:53:00'),
(3, 'Estudios', 1, '2019-12-27 10:53:00'),
(4, 'Personal', 1, '2019-12-27 10:53:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `fsol` date NOT NULL,
  `Tinicio` time NOT NULL,
  `Tfin` time NOT NULL,
  `motivo` varchar(10) NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `Trinicio` time DEFAULT NULL,
  `Trfin` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `user`, `fsol`, `Tinicio`, `Tfin`, `motivo`, `estado`, `Trinicio`, `Trfin`) VALUES
(44, 'dtrinidad@acg-soft.com', '2017-04-03', '00:00:00', '00:00:00', ' 3 ', NULL, '00:00:00', '00:00:00'),
(45, 'dtrinidad@acg-soft.com', '2017-03-03', '00:00:00', '00:00:00', ' 2 ', NULL, '00:00:00', '00:00:00'),
(46, 'dtrinidad@acg-soft.com', '2017-10-30', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(47, 'dtrinidad@acg-soft.com', '2019-12-31', '00:00:00', '00:00:00', ' 3 ', NULL, '00:00:00', '00:00:00'),
(48, 'dtrinidad@acg-soft.com', '2019-03-01', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(49, 'dtrinidad@acg-soft.com', '2019-04-03', '00:00:00', '00:00:00', ' 1 ', NULL, '00:00:00', '00:00:00'),
(50, 'dtrinidad@acg-soft.com', '2019-04-03', '00:00:00', '00:00:00', ' 1 ', NULL, '00:00:00', '00:00:00'),
(51, 'dtrinidad@acg-soft.com', '2019-09-04', '00:00:00', '00:00:00', ' 2 ', NULL, '00:00:00', '00:00:00'),
(52, 'dtrinidad@acg-soft.com', '2019-12-31', '00:00:00', '00:00:00', ' 2 ', NULL, '00:00:00', '00:00:00'),
(53, 'dtrinidad@acg-soft.com', '2019-12-31', '00:00:00', '00:00:00', ' 2 ', NULL, '00:00:00', '00:00:00'),
(54, 'dtrinidad@acg-soft.com', '2019-12-31', '00:00:00', '00:00:00', ' 2 ', NULL, '00:00:00', '00:00:00'),
(55, 'dtrinidad@acg-soft.com', '2019-04-03', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(56, 'dtrinidad@acg-soft.com', '2019-04-03', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(57, 'dtrinidad@acg-soft.com', '2019-02-08', '00:00:00', '00:00:00', ' 2 ', NULL, '00:00:00', '00:00:00'),
(58, 'dtrinidad@acg-soft.com', '2019-02-08', '00:00:00', '00:00:00', ' 3 ', NULL, '00:00:00', '00:00:00'),
(59, 'dtrinidad@acg-soft.com', '2019-01-23', '00:00:00', '00:00:00', ' 1 ', NULL, '00:00:00', '00:00:00'),
(60, 'dtrinidad@acg-soft.com', '2019-01-23', '00:00:00', '00:00:00', ' 1 ', NULL, '00:00:00', '00:00:00'),
(61, 'dtrinidad@acg-soft.com', '2019-01-25', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(62, 'dtrinidad@acg-soft.com', '2019-02-14', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(63, 'dtrinidad@acg-soft.com', '2020-02-01', '00:00:00', '00:00:00', ' 1 ', NULL, '00:00:00', '00:00:00'),
(64, 'dtrinidad@acg-soft.com', '2019-02-01', '00:00:00', '00:00:00', ' 1 ', NULL, '00:00:00', '00:00:00'),
(65, 'dtrinidad@acg-soft.com', '2019-02-14', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(66, 'dtrinidad@acg-soft.com', '2019-02-14', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(67, 'dtrinidad@acg-soft.com', '2019-02-15', '00:00:00', '00:00:00', ' 3 ', NULL, '00:00:00', '00:00:00'),
(68, '', '2019-02-15', '00:00:00', '00:00:00', ' 3 ', NULL, '00:00:00', '00:00:00'),
(69, 'dtrinidad@acg-soft.com', '2019-02-16', '00:00:00', '00:00:00', ' 4 ', 'FIN PERMISO', '00:00:00', '00:00:00'),
(70, '', '2020-01-01', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(71, 'dtrinidad@acg-soft.com', '2020-01-10', '00:00:00', '00:00:00', ' 4 ', 'APROBADO', '00:00:00', '00:00:00'),
(72, 'dtrinidad@acg-soft.com', '2020-01-05', '00:00:00', '00:00:00', '4', 'FIN PERMISO', '00:00:00', '00:00:00'),
(73, 'dtrinidad@acg-soft.com', '2020-01-07', '00:00:00', '00:00:00', ' 2 ', 'FIN PERMISO', '00:00:00', '00:00:00'),
(74, 'dangulo@acg.com.pe', '2020-01-05', '00:00:00', '00:00:00', ' 4 ', NULL, '00:00:00', '00:00:00'),
(75, 'dtrinidad@acg-soft.com', '2020-01-08', '00:00:00', '00:00:00', ' 2 ', 'FIN PERMISO', '00:00:00', '00:00:00'),
(76, 'dtrinidad@acg-soft.com', '2020-01-02', '00:00:00', '00:00:00', ' 3 ', 'FIN PERMISO', '00:00:00', '00:00:00'),
(77, 'dangulo@acg.com.pe', '2020-01-02', '00:00:00', '00:00:00', ' 4 ', 'FIN PERMISO', '00:00:00', '00:00:00'),
(78, 'dangulo@acg.com.pe', '2020-01-14', '09:00:00', '10:00:00', ' 3 ', 'POR APROBAR', NULL, NULL),
(79, 'cpalomino@acg.com.pe', '2020-01-02', '00:00:01', '00:00:14', ' 3 ', 'FIN PERMISO', NULL, NULL),
(80, 'dtrinidad@acg-soft.com', '2020-01-09', '00:00:01', '00:00:17', ' 2 ', 'FIN PERMISO', NULL, NULL),
(81, 'dtrinidad@acg-soft.com', '2020-01-09', '00:00:01', '00:00:20', ' 3 ', 'FIN PERMISO', NULL, NULL),
(82, 'dtrinidad@acg-soft.com', '2020-01-09', '00:00:05', '00:00:13', ' 2 ', 'FIN PERMISO', NULL, NULL),
(83, 'dtrinidad@acg-soft.com', '2020-01-09', '00:00:03', '00:00:16', ' 3 ', 'FIN PERMISO', NULL, NULL),
(84, 'dtrinidad@acg-soft.com', '2020-01-09', '00:00:12', '00:00:16', ' 3 ', 'POR APROBAR', NULL, NULL),
(85, 'dtrinidad@acg-soft.com', '2020-01-10', '00:00:06', '00:00:14', ' 3 ', 'APROBADO', NULL, NULL),
(86, 'dtrinidad@acg-soft.com', '2020-01-11', '09:15:00', '12:45:00', ' 2 ', 'APROBADO', NULL, NULL),
(87, 'dtrinidad@acg-soft.com', '2020-01-12', '10:00:00', '12:45:00', ' 4 ', 'APROBADO', NULL, NULL),
(88, 'dtrinidad@acg-soft.com', '2020-01-13', '09:45:00', '16:30:00', ' 4 ', 'APROBADO', NULL, NULL),
(89, 'dtrinidad@acg-soft.com', '2020-01-14', '10:15:00', '17:45:00', ' 4 ', 'FIN PERMISO', '17:59:19', '17:59:21'),
(90, 'dangulo@acg.com.pe', '2020-01-17', '09:45:00', '17:00:00', ' 3 ', 'POR APROBAR', NULL, NULL),
(91, 'dtrinidad@acg-soft.com', '2020-01-18', '09:30:00', '10:30:00', ' 1 ', 'APROBADO', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idcliente` int(11) NOT NULL,
  `DNI` int(8) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` text,
  `Telefono` int(9) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `ControlRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  `idusuario` varchar(100) DEFAULT NULL,
  `UserUpdate` varchar(100) DEFAULT NULL,
  `idCargo` varchar(25) DEFAULT NULL,
  `idArea` varchar(25) DEFAULT NULL,
  `idJefeInmediato` varchar(30) DEFAULT NULL,
  `EstadoCuenta` varchar(50) DEFAULT NULL,
  `CostoxHora` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idcliente`, `DNI`, `apellido`, `nombre`, `direccion`, `Telefono`, `estatus`, `ControlRegistro`, `idusuario`, `UserUpdate`, `idCargo`, `idArea`, `idJefeInmediato`, `EstadoCuenta`, `CostoxHora`) VALUES
(1, 0, 'Palomino	', 'Cesar	', NULL, NULL, 1, '2020-01-15 19:48:10', 'cpalomino@acg.com.pe', NULL, NULL, NULL, '		', 'REGISTRADO', 0),
(2, 0, 'Huamancusi	', 'Carmen Rosa	', NULL, NULL, 1, '2020-01-15 19:48:10', 'gerencia@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(3, 0, 'Angulo	', 'Diego Paolo	', NULL, NULL, 1, '2020-01-15 19:48:10', 'dangulo@acg.com.pe	', NULL, NULL, NULL, 'cpalomino@acg.com.pe	', 'PENDIENTE', 0),
(4, 0, 'Saravia	', 'Luis Felipe	', NULL, NULL, 1, '2020-01-15 19:48:10', 'fsaravia@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(5, 0, 'Bohorquez	', 'Miluska Melanie	', NULL, NULL, 1, '2020-01-15 19:48:10', 'mbohorquez@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(6, 0, 'Gongora	', 'Marilyn	', NULL, NULL, 1, '2020-01-15 19:48:10', 'asesores@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(7, 0, 'Ordinola	', 'Maria Del Carmen	', NULL, NULL, 1, '2020-01-15 19:48:10', 'cordinola@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(8, 0, 'Llamoja	', 'Vanessa Victoria	', NULL, NULL, 1, '2020-01-15 19:48:10', 'vllamoja@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(9, 0, 'Carbajal	', 'Alexander Mario	', NULL, NULL, 1, '2020-01-15 19:48:10', 'acarbajal@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(10, 0, 'Chirinos	', 'Aibby Tatiana	', NULL, NULL, 1, '2020-01-15 19:48:10', 'achirinos@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(11, 0, 'Leon	', 'Alex Javier	', NULL, NULL, 1, '2020-01-15 19:48:10', 'aleon@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(12, 0, 'Padilla	', 'Aldair Frank	', NULL, NULL, 1, '2020-01-15 19:48:10', 'apadilla@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(13, 0, 'Rivas	', 'Ana	', NULL, NULL, 1, '2020-01-15 19:48:10', 'arivas@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(14, 0, 'Aguilar	', 'Bryan Stanislaw	', NULL, NULL, 1, '2020-01-15 19:48:10', 'baguilar@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(15, 0, 'Peña	', 'Brenner Fabio	', NULL, NULL, 1, '2020-01-15 19:48:10', 'bpeña@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(16, 0, 'Izaguirre	', 'Carlos Enrique	', NULL, NULL, 1, '2020-01-15 19:48:10', 'cizaguirre@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(17, 0, 'Lobo	', 'Cesar	', NULL, NULL, 1, '2020-01-15 19:48:10', 'clobo@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(18, 0, 'Salas	', 'Cesar	', NULL, NULL, 1, '2020-01-15 19:48:10', 'csalas@acg.com.pe	', NULL, NULL, NULL, 'oonasa@acg.com.pe	', 'PENDIENTE', 0),
(19, 0, 'Yauri	', 'Cecilia Mercedes	', NULL, NULL, 1, '2020-01-15 19:48:10', 'cyauri@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(20, 0, 'Moreno	', 'Dick Josue	', NULL, NULL, 1, '2020-01-15 19:48:10', 'dmoreno@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(21, 0, 'Quijaite	', 'Diego Alexis	', NULL, NULL, 1, '2020-01-15 19:48:10', 'dquijaite@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(22, 0, 'Suarez	', 'Diana	', NULL, NULL, 1, '2020-01-15 19:48:10', 'dsuarez@acg.com.pe	', NULL, NULL, NULL, 'kramirez@acg.com.pe	', 'PENDIENTE', 0),
(23, 0, 'Ancana	', 'Edson Nathaniel	', NULL, NULL, 1, '2020-01-15 19:48:10', 'eancana@acg.com.pe	', NULL, NULL, NULL, 'kramirez@acg.com.pe	', 'PENDIENTE', 0),
(24, 0, 'Araujo	', 'Eliza Yanira	', NULL, NULL, 1, '2020-01-15 19:48:10', 'earaujo@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(25, 0, 'Perez	', 'Editza Michelly	', NULL, NULL, 1, '2020-01-15 19:48:10', 'eperez@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(26, 0, '	Román	', '	Elisa Cynthia	', NULL, NULL, 1, '2020-01-15 19:48:10', '	eroman@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(27, 0, '	Carhuancho	', '	Franklin	', NULL, NULL, 1, '2020-01-15 19:48:10', '	fcarhuancho@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(28, 0, '	Paredes	', '	Frank Josue	', NULL, NULL, 1, '2020-01-15 19:48:10', '	fparedes@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(29, 0, '	Delgado	', '	Giovanna Narda	', NULL, NULL, 1, '2020-01-15 19:48:10', '	gdelgado@acg.com.pe	', NULL, NULL, NULL, '	arivas@acg.com.pe	', 'PENDIENTE', 0),
(30, 0, '	Aguado	', '	Isabel Alejandra	', NULL, NULL, 1, '2020-01-15 19:48:10', '	iaguado@acg.com.pe	', NULL, NULL, NULL, '	kramirez@acg.com.pe	', 'PENDIENTE', 0),
(31, 0, '	Ccahuana	', '	Ismael	', NULL, NULL, 1, '2020-01-15 19:48:10', '	iccahuana@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(32, 0, '	Cruz	', '	Isidro Abel	', NULL, NULL, 1, '2020-01-15 19:48:10', '	icruz@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(33, 0, '	Petrovich	', '	Ian Kevin	', NULL, NULL, 1, '2020-01-15 19:48:10', '	ipetrovich@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(34, 0, '	Cucho	', '	Jaime	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jcucho@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(35, 0, '	Cuenca	', '	Jhonny Cristhian	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jcuenca@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(36, 0, '	Gongora	', '	Jacqueline Poulet	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jgongora@acg.com.pe	', NULL, NULL, NULL, '	arivas@acg.com.pe	', 'PENDIENTE', 0),
(37, 0, '	López	', '	Jose Smith	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jlopez@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(38, 0, '	Lozano	', '	Julissa Aurea	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jlozano@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(39, 0, '	Oscco	', '	José	', NULL, NULL, 1, '2020-01-15 19:48:10', '	joscco@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(40, 0, '	Pereda	', '	Jose Antonio	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jperedar@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(41, 0, '	Pereyra	', '	Judith Milagros	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jpereyra@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(42, 0, '	Quintanilla	', '	Jhon Alan	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jquintanilla@acg.com.pe	', NULL, NULL, NULL, '	oonasa@acg.com.pe	', 'PENDIENTE', 0),
(43, 0, '	Rivas	', '	Jose Arturo	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jrivas@acg.com.pe	', NULL, NULL, NULL, '	arivas@acg.com.pe	', 'PENDIENTE', 0),
(44, 0, '	Román	', '	Jennifer	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jroman@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(45, 0, '	Romero	', '	Jessica Tatiana	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jromero@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(46, 0, '	Tamaríz	', '	Juan Carlos	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jtamariz@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(47, 0, '	Unocc	', '	Juan Carlos	', NULL, NULL, 1, '2020-01-15 19:48:10', '	junocc@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(48, 0, '	Yurivilca	', '	José Antonio	', NULL, NULL, 1, '2020-01-15 19:48:10', '	glpi	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(49, 0, '	Cuba	', '	Karina Sofia	', NULL, NULL, 1, '2020-01-15 19:48:10', '	kcuba@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(50, 0, '	Laura	', '	Katia Elizabeth	', NULL, NULL, 1, '2020-01-15 19:48:10', '	klaura@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(51, 0, '	Ortiz	', '	Katty Fiorella	', NULL, NULL, 1, '2020-01-15 19:48:10', '	kortiz@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(52, 0, '	Ramírez	', '	Kely	', NULL, NULL, 1, '2020-01-15 19:48:10', '	kramirez@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(53, 0, '	Valverde	', '	Karin	', NULL, NULL, 1, '2020-01-15 19:48:10', '	kvalverde@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(54, 0, '	Ayala	', '	Liliana	', NULL, NULL, 1, '2020-01-15 19:48:10', '	layala@acg.com.pe	', NULL, NULL, NULL, '	rscruz@acg.com.pe	', 'PENDIENTE', 0),
(55, 0, '	Dulanto	', '	Luis	', NULL, NULL, 1, '2020-01-15 19:48:10', '	ldulanto@acg.com.pe	', NULL, NULL, NULL, '	rscruz@acg.com.pe	', 'PENDIENTE', 0),
(56, 0, '	Milian	', '	Leonardo	', NULL, NULL, 1, '2020-01-15 19:48:10', '	lmilian@acg.com.pe	', NULL, NULL, NULL, '	oonasa@acg.com.pe	', 'PENDIENTE', 0),
(57, 0, '	Cartagena	', '	María	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mcartagena@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(58, 0, '	Condori	', '	Meliza	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mcondori@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(59, 0, '	Llanos	', '	Merlle	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mllanos@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(60, 0, '	López	', '	Merlhit	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mlopez@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(61, 0, '	Morales	', '	María	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mmorales@acg.com.pe	', NULL, NULL, NULL, '	oonasa@acg.com.pe	', 'PENDIENTE', 0),
(62, 0, '	Naupa	', '	Micaela	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mnaupa@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(63, 0, '	Ramos	', '	María Sarita	', NULL, NULL, 1, '2020-01-15 19:48:10', '	maria@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(64, 0, '	Rodas	', '	Max	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mrodas@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(65, 0, '	Ruíz	', '	Michel	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mruiz@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(66, 0, '	Valverde	', '	Mercedes	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mvalverde@acg.com.pe	', NULL, NULL, NULL, '	oonasa@acg.com.pe	', 'PENDIENTE', 0),
(67, 0, '	Zamudio	', '	María	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mzamudio@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(68, 0, '	Santos	', '	Noemí	', NULL, NULL, 1, '2020-01-15 19:48:10', '	nsantos@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(69, 0, '	Santivañez	', '	Oscar	', NULL, NULL, 1, '2020-01-15 19:48:10', '	osantivañez@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(70, 0, '	Fernández	', '	Pablo	', NULL, NULL, 1, '2020-01-15 19:48:10', '	pfernandez@acg.com.pe	', NULL, NULL, NULL, '	rscruz@acg.com.pe	', 'PENDIENTE', 0),
(71, 0, '	Huamán	', '	Pamela	', NULL, NULL, 1, '2020-01-15 19:48:10', '	phuaman@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(72, 0, '	Repoma	', '	Pedro	', NULL, NULL, 1, '2020-01-15 19:48:10', '	prepoma@acg.com.pe	', NULL, NULL, NULL, '	kramirez@acg.com.pe	', 'PENDIENTE', 0),
(73, 0, '	Bedón	', '	Rosalvina	', NULL, NULL, 1, '2020-01-15 19:48:10', '	rbedon@acg.com.pe	', NULL, NULL, NULL, '	oonasa@acg.com.pe	', 'PENDIENTE', 0),
(74, 0, '	Bermeo	', '	Rosa	', NULL, NULL, 1, '2020-01-15 19:48:10', '	rbermeo@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(75, 0, '	cruz	', '	Rossmery	', NULL, NULL, 1, '2020-01-15 19:48:10', '	rcruz@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(76, 0, '	Levano	', '	Ruben	', NULL, NULL, 1, '2020-01-15 19:48:10', '	rlevano@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(77, 0, '	Apolinario	', '	Susana	', NULL, NULL, 1, '2020-01-15 19:48:10', '	sapolinario@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(78, 0, '	Arque	', '	Sandra	', NULL, NULL, 1, '2020-01-15 19:48:10', '	sarque@acg.com.pe	', NULL, NULL, NULL, '	kramirez@acg.com.pe	', 'PENDIENTE', 0),
(79, 0, '	Moreno	', '	Teresa	', NULL, NULL, 1, '2020-01-15 19:48:10', '	tmoreno@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(80, 0, '	Jaime	', '	Yanet	', NULL, NULL, 1, '2020-01-15 19:48:10', '	yjaime@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(81, 0, '	Meléndez	', '	Yessica	', NULL, NULL, 1, '2020-01-15 19:48:10', '	ymelendez@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(82, 0, '	Torero	', '	Yesenia	', NULL, NULL, 1, '2020-01-15 19:48:10', '	ytorero@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(83, 0, '	Zapata	', '	Enrique	', NULL, NULL, 1, '2020-01-15 19:48:10', '	ezapata@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(84, 0, '	Díaz	', '	Jesús	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jdiaz@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(85, 0, '	Fernández	', '	María del Rosario	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mfernandez@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(86, 0, '	Alarcón	', '	Zadith	', NULL, NULL, 1, '2020-01-15 19:48:10', '	zalarcon@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(87, 0, '	Arhuata	', '	Abrahan	', NULL, NULL, 1, '2020-01-15 19:48:10', '	aarhuata@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(88, 0, '	Pereda	', '	Jessica	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jpereda@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(89, 0, '	Góngora	', '	Milton	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mgongora@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(90, 0, '	Mendoza	', '	Alí	', NULL, NULL, 1, '2020-01-15 19:48:10', '	amendoza@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(91, 0, '	Rosas	', '	Arturo	', NULL, NULL, 1, '2020-01-15 19:48:10', '	arosas@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(92, 0, '	Patron	', '	José	', NULL, NULL, 1, '2020-01-15 19:48:10', '	jpatron@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(93, 0, '	Yaurima	', '	Kevin	', NULL, NULL, 1, '2020-01-15 19:48:10', '	soporte@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(94, 0, '	Salazar	', '	Amelia	', NULL, NULL, 1, '2020-01-15 19:48:10', '	asalazar@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(95, 0, '	Centeno	', '	Beygina	', NULL, NULL, 1, '2020-01-15 19:48:10', '	bcenteno@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(96, 0, '	realname	', '	firstname	', NULL, NULL, 1, '2020-01-15 19:48:10', '	email	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(97, 0, '	Dávila	', '	Gian Pier	', NULL, NULL, 1, '2020-01-15 19:48:10', '	gpdavila@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(98, 0, '	Rivero	', '	Marilyn	', NULL, NULL, 1, '2020-01-15 19:48:10', '	mrivero@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(99, 0, '	Usquiano	', '	Patricia	', NULL, NULL, 1, '2020-01-15 19:48:10', '	pusquiano@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(100, 0, '	Sicha	', '	Ursula	', NULL, NULL, 1, '2020-01-15 19:48:10', '	usicha@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(101, 0, '	Contreras	', '	Yuti	', NULL, NULL, 1, '2020-01-15 19:48:10', '	ycontreras@acg.com.pe	', NULL, NULL, NULL, '		', 'PENDIENTE', 0),
(102, 70186791, 'Trinidad', 'Diego', NULL, NULL, 1, '2020-01-15 22:15:33', 'dtrinidad@acg-soft.com', NULL, NULL, NULL, 'cpalomino@acg.com.pe', 'REGISTRADO', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProcesoAsistencia`
--

CREATE TABLE `ProcesoAsistencia` (
  `ProceAsist` int(11) NOT NULL,
  `User` varchar(110) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ProcesoAsistencia`
--

INSERT INTO `ProcesoAsistencia` (`ProceAsist`, `User`, `Estado`, `Fecha`) VALUES
(1, 'dtrinidad@acg-soft.com', 'INGRESO', '2020-01-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `idprueba` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `clave` binary(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prueba`
--

INSERT INTO `prueba` (`idprueba`, `user`, `clave`) VALUES
(1, 'acgcom', 0x31323300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Vendedor'),
(4, 'Contador'),
(5, 'Analista'),
(6, 'Gerencia'),
(7, 'Asistente'),
(8, 'Auditor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE `tarifa` (
  `iTarifa` int(11) NOT NULL,
  `TarifaReferencial` double NOT NULL,
  `LugarOrigen` int(11) NOT NULL,
  `LugarDestino` int(11) NOT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `UserUpdate` varchar(100) DEFAULT NULL,
  `ControlRegister` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdateRegister` varchar(110) DEFAULT NULL,
  `TarPromMesUlt` float DEFAULT NULL,
  `TarPromMesPU` double DEFAULT NULL,
  `TarifaReal` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`iTarifa`, `TarifaReferencial`, `LugarOrigen`, `LugarDestino`, `Usuario`, `UserUpdate`, `ControlRegister`, `UpdateRegister`, `TarPromMesUlt`, `TarPromMesPU`, `TarifaReal`) VALUES
(1, 1, 55, 1, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(2, 1.5, 55, 2, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(3, 2, 55, 3, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(4, 2.5, 55, 4, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(5, 3, 55, 5, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(6, 3.5, 55, 6, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(7, 4, 55, 7, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(8, 4.5, 55, 8, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(9, 5, 55, 9, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(10, 5.5, 55, 10, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(11, 6, 55, 11, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(12, 6.5, 55, 12, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(13, 7, 55, 13, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(14, 7.5, 55, 14, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(15, 8, 55, 15, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(16, 1.3, 55, 16, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(17, 2, 55, 17, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(18, 2.7, 55, 18, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(19, 3.4, 55, 19, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(20, 4.1, 55, 20, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(21, 4.8, 55, 21, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(22, 5.5, 55, 22, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(23, 6.2, 55, 23, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(24, 6.9, 55, 24, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(25, 7.6, 55, 25, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(26, 8.3, 55, 26, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(27, 9, 55, 27, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(28, 9.7, 55, 28, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(29, 10.4, 55, 29, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(30, 11.1, 55, 30, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(31, 11.8, 55, 31, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(32, 12.5, 55, 32, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(33, 13.2, 55, 33, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(34, 13.9, 55, 34, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(35, 14.6, 55, 35, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(36, 15.3, 55, 36, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(37, 4, 55, 37, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(38, 4.6, 55, 38, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(39, 5.2, 55, 39, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(40, 5.8, 55, 40, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(41, 6.4, 55, 41, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(42, 7, 55, 42, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(43, 7.6, 55, 43, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(44, 8.2, 55, 44, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(45, 8.8, 55, 45, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(46, 9.4, 55, 46, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(47, 10, 55, 47, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(48, 10.6, 55, 48, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(49, 11.2, 55, 49, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(50, 11.8, 55, 50, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(51, 12.4, 55, 51, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(52, 13, 55, 52, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(53, 13.6, 55, 53, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(54, 14.2, 55, 54, 'Sistema', NULL, '2020-01-15 20:32:27', NULL, NULL, NULL, NULL),
(55, 1, 54, 1, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(56, 1.5, 54, 2, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(57, 2, 54, 3, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(58, 2.5, 54, 4, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(59, 3, 54, 5, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(60, 3.5, 54, 6, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(61, 4, 54, 7, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(62, 4.5, 54, 8, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(63, 5, 54, 9, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(64, 5.5, 54, 10, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(65, 6, 54, 11, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(66, 6.5, 54, 12, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(67, 7, 54, 13, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(68, 7.5, 54, 14, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(69, 8, 54, 15, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(70, 1.3, 54, 16, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(71, 2, 54, 17, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(72, 2.7, 54, 18, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(73, 3.4, 54, 19, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(74, 4.1, 54, 20, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(75, 4.8, 54, 21, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(76, 5.5, 54, 22, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(77, 6.2, 54, 23, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(78, 6.9, 54, 24, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(79, 7.6, 54, 25, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(80, 8.3, 54, 26, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(81, 9, 54, 27, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(82, 9.7, 54, 28, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(83, 10.4, 54, 29, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(84, 11.1, 54, 30, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(85, 11.8, 54, 31, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(86, 12.5, 54, 32, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(87, 13.2, 54, 33, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(88, 13.9, 54, 34, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(89, 14.6, 54, 35, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(90, 15.3, 54, 36, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(91, 4, 54, 37, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(92, 4.6, 54, 38, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(93, 5.2, 54, 39, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(94, 5.8, 54, 40, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(95, 6.4, 54, 41, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(96, 7, 54, 42, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(97, 7.6, 54, 43, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(98, 8.2, 54, 44, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(99, 8.8, 54, 45, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(100, 9.4, 54, 46, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(101, 10, 54, 47, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(102, 10.6, 54, 48, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(103, 11.2, 54, 49, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(104, 11.8, 54, 50, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(105, 12.4, 54, 51, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(106, 13, 54, 52, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(107, 13.6, 54, 53, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(108, 14.2, 54, 55, 'Sistema', NULL, '2020-01-15 20:34:17', NULL, NULL, NULL, NULL),
(109, 1, 53, 1, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(110, 1.5, 53, 2, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(111, 2, 53, 3, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(112, 2.5, 53, 4, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(113, 3, 53, 5, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(114, 3.5, 53, 6, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(115, 4, 53, 7, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(116, 4.5, 53, 8, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(117, 5, 53, 9, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(118, 5.5, 53, 10, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(119, 6, 53, 11, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(120, 6.5, 53, 12, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(121, 7, 53, 13, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(122, 7.5, 53, 14, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(123, 8, 53, 15, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(124, 1.3, 53, 16, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(125, 2, 53, 17, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(126, 2.7, 53, 18, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(127, 3.4, 53, 19, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(128, 4.1, 53, 20, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(129, 4.8, 53, 21, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(130, 5.5, 53, 22, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(131, 6.2, 53, 23, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(132, 6.9, 53, 24, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(133, 7.6, 53, 25, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(134, 8.3, 53, 26, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(135, 9, 53, 27, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(136, 9.7, 53, 28, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(137, 10.4, 53, 29, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(138, 11.1, 53, 30, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(139, 11.8, 53, 31, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(140, 12.5, 53, 32, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(141, 13.2, 53, 33, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(142, 13.9, 53, 34, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(143, 14.6, 53, 35, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(144, 15.3, 53, 36, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(145, 4, 53, 37, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(146, 4.6, 53, 38, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(147, 5.2, 53, 39, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(148, 5.8, 53, 40, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(149, 6.4, 53, 41, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(150, 7, 53, 42, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(151, 7.6, 53, 43, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(152, 8.2, 53, 44, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(153, 8.8, 53, 45, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(154, 9.4, 53, 46, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(155, 10, 53, 47, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(156, 10.6, 53, 48, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(157, 11.2, 53, 49, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(158, 11.8, 53, 50, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(159, 12.4, 53, 51, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(160, 13, 53, 52, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(161, 13.6, 53, 54, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(162, 14.2, 53, 55, '	Sistema	', NULL, '2020-01-15 20:37:22', NULL, NULL, NULL, NULL),
(163, 1, 52, 1, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(164, 1.5, 52, 2, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(165, 2, 52, 3, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(166, 2.5, 52, 4, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(167, 3, 52, 5, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(168, 3.5, 52, 6, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(169, 4, 52, 7, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(170, 4.5, 52, 8, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(171, 5, 52, 9, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(172, 5.5, 52, 10, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(173, 6, 52, 11, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(174, 6.5, 52, 12, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(175, 7, 52, 13, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(176, 7.5, 52, 14, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(177, 8, 52, 15, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(178, 1.3, 52, 16, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(179, 2, 52, 17, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(180, 2.7, 52, 18, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(181, 3.4, 52, 19, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(182, 4.1, 52, 20, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(183, 4.8, 52, 21, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(184, 5.5, 52, 22, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(185, 6.2, 52, 23, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(186, 6.9, 52, 24, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(187, 7.6, 52, 25, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(188, 8.3, 52, 26, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(189, 9, 52, 27, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(190, 9.7, 52, 28, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(191, 10.4, 52, 29, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(192, 11.1, 52, 30, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(193, 11.8, 52, 31, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(194, 12.5, 52, 32, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(195, 13.2, 52, 33, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(196, 13.9, 52, 34, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(197, 14.6, 52, 35, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(198, 15.3, 52, 36, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(199, 4, 52, 37, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(200, 4.6, 52, 38, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(201, 5.2, 52, 39, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(202, 5.8, 52, 40, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(203, 6.4, 52, 41, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(204, 7, 52, 42, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(205, 7.6, 52, 43, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(206, 8.2, 52, 44, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(207, 8.8, 52, 45, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(208, 9.4, 52, 46, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(209, 10, 52, 47, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(210, 10.6, 52, 48, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(211, 11.2, 52, 49, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(212, 11.8, 52, 50, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(213, 12.4, 52, 51, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(214, 13, 52, 53, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(215, 13.6, 52, 54, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(216, 14.2, 52, 55, '	Sistema	', NULL, '2020-01-15 20:38:09', NULL, NULL, NULL, NULL),
(217, 1, 51, 1, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(218, 1.5, 51, 2, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(219, 2, 51, 3, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(220, 2.5, 51, 4, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(221, 3, 51, 5, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(222, 3.5, 51, 6, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(223, 4, 51, 7, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(224, 4.5, 51, 8, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(225, 5, 51, 9, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(226, 5.5, 51, 10, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(227, 6, 51, 11, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(228, 6.5, 51, 12, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(229, 7, 51, 13, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(230, 7.5, 51, 14, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(231, 8, 51, 15, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(232, 1.3, 51, 16, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(233, 2, 51, 17, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(234, 2.7, 51, 18, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(235, 3.4, 51, 19, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(236, 4.1, 51, 20, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(237, 4.8, 51, 21, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(238, 5.5, 51, 22, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(239, 6.2, 51, 23, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(240, 6.9, 51, 24, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(241, 7.6, 51, 25, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(242, 8.3, 51, 26, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(243, 9, 51, 27, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(244, 9.7, 51, 28, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(245, 10.4, 51, 29, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(246, 11.1, 51, 30, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(247, 11.8, 51, 31, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(248, 12.5, 51, 32, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(249, 13.2, 51, 33, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(250, 13.9, 51, 34, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(251, 14.6, 51, 35, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(252, 15.3, 51, 36, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(253, 4, 51, 37, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(254, 4.6, 51, 38, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(255, 5.2, 51, 39, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(256, 5.8, 51, 40, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(257, 6.4, 51, 41, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(258, 7, 51, 42, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(259, 7.6, 51, 43, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(260, 8.2, 51, 44, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(261, 8.8, 51, 45, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(262, 9.4, 51, 46, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(263, 10, 51, 47, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(264, 10.6, 51, 48, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(265, 11.2, 51, 49, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(266, 11.8, 51, 50, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(267, 12.4, 51, 51, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(268, 13, 51, 53, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(269, 13.6, 51, 54, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(270, 14.2, 51, 55, '	Sistema	', NULL, '2020-01-15 20:39:03', NULL, NULL, NULL, NULL),
(271, 1, 50, 1, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(272, 1.5, 50, 2, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(273, 2, 50, 3, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(274, 2.5, 50, 4, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(275, 3, 50, 5, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(276, 3.5, 50, 6, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(277, 4, 50, 7, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(278, 4.5, 50, 8, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(279, 5, 50, 9, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(280, 5.5, 50, 10, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(281, 6, 50, 11, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(282, 6.5, 50, 12, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(283, 7, 50, 13, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(284, 7.5, 50, 14, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(285, 8, 50, 15, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(286, 1.3, 50, 16, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(287, 2, 50, 17, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(288, 2.7, 50, 18, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(289, 3.4, 50, 19, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(290, 4.1, 50, 20, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(291, 4.8, 50, 21, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(292, 5.5, 50, 22, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(293, 6.2, 50, 23, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(294, 6.9, 50, 24, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(295, 7.6, 50, 25, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(296, 8.3, 50, 26, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(297, 9, 50, 27, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(298, 9.7, 50, 28, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(299, 10.4, 50, 29, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(300, 11.1, 50, 30, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(301, 11.8, 50, 31, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(302, 12.5, 50, 32, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(303, 13.2, 50, 33, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(304, 13.9, 50, 34, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(305, 14.6, 50, 35, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(306, 15.3, 50, 36, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(307, 4, 50, 37, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(308, 4.6, 50, 38, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(309, 5.2, 50, 39, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(310, 5.8, 50, 40, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(311, 6.4, 50, 41, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(312, 7, 50, 42, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(313, 7.6, 50, 43, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(314, 8.2, 50, 44, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(315, 8.8, 50, 45, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(316, 9.4, 50, 46, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(317, 10, 50, 47, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(318, 10.6, 50, 48, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(319, 11.2, 50, 49, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(320, 11.8, 50, 51, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(321, 12.4, 50, 52, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(322, 13, 50, 53, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(323, 13.6, 50, 54, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(324, 14.2, 50, 55, '	Sistema	', NULL, '2020-01-15 20:39:55', NULL, NULL, NULL, NULL),
(325, 1, 49, 1, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(326, 1.5, 49, 2, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(327, 2, 49, 3, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(328, 2.5, 49, 4, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(329, 3, 49, 5, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(330, 3.5, 49, 6, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(331, 4, 49, 7, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(332, 4.5, 49, 8, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(333, 5, 49, 9, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(334, 5.5, 49, 10, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(335, 6, 49, 11, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(336, 6.5, 49, 12, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(337, 7, 49, 13, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(338, 7.5, 49, 14, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(339, 8, 49, 15, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(340, 1.3, 49, 16, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(341, 2, 49, 17, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(342, 2.7, 49, 18, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(343, 3.4, 49, 19, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(344, 4.1, 49, 20, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(345, 4.8, 49, 21, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(346, 5.5, 49, 22, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(347, 6.2, 49, 23, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(348, 6.9, 49, 24, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(349, 7.6, 49, 25, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(350, 8.3, 49, 26, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(351, 9, 49, 27, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(352, 9.7, 49, 28, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(353, 10.4, 49, 29, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(354, 11.1, 49, 30, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(355, 11.8, 49, 31, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(356, 12.5, 49, 32, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(357, 13.2, 49, 33, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(358, 13.9, 49, 34, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(359, 14.6, 49, 35, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(360, 15.3, 49, 36, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(361, 4, 49, 37, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(362, 4.6, 49, 38, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(363, 5.2, 49, 39, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(364, 5.8, 49, 40, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(365, 6.4, 49, 41, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(366, 7, 49, 42, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(367, 7.6, 49, 43, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(368, 8.2, 49, 44, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(369, 8.8, 49, 45, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(370, 9.4, 49, 46, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(371, 10, 49, 47, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(372, 10.6, 49, 48, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(373, 11.2, 49, 50, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(374, 11.8, 49, 51, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(375, 12.4, 49, 52, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(376, 13, 49, 53, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(377, 13.6, 49, 54, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(378, 14.2, 49, 55, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(379, 1, 48, 1, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(380, 1.5, 48, 2, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(381, 2, 48, 3, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(382, 2.5, 48, 4, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(383, 3, 48, 5, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(384, 3.5, 48, 6, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(385, 4, 48, 7, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(386, 4.5, 48, 8, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(387, 5, 48, 9, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(388, 5.5, 48, 10, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(389, 6, 48, 11, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(390, 6.5, 48, 12, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(391, 7, 48, 13, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(392, 7.5, 48, 14, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(393, 8, 48, 15, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(394, 1.3, 48, 16, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(395, 2, 48, 17, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(396, 2.7, 48, 18, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(397, 3.4, 48, 19, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(398, 4.1, 48, 20, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(399, 4.8, 48, 21, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(400, 5.5, 48, 22, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(401, 6.2, 48, 23, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(402, 6.9, 48, 24, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(403, 7.6, 48, 25, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(404, 8.3, 48, 26, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(405, 9, 48, 27, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(406, 9.7, 48, 28, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(407, 10.4, 48, 29, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(408, 11.1, 48, 30, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(409, 11.8, 48, 31, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(410, 12.5, 48, 32, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(411, 13.2, 48, 33, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(412, 13.9, 48, 34, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(413, 14.6, 48, 35, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(414, 15.3, 48, 36, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(415, 4, 48, 37, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(416, 4.6, 48, 38, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(417, 5.2, 48, 39, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(418, 5.8, 48, 40, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(419, 6.4, 48, 41, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(420, 7, 48, 42, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(421, 7.6, 48, 43, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(422, 8.2, 48, 44, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(423, 8.8, 48, 45, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(424, 9.4, 48, 46, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(425, 10, 48, 47, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(426, 10.6, 48, 55, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(427, 11.2, 48, 49, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(428, 11.8, 48, 50, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(429, 12.4, 48, 51, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(430, 13, 48, 52, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(431, 13.6, 48, 53, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(432, 14.2, 48, 54, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(433, 1, 47, 1, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(434, 1.5, 47, 2, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(435, 2, 47, 3, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(436, 2.5, 47, 4, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(437, 3, 47, 5, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(438, 3.5, 47, 6, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(439, 4, 47, 7, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(440, 4.5, 47, 8, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(441, 5, 47, 9, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(442, 5.5, 47, 10, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(443, 6, 47, 11, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(444, 6.5, 47, 12, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(445, 7, 47, 13, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(446, 7.5, 47, 14, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(447, 8, 47, 15, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(448, 1.3, 47, 16, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(449, 2, 47, 17, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(450, 2.7, 47, 18, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(451, 3.4, 47, 19, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(452, 4.1, 47, 20, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(453, 4.8, 47, 21, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(454, 5.5, 47, 22, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(455, 6.2, 47, 23, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(456, 6.9, 47, 24, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(457, 7.6, 47, 25, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(458, 8.3, 47, 26, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(459, 9, 47, 27, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(460, 9.7, 47, 28, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(461, 10.4, 47, 29, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(462, 11.1, 47, 30, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(463, 11.8, 47, 31, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(464, 12.5, 47, 32, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(465, 13.2, 47, 33, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(466, 13.9, 47, 34, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(467, 14.6, 47, 35, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(468, 15.3, 47, 36, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(469, 4, 47, 37, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(470, 4.6, 47, 38, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(471, 5.2, 47, 39, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(472, 5.8, 47, 40, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(473, 6.4, 47, 41, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(474, 7, 47, 42, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(475, 7.6, 47, 43, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(476, 8.2, 47, 44, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(477, 8.8, 47, 45, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(478, 9.4, 47, 46, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(479, 10, 47, 47, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(480, 10.6, 47, 55, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(481, 11.2, 47, 49, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(482, 11.8, 47, 50, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(483, 12.4, 47, 51, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(484, 13, 47, 52, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(485, 13.6, 47, 53, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(486, 14.2, 47, 54, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(487, 1, 47, 1, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(488, 1.5, 47, 2, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(489, 2, 47, 3, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(490, 2.5, 47, 4, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(491, 3, 47, 5, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(492, 3.5, 47, 6, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(493, 4, 47, 7, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(494, 4.5, 47, 8, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(495, 5, 47, 9, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(496, 5.5, 47, 10, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(497, 6, 47, 11, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(498, 6.5, 47, 12, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(499, 7, 47, 13, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(500, 7.5, 47, 14, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(501, 8, 47, 15, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(502, 1.3, 47, 16, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(503, 2, 47, 17, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(504, 2.7, 47, 18, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(505, 3.4, 47, 19, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(506, 4.1, 47, 20, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(507, 4.8, 47, 21, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(508, 5.5, 47, 22, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(509, 6.2, 47, 23, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(510, 6.9, 47, 24, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(511, 7.6, 47, 25, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(512, 8.3, 47, 26, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(513, 9, 47, 27, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(514, 9.7, 47, 28, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(515, 10.4, 47, 29, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(516, 11.1, 47, 30, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(517, 11.8, 47, 31, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(518, 12.5, 47, 32, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(519, 13.2, 47, 33, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(520, 13.9, 47, 34, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(521, 14.6, 47, 35, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(522, 15.3, 47, 36, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(523, 4, 47, 37, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(524, 4.6, 47, 38, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(525, 5.2, 47, 39, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(526, 5.8, 47, 40, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(527, 6.4, 47, 41, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(528, 7, 47, 42, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(529, 7.6, 47, 43, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(530, 8.2, 47, 44, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(531, 8.8, 47, 45, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(532, 9.4, 47, 46, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(533, 10, 47, 47, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(534, 10.6, 47, 55, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(535, 11.2, 47, 49, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(536, 11.8, 47, 50, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(537, 12.4, 47, 51, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(538, 13, 47, 52, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(539, 13.6, 47, 53, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(540, 14.2, 47, 54, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(541, 1, 47, 1, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(542, 1.5, 47, 2, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(543, 2, 47, 3, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(544, 2.5, 47, 4, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(545, 3, 47, 5, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(546, 3.5, 47, 6, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(547, 4, 47, 7, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(548, 4.5, 47, 8, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(549, 5, 47, 9, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(550, 5.5, 47, 10, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(551, 6, 47, 11, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(552, 6.5, 47, 12, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(553, 7, 47, 13, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(554, 7.5, 47, 14, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(555, 8, 47, 15, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(556, 1.3, 47, 16, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(557, 2, 47, 17, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(558, 2.7, 47, 18, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(559, 3.4, 47, 19, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(560, 4.1, 47, 20, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(561, 4.8, 47, 21, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(562, 5.5, 47, 22, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(563, 6.2, 47, 23, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(564, 6.9, 47, 24, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(565, 7.6, 47, 25, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(566, 8.3, 47, 26, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(567, 9, 47, 27, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(568, 9.7, 47, 28, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(569, 10.4, 47, 29, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(570, 11.1, 47, 30, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(571, 11.8, 47, 31, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(572, 12.5, 47, 32, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(573, 13.2, 47, 33, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(574, 13.9, 47, 34, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(575, 14.6, 47, 35, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(576, 15.3, 47, 36, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(577, 4, 47, 37, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(578, 4.6, 47, 38, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(579, 5.2, 47, 39, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(580, 5.8, 47, 40, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(581, 6.4, 47, 41, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(582, 7, 47, 42, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(583, 7.6, 47, 43, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(584, 8.2, 47, 44, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(585, 8.8, 47, 45, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(586, 9.4, 47, 46, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(587, 10, 47, 47, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(588, 10.6, 47, 55, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(589, 11.2, 47, 49, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(590, 11.8, 47, 50, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(591, 12.4, 47, 51, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(592, 13, 47, 52, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(593, 13.6, 47, 53, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(594, 14.2, 47, 54, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(595, 1, 47, 1, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(596, 1.5, 47, 2, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(597, 2, 47, 3, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(598, 2.5, 47, 4, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(599, 3, 47, 5, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL);
INSERT INTO `tarifa` (`iTarifa`, `TarifaReferencial`, `LugarOrigen`, `LugarDestino`, `Usuario`, `UserUpdate`, `ControlRegister`, `UpdateRegister`, `TarPromMesUlt`, `TarPromMesPU`, `TarifaReal`) VALUES
(600, 3.5, 47, 6, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(601, 4, 47, 7, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(602, 4.5, 47, 8, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(603, 5, 47, 9, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(604, 5.5, 47, 10, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(605, 6, 47, 11, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(606, 6.5, 47, 12, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(607, 7, 47, 13, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(608, 7.5, 47, 14, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(609, 8, 47, 15, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(610, 1.3, 47, 16, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(611, 2, 47, 17, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(612, 2.7, 47, 18, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(613, 3.4, 47, 19, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(614, 4.1, 47, 20, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(615, 4.8, 47, 21, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(616, 5.5, 47, 22, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(617, 6.2, 47, 23, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(618, 6.9, 47, 24, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(619, 7.6, 47, 25, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(620, 8.3, 47, 26, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(621, 9, 47, 27, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(622, 9.7, 47, 28, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(623, 10.4, 47, 29, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(624, 11.1, 47, 30, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(625, 11.8, 47, 31, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(626, 12.5, 47, 32, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(627, 13.2, 47, 33, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(628, 13.9, 47, 34, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(629, 14.6, 47, 35, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(630, 15.3, 47, 36, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(631, 4, 47, 37, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(632, 4.6, 47, 38, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(633, 5.2, 47, 39, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(634, 5.8, 47, 40, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(635, 6.4, 47, 41, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(636, 7, 47, 42, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(637, 7.6, 47, 43, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(638, 8.2, 47, 44, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(639, 8.8, 47, 45, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(640, 9.4, 47, 46, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(641, 10, 47, 48, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(642, 10.6, 47, 55, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(643, 11.2, 47, 49, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(644, 11.8, 47, 50, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(645, 12.4, 47, 51, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(646, 13, 47, 52, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(647, 13.6, 47, 53, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL),
(648, 14.2, 47, 54, '	Sistema	', NULL, '2020-01-15 20:46:14', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `ControlUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario`, `clave`, `rol`, `estatus`, `ControlUpdate`) VALUES
(1, 'admin', 'admin2020', 1, 1, '2020-01-15 22:03:26'),
(8, 'dtrinidad@acg-soft.com', '2020', NULL, 1, '2020-01-17 22:15:59'),
(9, 'cpalomino@acg.com.pe', '1111', NULL, 1, '2020-01-17 22:17:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `idVisita` int(11) NOT NULL,
  `idmotivo` int(11) NOT NULL,
  `origen` int(100) NOT NULL,
  `destino` int(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `idtarifa` float NOT NULL,
  `tarifa` float DEFAULT NULL,
  `ControlRegister` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Observacion` varchar(50) DEFAULT NULL,
  `EstadoVisita` int(11) DEFAULT '1',
  `UbicacionInicial` int(11) DEFAULT NULL,
  `UbicacionFinal` int(11) DEFAULT NULL,
  `FecUpdateRegister` int(11) DEFAULT NULL,
  `HoraAbierta` time DEFAULT NULL,
  `HoraCerrada` time DEFAULT NULL,
  `FechaCreacion` date NOT NULL,
  `HoraCreacion` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centrocosto`
--
ALTER TABLE `centrocosto`
  ADD PRIMARY KEY (`iCodigo`);

--
-- Indices de la tabla `codigosrecuperacion`
--
ALTER TABLE `codigosrecuperacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ctrltarifa`
--
ALTER TABLE `ctrltarifa`
  ADD PRIMARY KEY (`iCtrlTarifa`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `horas_permiso`
--
ALTER TABLE `horas_permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `motivos`
--
ALTER TABLE `motivos`
  ADD PRIMARY KEY (`iCodigo`);

--
-- Indices de la tabla `motivos_permiso`
--
ALTER TABLE `motivos_permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `usuario_id` (`Telefono`);

--
-- Indices de la tabla `ProcesoAsistencia`
--
ALTER TABLE `ProcesoAsistencia`
  ADD PRIMARY KEY (`ProceAsist`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`idprueba`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`iTarifa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`idVisita`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `centrocosto`
--
ALTER TABLE `centrocosto`
  MODIFY `iCodigo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `codigosrecuperacion`
--
ALTER TABLE `codigosrecuperacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `ctrltarifa`
--
ALTER TABLE `ctrltarifa`
  MODIFY `iCtrlTarifa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horas_permiso`
--
ALTER TABLE `horas_permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `motivos`
--
ALTER TABLE `motivos`
  MODIFY `iCodigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `motivos_permiso`
--
ALTER TABLE `motivos_permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `ProcesoAsistencia`
--
ALTER TABLE `ProcesoAsistencia`
  MODIFY `ProceAsist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `idprueba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `iTarifa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `visita`
--
ALTER TABLE `visita`
  MODIFY `idVisita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
