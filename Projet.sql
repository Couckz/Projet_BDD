-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 18 mai 2026 à 12:10
-- Version du serveur : 8.0.44
-- Version de PHP : 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `Administre`
--

CREATE TABLE `Administre` (
  `login` varchar(30) NOT NULL,
  `id_article` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Administre`
--

INSERT INTO `Administre` (`login`, `id_article`) VALUES
('Aleex', 1),
('Aleex', 2),
('Aleex', 3);

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `Article` (
  `titre` varchar(30) DEFAULT NULL,
  `contenu` varchar(500) DEFAULT NULL,
  `note` decimal(3,2) DEFAULT NULL,
  `caracteristiques` varchar(100) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `date_modification` datetime DEFAULT NULL,
  `id_article` bigint NOT NULL,
  `id_jeu` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Article`
--

INSERT INTO `Article` (`titre`, `contenu`, `note`, `caracteristiques`, `date_creation`, `date_modification`, `id_article`, `id_jeu`) VALUES
('Starfield', 'Jeu d\'aventure dans l\'espace', 4.00, 'Violence, pegi 16', '2026-05-12 12:44:48', '2026-05-15 12:44:48', 1, 1),
('Mario odyssey', 'Jouez au nouveau jeu mario en 3D Super mario odyssey où l\'on doit parcourir le monde pour sauver la princesse Peach', 5.00, 'Pegi 7, combat', '2026-05-03 12:45:38', '2026-05-08 12:45:38', 2, 2),
('Zelda', 'Jeu d\'aventure. Découvrez la nouvelle aventure de Link pour sauver la princesse Zelda', 3.00, 'Violence, pegi 12, fantastique', '2026-05-03 12:47:13', '2026-05-29 12:47:13', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Avis`
--

CREATE TABLE `Avis` (
  `titre` varchar(30) DEFAULT NULL,
  `texte` varchar(500) DEFAULT NULL,
  `note` decimal(3,2) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `id_avis` bigint NOT NULL,
  `id_article` bigint DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Avis`
--

INSERT INTO `Avis` (`titre`, `texte`, `note`, `date_creation`, `id_avis`, `id_article`, `login`) VALUES
('Avis mario odyssey', 'J\'ai vraiment beaucoup aimé ce jeu, il est à l\'image de ses prédécesseurs ! ', 4.00, '2026-05-07 12:50:46', 1, 2, 'Cookie'),
('Zelda', 'Le jeu était bien mais je regrette que les jeux zelda aient moins de scénario qu\'avant..', 4.00, '2026-05-03 12:52:13', 2, 3, 'Maalo');

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `nom_categorie` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`nom_categorie`) VALUES
('Fantastique'),
('Palpitant'),
('Violence');

-- --------------------------------------------------------

--
-- Structure de la table `Est_categorise_par`
--

CREATE TABLE `Est_categorise_par` (
  `id_jeu` bigint NOT NULL,
  `nom_categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Est_categorise_par`
--

INSERT INTO `Est_categorise_par` (`id_jeu`, `nom_categorie`) VALUES
(2, 'Fantastique'),
(3, 'Fantastique'),
(1, 'Violence');

-- --------------------------------------------------------

--
-- Structure de la table `Est_jouable_sur`
--

CREATE TABLE `Est_jouable_sur` (
  `id_jeu` bigint NOT NULL,
  `nom_support` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Est_jouable_sur`
--

INSERT INTO `Est_jouable_sur` (`id_jeu`, `nom_support`) VALUES
(2, 'Switch'),
(3, 'Switch'),
(1, 'Xbox');

-- --------------------------------------------------------

--
-- Structure de la table `Image`
--

CREATE TABLE `Image` (
  `chemin_image` varchar(50) NOT NULL,
  `id_article` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Image`
--

INSERT INTO `Image` (`chemin_image`, `id_article`) VALUES
('img/article/starfield.png', 1),
('img/article/mario.png', 2),
('img/article/zelda.png', 3);

-- --------------------------------------------------------

--
-- Structure de la table `Jeu`
--

CREATE TABLE `Jeu` (
  `nom` varchar(30) DEFAULT NULL,
  `prix` decimal(5,2) DEFAULT NULL,
  `synopsis` varchar(40) DEFAULT NULL,
  `id_jeu` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Jeu`
--

INSERT INTO `Jeu` (`nom`, `prix`, `synopsis`, `id_jeu`) VALUES
('Starfield', 80.00, 'Jeu d\'aventure dans l\'espace ', 1),
('Mario', 70.00, 'Jeu mario 3D', 2),
('Zelda botw', 70.00, 'Affronter Ganon dans une aventure épique', 3);

-- --------------------------------------------------------

--
-- Structure de la table `Support`
--

CREATE TABLE `Support` (
  `nom_support` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Support`
--

INSERT INTO `Support` (`nom_support`) VALUES
('PS5'),
('Switch'),
('Xbox');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `Role` varchar(10) DEFAULT NULL,
  `login` varchar(30) NOT NULL,
  `mdp` varchar(30) DEFAULT NULL,
  `date_inscription` date DEFAULT NULL,
  `date_derniere_connexion` datetime DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse_email` varchar(320) DEFAULT NULL,
  `chemin_pdp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`Role`, `login`, `mdp`, `date_inscription`, `date_derniere_connexion`, `nom`, `prenom`, `date_naissance`, `adresse_email`, `chemin_pdp`) VALUES
('Redacteur', 'Aleex', '456', '2026-05-03', '2026-05-06 12:58:30', 'dsljeconnaispastonnom', 'Alexandre ', '2026-03-01', 'alex@gmail.com', '../img/photo_profil/pdp3.png'),
('Admin', 'Cookie', '987', '2026-05-03', '2026-05-07 12:36:58', 'Bensemmane', 'Camélia', '2006-05-08', 'bens@gmail.com', '../img/photo_profil/pdp2.png'),
('User', 'Maalo', '1234', '2026-05-04', '2026-05-12 12:19:12', 'Boudier', 'Malo', '2006-08-01', 'malo@gmail.com', '../img/photo_profil/pdp1.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Administre`
--
ALTER TABLE `Administre`
  ADD PRIMARY KEY (`login`,`id_article`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `id_jeu` (`id_jeu`);

--
-- Index pour la table `Avis`
--
ALTER TABLE `Avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `login` (`login`);

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`nom_categorie`);

--
-- Index pour la table `Est_categorise_par`
--
ALTER TABLE `Est_categorise_par`
  ADD PRIMARY KEY (`id_jeu`,`nom_categorie`),
  ADD KEY `nom_categorie` (`nom_categorie`);

--
-- Index pour la table `Est_jouable_sur`
--
ALTER TABLE `Est_jouable_sur`
  ADD PRIMARY KEY (`id_jeu`,`nom_support`),
  ADD KEY `nom_support` (`nom_support`);

--
-- Index pour la table `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`chemin_image`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `Jeu`
--
ALTER TABLE `Jeu`
  ADD PRIMARY KEY (`id_jeu`);

--
-- Index pour la table `Support`
--
ALTER TABLE `Support`
  ADD PRIMARY KEY (`nom_support`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `id_article` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Avis`
--
ALTER TABLE `Avis`
  MODIFY `id_avis` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Jeu`
--
ALTER TABLE `Jeu`
  MODIFY `id_jeu` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Administre`
--
ALTER TABLE `Administre`
  ADD CONSTRAINT `administre_ibfk_1` FOREIGN KEY (`login`) REFERENCES `Utilisateur` (`login`),
  ADD CONSTRAINT `administre_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `Article` (`id_article`);

--
-- Contraintes pour la table `Article`
--
ALTER TABLE `Article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `Jeu` (`id_jeu`);

--
-- Contraintes pour la table `Avis`
--
ALTER TABLE `Avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `Article` (`id_article`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`login`) REFERENCES `Utilisateur` (`login`);

--
-- Contraintes pour la table `Est_categorise_par`
--
ALTER TABLE `Est_categorise_par`
  ADD CONSTRAINT `est_categorise_par_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `Jeu` (`id_jeu`),
  ADD CONSTRAINT `est_categorise_par_ibfk_2` FOREIGN KEY (`nom_categorie`) REFERENCES `Categorie` (`nom_categorie`);

--
-- Contraintes pour la table `Est_jouable_sur`
--
ALTER TABLE `Est_jouable_sur`
  ADD CONSTRAINT `est_jouable_sur_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `Jeu` (`id_jeu`),
  ADD CONSTRAINT `est_jouable_sur_ibfk_2` FOREIGN KEY (`nom_support`) REFERENCES `Support` (`nom_support`);

--
-- Contraintes pour la table `Image`
--
ALTER TABLE `Image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `Article` (`id_article`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
