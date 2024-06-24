-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-11-2022 a las 13:15:45
-- Versión del servidor: 5.7.39-cll-lve
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fortunar_apuestas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `APUESTAS`
--

CREATE TABLE `APUESTAS` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TICKET` text,
  `TIPO` varchar(35) DEFAULT NULL,
  `APUESTA` varchar(255) DEFAULT NULL,
  `JUEGO` varchar(255) DEFAULT NULL,
  `CAJERO` varchar(35) DEFAULT NULL,
  `CLIENTE` varchar(35) DEFAULT NULL,
  `WALLET` text,
  `NOTAID` text,
  `RESULTADO` text,
  `REFERENCIA` text,
  `MONTO` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `RECIBE` decimal(16,6) NOT NULL DEFAULT '0.000000',
  `COMISION` decimal(13,6) NOT NULL DEFAULT '0.000000',
  `PAGADO` int(11) NOT NULL DEFAULT '0',
  `ENVIADO` int(11) NOT NULL DEFAULT '0',
  `ELIMINADO` int(11) NOT NULL DEFAULT '0',
  `TOMADO` int(11) NOT NULL DEFAULT '0',
  `ESTATUS` varchar(35) DEFAULT NULL,
  `MONEDA` varchar(20) DEFAULT 'USDT',
  `MEDIO_PAGO` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `APUESTAS`
--

INSERT INTO `APUESTAS` (`ID`, `FECHA`, `TICKET`, `TIPO`, `APUESTA`, `JUEGO`, `CAJERO`, `CLIENTE`, `WALLET`, `NOTAID`, `RESULTADO`, `REFERENCIA`, `MONTO`, `RECIBE`, `COMISION`, `PAGADO`, `ENVIADO`, `ELIMINADO`, `TOMADO`, `ESTATUS`, `MONEDA`, `MEDIO_PAGO`) VALUES
(52, '2022-06-09 10:29:53', 'f042c61ccd21c0ec', 'Ganador', 'Suecia (FAVORITO)', '28', NULL, 'maikerfermin55@gmail.com', 'TR4XAsG1M8ZiYyjJ7ZakyJdQYHbmXrccG9', 'Internal transfer 109009947653', NULL, '09-06-2022 20:45', '14.000000', '28.000000', '0.000000', 1, 0, 0, 0, 'PERDISTE', 'USDT', 'USDT'),
(53, '2022-08-04 16:44:14', '929050b3a7c02478', 'Deposito USDT', '', '', 'khorazi57@gmail.com', 'maikerfermin55@gmail.com', 'TLrahcUgJFnm3ggVYaEEWposJw39T9fXev', '82ed0fd48453086ae23982eeb6cddf60825d61317b019b91df3c41a2cec8848c', NULL, 'Deposito USDT', '10.000000', '10.000000', '0.000000', 1, 0, 0, 0, 'PAGADO', 'USDT', 'USDT'),
(54, '2022-08-04 19:17:51', 'da88ed3c526ab26f', 'Ganador', '(desafiox1_5)Arsenal FC', '339', 'khorazi57@gmail.com', 'maikerfermin55@gmail.com', '', '', '2:0', '05-08-2022  21:00', '10.000000', '15.000000', '0.000000', 1, 0, 0, 0, 'PAGADO', 'USDT', 'USDT'),
(55, '2022-08-05 20:57:01', '1addc5a23461549e', 'PREMIO', 'Ganador Por Referido', '339', NULL, 'alfonsi.acosta@gmail.com', 'P1073744892', '', NULL, '', '0.500000', '0.500000', '0.000000', 1, 0, 0, 0, 'GANADOR', 'USDT', NULL),
(56, '2022-08-06 11:32:19', '44bdda9e22ad5eca', 'Ganador', '(desafiox1_5)Leicester City', '343', NULL, 'maikerfermin55@gmail.com', '', '', NULL, '07-08-2022 15:00 ', '15.000000', '22.500000', '0.000000', 1, 0, 0, 0, 'PERDISTE', 'USDT', 'USDT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CHAT`
--

CREATE TABLE `CHAT` (
  `ID` int(11) NOT NULL,
  `TICKED` varchar(80) DEFAULT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AMO` varchar(34) DEFAULT NULL,
  `ENVIA` varchar(34) DEFAULT NULL,
  `RECIBE` varchar(34) DEFAULT NULL,
  `MENSAJE` text,
  `ACTIVO` int(11) DEFAULT '0',
  `LEIDO` int(11) DEFAULT '0',
  `CERRADO` int(11) DEFAULT '0',
  `BG` varchar(34) DEFAULT '#DEEEF3',
  `FG` varchar(34) DEFAULT '#4D4D4D'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `CHAT`
--

INSERT INTO `CHAT` (`ID`, `TICKED`, `FECHA`, `AMO`, `ENVIA`, `RECIBE`, `MENSAJE`, `ACTIVO`, `LEIDO`, `CERRADO`, `BG`, `FG`) VALUES
(1, '0001', '2022-08-01 19:37:57', 'khorazi57@gmail.com', 'khorazi57@gmail.com', 'khorazi57@gmail.com', 'Bienvenidos', 0, 0, 0, '#BABAEE', '#000000'),
(2, '0001', '2022-08-01 19:43:50', 'alfonsi.acosta@gmail.com', 'alfonsi.acosta@gmail.com', 'khorazi57@gmail.com', 'Gracias activo ', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(27, '0001', '2022-08-02 10:25:29', 'geimarosariolopez@gmail.com', 'geimarosariolopez@gmail.com', 'khorazi57@gmail.com', 'Buenos dÃ­as ', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(28, '0001', '2022-08-02 14:09:13', 'medinapinoa@gmail.com', 'medinapinoa@gmail.com', 'khorazi57@gmail.com', 'Buenos dÃ­as como son las jugadas aquÃ­ por favor', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(29, '0001', '2022-08-02 14:28:52', 'geimarosariolopez@gmail.com', 'geimarosariolopez@gmail.com', 'khorazi57@gmail.com', 'Primero recargar el saldo, luego puedes hacer jugadas de hasta 1$', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(30, '0001', '2022-08-02 14:29:38', 'geimarosariolopez@gmail.com', 'geimarosariolopez@gmail.com', 'khorazi57@gmail.com', 'Pero para participar en el bono de 1500$ cada jugada debe ser mayor o igual q 10$', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(31, '0001', '2022-08-02 14:31:01', 'geimarosariolopez@gmail.com', 'geimarosariolopez@gmail.com', 'khorazi57@gmail.com', 'El mÃ­nimo de retiro son 10$ allÃ­ tu escoges las jugadas q dan ', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(32, '0001', '2022-08-02 14:54:40', 'alfonsi.acosta@gmail.com', 'alfonsi.acosta@gmail.com', 'khorazi57@gmail.com', 'solo recarga saldo y juegas al equipo ganador y puedes hacerle seguimiento en tu historial de las jugadas o recargas', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(33, '0001', '2022-08-03 22:19:27', 'medinapinoa@gmail.com', 'medinapinoa@gmail.com', 'khorazi57@gmail.com', 'Quiero jugar ', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(34, '0001', '2022-08-04 01:27:14', 'alfonsi.acosta@gmail.com', 'alfonsi.acosta@gmail.com', 'khorazi57@gmail.com', 'alguien sabe como es el desafio fortuna royal que paga x3..??', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(35, '0001', '2022-08-06 00:15:28', 'geimarosariolopez@gmail.com', 'geimarosariolopez@gmail.com', 'khorazi57@gmail.com', 'hoy gane facil con el arsenal ', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(37, '0001', '2022-08-11 17:12:42', 'felix_1587@hotmail.com', 'felix_1587@hotmail.com', 'khorazi57@gmail.com', 'Hola a todos. CÃ³mo funciona estas inversiÃ³nes', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(38, '0001', '2022-08-11 22:48:46', 'deivisprosper1986@gmail.com', 'deivisprosper1986@gmail.com', 'khorazi57@gmail.com', 'BUENAS NOCHES SOY NUEVO EN ESTA PAGINA ..QUE TAL LES A  A CON LAS APUESTAS', 0, 0, 0, '#DEEEF3', '#4D4D4D'),
(39, '0001', '2022-08-14 12:03:38', 'alfonsi.acosta@gmail.com', 'alfonsi.acosta@gmail.com', 'khorazi57@gmail.com', 'se gana de vez en cuando como toda apuesta lo que si les puedo decir es que son responsables estÃ¡n siempre atento a tu pago y retiros, tambien soporte responde cuando hay eventualidades. no tengo quejas por los momentos', 0, 0, 0, '#DEEEF3', '#4D4D4D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ENVIOLISTA`
--

CREATE TABLE `ENVIOLISTA` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ENVIADO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ENVIOLISTA`
--

INSERT INTO `ENVIOLISTA` (`ID`, `FECHA`, `ENVIADO`) VALUES
(1, '2022-06-21 15:02:40', 1),
(2, '2022-06-22 10:53:00', 1),
(3, '2022-06-23 16:47:43', 1),
(4, '2022-06-24 13:29:44', 1),
(5, '2022-06-25 15:17:43', 1),
(6, '2022-06-26 23:04:38', 1),
(7, '2022-06-27 11:19:09', 1),
(8, '2022-06-30 09:44:05', 1),
(9, '2022-07-02 20:25:28', 1),
(10, '2022-07-04 00:03:01', 1),
(11, '2022-07-04 11:16:22', 1),
(12, '2022-07-05 10:33:38', 1),
(13, '2022-07-06 10:11:29', 1),
(14, '2022-07-09 13:23:08', 1),
(15, '2022-07-10 16:00:51', 1),
(16, '2022-07-11 10:29:18', 1),
(17, '2022-07-12 17:19:43', 1),
(18, '2022-07-13 19:07:26', 1),
(19, '2022-07-14 11:24:43', 1),
(20, '2022-07-15 10:50:41', 1),
(21, '2022-07-16 16:53:30', 1),
(22, '2022-07-18 00:02:36', 1),
(23, '2022-07-19 15:12:14', 1),
(24, '2022-07-20 20:27:35', 1),
(25, '2022-07-21 11:16:25', 1),
(26, '2022-07-22 11:19:42', 1),
(27, '2022-07-23 11:09:12', 1),
(28, '2022-07-25 11:10:55', 1),
(29, '2022-07-26 13:45:37', 1),
(30, '2022-07-27 16:38:39', 1),
(31, '2022-07-29 19:41:39', 1),
(32, '2022-07-30 07:53:53', 1),
(33, '2022-07-31 10:34:41', 1),
(34, '2022-08-03 23:08:38', 1),
(35, '2022-08-05 16:05:53', 1),
(36, '2022-08-07 00:04:13', 1),
(37, '2022-08-07 20:42:54', 1),
(38, '2022-08-08 11:42:49', 1),
(39, '2022-08-09 10:45:23', 1),
(40, '2022-08-10 12:09:01', 1),
(41, '2022-08-12 16:46:02', 1),
(42, '2022-08-13 11:21:21', 1),
(43, '2022-08-14 15:45:34', 1),
(44, '2022-08-15 15:19:17', 1),
(45, '2022-08-16 11:02:42', 1),
(46, '2022-08-17 21:13:49', 1),
(47, '2022-08-19 15:28:08', 1),
(48, '2022-08-20 23:53:44', 1),
(49, '2022-08-21 18:36:48', 1),
(50, '2022-08-22 17:06:17', 1),
(51, '2022-08-24 10:26:05', 1),
(52, '2022-08-27 23:06:07', 1),
(53, '2022-08-28 11:21:49', 1),
(54, '2022-08-30 20:33:43', 1),
(55, '2022-08-31 15:15:33', 1),
(56, '2022-09-01 21:36:12', 1),
(57, '2022-09-02 20:56:57', 1),
(58, '2022-09-04 23:17:46', 1),
(59, '2022-09-06 11:46:14', 1),
(60, '2022-09-07 10:36:09', 1),
(61, '2022-09-09 16:03:56', 1),
(62, '2022-09-10 11:21:50', 1),
(63, '2022-09-12 16:00:08', 1),
(64, '2022-09-19 15:02:45', 1),
(65, '2022-09-22 20:46:35', 1),
(66, '2022-11-20 14:27:19', 1),
(67, '2022-11-21 17:07:40', 1),
(68, '2022-11-22 13:27:31', 1),
(69, '2022-11-23 10:24:50', 1),
(70, '2022-11-24 12:09:15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JUEGOS`
--

CREATE TABLE `JUEGOS` (
  `ID` int(11) NOT NULL,
  `INICIO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FIN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `JUEGO` varchar(255) NOT NULL,
  `EQUIPO1` varchar(35) NOT NULL,
  `EQUIPO2` varchar(35) NOT NULL,
  `CAJERO` varchar(35) DEFAULT NULL,
  `TIPO` varchar(35) DEFAULT NULL,
  `WALLET` text,
  `REFERENCIA` text,
  `COMISION` decimal(13,6) NOT NULL DEFAULT '0.000000',
  `MIN` int(11) NOT NULL DEFAULT '10',
  `MAX` int(11) NOT NULL DEFAULT '10',
  `RATE` int(11) NOT NULL DEFAULT '0',
  `BLOQUEADO` int(11) NOT NULL DEFAULT '0',
  `VISIBLE` int(11) NOT NULL DEFAULT '0',
  `ESTATUS` varchar(34) DEFAULT NULL,
  `MONEDA` varchar(20) DEFAULT 'USDT',
  `APUESTAS` int(11) NOT NULL DEFAULT '0',
  `DESAFIO` int(11) NOT NULL DEFAULT '0',
  `DESAFIOX1_5` int(11) NOT NULL DEFAULT '0',
  `DESAFIOX3` int(11) NOT NULL DEFAULT '0',
  `FAVORITO` int(11) NOT NULL DEFAULT '0',
  `ELIMINADO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `JUEGOS`
--

INSERT INTO `JUEGOS` (`ID`, `INICIO`, `FIN`, `JUEGO`, `EQUIPO1`, `EQUIPO2`, `CAJERO`, `TIPO`, `WALLET`, `REFERENCIA`, `COMISION`, `MIN`, `MAX`, `RATE`, `BLOQUEADO`, `VISIBLE`, `ESTATUS`, `MONEDA`, `APUESTAS`, `DESAFIO`, `DESAFIOX1_5`, `DESAFIOX3`, `FAVORITO`, `ELIMINADO`) VALUES
(148, '2022-06-21 01:07:18', '2022-06-21 01:07:18', 'Argentina. Liga Profesional', 'Club AtlÃ©tico Platens', 'Aldosivi', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-06-2022  00:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(149, '2022-06-21 01:08:18', '2022-06-21 01:08:18', ' Argentina. Liga Profesional', 'Central Cordoba de Santiago', 'San Lorenzo', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-06-2022 02:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(150, '2022-06-21 01:11:10', '2022-06-21 01:11:10', 'CONCACAF Championship U20. CONCACAF Championship U20 Grp. F', 'Suriname U20', 'Haiti U20', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-06-2022  00:00 ', '0.000000', 50, 50, 5, 0, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(155, '2022-06-22 00:34:27', '2022-06-22 00:34:27', 'Colombia. Primera A Apertura Final Stage', 'AtlÃ©tico Nacional', 'Tolima', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '23-06-2022 03:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(156, '2022-06-22 00:37:04', '2022-06-22 00:37:04', 'CONCACAF Championship U20. CONCACAF Championship U20 Grp. E', 'Santo Kitts y Nevis U20', 'Canada U20', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-06-2022 22:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(157, '2022-06-22 00:38:22', '2022-06-22 00:38:22', 'CONCACAF Championship U20. CONCACAF Championship U20 Grp. F', 'Trinidad and Tobago U20', 'Mexico U20', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-06-2022 04:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(158, '2022-06-23 01:33:54', '2022-06-23 01:33:54', 'Argentina. Liga Profesional', 'Rosario Central', 'Gimnasia LP', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-06-2022 00:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(159, '2022-06-23 01:37:10', '2022-06-23 01:37:10', 'Argentina. Liga Profesional', 'Boca Juniors', 'Union', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-06-2022 02:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(160, '2022-06-23 01:38:45', '2022-06-23 01:38:45', ' Argentina. Liga Profesional', 'Talleres', 'Central Cordoba de Santiago', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-06-2022 20:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(161, '2022-06-23 01:40:36', '2022-06-23 01:40:36', ' Argentina. Liga Profesional', 'Defensa y Justicia', 'VÃ©lez Sarsfield', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-06-2022', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(162, '2022-06-23 16:51:38', '2022-06-23 16:51:38', 'Argentina. Liga Profesional', 'HuracÃ¡n', 'Colon', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-06-2022 23:00', '0.000000', 50, 50, 0, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(163, '2022-06-23 16:53:09', '2022-06-23 16:53:09', 'Brasil. Serie A', 'Athletico Paranaense', 'Red Bull Bragantino', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-06-2022 21:30', '0.000000', 50, 50, 2, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(164, '2022-06-23 16:54:54', '2022-06-23 16:54:54', 'CONCACAF Championship U20. CONCACAF Championship U20 Grp. F', 'Trinidad and Tobago U20', 'Suriname U20', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '24-06-2022 00:00', '0.000000', 50, 50, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(165, '2022-06-23 16:56:35', '2022-06-23 16:56:35', 'CONCACAF Championship U20. CONCACAF Championship U20 Grp. G', 'Panama U20', 'El Salvador U20', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '24-06-2022 02:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(166, '2022-06-25 00:34:31', '2022-06-25 00:34:31', ' Argentina. Primera Nacional', 'Deportivo MorÃ³n', 'Gimnasia Jujuy', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-06-2022  19:10 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(167, '2022-06-25 00:35:54', '2022-06-25 00:35:54', 'Argentina. Primera Nacional', 'Belgrano', 'CA Alvarado', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-06-2022 21:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(168, '2022-06-25 00:37:15', '2022-06-25 00:37:15', 'Argentina. Primera Nacional', 'Temperley', 'Flandria', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-06-2022 23:10 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(169, '2022-06-25 18:02:53', '2022-06-25 18:02:53', 'Argentina. Liga Profesional', 'Tigre', 'San Lorenzo', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 18:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(170, '2022-06-25 18:04:03', '2022-06-25 18:04:03', ' Argentina. Liga Profesional', 'Club AtlÃ©tico Platens', 'Sarmiento', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 20:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(171, '2022-06-25 18:08:55', '2022-06-25 18:08:55', 'Argentina. Primera Nacional', 'Deportivo Madryn', 'Almirante Brown', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 20:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(172, '2022-06-25 18:10:10', '2022-06-25 18:10:10', 'Argentina. Primera Nacional', 'Almagro', 'Deportivo Riestra', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 20:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(173, '2022-06-25 18:11:13', '2022-06-25 18:11:13', ' Argentina. Primera Nacional', 'Deportivo Maipu', 'All Boys', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022  20:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(174, '2022-06-25 18:12:17', '2022-06-25 18:12:17', 'Argentina. Primera Nacional', 'Santamarina', 'Agropecuario', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 21:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(175, '2022-06-25 18:14:04', '2022-06-25 18:14:04', 'Argentina. Primera Nacional', 'Estudiantes de Rio Cuarto', 'Villa Dalmine', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 21:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(176, '2022-06-25 18:15:13', '2022-06-25 18:15:13', ' Argentina. Primera Nacional', 'Club AtlÃ©tico Mitre', 'San MartÃ­n San Juan', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 21:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(177, '2022-06-25 18:16:31', '2022-06-25 18:16:31', 'Argentina. Primera Nacional', 'San Telmo', 'Independiente Rivadavia', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 21:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(178, '2022-06-25 18:17:47', '2022-06-25 18:17:47', 'Argentina. Primera Nacional', 'TristÃ¡n SuÃ¡rez', 'Atletico Rafaela', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 23:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(179, '2022-06-25 21:20:58', '2022-06-25 21:20:58', ' USA. MLB', 'San Diego Padres', 'Philadelphia Phillies', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 04:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(180, '2022-06-25 21:23:16', '2022-06-25 21:23:16', 'USA. MLB', 'Boston Red Sox', 'Cleveland Guardians', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 19:40 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(181, '2022-06-25 21:26:22', '2022-06-25 21:26:22', 'USA. MLB', 'Toronto Blue Jays', 'Milwaukee Brewers', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-06-2022 20:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(182, '2022-06-26 17:18:00', '2022-06-26 17:18:00', ' Argentina. Liga Profesional', 'Argentinos Juniors', 'Arsenal Sarandi', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-06-2022 01:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(183, '2022-06-26 17:19:05', '2022-06-26 17:19:05', ' Argentina. Liga Profesional', 'Independiente', 'Patronato de Parana', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-06-2022 20:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(184, '2022-06-26 17:21:38', '2022-06-26 17:21:38', 'Argentina. Primera Nacional', 'San Martin de Tucuman', 'Guillermo Brown', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-06-2022 01:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(185, '2022-06-26 17:23:06', '2022-06-26 17:23:06', 'Argentina. Primera Nacional', 'Atlanta', 'Sacachispas FC', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-06-2022 20:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(186, '2022-06-26 17:24:10', '2022-06-26 17:24:10', ' Argentina. Primera Nacional', 'Ferro Carril Oeste', 'CA Chaco For Ever', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-06-2022 23:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(187, '2022-06-26 17:28:44', '2022-06-26 17:28:44', 'USA. MLB', 'Los Angeles Dodgers', 'Atlanta Braves', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-06-2022 01:10 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(188, '2022-06-26 22:52:25', '2022-06-26 22:52:25', 'Argentina. Liga Profesional', 'Godoy Cruz', 'AtlÃ©tico TucumÃ¡n', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-06-2022 01:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(189, '2022-06-26 22:59:21', '2022-06-26 22:59:21', 'Argentina. Primera Nacional', 'Nueva Chicago', 'Atletico Guemes', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-06-2022 00:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(190, '2022-06-26 23:02:39', '2022-06-26 23:02:39', 'Argentina. Primera Nacional', 'CA Defensores de Belgrano', 'Chacarita Juniors', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-06-2022 02:15', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(191, '2022-06-26 23:04:19', '2022-06-26 23:04:19', ' Campeonato de Europa Sub 19. EURO U19 Final Stage', 'England U19', 'Italy U19', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-06-2022 17:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(192, '2022-06-26 23:06:15', '2022-06-26 23:06:15', 'Campeonato de Europa Sub 19. EURO U19 Final Stage', 'Israel U19', 'France U19', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-06-2022 20:00  ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(193, '2022-06-26 23:07:34', '2022-06-26 23:07:34', 'Campeonato de Europa Sub 19. EURO U19 World Cup U20 Playoff', 'Austria U19', 'Slovakia U19', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-06-2022 17:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(194, '2022-06-28 00:59:31', '2022-06-28 00:59:31', 'USA. MLB', 'Chicago White Sox', 'Los Angeles Angels', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-06-2022 03:40 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(195, '2022-06-28 01:01:23', '2022-06-28 01:01:23', 'USA. MLB', 'Baltimore Orioles', 'Seattle Mariners', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-06-2022 04:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(196, '2022-06-28 11:07:43', '2022-06-28 11:07:43', 'Campeonato de Europa Sub 19. EURO U19 World Cup U20 Playoff', 'Austria U19', 'Slovakia U19', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-06-2022  17:00 ', '0.000000', 50, 50, 5, 0, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(197, '2022-06-28 11:09:45', '2022-06-28 11:09:45', 'CONCACAF Championship U20. CONCACAF Championship U20 Final Stage', 'Panama U20', 'Honduras U20', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '29-06-2022 04:00', '0.000000', 50, 50, 5, 0, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(198, '2022-06-28 11:11:15', '2022-06-28 11:11:15', 'Copa Sudamericana. Copa Sudamericana Final Stage', 'Nacional', 'Union', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '29-06-2022 00:15 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(199, '2022-06-28 11:12:19', '2022-06-28 11:12:19', 'Copa Sudamericana. Copa Sudamericana Final Stage', 'Colo Colo', 'Internacional', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '29-06-2022 02:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(200, '2022-06-28 21:07:23', '2022-06-28 21:07:23', 'USA. MLB', 'Philadelphia Phillies', 'Atlanta Braves', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '29-06-2022  01:05', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(201, '2022-06-28 21:08:41', '2022-06-28 21:08:41', 'USA. MLB', 'Washington Nationals', 'Pittsburgh Pirates', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '29-06-2022 01:05 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(202, '2022-06-28 21:09:57', '2022-06-28 21:09:57', 'USA. MLB', 'Houston Astros', 'New York Mets', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '29-06-2022  01:10 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(203, '2022-06-28 21:11:02', '2022-06-28 21:11:02', 'USA. MLB', 'Tampa Bay Rays', 'Milwaukee Brewers', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '29-06-2022 01:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(204, '2022-06-28 21:12:27', '2022-06-28 21:12:27', 'USA. MLB', 'Cleveland Guardians', 'Minnesota Twins', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '29-06-2022 01:10 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(205, '2022-06-28 21:14:37', '2022-06-28 21:14:37', 'USA. MLB', 'Chicago Cubs', 'Cincinnati Reds', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '29-06-2022 02:05', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(206, '2022-06-28 23:38:30', '2022-06-28 23:38:30', 'USA. Major League Soccer', 'New York City FC', 'FC Cincinnati', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-06-2022 01:30 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(207, '2022-06-28 23:42:35', '2022-06-28 23:42:35', 'USA. Major League Soccer', 'Toronto FC', 'Columbus Crew', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-06-2022 01:30 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(208, '2022-06-28 23:44:19', '2022-06-28 23:44:19', 'USA. Major League Soccer', 'Chicago Fire FC', 'Philadelphia Union', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-06-2022 02:00', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(209, '2022-06-28 23:45:58', '2022-06-28 23:45:58', 'USA. Major League Soccer', 'CF Montreal', 'Seattle Sounders FC', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-06-2022 04:00', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(210, '2022-06-28 23:53:55', '2022-06-28 23:53:55', ' USA. Major League Soccer', 'Houston Dynamo FC', 'Portland Timbers', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-06-2022 04:30', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(211, '2022-06-29 20:43:26', '2022-06-29 20:43:26', ' AFC Cup. AFC Cup Grp. F', 'Dordoi FC', 'FK Khujand', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-06-2022 16:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(212, '2022-06-29 20:45:06', '2022-06-29 20:45:06', 'AFC Cup. AFC Cup Grp. G', 'Kedah Darul Aman FC', 'Visakha FC', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-06-2022 15:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(213, '2022-06-29 20:46:27', '2022-06-29 20:46:27', 'AFC Cup. Copa AFC grp. I', 'Young Elephants', 'Phnom Penh', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-06-2022 16:00', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(214, '2022-06-30 09:50:32', '2022-06-30 09:50:32', 'Argentina. Liga Profesional', 'Argentinos Juniors', 'Central Cordoba de Santiago', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022 00:00 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(215, '2022-06-30 09:51:44', '2022-06-30 09:51:44', 'Argentina. Liga Profesional', 'Boca Juniors', 'Banfield', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022 02:30 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(216, '2022-06-30 09:52:57', '2022-06-30 09:52:57', 'Argentina. Liga Profesional', 'Tigre', 'Talleres', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022 20:30', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(217, '2022-06-30 09:54:14', '2022-06-30 09:54:14', ' Argentina. Liga Profesional', 'Godoy Cruz', 'Colon', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022  23:00 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(218, '2022-06-30 09:55:26', '2022-06-30 09:55:26', 'Argentina. Liga Profesional', 'VÃ©lez Sarsfield', 'AtlÃ©tico TucumÃ¡n', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022 23:00', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(219, '2022-06-30 09:56:58', '2022-06-30 09:56:58', 'Argentina. Primera Nacional', 'Belgrano', 'Almagro', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022 00:10 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(220, '2022-06-30 09:58:03', '2022-06-30 09:58:03', 'Argentina. Primera Nacional', 'Deportivo Riestra', 'Nueva Chicago', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022 19:10', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(221, '2022-06-30 09:59:08', '2022-06-30 09:59:08', 'Argentina. Primera Nacional', 'Almirante Brown', 'Estudiantes de Rio Cuarto', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022 20:00 ', '0.000000', 40, 40, 4, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(222, '2022-06-30 10:00:08', '2022-06-30 10:00:08', 'Argentina. Primera Nacional', 'Club AtlÃ©tico Estudiante', 'Agropecuario', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022  23:05', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(223, '2022-06-30 10:01:29', '2022-06-30 10:01:29', 'USA. MLB', 'New York Yankees', 'Houston Astros', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '01-07-2022 00:10 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(224, '2022-06-30 10:02:38', '2022-06-30 10:02:38', 'USA. MLB', 'Milwaukee Brewers', 'Pittsburgh Pirates', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '01-07-2022 01:05', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(225, '2022-06-30 10:03:38', '2022-06-30 10:03:38', 'USA. MLB', 'Chicago Cubs', 'Cincinnati Reds', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '01-07-2022  02:05 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(226, '2022-07-01 11:46:46', '2022-07-01 11:46:46', 'Brasil. Serie A', 'AtlÃ©tico MG', 'Juventude', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022 21:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(227, '2022-07-01 11:48:01', '2022-07-01 11:48:01', ' Brasil. Serie A', 'Fluminense', 'Corinthians', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-07-2022 21:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(228, '2022-07-02 00:03:52', '2022-07-02 00:03:52', 'Argentina. Liga Profesional', 'Gimnasia LP', 'Defensa y Justicia', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022  01:30', '0.000000', 40, 40, 4, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(229, '2022-07-02 00:04:54', '2022-07-02 00:04:54', 'Argentina. Liga Profesional', 'Union', 'LanÃºs', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 18:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(230, '2022-07-02 00:05:59', '2022-07-02 00:05:59', 'Argentina. Liga Profesional', 'San Lorenzo', 'Barracas Central', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 20:00', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(231, '2022-07-02 00:07:17', '2022-07-02 00:07:17', 'Argentina. Liga Profesional', 'Racing Club', 'Sarmiento', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022  23:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(232, '2022-07-02 00:18:02', '2022-07-02 00:18:02', 'Argentina. Primera Nacional', 'All Boys', 'Quilmes', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 00:10 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(233, '2022-07-02 00:19:52', '2022-07-02 00:19:52', 'Argentina. Primera Nacional', 'Chacarita Juniors', 'Brown de AdroguÃ©', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 01:10', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(234, '2022-07-02 00:22:14', '2022-07-02 00:22:14', 'Argentina. Primera Nacional', 'Gimnasia Mendoza', 'Independiente Rivadavia', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 19:45', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(235, '2022-07-02 00:30:00', '2022-07-02 00:30:00', 'Brasil. Serie A', 'Ceara', 'Internacional', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 00:00', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(236, '2022-07-02 00:32:38', '2022-07-02 00:32:38', ' Brasil. Serie A', 'Flamengo', 'Santos FC', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 00:00', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(237, '2022-07-02 20:19:51', '2022-07-02 20:19:51', 'Argentina. Primera Nacional', 'Instituto', 'Atlanta', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 22:00', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(238, '2022-07-02 20:21:13', '2022-07-02 20:21:13', 'Argentina. Primera Nacional', 'Santamarina', 'TristÃ¡n SuÃ¡rez', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 21:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(239, '2022-07-02 20:22:56', '2022-07-02 20:22:56', ' Argentina. Primera Nacional', 'Deportivo MorÃ³n', 'Flandria', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-07-2022 20:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(240, '2022-07-03 12:17:59', '2022-07-03 12:17:59', 'Argentina. Liga Profesional', 'River Plate', 'HuracÃ¡n', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '04-07-2022 02:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(241, '2022-07-03 12:23:18', '2022-07-03 12:23:18', ' Argentina. Liga Profesional', 'Arsenal Sarandi', 'Estudiantes', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '04-07-2022 22:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(242, '2022-07-03 12:24:42', '2022-07-03 12:24:42', 'Argentina. Primera Nacional', 'Gimnasia Jujuy', 'Deportivo Madryn', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '04-07-2022 20:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(243, '2022-07-03 12:26:24', '2022-07-03 12:26:24', ' Argentina. Primera Nacional', 'Villa Dalmine', 'CA Alvarado', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '04-07-2022 20:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(244, '2022-07-04 11:17:48', '2022-07-04 11:17:48', 'Argentina. Liga Profesional', 'Rosario Central', 'Aldosivi', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '05-07-2022 00:00', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(245, '2022-07-04 11:28:30', '2022-07-04 11:28:30', 'Argentina. Liga Profesional', 'Club AtlÃ©tico Platens', 'Independiente', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '05-07-2022  02:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(246, '2022-07-05 10:39:13', '2022-07-05 10:39:13', 'USA. MLB', 'San Diego Padres', 'Seattle Mariners', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '05-07-2022 22:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(247, '2022-07-05 10:40:37', '2022-07-05 10:40:37', 'USA NBA Liga de Verano. NBA California Classic Summer League', 'Golden State Warriors', 'Miami Heat', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '05-07-2022 21:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(248, '2022-07-05 10:41:53', '2022-07-05 10:41:53', 'USA NBA Liga de Verano. NBA California Classic Summer League', 'Sacramento Kings', 'LA Lakers', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '05-07-2022 23:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(249, '2022-07-06 01:09:16', '2022-07-06 01:09:16', ' USA. MLB', 'Oakland Athletics', 'Toronto Blue Jays', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '06-07-2022  03:40 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(250, '2022-07-06 01:10:22', '2022-07-06 01:10:22', ' USA. MLB', 'Arizona Diamondbacks', 'San Francisco Giants', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '06-07-2022  03:40 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(251, '2022-07-06 01:11:25', '2022-07-06 01:11:25', 'USA. MLB', 'Colorado Rockies', 'Los Angeles Dodgers', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '06-07-2022 04:10 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(252, '2022-07-06 02:44:30', '2022-07-06 02:44:30', 'Argentina. Liga Profesional', 'Rosario Central', 'Sarmiento', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '09-07-2022 01:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(253, '2022-07-06 02:46:49', '2022-07-06 02:46:49', 'Argentina. Liga Profesional', 'Patronato de Parana', 'Arsenal Sarandi', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '09-07-2022 18:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(254, '2022-07-06 02:47:57', '2022-07-06 02:47:57', 'Argentina. Liga Profesional', 'Boca Juniors', 'San Lorenzo', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '09-07-2022 20:30 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(255, '2022-07-06 02:49:19', '2022-07-06 02:49:19', 'Argentina. Liga Profesional', 'Banfield', 'Union', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '09-07-2022 23:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(256, '2022-07-06 02:50:43', '2022-07-06 02:50:43', 'Argentina. Primera Nacional', 'Belgrano', 'Nueva Chicago', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '08-07-2022 20:35 ', '0.000000', 20, 20, 2, 0, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(257, '2022-07-06 02:52:04', '2022-07-06 02:52:04', 'Argentina. Primera Nacional', 'Deportivo MorÃ³n', 'Temperley', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '09-07-2022 20:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(258, '2022-07-06 02:54:34', '2022-07-06 02:54:34', 'Brasil. Serie A', 'Avai FC', 'Red Bull Bragantino', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '09-07-2022 21:30', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(259, '2022-07-06 02:56:04', '2022-07-06 02:56:04', 'Colombia. Primera A Clausura', 'Deportivo Pereira', 'Alianza Petrolera', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '08-07-2022 01:05 ', '0.000000', 20, 20, 2, 0, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(260, '2022-07-06 02:57:19', '2022-07-06 02:57:19', ' Colombia. Primera A Clausura', 'AtlÃ©tico Junior', 'Patriotas', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '08-07-2022 03:10', '0.000000', 30, 30, 3, 0, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(261, '2022-07-09 18:08:47', '2022-07-09 18:08:47', 'Argentina. Liga Profesional', 'Barracas Central', 'Talleres', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-07-2022 01:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(262, '2022-07-09 18:30:21', '2022-07-09 18:30:21', ' Argentina. Liga Profesional', 'AtlÃ©tico TucumÃ¡n', 'Gimnasia LP', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-07-2022 23:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(263, '2022-07-09 18:31:22', '2022-07-09 18:31:22', ' Argentina. Liga Profesional', 'HuracÃ¡n', 'LanÃºs', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-07-2022 23:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(264, '2022-07-09 18:37:17', '2022-07-09 18:37:17', 'Argentina. Primera Nacional', 'Independiente Rivadavia', 'All Boys', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-07-2022  00:10', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(265, '2022-07-09 18:38:15', '2022-07-09 18:38:15', 'Argentina. Primera Nacional', 'Deportivo MorÃ³n', 'Temperley', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-07-2022 02:10', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(266, '2022-07-09 18:39:15', '2022-07-09 18:39:15', 'Argentina. Primera Nacional', 'Instituto', 'San MartÃ­n San Juan', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-07-2022 20:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(267, '2022-07-09 18:40:30', '2022-07-09 18:40:30', ' Brasil. Serie A', 'Athletico Paranaense', 'Goias', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-07-2022  01:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(268, '2022-07-09 18:41:38', '2022-07-09 18:41:38', 'Brasil. Serie A', 'Coritiba', 'Juventude', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-07-2022 16:00 ', '0.000000', 40, 40, 4, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(269, '2022-07-09 20:01:40', '2022-07-09 20:01:40', 'Venezuela. Primera Division', 'Zamora FC', 'Deportivo Lara', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-07-2022 01:15', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(270, '2022-07-10 18:37:30', '2022-07-10 18:37:30', 'Argentina. Liga Profesional', 'Godoy Cruz', 'River Plate', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '11-07-2022 01:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(271, '2022-07-10 18:38:48', '2022-07-10 18:38:48', 'Argentina. Primera Nacional', 'CA Defensores de Belgrano', 'Atletico Rafaela', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '11-07-2022 22:35 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(272, '2022-07-10 18:39:59', '2022-07-10 18:39:59', ' Brasil. Serie A', 'Cuiaba', 'Botafogo RJ', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '11-07-2022 00:00 ', '0.000000', 30, 30, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(273, '2022-07-10 18:41:26', '2022-07-10 18:41:26', ' Colombia. Primera A Clausura', 'AtlÃ©tico Nacional', 'Cortulua', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '11-07-2022 01:10 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(274, '2022-07-10 18:42:31', '2022-07-10 18:42:31', ' Colombia. Primera A Clausura', 'Tolima', 'Independiente MedellÃ­n', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '11-07-2022 03:15 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(275, '2022-07-10 19:28:29', '2022-07-10 19:28:29', 'Venezuela. Primera Division', 'Deportivo TÃ¡chira', 'Portuguesa FC', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '11-07-2022  01:15 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(276, '2022-07-11 00:51:28', '2022-07-11 00:51:28', 'Chile. Primera DivisiÃ³n', 'Colo Colo', 'Audax Italiano', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '17-07-2022 00:15 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(277, '2022-07-11 01:20:50', '2022-07-11 01:20:50', 'Argentina. Liga Profesional', 'VÃ©lez Sarsfield', 'Colon', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '12-07-2022 00:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(278, '2022-07-11 01:25:41', '2022-07-11 01:25:41', 'Argentina. Liga Profesional', 'Argentinos Juniors', 'Tigre', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '12-07-2022 02:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(279, '2022-07-11 01:38:52', '2022-07-11 01:38:52', 'Argentina. Primera Nacional', 'CA Alvarado', 'Almirante Brown', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '12-07-2022 00:40 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(280, '2022-07-11 01:57:16', '2022-07-11 01:57:16', 'Chile. Primera DivisiÃ³n', 'UniÃ³n EspaÃ±ola', 'Universidad CatÃ³lica', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '12-07-2022  00:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(281, '2022-07-11 11:19:14', '2022-07-11 11:19:14', ' Colombia. Primera A Clausura', 'Cortulua', 'CD Jaguares', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '13-07-2022 21:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(282, '2022-07-11 11:20:26', '2022-07-11 11:20:26', 'Colombia. Primera A Clausura', 'AmÃ©rica de Cali', 'Deportivo Pereira', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '13-07-2022 21:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(283, '2022-07-11 11:21:48', '2022-07-11 11:21:48', 'Colombia. Primera A Clausura', 'Envigado', 'Deportivo Pasto', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '13-07-2022 23:05 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(284, '2022-07-12 01:44:31', '2022-07-12 01:44:31', 'Colombia. Primera A Clausura', 'Once Caldas', 'La Equidad', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '14-07-2022 01:10 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(285, '2022-07-12 01:46:20', '2022-07-12 01:46:20', 'Colombia. Primera A Clausura', 'La Equidad', 'Once Caldas', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '14-07-2022 01:10 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(286, '2022-07-12 01:48:08', '2022-07-12 01:48:08', ' Colombia. Primera A Clausura', 'AtlÃ©tico Junior', 'AtlÃ©tico Nacional', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '14-07-2022  03:15', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(287, '2022-07-12 01:49:09', '2022-07-12 01:49:09', 'Colombia. Primera A Clausura', 'AtlÃ©tico Nacional', 'AtlÃ©tico Junior', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '14-07-2022  03:15', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(288, '2022-07-12 01:50:23', '2022-07-12 01:50:23', 'Colombia. Primera A Clausura', 'Santa Fe', 'Rionegro Aguilas', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '14-07-2022  23:00 ', '0.000000', 50, 50, 5, 0, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(289, '2022-07-13 10:23:18', '2022-07-13 10:23:18', 'Argentina. Primera Nacional', 'Villa Dalmine', 'Nueva Chicago', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '15-07-2022  02:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(290, '2022-07-13 10:24:09', '2022-07-13 10:24:09', 'Argentina. Primera Nacional', 'Nueva Chicago', 'Villa Dalmine', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '15-07-2022  02:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(291, '2022-07-13 10:25:11', '2022-07-13 10:25:11', 'Argentina. Primera Nacional', 'Quilmes', 'Deportivo Riestra', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '15-07-2022  20:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(292, '2022-07-13 10:26:34', '2022-07-13 10:26:34', 'Brasil. Serie A', 'Athletico Paranaense', 'Internacional', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '16-07-2022  21:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(293, '2022-07-13 10:29:37', '2022-07-13 10:29:37', 'Chile. Primera DivisiÃ³n', 'Palestino', 'Coquimbo Unido', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '16-07-2022 19:15 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(294, '2022-07-20 20:30:43', '2022-07-20 20:30:43', ' Argentina. Liga Profesional', 'Talleres', 'Banfield', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-07-2022 00:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(295, '2022-07-20 20:41:44', '2022-07-20 20:41:44', ' Argentina. Primera Nacional', 'Estudiantes de Rio Cuarto', 'Temperley', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-07-2022 19:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(296, '2022-07-20 20:43:14', '2022-07-20 20:43:14', 'Argentina. Primera Nacional', 'Club AtlÃ©tico Mitre', 'All Boys', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-07-2022 21:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(297, '2022-07-20 20:49:02', '2022-07-20 20:49:02', 'Brasil. Serie A', 'Cuiaba', 'AtlÃ©tico MG', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-07-2022 00:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(298, '2022-07-20 20:50:05', '2022-07-20 20:50:05', ' Brasil. Serie A', 'Palmeiras', 'America MG', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '22-07-2022 01:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(299, '2022-07-22 01:06:44', '2022-07-22 01:06:44', 'Argentina. Liga Profesional', 'Sarmiento', 'Colon', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '23-07-2022 20:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(300, '2022-07-22 01:08:17', '2022-07-22 01:08:17', 'Argentina. Liga Profesional', 'Independiente', 'AtlÃ©tico TucumÃ¡n', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '23-07-2022 23:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(301, '2022-07-22 01:10:08', '2022-07-22 01:10:08', 'Argentina. Primera Nacional', 'San MartÃ­n San Juan', 'TristÃ¡n SuÃ¡rez', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '23-07-2022 00:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(302, '2022-07-22 01:11:47', '2022-07-22 01:11:47', 'Argentina. Primera Nacional', 'Almagro', 'Gimnasia Jujuy', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '23-07-2022 20:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(303, '2022-07-22 01:13:15', '2022-07-22 01:13:15', 'Brasil. Serie A', 'Botafogo RJ', 'Athletico Paranaense', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '24-07-2022 02:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(304, '2022-07-22 01:14:24', '2022-07-22 01:14:24', 'Brasil. Serie A', 'Ceara', 'Juventude', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '24-07-2022 21:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(305, '2022-07-23 11:13:28', '2022-07-23 11:13:28', 'Argentina. Liga Profesional', 'Boca Juniors', 'Estudiantes', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-07-2022 01:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(306, '2022-07-23 11:14:29', '2022-07-23 11:14:29', 'Argentina. Liga Profesional', 'Estudiantes', 'Boca Juniors', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-07-2022 01:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(307, '2022-07-23 11:15:30', '2022-07-23 11:15:30', ' Argentina. Liga Profesional', 'San Lorenzo', 'Talleres', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '25-07-2022  21:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(308, '2022-07-23 11:18:04', '2022-07-23 11:18:04', ' Argentina. Primera Nacional', 'Belgrano', 'Quilmes', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '24-07-2022 00:45', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(309, '2022-07-23 11:19:56', '2022-07-23 11:19:56', 'Brasil. Serie A', 'Coritiba', 'Cuiaba', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-07-2022 01:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(310, '2022-07-23 11:20:44', '2022-07-23 11:20:44', ' Brasil. Serie A', 'Cuiaba', 'Coritiba', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-07-2022 01:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(311, '2022-07-25 11:19:40', '2022-07-25 11:19:40', 'Argentina. Liga Profesional', 'Banfield', 'Argentinos Juniors', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-07-2022 00:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(312, '2022-07-25 11:23:30', '2022-07-25 11:23:30', 'Argentina. Liga Profesional', 'Union', 'Godoy Cruz', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-07-2022 02:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(313, '2022-07-25 11:24:51', '2022-07-25 11:24:51', 'Argentina. Liga Profesional', 'VÃ©lez Sarsfield', 'HuracÃ¡n', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-07-2022  02:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(314, '2022-07-25 11:26:31', '2022-07-25 11:26:31', 'Argentina. Liga Profesional', 'HuracÃ¡n', 'VÃ©lez Sarsfield', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '26-07-2022  02:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(315, '2022-07-26 00:40:07', '2022-07-26 00:40:07', 'Argentina. Liga Profesional', 'Patronato de Parana', 'Barracas Central', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-07-2022 01:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(316, '2022-07-26 00:41:29', '2022-07-26 00:41:29', 'Argentina. Liga Profesional', 'Arsenal Sarandi', 'Rosario Central', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-07-2022 01:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(317, '2022-07-26 03:19:34', '2022-07-26 03:19:34', 'Argentina. Primera Nacional', 'Club AtlÃ©tico Estudiante', 'Brown de AdroguÃ©', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-07-2022  02:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(318, '2022-07-26 03:20:43', '2022-07-26 03:20:43', 'Argentina. Primera Nacional', 'Brown de AdroguÃ©', 'Club AtlÃ©tico Estudiante', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-07-2022  02:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(319, '2022-07-26 03:21:53', '2022-07-26 03:21:53', 'Argentina. Primera Nacional', 'Almagro', 'Flandria', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-07-2022 20:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(320, '2022-07-26 03:25:22', '2022-07-26 03:25:22', 'Argentina. Primera Nacional', 'Deportivo Riestra', 'Ferro Carril Oeste', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-07-2022 20:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(321, '2022-07-27 03:06:35', '2022-07-27 03:06:35', 'Argentina. Primera Nacional', 'Atletico Guemes', 'Club AtlÃ©tico Mitre', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-07-2022 00:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(322, '2022-07-27 03:07:45', '2022-07-27 03:07:45', 'Argentina. Primera Nacional', 'Deportivo Maipu', 'Almirante Brown', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-07-2022 00:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(323, '2022-07-27 03:08:52', '2022-07-27 03:08:52', 'Argentina. Primera Nacional', 'Atlanta', 'CA Defensores de Belgrano', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-07-2022 00:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(324, '2022-07-27 03:10:26', '2022-07-27 03:10:26', 'Argentina. Primera Nacional', 'San Martin de Tucuman', 'San MartÃ­n San Juan', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-07-2022 20:35 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(325, '2022-07-28 01:26:37', '2022-07-28 01:26:37', 'Argentina. Liga Profesional', 'Godoy Cruz', 'VÃ©lez Sarsfield', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-07-2022 01:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(326, '2022-07-28 01:30:02', '2022-07-28 01:30:02', 'Argentina. Liga Profesional', 'VÃ©lez Sarsfield', 'Godoy Cruz', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-07-2022 01:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(327, '2022-07-28 01:31:32', '2022-07-28 01:31:32', 'Argentina. Liga Profesional', 'Talleres', 'Union', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-07-2022 01:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(328, '2022-07-28 01:33:40', '2022-07-28 01:33:40', 'Argentina. Liga Profesional', 'Union', 'Talleres', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-07-2022  01:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(329, '2022-07-28 01:35:56', '2022-07-28 01:35:56', 'Argentina. Liga Profesional', 'Argentinos Juniors', 'San Lorenzo', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-07-2022 20:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(330, '2022-07-28 01:37:39', '2022-07-28 01:37:39', 'Argentina. Liga Profesional', 'Estudiantes', 'Banfield ', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-07-2022  23:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(331, '2022-07-28 01:38:49', '2022-07-28 01:38:49', 'Argentina. Liga Profesional', 'Banfield', 'Estudiantes', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-07-2022  23:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(332, '2022-07-29 20:30:18', '2022-07-29 20:30:18', ' Argentina. Liga Profesional', 'HuracÃ¡n', 'Gimnasia LP', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '31-07-2022  01:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(333, '2022-07-29 20:31:18', '2022-07-29 20:31:18', 'Argentina. Liga Profesional', 'Boca Juniors', 'Patronato de Parana', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '31-07-2022 23:00', '0.000000', 50, 50, 5, 0, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(334, '2022-07-31 10:36:42', '2022-07-31 10:36:42', ' Argentina. Liga Profesional', 'Defensa y Justicia', 'Arsenal Sarandi', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-08-2022 00:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(335, '2022-07-31 10:37:43', '2022-07-31 10:37:43', ' Argentina. Liga Profesional', 'Arsenal Sarandi', 'Defensa y Justicia', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-08-2022 00:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(336, '2022-07-31 10:38:33', '2022-07-31 10:38:33', ' Argentina. Liga Profesional', 'Rosario Central', 'Central Cordoba de Santiago', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-08-2022 00:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(337, '2022-07-31 10:39:29', '2022-07-31 10:39:29', 'Argentina. Liga Profesional', 'Central Cordoba de Santiago', 'Rosario Central', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-08-2022 00:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(338, '2022-08-02 01:47:57', '2022-08-02 01:47:57', ' Argentina. Primera Nacional', 'Estudiantes de Rio Cuarto', 'Deportivo Madryn', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '02-08-2022 20:35 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1);
INSERT INTO `JUEGOS` (`ID`, `INICIO`, `FIN`, `JUEGO`, `EQUIPO1`, `EQUIPO2`, `CAJERO`, `TIPO`, `WALLET`, `REFERENCIA`, `COMISION`, `MIN`, `MAX`, `RATE`, `BLOQUEADO`, `VISIBLE`, `ESTATUS`, `MONEDA`, `APUESTAS`, `DESAFIO`, `DESAFIOX1_5`, `DESAFIOX3`, `FAVORITO`, `ELIMINADO`) VALUES
(339, '2022-08-03 23:59:54', '2022-08-03 23:59:54', 'Inglaterra. Premier League', 'Arsenal FC', 'Crystal Palace', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '05-08-2022  21:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 1, 0, 1, 0, 0, 1),
(340, '2022-08-04 00:01:04', '2022-08-04 00:01:04', ' Inglaterra. Premier League', 'Crystal Palace', 'Arsenal FC', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '05-08-2022  21:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(341, '2022-08-05 21:07:09', '2022-08-05 21:07:09', 'Inglaterra. Premier League', 'Aston Villa', 'AFC Bournemouth', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '06-08-2022', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(342, '2022-08-05 21:09:20', '2022-08-05 21:09:20', 'Inglaterra. Premier League', 'Leeds United', 'Wolverhampton Wanderers', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '06-08-2022 16:00 ', '0.000000', 20, 20, 2, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(343, '2022-08-06 00:12:04', '2022-08-06 00:12:04', 'Inglaterra. Premier League', 'Leicester City', 'Brentford', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '07-08-2022 15:00 ', '0.000000', 20, 50, 5, 1, 0, NULL, 'USDT', 1, 0, 1, 0, 0, 1),
(344, '2022-08-06 00:13:21', '2022-08-06 00:13:21', 'Inglaterra. Premier League', 'Brentford', 'Leicester City', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '07-08-2022 15:00 ', '0.000000', 20, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 1, 0, 1),
(345, '2022-08-07 00:03:57', '2022-08-07 00:03:57', 'Argentina. Primera Nacional', 'Instituto', 'Atletico Guemes', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '08-08-2022 22:10', '0.000000', 10, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(346, '2022-08-07 20:38:06', '2022-08-07 20:38:06', ' Inglaterra. Premier League', 'Manchester United', 'Brentford', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '13-08-2022 18:30 ', '0.000000', 10, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(347, '2022-08-07 20:41:29', '2022-08-07 20:41:29', ' Inglaterra. Premier League', 'Chelsea FC', 'Tottenham Hotspur', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '14-08-2022 17:30 ', '0.000000', 10, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(348, '2022-08-14 15:50:14', '2022-08-14 15:50:14', 'EspaÃ±a. LaLiga (Primera DivisiÃ³n)', 'AtlÃ©tico Madrid', 'Getafe', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '15-08-2022 19:30 ', '0.000000', 20, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(349, '2022-08-16 11:04:08', '2022-08-16 11:04:08', ' Inglaterra. Premier League', 'Everton', 'Nottingham Forest', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '20-08-2022 16:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(350, '2022-08-16 11:05:22', '2022-08-16 11:05:22', 'Inglaterra. Premier League', 'Fulham FC', 'Brentford', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '20-08-2022 16:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(351, '2022-08-16 11:06:29', '2022-08-16 11:06:29', 'Inglaterra. Premier League', 'Crystal Palace', 'Aston Villa', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '20-08-2022 16:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(352, '2022-08-20 23:55:08', '2022-08-20 23:55:08', ' Inglaterra. Premier League', 'West Ham United', 'Brighton & Hove Albion', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '21-08-2022 15:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(353, '2022-08-21 18:38:19', '2022-08-21 18:38:19', 'Inglaterra. Premier League', 'Manchester United', 'Southampton', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-08-2022 13:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(354, '2022-08-21 18:39:21', '2022-08-21 18:39:21', ' Inglaterra. Premier League', 'Brentford', 'Everton', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-08-2022 16:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(355, '2022-08-21 18:41:13', '2022-08-21 18:41:13', ' Inglaterra. Premier League', 'Brighton & Hove Albion', 'Leeds United', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '27-08-2022 16:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(356, '2022-08-27 23:09:33', '2022-08-27 23:09:33', ' Inglaterra. Premier League', 'Aston Villa', 'West Ham United', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-08-2022 15:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(357, '2022-08-27 23:10:52', '2022-08-27 23:10:52', 'Inglaterra. Premier League', 'Newcastle United', 'Wolverhampton Wanderers', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '28-08-2022 15:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 0, 1),
(358, '2022-08-29 00:58:53', '2022-08-29 00:58:53', 'Inglaterra. Premier League', 'Brighton & Hove Albion', 'Fulham FC', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-08-2022  20:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(359, '2022-08-29 01:01:15', '2022-08-29 01:01:15', ' Inglaterra. Premier League', 'Crystal Palace', 'Brentford', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '30-08-2022  20:30', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(360, '2022-08-30 23:48:40', '2022-08-30 23:48:40', 'Inglaterra. Premier League', 'Aston Villa', 'Arsenal FC', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '31-08-2022 20:30 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1),
(361, '2022-08-30 23:50:10', '2022-08-30 23:50:10', 'Inglaterra. Premier League', 'Tottenham Hotspur', 'West Ham United', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '31-08-2022 20:45', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(362, '2022-09-02 20:59:11', '2022-09-02 20:59:11', 'Inglaterra. Premier League', 'Leeds United', 'Brentford', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-09-2022  16:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(363, '2022-09-02 21:00:58', '2022-09-02 21:00:58', 'Inglaterra. Premier League', 'Wolverhampton Wanderers', 'Southampton', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '03-09-2022  16:00', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(364, '2022-09-06 11:47:12', '2022-09-06 11:47:12', 'Champions League. Champions League Grp. B', 'AtlÃ©tico Madrid', 'Oporto', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '07-09-2022 21:00 ', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(365, '2022-09-10 11:23:30', '2022-09-10 11:23:30', ' Argentina. Primera Nacional', 'CA Defensores de Belgrano', 'Deportivo Riestra', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '10-09-2022 22:10', '0.000000', 50, 50, 5, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(366, '2022-11-20 14:32:19', '2022-11-20 14:32:19', 'World Championship. World Cup Grp. A', 'Ecuador', 'Qatar', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '20-11-2022 17:00 ', '0.000000', 20, 20, 5, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(367, '2022-11-21 17:09:07', '2022-11-21 17:09:07', 'World Championship. World Cup Grp. B', 'EE.UU.', 'Gales', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '21-11-2022 20:00', '0.000000', 10, 10, 3, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(368, '2022-11-22 13:38:58', '2022-11-22 13:38:58', ' World Championship. World Cup Grp. F', 'Croacia', 'Marruecos', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '23-11-2022 11:00 ', '0.000000', 10, 10, 0, 1, 0, NULL, 'USDT', 0, 0, 0, 0, 1, 1),
(369, '2022-11-24 12:23:39', '2022-11-24 12:23:39', 'World Championship. World Cup Grp. H', 'Uruguay', 'Corea del Sur', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '24-11-2022  14:00', '0.000000', 10, 10, 3, 1, 0, NULL, 'USDT', 0, 0, 1, 0, 0, 1),
(370, '2022-11-24 12:26:34', '2022-11-24 12:26:34', 'World Championship. World Cup Grp. H', 'Ghana', 'Portugal', 'khorazi57@gmail.com', NULL, 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', '24-11-2022  17:00', '0.000000', 10, 10, 5, 1, 0, NULL, 'USDT', 0, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LIBROCONTABLE`
--

CREATE TABLE `LIBROCONTABLE` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OPERACION` varchar(4) DEFAULT 'COMI',
  `TIPO` varchar(34) DEFAULT NULL,
  `MONTO` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `DEVUELTO` int(11) NOT NULL DEFAULT '0',
  `ESTATUS` varchar(34) DEFAULT 'PAGADO',
  `MONEDA` varchar(4) DEFAULT 'USDT'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `LIBROCONTABLE`
--

INSERT INTO `LIBROCONTABLE` (`ID`, `FECHA`, `OPERACION`, `TIPO`, `MONTO`, `DEVUELTO`, `ESTATUS`, `MONEDA`) VALUES
(48, '2022-06-09 11:07:22', 'COMI', 'APUESTA', '0.5000', 0, 'PAGADO', 'USDT'),
(49, '2022-08-04 19:23:49', 'COMI', 'APUESTA', '0.5000', 0, 'PAGADO', 'USDT'),
(50, '2022-08-05 20:57:01', 'PAGO', 'PREMIO', '10.0000', 0, 'PAGADO', 'USDT'),
(51, '2022-08-05 20:57:01', 'COMI', 'GANADOR', '5.0000', 0, 'PAGADO', 'USDT'),
(52, '2022-08-06 11:44:18', 'COMI', 'APUESTA', '0.5000', 0, 'PAGADO', 'USDT'),
(53, '2022-08-06 13:38:04', 'COMI', 'GANADOR', '5.0000', 0, 'PAGADO', 'USDT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LINKS`
--

CREATE TABLE `LINKS` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LINK` varchar(255) DEFAULT NULL,
  `CORREO` varchar(255) DEFAULT NULL,
  `BLOQUEADO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `LINKS`
--

INSERT INTO `LINKS` (`ID`, `FECHA`, `LINK`, `CORREO`, `BLOQUEADO`) VALUES
(1, '2022-05-27 13:37:33', '794e4af2b6a16f05', 'alfonsi.acosta@gmail.com', 0),
(2, '2022-05-27 13:37:52', 'e9a5e394dfeb92d3', 'khorazi57@gmail.com', 0),
(3, '2022-06-07 10:53:24', 'f4259f22fa8bdd28', 'alfonsi.acosta@gmail.com', 0),
(4, '2022-06-14 15:46:15', 'f4069a829243eff6', 'juniorvilla1778@gmail.com', 0),
(5, '2022-07-25 18:25:12', 'b729635aba0b60a7', 'sergi.jimenezdavila2@gmail.com', 0),
(6, '2022-08-04 18:48:52', '4c59475cdd240ba8', 'maikerfermin55@gmail.com', 0),
(7, '2022-08-06 10:42:19', '678171cabc2ddb8f', 'maikerfermin55@gmail.com', 0),
(8, '2022-08-06 16:09:08', '0ac011116c51a215', 'maikerfermin55@gmail.com', 0),
(9, '2022-08-07 00:41:20', '183c89bcdb3e58f0', 'maikerfermin55@gmail.com', 0),
(10, '2022-08-11 14:23:04', 'a0fbe26340e6ad75', 'maikerfermin55@gmail.com', 0),
(11, '2022-08-11 22:43:12', '2bafaba233412070', 'deivisprosper1986@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LISTA`
--

CREATE TABLE `LISTA` (
  `ID` int(11) NOT NULL,
  `CORREO` varchar(34) DEFAULT NULL,
  `ENVIADO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `LISTA`
--

INSERT INTO `LISTA` (`ID`, `CORREO`, `ENVIADO`) VALUES
(491, 'alfonsi.acosta@gmail.com', 0),
(492, 'khorazi57@gmail.com', 0),
(493, 'geimarosariolopez@gmail.com', 0),
(494, 'daniel.alfonsi2011@gmail.com', 0),
(495, 'racostaugas2@gmail.com', 0),
(496, 'nissagetsu2@gmail.com', 0),
(497, 'juniorvilla1778@gmail.com', 0),
(498, 'jsalavarria02@gmail.com', 0),
(499, 'thaliaescalona4@gmail.com', 0),
(500, 'estebanbrazon@hotmail.com', 0),
(501, 'cpfnewss@gmail.com', 0),
(502, 'maikerfermin55@gmail.com', 0),
(503, 'deivisrodriguez.mls@gmail.com', 0),
(504, 'josearcia1986@gmail.com', 0),
(505, 'hortensiaysabelmedina@gmail.com', 0),
(506, 'marianelajalife@hotmail.com', 0),
(507, 'yoanis.tailer85@gmail.com', 0),
(508, 'negriolindo2021@gmail.com', 0),
(509, 'deivisprosper1986@gmail.com', 0),
(510, 'carlos.celon2501@gmail.com', 0),
(511, 'eli2002rivero@gmail.com', 0),
(512, 'partybarquisimeto@gmail.com', 0),
(513, 'gabrielrojoelfenix18@gmail.com', 0),
(514, 'takeprofit301@gmail.com', 0),
(515, 'Takeprofit301@gmail.com', 0),
(516, 'Takeprofit301@gmail.com', 0),
(517, 'valdezlamal@gmail.com', 0),
(518, 'galleta232323@gmail.com', 0),
(519, 'moyaluis001@gmail.com', 0),
(520, 'rodery9762008@hotmail.com', 0),
(521, 'fernando945@gmail.com', 0),
(522, 'cristianandres21989@gmail.com', 0),
(523, '04162936264az@gmail.com', 0),
(524, 'roylansanchez90@gmail.com', 0),
(525, 'morilloeligio95@gmail.com', 0),
(526, 'Ronny00rj@gmail.com', 0),
(527, 'carlito101535@gmail.com', 0),
(528, 'julioignaciofossati@gmail.com', 0),
(529, 'wromerocolina26@gmail.com', 0),
(530, 'naurejose@gmail.com', 0),
(531, 'santiagosifontes08@gmail.com', 0),
(532, 'collandrews25@gmail.com', 0),
(533, 'martha.figuera2011@gmail.com', 0),
(534, 'wilhc97@gmail.com', 0),
(535, 'arturo_jori_02@live.com', 0),
(536, 'litzbethrigual@gmail.com', 0),
(537, 'b04127822901@gmail.com', 0),
(538, 'minguito2407@gmail.com', 0),
(539, 'mariannyspaolamc@gmail.com', 0),
(540, 'rosaramirezjairosuarez@hotmail.com', 0),
(541, 'bokycacon@gmail.com', 0),
(542, 'becerralazaroinelia@gmail.com', 0),
(543, 'justmir_marcano@hotmail.com', 0),
(544, 'soriaisma87@gmail.com', 0),
(545, 'biancamampel013@gmail.com', 0),
(546, 'zzzrichardgs07@gmail.com', 0),
(547, 'rebelo83@gmail.com', 0),
(548, 'adriannadales946@gmail.com', 0),
(549, 'victory63@homail.com.ar', 0),
(550, 'miyerly.carvallo8@gmail.com', 0),
(551, 'xhorectk@gmail.com', 0),
(552, 'miguelangelmacao@gmail.com', 0),
(553, 'alfonsi.acosta@gmai.com', 0),
(554, 'alvaroamador537@gmail.com', 0),
(555, 'blancomaxi65@gmail.com', 0),
(556, 'antonellaisabel888@gmail.com', 0),
(557, 'baezandres081@gmail.com', 0),
(558, 'baezandre81@gmail.com', 0),
(559, 'julserra192304@gmail.com', 0),
(560, 'radelrio61@gmail.com', 0),
(561, 'maikolalejandro911@gmail.com', 0),
(562, 'felix_1587@hotmail.com', 0),
(563, 'josexadier88@gmail.com', 0),
(564, 'minamohebb@gmail.com', 0),
(565, 'jimenezrunner@gmail.com', 0),
(566, 'lcc06cogollo@gmail.com', 0),
(567, 'lirianoarianny@icloud.com', 0),
(568, 'luiso.18@hotmail.com', 0),
(569, 'visiondigitalpc@gmail.com', 0),
(570, 'gutierrezh1000@gmail.com', 0),
(571, 'sergi.jimenezdavila2@gmail.com', 0),
(572, 'pescatotal@outlook.com', 0),
(573, 'roncar7901@hotmail.com', 0),
(574, 'arieldecima81@gmail.com', 0),
(575, 'millonaria2505@gmail.com', 0),
(576, 'medinapinoa@gmail.com', 0),
(577, 'andrestirado201548@gmail.com', 0),
(578, 'cruzdejesus775@gmail.com', 0),
(579, 'alexandermora8@hotmail.com', 0),
(580, 'wilnerlysflores@gmail.com', 0),
(581, 'jesuslongart26@hotmail.com', 0),
(582, 'danhielavaguilera16@gmail.com', 0),
(583, 'naomismarcano27tochon@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROMO`
--

CREATE TABLE `PROMO` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CODIGO` text,
  `NOMBRE` varchar(34) DEFAULT NULL,
  `MENSAJE` text,
  `COLORBG` varchar(34) DEFAULT NULL,
  `COLORFG` varchar(34) DEFAULT NULL,
  `BORDER` varchar(34) DEFAULT NULL,
  `NUMPROMO` int(11) NOT NULL DEFAULT '0',
  `PREMIO` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `VISIBLE` int(11) NOT NULL DEFAULT '0',
  `GANADOR` int(11) NOT NULL DEFAULT '0',
  `DIFUSION` int(11) NOT NULL DEFAULT '0',
  `FLOTANTE` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `PROMO`
--

INSERT INTO `PROMO` (`ID`, `FECHA`, `CODIGO`, `NOMBRE`, `MENSAJE`, `COLORBG`, `COLORFG`, `BORDER`, `NUMPROMO`, `PREMIO`, `VISIBLE`, `GANADOR`, `DIFUSION`, `FLOTANTE`) VALUES
(32, '2022-07-25 11:14:01', '87862d4de122345e', 'RETO 1500 USDT', 'CONSIGUE UNA RACHA DE 15 TRIUNFOS CONTINUOS Y GANA 1500 USDT', NULL, NULL, NULL, 15, '1500.0000', 0, 1, 0, 0),
(35, '2022-08-03 23:08:08', '41e73ee37ffc878c', 'PUBLICIDADD', 'Fortuna Royal es una pÃ¡gina de juegos y competiciÃ³n creada con el propÃ³sito de entretener y relajarte, puedes hacer dinero mientras juegas!, recuerda que eres uno de nuestros miembros privilegiados y puedes ganar hasta 1500 dolares en premios, juega y diviÃ©rtete. Fortuna Royal, una pagina Ãšnica para un publico Ãšnico. https://fortunaroyal.com/', NULL, NULL, NULL, 5000000, '999999.9999', 0, 0, 1, 0),
(38, '2022-11-25 16:29:19', 'c7c1d7ca536d1cae', 'Publicidad ', 'EN MANTENIMIENTO', NULL, NULL, NULL, 5, '0.0000', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `REFERIDOS`
--

CREATE TABLE `REFERIDOS` (
  `ID` int(11) NOT NULL,
  `REFERIDO` varchar(34) DEFAULT NULL,
  `REFERENTE` varchar(34) DEFAULT NULL,
  `VALIDO` int(11) NOT NULL DEFAULT '0',
  `RETIRADO` int(11) NOT NULL DEFAULT '0',
  `LOGROS` int(11) NOT NULL DEFAULT '0',
  `RECOMPENSA` decimal(13,2) UNSIGNED NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `REFERIDOS`
--

INSERT INTO `REFERIDOS` (`ID`, `REFERIDO`, `REFERENTE`, `VALIDO`, `RETIRADO`, `LOGROS`, `RECOMPENSA`) VALUES
(1, 'ac8813bbfbe20e9e', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(2, '975cd4a5d6bea461', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(3, 'e131501089efcfc7', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(4, '7da72847f374d7d1', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(5, '26a28ecaca731e11', 'a4050f5ac6267099', 0, 0, 1, '0.00'),
(6, 'a4050f5ac6267099', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(7, '2fc011839b120957', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(8, '941b60ecd6636f89', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(9, 'ddd89d4b32e14676', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(10, 'be0d9967a48bf045', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(11, '3ac57ae39ffc6134', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(12, 'e2425c9038c09d54', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(13, '0faa17f6a10ece43', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(14, 'beb3e702b5924032', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(15, '3afae239365038d4', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(16, 'f0907a9be3357988', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(17, '57c32fcabde304dc', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(18, 'c8491e032d606230', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(19, 'e5763259ff693f0f', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(20, 'd5e0b4a8732cbbec', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(21, '7aec99f285f1fd59', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(22, 'd1171ab4ba747047', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(23, 'f58600cd7d2cae55', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(24, '627e4f76811bbfea', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(25, '0ec2c451b5b94b41', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(26, '295ddee552ac4d99', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(27, 'c0a09d67af876ac6', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(28, '424da2c65885d1b0', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(29, '4640241d8efd7cc2', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(30, 'cc9059b0ef0bacfe', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(31, 'a92ec40971ffe70b', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(32, '7c1055f79b741478', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(33, 'd533e74741287282', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(34, '9de84172622ee283', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(35, 'bf01c630f1de6832', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(36, '1594f8b4aec545e9', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(37, 'bc1c9677fc737466', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(38, 'ebd2a811f62ee127', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(39, 'cc18ba580aae151a', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(40, '92f8d58aceca8d36', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(41, '03fc4791b6af3dbd', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(42, '15a9399fbe0ff0a1', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(43, '4368caf03698c975', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(44, '27b06bb98d52c2fa', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(45, '63fa346ad45ebfdc', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(46, '85a08343d5209339', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(47, '90576f8b34198338', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(48, 'cb217f1171ad9715', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(49, '66b524efa0180a3f', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(50, '49fc4a778d89682d', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(51, '0009317eee08b339', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(52, '9894d1160969a8fa', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(53, '1167a15ab00515bc', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(54, '73c7ad07f695338b', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(55, 'b13bc3879f165b71', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(56, 'ae1ee6de1454e385', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(57, '05a42a3cf84769f1', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(58, 'd40fd0e76c6642cb', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(59, 'f02bb4bbfb40aad6', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(60, '91aec108a83c5436', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(61, '7ee0659bec55b353', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(62, 'e792d1d17c7ada04', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(63, '08bfaa7fc8f1719f', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(64, '1ad0426f51e6540c', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(65, 'b91d96e0b92b245e', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(66, 'a25e2a1a5c72f41a', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(67, 'e79c5cdfe9653c6c', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(68, 'd6cdb8b78f73a0a0', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(69, '3bfa9d6df523d417', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(70, '2cd65fba24553ca5', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(71, '445fc358c0ff683d', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(72, '84c3d4860514927d', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(73, '753ff9f4dd2e38b1', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(74, 'd381a70826da643d', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(75, '57a719a1b5b78b05', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(76, '2d8b46e9b9764116', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(77, '4523e6e52a8da040', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(78, 'b288775521b00ddf', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(79, 'ad572d517319ac6f', 'a4050f5ac6267099', 0, 0, 0, '0.00'),
(80, '888eb7d16c7b28bf', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(81, '543fa81b4c61473b', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(82, '4066600fd28fade6', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(83, 'cd019ee6adac2e08', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(84, '2396a630a423cf23', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(85, '655e33cd4da0c45b', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(86, '915caa98a777617e', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(87, '9b9f1b0d679ebb29', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(88, '28f263d3e8e742f7', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(89, '3bc74e5dcced65ae', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(90, 'a8841da7cd5919dd', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(91, '7d65ef75d041437d', '941b60ecd6636f89', 0, 0, 0, '0.00'),
(92, 'a6baee49f3b3eedc', '941b60ecd6636f89', 0, 0, 0, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USERPROMO`
--

CREATE TABLE `USERPROMO` (
  `ID` int(11) NOT NULL,
  `CODIGO` text,
  `CORREO` varchar(34) DEFAULT NULL,
  `RATE` int(11) NOT NULL DEFAULT '0',
  `NUMREF` int(11) NOT NULL DEFAULT '0',
  `NUMPROMO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USERPROMO`
--

INSERT INTO `USERPROMO` (`ID`, `CODIGO`, `CORREO`, `RATE`, `NUMREF`, `NUMPROMO`) VALUES
(1, '87862d4de122345e', 'maikerfermin55@gmail.com', 0, 0, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IP` varchar(255) DEFAULT NULL,
  `APODO` varchar(25) DEFAULT NULL,
  `PASSWORD` varchar(13) DEFAULT NULL,
  `CORREO` varchar(34) DEFAULT NULL,
  `TELEFONO` varchar(15) DEFAULT NULL,
  `NOMBRE` varchar(255) DEFAULT NULL,
  `NACIONALIDAD` varchar(34) DEFAULT NULL,
  `LINKREFERIDO` varchar(255) DEFAULT NULL,
  `CODIGOREFERIDO` varchar(255) DEFAULT NULL,
  `WALLET` varchar(255) DEFAULT NULL,
  `APIKEY` varchar(255) DEFAULT NULL,
  `HEXWALLET` varchar(255) DEFAULT NULL,
  `RATE` int(11) NOT NULL DEFAULT '0',
  `SALDO` decimal(13,4) UNSIGNED NOT NULL DEFAULT '0.0000',
  `USDT` decimal(13,4) UNSIGNED NOT NULL DEFAULT '0.0000',
  `P2P` decimal(13,4) UNSIGNED NOT NULL DEFAULT '0.0000',
  `SALDOREFERIDO` decimal(13,4) UNSIGNED NOT NULL DEFAULT '0.0000',
  `ACTIVO` int(11) NOT NULL DEFAULT '0',
  `BLOQUEADO` int(11) NOT NULL DEFAULT '0',
  `NIVEL` int(11) NOT NULL DEFAULT '0',
  `PERFIL` varchar(255) DEFAULT 'perfil.jpg',
  `PAYEER` varchar(255) DEFAULT NULL,
  `BINANCE` varchar(255) DEFAULT NULL,
  `AIRTM` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`ID`, `FECHA`, `IP`, `APODO`, `PASSWORD`, `CORREO`, `TELEFONO`, `NOMBRE`, `NACIONALIDAD`, `LINKREFERIDO`, `CODIGOREFERIDO`, `WALLET`, `APIKEY`, `HEXWALLET`, `RATE`, `SALDO`, `USDT`, `P2P`, `SALDOREFERIDO`, `ACTIVO`, `BLOQUEADO`, `NIVEL`, `PERFIL`, `PAYEER`, `BINANCE`, `AIRTM`) VALUES
(1, '2022-05-27 12:11:24', '190.38.12.56', NULL, 'Bertha$344', 'alfonsi.acosta@gmail.com', NULL, 'alfonsi.acosta@gmail.com', NULL, NULL, 'a4050f5ac6267099', 'TLrahcUgJFnm3ggVYaEEWposJw39T9fXev', NULL, NULL, 2, '0.5000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'P1073744892', NULL, NULL),
(2, '2022-05-27 12:27:02', '190.94.235.229', NULL, '14855453', 'khorazi57@gmail.com', NULL, 'khorazi57@gmail.com', NULL, NULL, '2fc011839b120957', 'TXDJfYCBXFbskhiQVLiPZyZmifhgRf6GCK', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 1, 'perfil.jpg', 'P80506606', NULL, NULL),
(3, '2022-05-28 21:38:06', '190.94.235.229', NULL, 'margarita63', 'geimarosariolopez@gmail.com', NULL, 'geimarosariolopez@gmail.com', NULL, NULL, '941b60ecd6636f89', 'TFYeVhNGETuV6cMSRn4f6nj5h6C4i2SouD', NULL, NULL, 2, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'P80506606', NULL, NULL),
(4, '2022-05-29 23:00:17', '200.84.245.20', NULL, 'a10882990', 'daniel.alfonsi2011@gmail.com', NULL, 'daniel.alfonsi2011@gmail.com', NULL, NULL, 'ddd89d4b32e14676', '546223213213546', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(5, '2022-05-31 14:29:07', '190.94.231.25', NULL, 'r25455841A', 'racostaugas2@gmail.com', NULL, 'racostaugas2@gmail.com', NULL, NULL, 'be0d9967a48bf045', '', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'P80529293', NULL, NULL),
(6, '2022-06-03 16:41:13', '200.84.245.20', NULL, 'a10882990', 'nissagetsu2@gmail.com', NULL, 'nissagetsu2@gmail.com', NULL, NULL, '3ac57ae39ffc6134', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(7, '2022-06-05 13:21:59', '186.88.198.20', NULL, 'J17781355', 'juniorvilla1778@gmail.com', NULL, 'juniorvilla1778@gmail.com', NULL, NULL, 'e2425c9038c09d54', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(8, '2022-06-05 15:58:35', '190.200.250.158', NULL, '14223753', 'jsalavarria02@gmail.com', NULL, 'jsalavarria02@gmail.com', NULL, NULL, '0faa17f6a10ece43', 'TSGSwopWVocupr2UPBPmhp5WPTdWFzBQKu', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(9, '2022-06-05 17:17:17', '152.206.240.176', NULL, '5772', 'thaliaescalona4@gmail.com', NULL, 'thaliaescalona4@gmail.com', NULL, NULL, 'beb3e702b5924032', 'Hvnno', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(10, '2022-06-05 22:51:02', '190.36.38.242', NULL, '10220966eb', 'estebanbrazon@hotmail.com', NULL, 'estebanbrazon@hotmail.com', NULL, NULL, '3afae239365038d4', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(12, '2022-06-07 00:16:10', '181.120.26.28', NULL, '29273119', 'cpfnewss@gmail.com', NULL, 'cpfnewss@gmail.com', NULL, NULL, 'f0907a9be3357988', 'TPCvQ1DYKk1Wjr2Yvfdh17Kae8BE3DtcZpTPCvQ1DYKk1Wjr2Yvfdh17Kae8BE3DtcZp', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(13, '2022-06-07 19:05:30', '190.207.19.60', NULL, 'Santiago_5', 'maikerfermin55@gmail.com', NULL, 'maikerfermin55@gmail.com', NULL, NULL, '26a28ecaca731e11', 'TR4XAsG1M8ZiYyjJ7ZakyJdQYHbmXrccG9', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '', NULL, NULL),
(14, '2022-06-07 19:47:18', '190.94.231.32', NULL, 'Kyosko22', 'deivisrodriguez.mls@gmail.com', NULL, 'deivisrodriguez.mls@gmail.com', NULL, NULL, '57c32fcabde304dc', '', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '', NULL, NULL),
(16, '2022-06-09 10:44:04', '186.185.37.252', NULL, '17705040', 'josearcia1986@gmail.com', NULL, 'josearcia1986@gmail.com', NULL, NULL, 'ac8813bbfbe20e9e', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(17, '2022-06-11 23:05:25', '190.38.23.180', NULL, '123Lana45*', 'hortensiaysabelmedina@gmail.com', NULL, 'hortensiaysabelmedina@gmail.com', NULL, NULL, '975cd4a5d6bea461', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(18, '2022-06-12 08:30:09', '190.188.39.247', NULL, 'beta2204794', 'marianelajalife@hotmail.com', NULL, 'marianelajalife@hotmail.com', NULL, NULL, 'e131501089efcfc7', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(19, '2022-06-12 19:47:09', '152.206.234.99', NULL, 'yhg55555', 'yoanis.tailer85@gmail.com', NULL, 'yoanis.tailer85@gmail.com', NULL, NULL, 'c8491e032d606230', '0x52b07059552cC7fb1bbB492a2B8Fb608EEc5a20c', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'P1068079719', NULL, NULL),
(20, '2022-06-14 15:47:49', '186.167.242.219', NULL, '17781344', 'negriolindo2021@gmail.com', NULL, 'negriolindo2021@gmail.com', NULL, NULL, 'e5763259ff693f0f', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(21, '2022-06-14 17:18:07', '186.167.249.246', NULL, '17781344', 'deivisprosper1986@gmail.com', NULL, 'deivisprosper1986@gmail.com', NULL, NULL, '7da72847f374d7d1', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(22, '2022-06-17 12:46:18', '186.169.211.63', NULL, '3122103848', 'carlos.celon2501@gmail.com', NULL, 'carlos.celon2501@gmail.com', NULL, NULL, 'd5e0b4a8732cbbec', 'Andres Celon ', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'CPA_00DZ4KI6KZ', NULL, NULL),
(23, '2022-06-17 14:19:24', '190.120.252.164', NULL, '28258199', 'eli2002rivero@gmail.com', NULL, 'eli2002rivero@gmail.com', NULL, NULL, '7aec99f285f1fd59', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(24, '2022-06-17 15:45:43', '186.167.251.99', NULL, '123456salmo', 'partybarquisimeto@gmail.com', NULL, 'partybarquisimeto@gmail.com', NULL, NULL, 'd1171ab4ba747047', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(25, '2022-06-18 22:25:32', '170.51.168.238', NULL, 'Esteban2020', 'gabrielrojoelfenix18@gmail.com', NULL, 'gabrielrojoelfenix18@gmail.com', NULL, NULL, 'f58600cd7d2cae55', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(26, '2022-06-18 23:30:21', '190.120.248.154', NULL, 'Yaracal2021', 'takeprofit301@gmail.com', NULL, 'takeprofit301@gmail.com', NULL, NULL, '627e4f76811bbfea', 'TD2jTsfNgFHWtpBkLeHQ4zfyu9iqX1SrNe', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '', NULL, NULL),
(27, '2022-06-18 23:32:27', '190.120.248.154', NULL, 'Yaracal2021', 'Takeprofit301@gmail.com', NULL, 'Takeprofit301@gmail.com', NULL, NULL, '295ddee552ac4d99', 'TD2jTsfNgFHWtpBkLeHQ4zfyu9iqX1SrNe', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '', NULL, NULL),
(28, '2022-06-18 23:36:44', '190.120.248.154', NULL, 'Yaracal2021', 'Takeprofit301@gmail.com', NULL, 'Takeprofit301@gmail.com', NULL, NULL, 'c0a09d67af876ac6', 'TD2jTsfNgFHWtpBkLeHQ4zfyu9iqX1SrNe', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '', NULL, NULL),
(29, '2022-06-18 23:56:27', '45.176.94.46', NULL, 'Lamal1212', 'valdezlamal@gmail.com', NULL, 'valdezlamal@gmail.com', NULL, NULL, '0ec2c451b5b94b41', 'THYayShx1NStv2cAD4t8nWVfwxQid1EbgG', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'Lamal12', NULL, NULL),
(30, '2022-06-19 02:51:45', '181.204.172.170', NULL, 'deli1812', 'galleta232323@gmail.com', NULL, 'galleta232323@gmail.com', NULL, NULL, '424da2c65885d1b0', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(31, '2022-06-19 18:03:53', '190.38.29.141', NULL, 'V14290917', 'moyaluis001@gmail.com', NULL, 'moyaluis001@gmail.com', NULL, NULL, '4640241d8efd7cc2', 'TFtY4rd9HRsrDMyenLn7YpumnNnF2ZmCAZ', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '290917', NULL, NULL),
(32, '2022-06-19 19:36:55', '190.198.80.121', NULL, 'krystal0901', 'rodery9762008@hotmail.com', NULL, 'rodery9762008@hotmail.com', NULL, NULL, 'cc9059b0ef0bacfe', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(33, '2022-06-20 03:22:55', '152.206.194.178', NULL, 'pich1234', 'fernando945@gmail.com', NULL, 'fernando945@gmail.com', NULL, NULL, 'a92ec40971ffe70b', 'TRpHsrRNdHxL3dHuy9NeDgewN5BP6N5pKN', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '88071126265', NULL, NULL),
(34, '2022-06-20 03:32:09', '190.97.239.70', NULL, 'Cristinaymia0', 'cristianandres21989@gmail.com', NULL, 'cristianandres21989@gmail.com', NULL, NULL, '7c1055f79b741478', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(35, '2022-06-20 03:43:35', '200.84.225.201', NULL, 'Dianeisisdelv', '04162936264az@gmail.com', NULL, '04162936264az@gmail.com', NULL, NULL, 'd533e74741287282', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(36, '2022-06-20 17:13:44', '152.206.209.1', NULL, 'brianna13', 'roylansanchez90@gmail.com', NULL, 'roylansanchez90@gmail.com', NULL, NULL, '9de84172622ee283', 'TTJr8eCLwDsjf3Tv1pmNejSri7m9dm7Nm6', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'brianna13', NULL, NULL),
(37, '2022-06-20 22:45:17', '201.249.147.69', NULL, 'Teto11%%&', 'morilloeligio95@gmail.com', NULL, 'morilloeligio95@gmail.com', NULL, NULL, 'bf01c630f1de6832', 'Fs57kjt6', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '248822', NULL, NULL),
(38, '2022-06-20 23:30:00', '190.120.252.33', NULL, '24644702', 'Ronny00rj@gmail.com', NULL, 'Ronny00rj@gmail.com', NULL, NULL, '1594f8b4aec545e9', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(39, '2022-06-21 04:25:32', '201.242.254.19', NULL, 'menca30.', 'carlito101535@gmail.com', NULL, 'carlito101535@gmail.com', NULL, NULL, 'bc1c9677fc737466', 'TPMq6bwtPJKWo15NVLdrprY8qkViDy9Eqk', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'lapaz', NULL, NULL),
(40, '2022-06-21 14:56:01', '24.232.153.186', NULL, 'julio2022', 'julioignaciofossati@gmail.com', NULL, 'julioignaciofossati@gmail.com', NULL, NULL, 'ebd2a811f62ee127', 'TFPmLRPL3TRDMWgRpW1V4gArYyVGSX3xhm', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '', NULL, NULL),
(41, '2022-06-21 23:02:29', '186.167.245.135', NULL, 'Wwilliams14', 'wromerocolina26@gmail.com', NULL, 'wromerocolina26@gmail.com', NULL, NULL, 'cc18ba580aae151a', 'TYZW7h2Cxtw4jxUjwVHH5fQXsULqBte7bo', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '207451873', NULL, NULL),
(42, '2022-06-23 03:03:09', '181.64.93.93', NULL, '26661836', 'naurejose@gmail.com', NULL, 'naurejose@gmail.com', NULL, NULL, '92f8d58aceca8d36', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(43, '2022-06-23 16:00:29', '186.88.204.54', NULL, 'apamte15.', 'santiagosifontes08@gmail.com', NULL, 'santiagosifontes08@gmail.com', NULL, NULL, '03fc4791b6af3dbd', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(44, '2022-06-24 11:19:22', '186.169.163.217', NULL, '18528732', 'collandrews25@gmail.com', NULL, 'collandrews25@gmail.com', NULL, NULL, '15a9399fbe0ff0a1', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(45, '2022-06-25 23:52:34', '186.88.213.248', NULL, 'a10882990', 'martha.figuera2011@gmail.com', NULL, 'martha.figuera2011@gmail.com', NULL, NULL, '63fa346ad45ebfdc', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(46, '2022-06-27 04:35:55', '190.239.93.196', NULL, '06noviembre', 'wilhc97@gmail.com', NULL, 'wilhc97@gmail.com', NULL, NULL, '4368caf03698c975', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(47, '2022-06-28 01:56:16', '186.185.22.135', NULL, 'art123,.', 'arturo_jori_02@live.com', NULL, 'arturo_jori_02@live.com', NULL, NULL, '27b06bb98d52c2fa', '', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '', NULL, NULL),
(48, '2022-06-30 15:54:26', '186.94.19.102', NULL, '19635198', 'litzbethrigual@gmail.com', NULL, 'litzbethrigual@gmail.com', NULL, NULL, '57a719a1b5b78b05', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(49, '2022-07-01 18:33:29', '186.167.249.173', NULL, '12425468', 'b04127822901@gmail.com', NULL, 'b04127822901@gmail.com', NULL, NULL, '85a08343d5209339', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(50, '2022-07-02 11:19:41', '186.94.5.40', NULL, 'M1ngo2308#', 'minguito2407@gmail.com', NULL, 'minguito2407@gmail.com', NULL, NULL, '90576f8b34198338', '', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '', NULL, NULL),
(51, '2022-07-02 23:41:03', '190.94.238.169', NULL, 'efesios51', 'mariannyspaolamc@gmail.com', NULL, 'mariannyspaolamc@gmail.com', NULL, NULL, 'cb217f1171ad9715', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(52, '2022-07-04 11:59:26', '191.95.48.90', NULL, 'Jairo2580', 'rosaramirezjairosuarez@hotmail.com', NULL, 'rosaramirezjairosuarez@hotmail.com', NULL, NULL, '66b524efa0180a3f', 'TJ13WawR18gabdc7tvur6pkaQBVayD2Ewu', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'Rosaramirezjairosuarez@hotmail.com', NULL, NULL),
(53, '2022-07-05 11:21:04', '190.166.55.107', NULL, 'estadio02', 'bokycacon@gmail.com', NULL, 'bokycacon@gmail.com', NULL, NULL, '49fc4a778d89682d', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(54, '2022-07-06 02:32:35', '200.6.167.138', NULL, 'makina2491', 'becerralazaroinelia@gmail.com', NULL, 'becerralazaroinelia@gmail.com', NULL, NULL, '0009317eee08b339', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(55, '2022-07-06 02:37:27', '190.207.30.203', NULL, 'justmir_marca', 'justmir_marcano@hotmail.com', NULL, 'justmir_marcano@hotmail.com', NULL, NULL, '9894d1160969a8fa', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(56, '2022-07-06 03:05:22', '186.12.204.164', NULL, 'sairaqganas', 'soriaisma87@gmail.com', NULL, 'soriaisma87@gmail.com', NULL, NULL, '1167a15ab00515bc', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(57, '2022-07-06 04:49:10', '200.117.195.183', NULL, 'bianca013', 'biancamampel013@gmail.com', NULL, 'biancamampel013@gmail.com', NULL, NULL, '73c7ad07f695338b', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(58, '2022-07-09 17:15:20', '186.167.251.29', NULL, '18177430r', 'zzzrichardgs07@gmail.com', NULL, 'zzzrichardgs07@gmail.com', NULL, NULL, 'b13bc3879f165b71', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(59, '2022-07-10 13:40:19', '181.225.57.82', NULL, 'Game619.', 'rebelo83@gmail.com', NULL, 'rebelo83@gmail.com', NULL, NULL, 'ae1ee6de1454e385', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(60, '2022-07-11 01:04:54', '190.36.22.11', NULL, '27946622', 'adriannadales946@gmail.com', NULL, 'adriannadales946@gmail.com', NULL, NULL, '05a42a3cf84769f1', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(61, '2022-07-11 01:19:42', '168.181.26.1', NULL, 'belgrano413', 'victory63@homail.com.ar', NULL, 'victory63@homail.com.ar', NULL, NULL, 'd40fd0e76c6642cb', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(62, '2022-07-11 02:43:00', '200.8.190.154', NULL, 'miyetsy.14', 'miyerly.carvallo8@gmail.com', NULL, 'miyerly.carvallo8@gmail.com', NULL, NULL, 'f02bb4bbfb40aad6', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(63, '2022-07-11 03:31:41', '186.167.250.129', NULL, 'xhorectk1', 'xhorectk@gmail.com', NULL, 'xhorectk@gmail.com', NULL, NULL, '91aec108a83c5436', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(64, '2022-07-11 11:45:45', '157.100.52.187', NULL, '12345678', 'miguelangelmacao@gmail.com', NULL, 'miguelangelmacao@gmail.com', NULL, NULL, '7ee0659bec55b353', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(65, '2022-07-11 14:19:41', '186.88.208.228', NULL, 'Bertha$344', 'alfonsi.acosta@gmai.com', NULL, 'alfonsi.acosta@gmai.com', NULL, NULL, '2d8b46e9b9764116', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(66, '2022-07-11 15:35:23', '152.207.247.11', NULL, 'Alvaro97', 'alvaroamador537@gmail.com', NULL, 'alvaroamador537@gmail.com', NULL, NULL, 'e792d1d17c7ada04', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(67, '2022-07-11 22:16:10', '181.9.137.42', NULL, '190991maxi', 'blancomaxi65@gmail.com', NULL, 'blancomaxi65@gmail.com', NULL, NULL, '08bfaa7fc8f1719f', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(68, '2022-07-11 23:06:28', '186.111.154.129', NULL, 'mimoto110', 'antonellaisabel888@gmail.com', NULL, 'antonellaisabel888@gmail.com', NULL, NULL, '1ad0426f51e6540c', 'TAqxJWfFw6munE9seWe7KjG5ywQcZMKCtv', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', 'P1066006067', NULL, NULL),
(69, '2022-07-12 00:26:56', '168.121.33.237', NULL, 'palito198433', 'baezandres081@gmail.com', NULL, 'baezandres081@gmail.com', NULL, NULL, '4523e6e52a8da040', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(70, '2022-07-12 00:28:57', '168.121.33.237', NULL, 'plito198433', 'baezandre81@gmail.com', NULL, 'baezandre81@gmail.com', NULL, NULL, 'b91d96e0b92b245e', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(71, '2022-07-12 03:52:19', '191.95.49.185', NULL, 'nacional91230', 'julserra192304@gmail.com', NULL, 'julserra192304@gmail.com', NULL, NULL, 'a25e2a1a5c72f41a', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(72, '2022-07-12 17:24:20', '167.249.198.23', NULL, 'Rdr14305', 'radelrio61@gmail.com', NULL, 'radelrio61@gmail.com', NULL, NULL, 'e79c5cdfe9653c6c', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(73, '2022-07-12 17:29:22', '186.167.242.49', NULL, 'Castellar2005', 'maikolalejandro911@gmail.com', NULL, 'maikolalejandro911@gmail.com', NULL, NULL, 'd6cdb8b78f73a0a0', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(74, '2022-07-13 10:56:45', '45.22.65.132', NULL, 'edgar1587', 'felix_1587@hotmail.com', NULL, 'felix_1587@hotmail.com', NULL, NULL, '3bfa9d6df523d417', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(75, '2022-07-13 12:08:13', '186.188.16.149', NULL, 'fara..88', 'josexadier88@gmail.com', NULL, 'josexadier88@gmail.com', NULL, NULL, '2cd65fba24553ca5', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(76, '2022-07-14 03:25:19', '41.34.228.117', NULL, 'Mina1234', 'minamohebb@gmail.com', NULL, 'minamohebb@gmail.com', NULL, NULL, '445fc358c0ff683d', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(77, '2022-07-15 11:10:29', '152.206.213.164', NULL, '12345678', 'jimenezrunner@gmail.com', NULL, 'jimenezrunner@gmail.com', NULL, NULL, '84c3d4860514927d', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(78, '2022-07-16 11:56:20', '191.156.68.15', NULL, 'claudia2022', 'lcc06cogollo@gmail.com', NULL, 'lcc06cogollo@gmail.com', NULL, NULL, '753ff9f4dd2e38b1', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(79, '2022-07-17 15:13:21', '168.232.108.81', NULL, 'soCquq-0syxni', 'lirianoarianny@icloud.com', NULL, 'lirianoarianny@icloud.com', NULL, NULL, 'b288775521b00ddf', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(80, '2022-07-18 13:28:58', '204.137.174.165', NULL, 'lopokijo', 'luiso.18@hotmail.com', NULL, 'luiso.18@hotmail.com', NULL, NULL, 'ad572d517319ac6f', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(81, '2022-07-20 21:06:28', '186.83.60.198', NULL, 'Visionccn1', 'visiondigitalpc@gmail.com', NULL, 'visiondigitalpc@gmail.com', NULL, NULL, 'd381a70826da643d', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(82, '2022-07-24 23:28:22', '152.207.133.5', NULL, 'Alice2020', 'gutierrezh1000@gmail.com', NULL, 'gutierrezh1000@gmail.com', NULL, NULL, '888eb7d16c7b28bf', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(83, '2022-07-25 18:25:08', '201.243.104.139', NULL, 'Alejandro32', 'sergi.jimenezdavila2@gmail.com', NULL, 'sergi.jimenezdavila2@gmail.com', NULL, NULL, '543fa81b4c61473b', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(87, '2022-07-25 23:32:38', '186.190.177.85', NULL, 'Mallea1983', 'pescatotal@outlook.com', NULL, 'pescatotal@outlook.com', NULL, NULL, '655e33cd4da0c45b', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(88, '2022-07-26 05:36:27', '181.235.109.185', NULL, 'rc13011979', 'roncar7901@hotmail.com', NULL, 'roncar7901@hotmail.com', NULL, NULL, '915caa98a777617e', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(89, '2022-07-27 14:43:17', '190.55.150.186', NULL, 'denise2019', 'arieldecima81@gmail.com', NULL, 'arieldecima81@gmail.com', NULL, NULL, '9b9f1b0d679ebb29', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(90, '2022-07-28 14:54:57', '191.95.59.223', NULL, 'Maria2348', 'millonaria2505@gmail.com', NULL, 'millonaria2505@gmail.com', NULL, NULL, '28f263d3e8e742f7', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(91, '2022-08-02 14:07:23', '38.41.8.37', NULL, '28658222', 'medinapinoa@gmail.com', NULL, 'medinapinoa@gmail.com', NULL, NULL, '3bc74e5dcced65ae', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(92, '2022-08-11 13:32:53', '146.75.208.2', NULL, 'Sara1203', 'andrestirado201548@gmail.com', NULL, 'andrestirado201548@gmail.com', NULL, NULL, 'a8841da7cd5919dd', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(93, '2022-08-28 02:37:43', '172.58.120.43', NULL, '030915Cn@', 'cruzdejesus775@gmail.com', NULL, 'cruzdejesus775@gmail.com', NULL, NULL, '1f153c76a3a128c7', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(94, '2022-09-06 14:34:00', '179.53.237.38', NULL, 'Miburrito12', 'alexandermora8@hotmail.com', NULL, 'alexandermora8@hotmail.com', NULL, NULL, '4477df1e0083ba80', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(95, '2022-09-19 03:29:23', '186.167.245.180', NULL, '31383554', 'wilnerlysflores@gmail.com', NULL, 'wilnerlysflores@gmail.com', NULL, NULL, '341f212de2397493', 'wilnerlysflores@gmail.com', NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', '31383554', NULL, NULL),
(96, '2022-09-27 20:57:12', '186.94.239.45', NULL, '17216376', 'jesuslongart26@hotmail.com', NULL, 'jesuslongart26@hotmail.com', NULL, NULL, '7d65ef75d041437d', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(97, '2022-10-08 14:57:22', '191.158.115.187', NULL, '27480556dvaa', 'danhielavaguilera16@gmail.com', NULL, 'danhielavaguilera16@gmail.com', NULL, NULL, 'a6baee49f3b3eedc', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL),
(98, '2022-10-12 04:23:07', '186.185.117.207', NULL, 'thenotorius00', 'naomismarcano27tochon@gmail.com', NULL, 'naomismarcano27tochon@gmail.com', NULL, NULL, 'b26c59a28243a704', NULL, NULL, NULL, 0, '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 'perfil.jpg', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `APUESTAS`
--
ALTER TABLE `APUESTAS`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `CHAT`
--
ALTER TABLE `CHAT`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `ENVIOLISTA`
--
ALTER TABLE `ENVIOLISTA`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `JUEGOS`
--
ALTER TABLE `JUEGOS`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `LIBROCONTABLE`
--
ALTER TABLE `LIBROCONTABLE`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `LINKS`
--
ALTER TABLE `LINKS`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `LISTA`
--
ALTER TABLE `LISTA`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `PROMO`
--
ALTER TABLE `PROMO`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `REFERIDOS`
--
ALTER TABLE `REFERIDOS`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `USERPROMO`
--
ALTER TABLE `USERPROMO`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `APUESTAS`
--
ALTER TABLE `APUESTAS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `CHAT`
--
ALTER TABLE `CHAT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `ENVIOLISTA`
--
ALTER TABLE `ENVIOLISTA`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `JUEGOS`
--
ALTER TABLE `JUEGOS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT de la tabla `LIBROCONTABLE`
--
ALTER TABLE `LIBROCONTABLE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `LINKS`
--
ALTER TABLE `LINKS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `LISTA`
--
ALTER TABLE `LISTA`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=584;

--
-- AUTO_INCREMENT de la tabla `PROMO`
--
ALTER TABLE `PROMO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `REFERIDOS`
--
ALTER TABLE `REFERIDOS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `USERPROMO`
--
ALTER TABLE `USERPROMO`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
