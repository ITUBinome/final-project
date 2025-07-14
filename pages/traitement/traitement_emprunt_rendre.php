<?php
require "../../inc/functions.php";
    session_start();
    if (isset($_GET['rend'])) {
        $rend = $_GET['rend'];
        $id_mebre = $_SESSION['user']['nom'];
        $sql = "update emprunt set date_retour = 'now()' where id_emprunt = '$rend' AND id_membre = '$id_mebre'";
        mysqli_query(dbconnect() , $sql);
    }