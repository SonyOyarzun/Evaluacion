-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2019 a las 08:32:27
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `evaluacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id_pregunta` int(11) NOT NULL,
  `comentario_calificacion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `nota_calificacion` int(11) NOT NULL,
  `id_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `id_evaluado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_calificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`id_pregunta`, `comentario_calificacion`, `nota_calificacion`, `id_usuario`, `id_evaluado`, `fecha_calificacion`) VALUES
(14, ' k', 4, '00.000.000-0', '00.000.000-0', '2019-10-09 02:06:33'),
(15, ' ', 4, '00.000.000-0', '00.000.000-0', '2019-10-09 02:06:33'),
(16, ' ', 4, '00.000.000-0', '00.000.000-0', '2019-10-09 02:06:33'),
(17, ' ', 4, '00.000.000-0', '00.000.000-0', '2019-10-09 02:06:33'),
(14, ' 1', 1, '00.000.000-0', '14.518.129-1', '2019-10-09 02:25:31'),
(15, ' 2', 2, '00.000.000-0', '14.518.129-1', '2019-10-09 02:25:31'),
(16, ' 3', 3, '00.000.000-0', '14.518.129-1', '2019-10-09 02:25:31'),
(17, ' 4', 4, '00.000.000-0', '14.518.129-1', '2019-10-09 02:25:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_general`
--

CREATE TABLE `comentario_general` (
  `id_encuesta` int(11) NOT NULL,
  `descripcion_comentario_general` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `id_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `id_evaluado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_comentario_general` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `comentario_general`
--

INSERT INTO `comentario_general` (`id_encuesta`, `descripcion_comentario_general`, `id_usuario`, `id_evaluado`, `fecha_comentario_general`) VALUES
(5, 'lll', '00.000.000-0', '00.000.000-0', '2019-10-09 02:06:34'),
(5, 'jojo', '00.000.000-0', '14.518.129-1', '2019-10-09 02:25:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion_departamento` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_departamento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nombre_departamento`, `descripcion_departamento`, `fecha_departamento`) VALUES
(1, 'General', 'Sin Area especifica', '0000-00-00 00:00:00'),
(3, 'TI', 'Informatica', '2019-09-05 16:57:05'),
(4, 'Owl Evaluation', 'Equipo de desarrollo', '2019-09-14 04:45:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id_encuesta` int(11) NOT NULL,
  `nombre_encuesta` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_encuesta` int(11) NOT NULL,
  `fecha_encuesta` datetime NOT NULL,
  `estado_encuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id_encuesta`, `nombre_encuesta`, `tipo_encuesta`, `fecha_encuesta`, `estado_encuesta`) VALUES
(2, 'DESEMPENO ESPECIFICO DEL CARGO (T.I)', 1, '2019-09-12 03:03:11', 1),
(3, 'HABILIDADES Y COMPETENCIAS GENERALES (T.I)', 1, '2019-09-12 03:03:35', 1),
(4, 'HABILIDADES Y COMPETENCIAS GENERALES (DIRECTOR T.I)', 2, '2019-09-12 03:27:53', 1),
(5, 'DESEMPENO ESPECIFICO DEL CARGO  (DIRECTOR T.I)', 2, '2019-09-12 03:28:28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(1, 'habilitado'),
(2, 'deshabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_asignacion`
--

CREATE TABLE `estado_asignacion` (
  `id_estado_asignacion` int(11) NOT NULL,
  `nombre_estado_asignacion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estado_asignacion`
--

INSERT INTO `estado_asignacion` (`id_estado_asignacion`, `nombre_estado_asignacion`) VALUES
(1, 'Asignada'),
(2, 'Contestada'),
(3, 'No Contestada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `nombre_genero` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `nombre_genero`) VALUES
(1, 'Femenino'),
(2, 'Masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_encuesta` int(11) NOT NULL,
  `id_usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `id_evaluado` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_encuesta` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_encuesta` int(11) NOT NULL,
  `id_asignacion` int(11) NOT NULL,
  `fecha_historial` datetime NOT NULL,
  `estado_usuario_encuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_encuesta`, `id_usuario`, `id_evaluado`, `nombre_encuesta`, `tipo_encuesta`, `id_asignacion`, `fecha_historial`, `estado_usuario_encuesta`) VALUES
(5, '00.000.000-0', '00.000.000-0', 'DESEMPENO ESPECIFICO DEL CARGO  (DIRECTOR T.I)', 2, 1, '2019-10-09 02:06:34', 2),
(5, '00.000.000-0', '14.518.129-1', 'DESEMPENO ESPECIFICO DEL CARGO  (DIRECTOR T.I)', 2, 1, '2019-10-09 02:25:31', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `nombre_pregunta` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion_pregunta` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `id_encuesta`, `nombre_pregunta`, `descripcion_pregunta`) VALUES
(1, 3, 'Proactividad:', 'Considera la tendencia a\r\ncontribuir, desarrollar y realizar nuevas\r\nideas y nuevos mÃ©todos.\r\n'),
(2, 3, 'Capacidad de planificaciÃ³n:', 'Capacidad que posee para establecer objetivos de su area y realizarlos con su equipo de trabajo.'),
(3, 3, 'Capacidad de Trabajo en Equipo:', 'Considera la manera de manejar las\r\nrelaciones de apoyo con su equipo de\r\ntrabajo y con otras Ã¡reas de la instituciÃ³n'),
(4, 3, 'Conocimientos / PreparaciÃ³n para la labor:', 'Considera el conocimiento para la\r\nejecuciÃ³n de su labor, complementada\r\ncon la experiencia y educaciÃ³n'),
(5, 3, 'AlineaciÃ³n con el Plan EstratÃ©gico y Principios Institucionales: ', 'Demuestra estar comprometido con la\r\ninstitucionalidad\r\n'),
(6, 3, 'PrecisiÃ³n, claridad y atenciÃ³n a los detalles del trabajo:', 'Considera la\r\nprecisiÃ³n, claridad, confiabilidad y\r\npresentaciÃ³n de los resultados\r\n'),
(7, 2, 'Actitud:', 'Comprende que la actitud frente al\r\ntrabajo es lo primordial.\r\n'),
(8, 2, 'Volumen de trabajo:', 'Realizar el volumen de trabajo asignado\r\nen el tiempo estipulado para hacerlo,\r\nregistrando todo en el gestor de proyectos\r\ndel equipo.\r\n'),
(9, 2, 'Centrado en la tarea.', 'Logra con precisiÃ³n, esmero, rigurosidad y\r\npulcritud los resultados de las actividades\r\nplaneadas.\r\n\r\n'),
(10, 2, 'Proactividad y disciplina:', 'Tienen iniciativa\ny son sensibles a las necesidades de los\ndemÃ¡s. Asumen responsabilidad y control\nde las situaciones.\n'),
(11, 2, 'Capacidad resolutiva y manejo de problemas: ', ' Resuelve problemas\r\nrelacionados con su Ã¡mbito de acciÃ³n de\r\nmanera eficiente.\r\n'),
(12, 2, 'Aporte:', 'Constantemente aporta ideas\r\npara el desarrollo de nuevas soluciones\r\nque permitan potenciar las Ã¡reas de la\r\ninstituciÃ³n.\r\n\r\n'),
(13, 2, 'AtenciÃ³n al usuario / Cliente:', 'Comprender a cabalidad que el usuario /\r\ncliente es el centro y que el rol que tiene\r\nen el Ã¡rea de tecnologÃ­a es de servicio y de\r\ngeneraciÃ³n de valor.\r\n\r\n\r\n'),
(14, 5, 'OperaciÃ³n, disponibilidad y coherencia: ', 'Mantener la operaciÃ³n, soporte,\r\ndisponibilidad y coherencia de los\r\nsistemas de informaciÃ³n de la instituciÃ³n.'),
(15, 5, 'OperaciÃ³n y plan de renovaciÃ³n de laboratorios: ', 'Proponer planes viables de\r\nrenovaciÃ³n y adquisiciÃ³n de hardware y\r\nsoftware, que respondan efectivamente a\r\nlas necesidades de la instituciÃ³n.\r\n'),
(16, 5, 'PlanificaciÃ³n, implementaciÃ³n e InnovaciÃ³n: ', ' Planificar, analizar, diseÃ±ar,\r\nimplementar y evaluar los sistemas de\r\ninformaciÃ³n de la instituciÃ³n.\r\nRecomendaciÃ³n de soluciones\r\ntecnolÃ³gicas, propiciando la innovaciÃ³n de\r\nprocesos y servicios para el estudiante.'),
(17, 5, 'DocumentaciÃ³n de medidas de aseguramiento de la calidad:', 'Se explicitan\r\nlas medidas de aseguramiento de la\r\ncalidad y registran indicadores valorados\r\nen serie histÃ³rica.\r\n'),
(18, 4, 'Proactividad:', 'Considera la tendencia a\r\ncontribuir, desarrollar y realizar nuevas\r\nideas y nuevos mÃ©todos.'),
(19, 4, 'Capacidad de planificaciÃ³n:', ' Capacidad\r\nque posee para establecer objetivos de su\r\nÃ¡rea y realizarlos con su equipo de\r\ntrabajo.'),
(20, 4, 'Capacidad de Trabajo en Equipo:', 'Considera la manera de manejar las\r\nrelaciones de apoyo con su equipo de\r\ntrabajo y con otras Ã¡reas de la instituciÃ³n.\r\n'),
(21, 4, 'Conocimientos / PreparaciÃ³n para la labor: ', 'Considera el conocimiento para la\r\nejecuciÃ³n de su labor, complementada\r\ncon la experiencia y educaciÃ³n.\r\n'),
(22, 4, 'AlineaciÃ³n con el Plan EstratÃ©gico y Principios Institucionales:', 'Demuestra estar comprometido con la\r\ninstitucionalidad.\r\n\r\n'),
(23, 4, 'PrecisiÃ³n, claridad y atenciÃ³n a los detalles del trabajo: ', 'Considera la\r\nprecisiÃ³n, claridad, confiabilidad y\r\npresentaciÃ³n de los resultados\r\n\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_encuesta`
--

CREATE TABLE `tipo_encuesta` (
  `id_tipo_encuesta` int(11) NOT NULL,
  `nombre_tipo_encuesta` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_encuesta`
--

INSERT INTO `tipo_encuesta` (`id_tipo_encuesta`, `nombre_tipo_encuesta`) VALUES
(1, 'General'),
(2, 'Jefatura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre_tipo_usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nombre_tipo_usuario`) VALUES
(3, 'Administrador'),
(1, 'Colaborador'),
(2, 'Jefe de Area');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `clave_usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `mail_usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_usuario` datetime NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `genero_usuario` int(11) NOT NULL,
  `departamento_usuario` int(11) NOT NULL,
  `estado_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `clave_usuario`, `mail_usuario`, `fecha_usuario`, `tipo_usuario`, `genero_usuario`, `departamento_usuario`, `estado_usuario`) VALUES
('00.000.000-0', 'Administrador', 'Sistema', '$2y$10$uWtfj/SuQJqs.TSDmJmz8OtWPV5ukdJTJ5aiIILlNwj6Lz3c35z0S', 'admin@admin.com', '2019-09-04 20:00:18', 3, 2, 1, 1),
('14.518.129-1', 'Alvaro Guillermo', 'Valenzuela Garrido', '$2y$10$z4lqxhwmiS9ikVmNouomJ.DX/JPDf2zIpfvkKjpYPOMdrZypBNx8a', 'agarrido@ciisa.cl', '2019-09-12 04:32:03', 2, 2, 3, 1),
('17.002.792-2', 'Sony Michael', 'Oyarzun Lopez', '$2y$10$wzhrqu3g1z.4OZZfCx9b2evJSVw4nQe1DMJ0hqz5zGEEYJN9YAsSW', 'sony.oyarzun@gmail.com', '2019-09-12 04:33:01', 1, 2, 4, 1),
('18.154.878-9', 'Richard Eduardo', 'Perez Contreras', '$2y$10$rJEy2Dx7UQ7PU0CQaM9Bw.l23cKrdXUS2Dg1mQdty9oJLUua.8.gm', 'richard.perez.contreras@ciisa.cl', '2019-09-14 04:49:19', 1, 2, 4, 1),
('18.608.585-k', 'Francisco Alejandro', 'Prado Diaz', '$2y$10$gR3mLV4lCnYdyEdNly9FheXj5qh/LcSt9t2iMgNDLa8luELXQ.OgW', 'francisco.prado.diaz@ciisa.cl', '2019-09-14 04:55:30', 2, 2, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_encuesta`
--

CREATE TABLE `usuario_encuesta` (
  `id_usuario_encuesta` int(11) NOT NULL,
  `id_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `fecha_usuario_encuesta` datetime NOT NULL,
  `estado_usuario_encuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_encuesta`
--

INSERT INTO `usuario_encuesta` (`id_usuario_encuesta`, `id_usuario`, `id_encuesta`, `fecha_usuario_encuesta`, `estado_usuario_encuesta`) VALUES
(1, '00.000.000-0', 5, '2019-10-09 02:06:15', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `comentario_general`
--
ALTER TABLE `comentario_general`
  ADD KEY `id_encuesta` (`id_encuesta`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`),
  ADD UNIQUE KEY `nombre_departamento` (`nombre_departamento`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id_encuesta`),
  ADD KEY `tipo_encuesta` (`tipo_encuesta`),
  ADD KEY `id_estado` (`estado_encuesta`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `estado_asignacion`
--
ALTER TABLE `estado_asignacion`
  ADD PRIMARY KEY (`id_estado_asignacion`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`),
  ADD UNIQUE KEY `nombre_genero` (`nombre_genero`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_encuesta` (`id_encuesta`);

--
-- Indices de la tabla `tipo_encuesta`
--
ALTER TABLE `tipo_encuesta`
  ADD PRIMARY KEY (`id_tipo_encuesta`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`),
  ADD UNIQUE KEY `nombre_tipo` (`nombre_tipo_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `mail_usuario` (`mail_usuario`),
  ADD KEY `tipo_usuario` (`tipo_usuario`),
  ADD KEY `genero_usuario` (`genero_usuario`),
  ADD KEY `departamento_usuario` (`departamento_usuario`),
  ADD KEY `id_estado` (`estado_usuario`);

--
-- Indices de la tabla `usuario_encuesta`
--
ALTER TABLE `usuario_encuesta`
  ADD PRIMARY KEY (`id_usuario_encuesta`),
  ADD KEY `id_encuesta` (`id_encuesta`),
  ADD KEY `estado` (`estado_usuario_encuesta`),
  ADD KEY `id_encuesta_2` (`id_encuesta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_asignacion`
--
ALTER TABLE `estado_asignacion`
  MODIFY `id_estado_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tipo_encuesta`
--
ALTER TABLE `tipo_encuesta`
  MODIFY `id_tipo_encuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario_encuesta`
--
ALTER TABLE `usuario_encuesta`
  MODIFY `id_usuario_encuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`);

--
-- Filtros para la tabla `comentario_general`
--
ALTER TABLE `comentario_general`
  ADD CONSTRAINT `comentario_general_ibfk_1` FOREIGN KEY (`id_encuesta`) REFERENCES `encuesta` (`id_encuesta`);

--
-- Filtros para la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD CONSTRAINT `encuesta_ibfk_1` FOREIGN KEY (`tipo_encuesta`) REFERENCES `tipo_encuesta` (`id_tipo_encuesta`),
  ADD CONSTRAINT `encuesta_ibfk_2` FOREIGN KEY (`estado_encuesta`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`id_encuesta`) REFERENCES `encuesta` (`id_encuesta`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`departamento_usuario`) REFERENCES `departamento` (`id_departamento`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`genero_usuario`) REFERENCES `genero` (`id_genero`),
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`estado_usuario`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `usuario_encuesta`
--
ALTER TABLE `usuario_encuesta`
  ADD CONSTRAINT `usuario_encuesta_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `usuario_encuesta_ibfk_3` FOREIGN KEY (`estado_usuario_encuesta`) REFERENCES `estado_asignacion` (`id_estado_asignacion`),
  ADD CONSTRAINT `usuario_encuesta_ibfk_4` FOREIGN KEY (`id_encuesta`) REFERENCES `encuesta` (`id_encuesta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
