<?php

function affichage_article($article){
    foreach($article as $lines){
            $titre = $lines["titre"];
            $contenu = $lines["contenu"];
            $date_creation = $lines["date_creation"];
            $date_modification = $lines["date_modification"];
            $note = $lines["note"];
            $caracteristiques = $lines["caracteristiques"];
            $chemin_img = $lines["chemin_image"];
            $prix = $lines["prix"];
            $synopsis = $lines["synopsis"];

            echo "<div class = 'border_article'>";
            echo "<div class = 'presentation'>";

            echo "<div class = 'intro'>";
            echo "<h2 class = 'title'>";
            echo "$titre";
            echo "</h2>";
            echo "<section class = 'caracteristique'>";
            echo "$synopsis";
            echo "$caracteristiques";
            echo "</section>";
            echo "</div>";

            echo "<div class = 'intro2'>";
            echo "<img src='$chemin_img'>";
            echo "<p class='note'>";
            echo "prix : $prix";
            echo "<p> Note :  ";
            echo "<p> $note/10";
            echo "</p>";
            echo "</p>";
            echo "</p>";
            echo "</div>";
            

            echo "</div>";
            echo "<div class='contenu'>";
            echo "<p class='texte'>";
            echo $contenu;
            echo "<p>";
            echo "<footer class = 'fin'>";
            echo "Date de création : $date_creation  ";
            echo "  Modifié le : $date_modification";
            echo "</footer>";
            echo "</div>";
            echo "</div>";
    }
}


?>