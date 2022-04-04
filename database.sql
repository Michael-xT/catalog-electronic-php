-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2022 at 06:33 PM
-- Server version: 10.3.31-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `absente`
--

CREATE TABLE `absente` (
  `ID` int(11) NOT NULL,
  `Nume` text NOT NULL,
  `Absenta` text NOT NULL,
  `Materie` int(11) NOT NULL DEFAULT 1,
  `Motiv` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Actualizari`
--

CREATE TABLE `Actualizari` (
  `ID` int(11) NOT NULL,
  `UpdateVersion` text NOT NULL,
  `Content` text NOT NULL,
  `Data` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Actualizari`
--

INSERT INTO `Actualizari` (`ID`, `UpdateVersion`, `Content`, `Data`) VALUES
(2, 'Orarul Clasei', '<p>Am adaugat orarul clasei a X-a X, il puteti accesa cu un click pe butonul &quot;Orarul clasei mele&quot;.</p>', '2017-11-07 16:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `anunturi`
--

CREATE TABLE `anunturi` (
  `ID` int(11) NOT NULL,
  `UpdateVersion` varchar(15) NOT NULL,
  `Content` text NOT NULL,
  `Author` varchar(20) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anunturi`
--

INSERT INTO `anunturi` (`ID`, `UpdateVersion`, `Content`, `Author`, `Time`) VALUES
(1, 'Catalog', '<p>De astazi, 27 Octombrie 2017, intra in folosinta Catalogul Electronic(Catalogul Online).</p><p>Ce vor putea parintii sa vada aici? Ei bine:</p><ol><li>Notele</li><li>Absentele (Motivate/Nemotivate)</li><li>Alte anunturi.</li></ol><p>Vor exista actualizari pe partea de Catalog destul de rare, daca intampinati probleme va rugam sa le transmiteti pe grupul parintilor. Numai bine!</p>', '1', '2017-10-27 18:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `conectari`
--

CREATE TABLE `conectari` (
  `ID` int(11) NOT NULL,
  `Nume` text NOT NULL,
  `Data` timestamp NOT NULL DEFAULT current_timestamp(),
  `IP` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversatii`
--

CREATE TABLE `conversatii` (
  `ID` int(11) NOT NULL,
  `nume` text NOT NULL,
  `text` text NOT NULL,
  `Data` timestamp NOT NULL DEFAULT current_timestamp(),
  `Elev` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `ID` int(11) NOT NULL,
  `Nume` text NOT NULL,
  `Nota` text NOT NULL,
  `Data` text NOT NULL,
  `Materie` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `updatenote`
--

CREATE TABLE `updatenote` (
  `ID` int(11) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updatenote`
--

INSERT INTO `updatenote` (`ID`, `Data`) VALUES
(1, '2017-03-03 17:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Admin` int(2) NOT NULL DEFAULT 0,
  `clasa` int(11) NOT NULL DEFAULT 9,
  `nrclasa` text NOT NULL,
  `Sex` int(2) NOT NULL DEFAULT 0,
  `Email` varchar(50) NOT NULL DEFAULT 'email@yahoo.com',
  `Telefon` varchar(11) NOT NULL DEFAULT '07xxxxxxxx'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `Admin`, `clasa`, `nrclasa`, `Sex`, `Email`, `Telefon`) VALUES
(1, 'admin', '098f6bcd4621d373cade4e832627b4f6', 5, 12, 'X', 1, 'admin@suntstudent.ro', '07xxxxxxxx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absente`
--
ALTER TABLE `absente`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Actualizari`
--
ALTER TABLE `Actualizari`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `anunturi`
--
ALTER TABLE `anunturi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `conectari`
--
ALTER TABLE `conectari`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `conversatii`
--
ALTER TABLE `conversatii`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `updatenote`
--
ALTER TABLE `updatenote`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Actualizari`
--
ALTER TABLE `Actualizari`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `anunturi`
--
ALTER TABLE `anunturi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `conversatii`
--
ALTER TABLE `conversatii`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `updatenote`
--
ALTER TABLE `updatenote`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
