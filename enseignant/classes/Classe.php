<?php
class Classe {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($nom, $code, $effectif, $annee_academique, $id_departement) {
        $sql = "INSERT INTO classe (nom_classe, code_classe, effectif_classe, annee_academique, id_departement) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $code, $effectif, $annee_academique, $id_departement]);
    }

    // Read
    public function read() {
        $sql = "SELECT * FROM classe";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $nom, $code, $effectif, $annee_academique, $id_departement) {
        $sql = "UPDATE classe SET nom_classe = ?, code_classe = ?, effectif_classe = ?, annee_academique = ?, id_departement = ? WHERE id_classe = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $code, $effectif, $annee_academique, $id_departement, $id]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM classe WHERE id_classe = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
