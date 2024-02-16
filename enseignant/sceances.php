<?php 
session_start();
    require_once "include/connexion.php";
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
                <h1 class="my-4">Emploi de temps</h1>
                    <table id="desiderataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <td scope="col">#</td>
                                <th scope="col">Jour</th>
                                <th scope="col">Horaire</th>
                                <th scope="col">Classe</th>
                                <th scope="col">Salle</th>
                                <th scope="col">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <!-- Fin des données dynamiques -->
                        </tbody>
                    </table>
                </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script>
           
        </script>
    </body>
</html>
