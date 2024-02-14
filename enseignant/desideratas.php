<?php 
session_start();
    require_once "include/connexion.php";
    $sal  = $connexion->query("SELECT * FROM horaire order by id asc", PDO::FETCH_ASSOC);
    $jours = $connexion->query("SELECT * FROM jour order by id asc", PDO::FETCH_ASSOC);
    $desideratas  = $connexion->query("SELECT desiderata.id, e.nom as Enseignant, j.nom as jour, h.heuredebut as debut, h.heurefin as fin from desiderata join enseignant e on e.id=enseignantid join jour j on j.id=jour_id JOIN horaire h on horaire_id=h.id;", PDO::FETCH_ASSOC);
    $stmt = null;

   if(isset($_POST["valider"])){
        $sql = "INSERT INTO `planning` (`classeid`, `uecode`, `salleid`, `jour_id`, `horaire_id`)
        SELECT `classeid`, `uecode`, `salleid`, `jour_id`, `horaire_id`
        FROM `desiderata`
        WHERE `id` = {$_POST['valider']};";
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
                                <th scope="col">Horaire</th>
                                <td scope="col">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Remplacer par les données dynamiques -->
                            <?php foreach($desideratas as $des):?>
                                <form action="" method="post">
                                <tr>
                                    <th scope="row"><?=$des["id"]?></th>
                                    <td><?=$des["Enseignant"]?></td>
                                    <td><?=$des["jour"]?></td>
                                    <td><?=$des["debut"]?> - <?=$des["fin"]?></td>
                                    <td>
                                        <button type="submit" class="btn" name="valider" value="<?=$des["id"]?>" title="valider"><i class="fas fa-check-circle" style="color: green;"></i></button>
                                        <button type="submit" class="btn" name="Modifier" value="edit" title="modifier"><i class="fas fa-edit" style="color: yellow;"></i></button>
                                        <button type="submit" class="btn" name="supprimer" value="rm" title="Supprimer"><i class="fas fa-check-circle" style="color: red;"></i></button>
                                    </td>
                                </tr>
                                </form>
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
