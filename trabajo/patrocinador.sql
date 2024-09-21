-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-09-2024 a las 03:40:05
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
-- Estructura de tabla para la tabla `patrocinador`
--

DROP TABLE IF EXISTS `patrocinador`;
CREATE TABLE IF NOT EXISTS `patrocinador` (
  `codigo` int NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `patrocinio` int NOT NULL,
  `departamento` int NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `departamento` (`departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `patrocinador`
--

INSERT INTO `patrocinador` (`codigo`, `nombre`, `patrocinio`, `departamento`) VALUES
(1020, 'Recursos Humanos', 2000033, 1030),
(1030, 'Recursos Municipales', 20303030, 1030),
(1040, 'Recursos Gubernament', 2930303, 1030),
(1050, 'Recursos externos', 1020303030, 1030),
(1070, 'Recursos generales', 12345678, 1030);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
