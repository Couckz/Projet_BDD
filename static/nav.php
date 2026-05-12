<?php
session_start();
?>
<nav>
    <ul>
        <li><a class="Acceuil" href="index.php">Acceuil</a></li>
        <?php
            if(isset($_SESSION['connecte']) && $_SESSION['connecte']){
                ?><li><a href="php/logout.php">Déconnexion</a></li><?php
                ?><li><a href="maj.php">Mettre à jour son Pokédex</a></li><?php
            }else{
                ?><li><a href="connection.php">Connexion</a></li><?php
            }?>
    </ul>
</nav>