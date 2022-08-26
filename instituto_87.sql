-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-08-2022 a las 11:49:16
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `instituto_87`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `documento` bigint(8) NOT NULL,
  `tipo_documento` char(3) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_postal` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `numero_domicilio` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `piso` char(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `departamento` char(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` bigint(15) DEFAULT NULL,
  `contacto_emergencia` bigint(15) DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `titulo_secundario` tinyint(1) NOT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`documento`, `tipo_documento`, `apellido`, `nombre`, `sexo`, `fecha_nacimiento`, `nacionalidad`, `provincia`, `localidad`, `codigo_postal`, `domicilio`, `numero_domicilio`, `piso`, `departamento`, `telefono`, `contacto_emergencia`, `email`, `titulo_secundario`) VALUES
(24529073, 'DNI', 'PASTORINO', 'JAVIER', 'M', '1975-05-23', 'ARGENTINA', 'BUENOS AIRES', 'AYACUCHO', 'B7150', 'PASTEUR', '550', NULL, NULL, 249154661097, NULL, 'javierfpastorino@gmail.com', 1),
(24529075, 'DNI', 'PASTORINO', 'Analista de Sistemas', 'M', '1975-05-23', 'ARGENTINA', 'BUENOS AIRES', 'AYACUCHO', 'B7150', 'PASTEUR', '550', NULL, NULL, 2494661097, NULL, 'javierfpastorino@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

DROP TABLE IF EXISTS `carreras`;
CREATE TABLE IF NOT EXISTS `carreras` (
  `resolucion` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_anios` int(1) NOT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `anio_inicio` int(4) NOT NULL,
  PRIMARY KEY (`resolucion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`resolucion`, `codigo`, `nombre`, `cantidad_anios`, `tipo`, `anio_inicio`) VALUES
('1234', '1234', 'Analista de Sistemas', 3, 'T', 2019),
('43210', '123', 'EnfermerÃ­a', 3, 'T', 2020),
('4321', '4321', 'Prueba', 4, 'P', 2022);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resolucion` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `anio` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `resolucion`, `codigo`, `nombre`, `anio`) VALUES
(1, '43210', 'mate', 'AnÃ¡lisis MatemÃ¡tico 1', 1),
(2, '43210', 'mate', 'AnÃ¡lisis MatemÃ¡tico 2', 2),
(3, '43210', 'mate', 'Ãlgebra', 1),
(4, '43210', 'mate', 'LÃ³gica', 2),
(5, '43210', 'mate', 'Probabilidades y estadÃ­sticas', 2),
(6, '1234', 'mate', 'AnÃ¡lisis MatemÃ¡tico 1', 1),
(7, '1234', 'mate', 'LÃ³gica', 1),
(8, '1234', 'mate', 'AnÃ¡lisis MatemÃ¡tico 2', 2),
(9, '1234', 'mate', 'Ãlgebra', 2),
(11, '1234', 'mmm', 'hhhh', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varbinary(8000) NOT NULL,
  `nivel` int(1) NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `clave`, `nivel`) VALUES
('admin', 0x243279243130242f4a4d656845535a323544656771326441747a64412e4567694d48337665682f7861332e4f3861554f616574526c44336d71475857, 0),
('Javier', 0x24327924313024534537624742785574665133614333426867676e4c2e566636442f4f304b67415964364233736277734f4a334b31484866764e4361, 1),
('Fernando', 0x2432792431302477352f4630476e2e745746517243476f784c6968552e47414c69654639694763346e54364646476a56427069613555656c4b677561, 1),
('Damian', 0x2432792431302449523131556651584a6237624f626a62735a4e7349656d7247537831364e696e6478515a306b736f39476334424d2f42585145412e, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
