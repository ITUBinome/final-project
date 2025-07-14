<?php
session_start();
require "../inc/functions.php";

if (!isset($_GET['id_objet']) || !isset($_SESSION['user'])) {
    header("Location: liste-objet.php");
    exit;
}

$id_objet = (int)$_GET['id_objet'];
$objet = get_objet_details($id_objet);

if (!$objet) {
    $_SESSION['message'] = "Objet introuvable.";
    header("Location: liste-objets.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Emprunter un objet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body style="background-color: #f8f9fa;">

    <?php include "../inc/nav.php"; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Emprunter : <?= htmlspecialchars($objet['nom_objet']) ?></h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $img = $objet['images'][0] ?? 'default.jpg';
                        ?>
                        <div class="text-center mb-3">
                            <img src="../images/<?= htmlspecialchars($img) ?>" class="img-fluid rounded" style="max-height: 250px;" alt="Objet">
                        </div>

                        <form action="traitement/traitement-emprunt.php" method="POST">
                            <input type="hidden" name="id_objet" value="<?= $id_objet ?>">

                            <div class="mb-3">
                                <label for="duree" class="form-label">Durée de l'emprunt (en jours) :</label>
                                <input type="number" class="form-control" id="duree" name="duree" min="1" max="30" value="3" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">Valider l'emprunt</button>
                                <a href="liste-objet.php" class="btn btn-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-auto py-4 text-muted bg-light">
        &copy; <?= date("Y") ?> EmpruntObjets - Tous droits réservés
    </footer>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
