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

    <nav>
        <a href="liste-objet.php">Liste objets</a>
        <a href="filtrage-by-categorie.php">Filtrer par catégorie</a>
        <a href="logout.php">Déconnexion</a>
    </nav>

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
