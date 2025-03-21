-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 21 mars 2025 à 22:48
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ordures`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis_reclamations`
--

DROP TABLE IF EXISTS `avis_reclamations`;
CREATE TABLE IF NOT EXISTS `avis_reclamations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `type` enum('avis','reclamation') NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT 'En attente',
  `is_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `avis_reclamations`
--

INSERT INTO `avis_reclamations` (`id`, `user_id`, `type`, `contenu`, `date_creation`, `status`, `is_read`) VALUES
(1, 1, 'reclamation', 'Problème', '2025-03-18 13:44:47', 'En cours', 0),
(2, 1, 'avis', 'Parfait', '2025-03-18 14:00:35', 'En attente', 0);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `read_at` timestamp NULL DEFAULT NULL,
  `type` enum('info','warning','success','error') DEFAULT 'info',
  `status` enum('non_lu','lu') DEFAULT 'non_lu',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `created_at`, `read_at`, `type`, `status`) VALUES
(1, 1, 'Votre réclamation a été mise à jour. Nouveau statut : En attente.', '2025-03-18 15:38:15', '2025-03-18 19:02:28', 'info', 'lu'),
(2, 1, 'Votre réclamation a été prise en compte. Nouveau statut : En cours.', '2025-03-18 19:14:53', NULL, 'info', 'lu');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Client','Admin','Gie') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Chacha Koné', '93889543', 'Zrny', 'banca@gmail.com', '$2y$10$jLNfv0jww9yg8fNDEUBvXepfSi.kb2q.G1SGO8Yzn9fNpz8AEk3za', 'Client', '2025-03-16 16:48:00'),
(2, 'Ibrahim', '75246196', 'Banconi', 'ibra@gmail.com', '$2y$10$A5I1Z0o.uaYF5OgXl/YAq.Lz640N.P5K5a0ZPYTk7WfGK6msQP.hS', 'Gie', '2025-03-16 17:44:34'),
(3, 'Admin', '0000', 'Admin', 'Admin@gmail.com', '$2y$10$r6XJ2Ft88B46NaWGmnaRYOlyfrVUSsYGwyg3F1LXU8hzY8LxmJetW', 'Admin', '2025-03-16 17:52:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
