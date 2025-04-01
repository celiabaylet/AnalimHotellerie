-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 29 mars 2025 à 17:03
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `analim`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomActivite` varchar(50) COLLATE utf8_bin NOT NULL,
  `prixActivite` double NOT NULL,
  `date` date NOT NULL,
  `horaire` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `congressiste`
--

DROP TABLE IF EXISTS `congressiste`;
CREATE TABLE IF NOT EXISTS `congressiste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(100) COLLATE utf8_bin NOT NULL,
  `mail` varchar(50) COLLATE utf8_bin NOT NULL,
  `petitDej` tinyint(1) DEFAULT NULL,
  `ville` varchar(100) COLLATE utf8_bin NOT NULL,
  `tel` varchar(50) COLLATE utf8_bin NOT NULL,
  `codePostal` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_Hotel` int(11) DEFAULT NULL,
  `id_Organisme` int(11) DEFAULT NULL,
  `nbEtoilesVoulues` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Congressiste_Hotel_FK` (`id_Hotel`),
  KEY `Congressiste_Organisme0_FK` (`id_Organisme`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `congressiste`
--

INSERT INTO `congressiste` (`id`, `nom`, `prenom`, `adresse`, `mail`, `petitDej`, `ville`, `tel`, `codePostal`, `id_Hotel`, `id_Organisme`, `nbEtoilesVoulues`) VALUES
(1, 'dupond', 'emma', 'rue des lilas', 'emmad@gmail.com', 1, 'limogesss', '0711111113', '87150', 1, NULL, 0),
(3, 'dupond', 'marcel', 'rue des fleurs', 'marcel.durand@gmail.com', 1, 'saint junien ', '0733333333', '87200', 1, NULL, 1),
(4, 'DUPONT', 'agathe', 'rue de saint jacques', 'agathe@gmail.com', 1, 'aixe sur vienne', '0744444444', '87700', 3, NULL, 3),
(5, 'TEST', 'agathe', 'rue testtttt', 'test@gmail.com', 1, 'limoges', '0777777777', '33000', 1, NULL, 0),
(6, 'BERNARD', 'alex', 'rue des arbres', 'alex@gmail.com', 0, 'limoges', '0777777997', '87100', 1, NULL, 1),
(7, 'MARTIN', 'Lilou', 'rue des gagnants', 'lilou@gmail.com', NULL, 'limoges', '0777777123', '87200', NULL, NULL, 1),
(8, 'MORGADO', 'david', 'rue des fleurs', 'david@gmail.com', 0, 'limoges', '0666666661', '87000', NULL, NULL, 0),
(9, 'GERARD', 'philippe', 'rue des abricots', 'philippe@gmail.com', 0, 'bordeaux', '0666666666', '33000', NULL, NULL, 0),
(10, 'Bourgeois', 'Agnes', 'rue des lilas', 'bourgeois@gmail.com', 0, 'limoges', '0666666662', '87000', NULL, NULL, 0),
(11, 'Abric', 'Maxence', 'rue des thuyas', 'maxence@gmail.com', 0, 'limoges', '0666666663', '87000', NULL, NULL, 0),
(12, 'baylet', 'celia', 'rue des sapins', 'celia@gmail.com', 0, 'limoges', '0666666665', '87100', NULL, NULL, 0),
(13, 'segalat', 'adrien', 'rue des oiseaux', 'adrien@gmail.com', 0, 'limoges', '0666666664', '87000', NULL, NULL, 0),
(14, 'teillou', 'logan', 'rue des arbustres', 'logan@gmail.com', 0, 'limoges', '0666666668', '87000', NULL, NULL, 0),
(15, 'DUPONT', 'Mathilde', 'rue des arbres', 'mathilde@gmail.com', 0, 'paris', '0666666610', '78000', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `numFacture` int(11) NOT NULL AUTO_INCREMENT,
  `Payement` tinyint(1) NOT NULL,
  `impression` tinyint(1) NOT NULL,
  `dateFacture` date NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`numFacture`),
  UNIQUE KEY `Facture_Congressiste_AK` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomHotel` varchar(50) COLLATE utf8_bin NOT NULL,
  `prixParticipant` double NOT NULL,
  `prixPetitDej` double NOT NULL,
  `adresseHotel` varchar(50) COLLATE utf8_bin NOT NULL,
  `ville` varchar(50) COLLATE utf8_bin NOT NULL,
  `codePostal` varchar(50) COLLATE utf8_bin NOT NULL,
  `nbEtoiles` int(11) NOT NULL,
  `nbChambresPrises` int(11) NOT NULL,
  `nbChambresTotales` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `hotel`
--

INSERT INTO `hotel` (`id`, `nomHotel`, `prixParticipant`, `prixPetitDej`, `adresseHotel`, `ville`, `codePostal`, `nbEtoiles`, `nbChambresPrises`, `nbChambresTotales`) VALUES
(1, 'Lhotel Parfait', 158, 18, '15 rue des Lilas', 'Saint Junien', '87200', 3, 0, 200),
(3, 'test', 15, 15, '12 rue test', 'Bordeaux', '87555', 4, 0, 20000),
(4, 'test2', 605, 20, '12 rue test', 'Bordeaux', '87555', 5, 0, 20000),
(5, 'L\'hotel Parfait', 160, 46, '15 rue test', 'fzdcsx', '87555', 4, 0, 20000),
(6, 'test', 596, 41, 'ffchbv', 'limogess', '87000', 3, 0, 56),
(7, 'Le Meilleur Hotel', 564, 39, 'rue des paquerettes', 'Bordeaux', '33000', 5, 0, 100),
(8, 'AZERDGTHFY', 85969, 54, 'frdkjlvbdfs', 'zdefrgth', '52555', 3, 0, 202);

-- --------------------------------------------------------

--
-- Structure de la table `listeparticipantsact`
--

DROP TABLE IF EXISTS `listeparticipantsact`;
CREATE TABLE IF NOT EXISTS `listeparticipantsact` (
  `id` int(11) NOT NULL,
  `id_Congressiste` int(11) NOT NULL,
  `nombreAccompagnants` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_Congressiste`),
  KEY `ListeParticipantsAct_Congressiste0_FK` (`id_Congressiste`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `listeparticipantsses`
--

DROP TABLE IF EXISTS `listeparticipantsses`;
CREATE TABLE IF NOT EXISTS `listeparticipantsses` (
  `id` int(11) NOT NULL,
  `id_Session` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_Session`),
  KEY `ListeParticipantsSes_Session0_FK` (`id_Session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `organisme`
--

DROP TABLE IF EXISTS `organisme`;
CREATE TABLE IF NOT EXISTS `organisme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `domaineActivite` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomSession` varchar(50) COLLATE utf8_bin NOT NULL,
  `prixSession` double NOT NULL,
  `date` date NOT NULL,
  `horaire` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `congressiste`
--
ALTER TABLE `congressiste`
  ADD CONSTRAINT `Congressiste_Hotel_FK` FOREIGN KEY (`id_Hotel`) REFERENCES `hotel` (`id`),
  ADD CONSTRAINT `Congressiste_Organisme0_FK` FOREIGN KEY (`id_Organisme`) REFERENCES `organisme` (`id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `Facture_Congressiste_FK` FOREIGN KEY (`id`) REFERENCES `congressiste` (`id`);

--
-- Contraintes pour la table `listeparticipantsact`
--
ALTER TABLE `listeparticipantsact`
  ADD CONSTRAINT `ListeParticipantsAct_Activites_FK` FOREIGN KEY (`id`) REFERENCES `activites` (`id`),
  ADD CONSTRAINT `ListeParticipantsAct_Congressiste0_FK` FOREIGN KEY (`id_Congressiste`) REFERENCES `congressiste` (`id`);

--
-- Contraintes pour la table `listeparticipantsses`
--
ALTER TABLE `listeparticipantsses`
  ADD CONSTRAINT `ListeParticipantsSes_Congressiste_FK` FOREIGN KEY (`id`) REFERENCES `congressiste` (`id`),
  ADD CONSTRAINT `ListeParticipantsSes_Session0_FK` FOREIGN KEY (`id_Session`) REFERENCES `session` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
