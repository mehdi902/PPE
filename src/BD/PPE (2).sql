-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 27 Janvier 2020 à 10:10
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
  `id` int(11) NOT NULL,
  `idlangage` int(11) NOT NULL,
  `iddeveloppeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `developpeur`
--

CREATE TABLE `developpeur` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `langage`
--

CREATE TABLE `langage` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
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
(1, 'mehdi', 'timmerman', 'mehditimmerman@gmail.com', '$2y$10$pIWwyzNteo0Kz4UlOlCwluuVoeUikqsQeyZTmRTdvESaLj6xvJQ2W', 0),
(1, 'aze', 'aze', 'mpkohfdjogk@fff', '$2y$10$PEkzd8YL8NXbaFh9h2NQNuE7SkbDQ1T8wXQ.cXCEfikwUeL3VScLy', 0),
(1, 'aze', 'aze', 'plllllptkpyghk@gmail', '$2y$10$9MtlUlc7Kql0tlNrrOnJ6O5QB3NHPxYgN6nc0fl0zJtLyrnNrMWCO', 0),
(1, 'zzzzz', 'zzzzz', 'test2@gm', '$2y$10$f9LYf2ejGefJc1VnLw1nsewECnYMgXjzWMahe7qLzYd3m.SqxyItW', 0),
(1, 'aze', 'aze', 'test@gmail', '$2y$10$hrC9XXgRwENvb05UpSPATe4NXQ/5PCOvRe9Xqw3U2KzyhST27UEYC', 0),
(1, 'toto', 'toto', 'toto1@gmail.com', '$2y$10$BXStGbOQngKSUZ5UQVm34OLwc4pIs7Xrais8rVKcX0vxXi0/y3Mim', 0),
(1, 'aze', 'aze', 'toto@gmail.com', '$2y$10$5Eznfs3SX5FHhUaiATHYCe1WSElpbSxyMwR4u/pdTQH/cOD9XYmHy', 0),
(1, 'aze', 'aze', 'totoooooooo@gmail', '$2y$10$3YGyM/RVrCS878IZyP4sVO.X61tnCLY2yy25CLhyUSpdePc4at5sG', 0),
(1, 'aze', 'aze', 'tsssssss@ggg', '$2y$10$CkCIBfea7hBpreL77JGWWOeWaljtjZlwzDhNVfN21PYiLAoAII4.q', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `codage`
--
ALTER TABLE `codage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idlangage` (`idlangage`),
  ADD KEY `iddeveloppeur` (`iddeveloppeur`);

--
-- Index pour la table `developpeur`
--
ALTER TABLE `developpeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `langage`
--
ALTER TABLE `langage`
  ADD PRIMARY KEY (`id`);

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
-- Contraintes pour la table `codage`
--
ALTER TABLE `codage`
  ADD CONSTRAINT `codage_ibfk_1` FOREIGN KEY (`idlangage`) REFERENCES `langage` (`id`),
  ADD CONSTRAINT `codage_ibfk_2` FOREIGN KEY (`iddeveloppeur`) REFERENCES `developpeur` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idrole`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
