-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2024 at 08:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_data`
--
CREATE DATABASE IF NOT EXISTS `flight_data` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `flight_data`;

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

DROP TABLE IF EXISTS `airline`;
CREATE TABLE `airline` (
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`code`, `name`) VALUES
('AA', 'American Airlines'),
('AC', 'Air Canada'),
('AF', 'Air France'),
('BA', 'British Airways'),
('DL', 'Delta Air Lines'),
('EK', 'Emirates'),
('LH', 'Lufthansa'),
('QF', 'Qantas'),
('UA', 'United Airlines');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

DROP TABLE IF EXISTS `airport`;
CREATE TABLE `airport` (
  `code` varchar(10) NOT NULL,
  `city_code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country_code` char(2) NOT NULL,
  `region_code` varchar(10) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `timezone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`code`, `city_code`, `name`, `city`, `country_code`, `region_code`, `latitude`, `longitude`, `timezone`) VALUES
('DXB', 'DXB', 'Dubai International', 'Dubai', 'AE', 'DXB', 25.253175, 55.365673, 'Asia/Dubai'),
('JFK', 'NYC', 'John F. Kennedy International', 'New York', 'US', 'NY', 40.641311, -73.778139, 'America/New_York'),
('LAX', 'LAX', 'Los Angeles International', 'Los Angeles', 'US', 'CA', 33.941589, -118.408530, 'America/Los_Angeles'),
('LHR', 'LON', 'London Heathrow', 'London', 'GB', 'ENG', 51.470022, -0.454296, 'Europe/London'),
('ORD', 'ORD', 'O\'Hare International', 'Chicago', 'US', 'IL', 41.974163, -87.907321, 'America/Chicago'),
('SFO', 'SFO', 'San Francisco International', 'San Francisco', 'US', 'CA', 37.774930, -122.419420, 'America/Los_Angeles'),
('SYD', 'SYD', 'Sydney Kingsford Smith', 'Sydney', 'AU', 'NSW', -33.939923, 151.175276, 'Australia/Sydney'),
('YUL', 'YMQ', 'Pierre Elliott Trudeau International', 'Montreal', 'CA', 'QC', 45.457714, -73.749908, 'America/Montreal'),
('YVR', 'YVR', 'Vancouver International', 'Vancouver', 'CA', 'BC', 49.194698, -123.179192, 'America/Vancouver');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

DROP TABLE IF EXISTS `flight`;
CREATE TABLE `flight` (
  `airline` varchar(10) NOT NULL,
  `number` varchar(10) NOT NULL,
  `departure_airport` varchar(10) NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_airport` varchar(10) NOT NULL,
  `arrival_time` time NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`airline`, `number`, `departure_airport`, `departure_time`, `arrival_airport`, `arrival_time`, `price`) VALUES
('AA', '100', 'JFK', '08:30:00', 'LHR', '20:00:00', 500.00),
('AA', '101', 'YUL', '07:00:00', 'JFK', '09:00:00', 300.00),
('AA', '104', 'JFK', '08:00:00', 'YUL', '10:00:00', 300.00),
('AA', '308', 'YVR', '14:00:00', 'JFK', '22:00:00', 490.00),
('AA', '400', 'ORD', '07:00:00', 'YUL', '09:00:00', 260.00),
('AA', '403', 'YUL', '08:00:00', 'ORD', '10:00:00', 260.00),
('AC', '102', 'YUL', '12:30:00', 'JFK', '14:30:00', 280.00),
('AC', '105', 'JFK', '14:30:00', 'YUL', '16:30:00', 280.00),
('AC', '301', 'YUL', '07:35:00', 'YVR', '10:05:00', 273.23),
('AC', '302', 'YVR', '11:30:00', 'YUL', '19:11:00', 220.63),
('AC', '303', 'YUL', '14:00:00', 'YVR', '16:30:00', 280.00),
('AF', '204', 'JFK', '16:00:00', 'LHR', '04:00:00', 530.00),
('AF', '205', 'JFK', '21:00:00', 'LHR', '09:00:00', 530.00),
('BA', '200', 'LHR', '10:00:00', 'JFK', '13:00:00', 520.00),
('BA', '201', 'LHR', '15:00:00', 'JFK', '18:00:00', 520.00),
('BA', '202', 'LHR', '20:00:00', 'JFK', '23:00:00', 520.00),
('BA', '203', 'JFK', '11:00:00', 'LHR', '23:00:00', 520.00),
('BA', '206', 'LHR', '11:00:00', 'YVR', '13:00:00', 560.00),
('BA', '302', 'YVR', '18:00:00', 'LHR', '06:00:00', 560.00),
('DL', '103', 'YUL', '18:00:00', 'JFK', '20:00:00', 290.00),
('DL', '106', 'JFK', '20:00:00', 'YUL', '22:00:00', 290.00),
('DL', '200', 'JFK', '14:00:00', 'YVR', '18:00:00', 450.00),
('DL', '207', 'LHR', '17:00:00', 'YVR', '19:00:00', 570.00),
('DL', '304', 'YUL', '18:00:00', 'YVR', '20:30:00', 270.00),
('DL', '307', 'YVR', '08:00:00', 'YUL', '10:30:00', 275.00),
('DL', '402', 'ORD', '19:00:00', 'YUL', '21:00:00', 255.00),
('DL', '405', 'YUL', '20:00:00', 'ORD', '22:00:00', 255.00),
('EK', '300', 'YVR', '07:00:00', 'LHR', '19:00:00', 570.00),
('LH', '208', 'LHR', '22:00:00', 'YVR', '00:00:00', 580.00),
('LH', '301', 'YVR', '12:00:00', 'LHR', '00:00:00', 580.00),
('LH', '309', 'LHR', '12:00:00', 'YVR', '15:00:00', 580.00),
('LH', '500', 'LHR', '09:00:00', 'YUL', '12:00:00', 550.00),
('UA', '401', 'ORD', '13:00:00', 'YUL', '15:00:00', 250.00),
('UA', '404', 'YUL', '14:00:00', 'ORD', '16:00:00', 250.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airline`
--
ALTER TABLE `airline`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`airline`,`number`) USING BTREE,
  ADD KEY `departure_airport` (`departure_airport`),
  ADD KEY `arrival_airport` (`arrival_airport`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`airline`) REFERENCES `airline` (`code`),
  ADD CONSTRAINT `flight_ibfk_2` FOREIGN KEY (`departure_airport`) REFERENCES `airport` (`code`),
  ADD CONSTRAINT `flight_ibfk_3` FOREIGN KEY (`arrival_airport`) REFERENCES `airport` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
