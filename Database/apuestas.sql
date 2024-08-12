-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2024 a las 15:59:17
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
(18, 2, '875e084b25619b5b', '2024-08-08 17:54:41', '2024-08-08', '2024-09-08', 'MENSUAL', 'Suscripción Por 4 Señales', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 0, 5.000000, 0.000000, 5.000000, 5.000000, 0.000000, 1, 0, 1, 0, 0, 'ACTIVO', 'azul.png', 'white', 'USDC'),
(19, 6, '66faacdeaca1dac1', '2024-08-10 13:05:58', '2024-08-10', '2025-08-10', 'ANUAL', '190% RENTABILIDAD ANUAL INVERSIÓN 20$', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 190, 20.000000, 3.166667, 3.821683, 45.860193, 0.000000, 12, 0, 1, 0, 0, 'ACTIVO', 'azul.png', 'white', 'USDC'),
(20, 7, 'c196ac13fe05d012', '2024-08-12 02:50:46', '2024-08-12', '2024-09-12', 'MENSUAL', 'Prueba', 'alfonsi.acosta@gmail.com', 'pepe@gmail.com', 0, 5.000000, 0.000000, 5.000000, 5.000000, 0.000000, 1, 0, 1, 0, 0, 'ACTIVO', 'amarillo.png', 'black', 'USDC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
