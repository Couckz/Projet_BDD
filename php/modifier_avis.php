<?php
session_start();
require_once(__DIR__."/../php/functions-DB.php");
require_once(__DIR__."/../php/functions-query.php");
require_once(__DIR__."/../includes/constantes.php"); //constantes du site
require_once(__DIR__."/../includes/config-bdd.php"); //donnees pour la connexion
require_once(__DIR__."/../php/functions-DB.php"); //functions de connexions
require_once(__DIR__."/../php/functions-query.php"); //functions de requêtes SQL
require_once(__DIR__."/../php/functions-structures.php"); //functions de mises en pages au niveau des données obtenues de la BDD

if (!isset($_SESSION['connecte']) or !$_SESSION['connecte']) {
    header("Location: ../connexion.php");
    exit();
}

if (!isset($_GET['id_avis'])) {
	header("Location: ../index.php");
	exit();
}

$mysqli	= connectionDB();

$login	= $_SESSION['login'];

$avis	= recuperer_avis($mysqli, $_GET['id_avis']);

if (!isset($avis[0]) or $avis[0]['login'] != $_SESSION['login']) {
	header("Location: ../index.php");
	exit();
}

$avis = $avis[0];
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="styles/style.css">
		<title>Modifier mon avis</title>
	</head>
	<body>
		<form action="process_avis.php" method="POST">
			<input type="hidden" name="id_avis" value="<?php echo htmlspecialchars($avis['id_avis']); ?>">
			<input type="hidden" name="action" value="modif">

			<input type="text" name="titre" value="<?php echo htmlspecialchars($avis['titre']); ?>" required>
			<textarea name="texte" required><?php echo htmlspecialchars($avis['texte']); ?></textarea>
			<input type="number" name="note" min="0" max="10" value="<?php echo htmlspecialchars($avis['note']); ?>">

			<button type="submit">Enregistrer les modifications</button>
		</form>
	</body>
</html>


<?php
closeDB($mysqli);
?>