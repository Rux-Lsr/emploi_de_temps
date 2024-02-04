<?php
$serveur = "localhost"; // Remplacez par l'adresse de votre serveur MySQL
$utilisateur = "root"; // Remplacez par votre nom d'utilisateur MySQL
$mot_de_passe = ""; // Remplacez par votre mot de passe MySQL
$base_de_donnees = "time_sc"; // Remplacez par le nom de votre base de données

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    // Configure le mode d'erreur pour les exceptions
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

