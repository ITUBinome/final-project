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
    <title>Filtrer par catégorie - Emprunt d'objets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav {
            background-color: #4e73df;
            padding: 1rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1.5rem;
            margin: 0 0.5rem;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .filter-form {
            max-width: 500px;
            margin: 0 auto 2rem;
            padding: 0 1rem;
        }

        .filter-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #495057;
        }

        .filter-form select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 1rem;
            color: #495057;
            background-color: #fff;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .filter-form select:focus {
            border-color: #4e73df;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
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

        .no-objets {
            text-align: center;
            grid-column: 1 / -1;
            padding: 2rem;
            color: #6c757d;
            font-size: 1.1rem;
        }

        footer {
            background-color: #e9ecef;
            color: #6c757d;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <nav class="d-flex justify-content-center">
        <a href="liste-objet.php">Liste objets</a>
        <a href="filtrage-by-categorie.php">Filtrer par catégorie</a>
        <a href="logout.php">Déconnexion</a>
    </nav>

    <form method="GET" action="" class="filter-form">
        <label for="categorie">Choisir une catégorie :</label>
        <select name="categorie" id="categorie" onchange="this.form.submit()" class="form-select">
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
                    echo '<img src="../assets/images/default.jpg">';
                }

                echo '<div class="card-body">';
                echo '<h3>' . htmlspecialchars($objet['nom_objet']) . '</h3>';
                echo '<p><strong>Catégorie :</strong> ' . htmlspecialchars($objet['nom_categorie']) . '</p>';
                echo '<p><strong>Propriétaire :</strong> ' . htmlspecialchars($objet['proprietaire']) . '</p>';

                if ($objet['statut_emprunt'] === 'Emprunté') {
                    echo '<p class="emprunte">Statut : Emprunté</p>';
                    echo '<p><small>Depuis le ' . htmlspecialchars($objet['date_emprunt']) . '</small></p>';
                } else {
                    echo '<p class="disponible">Statut : Disponible</p>';
                }
                echo '</div></div>';
            }
        }
        ?>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> EmpruntObjets - Tous droits réservés
    </footer>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>