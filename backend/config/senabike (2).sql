-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 01:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `senabike`
--

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `id` int(11) NOT NULL,
  `brand` text NOT NULL,
  `color` text NOT NULL,
  `bike_condition` text NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `rent_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`id`, `brand`, `color`, `bike_condition`, `availability`, `rent_price`) VALUES
(4, 'GW', 'Verde', 'Excelente', 1, 100000),
(5, 'GW', 'Rojo', 'Regular', 1, 10000),
(8, 'GW', 'Blanco', 'Regular', 0, 121212);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `economic_id` int(11) NOT NULL,
  `discount_range` text NOT NULL,
  `discount_percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `economic_status`
--

CREATE TABLE `economic_status` (
  `id` int(11) NOT NULL,
  `economic_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `economic_status`
--

INSERT INTO `economic_status` (`id`, `economic_name`) VALUES
(1, 'Estrato Uno'),
(2, 'Estrato Dos'),
(3, 'Estrato Tres'),
(4, 'Estrato Cuatro'),
(5, 'Estrato Cinco'),
(6, 'Estrato Seis');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `department` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `department`) VALUES
(1, 'Amazonas'),
(2, 'Antioquia'),
(3, 'Arauca'),
(4, 'Atlántico'),
(5, 'Bolívar'),
(6, 'Boyacá'),
(7, 'Caldas'),
(8, 'Caquetá'),
(9, 'Casanare'),
(10, 'Cauca'),
(11, 'Cesar'),
(12, 'Chocó'),
(13, 'Córdoba'),
(14, 'Cundinamarca'),
(15, 'Guainía'),
(16, 'Guaviare'),
(17, 'Huila'),
(18, 'La Guajira'),
(19, 'Magdalena'),
(20, 'Meta'),
(21, 'Nariño'),
(22, 'Norte de Santander'),
(23, 'Putumayo'),
(24, 'Quindío'),
(25, 'Risaralda'),
(26, 'San Andrés y Providencia'),
(27, 'Santander'),
(28, 'Sucre'),
(29, 'Tolima'),
(30, 'Valle del Cauca'),
(31, 'Vaupés'),
(32, 'Vichada');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `bike_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `origin_region_id` int(11) NOT NULL,
  `destination_region_id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `final_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Funcionario'),
(3, 'Aprendiz');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(99) NOT NULL,
  `phone_number` text NOT NULL,
  `password` varchar(99) NOT NULL,
  `economic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `region_id`, `name`, `email`, `phone_number`, `password`, `economic_id`) VALUES
(100, 1, 8, 'Jair Sanchez', 'jair@mail.com', '232352352366', '12345678', 0),
(101, 1, 8, 'Jair Sanchez', 'jair.sanchez@mail.com', '2323523523', 'password123', 2),
(102, 2, 12, 'Maria Gomez', 'maria.gomez@mail.com', '1234567890', 'password456', 3),
(103, 3, 25, 'Carlos Rodriguez', 'carlos.rodriguez@mail.com', '2345678901', 'password789', 1),
(104, 1, 4, 'Luisa Martinez', 'luisa.martinez@mail.com', '3456789012', 'password321', 6),
(105, 2, 15, 'Andres Fernandez', 'andres.fernandez@mail.com', '4567890123', 'password654', 4),
(106, 3, 7, 'Laura Torres', 'laura.torres@mail.com', '5678901234', 'password987', 5),
(107, 1, 30, 'Diego Lopez', 'diego.lopez@mail.com', '6789012345', 'password543', 1),
(108, 2, 22, 'Sofia Perez', 'sofia.perez@mail.com', '7890123456', 'password678', 3),
(109, 3, 1, 'Miguel Morales', 'miguel.morales@mail.com', '8901234567', 'password234', 2),
(110, 1, 19, 'Ana Rivas', 'ana.rivas@mail.com', '9012345678', 'password876', 6),
(111, 2, 11, 'Pablo Herrera', 'pablo.herrera@mail.com', '0123456789', 'password135', 4),
(112, 3, 28, 'Valentina Ruiz', 'valentina.ruiz@mail.com', '1234567890', 'password246', 5),
(113, 1, 17, 'Fernando Castro', 'fernando.castro@mail.com', '2345678901', 'password357', 1),
(114, 2, 6, 'Isabella Vargas', 'isabella.vargas@mail.com', '3456789012', 'password468', 2),
(115, 3, 29, 'Emilio Mendoza', 'emilio.mendoza@mail.com', '4567890123', 'password579', 3),
(116, 1, 14, 'Cristina Aguirre', 'cristina.aguirre@mail.com', '5678901234', 'password680', 6),
(117, 2, 31, 'Arturo Pineda', 'arturo.pineda@mail.com', '6789012345', 'password791', 5),
(118, 3, 3, 'Renata Salazar', 'renata.salazar@mail.com', '7890123456', 'password802', 4),
(119, 1, 21, 'Hugo Camacho', 'hugo.camacho@mail.com', '8901234567', 'password913', 1),
(120, 2, 16, 'Santiago Cortes', 'santiago.cortes@mail.com', '9012345678', 'password024', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `economic_id` (`economic_id`);

--
-- Indexes for table `economic_status`
--
ALTER TABLE `economic_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bike_id` (`bike_id`,`user_id`,`origin_region_id`,`destination_region_id`,`discount_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `economic_id` (`economic_id`),
  ADD KEY `region.id` (`region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `economic_status`
--
ALTER TABLE `economic_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
