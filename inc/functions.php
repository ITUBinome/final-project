<?php
require "connection.php";

/*============ User =========*/

function  user_add($nom , $date_de_naissance , $genre, $mail, $mdp , $image_profil)
{
    $mysql_user = "INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp) 
    VALUES ($nom , $date_de_naissance , $genre, $mail, $mdp , $image_profil)";

    mysqli_query(dbconnect() , $mysql_user);
}

function compte_exist($email , $mdp)
{
    $mysql_user_login = "SELECT * FROM membre WHERE email = '$email' AND mdp = '$mdp'";
    
    if (mysqli_num_rows(mysqli_query(dbconnect() , $mysql_user_login)) > 0) {
        return true;
    } 
    return false;

}