<?php
session_start();
// require_once("./includes/constantes.php");//constantes du site
// require_once("./includes/config-bdd.php");
// require_once("./php/functions-DB.php");
// require_once("./php/functions_query.php");
// require_once("./php/functions_structure.php");
require_once("./php/login.php");
?> 


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/pokedex/styles/connection.css">
</head>
<body>
    <?php include("static/header.php"); ?>
    <div class="formulaire">
        <form action="/php/login.php" method="POST">
            <div class="champ">
                <label for="id">Nom d'utilisateur :</label>
                <input type="text" id="nom" name="nom">
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp">
            </div>
        <div class="soumettre">
            <button>
                Envoyer
            </button>
        </div>
        </form>
    </div>
</body>
</html>