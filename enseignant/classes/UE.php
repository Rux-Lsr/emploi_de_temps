<?php
class UE {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($code, $nom, $id_enseignant, $semestre) {
        $stmt = $this->pdo->prepare("CALL InsertIntoUe(?, ?, ?, ?)");
        $stmt->bindParam(1, $code, PDO::PARAM_STR);
        $stmt->bindParam(2, $nom, PDO::PARAM_STR);
        $stmt->bindParam(3, $id_enseignant, PDO::PARAM_INT);
        $stmt->bindParam(4, $semestre, PDO::PARAM_STR);
        $stmt->execute();
    }
    

    // Read
    public function read() {
        $stmt = $this->pdo->query("SELECT * FROM ViewUe");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Update
    public function update($id, $code, $nom, $id_enseignant, $semestre = 1) {
        $stmt = $this->pdo->prepare("CALL UpdateUe(?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $code, PDO::PARAM_STR);
        $stmt->bindParam(3, $nom, PDO::PARAM_STR);
        $stmt->bindParam(4, $id_enseignant, PDO::PARAM_INT);
        $stmt->bindParam(5, $semestre, PDO::PARAM_STR);
        $stmt->execute();
    }
    

    // Delete
    public function delete($id) {
        $stmt = $this->pdo->prepare("CALL DeleteFromUe(?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
}

// Similar classes can be created for the other tables: Departement, Horaire, Salle, Classe
