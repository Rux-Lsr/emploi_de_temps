<?php session_start() ;
 include_once "include/connexion.php";
    include_once "classes/Departement.php";
    include_once "classes/Classe.php";
 // Exemple d'utilisation de la fonction
    $sall = new Departement($connexion);
    $departements = $sall->read();

    $sall = new Classe($connexion);
    $sal = $sall->read();
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
                            <li class="breadcrumb-item active">Liste des UEs</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                 <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#modalEnseignant">Ajouter une classe</button>
                            </div>
                       
                            <div class="card-body">
                                <table class="table table-light">
                                    <thead>
                                        <tr> 
                                            <th>id</th>
                                            <th>nom</th>
                                            <th>code</th>
                                            <th>Effectif</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($sal as $sall): ?>
                                        <tr>
                                            <td><?php echo $sall['id_classe']; ?></td>
                                            <td><?php echo $sall['code_classe']; ?></td>
                                            <td><?php echo $sall['nom_classe']; ?></td>
                                            <td><?php echo $sall['effectif_classe']; ?></td>
                                            <th><a class="btn btn-danger">Supprimer</a > <a class="btn btn-warning ml-2">Modifier</a></th>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>   
                        </div>
                        </div>
                    </div> 
                   
                </main>
               
            </div>
           
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
