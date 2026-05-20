<?php
session_start();
$rootPath = dirname($_SERVER['SCRIPT_NAME']);
?>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <?php
            if(isset($_SESSION['connecte']) && $_SESSION['connecte']){
                ?><li><a href="profil.php">Profil</a></li><?php
                ?><li><a href="php/logout.php">Déconnexion</a></li><?php
            }else{
                ?><li><a href="<?php echo $rootPath; ?>/connexion.php">Connexion</a></li><?php
            }?>
    </ul>
</nav>