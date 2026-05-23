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
        titre,
        Utilisateur.chemin_pdp
    FROM Avis
    INNER JOIN Utilisateur USING(login)
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

function recuperer_article($mysqli) {
    $query = "SELECT titre FROM Article";
    $result = readDB($mysqli, $query);
    return $result;
}

function creation_avis($mysqli,  $login, $article_selectionne, $titre_avis, $avis, $note) {
    $query_id_article = "SELECT id_article FROM Article WHERE Article.titre = '$article_selectionne';";
    $result_id = readDB($mysqli, $query_id_article);
    $id_article = $result_id[0]['id_article'];
    $insertion_query = "INSERT INTO Avis (titre, texte, note, date_creation, id_article, login) VALUES ('$titre_avis', '$avis', '$note', NOW(), '$id_article', '$login');";
    writeDB($mysqli, $insertion_query);
}


function recuperer_avis($mysqli, $id_avis) {

    $query = "SELECT
        date_creation,
        id_avis,
        login,
        note,
        texte,
        titre,
        Utilisateur.chemin_pdp
    FROM Avis
    INNER JOIN Utilisateur USING(login)
    WHERE id_avis = $id_avis;";

    return readDB($mysqli, $query);
}

function modifier_avis($mysqli, $login, $id_avis, $nouveau_titre, $nouveau_texte, $nouvelle_note) {

    /* pour éviter des erreurs lorsque le texte contient des apostrophes etc */
    $nouveau_titre = mysqli_real_escape_string($mysqli, $nouveau_titre);
    $nouveau_texte = mysqli_real_escape_string($mysqli, $nouveau_texte);

    $query  = " UPDATE Avis
                SET
                    titre = '$nouveau_titre',
                    texte = '$nouveau_texte',
                    note = $nouvelle_note

                WHERE id_avis = $id_avis
                AND login = '$login';";
    writeDB($mysqli, $query);
}

function supprimer_avis($mysqli, $login, $id_avis) {
    $query  = " DELETE FROM Avis
                WHERE id_avis = '$id_avis'
                AND login = '$login';";
    writeDB($mysqli, $query);
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