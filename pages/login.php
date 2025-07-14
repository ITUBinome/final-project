<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Connexion - Emprunt d'objets</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    
    .auth-wrapper {
      display: flex;
      flex-direction: column;
      justify-content: center;
      flex-grow: 1;
    }
    
    .auth-card {
      max-width: 450px;
      margin: 0 auto;
      border: none;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }
    
    .auth-header {
      background-color: #ffffff;
      padding: 1.5rem;
      text-align: center;
      border-bottom: 1px solid #e9ecef;
    }
    
    .auth-header h1 {
      font-weight: 700;
      color: #212529;
      margin: 0;
      font-size: 1.8rem;
    }
    
    .auth-body {
      padding: 2rem;
      background-color: #ffffff;
    }
    
    .form-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      width: 20px;
      height: 20px;
      pointer-events: none;
      opacity: 0.6;
    }
    
    .form-control {
      padding-left: 45px !important;
      height: 48px;
      border-radius: 8px;
      border: 1px solid #e0e0e0;
      transition: all 0.3s;
    }
    
    .form-control:focus {
      border-color: #4e73df;
      box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }
    
    .form-label {
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #495057;
    }
    
    .btn-primary {
      background-color: #4e73df;
      border-color: #4e73df;
      padding: 12px;
      font-weight: 600;
      border-radius: 8px;
      transition: all 0.3s;
    }
    
    .btn-primary:hover {
      background-color: #2e59d9;
      border-color: #2e59d9;
    }
    
    .footer {
      background-color: #e9ecef;
      color: #6c757d;
      padding: 1.5rem 0;
      text-align: center;
      margin-top: auto;
    }
    
    .register-link {
      text-align: center;
      margin-top: 1.5rem;
    }
    
    .register-link a {
      color: #4e73df;
      text-decoration: none;
      font-weight: 500;
    }
    
    .register-link a:hover {
      text-decoration: underline;
    }
    
    .forgot-password {
      text-align: right;
      margin-top: 0.5rem;
    }
    
    .forgot-password a {
      color: #6c757d;
      text-decoration: none;
      font-size: 0.9rem;
    }
    
    .forgot-password a:hover {
      text-decoration: underline;
      color: #4e73df;
    }
  </style>
</head>

<body>
  <div class="auth-wrapper">
    <div class="container">
      <div class="auth-card">
        <div class="auth-header">
          <h1>Connexion</h1>
        </div>
        
        <div class="auth-body">
          <form action="traitement/traitement-login.php" method="POST" novalidate>
            <!-- Email -->
            <div class="mb-4">
              <label for="email" class="form-label">Adresse e-mail</label>
              <div class="position-relative">
                <img src="../assets/images/icon-email.png" alt="Icône email" class="form-icon" />
                <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com" required>
              </div>
            </div>
            
            <!-- Mot de passe -->
            <div class="mb-3">
              <label for="mdp" class="form-label">Mot de passe</label>
              <div class="position-relative">
                <img src="../assets/images/icon-password.png" alt="Icône mot de passe" class="form-icon" />
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="••••••••" required>
              </div>
              <div class="forgot-password">
                <a href="mot-de-passe-oublie.php">Mot de passe oublié ?</a>
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 py-3">
              Se connecter
            </button>
            
            <div class="register-link">
              <p>Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <footer class="footer">
    &copy; <?php echo date("Y"); ?> EmpruntObjets - Tous droits réservés
  </footer>

  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>