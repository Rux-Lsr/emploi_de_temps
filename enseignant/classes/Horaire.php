<?php
    class Horaire {
        private $pdo;
    
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }
    
        // Create
        public function create($jour, $heure_debut, $heure_fin, $id_classe, $id_ue, $id_salle) {
            $stmt = $this->pdo->prepare("CALL InsertIntoHoraire(?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $jour, PDO::PARAM_STR);
            $stmt->bindParam(2, $heure_debut, PDO::PARAM_STR);
            $stmt->bindParam(3, $heure_fin, PDO::PARAM_STR);
            $stmt->bindParam(4, $id_classe, PDO::PARAM_INT);
            $stmt->bindParam(5, $id_ue, PDO::PARAM_INT);
            $stmt->bindParam(6, $id_salle, PDO::PARAM_INT);
            $stmt->execute();
        }
        
    
        // Read
        public function read() {
            $stmt = $this->pdo->query("SELECT * FROM viewhoraire");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    
        // Update
        public function update($id, $jour, $heure_debut, $heure_fin, $id_classe, $id_ue, $id_salle) {
            $stmt = $this->pdo->prepare("CALL UpdateHoraire(?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $jour, PDO::PARAM_INT);
            $stmt->bindParam(3, $heure_debut, PDO::PARAM_STR);
            $stmt->bindParam(4, $heure_fin, PDO::PARAM_STR);
            $stmt->bindParam(5, $id_classe, PDO::PARAM_INT);
            $stmt->bindParam(6, $id_ue, PDO::PARAM_INT);
            $stmt->bindParam(7, $id_salle, PDO::PARAM_INT);
            $stmt->execute();
        }
        
    
        // Delete
        public function delete($id) {
            $stmt = $this->pdo->prepare("CALL DeleteFromHoraire(?)");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        

        public function read_horaire_ue_salleParam($semestre, $salle) {
            $stmt = $this->pdo->prepare("CALL ReadHoraireUeSalleParam(?, ?)");
            $stmt->bindParam(1, $semestre, PDO::PARAM_STR);
            $stmt->bindParam(2, $salle, PDO::PARAM_INT);
            $stmt->execute();
        
            // Récupération des résultats 
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }

 

        public function read_horaire_ue_salle() {
            
        
            // Requête SQL pour récupérer les horaires
            $sql = "SELECT nom_jour, heure_debut_horaire, heure_fin_horaire, nom_ue, nom_enseignant, nom_salle 
            FROM horaire 
            JOIN ue ON horaire.id_ue = ue.id_ue 
            join classe on classe.id_classe = ue.id_classe
            JOIN enseignant ON ue.id_enseignant = enseignant.id_enseignant 
            JOIN salle ON horaire.id_salle = salle.id_salle
            join jour j on j.id_jour= horaire.id_jour;
            WHERE 1 ORDER BY id_jour, heure_debut_horaire";
        
            // Préparation de la requête
            $stmt = $this->pdo->prepare($sql); 
        
            // Liaison des paramètres et exécution de la requête
            
            $stmt->execute();
        
            // Récupération des résultats 
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
        }
        
        
    }
    
   