-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-11-2020 a las 12:42:54
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: coches
--
CREATE DATABASE IF NOT EXISTS coches DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE coches;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla marca
--

DROP TABLE IF EXISTS marca;
CREATE TABLE IF NOT EXISTS marca (
                                         id int(11) NOT NULL AUTO_INCREMENT,
                                         nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                         PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla marca
--

INSERT INTO marca (id, nombre) VALUES
(1, 'Ford'),
(2, 'Audi'),
(3, 'Opel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla modelo
--

DROP TABLE IF EXISTS modelo;
CREATE TABLE IF NOT EXISTS modelo (
                                       id int(11) NOT NULL AUTO_INCREMENT,
                                       modelo varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                       motor varchar(80) DEFAULT NULL,
                                       caballos varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                       combustible varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                       estrella tinyint(1) NOT NULL DEFAULT 0,
                                       marcaId int(11) NOT NULL,
                                       PRIMARY KEY (id),
                                       KEY fk_marcaIdIdx (marcaId)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla modelo
--

INSERT INTO modelo (id, modelo, motor, caballos, combustible , estrella, marcaId) VALUES
(1, 'mondeo', '2.0', '150', 'gasolina' , 0, 1),
(2, 'focus', '1.0', '125', 'gasolina' , 0, 1),
(3, 'a3', '2.0', '150', 'diesel' , 0, 2),
(4, 'rs5', '2.7', '240', 'gasolina' , 0, 2),
(5, 'astra', '1.8', '115', 'diesel' , 0, 3),
(6, 'mondeo', '2.0', '115', 'diesel' , 0, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla modelo
--
ALTER TABLE modelo
    ADD CONSTRAINT fk_marcaId FOREIGN KEY (marcaId) REFERENCES marca (id) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
