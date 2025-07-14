<?php
require "../../inc/functions.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_objet = $_POST['nom_objet'];
    $id_categorie = $_POST['id_categorie'];
    $id_user = $_SESSION['user']['id_membre'];

    $image_objets = "objet.png";

    if (!empty($_FILES['images']['name'][0])) {

        $uploadDir = '../objets/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $maxSizeMB = 5;
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) {
            $isMultiple = is_array($_FILES['images']['name']);

            $names = $isMultiple ? $_FILES['images']['name'] : [$_FILES['images']['name']];
            $tmp_names = $isMultiple ? $_FILES['images']['tmp_name'] : [$_FILES['images']['tmp_name']];
            $sizes = $isMultiple ? $_FILES['images']['size'] : [$_FILES['images']['size']];
            $errors = $isMultiple ? $_FILES['images']['error'] : [$_FILES['images']['error']];

            for ($i = 0; $i < count($names); $i++) {
                $fileName = basename($names[$i]);
                $fileTmp = $tmp_names[$i];
                $fileSize = $sizes[$i];
                $fileError = $errors[$i];

                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $newFileName = uniqid('img_', true) . '.' . $fileExt;
                $filePath = $uploadDir . $newFileName;

                if ($fileError !== UPLOAD_ERR_OK) {
                    echo "<p style='color:red;'>Erreur lors de l'upload de $fileName.</p>";
                    continue;
                }

                if (!in_array($fileExt, $allowedExtensions)) {
                    echo "<p style='color:red;'>Extension non autorisée pour $fileName.</p>";
                    continue;
                }

                if ($fileSize > $maxSizeMB * 1024 * 1024) {
                    echo "<p style='color:red;'>$fileName est trop grand (max {$maxSizeMB}MB).</p>";
                    continue;
                }

                if (move_uploaded_file($fileTmp, $filePath)) {
                    echo "<p style='color:green;'>$fileName uploadé avec succès.</p>";
                    echo "<img src='$filePath' alt='' style='max-width:200px;'><br><br>";
                } else {
                    echo "<p style='color:red;'>Erreur lors de la sauvegarde de $fileName.</p>";
                }
            }
        } else {
            echo "<p>Aucun fichier reçu.</p>";
        }
    }
}


?>