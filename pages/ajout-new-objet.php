<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'objet - Emprunt d'objets</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-hover: #3a5bbf;
            --secondary-color: #f8f9fa;
            --border-color: #e0e0e0;
            --text-color: #495057;
            --light-text: #6c757d;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            
        }
        
        .upload-container {
            max-width: 650px;
            margin: 0 auto;
            width: 100%;
        }
        
        .upload-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .upload-card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            padding: 1.75rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
        }
        
        .card-title {
            font-weight: 700;
            margin: 0;
            font-size: 1.75rem;
            letter-spacing: -0.5px;
        }
        
        .card-body {
            padding: 2.5rem;
            background-color: #fff;
        }
        
        .form-group {
            margin-bottom: 1.75rem;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--text-color);
            display: block;
            font-size: 1.05rem;
        }
        
        .form-control, .form-select {
            padding: 0.85rem 1.25rem;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            width: 100%;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.2);
            outline: none;
        }
        
        .file-upload-wrapper {
            position: relative;
            margin-top: 0.5rem;
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }
        
        .file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            cursor: pointer;
        }
        
        .file-upload-info {
            padding: 2.5rem 2rem;
            border: 2px dashed var(--border-color);
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
            background-color: var(--secondary-color);
        }
        
        .file-upload:hover .file-upload-info {
            border-color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.05);
        }
        
        .file-upload-info .upload-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1.25rem;
            display: block;
        }
        
        .file-upload-info p {
            margin: 0;
            color: var(--text-color);
            font-weight: 500;
        }
        
        .file-upload-info small {
            color: var(--light-text);
            font-size: 0.85rem;
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            border: none;
            color: white;
            font-weight: 600;
            padding: 1rem;
            border-radius: 10px;
            width: 100%;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn-submit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .card-body {
                padding: 1.75rem;
            }
            
            .card-title {
                font-size: 1.5rem;
            }
            
            .file-upload-info {
                padding: 1.75rem 1.5rem;
            }
        }
    </style>
</head>
<body>

        <?php include "../inc/nav.php" ?>

    <div class="upload-container">
        <div class="upload-card">
            <div class="card-header">
                <h1 class="card-title">Ajouter un nouvel objet</h1>
            </div>
            <div class="card-body">
                <form action="traitement/traitement-ajout-objet.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom_objet" class="form-label">Nom de l'objet</label>
                        <input type="text" class="form-control" id="nom_objet" name="nom_objet" placeholder="Ex: Perceuse électrique" required>
                    </div>

                    <div class="form-group">
                        <label for="id_categorie" class="form-label">Catégorie</label>
                        <select class="form-select" id="id_categorie" name="id_categorie" required>
                            <option value="" selected disabled>-- Sélectionnez une catégorie --</option>
                            <option value="1">Esthétique</option>
                            <option value="2">Bricolage</option>
                            <option value="3">Mécanique</option>
                            <option value="4">Cuisine</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image_objet" class="form-label">Images de l'objet</label>
                        <div class="file-upload-wrapper">
                            <div class="file-upload">
                                <input type="file" id="image_objet" name="image_objet[]" accept="image/*" multiple required>
                                <div class="file-upload-info">
                                    <i class="bi bi-cloud-arrow-up upload-icon"></i>
                                    <p>Glissez-déposez vos fichiers ou cliquez pour sélectionner</p>
                                    <small>Formats acceptés: JPG, PNG, WEBP (max 5MB par image)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="bi bi-plus-circle"></i> Ajouter l'objet
                    </button>
                </form>
            </div>
        </div>
    </div>

        <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>