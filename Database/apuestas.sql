-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2024 a las 19:56:11
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
-- Base de datos: `apuestas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuestas`
--

CREATE TABLE `apuestas` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `INICIO` date DEFAULT curdate(),
  `FIN` date DEFAULT curdate(),
  `TICKET` text DEFAULT NULL,
  `TIPO` varchar(35) DEFAULT NULL,
  `IDJUEGO` int(11) DEFAULT NULL,
  `JUEGO` varchar(255) DEFAULT NULL,
  `CAJERO` varchar(35) DEFAULT NULL,
  `CLIENTE` varchar(35) DEFAULT NULL,
  `PORCIENTO` int(11) DEFAULT NULL,
  `MONTO` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `INTERES_MENSUAL` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `CUOTA_MENSUAL` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `TOTAL_PAGAR` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `COMISION` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `N_PAGOS` int(11) NOT NULL DEFAULT 0,
  `PAGADOS` int(11) NOT NULL DEFAULT 0,
  `ACTIVO` int(11) NOT NULL DEFAULT 1,
  `ELIMINADO` int(11) NOT NULL DEFAULT 0,
  `ESTATUS` varchar(35) DEFAULT 'ACTIVO',
  `MONEDA` varchar(20) DEFAULT 'USDC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apuestas`
--

INSERT INTO `apuestas` (`ID`, `FECHA`, `INICIO`, `FIN`, `TICKET`, `TIPO`, `IDJUEGO`, `JUEGO`, `CAJERO`, `CLIENTE`, `PORCIENTO`, `MONTO`, `INTERES_MENSUAL`, `CUOTA_MENSUAL`, `TOTAL_PAGAR`, `COMISION`, `N_PAGOS`, `PAGADOS`, `ACTIVO`, `ELIMINADO`, `ESTATUS`, `MONEDA`) VALUES
(18, '2024-08-08 17:54:41', '2024-08-08', '2024-09-08', '875e084b25619b5b', 'MENSUAL', 2, 'Suscripción Por 4 Señales', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 0, 5.000000, 0.000000, 5.000000, 5.000000, 0.000000, 1, 0, 1, 0, 'ACTIVO', 'USDC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `IDPEDIDO` varchar(80) DEFAULT NULL,
  `AMO` varchar(34) DEFAULT NULL,
  `ENVIA` varchar(34) DEFAULT NULL,
  `RECIBE` varchar(34) DEFAULT NULL,
  `MENSAJE` text DEFAULT NULL,
  `ACTIVO` int(11) DEFAULT 0,
  `LEIDO` int(11) DEFAULT 0,
  `CERRADO` int(11) DEFAULT 0,
  `BG` varchar(34) DEFAULT '#DEEEF3',
  `FG` varchar(34) DEFAULT '#4D4D4D'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`ID`, `FECHA`, `IDPEDIDO`, `AMO`, `ENVIA`, `RECIBE`, `MENSAJE`, `ACTIVO`, `LEIDO`, `CERRADO`, `BG`, `FG`) VALUES
(1, '2024-07-23 13:23:57', '2b49dc2621a3cafd', '5', '5', '3', 'hola', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(2, '2024-07-24 13:38:25', '2b49dc2621a3cafd', '3', '3', '5', 'mandame los datos para confirmar', 0, 1, 0, '#ff7380', '#4D4D4D'),
(3, '2024-07-25 02:31:07', '2b49dc2621a3cafd', '3', '3', '5', 'espero por ti', 0, 1, 0, '#ff7380', '#4D4D4D'),
(4, '2024-07-25 02:41:25', '2b49dc2621a3cafd', '5', '5', '3', 'ok ya te los envio', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(5, '2024-07-25 20:47:17', '7fb0c04024171245', '3', '3', '5', 'ya verifico', 0, 1, 0, '#ff7380', '#4D4D4D'),
(6, '2024-08-04 02:10:07', '6ac682ad408aeaea', '5', '5', '3', 'que ha pasado con esto', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(7, '2024-08-04 02:11:06', '6ac682ad408aeaea', '3', '3', '5', 'ya procedo', 0, 1, 0, '#ff7380', '#4D4D4D'),
(8, '2024-08-04 02:34:26', '6ac682ad408aeaea', '5', '5', '3', 'estoy esperando', 0, 1, 0, '#DADFE8', '#4D4D4D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `ID` int(11) NOT NULL,
  `MONEDA` varchar(10) DEFAULT 'BTCUSDT',
  `ASSET` varchar(10) DEFAULT 'BTC',
  `PAR` varchar(10) DEFAULT 'USDC',
  `BALANCE_ASSET` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `PRECIO_VENTA` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `PANTE` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `ACTIVO` int(11) DEFAULT 0,
  `ULTIMAVENTA` decimal(16,5) NOT NULL DEFAULT 0.00000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`ID`, `MONEDA`, `ASSET`, `PAR`, `BALANCE_ASSET`, `PRECIO_VENTA`, `PANTE`, `ACTIVO`, `ULTIMAVENTA`) VALUES
(4, 'BTCUSDC', 'BTC', 'USDC', 0.00000000, 0.00000000, 0.00000000, 0, 0.00000),
(5, 'ETHUSDC', 'ETH', 'USDC', 0.00000000, 0.00000000, 0.00000000, 0, 0.00000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enviolista`
--

CREATE TABLE `enviolista` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `ENVIADO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `enviolista`
--

INSERT INTO `enviolista` (`ID`, `FECHA`, `ENVIADO`) VALUES
(1, '2024-07-23 13:37:24', 1),
(2, '2024-08-02 02:46:54', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `JUEGO` varchar(255) DEFAULT NULL,
  `DESCRIPCION` text DEFAULT NULL,
  `ANALISIS` text DEFAULT NULL,
  `CAJERO` varchar(35) DEFAULT NULL,
  `TIPO` varchar(35) DEFAULT NULL,
  `WALLET` varchar(200) DEFAULT NULL,
  `REFERENCIA` varchar(100) DEFAULT NULL,
  `PORCIENTO` int(11) DEFAULT NULL,
  `MONTO` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `COMISION` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `MIN` int(11) NOT NULL DEFAULT 10,
  `MAX` int(11) NOT NULL DEFAULT 10,
  `RATE` int(11) NOT NULL DEFAULT 0,
  `BLOQUEADO` int(11) NOT NULL DEFAULT 0,
  `VISIBLE` int(11) NOT NULL DEFAULT 0,
  `ESTATUS` varchar(34) DEFAULT 'ACTIVO',
  `PORADELANTADO` int(11) NOT NULL DEFAULT 0,
  `FAVORITO` int(11) NOT NULL DEFAULT 0,
  `ELIMINADO` int(11) NOT NULL DEFAULT 0,
  `ACTIVO` int(11) NOT NULL DEFAULT 1,
  `IMAGEN` blob DEFAULT NULL,
  `MONEDA` varchar(20) DEFAULT 'USDC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`ID`, `FECHA`, `JUEGO`, `DESCRIPCION`, `ANALISIS`, `CAJERO`, `TIPO`, `WALLET`, `REFERENCIA`, `PORCIENTO`, `MONTO`, `COMISION`, `MIN`, `MAX`, `RATE`, `BLOQUEADO`, `VISIBLE`, `ESTATUS`, `PORADELANTADO`, `FAVORITO`, `ELIMINADO`, `ACTIVO`, `IMAGEN`, `MONEDA`) VALUES
(1, '2024-07-27 22:36:31', 'Plazo Fijo Mensual', '<p><span style=\"font-weight: normal;\">Plazo Fijo Mensual el capital se Retiene y se Libera al final del plazo junto con los intereses</span></p><p>20% de interés&nbsp; Anual</p>', NULL, 'alfonsi.acosta@gmail.com', 'MENSUAL', NULL, NULL, 20, 100.000000, 0.000000, 10, 10, 3, 0, 0, 'ACTIVO', 0, 0, 0, 1, NULL, 'USDC'),
(2, '2024-07-28 01:43:17', 'Suscripción Por 4 Señales', '<p><span style=\"font-weight: normal;\">Con la compra de esta suscripción tendrás 4 señales diarias&nbsp; de la tendencia para compra y venta de</span> ADA, DOGE, ETH, BTC</p><p><i>Por tan solo<span style=\"font-size: 18px;\"> 5 Usdc</span> Mensuales&nbsp;</i></p>', '<p id=\"edit\"><p>Análisis Técnico</p><ul><li>ADA (comprar)</li><li>DOGE (Comprar)</li><li>ETH (vender)</li><li>BTC (Vender)</li></ul><p>el mercado esta mixto en promedio se debe tener en cuenta</p></p>', 'alfonsi.acosta@gmail.com', 'MENSUAL', NULL, NULL, 0, 5.000000, 0.000000, 100, 10, 4, 0, 0, 'ACTIVO', 0, 0, 0, 1, NULL, 'USDC'),
(5, '2024-07-28 02:13:00', 'Intereses por adelantado', 'Interes oor adelantado', NULL, 'alfonsi.acosta@gmail.com', 'MENSUAL', NULL, NULL, 25, 100.000000, 0.000000, 10, 10, 5, 0, 0, 'ACTIVO', 1, 1, 1, 1, NULL, 'USDC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librocontable`
--

CREATE TABLE `librocontable` (
  `ID` int(11) NOT NULL,
  `FECHA` date DEFAULT NULL,
  `TICKET` text DEFAULT NULL,
  `TIPO` varchar(35) DEFAULT 'CREDITO',
  `IDJUEGO` int(11) DEFAULT NULL,
  `JUEGO` varchar(255) DEFAULT NULL,
  `CAJERO` varchar(35) DEFAULT NULL,
  `CLIENTE` varchar(35) DEFAULT NULL,
  `MONTO` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `INTERES_MENSUAL` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `CUOTA_MENSUAL` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `TOTAL_PAGAR` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `COMISION` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `INVERSION` int(11) NOT NULL DEFAULT 0,
  `INTERES_ADELANTADO` int(11) NOT NULL DEFAULT 0,
  `PAGADO` int(11) NOT NULL DEFAULT 0,
  `ACTIVO` int(11) NOT NULL DEFAULT 1,
  `ELIMINADO` int(11) NOT NULL DEFAULT 0,
  `ESTATUS` varchar(35) DEFAULT 'ACTIVO',
  `MONEDA` varchar(4) DEFAULT 'USDC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `librocontable`
--

INSERT INTO `librocontable` (`ID`, `FECHA`, `TICKET`, `TIPO`, `IDJUEGO`, `JUEGO`, `CAJERO`, `CLIENTE`, `MONTO`, `INTERES_MENSUAL`, `CUOTA_MENSUAL`, `TOTAL_PAGAR`, `COMISION`, `INVERSION`, `INTERES_ADELANTADO`, `PAGADO`, `ACTIVO`, `ELIMINADO`, `ESTATUS`, `MONEDA`) VALUES
(26, '2024-08-08', '875e084b25619b5b', 'DEBITO', 2, 'Suscripción Por 4 Señales', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 5.000000, 0.000000, 5.000000, 5.000000, 0.000000, 0, 0, 1, 0, 0, 'CERRADO', 'USDC'),
(27, '2024-09-08', '875e084b25619b5b', 'DEBITO', 2, 'Suscripción Por 4 Señales', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 5.000000, 0.000000, 5.000000, 5.000000, 0.000000, 0, 0, 0, 1, 0, 'ACTIVO', 'USDC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `links`
--

CREATE TABLE `links` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `LINK` varchar(255) DEFAULT NULL,
  `CORREO` varchar(255) DEFAULT NULL,
  `BLOQUEADO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `links`
--

INSERT INTO `links` (`ID`, `FECHA`, `LINK`, `CORREO`, `BLOQUEADO`) VALUES
(3, '2024-08-05 17:21:01', 'ec5c77d717f9e39a', 'alfonsi.acosta@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE `lista` (
  `ID` int(11) NOT NULL,
  `CORREO` varchar(34) DEFAULT NULL,
  `ENVIADO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista`
--

INSERT INTO `lista` (`ID`, `CORREO`, `ENVIADO`) VALUES
(7, 'alfonsi.acosta@gmail.com', 0),
(8, 'alfonsi@gmail.com', 0),
(9, 'pepe@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `ID` int(11) NOT NULL,
  `IDPEDIDO` varchar(80) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `IDUSUARIO` bigint(20) DEFAULT NULL,
  `UBICACION` varchar(200) DEFAULT NULL,
  `NOTICIA` text DEFAULT NULL,
  `BG` varchar(255) DEFAULT '#FFC0CB',
  `FG` varchar(255) DEFAULT '#1A1A1A',
  `VISTO` int(11) NOT NULL DEFAULT 0,
  `BLOQUEADO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`ID`, `IDPEDIDO`, `FECHA`, `IDUSUARIO`, `UBICACION`, `NOTICIA`, `BG`, `FG`, `VISTO`, `BLOQUEADO`) VALUES
(1, '2b49dc2621a3cafd', '2024-07-23 13:23:58', 1, 'chat.php?chat=&idpedido=2b49dc2621a3cafd', 'Pedido #2b49dc2621a3cafd Tiene un Nuevo Mensaje ', '#FFC0CB', '#1A1A1A', 1, 0),
(2, '2b49dc2621a3cafd', '2024-07-25 02:31:07', 5, 'chat.php?chat=&idpedido=2b49dc2621a3cafd', 'Pedido #2b49dc2621a3cafd Tiene un Nuevo Mensaje ', '#FFC0CB', '#1A1A1A', 0, 0),
(3, '2b49dc2621a3cafd', '2024-07-25 02:41:25', 3, 'chat.php?chat=&idpedido=2b49dc2621a3cafd', 'Pedido #2b49dc2621a3cafd Tiene un Nuevo Mensaje ', '#FFC0CB', '#1A1A1A', 1, 0),
(4, '7fb0c04024171245', '2024-07-25 20:47:17', 5, 'chat.php?chat=&idpedido=7fb0c04024171245', 'Pedido #7fb0c04024171245 Tiene un Nuevo Mensaje ', '#FFC0CB', '#1A1A1A', 1, 0),
(5, '6ac682ad408aeaea', '2024-08-04 02:10:07', 3, 'chat.php?chat=&idpedido=6ac682ad408aeaea', 'Pedido #6ac682ad408aeaea Tiene un Nuevo Mensaje ', '#FFC0CB', '#1A1A1A', 1, 0),
(6, '6ac682ad408aeaea', '2024-08-04 02:11:06', 5, 'chat.php?chat=&idpedido=6ac682ad408aeaea', 'Pedido #6ac682ad408aeaea Tiene un Nuevo Mensaje ', '#FFC0CB', '#1A1A1A', 1, 0),
(7, '6ac682ad408aeaea', '2024-08-04 02:34:26', 3, 'chat.php?chat=&idpedido=6ac682ad408aeaea', 'Pedido #6ac682ad408aeaea Tiene un Nuevo Mensaje ', '#FFC0CB', '#1A1A1A', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `ID` int(11) NOT NULL,
  `CAPITAL` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `ESCALONES` int(11) DEFAULT 4,
  `INVXCOMPRA` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `DISPONIBLE` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `GANANCIA` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `PERDIDA` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `IMPUESTO` decimal(16,8) NOT NULL DEFAULT 0.02000000,
  `LOCAL` int(11) DEFAULT 1,
  `BINANCE` int(11) DEFAULT 0,
  `APIKEY` varchar(255) DEFAULT NULL,
  `SECRET` varchar(255) DEFAULT NULL,
  `PUNTOS` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `DATOS` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`DATOS`)),
  `GRAFICO` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`ID`, `CAPITAL`, `ESCALONES`, `INVXCOMPRA`, `DISPONIBLE`, `GANANCIA`, `PERDIDA`, `IMPUESTO`, `LOCAL`, `BINANCE`, `APIKEY`, `SECRET`, `PUNTOS`, `DATOS`, `GRAFICO`) VALUES
(1, 0.00000000, 1, 0.00000000, 0.00000000, 0.00000000, 0.00000000, 0.02000000, 1, 0, 'iwmGI5RxUzQrnVgVQsnGuiif2PfGvx5cXuuT9wYJ8nZFUqrrhXBTLv9WQHezUd3v', '22ifWVZjo9qiDqF14hWA56IAbLPjtavlGxHYrN9It0VI5fCFcHxsIwxwxi0GvG9N', 0.00000000, '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"0.00000000\",\"btc\":\"0.00000000\",\"colorbtc\":\"#4BC883\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#4BC883\",\"maxdia\":\"0.00000000\",\"mindia\":\"0.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"5:10 AM\",\"techo\":\"0.000000000000\",\"piso\":\"0.000000000000\",\"ant\":\"0.00000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"0%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":0,\"xdisponible\":0,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"recordCount\":null,\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"0.00\",\"labelpricemoneda\":\"0.00000000\",\"precio_venta\":\"0.00000000\",\"listasset\":\"<table style=text-align:right;><td><span style=cursor:pointer;color:#4BC883;>BTC</span></td><td><span style=color:#4BC883;font-weight:bold;>0.00000000</span></td><td><span class=bolita style=color:green;>&#9679;</span></td></table>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#089981;--data1:80deg;--color2:#089981;--data2:220deg;--color3:#089981;--data3:360deg;--color4:#F23645;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prices`
--

CREATE TABLE `prices` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `MONEDA` varchar(10) DEFAULT 'BTCUSDT',
  `DATOS` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`DATOS`)),
  `ACTUAL` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `ARRIBA` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `ABAJO` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `BAJISTA` int(11) DEFAULT 0,
  `ALCISTA` int(11) DEFAULT 0,
  `VERDE` int(11) DEFAULT 0,
  `NARANJA` int(11) DEFAULT 0,
  `ROJO` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prices`
--

INSERT INTO `prices` (`ID`, `FECHA`, `MONEDA`, `DATOS`, `ACTUAL`, `ARRIBA`, `ABAJO`, `BAJISTA`, `ALCISTA`, `VERDE`, `NARANJA`, `ROJO`) VALUES
(3, '2024-08-08 14:31:48', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59586.01000000\",\"btc\":\"59586.01000000\",\"colorbtc\":\"#4BC883\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59662.00000000\",\"mindia\":\"58734.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"1:54 PM\",\"techo\":\"59662.000000000000\",\"piso\":\"58734.000000000000\",\"ant\":\"59662.00000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"92%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":59198,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59586.01000000\",\"labelpricemoneda\":\"59586.01\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59586.01</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2584.31</span> <span class=bolita style=color:red;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#089981;--data1:-80deg;--color2:#089981;--data2:-220deg;--color3:#089981;--data3:-360deg;--color4:#F23645;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 59586.01000000, 59662.00000000, 58734.00000000, 1, 0, 0, 0, 0),
(4, '2024-08-08 14:31:49', 'BTCUSDT', NULL, 0.00000000, 0.00000000, 0.00000000, 0, 0, 0, 0, 0),
(5, '2024-08-08 17:09:27', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2583.40000000\",\"btc\":\"59586.01000000\",\"colorbtc\":\"#4BC883\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2589.20000000\",\"mindia\":\"2579.84000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"1:54 PM\",\"techo\":\"2589.200000000000\",\"piso\":\"2579.840000000000\",\"ant\":\"2589.20000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"38%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2584.52,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59586.01000000\",\"labelpricemoneda\":\"2583.40\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59586.01</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2583.40</span> <span class=bolita style=color:red;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#089981;--data1:-80deg;--color2:#089981;--data2:-220deg;--color3:#089981;--data3:-360deg;--color4:#F23645;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2583.40000000, 2589.20000000, 2579.84000000, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promo`
--

CREATE TABLE `promo` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `CODIGO` text DEFAULT NULL,
  `NOMBRE` varchar(34) DEFAULT NULL,
  `MENSAJE` text DEFAULT NULL,
  `COLORBG` varchar(34) DEFAULT NULL,
  `COLORFG` varchar(34) DEFAULT NULL,
  `BORDER` varchar(34) DEFAULT NULL,
  `NUMPROMO` int(11) NOT NULL DEFAULT 0,
  `PREMIO` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `VISIBLE` int(11) NOT NULL DEFAULT 0,
  `GANADOR` int(11) NOT NULL DEFAULT 0,
  `DIFUSION` int(11) NOT NULL DEFAULT 0,
  `FLOTANTE` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promo`
--

INSERT INTO `promo` (`ID`, `FECHA`, `CODIGO`, `NOMBRE`, `MENSAJE`, `COLORBG`, `COLORFG`, `BORDER`, `NUMPROMO`, `PREMIO`, `VISIBLE`, `GANADOR`, `DIFUSION`, `FLOTANTE`) VALUES
(4, '2024-08-02 02:53:22', 'e22f39d28c90bc87', 'Bienvenidos', '<p>Aquí tendrás en tu tienda nuevas oportunidades de poner a trabajar tu dinero y recibir información </p><p>con toda seguridad y seriedad&nbsp;</p>', NULL, NULL, NULL, 0, 0.0000, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referidos`
--

CREATE TABLE `referidos` (
  `ID` int(11) NOT NULL,
  `REFERIDO` varchar(34) DEFAULT NULL,
  `REFERENTE` varchar(34) DEFAULT NULL,
  `VALIDO` int(11) NOT NULL DEFAULT 0,
  `RETIRADO` int(11) NOT NULL DEFAULT 0,
  `LOGROS` int(11) NOT NULL DEFAULT 0,
  `RECOMPENSA` decimal(13,2) UNSIGNED NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `TICKET` text DEFAULT NULL,
  `TIPO` varchar(35) DEFAULT 'DEPOSITO',
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  `CAJERO` varchar(35) DEFAULT NULL,
  `CLIENTE` varchar(35) DEFAULT NULL,
  `MEDIO_PAGO` varchar(35) DEFAULT 'BINANCE PAY',
  `WALLET` varchar(255) DEFAULT NULL,
  `ORIGEN` varchar(255) NOT NULL,
  `DESTINO` varchar(255) NOT NULL,
  `NOTAID` varchar(255) DEFAULT NULL,
  `RESULTADO` varchar(255) DEFAULT NULL,
  `REFERENCIA` varchar(255) DEFAULT NULL,
  `MONTO` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `RECIBE` decimal(16,6) NOT NULL DEFAULT 0.000000,
  `COMISION` decimal(13,6) NOT NULL DEFAULT 0.000000,
  `PAGADO` int(11) NOT NULL DEFAULT 0,
  `ENVIADO` int(11) NOT NULL DEFAULT 0,
  `ELIMINADO` int(11) NOT NULL DEFAULT 0,
  `TOMADO` int(11) NOT NULL DEFAULT 0,
  `RATE` int(11) NOT NULL DEFAULT 0,
  `CALIFICADO` int(11) NOT NULL DEFAULT 0,
  `ESTATUS` varchar(35) DEFAULT 'REVISION',
  `MONEDA` varchar(20) DEFAULT 'USDC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`ID`, `FECHA`, `TICKET`, `TIPO`, `DESCRIPCION`, `CAJERO`, `CLIENTE`, `MEDIO_PAGO`, `WALLET`, `ORIGEN`, `DESTINO`, `NOTAID`, `RESULTADO`, `REFERENCIA`, `MONTO`, `RECIBE`, `COMISION`, `PAGADO`, `ENVIADO`, `ELIMINADO`, `TOMADO`, `RATE`, `CALIFICADO`, `ESTATUS`, `MONEDA`) VALUES
(15, '2024-08-06 20:42:58', '80de63da8146e402', 'DEPOSITO', 'Deposito Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, 'alfonsi.acosta@gmail.com', '834916814', NULL, NULL, NULL, 10.000000, 10.000000, 0.000000, 0, 0, 0, 0, 3, 1, 'REVISION', 'USDC'),
(16, '2024-08-06 20:46:46', 'fd8e0f75bdb9e3a2', 'RETIRO', 'Retiro Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, '834916814', 'alfonsi.acosta@gmail.com', NULL, NULL, NULL, 40.000000, 38.800000, 0.000000, 0, 0, 0, 0, 1, 1, 'REVISION', 'USDC'),
(17, '2024-08-07 01:50:21', '0f06d6dd7d081328', 'DEPOSITO', 'Deposito Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, 'alfonsi.acosta@gmail.com', '834916814', NULL, NULL, NULL, 2.000000, 2.000000, 0.000000, 0, 0, 0, 0, 0, 0, 'REVISION', 'USDC'),
(18, '2024-08-07 01:50:49', '8471b7201cb9c439', 'RETIRO', 'Retiro Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, '834916814', 'alfonsi.acosta@gmail.com', NULL, NULL, NULL, 5.000000, 4.850000, 0.000000, 0, 0, 0, 0, 0, 0, 'REVISION', 'USDC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userpromo`
--

CREATE TABLE `userpromo` (
  `ID` int(11) NOT NULL,
  `CODIGO` text DEFAULT NULL,
  `CORREO` varchar(34) DEFAULT NULL,
  `RATE` int(11) NOT NULL DEFAULT 0,
  `NUMREF` int(11) NOT NULL DEFAULT 0,
  `NUMPROMO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `IP` varchar(255) DEFAULT NULL,
  `NOMBRE_USUARIO` varchar(34) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `VKEY` varchar(100) DEFAULT NULL,
  `CORREO` varchar(34) DEFAULT NULL,
  `TELEFONO` varchar(15) DEFAULT NULL,
  `NOMBRE` varchar(255) DEFAULT NULL,
  `NACIONALIDAD` varchar(34) DEFAULT NULL,
  `LINKREFERIDO` varchar(255) DEFAULT NULL,
  `CODIGOREFERIDO` varchar(255) DEFAULT NULL,
  `BEP20` varchar(255) DEFAULT NULL,
  `BINANCE` varchar(255) DEFAULT NULL,
  `RATE` int(11) NOT NULL DEFAULT 0,
  `SALDO` decimal(13,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `USDT` decimal(13,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `P2P` decimal(13,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `SALDOREFERIDO` decimal(13,4) UNSIGNED NOT NULL DEFAULT 0.0000,
  `VERIFICADO` int(11) NOT NULL DEFAULT 0,
  `ACTIVO` int(11) NOT NULL DEFAULT 0,
  `LABORANDO` int(11) NOT NULL DEFAULT 0,
  `BLOQUEADO` int(11) NOT NULL DEFAULT 0,
  `NIVEL` int(11) NOT NULL DEFAULT 0,
  `ACTIVE_BEP20` int(11) NOT NULL DEFAULT 0,
  `ACTIVE_BINANCE` int(11) NOT NULL DEFAULT 0,
  `QR_BEP20` varchar(255) NOT NULL DEFAULT 'perfil.jpg',
  `QR_BINANCE` varchar(255) NOT NULL DEFAULT 'perfil.jpg',
  `PERFIL` varchar(255) DEFAULT 'perfil.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `FECHA`, `IP`, `NOMBRE_USUARIO`, `PASSWORD`, `VKEY`, `CORREO`, `TELEFONO`, `NOMBRE`, `NACIONALIDAD`, `LINKREFERIDO`, `CODIGOREFERIDO`, `BEP20`, `BINANCE`, `RATE`, `SALDO`, `USDT`, `P2P`, `SALDOREFERIDO`, `VERIFICADO`, `ACTIVO`, `LABORANDO`, `BLOQUEADO`, `NIVEL`, `ACTIVE_BEP20`, `ACTIVE_BINANCE`, `QR_BEP20`, `QR_BINANCE`, `PERFIL`) VALUES
(3, '2024-07-18 15:12:20', '::1', 'Didapax', '$2y$10$iz6Cyr2pj9.g0gz9Yh5N6Oit2MXAT8PMYnM5hksLMPDkItBSWRLei', '88c99461e5d51625', 'alfonsi.acosta@gmail.com', NULL, 'alfonsi.acosta@gmail.com', NULL, NULL, '1092e38b3bfe123b', '0x9Ad41AAeaDcc2A9A3285dC82DbF95C0CEaD09718', '834916814', 2, 6.6300, 0.0000, 0.0000, 0.0000, 1, 1, 1, 0, 1, 1, 1, '0e51ba406d.png', 'fbe1223b2f.png', '2812b740cd.png'),
(4, '2024-07-18 23:01:27', '::1', NULL, '$2y$10$nlwRdUti0f6KfGHlFxxPxO5Wss8ekUOpUYLBCMCfQVmcqx7e2vH1q', '9776e14db528aa0d', 'alfonsi@gmail.com', NULL, 'alfonsi@gmail.com', NULL, NULL, 'f57dc7a0254af0bc', NULL, NULL, 0, 0.0000, 0.0000, 0.0000, 0.0000, 0, 0, 0, 0, 0, 0, 0, 'perfil.jpg', 'perfil.jpg', 'perfil.jpg'),
(5, '2024-07-18 23:12:17', '::1', NULL, '$2y$10$qqzuKPChM4NXdlsWJ.eFb.pjKYD/UwPKAi.XkY6f63znTdPC/2m.S', '504c0d2e6db8a604', 'pepe@gmail.com', NULL, 'pepe@gmail.com', NULL, NULL, '6d0433aef2547f52', NULL, 'alfonsi.acosta@gmail.com', 0, 265.0000, 0.0000, 0.0000, 0.0000, 1, 1, 0, 0, 0, 0, 0, 'perfil.jpg', 'perfil.jpg', 'perfil.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `enviolista`
--
ALTER TABLE `enviolista`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `librocontable`
--
ALTER TABLE `librocontable`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `referidos`
--
ALTER TABLE `referidos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `userpromo`
--
ALTER TABLE `userpromo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `enviolista`
--
ALTER TABLE `enviolista`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `librocontable`
--
ALTER TABLE `librocontable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `links`
--
ALTER TABLE `links`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prices`
--
ALTER TABLE `prices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `promo`
--
ALTER TABLE `promo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `referidos`
--
ALTER TABLE `referidos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `userpromo`
--
ALTER TABLE `userpromo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;