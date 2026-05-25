<?php
session_start();
require_once(__DIR__."/php/functions-DB.php");
require_once(__DIR__."/php/functions-query.php");
require_once(__DIR__."/includes/constantes.php"); //constantes du site
require_once(__DIR__."/includes/config-bdd.php"); //donnees pour la connexion
require_once(__DIR__."/php/functions-DB.php"); //functions de connexions
require_once(__DIR__."/php/functions-query.php"); //functions de requêtes SQL
require_once(__DIR__."/php/functions-structures.php"); //functions de mises en pages au niveau des données obtenues de la BDD

if (!isset($_SESSION['connecte']) or !$_SESSION['connecte']) {
    header("Location: connexion.php");
    exit();
}

if (!isset($_GET['id_avis'])) {
	header("Location: index.php");
	exit();
}

$mysqli	= connectionDB();

$login	= $_SESSION['login'];

$avis	= recuperer_avis($mysqli, $_GET['id_avis']);

if (!isset($avis[0]) or $avis[0]['login'] != $_SESSION['login']) {
	header("Location: index.php");
	exit();
}

$avis = $avis[0];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Modifier mon avis</title>
        <meta charset="utf-8">
        <meta name="keywords" content="jeu vidéo modification avis">
        <meta name="author" content="Malo Camelia Alexandre">
        <link rel="icon" href="images/pokeball.png">
        <link rel="stylesheet" type="text/css" href="styles/style.css">
    </head>
    <body>
		<?php include("static/header.php"); ?>
		<?php include("static/nav.php"); ?>
		<main>
			<form class="redaction-article-avis" action="php/process_avis.php" method="POST">
				<h1>Modifiez votre avis</h1>
				<input type="hidden" name="id_avis" value="<?php echo htmlspecialchars($avis['id_avis']); ?>">
				<input type="hidden" name="action" value="modif">

				<hr/>

				<fieldset class="sameline">
					<label for="note">Note donnée</label>
					<input type="number" name="note" id="note" min="0" max="10" value="<?php echo htmlspecialchars($avis['note']); ?>">
				</fieldset>

				<fieldset>
					<label for="titre">Titre de l'avis</label>
					<textarea name="titre" id="titre" maxlength="30" required><?php echo htmlspecialchars($avis['titre']); ?></textarea>
				</fieldset>

				<fieldset>
					<label for="texte">Contenu de l'avis</label>
					<textarea class = "huge-text-area" name="texte" id="texte" maxlength="500" required><?php echo htmlspecialchars($avis['texte']); ?></textarea>
				</fieldset>

				<hr/>

				<input type="submit"></input>
			</form>
		</main>
        <?php include("static/footer.php"); ?>
        <?php closeDB($mysqli); ?>
	</body>
</html>


<!-- <?php
closeDB($mysqli);
?> -->