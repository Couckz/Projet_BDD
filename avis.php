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
        <link rel="icon" href=<?php echo "$iconeSite"; ?>>
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
            <form class = "redaction-article-avis" action="#" method="post">

                <h1>Donnez votre avis</h1>

                <hr/>

                <fieldset class="sameline">
                    <label id="titre" for="article" name="titre" required>Article visé : </label>
                    <select name="article" id="article" required>
                    <?php
                        $article = recuperer_article($sql_connection);
                        displayForm($article);
                    ?>
                    </select>
                </fieldset>

               <fieldset class = "sameline">
                    <label for="note">Note</label>
                    <input type="number" name="note" id="note" min="0" max="10" placeholder="0" required>
                </fieldset>

                <fieldset>
                    <label for="title">Titre de l'avis</label>
                    <textarea name="title" id="title" maxlength="30" placeholder="Vive Halo !" required></textarea>
                </fieldset>

                <fieldset>
                    <label for="avis">Contenu de l'avis</label>
                    <textarea class = "huge-text-area" name="avis" id="avis" maxlength="500" required></textarea>
                </fieldset>

                <hr/>

                <input name="btnsub" type="submit"></input>

                </form>
            </div>
        </main>
        <?php include("static/footer.php"); ?>
        <?php closeDB($sql_connection); ?>
    </body>
</html>