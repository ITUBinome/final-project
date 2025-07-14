<?php

ini_set("display_errors", "1");

function dbconnect() {
    
    $host = "localhost";
    $username = "root"; // ETU004282
    $pwd = ""; // OgeGnKyQ
    $db = "emprunt_objets"; // db_s2_ETU004282

    $conn = mysqli_connect($host, $username, $pwd, $db);

    if (! $conn) {
        die("Erreur de connexion à la base de données : ". mysqli_connect_errno());
    }

    // Encodage UTF-8
    mysqli_set_charset($conn, 'utf8mb4');

    return $conn;
}

?>