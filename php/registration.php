<?php

function registration()
{
    $sql_connection = connectionDB();
    inscription($sql_connection, $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['adresse_email'], $_POST['login'], $_POST['mdp']);
    closeDB($sql_connection);
    header("Location: index.php");
}

?>