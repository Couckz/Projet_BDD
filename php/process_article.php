<?php

session_start();
require_once(__DIR__."/../php/functions-DB.php");
require_once(__DIR__."/../php/functions-query.php");
require_once(__DIR__."/../includes/constantes.php"); //constantes du site
require_once(__DIR__."/../includes/config-bdd.php"); //donnees pour la connexion
require_once(__DIR__."/../php/functions-DB.php"); //fonctions de connexions
require_once(__DIR__."/../php/functions-query.php"); //fonctions de requêtes SQL
require_once(__DIR__."/../php/functions-structures.php"); //functions de mises en pages au niveau des données obtenues de la BDD
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!isset($_SESSION['connecte']) or !$_SESSION['connecte']) {
    header("Location: ../connexion.php");
    exit();
}

$mysqli	= connectionDB();

$login	= $_SESSION['login'];

if (isset($_POST['id_article']) and isset($_POST['action'])) {

	$id_article = $_POST['id_article'];
	$action	= $_POST['action'];
	if ($action == 'suppr') {
		supprimer_article($mysqli, $id_article);
	}
	if ($action == 'modif') {
		modifier_article($mysqli, $_POST['id_article'],$_POST['titre_article'], $_POST['note'],$_POST['contenu'], $_POST['caracteristiques'], $_POST['titre_jeu'], $_POST['prix'], $_POST['date_sortie'], $_POST['synopsis'], $_POST['categorie'], $_POST['support'], $chemin_image);
	}

}

closeDB($mysqli);

/* retour à la page précedente */
header("Location: ../index.php");

exit();




?>