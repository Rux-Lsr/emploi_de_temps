<?php 
session_start();
    require_once "include/connexion.php";
    $sal  = $connexion->query("SELECT * FROM horaire order by id asc", PDO::FETCH_ASSOC);
    $jours = $connexion->query("SELECT * FROM jour order by id asc", PDO::FETCH_ASSOC);
    $desideratas  = $connexion->query("SELECT desiderata.id, j.nom as jour, h.heuredebut, h.heurefin FROM desiderata join jour j on j.id = jour_id join horaire h on h.id=horaire_id join enseignant on enseignant.id= enseignantid where enseignantid = {$_SESSION["user"]["id"]} order by jour  asc", PDO::FETCH_ASSOC);
    $stmt = null;

    if(isset($_POST["sub"])){
        $stmt = $connexion->prepare("INSERT INTO `desiderata`(`enseignantid`, `jour_id`, `horaire_id`) VALUES ('{$_SESSION["user"]["id"]}','{$_POST["jour"]}','{$_POST["horaire"]}')");
        $res = $stmt->execute();

        if($res)
            echo"<script>alert('Desirata soumis avec success');location.href='index.php'</script>";
        else
            echo"<script>alert('Echec de soumission du desideratsa');location.href='index.php'</script>";
    }

    if(isset($_POST["del"])){
        $sql = "DELETE FROM desiderata where id = {$_POST['del']}";
        $stmt = $connexion->prepare("$sql");
        $res = $stmt->execute();

        if($res)
            echo"<script>alert('Supression reussie');location.href='index.php'</script>";
        else
            echo"<script>alert('Echec de suppression');location.href='index.php'</script>";
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
            <div id="layoutSidenav_content">
   
                <main>
                    
                <div class="container">
                    <h2>Formulaire de Désidérata</h2>
                    <form action="" method="post">
                    <div class="form-group">
                        <label for="jour">Jour:</label>
                        <select class="form-control" id="jour" name="jour">
                            <?php foreach($jours as $sall):?>
                                <option value="<?=$sall["id"]?>"><?=$sall["nom"]?></option>
                                <?php endforeach;  ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horaire">Plage horaire:</label>
                        <select class="form-control" id="horaire" name="horaire">
                        <?php foreach($sal as $horaire):?>
                                <option value="<?=$horaire["id"]?>"><?=$horaire["heuredebut"]?>-<?=$horaire["heurefin"]?></option>
                                <?php endforeach;  ?>
                        </select>
                    </div><br>
                        <button type="submit" class="btn btn-primary" name="sub">Soumettre</button>
                    </form>
                </div>  
                <h2>Liste des desideratas</h2>
                <div class="container">
                <table class="table table-striped">
            <thead>
                <tr>
                    <th>Jour</th>
                    <th>Heure de début</th>
                    <th>Heure de fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Remplacez ces lignes par les données de votre base de données -->
                <?php 
                $cpt = 0;
                    foreach($desideratas as $des):
                ?>
                <form action="" method="post" id="<?=(++$cpt)?>">
                    <tr>
                        <td><?=$des["jour"]?></td>
                        <td><?=$des["heuredebut"]?></td>
                        <td><?=$des["heurefin"]?></td>
                        <td>
                            <a class="btn btn-primary" name="modif" href="modifier.php?id=<?=$des['id']?>">Modifier</a>
                            <button type="submit" class="btn btn-danger" name="del" value="<?=$des['id']?>">Supprimer</button>
                        </td>
                    </tr>
                </form>
                <?php endforeach;?>
                <!-- Fin des données de la base de données -->
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
