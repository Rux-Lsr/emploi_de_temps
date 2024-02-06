<?php session_start() ;
    
    if(!isset($_SESSION['user']) || empty($_SESSION['user']))
        header('Location: ..\error_pages\401.php');

        include_once("include/connexion.php");
        include_once("classes/Classe.php");
        include_once("classes/Horaire.php");
        $hors = new Horaire($connexion);
        $result = $hors->read_horaire_ue_salle(1);
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
                    </div>  
                </main>
               
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/simple-da tatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="js/datatables-simple-demo.js"></script> -->
    </body>
</html>
