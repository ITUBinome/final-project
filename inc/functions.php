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

    $sql = "
        SELECT 
            o.id_objet,
            o.nom_objet,
            c.nom_categorie,
            m.nom AS proprietaire,
            (SELECT nom_image FROM images_objet WHERE id_objet = o.id_objet LIMIT 1) AS image,
            e.date_emprunt,
            e.date_retour
        FROM objet o
        JOIN categorie_objet c ON o.id_categorie = c.id_categorie
        JOIN membre m ON o.id_membre = m.id_membre
        LEFT JOIN emprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NULL
        ORDER BY o.id_objet DESC
    ";

    $result = mysqli_query(dbconnect(), $sql);
    $objets = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $row['statut_emprunt'] = $row['date_retour'] === null && $row['date_emprunt'] !== null ? 'Emprunté' : 'Disponible';
        $objets[] = $row;
    }

    mysqli_close(dbconnect());
    return $objets;
}

function get_categories() {
    $conn = dbconnect();
    $sql = "SELECT * FROM categorie_objet ORDER BY nom_categorie";
    $result = mysqli_query($conn, $sql);

    $categories = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    mysqli_close($conn);
    return $categories;
}


function get_objets_par_categorie($id_categorie = null) {
    $conn = dbconnect();

    $where = "";
    if ($id_categorie) {
        $id_categorie = mysqli_real_escape_string($conn, $id_categorie);
        $where = "WHERE o.id_categorie = $id_categorie";
    }

    $sql = "
        SELECT 
            o.id_objet,
            o.nom_objet,
            c.nom_categorie,
            m.nom AS proprietaire,
            (SELECT nom_image FROM images_objet WHERE id_objet = o.id_objet LIMIT 1) AS image,
            e.date_emprunt,
            e.date_retour
        FROM objet o
        JOIN categorie_objet c ON o.id_categorie = c.id_categorie
        JOIN membre m ON o.id_membre = m.id_membre
        LEFT JOIN emprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NULL
        $where
        ORDER BY o.id_objet DESC
    ";

    $result = mysqli_query($conn, $sql);
    $objets = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $row['statut_emprunt'] = $row['date_retour'] === null && $row['date_emprunt'] !== null ? 'Emprunté' : 'Disponible';
        $objets[] = $row;
    }

    mysqli_close($conn);
    return $objets;
}

function ajouter_images_objet($id_objet, $noms_images) {
    $connexion = dbconnect();

    if (empty($noms_images)) {
        $requete = "INSERT INTO images_objet (id_objet, nom_image) VALUES ($id_objet, 'placeholder.jpg')";
        mysqli_query($connexion, $requete);
    } else {
        foreach ($noms_images as $image) {
            $image = mysqli_real_escape_string($connexion, $image);
            $requete = "INSERT INTO images_objet (id_objet, nom_image) VALUES ($id_objet, '$image')";
            mysqli_query($connexion, $requete);
        }
    }
}


function upload_images($files, $uploadDir) {
    $noms_images = [];

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $maxSize = 5 * 1024 * 1024; // 5 Mo
    $extensions_autorisees = ['jpg', 'jpeg', 'png', 'gif'];

    $names = is_array($files['name']) ? $files['name'] : [$files['name']];
    $tmp_names = is_array($files['tmp_name']) ? $files['tmp_name'] : [$files['tmp_name']];
    $sizes = is_array($files['size']) ? $files['size'] : [$files['size']];
    $errors = is_array($files['error']) ? $files['error'] : [$files['error']];

    for ($i = 0; $i < count($names); $i++) {
        if (empty($names[$i])) continue;

        $nom = basename($names[$i]);
        $tmp = $tmp_names[$i];
        $taille = $sizes[$i];
        $erreur = $errors[$i];

        $extension = strtolower(pathinfo($nom, PATHINFO_EXTENSION));
        $nouveau_nom = uniqid("img_", true) . "." . $extension;
        $chemin_final = $uploadDir . $nouveau_nom;

        if ($erreur === UPLOAD_ERR_OK &&
            in_array($extension, $extensions_autorisees) &&
            $taille <= $maxSize) {
            
            if (move_uploaded_file($tmp, $chemin_final)) {
                $noms_images[] = $nouveau_nom; // ✅ Nom à insérer en BDD
            }
        }
    }

    return $noms_images;
}

function ajouter_objet($nom, $id_categorie, $id_membre) {
    $connexion = dbconnect();
    $nom = mysqli_real_escape_string($connexion, $nom);

    $requete = "INSERT INTO objet (nom_objet, id_categorie, id_membre)
                VALUES ('$nom', $id_categorie, $id_membre)";
    mysqli_query($connexion, $requete);

    return mysqli_insert_id($connexion); // ID du nouvel objet
}
