<?php
class Departement {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($nom) {
        $stmt = $this->pdo->prepare("CALL InsertIntoDepartement(?)");
        $stmt->bindParam(1, $nom, PDO::PARAM_STR);
        $stmt->execute();
    }
    

    // Read
    public function read() {
        $stmt = $this->pdo->query("SELECT * FROM ViewDepartement");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Update
    public function update($id, $nom) {
        $stmt = $this->pdo->prepare("CALL UpdateDepartement(?, ?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $nom, PDO::PARAM_STR);
        $stmt->execute();
    }
    

    // Delete
    public function delete($id) {
        $stmt = $this->pdo->prepare("CALL DeleteFromDepartement(?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
}

// Similar classes can be created for the other tables: Horaire, Salle, Classe
