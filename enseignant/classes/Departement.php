<?php
class Departement {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($nom) {
        $sql = "INSERT INTO departement (nom_departement) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom]);
    }

    // Read
    public function read() {
        $sql = "SELECT * FROM departement";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $nom) {
        $sql = "UPDATE departement SET nom_departement = ? WHERE id_departement = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $id]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM departement WHERE id_departement = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}

// Similar classes can be created for the other tables: Horaire, Salle, Classe
