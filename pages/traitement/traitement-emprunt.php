<?php
session_start();
require "../../inc/functions.php";

if (!isset($_POST['id_objet'], $_POST['duree'])) {
    header("Location: ../liste-objet.php");
    exit;
}

$id_objet = (int) $_POST['id_objet'];
$duree = (int) $_POST['duree'];
$id_membre = (int) $_SESSION['user']['id_membre'];

emprunter_objet($id_objet, $id_membre, $duree);


header("Location: ../liste-objet.php");
exit;
