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
    }
    
   