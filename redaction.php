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

                <div class="formulaire_article">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="ensemble_formulaire_article">
                    Titre de l'article <input required type="text" name="title_article" id="title_article" placeholder="Vive Halo !"><br>
                    Note <input required type="number" name="note_jeu" min="0" id="note_jeu"><br>
                    Contenu <input required type="text" name="content" id="content" placeholder="Critique du jeu.."><br>
                    Caracteristiques <input required type="text" name="car" id="car" placeholder="Pegi 18"><br>
                    Titre du jeu <input required type="text" name="title_jeu" id="title_jeu" placeholder="Zelda Breath of the wild"><br>
                    Prix <input required type="number" name="prix" min="0" id="prix"><br>
                    Date de sortie <input required type="date" name="sortie" min="0" id="sortie"><br>
                    Synopsis <input required type="text" name="synopsis" id="synopsis" placeholder="Résumé du jeu"><br>
                    Insérer l'image de la jaquette <input type="file" name="image_article">
                        <div class="liste_categorie">
                        <label for="">Catégorie</label>
                        <?php
                            $categorie = recuperer_categorie($sql_connection);
                            display_categorie($categorie);
                        ?>
                        </div>
                
                        
                        <br>
                        
                        <div class="liste_support">
                            <label for="">Support</label>
                            <?php
                            $support = recuperer_support($sql_connection);
                            display_support($support);
                        ?>
                        </div>
                        

                    
                        
                    <div class="boutton_avis">
                    <button type="btnsub_article" name="btnsub_article">
                            Envoyer
                    </button>
                    </div>
                    </div>
                </form>
        </main>
        
        <?php include("static/footer.php"); ?>
        <?php closeDB($sql_connection); ?>
    </body>
</html>