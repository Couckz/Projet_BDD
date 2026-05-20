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

            echo "<div class = 'border_article'>";
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
                            echo "<a href = article.php/?id_article=$id_article>";
                                echo "<img src='$chemin_img'>";
                            echo "</a>";
                        echo "</div>";
                        echo "<p>Prix : $prix</p>";
                        echo "<p class='note'> Note : $note/10</p>";
                    echo "</div>";


                 echo "</div>";

                echo "<div class='contenu'>";
                    echo "<p class='texte'>";
                        echo $contenu;
                    echo "<p>";
                echo "</div>";

                echo "<footer class = 'fin'>";
                    echo "Date de création : $date_creation  ";
                    echo "  Modifié le : $date_modification";
                echo "</footer>";

            echo "</div>";
    }

    echo "</div>";
}

<<<<<<< Updated upstream
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
=======

function affichage_article($article) {

    $id_article = $article["id_article"];
    $titre = $article["titre"];
    $contenu = $article["contenu"];
    $date_creation = $article["date_creation"];
    $date_modification = $article["date_modification"];
    $note = $article["note"];
    $caracteristiques = explode(",", $article["caracteristiques"]);
    $chemin_img = $article["chemin_image"];
    $prix = $article["prix"];
    $synopsis = $article["synopsis"];

    echo "<div class = 'border_article'>";
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
                    echo "<img src='../$chemin_img'>";
                echo "</div>";
                echo "<p>Prix : $prix</p>";
                echo "<p class='note'> Note : $note/10</p>";
            echo "</div>";


            echo "</div>";

        echo "<div class='contenu'>";
            echo "<p class='texte'>";
                echo $contenu;
            echo "<p>";
        echo "</div>";

        echo "<footer class = 'fin'>";
            echo "Date de création : $date_creation  ";
            echo "  Modifié le : $date_modification";
        echo "</footer>";

    echo "</div>";
}

>>>>>>> Stashed changes
function affichage_article($article) {

    $id_article = $article["id_article"];
    $titre = $article["titre"];
    $contenu = $article["contenu"];
    $date_creation = $article["date_creation"];
    $date_modification = $article["date_modification"];
    $note = $article["note"];
    $caracteristiques = explode(",", $article["caracteristiques"]);
    $chemin_img = $article["chemin_image"];
    $prix = $article["prix"];
    $synopsis = $article["synopsis"];

    echo "<div class = 'border_article'>";
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
                    echo "<img src='../$chemin_img'>";
                echo "</div>";
                echo "<p>Prix : $prix</p>";
                echo "<p class='note'> Note : $note/10</p>";
            echo "</div>";


            echo "</div>";

        echo "<div class='contenu'>";
            echo "<p class='texte'>";
                echo $contenu;
            echo "<p>";
        echo "</div>";

        echo "<footer class = 'fin'>";
            echo "Date de création : $date_creation  ";
            echo "  Modifié le : $date_modification";
        echo "</footer>";

    echo "</div>";
}

?>