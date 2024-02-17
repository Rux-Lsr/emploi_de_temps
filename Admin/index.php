<?php 
session_start();
    require_once "include/connexion.php";
    $sal  = $connexion->query("SELECT * FROM horaire order by id asc", PDO::FETCH_ASSOC);
    $jours = $connexion->query("SELECT * FROM jour order by id asc", PDO::FETCH_ASSOC);
    $stm  = $connexion->query("SELECT * FROM periodemodification ", PDO::FETCH_ASSOC);
    $dateLimite = $stm->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST["sub"])){
        $dateActuelle = date('Y-m-d');
        $stmt = $connexion->prepare("INSERT INTO `periodemodification`(`datedebut`, `datefin`, `id`) VALUES ('$dateActuelle','{$_POST["dateLimiteModif"]}', 1)");
        $res = $stmt->execute();

        if($res)
            echo"<script>alert('Date de fin definie avec success soumis avec success');location.href='index.php'</script>";
        else
            echo"<script>alert('Echec d'enregistrement de la date de fin');location.href='index.php'</script>";
    }else if(isset($_POST["del"])){
        $sql = "UPDATE periodemodification set datefin={$_POST["dateLimiteModif"]} where id = 1";
        $stmt = $connexion->prepare("$sql");
        $res = $stmt->execute();

        if($res)
            echo"<script>alert('modification reussie');location.href='index.php'</script>";
        else
            echo"<script>alert('Echec de modification');location.href='index.php'</script>";
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
                    <h2>date limite de modification</h2>
                    <form action="" method="post">
                    <div class="form-group">
                        <label for="jour">Date:</label>
                        <input type="date" name="dateLimiteModif" class="form-control">
                    </div>
                        <button type="submit" class="btn btn-success" name="sub">Soumettre</button> <button type="submit" class="btn btn-primary" name="del">Modififier</button>
                    </form>
                </div>  
                
                <div class="container">
                <h4>Date limite de modification prevue : </h4><?= $dateLimite['datefin']?> 
                   <br>
                </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
     
    </body>
</html>
