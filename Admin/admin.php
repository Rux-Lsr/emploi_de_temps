<?php session_start() ;
 include_once "include/connexion.php";
    require_once "../classes/Classe.php";

    $classe = new Classe($connexion);
    $classes =  $classe->read(); 

    $🤣 = $connexion->query("SELECT * from vue_enseignant");
    $en = $🤣->fetchAll(PDO::FETCH_ASSOC);

    $salles = $connexion->query("SELECT * from vue_salle");
    $salle = $salles->fetchAll(PDO::FETCH_ASSOC);

    $dpt = $connexion->query("SELECT * from departement");
    $dpts = $dpt->fetchAll(PDO::FETCH_ASSOC);

    $ue = $connexion->query("SELECT * from ue where enseignantid is null");
    $ues = $ue->fetchAll(PDO::FETCH_ASSOC);
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
                                        <legend>Salle  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSalle"> Ajouter</button></legend>
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
                                        <legend>Classe    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalClasse"> Ajouter</button></legend>
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
                                            <legend>Enseignant <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEnseignant"> Ajouter</button></legend>
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
                        <div class="modal fade" id="modalSalle" tabindex="-1" role="dialog" aria-labelledby="modalEnseignantLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEnseignantLabel">Ajouter une SAlle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulaire pour saisir les informations de l'enseignant -->
                                        <form action=" " method="post">
                                            <div class="form-group">
                                                <label for="nom">Nom Salle :</label>
                                                <input type="text" class="form-control" id="nom" name="nomSalle" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Capacite :</label>
                                                <input type="number" class="form-control" id="code" name="capacite" required>
                                            </div><br>
                                            <button type="submit" class="btn btn-primary" value="addSalle" name="valider">Enregistrer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <?php 
                            if (isset($_POST['valider'])) {

                                switch ($_POST['valider']) {
                                    case 'addSalle':
                                        // Préparer la requête SQL
                                        $stmt = $connexion->prepare("INSERT INTO salle (nom, capacite) VALUES (:nom, :capacite)");
                                        $stmt->bindParam(':nom', $_POST['nomSalle']);
                                        $stmt->bindParam(':capacite', $_POST['capacite']);
                        
                                        // Exécuter la requête
                                        $res = $stmt->execute();

                                        if($res)
                                            echo"<script>alert('Ajout de salle  reussie');location.href='admin.php'</script>";
                                        else
                                            echo"<script>alert('Echec d'ajout de la sallw');location.href='admin.php'</script>";
                                        break;
                                    case 'addClasse':
                                        // Préparer la requête SQL
                                        $stmt = $connexion->prepare("INSERT INTO classe (nom, departementid, niveau) VALUES (:nom, :departementid, :niveau)");
                                        $stmt->bindParam(':nom', $_POST['nomClasse']);
                                        $stmt->bindParam(':departementid', $_POST['departementid']);
                                        $stmt->bindParam(':niveau', $_POST['niveau']);
                        
                                        // Exécuter la requête
                                        $res = $stmt->execute();

                                        if($res)
                                            echo"<script>alert('Ajout de classe  reussie');location.href='admin.php'</script>";
                                        else
                                            echo"<script>alert('Echec d'ajout de la classe');location.href='admin.php'</script>";
                                        break;
                                    case 'addEnseignant':
                                        // Préparer la requête SQL
                                        $stmt = $connexion->prepare("INSERT INTO enseignant (nom, email, mdp) VALUES (:nom, :email, :numero_tel)");
                                        $stmt->bindParam(':nom', $_POST['nomEnsignant']);
                                        $stmt->bindParam(':email', $_POST['email']);
                                        $stmt->bindParam(':numero_tel', $_POST['mdp']);
                        
                                        // Exécuter la requête
                                        $stmt->execute();
                                        
                                        // Obtenir l'ID de l'enseignant inséré
                                        $enseignantid = $connexion->lastInsertId();
                        
                                        // Préparer la requête SQL pour associer l'enseignant à une UE
                                        $stmt = $connexion->prepare("UPDATE ue SET enseignantid = :enseignantid WHERE id = :ue");
                                        $stmt->bindParam(':enseignantid', $enseignantid);
                                        $stmt->bindParam(':ue', $_POST['ue']);
                        
                                        // Exécuter la requête
                                        $res = $stmt->execute();

                                        if($res)
                                            echo"<script>alert('Ajout d'enseignant  reussie');location.href='admin.php'</script>";
                                        else
                                            echo"<script>alert('Echec d'ajout de l'enseignant');location.href='admin.php'</script>";
                                        break;
                                    default:
                                        # code...
                                        break;
                                }
                            }
                        ?>
                        <div class="modal fade" id="modalClasse" tabindex="-1" role="dialog" aria-labelledby="modalEnseignantLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEnseignantLabel">Ajouter une Classe</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulaire pour saisir les informations de l'enseignant -->
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="nom">Nom Classe :</label>
                                            <input type="text" class="form-control" id="nom" name="nomClasse" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Effectif</label>
                                            <input type="number" class="form-control" id="effe" name="effectif" required>
                                        </div><br>
                                        <select class="form-control" id="enseignant" name="enseignant">   
                                                <?php foreach($dpts as $enseignant):?>
                                                        <option value="<?=$enseignant["id"]?>"><?=$enseignant["nom"]?></option>
                                                <?php endforeach;  ?>
                                        </select>
                                        <button type="submit" class="btn btn-primary" value="addClasse" name="valider">Enregistrer</button>
                                    </form>
                                </div>
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
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="nom">Nom de l'enseignant :</label>
                                            <input type="text" class="form-control" id="nom" name="nomEnsignant" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email :</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="classe">Ues</label>
                                            <select class="form-control" id="classe" name="ue" required>
                                            <?php foreach($ues as $horaire):?>
                                                    <option value="<?=$horaire["id"]?>"><?=$horaire["nom"]?></option>
                                            <?php endforeach;  ?>
                                            </select>
                                        </div>  
                                        <div class="form-floating mb-3">
                                                <input class="form-control" id="chaine-caracteres" type="text" placeholder="mdp" name="mdp" readonly/>
                                                <label for="mdp">Mot de passe</label>
                                            </div><br>
                                        <!-- Autres champs à ajouter ici (par exemple, prénom, matières enseignées, etc.) -->
                                        <button type="submit" class="btn btn-primary" value="addEnseignant" name="valider">Enregistrer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                </main>
               
            </div>
           
        </div>
        <script>
            const inputChaine = document.getElementById("chaine-caracteres");

            // Fonction pour générer une chaîne aléatoire de caractères
            function genererChaineAleatoire(longueur) {
            const caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            let chaine = "";
            for (let i = 0; i < longueur; i++) {
                chaine += caracteres[Math.floor(Math.random() * caracteres.length)];
            }
            return chaine;
            }

            // Evénement sur le focus du champ
            inputChaine.addEventListener("dblclick", () => {
            // Si la valeur actuelle est vide, générer une chaîne aléatoire
            if (!inputChaine.value) {
                inputChaine.value = genererChaineAleatoire(8);
            }
            });

            // Fonction pour vérifier la validité de la chaîne
            function verifierValiditeChaine(chaine) {
            // La chaîne doit contenir au moins 8 caractères
            return chaine.length >= 8;
            }


        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
