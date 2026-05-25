<?php

function affichage_articles($articles){
    echo "<div class = 'articles_container'>";

    foreach($articles as $lines){
            $id_article = $lines["id_article"];
            $titre = $lines["titre"];
            $contenu = $lines["contenu"];
            $date_creation = $lines["date_creation"];
            $date_modification = $lines["date_modification"];
            $note = $lines["note"];
            $caracteristiques = explode(",", $lines["caracteristiques"]);
            $chemin_img = $lines["chemin_image"];
            $prix = $lines["prix"];
            $synopsis = $lines["synopsis"];
            $nom_jeu = $lines["nom"];
            $date_sortie = $lines["sortie"];


            echo "<a href = article.php/?id_article=$id_article>";
                echo "<div class = 'article'>";

                        echo "<div class = 'presentation'>";

                            echo "<div class = 'intro'>";
                                echo "<h2 class = 'title'>$titre</h2>";
                                echo "<section class = 'caracteristique'>";

                                    echo "<div class = 'tags_container'>";
                                        foreach($caracteristiques as $caracteristique){
                                            echo "<div class = 'tag_bubble'>$caracteristique</div>";
                                        }
                                    echo "</div>";

                                    echo "$synopsis<br/>";
                                echo "</section>";
                            echo "</div>";

                            echo "<div class = 'intro2'>";
                                echo "<div class = 'img_container'>";
                                    $chemin_img = dirname($_SERVER['SCRIPT_NAME'])."/".$chemin_img;
                                    echo "<img src='$chemin_img'>";
                                echo "</div>";
                                echo "<p>Jeu : $nom_jeu</p>";
                                echo "<p>Prix : $prix €</p>";
                                echo "<p>Date de sortie : $date_sortie</p>";
                                echo "<p> Supports :";
                                foreach($lines["supports"] as $support){
                                    echo " $support";
                                }
                                echo "</p>";

                                echo "<p> Categories :";
                                foreach($lines["categories"] as $cat){
                                    echo " $cat";
                                }
                                echo "</p>";
                                echo "<p class='note'> Note : $note/10</p>";
                            echo "</div>";
                        echo "</div>";

                        echo "<div class='content'>";
                            echo "<p class='texte'>";
                                echo $contenu;
                            echo "<p>";
                        echo "</div>";

                        echo "<footer class = 'fin'>";
                            echo "Date de création : $date_creation  ";
                            echo "  Modifié le : $date_modification";
                        echo "</footer>";

                echo "</div>";
            echo "</a>";

    }

    echo "</div>";
}

function date_to_str($date){
    $chaine_date = substr($date, 8, 2);
    switch(substr($date, 5, 2)){
        case "01":
            $chaine_date = $chaine_date." janvier ";
            break;
        case "02":
            $chaine_date = $chaine_date." février ";
            break;
        case "03":
            $chaine_date = $chaine_date." mars ";
            break;
        case "04":
            $chaine_date = $chaine_date." avril ";
            break;
        case "05":
            $chaine_date = $chaine_date." mai ";
            break;
        case "06":
            $chaine_date = $chaine_date." juin ";
            break;
        case "07":
            $chaine_date = $chaine_date." juillet ";
            break;
        case "08":
            $chaine_date = $chaine_date." août ";
            break;
        case "09":
            $chaine_date = $chaine_date." septembre ";
            break;
        case "10":
            $chaine_date = $chaine_date." octobre ";
            break;
        case "11":
            $chaine_date = $chaine_date." novembre ";
            break;
        case "12":
            $chaine_date = $chaine_date." décembre ";
            break;
        default:
            return 0;
            break;
    }
    $chaine_date = $chaine_date.substr($date, 0, 4);
    return $chaine_date;
}

function affichage_article($article) {
    $mysqli = connectionDB();
    $id_article  = $article["id_article"];
    $titre  = $article["titre"];
    $contenu  = $article["contenu"];
    $date_creation  = $article["date_creation"];
    $date_modification = $article["date_modification"];
    $note = $article["note"];
    $caracteristiques  = explode(",", $article["caracteristiques"]);
    $chemin_img = $article["chemin_image"];
    $prix = $article["prix"];
    $synopsis = $article["synopsis"];
    $nom_jeu = $article["nom"];
    $date_sortie  = $article["sortie"];
    $id_jeu = $article["id_jeu"];
    $supports = recuperer_supports_jeu($mysqli, $id_jeu);
    $categories = recuperer_categories_jeu($mysqli, $id_jeu);
    $est_connecte = isset($_SESSION['connecte']) && $_SESSION['connecte'];

    echo "<div class='article'>";
        echo "<div class='presentation'>";
            if ($est_connecte && $_SESSION["role"] === "Admin") {
                echo "<div class='article-actions'>";
                    echo "<form action='../php/process_article.php' method='POST'>";
                        echo "<input type='hidden' name='id_article' value='$id_article'>";
                        echo "<input type='hidden' name='action' value='suppr'>";
                        echo "<button type='submit'>Supprimer</button>";
                    echo "</form>";
                    echo "<form action='../modifier_article.php' method='GET'>";
                        echo "<input type='hidden' name='id_article' value='$id_article'>";
                        echo "<button type='submit'>Modifier</button>";
                    echo "</form>";
                echo "</div>";
            }
            if ($est_connecte && $_SESSION["role"] === "Redacteur") {
                if (est_administre_par($mysqli, $_SESSION["login"], $id_article)) {
                    echo "<div class='article-actions'>";
                        echo "<form action='../php/process_article.php' method='POST'>";
                            echo "<input type='hidden' name='id_article' value='$id_article'>";
                            echo "<input type='hidden' name='action' value='suppr'>";
                            echo "<button type='submit'>Supprimer</button>";
                        echo "</form>";
                        echo "<form action='../modifier_article.php' method='GET'>";
                            echo "<input type='hidden' name='id_article' value='$id_article'>";
                            echo "<button type='submit'>Modifier</button>";
                        echo "</form>";
                    echo "</div>";
                }
            }
            echo "<div class='intro'>";
                echo "<h2 class='title'>$titre</h2>";
                echo "<section class='caracteristique'>";
                    echo "<div class='tags_container'>";
                        foreach($caracteristiques as $caracteristique) {
                            echo "<div class='tag_bubble'>$caracteristique</div>";
                        }
                    echo "</div>";
                    echo "$synopsis<br/>";
                echo "</section>";
            echo "</div>";
            echo "<div class='intro2'>";
                echo "<div class='img_container'>";
                    echo "<img src='../$chemin_img'>";
                echo "</div>";
                echo "<p>Jeu : $nom_jeu</p>";
                echo "<p>Prix : $prix €</p>";
                echo "<p>Date de sortie : $date_sortie</p>";
                echo "<p>Supports :</p>";
                foreach($supports as $support) {
                    echo $support["nom_support"] . " ";
                }

                echo "<p>Catégories : ";
                foreach($categories as $categorie) {
                    echo $categorie["nom_categorie"] . " ";
                }
                echo "</p>";

                echo "<p class='note'>Note : $note/10</p>";
            echo "</div>";
        echo "</div>";
        echo "<div class='content'>";
            echo "<p class='texte'>$contenu</p>";
        echo "</div>";
        echo "<footer class='fin'>";
            echo "Date de création : $date_creation ";
            echo "Modifié le : $date_modification";
        echo "</footer>";
    echo "</div>";
    closeDB($mysqli);
}

function affichage_liste_avis($liste_avis) {

    $est_connecte = isset($_SESSION['connecte']) && $_SESSION['connecte'];

    foreach($liste_avis as $avis){

        /* sépare date et heure */
        $date_creation  = explode(" ", $avis["date_creation"]);
        $jour           = $date_creation[0];
        $heure          = $date_creation[1];

        $note           = $avis["note"];
        $texte          = $avis["texte"];
        $titre          = $avis["titre"];

        $id_avis        = $avis["id_avis"];
        $login          = $avis["login"];
        $chemin_pdp     = $avis["chemin_pdp"];

        echo "<div class = 'avis'>";

            echo "<section class = 'avis-contenu'>";

                echo "<div class = 'avis_header'>";
                    echo "<div class = 'avis_pdp_img_container'>";
                        echo "<a href='../profil_public.php/?login=$login'><img src = '$chemin_pdp' alt = 'photo de profil de $login'></a>";
                    echo "</div>";
                    echo "<h2>$titre</h2>";
                    if ($est_connecte and ($_SESSION['login'] === $login) || $_SESSION['role'] === "Admin") {
                        echo "<div class='avis-actions'>";

                            echo "<form action='../php/process_avis.php' method='POST'>";
                                echo "<input type='hidden' name='id_avis' value='$id_avis'>";
                                echo "<input type='hidden' name='action' value='suppr'>";
                                echo "<button type='submit'>Supprimer</button>";
                            echo "</form>";
                            if ($est_connecte and ($_SESSION['login'] === $login)){
                            echo "<form action='../modifier_avis.php' method='GET'>";
                                echo "<input type='hidden' name='id_avis' value='$id_avis'>";
                                echo "<button type='submit'>Modifier</button>";
                            echo "</form>";
                            }
                        echo "</div>";
                    }
                echo "</div>";

                echo "<p>De <i>$login</i>, le $jour, à $heure</p>";

                echo "<p>Note: $note/10</p>";
                echo "$texte";

            echo "</section>";

        echo "</div>";
    }
}

function affiche_profil_public($info_user){
    $login = $info_user[0]["login"];
    $pp = $info_user[0]["chemin_pdp"];
    $date_der_co = date_to_str($info_user[0]["date_derniere_connexion"]);
    $date_prem_co = date_to_str($info_user[0]["date_inscription"]);
    ?><div class = "profile_publique">
        <h1 class="salutation">Vous regardez le profil de <?php echo $login;?>!</h2>
        <img src="<?php echo $pp; ?>" alt="photo de profil">
        <p>
            <br>Membre depuis le <?php echo $date_prem_co;?><br>
            <br>Dernières connexion le <?php echo $date_der_co;?>
        </p>
    </div><?php
}

function displayForm($article) {
    foreach($article as $line) {
        $nom_article = $line['titre'];
        echo "<option value=\"$nom_article\">$nom_article</option>";
    };

}

function display_categorie($categorie) {
    echo "<br>";
    foreach($categorie as $line) {
        $nom_categorie = $line["nom_categorie"];
        echo "<input type=\"checkbox\" name=\"categorie[]\" value=\"$nom_categorie\">$nom_categorie<br>";
    }
}

function display_categorie_selection($categorie) {
    foreach($categorie as $line) {
        $nom_categorie = $line["nom_categorie"];
        echo "<option value=\"$nom_categorie\">$nom_categorie</option>";
    }
}

function display_support($support) {
    echo "<br>";
    foreach($support as $line) {
        $nom_support = $line["nom_support"];
        echo "<input type=\"checkbox\" name=\"support[]\" value=\"$nom_support\">$nom_support<br>";
    }
}

function affichage_note_moyenne($moyenne) {
    foreach($moyenne as $line) {
        $moy = $line["moyenne"];
        if (is_numeric($moy)) {
            echo "Note moyenne donnée par les utilisateurs : " . number_format($moy, 2) . " / 10";
        }
    }
}
?>