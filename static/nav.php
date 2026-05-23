<?php
$rootPath = dirname($_SERVER['SCRIPT_NAME']);
?>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <?php
            if(isset($_SESSION['connecte']) && $_SESSION['connecte']){
                ?><li><a href="<?php echo $rootPath; ?>/profil.php">Profil</a></li><?php
                ?><li><a href="<?php echo $rootPath; ?>/php/logout.php">Déconnexion</a></li><?php
                ?><li><a href="<?php echo $rootPath; ?>/avis.php">Poster un avis</a></li><?php
                if ($_SESSION['role'] == "Redacteur" || $_SESSION['role'] == "Admin"  ) {
                    ?><li><a href="<?php echo $rootPath; ?>/redaction.php">Rediger un article</a></li><?php
                }
            } else{
                ?><li><a href="<?php echo $rootPath; ?>/connexion.php">Connexion</a></li><?php
            }?>
    </ul>
</nav>