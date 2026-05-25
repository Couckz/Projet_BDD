<?php
//session_start();
require_once(__DIR__."/../php/functions-query.php");
require_once(__DIR__."/../avis.php");

function post_avis() {
    if (isset($_POST['btnsub'])) {
        $mysqli = connectionDB();
        $titre_avis = $_POST["title"];
        $article_selectionne = $_POST["article"];
        $avis = $_POST["avis"];
        $note = $_POST["note"];
        $login = $_SESSION['login'];
        creation_avis($mysqli, $login, $article_selectionne, $titre_avis, $avis, $note);
        closeDB($mysqli);
        header("Location: index.php");
    }
}


?>