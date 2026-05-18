<?php

function information_article($mysqli) {
    $query = "SELECT Article.titre, Article.contenu, Article.note, Article.caracteristiques, Article.date_creation, Jeu.prix, Jeu.synopsis, Article.date_modification,  Image.chemin_image FROM Article INNER JOIN Image ON Image.id_article = Article.id_article INNER JOIN Jeu ON Article.id_jeu = Jeu.id_jeu ";

    $result = readDB($mysqli, $query);
    return $result;
}

?>