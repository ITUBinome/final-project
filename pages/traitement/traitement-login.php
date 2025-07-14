<?php
require "../../inc/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if (compte_exist($email , $mdp)) {
        // Session user
        session_start();
        $_SESSION['user'] = get_user_by_mail_mdp($email, $mdp);

        header("Location:../liste-objet.php");
    } else {
        header("Location:../login.php");
    }
}