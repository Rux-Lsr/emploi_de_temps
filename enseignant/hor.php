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
                        <h1 class="mt-4">Desideratas</h1>
                        
                        
                    </div>  
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
     
    </body>
</html>
