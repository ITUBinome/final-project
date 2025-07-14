<?php
session_start();
session_destroy();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    <form action="traitement_inscription.php" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom complet :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="date_naissance">Date de naissance :</label><br>
        <input type="date" id="date_naissance" name="date_naissance" required><br><br>

        <label for="genre">Genre :</label><br>
        <select id="genre" name="genre" required>
            <option value="">--Choisir--</option>
            <option value="M">Masculin</option>
            <option value="F">Féminin</option>
        </select><br><br>

        <label for="email">Adresse e-mail :</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="ville">Ville :</label><br>
        <input type="text" id="ville" name="ville" required><br><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" required><br><br>

        <label for="image_profil">Image de profil :</label><br>
        <input type="file" id="image_profil" name="(image_profil)" accept="image/*"><br><br>

        <input type="submit" value="S'inscrire">
    </form>

</body>
</html>