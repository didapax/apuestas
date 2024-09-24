-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2024 a las 22:35:01
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
  `IDJUEGO` int(11) DEFAULT NULL,
  `TICKET` text DEFAULT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp(),
  `INICIO` date DEFAULT curdate(),
  `FIN` date DEFAULT curdate(),
  `TIPO` varchar(35) DEFAULT NULL,
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
  `DEVUELVE_CAPITAL` int(11) NOT NULL DEFAULT 0,
  `ELIMINADO` int(11) NOT NULL DEFAULT 0,
  `ESTATUS` varchar(35) DEFAULT 'ACTIVO',
  `IMAGEN` varchar(255) NOT NULL DEFAULT 'azul.png',
  `FOREGROUND` varchar(34) NOT NULL DEFAULT 'white',
  `MONEDA` varchar(20) DEFAULT 'USDC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apuestas`
--

INSERT INTO `apuestas` (`ID`, `IDJUEGO`, `TICKET`, `FECHA`, `INICIO`, `FIN`, `TIPO`, `JUEGO`, `CAJERO`, `CLIENTE`, `PORCIENTO`, `MONTO`, `INTERES_MENSUAL`, `CUOTA_MENSUAL`, `TOTAL_PAGAR`, `COMISION`, `N_PAGOS`, `PAGADOS`, `ACTIVO`, `DEVUELVE_CAPITAL`, `ELIMINADO`, `ESTATUS`, `IMAGEN`, `FOREGROUND`, `MONEDA`) VALUES
(31, 2, '00e4fc5cb609ec01', '2024-09-08 21:15:13', '2024-09-08', '2024-12-08', 'TRIMESTRAL', 'Suscripción Por 4 Señales', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 0, 5.000000, 0.000000, 1.666667, 5.000000, 0.000000, 3, 0, 1, 0, 0, 'ACTIVO', 'azul.png', 'white', 'USDC'),
(32, 8, '9595bc21231d4d74', '2024-09-08 21:16:53', '2024-09-08', '2024-12-08', 'TRIMESTRAL', 'ESTADISTICAS CRIPTOSIGNAL', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 0, 0.000000, 0.000000, 0.000000, 0.000000, 0.000000, 3, 0, 1, 0, 0, 'ACTIVO', 'amarillo.png', 'white', 'USDC'),
(33, 8, 'c3d6115044a4b757', '2024-09-24 20:00:07', '2024-09-24', '2024-12-24', 'TRIMESTRAL', 'ESTADISTICAS CRIPTOSIGNAL', 'alfonsi.acosta@gmail.com', 'alfonsi.acosta@gmail.com', 0, 0.000000, 0.000000, 0.000000, 0.000000, 0.000000, 3, 0, 1, 0, 0, 'ACTIVO', 'amarillo.png', 'white', 'USDC');

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
(8, '2024-08-04 02:34:26', '6ac682ad408aeaea', '5', '5', '3', 'estoy esperando', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(9, '2024-08-28 15:45:39', 'fd8e0f75bdb9e3a2', '5', '5', '3', 'HOLA', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(15, '2024-08-28 21:51:47', 'fd8e0f75bdb9e3a2', '3', '3', '5', 'estoy en linea', 1, 1, 0, '#ff7380', '#4D4D4D'),
(16, '2024-08-28 21:52:16', 'fd8e0f75bdb9e3a2', '5', '5', '3', 'ok gracias', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(17, '2024-08-30 02:48:09', 'fd8e0f75bdb9e3a2', '5', '5', '3', 'saludos el numero de confirmacion es el 1412541 y me dice que ya esta listo lleva 16 confirmaciones usted podria verificar lo mas pronto posible por favor', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(18, '2024-08-30 03:17:45', 'fd8e0f75bdb9e3a2', '3', '3', '5', 'OK', 1, 1, 0, '#ff7380', '#4D4D4D'),
(19, '2024-09-01 02:21:11', 'fd8e0f75bdb9e3a2', '5', '5', '3', 'hola', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(20, '2024-09-01 19:35:17', 'fd8e0f75bdb9e3a2', '5', '5', '3', 'epaleee', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(21, '2024-09-01 22:43:03', 'fd8e0f75bdb9e3a2', '5', '5', '3', 'puede leerme esta activo??', 0, 1, 0, '#DADFE8', '#4D4D4D'),
(22, '2024-09-01 22:44:12', 'fd8e0f75bdb9e3a2', '3', '3', '5', 'si exacto', 1, 1, 0, '#ff7380', '#4D4D4D');

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
  `DEVUELVE_CAPITAL` int(11) NOT NULL DEFAULT 0,
  `IMAGEN` varchar(255) DEFAULT 'azul.png',
  `FOREGROUND` varchar(34) NOT NULL DEFAULT 'white',
  `MONEDA` varchar(20) DEFAULT 'USDC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`ID`, `FECHA`, `JUEGO`, `DESCRIPCION`, `ANALISIS`, `CAJERO`, `TIPO`, `WALLET`, `REFERENCIA`, `PORCIENTO`, `MONTO`, `COMISION`, `MIN`, `MAX`, `RATE`, `BLOQUEADO`, `VISIBLE`, `ESTATUS`, `PORADELANTADO`, `FAVORITO`, `ELIMINADO`, `ACTIVO`, `DEVUELVE_CAPITAL`, `IMAGEN`, `FOREGROUND`, `MONEDA`) VALUES
(1, '2024-07-27 22:36:31', 'Plazo Fijo Mensual', 'Plazo Fijo Mensual el capital se Retiene y se Libera al final del plazo junto con los intereses 20% de interés&nbsp; Anual', NULL, 'alfonsi.acosta@gmail.com', 'MENSUAL', NULL, NULL, 20, 100.000000, 0.000000, 10, 10, 3, 0, 0, 'ACTIVO', 0, 0, 0, 1, 1, 'azul.png', 'white', 'USDC'),
(2, '2024-07-28 01:43:17', 'Suscripción Por 4 Señales', 'Con la compra de esta suscripción tendrás 4 señales diarias&nbsp; de la tendencia para compra y venta de ADA, DOGE, ETH, BTC<p>Por tan solo 5 Usdc Mensuales&nbsp;', 'ASDSADSUODHASUDUSAD  JASHDJS ', 'alfonsi.acosta@gmail.com', 'TRIMESTRAL', NULL, NULL, 0, 5.000000, 0.000000, 100, 10, 4, 0, 0, 'ACTIVO', 0, 0, 0, 1, 0, 'azul.png', 'white', 'USDC'),
(5, '2024-07-28 02:13:00', 'Intereses por adelantado', 'Interes oor adelantado', NULL, 'alfonsi.acosta@gmail.com', 'MENSUAL', NULL, NULL, 25, 100.000000, 0.000000, 10, 10, 5, 0, 0, 'ACTIVO', 0, 1, 0, 1, 0, 'azul.png', 'white', 'USDC'),
(6, '2024-08-10 01:37:45', '190% RENTABILIDAD ANUAL INVERSIÓN 20$', 'OBTIENES EN&nbsp; EL AÑO UN TOTAL DE 38$ UTILIDAD Y UN PORCENTAJE DEL CAPITAL INVERTIDO DISPONIBLE MENSUAL 3.16$', NULL, 'alfonsi.acosta@gmail.com', 'ANUAL', NULL, NULL, 190, 20.000000, 0.000000, 10, 10, 2, 0, 0, 'ACTIVO', 0, 0, 0, 1, 0, 'azul.png', 'white', 'USDC'),
(7, '2024-08-12 02:13:30', 'Prueba', 'fssdgdfgdfg', NULL, 'alfonsi.acosta@gmail.com', 'MENSUAL', NULL, NULL, 0, 5.000000, 0.000000, 10, 10, 1, 0, 0, 'ACTIVO', 0, 0, 0, 1, 0, 'amarillo.png', 'black', 'USDC'),
(8, '2024-09-03 02:13:28', 'ESTADISTICAS CRIPTOSIGNAL', 'Total de Usuarios: __TOTALUSUARIOS__<br>\r\nCantidad Depositos: __DEPOSITOS__<br>\r\ncantidad Retiros: __RETIROS__\r\n', 'dfddghg', 'alfonsi.acosta@gmail.com', 'TRIMESTRAL', NULL, NULL, 0, 0.000000, 0.000000, 2, 10, 1, 0, 0, 'ACTIVO', 0, 1, 0, 1, 0, 'amarillo.png', 'white', 'USDC'),
(9, '2024-09-08 21:18:02', 'SUSCRIPCION NEFLIX', 'OBTEN POR LA COMPRA DE ESTA TARJETA UNA CUENTA DE NEFLIX', 'LJSADNAFSDJN LJDHCJLDH LJKDNCJLD ', 'alfonsi.acosta@gmail.com', 'TRIMESTRAL', NULL, NULL, 0, 15.000000, 0.000000, 10, 10, 1, 0, 0, 'ACTIVO', 0, 0, 0, 1, 0, 'azul_oscuro.png', 'red', 'USDC');

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
  `DEVUELVE_CAPITAL` int(11) NOT NULL DEFAULT 0,
  `ELIMINADO` int(11) NOT NULL DEFAULT 0,
  `ESTATUS` varchar(35) DEFAULT 'ACTIVO',
  `MONEDA` varchar(4) DEFAULT 'USDC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `librocontable`
--

INSERT INTO `librocontable` (`ID`, `FECHA`, `TICKET`, `TIPO`, `IDJUEGO`, `JUEGO`, `CAJERO`, `CLIENTE`, `MONTO`, `INTERES_MENSUAL`, `CUOTA_MENSUAL`, `TOTAL_PAGAR`, `COMISION`, `INVERSION`, `INTERES_ADELANTADO`, `PAGADO`, `ACTIVO`, `DEVUELVE_CAPITAL`, `ELIMINADO`, `ESTATUS`, `MONEDA`) VALUES
(72, '2024-09-08', '00e4fc5cb609ec01', 'DEBITO', 2, 'Suscripción Por 4 Señales', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 5.000000, 0.000000, 1.666667, 5.000000, 0.000000, 0, 0, 1, 0, 0, 0, 'CERRADO', 'USDC'),
(73, '2024-12-08', '00e4fc5cb609ec01', 'DEBITO', 2, 'Suscripción Por 4 Señales', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 5.000000, 0.000000, 1.666667, 5.000000, 0.000000, 0, 0, 0, 1, 0, 0, 'ACTIVO', 'USDC'),
(74, '2024-09-08', '9595bc21231d4d74', 'DEBITO', 8, 'ESTADISTICAS CRIPTOSIGNAL', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 0.000000, 0.000000, 0.000000, 0.000000, 0.000000, 0, 0, 1, 0, 0, 0, 'CERRADO', 'USDC'),
(75, '2024-12-08', '9595bc21231d4d74', 'DEBITO', 8, 'ESTADISTICAS CRIPTOSIGNAL', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 0.000000, 0.000000, 0.000000, 0.000000, 0.000000, 0, 0, 0, 1, 0, 0, 'ACTIVO', 'USDC'),
(76, '2024-09-24', 'c3d6115044a4b757', 'DEBITO', 8, 'ESTADISTICAS CRIPTOSIGNAL', 'alfonsi.acosta@gmail.com', 'alfonsi.acosta@gmail.com', 0.000000, 0.000000, 0.000000, 0.000000, 0.000000, 0, 0, 1, 0, 0, 0, 'CERRADO', 'USDC'),
(77, '2024-12-24', 'c3d6115044a4b757', 'DEBITO', 8, 'ESTADISTICAS CRIPTOSIGNAL', 'alfonsi.acosta@gmail.com', 'alfonsi.acosta@gmail.com', 0.000000, 0.000000, 0.000000, 0.000000, 0.000000, 0, 0, 0, 1, 0, 0, 'ACTIVO', 'USDC');

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
  `SUBJET` varchar(250) NOT NULL,
  `BODY` text NOT NULL,
  `ENVIADO` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista`
--

INSERT INTO `lista` (`ID`, `CORREO`, `SUBJET`, `BODY`, `ENVIADO`) VALUES
(12, 'pepe@gmail.com', 'Analisis ESTADISTICAS CRIPTOSIGNAL', 'dfddghg', 0),
(13, 'alfonsi.acosta@gmail.com', 'Analisis ESTADISTICAS CRIPTOSIGNAL', 'dfddghg', 0);

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
(18, 'fd8e0f75bdb9e3a2', '2024-09-01 22:44:12', 5, 'chat.php?chat=&idpedido=fd8e0f75bdb9e3a2', 'Pedido #fd8e0f75bdb9e3a2 Tiene un Nuevo Mensaje ', '#FFC0CB', '#1A1A1A', 1, 0);

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
  `FECHA` date DEFAULT curdate(),
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
(3, '2024-08-08', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 59620.00000000, 59678.31000000, 58734.00000000, 1, 0, 0, 0, 0),
(5, '2024-08-08', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2577.22000000, 2589.20000000, 2577.22000000, 1, 0, 0, 0, 0),
(6, '2024-08-09', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 60534.01000000, 60728.00000000, 60534.01000000, 0, 1, 0, 0, 0),
(8, '2024-08-09', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2602.21000000, 2610.39000000, 2602.21000000, 0, 1, 0, 0, 0),
(9, '2024-08-10', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 61053.52000000, 61072.65000000, 60619.64000000, 0, 1, 0, 0, 0),
(11, '2024-08-10', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2627.01000000, 2631.80000000, 2601.60000000, 0, 1, 0, 0, 0),
(12, '2024-08-11', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 58648.00000000, 60512.29000000, 58397.97000000, 1, 0, 0, 0, 0),
(14, '2024-08-11', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2548.35000000, 2638.11000000, 2537.51000000, 0, 1, 0, 0, 0),
(15, '2024-08-18', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 58624.01000000, 58642.06000000, 58624.01000000, 1, 0, 0, 0, 0),
(17, '2024-08-18', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2637.00000000, 2637.14000000, 2637.00000000, 1, 0, 0, 0, 0),
(18, '2024-08-19', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 59249.64000000, 59249.64000000, 59249.64000000, 0, 1, 0, 0, 0),
(20, '2024-08-19', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2622.00000000, 2622.00000000, 2622.00000000, 1, 0, 0, 0, 0),
(21, '2024-08-20', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 58998.01000000, 59622.01000000, 58923.29000000, 0, 1, 0, 0, 0),
(23, '2024-08-20', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2575.17000000, 2606.65000000, 2574.40000000, 1, 0, 0, 0, 0),
(24, '2024-08-22', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 60647.64000000, 60892.00000000, 60647.64000000, 1, 0, 0, 0, 0),
(26, '2024-08-22', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2638.38000000, 2638.82000000, 2615.40000000, 1, 0, 0, 0, 0),
(27, '2024-08-23', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 60978.00000000, 61630.02000000, 60934.00000000, 0, 1, 0, 0, 0),
(29, '2024-08-23', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2646.60000000, 2677.13000000, 2644.73000000, 0, 1, 0, 0, 0),
(35, '2024-08-24', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 64202.84000000, 64202.84000000, 64182.00000000, 0, 1, 0, 0, 0),
(36, '2024-08-24', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2759.80000000, 2759.80000000, 2757.96000000, 0, 1, 0, 0, 0),
(37, '2024-08-27', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 59157.99000000, 62068.98000000, 59157.99000000, 1, 0, 0, 0, 0),
(38, '2024-08-27', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2438.75000000, 2602.74000000, 2438.75000000, 1, 0, 0, 0, 0),
(39, '2024-08-28', 'BTCUSDC', '{\"asset\":\"BTC\",\"ultimaventa\":\"0.00000\",\"price\":\"59005.99000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:0deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"BTCUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"59436.61000000\",\"mindia\":\"58770.00000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"60644.617500000000\",\"piso\":\"59897.849166666667\",\"ant\":\"62068.98000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"35%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":60271.23333333334,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"59005.99\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.86</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:80deg;--color2:#F6465D;--data2:220deg;--color3:#F6465D;--data3:360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 59005.99000000, 59436.61000000, 58770.00000000, 1, 0, 0, 0, 0),
(40, '2024-08-28', 'ETHUSDC', '{\"asset\":\"ETH\",\"ultimaventa\":\"0.00000\",\"price\":\"2521.09000000\",\"btc\":\"59005.99000000\",\"colorbtc\":\"#F37A8B\",\"symbol\":\"<div class=odometros style=--data:360deg;><div id=grad2>BUY</div></div>\",\"moneda\":\"ETHUSDC\",\"tendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"color\":\"#F37A8B\",\"maxdia\":\"2545.20000000\",\"mindia\":\"2488.18000000\",\"totalTendencia\":\"<span style=color:#EA465C;font-weight:bold;>&#9660;</span>\",\"utc\":\"6:19 PM\",\"techo\":\"2629.915000000000\",\"piso\":\"2591.413333333333\",\"ant\":\"2602.74000000\",\"nivel\":\"<div class=odometros style=--data:0deg;><div id=grad2>SELL</div></div>\",\"nivelbtc\":\"<div class=odometros style=--data:0deg;><div id=grad2>BTC</div></div>\",\"porcenmax\":\"58%\",\"ganancia\":\"0.00000000\",\"perdida\":\"0.00000000\",\"capital\":\"0.00000000\",\"disponible\":\"0.00000000\",\"escalones\":\"1\",\"invxcompra\":\"0.00000000\",\"totalpromedio\":2610.6641666666665,\"auto\":\"1\",\"bina\":\"0\",\"impuesto\":\"0.02000000\",\"colordisp\":\"#4BC883\",\"labelpricebitcoin\":\"59005.99\",\"labelpricemoneda\":\"2521.09\",\"precio_venta\":\"0.00000000\",\"listasset\":\" <span style=cursor:pointer;color:#F37A8B;>BTC</span> <span style=color:#F37A8B;font-weight:bold;>59005.99</span> <span class=bolita style=color:red;>&#9679;</span> <span style=cursor:pointer;color:#F37A8B;>ETH</span> <span style=color:#F37A8B;font-weight:bold;>2521.09</span> <span class=bolita style=color:green;>&#9679;</span>\",\"nivelcompra\":\"<div class=odometroalert style=--color1:#F6465D;--data1:-80deg;--color2:#F6465D;--data2:-220deg;--color3:#F6465D;--data3:-360deg;--color4:#85929e;--data4:-360deg;><div id=grad2>BUY</div></div>\"}', 2521.09000000, 2545.20000000, 2488.18000000, 1, 0, 0, 0, 0);

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
(15, '2024-08-06 20:42:58', '80de63da8146e402', 'DEPOSITO', 'Deposito Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, 'alfonsi.acosta@gmail.com', '834916814', NULL, NULL, NULL, 10.000000, 10.000000, 0.000000, 1, 0, 0, 0, 3, 1, 'EXITOSO', 'USDC'),
(16, '2024-08-06 20:46:46', 'fd8e0f75bdb9e3a2', 'RETIRO', 'Retiro Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, '834916814', 'alfonsi.acosta@gmail.com', NULL, NULL, NULL, 40.000000, 38.800000, 0.000000, 0, 0, 0, 0, 1, 1, 'REVISION', 'USDC'),
(17, '2024-08-07 01:50:21', '0f06d6dd7d081328', 'DEPOSITO', 'Deposito Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, 'alfonsi.acosta@gmail.com', '834916814', NULL, NULL, NULL, 2.000000, 2.000000, 0.000000, 0, 0, 0, 0, 4, 1, 'REVISION', 'USDC'),
(18, '2024-08-07 01:50:49', '8471b7201cb9c439', 'RETIRO', 'Retiro Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, '834916814', 'alfonsi.acosta@gmail.com', NULL, NULL, NULL, 5.000000, 4.850000, 0.000000, 0, 0, 0, 0, 3, 1, 'REVISION', 'USDC'),
(19, '2024-09-01 02:21:48', '52f148d3463f74a4', 'DEPOSITO', 'Deposito Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, 'alfonsi.acosta@gmail.com', '834916814', NULL, NULL, NULL, 11.000000, 11.000000, 0.000000, 0, 0, 0, 0, 0, 0, 'REVISION', 'USDC'),
(20, '2024-09-06 15:10:18', '3b1de0d5af44ff30', 'DEPOSITO', 'Deposito Binance Pay', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 'BINANCE', NULL, 'alfonsi.acosta@gmail.com', '834916814', NULL, NULL, NULL, 10.000000, 10.000000, 0.000000, 0, 0, 0, 0, 0, 0, 'REVISION', 'USDT');

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
(3, '2024-07-18 15:12:20', '::1', 'cajero Didapax', '$2y$10$iz6Cyr2pj9.g0gz9Yh5N6Oit2MXAT8PMYnM5hksLMPDkItBSWRLei', '88c99461e5d51625', 'alfonsi.acosta@gmail.com', NULL, 'alfonsi.acosta@gmail.com', NULL, NULL, '1092e38b3bfe123b', '0x9Ad41AAeaDcc2A9A3285dC82DbF95C0CEaD09718', '834916814', 3, 1.6300, 0.0000, 0.0000, 0.0000, 1, 1, 1, 0, 1, 1, 1, '0e51ba406d.png', 'fbe1223b2f.png', '2812b740cd.png'),
(4, '2024-07-18 23:01:27', '::1', NULL, '$2y$10$nlwRdUti0f6KfGHlFxxPxO5Wss8ekUOpUYLBCMCfQVmcqx7e2vH1q', '9776e14db528aa0d', 'alfonsi@gmail.com', NULL, 'alfonsi@gmail.com', NULL, NULL, 'f57dc7a0254af0bc', NULL, NULL, 0, 0.0000, 0.0000, 0.0000, 0.0000, 0, 0, 0, 0, 0, 0, 0, 'perfil.jpg', 'perfil.jpg', 'perfil.jpg'),
(5, '2024-07-18 23:12:17', '::1', 'didapax', '$2y$10$qqzuKPChM4NXdlsWJ.eFb.pjKYD/UwPKAi.XkY6f63znTdPC/2m.S', '504c0d2e6db8a604', 'pepe@gmail.com', NULL, 'pepe@gmail.com', NULL, NULL, '6d0433aef2547f52', '0x9Ad41AAeaDcc2A9A3285dC82DbF95C0CEaD09718', 'alfonsi.acosta@gmail.com', 0, 90.0000, 0.0000, 0.0000, 0.0000, 1, 1, 0, 0, 0, 0, 0, 'perfil.jpg', 'perfil.jpg', 'perfil.jpg'),
(6, '2024-09-01 02:51:37', '::1', NULL, '$2y$10$uBr4lJDfDHIU8ZOFiwxtjuTMbI66qrVhWL7b19YidAcNL5tNd3fqO', '71a7d4185733d080', 'juan@gmail.com', NULL, 'juan@gmail.com', NULL, NULL, 'd8b11defda24f8ea', NULL, 'juan@gmail.com', 0, 0.0000, 0.0000, 0.0000, 0.0000, 1, 0, 0, 0, 0, 0, 0, 'perfil.jpg', 'perfil.jpg', 'perfil.jpg');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `librocontable`
--
ALTER TABLE `librocontable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `links`
--
ALTER TABLE `links`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prices`
--
ALTER TABLE `prices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `userpromo`
--
ALTER TABLE `userpromo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
