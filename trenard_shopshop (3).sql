-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 08 jan. 2024 à 08:51
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `trenard_shopshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `etat` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_util` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `montant`, `date`, `etat`, `idUtilisateur`) VALUES
(2, '3000.00', '2024-01-07 02:47:33', 1, 29),
(3, '5300.00', '2024-01-07 03:00:15', 1, 29),
(4, '5300.00', '2024-01-07 03:00:18', 1, 29),
(5, '800.00', '2024-01-07 03:00:44', 1, 29),
(6, '900.00', '2024-01-07 03:01:15', 1, 29),
(7, '900.00', '2024-01-07 03:04:20', 1, 29),
(8, '900.00', '2024-01-07 03:04:22', 1, 29),
(9, '800.00', '2024-01-07 03:04:43', 1, 29),
(10, '800.00', '2024-01-07 03:04:46', 1, 29),
(11, '800.00', '2024-01-07 03:04:47', 1, 29),
(12, '800.00', '2024-01-07 03:07:05', 1, 29),
(13, '3200.00', '2024-01-07 03:07:16', 1, 29),
(14, '3200.00', '2024-01-07 03:07:19', 1, 29),
(15, '3200.00', '2024-01-07 03:07:19', 1, 29),
(16, '3200.00', '2024-01-07 03:07:20', 1, 29),
(17, '3200.00', '2024-01-07 03:07:20', 1, 29),
(18, '3200.00', '2024-01-07 03:07:20', 1, 29),
(19, '3200.00', '2024-01-07 03:07:21', 1, 29),
(20, '800.00', '2024-01-07 03:07:53', 1, 29),
(21, '800.00', '2024-01-07 03:08:00', 1, 29),
(22, '800.00', '2024-01-07 03:10:07', 1, 29),
(23, '800.00', '2024-01-07 03:10:14', 1, 29),
(24, '1500.00', '2024-01-07 03:13:12', 1, 29),
(25, '1500.00', '2024-01-07 03:13:21', 1, 29),
(26, '1500.00', '2024-01-07 03:18:58', 1, 29),
(27, '800.00', '2024-01-07 03:19:04', 1, 29),
(28, '800.00', '2024-01-07 03:19:35', 1, 29),
(29, '800.00', '2024-01-07 03:20:37', 1, 29),
(30, '800.00', '2024-01-07 03:20:53', 1, 29),
(31, '800.00', '2024-01-07 03:26:52', 1, 29),
(32, '3200.00', '2024-01-07 03:30:09', 1, 29),
(33, '3200.00', '2024-01-07 03:31:07', 1, 29),
(34, '46000.00', '2024-01-07 03:35:36', 1, 29),
(35, '800.00', '2024-01-07 03:36:42', 1, 29),
(36, '1600.00', '2024-01-07 03:39:06', 1, 29),
(37, '800.00', '2024-01-07 03:40:22', 1, 29),
(38, '1500.00', '2024-01-07 04:00:39', 1, 31),
(39, '1500.00', '2024-01-07 04:05:32', 1, 31),
(40, '1500.00', '2024-01-07 04:07:50', 1, 31),
(41, '7500.00', '2024-01-08 08:43:04', 1, 31),
(42, '1500.00', '2024-01-08 08:43:14', 1, 31),
(43, '800.00', '2024-01-08 08:54:59', 1, 31),
(44, '800.00', '2024-01-08 08:56:00', 1, 31);

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

DROP TABLE IF EXISTS `composer`;
CREATE TABLE IF NOT EXISTS `composer` (
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`idCommande`,`idProduit`),
  KEY `fk_produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `composer`
--

INSERT INTO `composer` (`idCommande`, `idProduit`, `quantite`) VALUES
(3, 142, 1),
(3, 143, 3),
(5, 142, 1),
(6, 123, 1),
(6, 140, 5),
(9, 142, 1),
(13, 142, 4),
(20, 142, 1),
(23, 142, 1),
(24, 143, 1),
(27, 142, 1),
(28, 142, 1),
(29, 142, 1),
(30, 142, 1),
(31, 142, 1),
(32, 142, 4),
(34, 140, 20),
(34, 142, 55),
(35, 142, 1),
(36, 142, 2),
(37, 142, 1),
(38, 143, 1),
(39, 123, 3),
(39, 136, 5),
(41, 143, 5),
(42, 129, 1),
(42, 140, 1),
(42, 141, 1),
(43, 142, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomProduit` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL,
  `idType` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idType` (`idType`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nomProduit`, `description`, `prix`, `idType`, `photo`) VALUES
(123, 'Le Starter', 'Vous voulez un PC pas trop cher pour votre adolescent ? Celui-ci devrait lui convenir à jouer à certains de ses jeux préférés avec ses amis !', 400, 7, '65984f31640be.png'),
(124, 'Le Timide', 'Un PC plutôt fait pour la bureautique... ou vos parties endiablées de Démineur ! En tout cas, les feuilles Excel ne devraient pas trop vous poser de problèmes.', 240, 7, '6598582991753.png'),
(126, 'RTX 4060', 'Une carte graphique moyenne gamme qui permettra de faire tourner vos jeux favoris dans les qualités les plus élevées (ou presque) en résolution 1080p avec 60FPS.', 320, 2, '6599d1461c051.jpg'),
(127, 'RTX 4070', 'Une carte graphique haut de gamme permettant de jouer à tous les jeux sans aucun compromis sur la partie graphique, même dans des résolutions élevées !', 600, 2, '6599d17dddcf0.png'),
(128, 'RTX 4080', 'Prêt à être dans une situation confortable pendant plusieurs années ? La RTX 4080 vous permettra de jouer à tous vos jeux en 4K sans trop de difficulté, à vous de jouer !', 950, 2, '6599d1b1a66b3.png'),
(129, 'RTX 4090', 'Rien ne vous arrêtera !', 1200, 2, '6599d1f9eda98.png'),
(130, '1TB HDD', '1 Térabyte de stockage HDD', 30, 4, '6599d3d583eab.png'),
(131, '2TB HDD', '2 Térabytes de stockage HDD', 40, 4, '6599d3e9309f8.png'),
(132, '4TB HDD', '4 Térabytes de stockage HDD', 55, 4, '6599d3fc0db8e.png'),
(133, 'Corsair Vengeance 2*8 GO', '16 Go de RAM au total', 120, 5, '6599d4509dc1e.png'),
(134, 'G-Skill Trident 32 GO RAM', '32 GO de Ram pour vos jeux favoris, il y\'en a de la marge !', 200, 5, '6599d4833a20e.jpg'),
(136, 'I5-7500', 'Un processeur qui fait le travail, tout ce qu\'on demande !', 60, 3, '6599d98b66b3c.jpg'),
(140, 'I7-7700', 'Un très bon processeur qui fera tourner vos jeux sans aucun compromis !', 100, 3, '6599db1c395aa.jpg'),
(141, 'I9-12900K', 'Un excellent processeur qui vous permettra de tout faire !', 200, 3, '6599db361b446.jpg'),
(142, 'Le Doué', 'Un bon PC pour les joueurs, il vous fera passer de bons moments dans les jeux plutôt gourmands !', 800, 7, '6599db7a99dd5.jpg'),
(143, 'L\'Exquis', 'Le haut du panier, avec ça, les jeux actuels et ceux qui arriveront les prochaines années ne vous poseront pas de soucis !', 1500, 7, '6599dbb513ef2.jpg'),
(144, 'Le Marcheur', 'Un PC portable qui ne sert pas vraiment pour les jeux, mais suffisant pour faire tout ce dont vous souhaitez en rapport avec la bureautique !', 340, 8, '6599dcac92f70.jpg'),
(145, 'L\'Explorateur', 'Un laptop pour des jeux relativement gourmands, il sera votre compagnon polyvalent idéal si vous êtes un joueur amateur.', 550, 8, '6599dcdc79165.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `libelle`) VALUES
(1, 'Administrateur'),
(2, 'Client');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `libelle`) VALUES
(2, 'Carte graphique (GPU)'),
(3, 'Processeur (CPU)'),
(4, 'Disque dur (HDD)'),
(5, 'RAM'),
(7, 'Ordinateur'),
(8, 'Laptop'),
(9, 'Disque dur (SSD)'),
(10, 'Carte mère'),
(11, 'Ventilateur'),
(12, 'Alimentation');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(999) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `idRole` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idRole` (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `mdp`, `nom`, `prenom`, `idRole`) VALUES
(19, 'terencevraivraivrai@gmail.com', '$2y$10$QFkqYYFMlciUOLwaZi71beuPzDdQtoK7jC5Nf0A0FNe0PQLK5DASi', 'teteaaa', 'tete', 1),
(29, 'terencelevrai@gmail.com', '$2y$10$L6oirjx7U1x//PnVg.7HAea2vXjUxvyO3a//CUB/hSYTYxNTXICRW', 'bbbbbb', 'bbbbbb', 1),
(31, 'client1@gmail.com', '$2y$10$zxWept8ZDezS5FhyO3mP/.nfcuuiDXdAjR3S/JhtdIh7C.tqViIRu', 'Renard', 'Terence', 2),
(32, 'terenceclasse@gmail.com', '$2y$10$NMfjxcCkXrFNH0f5tRBY0.pBX4vX2664bN1uyj7WYzaU6ttRdvipG', 'lol', 'lol', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_util` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
  ADD CONSTRAINT `fk_commande` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `fk_produit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `idType` FOREIGN KEY (`idType`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
