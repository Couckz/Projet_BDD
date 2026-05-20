<header>
    <?php
	$rootPath = '/' . explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];
    ?>
    <a href="index.php">
        <?php
        $rootPath = '/' . explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];
        echo "<img src='$rootPath/Projet_BDD/img/site/logo.png' alt='Logo du site'>"
        ?>
    </a>
    <h1>Game-Actu</h1>
</header>