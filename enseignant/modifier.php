<?php session_start() ;
 include_once "include/connexion.php";
    include_once "classes/UE.php";
    include_once "classes/Classe.php";
    include_once "classes/Enseignant.php";
 // Exemple d'utilisation de la fonction
    $enss = new Enseignant($connexion);
    $enssArray = $enss->read();

    $horaire = new Classe($connexion);
    $horaires = $horaire->read();

    $stm = $connexion->query("SELECT nom_ue, code_ue, nom_enseignant from ue join enseignant on enseignant.id_enseignant = ue.id_enseignant where id_ue=".$_GET['id']);
    $profs = $stm->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['submit']))
    {
        $ue = new UE($connexion);
        $ue->update($_GET["id"], $_POST['code'], $_POST['nom'],$_POST['enseignant'], $_POST['submit']);
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
                            <div class="Container">
                                <h3>Modifier UE</h3>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="nom">Nom UE :</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required value="<?=$profs['nom_ue']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Code :</label>
                                        <input type="text" class="form-control" id="code" name="code" required value="<?=$profs['code_ue']?>">
                                    </div><br>                                                
                                    <div class="form-group">
                                        <select name="enseignant" id="enseignant" class="form-select" aria-label="Default select example">
                                        <option selected disabled>Enseignant</option>
                                            <?php foreach ($enssArray as $prof): ?>
                                                <option value="<?=$prof['id']?>"><?=$prof['nom']?></option>
                                            <?php endforeach;  var_dump($enssArray)?>
                                        </select>
                                    </div>
                                    <br>
                                    <!-- Autres champs à ajouter ici (par exemple, prénom, matières enseignées, etc.) -->
                                    <button type="submit" class="btn btn-primary" name="submit">Enregistrer</button>
                                </form>
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
