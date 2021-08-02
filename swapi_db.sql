-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2021 at 04:56 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swapi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `starships`
--

CREATE TABLE `starships` (
  `_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  `starship_class` varchar(100) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `cost_in_credits` varchar(100) NOT NULL,
  `length` varchar(100) NOT NULL,
  `crew` varchar(100) NOT NULL,
  `passengers` varchar(100) NOT NULL,
  `max_atmosphering_speed` varchar(100) NOT NULL,
  `hyperdrive_rating` varchar(100) NOT NULL,
  `MGLT` varchar(100) NOT NULL,
  `cargo_capacity` varchar(100) NOT NULL,
  `consumables` varchar(100) NOT NULL,
  `films` varchar(100) NOT NULL,
  `pilots` longtext NOT NULL,
  `url` longtext NOT NULL,
  `created` varchar(100) NOT NULL,
  `edited` varchar(100) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `cost_in_credits` varchar(100) NOT NULL,
  `length` varchar(100) NOT NULL,
  `max_atmosphering_speed` varchar(100) NOT NULL,
  `crew` varchar(100) NOT NULL,
  `passengers` varchar(100) NOT NULL,
  `cargo_capacity` varchar(100) NOT NULL,
  `consumables` varchar(100) NOT NULL,
  `vehicle_class` varchar(100) NOT NULL,
  `pilots` longtext NOT NULL,
  `films` longtext NOT NULL,
  `created` varchar(100) NOT NULL,
  `edited` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `starships`
--
ALTER TABLE `starships`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `starships`
--
ALTER TABLE `starships`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
