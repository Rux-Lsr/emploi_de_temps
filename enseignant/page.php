<?php
// Connexion à la base de données
$dbh = new PDO('mysql:host=localhost;dbname=time_sc', 'root', '');

// Requête SQL pour récupérer les horaires
$sql = "SELECT jour_horaire, heure_debut_horaire, heure_fin_horaire, nom_ue, nom_enseignant, nom_salle 
        FROM horaire 
        JOIN ue ON horaire.id_ue = ue.id_ue 
        JOIN enseignant ON ue.id_enseignant = enseignant.id_enseignant 
        JOIN salle ON horaire.id_salle = salle.id_salle 
        WHERE semestre = :semestre AND id_classe = :id_classe 
        ORDER BY jour_horaire, heure_debut_horaire";

// Préparation de la requête
$stmt = $dbh->prepare($sql); // Exécution de la requête avec les paramètressouhaités 
$stmt->execute(['semestre' => 1, 'id_classe' => 1]);
// Récupération des résultats 
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Emploi du temps</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
  </head>
  <body>
    <div class="container">
      <h2>Emploi du temps</h2>
      <form action="" method="post">
    <div class="form-group">
      <label for="semestre">Semestre:</label>
      <select class="form-control" id="semestre" name="semestre">
        <option value="1">1</option>
        <option value="2">2</option>
      </select>
    </div>
    <div class="form-group">
      <label for="groupe">Groupe:</label>
      <select class="form-control" id="groupe" name="groupe">
        <?php
        // Requête SQL pour récupérer les groupes
        $sql = "SELECT id_classe, nom_classe FROM classe";
        // Préparation de la requête
        $stmt = $dbh->prepare($sql);
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Génération des options de la liste déroulante
        foreach ($res as $row) {
          echo '<option value="' . htmlspecialchars($row['id_classe']) . '">' . htmlspecialchars($row['nom_classe']) . '</option>';
        }
        ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Afficher l'emploi du temps</button>
  </form>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Jour</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>UE</th>
            <th>Enseignant</th>
            <th>Salle</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['jour_horaire']) ?></td>
            <td><?= htmlspecialchars($row['heure_debut_horaire']) ?></td>
            <td><?= htmlspecialchars($row['heure_fin_horaire']) ?></td>
            <td><?= htmlspecialchars($row['nom_ue']) ?></td>
            <td><?= htmlspecialchars($row['nom_enseignant']) ?></td>
            <td><?= htmlspecialchars($row['nom_salle']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
