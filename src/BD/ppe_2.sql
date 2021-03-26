-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2021 at 09:08 AM
-- Server version: 10.3.27-MariaDB-1:10.3.27+maria~stretch
-- PHP Version: 7.3.25-1+0~20201130.73+debian9~1.gbp042074

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppe`
--

-- --------------------------------------------------------

--
-- Table structure for table `codage`
--

CREATE TABLE `codage` (
  `id` int(11) NOT NULL,
  `idlangage` int(11) NOT NULL,
  `emailDeveloppeur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `codage`
--

INSERT INTO `codage` (`id`, `idlangage`, `emailDeveloppeur`) VALUES
(1, 1, 'test@test'),
(6, 4, 'test@test'),
(8, 10, 'test@test');

-- --------------------------------------------------------

--
-- Table structure for table `langage`
--

CREATE TABLE `langage` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `langage`
--

INSERT INTO `langage` (`id`, `libelle`) VALUES
(1, 'PHP'),
(4, 'python'),
(9, 'asics'),
(10, 'Ruby'),
(11, 'Node js');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `libelle`) VALUES
(1, 'administrateur'),
(2, 'utilisateur'),
(3, 'nonActif');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idrole` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `uniqid` varchar(13) NOT NULL,
  `date` varchar(20) NOT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idrole`, `nom`, `prenom`, `email`, `mdp`, `uniqid`, `date`, `photo`) VALUES
(2, 'ad', 'ad', 'antoine.dumont2@epsi.fr', '$2y$10$oLqTaNwUUKofsHJSga0bIu.6f6XNdJt5PnOGqpEJ/cvjiDoakIkZi', '605da3e802aca', '2021-03-26 09:05:44', 'profilvide.png'),
(1, 'aze', 'aze', 'test@gmail', '$2y$10$hrC9XXgRwENvb05UpSPATe4NXQ/5PCOvRe9Xqw3U2KzyhST27UEYC', '0', '', ''),
(1, 'test', 'test', 'test@test', '$2y$10$Aop802s9OHZ9BoOEgriWu.0v5Kr2tpm9cO0vuOCMeigaV6e1dUhAi', '5e60dd926e525', '2020-03-05 11:08:02', 'PNG_transparency_demonstration_1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codage`
--
ALTER TABLE `codage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idlangage` (`idlangage`),
  ADD KEY `iddeveloppeur` (`emailDeveloppeur`);

--
-- Indexes for table `langage`
--
ALTER TABLE `langage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email`),
  ADD KEY `idrole` (`idrole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codage`
--
ALTER TABLE `codage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `langage`
--
ALTER TABLE `langage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `codage`
--
ALTER TABLE `codage`
  ADD CONSTRAINT `codage_ibfk_1` FOREIGN KEY (`idlangage`) REFERENCES `langage` (`id`),
  ADD CONSTRAINT `codage_ibfk_2` FOREIGN KEY (`emailDeveloppeur`) REFERENCES `utilisateur` (`email`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idrole`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
