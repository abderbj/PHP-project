-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 28 mars 2024 à 00:46
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

create or replace database carpooling;
use carpooling;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `carpooling`
--

-- --------------------------------------------------------

--
-- Structure de la table `rides`
--


CREATE TABLE `rides` (
  `id` int(11) NOT NULL,
  `places` int(11) NOT NULL,
  `departure` varchar(255) NOT NULL,
  `arrival` varchar(255) NOT NULL,
  `departure_time` TIMESTAMP  NOT NULL,
  `departure_date` date NOT NULL,
  `price` float(10) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phonenumber` int(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pfp_path` varchar(255) NOT NULL DEFAULT 'images/default.PNG',
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `rating`  float(10) NOT NULL DEFAULT 0,
  `nb_ratings` int(11) NOT NULL DEFAULT 0,
  `joined_id` int(11) DEFAULT NULL,
  `driving_id` int(11)DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

-- INSERT INTO `users` (`id`, `firstname`, `lastname`, `phonenumber`, `email`, `password`, `is_admin`, `activation_code`) VALUES
-- (1, '', 'majd', 546, 'majdoubsarah7@gmail.', '123', 0, ''),
-- (3, '', 'majd', 546, 'sarramajdoub5@gmail.', '123', 0, ''),
-- (7, 'amy', 'no', 15698, 'amyno@gmail.com', '123', 0, '');
--
-- Index pour les tables déchargées
--

--
-- Index pour la table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `rides`
--
ALTER TABLE `rides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54,
  ADD CONSTRAINT `rider_fk` FOREIGN KEY (`joined_id`) REFERENCES `rides` (`id`),
  ADD CONSTRAINT `driver_fk` FOREIGN KEY (`driving_id`) REFERENCES `rides` (`id`);

--
-- Contraintes pour les tables déchargées
--


-- Insert dummy data into the `rides` table
INSERT INTO `rides` (`id`, `places`, `departure`, `arrival`, `departure_time`, `departure_date`, `price`, `description`) VALUES
(1, 3, 'New York', 'Los Angeles', '2024-03-28 08:00:00', '2024-03-28', 50.00, 'Road trip across the country'),
(2, 2, 'San Francisco', 'Las Vegas', '2024-03-29 10:00:00', '2024-03-29', 30.00, 'Weekend getaway'),
(3, 4, 'Chicago', 'Miami', '2024-03-30 12:00:00', '2024-03-30', 80.00, 'Vacation with friends');

-- Insert dummy data into the `users` table
INSERT INTO `users` (`id`, `firstname`, `lastname`, `phonenumber`, `email`, `password`, `pfp_path`, `is_admin`, `rating`, `nb_ratings`, `joined_id`, `driving_id`) VALUES
(1, 'John', 'Doe', 1234567890, 'john.doe@example.com', 'password123', 'im/john.PNG', 0, 4.5, 10, 1, 2),
(2, 'Jane', 'Smith', 9876543210, 'jane.smith@example.com', 'password456', 'im/jane.PNG', 0, 4.2, 8, 2, 3),
(3, 'Mike', 'Johnson', 5555555555, 'mike.johnson@example.com', 'password789', 'im/mike.PNG', 1, 4.8, 12, 3, 1);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
