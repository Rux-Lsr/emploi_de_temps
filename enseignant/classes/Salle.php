<?php
class Salle {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($nom, $capacite) {
        $sql = "INSERT INTO salle (nom_salle, capacite_salle) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $capacite]);
    }

    // Read
    public function read() {
        $sql = "SELECT * FROM salle";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $nom, $capacite) {
        $sql = "UPDATE salle SET nom_salle = ?, capacite_salle = ? WHERE id_salle = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $capacite, $id]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM salle WHERE id_salle = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}

