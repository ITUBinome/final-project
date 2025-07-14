<?php
require "connection.php";

/*============ User =========*/

function  user_add($nom , $date_de_naissance , $genre, $mail, $ville, $mdp , $image_profil)
{
    $nom = mysqli_real_escape_string(dbconnect(), $nom);
    $date_naissance = mysqli_real_escape_string(dbconnect(), $date_de_naissance);
    $genre = mysqli_real_escape_string(dbconnect(), $genre);
    $email = mysqli_real_escape_string(dbconnect(), $mail);
    $ville = mysqli_real_escape_string(dbconnect(), $ville);
    $mdp = mysqli_real_escape_string(dbconnect(), $mdp);
    $image_profil = mysqli_real_escape_string(dbconnect(), $image_profil);

    $sql = "INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil)
            VALUES ('$nom', '$date_naissance', '$genre', '$email', '$ville', '$mdp', '$image_profil')";

    mysqli_query(dbconnect(), $sql);
}

function compte_exist($email , $mdp)
{
    $mysql_user_login = "SELECT * FROM membre WHERE email = '$email' AND mdp = '$mdp'";
    
    if (mysqli_num_rows(mysqli_query(dbconnect() , $mysql_user_login)) > 0) {
        return true;
    } 
    return false;

}

function get_user_by_id($id) {
    $sql = "SELECT * FROM membre WHERE id_membre = $id";
    $user = mysqli_query(dbconnect(), $sql);

    if ($user != null && mysqli_num_rows($user) > 0) {
        $user = mysqli_fetch_assoc($user);

        return $user;
    }
    return null;
}

function get_user_by_mail_mdp($email, $mdp) {
    $sql = "SELECT * FROM membre WHERE email = '$email' AND mdp = '$mdp'";
    $user = mysqli_query(dbconnect(), $sql);

    if ($user != null && mysqli_num_rows($user) > 0) {
        $user = mysqli_fetch_assoc($user);

        return $user;
    }
    return null;
}

function get_liste_objet() {
    $sql = "SELECT * FROM vue_objets_complets";
    $result = mysqli_query(dbconnect(), $sql);
    $objets = [];

    if ($result != null && mysqli_num_rows($result) > 0) {
        while ($objet = mysqli_fetch_assoc($result)) {
            $objets[] = $objet;
        }
    }

    return $objets;
}