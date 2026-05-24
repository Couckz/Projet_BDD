<?php

function information_articles($mysqli) {
    $query = "SELECT
        Article.id_article,
        Article.titre,
        Article.contenu,
        Article.note,
        Article.caracteristiques,
        Article.date_creation,
        Jeu.nom,
        Jeu.sortie,
        Jeu.prix,
        Jeu.synopsis,
        Jeu.id_jeu,
        Article.date_modification,
        Image.chemin_image
    FROM Article
    INNER JOIN Image ON Image.id_article = Article.id_article
    INNER JOIN Jeu ON Article.id_jeu = Jeu.id_jeu
    ORDER BY Article.date_creation DESC";
    $result = readDB($mysqli, $query);
    return $result;
}

function recuperer_supports_jeu($mysqli, $id_jeu) {
    $query = "SELECT nom_support
    FROM Est_jouable_sur
    WHERE id_jeu = '$id_jeu'";
    return readDB($mysqli, $query);
}

function recuperer_categories_jeu($mysqli, $id_jeu) {
    $query = "SELECT nom_categorie
    FROM Est_categorise_par
    WHERE id_jeu = '$id_jeu'";
    return readDB($mysqli, $query);
}

function information_articles_complet($mysqli) {
    $articles = information_articles($mysqli);
    $resultat = [];

    foreach($articles as $article) {
        $id_jeu = $article["id_jeu"];
        $supports = recuperer_supports_jeu($mysqli, $id_jeu);
        $categories = recuperer_categories_jeu($mysqli, $id_jeu);
        $liste_supports = [];
        foreach($supports as $support) {
            $liste_supports[] = $support["nom_support"];
        }
        $liste_categories = [];
        foreach($categories as $categorie) {
            $liste_categories[] = $categorie["nom_categorie"];
        }
        $article["supports"] = $liste_supports;
        $article["categories"] = $liste_categories;
        $resultat[] = $article;
    }
    return $resultat;
}


function information_article($mysqli, $id_article) {
    $query = "SELECT
        Article.id_article,
        Article.titre,
        Article.contenu,
        Article.note,
        Article.caracteristiques,
        Article.date_creation,
        Jeu.nom,
        Jeu.sortie,
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

function info_user($mysqli, $login)
{
    $sql_query = "SELECT login, Role, date_inscription, date_derniere_connexion, chemin_pdp
    FROM Utilisateur
    WHERE Utilisateur.login = '$login';";
    $result = readDB($mysqli, $sql_query);
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

function modif_derniere_connexion($mysqli, $login, $date)
{
    $query = "UPDATE Utilisateur
    SET date_derniere_connexion = '$date'
    WHERE Utilisateur.login = '$login';";
    writeDB($mysqli, $query);
}

function modif_nom($mysqli, $login, $nom, $prenom){
    $query = "UPDATE Utilisateur
    SET nom = '$nom', prenom = '$prenom'
    WHERE Utilisateur.login = '$login';";
    writeDB($mysqli, $query);
}

function modif_mail($mysqli, $login, $mail){
    $query = "UPDATE Utilisateur
    SET adresse_email = '$mail'
    WHERE Utilisateur.login = '$login';";
    writeDB($mysqli, $query);
}

function modif_naissance($mysqli, $login, $date){
    $query = "UPDATE Utilisateur
    SET date_naissance = '$date'
    WHERE Utilisateur.login = '$login';";
    writeDB($mysqli, $query);
}

function recuperer_article($mysqli) {
    $query = "SELECT titre FROM Article";
    $result = readDB($mysqli, $query);
    return $result;
}

function get_article_via_avis($mysqli, $id_avis){
    $query = "SELECT id_article
    FROM Avis
    WHERE id_avis='$id_avis'";
    $result = readDB($mysqli, $query);
    return $result;
}

function creation_avis($mysqli, $login, $article_selectionne, $titre_avis, $avis, $note) {

    $query_id_article = "SELECT id_article FROM Article WHERE Article.titre = '$article_selectionne';";
    $result_id = readDB($mysqli, $query_id_article);
    $id_article = $result_id[0]['id_article'];

    // vérification de l'unicité de l'avis pour cet utilisateur
    $query_nb_avis = "SELECT COUNT(*) as nb_avis FROM Avis WHERE login = '$login' AND id_article = '$id_article';";
    $nb_avis = readDB($mysqli, $query_nb_avis);
    if ($nb_avis[0]['nb_avis'] > 0) {
        return;
    }

    /* pour éviter des erreurs lorsque le texte contient des apostrophes etc */
    $titre_avis = mysqli_real_escape_string($mysqli, $titre_avis);
    $avis = mysqli_real_escape_string($mysqli, $avis);

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

function supprimer_avis($mysqli, $id_avis) {
    $query  = " DELETE FROM Avis
                WHERE id_avis = '$id_avis';";
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

function recuperer_support($mysqli) {
    $query = "SELECT nom_support FROM Support";
    $result = readDB($mysqli, $query);
    return $result;
}

function recuperer_categorie($mysqli) {
    $query = "SELECT nom_categorie FROM Categorie";
    $result = readDB($mysqli, $query);
    return $result;
}

function creation_jeu($mysqli, $titre_jeu, $prix, $synopsis, $categorie, $support, $date) {
    $titre_jeu = mysqli_real_escape_string($mysqli, $titre_jeu);
    $query_verif = "SELECT id_jeu FROM Jeu WHERE nom = '$titre_jeu'";
    $result_verif = readDB($mysqli, $query_verif);

    if(!empty($result_verif)) {
        $id_jeu = $result_verif[0]['id_jeu'];
    } else {
        $insertion_query = "INSERT INTO Jeu (nom, prix, synopsis, sortie) VALUES ('$titre_jeu', '$prix', '$synopsis', '$date')";
        writeDB($mysqli, $insertion_query);
        $query_id_jeu = "SELECT id_jeu FROM Jeu WHERE Jeu.nom = '$titre_jeu'";
        $result_id = readDB($mysqli, $query_id_jeu);
        $id_jeu = $result_id[0]['id_jeu'];
    }

    foreach($categorie as $lines) {
        $query_categorie = "INSERT IGNORE INTO Est_categorise_par (id_jeu, nom_categorie) VALUES ('$id_jeu', '$lines')";
        writeDB($mysqli, $query_categorie);
    }

    foreach($support as $lines) {
        $query_support = "INSERT IGNORE INTO Est_jouable_sur (id_jeu, nom_support) VALUES ('$id_jeu', '$lines')";
        writeDB($mysqli, $query_support);
    }
}

function creation_article($mysqli, $titre_article, $titre_jeu, $note, $contenu, $caracteristique, $chemin_final, $login) {
    $titre_article = mysqli_real_escape_string($mysqli, $titre_article);
    $contenu = mysqli_real_escape_string($mysqli, $contenu);
    $caracteristiques = mysqli_real_escape_string($mysqli, $caracteristique);
    $titre_jeu = mysqli_real_escape_string($mysqli, $titre_jeu);

    $query_id_jeu = "SELECT id_jeu FROM Jeu WHERE Jeu.nom = '$titre_jeu'";
    $result_id = readDB($mysqli, $query_id_jeu);
    $id_jeu = $result_id[0]['id_jeu'];
    $insertion_query = "INSERT INTO Article (titre, contenu, note, caracteristiques, date_creation, date_modification, id_jeu)
    VALUES ('$titre_article', '$contenu', '$note', '$caracteristiques', NOW(), NOW(), '$id_jeu')";
    writeDB($mysqli, $insertion_query);

    $query_id_article = "SELECT id_article FROM Article WHERE Article.titre = '$titre_article'";
    $result_id_article = readDB($mysqli, $query_id_article);
    $id_article = $result_id_article[0]['id_article'];
    $insertion_article_query = "INSERT INTO Image (chemin_image, id_article) VALUES ('$chemin_final', '$id_article')";
    writeDB($mysqli, $insertion_article_query);

    $query_administre = "INSERT INTO Administre (login, id_article) VALUES ('$login', '$id_article')";
    writeDB($mysqli, $query_administre);
}

function modif_pp($mysqli, $login, $path){
    $query = "UPDATE Utilisateur
    SET chemin_pdp = '$path'
    WHERE Utilisateur.login = '$login';";
    writeDB($mysqli, $query);
}

function recuperer_article_par_nom_complet($mysqli, $title) {
    $query_verif = "SELECT nom
                    FROM Jeu
                    WHERE nom = '$title'";
    $result_verif = readDB($mysqli, $query_verif);
    if(empty($result_verif)) {
        print_r("Aucun article n'est à propos de ce jeu");
        return 0;
    } else {
        $query = "SELECT
            Article.id_article,
            Article.titre,
            Article.contenu,
            Article.note,
            Article.caracteristiques,
            Article.date_creation,
            Jeu.nom,
            Jeu.sortie,
            Jeu.prix,
            Jeu.synopsis,
            Jeu.id_jeu,
            Article.date_modification,
            Image.chemin_image
        FROM Article
        INNER JOIN Image
            ON Image.id_article = Article.id_article
        INNER JOIN Jeu
            ON Article.id_jeu = Jeu.id_jeu
        WHERE Jeu.nom = '$title'
        ORDER BY Article.date_creation DESC";
        $articles = readDB($mysqli, $query);
        $resultat = [];
        foreach($articles as $article) {
            $id_jeu = $article["id_jeu"];
            // supports
            $supports = recuperer_supports_jeu($mysqli, $id_jeu);
            $liste_supports = [];
            foreach($supports as $support) {
                $liste_supports[] = $support["nom_support"];
            }
            // catégories
            $categories = recuperer_categories_jeu($mysqli, $id_jeu);
            $liste_categories = [];
            foreach($categories as $categorie) {
                $liste_categories[] = $categorie["nom_categorie"];
            }
            // ajout dans l'article
            $article["supports"] = $liste_supports;
            $article["categories"] = $liste_categories;
            $resultat[] = $article;
        }
        return $resultat;
    }
}

function recuperer_article_par_categorie_complet($mysqli, $categorie) {
    $query = "SELECT
        Article.id_article,
        Article.titre,
        Article.contenu,
        Article.note,
        Article.caracteristiques,
        Article.date_creation,
        Jeu.nom,
        Jeu.sortie,
        Jeu.prix,
        Jeu.synopsis,
        Jeu.id_jeu,
        Article.date_modification,
        Image.chemin_image
    FROM Article
    INNER JOIN Image
        ON Image.id_article = Article.id_article
    INNER JOIN Jeu
        ON Article.id_jeu = Jeu.id_jeu
    INNER JOIN Est_categorise_par
        ON Est_categorise_par.id_jeu = Jeu.id_jeu
    WHERE Est_categorise_par.nom_categorie = '$categorie'
    ORDER BY Article.date_creation DESC";
    $articles = readDB($mysqli, $query);
    $resultat = [];
    foreach($articles as $article) {
        $id_jeu = $article["id_jeu"];
        // supports
        $supports = recuperer_supports_jeu($mysqli, $id_jeu);
        $liste_supports = [];
        foreach($supports as $support) {
            $liste_supports[] = $support["nom_support"];
        }
        // catégories
        $categories = recuperer_categories_jeu($mysqli, $id_jeu);
        $liste_categories = [];
        foreach($categories as $categorie_ligne) {
            $liste_categories[] = $categorie_ligne["nom_categorie"];
        }
        // ajout dans l'article
        $article["supports"] = $liste_supports;
        $article["categories"] = $liste_categories;
        $resultat[] = $article;
    }

    return $resultat;
}

function get_note_moyenne($mysqli, $id_article) {
    $query = "SELECT AVG(note) as moyenne FROM Avis WHERE id_article = '$id_article'";
    $result = readDB($mysqli, $query);
    return $result;
}

function est_administre_par($mysqli, $login, $id_article) {
    $query = "SELECT id_article FROM Administre WHERE login = '$login' AND id_article ='$id_article'";
    $result = readDB($mysqli, $query);
    return !empty($result); //true si administre l'article, false sinon
}
?>