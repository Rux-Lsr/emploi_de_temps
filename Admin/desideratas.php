<?php 
session_start();
    require_once "include/connexion.php";
    $sal  = $connexion->query("SELECT * FROM horaire order by id asc", PDO::FETCH_ASSOC);
    $jours = $connexion->query("SELECT * FROM jour order by id asc", PDO::FETCH_ASSOC);
    $desideratas  = $connexion->query("SELECT desiderata.id, e.nom as Enseignant, j.nom as jour, h.heuredebut as debut, h.heurefin as fin, `classe`.`nom` as classe
                                        from desiderata 
                                        join enseignant e on e.id=enseignantid 
                                        join jour j on j.id=jour_id 
                                        JOIN horaire h on horaire_id=h.id
                                        JOIN `ue` ON `ue`.`enseignantid` = `desiderata`.`enseignantid`
                                        join classe on ue.classeid=classe.id
                                        ", PDO::FETCH_ASSOC);
    $stmt = null;

    if(isset($_POST["valider"])){
        // Commencer la transaction
        $connexion->beginTransaction();
    
        // Préparer et exécuter la requête de vérification
        $sql0 = "SELECT COUNT(*) FROM `planning`
                 JOIN `ue` ON `ue`.`code` = `planning`.`uecode`
                 JOIN `desiderata` ON `ue`.`enseignantid` = `desiderata`.`enseignantid`
                 WHERE `desiderata`.`id` = {$_POST['valider']}
                 AND `planning`.`jour_id` = `desiderata`.`jour_id`
                 AND `planning`.`horaire_id` = `desiderata`.`horaire_id`";
        $stmt0 = $connexion->prepare($sql0);
        $stmt0->execute();
        $count = $stmt0->fetchColumn();
    
        if($count > 0){
            echo "<script>alert('L'enseignant a déjà choisi cette plage horaire.');location.href='desideratas.php'</script>";
        } else {
            // Préparer et exécuter la requête d'insertion
            $sql1 = "INSERT INTO `planning` (`classeid`, `uecode`, `jour_id`, `horaire_id`)
            SELECT `ue`.`classeid`, `ue`.`code`, `desiderata`.`jour_id`, `desiderata`.`horaire_id`
            FROM `desiderata`
            JOIN `ue` ON `ue`.`enseignantid` = `desiderata`.`enseignantid`
            WHERE `desiderata`.`id` = {$_POST['valider']}";
    
            $stmt = $connexion->prepare($sql1);
            $res = $stmt->execute();
    
            // Préparer et exécuter la requête de suppression
            $sql2 = "DELETE FROM desiderata where id = {$_POST['valider']}";
            $stmt2 = $connexion->prepare($sql2);
            $res2 = $stmt2->execute();
    
            if($res && $res2){
                // Si les deux opérations ont réussi, valider la transaction
                $connexion->commit();
                echo "<script>alert('Validation du desiderata réussie');location.href='desideratas.php'</script>";
            } else {
                // En cas d'erreur, annuler la transaction
                $connexion->rollBack();
                echo "<script>alert('Échec de validation du desiderata: " . $e->getMessage() . "');location.href='desideratas.php'</script>";
            }
        }
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
                <main>
                <h1 class="my-4">Desiderata</h1><?php var_dump($_POST);?>
                    <table id="desiderataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <td scope="col">#</td>
                                <th scope="col">Enseignant</th>
                                <th scope="col">Jour</th>
                                <th scope="col">Horaire</th>
                                <th scope="col">Classe</th>
                                <td scope="col">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Remplacer par les données dynamiques -->
                            <?php foreach($desideratas as $des):?>
                                
                                    <tr>
                                    <form action="" method="post"  id="<?=$des["id"]?>">
                                        <th scope="row"><?=$des["id"]?></th>
                                        <td><?=$des["Enseignant"]?></td>
                                        <td><?=$des["jour"]?></td>
                                        <td><?=$des["debut"]?> - <?=$des["fin"]?></td>
                                        <td><?=$des["classe"]?></td>
                                        <td>
                                            <button type="submit" class="btn" name="valider" value="<?=$des["id"]?>" title="valider"><i class="fas fa-check-circle" style="color: green;"></i> ok </button>
                                            <a name="modif" href="modifier.php?id=<?=$des['id']?>"><i class="fas fa-edit" style="color: yellow;"></i></a>
                                            <button type="submit" class="btn" name="del" value="<?=$des['id']?>"><i class="fas fa-check-circle" style="color: red;"></i></button>
                                        </td>
                                    </form>
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
               /* $('#desiderataTable thead th').each(function() {
                    var title = $(this).text();
                    $(this).html(title+'<br><input type="text" placeholder="Rechercher" />');
                });*/

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
