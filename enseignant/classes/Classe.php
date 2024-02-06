<?php
class Classe {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($nom, $code, $effectif, $annee_academique, $id_departement) {
        $stmt = $this->pdo->prepare("CALL InsertIntoClasse(?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $nom, PDO::PARAM_STR);
        $stmt->bindParam(2, $code, PDO::PARAM_STR);
        $stmt->bindParam(3, $effectif, PDO::PARAM_INT);
        $stmt->bindParam(4, $annee_academique, PDO::PARAM_STR);
        $stmt->bindParam(5, $id_departement, PDO::PARAM_INT);
        $stmt->execute();
    }
    

    // Read
    public function read() {
        $sql = "SELECT * FROM vue_classe";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function readParam($depart) {
        $stmt = $this->pdo->prepare("CALL SelectClasseDepartement(?)");
        $stmt->bindParam(1, $depart, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $nom, $code, $effectif, $annee_academique, $id_departement) {
        $stmt = $this->pdo->prepare("CALL UpdateClasse(?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $nom, PDO::PARAM_STR);
        $stmt->bindParam(2, $code, PDO::PARAM_STR);
        $stmt->bindParam(3, $effectif, PDO::PARAM_INT);
        $stmt->bindParam(4, $annee_academique, PDO::PARAM_STR);
        $stmt->bindParam(5, $id_departement, PDO::PARAM_INT);
        $stmt->bindParam(6, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    

    // Delete
    public function delete($id) {
        $stmt = $this->pdo->prepare("CALL DeleteFromClasse(?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
}
