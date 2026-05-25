<?php

function login()
{
    $sql_connection = connectionDB();
    modif_derniere_connexion($sql_connection, $_POST['login'], date("Y-m-d H:i:s"));
    $connect = connection($sql_connection, $_POST['login'], $_POST['mdp']);
    if(empty($connect)){
        closeDB($sql_connection);
        header("Location: connexion.php");
    }else{
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $_SESSION['prenom'] = $connect[0]['prenom'];
        $_SESSION['nom'] = $connect[0]['nom'];
        $_SESSION['date_inscription'] = $connect[0]['date_inscription'];
        $_SESSION['role'] = $connect[0]['Role'];
        $_SESSION['date_derniere_connexion'] = $connect[0]['date_derniere_connexion'];
        $_SESSION['date_naissance'] = $connect[0]['date_naissance'];
        $_SESSION['adresse_email'] = $connect[0]['adresse_email'];
        $_SESSION['chemin_pdp'] = $connect[0]['chemin_pdp'];
        $_SESSION['chemin_pdp'] = ltrim($_SESSION['chemin_pdp'], './'); //evite les ../ , sinon sa marche pas sur linux
        $_SESSION['connecte'] = true;
        closeDB($sql_connection);
        header("Location: index.php");
    }
}

?>