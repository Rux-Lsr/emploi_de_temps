<?php 
session_start();
    require_once "include/connexion.php";
    var_dump($_SESSION);
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
        <div>
            <div>
                <main>
                <h1 class="my-4">Emploi de temps</h1>
                <div class="container-fluid">
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <form action="" method="post">
                                            <div class="form-group">
                                            <label for="classe">Semestres</label>
                                                <select class="form-control" id="semestre" name="semestreE">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                </select>
                                            </div> 
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" name="submitEnseignant" type="submit">Trouver</button>
                                            </div>
                                    </form>
                                </div>
                               
                            <div>
                        </div><br><br>
                        <?php if (isset($_POST['submitEnseignant'])) {
                            $sql = "SELECT ue.semestre as Semestre , p.`id`, c.nom as classe, `uecode` as ue,e.nom as enseignant,s.nom as salle, `jour`.`nom` as jour, h.heuredebut as debut, h.heurefin as fin FROM `planning` p
                            JOIN classe c on c.id = p.classeid
                            JOIN salle s on s.id = p.salleid
                            JOIN horaire h on h.id = horaire_id
                            JOIN jour on jour_id = jour.id
                            JOIN ue on ue.code = uecode
                            join enseignant e on e.id = ue.enseignantid
                            WHERE e.id = {$_SESSION['user']['id']} and ue.semestre = {$_POST['semestreE']} 
                            ORDER BY jour.id asc";

                            $😊 = $connexion->query($sql);

                            $res = $😊->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                            <div class="card-body">
                                <table class="table table-light">
                                    <caption>Semestre:<?= $_POST['semestreE']?>       Enseignant: <?= $_SESSION['user']['nom'] ?></caption>
                                    <thead>
                                        <tr> 
                                            <th>Ue</th>
                                            <th>Jour</th>
                                            <th>Horaire</th>
                                            <th>Salle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                            if(!empty($res)){
                                                
                                            foreach ($res as  $value):
                                         ?>
                                        <tr> 
                                            <td><?=$value["ue"]?></td>
                                            <td><?=$value["jour"]?></td>
                                            <td><?=$value["debut"]?> - <?=$value["fin"]?></td>
                                            <td><?=$value["salle"]?></td>
                                        </tr>
                                        <?php endforeach;}else echo "Pas Encore defini";?>     
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>
                </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script>
           
        </script>
    </body>
</html>
