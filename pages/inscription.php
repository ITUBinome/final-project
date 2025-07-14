<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inscription - Emprunt d'objets</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-top: 2rem;
    }
    
    .auth-wrapper {
      display: flex;
      flex-direction: column;
      justify-content: center;
      flex-grow: 1;
    }
    
    .auth-card {
      max-width: 600px;
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
      opacity: 0.8;
    }
    
    .form-control, .form-select {
      padding-left: 45px !important;
      height: 48px;
      border-radius: 8px;
      border: 1px solid #e0e0e0;
      transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
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
      padding: 0.6rem 1.2rem;
      font-weight: 600;
      border-radius: 8px;
      transition: all 0.3s;
    }
    
    .btn-primary:hover {
      background-color: #2e59d9;
      border-color: #2e59d9;
    }
    
    .file-upload-label {
      display: block;
      background-color: #f8f9fa;
      border: 1px dashed #dee2e6;
      border-radius: 8px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .file-upload-label:hover {
      border-color: #4e73df;
      background-color: #f0f5ff;
    }
    
    .footer {
      background-color: #e9ecef;
      color: #6c757d;
      padding: 1.5rem 0;
      text-align: center;
      margin-top: auto;
    }
    
    .login-link {
      text-align: center;
      margin-top: 1.5rem;
    }
    
    .login-link a {
      color: #4e73df;
      text-decoration: none;
      font-weight: 500;
    }
    
    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="auth-wrapper">
    <div class="container">
      <div class="auth-card">
        <div class="auth-header">
          <h1>Créer un compte</h1>
        </div>
        
        <div class="auth-body">
          <form action="traitement/traitement-inscription.php" method="POST" enctype="multipart/form-data" novalidate>
            <!-- Nom complet -->
            <div class="mb-4">
              <label for="nom" class="form-label">Nom complet</label>
              <div class="position-relative">
                <img src="../assets/images/icon-user.png" alt="Icône utilisateur" class="form-icon" />
                <input type="text" class="form-control" id="nom" name="nom" required>
              </div>
            </div>
            
            <!-- Date de naissance -->
            <div class="mb-4">
              <label for="date_naissance" class="form-label">Date de naissance</label>
              <div class="position-relative">
                <img src="../assets/images/icon-calendar.png" alt="Icône calendrier" class="form-icon" />
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
              </div>
            </div>
            
            <!-- Genre -->
            <div class="mb-4">
              <label for="genre" class="form-label">Genre</label>
              <div class="position-relative">
                <img src="../assets/images/icon-gender.png" alt="Icône genre" class="form-icon" />
                <select class="form-select" id="genre" name="genre" required>
                  <option value="" selected disabled>-- Choisir --</option>
                  <option value="M">Masculin</option>
                  <option value="F">Féminin</option>
                </select>
              </div>
            </div>
            
            <!-- Email -->
            <div class="mb-4">
              <label for="email" class="form-label">Adresse e-mail</label>
              <div class="position-relative">
                <img src="../assets/images/icon-email.png" alt="Icône email" class="form-icon" />
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
            </div>
            
            <!-- Ville -->
            <div class="mb-4">
              <label for="ville" class="form-label">Ville</label>
              <div class="position-relative">
                <img src="../assets/images/icon-city.png" alt="Icône ville" class="form-icon" />
                <input type="text" class="form-control" id="ville" name="ville" required>
              </div>
            </div>
            
            <!-- Mot de passe -->
            <div class="mb-4">
              <label for="mdp" class="form-label">Mot de passe</label>
              <div class="position-relative">
                <img src="../assets/images/icon-password.png" alt="Icône mot de passe" class="form-icon" />
                <input type="password" class="form-control" id="mdp" name="mdp" required>
              </div>
            </div>
            
            <!-- Image de profil -->
            <div class="mb-4">
              <label for="image_profil" class="form-label">Image de profil</label>
              <div class="position-relative">
                <img src="../assets/images/icon-image.png" alt="Icône image" class="form-icon" />
                <input type="file" class="form-control" id="image_profil" name="image_profil" accept="image/*">
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">
              S'inscrire
            </button>
            
            <div class="login-link">
              <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
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