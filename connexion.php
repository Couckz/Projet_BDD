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
                if(isset($_POST['btnEnvoyer'])){
                    echo "Veuillez patienter...";
                    login();
                }else{
            ?>
            <form action="#" method="post">
                <div class="formulaire">
                    <div class="connexion">
                        <div class="champ_connexion">
                            <img src="img/site/connexion.png" alt="login">
                            Identifiant: <input required type="text" name="login" placeholder="ex: salextroll"><br>
                        </div>
                        <div class="champ_connexion">
                            <img src="img/site/mdp.png" alt="mdp">
                            Mot de passe: <input required type="password" name="mdp"><br>
                        </div>
                    </div>
                    <div class="log">
                        <input type="submit" name="btnEnvoyer">
                    </div>
                    <p>Pas de compte? <a href="inscription.php">Créez-en un!</a></p>
                </div>
            </form>
            <?php
                }
            ?>
        </main>
        <?php include("static/footer.php"); ?>
        <?php closeDB($sql_connection); ?>
    </body>
</html>

<!-- <h3>Veuillez vous identifier:</h3> -->