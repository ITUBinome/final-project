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
        }

        header {
            padding: 2rem 1rem;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
            text-align: center;
        }

        header h1 {
            font-weight: 700;
            color: #343a40;
            font-size: 1.8rem;
        }

        .container-main {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 1rem;
        }

        .card-link {
            width: 280px;
            text-decoration: none;
            color: #495057;
            background-color: #fff;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .card-link:hover, .card-link:focus {
            box-shadow: 0 8px 20px rgb(0 0 0 / 0.15);
            transform: translateY(-4px);
            color: #0d6efd;
        }

        .card-link img.icon {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
        }

        .card-text {
            font-size: 1.25rem;
            font-weight: 600;
        }

        footer {
            background-color: #e9ecef;
            text-align: center;
            padding: 1rem 0;
            font-size: 0.9rem;
            color: #6c757d;
            user-select: none;
        }

        @media (max-width: 576px) {
            .card-link {
                width: 90vw;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Bienvenue sur la plateforme d'emprunt d'objets</h1>
    </header>

    <main class="container-main">
        <div class="d-flex flex-column flex-sm-row gap-4">

            <a href="login.php" class="card-link" aria-label="Se connecter">
                <img src="../assets/images/login.png" alt="" class="icon" />
                <span class="card-text">Se connecter</span>
            </a>

            <a href="inscription.php" class="card-link" aria-label="S'inscrire">
                <img src="../assets/images/register.png" alt="" class="icon" />
                <span class="card-text">S'inscrire</span>
            </a>

        </div>
    </main>

    <footer>
        &copy; <?php echo date("Y"); ?> Tous droits réservés.
    </footer>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
