-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2024 a las 21:49:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_videojuegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `ID_Transaccion` int(11) NOT NULL,
  `ID_Cliente` int(11) NOT NULL,
  `ID_Juego` int(11) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Formato` varchar(50) NOT NULL,
  `Plataforma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`ID_Transaccion`, `ID_Cliente`, `ID_Juego`, `Precio`, `Formato`, `Plataforma`) VALUES
(1, 1, 2, 5000, 'Digital', 'Microsoft Windows'),
(2, 2, 1, 72000, 'Blu-ray Disc', 'PS4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojuegos`
--

CREATE TABLE `videojuegos` (
  `ID_Juego` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Desarrollador` varchar(50) NOT NULL,
  `Distribuidor` varchar(50) NOT NULL,
  `Genero` varchar(50) NOT NULL,
  `Fecha de lanzamiento` date NOT NULL,
  `Formato` varchar(75) NOT NULL,
  `Plataformas` varchar(75) NOT NULL,
  `Modos de juego` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `videojuegos`
--

INSERT INTO `videojuegos` (`ID_Juego`, `Nombre`, `Desarrollador`, `Distribuidor`, `Genero`, `Fecha de lanzamiento`, `Formato`, `Plataformas`, `Modos de juego`) VALUES
(1, 'Red Dead Redemption 2', 'Rockstar Games', 'Rockstar Games', 'Acción-aventura/Mundo abierto', '2019-12-05', 'Blu-ray Disc/Digital', 'Microsoft Windows/PlayStation 4/Xbox One', 'Un jugador/Multijugador'),
(2, 'Mount and Blade: Warband', 'TaleWorlds Entertainment', 'Paradox Interactive', 'Acción-aventura/estrategia', '2010-08-12', 'Blu-ray Disc/Digital', 'Microsoft Windows/PlayStation 4/Xbox One', 'Un jugador/Multijugador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`ID_Transaccion`),
  ADD KEY `Id_Producto` (`ID_Juego`);

--
-- Indices de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD PRIMARY KEY (`ID_Juego`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `ID_Transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  MODIFY `ID_Juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`ID_Juego`) REFERENCES `videojuegos` (`ID_Juego`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
