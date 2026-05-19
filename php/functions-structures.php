<?php

function affichage_article($article){

    echo "<div class = 'articles_container'>";

    foreach($article as $lines){
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
                            echo "<img src='$chemin_img'>";
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


?>