-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-12-2020 a las 14:19:40
-- Versión del servidor: 8.0.21-0ubuntu0.20.04.4
-- Versión de PHP: 7.2.33-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

CREATE TABLE `bitacoras` (
  `id` int NOT NULL,
  `quien` varchar(40) COLLATE utf8_bin NOT NULL,
  `cuando` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accion` varchar(600) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `que` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `bitacoras`
--

INSERT INTO `bitacoras` (`id`, `quien`, `cuando`, `accion`, `que`) VALUES
(1, 'Anonimo', '2020-11-22 12:23:55', 'Agrego categoria', '{\"nombre\":\"Prueba 1\",\"descripcion\":\"descripcion\",\"id\":15}'),
(5, 'Jorge Octavio', '2020-11-22 16:58:02', 'Actualizó categoria', '{\"id\":16,\"nombre\":\"Prueba 1\",\"descripcion\":\"descripci\\u00f3n\",\"imagen\":null,\"activa\":\"1\"}'),
(6, 'Jorge Octavio', '2020-11-22 16:58:19', 'Eliminó categoria', '{\"id\":16,\"nombre\":\"Prueba 1\",\"descripcion\":\"descripci\\u00f3n\",\"imagen\":null,\"activa\":1}'),
(7, 'Desconocido', '2020-11-26 07:25:49', 'Se registro', '192.168.56.1'),
(8, 'Otra', '2020-11-30 05:15:10', 'Se registro', '192.168.56.1'),
(9, 'Otra', '2020-11-30 05:22:58', 'Se registro', '192.168.56.1'),
(10, 'Otra', '2020-11-30 05:24:18', 'Se registro', '192.168.56.1'),
(11, 'Otra', '2020-11-30 05:26:56', 'Se registro', '192.168.56.1'),
(12, 'Otra', '2020-11-30 05:28:58', 'Se registro', '192.168.56.1'),
(13, 'Otra', '2020-11-30 05:30:08', 'Se registro', '192.168.56.1'),
(14, 'Otra', '2020-11-30 05:31:32', 'Se registro', '192.168.56.1'),
(15, 'Otra', '2020-11-30 05:32:31', 'Se registro', '192.168.56.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `imagen`, `activa`) VALUES
(1, 'Electronica', 'artículos de electrónica', 'electronicos.png', 1),
(2, 'Electrodomesticos', 'asdf', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int NOT NULL,
  `producto_id` int NOT NULL,
  `pregunta` varchar(500) COLLATE utf8_bin NOT NULL,
  `hora_p` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quien_p` int NOT NULL,
  `p_autorizada` timestamp NULL DEFAULT NULL,
  `respuesta` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `r_autorizada` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `producto_id`, `pregunta`, `hora_p`, `quien_p`, `p_autorizada`, `respuesta`, `r_autorizada`) VALUES
(1, 2, 'Y funciona bien?', '2020-11-26 18:45:01', 7, '2020-11-27 22:19:57', 'Si solo el almacenamiento del modelo', '2020-11-27 22:22:58'),
(3, 4, 'Es 4g?', '2020-11-27 19:41:18', 6, '2020-12-02 07:04:54', NULL, NULL),
(8, 2, 'Que modelos es', '2020-12-01 07:21:26', 7, '2020-11-27 22:19:57', NULL, NULL),
(10, 4, 'De que compañía es?', '2020-12-05 12:19:53', 6, '2020-12-05 12:20:52', 'Está liberado', '2020-12-05 13:11:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre` varchar(20) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin NOT NULL,
  `precio` float NOT NULL,
  `imagen` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `usuario_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  `concesionado` tinyint(1) DEFAULT NULL,
  `motivo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `usuario_id`, `categoria_id`, `concesionado`, `motivo`) VALUES
(2, 'Celular', 'Motorola usado', 2000, 'cel.jpg', 6, 1, 1, ''),
(3, 'Tablet', 'Tableta Samsung Galaxy Tab S3 T820 Wifi (negro) Tablet', 2000, 'tableta.jpg', 6, 1, NULL, 'Cara'),
(4, 'Iphone', 'IPhone usado con estética de 9', 2500, 'iphone.jfif', 7, 1, 1, 'muy caro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `a_paterno` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `a_materno` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `imagen` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rol` enum('Supervisor','Encargado','Contador','Cliente') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Cliente',
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `a_paterno`, `a_materno`, `imagen`, `rol`, `activo`, `password`) VALUES
(3, 'Jorge Octavio', 'Guzmán', 'Sánchez', 'fotogit.jpg', 'Supervisor', 0, '$2y$10$yyXJqXRqSEfOscVNBS8Jm.uovr8x1OzuE.DpXlwQmvoAA7dai1csm'),
(4, 'Beto', NULL, NULL, 'usuario.png', 'Encargado', 0, '$2y$10$pfwFtyBI0Y16g.sWaItlT.w8jw3n1.maj8N/r9epXHm202VV7A.fK'),
(5, 'Adriana', NULL, NULL, NULL, 'Contador', 0, '$2y$10$W3P1OLuf5dP9OiLtXHeDE.svkIm.wcwOnSLXijCEb9ZcN7bOKh6pi'),
(6, 'Cliente', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$9zASZK6DwWbNyiODmr2X/up8SpNuQ.H2EkkPJhg58fipb8B6pVGo2'),
(7, 'Cliente2', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$yGNxmRHHCtj2GgqP6X2ml.hiKdCakc6QUVXosYkK5CAdhrSnlWdhm'),
(16, 'Desconocido', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$Rd0D99eniBPb8SyMSy9kEOk5gkUAI8c/PCWIKRjfnzi773835ED26'),
(17, 'Otra', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$WMt3ZaaRVRM5pRiYlXgaW.aOWRZ93iDmuI65rmzrD.H2pJFpTaBj2'),
(18, 'Otra', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$00QJw7XXBSwGTV6vtbBLree20I2K0htYzbBvSGmpQpa.PF7SC0jjC'),
(19, 'Otra', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$eKPrXVqfjEQFqu8AAaXJ.eGhYyWAVXECIcZ244s40PyJbjZ9R3rnG'),
(20, 'Otra', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$1NSW5SqMH//1mV4CePpwu.k12ALKcSyDEQxqqE0K.xHvXnzBOrzIe'),
(21, 'Otra', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$kzPRnwpsQfw2P9LWvDPsaOgylTgGP2Tvv7iA8N1AsEJY6l.5642A2'),
(22, 'Otra', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$14oxuGX7egaU4DO.x1fYW.uggo/54zevSFS4LGTezat8VZnLRtSxi'),
(23, 'Otra', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$WnTLN7mCXKVz.F3ytt5oHu50cfSWwjbsUGteXq4rnlRLCVQ34ELn2'),
(24, 'Otra', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$kNpBLYypHNYP5/OF/igBkOhAnb2G55U5gzuMXPFOZRr8Z9Vhphlx.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `de_que` (`producto_id`),
  ADD KEY `quien_pregunta` (`quien_p`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`usuario_id`),
  ADD KEY `categoria` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acendente` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `de_que` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `indagador` FOREIGN KEY (`quien_p`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `owner` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
