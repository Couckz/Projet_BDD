<?php

function information_articles($mysqli) {
    $query = "SELECT
        Article.id_article,
        Article.titre,
        Article.contenu,
        Article.note,
        Article.caracteristiques,
        Article.date_creation,
        Jeu.prix,
        Jeu.synopsis,
        Article.date_modification,
        Image.chemin_image
    FROM Article
    INNER JOIN Image ON Image.id_article = Article.id_article
    INNER JOIN Jeu ON Article.id_jeu = Jeu.id_jeu
    ORDER BY Article.date_creation DESC";
    $result = readDB($mysqli, $query);
    return $result;
}

function information_article($mysqli, $id_article) {
    $query = "SELECT
        Article.id_article,
        Article.titre,
        Article.contenu,
        Article.note,
        Article.caracteristiques,
        Article.date_creation,
        Jeu.prix,
        Jeu.synopsis,
        Article.date_modification,
        Image.chemin_image
    FROM Article
    INNER JOIN Image ON Image.id_article = Article.id_article
    INNER JOIN Jeu ON Article.id_jeu = Jeu.id_jeu
    WHERE Article.id_article = '$id_article'
    ORDER BY Article.date_creation DESC";
    $result = readDB($mysqli, $query);
    return $result;
}


function liste_avis($mysqli, $id_article) {

    $query = "SELECT
        date_creation,
        id_avis,
        login,
        note,
        texte,
        titre
    FROM avis
    WHERE id_article = '$id_article';";

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

function inscription($mysqli, $nom, $prenom, $date_naissance, $adresse_email, $login, $mdp)
{
    $date_inscription = date("Y-m-d");
    $date_derniere_connexion = date("Y-m-d H:i:s");
    $sql_query = "INSERT INTO Utilisateur (Role, login, mdp, date_inscription, date_derniere_connexion, prenom, nom, date_naissance, adresse_email, chemin_pdp)
    VALUES ('User', '$login', '$mdp', '$date_inscription', '$date_derniere_connexion', '$prenom', '$nom', '$date_naissance', '$adresse_email', '../img/photo_profil/defaut.png');";
    writeDB($mysqli, $sql_query);
}
?>