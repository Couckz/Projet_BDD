<?php

function information_article($mysqli) {
    $query = "SELECT Article.titre, Article.contenu, Article.note, Article.caracteristiques, Article.date_creation, Image.chemin_image FROM Article INNER JOIN Image ON Image.id_article = Article.id_article ";

    $result = readDB($mysqli, $query);
    return $result;
}

?>