<?php
require_once(__DIR__."/../php/functions-query.php");
require_once(__DIR__."/../redaction.php");

function post_article() {
    if (isset($_POST['btnsub_article'])) {
        $mysqli = connectionDB();
        $titre_article = $_POST["title_article"];
        $note = $_POST["note_jeu"];
        $contenu = $_POST["content"];
        $titre_jeu = $_POST["title_jeu"];
        $prix = $_POST["prix"];
        $date = $_POST["sortie"];
        $synopsis = $_POST["synopsis"];
        $categorie = $_POST["categorie"];
        $support = $_POST["support"];
        $caracteristiques = $_POST["car"];
        $image = $_FILES['image_article'];
        $dossier = "img/article/";
        $nom_original = basename($_FILES["image_article"]["name"]);
        $nom_unique = uniqid() . "_" . $nom_original;
        $chemin_final = $dossier . $nom_unique;
        $login = $_SESSION["login"];
        move_uploaded_file($_FILES["image_article"]["tmp_name"],$chemin_final);
        creation_jeu($mysqli, $titre_jeu, $prix, $synopsis, $categorie, $support);
        creation_article($mysqli, $titre_article, $titre_jeu, $note, $contenu, $caracteristiques, $date, $chemin_final, $login);
        closeDB($mysqli);
        header("Location: index.php");
    }
}



?>