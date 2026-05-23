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
require_once("./php/functions-structures.php"); //functions de mises en pages au niveau des données obtenues de la BDD
require_once("./php/change_photo.php"); //functions de changement de l'image de profil
require_once("./php/changement_profil.php"); //functions de changement des infos users
$mysqli = connectionDB(); //création de la connexion SQL

if (isset($_POST['btn_nom_modif'])) {
    change_nom();
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['prenom'] = $_POST['prenom'];
}

if (isset($_POST['btn_adresse_email_modif'])) {
    change_mail();
    $_SESSION['adresse_email'] = $_POST['adresse_email'];
}

if (isset($_POST['btn_date_naissance_modif'])) {
    change_naissance();
    $_SESSION['date_naissance'] = $_POST['date_naissance'];
}

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
            <h2 class="salutation">Bonjour <?php echo $_SESSION['login'];?>!</h2>
            <?php
            if (isset($_POST['btnPhoto']) && !empty($_FILES['pp']['name'])) {
                change_photo();
            }
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <label for="inputPdp"  class="profile" style="cursor:pointer;">
                    <img src="<?php echo $_SESSION['chemin_pdp']; ?>" alt="photo de profil">
                </label>
                <input type="file" id="inputPdp" name="pp" accept="image/*" style="display:none;">
                <br><button type="submit" name="btnPhoto">Changer</button>
                <p class="profile">
                    <span>
                        Membre depuis le : <?php echo date_to_str($_SESSION['date_inscription']); ?> 
                    </span>
                    <span>
                        Identité : <?php echo $_SESSION['prenom'];echo " ". $_SESSION['nom']; ?> 
                        <button type="submit" name="btn_nom">Changer</button><br>
                        <?php
                            if (isset($_POST['btn_nom'])){?>
                                <input required type="text" name="nom" placeholder="ex: Chirac"><br>
                                <input required type="text" name="prenom" placeholder="ex: Jacques"><br>
                                <button type="submit" name="btn_nom_modif">Confirmer</button><?php
                            }
                        ?>
                    </span>
                    <span>
                        Né le : <?php echo date_to_str($_SESSION['date_naissance']); ?> 
                        <button type="submit" name="btn_date_naissance">Changer</button>
                        <?php
                            if (isset($_POST['btn_date_naissance'])){?>
                                <input required type="date" name="date_naissance"><br>
                                <button type="submit" name="btn_date_naissance_modif">Confirmer</button><?php
                            }
                        ?>
                    </span>
                    <span>
                        Adresse e-mail : <?php echo $_SESSION['adresse_email']; ?> 
                        <button type="submit" name="btn_adresse_email">Changer</button>
                        <?php
                            if (isset($_POST['btn_adresse_email'])){?>
                                <input required type="email" name="adresse_email" placeholder="ex: david.goodenough@gmail.com"><br>
                                <button type="submit" name="btn_adresse_email_modif">Confirmer</button><?php
                            }
                        ?>
                    </span>
                </p>
            </form>
        </main>
        <?php
            include("static/footer.php"); //inclusion du footer de la page
            closeDB($mysqli); //cloture de la connexion SQL
        ?>
    </body>
</html>
