-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 04 fév. 2024 à 22:02
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `time_sc`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id_classe` bigint(20) NOT NULL,
  `nom_classe` varchar(50) DEFAULT NULL,
  `code_classe` varchar(50) DEFAULT NULL,
  `effectif_classe` bigint(20) DEFAULT NULL,
  `id_departement` bigint(20) DEFAULT NULL,
  `annee_academique` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `nom_classe`, `code_classe`, `effectif_classe`, `id_departement`, `annee_academique`) VALUES
(1, 'L1 Informatique', 'INFO-L1', 100, 1, '2024-02-04'),
(2, 'L2 Mathématiques', 'MATH-L2', 80, 2, '2024-02-04'),
(3, 'L3 Physique', 'PHYS-L3', 70, 3, '2024-02-04'),
(4, 'M1 Chimie', 'CHIM-M1', 50, 4, '2024-02-04'),
(5, 'M2 Biologie', 'BIO-M2', 60, 5, '2024-02-04');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id_departement` bigint(20) NOT NULL,
  `nom_departement` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id_departement`, `nom_departement`) VALUES
(1, 'Informatique'),
(2, 'Mathématiques'),
(3, 'Physique'),
(4, 'Chimie'),
(5, 'Biologie');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_enseignant` bigint(20) NOT NULL,
  `email_enseignant` varchar(50) DEFAULT NULL,
  `nom_enseignant` varchar(50) DEFAULT NULL,
  `mdp_enseignant` varchar(50) DEFAULT NULL,
  `priv` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `email_enseignant`, `nom_enseignant`, `mdp_enseignant`, `priv`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin2.0', 1),
(2, 'prof1@email.com', 'Professeur 1', NULL, 0),
(3, 'prof2@email.com', 'Professeur 2', NULL, 0),
(4, 'prof3@email.com', 'Professeur 3', NULL, 0),
(5, 'prof4@email.com', 'Professeur 4', NULL, 0),
(6, 'prof5@email.com', 'Professeur 5', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `id_horaire` int(11) NOT NULL,
  `jour_horaire` varchar(50) DEFAULT NULL,
  `heure_debut_horaire` time DEFAULT NULL,
  `heure_fin_horaire` time DEFAULT NULL,
  `id_ue` bigint(20) DEFAULT NULL,
  `id_salle` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id_horaire`, `jour_horaire`, `heure_debut_horaire`, `heure_fin_horaire`, `id_ue`, `id_salle`) VALUES
(1, 'Lundi', '08:00:00', '10:00:00', 1, 1),
(2, 'Mardi', '14:00:00', '16:00:00', 2, 2),
(3, 'Mercredi', '10:30:00', '12:30:00', 2, 3),
(4, 'Jeudi', '13:00:00', '15:00:00', 4, 4),
(5, 'Vendredi', '16:30:00', '18:30:00', 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` bigint(20) NOT NULL,
  `nom_salle` varchar(50) DEFAULT NULL,
  `capacite_salle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `nom_salle`, `capacite_salle`) VALUES
(1, 'Salle A', 50),
(2, 'Salle B', 40),
(3, 'Salle C', 30),
(4, 'Salle D', 60),
(5, 'Salle E', 35);

-- --------------------------------------------------------

--
-- Structure de la table `ue`
--

CREATE TABLE `ue` (
  `id_ue` bigint(20) NOT NULL,
  `code_ue` varchar(50) DEFAULT NULL,
  `nom_ue` varchar(50) DEFAULT NULL,
  `id_enseignant` bigint(20) DEFAULT NULL,
  `id_classe` bigint(20) DEFAULT NULL,
  `semestre` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ue`
--

INSERT INTO `ue` (`id_ue`, `code_ue`, `nom_ue`, `id_enseignant`, `id_classe`, `semestre`) VALUES
(1, 'UE101', 'Introduction à la Programmation', 2, 1, 1),
(2, 'UE102', 'Bases de Données', 3, 1, 1),
(3, 'UE103', 'Réseaux Informatiques', 4, 1, 1),
(4, 'UE104', 'Intelligence Artificielle', 5, 2, 1),
(5, 'UE105', 'Sécurité des Systèmes', 6, 2, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `FK_classe_id_departement` (`id_departement`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_enseignant`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id_horaire`),
  ADD KEY `FK_horaire_id_ue` (`id_ue`),
  ADD KEY `FK_horaire_id_salle` (`id_salle`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- Index pour la table `ue`
--
ALTER TABLE `ue`
  ADD PRIMARY KEY (`id_ue`),
  ADD KEY `FK_ue_id_enseignant` (`id_enseignant`),
  ADD KEY `FK_ue_id_classe` (`id_classe`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_classe` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_enseignant` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `id_horaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ue`
--
ALTER TABLE `ue`
  MODIFY `id_ue` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `FK_classe_id_departement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`);

--
-- Contraintes pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD CONSTRAINT `FK_horaire_id_salle` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`),
  ADD CONSTRAINT `FK_horaire_id_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`);

--
-- Contraintes pour la table `ue`
--
ALTER TABLE `ue`
  ADD CONSTRAINT `FK_ue_id_classe` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`),
  ADD CONSTRAINT `FK_ue_id_enseignant` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
