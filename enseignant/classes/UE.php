<?php
class UE {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create
    public function create($code, $nom, $id_enseignant, $semestre) {
        $sql = "INSERT INTO ue (code_ue, nom_ue, id_enseignant, semestre) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$code, $nom, $id_enseignant, $semestre]);
    }

    // Read
    public function read() {
        $sql = "SELECT `id_ue` as id, `code_ue` as code, `nom_ue` as nom_ue, `semestre`, nom_enseignant as ens FROM `ue` JOIN enseignant on ue.id_enseignant=enseignant.id_enseignant;";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $code, $nom, $id_enseignant, $semestre) {
        $sql = "UPDATE ue SET code_ue = ?, nom_ue = ?, id_enseignant = ?, semestre = ? WHERE id_ue = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$code, $nom, $id_enseignant, $semestre, $id]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM ue WHERE id_ue = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}

// Similar classes can be created for the other tables: Departement, Horaire, Salle, Classe
