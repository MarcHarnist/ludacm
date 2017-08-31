-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Client :  marcharnssmarc.mysql.db
-- Généré le :  Dim 06 Août 2017 à 00:07
-- Version du serveur :  5.6.34-log
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `marcharnssmarc`
--

-- --------------------------------------------------------

--
-- Structure de la table `personnages`
--

CREATE TABLE IF NOT EXISTS `personnages` (
  `id` smallint(5) unsigned NOT NULL,
  `nom` varchar(50) NOT NULL,
  `forcePerso` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `degats` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `niveau` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `experience` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `personnages`
--

INSERT INTO `personnages` (`id`, `nom`, `forcePerso`, `degats`, `niveau`, `experience`) VALUES
(1, 'Marc', 0, 10, 0, 0),
(2, 'Vercingétorix', 0, 50, 0, 0),
(8, 'Julie', 0, 15, 0, 0),
(4, 'Tom', 0, 30, 0, 0),
(5, 'Tomy', 0, 25, 0, 0),
(6, 'Jules Cesar', 0, 80, 0, 0),
(7, 'Marc-de-Niort', 0, 20, 0, 0),
(9, 'Tomas', 0, 20, 0, 0),
(10, 'Juliette', 0, 30, 0, 0),
(11, 'Marcel', 0, 15, 0, 0),
(12, 'Marc-Antoine', 0, 20, 0, 0),
(13, 'Marcelin', 0, 10, 0, 0),
(14, 'Brutus', 0, 10, 0, 0),
(15, 'Hermann', 0, 5, 0, 0),
(16, 'Tomily', 0, 0, 0, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `personnages`
--
ALTER TABLE `personnages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `personnages`
--
ALTER TABLE `personnages`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
