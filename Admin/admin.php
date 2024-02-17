<?php session_start() ;
 include_once "include/connexion.php";
    require_once "../classes/Classe.php";

    $classe = new Classe($connexion);
    $classes =  $classe->read(); 

    $🤣 = $connexion->query("SELECT * from vue_enseignant");
    $en = $🤣->fetchAll(PDO::FETCH_ASSOC);

    $salles = $connexion->query("SELECT * from vue_salle");
    $salle = $salles->fetchAll(PDO::FETCH_ASSOC);
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
        <div style="margin-top 50px;">
            <!-- ; -->
            <div >
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-5" style="color:white">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                       
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <form action="" method="post">
                                        <div class="form-group">
                                        <legend>Salle </legend>
                                            <label for="salle">Salle</label>
                                            <select class="form-control" id="salle" name="salle">
                                            <?php foreach($salle as $sal):?>
                                                    <option value="<?=$sal["id"]?>"><?=$sal["nom"]?></option>
                                            <?php endforeach;  ?>
                                            </select>
                                        </div>  
                                        <div class="form-group">
                                            <label for="classe">Semestres</label>
                                            <select class="form-control" id="semestre" name="semestreSal">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                            </select>
                                        </div>  
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" name="submitClasse" type="submit">Trouver</button>
                                            </div>
                                    </form>
                                </div>
                                <div class="col-md-3 ">
                                    <form action="" method="post">
                                        <legend>Classe</legend>
                                        <div class="form-group">
                                            <label for="classe">Classe</label>
                                            <select class="form-control" id="classe" name="classeS">
                                            <?php foreach($classes as $horaire):?>
                                                    <option value="<?=$horaire["id"]?>"><?=$horaire["nom"]?></option>
                                            <?php endforeach;  ?>
                                            </select>
                                        </div>  
                                        <div class="form-group">
                                            <label for="classe">Semestres</label>
                                            <select class="form-control" id="semestre" name="semestre">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                            </select>
                                        </div>  
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" name="submitSemestre" type="submit">Trouver</button>
                                        </div>
                                </form>
                                </div>
                                <div class="col-md-3">
                                    <form action="" method="post">
                                            <div class="form-group">
                                            <legend>Enseignant </legend>
                                                <label for="enseignant">Enseignant</label>
                                                <select class="form-control" id="enseignant" name="enseignant">
                                                    
                                                <?php foreach($en as $enseignant):?>
                                                        <option value="<?=$enseignant["id"]?>"><?=$enseignant["nom"]?></option>
                                                <?php endforeach;  ?>
                                                </select>
                                            </div>  
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
                                <div class="col-md-3 bg-warning">Div enfant 4</div>
                            <div>
                        </div><br><br>
                       
                       
                        <?php 
                        if(isset($_POST['submitClasse'])){
                            $sql = "SELECT ue.semestre as Semestre , p.`id`, c.nom as classe, `uecode` as ue,e.nom as enseignant,s.nom as salle, `jour`.`nom` as jour, h.heuredebut as debut, h.heurefin as fin FROM `planning` p
                            JOIN classe c on c.id = p.classeid
                            JOIN salle s on s.id = p.salleid
                            JOIN horaire h on h.id = horaire_id
                            JOIN jour on jour_id = jour.id
                            JOIN ue on ue.code = uecode
                            join enseignant e on e.id = ue.enseignantid
                            WHERE p.classeid = {$_POST['salle']} and ue.semestre = {$_POST['semestreSal']} 
                            ORDER BY jour.id asc";

                            $😊 = $connexion->query($sql);

                            $res = $😊->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                            <div class="card-body">
                                <table class="table table-light">
                                <caption>Salle: <?= !empty($res) ?$res[0]['salle'] : $_POST['salle'] ;?> Semestre: <?=!empty($res) ?$res[0]['Semestre'] : $_POST['semestreSal'] ;?></caption>
                                    <thead>
                                        <tr> 
                                            <th>Jour</th>
                                            <th>Horaire</th>
                                            <th>Classe</th>
                                            <th>Ue</th>
                                            <th>Enseignant</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(!empty($res)){
                                                
                                            foreach ($res as  $value):
                                         ?>
                                            
                                        <tr> 
                                            <td><?=$value["jour"]?></td>
                                            <td><?=$value["debut"]?> - <?=$value["fin"]?></td>
                                            <td><?=$value["classe"]?></td>
                                            <td><?=$value["ue"]?></td>
                                            <td><?=$value["enseignant"]?></td>
                                            <td><?=$value["salle"]?></td>
                                        </tr>

                                        <?php endforeach;}else echo "Pas Encore defini";?>     
                                    </tbody>
                                </table>
                            </div>
                            <?php
//======================================Else if de la mort qui tue============================================================================================================
                        }else if (isset($_POST['submitSemestre'])) {
                            $sql = "SELECT ue.semestre as Semestre , p.`id`, c.nom as classe, `uecode` as ue,e.nom as enseignant,s.nom as salle, `jour`.`nom` as jour, h.heuredebut as debut, h.heurefin as fin FROM `planning` p
                            JOIN classe c on c.id = p.classeid
                            JOIN salle s on s.id = p.salleid
                            JOIN horaire h on h.id = horaire_id
                            JOIN jour on jour_id = jour.id
                            JOIN ue on ue.code = uecode
                            join enseignant e on e.id = ue.enseignantid
                            WHERE p.classeid = {$_POST['classeS']} and ue.semestre = {$_POST['semestre']} 
                            ORDER BY jour.id asc";

                            $😊 = $connexion->query($sql);

                            $res = $😊->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                            <div class="card-body">
                                <table class="table table-light">
                                    <caption>Semestre:<?=$_POST['semestre']?>       Classe: <?=$_POST['classeS']?></caption>
                                    <thead>
                                        <tr> 
                                            <th>Jour</th>
                                            <th>Horaire</th>
                                            <th>Ue</th>
                                            <th>Enseignant</th>
                                            <th>Salle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                            if(!empty($res)){
                                                
                                            foreach ($res as  $value):
                                         ?>
                                            
                                        <tr> 
                                            <td><?=$value["jour"]?></td>
                                            <td><?=$value["debut"]?> - <?=$value["fin"]?></td>
                                            <td><?=$value["ue"]?></td>
                                            <td><?=$value["enseignant"]?></td>
                                            <td><?=$value["salle"]?></td>
                                        </tr>

                                        <?php endforeach;}else echo "Pas Encore defini";?>     
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }else if (isset($_POST['submitEnseignant'])) {
                            $sql = "SELECT ue.semestre as Semestre , p.`id`, c.nom as classe, `uecode` as ue,e.nom as enseignant,s.nom as salle, `jour`.`nom` as jour, h.heuredebut as debut, h.heurefin as fin FROM `planning` p
                            JOIN classe c on c.id = p.classeid
                            JOIN salle s on s.id = p.salleid
                            JOIN horaire h on h.id = horaire_id
                            JOIN jour on jour_id = jour.id
                            JOIN ue on ue.code = uecode
                            join enseignant e on e.id = ue.enseignantid
                            WHERE e.id = {$_POST['enseignant']} and ue.semestre = {$_POST['semestreE']} 
                            ORDER BY jour.id asc";

                            $😊 = $connexion->query($sql);

                            $res = $😊->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                            <div class="card-body">
                                <table class="table table-light">
                                    <caption>Semestre:<?= $_POST['semestreE']?>       Enseignant: <?= $_POST['enseignant'] ?></caption>
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
                        </div>
                    </div> 
                    <div class="modal fade" id="modalEnseignant" tabindex="-1" role="dialog" aria-labelledby="modalEnseignantLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEnseignantLabel">Ajouter un enseignant</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulaire pour saisir les informations de l'enseignant -->
                                <form action="traitement.php" method="post">
                                    <div class="form-group">
                                        <label for="nom">Nom Departement :</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>
                                    <br>
                                    <!-- Autres champs à ajouter ici (par exemple, prénom, matières enseignées, etc.) -->
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </form>
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
