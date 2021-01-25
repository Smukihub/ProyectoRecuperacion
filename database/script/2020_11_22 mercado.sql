-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-11-2020 a las 19:15:50
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
(6, 'Jorge Octavio', '2020-11-22 16:58:19', 'Eliminó categoria', '{\"id\":16,\"nombre\":\"Prueba 1\",\"descripcion\":\"descripci\\u00f3n\",\"imagen\":null,\"activa\":1}');

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
(3, 'Tablet', 'Tableta Samsung Galaxy Tab S3 T820 Wifi (negro) Tablet', 2500, 'tableta.jpg', 6, 1, NULL, ''),
(4, 'Iphone', 'IPhone usado con estética de 9', 2500, 'iphone.jfif', 7, 1, 0, 'muy caro');

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
(4, 'Beto', NULL, NULL, NULL, 'Encargado', 0, '$2y$10$pfwFtyBI0Y16g.sWaItlT.w8jw3n1.maj8N/r9epXHm202VV7A.fK'),
(5, 'Adriana', NULL, NULL, NULL, 'Contador', 0, '$2y$10$W3P1OLuf5dP9OiLtXHeDE.svkIm.wcwOnSLXijCEb9ZcN7bOKh6pi'),
(6, 'Cliente', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$9zASZK6DwWbNyiODmr2X/up8SpNuQ.H2EkkPJhg58fipb8B6pVGo2'),
(7, 'Cliente2', NULL, NULL, NULL, 'Cliente', 0, '$2y$10$yGNxmRHHCtj2GgqP6X2ml.hiKdCakc6QUVXosYkK5CAdhrSnlWdhm');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

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
