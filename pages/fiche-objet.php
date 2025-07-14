<?php
session_start();
require "../inc/functions.php";

if (!isset($_GET['id'])) {
    header("Location: liste-objets.php");
    exit;
}

$id_objet = intval($_GET['id']);
$objet = get_objet_details($id_objet);

if (!$objet) {
    header("Location: liste-objets.php");
    exit;
}

$historique = get_historique_emprunts($id_objet);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche - <?= htmlspecialchars($objet['nom_objet']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .fiche-objet {
            max-width: 850px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        .main-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .thumbnails {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .thumbnail:hover {
            transform: scale(1.05);
        }

        .disponible {
            color: green;
            font-weight: bold;
        }

        .emprunte {
            color: red;
            font-weight: bold;
        }

        .btn-retour {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
<?php include "../inc/nav.php"; ?>

<div class="fiche-objet">
    <h1><?= htmlspecialchars($objet['nom_objet']) ?></h1>

    <!-- Image principale -->
    <img src="../images/<?= htmlspecialchars($objet['images'][0] ?? 'default.jpg') ?>" 
         alt="Image principale" class="main-image">

    <!-- Miniatures -->
    <?php if (!empty($objet['images'])): ?>
        <div class="thumbnails">
            <?php foreach ($objet['images'] as $image): ?>
                <img src="../images/<?= htmlspecialchars($image) ?>" class="thumbnail" 
                     onclick="document.querySelector('.main-image').src = this.src">
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Détails -->
    <div class="mt-4">
        <p><strong>Catégorie :</strong> <?= htmlspecialchars($objet['nom_categorie']) ?></p>
        <p><strong>Propriétaire :</strong> <?= htmlspecialchars($objet['proprietaire']) ?></p>
        <p><strong>Description :</strong> <?= htmlspecialchars($objet['description'] ?? 'Aucune') ?></p>
        <p class="<?= $objet['statut_emprunt'] === 'Disponible' ? 'disponible' : 'emprunte' ?>">
            Statut : <?= htmlspecialchars($objet['statut_emprunt']) ?>
        </p>
    </div>

    <!-- Historique -->
    <div class="historique mt-5">
        <h4>Historique des emprunts</h4>
        <?php if (!empty($historique)): ?>
            <ul class="list-group">
                <?php foreach ($historique as $emprunt): ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($emprunt['emprunteur']) ?></strong> 
                        le <?= date('d/m/Y', strtotime($emprunt['date_emprunt'])) ?>
                        <?php if ($emprunt['date_retour']): ?>
                            — retourné le <?= date('d/m/Y', strtotime($emprunt['date_retour'])) ?>
                        <?php else: ?>
                            — <span class="text-warning">encore emprunté</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-muted">Aucun historique d'emprunt pour cet objet.</p>
        <?php endif; ?>
    </div>
</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
