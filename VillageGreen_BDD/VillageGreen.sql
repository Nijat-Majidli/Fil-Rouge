-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 26 déc. 2022 à 22:20
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `filrouge`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_photo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `cat_nom`, `cat_photo`) VALUES
(1, 'Guit&Bass', 'jpg'),
(2, 'Batteries', 'jpg'),
(3, 'Clavier', 'jpg'),
(4, 'Studio', 'jpg'),
(5, 'Sono', 'jpg'),
(6, 'Eclairage', 'jpg'),
(7, 'DJ', 'jpg'),
(8, 'Cases', 'jpg'),
(9, 'Accessoires', 'jpg'),
(10, 'Logiciels', 'jpg'),
(11, 'Vents', 'jpg'),
(12, 'Micros', 'jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_date` date NOT NULL,
  `mode_paiement` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_facturation` date NOT NULL,
  `date_livraison` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `com_montant` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6EEAA67DA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `com_date`, `mode_paiement`, `date_facturation`, `date_livraison`, `user_id`, `com_montant`) VALUES
(14, '2022-09-06', 'virement', '2022-09-06', NULL, 5, 567),
(15, '2022-09-06', 'paypal', '2022-09-06', NULL, 2, 300),
(16, '2022-09-07', 'carte de crédit', '2022-09-07', NULL, 5, 552),
(19, '2022-09-07', 'paypal', '2022-09-07', NULL, 5, 110),
(20, '2022-09-07', 'carte de crédit', '2022-09-07', NULL, 5, 1590),
(21, '2022-09-18', 'paypal', '2022-09-18', NULL, 3, 159);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962AF347EFB` (`produit_id`),
  KEY `IDX_5F9E962AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `produit_id`, `user_id`, `content`, `date`, `update_date`) VALUES
(1, 1, 5, 'C\'est un très bon guitare électrique. Si votre budget est limité ou si vous voulez simplement vous lancer dans l’apprentissage de la guitare sans investir de sommes trop importantes, ce modèle est ce qu’il vous faut.', '2022-09-15 09:51:41', NULL),
(2, 2, 5, 'J\'ai acheté la guitare pour mon fils et j\'ai été étonné de voir à quel point c\'était facile à jouer. Avec cette guitare, je pourrais immédiatement jouer tout un concert en termes de son et de jouabilité (normalement je joue Ibanez).', '2022-09-15 18:51:19', NULL),
(3, 2, 2, 'Vous ne pouvez pas demander plus pour le prix qu\'il a. La finition de la guitare est très bonne et de bonne qualité.', '2022-09-15 18:59:56', NULL),
(4, 3, 2, 'Très bon produit pour le prix !!', '2022-09-15 19:02:30', NULL),
(5, 2, 3, 'Les finitions sont bonnes, les frettes sont bien ajustées et limées sur les bords. Aucune frisure. Le manche est confortable, aucun défaut visible sur la guitare !', '2022-09-18 14:31:29', NULL),
(6, 8, 3, 'Le meilleur rapport qualité prix', '2022-09-19 00:00:00', NULL),
(7, 8, 2, 'Vraiment bien cette petite guitare !!!', '2022-09-19 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lignedecommande`
--

DROP TABLE IF EXISTS `lignedecommande`;
CREATE TABLE IF NOT EXISTS `lignedecommande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `remise` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A4C3DF16C3B7E4BA` (`pro_id`),
  KEY `IDX_A4C3DF16748C0F37` (`com_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lignedecommande`
--

INSERT INTO `lignedecommande` (`id`, `pro_id`, `com_id`, `quantite`, `remise`) VALUES
(6, 8, 14, 3, NULL),
(7, 7, 14, 4, NULL),
(8, 2, 14, 1, NULL),
(9, 3, 14, 2, NULL),
(10, 8, 15, 3, NULL),
(11, 7, 15, 4, NULL),
(12, 2, 15, 1, NULL),
(13, 3, 15, 2, NULL),
(14, 14, 16, 3, NULL),
(15, 13, 16, 1, NULL),
(16, 8, 19, 2, NULL),
(17, 7, 19, 5, NULL),
(18, 4, 20, 3, NULL),
(19, 11, 20, 3, NULL),
(20, 2, 21, 1, NULL),
(21, 8, 21, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sous_cat_id` int(11) DEFAULT NULL,
  `pro_libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_ht` double NOT NULL,
  `tva` double NOT NULL,
  `prix_ttc` double NOT NULL,
  `pro_photo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC2736B25BB4` (`sous_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `sous_cat_id`, `pro_libelle`, `pro_description`, `prix_ht`, `tva`, `prix_ttc`, `pro_photo`, `pro_stock`) VALUES
(1, 1, 'Harley Benton', 'Guitare électrique, Harley Benton ST-20HSS CA Standard Set 1', 100, 20, 120, 'jpg', 5),
(2, 1, 'Thomann Guitar', 'Guitare électrique, Thomann Guitar Set G13 White', 70, 20, 84, 'jpg', 2),
(3, 1, 'Fender', 'Guitare électrique, Fender SQ Aff. Strat HSS MN PACK LPB', 150, 20, 180, 'jpg', 4),
(4, 1, 'Evh', 'Guitare électrique, Evh SQ Aff. Strat HSS MN PACK LPB', 150, 20, 180, 'jpg', 8),
(5, 1, 'Jackson', 'Guitare électrique, Jackson SQ Aff. Strat HSS MN PACK LPB', 150, 20, 180, 'jpg', 9),
(6, 1, 'Squier', 'Guitare électrique, Squier SQ Aff. Strat HSS MN PACK LPB', 150, 20, 180, 'jpg', 4),
(7, 2, 'Startone', 'Guitare classique, Startone CG 851 1/8', 10, 20, 12, 'jpg', 15),
(8, 2, 'Yamaha', 'Guitare classique, Yamaha GL1 Tobacco Brown Sunburst', 25, 20, 25, 'jpg', 7),
(9, 2, 'La Mancha', 'Guitare classique, La Mancha Rubinito CM/47', 100, 20, 120, 'jpg', 6),
(10, 2, 'Ortega', 'Guitare classique, Ortega R122-1/4', 60, 20, 72, 'jpg', 4),
(11, 2, 'Hellweg', 'Guitare classique, Hellweg Micki', 300, 20, 350, 'jpg', 3),
(12, 2, 'Manuel Rodriguez', 'Guitare classique, Manuel Rodriguez Tesoro de la Bodega Limited', 800, 20, 960, 'jpg', 1),
(13, 3, 'Epiphone', 'Guitares Acoustiques & Electro-Acoustiques, Epiphone J-15 EC Deluxe NA', 160, 20, 192, 'jpg', 2),
(14, 3, 'Baton Rouge', 'Guitares Acoustiques & Electro-Acoustiques, Baton Rouge X11LS/D-W-SCC', 100, 20, 120, 'jpg', 7),
(15, 3, 'Gibson', 'Guitares Acoustiques & Electro-Acoustiques, Gibson G-45 Natural Generation', 700, 20, 840, 'jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reset_password_request`
--

INSERT INTO `reset_password_request` (`id`, `user_id`, `selector`, `hashed_token`, `requested_at`, `expires_at`) VALUES
(13, 1, 'takGUsAbd3hbPb6Qcc3y', 'o2PEN0TbPeVXVrdtVNP/HU9woxCrHUIZfq0hJvBlNXI=', '2022-12-16 07:39:01', '2022-12-16 08:39:01');

-- --------------------------------------------------------

--
-- Structure de la table `souscategories`
--

DROP TABLE IF EXISTS `souscategories`;
CREATE TABLE IF NOT EXISTS `souscategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `sous_cat_nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sous_cat_photo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6C660C3AE6ADA943` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `souscategories`
--

INSERT INTO `souscategories` (`id`, `cat_id`, `sous_cat_nom`, `sous_cat_photo`) VALUES
(1, 1, 'Guitares Electriques', 'jpg'),
(2, 1, 'Guitares Classiques', 'jpg'),
(3, 1, 'Guitares Acoustiques & Electro-Acoustiques', 'jpg'),
(4, 1, 'Basses electriques', 'jpg'),
(5, 1, 'Basses acoustiques & Semi-Acoustiques', 'jpg'),
(6, 1, 'Ukulélés', 'jpg'),
(7, 2, 'Batteries Acoustiques', 'jpg'),
(8, 2, 'Batteries Electroniques', 'jpg'),
(9, 2, 'Cymbales', 'jpg'),
(10, 2, 'Baguettes & Maillets', 'jpg'),
(11, 2, 'Peaux de Batterie & Percussions', 'jpg'),
(12, 2, 'Hardware pour Batterie & Percussions', 'jpg'),
(13, 3, 'Claviers Arrangeurs', 'jpg'),
(14, 3, 'Claviers Maîtres', 'jpg'),
(15, 3, 'Pianos de Scène', 'jpg'),
(16, 3, 'Pianos Numériques', 'jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `user_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_categorie` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_cp` int(11) NOT NULL,
  `user_ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `user_nom`, `user_prenom`, `user_categorie`, `user_adresse`, `user_cp`, `user_ville`, `user_pays`) VALUES
(1, 'nijatmajidli@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$EmjITVf.v2sWFvrGWU63BODO7MmEE5PZUEfHQWsM9/FU5ySmC7WXy', 1, 'Majidli', 'Nijat', 'particulier', '4 rue Richard Wagner', 60180, 'Nogent sur Oise', 'France'),
(2, 'richard@gmail.com', '[\"ROLE_USER\"]', '$2y$13$7KMzsi6HEtDS.GGvv7QWeOddqmAVqMPjAuu5gajxu3mwuI2Cr2VFC', 1, 'Richard', 'Jules', 'particulier', '5 rue Général Leclerc', 80000, 'Amiens', 'France'),
(3, 'durand_adam@yahoo.com', '[\"ROLE_USER\"]', '$2y$13$EmjITVf.v2sWFvrGWU63BODO7MmEE5PZUEfHQWsM9/FU5ySmC7WXy', 1, 'Durand', 'Adam', 'particulier', '52 rue Jean Jaures', 75000, 'Paris', 'France'),
(4, 'dubois-lucas@hotmail.com', '[\"ROLE_USER\"]', '$2y$13$EmjITVf.v2sWFvrGWU63BODO7MmEE5PZUEfHQWsM9/FU5ySmC7WXy', 1, 'Dubois', 'Lucas', 'particulier', '18 bd Gambetta', 75000, 'Paris', 'France'),
(5, 'hugo777@sfr.fr', '[\"ROLE_USER\"]', '$2y$13$EmjITVf.v2sWFvrGWU63BODO7MmEE5PZUEfHQWsM9/FU5ySmC7WXy', 1, 'Moreau', 'Hugo', 'professionnel', '7 place Hotel de Ville', 60800, 'Creil', 'France'),
(6, 'gabin-2022@free.org', '[\"ROLE_USER\"]', '$2y$13$EmjITVf.v2sWFvrGWU63BODO7MmEE5PZUEfHQWsM9/FU5ySmC7WXy', 1, 'Laurent', 'Gabin', 'professionnel', '38 avenue Victor Hugo', 75000, 'Paris', 'France'),
(7, 'paul123simon@afpa.fr', '[\"ROLE_USER\"]', '$2y$13$7KMzsi6HEtDS.GGvv7QWeOddqmAVqMPjAuu5gajxu3mwuI2Cr2VFC', 1, 'Simon', 'Paul', 'professionnel', '30 Rue de Poulainville', 80000, 'Amiens', 'France');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5F9E962AF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `lignedecommande`
--
ALTER TABLE `lignedecommande`
  ADD CONSTRAINT `FK_A4C3DF16748C0F37` FOREIGN KEY (`com_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_A4C3DF16C3B7E4BA` FOREIGN KEY (`pro_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC2736B25BB4` FOREIGN KEY (`sous_cat_id`) REFERENCES `souscategories` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `souscategories`
--
ALTER TABLE `souscategories`
  ADD CONSTRAINT `FK_6C660C3AE6ADA943` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
