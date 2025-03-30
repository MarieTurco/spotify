-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 30 mars 2025 à 11:59
-- Version du serveur : 8.0.41-0ubuntu0.22.04.1
-- Version de PHP : 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `spotify`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `id` int NOT NULL,
  `artist_id` tinyint NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `picture` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `spotify_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`id`, `artist_id`, `name`, `description`, `picture`, `created`, `modified`, `spotify_url`) VALUES
(2, 3, 'Divide', 'L\'album acclamé par la critique d\'Ed Sheeran, avec des titres comme \"Shape of You\" et \"Castle on the Hill\".', '', '2025-03-25 10:39:29', '2025-03-25 13:04:35', '3T4tUhGYeRNVUGevb0wThu'),
(3, 4, '25', 'Le dernier album d\\\'Adele, qui a captivé le monde avec des ballades émouvantes comme \"Hello\"', '', '2025-03-25 10:39:45', '2025-03-25 13:25:24', '6TVfiWmo8KtflUAmkK9gGF'),
(4, 5, 'En passant', 'Un album iconique de Jean-Jacques Goldman avec des chansons inoubliables comme \"Quand la musique est bonne\"', '', '2025-03-25 10:40:03', '2025-03-25 13:03:46', '3Z4uAMHKOdut4Cvx9NemEs'),
(6, 4, '30', NULL, NULL, '2025-03-30 08:31:22', '2025-03-30 08:31:22', '21jF5jlMtzo94wbxmJ18aa'),
(7, 13, '7', '', '', '2025-03-30 11:29:58', '2025-03-30 11:29:58', '5rbJtzuXtpIP0Ykk7ewIit'),
(8, 13, 'Listen', '', '', '2025-03-30 11:30:20', '2025-03-30 11:30:20', '77UW17CZFyCaRLHdHeofZu');

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

CREATE TABLE `artists` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `bio` text,
  `picture` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `spotify_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `name`, `bio`, `picture`, `created`, `modified`, `spotify_url`) VALUES
(3, 'Ed Sheeran', 'Ed Sheeran est un auteur-compositeur-interprète britannique connu pour ses tubes mondiaux tels que \"Shape of You\", \"Castle on the Hill\" et \"Perfect\". Il a acquis une renommée internationale avec sa voix soul et ses paroles sincères.', '', '2025-03-25 10:11:39', '2025-03-25 13:28:22', '6eUKZXaKkcviH0Ku9w2n3V'),
(4, 'Adele', 'Adele est une chanteuse et auteure-compositrice britannique, célèbre pour sa voix puissante et ses ballades émotionnelles. Ses albums, notamment \"21\" et \"25\", lui ont valu de nombreux prix, dont plusieurs Grammy Awards. Des chansons comme \"Someone Like You\" et \"Hello\" sont devenues des succès mondiaux.', '', '2025-03-25 10:11:58', '2025-03-25 13:27:36', '4dpARuHxo51G3z768sgnrY'),
(5, 'JJ Goldman', 'Jean-Jacques Goldman, surnommé JJ Goldman, est un chanteur, auteur-compositeur et musicien français. Avec une carrière de plus de quatre décennies, il est l\'un des artistes les plus populaires et respectés de France, connu pour des chansons comme \"Je te promets\" et \"Quand la musique est bonne\".', '', '2025-03-25 10:13:10', '2025-03-25 13:27:13', '2Cx19OTMqa6gpz2l60cGG2'),
(12, 'Taylor Swift', NULL, NULL, '2025-03-30 08:43:12', '2025-03-30 08:43:12', '06HL4z0CvFAxyc27GXpf02'),
(13, 'David Guetta', 'Célèbre DJ', '', '2025-03-30 11:29:36', '2025-03-30 11:29:36', '1Cs0zKBU1kc0i8ypK3B9ai');

-- --------------------------------------------------------

--
-- Structure de la table `asks`
--

CREATE TABLE `asks` (
  `id` int NOT NULL,
  `user_id` tinyint NOT NULL,
  `target_type` varchar(255) NOT NULL,
  `spotify_url` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `artist_id` tinyint DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `asks`
--

INSERT INTO `asks` (`id`, `user_id`, `target_type`, `spotify_url`, `message`, `artist_id`, `status`, `created`, `modified`) VALUES
(2, 8, 'album', '21jF5jlMtzo94wbxmJ18aa', '30', 4, 'Validée', '2025-03-30 08:28:08', '2025-03-30 08:31:22'),
(4, 7, 'artist', '06HL4z0CvFAxyc27GXpf02', 'Taylor Swift', NULL, 'Validée', '2025-03-30 08:42:29', '2025-03-30 08:43:12');

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `target_id` tinyint NOT NULL,
  `target_type` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `target_id`, `target_type`, `created`, `modified`) VALUES
(19, '7', 3, 'artist', '2025-03-27 21:27:51', '2025-03-27 21:27:51'),
(23, '7', 2, 'album', '2025-03-27 22:29:14', '2025-03-27 22:29:14'),
(28, '8', 2, 'album', '2025-03-29 14:51:10', '2025-03-29 14:51:10'),
(29, '7', 4, 'artist', '2025-03-29 15:52:53', '2025-03-29 15:52:53'),
(30, '10', 8, 'album', '2025-03-30 11:30:36', '2025-03-30 11:30:36'),
(31, '10', 4, 'album', '2025-03-30 11:30:37', '2025-03-30 11:30:37'),
(32, '10', 2, 'album', '2025-03-30 11:30:39', '2025-03-30 11:30:39'),
(33, '10', 12, 'artist', '2025-03-30 11:30:42', '2025-03-30 11:30:42'),
(34, '10', 4, 'artist', '2025-03-30 11:30:42', '2025-03-30 11:30:42'),
(35, '14', 6, 'album', '2025-03-30 11:30:53', '2025-03-30 11:30:53'),
(36, '14', 7, 'album', '2025-03-30 11:30:54', '2025-03-30 11:30:54'),
(37, '14', 8, 'album', '2025-03-30 11:30:55', '2025-03-30 11:30:55'),
(38, '14', 5, 'artist', '2025-03-30 11:31:04', '2025-03-30 11:31:04'),
(39, '14', 12, 'artist', '2025-03-30 11:31:05', '2025-03-30 11:31:05'),
(40, '13', 6, 'album', '2025-03-30 11:31:21', '2025-03-30 11:31:21'),
(41, '13', 3, 'artist', '2025-03-30 11:31:24', '2025-03-30 11:31:24'),
(42, '13', 4, 'artist', '2025-03-30 11:31:25', '2025-03-30 11:31:25'),
(43, '13', 13, 'artist', '2025-03-30 11:31:27', '2025-03-30 11:31:27'),
(44, '11', 4, 'artist', '2025-03-30 11:31:35', '2025-03-30 11:31:35'),
(45, '11', 13, 'artist', '2025-03-30 11:31:36', '2025-03-30 11:31:36'),
(46, '11', 3, 'artist', '2025-03-30 11:31:38', '2025-03-30 11:31:38'),
(47, '11', 2, 'album', '2025-03-30 11:31:42', '2025-03-30 11:31:42'),
(48, '12', 7, 'album', '2025-03-30 11:31:51', '2025-03-30 11:31:51'),
(49, '12', 8, 'album', '2025-03-30 11:31:52', '2025-03-30 11:31:52'),
(50, '12', 5, 'artist', '2025-03-30 11:31:56', '2025-03-30 11:31:56'),
(51, '12', 4, 'artist', '2025-03-30 11:31:57', '2025-03-30 11:31:57'),
(52, '12', 3, 'artist', '2025-03-30 11:32:03', '2025-03-30 11:32:03'),
(53, '12', 12, 'artist', '2025-03-30 11:32:03', '2025-03-30 11:32:03'),
(54, '12', 13, 'artist', '2025-03-30 11:32:04', '2025-03-30 11:32:04');

-- --------------------------------------------------------

--
-- Structure de la table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20250324110818, 'CreateUsers', '2025-03-24 13:10:52', '2025-03-24 13:10:52', 0),
(20250324112657, 'CreateArtists', '2025-03-24 13:10:52', '2025-03-24 13:10:52', 0),
(20250324112706, 'CreateUsersArtists', '2025-03-24 13:10:52', '2025-03-24 13:10:52', 0),
(20250324112826, 'CreateAlbums', '2025-03-24 13:10:52', '2025-03-24 13:10:52', 0),
(20250324112847, 'CreateUsersAlbums', '2025-03-24 13:10:52', '2025-03-24 13:10:52', 0),
(20250324113018, 'CreateFavorites', '2025-03-24 13:10:52', '2025-03-24 13:10:52', 0),
(20250324113059, 'CreateAsks', '2025-03-24 13:10:52', '2025-03-24 13:10:52', 0),
(20250325124907, 'AddSpotifyUrlToArtists', '2025-03-25 12:49:36', '2025-03-25 12:49:36', 0),
(20250325124912, 'AddSpotifyUrlToAlbums', '2025-03-25 12:49:36', '2025-03-25 12:49:36', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pseudo`, `role`, `created`, `modified`) VALUES
(7, 'asato@test.com', '$2y$10$bi7AV3fB0OfghCtcHGJZB.9sUVdgHW9PJTTGI7Q6085W0HcGHCXym', 'Asato', 'user', '2025-03-24 15:38:55', '2025-03-24 15:38:55'),
(8, 'mtest@test.com', '$2y$10$PmJZNZ8hLszd17icGr8vrOKItFdNHhw4A1LyyzUyRZARo9sha7Phq', 'M@rie', 'admin', '2025-03-28 11:04:33', '2025-03-28 11:04:33'),
(9, 'test@test.com', '$2y$10$MunBamznzy9HbD/M.jsW5ejRToSr3GltIk90HqXkk5djlIDVvxwzC', 'Bernou', 'user', '2025-03-30 11:24:30', '2025-03-30 11:24:30'),
(10, 'test2@test.com', '$2y$10$3RSRdXJb2V.wKlFy7JjJW.yZfpYUnyGPND.tBU1fKZJYHisoXUltq', 'Shorty', 'user', '2025-03-30 11:24:54', '2025-03-30 11:24:54'),
(11, 'test3@test.com', '$2y$10$fg1NQw3vJbxs.QQOSAdI6.NziBHVMD0iL9bgLndoTbCMgdFQ3I556', 'Link_Loup', 'user', '2025-03-30 11:25:13', '2025-03-30 11:25:13'),
(12, 'test4@test.com', '$2y$10$BZW6oZFwsECbP5VAj/Znwe2JhauaS8ctCaQRhEsPRGF6P8Tw0W6cy', 'Nivek', 'user', '2025-03-30 11:25:30', '2025-03-30 11:25:30'),
(13, 'test5@test.com', '$2y$10$fBixZS6ns.oTxRFmm4brRO/LpvZdXG8g4hmy8DlIO7ypiygMgKIhG', 'Daphar', 'user', '2025-03-30 11:27:45', '2025-03-30 11:27:45'),
(14, 'test6@test.com', '$2y$10$qdBOBlka92xmToc/Pg5vkuBg.3ge8FZ/SHINVs6YmRphsNSiOa5aK', 'elgoz', 'user', '2025-03-30 11:28:02', '2025-03-30 11:28:02');

-- --------------------------------------------------------

--
-- Structure de la table `users_albums`
--

CREATE TABLE `users_albums` (
  `id` int NOT NULL,
  `user_id` tinyint NOT NULL,
  `album_id` tinyint NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users_artists`
--

CREATE TABLE `users_artists` (
  `id` int NOT NULL,
  `user_id` tinyint NOT NULL,
  `artist_id` tinyint NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `asks`
--
ALTER TABLE `asks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_albums`
--
ALTER TABLE `users_albums`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_artists`
--
ALTER TABLE `users_artists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `asks`
--
ALTER TABLE `asks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users_albums`
--
ALTER TABLE `users_albums`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users_artists`
--
ALTER TABLE `users_artists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
