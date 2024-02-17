

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `departementid` int(11) DEFAULT NULL,
  `niveau` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `desiderata` (
  `id` int(11) NOT NULL,
  `enseignantid` int(11) DEFAULT NULL,
  `jour_id` int(11) DEFAULT NULL,
  `horaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `enseignant` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `horaire` (
  `id` int(7) NOT NULL,
  `heuredebut` time DEFAULT NULL,
  `heurefin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jour` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `periodemodification` (
  `id` int(11) NOT NULL,
  `datedebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `classeid` int(11) DEFAULT NULL,
  `uecode` varchar(10) DEFAULT NULL,
  `salleid` int(11) DEFAULT NULL,
  `jour_id` int(11) DEFAULT NULL,
  `horaire_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `capacite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ue` (
  `code` varchar(10) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `enseignantid` int(11) DEFAULT NULL,
  `classeid` int(11) DEFAULT NULL,
  `semestre` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departementid` (`departementid`);

ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `desiderata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enseignantid` (`enseignantid`),
  ADD KEY `desiderata_fk_jour` (`jour_id`),
  ADD KEY `desiderata_ibfk_horaire` (`horaire_id`);

ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `jour`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

ALTER TABLE `modification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planningid` (`planningid`);

ALTER TABLE `periodemodification`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horaire_id` (`horaire_id`),
  ADD KEY `jour_id` (`jour_id`),
  ADD KEY `classeid` (`classeid`),
  ADD KEY `uecode` (`uecode`),
  ADD KEY `salleid` (`salleid`);

ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

ALTER TABLE `ue`
  ADD PRIMARY KEY (`code`),
  ADD KEY `enseignantid` (`enseignantid`),
  ADD KEY `fk_classeid` (`classeid`);

--
ALTER TABLE `desiderata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `horaire`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

ALTER TABLE `planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_1` FOREIGN KEY (`departementid`) REFERENCES `departement` (`id`);

ALTER TABLE `desiderata`
  ADD CONSTRAINT `desiderata_fk_jour` FOREIGN KEY (`jour_id`) REFERENCES `jour` (`id`),
  ADD CONSTRAINT `desiderata_ibfk_1` FOREIGN KEY (`enseignantid`) REFERENCES `enseignant` (`id`),
  ADD CONSTRAINT `desiderata_ibfk_horaire` FOREIGN KEY (`horaire_id`) REFERENCES `horaire` (`id`);

ALTER TABLE `modification`
  ADD CONSTRAINT `modification_ibfk_1` FOREIGN KEY (`planningid`) REFERENCES `planning` (`id`);

ALTER TABLE `planning`
  ADD CONSTRAINT `planning_ibfk_1` FOREIGN KEY (`horaire_id`) REFERENCES `horaire` (`id`),
  ADD CONSTRAINT `planning_ibfk_2` FOREIGN KEY (`jour_id`) REFERENCES `jour` (`id`),
  ADD CONSTRAINT `planning_ibfk_3` FOREIGN KEY (`classeid`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `planning_ibfk_4` FOREIGN KEY (`uecode`) REFERENCES `ue` (`code`),
  ADD CONSTRAINT `planning_ibfk_5` FOREIGN KEY (`salleid`) REFERENCES `salle` (`id`);

ALTER TABLE `ue`
  ADD CONSTRAINT `fk_classeid` FOREIGN KEY (`classeid`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `ue_ibfk_1` FOREIGN KEY (`enseignantid`) REFERENCES `enseignant` (`id`);

