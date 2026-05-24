<?php
session_start();
require_once(__DIR__."/../php/functions-DB.php");
require_once(__DIR__."/../php/functions-query.php");
require_once(__DIR__."/../includes/constantes.php"); //constantes du site
require_once(__DIR__."/../includes/config-bdd.php"); //donnees pour la connexion
require_once(__DIR__."/../php/functions-DB.php"); //fonctions de connexions
require_once(__DIR__."/../php/functions-query.php"); //fonctions de requêtes SQL
require_once(__DIR__."/../php/functions-structures.php"); //functions de mises en pages au niveau des données obtenues de la BDD

if (!isset($_SESSION['connecte']) or !$_SESSION['connecte']) {
    header("Location: ../connexion.php");
    exit();
}

$mysqli	= connectionDB();
$login	= $_SESSION['login'];

if (isset($_POST['id_avis']) and isset($_POST['action'])) {

	$id_avis = $_POST['id_avis'];
	$action	= $_POST['action'];

	$id_article = get_article_via_avis($mysqli, $id_avis)[0]['id_article'];

	if ($action == 'suppr') {
		supprimer_avis($mysqli, $login, $id_avis);
	}

	if ($action == 'modif') {
		modifier_avis($mysqli, $login, $id_avis, $_POST['titre'], $_POST['texte'], $_POST['note']);
	}

}

closeDB($mysqli);

/* retour à la page précedente */
header("Location: ../article.php/?id_article=" . $id_article);

exit();

?>