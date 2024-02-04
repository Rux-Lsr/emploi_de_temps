
DROP TABLE IF EXISTS enseignant ;
CREATE TABLE enseignant (id_enseignant BIGINT AUTO_INCREMENT NOT NULL, email_enseignant VARCHAR(50), nom_enseignant VARCHAR(50), mdp_enseignant VARCHAR(50), PRIMARY KEY (id_enseignant)) ENGINE=InnoDB; 
DROP TABLE IF EXISTS ue ; 
CREATE TABLE ue (id_ue BIGINT AUTO_INCREMENT NOT NULL, code_ue VARCHAR(50), nom_ue VARCHAR(50), id_enseignant bigint
, id_classe bigint
, PRIMARY KEY (id_ue)) ENGINE=InnoDB;  
DROP TABLE IF EXISTS departement ; CREATE TABLE departement (id_departement BIGINT AUTO_INCREMENT NOT NULL, nom_departement VARCHAR(50), PRIMARY KEY (id_departement)) ENGINE=InnoDB
;  
DROP TABLE IF EXISTS horaire ; 
CREATE TABLE horaire (id_horaire INT AUTO_INCREMENT NOT NULL, jour_horaire VARCHAR(50), heure_debut_horaire TIME, heure_fin_horaire TIME, id_ue bigint
, id_salle bigint
, PRIMARY KEY (id_horaire)) ENGINE=InnoDB;  
DROP TABLE IF EXISTS salle ; CREATE TABLE salle (id_salle BIGINT AUTO_INCREMENT NOT NULL, nom_salle VARCHAR(50), capacite_salle INT, PRIMARY KEY (id_salle)) ENGINE=InnoDB;  
DROP TABLE IF EXISTS classe ;
CREATE TABLE classe (id_classe BIGINT AUTO_INCREMENT NOT NULL, nom_classe VARCHAR(50), code_classe VARCHAR(50), effectif_classe BIGINT, id_departement bigint
, PRIMARY KEY (id_classe)) ENGINE=InnoDB;  
