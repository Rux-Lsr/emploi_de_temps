-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 14 fév. 2024 à 15:45
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
-- Base de données : `planningu`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `departementid` int(11) DEFAULT NULL,
  `niveau` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `nom`, `departementid`, `niveau`) VALUES
(1, 'Classe 1', 1, 1),
(2, 'Classe 2', 1, 2),
(3, 'Classe 3', 2, 1),
(4, 'Classe 4', 2, 2),
(5, 'Classe 5', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `nom`) VALUES
(1, 'Département 1'),
(2, 'Département 2');

-- --------------------------------------------------------

--
-- Structure de la table `desiderata`
--

CREATE TABLE `desiderata` (
  `id` int(11) NOT NULL,
  `enseignantid` int(11) DEFAULT NULL,
  `jour_id` int(11) DEFAULT NULL,
  `horaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `desiderata`
--

INSERT INTO `desiderata` (`id`, `enseignantid`, `jour_id`, `horaire_id`) VALUES
(1, 1, 3, 1),
(2, 1, 3, 4),
(3, 1, 1, 1),
(4, 2, 2, 2),
(5, 3, 3, 4),
(6, 4, 4, 4),
(7, 5, 5, 1),
(8, 6, 1, 3),
(9, 1, 2, 4),
(10, 2, 3, 1),
(11, 3, 4, 2),
(12, 4, 5, 3),
(13, 5, 1, 4),
(14, 6, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `email`) VALUES
(1, 'admin', 'admin@gmail.com'),
(2, 'Enseignant 2', 'enseignant2@email.com'),
(3, 'Enseignant 3', 'enseignant3@email.com'),
(4, 'Enseignant 4', 'enseignant4@email.com'),
(5, 'Enseignant 5', 'enseignant5@email.com'),
(6, 'Enseignant 6', 'enseignant6@email.com');

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `id` int(7) NOT NULL,
  `heuredebut` time DEFAULT NULL,
  `heurefin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id`, `heuredebut`, `heurefin`) VALUES
(1, '07:30:00', '09:31:00'),
(2, '09:45:00', '11:45:00'),
(3, '12:00:00', '14:00:00'),
(4, '14:15:00', '16:15:00');

-- --------------------------------------------------------

--
-- Structure de la table `jour`
--

CREATE TABLE `jour` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jour`
--

INSERT INTO `jour` (`id`, `nom`) VALUES
(4, 'Jeudi'),
(1, 'Lundi'),
(2, 'Mardi'),
(3, 'Mercredi'),
(6, 'Samedi'),
(5, 'Vendredi');

-- --------------------------------------------------------

--
-- Structure de la table `modification`
--

CREATE TABLE `modification` (
  `id` int(11) NOT NULL,
  `planningid` int(11) DEFAULT NULL,
  `datemodification` date DEFAULT NULL,
  `heuredebutprecedente` time DEFAULT NULL,
  `heurefinprecedente` time DEFAULT NULL,
  `heuredebutnouvelle` time DEFAULT NULL,
  `heurefinnouvelle` time DEFAULT NULL,
  `utilisateurid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `periodemodification`
--

CREATE TABLE `periodemodification` (
  `id` int(11) NOT NULL,
  `datedebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `classeid` int(11) DEFAULT NULL,
  `uecode` varchar(10) DEFAULT NULL,
  `salleid` int(11) DEFAULT NULL,
  `jour_id` int(11) DEFAULT NULL,
  `horaire_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `capacite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `nom`, `capacite`) VALUES
(1, 'S001', 50);

-- --------------------------------------------------------

--
-- Structure de la table `ue`
--

CREATE TABLE `ue` (
  `code` varchar(10) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `enseignantid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ue`
--

INSERT INTO `ue` (`code`, `nom`, `enseignantid`) VALUES
('UE1', 'UE 1', 1),
('UE2', 'UE 2', 2),
('UE3', 'UE 3', 3),
('UE4', 'UE 4', 4),
('UE5', 'UE 5', 5),
('UE6', 'UE 6', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departementid` (`departementid`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `desiderata`
--
ALTER TABLE `desiderata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enseignantid` (`enseignantid`),
  ADD KEY `desiderata_fk_jour` (`jour_id`),
  ADD KEY `desiderata_ibfk_horaire` (`horaire_id`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jour`
--
ALTER TABLE `jour`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `modification`
--
ALTER TABLE `modification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planningid` (`planningid`);

--
-- Index pour la table `periodemodification`
--
ALTER TABLE `periodemodification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horaire_id` (`horaire_id`),
  ADD KEY `jour_id` (`jour_id`),
  ADD KEY `classeid` (`classeid`),
  ADD KEY `uecode` (`uecode`),
  ADD KEY `salleid` (`salleid`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `ue`
--
ALTER TABLE `ue`
  ADD PRIMARY KEY (`code`),
  ADD KEY `enseignantid` (`enseignantid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `desiderata`
--
ALTER TABLE `desiderata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_1` FOREIGN KEY (`departementid`) REFERENCES `departement` (`id`);

--
-- Contraintes pour la table `desiderata`
--
ALTER TABLE `desiderata`
  ADD CONSTRAINT `desiderata_fk_jour` FOREIGN KEY (`jour_id`) REFERENCES `jour` (`id`),
  ADD CONSTRAINT `desiderata_ibfk_1` FOREIGN KEY (`enseignantid`) REFERENCES `enseignant` (`id`),
  ADD CONSTRAINT `desiderata_ibfk_horaire` FOREIGN KEY (`horaire_id`) REFERENCES `horaire` (`id`);

--
-- Contraintes pour la table `modification`
--
ALTER TABLE `modification`
  ADD CONSTRAINT `modification_ibfk_1` FOREIGN KEY (`planningid`) REFERENCES `planning` (`id`);

--
-- Contraintes pour la table `planning`
--
ALTER TABLE `planning`
  ADD CONSTRAINT `planning_ibfk_1` FOREIGN KEY (`horaire_id`) REFERENCES `horaire` (`id`),
  ADD CONSTRAINT `planning_ibfk_2` FOREIGN KEY (`jour_id`) REFERENCES `jour` (`id`),
  ADD CONSTRAINT `planning_ibfk_3` FOREIGN KEY (`classeid`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `planning_ibfk_4` FOREIGN KEY (`uecode`) REFERENCES `ue` (`code`),
  ADD CONSTRAINT `planning_ibfk_5` FOREIGN KEY (`salleid`) REFERENCES `salle` (`id`);

--
-- Contraintes pour la table `ue`
--
ALTER TABLE `ue`
  ADD CONSTRAINT `ue_ibfk_1` FOREIGN KEY (`enseignantid`) REFERENCES `enseignant` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
