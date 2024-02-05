<?php
    class Horaire {
        private $pdo;
    
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }
    
        // Create
        public function create($jour, $heure_debut, $heure_fin, $id_classe, $id_ue, $id_salle) {
            $sql = "INSERT INTO horaire (jour_horaire, heure_debut_horaire, heure_fin_horaire, id_classe, id_ue, id_salle) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$jour, $heure_debut, $heure_fin, $id_classe, $id_ue, $id_salle]);
        }
    
        // Read
        public function read() {
            $sql = "SELECT `id_horaire`, `jour_horaire`, `heure_debut_horaire`, `heure_fin_horaire`, ue.nom_ue, salle.nom_salle FROM `horaire` JOIN ue on ue.id_ue = horaire.id_ue JOIN salle ON horaire.id_salle=salle.id_salle";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Update
        public function update($id, $jour, $heure_debut, $heure_fin, $id_classe, $id_ue, $id_salle) {
            $sql = "UPDATE horaire SET jour_horaire = ?, heure_debut_horaire = ?, heure_fin_horaire = ?, id_classe = ?, id_ue = ?, id_salle = ? WHERE id_horaire = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$jour, $heure_debut, $heure_fin, $id_classe, $id_ue, $id_salle, $id]);
        }
    
        // Delete
        public function delete($id) {
            $sql = "DELETE FROM horaire WHERE id_horaire = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
        }

        public function read_horaire_ue_salleParam($semestre, $salle) {
            // Requête SQL pour récupérer les horaires
            $sql = "SELECT jour_horaire, heure_debut_horaire, heure_fin_horaire, nom_ue, nom_enseignant, nom_salle
            FROM horaire 
            JOIN ue ON horaire.id_ue = ue.id_ue 
            JOIN enseignant ON ue.id_enseignant = enseignant.id_enseignant 
            JOIN salle ON horaire.id_salle = salle.id_salle 
            WHERE semestre = :semestre AND id_classe = :id_classe 
            ORDER BY jour_horaire, heure_debut_horaire";

            // Préparation de la requête
            $stmt = $this->pdo->prepare($sql); // Exécution de la requête avec les paramètressouhaités 
            $stmt->execute(['semestre' => $semestre, 'id_classe' => $salle]);
            // Récupération des résultats 
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }

        public function read_horaire_ue_salle($id_depart) {
            // Requête SQL pour récupérer les horaires
            $sql = "SELECT jour_horaire, heure_debut_horaire, heure_fin_horaire, nom_ue, nom_enseignant, nom_salle 
            FROM horaire 
            JOIN ue ON horaire.id_ue = ue.id_ue 
            join classe on classe.id_classe = ue.id_classe
            JOIN enseignant ON ue.id_enseignant = enseignant.id_enseignant 
            JOIN salle ON horaire.id_salle = salle.id_salle
            where id_departement =".$id_depart." ORDER BY jour_horaire, heure_debut_horaire";

            // Préparation de la requête
            $stmt = $this->pdo->prepare($sql); // Exécution de la requête avec les paramètressouhaités 
            $stmt->execute();
            // Récupération des résultats 
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }
    }
    
   