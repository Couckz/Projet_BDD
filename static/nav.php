<?php
session_start();
?>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <?php
            if(isset($_SESSION['connecte']) && $_SESSION['connecte']){
                ?><li><a href="profil.php">Profil</a></li><?php
                ?><li><a href="php/logout.php">Déconnexion</a></li><?php
                ?><li><a href="avis.php">Poster un avis</a></li><?php

                if($_SESSION['role'] == "Redacteur") {
                    ?><li><a href="article.php">Rediger un article</a></li><?php
                }
            }else{
                ?><li><a href="connexion.php">Connexion</a></li><?php
            }
            
            
            
            ?>

            
    </ul>
</nav>