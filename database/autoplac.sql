-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 12:18 PM
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
-- Database: `autoplac`
--

-- --------------------------------------------------------

--
-- Table structure for table `narudzbina`
--

CREATE TABLE `narudzbina` (
  `user_id` int(11) NOT NULL,
  `oglas_id` int(11) NOT NULL,
  `dan_narucivanja` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oglasi`
--

CREATE TABLE `oglasi` (
  `id` int(11) NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `opis` text DEFAULT NULL,
  `marka` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `godina` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `kilometraza` int(11) DEFAULT NULL,
  `url_slike` varchar(255) DEFAULT NULL,
  `datum_kreiranja` timestamp NOT NULL DEFAULT current_timestamp(),
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `kreator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oglasi`
--

INSERT INTO `oglasi` (`id`, `naslov`, `opis`, `marka`, `model`, `godina`, `cena`, `kilometraza`, `url_slike`, `datum_kreiranja`, `premium`, `kreator_id`) VALUES
(1, 'UNIKAT!! JEDAN U SVETUU!! ŽOPE 206!!!', 'Najjaci auto na svetu', 'Peugeot', '206', 2024, '500000.00', 24, 'zope.jpg', '2024-03-13 17:03:56', 1, 5),
(2, 'PREMIUM!! Opel Astra H GTC!!', 'ko nov', 'Opel', 'Astra H', 2018, '20000.00', 12483, 'Terzina astra.jpg', '2024-03-13 17:06:06', 1, 5),
(3, 'PREMIUM!! VW Golf 4 sa opremom iz 2024. godine!!', 'Ambijentalno, multimedija, grejaci sedista,\ndigitalna klima, automatska svetla, karbonski enterijer', 'Volkswagen', 'Golf 4', 2016, '10000.00', 54386, 'golfic.jpg', '2024-03-13 17:10:51', 1, 5),
(4, 'Prosecan Golf 7!! lep mu spojler :)', 'Kul auto al bolja cetvorka', 'Volkswagen', 'Golf 7', 2015, '2000.00', 103386, 'golf.jpg', '2024-03-13 17:13:05', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(5, 'miksi.rankovic@gmail.com', 'MiksaGas', '$2y$10$cHv5Eu0zF9lo6C6MKY/seuxbJIe9neVEXH3HA.ykLcRtY16JQfIzq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `narudzbina`
--
ALTER TABLE `narudzbina`
  ADD PRIMARY KEY (`user_id`,`oglas_id`),
  ADD KEY `oglas_id` (`oglas_id`);

--
-- Indexes for table `oglasi`
--
ALTER TABLE `oglasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kreator_id` (`kreator_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Postoji` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oglasi`
--
ALTER TABLE `oglasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `narudzbina`
--
ALTER TABLE `narudzbina`
  ADD CONSTRAINT `narudzbina_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `narudzbina_ibfk_2` FOREIGN KEY (`oglas_id`) REFERENCES `oglasi` (`id`);

--
-- Constraints for table `oglasi`
--
ALTER TABLE `oglasi`
  ADD CONSTRAINT `oglasi_ibfk_1` FOREIGN KEY (`kreator_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
