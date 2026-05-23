<?php
session_start();
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
require_once("./php/post_avis.php");

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
            <?php
            if(isset($_POST['btnsub'])){
                post_avis();
            }
            ?>
            <div class="formulaire_avis">
                <form action="#" method="post">
                    <div class="ensemble_formulaire">
                    Titre <input required type="text" name="title" id="title" placeholder="Vive Halo !"><br>
                        <label id="titre" name="titre">Titre de l'article: </label>
                        <select name="article" id="article">
                        <?php
                            $article = recuperer_article($sql_connection);
                            displayForm($article);
                        ?>
                        </select>
                        Note <input required type="number" name="note" min="0" max="10" id="note"><br>
                        Avis <input required type="text" name="avis" id="avis"><br>
                    
                    <div class="boutton_avis">
                    <button type="btnsub" name="btnsub">
                            Envoyer
                    </button>
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