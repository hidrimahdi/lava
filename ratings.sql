-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 déc. 2023 à 16:33
-- Version du serveur : 8.0.31
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `events`
--

-- --------------------------------------------------------

--
-- Structure de la table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NOT NULL,
  `username` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ratings`
--

INSERT INTO `ratings` (`id`, `movie_id`, `username`, `rating`, `comment`) VALUES
(1, 2, 'visit', 0, 'zaeaz'),
(2, 2, 'visit', 5, 'parfait'),
(3, 2, 'visit', 5, 'zeae'),
(4, 4, 'testing', 4, 'parfait'),
(5, 4, 'testing', 0, 'parfait'),
(6, 4, 'khlifi', 5, 'sdtfuygvbhjnk,l'),
(7, 2, 'khlifi', 4, 'sdfghbjn,k'),
(8, 2, 'khlifi', 4, 'really helpful'),
(9, 7, 'testing', 5, 'nyaaahahahaa\r\n'),
(10, 2, 'testing', 5, 'ztzrtzertzet'),
(11, 2, 'testing', 5, 'azerazerazerazreazer'),
(12, 11, 'testing', 4, 'lundii ');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
