<?php
// Fonction pour récupérer les enseignants
function getEnseignants() {
    // Remplacez ces informations par celles de votre base de données
   require_once "connexion.php";

    try {
        // Connexion à la base de données
        
        // Requête pour récupérer les enseignants
        $sql = "SELECT e.id_enseignant as id, e.nom_enseignant as nom, e.email_enseignant as email FROM enseignant e";
        $stmt = $connexion->query($sql);
        $enseignants = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $enseignants;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return []; // Retourne un tableau vide en cas d'erreur
    }
}


function getUes() {
    // Remplacez ces informations par celles de votre base de données
   require_once "connexion.php";

    try {
        // Connexion à la base de données
        
        // Requête pour récupérer les enseignants
        $sql = "SELECT `id_ue` as id, `code_ue` as code, `nom_ue` as nom_ue, `semestre`, nom_enseignant as ens FROM `ue` JOIN enseignant on ue.id_enseignant=enseignant.id_enseignant;";
        $stmt = $connexion->query($sql);
        $ues = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $ues;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return []; // Retourne un tableau vide en cas d'erreur
    }
}


