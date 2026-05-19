<?php

function login()
{
    $sql_connection = connectionDB();
    $connect = connection($sql_connection, $_POST['login'], $_POST['mdp']);
    if(empty($connect)){
        closeDB($sql_connection);
        header("Location: http://localhost/Projet_BDD/connexion.php");
    }else{
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $_SESSION['connecte'] = true;
        closeDB($sql_connection);
        header("Location: http://localhost/Projet_BDD/index.php");
    }
}

?>