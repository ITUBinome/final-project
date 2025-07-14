<?php
session_start();
require "../inc/functions.php";

$objets = get_liste_objet();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/liste-objet.css">
</head>
<body>

    <header>
        <h1>Objets disponibles à l'emprunt</h1>
    </header>

    <?php include "../inc/nav.php" ?>

    <div class="container upload-image">
        <h3>Ajouter de nouveau objet</h3>
        <form action="traitement/traitement-ajout-objet.php" method="post" enctype="multipart/form-data">

            <label for="nom_objet">Nom objet :</label>
            <input type="text" name="nom_objet" required>

            <label for="id_categorie">Catégorie :</label>
            <select name="id_categorie" id="" required>
                <option value="1">Esthétique</option>
                <option value="2">Bricolage</option>
                <option value="3">Mécanique</option>
                <option value="4">Cuisine</option>
            </select>


            <label for="image_objet">Image objet :</label>
            <input type="file" id="image_objet" name="image_objet[]" accept="image/*" multiple>

            <input type="submit" value="Ajouter">

        </form>
    </div>
    <div class="container">
        <?php
        foreach ($objets as $objet) {
            ?>
            <div class="card">
                <?php
                if (!empty($objet['image'])) {
                    echo '<img src="../images/' . htmlspecialchars($objet['image']) . '" alt="' . htmlspecialchars($objet['nom_objet']) . '">';
                } else {
                    echo '<img src="../images/placeholder.jpg" alt="Aucune image">';
                }
                ?>

                <h3><?= htmlspecialchars($objet['nom_objet']) ?></h3>
                <p><strong>Catégorie :</strong> <?= htmlspecialchars($objet['nom_categorie']) ?></p>
                <p><strong>Propriétaire :</strong> <?= htmlspecialchars($objet['proprietaire']) ?></p>

                <?php
                if ($objet['statut_emprunt'] === 'Emprunté') {
                    echo '<p class="emprunte">Statut : Emprunté</p>';
                    echo '<p><small>Depuis le ' . htmlspecialchars($objet['date_emprunt']) . '</small></p>';
                } else {
                    echo '<p class="disponible">Statut : Disponible</p>';
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> EmpruntObjets - Tous droits réservés
    </footer>

</body>
</html>
