<?php
    session_start();
    require "../../inc/functions.php";

    $id_membre = $_SESSION['id_membre']; // récupéré via la session
    $nom_objet = $_POST['nom_objet'];
    $id_categorie = $_POST['id_categorie'];

    // 1. Ajout de l'objet
    $id_objet = ajouter_objet($nom_objet, $id_categorie, $id_membre);

    // 2. Upload des images (et insertion en BDD)
    $images = upload_images($_FILES['image_objet'], "../images/");
    ajouter_images_objet($id_objet, $images);

    // 3. Redirection ou message
    header("Location: ../liste-objet.php");
    exit;
?>
