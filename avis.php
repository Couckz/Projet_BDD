<?php
//affichage des erreurs côté PHP et côté MYSQLI
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Import du site
require_once("./includes/constantes.php");      //constantes du site
require_once("./includes/config-bdd.php");
require_once("./php/functions-DB.php");
require_once("./php/functions-query.php");
require_once("./php/functions-structures.php");
require_once("./php/login.php");

$sql_connection = connectionDB();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php echo "$titreSite"; ?></title>
        <meta charset="utf-8">
        <meta name="keywords" content="jeu vidéo connexion">
        <meta name="author" content="Malo Camelia Alexandre">
        <link rel="icon" href="images/pokeball.png">
        <link rel="stylesheet" type="text/css" href="styles/style.css">
    </head>
    <body>
        <?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
        <main>
            <div class="formulaire_avis">
                <form action="#" method="post">
                    <div class="ensemble_formulaire">
                        
                        Titre <input required type="text" name="Titre" placeholder="Vive Halo !"><br>
                        Note <input required type="number" name="mdp" min="0" max="10"><br>
                        Avis <input required type="password" name="mdp"><br>
                    
                    <div class="boutton_avis">
                    <input type="submit" name="btnEnvoyer">
                    </div>
                    </div>
                    
                    
                    
                </form>
            </div>
            <?php
                
            ?>
        </main>
        <?php include("static/footer.php"); ?>
        <?php closeDB($sql_connection); ?>
    </body>
</html>