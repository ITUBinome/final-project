<?php
session_start();
session_destroy();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if (compte_exist($email , $mdp)) {
        header("Location:../liste-objet.php");
    } else {
        header("Location:../login.php");
    }
}