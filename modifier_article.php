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
    <form class="modification-article" action="php/process_article.php" method="POST" enctype="multipart/form-data">
    <h1>Modifier votre article</h1>
    <input type="hidden" name="id_article" value="<?php echo htmlspecialchars($article['id_article']); ?>">
    <input type="hidden" name="action" value="modif">

    <fieldset>
        <label for="titre_article">Titre de l'article</label>
        <input type="text" id="titre_article" name="titre_article" maxlength="100" required value="<?php echo htmlspecialchars($article['titre']); ?>">
    </fieldset>

    <fieldset>
        <label for="note">Note</label>
        <input type="number" id="note" name="note" min="0" max="10" required value="<?php echo htmlspecialchars($article['note']); ?>">
    </fieldset>

    <fieldset>
        <label for="contenu">Contenu</label>
        <textarea class="huge-text-area" id="contenu" name="contenu" maxlength="5000" required><?php echo htmlspecialchars($article['contenu']); ?></textarea>
    </fieldset>

    <fieldset>
        <label for="caracteristiques"> Caractéristiques (séparées par des virgules)</label>
        <input type="text" id="caracteristiques" name="caracteristiques" required value="<?php echo htmlspecialchars($article['caracteristiques']); ?>">
    </fieldset>

    <fieldset>
        <label for="titre_jeu">Titre du jeu</label>
        <input type="text" id="titre_jeu" name="titre_jeu" required value="<?php echo htmlspecialchars($article['nom']); ?>">
    </fieldset>

    <fieldset>
        <label for="prix">Prix</label>
        <input type="number" step="0.01" id="prix" name="prix" required value="<?php echo htmlspecialchars($article['prix']); ?>">
    </fieldset>

    <fieldset>
        <label for="date_sortie">Date de sortie</label>
        <input type="date" id="date_sortie" name="date_sortie" required value="<?php echo htmlspecialchars($article['sortie']); ?>">
    </fieldset>

    <fieldset>
        <label for="synopsis">Synopsis</label>
        <textarea id="synopsis" name="synopsis" maxlength="1000"required><?php echo htmlspecialchars($article['synopsis']); ?></textarea>
    </fieldset>

    <fieldset>
        <label for="image">Jaquette</label>
        <input type="file" id="image" name="image" accept="image/*">
        <p>Image actuelle :</p>
        <img src="<?php echo $article['chemin_image']; ?>" alt="jaquette"width="200">
    </fieldset>

    <fieldset>
    <legend>Catégories</legend>

    <?php
    foreach($categories as $cat) {
    ?>
    <label>
        <input type="checkbox" name="categorie[]" value="<?php echo $cat['nom_categorie']; ?>"
            <?php
            if (in_array($cat['nom_categorie'], $categories_selectionnees)) {
                echo "checked";
            }
            ?>
            >
        <?php echo $cat['nom_categorie']; ?>
        </label>
        <br>
    <?php
    }
    ?>

</fieldset>

<fieldset>
    <legend>Supports</legend>
    <?php
    foreach($supports as $sup) {
    ?>
    <label>
    <input type="checkbox" name="support[]" value="<?php echo $sup['nom_support']; ?>"
    <?php
    if (in_array($sup['nom_support'], $supports_selectionnes)) {
        echo "checked"; 
    }
    ?>>
    <?php echo $sup['nom_support']; ?>
    </label>
    <br>
    <?php
    }
    ?>

</fieldset>
    <button type="submit"> Modifier l'article </button>
</form>
</main>
<?php include("static/footer.php"); ?>
<?php closeDB($mysqli); ?>
</body>
</html>