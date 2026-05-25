<?php
session_start();
ini_set('display_errors', 1); //active l'affichage des erreurs
ini_set('display_startup_errors', 1); //gestion des affichages d'erreur au démarage
error_reporting(E_ALL); //affiche toute les erreurs possible
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //déclenche une erreur PHP dés qu'une requête échoue, puis transformes ces erreurs en exception
require_once("./includes/constantes.php"); //constantes du site
require_once("./includes/config-bdd.php"); //donnees pour la connexion
require_once("./php/functions-DB.php"); //functions de connexions
require_once("./php/functions-query.php"); //functions de requêtes SQL
require_once("./php/functions-structures.php"); //functions de mises en pages au niveau des données obtenues de la BD
require_once("./php/filtre.php");
$mysqli = connectionDB(); //création de la connexion SQL
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php echo "$titreSite"; ?></title>
        <meta charset="utf-8">
        <meta name="keywords" content="jeu vidéo">
        <meta name="author" content="Malo Camelia Alexandre">
        <link rel="icon" href=<?php echo "$iconeSite"; ?>>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
    </head>
    <body>
        <?php
            include("static/header.php"); //inclusion du header de la page
            include("static/nav.php"); //inclusion de l'onglet navigation de la page
        ?>
        <main>

            <section>

                <div class="formulaire">
                    <h3>Vous êtes perdus ? Recherchez votre jeu préféré :</h3>
                    <form action="#" method="POST">
                        <div class="champ">
                            Titre : <input type="text" name="title" id="title" placeholder="Mario"><br>
                            Catégorie :
                            <select name="categorie" id="categorie">
                                <?php
                                $categorie = recuperer_categorie($mysqli);
                                display_categorie_selection($categorie);
                                ?>
                            </select>
                        </div>
                    <div class="soumettre">
                        <button type="filtre_cat" name="filtre_cat">
                            Filtrer par categorie
                        </button>
                        <button type="filtre_nom" name="filtre_nom">
                            Filtrer par nom
                        </button>
                    </div>
                    </form>
                </div>
            </section>

            <?php
            if(isset($_POST['filtre_nom'])){
                $title = filtrer_nom($mysqli);
                $result = recuperer_article_par_nom_complet($mysqli, $title);
                if ($result != 0) {
                    affichage_articles($result);
                }

            } else if (isset($_POST['filtre_cat'])){
                $articles = filtrer_cat($mysqli);
                $result = recuperer_article_par_categorie_complet($mysqli, $articles);
                affichage_articles($result);

            } else {
                $articles = information_articles_complet($mysqli); //on récupère tout les articles en même temps depuis la BDD
                affichage_articles($articles); //on affiche simplement lesdits articles
            }


            ?>

        </main>
        <?php
            include("static/footer.php"); //inclusion du footer de la page
            closeDB($mysqli); //cloture de la connexion SQL
        ?>
    </body>
</html>
