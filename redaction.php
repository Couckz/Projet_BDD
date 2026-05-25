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
require_once("./php/post_article.php");

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
            if(isset($_POST['btnsub_article'])){
                post_article();
            }
            ?>

            <form class = "redaction-article-avis" action="#" method="post" enctype="multipart/form-data">

                <h1>Rédigez un article</h1>

                <hr/>

                <fieldset>
                    <label for="title_jeu" name="titre">Titre du jeu</label>
                    <textarea required name="title_jeu" id="title_jeu" placeholder="Zelda Breath of the wild"></textarea>
                </fieldset>

                <fieldset>
                    <label for="sortie">Synopsis</label>
                    <textarea class = "huge-text-area" name="synopsis" id="synopsis" maxlength="500" placeholder="Résumé du jeu..." required></textarea>
                </fieldset>

                <fieldset>
                    <label for="image_article">Insérez l'image de la jaquette : </label>
                    <input type="file" name="image_article" id="image_article">
                </fieldset>

                <fieldset class = "sameline">
                    <label for="sortie">Date de sortie : </label>
                    <input required type="date" id="sortie" name="sortie" min="0" id="sortie">
                </fieldset>

                <fieldset class = "sameline">
                    <label for="prix">Prix (€) : </label>
                    <input required type="number" name="prix" min="0" id="prix" placeholder = "10">
                </fieldset>

                <fieldset class="sameline">
                    <div class="liste_support">
                        <label for="">Support(s)</label>
                        <?php
                        $support = recuperer_support($sql_connection);
                        display_support($support);
                    ?>
                    </div>
                    <div class="liste_categorie">
                        <label>Catégorie(s) du jeu</label>
                        <?php
                            $categorie = recuperer_categorie($sql_connection);
                            display_categorie($categorie);
                        ?>
                    </div>
                </fieldset>

                <hr/>

                <fieldset>
                    <label for="title_article">Titre de l'article</label>
                    <textarea name="title_article" id="title_article" maxlength="30" placeholder="Vive Halo !" required></textarea>
                </fieldset>

                <fieldset>
                    <label for="content">Contenu de l'article</label>
                    <textarea class = "huge-text-area" name="content" id="content" maxlength="500" placeholder="Critique du jeu..." required></textarea>
                </fieldset>

               <fieldset class = "sameline">
                    <label for="note_jeu">Note : </label>
                    <input type="number" name="note_jeu" id="note_jeu" min="0" max="10" placeholder="0" required>
                </fieldset>

                <fieldset>
                    <label for="car">Caractéristiques (séparées par des virgules)</label>
                    <input required type="text" name="car" id="car" placeholder="Pegi 18, Aventure">
                </fieldset>

                <hr/>

                <input name="btnsub_article" type="submit"></input>

                </form>
            </div>
        </main>

        <?php include("static/footer.php"); ?>
        <?php closeDB($sql_connection); ?>
    </body>
</html>