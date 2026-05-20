<?php

function registration()
{
    $sql_connection = connectionDB();
    inscription($sql_connection, $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['adresse_email'], $_POST['login'], $_POST['mdp']);
    $date_inscription = date("Y-m-d");
    $date_derniere_connexion = date("Y-m-d H:i:s");
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['mdp'] = $_POST['mdp'];
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['date_inscription'] = $date_inscription;
    $_SESSION['role'] = "User";
    $_SESSION['date_derniere_connexion'] = $date_derniere_connexion;
    $_SESSION['date_naissance'] = $_POST['date_naissance'];
    $_SESSION['adresse_email'] = $_POST['adresse_email'];
    $_SESSION['chemin_pdp'] = "./img/photo_profil/defaut.png";
    $_SESSION['connecte'] = true;
    closeDB($sql_connection);
    header("Location: index.php");
}

?>