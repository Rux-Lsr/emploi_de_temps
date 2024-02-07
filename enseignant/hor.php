<?php session_start() ;
    
    if(!isset($_SESSION['user']) || empty($_SESSION['user']))
        header('Location: ..\error_pages\401.php');

        require_once("include/connexion.php");
        require_once("classes/Classe.php");
        require_once("classes/Horaire.php");
        $hors = new Horaire($connexion);
        $result = $hors->read();

        if (isset($_POST["sub"])) {
            $result = $hors->read_horaire_ue_salleParam($_POST["semestre"], $_POST["groupe"]);
        }
        ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard ens - Gestion de requette</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="sb-nav-fixed">
        <?php include_once "templates/fixedNavBar.php";?>
        <div id="layoutSidenav">
            <!-- ; -->
            <div id="layoutSidenav_content">
            <?php include_once "templates/sideBar.php" ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="container">
                            <div class="row">
                                   <div class="col">
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
                            <select class="form-control" id="groupe" name="groupe" required>
                                
                                <?php
                                $class = new Classe($connexion);
                                
                                $res = $class->read();
                                // Génération des options de la liste déroulante
                                foreach ($res as $row) {
                                    echo '<option value="' . htmlspecialchars($row['id_classe']) . '">' . htmlspecialchars($row['nom_classe']) . '</option>';
                                }
                                ?>
                            </select>
                            </div><br>
                            <?php 
                                if(isset($_POST['sub'])) {
                                    $semestre = $_POST['semestre'];
                                    $groupe = $_POST['groupe'];
                                        
                                    $result = $hors->read_horaire_ue_salleParam($semestre, $groupe);
                                }
                            ?>
                            <button type="submit" class="btn btn-primary" name="sub">Afficher l'emploi du temps</button>
                        </form> 

                                   </div>  
                                   <div class="col">
                                   <form action="" method="post">
                                        <div class="form-group">
                                            <label for="salle">Salle:</label>
                                            <select class="form-control" id="salle" name="salle">
                                            <?php
                                                
                                                ?>
                                            </select>
                                        </div><br>
                                        <button type="submit" name="submit2" class="btn btn-primary">Choisir la salle</button>
                                    </form>
                                   </div>           
                            </div>
                        </div>
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
                            <?php 
                                if(count($result[0]) > 5) {
                                    ?>
                                        <tr>
                                <td><?= htmlspecialchars($row['nom_jour']) ?></td>
                                <td><?= htmlspecialchars($row['heure_debut_horaire']) ?></td>
                                <td><?= htmlspecialchars($row['heure_fin_horaire']) ?></td>
                                <td><?= htmlspecialchars($row['nom_ue']) ?></td>
                                <td><?= htmlspecialchars($row['nom_enseignant']) ?></td>
                                <td><?= htmlspecialchars($row['nom_salle']) ?></td>
                            </tr>
                                    <?php
                                }else{
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['nom_jour']) ?></td>
                                            <td><?= htmlspecialchars($row['heure_debut_horaire']) ?></td>
                                            <td><?= htmlspecialchars($row['heure_fin_horaire']) ?></td>
                                            <td><?= htmlspecialchars($row['ue'])?></td>
                                            <td></td>
                                            <td><?= htmlspecialchars($row['salle']) ?></td>
                                        </tr>
                                    <?php
                                } 
                            ?>
                            <?php endforeach; 
                                echo count($result);
                            ?>
                            </tbody>
                        </table>
                        </div>
                    </div>  
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
     
    </body>
</html>
