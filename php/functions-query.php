<?php

function information_article($mysqli) {
    $query = "SELECT Article.titre, Article.contenu, Article.note, Article.caracteristiques, Article.date_creation, Jeu.prix, Jeu.synopsis, Article.date_modification,  Image.chemin_image FROM Article INNER JOIN Image ON Image.id_article = Article.id_article INNER JOIN Jeu ON Article.id_jeu = Jeu.id_jeu ORDER BY Article.date_creation DESC";
    $result = readDB($mysqli, $query);
    return $result;
}

function connection($mysqli, $login, $mdp)
{
    $sql_query = "SELECT *
    FROM Utilisateur
    WHERE Utilisateur.login = '$login'
    AND Utilisateur.mdp = '$mdp';";
    $result = readDB($mysqli, $sql_query);
    return $result;
}

function recuperer_article($mysqli) {
    $query = "SELECT titre FROM Article";
    $result = readDB($mysqli, $query);
    return $result;
}

function creation_avis($mysqli,  $login, $article_selectionne, $titre_avis, $avis, $note) {
    $query_id_article = "SELECT id_article FROM Article WHERE Article.titre = '$article_selectionne'";
    $result_id = readDB($mysqli, $query_id_article);
    $id_article = $result_id[0]['id_article']; 
    $insertion_query = "INSERT INTO Avis (titre, texte, note, date_creation, id_article, login) VALUES ('$titre_avis', '$avis', '$note', NOW(), '$id_article', '$login')";
    writeDB($mysqli, $insertion_query);
}
?>