<?php
session_start();
require "../inc/functions.php";

$categories = get_categories();
$id_categorie = isset($_GET['categorie']) ? $_GET['categorie'] : null;
$objets = get_objets_par_categorie($id_categorie);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Filtrer par catégorie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/filtre.css">
</head>
<body>

    <header>
        <h1>Filtrer les objets par catégorie</h1>
    </header>

    <?php include "../inc/nav.php" ?>

    <form method="GET" action="">
        <label for="categorie">Choisir une catégorie :</label>
        <select name="categorie" id="categorie" onchange="this.form.submit()">
            <option value="">-- Toutes les catégories --</option>
            <?php
            foreach ($categories as $cat) {
                $selected = ($id_categorie == $cat['id_categorie']) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($cat['id_categorie']) . '" ' . $selected . '>' .
                    htmlspecialchars($cat['nom_categorie']) . '</option>';
            }
            ?>
        </select>
    </form>

    <div class="container">
        <?php
        if (empty($objets)) {
            echo '<p class="no-objets">Aucun objet trouvé pour cette catégorie.</p>';
        } else {
            foreach ($objets as $objet) {
                echo '<div class="card">';
                if (!empty($objet['image'])) {
                    echo '<img src="../images/' . htmlspecialchars($objet['image']) . '" alt="' . htmlspecialchars($objet['nom_objet']) . '">';
                } else {
                    echo '<img src="../images/placeholder.jpg" alt="Aucune image">';
                }

                echo '<h3>' . htmlspecialchars($objet['nom_objet']) . '</h3>';
                echo '<p><strong>Catégorie :</strong> ' . htmlspecialchars($objet['nom_categorie']) . '</p>';
                echo '<p><strong>Propriétaire :</strong> ' . htmlspecialchars($objet['proprietaire']) . '</p>';

                if ($objet['statut_emprunt'] === 'Emprunté') {
                    echo '<p class="emprunte">Statut : Emprunté</p>';
                    echo '<p><small>Depuis le ' . htmlspecialchars($objet['date_emprunt']) . '</small></p>';
                } else {
                    echo '<p class="disponible">Statut : Disponible</p>';
                }

                echo '</div>';
            }
        }
        ?>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> EmpruntObjets - Tous droits réservés
    </footer>

</body>
</html>
