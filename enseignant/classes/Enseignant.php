<?php
class Enseignant {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($email, $nom) {
        $stmt = $this->pdo->prepare("CALL InsertIntoEnseignant(?, ?)");
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $nom, PDO::PARAM_STR);
        $stmt->execute();
    }
    

    // Read
    public function read() {
        $stmt = $this->pdo->query("SELECT * FROM ViewEnseignant");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function readParam($mail, $mdp) {
        $stmt = $this->pdo->prepare("CALL ReadParamEnseignant(?, ?)");
        $stmt->bindParam(1, $mail, PDO::PARAM_STR);
        $stmt->bindParam(2, $mdp, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    // Update
    public function update($id, $email, $nom) {
        $stmt = $this->pdo->prepare("CALL UpdateEnseignant(?, ?, ?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $nom, PDO::PARAM_STR);
        $stmt->execute();
    }
    

    // Delete
    public function delete($id) {
        $stmt = $this->pdo->prepare("CALL DeleteFromEnseignant(?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
}
?>
