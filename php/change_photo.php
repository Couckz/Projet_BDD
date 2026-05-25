<?php
function change_photo()
{
        $mysqli = connectionDB();
        $image = $_FILES['pp'];
        $dossier = "../img/photo_profil/";
        $nom_original = basename($_FILES["pp"]["name"]);
        $extension = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
        $nom_unique = $_SESSION["login"] . "." . $extension;
        $chemin_final = $dossier . $nom_unique;
        $login = $_SESSION["login"];
        move_uploaded_file($_FILES["pp"]["tmp_name"],$chemin_final);
        modif_pp($mysqli, $_SESSION['login'], $chemin_final);
        $_SESSION['chemin_pdp'] =  $chemin_final;
        closeDB($mysqli);
        header("Location: profil_prive.php");
}
?>
