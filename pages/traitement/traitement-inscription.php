<?php
require "../../inc/functions.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $date_de_naissance = $_POST['date_naissance'];
    $genre = $_POST['genre'];
    $mail = $_POST['email'];
    $mdp = $_POST['mdp'];

    $image_profil = "profil.png";
    
    if (isset($_FILES['image_profil'])) {   
        $image_profil = $_POST['image_profil'];
    }
    
    user_add($nom , $date_de_naissance , $genre, $mail, $mdp , $image_profil);
    header("Location:../index.php");
}
?>