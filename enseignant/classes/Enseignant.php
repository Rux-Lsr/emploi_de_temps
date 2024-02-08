<?php
class Enseignant {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($nom, $email) {
        $sql = "INSERT INTO enseignant (nom, email) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $email]);
    }

    // Read
    public function read($id) {
        $sql = "SELECT * FROM enseignant WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function readP($nom, $email) {
        $sql = "SELECT * FROM enseignant where nom = ? and email=  ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $nom, $email) {
        $sql = "UPDATE enseignant SET nom = ?, email = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $email, $id]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM enseignant WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
