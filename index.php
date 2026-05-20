<?php
ini_set('display_errors', 1); //active l'affichage des erreurs
ini_set('display_startup_errors', 1); //gestion des affichages d'erreur au démarage
error_reporting(E_ALL); //affiche toute les erreurs possible
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //déclenche une erreur PHP dés qu'une requête échoue, puis transformes ces erreurs en exception
require_once("./includes/constantes.php"); //constantes du site
require_once("./includes/config-bdd.php"); //donnees pour la connexion
require_once("./php/functions-DB.php"); //functions de connexions
require_once("./php/functions-query.php"); //functions de requêtes SQL
require_once("./php/functions-structures.php"); //functions de mises en pages au niveau des données obtenues de la BDD
$mysqli = connectionDB(); //création de la connexion SQL
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
        <?php
            include("static/header.php"); //inclusion du header de la page
            include("static/nav.php"); //inclusion de l'onglet navigation de la page
        ?>
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
            $article = information_article($mysqli); //on récupère tout les articles en même temps depuis la BDD
            affichage_article($article); //on affiche simplement lesdits articles
            ?>
        </main>
        <?php
            include("static/footer.php"); //inclusion du footer de la page
            closeDB($mysqli); //cloture de la connexion SQL
        ?>
    </body>
</html>
