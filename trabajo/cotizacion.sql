-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-09-2024 a las 03:39:01
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_trabajo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

DROP TABLE IF EXISTS `cotizacion`;
CREATE TABLE IF NOT EXISTS `cotizacion` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `valor` int NOT NULL,
  `receptor` int NOT NULL,
  `verificador` int DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `receptor` (`receptor`),
  KEY `verificador` (`verificador`)
) ENGINE=MyISAM AUTO_INCREMENT=2147483648 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`codigo`, `fecha`, `valor`, `receptor`, `verificador`) VALUES
(3, '2024-09-28', 1234567, 1020, 0),
(2, '2024-09-18', 123456, 1020, 0),
(4, '2024-09-30', 2345678, 1040, 1050),
(5, '2024-09-28', 134567, 1070, 1020),
(1050, '2024-09-27', 1234567, 1030, 1020),
(123, '2024-09-11', 123456, 1030, 0),
(1234, '2024-09-18', 123456, 1030, 1050),
(2345, '2024-09-24', 123456, 1020, 1050),
(12346, '2024-09-18', 23456, 1020, 1020),
(2147483647, '2024-09-18', 23456, 1020, 1020);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
