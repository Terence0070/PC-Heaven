-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 13 jan. 2024 à 02:16
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
-- Base de données : `trenard_shopshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `montant` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `etat` int NOT NULL,
  `idUtilisateur` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_util` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `montant`, `date`, `etat`, `idUtilisateur`) VALUES
(38, '1500.00', '2024-01-07 04:00:39', 1, 31),
(39, '1500.00', '2024-01-07 04:05:32', 1, 31),
(40, '1500.00', '2024-01-07 04:07:50', 1, 31),
(41, '800.00', '2024-01-07 05:28:30', 1, 31),
(42, '3400.00', '2024-01-07 15:25:47', 1, 31),
(43, '2200.00', '2024-01-13 03:13:24', 1, 35);

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

DROP TABLE IF EXISTS `composer`;
CREATE TABLE IF NOT EXISTS `composer` (
  `idCommande` int NOT NULL,
  `idProduit` int NOT NULL,
  `quantite` int NOT NULL,
  PRIMARY KEY (`idCommande`,`idProduit`),
  KEY `fk_produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `composer`
--

INSERT INTO `composer` (`idCommande`, `idProduit`, `quantite`) VALUES
(38, 143, 1),
(39, 123, 3),
(39, 136, 5),
(41, 142, 1),
(42, 141, 1),
(42, 142, 4),
(43, 145, 4);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomProduit` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL,
  `idType` int NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idType` (`idType`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

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
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

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
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(999) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `idRole` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idRole` (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `mdp`, `nom`, `prenom`, `idRole`) VALUES
(30, 'client@gmail.com', '$2y$10$exnhL6KxaKZRKvhu9P3Fx.o2.X6H9thjWbLmVLatGfnHhBnHAsHG.', 'aaaa', 'aaaa', 2),
(31, 'client1@gmail.com', '$2y$10$zxWept8ZDezS5FhyO3mP/.nfcuuiDXdAjR3S/JhtdIh7C.tqViIRu', 'Renard', 'Terence', 2),
(32, 'admin1@gmail.com', '$2y$10$ovCAwbhbvd55k6JZB/V/Gea/BbYfyE/nO9tNHoI.lbZKNfhl0bA0m', 'Renard', 'Terence', 1),
(34, 'clientaaa@gmail.com', '$2y$10$pf8BXO8zgMAh0J8JfR8/4uVqdSvsxCkQ5WZotpsXI0rjigljjoloy', 'aaa', 'aaa', 2),
(35, 'clientbbb@gmail.com', '$2y$10$4b5Jl5WHWw6f1MrdpydA6ez2K2f.BwYu0qmlUnMj.jnd3xpuLOPzO', 'aaaa', 'aaaaa', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_util` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
  ADD CONSTRAINT `fk_commande` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
