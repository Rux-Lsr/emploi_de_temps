<?php
    // Connexion à la base de données
    include_once("include/connexion.php");
    include_once("classes/Classe.php");
    include_once("classes/Horaire.php");
    $hors = new Horaire($connexion);
    $result = $hors->read_horaire_ue_salle(1);
?>

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
            $class = new Classe($connexion);
            
            $res = $class->readParam(1);
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
