<?php
require_once(__DIR__."/../php/functions-query.php");
require_once(__DIR__."/../index.php");

function filtrer_cat($mysqli) {
    if (isset($_POST['filtre_cat'])) {
        $categorie = $_POST["categorie"];
        return $categorie;
        
    }
}

function filtrer_nom($mysqli) {
    if (isset($_POST['filtre_nom'])) {
        $title = $_POST["title"];
        return $title;
    }
}

?>