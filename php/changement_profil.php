<?php

function change_nom()
{
    $sql_connection = connectionDB();
    modif_nom($sql_connection, $_SESSION['login'], $_POST['nom'], $_POST['prenom']);
    closeDB($sql_connection);
}

function change_mail()
{
    $sql_connection = connectionDB();
    modif_mail($sql_connection, $_SESSION['login'], $_POST['adresse_email']);
    closeDB($sql_connection);
}

function change_naissance()
{
    $sql_connection = connectionDB();
    modif_naissance($sql_connection, $_SESSION['login'], $_POST['date_naissance']);
    closeDB($sql_connection);
}


?>