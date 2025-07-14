<?php
session_start();
require "../inc/functions.php";

$objets = get_liste_objet();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets - Emprunt d'objets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 0 2rem;
            margin-bottom: 3rem;
            flex-grow: 1;
        }

        .card {
            cursor: pointer;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #e9ecef;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card h3 {
            font-size: 1.25rem;
            margin-top: 0;
            margin-bottom: 0.75rem;
            color: #212529;
        }
      
        .card p {
            margin-bottom: 0.5rem;
            color: #495057;
            font-size: 0.95rem;
        }

        .card p strong {
            color: #343a40;
        }

        .disponible {
            color: #28a745;
            font-weight: 600;
            margin-top: 1rem;
        }

        .emprunte {
            color: #dc3545;
            font-weight: 600;
            margin-top: 1rem;
        }

        .card p small {
            color: #6c757d;
            font-size: 0.85rem;
        }

        footer {
            background-color: #e9ecef;
            color: #6c757d;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: auto;
        }

        .upload-image {
        max-width: 600px;
        margin: 2rem auto;
    }
    
    
    </style>
</head>
<body>

    <?php include "../inc/nav.php" ?>

    <div class="container">
        <?php
        foreach ($objets as $objet) {
            ?>
            <div class="card">
                <?php
                if (!empty($objet['image'])) {
                    echo '<img src="../images/' . htmlspecialchars($objet['image']) . '" alt="' . htmlspecialchars($objet['nom_objet']) . '">';
                } else {
                    echo '<img src="../assets/images/default.jpg">';
                }
                ?>

                <div class="card-body">
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
            </div>
            <?php
        }
        ?>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> EmpruntObjets - Tous droits réservés
    </footer>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Modif -->
</body>
</html>