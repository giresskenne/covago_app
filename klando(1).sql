-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 13 déc. 2023 à 14:14
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `klando`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `texte` text NOT NULL,
  `dateComment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`texte`, `dateComment`) VALUES
(';;;;jjjjjj', '2023-12-12'),
('Merci pour cette super plateforme mise sur ppied', '2023-12-12');

-- --------------------------------------------------------

--
-- Structure de la table `journey`
--

CREATE TABLE `journey` (
  `id` int(11) NOT NULL,
  `immat` text NOT NULL,
  `marque` text NOT NULL,
  `model` text NOT NULL,
  `couleur` text NOT NULL,
  `nbPlaces` int(11) NOT NULL,
  `dateTravel` date NOT NULL,
  `lieuDep` text NOT NULL,
  `lieuArriv` text NOT NULL,
  `photo_1` text DEFAULT NULL,
  `photo_2` text DEFAULT NULL,
  `photo_3` text DEFAULT NULL,
  `postDate` date DEFAULT NULL,
  `heureDep` time NOT NULL,
  `emailChauffeur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `phoneNumber`, `password`, `roles`) VALUES
(1, 'tiotsopvaescadreny01@gmail.com', 123456789, '1c1f0ae88b5045bb302bffb7f023d5ea5afc235c', ''),
(2, 'tiotsopvany01@gmail.com', 123444777, '2444b220ee4d915d3e6f1a0a2db4b2275ee6a3e9', ''),
(3, 'tiotsopvany11101@gmail.com', 111444777, 'a21b7004d756e3aed9588723bfaf364e55da6e57', ''),
(4, 'tiotsopvany01@gmai11l.com', 654814503, 'e03f56322e9f0f434d83d4cbbcda2ccbcd613040', ''),
(5, 'tiotsopvany01@glkmail.com', 654814503, 'a74c1b3b1d531be846c709e811ab9697ad865185', ''),
(6, 'jopvany01@gmail.com', 654814503, 'f3d7fa4c38b350393599c07d9ed2e9f0a6827143', ''),
(7, 'jhbsopvany01@gmail.com', 654789652, '4bdf88e24c2ad41961ac57ea87a380aeffa7260f', ''),
(8, 'tiotsopvan22y01@gmail.com', 654814503, '9196c2605bb4f1aa89cfb01af98b452e566d2b18', ''),
(9, 'tiotsopva78ny01@gmail.com', 654814503, '161d489a658a58bb8b5a3b95b4f2085287174ccf', ''),
(10, 'tiotsopvCliqulany01@gmail.com', 987456210, '8b1debd200e15d6ef01b472c47ac38282f6901f6', ''),
(11, 'tiotsopvacny01@gmail.com', 645814503, 'ec3990bd24ba763a8933fb80f5ec808fd29a6e5b', ''),
(12, 'tiotsopvany01@gmail.comiv', 654847896, '685d6fbd83151033801d07156b70a0796aa187a3', ''),
(13, 'tiotsopvany01@gmail.commm', 654814522, 'e88d6aa2bb525883b395e98f9eee868ac8c74b33', ''),
(14, 'tiotsopvany01@gmail.cokkm', 654814503, '3613d0abdebb7c53c261644c14666a42d1e0964a', ''),
(15, 'tiotsopvanhghgh01@gmail.com', 654814503, 'ecec7fa3b5a7695e62df7b5c95bd57b4c02f42a5', ''),
(16, 'tiotsopvany01@gmnail.com', 123456789, 'cf4c13fd550f121f1debad392bb916436002f301', ''),
(17, 'tiotsopvanddy01@gmail.com', 789456123, '3a8501e72dc76538de39f32cb1fbdde802acd70b', ''),
(18, 'tiotsopvvvvany01@gmail.com', 654814503, 'b3e401a18b383b19d65b64b63acead03b9004b10', ''),
(19, 'Protsopvany01@gmail.com', 789456123, 'e377f892095bde3a83b53d4969eb7cb991efbf28', ''),
(20, 'tiotsopjjjvany01@gmail.com', 654812574, '00de983421f8692a69ff2e54724f0cb1c0d8c396', ''),
(21, 'tiotsopvammmny01@gmail.com', 654789123, '647dd17d540258512b03788416ef36e73c7a20cc', ''),
(22, 'tiotsopvakny01@gmail.com', 0, '9fb073487e9283181ca7fcc10d7454761595789b', ''),
(23, 'tioxtsopvany01@gmail.com', 0, '64d4ab5de1866a036bccf6dae779bdd50088fac8', ''),
(24, 'tiotsopva0ny01@gmail.com', 0, 'edd37b1ff92811d86a7bfb5a6f695432a547e219', ''),
(25, 'tiotsopvammny01@gmail.com', 654814503, 'af8a0b647b3b431a49583c56592a2437d6a2b7bf', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `journey`
--
ALTER TABLE `journey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emailChauffeur` (`emailChauffeur`);

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
-- AUTO_INCREMENT pour la table `journey`
--
ALTER TABLE `journey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
