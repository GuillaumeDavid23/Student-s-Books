-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 24 sep. 2021 à 09:50
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `studentbook1`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences`
--

CREATE TABLE `absences` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_hour` time NOT NULL,
  `end_hour` time NOT NULL,
  `justification` varchar(40) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `drop_at` datetime DEFAULT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `absences`
--

INSERT INTO `absences` (`id`, `start_date`, `end_date`, `start_hour`, `end_hour`, `justification`, `create_at`, `update_at`, `drop_at`, `id_users`) VALUES
(1, '2021-08-25', '2021-08-26', '08:00:00', '12:00:00', 'Non justifiée', '2021-09-01 14:00:22', '2021-09-01 14:04:52', NULL, 1),
(2, '2021-09-07', '2021-09-08', '12:06:56', '22:06:56', 'J\'étais pas la !', '2021-09-09 12:07:43', '2021-09-09 12:07:43', '2021-09-09 10:06:54', 7);

-- --------------------------------------------------------

--
-- Structure de la table `assignements`
--

CREATE TABLE `assignements` (
  `id` int(11) NOT NULL,
  `end_date` date NOT NULL,
  `assignement` varchar(40) NOT NULL,
  `returnAssign` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `drop_at` datetime DEFAULT NULL,
  `id_classes` int(11) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `assignements`
--

INSERT INTO `assignements` (`id`, `end_date`, `assignement`, `returnAssign`, `create_at`, `update_at`, `drop_at`, `id_classes`, `id_users`) VALUES
(1, '2021-08-31', 'DS sur la vie', 0, '2021-08-26 12:32:43', '2021-09-21 13:50:03', NULL, 1, 6),
(3, '2021-08-27', 'Expression écrite', 1, '2021-08-26 16:09:29', '2021-09-21 13:56:33', NULL, 1, 6),
(7, '2021-09-16', 'DS Test', 0, '2021-09-15 16:40:36', '2021-09-21 11:47:40', NULL, 2, 6),
(8, '2021-09-24', 'Devoir maison voltaire', 1, '2021-09-15 16:41:37', '2021-09-21 15:08:03', NULL, 4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `event` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `drop_at` datetime DEFAULT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `calendar`
--

INSERT INTO `calendar` (`id`, `event`, `event_date`, `create_at`, `update_at`, `drop_at`, `id_users`) VALUES
(1, 'TEST2', '2021-08-28', '2021-08-27 09:38:19', '2021-08-27 09:38:19', NULL, 6),
(2, 'COucou', '2021-08-26', '2021-08-27 09:45:30', '2021-08-27 09:45:30', NULL, 6),
(3, 'COucou', '2021-08-26', '2021-08-27 09:46:10', '2021-08-27 09:46:10', NULL, 6),
(4, 'YES !', '2021-09-16', '2021-09-07 11:47:02', '2021-09-07 11:47:02', NULL, 6),
(5, 'TEST octobre', '2021-10-22', '2021-09-07 11:53:25', '2021-09-07 11:53:25', NULL, 6);

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `class`) VALUES
(1, '6ème'),
(2, '5ème'),
(3, '4ème'),
(4, '3ème');

-- --------------------------------------------------------

--
-- Structure de la table `classes_schedule`
--

CREATE TABLE `classes_schedule` (
  `id_class` int(11) NOT NULL,
  `id_schedule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classes_schedule`
--

INSERT INTO `classes_schedule` (`id_class`, `id_schedule`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 33),
(1, 34),
(1, 35),
(1, 36);

-- --------------------------------------------------------

--
-- Structure de la table `class_teacher`
--

CREATE TABLE `class_teacher` (
  `id` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` int(11) NOT NULL,
  `notation` varchar(40) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `drop_at` datetime DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  `id_users_teacher_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `marks`
--

INSERT INTO `marks` (`id`, `date`, `note`, `notation`, `create_at`, `update_at`, `drop_at`, `id_users`, `id_users_teacher_marks`) VALUES
(1, '2021-08-24', 15, 'DS sur la vie', '2021-08-26 07:47:21', '2021-08-26 07:47:21', NULL, 1, 6),
(8, '2021-08-29', 15, 'DS sur toto', '2021-08-27 11:12:47', '2021-09-10 12:03:09', NULL, 1, 6),
(9, '2021-08-29', 15, 'DS sur JAck lantern', '2021-08-27 11:14:12', '2021-08-27 11:15:00', NULL, 1, 6),
(10, '2021-08-29', 15, 'Un test sur table', '2021-08-27 11:14:12', '2021-08-27 11:15:00', NULL, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `matters`
--

CREATE TABLE `matters` (
  `id` int(11) NOT NULL,
  `matter` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matters`
--

INSERT INTO `matters` (`id`, `matter`) VALUES
(1, 'Histoire-Géographie'),
(2, 'Mathématique'),
(3, 'Français'),
(4, 'Sciences-Physiques'),
(5, 'SVT'),
(6, 'Anglais'),
(7, 'Latin'),
(8, 'EPS'),
(9, 'Musique'),
(10, 'Arts-Plastiques'),
(11, 'Pause');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `drop_at` datetime DEFAULT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `create_at`, `update_at`, `drop_at`, `id_users`) VALUES
(1, 'Bonjour à tous !', '2021-09-02 10:27:14', '2021-09-02 10:27:14', NULL, 1),
(2, 'Salut mec !', '2021-09-02 10:43:11', '2021-09-02 10:43:11', NULL, 7),
(3, 'Comment ça va ?', '2021-09-02 11:06:46', '2021-09-02 11:06:46', NULL, 6),
(5, 'Allo ?', '2021-09-02 11:08:06', '2021-09-03 11:49:38', NULL, 1),
(6, 'TEst tchat !', '2021-09-02 12:32:06', '2021-09-02 12:32:06', NULL, 8),
(9, 'bonjour ! \n', '2021-09-02 16:31:27', '2021-09-02 16:31:27', NULL, 6),
(11, 'coucou\n', '2021-09-02 17:02:01', '2021-09-03 11:49:50', NULL, 7),
(12, 'Ca va \n', '2021-09-02 18:20:33', '2021-09-02 18:20:33', NULL, 6),
(13, 'Moi ça va bien !\n', '2021-09-03 13:35:22', '2021-09-03 13:35:22', NULL, 6),
(29, 'Connected !\n', '2021-09-07 11:34:20', '2021-09-07 11:34:20', NULL, 6),
(33, 'Bonjour !\n', '2021-09-09 13:41:27', '2021-09-09 13:41:27', NULL, 7),
(34, 'Hello tous\n le monde !', '2021-09-10 12:19:55', '2021-09-10 12:19:55', NULL, 1),
(35, 'HEllo', '2021-09-10 12:30:08', '2021-09-10 12:30:08', NULL, 1),
(36, 'Coucou', '2021-09-11 14:03:54', '2021-09-11 14:03:54', NULL, 1),
(37, 'dvhjfzle', '2021-09-15 17:01:16', '2021-09-15 17:01:16', NULL, 6),
(38, 'YO', '2021-09-16 14:35:39', '2021-09-16 14:35:39', NULL, 6),
(39, 'Hello tous le monde !', '2021-09-21 15:15:23', '2021-09-21 15:15:23', NULL, 12),
(40, 'Coucou je suis l\'admin', '2021-09-24 11:31:21', '2021-09-24 11:31:21', NULL, 9);

-- --------------------------------------------------------

--
-- Structure de la table `online`
--

CREATE TABLE `online` (
  `id` int(6) NOT NULL,
  `id_users_online` int(6) NOT NULL,
  `last_action` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `parents_childs`
--

CREATE TABLE `parents_childs` (
  `id_child` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `parents_childs`
--

INSERT INTO `parents_childs` (`id_child`, `id_parent`) VALUES
(1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `ranks`
--

CREATE TABLE `ranks` (
  `id` int(11) NOT NULL,
  `rank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ranks`
--

INSERT INTO `ranks` (`id`, `rank`) VALUES
(1, 'Étudiant'),
(2, 'Parent'),
(3, 'Professeur'),
(4, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `room`) VALUES
(1, '23'),
(2, '1'),
(3, '2'),
(4, '3'),
(5, '4'),
(6, '5'),
(7, '6'),
(8, '7'),
(9, '8'),
(10, '9'),
(11, '10'),
(12, '11'),
(13, '12'),
(14, '13'),
(15, '14'),
(16, '15'),
(17, '16'),
(18, '17'),
(19, '18'),
(20, '19'),
(21, '20'),
(22, 'SELF'),
(23, 'GYM');

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `drop_at` datetime DEFAULT NULL,
  `id_slots` int(11) NOT NULL,
  `id_matters` int(11) NOT NULL,
  `id_rooms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `schedule`
--

INSERT INTO `schedule` (`id`, `day`, `create_at`, `update_at`, `drop_at`, `id_slots`, `id_matters`, `id_rooms`) VALUES
(1, 'Lundi', '2021-09-14 09:42:49', '2021-09-14 09:42:49', NULL, 2, 1, 1),
(3, 'Lundi', '2021-09-22 11:55:40', '2021-09-23 16:36:33', NULL, 1, 9, 7),
(4, 'Lundi', '2021-09-22 11:56:26', '2021-09-22 11:56:26', NULL, 3, 8, 11),
(5, 'Lundi', '2021-09-22 11:56:39', '2021-09-22 11:56:39', NULL, 4, 8, 11),
(6, 'Mardi', '2021-09-22 11:57:49', '2021-09-22 11:57:49', NULL, 7, 6, 18),
(7, 'Lundi', '2021-09-22 11:58:05', '2021-09-22 11:58:05', NULL, 8, 5, 13),
(8, 'Lundi', '2021-09-22 11:58:24', '2021-09-22 11:58:24', NULL, 7, 7, 16),
(9, 'Lundi', '2021-09-22 11:58:43', '2021-09-22 11:58:43', NULL, 9, 10, 20),
(10, 'Mardi', '2021-09-22 11:59:03', '2021-09-22 11:59:03', NULL, 2, 3, 4),
(11, 'Mardi', '2021-09-22 12:00:37', '2021-09-22 12:00:37', NULL, 1, 4, 17),
(12, 'Mardi', '2021-09-22 12:00:58', '2021-09-22 12:00:58', NULL, 9, 2, 1),
(13, 'Mardi', '2021-09-22 12:01:40', '2021-09-22 12:01:40', NULL, 3, 1, 19),
(14, 'Mercredi', '2021-09-22 12:02:05', '2021-09-22 12:02:05', NULL, 1, 7, 16),
(15, 'Mercredi', '2021-09-22 12:02:28', '2021-09-22 12:02:28', NULL, 2, 2, 13),
(16, 'Mercredi', '2021-09-22 12:03:04', '2021-09-22 12:03:04', NULL, 3, 5, 14),
(17, 'Mercredi', '2021-09-22 12:04:06', '2021-09-22 12:04:06', NULL, 4, 10, 16),
(18, 'Jeudi', '2021-09-22 12:05:35', '2021-09-22 12:05:35', NULL, 1, 6, 19),
(19, 'Jeudi', '2021-09-22 12:05:52', '2021-09-22 12:05:52', NULL, 2, 3, 15),
(20, 'Jeudi', '2021-09-22 12:06:12', '2021-09-23 16:36:52', NULL, 7, 7, 19),
(21, 'Jeudi', '2021-09-22 12:06:25', '2021-09-22 12:06:25', NULL, 3, 1, 7),
(22, 'Jeudi', '2021-09-22 12:07:07', '2021-09-22 12:07:07', NULL, 8, 2, 7),
(23, 'Vendredi', '2021-09-22 12:07:45', '2021-09-22 12:07:45', NULL, 2, 8, 11),
(24, 'Vendredi', '2021-09-22 12:07:57', '2021-09-22 12:07:57', NULL, 3, 8, 11),
(25, 'Vendredi', '2021-09-22 12:08:12', '2021-09-22 12:08:12', NULL, 7, 4, 15),
(26, 'Vendredi', '2021-09-22 12:08:26', '2021-09-22 12:08:26', NULL, 4, 7, 8),
(27, 'Vendredi', '2021-09-22 12:08:49', '2021-09-22 12:08:49', NULL, 9, 3, 20),
(28, 'Lundi', '2021-09-22 12:09:59', '2021-09-22 12:09:59', NULL, 5, 11, 22),
(29, 'Lundi', '2021-09-22 12:10:13', '2021-09-22 12:10:13', NULL, 6, 11, 22),
(30, 'Mardi', '2021-09-22 12:10:25', '2021-09-22 12:10:25', NULL, 5, 11, 22),
(31, 'Mardi', '2021-09-22 12:10:33', '2021-09-22 12:10:33', NULL, 6, 11, 22),
(33, 'Jeudi', '2021-09-22 12:11:58', '2021-09-22 12:11:58', NULL, 5, 11, 22),
(34, 'Jeudi', '2021-09-22 12:12:06', '2021-09-22 12:12:06', NULL, 6, 11, 22),
(35, 'Vendredi', '2021-09-22 12:12:15', '2021-09-22 12:12:15', NULL, 5, 11, 22),
(36, 'Vendredi', '2021-09-22 12:12:24', '2021-09-22 12:12:24', NULL, 6, 11, 22);

-- --------------------------------------------------------

--
-- Structure de la table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `slot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `slots`
--

INSERT INTO `slots` (`id`, `slot`) VALUES
(1, 8),
(2, 9),
(3, 10),
(4, 11),
(5, 12),
(6, 13),
(7, 14),
(8, 15),
(9, 16),
(10, 17);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `birthdate` date DEFAULT NULL,
  `mail` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` char(60) CHARACTER SET utf8mb4 NOT NULL,
  `changePass` tinyint(1) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `drop_at` datetime DEFAULT NULL,
  `id_ranks` int(2) NOT NULL,
  `id_matters` int(11) DEFAULT NULL,
  `id_classes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `birthdate`, `mail`, `password`, `changePass`, `statut`, `create_at`, `update_at`, `drop_at`, `id_ranks`, `id_matters`, `id_classes`) VALUES
(1, 'Guillaume', 'David', '1999-07-23', 'guillaume.david744@orange.fr', '$2y$10$ENvONeFW1e9Yg0juKQ8wEOnN6TgiciTixaBCkYd8wa9yDiZcyudDu', 0, 1, '2021-08-25 15:05:34', '2021-09-13 15:08:32', NULL, 1, NULL, 1),
(6, 'Cédric', 'Gallet', '1980-10-10', 'cedric@orange.fr', '$2y$10$xw5WULei7PkZzd30OEwJlOBDvXbv55sPPi8fgRYfDmeBbOzjP4Zx6', 0, 1, '2021-08-25 16:29:50', '2021-09-14 14:55:09', NULL, 3, 1, NULL),
(7, 'Mickaël', 'Boulanger', '1980-04-15', 'mick@orange.fr', '$2y$10$nRCDaJ0B7.vK7WW15i7cUOJ51w/wnRQ/3JtQfuD7v4udpgCwpJKXq', 0, 1, '2021-08-27 14:07:29', '2021-09-09 09:44:20', NULL, 2, NULL, NULL),
(8, 'Vincent', 'Mancheron', '1995-07-19', 'vince@orange.fr', '$2y$10$ENvONeFW1e9Yg0juKQ8wEOnN6TgiciTixaBCkYd8wa9yDiZcyudDu', 0, 1, '2021-08-27 14:10:02', '2021-09-09 09:29:02', NULL, 1, NULL, 2),
(9, 'Thierry', 'Lachat', '1985-09-09', 'thierry@orange.fr', '$2y$10$qSdRGrBzdDxVlAEVghcmjue0qXN2dTMGChrXHh7nG1OdlMwQ9xt4G', 0, 1, '2021-09-21 14:44:58', '2021-09-21 14:44:58', '2021-09-21 12:44:01', 4, NULL, NULL),
(10, 'Plessier', 'Matthieu', '1980-10-20', 'mat@orange.fr', '$2y$10$igkkFkNYBag2bvIdAgu0UeL6b4mgcLZsRRgb8JXYV2bEdaJURquiq', 1, 1, '2021-09-21 14:58:20', '2021-09-21 14:58:20', NULL, 1, NULL, 3),
(11, 'Pinhoca', 'Nhem', '1995-09-23', 'Pinh@orange.fr', '$2y$10$HaHj39yfj3buetFGBzPQlOhSnT8DfhDQoUOeT/60fN1ynxSBVJoHW', 0, 1, '2021-09-21 15:00:18', '2021-09-21 15:00:50', NULL, 1, NULL, 4),
(12, 'Pauline', 'Gallezot', '1975-05-10', 'gallezot@orange.fr', '$2y$10$7xGSJL7SLfRct2vWXBh2K.HUI9OJr8K3xkL9W0isRpKXifbAyUtZe', 0, 1, '2021-09-21 15:14:15', '2021-09-21 15:14:58', NULL, 3, 8, NULL),
(13, 'Ludovic', 'Arduino', '1982-01-21', 'arduino@orange.fr', '$2y$10$pVfYeq1x8zf7n6CMR9RpJ.wwGBpPa7YSFj/xZcqIgKPxNidbbuMyC', 0, 1, '2021-09-21 15:16:27', '2021-09-21 15:17:03', NULL, 2, NULL, NULL),
(14, 'Ferdinand', 'Kevin', '1999-09-23', 'kev@or.fr', '$2y$10$Q7/egjIzq5vSqoPe2VQo.uUkHXAZrKUncHSxCGhqn/IW5ADeSzNhO', 1, 1, '2021-09-22 09:36:12', '2021-09-22 09:57:40', NULL, 1, NULL, 4),
(15, 'Pierre', 'Fraigneau', '1999-10-21', 'caesar@orange.fr', '$2y$10$vSOoCU3IvKRQUzKwUswuPehsYPUnXQRE1PJxVrX302oNMQwax/UmK', 1, 1, '2021-09-22 09:48:59', '2021-09-22 09:57:54', NULL, 2, NULL, NULL),
(16, 'Justine', 'Douay', '1995-07-15', 'douay@pro.fr', '$2y$10$3UAI4a4pqLQ6R0k0K46aB.qBfSLHOuivkSKVKtNMxaO95QRbIiA7S', 1, 1, '2021-09-22 09:51:09', '2021-09-22 09:59:25', NULL, 3, 5, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absences_users_FK` (`id_users`);

--
-- Index pour la table `assignements`
--
ALTER TABLE `assignements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignements_classes_FK` (`id_classes`),
  ADD KEY `assignements_users0_FK` (`id_users`);

--
-- Index pour la table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calendar_users_FK` (`id_users`);

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classes_schedule`
--
ALTER TABLE `classes_schedule`
  ADD PRIMARY KEY (`id_class`,`id_schedule`),
  ADD KEY `classes_schedule_schedule0_FK` (`id_schedule`);

--
-- Index pour la table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD PRIMARY KEY (`id_class`,`id_users`),
  ADD KEY `class_teacher_users0_FK` (`id_users`);

--
-- Index pour la table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marks_users_FK` (`id_users`),
  ADD KEY `marks_users0_FK` (`id_users_teacher_marks`);

--
-- Index pour la table `matters`
--
ALTER TABLE `matters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_users_FK` (`id_users`);

--
-- Index pour la table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users_online_FK` (`id_users_online`);

--
-- Index pour la table `parents_childs`
--
ALTER TABLE `parents_childs`
  ADD PRIMARY KEY (`id_child`,`id_parent`),
  ADD KEY `parents_childs_users0_FK` (`id_parent`);

--
-- Index pour la table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_slots_FK` (`id_slots`),
  ADD KEY `schedule_matters0_FK` (`id_matters`),
  ADD KEY `schedule_rooms1_FK` (`id_rooms`);

--
-- Index pour la table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_matters0_FK` (`id_matters`),
  ADD KEY `users_classes1_FK` (`id_classes`),
  ADD KEY `users_ranks_FK` (`id_ranks`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `assignements`
--
ALTER TABLE `assignements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `matters`
--
ALTER TABLE `matters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `online`
--
ALTER TABLE `online`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `assignements`
--
ALTER TABLE `assignements`
  ADD CONSTRAINT `assignements_classes_FK` FOREIGN KEY (`id_classes`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `assignements_users0_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `calendar_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `classes_schedule`
--
ALTER TABLE `classes_schedule`
  ADD CONSTRAINT `classes_schedule_classes_FK` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classes_schedule_schedule0_FK` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD CONSTRAINT `class_teacher_classes_FK` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `class_teacher_users0_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_users0_FK` FOREIGN KEY (`id_users_teacher_marks`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `marks_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `online`
--
ALTER TABLE `online`
  ADD CONSTRAINT `id_users_online_FK` FOREIGN KEY (`id_users_online`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `parents_childs`
--
ALTER TABLE `parents_childs`
  ADD CONSTRAINT `parents_childs_users0_FK` FOREIGN KEY (`id_parent`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `parents_childs_users_FK` FOREIGN KEY (`id_child`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_matters0_FK` FOREIGN KEY (`id_matters`) REFERENCES `matters` (`id`),
  ADD CONSTRAINT `schedule_rooms1_FK` FOREIGN KEY (`id_rooms`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `schedule_slots_FK` FOREIGN KEY (`id_slots`) REFERENCES `slots` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_classes1_FK` FOREIGN KEY (`id_classes`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `users_matters0_FK` FOREIGN KEY (`id_matters`) REFERENCES `matters` (`id`),
  ADD CONSTRAINT `users_ranks_FK` FOREIGN KEY (`id_ranks`) REFERENCES `ranks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
