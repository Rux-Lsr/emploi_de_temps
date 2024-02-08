<?php
class Salle {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($nom, $capacite) {
        $stmt = $this->pdo->prepare("INSERT into salle(nom, capacite) value(?, ?)");
        $stmt->bindParam(1, $nom, PDO::PARAM_STR);
        $stmt->bindParam(2, $capacite, PDO::PARAM_INT);
        $stmt->execute();
    }
    

    // Read
    public function read() {
        $stmt = $this->pdo->query("SELECT * FROM salle");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Update
    public function update($id, $nom, $capacite) {
        $stmt = $this->pdo->prepare("CALL UpdateSalle(?, ?, ?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $nom, PDO::PARAM_STR);
        $stmt->bindParam(3, $capacite, PDO::PARAM_INT);
        $stmt->execute();
    }
    

    // Delete
    public function delete($id) {
        $stmt = $this->pdo->prepare("CALL DeleteFromSalle(?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
}

