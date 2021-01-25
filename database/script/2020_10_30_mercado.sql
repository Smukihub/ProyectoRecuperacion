CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(20) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin NOT NULL,
  `imagen` varchar(100) COLLATE utf8_bin NOT NULL,
  `activa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;
