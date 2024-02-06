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
        $sql = "SELECT e.id_enseignant as id, e.nom_enseignant as nom, e.email_enseignant as email, priv FROM enseignant e";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function readParam($mail, $mdp) {
        $sql = "SELECT enseignant.id_enseignant, email_enseignant, nom_enseignant,nom_ue, id_departement, priv 
        from enseignant
        join ue on ue.id_enseignant = enseignant.id_enseignant
        JOIN classe on classe.id_classe = ue.id_classe where email_enseignant = :mail and mdp_enseignant = :mdp";
        $stm = $this->pdo->prepare($sql);
        $stm ->bindValue(':mail',$mail , PDO::PARAM_STR );
        $stm ->bindValue(':mdp' ,$mdp);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
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
