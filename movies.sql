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
-- Structure de la table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `year` date NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `rate` int NOT NULL,
  `tag1` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tag2` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tag3` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int DEFAULT NULL,
  `username` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `image`, `name`, `year`, `type`, `rate`, `tag1`, `tag2`, `tag3`, `description`, `category_id`, `username`) VALUES
(2, './uploads/eye art.jpg', 'Eye ART', '2001-01-01', 'TT', 0, 'tt', 'tt', 'tt', 'tt\\r\\n', 4, 'artist'),
(3, './uploads/354251388_290366993440228_7207688574012180969_n.jpg', 'admin', '2023-12-15', 'hum', 0, 'sexy', 'aze', 'tfadlika', '785', 2, 'artist'),
(4, '../public/uploads/download.jpg', '687867', '7687-06-08', '68767', 0, '767', '6876878', '67687', '687687', 1, 'artist'),
(5, '../public/uploads/download.jpg', 'NEW MOVIE', '2001-01-01', '456465', 0, '65465', '45646', '5465', '4654654', 1, 'artist'),
(6, '../public/uploads/download.jpg', 'test', '2001-01-01', 'zeaz', 0, 'ezae', 'eza', 'eza', 'eza', 1, 'testing'),
(7, '../public/uploads/download.jpg', 'test', '2001-01-01', 'zaeaz', 0, 'eza', 'eza', 'eaz', 'eza', 1, 'artist'),
(8, '../public/uploads/download.jpg', 'test', '2001-01-01', 'zaeaz', 0, 'eza', 'eza', 'eaz', 'eza', 1, 'artist'),
(9, '../public/uploads/download.jpg', 'zaeaz', '1999-01-01', 'tt', 0, 'tt', 'tt', 'tt', 'tt', 1, 'artist'),
(10, '../public/uploads/download.jpg', 'zeza', '1999-01-01', 'azeaz', 0, 'eza', 'eaz', 'eaz', 'eaz', 1, 'artist'),
(11, '../public/uploads/download.jpg', 'tt', '1999-01-01', '1561', 0, '156165', '1651', '651651', 'zaza', 1, 'artist'),
(12, '../public/uploads/download.jpg', 'tt', '1999-01-01', '1561', 0, '156165', '1651', '651651', 'zaza', 1, 'artist'),
(13, '../public/uploads/download.jpg', 'tt', '1999-01-01', '1561', 0, '156165', '1651', '651651', 'zaza', 1, 'artist'),
(14, '../public/uploads/download.jpg', 'tt', '1999-01-01', '1561', 0, '156165', '1651', '651651', 'zaza', 1, 'artist'),
(15, '../public/uploads/download.jpg', 'zaeaz', '2001-01-01', 'zaeaz', 0, 'eza', 'eza', 'eaz', 'eza\r\n', 1, 'artist'),
(16, '../public/uploads/download.jpg', 'zeae', '0000-00-00', '56465', 0, 'zea', '654654', '654', '564', 1, 'artist'),
(17, '../public/uploads/download.jpg', 'zaeza', '5741-01-05', 'azeaz', 0, 'ezae', 'eza', 'eza', 'eaz', 1, 'artist'),
(18, '../public/uploads/download.jpg', 'zaeza', '5741-01-05', 'azeaz', 0, 'ezae', 'eza', 'eza', 'eaz', 1, 'artist'),
(19, '../public/uploads/download.jpg', 'zaeza', '5741-01-05', 'azeaz', 0, 'ezae', 'eza', 'eza', 'eaz', 1, 'artist'),
(20, '../public/uploads/download.jpg', 'zaeaz', '1999-01-01', 'zaeaz', 0, 'eza', 'eza', 'eza', 'eza', 1, 'artist'),
(21, '../public/uploads/download.jpg', 'zaeza', '2023-12-13', '7987', 0, '9879', '9879', '987', '98798', 1, 'artist'),
(22, '../public/uploads/download.jpg', 'zaeza', '2023-12-13', '7987', 0, '9879', '9879', '987', '98798', 1, 'artist'),
(23, '../public/uploads/download.jpg', 'zanoizaen', '5452-01-04', 'zeaz', 0, 'ezae', 'eza', 'eaz', 'eaz', 1, 'artist'),
(24, '../public/uploads/download.jpg', 'zaeza', '1999-01-01', '1561', 0, '1651', '165165', '1651', '165156', 1, 'artist'),
(25, '../public/uploads/download.jpg', 'zaeza', '1999-01-01', '1561', 0, '1651', '165165', '1651', '165156', 1, 'artist'),
(26, '../public/uploads/download.jpg', 'zaeza', '1999-01-01', '1561', 0, '1651', '165165', '1651', '165156', 1, 'artist'),
(27, '../public/uploads/download.jpg', 'ezaea', '1999-01-15', '4654', 0, '4654', '6546', '4654', '4654\r\n', 1, 'artist'),
(28, '../public/uploads/download.jpg', 'ezaea', '1999-01-15', '4654', 0, '4654', '6546', '4654', '4654\r\n', 1, 'artist'),
(29, '../public/uploads/eye art.jpg', 'esprit ', '2024-01-07', 'ghjk', 0, 'k', 'jj', 'vbn,;', 'xcvbn,', 2, 'khlifi'),
(30, '../public/uploads/about.jpg', 'hello', '2023-12-15', 'hello', 0, 'ohdzi', 'moidaz', 'ijdazd', 'ijdziazd', 2, 'testing'),
(31, '../public/uploads/property-2.jpg', 'hello', '2023-12-26', 'iazdu', 0, 'pijzc', 'kajd', 'paijd', 'opaidaa', 4, 'testing'),
(32, '../public/uploads/eye art.jpg', 'aez', '2024-01-07', 'azaaa', 0, 'aaa', 'aaa', 'aaa', 'aaaaa', 2, 'testing'),
(33, '../public/uploads/eye art.jpg', 'aya 3ad', '2023-12-31', 'aaaaaaaa', 0, 'aaaaaaaaaaaa', 'zaaaaaaaaaa', 'aaaa', 'aaaaaaaa', 4, 'testing'),
(34, '../public/uploads/eye art.jpg', 'esprit', '2023-12-30', 'art ', 0, 'art', 'art', 'art', 'esprit events d\'art ', 1, 'testing');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
