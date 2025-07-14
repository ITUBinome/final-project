<?php
require "../../inc/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     
    $nom = trim($_POST['nom']);
    $date_de_naissance = $_POST['date_naissance'];
    $genre = $_POST['genre'];
    $mail = trim($_POST['email']);
    $ville = trim($_POST['ville']);
    $mdp = $_POST['mdp'];
    $image_profil = "profil.png";
    
    if (empty($nom) || empty($mail) || empty($mdp)) {
        header("Location: ../inscription.php?error=champ");
        exit();
    }
    
    // Traitement de l'upload d'image
    if (isset($_FILES['image_profil']) && $_FILES['image_profil']['error'] === UPLOAD_ERR_OK) {
        
        $upload_dir = '../uploads/profils/';
        $max_size = 5 * 1024 * 1024; 
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        // Créer le dossier s'il n'existe pas
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_tmp = $_FILES['image_profil']['tmp_name'];
        $file_size = $_FILES['image_profil']['size'];
        $file_type = $_FILES['image_profil']['type'];
        $file_name = $_FILES['image_profil']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        //  sécurité
        if ($file_size > $max_size) {
            header("Location: ../inscription.php?error=size");
            exit();
        }
        
        if (!in_array($file_type, $allowed_types) || !in_array($file_ext, $allowed_extensions)) {
            // $_SESSION['error'] = "Format d'image non autorisé. Formats acceptés : JPG, PNG, GIF, WEBP.";
            header("Location: ../inscription.php?error=format");
            exit();
        }
        
        // Vérification supplémentaire du type MIME réel
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $real_mime = $finfo->file($file_tmp);
        if (!in_array($real_mime, $allowed_types)) {
            // $_SESSION['error'] = "Type de fichier non valide détecté.";
            header("Location: ../inscription.php?error=type");
            exit();
        }
        
        // Génération d'un nom de fichier unique et sécurisé
        $unique_name = uniqid('profil_', true) . '.' . $file_ext;
        $upload_path = $upload_dir . $unique_name;
        
        // upload
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $image_profil = $unique_name;
            
        } else {
            // $_SESSION['error'] = "Erreur lors de l'upload de l'image.";
            header("Location: ../inscription.php?erro=upload");
            exit();
        }
        
    } elseif (isset($_FILES['image_profil']) && $_FILES['image_profil']['error'] !== UPLOAD_ERR_NO_FILE) {
        
        // $_SESSION['error'] = $upload_errors[$error_code] ?? "Erreur inconnue lors de l'upload.";
        header("Location: ../inscription.php?erro=inconnue");
        exit();
    }
    
    // Tentative d'ajout de l'utilisateur
    user_add($nom, $date_de_naissance, $genre, $mail, $ville, $mdp, $image_profil);
    // Session user
    session_start();
    $_SESSION['user'] = get_user_by_mail_mdp($mail, $mdp);

    header("Location: ../liste-objet.php");
    exit();
}

?>