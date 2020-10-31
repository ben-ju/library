-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 30 oct. 2020 à 12:16
-- Version du serveur :  8.0.21-0ubuntu0.20.04.4
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `library`
--

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

CREATE TABLE `author` (
  `id` int NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` datetime NOT NULL,
  `death_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`id`, `firstname`, `lastname`, `birth_date`, `death_date`) VALUES
(1, 'Émile', 'Zola', '1840-04-20 00:00:00', '1902-09-29 00:00:00'),
(3, 'Jahseh', 'Onfroy', '1998-01-23 00:00:00', '2018-06-18 00:00:00'),
(4, 'Stephen', 'King', '1947-09-21 00:00:00', NULL),
(5, 'Carolyn', 'Brown', '1969-05-10 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `borrowing`
--

CREATE TABLE `borrowing` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `document_id` int NOT NULL,
  `borrowed_at` datetime NOT NULL,
  `expected_return_date` datetime NOT NULL,
  `actual_return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Science Fiction', 'Science fiction is a genre of speculative fiction that typically deals with imaginative and futuristic ... \"Science fiction\" is difficult to define precisely, as it includes a wide range of concepts and themes. ... It was translated into English by Ken Liu and published by Tor Books in 2014, and won the 2015 Hugo Award for Best Novel'),
(2, 'Horror', 'What is Horror? In literature, horror (pronounced hawr-er) is a genre of fiction whose purpose is to create feelings of fear, dread, repulsion, and terror in the audience—in other words, it develops an atmosphere of horror.'),
(3, 'Classic', 'A classic is an outstanding example of a particular style; something of lasting worth or with a timeless quality; of the first or highest quality, class, or rank – something that exemplifies its class. ... It denotes a particular quality in art, architecture, literature, design, technology, or other cultural artifacts.'),
(4, 'Romance', 'A romance is a relationship between two people who are in love with each other but who are not married to each other. ... Romance refers to the actions and feelings of people who are in love, especially behaviour which is very caring or affectionate.'),
(5, 'Rap', 'a type of popular music with a strong rhythm in which the words are spoken, not sung');

-- --------------------------------------------------------

--
-- Structure de la table `cd`
--

CREATE TABLE `cd` (
  `id` int NOT NULL,
  `total_duration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cd`
--

INSERT INTO `cd` (`id`, `total_duration`) VALUES
(1, 566);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201030104939', '2020-10-30 11:49:46', 1547);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime NOT NULL,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id`, `title`, `published_at`, `reference_number`, `stock`, `publisher`, `description`, `illustration`, `type`) VALUES
(1, '17', '2018-08-14 00:00:00', '5f9bf250e41d23.71522086', 100, 'Universal Music', '17 is XXXTentacion first studio album which contains the famuos Jocelyn Flores track', 'IMAGE', 'cd'),
(2, 'Jurrasic Park', '1986-12-24 00:00:00', '5f9bf2f8494fa5.89056892', 4, 'Lucas Film', 'Sci fi movie that depicts dinosaur and people trying to run away from them', 'IMAGE', 'dvd'),
(3, 'Falling in love', '2020-10-13 00:00:00', '5f9bf3551400f3.86999104', 1, 'Kiko Writing', 'A book that emphase a romance between two people that won a lotery', 'IMAGE', 'novel');

-- --------------------------------------------------------

--
-- Structure de la table `document_author`
--

CREATE TABLE `document_author` (
  `document_id` int NOT NULL,
  `author_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `document_author`
--

INSERT INTO `document_author` (`document_id`, `author_id`) VALUES
(1, 3),
(2, 5),
(3, 1),
(3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `document_category`
--

CREATE TABLE `document_category` (
  `document_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `document_category`
--

INSERT INTO `document_category` (`document_id`, `category_id`) VALUES
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `dvd`
--

CREATE TABLE `dvd` (
  `id` int NOT NULL,
  `duration` int NOT NULL,
  `has_bonus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dvd`
--

INSERT INTO `dvd` (`id`, `duration`, `has_bonus`) VALUES
(2, 4865, 1);

-- --------------------------------------------------------

--
-- Structure de la table `novel`
--

CREATE TABLE `novel` (
  `id` int NOT NULL,
  `pages` int NOT NULL,
  `original_language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `novel`
--

INSERT INTO `novel` (`id`, `pages`, `original_language`, `isbn`) VALUES
(3, 478, 'en', '7456-1249-3719');

-- --------------------------------------------------------

--
-- Structure de la table `penalty`
--

CREATE TABLE `penalty` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `type` enum('one_day','seven_days','fourteen_days','blacklisted') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plage`
--

CREATE TABLE `plage` (
  `id` int NOT NULL,
  `cd_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plage`
--

INSERT INTO `plage` (`id`, `cd_id`, `title`, `duration`) VALUES
(1, 1, 'Jocelyn Flores', 254),
(2, 1, 'Carry On', 312);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` json NOT NULL,
  `subscribed_at` datetime DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `subscription_end_date` datetime DEFAULT NULL,
  `status` enum('free','subscribed') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `subscribed_at`, `phone_number`, `created_at`, `subscription_end_date`, `status`) VALUES
(1, 'Benjamin', 'BENCIVINNI', 'bencivinnibenjamin@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Lk54bkxTcmllc2FEZ2x0Qg$C94yAAtSvtWbFnPEPLluIUdWN7lg+Fy7T1vw3fbR3tg', '[\"ROLE_USER\"]', NULL, '669495875', '2020-10-30 12:08:18', NULL, 'free');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_226E5897A76ED395` (`user_id`),
  ADD KEY `IDX_226E5897C33F7837` (`document_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cd`
--
ALTER TABLE `cd`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `document_author`
--
ALTER TABLE `document_author`
  ADD PRIMARY KEY (`document_id`,`author_id`),
  ADD KEY `IDX_3CD69AEC33F7837` (`document_id`),
  ADD KEY `IDX_3CD69AEF675F31B` (`author_id`);

--
-- Index pour la table `document_category`
--
ALTER TABLE `document_category`
  ADD PRIMARY KEY (`document_id`,`category_id`),
  ADD KEY `IDX_898DE898C33F7837` (`document_id`),
  ADD KEY `IDX_898DE89812469DE2` (`category_id`);

--
-- Index pour la table `dvd`
--
ALTER TABLE `dvd`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `novel`
--
ALTER TABLE `novel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AFE28FD8A76ED395` (`user_id`);

--
-- Index pour la table `plage`
--
ALTER TABLE `plage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_107196C935F486F6` (`cd_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `author`
--
ALTER TABLE `author`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `plage`
--
ALTER TABLE `plage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `FK_226E5897A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_226E5897C33F7837` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`);

--
-- Contraintes pour la table `cd`
--
ALTER TABLE `cd`
  ADD CONSTRAINT `FK_45D68FDABF396750` FOREIGN KEY (`id`) REFERENCES `document` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `document_author`
--
ALTER TABLE `document_author`
  ADD CONSTRAINT `FK_3CD69AEC33F7837` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3CD69AEF675F31B` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `document_category`
--
ALTER TABLE `document_category`
  ADD CONSTRAINT `FK_898DE89812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_898DE898C33F7837` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `dvd`
--
ALTER TABLE `dvd`
  ADD CONSTRAINT `FK_8325C1DFBF396750` FOREIGN KEY (`id`) REFERENCES `document` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `novel`
--
ALTER TABLE `novel`
  ADD CONSTRAINT `FK_8F977F17BF396750` FOREIGN KEY (`id`) REFERENCES `document` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `penalty`
--
ALTER TABLE `penalty`
  ADD CONSTRAINT `FK_AFE28FD8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `plage`
--
ALTER TABLE `plage`
  ADD CONSTRAINT `FK_107196C935F486F6` FOREIGN KEY (`cd_id`) REFERENCES `cd` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
