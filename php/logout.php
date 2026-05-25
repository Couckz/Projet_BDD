<?php
    session_start();
    if (!isset($_SESSION['connecte']) or !$_SESSION['connecte']) {
        header("Location: ../connexion.php");
        exit();
    }
    $_SESSION = array();
    session_destroy();
    header("Location: ../index.php");
?>