CREATE TABLE departement (
    id INT PRIMARY KEY,
    nom VARCHAR(100)
);

CREATE TABLE classe (
    id INT PRIMARY KEY,
    nom VARCHAR(100),
    departementid INT,
    niveau INT,
    FOREIGN KEY (departementid) REFERENCES departement(id)
);

CREATE TABLE enseignant (
    id INT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100)
);

CREATE TABLE salle (
    id INT PRIMARY KEY,
    nom VARCHAR(100) UNIQUE,
    capacite INT
);

CREATE TABLE ue (
    code VARCHAR(10) PRIMARY KEY,
    nom VARCHAR(100),
    enseignantid INT,
    FOREIGN KEY (enseignantid) REFERENCES enseignant(id)
);

CREATE TABLE planning (
    id INT PRIMARY KEY,
    classeid INT,
    uecode VARCHAR(10),
    salleid INT,
    jour_id INT, 
    horaire_id int,
    FOREIGN key (horaire_id) references horaire(id),
    FOREIGN KEY (jour_id) REFERENCES jour(id),
    FOREIGN KEY (classeid) REFERENCES classe(id),
    FOREIGN KEY (uecode) REFERENCES ue(code),
    FOREIGN KEY (salleid) REFERENCES salle(id)
);

Create table horaire(
    id int primary key,
    heuredebut TIME,
    heurefin TIME,
);

CREATE TABLE jour(
    id INT PRIMARY KEY,
    nom VARCHAR(100) UNIQUE
);

CREATE TABLE desiderata (
    id INT PRIMARY KEY,
    enseignantid INT,
    jour VARCHAR(10),
    heuredebut TIME,
    heurefin TIME,
    FOREIGN KEY (enseignantid) REFERENCES enseignant(id)
);

CREATE TABLE periodemodification (
    id INT PRIMARY KEY,
    datedebut DATE,
    datefin DATE
);

CREATE TABLE modification (
    id INT PRIMARY KEY,
    planningid INT,
    datemodification DATE,
    heuredebutprecedente TIME,
    heurefinprecedente TIME,
    heuredebutnouvelle TIME,
    heurefinnouvelle TIME,
    utilisateurid INT,
    FOREIGN KEY (planningid) REFERENCES planning(id)
);

CREATE TABLE administrateur (
    id INT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100)
);
