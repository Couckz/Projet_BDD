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
$mysqli = connectionDB();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php echo "$titreSite"; ?></title>
        <meta charset="utf-8">
        <meta name="keywords" content="jeu vidéo">
        <meta name="author" content="Malo Camelia Alexandre">
        <link rel="icon" href="images/pokeball.png">
        <link rel="stylesheet" type="text/css" href="styles/style.css">
    </head>
    <body>
        <?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
        <main>
            <section>
            <h3>Vous êtes perdus ? Recherchez votre jeu préféré :</h3>

            <!-- Pour le futur formulaire de recherche par nom et par catégorie : -->
        
            <!-- <div class="formulaire">
                <form action="/pokedex/php/modification.php" method="POST">
                    <div class="champ">
                        <label for="id">Pokemon selectionné : </label>
                        <select name="pokemon" id="">
                        </select>
                        <label for="id">Nombre de vue</label>
                        <input type="text" id="nombrevue" name="nombrevue">
                        <label for="id">Nombre attrapé</label>
                        <input type="text" id="nombreattrap" name="nombreattrap">
                    </div>
                <div class="soumettre">
                    <button type="submit" name="submit">
                        Modifier
                    </button>
                </div>
                </form>
            </div> -->
            </section>
            
            <?php
            $article = information_article($mysqli);
            affichage_article($article);
            //print_r($article); Commande de test pour afficher la structure d'un article
            ?>
            
        </main>
        <?php include("static/footer.php"); ?>
        <?php closeDB($mysqli); ?>
    </body>
</html>
