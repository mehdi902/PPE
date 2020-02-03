-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 16 Janvier 2020 à 10:27
-- Version du serveur :  10.1.41-MariaDB-0+deb9u1
-- Version de PHP :  7.3.10-1+0~20191008.45+debian9~1.gbp365209

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `PPE`
--

-- --------------------------------------------------------

--
-- Structure de la table `codage`
--

CREATE TABLE `codage` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `developpeur`
--

CREATE TABLE `developpeur` (
  `id` int(11) NOT NULL,
  `idcodage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `langage`
--

CREATE TABLE `langage` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `idcodage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `libelle`) VALUES
(1, 'administrateur'),
(2, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idrole` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `iddeveloppeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idrole`, `nom`, `prenom`, `email`, `mdp`, `iddeveloppeur`) VALUES
(1, 'aze', 'aze', 'azeeeaaa@gmail', '$2y$10$4h7osfqk.Qwu7zr9aOusKuU5849WPFgnlF8bwe9tYE6d1u.fjNCem', 0),
(1, 'aze', 'aze', 'azerrsdxdf@gm', '$2y$10$f6WB.YbMMV.8FTvtVslsW.N2AWqGnM581hxP.bsneS/7s6Qz4xrpi', 0),
(1, 'aze', 'aze', 'dsde@gfeke', '$2y$10$UlVZ0wLn5GRCa/u6K2dZ1.ar9dVs8foIFl/q5v2A3A3UeDbUrPwcS', 0),
(1, 'aze', 'aze', 'mehditimmerman915@gmail.com', '$2y$10$B37hn3c96zPJRyknGHIYieU/PLTAfkNgs4BK10xSoFsGa8ArVuf/S', 0),
(1, 'zer', 'zer', 'zer@mgg', '$2y$10$jWTLg8flESHaqYXKDlZUyut27PcIShJR706rhTL7h2syDb42oUZre', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `codage`
--
ALTER TABLE `codage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `developpeur`
--
ALTER TABLE `developpeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcodage` (`idcodage`);

--
-- Index pour la table `langage`
--
ALTER TABLE `langage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcodage` (`idcodage`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email`),
  ADD KEY `idrole` (`idrole`),
  ADD KEY `iddeveloppeur` (`iddeveloppeur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `codage`
--
ALTER TABLE `codage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `langage`
--
ALTER TABLE `langage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `developpeur`
--
ALTER TABLE `developpeur`
  ADD CONSTRAINT `developpeur_ibfk_2` FOREIGN KEY (`idcodage`) REFERENCES `codage` (`id`);

--
-- Contraintes pour la table `langage`
--
ALTER TABLE `langage`
  ADD CONSTRAINT `langage_ibfk_1` FOREIGN KEY (`idcodage`) REFERENCES `codage` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idrole`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
