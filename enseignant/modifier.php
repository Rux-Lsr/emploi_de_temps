<?php 
session_start();
    require_once "include/connexion.php";
    $sal  = $connexion->query("SELECT * FROM horaire order by id asc", PDO::FETCH_ASSOC);
    $jours = $connexion->query("SELECT * FROM jour order by id asc", PDO::FETCH_ASSOC);
   $stmt  = $connexion->prepare("SELECT j.nom as jour, horaire_id FROM desiderata join jour j on j.id = jour_id  where desiderata.id = {$_GET["id"]}  order by jour  asc");
   $stmt->execute();
   $des = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt = null;

    if(isset($_POST["sub"])){
        $stmt = $connexion->prepare("UPDATE desiderata set jour_id={$_POST["jour"]}, horaire_id={$_POST["horaire"]} where id={$_GET["id"]}");
        $res = $stmt->execute();

        if($res)
            echo"<script>alert('Desirata Mis a jour avec success')</script>";
        else
            echo"<script>alert('Echec de modification du desideratsa')</script>";
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
            <?php include_once "templates/sideBar.php" ?>
                <main>
                    
                <div class="container">
                    <h2>Formulaire de Désidérata</h2>
                    <form action="" method="post">
                    <div class="form-group">
                        <label for="jour">Jour:</label>
                        <select class="form-control" id="jour" name="jour">
                            <?php foreach($jours as $sall):?>
                                <option value="<?=$sall["id"]?>" <?=(strcmp($des["jour"],$sall["nom"])) ?  "" :  "selected"; ?> ><?=$sall["nom"]?></option>
                            <?php endforeach;  ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horaire">Plage horaire:</label>
                        <select class="form-control" id="horaire" name="horaire">
                        <?php foreach($sal as $horaire):?>
                                <option value="<?=$horaire["id"]?>" <?=($des["horaire_id"] == $horaire["id"]) ?  "selected" :  ""; ?>><?=$horaire["heuredebut"]?>-<?=$horaire["heurefin"]?></option>
                                <?php endforeach;  ?>
                        </select>
                    </div><br>
                        <button type="submit" class="btn btn-primary" name="sub">Modifier</button>
                    </form>
                </div>  
                
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
     
    </body>
</html>
