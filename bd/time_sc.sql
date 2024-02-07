-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 07 fév. 2024 à 08:09
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

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `DeleteFromClasse`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteFromClasse` (IN `p_id_classe` INT)   BEGIN
    DELETE FROM classe WHERE id_classe = p_id_classe;
END$$

DROP PROCEDURE IF EXISTS `DeleteFromDepartement`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteFromDepartement` (IN `p_id_departement` INT)   BEGIN
    DELETE FROM departement WHERE id_departement = p_id_departement;
END$$

DROP PROCEDURE IF EXISTS `DeleteFromEnseignant`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteFromEnseignant` (IN `p_id_enseignant` INT)   BEGIN
    DELETE FROM enseignant WHERE id_enseignant = p_id_enseignant;
END$$

DROP PROCEDURE IF EXISTS `DeleteFromHoraire`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteFromHoraire` (IN `p_id` INT)   BEGIN
    DELETE FROM horaire WHERE id_horaire = p_id;
END$$

DROP PROCEDURE IF EXISTS `DeleteFromSalle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteFromSalle` (IN `p_id_salle` INT)   BEGIN
    DELETE FROM salle WHERE id_salle = p_id_salle;
END$$

DROP PROCEDURE IF EXISTS `DeleteFromUe`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteFromUe` (IN `p_id` INT)   BEGIN
    DELETE FROM ue WHERE id_ue = p_id;
END$$

DROP PROCEDURE IF EXISTS `InsertIntoClasse`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertIntoClasse` (IN `p_nom_classe` VARCHAR(255), IN `p_code_classe` VARCHAR(255), IN `p_effectif_classe` INT, IN `p_annee_academique` VARCHAR(255), IN `p_id_departement` INT)   BEGIN
    INSERT INTO classe (nom_classe, code_classe, effectif_classe, annee_academique, id_departement) 
    VALUES (p_nom_classe, p_code_classe, p_effectif_classe, p_annee_academique, p_id_departement);
END$$

DROP PROCEDURE IF EXISTS `InsertIntoDepartement`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertIntoDepartement` (IN `p_nom_departement` VARCHAR(255))   BEGIN
    INSERT INTO departement (nom_departement) VALUES (p_nom_departement);
END$$

DROP PROCEDURE IF EXISTS `InsertIntoEnseignant`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertIntoEnseignant` (IN `p_email_enseignant` VARCHAR(255), IN `p_nom_enseignant` VARCHAR(255))   BEGIN
    INSERT INTO enseignant (email_enseignant, nom_enseignant) VALUES (p_email_enseignant, p_nom_enseignant);
END$$

DROP PROCEDURE IF EXISTS `InsertIntoHoraire`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertIntoHoraire` (IN `p_jour` VARCHAR(255), IN `p_heure_debut` TIME, IN `p_heure_fin` TIME, IN `p_id_classe` INT, IN `p_id_ue` INT, IN `p_id_salle` INT)   BEGIN
    INSERT INTO horaire (jour_horaire, heure_debut_horaire, heure_fin_horaire, id_classe, id_ue, id_salle) 
    VALUES (p_jour, p_heure_debut, p_heure_fin, p_id_classe, p_id_ue, p_id_salle);
END$$

DROP PROCEDURE IF EXISTS `InsertIntoSalle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertIntoSalle` (IN `p_nom_salle` VARCHAR(255), IN `p_capacite_salle` INT)   BEGIN
    INSERT INTO salle (nom_salle, capacite_salle) VALUES (p_nom_salle, p_capacite_salle);
END$$

DROP PROCEDURE IF EXISTS `InsertIntoUe`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertIntoUe` (IN `p_code_ue` VARCHAR(255), IN `p_nom_ue` VARCHAR(255), IN `p_id_enseignant` INT, IN `p_semestre` VARCHAR(255))   BEGIN
    INSERT INTO ue (code_ue, nom_ue, id_enseignant, semestre) VALUES (p_code_ue, p_nom_ue, p_id_enseignant, p_semestre);
END$$

DROP PROCEDURE IF EXISTS `ReadHoraireUeSalle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ReadHoraireUeSalle` (IN `p_id_depart` INT)   BEGIN
    SELECT jour_horaire, heure_debut_horaire, heure_fin_horaire, nom_ue, nom_enseignant, nom_salle 
    FROM horaire 
    JOIN ue ON horaire.id_ue = ue.id_ue 
    JOIN classe ON classe.id_classe = ue.id_classe
    JOIN enseignant ON ue.id_enseignant = enseignant.id_enseignant 
    JOIN salle ON horaire.id_salle = salle.id_salle
    WHERE id_departement = p_id_depart 
    ORDER BY jour_horaire, heure_debut_horaire;
END$$

DROP PROCEDURE IF EXISTS `ReadHoraireUeSalleParam`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ReadHoraireUeSalleParam` (IN `p_semestre` VARCHAR(255), IN `p_id_classe` INT)   BEGIN
    SELECT nom_jour, heure_debut_horaire, heure_fin_horaire, nom_ue, nom_enseignant, nom_salle
    FROM horaire 
    JOIN ue ON horaire.id_ue = ue.id_ue 
    JOIN enseignant ON ue.id_enseignant = enseignant.id_enseignant 
    JOIN salle ON horaire.id_salle = salle.id_salle 
    join jour j on j.id_jour=horaire.id_jour
    WHERE semestre = p_semestre AND id_classe = p_id_classe 
    ORDER BY j.id_jour, heure_debut_horaire;
END$$

DROP PROCEDURE IF EXISTS `ReadParamEnseignant`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ReadParamEnseignant` (IN `p_mail` VARCHAR(255), IN `p_mdp` VARCHAR(255))   BEGIN
    SELECT enseignant.id_enseignant, email_enseignant, nom_enseignant, priv 
    FROM enseignant
     
    WHERE email_enseignant = p_mail AND mdp_enseignant = p_mdp;
END$$

DROP PROCEDURE IF EXISTS `SelectClasseDepartement`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectClasseDepartement` (IN `depart` INT)   BEGIN
    SELECT * FROM classe WHERE id_departement = depart;
END$$

DROP PROCEDURE IF EXISTS `UpdateClasse`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateClasse` (IN `p_nom_classe` VARCHAR(255), IN `p_code_classe` VARCHAR(255), IN `p_effectif_classe` INT, IN `p_annee_academique` VARCHAR(255), IN `p_id_departement` INT, IN `p_id_classe` INT)   BEGIN
    UPDATE classe 
    SET nom_classe = p_nom_classe, code_classe = p_code_classe, effectif_classe = p_effectif_classe, annee_academique = p_annee_academique, id_departement = p_id_departement 
    WHERE id_classe = p_id_classe;
END$$

DROP PROCEDURE IF EXISTS `UpdateEnseignant`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateEnseignant` (IN `p_id_enseignant` INT, IN `p_email_enseignant` VARCHAR(255), IN `p_nom_enseignant` VARCHAR(255))   BEGIN
    UPDATE enseignant SET email_enseignant = p_email_enseignant, nom_enseignant = p_nom_enseignant WHERE id_enseignant = p_id_enseignant;
END$$

DROP PROCEDURE IF EXISTS `UpdateHoraire`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateHoraire` (IN `p_id` INT, IN `p_jour` INT, IN `p_heure_debut` TIME, IN `p_heure_fin` TIME, IN `p_id_classe` INT, IN `p_id_ue` INT, IN `p_id_salle` INT)   BEGIN
    UPDATE horaire 
    SET jour_horaire = p_jour, heure_debut_horaire = p_heure_debut, heure_fin_horaire = p_heure_fin, id_classe = p_id_classe, id_ue = p_id_ue, id_salle = p_id_salle 
    WHERE id_horaire = p_id;
END$$

DROP PROCEDURE IF EXISTS `UpdateSalle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSalle` (IN `p_id_salle` INT, IN `p_nom_salle` VARCHAR(255), IN `p_capacite_salle` INT)   BEGIN
    UPDATE salle 
    SET nom_salle = p_nom_salle, capacite_salle = p_capacite_salle 
    WHERE id_salle = p_id_salle;
END$$

DROP PROCEDURE IF EXISTS `UpdateUe`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUe` (IN `p_id` INT, IN `p_code` VARCHAR(255), IN `p_nom` VARCHAR(255), IN `p_id_enseignant` INT, IN `p_semestre` VARCHAR(255))   BEGIN
    UPDATE ue 
    SET code_ue = p_code, nom_ue = p_nom, id_enseignant = p_id_enseignant, semestre = p_semestre 
    WHERE id_ue = p_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
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

DROP TABLE IF EXISTS `departement`;
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

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE `enseignant` (
  `id_enseignant` bigint(20) NOT NULL,
  `email_enseignant` varchar(50) DEFAULT NULL,
  `nom_enseignant` varchar(50) DEFAULT NULL,
  `mdp_enseignant` varchar(50) DEFAULT '0000',
  `priv` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `email_enseignant`, `nom_enseignant`, `mdp_enseignant`, `priv`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin2.0', 1),
(2, 'prof1@email.com', 'Professeur 1', '0000', 0),
(3, 'prof2@email.com', 'Professeur 2', NULL, 0),
(4, 'prof3@email.com', 'Professeur 3', NULL, 0),
(5, 'prof4@email.com', 'Professeur 4', NULL, 0),
(6, 'prof5@email.com', 'Professeur 5', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

DROP TABLE IF EXISTS `horaire`;
CREATE TABLE `horaire` (
  `id_horaire` int(11) NOT NULL,
  `id_jour` int(11) NOT NULL,
  `heure_debut_horaire` time DEFAULT NULL,
  `heure_fin_horaire` time DEFAULT NULL,
  `id_ue` bigint(20) DEFAULT NULL,
  `id_salle` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id_horaire`, `id_jour`, `heure_debut_horaire`, `heure_fin_horaire`, `id_ue`, `id_salle`) VALUES
(1, 1, '08:00:00', '10:00:00', NULL, 1),
(2, 2, '14:00:00', '16:00:00', NULL, 2),
(3, 3, '10:30:00', '12:30:00', NULL, 3),
(4, 4, '13:00:00', '15:00:00', NULL, 4),
(5, 5, '16:30:00', '18:30:00', NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `jour`
--

DROP TABLE IF EXISTS `jour`;
CREATE TABLE `jour` (
  `id_jour` int(11) NOT NULL,
  `nom_jour` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jour`
--

INSERT INTO `jour` (`id_jour`, `nom_jour`) VALUES
(1, 'lundi'),
(2, 'mardi'),
(3, 'mercredi'),
(4, 'jeudi'),
(5, 'vendredi'),
(6, 'samedi'),
(7, 'dimanche');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
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

DROP TABLE IF EXISTS `ue`;
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
(4, 'UE104', 'Intelligence Artificielle', 2, 2, 1),
(5, 'UE105', 'Sécurité des Systèmes', 2, 5, 1);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `viewdepartement`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `viewdepartement`;
CREATE TABLE `viewdepartement` (
`id_departement` bigint(20)
,`nom_departement` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `viewenseignant`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `viewenseignant`;
CREATE TABLE `viewenseignant` (
`id` bigint(20)
,`nom` varchar(50)
,`email` varchar(50)
,`priv` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `viewhoraire`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `viewhoraire`;
CREATE TABLE `viewhoraire` (
`nom_jour` text
,`heure_debut_horaire` time
,`heure_fin_horaire` time
,`salle` bigint(20)
,`ue` bigint(20)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `viewsalle`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `viewsalle`;
CREATE TABLE `viewsalle` (
`id_salle` bigint(20)
,`nom_salle` varchar(50)
,`capacite_salle` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `viewue`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `viewue`;
CREATE TABLE `viewue` (
`id` bigint(20)
,`code` varchar(50)
,`nom_ue` varchar(50)
,`semestre` int(11)
,`ens` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_classe`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_classe`;
CREATE TABLE `vue_classe` (
`id_classe` bigint(20)
,`nom_classe` varchar(50)
,`code_classe` varchar(50)
,`effectif_classe` bigint(20)
,`id_departement` bigint(20)
,`annee_academique` date
);

-- --------------------------------------------------------

--
-- Structure de la vue `viewdepartement`
--
DROP TABLE IF EXISTS `viewdepartement`;

DROP VIEW IF EXISTS `viewdepartement`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewdepartement`  AS SELECT `departement`.`id_departement` AS `id_departement`, `departement`.`nom_departement` AS `nom_departement` FROM `departement` ;

-- --------------------------------------------------------

--
-- Structure de la vue `viewenseignant`
--
DROP TABLE IF EXISTS `viewenseignant`;

DROP VIEW IF EXISTS `viewenseignant`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewenseignant`  AS SELECT `e`.`id_enseignant` AS `id`, `e`.`nom_enseignant` AS `nom`, `e`.`email_enseignant` AS `email`, `e`.`priv` AS `priv` FROM `enseignant` AS `e` ;

-- --------------------------------------------------------

--
-- Structure de la vue `viewhoraire`
--
DROP TABLE IF EXISTS `viewhoraire`;

DROP VIEW IF EXISTS `viewhoraire`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewhoraire`  AS SELECT `jour`.`nom_jour` AS `nom_jour`, `horaire`.`heure_debut_horaire` AS `heure_debut_horaire`, `horaire`.`heure_fin_horaire` AS `heure_fin_horaire`, `horaire`.`id_salle` AS `salle`, `horaire`.`id_ue` AS `ue` FROM (`horaire` join `jour` on(`jour`.`id_jour` = `horaire`.`id_jour`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `viewsalle`
--
DROP TABLE IF EXISTS `viewsalle`;

DROP VIEW IF EXISTS `viewsalle`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewsalle`  AS SELECT `salle`.`id_salle` AS `id_salle`, `salle`.`nom_salle` AS `nom_salle`, `salle`.`capacite_salle` AS `capacite_salle` FROM `salle` ;

-- --------------------------------------------------------

--
-- Structure de la vue `viewue`
--
DROP TABLE IF EXISTS `viewue`;

DROP VIEW IF EXISTS `viewue`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewue`  AS SELECT `ue`.`id_ue` AS `id`, `ue`.`code_ue` AS `code`, `ue`.`nom_ue` AS `nom_ue`, `ue`.`semestre` AS `semestre`, `enseignant`.`nom_enseignant` AS `ens` FROM (`ue` join `enseignant` on(`ue`.`id_enseignant` = `enseignant`.`id_enseignant`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_classe`
--
DROP TABLE IF EXISTS `vue_classe`;

DROP VIEW IF EXISTS `vue_classe`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_classe`  AS SELECT `classe`.`id_classe` AS `id_classe`, `classe`.`nom_classe` AS `nom_classe`, `classe`.`code_classe` AS `code_classe`, `classe`.`effectif_classe` AS `effectif_classe`, `classe`.`id_departement` AS `id_departement`, `classe`.`annee_academique` AS `annee_academique` FROM `classe` ;

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
  ADD KEY `FK_horaire_id_salle` (`id_salle`),
  ADD KEY `FK_horaire_id_jour` (`id_jour`);

--
-- Index pour la table `jour`
--
ALTER TABLE `jour`
  ADD PRIMARY KEY (`id_jour`);

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
-- AUTO_INCREMENT pour la table `jour`
--
ALTER TABLE `jour`
  MODIFY `id_jour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `FK_horaire_id_jour` FOREIGN KEY (`id_jour`) REFERENCES `jour` (`id_jour`) ON DELETE NO ACTION ON UPDATE CASCADE,
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
