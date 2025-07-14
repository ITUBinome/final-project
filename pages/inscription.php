
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/css/inscription.css">
</head>
<body>

    <header>
        <h1>Créer un compte</h1>
    </header>

    <div class="container">
        <form action="traitement/traitement-inscription.php" method="POST" enctype="multipart/form-data">

            <label for="nom">Nom complet :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="date_naissance">Date de naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" required>

            <label for="genre">Genre :</label>
            <select id="genre" name="genre" required>
                <option value="">-- Choisir --</option>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>

            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>

            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" required>

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" required>

            <label for="image_profil">Image de profil :</label>
            <input type="file" id="image_profil" name="image_profil" accept="image/*">

            <input type="submit" value="S'inscrire">
        </form>

        <div class="back-link">
            <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> EmpruntObjets - Tous droits réservés
    </footer>

</body>
</html>
