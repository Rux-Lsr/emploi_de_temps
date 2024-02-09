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
        <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include_once "templates/fixedNavBar.php";?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <?php include_once "templates/sideBar.php" ?>
                <main>
                <h1 class="my-4">Desiderata</h1>
                    <table id="desiderataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <td scope="col">#</td>
                                <th scope="col">Enseignant</th>
                                <th scope="col">Jour</th>
                                <th scope="col">Heure début</th>
                                <th scope="col">Heure fin</th>
                                <td scope="col">Actions</td>
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
                                    <a type="button" class="btn" name="sub" title="valider"><i class="fas fa-check-circle" style="color: green;"></i></a>
                                    <a type="button" class="btn " title="modifier"><i class="fas fa-edit" style="color: yellow;"></i></a>
                                    <a type="button" class="btn " title="Supprimer"><i class="fas fa-check-circle" style="color: red;"></i></a>
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
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#desiderataTable').DataTable();

                // Ajouter les boîtes de recherche
                $('#desiderataTable thead th').each(function() {
                    var title = $(this).text();
                    $(this).html(title+'<br><input type="text" placeholder="Rechercher" />');
                });

                // Appliquer le filtre
                table.columns().every(function() {
                    var that = this;
                    $('input', this.header()).on('keyup change', function() {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            });
        </script>
    </body>
</html>
