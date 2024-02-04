<?php
class Enseignant {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($email, $nom) {
        $sql = "INSERT INTO enseignant (email_enseignant, nom_enseignant) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $nom]);
    }

    // Read
    public function read() {
        $sql = "SELECT e.id_enseignant as id, e.nom_enseignant as nom, e.email_enseignant as email FROM enseignant e";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $email, $nom) {
        $sql = "UPDATE enseignant SET email_enseignant = ?, nom_enseignant = ? WHERE id_enseignant = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $nom, $id]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM enseignant WHERE id_enseignant = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
