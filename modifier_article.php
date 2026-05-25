<?php
session_start();
require_once(__DIR__."/php/functions-DB.php");
require_once(__DIR__."/php/functions-query.php");
require_once(__DIR__."/includes/constantes.php");
require_once(__DIR__."/includes/config-bdd.php");
require_once(__DIR__."/php/functions-structures.php");

if (!isset($_SESSION['connecte']) || !$_SESSION['connecte']) {
    header("Location: connexion.php");
    exit();
}
if (!isset($_GET['id_article'])) {
    header("Location: index.php");
    exit();
}

$mysqli = connectionDB();
$id_article = $_GET['id_article'];
$article = information_article($mysqli, $id_article);

if (!isset($article[0])) {
    header("Location: index.php");
    exit();
}

$article = $article[0];

$categories = recuperer_categorie($mysqli);
$supports = recuperer_support($mysqli);

$categories_article = recuperer_categories_jeu($mysqli, $article['id_jeu']);
$supports_article = recuperer_supports_jeu($mysqli, $article['id_jeu']);

$categories_selectionnees = [];
foreach($categories_article as $cat) {
    $categories_selectionnees[] = $cat['nom_categorie'];
}

$supports_selectionnes = [];
foreach($supports_article as $sup) {
    $supports_selectionnes[] = $sup['nom_support'];
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier un article</title>
    <meta charset="utf-8">
    <meta name="keywords" content="jeu vidéo modification article">
    <meta name="author" content="Malo Camelia Alexandre">
    <link rel="icon" href="<?php echo $iconeSite; ?>">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
<?php include("static/header.php"); ?>
<?php include("static/nav.php"); ?>
<main>
    <form class="redaction-article-avis" action="php/process_article.php" method="POST" enctype="multipart/form-data">
    <h1>Modifier votre article</h1>
    <input type="hidden" name="id_article" value="<?php echo htmlspecialchars($article['id_article']); ?>">
    <input type="hidden" name="action" value="modif">

    <hr/>

    <fieldset>
        <label for="titre_jeu">Titre du jeu</label>
        <textarea type="text" id="titre_jeu" name="titre_jeu" required><?php echo htmlspecialchars($article['nom']); ?></textarea>
    </fieldset>

    <fieldset>
        <label for="synopsis">Synopsis</label>
        <textarea class="huge-text-area" id="synopsis" name="synopsis" maxlength="1000"required><?php echo htmlspecialchars($article['synopsis']); ?></textarea>
    </fieldset>

    <fieldset>
        <label for="image">Jaquette</label>
        <input type="file" id="image" name="image" accept="image/*">
        <p>Image actuelle :</p>
        <img src="<?php echo $article['chemin_image']; ?>" alt="jaquette"width="200">
    </fieldset>

    <fieldset>
        <label for="date_sortie">Date de sortie</label>
        <input type="date" id="date_sortie" name="date_sortie" required value="<?php echo htmlspecialchars($article['sortie']); ?>">
    </fieldset>

    <fieldset>
        <label for="prix">Prix</label>
        <input type="number" step="0.01" id="prix" name="prix" required value="<?php echo htmlspecialchars($article['prix']); ?>">
    </fieldset>

    <fieldset class="sameline">
            <div class="liste_support">
                <label>Catégories du jeu</label>

                <?php
                echo "<br>";
                foreach($categories as $cat) {
                    $nom_categorie = $cat["nom_categorie"];
                    echo "<input type=\"checkbox\" name=\"categorie[]\" value=\"$nom_categorie\"";
                    if (in_array($nom_categorie, $categories_selectionnees)) {
                        echo "checked";
                    }
                    echo ">$nom_categorie";
                    echo "<br>";
                }
                ?>
            </div>

            <div class="liste_categorie">


                <label>Supports</label>

                <?php
                echo "<br>";
                foreach($supports as $sup) {
                    $nom_support = $sup["nom_support"];
                    echo "<input type=\"checkbox\" name=\"support[]\" value=\"$nom_support\"";
                    if (in_array($nom_support, $supports_selectionnes)) {
                        echo "checked";
                    }
                    echo ">$nom_support";
                    echo "<br>";
                }
                ?>
                </label>
            </div>
    </fieldset>

    <hr/>

    <fieldset class="sameline">
        <label for="note">Note</label>
        <input type="number" id="note" name="note" min="0" max="10" required value="<?php echo htmlspecialchars($article['note']); ?>">
    </fieldset>

    <fieldset>
        <label for="titre_article">Titre de l'article</label>
        <textarea id="titre_article" name="titre_article" maxlength="100" required><?php echo htmlspecialchars($article['titre']); ?></textarea>
    </fieldset>

    <fieldset>
        <label for="contenu">Contenu de l'article</label>
        <textarea class="huge-text-area" id="contenu" name="contenu" maxlength="5000" required><?php echo htmlspecialchars($article['contenu']); ?></textarea>
    </fieldset>

    <fieldset>
        <label for="caracteristiques"> Caractéristiques (séparées par des virgules)</label>
        <input type="text" id="caracteristiques" name="caracteristiques" required value="<?php echo htmlspecialchars($article['caracteristiques']); ?>">
    </fieldset>

    <hr/>

    <input type="submit"></input>
</form>
</main>
<?php include("static/footer.php"); ?>
<?php closeDB($mysqli); ?>
</body>
</html>