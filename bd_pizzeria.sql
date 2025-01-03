-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2021 a las 03:18:36
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_pizzeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `cliNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cliCorreo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cliTelefono` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `cliPassword` varchar(60) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `cliNombre`, `cliCorreo`, `cliTelefono`, `cliPassword`) VALUES
(1, 'Juan', 'juancho29silva@gmail.com', '3112119638', 'd74a9f3baf2dd9f9fa4c1c0449cb0eac'),
(2, 'Alexandra', 'yesamez20@gmail.com', '3183807765', '8723b7199728cb6491facc5f572a5154');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `pedCliente` int(11) NOT NULL,
  `pedPizza` int(11) NOT NULL,
  `pedCantidad` int(11) NOT NULL,
  `pedFechaHora` datetime NOT NULL,
  `pedDireccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `pedEstado` enum('Inicio','Pendiente','En Proceso','Atendido') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pizzas`
--

CREATE TABLE `pizzas` (
  `idPizza` int(11) NOT NULL,
  `pizNombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `pizIngredientes` varchar(2000) COLLATE utf8_spanish2_ci NOT NULL,
  `pizValor` int(11) NOT NULL,
  `pizImagen` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `pizEstado` enum('Activa','Desactiva') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pizzas`
--

INSERT INTO `pizzas` (`idPizza`, `pizNombre`, `pizIngredientes`, `pizValor`, `pizImagen`, `pizEstado`) VALUES
(4, 'Pizzas Hawaiana', 'Contiene pequeos trozos de pizza', 4500, 'pizza-7.jpg', 'Activa'),
(5, 'Pizza De Pollo', 'Pizza con mucho pollo', 5000, 'pizza-6.jpg', 'Activa'),
(6, 'Pizza Peperoni', 'Pizza con mucho peperoni', 4500, 'pizza-2.jpg', 'Activa'),
(7, 'Pizza de Verduras', 'pizza con deliciosas verduras', 3000, 'pizza-5.jpg', 'Desactiva'),
(8, 'Pizza Mixta', 'Trae de todo un poquito y es muy rica', 6000, 'pizza-4.jpg', 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuLogin` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `usuPassword` varchar(60) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuLogin`, `usuPassword`) VALUES
(1, 'userAdmin', '9eb9dc2efedbc75afe0781c613eb3910');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idCliente` (`pedCliente`),
  ADD KEY `idPizza` (`pedPizza`);

--
-- Indices de la tabla `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`idPizza`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `idPizza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`pedPizza`) REFERENCES `pizzas` (`idPizza`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`pedCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
