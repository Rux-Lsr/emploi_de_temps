<?php session_start() ;
 include_once "include/connexion.php";
    include_once "classes/Salle.php";
 // Exemple d'utilisation de la fonction
    
    $salles = new Salle($connexion);
    $sal = $salles->read();

    if(isset($_POST["sub"])){
        $salles->create($_POST["nom"], $_POST["capacite"]);
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
            <!-- ; -->
            <div id="layoutSidenav_content">
            <?php include_once "templates/sideBar.php" ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                       <div class="container">
                       <form method="post">
                            <div class="form-group">
                                <label for="nom">Nom de la salle:</label>
                                <input type="text" id="nom" name="nom" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="capacite">Capacité:</label>
                                <input type="number" id="capacite" name="capacite" required  class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="sub" class="btn btn-primary">Ajouter la salle</button>
                            </div>
                        </form>
                       </div>
                       <h3>Liste des salles</h3>   
                        <table class="table table-light">
                            <thead>
                                <tr> 
                                    <th>Numero</th>
                                    <th>nom</th>
                                    <th>Capacité</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($sal as $sall): ?>
                                <tr>
                                    <td><?php echo $sall['id']; ?></td>
                                    <td><?php echo $sall['nom']; ?></td>
                                    <td><?php echo $sall['capacite']; ?></td>
                                    <th><a class="btn btn-danger">Supprimer</a > <a class="btn btn-warning ml-2">Modifier</a></th>
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
