-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 11:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muhamedk_delavec_podjetje`
--

-- --------------------------------------------------------

--
-- Table structure for table `delavec`
--

CREATE TABLE `delavec` (
  `id_delavec` int(11) NOT NULL,
  `ime` varchar(30) DEFAULT NULL,
  `izobrazba` varchar(40) DEFAULT NULL,
  `placa` decimal(7,2) DEFAULT NULL,
  `id_podjetje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delavec`
--

INSERT INTO `delavec` (`id_delavec`, `ime`, `izobrazba`, `placa`, `id_podjetje`) VALUES
(1, 'Janez', 'visoka', '1000.00', 5),
(2, 'Miha', 'visoka', '1200.00', 1),
(3, 'Mojca', 'srednja', '600.00', 1),
(4, 'Metka', 'srednja', '500.00', 2),
(5, 'Janez', 'srednja', '700.00', 3),
(6, 'Luka', 'osnovna', '400.00', 4),
(7, 'Alenka', 'višja', '550.00', 4),
(8, 'Franci', 'višja', '1300.00', 6),
(9, 'Andrej', 'visoka', '2200.00', 6),
(10, 'Barbara', 'višja', '1500.00', 6),
(11, 'Aljaž', 'visoka', '2000.00', 7),
(12, 'Marjan', 'osnovna', '500.00', 7),
(32, 'Muhamed', 'visoka', '555.00', 1),
(33, 'Muhamed', 'visoka', '555.00', 1),
(34, 'žžž', 'visoka', '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `podjetje`
--

CREATE TABLE `podjetje` (
  `id_podjetje` int(11) NOT NULL,
  `naziv` varchar(100) DEFAULT NULL,
  `mesto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `podjetje`
--

INSERT INTO `podjetje` (`id_podjetje`, `naziv`, `mesto`) VALUES
(1, 'Markus d.o.o.', 'Celje'),
(2, 'Višina d.d.', 'Celje'),
(3, 'Milnica d.d.', 'Celje'),
(4, 'Ratata d.o.o.', 'Velenje'),
(5, 'Janez s.p.', 'Žalec'),
(6, 'Toti d.d.', 'Maribor'),
(7, 'Mala šala d.o.o.', 'Ljubljana'),
(8, 'Vedno za d.o.o.', 'Ljubljana'),
(9, 'Vsi za enega d.d.', 'Celje'),
(5281, '29ba397a-f', ''),
(20992, 'TAM d.o.o.', 'Maribor');

-- --------------------------------------------------------

--
-- Table structure for table `projekt`
--

CREATE TABLE `projekt` (
  `id_projekt` int(11) NOT NULL,
  `naziv` varchar(30) DEFAULT NULL,
  `sredstva` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projekt`
--

INSERT INTO `projekt` (`id_projekt`, `naziv`, `sredstva`) VALUES
(1, 'Projekt1', '100000.00'),
(2, 'Projekt2', '23000.00'),
(3, 'Projekt3', '35500.00'),
(4, 'Projekt4', '5000.00'),
(5, 'Projekt5', '50000.00'),
(6, 'Projekt6', '800000.00'),
(7, 'Projekt7', '120000.00'),
(8, 'Projekt8', NULL),
(9, 'Projekt9', NULL),
(10, 'Projekt10', '1000000.00');

-- --------------------------------------------------------

--
-- Table structure for table `sodeluje`
--

CREATE TABLE `sodeluje` (
  `id_delavec` int(11) NOT NULL,
  `id_projekt` int(11) NOT NULL,
  `funkcija` varchar(30) DEFAULT NULL,
  `datum_nastopa` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sodeluje`
--

INSERT INTO `sodeluje` (`id_delavec`, `id_projekt`, `funkcija`, `datum_nastopa`) VALUES
(1, 1, 'vodja', '2006-04-12 00:00:00'),
(1, 2, 'sodelavec', '2006-07-13 00:00:00'),
(2, 1, 'sodelavec', '2006-04-12 00:00:00'),
(2, 3, 'vodja', '2006-07-13 00:00:00'),
(3, 3, 'sodelavec', '2006-11-11 00:00:00'),
(4, 2, 'vodja', '2006-07-13 00:00:00'),
(4, 5, NULL, '2007-01-22 00:00:00'),
(4, 6, 'sodelavec', '2007-02-01 00:00:00'),
(5, 4, 'vodja', '2006-12-16 00:00:00'),
(6, 4, 'sodelavec', '2006-12-16 00:00:00'),
(8, 1, 'svetovalec', '2006-12-11 00:00:00'),
(8, 2, 'svetovalec', '2006-11-24 00:00:00'),
(8, 3, 'sodelavec', '2006-12-11 00:00:00'),
(8, 6, NULL, '2007-01-10 00:00:00'),
(9, 1, 'sodelavec', '2007-01-23 00:00:00'),
(9, 2, 'sodelavec', '2007-01-23 00:00:00'),
(9, 5, NULL, '2007-01-23 00:00:00'),
(10, 2, 'svetovalec', '2007-01-02 00:00:00'),
(10, 10, 'vodja', '2007-01-28 00:00:00'),
(11, 2, 'svetovalec', '2007-01-02 00:00:00'),
(11, 10, 'sodelavec', '2007-01-02 00:00:00'),
(12, 10, 'sodelavec', '2007-01-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `uporabnik`
--

CREATE TABLE `uporabnik` (
  `id` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Dumping data for table `uporabnik`
--

INSERT INTO `uporabnik` (`id`, `email`, `password`) VALUES
(1, 'uporabnik@primer.com', 'geslo'),
(4, 'hameactros@gmail.com', 'mercedes'),
(5, 'medzid.salkanovic.5@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delavec`
--
ALTER TABLE `delavec`
  ADD PRIMARY KEY (`id_delavec`),
  ADD KEY `id_podjetje` (`id_podjetje`);

--
-- Indexes for table `podjetje`
--
ALTER TABLE `podjetje`
  ADD PRIMARY KEY (`id_podjetje`);

--
-- Indexes for table `projekt`
--
ALTER TABLE `projekt`
  ADD PRIMARY KEY (`id_projekt`);

--
-- Indexes for table `sodeluje`
--
ALTER TABLE `sodeluje`
  ADD PRIMARY KEY (`id_delavec`,`id_projekt`),
  ADD KEY `id_projekt` (`id_projekt`);

--
-- Indexes for table `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delavec`
--
ALTER TABLE `delavec`
  MODIFY `id_delavec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `podjetje`
--
ALTER TABLE `podjetje`
  MODIFY `id_podjetje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20998;

--
-- AUTO_INCREMENT for table `projekt`
--
ALTER TABLE `projekt`
  MODIFY `id_projekt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delavec`
--
ALTER TABLE `delavec`
  ADD CONSTRAINT `delavec_ibfk_1` FOREIGN KEY (`id_podjetje`) REFERENCES `podjetje` (`id_podjetje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sodeluje`
--
ALTER TABLE `sodeluje`
  ADD CONSTRAINT `sodeluje_ibfk_1` FOREIGN KEY (`id_delavec`) REFERENCES `delavec` (`id_delavec`),
  ADD CONSTRAINT `sodeluje_ibfk_2` FOREIGN KEY (`id_projekt`) REFERENCES `projekt` (`id_projekt`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
