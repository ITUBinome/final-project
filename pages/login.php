<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Connexion</h1>

    <form action="traitement_connexion.php" method="POST">
        <label for="email">Adresse e-mail :</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" required><br><br>

        <input type="submit" value="Se connecter">
    </form>
    
</body>
</html>