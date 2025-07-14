<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bienvenue - Emprunt d'objets</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        header {
            padding: 3rem 1rem;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            text-align: center;
            margin-bottom: 2rem;
        }

        header h1 {
            font-weight: 700;
            color: #212529;
            font-size: 2rem;
            margin: 0;
        }

        .welcome-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .auth-cards {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            width: 100%;
            max-width: 800px;
        }

        @media (min-width: 768px) {
            .auth-cards {
                flex-direction: row;
            }
        }

        .auth-card {
            flex: 1;
            text-decoration: none;
            color: #495057;
            background-color: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .auth-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
            color: #4e73df;
            border-color: rgba(78, 115, 223, 0.2);
        }

        .auth-card img {
            width: 64px;
            height: 64px;
            margin-bottom: 1.5rem;
            object-fit: contain;
        }

        .auth-card h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .auth-card p {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        footer {
            background-color: #e9ecef;
            text-align: center;
            padding: 1.5rem 0;
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 3rem;
        }

        .welcome-message {
            max-width: 800px;
            margin: 0 auto 3rem;
            text-align: center;
            color: #6c757d;
            padding: 0 1.5rem;
        }
    </style>
</head>
<body>

    <header>
        <h1>Bienvenue sur la plateforme d'emprunt d'objets</h1>
        <div class="welcome-message">
            <p class="lead">Connectez-vous ou inscrivez-vous pour commencer à emprunter ou prêter des objets entre membres de la communauté.</p>
        </div>
    </header>

    <main class="welcome-container">
        <div class="auth-cards">

            <a href="login.php" class="auth-card" aria-label="Se connecter">
                <img src="../assets/images/login.png" alt="Icône connexion" />
                <h2>Se connecter</h2>
                <p>Accédez à votre compte existant</p>
            </a>

            <a href="inscription.php" class="auth-card" aria-label="S'inscrire">
                <img src="../assets/images/register.png" alt="Icône inscription" />
                <h2>S'inscrire</h2>
                <p>Créez un nouveau compte</p>
            </a>

        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> EmpruntObjets - Tous droits réservés
    </footer>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>