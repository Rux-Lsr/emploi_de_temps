<?php 
session_start();
    require_once "include/connexion.php";
    $sal  = $connexion->query("SELECT * FROM horaire order by id asc", PDO::FETCH_ASSOC);
    $jours = $connexion->query("SELECT * FROM jour order by id asc", PDO::FETCH_ASSOC);
    $desideratas  = $connexion->query("SELECT desiderata.id, e.nom as Enseignant, j.nom as jour, h.heuredebut as debut, h.heurefin as fin from desiderata join enseignant e on e.id=enseignantid join jour j on j.id=jour_id JOIN horaire h on horaire_id=h.id;", PDO::FETCH_ASSOC);
    $stmt = null;

   if(isset($_POST["sub"])){
        $stmt = $connexion->prepare("INSERT INTO `desiderata`(`enseignantid`, `jour_id`, `horaire_id`) VALUES ('{$_SESSION["user"]["id"]}','{$_POST["jour"]}','{$_POST["horaire"]}')");
        $stmt->execute();
        echo"<script>alert('Desirata soumis avec success')</script>";
    }else
        echo"<script>alert('Echec de soumission du  Desirata')</script>";


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
            <div id="layoutSidenav_content">
            <?php include_once "templates/sideBar.php" ?>
                <main>
                <h1 class="my-4">Desiderata</h1>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Enseignant</th>
                                <th scope="col">Jour</th>
                                <th scope="col">Heure début</th>
                                <th scope="col">Heure fin</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Remplacer par les données dynamiques -->
                            <?php foreach($desideratas as $des):?>
                            <tr>
                                <th scope="row"><?=$des["id"]?></th>
                                <td><?=$des["Enseignant"]?></td>
                                <td><?=$des["jour"]?></td>
                                <td><?=$des["debut"]?></td>
                                <td><?=$des["fin"]?></td>
                                <td>
                                    <button type="button" class="btn btn-success" name="sub">Valider</button>
                                    <button type="button" class="btn btn-primary">Modifier</button>
                                    <button type="button" class="btn btn-danger">Supprimer</button>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <!-- Fin des données dynamiques -->
                        </tbody>
                    </table>
                </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
     
    </body>
</html>
